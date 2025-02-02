<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(){
        $products = Product::orderBy('created_at','DESC')->paginate(12);
        return view('user.shop.index',compact('products'));
    }

    public function details($slug){
        $product = Product::whereSlug($slug)->first();
        $relatedProducts = Category::find($product->category_id)->products()->take(8)->get();
        return view('user.shop.view',compact('product','relatedProducts'));

    }
}
