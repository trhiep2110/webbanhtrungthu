$(document).ready(function () {

    // ===== TOAST HELPER =====
    window.showToast = function (message, type = 'success') {

        $.toast({
            heading: type === 'success' ? 'Thành công' : 'Thông báo',
            text: message,
            icon: type,
            position: 'top-right',
            loader: true,
            stack: 5,
            hideAfter: 3000
        });

    };

    // ===== TOGGLE PASSWORD =====
    $(document).on('click', '.password-toggle', function () {

        const target = $(this).data('target');
        const input = $('#' + target);

        if (!input.length) {
            return;
        }

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