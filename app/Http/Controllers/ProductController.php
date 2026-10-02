<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->where('status', 'available');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Khoảng giá
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Chiều dài / chiều rộng / kích thước (chiều cao)
        if ($request->filled('length_min')) {
            $query->where('length_cm', '>=', $request->length_min);
        }
        if ($request->filled('length_max')) {
            $query->where('length_cm', '<=', $request->length_max);
        }
        if ($request->filled('width_min')) {
            $query->where('width_cm', '>=', $request->width_min);
        }
        if ($request->filled('width_max')) {
            $query->where('width_cm', '<=', $request->width_max);
        }
        if ($request->filled('height_min')) {
            $query->where('height_cm', '>=', $request->height_min);
        }
        if ($request->filled('height_max')) {
            $query->where('height_cm', '<=', $request->height_max);
        }

        // Nơi bán
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Đơn vị vận chuyển
        if ($request->filled('shipping_unit')) {
            $query->where('shipping_unit', $request->shipping_unit);
        }

        // Tình trạng
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        // Thương hiệu
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        $products = $query->latest()->paginate(12)->withQueryString();

        $categories = Category::all();
        $brands = Product::whereNotNull('brand')->distinct()->orderBy('brand')->pluck('brand');
        $locations = Product::whereNotNull('location')->distinct()->orderBy('location')->pluck('location');
        $shippingUnits = Product::whereNotNull('shipping_unit')->distinct()->orderBy('shipping_unit')->pluck('shipping_unit');
        $conditions = Product::conditionLabels();

        return view('products.index', compact('products', 'categories', 'brands', 'locations', 'shippingUnits', 'conditions'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
