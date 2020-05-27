<?php

namespace App\Providers;

use App\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use App\Supplier;

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

        view()->composer('supplier.sidebar', function ($view) {
            $id = Auth::user()->getSupId();
            if ($id) {
                $shop_name = Supplier::find($id)->shop_name;
                $view->with('shop_name', $shop_name);
            }
        });

        view()->composer(['includes.top-header', 'admin.top-header', 'supplier.top-header', 'user.top-header'], function ($view) {
            if (Auth::check()) {
                $notis = Notification::where('user_id', Auth::user()->id)
                    ->orderBy('id', 'desc')
                    ->take(3)
                    ->get();
                foreach ($notis as $noti) {
                    $noti->hour = $noti->created_at->format('H:i');
                    $noti->date = $noti->created_at->format('d/m/Y');
                }
                $noti_count = Notification::where([
                    ['user_id', Auth::user()->id],
                    ['read', 0]
                ])->count();
                $all_noti_count = Notification::where('user_id', Auth::user()->id)->count();
                $view->with('notis', $notis)
                    ->with('noti_count', $noti_count)
                    ->with('all_noti_count', $all_noti_count);
            }
        });
    }
}
