<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
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
        $category = new Category();
        $category->name = $name;
        $category->slug = Str::slug($name);

        $image = $request->file('image');
        $fileName = Carbon::now()->timestamp . '.' . $image->extension();
        $thumbnailPath = Helper::generateThumbnailImage($image, $fileName ,"categories");
        $category->image = $thumbnailPath;


        $category->save();

        return redirect()->route('admin.categories')->with('status', 'Category has been added successfully!');
    }

    public function categoryEdit($id){
        $category = Category::find($id);
        return view('admin.categories.edit',compact('category'));
    }
    public function categoryUpdate(UpdateCategoryRequest $request){
        $validated = $request->validated();
        $name = $validated['name'];
        $category = Category::find($request->id);
        $category->name = $name;
        $category->slug = Str::slug($name);

        if ($request->hasFile('image')) {
            Helper::deleteOldImage($category->image);
            $image = $request->file('image');
            $fileName = Carbon::now()->timestamp . '.' . $image->extension();
            $thumbnailPath = Helper::generateThumbnailImage($image, $fileName , "categories");
            $category->image = $thumbnailPath;

        }

        $category->save();
        return redirect()->route('admin.categories')->with('status','Category has been edited successfully!');

    }
    public function categoryDelete($id){
        $category =  Category::find($id);
        Helper::deleteOldImage($category->image);
        $category->delete();
        return redirect()->route('admin.categories')->with('status','Category has been deleted successfully!');

    }
}
