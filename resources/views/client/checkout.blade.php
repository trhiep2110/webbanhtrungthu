@extends('layouts.app')

@section('content')

{{-- BANNER --}}
<section class="page-banner" style="background-image: url('/assets/images/product-filter.jpg')">
    <div class="page-banner-overlay"></div>
    <div class="page-banner-content">
        <h1>Thanh Toán</h1>
        <p><a href="/">Trang chủ</a> / <a href="/gio-hang">Giỏ hàng</a> / <span>Thanh toán</span></p>
    </div>
</section>

{{-- NỘI DUNG --}}
<section class="checkout-section">
    <div class="container">
        <div class="checkout-layout">

            {{-- FORM THÔNG TIN --}}
            <div class="checkout-form">

                {{-- THÔNG TIN GIAO HÀNG --}}
                <div class="checkout-box">
                    <h3 class="checkout-box-title">
                        <span class="checkout-step">1</span>
                        Thông tin giao hàng
                    </h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Họ tên người nhận</label>
                            <input type="text" id="recipient-name" class="form-input" placeholder="Nhập họ tên" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Số điện thoại</label>
                            <input type="tel" id="recipient-phone" class="form-input"
                                placeholder="Nhập số điện thoại" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Tỉnh/Thành phố</label>
                            <select id="province" class="form-input" onchange="loadDistricts()">
                                <option value="">Chọn tỉnh/thành phố</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Quận/Huyện</label>
                            <select id="district" class="form-input" onchange="loadWards()">
                                <option value="">Chọn quận/huyện</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Phường/Xã</label>
                            <select id="ward" class="form-input">
                                <option value="">Chọn phường/xã</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Địa chỉ cụ thể</label>
                            <input type="text" id="street" class="form-input" placeholder="Số nhà, tên đường..." />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ghi chú</label>
                        <textarea id="note" class="form-input" rows="3"
                            placeholder="Ghi chú cho đơn hàng (nếu có)..."></textarea>
                    </div>
                </div>

                {{-- PHƯƠNG THỨC THANH TOÁN --}}
                <div class="checkout-box">
                    <h3 class="checkout-box-title">
                        <span class="checkout-step">2</span>
                        Phương thức thanh toán
                    </h3>
                    <div class="payment-methods">
                        <label class="payment-method active" onclick="selectPayment('COD', this)">
                            <input type="radio" name="payment" value="COD" checked />
                            <img src="/assets/images/codMethod.png" alt="COD" />
                            <div>
                                <p class="payment-name">Thanh toán khi nhận hàng</p>
                                <p class="payment-desc">Thanh toán tiền mặt khi nhận hàng</p>
                            </div>
                        </label>
                        <label class="payment-method" onclick="selectPayment('VNPay', this)">
                            <input type="radio" name="payment" value="VNPay" />
                            <img src="/assets/images/logoVnpay.png" alt="VNPay" />
                            <div>
                                <p class="payment-name">VNPay</p>
                                <p class="payment-desc">Thanh toán qua cổng VNPay</p>
                            </div>
                        </label>
                        <label class="payment-method" onclick="selectPayment('MoMo', this)">
                            <input type="radio" name="payment" value="MoMo" />
                            <img src="/assets/images/logoMomo.png" alt="MoMo" />
                            <div>
                                <p class="payment-name">MoMo</p>
                                <p class="payment-desc">Thanh toán qua ví MoMo</p>
                            </div>
                        </label>
                        <label class="payment-method" onclick="selectPayment('ZaloPay', this)">
                            <input type="radio" name="payment" value="ZaloPay" />
                            <img src="/assets/images/logoZaloPay.png" alt="ZaloPay" />
                            <div>
                                <p class="payment-name">ZaloPay</p>
                                <p class="payment-desc">Thanh toán qua ví ZaloPay</p>
                            </div>
                        </label>
                    </div>
                </div>

            </div>

            {{-- TÓM TẮT ĐƠN HÀNG --}}
            <div class="checkout-summary">
                <div class="cart-summary">
                    <h3 class="cart-summary-title">Đơn hàng của bạn</h3>

                    <div id="checkout-items" style="margin-bottom:20px;"></div>

                    <div class="cart-summary-row">
                        <span>Tạm tính</span>
                        <span id="checkout-subtotal">0đ</span>
                    </div>
                    <div class="cart-summary-row">
                        <span>Phí vận chuyển</span>
                        <span id="shipping-fee" style="color:var(--emerald);">Đang tính...</span>
                    </div>
                    <div class="cart-summary-divider"></div>
                    <div class="cart-summary-row cart-summary-total">
                        <span>Tổng cộng</span>
                        <span id="checkout-total">0đ</span>
                    </div>

                    <div id="checkout-error" class="auth-alert auth-alert-error" style="display:none;margin-top:16px;">
                    </div>

                    <button class="btn btn-emerald" style="width:100%;margin-top:24px;justify-content:center;"
                        onclick="placeOrder()">
                        Đặt hàng ngay
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    let selectedPayment = 'COD';
    let cartItems = [];
    let shippingData = {
        fee: 0,
        province_id: null,
        district_id: null,
        ward_code: null
    };

    // ===== LOAD GIỎ HÀNG =====
    async function loadCheckoutCart() {
        const user = getUser();
        if (!user) {
            window.location.href = '/dang-nhap';
            return;
        }

        const res = await cartAPI.get();
        if (!res?.data?.cart_details?.length) {
            window.location.href = '/gio-hang';
            return;
        }

        cartItems = res.data.cart_details;
        const subtotal = res.data.total_money;

        // Điền thông tin user
        document.getElementById('recipient-name').value = user.fullname || '';
        document.getElementById('recipient-phone').value = user.phone || '';

        // Render items
        document.getElementById('checkout-items').innerHTML = cartItems.map(item => {
            const images = Array.isArray(item.product.images) ? item.product.images : JSON.parse(item.product
                .images || '[]');
            const img = images[0] || '/assets/images/default.avif';
            return `
        <div style="display:flex;gap:12px;align-items:center;margin-bottom:12px;">
            <img src="${img}" style="width:60px;height:60px;border-radius:8px;object-fit:cover;" />
            <div style="flex:1;">
                <p style="font-size:13px;font-weight:600;color:var(--dark);">${item.product.name}</p>
                <p style="font-size:12px;color:var(--gray);">x${item.quantity}</p>
            </div>
            <p style="font-weight:600;color:var(--emerald);font-size:14px;">${formatCurrency(item.product.price * item.quantity)}</p>
        </div>`;
        }).join('');

        document.getElementById('checkout-subtotal').textContent = formatCurrency(subtotal);
        document.getElementById('checkout-total').textContent = formatCurrency(subtotal);
    }

    // ===== LOAD TỈNH THÀNH =====
    async function loadProvinces() {
        try {
            const res = await fetch('https://online-gateway.ghn.vn/shiip/public-api/master-data/province', {
                headers: {
                    'Token': '{{ env("REACT_APP_GHN_API_KEY", "") }}'
                }
            });
            const data = await res.json();
            const select = document.getElementById('province');
            (data.data || []).forEach(p => {
                select.innerHTML +=
                    `<option value="${p.ProvinceID}" data-name="${p.ProvinceName}">${p.ProvinceName}</option>`;
            });
        } catch (e) {
            console.log('GHN API chưa cấu hình');
        }
    }

    async function loadDistricts() {
        const provinceSelect = document.getElementById('province');
        const provinceId = provinceSelect.value;
        shippingData.province_id = parseInt(provinceId);
        shippingData.province_name = provinceSelect.options[provinceSelect.selectedIndex].dataset.name;

        document.getElementById('district').innerHTML = '<option value="">Chọn quận/huyện</option>';
        document.getElementById('ward').innerHTML = '<option value="">Chọn phường/xã</option>';

        try {
            const res = await fetch(
                `https://online-gateway.ghn.vn/shiip/public-api/master-data/district?province_id=${provinceId}`, {
                    headers: {
                        'Token': '{{ env("REACT_APP_GHN_API_KEY", "") }}'
                    }
                });
            const data = await res.json();
            const select = document.getElementById('district');
            (data.data || []).forEach(d => {
                select.innerHTML +=
                    `<option value="${d.DistrictID}" data-name="${d.DistrictName}">${d.DistrictName}</option>`;
            });
        } catch (e) {}
    }

    async function loadWards() {
        const districtSelect = document.getElementById('district');
        const districtId = districtSelect.value;
        shippingData.district_id = parseInt(districtId);
        shippingData.district_name = districtSelect.options[districtSelect.selectedIndex].dataset.name;

        document.getElementById('ward').innerHTML = '<option value="">Chọn phường/xã</option>';

        try {
            const res = await fetch(
                `https://online-gateway.ghn.vn/shiip/public-api/master-data/ward?district_id=${districtId}`, {
                    headers: {
                        'Token': '{{ env("REACT_APP_GHN_API_KEY", "") }}'
                    }
                });
            const data = await res.json();
            const select = document.getElementById('ward');
            (data.data || []).forEach(w => {
                select.innerHTML +=
                    `<option value="${w.WardCode}" data-name="${w.WardName}">${w.WardName}</option>`;
            });
        } catch (e) {}
    }

    // ===== CHỌN THANH TOÁN =====
    function selectPayment(method, el) {
        selectedPayment = method;
        document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('active'));
        el.classList.add('active');
    }

    // ===== ĐẶT HÀNG =====
    async function placeOrder() {
        const errorEl = document.getElementById('checkout-error');
        errorEl.style.display = 'none';

        const wardSelect = document.getElementById('ward');
        const wardCode = wardSelect.value;
        const wardName = wardSelect.options[wardSelect.selectedIndex]?.dataset.name || '';

        const orderData = {
            recipient_name: document.getElementById('recipient-name').value,
            recipient_phone: document.getElementById('recipient-phone').value,
            province_name: shippingData.province_name || '',
            province_id: shippingData.province_id || 0,
            district_name: shippingData.district_name || '',
            district_id: shippingData.district_id || 0,
            ward_name: wardName,
            ward_code: wardCode,
            street: document.getElementById('street').value,
            note: document.getElementById('note').value,
            payment_method: selectedPayment === 'COD' ? 'COD' : 'Bank',
            payment_gateway: selectedPayment !== 'COD' ? selectedPayment : null,
        };

        // Validate
        if (!orderData.recipient_name || !orderData.recipient_phone || !orderData.street) {
            errorEl.textContent = 'Vui lòng điền đầy đủ thông tin giao hàng!';
            errorEl.style.display = 'block';
            return;
        }

        const res = await apiFetch('/order', {
            method: 'POST',
            body: JSON.stringify(orderData),
        });

        if (res?.code === 200 || res?.code === 201) {
            if (res.data?.pay_url) {
                window.location.href = res.data.pay_url;
            } else {
                showToast('Đặt hàng thành công!');
                setTimeout(() => window.location.href = '/don-hang', 1500);
            }
        } else {
            errorEl.textContent = res?.message || 'Có lỗi xảy ra! Vui lòng thử lại.';
            errorEl.style.display = 'block';
        }
    }

    loadCheckoutCart();
    loadProvinces();
</script>
@endpush