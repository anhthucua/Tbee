<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;

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

        $coupon = Coupon::where('code', $data->coupon)->get()[0];

        $start = Carbon::createFromFormat('Y-m-d', $coupon->start_at)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $coupon->end_at)->endOfDay();
        $now = Carbon::now();

        if (!$now->between($start, $end)) {
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

        return view('checkout', compact('coupon', 'products', 'address_infos', 'sum', 'sale'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show supplier orders list
     */
    public function supplierOrderList()
    {
        return view('supplier.orders');
    }

    public function adminOrderList()
    {
        return view('admin.orders');
    }

    public function userOrderList()
    {
        return view('user.orders');
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
