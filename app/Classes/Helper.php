<?php

namespace App\Classes;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;


class Helper{

    public static function generateBrandThumbnailImage($image , $imageName){

          // Define the relative path inside storage/app/public/
            $relativePath = "uploads/brands/thumbnails/{$imageName}";

            // Read and process the image
            $img = Image::read($image->path());
            $img->cover(124, 124, 'top');
            $img->resize(124, 124, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Store the processed image in the public disk
            Storage::disk('public')->put($relativePath, (string) $img->encode());

            return $relativePath;

    }
    public static function deleteOldImage(?string $imagePath): void
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }





}

