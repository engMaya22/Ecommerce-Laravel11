<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request){
        Cart::instance('wishlist')->add($request->id , $request->name , $request->quantity , $request->price)->associate(Product::class);
        return redirect()->back();

    }
}
