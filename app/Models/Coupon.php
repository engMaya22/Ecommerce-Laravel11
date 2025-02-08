<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = [];

    public function scopeActive($query)//
    {
        $query->where('expire_at','>=',today());
    }


}
