@extends('layouts.app')

@section('title', 'Đặt Lại Mật Khẩu')

@section('breadcrumb', 'Đặt Lại Mật Khẩu')

@section('content')


{{-- BANNER --}}
<section class="page-banner" style="background-image: url('/assets/images/home-2.jpg')">
    <div class="page-banner-overlay"></div>
    <div class="page-banner-content">
        <h1>Đặt Lại Mật Khẩu</h1>
        <p><a href="/">Trang chủ</a> / <span>Đặt lại mật khẩu</span></p>
    </div>
</section>

{{-- NỘI DUNG --}}
<section class="auth-section">
    <div class="container">
        <div class="auth-layout">

            {{-- ẢNH --}}
            <div class="auth-image">
                <img src="/assets/images/children-banner-2.png" alt="Đặt lại mật khẩu" />
            </div>

            {{-- FORM --}}
            <div class="auth-form-box">
                <h2 class="auth-title">Nhập Mã OTP</h2>
                <p class="auth-desc">
                    Mã OTP đã được gửi đến email <strong>{{ session('reset_email') }}</strong>.
                    Vui lòng kiểm tra hộp thư (kể cả mục spam) và nhập mã dưới đây.
                </p>

                <form id="reset-form" method="POST" action="/dat-lai-mat-khau">
                    @csrf

                    {{-- OTP --}}
                    <div class="form-group">
                        <label class="form-label">Mã OTP (6 số)</label>
                        <input type="text" id="reset-otp" name="otp" class="form-input otp-input"
                            placeholder="Nhập mã OTP" maxlength="6" required />
                    </div>

                    {{-- MẬT KHẨU MỚI --}}
                    <div class="form-group">
                        <label class="form-label">Mật khẩu mới</label>
                        <div class="input-password">
                            <input type="password" id="reset-password" name="password" class="form-input"
                                placeholder="Nhập mật khẩu mới (ít nhất 6 ký tự)" required />
                            <button type="button" data-target="reset-password" class="password-toggle">
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
                        <label class="form-label">Xác nhận mật khẩu mới</label>
                        <div class="input-password">
                            <input type="password" id="reset-confirm-password" name="password_confirmation"
                                class="form-input" placeholder="Nhập lại mật khẩu mới" required />
                            <button type="button" data-target="reset-confirm-password" class="password-toggle">
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

                    <button type="submit" class="btn btn-emerald" style="width:100%;" id="reset-btn-submit">
                        Đặt lại mật khẩu
                    </button>
                </form>

                {{-- GỬI LẠI OTP --}}
                <p class="auth-switch">
                    Không nhận được mã? <a href="#" id="resend-otp-btn">Gửi lại OTP</a>
                    <span id="countdown-text" style="display:none;"></span>
                </p>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('assets/clients/js/custom.js') }}"></script>
@endpush