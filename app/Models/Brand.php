<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Brand extends Model
{
    public function getImage(): Attribute //cover image
    {
        return Attribute::make(get: fn () => $this->image && Storage::disk('public')->exists($this->image) ? asset('storage/' . $this->image) : asset('storage/imgs/placeholder.jpg'));
    }

}
