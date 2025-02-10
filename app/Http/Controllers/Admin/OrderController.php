<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::OrderBy('created_at','DESC')->paginate(12);
        return view('admin.orders.index',compact('orders'));
    }
    public function orderDetails($id){
        $order = Order::find($id);
        $items = $order->items()->orderBy('id')->paginate(12);
        $transaction = $order->transaction;
        return view('admin.orders.details',compact('order','items','transaction'));

    }
}
