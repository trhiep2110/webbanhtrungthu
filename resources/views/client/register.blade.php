@extends('layouts.app')


@section('title', 'Đăng Ký')

@section('breadcrumb', 'Đăng Ký')


@section('content')

{{-- BANNER --}}
<section class="page-banner" style="background-image: url('/assets/images/home-2.jpg')">
    <div class="page-banner-overlay"></div>
    <div class="page-banner-content">
        <h1>Đăng Ký</h1>
        <p><a href="/">Trang chủ</a> / <span>Đăng ký</span></p>
    </div>
</section>

{{-- NỘI DUNG --}}
<section class="auth-section">
    <div class="container">
        <div class="auth-layout">

            {{-- ẢNH --}}
            <div class="auth-image">
                <img src="/assets/images/children-banner-2.png" alt="Đăng ký" />
            </div>

            {{-- FORM --}}
            <div class="auth-form-box">
                <h2 class="auth-title">Đăng Ký Tài Khoản</h2>
                <p class="auth-desc">Tạo tài khoản để mua sắm và theo dõi đơn hàng của bạn.</p>

                <form id="register-form" method="POST">
                    @csrf

                    {{-- HỌ TÊN --}}
                    <div class="form-group">
                        <label class="form-label">Họ và tên</label>
                        <input type="text" id="reg-fullname" name="fullname" class="form-input"
                            placeholder="Nhập họ và tên" required />
                    </div>

                    {{-- EMAIL --}}
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" id="reg-email" name="email" class="form-input" placeholder="Nhập email"
                            required />
                    </div>

                    {{-- SỐ ĐIỆN THOẠI --}}
                    <div class="form-group">
                        <label class="form-label">Số điện thoại</label>
                        <input type="tel" id="reg-phone" name="phone" class="form-input"
                            placeholder="Nhập số điện thoại" />
                    </div>

                    {{-- MẬT KHẨU --}}
                    <div class="form-group">
                        <label class="form-label">Mật khẩu</label>
                        <div class="input-password">
                            <input type="password" id="reg-password" name="password" class="form-input"
                                placeholder="Nhập mật khẩu (ít nhất 6 ký tự)" required />
                            <button type="button" data-target="reg-password" class="password-toggle">
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

                    {{-- XÁC NHẬN MẬT KHẨU --}}
                    <div class="form-group">
                        <label class="form-label">Xác nhận mật khẩu</label>
                        <div class="input-password">
                            <input type="password" id="reg-confirm-password" name="password_confirmation"
                                class="form-input" placeholder="Nhập lại mật khẩu" required />
                            <button type="button" data-target="reg-confirm-password" class="password-toggle">
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

                    {{-- NÚT ĐĂNG KÝ --}}
                    <button type="submit" class="btn btn-emerald" style="width:100%;" id="register-btn-submit">
                        Đăng ký
                    </button>
                </form>

                {{-- HOẶC --}}
                <div class="auth-divider"><span>hoặc</span></div>

                {{-- GOOGLE --}}
                <button class="btn-google" onclick="loginGoogle()">
                    <img src="/assets/images/logo-google.png" alt="Google" style="width:20px;height:20px;" />
                    Đăng ký với Google
                </button>

                {{-- ĐÃ CÓ TÀI KHOẢN --}}
                <p class="auth-switch">
                    Đã có tài khoản? <a href="/dang-nhap">Đăng nhập ngay</a>
                </p>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('assets/clients/js/custom.js') }}"></script>
@endpush