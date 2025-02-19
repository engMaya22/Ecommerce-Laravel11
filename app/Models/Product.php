<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts= [
          'images'=> 'array'
    ];
    protected $appends = ['reviews_count'];

    public function getReviewsCountAttribute(): int
    {
        return $this->reviews()->count();
    }


    public function getThumbnailImage(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->main_image//for admin
                ?  Storage::url("uploads/products/thumbnails/".$this->main_image)
                : asset('storage/imgs/placeholder.jpg')
        );
    }
    public function getOrginalIImage(): Attribute //for shop page
    {
        return Attribute::make(
            get: fn() => $this->main_image
                ?  Storage::url("uploads/products/orginal/".$this->main_image)
                : asset('storage/imgs/placeholder.jpg')
        );
    }

    public function scopeFeatured($query)//
    {
        $query->whereFeatured(true);
    }


    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
