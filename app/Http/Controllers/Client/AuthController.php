<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // ===== HIỂN THỊ FORM =====
    public function loginForm()
    {
        if (session('user')) return redirect('/');
        return view('client.login');
    }

    public function registerForm()
    {
        if (session('user')) return redirect('/');
        return view('client.register');
    }

    public function forgotForm()
    {
        return view('client.forgot-password');
    }

    // ===== XỬ LÝ ĐĂNG KÝ =====
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone'    => 'nullable|string|max:20',
        ], [
            'fullname.required' => 'Vui lòng nhập họ tên!',
            'email.required'    => 'Vui lòng nhập email!',
            'email.email'       => 'Email không hợp lệ!',
            'email.unique'      => 'Email đã được sử dụng!',
            'password.required' => 'Vui lòng nhập mật khẩu!',
            'password.min'      => 'Mật khẩu phải có ít nhất 6 ký tự!',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Kiểm tra mật khẩu xác nhận
        if ($request->password !== $request->password_confirmation) {
            return back()
                ->with('error', 'Mật khẩu xác nhận không khớp!')
                ->withInput();
        }

        $user = User::create([
            'fullname'  => $request->fullname,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'phone'     => $request->phone,
            'role'      => 'user',
            'is_verify' => false,
            'avatar'    => 'https://hitly.vn/avatar-default',
        ]);

        return redirect('/dang-nhap')
            ->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    // ===== XỬ LÝ ĐĂNG NHẬP =====
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'Vui lòng nhập email!',
            'email.email'       => 'Email không hợp lệ!',
            'password.required' => 'Vui lòng nhập mật khẩu!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()
                ->with('error', 'Email hoặc mật khẩu không đúng!')
                ->withInput();
        }

        if ($user->is_locked) {
            return back()->with('error', 'Tài khoản đã bị khóa!');
        }

        $user->update(['last_active' => now()]);

        // Lưu token vào session
        $token = $user->createToken('access_token')->plainTextToken;

        session([
            'user'         => $user,
            'access_token' => $token,
        ]);

        if ($user->role === 'admin') {
            return redirect('/admin')->with('success', 'Đăng nhập thành công!');
        }

        return redirect('/')->with('success', 'Đăng nhập thành công!');
    }

    // ===== ĐĂNG XUẤT =====
    public function logout(Request $request)
    {
        // Xóa token Sanctum
        if (session('access_token')) {
            $user = session('user');
            if ($user) {
                User::find($user->id)?->tokens()->delete();
            }
        }
        session()->flush();
        return redirect('/dang-nhap')->with('success', 'Đăng xuất thành công!');
    }

    // ===== ĐĂNG NHẬP GOOGLE (API) =====
    public function loginGoogle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firebase_id' => 'required|string',
            'email'       => 'required|email',
            'fullname'    => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code'    => 400,
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $user = User::where('email', $request->email)
            ->orWhere('firebase_id', $request->firebase_id)
            ->first();

        if (!$user) {
            $user = User::create([
                'fullname'    => $request->fullname,
                'email'       => $request->email,
                'firebase_id' => $request->firebase_id,
                'avatar'      => $request->avatar ?? 'https://hitly.vn/avatar-default',
                'role'        => 'user',
                'is_verify'   => true,
                'password'    => null,
            ]);
        } else {
            $user->update([
                'firebase_id' => $request->firebase_id,
                'avatar'      => $request->avatar ?? $user->avatar,
                'last_active' => now(),
            ]);
        }

        if ($user->is_locked) {
            return response()->json([
                'code'    => 403,
                'message' => 'Tài khoản đã bị khóa!',
            ], 403);
        }

        $token = $user->createToken('access_token')->plainTextToken;

        session([
            'user'         => $user,
            'access_token' => $token,
        ]);

        return response()->json([
            'code'    => 200,
            'message' => 'Đăng nhập Google thành công!',
            'data'    => [
                'access_token' => $token,
                'user'         => $user,
            ],
        ]);
    }
}