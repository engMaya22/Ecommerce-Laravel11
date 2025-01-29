<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function categories(){
        $categories = Category::orderBy('id','DESC')->paginate(6);
        return view('admin.categories.index',compact('categories'));

    }

    public function categoryAdd(){
        return view('admin.categories.add');
    }
    public function categoryStore(AddCategoryRequest $request)
    {
        $validated = $request->validated();
        $name = $validated['name'];
        $brand = new Category();
        $brand->name = $name;
        $brand->slug = Str::slug($name);

        $image = $request->file('image');
        $fileName = Carbon::now()->timestamp . '.' . $image->extension();
        $thumbnailPath = Helper::generateThumbnailImage($image, $fileName ,"categories");
        $brand->image = $thumbnailPath;


        $brand->save();

        return redirect()->route('admin.categories')->with('status', 'Category has been added successfully!');
    }
}
