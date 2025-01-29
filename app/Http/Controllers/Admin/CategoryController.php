<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   public function categories(){
     $categories = Category::orderBy('id','DESC')->paginate(6);
     return view('admin.categories.index',compact('categories'));

   }
}
