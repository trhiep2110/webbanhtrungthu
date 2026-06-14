<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_en',
        'name_zh',
        'name_ja',
        'code',
        'images',
        'price',
        'cost_price',
        'quantity',
        'manufacturer_id',
        'category_id',
        'description',
        'description_en',
        'description_zh',
        'description_ja',
        'in_stock',
        'ratings',
        'deleted_at',
    ];

    protected $casts = [
        'images'     => 'array', // JSON -> array tự động
        'in_stock'   => 'boolean',
        'ratings'    => 'float',
        'deleted_at' => 'datetime',
    ];

    // ============ RELATIONSHIPS ============

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    // ============ SCOPES ============

    // Chỉ lấy sản phẩm chưa bị xóa mềm
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    // Lọc theo danh mục
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // Lọc theo thương hiệu
    public function scopeByManufacturer($query, $manufacturerId)
    {
        return $query->where('manufacturer_id', $manufacturerId);
    }

    // Lọc theo khoảng giá
    public function scopeByPriceRange($query, $min, $max)
    {
        return $query->when($min, fn($q) => $q->where('price', '>=', $min))
            ->when($max, fn($q) => $q->where('price', '<=', $max));
    }

    // Tìm kiếm theo tên
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('name_en', 'LIKE', "%{$keyword}%")
                ->orWhere('code', 'LIKE', "%{$keyword}%");
        });
    }

    // Lọc theo rating tối thiểu
    public function scopeMinRating($query, $rating)
    {
        return $query->where('ratings', '>=', $rating);
    }

    // ============ HELPERS ============

    // Tính lại rating trung bình từ bảng comments
    public function recalculateRatings(): void
    {
        $avg = $this->comments()->avg('rating');
        $this->update(['ratings' => round($avg ?? 1, 1)]);
    }
}
