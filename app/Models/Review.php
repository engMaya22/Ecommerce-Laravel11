<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $guarded = [];
    // April 06, 2023
    protected function PublishedAt(): Attribute
    {
        return new Attribute(
            get: fn () => $this->created_at->toFormattedDateString(),
        );
    }

}
