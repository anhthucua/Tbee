<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Route::get('/category', function () {
    return view('category');
});

Route::get('/product-detail', function () {
    return view('product-detail');
});

Route::get('cart', 'ProductController@cart')->name('cart');
Route::post('add-to-cart', 'ProductController@addToCart');
Route::patch('cart/update', 'ProductController@updateCart');
Route::delete('cart/product/{id}/delete', 'ProductController@deleteFromCart')->name('delete-cart');

// Coupon
Route::post('coupon/check', 'CouponController@check');

Route::get('checkout', function () {
    return view('checkout');
});

// User
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'auth'], function () {
    Route::get('/orders', 'OrderController@userOrderList')->name('orders');
    Route::get('/information', 'UserController@edit')->name('edit');
    Route::post('/edit', 'UserController@update')->name('update');
    Route::get('/change-pass', 'UserController@changePass')->name('change-pass');
    Route::post('/change-pass', 'UserController@changePassSubmit')->name('change-pass-submit');
});

Route::group(['prefix' => 'supplier', 'as' => 'supplier.', 'middleware' => 'auth'], function () {
    Route::get('/', 'SupplierController@create')->name('new');
    Route::post('/create', 'SupplierController@store')->name('create');
    Route::get('/products', 'ProductController@supplierProductList')->name('manage-products');
    Route::get('/add-product', 'ProductController@create')->name('add-product');
    Route::get('/orders', 'OrderController@supplierOrderList')->name('manage-orders');
    Route::get('/edit-shop', 'SupplierController@edit')->name('edit');
    Route::put('/update', 'SupplierController@update')->name('update');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    Route::get('/add-coupon', 'CouponController@create')->name('add-coupon');
    Route::post('/add-coupon', 'CouponController@store')->name('save-coupon');
    Route::post('/coupon/search', 'CouponController@search');
    Route::put('/edit-coupon/{id}', 'CouponController@update');
    Route::delete('/coupon/{id}/delete', 'CouponController@destroy');
    Route::get('/coupons', 'CouponController@index')->name('manage-coupons');
    Route::get('/orders', 'OrderController@adminOrderList')->name('manage-orders');
    Route::get('/users', 'UserController@index')->name('manage-users');
    Route::post('/user/{id}/block', 'UserController@block')->name('user.block');
    Route::post('/user/{id}/unblock', 'UserController@unblock')->name('user.unblock');
    Route::post('/user/search', 'UserController@search');
});

// Product routes for supplier
Route::group(['prefix' => 'product', 'as' => 'product.', 'middleware' => 'supplier'], function () {
    Route::post('/create', 'ProductController@store')->name('create');
    Route::get('/{id}/edit', 'ProductController@edit')->name('edit');
    Route::delete('{id}/delete', 'ProductController@softDelete')->name('delete');
});

// Product routes for everyone
Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
    Route::post('/supplier-search', 'ProductController@supplierProductSearch');
    Route::get('/{id}/show', 'ProductController@show')->name('show');
});

// Products by category
Route::get('category/{id}', 'ProductController@productsByCategory')->name('products-category');
Route::post('category/{id}/search', 'ProductController@productsByCategorySearch');
Route::get('category_lv2/{id}', 'ProductController@categoryLevel2')->name('products-category2');

// Products by shop
Route::get('shop/{id}', 'ProductController@productsByShop')->name('products-shop');
Route::post('shop/{id}/search', 'ProductController@productsByShopSearch');

// Authentication routes
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('register', 'Auth\RegisterController@register')->name('register');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');