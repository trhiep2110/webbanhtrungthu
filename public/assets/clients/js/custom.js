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


    // ===== TOGGLE HEADER DROPDOWN =====
    $('#header-user-toggle').on('click', function (e) {
        e.stopPropagation();
        $('#header-dropdown-menu').toggleClass('show');
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('.header-user-dropdown').length) {
            $('#header-dropdown-menu').removeClass('show');
        }
    });
});



$(document).ready(function () {

    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('.profile-nav-item[data-tab]').on('click', function () {
        const tab = $(this).data('tab');

        $('.profile-nav-item[data-tab]').removeClass('active');
        $(this).addClass('active');

        $('.profile-panel').removeClass('active');
        $('#panel-' + tab).addClass('active');

        // Lưu tab hiện tại vào URL hash (để F5 vẫn nhớ tab, nhưng không load lại trang)
        history.replaceState(null, null, '#' + tab);
    });

    // Khôi phục tab từ hash khi load trang
    const hash = window.location.hash.replace('#', '');
    if (hash && $('#panel-' + hash).length) {
        $('.profile-nav-item[data-tab]').removeClass('active');
        $('.profile-nav-item[data-tab="' + hash + '"]').addClass('active');
        $('.profile-panel').removeClass('active');
        $('#panel-' + hash).addClass('active');
    }

    // ===========================================
    // CẬP NHẬT THÔNG TIN CÁ NHÂN
    // ===========================================
    $('#profile-form').on('submit', function (e) {
        e.preventDefault();
        const btn = $('#save-profile-btn');
        const originalText = btn.text();
        btn.text('Đang lưu...').prop('disabled', true);

        $.ajax({
            url: '/profile/cap-nhat',
            method: 'POST',
            data: {
                _token: csrfToken,
                fullname: $('#edit-fullname').val(),
                phone: $('#edit-phone').val(),
            },
            success: function (res) {
                showToast(res.message || 'Cập nhật thông tin thành công!', 'success');
                $('.profile-name').text($('#edit-fullname').val());
            },
            error: function (xhr) {
                showToast(xhr.responseJSON?.message || 'Có lỗi xảy ra!', 'error');
            },
            complete: function () {
                btn.text(originalText).prop('disabled', false);
            }
        });
    });

    // ===========================================
    // ĐỔI MẬT KHẨU
    // ===========================================
    $('#password-form').on('submit', function (e) {
        e.preventDefault();

        const newPwd = $('#new-pwd').val();
        const confirmPwd = $('#confirm-pwd').val();

        if (newPwd.length < 6) {
            showToast('Mật khẩu mới phải có ít nhất 6 ký tự!', 'error');
            return;
        }
        if (newPwd !== confirmPwd) {
            showToast('Mật khẩu xác nhận không khớp!', 'error');
            return;
        }

        const btn = $('#save-password-btn');
        const originalText = btn.text();
        btn.text('Đang xử lý...').prop('disabled', true);

        $.ajax({
            url: '/profile/doi-mat-khau',
            method: 'POST',
            data: {
                _token: csrfToken,
                current_password: $('#current-pwd').val(),
                new_password: newPwd,
                new_password_confirmation: confirmPwd,
            },
            success: function (res) {
                showToast(res.message || 'Đổi mật khẩu thành công!', 'success');
                $('#password-form')[0].reset();
            },
            error: function (xhr) {
                showToast(xhr.responseJSON?.message || 'Mật khẩu hiện tại không đúng!', 'error');
            },
            complete: function () {
                btn.text(originalText).prop('disabled', false);
            }
        });
    });

    // ===========================================
    // UPLOAD AVATAR THẬT (LƯU VÀO SERVER)
    // ===========================================
    $('#avatar-input').on('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;

        // Validate trước khi gửi
        const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            showToast('Chỉ chấp nhận ảnh JPG, PNG hoặc WEBP!', 'error');
            return;
        }
        if (file.size > 2 * 1024 * 1024) {
            showToast('Ảnh không được vượt quá 2MB!', 'error');
            return;
        }

        // Preview tạm trong lúc upload
        const reader = new FileReader();
        reader.onload = function (evt) {
            $('#profile-avatar').attr('src', evt.target.result);
        };
        reader.readAsDataURL(file);

        // Upload thật lên server
        const formData = new FormData();
        formData.append('avatar', file);
        formData.append('_token', csrfToken);

        $.ajax({
            url: '/profile/avatar',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                showToast(res.message || 'Cập nhật ảnh đại diện thành công!', 'success');
                // Cập nhật lại src bằng URL thật từ server (tránh mất khi F5)
                $('#profile-avatar').attr('src', res.avatar);
            },
            error: function (xhr) {
                showToast(xhr.responseJSON?.message || 'Tải ảnh lên thất bại!', 'error');
                // Khôi phục ảnh cũ nếu lỗi
                location.reload();
            }
        });
    });

    // ===========================================
    // ĐƠN HÀNG: FILTER THEO TRẠNG THÁI
    // ===========================================
    $('.order-tab').on('click', function () {
        const status = $(this).data('status');
        $('.order-tab').removeClass('active');
        $(this).addClass('active');

        if (status === 'all') {
            $('.order-card').show();
        } else {
            $('.order-card').hide();
            $('.order-card[data-status="' + status + '"]').show();
        }
    });

    // ===========================================
    // ĐƠN HÀNG: HỦY ĐƠN
    // ===========================================
    $(document).on('click', '.cancel-order-btn', function () {
        const orderId = $(this).data('id');
        if (!confirm('Bạn có chắc muốn hủy đơn hàng này?')) return;

        $.ajax({
            url: '/order/' + orderId + '/cancel',
            method: 'PUT',
            data: { _token: csrfToken },
            success: function (res) {
                showToast(res.message || 'Hủy đơn hàng thành công!', 'success');
                setTimeout(() => location.reload(), 1000);
            },
            error: function (xhr) {
                showToast(xhr.responseJSON?.message || 'Có lỗi xảy ra!', 'error');
            }
        });
    });

    // ===========================================
    // YÊU THÍCH: XÓA
    // ===========================================
    $(document).on('click', '.favorite-remove-btn', function () {
        const favId = $(this).data('id');
        const card = $(this).closest('.favorite-card');

        if (!confirm('Xóa sản phẩm này khỏi danh sách yêu thích?')) return;

        $.ajax({
            url: '/profile/yeu-thich/' + favId,
            method: 'DELETE',
            data: { _token: csrfToken },
            success: function (res) {
                showToast(res.message || 'Đã xóa khỏi yêu thích!', 'success');
                card.fadeOut(250, function () {
                    $(this).remove();
                    // Cập nhật số đếm trên nav
                    const newCount = $('.favorite-card').length;
                    const navCount = $('.profile-nav-item[data-tab="favorites"] .profile-nav-count');
                    if (newCount === 0) {
                        navCount.remove();
                        $('#favorites-list').replaceWith(
                            '<div class="profile-empty"><p>Bạn chưa có sản phẩm yêu thích nào!</p><a href="/san-pham" class="btn btn-emerald">Khám phá sản phẩm</a></div>'
                        );
                    } else {
                        navCount.text(newCount);
                    }
                });
            },
            error: function (xhr) {
                showToast(xhr.responseJSON?.message || 'Có lỗi xảy ra!', 'error');
            }
        });
    });

    // ===========================================
    // ĐỊA CHỈ: MỞ / ĐÓNG MODAL
    // ===========================================
    $('#add-address-btn').on('click', function () {
        $('#address-form')[0].reset();
        $('#address-modal').css('display', 'flex');
        loadProvinces();
    });

    function closeAddressModal() {
        $('#address-modal').hide();
    }
    $('#address-modal-close, #address-cancel-btn, #address-modal-overlay').on('click', closeAddressModal);

    // ===========================================
    // ĐỊA CHỈ: LOAD TỈNH / HUYỆN / XÃ (GHN API)
    // ===========================================
    function loadProvinces() {
        const select = $('#addr-province');
        if (select.find('option').length > 1) return; // đã load rồi

        $.ajax({
            url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province',
            method: 'GET',
            headers: { 'Token': window.GHN_API_KEY || '' },
            success: function (res) {
                (res.data || []).forEach(p => {
                    select.append(`<option value="${p.ProvinceID}" data-name="${p.ProvinceName}">${p.ProvinceName}</option>`);
                });
            }
        });
    }

    $('#addr-province').on('change', function () {
        const provinceId = $(this).val();
        const districtSelect = $('#addr-district');
        const wardSelect = $('#addr-ward');
        districtSelect.html('<option value="">Chọn quận/huyện</option>');
        wardSelect.html('<option value="">Chọn phường/xã</option>');

        if (!provinceId) return;

        $.ajax({
            url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/district',
            method: 'GET',
            data: { province_id: provinceId },
            headers: { 'Token': window.GHN_API_KEY || '' },
            success: function (res) {
                (res.data || []).forEach(d => {
                    districtSelect.append(`<option value="${d.DistrictID}" data-name="${d.DistrictName}">${d.DistrictName}</option>`);
                });
            }
        });
    });

    $('#addr-district').on('change', function () {
        const districtId = $(this).val();
        const wardSelect = $('#addr-ward');
        wardSelect.html('<option value="">Chọn phường/xã</option>');

        if (!districtId) return;

        $.ajax({
            url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/ward',
            method: 'GET',
            data: { district_id: districtId },
            headers: { 'Token': window.GHN_API_KEY || '' },
            success: function (res) {
                (res.data || []).forEach(w => {
                    wardSelect.append(`<option value="${w.WardCode}" data-name="${w.WardName}">${w.WardName}</option>`);
                });
            }
        });
    });

    // ===========================================
    // ĐỊA CHỈ: LƯU ĐỊA CHỈ MỚI
    // ===========================================
    $('#save-address-btn').on('click', function () {
        const provinceSelect = $('#addr-province');
        const districtSelect = $('#addr-district');
        const wardSelect = $('#addr-ward');

        const data = {
            _token: csrfToken,
            name: $('#addr-name').val(),
            phone: $('#addr-phone').val(),
            street: $('#addr-street').val(),
            province_id: provinceSelect.val(),
            province_name: provinceSelect.find('option:selected').data('name'),
            district_id: districtSelect.val(),
            district_name: districtSelect.find('option:selected').data('name'),
            ward_code: wardSelect.val(),
            ward_name: wardSelect.find('option:selected').data('name'),
        };

        if (!data.name || !data.phone || !data.street || !data.province_id || !data.district_id || !data.ward_code) {
            showToast('Vui lòng điền đầy đủ thông tin địa chỉ!', 'error');
            return;
        }

        const btn = $(this);
        btn.text('Đang lưu...').prop('disabled', true);

        $.ajax({
            url: '/profile/dia-chi',
            method: 'POST',
            data: data,
            success: function (res) {
                showToast(res.message || 'Thêm địa chỉ thành công!', 'success');
                closeAddressModal();
                setTimeout(() => location.reload(), 800);
            },
            error: function (xhr) {
                showToast(xhr.responseJSON?.message || 'Có lỗi xảy ra!', 'error');
            },
            complete: function () {
                btn.text('Lưu địa chỉ').prop('disabled', false);
            }
        });
    });

    // ===========================================
    // ĐỊA CHỈ: XÓA
    // ===========================================
    $(document).on('click', '.address-delete-btn', function () {
        const addrId = $(this).data('id');
        const card = $(this).closest('.address-card');

        if (!confirm('Xóa địa chỉ này?')) return;

        $.ajax({
            url: '/profile/dia-chi/' + addrId,
            method: 'DELETE',
            data: { _token: csrfToken },
            success: function (res) {
                showToast(res.message || 'Đã xóa địa chỉ!', 'success');
                card.fadeOut(250, function () { $(this).remove(); });
            },
            error: function (xhr) {
                showToast(xhr.responseJSON?.message || 'Có lỗi xảy ra!', 'error');
            }
        });
    });

    // ===== ĐĂNG XUẤT (DÙNG CHUNG CHO MỌI NÚT, MỌI TRANG) =====
    $(document).on('click', '.logout-trigger', function (e) {
        e.preventDefault();
        if (!confirm('Bạn có chắc muốn đăng xuất?')) return;

        $.ajax({
            url: '/dang-xuat',
            method: 'POST',
            data: { _token: $('meta[name="csrf-token"]').attr('content') },
            success: function () {
                window.location.href = '/dang-nhap';
            },
            error: function () {
                window.location.href = '/dang-nhap';
            }
        });
    });
});