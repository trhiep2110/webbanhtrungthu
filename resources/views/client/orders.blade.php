@extends('layouts.app')

@section('content')

{{-- BANNER --}}
<section class="page-banner" style="background-image: url('/assets/images/home-1.jpg')">
    <div class="page-banner-overlay"></div>
    <div class="page-banner-content">
        <h1>Đơn Hàng Của Tôi</h1>
        <p><a href="/">Trang chủ</a> / <a href="/profile">Trang cá nhân</a> / <span>Đơn hàng</span></p>
    </div>
</section>

<section class="profile-section">
    <div class="container">
        <div class="profile-layout">

            {{-- SIDEBAR --}}
            <div class="profile-sidebar">
                <div class="profile-avatar-box">
                    <div class="profile-avatar-wrap">
                        <img id="profile-avatar" src="/assets/images/default.avif" alt="Avatar" />
                    </div>
                    <h3 id="profile-name" style="font-size:18px;font-weight:700;margin-top:16px;">Đang tải...</h3>
                    <p id="profile-email" style="color:var(--gray);font-size:14px;margin-top:4px;"></p>
                </div>
                <nav class="profile-nav">
                    <a href="/profile" class="profile-nav-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Thông tin cá nhân
                    </a>
                    <a href="/don-hang" class="profile-nav-item active">
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
                    <h3 class="profile-box-title">Đơn Hàng Của Tôi</h3>

                    {{-- TAB TRẠNG THÁI --}}
                    <div class="order-tabs">
                        <button class="order-tab active" onclick="filterOrders('all', this)">Tất cả</button>
                        <button class="order-tab" onclick="filterOrders('pending', this)">Chờ xác nhận</button>
                        <button class="order-tab" onclick="filterOrders('confirmed', this)">Đã xác nhận</button>
                        <button class="order-tab" onclick="filterOrders('shipping', this)">Đang giao</button>
                        <button class="order-tab" onclick="filterOrders('success', this)">Hoàn thành</button>
                        <button class="order-tab" onclick="filterOrders('canceled', this)">Đã hủy</button>
                    </div>

                    {{-- DANH SÁCH ĐƠN HÀNG --}}
                    <div id="orders-loading" style="text-align:center;padding:40px;">
                        <p style="color:var(--gray);">Đang tải đơn hàng...</p>
                    </div>
                    <div id="orders-empty" style="display:none;text-align:center;padding:40px;">
                        <img src="/assets/images/orderEmpty.png" alt="Không có đơn hàng"
                            style="width:150px;margin-bottom:16px;" />
                        <p style="color:var(--gray);">Bạn chưa có đơn hàng nào!</p>
                        <a href="/san-pham" class="btn btn-emerald" style="margin-top:16px;">Mua sắm ngay</a>
                    </div>
                    <div id="orders-list"></div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    let allOrders = [];
    let currentFilter = 'all';

    const statusMap = {
        pending: {
            label: 'Chờ xác nhận',
            color: '#f59e0b',
            bg: '#fef3c7'
        },
        confirmed: {
            label: 'Đã xác nhận',
            color: '#3b82f6',
            bg: '#dbeafe'
        },
        shipping: {
            label: 'Đang giao hàng',
            color: '#8b5cf6',
            bg: '#ede9fe'
        },
        success: {
            label: 'Hoàn thành',
            color: '#065f46',
            bg: '#d1fae5'
        },
        canceled: {
            label: 'Đã hủy',
            color: '#ef4444',
            bg: '#fee2e2'
        },
        reject: {
            label: 'Từ chối',
            color: '#ef4444',
            bg: '#fee2e2'
        },
    };

    async function loadOrders() {
        const user = getUser();
        if (!user) {
            window.location.href = '/dang-nhap';
            return;
        }

        document.getElementById('profile-name').textContent = user.fullname;
        document.getElementById('profile-email').textContent = user.email;
        document.getElementById('profile-avatar').src = user.avatar || '/assets/images/default.avif';

        const res = await apiFetch('/order/my-orders');
        document.getElementById('orders-loading').style.display = 'none';

        if (!res?.data?.orders?.length) {
            document.getElementById('orders-empty').style.display = 'block';
            return;
        }

        allOrders = res.data.orders;
        renderOrders(allOrders);
    }

    function renderOrders(orders) {
        const container = document.getElementById('orders-list');
        if (!orders.length) {
            container.innerHTML = '';
            document.getElementById('orders-empty').style.display = 'block';
            return;
        }
        document.getElementById('orders-empty').style.display = 'none';
        container.innerHTML = orders.map(order => {
            const status = statusMap[order.status] || {
                label: order.status,
                color: '#6b7280',
                bg: '#f3f4f6'
            };
            return `
        <div class="order-card">
            <div class="order-card-header">
                <div>
                    <p class="order-id">#${order.id}</p>
                    <p class="order-date">${new Date(order.created_at).toLocaleDateString('vi-VN')}</p>
                </div>
                <span class="order-status-badge" style="color:${status.color};background:${status.bg};">
                    ${status.label}
                </span>
            </div>
            <div class="order-card-body">
                ${(order.cart_details || []).slice(0, 2).map(detail => {
                    const images = Array.isArray(detail.product?.images) ? detail.product.images : JSON.parse(detail.product?.images || '[]');
                    const img = images[0] || '/assets/images/default.avif';
                    return `
                    <div class="order-product-item">
                        <img src="${img}" alt="${detail.product?.name}" />
                        <div>
                            <p class="order-product-name">${detail.product?.name || ''}</p>
                            <p class="order-product-qty">x${detail.quantity}</p>
                        </div>
                        <p class="order-product-price">${formatCurrency(detail.product?.price * detail.quantity)}</p>
                    </div>`;
                }).join('')}
                ${order.cart_details?.length > 2 ? `<p style="color:var(--gray);font-size:13px;text-align:center;padding:8px 0;">+${order.cart_details.length - 2} sản phẩm khác</p>` : ''}
            </div>
            <div class="order-card-footer">
                <div>
                    <span style="color:var(--gray);font-size:13px;">Tổng tiền: </span>
                    <span style="color:var(--emerald);font-weight:700;font-size:18px;">${formatCurrency(order.total_amount)}</span>
                </div>
                <div style="display:flex;gap:8px;">
                    ${order.status === 'pending' ? `<button class="btn-sm btn-red" onclick="cancelOrder(${order.id})">Hủy đơn</button>` : ''}
                    ${order.status === 'success' ? `<button class="btn-sm btn-emerald-sm" onclick="reorder(${order.id})">Mua lại</button>` : ''}
                </div>
            </div>
        </div>`;
        }).join('');
    }

    function filterOrders(status, btn) {
        currentFilter = status;
        document.querySelectorAll('.order-tab').forEach(t => t.classList.remove('active'));
        btn.classList.add('active');
        const filtered = status === 'all' ? allOrders : allOrders.filter(o => o.status === status);
        renderOrders(filtered);
    }

    async function cancelOrder(orderId) {
        if (!confirm('Bạn có chắc muốn hủy đơn hàng này?')) return;
        const res = await apiFetch(`/order/${orderId}/cancel`, {
            method: 'PUT'
        });
        if (res?.code === 200) {
            showToast('Hủy đơn hàng thành công!');
            loadOrders();
        } else {
            showToast(res?.message || 'Có lỗi xảy ra!', 'error');
        }
    }

    async function reorder(orderId) {
        showToast('Tính năng đang phát triển!');
    }

    function handleLogout() {
        localStorage.removeItem('access_token');
        localStorage.removeItem('user');
        window.location.href = '/';
    }

    loadOrders();
</script>
@endpush