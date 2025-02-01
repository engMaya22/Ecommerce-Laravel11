<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $guarded = [];
    public function getImage(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image&& Storage::disk('public')->exists("uploads/categories/thumbnails/".$this->image)
                ? Storage::url("uploads/categories/thumbnails/".$this->image)
                : asset('storage/imgs/placeholder.jpg')
        );
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}
