<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $guarded = [];
    protected $casts= [
          'images'=> 'array'
    ];

    public function getThumbnailmage(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->main_image
                ?  Storage::url("uploads/products/thumbnails/".$this->main_image)
                : asset('storage/imgs/placeholder.jpg')
        );
    }
    public function getOrginalImage(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->main_image
                ?  Storage::url("uploads/products/orginal/".$this->main_image)
                : asset('storage/imgs/placeholder.jpg')
        );
    }


    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
}
