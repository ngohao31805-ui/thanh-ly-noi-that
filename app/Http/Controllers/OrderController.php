<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);
        $order->load('items.product');

        return view('orders.show', compact('order'));
    }

    public function checkout(Request $request)
    {
        $cart = session('cart', []);
        abort_if(empty($cart), 400, 'Giỏ hàng trống.');

        $data = $request->validate([
            'shipping_address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        $products = Product::whereIn('id', array_keys($cart))->get();

        $order = DB::transaction(function () use ($cart, $products, $data) {
            $total = 0;
            foreach ($products as $product) {
                $total += $product->price * $cart[$product->id];
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
                'shipping_address' => $data['shipping_address'],
                'phone' => $data['phone'],
                'status' => 'pending',
            ]);

            foreach ($products as $product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $cart[$product->id],
                    'price' => $product->price,
                ]);
                $product->decrement('quantity', $cart[$product->id]);
                if ($product->quantity <= 0) {
                    $product->update(['status' => 'sold']);
                }
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()->route('orders.show', $order)->with('success', 'Đặt hàng thành công!');
    }
}
