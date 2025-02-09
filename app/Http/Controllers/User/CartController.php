<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index(){
        $items = Cart::instance('cart')->content();
        return view('user.shop.cart',compact('items'));
    }
    public function addToCart(Request $request){
        Cart::instance('cart')->add($request->id , $request->name , $request->quantity , $request->price)->associate(Product::class);
        return redirect()->back();

    }

    public function increaseCartQuantity($rowId){
        $item = Cart::instance('cart')->get($rowId);
        $qty = $item->qty + 1 ;
        Cart::instance('cart')->update($rowId,$qty);
        return redirect()->back();
    }
    public function decreaseCartQuantity($rowId){
        $item = Cart::instance('cart')->get($rowId);
        $qty = $item->qty - 1 ;
        Cart::instance('cart')->update($rowId,$qty);
        return redirect()->back();
    }
    public function removeItem($rowId){
        Cart::instance('cart')->remove($rowId);
        return redirect()->back();

    }
    public function emptyCart(){
        Cart::instance('cart')->destroy();
        return redirect()->back();

    }


    public function checkout(){

        $address = auth()->user()->getDefaultAddress();
        return view('user.shop.checkout',compact('address'));
    }
    public function orderConfirm(){
        return view('user.shop.order-confirm',compact(''));
    }


}
