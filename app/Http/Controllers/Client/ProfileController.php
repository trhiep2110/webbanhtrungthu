<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return view('client.profile');
    }

    public function orders()
    {
        return view('client.orders');
    }

    public function favorites()
    {
        return view('client.favorites');
    }
}
