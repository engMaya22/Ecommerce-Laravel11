<?php

namespace App\Classes;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;


class Helper{

    public static function generateThumbnailImage($image , $imageName , $folderName ,$width , $height){

          // Define the relative path inside storage/app/public/
            $relativePath = "uploads/".$folderName.$imageName;

            // Read and process the image
            $img = Image::read($image->path());
            $img->cover($width, $height, 'top');
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Store the processed image in the public disk
            Storage::disk('public')->put($relativePath, (string) $img->encode());


    }
    public static function deleteOldImage(?string $imagePath): void
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }





}

