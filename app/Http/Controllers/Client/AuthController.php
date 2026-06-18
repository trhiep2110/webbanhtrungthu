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
        return view('client.auth.forgot-password');
    }

    public function resetForm()
    {
        return view('client.auth.reset-password');
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
            return response()->json(['code' => 400, 'message' => $validator->errors()->first()], 400);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['code' => 401, 'message' => 'Email hoặc mật khẩu không đúng!'], 401);
        }

        if ($user->is_locked) {
            return response()->json(['code' => 403, 'message' => 'Tài khoản đã bị khóa!'], 403);
        }

        $user->update(['last_active' => now()]);
        $token = $user->createToken('access_token')->plainTextToken;

        session(['user' => $user, 'access_token' => $token]);

        return response()->json([
            'code'    => 200,
            'message' => 'Đăng nhập thành công!',
            'role'    => $user->role,
        ]);
    }

    // ===== GỬI OTP QUÊN MẬT KHẨU =====
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Vui lòng nhập email!',
            'email.email'    => 'Email không hợp lệ!',
            'email.exists'   => 'Email không tồn tại trong hệ thống!',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 400, 'message' => $validator->errors()->first()], 400);
        }

        Otp::where('email', $request->email)->where('type', 'forgot password')->delete();

        $otpCode = rand(100000, 999999);

        Otp::create([
            'email'      => $request->email,
            'otp'        => $otpCode,
            'type'       => 'forgot password',
            'expires_at' => now()->addMinutes(5),
        ]);

        try {
            Mail::send('emails.otp', ['otp' => $otpCode, 'type' => 'forgot password'], function ($mail) use ($request) {
                $mail->to($request->email)->subject('Đặt Lại Mật Khẩu - Bánh Trung Thu');
            });
        } catch (\Exception $e) {
            return response()->json(['code' => 500, 'message' => 'Không thể gửi email! Lỗi: ' . $e->getMessage()], 500);
        }

        session(['reset_email' => $request->email]);

        return response()->json([
            'code'    => 200,
            'message' => 'Mã OTP đã được gửi đến email của bạn!',
            'redirect' => '/dat-lai-mat-khau',
        ]);
    }

    // ===== XÁC THỰC OTP & ĐẶT LẠI MẬT KHẨU =====
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp'      => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 400, 'message' => $validator->errors()->first()], 400);
        }

        if ($request->password !== $request->password_confirmation) {
            return response()->json(['code' => 400, 'message' => 'Mật khẩu xác nhận không khớp!'], 400);
        }

        $email = session('reset_email');

        if (!$email) {
            return response()->json(['code' => 400, 'message' => 'Phiên làm việc đã hết hạn! Vui lòng thử lại từ đầu.'], 400);
        }

        $otp = Otp::where('email', $email)
            ->where('otp', $request->otp)
            ->where('type', 'forgot password')
            ->where('expires_at', '>', now())
            ->first();

        if (!$otp) {
            return response()->json(['code' => 400, 'message' => 'Mã OTP không đúng hoặc đã hết hạn!'], 400);
        }

        User::where('email', $email)->update(['password' => Hash::make($request->password)]);

        $otp->delete();
        session()->forget('reset_email');

        return response()->json([
            'code'    => 200,
            'message' => 'Đặt lại mật khẩu thành công!',
            'redirect' => '/dang-nhap',
        ]);
    }
}
