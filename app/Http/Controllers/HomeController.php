<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slides = Slide::active()->get()->take(3);
        $categories = Category::orderBy('name')->get();
        $productOnSale = Product::whereNotNull('sale_price')->inRandomOrder()->get()->take(8);
        $featuredProducts = Product::featured()->get()->take(8);
        return view('index',compact('slides','categories','productOnSale','featuredProducts'));
    }
}
