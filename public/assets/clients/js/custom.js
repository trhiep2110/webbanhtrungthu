// ===== TOAST HELPER (GLOBAL) =====
function showToast(message, type = 'success') {
    $.toast({
        heading: type === 'success' ? 'Thành công' : 'Lỗi',
        text: message,
        showHideTransition: 'slide',
        icon: type,
        position: 'top-right',
        bgColor: type === 'success' ? '#065f46' : '#ef4444',
        textColor: '#fff',
        loaderBg: type === 'success' ? '#059669' : '#dc2626',
        hideAfter: 3000,
    });
}

$(document).ready(function () {

    // ===== TOGGLE PASSWORD (DÙNG CHUNG MỌI TRANG) =====
    $(document).on('click', '.password-toggle', function () {
        const target = $(this).data('target');
        const input = $('#' + target);
        if (!input.length) return;

        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            $(this).addClass('active');
        } else {
            input.attr('type', 'password');
            $(this).removeClass('active');
        }
    });

    // ===== ĐĂNG KÝ FORM =====
    $('#register-form').on('submit', function (e) {
        e.preventDefault();

        const password = $('#reg-password').val();
        const confirmPassword = $('#reg-confirm-password').val();

        if (password.length < 6) {
            showToast('Mật khẩu phải có ít nhất 6 ký tự!', 'error');
            return;
        }
        if (password !== confirmPassword) {
            showToast('Mật khẩu xác nhận không khớp!', 'error');
            return;
        }

        const btn = $('#register-btn-submit');
        btn.text('Đang đăng ký...').prop('disabled', true);

        $.ajax({
            url: '/dang-ky',
            method: 'POST',
            data: {
                _token: $('#register-form [name="_token"]').val(),
                fullname: $('#reg-fullname').val(),
                email: $('#reg-email').val(),
                phone: $('#reg-phone').val(),
                password: password,
                password_confirmation: confirmPassword,
            },
            success: function (res) {
                showToast('Đăng ký thành công!', 'success');
                setTimeout(() => window.location.href = '/dang-nhap', 1500);
            },
            error: function (xhr) {
                const res = xhr.responseJSON;
                showToast(res?.message || 'Có lỗi xảy ra!', 'error');
                btn.text('Đăng ký').prop('disabled', false);
            }
        });
    });

    // ===== LOGIN FORM =====
    $('#login-form').on('submit', function (e) {
        e.preventDefault();

        const btn = $('#login-btn-submit');
        btn.text('Đang đăng nhập...').prop('disabled', true);

        $.ajax({
            url: '/dang-nhap',
            method: 'POST',
            data: {
                _token: $('#login-form [name="_token"]').val(),
                email: $('#login-email').val(),
                password: $('#login-password').val(),
            },
            success: function (res) {
                showToast(res.message, 'success');
                setTimeout(() => {
                    window.location.href = res.role === 'admin' ? '/admin' : '/';
                }, 1000);
            },
            error: function (xhr) {
                const res = xhr.responseJSON;
                showToast(res?.message || 'Đăng nhập thất bại!', 'error');
                btn.text('Đăng nhập').prop('disabled', false);
            }
        });
    });

    // ===== FORGOT PASSWORD FORM =====
    $('#forgot-form').on('submit', function (e) {
        e.preventDefault();

        const btn = $('#forgot-btn-submit');
        btn.text('Đang gửi mã OTP...').prop('disabled', true);

        $.ajax({
            url: '/quen-mat-khau',
            method: 'POST',
            data: {
                _token: $('#forgot-form [name="_token"]').val(),
                email: $('#forgot-email').val(),
            },
            success: function (res) {
                showToast(res.message, 'success');
                setTimeout(() => {
                    window.location.href = res.redirect || '/dat-lai-mat-khau';
                }, 1200);
            },
            error: function (xhr) {
                const res = xhr.responseJSON;
                showToast(res?.message || 'Có lỗi xảy ra!', 'error');
                btn.text('Gửi mã OTP').prop('disabled', false);
            }
        });
    });

    // ===== RESET PASSWORD FORM =====
    let countdown = 60;
    let countdownInterval = null;

    $('#reset-otp').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#reset-form').on('submit', function (e) {
        e.preventDefault();

        const password = $('#reset-password').val();
        const confirmPassword = $('#reset-confirm-password').val();

        if (password.length < 6) {
            showToast('Mật khẩu phải có ít nhất 6 ký tự!', 'error');
            return;
        }
        if (password !== confirmPassword) {
            showToast('Mật khẩu xác nhận không khớp!', 'error');
            return;
        }

        const btn = $('#reset-btn-submit');
        btn.text('Đang xử lý...').prop('disabled', true);

        $.ajax({
            url: '/dat-lai-mat-khau',
            method: 'POST',
            data: {
                _token: $('#reset-form [name="_token"]').val(),
                otp: $('#reset-otp').val(),
                password: password,
                password_confirmation: confirmPassword,
            },
            success: function (res) {
                showToast(res.message, 'success');
                setTimeout(() => {
                    window.location.href = res.redirect || '/dang-nhap';
                }, 1200);
            },
            error: function (xhr) {
                const res = xhr.responseJSON;
                showToast(res?.message || 'Có lỗi xảy ra!', 'error');
                btn.text('Đặt lại mật khẩu').prop('disabled', false);
            }
        });
    });

    function startCountdown() {
        if (!$('#resend-otp-btn').length) return;
        countdown = 60;
        $('#resend-otp-btn').hide();
        $('#countdown-text').show();
        updateCountdownText();

        countdownInterval = setInterval(function () {
            countdown--;
            updateCountdownText();
            if (countdown <= 0) {
                clearInterval(countdownInterval);
                $('#countdown-text').hide();
                $('#resend-otp-btn').show();
            }
        }, 1000);
    }

    function updateCountdownText() {
        $('#countdown-text').text(`Gửi lại sau ${countdown}s`);
    }

    $('#resend-otp-btn').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/gui-lai-otp',
            method: 'POST',
            data: { _token: $('meta[name="csrf-token"]').attr('content') },
            success: function (res) {
                showToast('Đã gửi lại mã OTP!', 'success');
                startCountdown();
            },
            error: function (xhr) {
                const res = xhr.responseJSON;
                showToast(res?.message || 'Có lỗi xảy ra!', 'error');
            }
        });
    });

    if ($('#reset-form').length) {
        startCountdown();
    }

    // ===== ĐĂNG NHẬP GOOGLE =====
    window.loginGoogle = async function () {
        try {
            const provider = new firebase.auth.GoogleAuthProvider();
            const result = await firebase.auth().signInWithPopup(provider);
            const user = result.user;

            $.ajax({
                url: '/dang-nhap-google',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    firebase_id: user.uid,
                    email: user.email,
                    fullname: user.displayName,
                    avatar: user.photoURL,
                },
                success: function (res) {
                    if (res.code === 200) {
                        showToast('Đăng nhập Google thành công!', 'success');
                        setTimeout(() => window.location.href = '/', 1000);
                    }
                },
                error: function () {
                    showToast('Đăng nhập Google thất bại!', 'error');
                }
            });
        } catch (error) {
            showToast('Đăng nhập Google thất bại!', 'error');
        }
    };

});