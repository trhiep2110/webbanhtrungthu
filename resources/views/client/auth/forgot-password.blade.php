@extends('layouts.app')

@section('title', 'Quên Mật Khẩu')

@section('breadcrumb', 'Quên Mật Khẩu')

@section('content')

{{-- BANNER --}}
<section class="page-banner" style="background-image: url('/assets/images/home-2.jpg')">
    <div class="page-banner-overlay"></div>
    <div class="page-banner-content">
        <h1>Quên Mật Khẩu</h1>
        <p><a href="/">Trang chủ</a> / <span>Quên mật khẩu</span></p>
    </div>
</section>

{{-- NỘI DUNG --}}
<section class="auth-section">
    <div class="container">
        <div class="auth-layout">

            {{-- ẢNH --}}
            <div class="auth-image">
                <img src="/assets/images/children-banner-1.png" alt="Quên mật khẩu" />
            </div>

            {{-- FORM --}}
            <div class="auth-form-box">
                <h2 class="auth-title">Quên Mật Khẩu?</h2>
                <p class="auth-desc">Nhập email đã đăng ký, chúng tôi sẽ gửi mã OTP để bạn đặt lại mật khẩu.</p>

                <form id="forgot-form" method="POST" action="/quen-mat-khau">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" id="forgot-email" name="email" class="form-input"
                            placeholder="Nhập email đã đăng ký" value="{{ old('email') }}" required />
                    </div>

                    <button type="submit" class="btn btn-emerald" style="width:100%;" id="forgot-btn-submit">
                        Gửi mã OTP
                    </button>
                </form>

                <p class="auth-switch">
                    Đã nhớ mật khẩu? <a href="{{ route('login') }}">Đăng nhập ngay</a>
                </p>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('assets/clients/js/custom.js') }}"></script>
@endpush