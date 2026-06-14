<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacturer;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'manufacturer'])
            ->whereNull('deleted_at')
            ->latest()
            ->paginate(10);
        $categories = Category::all();
        $manufacturers = Manufacturer::all();
        return view('admin.products', compact('products', 'categories', 'manufacturers'));
    }
}
