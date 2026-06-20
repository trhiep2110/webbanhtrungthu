@extends('layouts.app')

@section('title', 'Tài Khoản Của Tôi')

@section('content')

{{-- BANNER --}}
<section class="page-banner" style="background-image: url('/assets/images/home-1.jpg')">
    <div class="page-banner-overlay"></div>
    <div class="page-banner-content">
        <h1>Tài Khoản Của Tôi</h1>
        <p><a href="/">Trang chủ</a> / <span>Tài khoản</span></p>
    </div>
</section>

<section class="profile-section">
    <div class="container">
        <div class="profile-layout">

            {{-- ===== SIDEBAR ===== --}}
            <div class="profile-sidebar">

                {{-- CARD AVATAR --}}
                <div class="profile-avatar-box">
                    <div class="profile-avatar-wrap">
                        <img id="profile-avatar" src="{{ $user->avatar ?? '/assets/images/default.avif' }}"
                            alt="Avatar" />
                        <button class="profile-avatar-edit" type="button"
                            onclick="document.getElementById('avatar-input').click()" title="Đổi ảnh đại diện">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                        <input type="file" id="avatar-input" accept="image/png,image/jpeg,image/webp" hidden />
                    </div>
                    <h3 class="profile-name">{{ $user->fullname }}</h3>
                    <p class="profile-email">{{ $user->email }}</p>
                    <span class="profile-member-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        Thành viên từ {{ $user->created_at?->format('m/Y') ?? '—' }}
                    </span>
                </div>

                {{-- MENU - CHUYỂN TAB BẰNG JS, KHÔNG LOAD LẠI TRANG --}}
                <nav class="profile-nav">
                    <button type="button" class="profile-nav-item active" data-tab="info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Thông tin cá nhân</span>
                    </button>
                    <button type="button" class="profile-nav-item" data-tab="orders">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span>Đơn hàng của tôi</span>
                        @if($orders->count() > 0)
                        <span class="profile-nav-count">{{ $orders->count() }}</span>
                        @endif
                    </button>
                    <button type="button" class="profile-nav-item" data-tab="favorites">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span>Sản phẩm yêu thích</span>
                        @if($favorites->count() > 0)
                        <span class="profile-nav-count">{{ $favorites->count() }}</span>
                        @endif
                    </button>
                    <button type="button" class="profile-nav-item" data-tab="addresses">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Địa chỉ của tôi</span>
                        @if($addresses->count() > 0)
                        <span class="profile-nav-count">{{ $addresses->count() }}</span>
                        @endif
                    </button>
                    <div class="profile-nav-divider"></div>
                    <button type="button" class="profile-nav-item profile-nav-logout logout-trigger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Đăng xuất</span>
                    </button>
                </nav>
            </div>

            {{-- ===== NỘI DUNG: 4 PANEL, JS ẨN/HIỆN ===== --}}
            <div class="profile-content">

                {{-- ===== PANEL 1: THÔNG TIN CÁ NHÂN ===== --}}
                <div class="profile-panel active" id="panel-info">
                    <div class="profile-box">
                        <div class="profile-box-head">
                            <div>
                                <h3 class="profile-box-title">Thông tin cá nhân</h3>
                                <p class="profile-box-subtitle">Cập nhật thông tin liên hệ để giao hàng chính xác hơn
                                </p>
                            </div>
                        </div>

                        <form id="profile-form" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Họ và tên</label>
                                    <input type="text" id="edit-fullname" name="fullname" class="form-input"
                                        value="{{ $user->fullname }}" placeholder="Nhập họ và tên" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="tel" id="edit-phone" name="phone" class="form-input"
                                        value="{{ $user->phone }}" placeholder="Nhập số điện thoại" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <div class="input-with-badge">
                                    <input type="email" id="edit-email" class="form-input" value="{{ $user->email }}"
                                        disabled />
                                    @if($user->is_verify)
                                    <span class="badge badge-success input-badge">Đã xác thực</span>
                                    @else
                                    <span class="badge badge-warning input-badge">Chưa xác thực</span>
                                    @endif
                                </div>
                                <p class="form-hint">Email không thể thay đổi sau khi đăng ký</p>
                            </div>
                            <div class="profile-form-actions">
                                <button type="submit" class="btn btn-emerald" id="save-profile-btn">Lưu thay
                                    đổi</button>
                            </div>
                        </form>
                    </div>

                    <div class="profile-box" style="margin-top:24px;">
                        <div class="profile-box-head">
                            <div>
                                <h3 class="profile-box-title">Đổi mật khẩu</h3>
                                <p class="profile-box-subtitle">Nên đặt mật khẩu mạnh, không dùng lại ở nơi khác</p>
                            </div>
                        </div>

                        <form id="password-form" novalidate>
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Mật khẩu hiện tại</label>
                                <div class="input-password">
                                    <input type="password" id="current-pwd" name="current_password" class="form-input"
                                        placeholder="Nhập mật khẩu hiện tại" />
                                    <button type="button" data-target="current-pwd" class="password-toggle">
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
                                        <input type="password" id="new-pwd" name="new_password" class="form-input"
                                            placeholder="Ít nhất 6 ký tự" />
                                        <button type="button" data-target="new-pwd" class="password-toggle">
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
                                        <input type="password" id="confirm-pwd" name="new_password_confirmation"
                                            class="form-input" placeholder="Nhập lại mật khẩu mới" />
                                        <button type="button" data-target="confirm-pwd" class="password-toggle">
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
                            <div class="profile-form-actions">
                                <button type="submit" class="btn btn-emerald" id="save-password-btn">Đổi mật
                                    khẩu</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- ===== PANEL 2: ĐƠN HÀNG ===== --}}
                <div class="profile-panel" id="panel-orders">
                    <div class="profile-box">
                        <div class="profile-box-head">
                            <div>
                                <h3 class="profile-box-title">Đơn hàng của tôi</h3>
                                <p class="profile-box-subtitle">Theo dõi trạng thái và lịch sử mua hàng</p>
                            </div>
                        </div>

                        @if($orders->count() > 0)
                        <div class="order-tabs">
                            <button class="order-tab active" data-status="all">Tất cả</button>
                            <button class="order-tab" data-status="pending">Chờ xác nhận</button>
                            <button class="order-tab" data-status="shipping">Đang giao</button>
                            <button class="order-tab" data-status="success">Hoàn thành</button>
                            <button class="order-tab" data-status="canceled">Đã hủy</button>
                        </div>

                        <div id="orders-list">
                            @php
                            $statusMap = [
                            'pending' => ['label' => 'Chờ xác nhận', 'color' => '#f59e0b', 'bg' => '#fef3c7'],
                            'confirmed' => ['label' => 'Đã xác nhận', 'color' => '#3b82f6', 'bg' => '#dbeafe'],
                            'shipping' => ['label' => 'Đang giao hàng', 'color' => '#8b5cf6', 'bg' => '#ede9fe'],
                            'success' => ['label' => 'Hoàn thành', 'color' => '#065f46', 'bg' => '#d1fae5'],
                            'canceled' => ['label' => 'Đã hủy', 'color' => '#ef4444', 'bg' => '#fee2e2'],
                            'reject' => ['label' => 'Từ chối', 'color' => '#ef4444', 'bg' => '#fee2e2'],
                            ];
                            @endphp
                            @foreach($orders as $order)
                            @php $status = $statusMap[$order->status] ?? ['label' => $order->status, 'color' =>
                            '#6b7280', 'bg' => '#f3f4f6']; @endphp
                            <div class="order-card" data-status="{{ $order->status }}">
                                <div class="order-card-header">
                                    <div>
                                        <p class="order-id">#{{ $order->id }}</p>
                                        <p class="order-date">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <span class="order-status-badge"
                                        style="color:{{ $status['color'] }};background:{{ $status['bg'] }};">
                                        {{ $status['label'] }}
                                    </span>
                                </div>
                                <div class="order-card-body">
                                    @foreach($order->cartDetails->take(2) as $detail)
                                    @php
                                    $images = is_array($detail->product->images ?? null) ? $detail->product->images :
                                    json_decode($detail->product->images ?? '[]', true);
                                    $img = $images[0] ?? '/assets/images/default.avif';
                                    @endphp
                                    <div class="order-product-item">
                                        <img src="{{ $img }}" alt="{{ $detail->product->name ?? '' }}" />
                                        <div>
                                            <p class="order-product-name">{{ $detail->product->name ?? '' }}</p>
                                            <p class="order-product-qty">x{{ $detail->quantity }}</p>
                                        </div>
                                        <p class="order-product-price">
                                            {{ number_format(($detail->product->price ?? 0) * $detail->quantity, 0, ',', '.') }}đ
                                        </p>
                                    </div>
                                    @endforeach
                                    @if($order->cartDetails->count() > 2)
                                    <p style="color:var(--gray);font-size:13px;text-align:center;padding:8px 0;">
                                        +{{ $order->cartDetails->count() - 2 }} sản phẩm khác</p>
                                    @endif
                                </div>
                                <div class="order-card-footer">
                                    <div>
                                        <span style="color:var(--gray);font-size:13px;">Tổng tiền: </span>
                                        <span
                                            style="color:var(--emerald);font-weight:700;font-size:18px;">{{ number_format($order->total_amount, 0, ',', '.') }}đ</span>
                                    </div>
                                    @if($order->status === 'pending')
                                    <button class="btn-sm btn-red cancel-order-btn" data-id="{{ $order->id }}">Hủy
                                        đơn</button>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="profile-empty">
                            <img src="/assets/images/orderEmpty.png" alt="Không có đơn hàng" />
                            <p>Bạn chưa có đơn hàng nào!</p>
                            <a href="/san-pham" class="btn btn-emerald">Mua sắm ngay</a>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- ===== PANEL 3: YÊU THÍCH ===== --}}
                <div class="profile-panel" id="panel-favorites">
                    <div class="profile-box">
                        <div class="profile-box-head">
                            <div>
                                <h3 class="profile-box-title">Sản phẩm yêu thích</h3>
                                <p class="profile-box-subtitle">Danh sách sản phẩm bạn đã lưu để mua sau</p>
                            </div>
                        </div>

                        @if($favorites->count() > 0)
                        <div class="favorites-grid" id="favorites-list">
                            @foreach($favorites as $fav)
                            @php
                            $product = $fav->product;
                            $images = is_array($product->images ?? null) ? $product->images :
                            json_decode($product->images ?? '[]', true);
                            $img = $images[0] ?? '/assets/images/default.avif';
                            @endphp
                            <div class="favorite-card" data-fav-id="{{ $fav->id }}">
                                <a href="/san-pham/{{ $product->id }}" class="favorite-img-wrap">
                                    <img src="{{ $img }}" alt="{{ $product->name }}" />
                                </a>
                                <div class="favorite-info">
                                    <p class="favorite-category">{{ $product->category->name ?? '' }}</p>
                                    <a href="/san-pham/{{ $product->id }}"
                                        class="favorite-name">{{ $product->name }}</a>
                                    <p class="favorite-price">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                                </div>
                                <button class="favorite-remove-btn" data-id="{{ $fav->id }}" title="Xóa khỏi yêu thích">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="profile-empty">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="none"
                                viewBox="0 0 24 24" stroke="#d1d5db" style="margin:0 auto;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <p>Bạn chưa có sản phẩm yêu thích nào!</p>
                            <a href="/san-pham" class="btn btn-emerald">Khám phá sản phẩm</a>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- ===== PANEL 4: ĐỊA CHỈ ===== --}}
                <div class="profile-panel" id="panel-addresses">
                    <div class="profile-box">
                        <div class="profile-box-head">
                            <div>
                                <h3 class="profile-box-title">Địa chỉ của tôi</h3>
                                <p class="profile-box-subtitle">Quản lý các địa chỉ giao hàng đã lưu</p>
                            </div>
                            <button type="button" class="btn btn-emerald" id="add-address-btn"
                                style="padding:10px 20px;font-size:14px;">+ Thêm địa chỉ</button>
                        </div>

                        <div id="addresses-list" class="addresses-grid">
                            @forelse($addresses as $addr)
                            <div class="address-card" data-id="{{ $addr->id }}">
                                <div class="address-card-head">
                                    <p class="address-name">{{ $addr->name }}</p>
                                    <button class="address-delete-btn" data-id="{{ $addr->id }}" title="Xóa địa chỉ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                                <p class="address-phone">{{ $addr->phone }}</p>
                                <p class="address-detail">{{ $addr->street }}, {{ $addr->ward_name }},
                                    {{ $addr->district_name }}, {{ $addr->province_name }}
                                </p>
                            </div>
                            @empty
                            <div class="profile-empty" style="grid-column:1/-1;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="none"
                                    viewBox="0 0 24 24" stroke="#d1d5db" style="margin:0 auto;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p>Bạn chưa lưu địa chỉ nào!</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- ===== MODAL THÊM ĐỊA CHỈ ===== --}}
<div id="address-modal" class="admin-modal" style="display:none;">
    <div class="admin-modal-overlay" id="address-modal-overlay"></div>
    <div class="admin-modal-box" style="width:600px;">
        <div class="admin-modal-header">
            <h3>Thêm địa chỉ mới</h3>
            <button type="button" class="admin-modal-close" id="address-modal-close">✕</button>
        </div>
        <div class="admin-modal-body">
            <form id="address-form" novalidate>
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Họ tên người nhận</label>
                        <input type="text" id="addr-name" class="form-input" placeholder="Nhập họ tên" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Số điện thoại</label>
                        <input type="tel" id="addr-phone" class="form-input" placeholder="Nhập số điện thoại" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tỉnh/Thành phố</label>
                        <select id="addr-province" class="form-input">
                            <option value="">Chọn tỉnh/thành phố</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Quận/Huyện</label>
                        <select id="addr-district" class="form-input">
                            <option value="">Chọn quận/huyện</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Phường/Xã</label>
                        <select id="addr-ward" class="form-input">
                            <option value="">Chọn phường/xã</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Địa chỉ cụ thể</label>
                        <input type="text" id="addr-street" class="form-input" placeholder="Số nhà, tên đường..." />
                    </div>
                </div>
            </form>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="btn-outline-emerald" id="address-cancel-btn">Hủy</button>
            <button type="button" class="btn btn-emerald" id="save-address-btn">Lưu địa chỉ</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('assets/clients/js/custom.js') }}"></script>
@endpush