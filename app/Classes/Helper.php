<?php

namespace App\Classes;
use Intervention\Image\Laravel\Facades\Image;


class Helper{

    public static function generateBrandThumbnailImage($image , $imageName){

        $destination = storage_path('app/public/uploads/brands/thumbnails');
        $img = Image::read($image->path());
        $img->cover(124,124,'top');
        $img->resize(124,124,function($constrain){
            $constrain->aspectRatio();

        })->save( $destination.'/'.$imageName);

    }





}

