<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Notification;
use App\Order;
use App\Product;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function checkout()
    {
        $user = User::find(Auth::user()->id);
        $id = $user->id;
        if (Redis::get("user_{$id}_cart") == null) {
            return redirect(route('home'));
        }

        $json_data = Redis::get("user_{$id}_cart");
        $data = json_decode($json_data);

        $sid = $data->sid;

        if (isset($data->coupon)) {
            $coupon = Coupon::where('code', $data->coupon)->get()[0];

            $start = Carbon::createFromFormat('Y-m-d', $coupon->start_at)->startOfDay();
            $end = Carbon::createFromFormat('Y-m-d', $coupon->end_at)->endOfDay();
            $now = Carbon::now();

            if (!$now->between($start, $end)) {
                $coupon = false;
            }
        } else {
            $coupon = false;
        }

        $products = [];
        $sum = 0;
        $sale = 0;
        foreach ($data->product_list as $item) {
            $product = Product::find($item->pid);
            $product->qty = $item->qty;
            $product->sum = $product->qty * $product->sale_price;
            $sum += $product->sum;
            array_push($products, $product);
        }

        if ($coupon) {
            if ($coupon->sale_in_money == null) {
                $sale = $sum * $coupon->sale_in_percent / 100;
            } else {
                if ($sum * $coupon->sale_in_percent / 100 >= $coupon->sale_in_money) {
                    $sale = $coupon->sale_in_money;
                } else {
                    $sale = $sum * $coupon->sale_in_percent / 100;
                }
            }
            $sum = $sum - $sale;
            if ($sum <= 0) {
                $sum = 0;
            }
        }

        $address_infos = $user->address_infos;

        return view('checkout', compact('coupon', 'products', 'address_infos', 'sum', 'sale', 'sid'));
    }

    /**
     * submit cart
     *
     * @param Request $request
     * @return void
     */
    public function cartSubmit(Request $request)
    {
        $id = Auth::user()->id;
        $data = json_encode($request->all());

        Redis::set("user_{$id}_cart", $data);

        return 'ok';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $supplier = Supplier::find($request->sid);
        $aid = $request->aid;
        $cid = $request->cid ?? null;
        $total = $request->total;
        $user = User::find(Auth::user()->id);

        // Insert order
        $order = new Order();
        $order->supplier_id = $request->sid;
        $order->user_id = $user->id;
        $order->address_info_id = $aid;
        $order->total_price = $total;
        $order->coupon_id = $cid;
        $order->save();

        // Update coupon
        if ($cid != null) {
            $coupon = Coupon::find($cid);

            if ($coupon->numbers != null) {
                $coupon->numbers = $coupon->numbers - 1;
                $coupon->save();
            }
        }

        foreach ($request->product_list as $item) {
            $product = Product::find($item['pid']);

            // Update product in db
            $product->stock = $product->stock - $item['qty'];
            $product->purchased_number = $product->purchased_number + $item['qty'];
            $product->save();

            // check if product is out of stock
            if ($product->stock == 0) {
                DB::table('cart')
                    ->where('product_id', '=', $product->id)
                    ->delete();
            }

            // insert into order detail
            DB::table('order_detail')->insert([
                'order_id' => $order->id,
                'product_id' => $item['pid'],
                'quantity' => $item['qty'],
                'price' => $product->sale_price
            ]);
        }

        // Noti for shop
        $noti = new Notification();
        $noti->user_id = $supplier->user_id;
        $noti->content = 'Bạn có đơn hàng mới từ ' . $user->username;
        $noti->url = '/supplier/orders';
        $noti->save();

        return 'ok';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('order-detail');
    }

    public function accept($id)
    {
        $order = Order::find($id);

        $order->status = 'done';
        $order->save();

        $sup_name = Supplier::find($order->supplier_id)->shop_name;

        $noti = new Notification();
        $noti->user_id = $order->user_id;
        $noti->content = "Đơn hàng {$order->id} của bạn đã được người bán {$sup_name} xác nhận";
        $noti->url = '/user/orders';
        $noti->save();

        return redirect(route('supplier.manage-orders'));
    }

    public function cancel($id)
    {
        $order = Order::find($id);

        $order->status = 'cancel';
        $order->save();

        $sup_name = Supplier::find($order->supplier_id)->shop_name;

        $noti = new Notification();
        $noti->user_id = $order->user_id;
        $noti->content = "Đơn hàng {$order->id} của bạn đã bị người bán {$sup_name} hủy";
        $noti->url = '/user/orders';
        $noti->save();

        return redirect(route('supplier.manage-orders'));
    }

    private function getOrdersDetail($orders)
    {
        foreach ($orders as $order) {
            $order->supplier_name = Supplier::find($order->supplier_id)->shop_name;

            $order->username = User::find($order->user_id)->username;

            $order->time = $order->created_at->format('H:i d/m/Y');

            switch ($order->status) {
                case 'done':
                    $order->status = 'Đã hoàn thành!';
                    $order->status_class = 'order-status--agree';
                    break;
                case 'cancel':
                    $order->status = 'Đã hủy!';
                    $order->status_class = 'order-status--cancel';
                    break;
                default:
                    $order->status = 'Chờ xác nhận';
                    $order->status_class = '';
                    break;
            }

            $details = DB::table('order_detail')
                ->where('order_id', $order->id)
                ->get(['product_id', 'quantity']);

            $products = array();
            foreach ($details as $detail) {
                $pname = Product::find($detail->product_id)->name;
                $item = [
                    'id' => $detail->product_id,
                    'name' => $pname,
                    'qty' => $detail->quantity
                ];
                // dump($products, $item);
                $products[] = $item;
            }

            $order->products = $products;
        }

        return $orders;
    }

    public function userOrderList()
    {
        $orders = Order::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();

        $orders = $this->getOrdersDetail($orders);

        return view('user.orders', compact('orders'));
    }

    public function userOrderSearch(Request $request)
    {
        $id = ($request['search'] === null) ? '' : $request['search'];
        if ($request->status === "all") {
            $orders = Order::where([
                ['id', 'LIKE', "%{$id}%"],
                ['user_id', Auth::user()->id]
            ])
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $orders = Order::where([
                ['id', 'LIKE', "%{$id}%"],
                ['user_id', Auth::user()->id],
                ['status', $request->status]
            ])
                ->orderBy('id', 'desc')
                ->get();
        }

        $orders = $this->getOrdersDetail($orders);

        return $orders;
    }

    public function supplierOrderList()
    {
        $supId = Auth::user()->getSupId();

        $orders = Order::where('supplier_id', $supId)
            ->orderBy('id', 'desc')
            ->get();

        $orders = $this->getOrdersDetail($orders);

        return view('supplier.orders', compact('orders'));
    }

    public function supplierOrderSearch(Request $request)
    {
        $id = ($request['search'] === null) ? '' : $request['search'];
        if ($request->status === "all") {
            $orders = Order::where([
                ['id', 'LIKE', "%{$id}%"],
                ['supplier_id', Auth::user()->getSupId()]
            ])
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $orders = Order::where([
                ['id', 'LIKE', "%{$id}%"],
                ['supplier_id', Auth::user()->getSupId()],
                ['status', $request->status]
            ])
                ->orderBy('id', 'desc')
                ->get();
        }

        $orders = $this->getOrdersDetail($orders);

        return $orders;
    }

    public function adminOrderList()
    {
        $orders = Order::orderBy('id', 'desc')->get();

        $orders = $this->getOrdersDetail($orders);

        return view('admin.orders', compact('orders'));
    }

    public function adminOrderSearch(Request $request)
    {
        $id = ($request['search'] === null) ? '' : $request['search'];
        if ($request->status === "all") {
            $orders = Order::where('id', 'LIKE', "%{$id}%")
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $orders = Order::where([
                ['id', 'LIKE', "%{$id}%"],
                ['status', $request->status]
            ])
                ->orderBy('id', 'desc')
                ->get();
        }

        $orders = $this->getOrdersDetail($orders);

        return $orders;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
