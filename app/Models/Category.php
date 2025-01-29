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
            get: fn() => $this->image && Storage::disk('public')->exists($this->image)
                ? Storage::url($this->image)
                : asset('storage/imgs/placeholder.jpg')
        );
    }
}
