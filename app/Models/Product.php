<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'purchase_request_id', 'name', 'description',
        'image', 'price', 'quantity', 'status',
        'length_cm', 'width_cm', 'height_cm', 'condition', 'brand', 'location', 'shipping_unit',
    ];

    // Nhãn hiển thị cho tình trạng sản phẩm
    public static function conditionLabels(): array
    {
        return [
            'new' => 'Mới',
            'like_new' => 'Như mới',
            'used' => 'Đã sử dụng',
            'old' => 'Cũ',
        ];
    }

    public function conditionLabel(): string
    {
        return self::conditionLabels()[$this->condition] ?? $this->condition;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
