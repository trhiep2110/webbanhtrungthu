@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')

{{-- BANNER --}}
<section class="page-banner" style="background-image: url('/assets/images/home-2.jpg')">
    <div class="page-banner-overlay"></div>
    <div class="page-banner-content">
        <h1>Đăng Nhập</h1>
        <p><a href="/">Trang chủ</a> / <span>Đăng nhập</span></p>
    </div>
</section>

{{-- NỘI DUNG --}}
<section class="auth-section">
    <div class="container">
        <div class="auth-layout">

            {{-- ẢNH --}}
            <div class="auth-image">
                <img src="/assets/images/children-banner-1.png" alt="Đăng nhập" />
            </div>

            {{-- FORM --}}
            <div class="auth-form-box">
                <h2 class="auth-title">Đăng Nhập</h2>
                <p class="auth-desc">Chào mừng bạn đến với Trang quản trị. Hãy đăng nhập để quản lý hệ thống một cách dễ
                    dàng và hiệu quả.</p>

                {{-- THÔNG BÁO LỖI --}}
                <div id="auth-error" class="auth-alert auth-alert-error" style="display:none;"></div>
                <div id="auth-success" class="auth-alert auth-alert-success" style="display:none;"></div>

                <form id="login-form" method="POST">
                    @csrf

                    {{-- EMAIL --}}
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" id="login-email" name="email" class="form-input"
                            placeholder="Nhập email của bạn" required />
                    </div>

                    {{-- MẬT KHẨU --}}
                    <div class="form-group">
                        <label class="form-label">Mật khẩu</label>
                        <div class="input-password">
                            <input type="password" id="login-password" name="password" class="form-input"
                                placeholder="Nhập mật khẩu" required />
                            <button type="button" data-target="login-password" class="password-toggle">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- QUÊN MẬT KHẨU --}}
                    <div style="text-align:right; margin-bottom:20px;">
                        <a href="{{ route('password.request') }}" style="color:var(--emerald); font-size:14px;">Quên mật
                            khẩu?</a>
                    </div>

                    {{-- NÚT ĐĂNG NHẬP --}}
                    <button type="submit" class="btn btn-emerald" style="width:100%;" id="login-btn-submit">
                        Đăng nhập
                    </button>
                </form>

                {{-- HOẶC --}}
                <div class="auth-divider">
                    <span>hoặc</span>
                </div>

                {{-- GOOGLE --}}
                <button class="btn-google" onclick="loginGoogle()">
                    <img src="/assets/images/logo-google.png" alt="Google" style="width:20px;height:20px;" />
                    Đăng nhập với Google
                </button>

                {{-- CHƯA CÓ TÀI KHOẢN --}}
                <p class="auth-switch">
                    Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a>
                </p>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('assets/clients/js/custom.js') }}"></script>
@endpush