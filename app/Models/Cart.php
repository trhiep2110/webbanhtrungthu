<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total_money',
    ];

    // ============ RELATIONSHIPS ============

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class);
    }

    // ============ HELPERS ============

    // Tính lại tổng tiền giỏ hàng (tương đương recalculateTotalMoney trong Mongoose)
    public function recalculateTotalMoney(): int
    {
        $total = $this->cartDetails()
            ->with('product')
            ->get()
            ->sum(fn($detail) => $detail->quantity * $detail->product->price);

        $this->update(['total_money' => $total]);

        return $total;
    }

    // Scope lấy giỏ hàng đang active
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
