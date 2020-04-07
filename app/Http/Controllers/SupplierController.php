<?php

namespace App\Http\Controllers;

use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class SupplierController extends Controller
{
    /**
     * check if user has shop
     *
     * @return void
     */
    private function checkInitShop()
    {
        if (Auth::user()->is('supplier')) {
            return true;
        }

        return false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Check if supplier is created or not
        if ($this->checkInitShop()) {
            return redirect(route('supplier.home'));
        }

        // if not, show form
        return view('supplier.create');

    }

    /**
     * Show home page of shop
     *
     * @return void
     */
    public function home()
    {
        return 'home';
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $origin_img = $request->file('shopBanner');
        $img = Image::make($origin_img);
        $img->fit(1200, 300);
        $time = Carbon::now()->format('Ymd_His');
        $img->save(public_path("images/suppliers/{$time}_{$origin_img->getClientOriginalName()}"));
        dd(1);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
