<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request){
        $size = $request->query('size') ? $request->query('size') : 12;//12 is default //get form send parameter by query head
        $brandsFilter = $request->query('brands');
        $o_column = "";
        $o_order = "";
        $order = $request->query('order') ? $request->query('order') : -1;

        switch($order){
            case 1 :
                $o_column = 'created_at';
                $o_order = 'DESC';
                break;
            case 2 :
                $o_column = 'created_at';
                $o_order = 'ASC';
                break;
            case 3 :
                    $o_column = 'sale_price';
                    $o_order = 'ASC';
                    break;
            case 4 :
                    $o_column = 'sale_price';
                    $o_order = 'DESC';
                    break;
            default:
                    $o_column = 'id';
                    $o_order = 'DESC';

        }
        $brands = Brand::orderBy('name','ASC')->get();
        $products = Product::when($brandsFilter , function($q , $brandsFilter){
                             $q->whereIn('brand_id', explode(',', $brandsFilter));
                         })



                             ->orderBy($o_column , $o_order)->paginate($size);
        return view('user.shop.index',compact('products','size','order','brands','brandsFilter'));
    }

    public function details($slug){
        $product = Product::whereSlug($slug)->first();
        $relatedProducts = Category::find($product->category_id)->products()->take(8)->get();
        return view('user.shop.view',compact('product','relatedProducts'));

    }
}
