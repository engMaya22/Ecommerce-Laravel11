<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('created_at','DESC')->paginate(10);
        return view('admin.products.index',compact('products'));
    }
    public function productAdd(){
        $categories = Category::select('id','name')->orderBy('name')->get();
        $brands = Brand::select('id','name')->orderBy('name')->get();
        return view('admin.products.add',compact('categories','brands'));
    }
    public function productStore(AddProductRequest $request){
        $image = $request->file('main_image');
        $fileName = Carbon::now()->timestamp . '.' . $image->extension();
        Helper::generateThumbnailImage($image, $fileName ,"products/thumbnails/",104 , 104);
        Helper::generateThumbnailImage($image, $fileName ,"products/orginal/",540 , 689);

        // Handle multiple images
        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $imageFileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $img->extension();
                Helper::generateThumbnailImage($img, $imageFileName ,"products/thumbnails/",104 , 104);
                Helper::generateThumbnailImage($img, $imageFileName ,"products/orginal/",540 , 689);
                $imageNames[] = $imageFileName;
            }
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'main_image' => $fileName,
            'images' => $imageNames, // Save array of image names
            'short_description' => $request->short_description,
            'description' => $request->description,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'sku' => $request->sku,
            'stock_status' => $request->stock_status,
            'featured' => $request->featured,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
        ]);

        return redirect()->route('admin.products')->with('status', 'Product has been created successfully.');
    }

}
