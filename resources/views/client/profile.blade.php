@extends('layouts.app')

@section('content')

{{-- BANNER --}}
<section class="page-banner" style="background-image: url('/assets/images/home-1.jpg')">
    <div class="page-banner-overlay"></div>
    <div class="page-banner-content">
        <h1>Trang Cá Nhân</h1>
        <p><a href="/">Trang chủ</a> / <span>Trang cá nhân</span></p>
    </div>
</section>

{{-- NỘI DUNG --}}
<section class="profile-section">
    <div class="container">
        <div class="profile-layout">

            {{-- SIDEBAR --}}
            <div class="profile-sidebar">
                <div class="profile-avatar-box">
                    <div class="profile-avatar-wrap">
                        <img id="profile-avatar" src="/assets/images/default.avif" alt="Avatar" />
                        <button class="profile-avatar-edit" onclick="document.getElementById('avatar-input').click()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                        <input type="file" id="avatar-input" accept="image/*" style="display:none;"
                            onchange="uploadAvatar(this)" />
                    </div>
                    <h3 id="profile-name" style="font-size:18px;font-weight:700;margin-top:16px;">Đang tải...</h3>
                    <p id="profile-email" style="color:var(--gray);font-size:14px;margin-top:4px;"></p>
                </div>

                <nav class="profile-nav">
                    <a href="/profile" class="profile-nav-item active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Thông tin cá nhân
                    </a>
                    <a href="/don-hang" class="profile-nav-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Đơn hàng của tôi
                    </a>
                    <a href="/yeu-thich" class="profile-nav-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        Sản phẩm yêu thích
                    </a>
                    <a href="/dia-chi" class="profile-nav-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Địa chỉ của tôi
                    </a>
                    <button onclick="handleLogout()" class="profile-nav-item profile-nav-logout">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Đăng xuất
                    </button>
                </nav>
            </div>

            {{-- NỘI DUNG --}}
            <div class="profile-content">
                <div class="profile-box">
                    <h3 class="profile-box-title">Thông tin cá nhân</h3>

                    <div id="profile-error" class="auth-alert auth-alert-error" style="display:none;"></div>
                    <div id="profile-success" class="auth-alert auth-alert-success" style="display:none;"></div>

                    <form onsubmit="updateProfile(event)">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" id="edit-fullname" class="form-input" placeholder="Nhập họ và tên" />
                            </div>
                            <div class="form-group">
                                <label class="form-label">Số điện thoại</label>
                                <input type="tel" id="edit-phone" class="form-input" placeholder="Nhập số điện thoại" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" id="edit-email" class="form-input" disabled
                                style="background:var(--gray-light);" />
                        </div>
                        <button type="submit" class="btn btn-emerald">Cập nhật thông tin</button>
                    </form>
                </div>

                {{-- ĐỔI MẬT KHẨU --}}
                <div class="profile-box" style="margin-top:24px;">
                    <h3 class="profile-box-title">Đổi mật khẩu</h3>

                    <div id="pwd-error" class="auth-alert auth-alert-error" style="display:none;"></div>
                    <div id="pwd-success" class="auth-alert auth-alert-success" style="display:none;"></div>

                    <form onsubmit="changePassword(event)">
                        <div class="form-group">
                            <label class="form-label">Mật khẩu hiện tại</label>
                            <div class="input-password">
                                <input type="password" id="current-pwd" class="form-input"
                                    placeholder="Nhập mật khẩu hiện tại" />
                                <button type="button" onclick="togglePassword('current-pwd', this)"
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
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Mật khẩu mới</label>
                                <div class="input-password">
                                    <input type="password" id="new-pwd" class="form-input"
                                        placeholder="Nhập mật khẩu mới" />
                                    <button type="button" onclick="togglePassword('new-pwd', this)"
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
                            <div class="form-group">
                                <label class="form-label">Xác nhận mật khẩu mới</label>
                                <div class="input-password">
                                    <input type="password" id="confirm-pwd" class="form-input"
                                        placeholder="Nhập lại mật khẩu mới" />
                                    <button type="button" onclick="togglePassword('confirm-pwd', this)"
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
                        </div>
                        <button type="submit" class="btn btn-emerald">Đổi mật khẩu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // ===== LOAD PROFILE =====
    async function loadProfile() {
        const user = getUser();
        if (!user) {
            window.location.href = '/dang-nhap';
            return;
        }

        document.getElementById('profile-name').textContent = user.fullname;
        document.getElementById('profile-email').textContent = user.email;
        document.getElementById('profile-avatar').src = user.avatar || '/assets/images/default.avif';
        document.getElementById('edit-fullname').value = user.fullname || '';
        document.getElementById('edit-phone').value = user.phone || '';
        document.getElementById('edit-email').value = user.email || '';
    }

    // ===== CẬP NHẬT PROFILE =====
    async function updateProfile(e) {
        e.preventDefault();
        const errorEl = document.getElementById('profile-error');
        const successEl = document.getElementById('profile-success');
        errorEl.style.display = 'none';
        successEl.style.display = 'none';

        const res = await apiFetch('/user/profile', {
            method: 'PUT',
            body: JSON.stringify({
                fullname: document.getElementById('edit-fullname').value,
                phone: document.getElementById('edit-phone').value,
            }),
        });

        if (res?.code === 200) {
            const user = getUser();
            user.fullname = document.getElementById('edit-fullname').value;
            user.phone = document.getElementById('edit-phone').value;
            localStorage.setItem('user', JSON.stringify(user));
            successEl.textContent = 'Cập nhật thông tin thành công!';
            successEl.style.display = 'block';
            document.getElementById('profile-name').textContent = user.fullname;
        } else {
            errorEl.textContent = res?.message || 'Có lỗi xảy ra!';
            errorEl.style.display = 'block';
        }
    }

    // ===== ĐỔI MẬT KHẨU =====
    async function changePassword(e) {
        e.preventDefault();
        const errorEl = document.getElementById('pwd-error');
        const successEl = document.getElementById('pwd-success');
        errorEl.style.display = 'none';
        successEl.style.display = 'none';

        const newPwd = document.getElementById('new-pwd').value;
        const confirmPwd = document.getElementById('confirm-pwd').value;

        if (newPwd !== confirmPwd) {
            errorEl.textContent = 'Mật khẩu xác nhận không khớp!';
            errorEl.style.display = 'block';
            return;
        }

        const res = await apiFetch('/user/change-password', {
            method: 'PUT',
            body: JSON.stringify({
                current_password: document.getElementById('current-pwd').value,
                new_password: newPwd,
            }),
        });

        if (res?.code === 200) {
            successEl.textContent = 'Đổi mật khẩu thành công!';
            successEl.style.display = 'block';
            e.target.reset();
        } else {
            errorEl.textContent = res?.message || 'Mật khẩu hiện tại không đúng!';
            errorEl.style.display = 'block';
        }
    }

    // ===== LOGOUT =====
    async function handleLogout() {
        await authAPI.logout();
        removeToken();
        removeUser();
        window.location.href = '/';
    }

    function removeToken() {
        localStorage.removeItem('access_token');
    }

    function removeUser() {
        localStorage.removeItem('user');
    }

    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        input.type = input.type === 'password' ? 'text' : 'password';
        btn.style.color = input.type === 'text' ? 'var(--emerald)' : '';
    }

    function uploadAvatar(input) {
        showToast('Tính năng đang phát triển!');
    }

    loadProfile();
</script>
@endpush