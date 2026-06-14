<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'manufacturer'])
            ->whereNull('deleted_at');

        // Tìm kiếm
        if ($request->keyword) {
            $query->where('name', 'LIKE', "%{$request->keyword}%");
        }

        // Lọc danh mục
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        // Lọc thương hiệu
        if ($request->manufacturer) {
            $query->where('manufacturer_id', $request->manufacturer);
        }

        // Lọc giá
        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sắp xếp
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderBy('ratings', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12);
        $categories = Category::all();
        $manufacturers = Manufacturer::all();

        return view('client.products', compact('products', 'categories', 'manufacturers'));
    }

    public function show($id)
    {
        $product = Product::with(['category', 'manufacturer', 'comments.user'])
            ->whereNull('deleted_at')
            ->findOrFail($id);

        $relatedProducts = Product::with(['category'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->whereNull('deleted_at')
            ->limit(4)
            ->get();

        return view('client.product-detail', compact('product', 'relatedProducts'));
    }
}
