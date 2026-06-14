<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('client.login');
    }

    public function registerForm()
    {
        return view('client.register');
    }

    public function forgotForm()
    {
        return view('client.forgot-password');
    }
}
