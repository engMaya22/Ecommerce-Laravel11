<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(){
        $coupons = Coupon::orderBy('expire_at','DESC')->paginate(12);
        return view('admin.coupons.index',compact('coupons'));
    }

    public function couponAdd(){
        return view('admin.coupons.add');
    }

    public function couponStore(AddCouponRequest $request){
        Coupon::create($request->validated());
        return redirect()->route('admin.coupons')->with('status','Coupon has been created successfully.');
    }
}
