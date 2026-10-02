<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\PurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = PurchaseRequest::with(['seller', 'category']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $requests = $query->latest()->paginate(15)->withQueryString();

        return view('buyer.requests.index', compact('requests'));
    }

    public function show(PurchaseRequest $purchaseRequest)
    {
        return view('buyer.requests.show', compact('purchaseRequest'));
    }

    // Định giá cho yêu cầu bán/thanh lý
    public function valuate(Request $request, PurchaseRequest $purchaseRequest)
    {
        $data = $request->validate([
            'offered_price' => ['required', 'numeric', 'min:0'],
            'buyer_note' => ['nullable', 'string'],
        ]);

        $data['buyer_id'] = Auth::id();
        $data['status'] = 'valuated';

        $purchaseRequest->update($data);

        return back()->with('success', 'Đã định giá yêu cầu. Chờ chốt thu mua.');
    }

    // Chốt thu mua: chuyển thành sản phẩm trong kho để bán lại
    public function approve(PurchaseRequest $purchaseRequest)
    {
        if ($purchaseRequest->status !== 'valuated') {
            return back()->withErrors('Yêu cầu cần được định giá trước khi chốt thu mua.');
        }

        $purchaseRequest->update([
            'status' => 'approved',
            'buyer_id' => $purchaseRequest->buyer_id ?? Auth::id(),
        ]);

        Product::create([
            'category_id' => $purchaseRequest->category_id,
            'purchase_request_id' => $purchaseRequest->id,
            'name' => $purchaseRequest->title,
            'description' => $purchaseRequest->description,
            'image' => $purchaseRequest->image,
            'price' => round($purchaseRequest->offered_price * 1.3, 2), // giá bán lại đề xuất (+30%)
            'quantity' => 1,
            'status' => 'available',
        ]);

        $purchaseRequest->update(['status' => 'completed']);

        return back()->with('success', 'Đã chốt thu mua và đưa sản phẩm vào kho bán lại.');
    }

    public function reject(Request $request, PurchaseRequest $purchaseRequest)
    {
        $data = $request->validate([
            'buyer_note' => ['nullable', 'string'],
        ]);

        $data['status'] = 'rejected';
        $data['buyer_id'] = Auth::id();

        $purchaseRequest->update($data);

        return back()->with('success', 'Đã từ chối yêu cầu.');
    }
}
