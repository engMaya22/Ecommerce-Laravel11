<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $size = $request->query('size', 12);  // Default to 12 if 'size' is not present
        $brandsFilter = $request->query('brands');
        $categoriesFilter = $request->query('categories');
        $order = $request->query('order', -1);

        $orderOptions = [
            1 => ['created_at', 'DESC'],
            2 => ['created_at', 'ASC'],
            3 => ['sale_price', 'ASC'],
            4 => ['sale_price', 'DESC'],
        ];

        [$o_column, $o_order] = $orderOptions[$order] ?? ['id', 'DESC'];

        $brands = Brand::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();

        $products = Product::when($brandsFilter, function ($q) use ($brandsFilter) {
                $q->whereIn('brand_id', explode(',', $brandsFilter));
            })
            ->when($categoriesFilter, function ($q) use ($categoriesFilter) {
                $q->whereIn('category_id', explode(',', $categoriesFilter));
            })
            ->orderBy($o_column, $o_order)
            ->paginate($size);

        return view('user.shop.index', compact('products', 'size', 'order', 'brands', 'brandsFilter', 'categories', 'categoriesFilter'));
    }


    public function details($slug){
        $product = Product::whereSlug($slug)->first();
        $relatedProducts = Category::find($product->category_id)->products()->take(8)->get();
        return view('user.shop.view',compact('product','relatedProducts'));

    }
}
