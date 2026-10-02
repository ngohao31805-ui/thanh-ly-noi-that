<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Bổ sung giá trị 'customer' vào cột role cho các database đã migrate
     * trước khi vai trò Khách hàng được tách riêng. An toàn để chạy nhiều lần
     * và không làm mất dữ liệu tài khoản hiện có.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('customer', 'seller', 'buyer', 'admin') NOT NULL DEFAULT 'customer'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('seller', 'buyer', 'admin') NOT NULL DEFAULT 'seller'");
    }
};
