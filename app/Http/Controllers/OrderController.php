<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
class OrderController extends Controller
{
    public function displayOrders(){
        $orders = Order::where('user_id', auth()->id())->with('orderItems.product')->get();
        return view('user.order-panel', compact('orders'));
    }

    public function displayAllOrders() {
        $orders = Order::with('orderItems.product')->get();
        return view('admin.orders', compact('orders'));
    }

}
