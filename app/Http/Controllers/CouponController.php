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
        return view('admin.coupons');
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
