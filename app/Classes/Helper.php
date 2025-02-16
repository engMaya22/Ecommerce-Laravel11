<?php

namespace App\Classes;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class Helper{

    public static function generateThumbnailImage($image , $imageName , $folderName ,$width , $height){

          // Define the relative path inside storage/app/public/
            $relativePath = "uploads/".$folderName.$imageName;

            // Read and process the image
            $img = Image::read($image->path());
            $img->cover($width, $height, 'top');
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Store the processed image in the public disk
            Storage::disk('public')->put($relativePath, (string) $img->encode());

    }
    public static function deleteOldImage(?string $imagePath): void
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }

    public static function calculateDiscount(){
        $discount = 0;
        $couponType = Session::get('coupon')['type'];
        $couponValue = Session::get('coupon')['value'];
        $subTotal = Cart::instance('cart')->subtotal();

        if($couponType == 'fixed'){
            $discount =  $couponValue ;
        }else{//percentage
             $discount =  ($subTotal* $couponValue)/100;
        }

        $subTotalAfterDiscount =  $subTotal  - $discount;
        $taxAfterDiscount = ($subTotalAfterDiscount * config('cart.tax'))/100;
        $totalAfterDiscount = $subTotalAfterDiscount + $taxAfterDiscount;
            Session::put('discounts',[
                'discount' => number_format(floatval($discount),2,'.',''),
                'subtotal' => number_format(floatval($subTotalAfterDiscount),2,'.',''),
                'tax' => number_format(floatval($taxAfterDiscount),2,'.',''),
                'total' => number_format(floatval($totalAfterDiscount),2,'.','')

            ]);
    }
    public static function setAmountForCheckout(){
        if(Cart::instance('cart')->content()->count() == 0 ){
            Session::forget('checkout');
            return;
        }
        if(Session::has('coupon')){
            Session::put('checkout',[
                'discount' => Session::get('discounts')['discount'],
                'subtotal' => Session::get('discounts')['subtotal'],
                'tax' => Session::get('discounts')['tax'],
                'total' => Session::get('discounts')['total'],


            ]);
        }else{
            Session::put('checkout',[
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'tax' => Cart::instance('cart')->tax(),
                'total' => Cart::instance('cart')->total(),


            ]);

        }
    }




}

