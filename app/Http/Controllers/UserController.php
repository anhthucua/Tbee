<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all('id', 'username', 'email', 'is_banned', 'created_at');

        foreach ($users as $user) {
            if (User::find($user->id)->is('supplier')) {
                $user->isShop = true;
            }

            $user->created_date = $user->created_at->format('d-m-Y');
        }

        return view('admin.users', compact('users'));
    }

    /**
     * Search user
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

        $name = ($request['search'] === null) ? '' : $request['search'];

        if ($request['filter'] === 'all') {
            $users = User::where('username', 'LIKE', "%{$name}%")
                ->select('id', 'username', 'email', 'is_banned', 'created_at')
                ->orderBy($column, $direction)
                ->get();
        } else {
            $users = User::query()
                ->where([
                    ['username', 'LIKE', "%{$name}%"],
                    ['is_banned', $request['filter']]
                ])
                ->select('id', 'username', 'email', 'is_banned', 'created_at')
                ->orderBy($column, $direction)
                ->get();
        }

        foreach ($users as $user) {
            if (User::find($user->id)->is('supplier')) {
                $user->isShop = true;
            }

            $user->created_date = $user->created_at->format('d-m-Y');
        }

        return $users;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('user.edit');
    }

    public function changePass()
    {
        return view('user.change-pass');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Block an user
     *
     * @param [type] $id
     * @return void
     */
    public function block($id)
    {
        $user = User::find($id);
        $user->is_banned = true;
        $user->save();

        DB::table('cart')
            ->where('user_id', $id)
            ->delete();

        $products = Product::query()
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->join('users', 'suppliers.user_id', '=', 'users.id')
            ->where('users.id', $id)
            ->select('products.id')
            ->get();

        foreach ($products as $item) {
            // Delete from cart
            DB::table('cart')
                ->where('product_id', $item->id)
                ->delete();

            $product = Product::find($item->id);
            $product->is_banned = true;
            $product->save();
        }

        return redirect(route('admin.manage-users'));
    }

    /**
     * Unblock an user
     *
     * @param [type] $id
     * @return void
     */
    public function unblock($id)
    {
        $user = User::find($id);
        $user->is_banned = false;
        $user->save();

        $products = Product::query()
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->join('users', 'suppliers.user_id', '=', 'users.id')
            ->where('users.id', $id)
            ->select('products.id')
            ->get();

        foreach ($products as $item) {
            $product = Product::find($item->id);
            $product->is_banned = false;
            $product->save();
        }

        return redirect(route('admin.manage-users'));
    }
}
