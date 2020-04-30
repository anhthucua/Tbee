<?php

namespace App\Http\Controllers;

use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use App\Image as ImageModel;

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
            return redirect(route('supplier.manage-products'));
        }

        // if not, show form
        return view('supplier.create');
    }

    /**
     * Store a newly created supplier
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Upload image
        $origin_img = $request->file('shopBanner');
        $img = Image::make($origin_img);
        $img->fit(1200, 300);
        $time = Carbon::now()->format('Ymd_His');
        $url = "/images/suppliers/{$time}_{$origin_img->getClientOriginalName()}";
        $public_url = public_path($url);
        $img->save($public_url);

        // Insert image into database
        $image = new ImageModel(['url' => $url]);
        $image->save();

        // Insert supplier into database
        $supplier = new Supplier();
        $supplier->banner = $image->id;
        $supplier->user_id = Auth::user()->id;
        $supplier->shop_name = $request->shop_name;
        $supplier->address = $request->address;
        $supplier->notes = $request->note;
        $supplier->save();

        Auth::user()->roles()->attach('2');

        return redirect(route('supplier.manage-products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $supplier = Supplier::find(Auth::user()->getSupId());
        $image = ImageModel::find($supplier->banner);
        return view('supplier.edit', compact('supplier', 'image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = Auth::user()->getSupId();

        $supplier = Supplier::find($id);

        if ($request->shopBanner) {
            // Upload image
            $origin_img = $request->file('shopBanner');
            $img = Image::make($origin_img);
            $img->fit(1200, 300);
            $time = Carbon::now()->format('Ymd_His');
            $url = "/images/suppliers/{$time}_{$origin_img->getClientOriginalName()}";
            $public_url = public_path($url);
            $img->save($public_url);

            // Insert image into database
            $image = new ImageModel(['url' => $url]);
            $image->save();

            $supplier->banner = $image->id;
        }

        $supplier->shop_name = $request->shop_name;
        $supplier->address = $request->address;
        $supplier->notes = $request->note;

        $supplier->save();

        return redirect(route('supplier.edit'))->with('success', 'Cập nhật shop thành công');
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
