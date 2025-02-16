<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slide extends Model
{
    protected $guarded = [];

    public function getImage(): Attribute //save all path by name where I have only one size for slide
    {
        return Attribute::make(get: fn ()=> $this->image && Storage::disk('public')->exists($this->image)
                           ? asset('storage/' . $this->image)
                           : asset('img/placeholder.jpg'));
    }
    public function scopeActive($query)//
    {
        $query->whereStatus(true);
    }
}
