@extends('layouts.app')

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

                <div id="auth-error" class="auth-alert auth-alert-error" style="display:none;"></div>
                <div id="auth-success" class="auth-alert auth-alert-success" style="display:none;"></div>

                <form id="register-form" onsubmit="handleRegister(event)">

                    {{-- HỌ TÊN --}}
                    <div class="form-group">
                        <label class="form-label">Họ và tên</label>
                        <input type="text" id="reg-fullname" class="form-input" placeholder="Nhập họ và tên" required />
                    </div>

                    {{-- EMAIL --}}
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" id="reg-email" class="form-input" placeholder="Nhập email" required />
                    </div>

                    {{-- SỐ ĐIỆN THOẠI --}}
                    <div class="form-group">
                        <label class="form-label">Số điện thoại</label>
                        <input type="tel" id="reg-phone" class="form-input" placeholder="Nhập số điện thoại" />
                    </div>

                    {{-- MẬT KHẨU --}}
                    <div class="form-group">
                        <label class="form-label">Mật khẩu</label>
                        <div class="input-password">
                            <input type="password" id="reg-password" class="form-input"
                                placeholder="Nhập mật khẩu (ít nhất 6 ký tự)" required />
                            <button type="button" onclick="togglePassword('reg-password', this)"
                                class="password-toggle">
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
                            <input type="password" id="reg-confirm-password" class="form-input"
                                placeholder="Nhập lại mật khẩu" required />
                            <button type="button" onclick="togglePassword('reg-confirm-password', this)"
                                class="password-toggle">
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
                    <img src="/assets/images/logoGHN.webp" alt="Google" style="width:20px;height:20px;" />
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
<script>
    async function handleRegister(e) {
        e.preventDefault();
        const fullname = document.getElementById('reg-fullname').value;
        const email = document.getElementById('reg-email').value;
        const phone = document.getElementById('reg-phone').value;
        const password = document.getElementById('reg-password').value;
        const confirmPassword = document.getElementById('reg-confirm-password').value;
        const btn = document.getElementById('register-btn-submit');
        const errorEl = document.getElementById('auth-error');
        const successEl = document.getElementById('auth-success');

        errorEl.style.display = 'none';
        successEl.style.display = 'none';

        // Validate
        if (password.length < 6) {
            errorEl.textContent = 'Mật khẩu phải có ít nhất 6 ký tự!';
            errorEl.style.display = 'block';
            return;
        }
        if (password !== confirmPassword) {
            errorEl.textContent = 'Mật khẩu xác nhận không khớp!';
            errorEl.style.display = 'block';
            return;
        }

        btn.textContent = 'Đang đăng ký...';
        btn.disabled = true;

        const res = await authAPI.register({
            fullname,
            email,
            phone,
            password
        });

        if (res?.code === 200 || res?.code === 201) {
            successEl.textContent = 'Đăng ký thành công! Đang chuyển đến trang đăng nhập...';
            successEl.style.display = 'block';
            setTimeout(() => window.location.href = '/dang-nhap', 2000);
        } else {
            errorEl.textContent = res?.message || 'Có lỗi xảy ra! Vui lòng thử lại.';
            errorEl.style.display = 'block';
            btn.textContent = 'Đăng ký';
            btn.disabled = false;
        }
    }

    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        input.type = input.type === 'password' ? 'text' : 'password';
        btn.style.color = input.type === 'text' ? 'var(--emerald)' : '';
    }

    function loginGoogle() {
        showToast('Tính năng đang phát triển!', 'error');
    }

    if (getUser()) window.location.href = '/';
</script>
@endpush