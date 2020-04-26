<?php

namespace App\Http\Controllers;

use App\CategoryLvl1;
use App\Product;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cat_lv1 = CategoryLvl1::all();

        $best_seller_products = Product::join('images', 'products.image_id', 'images.id')
            ->orderBy('purchased_number', 'desc')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'products.sale_price',
                'products.purchased_number',
                'images.url as img_url'
            )
            ->take(6)
            ->get();

        $new_products = Product::join('images', 'products.image_id', 'images.id')
            ->orderBy('products.created_at', 'desc')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'products.sale_price',
                'products.purchased_number',
                'images.url as img_url'
            )
            ->take(6)
            ->get();

        foreach ($best_seller_products as $product) {
            if ($product->price !== $product->sale_price) {
                $product->sale_percent = intval(round($product->sale_price / $product->price * 100 - 100));
                if ($product->sale_percent === -100) {
                    $product->sale_percent = -99;
                } elseif ($product->sale_percent === 0) {
                    unset($product->sale_percent);
                }
            }
        }

        foreach ($new_products as $product) {
            if ($product->price !== $product->sale_price) {
                $product->sale_percent = intval(round($product->sale_price / $product->price * 100 - 100));
                if ($product->sale_percent === -100) {
                    $product->sale_percent = -99;
                } elseif ($product->sale_percent === 0) {
                    unset($product->sale_percent);
                }
            }
        }

        return view('welcome', compact('cat_lv1', 'new_products', 'best_seller_products'));
    }
}
