<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'password', 'role', 'is_active',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isBuyer(): bool
    {
        return $this->role === 'buyer';
    }

    public function isSeller(): bool
    {
        return $this->role === 'seller';
    }

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    /**
     * Layout Blade riêng cho từng khu vực (admin / seller / buyer / customer).
     */
    public function panelLayout(): string
    {
        return match ($this->role) {
            'admin' => 'layouts.admin',
            'seller' => 'layouts.seller',
            'buyer' => 'layouts.buyer',
            default => 'layouts.customer',
        };
    }

    public function purchaseRequests()
    {
        return $this->hasMany(PurchaseRequest::class, 'seller_id');
    }

    public function handledRequests()
    {
        return $this->hasMany(PurchaseRequest::class, 'buyer_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
