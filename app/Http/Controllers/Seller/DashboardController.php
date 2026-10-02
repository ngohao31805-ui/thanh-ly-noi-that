<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PurchaseRequest;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $myRequests = PurchaseRequest::where('seller_id', Auth::id())->latest()->take(5)->get();
        $myOrders = Order::where('user_id', Auth::id())->latest()->take(5)->get();

        return view('seller.dashboard', compact('myRequests', 'myOrders'));
    }
}
