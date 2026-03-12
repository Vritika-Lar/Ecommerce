<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items'])
            ->latest()
            ->paginate(15);
        //    dump($orders);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product', 'address']);

        return view('admin.orders.show', compact('order'));
    }
    public function updateStatus(Request $request, Order $order)
    {
        $order->update([
            'order_status' => $request->order_status,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->route('admin.orders.show', compact('order'))->with('success', 'Order status updated.');
    }
    public function orderSuccess(Order $order)
    {
        $order->load(['user', 'items.product', 'address']);


        return view('orders.success', compact('order'));
    }
    public function Userindex()
    {
        $orders = Order::with(['user', 'items'])
            ->latest()
            ->paginate(15);
        //    dump($orders);
        return view('user.orders.index', compact('orders'));
    }
}
