<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('expected_price', 12, 2)->nullable(); // giá người bán mong muốn
            $table->decimal('offered_price', 12, 2)->nullable();  // giá thu mua đề xuất bởi buyer
            $table->foreignId('buyer_id')->nullable()->constrained('users')->nullOnDelete(); // NV thu mua xử lý
            // pending: chờ xử lý, valuated: đã định giá, approved: đã chốt thu mua,
            // rejected: từ chối, completed: đã hoàn tất giao dịch
            $table->enum('status', ['pending', 'valuated', 'approved', 'rejected', 'completed'])->default('pending');
            $table->text('buyer_note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_requests');
    }
};
