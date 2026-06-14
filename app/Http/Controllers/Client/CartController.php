<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        return view('client.cart');
    }

    public function checkout()
    {
        return view('client.checkout');
    }
}
