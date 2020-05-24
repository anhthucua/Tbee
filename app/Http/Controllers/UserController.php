<?php

namespace App\Http\Controllers;

use App\AddressInfo;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Image as ImageModel;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

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
        $user = Auth::user();

        if ($user->avatar) {
            $user->avatar_img = ImageModel::find($user->avatar)->url;
        } else {
            $user->avatar_img = '/images/default-avt.png';
        }

        return view('user.edit', compact('user'));
    }

    public function changePass()
    {
        return view('user.change-pass');
    }

    public function changePassSubmit(Request $request)
    {
        $user = Auth::user();

        if (!Hash::check($request['password'], $user['password'])) {
            return redirect(route('user.change-pass'))->with('err-pass', 'Mật khẩu không chính xác');
        }

        if (strlen($request['new_password']) < 8) {
            return redirect(route('user.change-pass'))->with('err-new-pass', 'Mật khẩu phải có ít nhất 8 kí tự');
        }

        if ($request['new_password'] !== $request['new_pass_cf']) {
            return redirect(route('user.change-pass'))->with('err-pass-cf', 'Xác nhận mật khẩu không trùng khớp');
        }

        $new_pass = Hash::make($request['new_password']);

        $user->password = $new_pass;
        $user->save();

        return redirect(route('user.change-pass'))->with('success', 'Đổi mật khẩu thành công');
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
        $user = Auth::user();

        if ($request->avatar) {
            // Upload image
            $origin_img = $request->file('avatar');
            $img = Image::make($origin_img);
            $img->fit(300, 300);
            $time = Carbon::now()->format('Ymd_His');
            $url = "/images/users/{$time}_{$origin_img->getClientOriginalName()}";
            $public_url = public_path($url);
            $img->save($public_url);

            // Insert image into database
            $image = new ImageModel(['url' => $url]);
            $image->save();
            $user->avatar = $image->id;
        }

        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();

        return redirect(route('user.edit'));
    }

    public function addAddress(Request $request)
    {
        $address = new AddressInfo($request->all());
        if (count(Auth::user()->address_infos) == 0) {
            $address->is_main_address = true;
        }
        $address->user_id = Auth::user()->id;

        $address->save();

        return $address;
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
