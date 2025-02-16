<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddSlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use App\Models\Slide;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index(){
        $slides = Slide::orderBy('id','DESC')
                       ->paginate(12);
        return view('admin.slides.index',compact('slides'));
    }

    public function slideAdd(){
        return view('admin.slides.add');
    }

    public function slideStore(AddSlideRequest $request){
        $slide = new Slide();
        $slide->title = $request->title;
        $slide->tagline = $request->tagline;
        $slide->link = $request->link;
        $slide->subtitle = $request->subtitle;
        $slide->status = $request->status;

        $image = $request->file('image');
        $fileName = Carbon::now()->timestamp . '.' . $image->extension();
        Helper::generateThumbnailImage($image, $fileName , "slides/",400 , 690);
        $slide->image = 'uploads/slides/' . $fileName;
        $slide->save();

        return redirect()->route('admin.slides')->with('status', 'Slide has been added successfully!');
    }

    public function slideEdit($id){
        $slide = Slide::find($id);
        return view('admin.slides.edit',compact('slide'));
    }
    public function slideUpdate(UpdateSlideRequest $request){
        $slide = Slide::find($request->id);
        $slide->title = $request->title;
        $slide->tagline = $request->tagline;
        $slide->link = $request->link;
        $slide->subtitle = $request->subtitle;
        $slide->status = $request->status;

        if($request->hasFile('image')){

            Helper::deleteOldImage($slide->image);
            $image = $request->file('image');
            $fileName = Carbon::now()->timestamp . '.' . $image->extension();
            Helper::generateThumbnailImage($image, $fileName , "slides/",400 , 690);
            $slide->image = 'uploads/slides/' . $fileName;

        }

        $slide->save();

        return redirect()->route('admin.slides')->with('status', 'Slide has been updated successfully!');

    }
    public function slideDelete($id){

        $slide = Slide::find($id);
        Helper::deleteOldImage($slide->image);
        $slide->delete();
        return redirect()->route('admin.slides')->with('status', 'Slide has been deleted successfully!');

    }



}
