<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'buyer_name',
        'buyer_email',
        'buyer_phone',
        'recipient_name',
        'recipient_phone',
        'province_name',
        'province_id',
        'district_name',
        'district_id',
        'ward_name',
        'ward_code',
        'street',
        'note',
        'status',
        'total_amount',
        'shipping_fee',
        'payment_method',
        'payment_gateway',
        'is_paid',
        'pay_url',
        'momo_trans_id',
        'momo_request_id',
        'is_refunded',
    ];

    protected $casts = [
        'is_paid'     => 'boolean',
        'is_refunded' => 'boolean',
    ];

    // ============ RELATIONSHIPS ============

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartDetails()
    {
        return $this->belongsToMany(CartDetail::class, 'order_cart_details');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    // ============ SCOPES ============

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // ============ HELPERS ============

    public function getFullAddressAttribute(): string
    {
        return "{$this->street}, {$this->ward_name}, {$this->district_name}, {$this->province_name}";
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
    public function isCanceled(): bool
    {
        return $this->status === 'canceled';
    }
    public function isSuccess(): bool
    {
        return $this->status === 'success';
    }
}
