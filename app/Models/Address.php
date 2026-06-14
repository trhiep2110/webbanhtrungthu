<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'street',
        'province_name',
        'province_id',
        'district_name',
        'district_id',
        'ward_name',
        'ward_code',
    ];

    // ============ RELATIONSHIPS ============

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ============ HELPERS ============

    // Trả về địa chỉ đầy đủ dạng string
    public function getFullAddressAttribute(): string
    {
        return "{$this->street}, {$this->ward_name}, {$this->district_name}, {$this->province_name}";
    }
}
