<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\PurchaseRequest;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'pending' => PurchaseRequest::where('status', 'pending')->count(),
            'valuated' => PurchaseRequest::where('status', 'valuated')->count(),
            'my_approved' => PurchaseRequest::where('buyer_id', Auth::id())->where('status', 'approved')->count(),
            'my_completed' => PurchaseRequest::where('buyer_id', Auth::id())->where('status', 'completed')->count(),
        ];

        $newRequests = PurchaseRequest::with('seller')->where('status', 'pending')->latest()->take(10)->get();

        return view('buyer.dashboard', compact('stats', 'newRequests'));
    }
}
