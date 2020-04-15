<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\CategoryLvl1;
use App\CategoryLvl2;
use Image;
use App\Image as ImageModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat_lv1 = CategoryLvl1::all(['id', 'name']);
        $cat_lv2 = CategoryLvl2::all(['id', 'name', 'category_level1_id']);
        return view('supplier.add-product', compact('cat_lv1', 'cat_lv2'));
    }

    public function supplierProductList()
    {
        return view('supplier.products');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $images = $request->file('images');
        $main_img = $request['main-image'];
        $input = $request->all();
        $input['supplier_id'] = Auth::user()->getSupId();

        $product = new Product($input);

        $image = [];

        foreach ($images as $k => $product_img) {
            // Upload image to storage
            $img = Image::make($product_img);
            $img->fit(360, 360);
            $time = Carbon::now()->format('Ymd_His');
            $url = public_path("images/products/{$time}_{$product_img->getFilename()}_{$product_img->getClientOriginalName()}");
            $img->save($url);

            // insert images to db
            $image[$k] = new ImageModel(['url' => $url]);
            $image[$k]->save();

            // Check if main image
            if ($k == $main_img) {
                $product->image_id = $image[$k]->id;
            }
        }

        $product->save();

        // Insert into pivot table
        foreach ($image as $p_img) {
            $product->images()->attach($p_img->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }
}
