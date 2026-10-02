<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\PurchaseRequest;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_customers' => User::where('role', 'customer')->count(),
            'total_sellers' => User::where('role', 'seller')->count(),
            'total_buyers' => User::where('role', 'buyer')->count(),
            'pending_requests' => PurchaseRequest::where('status', 'pending')->count(),
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'revenue' => Order::where('status', 'completed')->sum('total_price'),
        ];

        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $recentRequests = PurchaseRequest::with(['seller', 'buyer'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'recentRequests'));
    }
}
