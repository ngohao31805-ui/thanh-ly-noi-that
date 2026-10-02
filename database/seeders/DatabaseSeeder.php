<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Tài khoản mẫu
        User::create([
            'name' => 'Quản trị viên',
            'email' => 'admin@furniture.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Nhân viên thu mua',
            'email' => 'buyer@furniture.test',
            'password' => Hash::make('password'),
            'role' => 'buyer',
        ]);

        User::create([
            'name' => 'Người bán demo',
            'email' => 'seller@furniture.test',
            'password' => Hash::make('password'),
            'role' => 'seller',
        ]);

        User::create([
            'name' => 'Khách hàng demo',
            'email' => 'customer@furniture.test',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // Danh mục mẫu (kèm ảnh minh họa tương ứng đã có sẵn trong storage/app/public/products)
        $categories = [
            'Bàn ghế' => 'products/demo-ban-ghe.svg',
            'Tủ kệ' => 'products/demo-tu-ke.svg',
            'Giường nệm' => 'products/demo-giuong-nem.svg',
            'Sofa' => 'products/demo-sofa.svg',
            'Đồ trang trí' => 'products/demo-do-trang-tri.svg',
        ];
        $brands = ['Hòa Phát', 'Nội Thất Xinh', 'IKEA', 'An Cường', 'Govi'];
        $locations = ['TP.HCM', 'Hà Nội', 'Đà Nẵng', 'Bình Dương', 'Cần Thơ'];
        $shippingUnits = ['Giao hàng nhanh', 'GHTK', 'Ahamove', 'Viettel Post', 'Tự vận chuyển'];
        $conditions = ['new', 'like_new', 'used', 'old'];

        $i = 0;
        foreach ($categories as $name => $image) {
            $category = Category::create([
                'name' => $name,
                'slug' => Str::slug($name) . '-' . uniqid(),
            ]);

            // Vài sản phẩm demo mỗi danh mục, đủ dữ liệu để test bộ lọc
            Product::create([
                'category_id' => $category->id,
                'name' => $name . ' - mẫu demo',
                'description' => 'Sản phẩm nội thất đã qua thu mua, kiểm định chất lượng, sẵn sàng bán lại.',
                'image' => $image,
                'price' => rand(500, 5000) * 1000,
                'quantity' => rand(1, 5),
                'status' => 'available',
                'length_cm' => rand(40, 200),
                'width_cm' => rand(30, 120),
                'height_cm' => rand(30, 180),
                'condition' => $conditions[$i % count($conditions)],
                'brand' => $brands[$i % count($brands)],
                'location' => $locations[$i % count($locations)],
                'shipping_unit' => $shippingUnits[$i % count($shippingUnits)],
            ]);
            $i++;
        }
    }
}
