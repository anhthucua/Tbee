<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('includes.header', function ($view) {
            if (Auth::check()) {
                $cart_count = DB::table('cart')
                ->where('user_id', Auth::user()->id)
                ->sum('quantity');
                $view->with('cart_count', $cart_count);
            }
        });
    }
}
