<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){

        $orders = auth()->user()->orders()->orderBy('created_at','DESC')->paginate(10);
        return view('user.orders.index',compact('orders'));
    }

    public function details($order_id){
        $order = auth()->user()->orders()->where('id',$order_id)->first();
        if($order){
            $items = $order->items()->orderBy('id')->paginate(12);
            $transaction = $order->transaction;
            return view('user.orders.details',compact('order','items','transaction'));

        }else{
            return redirect()->route('login');
        }


    }
}
