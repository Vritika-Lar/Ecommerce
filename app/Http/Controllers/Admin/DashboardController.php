<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'orders' => Order::count(),
            'users' => User::where('role', 'user')->count(),
            'revenue' => (float) Order::where('payment_status', '!=', 'failed')->sum('total_amount'),
        ];

        $recentOrders = Order::with('user')
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
