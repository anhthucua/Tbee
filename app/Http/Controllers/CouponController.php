<?php

namespace App\Http\Controllers;

use App\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
        foreach ($coupons as $coupon) {
            $start = Carbon::createFromFormat('Y-m-d', $coupon->start_at)->startOfDay();
            $end = Carbon::createFromFormat('Y-m-d', $coupon->end_at)->endOfDay();
            $now = Carbon::now();

            if ($now->between($start, $end)) {
                $coupon->status = 'Còn hiệu lực';
            } elseif ($now->greaterThan($end)) {
                $coupon->status = 'Hết hiệu lực';
            } else {
                $coupon->status = 'Chưa có hiệu lực';
            }

            $coupon->created_date = $coupon->created_at->format('Y-m-d');
        }

        return view('admin.coupons', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add-coupon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $coupon = new Coupon($input);

        $coupon->save();

        return redirect(route('admin.manage-coupons'));
    }

    /**
     * Check if coupon is valid
     *
     * @param Request $request
     * @return void
     */
    public function check(Request $request)
    {
        $coupon = Coupon::where('code', $request->code)->get();

        if (!count($coupon)) {
            return 'error';
        }

        $coupon = $coupon[0];

        $start = Carbon::createFromFormat('Y-m-d', $coupon->start_at)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $coupon->end_at)->endOfDay();
        $now = Carbon::now();

        if ($now->between($start, $end)) {
            $data = [
                'percent' => $coupon->sale_in_percent,
                'max' => $coupon->sale_in_money
            ];
            return $data;
        } else {
            return 'error';
        }
    }

    /**
     * Search coupons
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {
        // Format order by
        $order_by_arr = explode(' ', $request['sort']);
        $column = $order_by_arr[0];
        $direction = $order_by_arr[1];

        $code = ($request['search'] === null) ? '' : $request['search'];

        switch ($request['filter']) {
            case 'chua_hieuluc':
                $coupons = Coupon::query()
                    ->where([
                        ['code', 'LIKE', "%{$code}%"],
                    ])
                    ->whereDate('start_at', '>', date('Y-m-d'))
                    ->orderBy($column, $direction)
                    ->get();
                foreach ($coupons as $coupon) {
                    $coupon->status = 'Chưa có hiệu lực';
                    $coupon->created_date = $coupon->created_at->format('Y-m-d');
                }
                break;
            case 'con_hieuluc':
                $coupons = Coupon::query()
                    ->where([
                        ['code', 'LIKE', "%{$code}%"],
                    ])
                    ->whereDate('start_at', '<=', date('Y-m-d'))
                    ->whereDate('end_at', '>=', date('Y-m-d'))
                    ->orderBy($column, $direction)
                    ->get();
                foreach ($coupons as $coupon) {
                    $coupon->status = 'Còn hiệu lực';
                    $coupon->created_date = $coupon->created_at->format('Y-m-d');
                }
                break;
            case 'het_hieuluc':
                $coupons = Coupon::query()
                    ->where([
                        ['code', 'LIKE', "%{$code}%"],
                    ])
                    ->whereDate('end_at', '<', date('Y-m-d'))
                    ->orderBy($column, $direction)
                    ->get();
                foreach ($coupons as $coupon) {
                    $coupon->status = 'Hết hiệu lực';
                    $coupon->created_date = $coupon->created_at->format('Y-m-d');
                }
                break;
            default:
                $coupons = Coupon::query()
                    ->where([
                        ['code', 'LIKE', "%{$code}%"]
                    ])
                    ->orderBy($column, $direction)
                    ->get();
                foreach ($coupons as $coupon) {
                    $start = Carbon::createFromFormat('Y-m-d', $coupon->start_at)->startOfDay();
                    $end = Carbon::createFromFormat('Y-m-d', $coupon->end_at)->endOfDay();
                    $now = Carbon::now();

                    if ($now->between($start, $end)) {
                        $coupon->status = 'Còn hiệu lực';
                    } elseif ($now->greaterThan($end)) {
                        $coupon->status = 'Hết hiệu lực';
                    } else {
                        $coupon->status = 'Chưa có hiệu lực';
                    }

                    $coupon->created_date = $coupon->created_at->format('Y-m-d');
                }
                break;
        }

        return $coupons;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $coupon = Coupon::find($id);
        $coupon->fill($input);
        $coupon->save();
        return redirect(route('admin.manage-coupons'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect(route('admin.manage-coupons'));
    }
}
