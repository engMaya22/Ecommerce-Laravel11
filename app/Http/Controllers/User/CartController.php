<?php

namespace App\Http\Controllers\User;

use App\Classes\Helper;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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

    public function placeOrder(Request $request){
        $address = auth()->user()->getDefaultAddress();
        if(!$address){
            $validatedDat = $request->validate(
               [
                'name' => 'required|max:100',
                'phone' => 'required|numeric|digits:10',
                'zip' => 'required|numeric|digits:6',
                'state' => 'required',
                'city' => 'required',
                'address' => 'required',
                'locality' => 'required',
                'landmark' => 'required',

            ]);

            $address = auth()->user()->addresses()->create(
                array_merge(
                    $validatedDat,
                    ['is_default' => true],
                    ['country' => '']
                ));
        }
        Helper::setAmountForCheckout();
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->subtotal = Session::get('checkout')['subtotal'];
        $order->discount = Session::get('checkout')['discount'];
        $order->tax = Session::get('checkout')['tax'];
        $order->total = Session::get('checkout')['total'];
        $order->name = $address->name;
        $order->phone = $address->phone;
        $order->zip = $address->zip;
        $order->state = $address->state;
        $order->city = $address->city;
        $order->address = $address->address;
        $order->locality = $address->locality;
        $order->landmark = $address->landmark;
        $order->country = $address->country;
        $order->save();

        //order items
        foreach(Cart::instance('cart')->content() as $item){
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            $orderItem->order_id = $order->id;
            $orderItem->save();

        }
        if($request->mode === 'cod'){
         //transaction
            $transaction = new Transaction();
            $transaction->user_id = auth()->user()->id;
            $transaction->order_id = $order->id;
            $transaction->mode = $request->mode;
            $transaction->status = 'pending';
            $transaction->save();

        }elseif($request->mode === 'paypal')
        {

        }elseif($request->mode === 'card'){

        }


        //flash
        Cart::instance('cart')->destroy();
        Session::forget('checkout');
        Session::forget('coupon');
        Session::forget('discounts');

        Session::put('order_id',$order->id);
        return redirect()->route('order.confirm');


    }
    public function orderConfirm(){
        if(Session::has('order_id')){
            $order = Order::find(Session::get('order_id'));
            return view('user.shop.order-confirm',compact('order'));

        }
        return redirect()->route('cart.index');

    }


}
