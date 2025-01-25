<?php

namespace App\Http\Controllers;

use App\Classes\Helper;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function brands(){
        $brands = Brand::orderBy('id','DESC')->paginate(10);
        return view('admin.brands.index',compact('brands'));
    }
    public function addBrand(){
        return view('admin.brands.add');
    }
    public function brandStore(BrandRequest $request)
    {
        $validated = $request->validated();
        $name = $validated['name'];
        $brand = new Brand();
        $brand->name = $name;
        $brand->slug = Str::slug($name);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = Carbon::now()->timestamp . '.' . $image->extension();

            $thumbnailPath = Helper::generateBrandThumbnailImage($image, $fileName);

            $brand->image = $thumbnailPath;
        }


        $brand->save();

        return redirect()->route('admin.brands')->with('status', 'Brand has been added successfully!');
    }


}
