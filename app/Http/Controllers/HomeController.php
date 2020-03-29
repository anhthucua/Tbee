<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryLvl1;

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
        return view('welcome', compact('cat_lv1'));
    }
}
