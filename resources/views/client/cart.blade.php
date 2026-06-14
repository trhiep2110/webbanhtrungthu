@extends('layouts.app')

@section('content')

{{-- BANNER --}}
<section class="page-banner" style="background-image: url('/assets/images/product-filter.jpg')">
    <div class="page-banner-overlay"></div>
    <div class="page-banner-content">
        <h1>Giỏ Hàng</h1>
        <p><a href="/">Trang chủ</a> / <span>Giỏ hàng</span></p>
    </div>
</section>

{{-- NỘI DUNG --}}
<section class="cart-section">
    <div class="container">

        {{-- LOADING --}}
        <div id="cart-loading" style="text-align:center;padding:60px 0;">
            <p style="color:var(--gray);font-size:18px;">Đang tải giỏ hàng...</p>
        </div>

        {{-- GIỎ HÀNG TRỐNG --}}
        <div id="cart-empty" style="display:none;text-align:center;padding:60px 0;">
            <img src="/assets/images/orderEmpty.png" alt="Giỏ hàng trống" style="width:200px;margin-bottom:24px;" />
            <p style="color:var(--gray);font-size:18px;margin-bottom:24px;">Giỏ hàng của bạn đang trống!</p>
            <a href="/san-pham" class="btn btn-emerald">Tiếp tục mua sắm</a>
        </div>

        {{-- NỘI DUNG GIỎ HÀNG --}}
        <div id="cart-content" style="display:none;">
            <div class="cart-layout">

                {{-- DANH SÁCH SẢN PHẨM --}}
                <div class="cart-items">
                    <div class="cart-header">
                        <span>Sản phẩm</span>
                        <span>Đơn giá</span>
                        <span>Số lượng</span>
                        <span>Thành tiền</span>
                        <span></span>
                    </div>
                    <div id="cart-items-list"></div>
                </div>

                {{-- TỔNG TIỀN --}}
                <div class="cart-summary">
                    <h3 class="cart-summary-title">Tóm tắt đơn hàng</h3>

                    <div class="cart-summary-row">
                        <span>Tạm tính</span>
                        <span id="subtotal">0đ</span>
                    </div>
                    <div class="cart-summary-row">
                        <span>Phí vận chuyển</span>
                        <span style="color:var(--emerald);">Tính khi thanh toán</span>
                    </div>
                    <div class="cart-summary-divider"></div>
                    <div class="cart-summary-row cart-summary-total">
                        <span>Tổng cộng</span>
                        <span id="total-price">0đ</span>
                    </div>

                    <a href="/thanh-toan" class="btn btn-emerald"
                        style="width:100%;margin-top:24px;justify-content:center;">
                        Tiến hành thanh toán
                    </a>
                    <a href="/san-pham" class="btn btn-outline-emerald"
                        style="width:100%;margin-top:12px;justify-content:center;">
                        Tiếp tục mua sắm
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    let cartData = null;

    async function loadCart() {
        const user = getUser();
        if (!user) {
            window.location.href = '/dang-nhap';
            return;
        }

        const res = await cartAPI.get();
        const loadingEl = document.getElementById('cart-loading');
        const emptyEl = document.getElementById('cart-empty');
        const contentEl = document.getElementById('cart-content');

        loadingEl.style.display = 'none';

        if (!res?.data?.cart_details || res.data.cart_details.length === 0) {
            emptyEl.style.display = 'block';
            return;
        }

        cartData = res.data;
        contentEl.style.display = 'block';
        renderCartItems(cartData.cart_details);
        updateSummary(cartData.total_money);
    }

    function renderCartItems(items) {
        const container = document.getElementById('cart-items-list');
        container.innerHTML = items.map(item => {
            const images = Array.isArray(item.product.images) ?
                item.product.images :
                JSON.parse(item.product.images || '[]');
            const img = images[0] || '/assets/images/default.avif';
            const total = item.product.price * item.quantity;

            return `
        <div class="cart-item" id="cart-item-${item.id}">
            <div class="cart-item-product">
                <img src="${img}" alt="${item.product.name}" class="cart-item-img" />
                <div>
                    <a href="/san-pham/${item.product.id}" class="cart-item-name">${item.product.name}</a>
                    <p class="cart-item-category">${item.product.category?.name || ''}</p>
                </div>
            </div>
            <p class="cart-item-price">${formatCurrency(item.product.price)}</p>
            <div class="cart-item-qty">
                <button onclick="updateQty(${item.id}, ${item.quantity - 1})">−</button>
                <span>${item.quantity}</span>
                <button onclick="updateQty(${item.id}, ${item.quantity + 1})">+</button>
            </div>
            <p class="cart-item-total">${formatCurrency(total)}</p>
            <button class="cart-item-remove" onclick="removeItem(${item.id})">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        </div>`;
        }).join('');
    }

    function updateSummary(total) {
        document.getElementById('subtotal').textContent = formatCurrency(total);
        document.getElementById('total-price').textContent = formatCurrency(total);
    }

    async function updateQty(detailId, newQty) {
        if (newQty < 1) {
            removeItem(detailId);
            return;
        }
        const res = await cartAPI.update(detailId, newQty);
        if (res?.code === 200) {
            loadCart();
            updateCartCount();
        } else {
            showToast(res?.message || 'Có lỗi xảy ra!', 'error');
        }
    }

    async function removeItem(detailId) {
        const res = await cartAPI.remove(detailId);
        if (res?.code === 200) {
            showToast('Đã xóa sản phẩm khỏi giỏ hàng!');
            loadCart();
            updateCartCount();
        } else {
            showToast('Có lỗi xảy ra!', 'error');
        }
    }

    loadCart();
</script>
@endpush