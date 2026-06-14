<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'otp',
        'type',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    // ============ SCOPES ============

    // Chỉ lấy OTP còn hạn
    public function scopeValid($query)
    {
        return $query->where('expires_at', '>', now());
    }

    // ============ HELPERS ============

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }
}
