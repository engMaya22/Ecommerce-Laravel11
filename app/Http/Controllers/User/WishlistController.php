<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{

    public function index(){
        $items = Cart::instance('wishlist')->content();
        return view('user.wishlist',compact('items'));


    }
    public function addToWishlist(Request $request){
        Cart::instance('wishlist')->add($request->id , $request->name , $request->quantity , $request->price)->associate(Product::class);
        return redirect()->back();

    }
    public function removeItem($rowId){
        Cart::instance('wishlist')->remove($rowId);
        return redirect()->back();

    }
    public function emptyWishlist(){
        Cart::instance('wishlist')->destroy();
        return redirect()->back();

    }

}
