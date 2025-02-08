<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Surfsidemedia\Shoppingcart\Facades\Cart;

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


    public function couponEdit($id){
        $coupon = Coupon::find($id);
        return view('admin.coupons.edit',compact('coupon'));
    }
    public function couponUpdate(UpdateCouponRequest $request){
        $coupon = Coupon::find($request->id);
        $coupon->update($request->validated());
        return redirect()->route('admin.coupons')->with('status','Coupon has been updated successfully.');

    }

    public function couponDelete($id){
        Coupon::find($id)->delete();
        return redirect()->route('admin.coupons')->with('status','Coupon has been deleted successfully!');

    }

    public function applyCouponCode(Request $request){
        // $request->validate([
        //     'coupon_code' => 'required'
        // ]);
        // $couponCode = $request->validated();
        $couponCode = $request->coupon_code;
        if(empty($couponCode))
          return redirect()->back()->with('error','Add coupon code!');

        $coupon = Coupon::where('code',$couponCode)
                        ->active()//not expired yet
                        ->where('cart_value','<=',Cart::instance('cart')->subtotal())
                        ->first();
        if(!$coupon)
          return redirect()->back()->with('error','Invalid coupon code!');

        Session::put('coupon',[//save coupon data based on entered code into session
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cart_value' => $coupon->cart_value,

        ]);
        Helper::calculateDiscount();
        return redirect()->back()->with('success','Coupon has been applied successfully!');


    }
}
