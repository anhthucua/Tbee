<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\CategoryLvl1;
use App\CategoryLvl2;
use Image;
use App\Image as ImageModel;
use App\Supplier;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    /**
     * Get products list of supplier
     *
     * @return void
     */
    public function supplierProductList()
    {
        $supplier_id = Auth::user()->getSupId();
        $cat_lv1 = CategoryLvl1::all(['id', 'name']);
        $products = Product::query()
            ->where('supplier_id', $supplier_id)
            ->orderBy('id', 'desc')
            ->get();

        foreach ($products as $product) {
            $product->cat_lv2 = CategoryLvl2::find($product->category_level2_id)->name;
            $product->img = ImageModel::find($product->image_id)->url;
            $product->date = $product->created_at->format('d/m/Y');
        }

        return view('supplier.products', compact('products', 'cat_lv1'));
    }

    /**
     * Products by category lv2
     *
     * @param [type] $id
     * @return void
     */
    public function categoryLevel2($id)
    {
        return $this->productsByCategory($id, $id);
    }

    /**
     * Get products by category
     *
     * @param [type] $id
     * @return void
     */
    public function productsByCategory($id, $cat_lv2_id = null)
    {
        if (!$cat_lv2_id) {
            $cat_lv1 = CategoryLvl1::find($id);
            $cat_lv2 = CategoryLvl2::where('category_level1_id', $id)->get();

            // use in query
            $cat_lv2_id_arr = $cat_lv2->pluck('id');

            foreach ($cat_lv2 as $cat) {
                $cat->products_count = Product::where('category_level2_id', $cat->id)->count();
            }
        } else {
            $cat_lv2 = CategoryLvl2::find($cat_lv2_id);
            $cat_lv1 = CategoryLvl1::find($cat_lv2->category_level1_id);
            $cat_lv2_id_arr = array(intval($cat_lv2_id));
        }

        $products = Product::join('images', 'products.image_id', 'images.id')
            ->whereIn('products.category_level2_id', $cat_lv2_id_arr)
            ->orderBy('sale_price', 'asc')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'products.sale_price',
                'products.purchased_number',
                'images.url as img_url'
            )
            ->get();

        foreach ($products as $product) {
            if ($product->price !== $product->sale_price) {
                $product->sale_percent = intval(round($product->sale_price / $product->price * 100 - 100));
                if ($product->sale_percent === -100) {
                    $product->sale_percent = -99;
                } elseif ($product->sale_percent === 0) {
                    unset($product->sale_percent);
                }
            }
        }

        // best seller products
        $best_seller_products = Product::join('images', 'products.image_id', 'images.id')
            ->whereIn('products.category_level2_id', $cat_lv2_id_arr)
            ->orderBy('purchased_number', 'desc')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'products.sale_price',
                'products.purchased_number',
                'images.url as img_url'
            )
            ->take(3)
            ->get();

        $price_values = Product::whereIn('products.category_level2_id', $cat_lv2_id_arr)
            ->selectRaw('MIN(sale_price) AS min, MAX(sale_price) AS max')
            ->get();

        return view('category', compact('cat_lv1', 'cat_lv2', 'products', 'best_seller_products', 'price_values', 'cat_lv2_id'));
    }

    /**
     * Get products by shop
     *
     * @param [type] $id
     * @return void
     */
    public function productsByShop($id)
    {
        dd('Trang hien thi shop voi id = ' . $id);
    }

    /**
     * Add product to cart
     *
     * @param Request $request
     * @return void
     */
    public function addToCart(Request $request)
    {
        $pid = $request['pid'];
        $uid = Auth::user()->id;
        $product = Product::find($pid);

        $count = DB::table('cart')
            ->select('quantity')
            ->where([
                ['user_id', $uid],
                ['product_id', $pid]
            ])
            ->get();

        if (count($count) === 0) {
            if ($product->stock == 0) {
                return 'Sản phẩm hiện đã hết hàng';
            }
            DB::table('cart')
                ->insert([
                    'user_id' => $uid,
                    'product_id' => $pid,
                    'quantity' => 1,
                ]);
        } else {
            if ($count[0]->quantity === $product->stock) {
                return 'Không thể thêm sản phẩm nữa';
            } else {
                DB::table('cart')
                    ->where([
                        ['user_id', $uid],
                        ['product_id', $pid]
                    ])
                    ->update(['quantity' => intval($count[0]->quantity) + 1]);
            }
        }

        return 'Sản phẩm đã được thêm vào giỏ hàng';
    }

    public function cart()
    {
        $cart = DB::table('cart')
            ->where('user_id', Auth::user()->id)
            ->get();
        dd($cart);
    }

    /**
     * Seach products of supplier
     *
     * @param Request $request
     * @param $id
     * @return void
     */
    public function supplierProductSearch(Request $request)
    {
        // Format order by
        $order_by_arr = explode(' ', $request['sort']);
        $column = $order_by_arr[0];
        $direction = $order_by_arr[1];

        $name = ($request['search'] === null) ? '' : $request['search'];

        if ($request['category'] === "all") {
            $products = Product::query()
                ->where([
                    ['name', 'LIKE', "%{$name}%"],
                    ['supplier_id', Auth::user()->id]
                ])
                ->orderBy($column, $direction)
                ->get();
        } else {
            $products = Product::query()
                ->where([
                    ['name', 'LIKE', "%{$name}%"],
                    ['supplier_id', Auth::user()->id]
                ])
                ->whereHas('categoryLvl2', function (Builder $query) use ($request) {
                    $query->where('category_level1_id', $request['category']);
                })
                ->orderBy($column, $direction)
                ->get();
        }

        // Get information
        foreach ($products as $product) {
            $product->cat_lv2 = CategoryLvl2::find($product->category_level2_id)->name;
            $product->img = ImageModel::find($product->image_id)->url;
            $product->date = $product->created_at->format('d/m/Y');
        }

        return $products;
    }

    /**
     * Search products by category
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function productsByCategorySearch(Request $request, $id)
    {
        // Format order by
        $order_by_arr = explode(' ', $request['sort']);
        $column = $order_by_arr[0];
        $direction = $order_by_arr[1];

        if ($request->cat_lv2 === []) {
            if ($request->level === '2') {
                $products = Product::query()
                ->where([
                    ['sale_price', '>=', $request['minPrice']],
                    ['sale_price', '<=', $request['maxPrice']],
                    ['category_level2_id', $id]
                ])
                ->orderBy($column, $direction)
                ->get();
            } else {
                $products = Product::query()
                ->where([
                    ['sale_price', '>=', $request['minPrice']],
                    ['sale_price', '<=', $request['maxPrice']]
                ])
                ->whereHas('categoryLvl2', function (Builder $query) use ($id) {
                    $query->where('category_level1_id', $id);
                })
                ->orderBy($column, $direction)
                ->get();
            }


        } else {
            $products = Product::query()
                ->where([
                    ['sale_price', '>=', $request['minPrice']],
                    ['sale_price', '<=', $request['maxPrice']]
                ])
                ->whereIn('category_level2_id', $request['cat_lv2'])
                ->orderBy($column, $direction)
                ->get();
        }

        foreach ($products as $product) {
            $product->img = ImageModel::find($product->image_id)->url;
            if ($product->price !== $product->sale_price) {
                $product->sale_percent = intval(round($product->sale_price / $product->price * 100 - 100));
                if ($product->sale_percent === -100) {
                    $product->sale_percent = -99;
                } elseif ($product->sale_percent === 0) {
                    unset($product->sale_percent);
                }
            }
        }

        return $products;
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
        $input['sale_price'] = ($input['sale_price'] === null) ? $input['price'] : $input['sale_price'];

        $product = new Product($input);

        $image = [];

        foreach ($images as $k => $product_img) {
            // Upload image to storage
            $img = Image::make($product_img);
            $img->fit(360, 360);
            $time = Carbon::now()->format('Ymd_His');
            $url = "/images/products/{$time}_{$product_img->getFilename()}_{$product_img->getClientOriginalName()}";
            $public_url = public_path($url);
            $img->save($public_url);

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
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $cat_lv2 = CategoryLvl2::find($product->category_level2_id);
        $cat_lv1 = CategoryLvl1::find($cat_lv2->category_level1_id);

        $product->main_img = ImageModel::find($product->image_id)->url;

        $images = [];

        foreach ($product->images as $image) {
            if ($image->id == $product->image_id) {
                continue;
            }
            $images[] = $image->url;
        }

        $supplier = Supplier::findOrFail($product->supplier_id);

        $user = User::find($supplier->user_id);
        $uid = $user->id;
        $avatar = $user->avatar;

        $shop = [
            'id' => $product->supplier_id,
            'uid' => $uid,
            'name' => $supplier->shop_name,
            'avatar' => $avatar ? ImageModel::find($avatar)->url : '/images/default-avt.png',
        ];

        // best seller products
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
            ->take(4)
            ->get();

        foreach ($best_seller_products as $b_product) {
            if ($b_product->price !== $b_product->sale_price) {
                $b_product->sale_percent = intval(round($b_product->sale_price / $b_product->price * 100 - 100));
                if ($b_product->sale_percent === -100) {
                    $b_product->sale_percent = -99;
                } elseif ($b_product->sale_percent === 0) {
                    unset($b_product->sale_percent);
                }
            }
        }

        return view('product-detail', compact('product', 'cat_lv2', 'cat_lv1', 'images', 'shop', 'best_seller_products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd("Trang sua san pham co id = {$id}");
        return view('supplier.edit-product');
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

    /**
     * Soft Delete product
     *
     * @param [type] $id
     * @return void
     */
    public function softDelete($id)
    {
        Product::find($id)->delete();
    }
}
