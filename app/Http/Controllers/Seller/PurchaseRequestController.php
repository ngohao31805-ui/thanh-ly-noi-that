<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseRequestController extends Controller
{
    public function index()
    {
        $requests = PurchaseRequest::where('seller_id', Auth::id())->latest()->paginate(10);

        return view('seller.requests.index', compact('requests'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('seller.requests.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'expected_price' => ['nullable', 'numeric', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('purchase-requests', 'public');
        }

        $data['seller_id'] = Auth::id();
        $data['status'] = 'pending';

        PurchaseRequest::create($data);

        return redirect()->route('seller.requests.index')->with('success', 'Đã gửi yêu cầu bán/thanh lý. Nhân viên thu mua sẽ liên hệ sớm.');
    }

    public function show(PurchaseRequest $purchaseRequest)
    {
        abort_unless($purchaseRequest->seller_id === Auth::id(), 403);

        return view('seller.requests.show', compact('purchaseRequest'));
    }
}
