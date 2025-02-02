<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Classes\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::orderBy('id','DESC')->paginate(10);
        return view('admin.brands.index',compact('brands'));
    }
    public function addBrand(){
        return view('admin.brands.add');
    }
    public function brandStore(AddBrandRequest $request)
    {
        $validated = $request->validated();
        $name = $validated['name'];
        $brand = new Brand();
        $brand->name = $name;
        $brand->slug = Str::slug($name);

        $image = $request->file('image');
        $fileName = Carbon::now()->timestamp . '.' . $image->extension();
        Helper::generateThumbnailImage($image, $fileName , "brands/thumbnails/",124 , 124);
        $brand->image = $fileName;

        $brand->save();

        return redirect()->route('admin.brands')->with('status', 'Brand has been added successfully!');
    }


    public function brandEdit($id){
        $brand = Brand::find($id);
        return view('admin.brands.edit',compact('brand'));
    }
    public function brandUpdate(UpdateBrandRequest $request){
        $validated = $request->validated();
        $name = $validated['name'];
        $brand = Brand::find($request->id);
        $brand->name = $name;
        $brand->slug = Str::slug($name);

        if ($request->hasFile('image')) {

            $imagePath = "uploads/brands/thumbnails/" . $brand->image;
            Helper::deleteOldImage($imagePath);
            $image = $request->file('image');
            $fileName = Carbon::now()->timestamp . '.' . $image->extension();
            Helper::generateThumbnailImage($image, $fileName , "brands/thumbnails/", 124 , 124);
            $brand->image = $fileName;

        }


        $brand->save();
        return redirect()->route('admin.brands')->with('status','Brand has been edited successfully!');

    }
    public function brandDelete($id){
        $brand =  Brand::find($id);
        $imagePath = "uploads/brands/thumbnails/" . $brand->image;
        Helper::deleteOldImage($imagePath);
        $brand->delete();
        return redirect()->route('admin.brands')->with('status','Brand has been deleted successfully!');

    }
}
