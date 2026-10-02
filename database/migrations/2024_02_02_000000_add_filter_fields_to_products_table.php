<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('length_cm', 8, 2)->nullable()->after('quantity');   // chiều dài
            $table->decimal('width_cm', 8, 2)->nullable()->after('length_cm');   // chiều rộng
            $table->decimal('height_cm', 8, 2)->nullable()->after('width_cm');   // chiều cao (kích thước)
            // tình trạng: mới / like_new / đã sử dụng / cũ
            $table->enum('condition', ['new', 'like_new', 'used', 'old'])->default('used')->after('height_cm');
            $table->string('brand')->nullable()->after('condition');            // thương hiệu
            $table->string('location')->nullable()->after('brand');             // nơi bán
            $table->string('shipping_unit')->nullable()->after('location');     // đơn vị vận chuyển
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['length_cm', 'width_cm', 'height_cm', 'condition', 'brand', 'location', 'shipping_unit']);
        });
    }
};
