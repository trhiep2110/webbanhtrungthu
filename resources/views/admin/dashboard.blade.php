@extends('layouts.admin')

@section('content')

{{-- STATS CARDS --}}
<div class="admin-stats">
    <div class="admin-stat-card">
        <div class="admin-stat-icon stat-icon-green">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <p class="admin-stat-value">{{ number_format($totalRevenue, 0, ',', '.') }}đ</p>
            <p class="admin-stat-label">Tổng doanh thu</p>
        </div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-icon stat-icon-yellow">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
        </div>
        <div>
            <p class="admin-stat-value">{{ $totalOrders }}</p>
            <p class="admin-stat-label">Tổng đơn hàng</p>
        </div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-icon stat-icon-blue">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>
        <div>
            <p class="admin-stat-value">{{ $totalUsers }}</p>
            <p class="admin-stat-label">Tổng người dùng</p>
        </div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-icon stat-icon-purple">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
        </div>
        <div>
            <p class="admin-stat-value">{{ $totalProducts }}</p>
            <p class="admin-stat-label">Tổng sản phẩm</p>
        </div>
    </div>
</div>

{{-- BIỂU ĐỒ + ĐƠN HÀNG GẦN ĐÂY --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:24px;">

    {{-- BIỂU ĐỒ DOANH THU --}}
    <div class="admin-chart-box">
        <h3 class="admin-box-title">Doanh thu 6 tháng gần đây</h3>
        <canvas id="revenueChart"></canvas>
    </div>

    {{-- BIỂU ĐỒ ĐƠN HÀNG --}}
    <div class="admin-chart-box">
        <h3 class="admin-box-title">Trạng thái đơn hàng</h3>
        <canvas id="orderChart"></canvas>
    </div>

</div>

{{-- ĐƠN HÀNG GẦN ĐÂY --}}
<div class="admin-chart-box">
    <div class="admin-table-header">
        <h3 class="admin-box-title">Đơn hàng gần đây</h3>
        <a href="/admin/don-hang" class="btn btn-emerald" style="padding:8px 16px;font-size:13px;">Xem tất cả</a>
    </div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Thanh toán</th>
                    <th>Trạng thái</th>
                    <th>Ngày đặt</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr>
                    <td><strong>#{{ $order->id }}</strong></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:8px;">
                            <img src="{{ $order->user->avatar }}" alt=""
                                style="width:32px;height:32px;border-radius:50%;object-fit:cover;" />
                            <span>{{ $order->user->fullname }}</span>
                        </div>
                    </td>
                    <td><strong
                            style="color:var(--emerald);">{{ number_format($order->total_amount, 0, ',', '.') }}đ</strong>
                    </td>
                    <td>{{ $order->payment_method }}</td>
                    <td>
                        @php
                        $statusMap = [
                        'pending' => ['label' => 'Chờ xác nhận', 'class' => 'badge-warning'],
                        'confirmed' => ['label' => 'Đã xác nhận', 'class' => 'badge-info'],
                        'shipping' => ['label' => 'Đang giao', 'class' => 'badge-purple'],
                        'success' => ['label' => 'Hoàn thành', 'class' => 'badge-success'],
                        'canceled' => ['label' => 'Đã hủy', 'class' => 'badge-danger'],
                        ];
                        $status = $statusMap[$order->status] ?? ['label' => $order->status, 'class' => 'badge-gray'];
                        @endphp
                        <span class="badge {{ $status['class'] }}">{{ $status['label'] }}</span>
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@push('scripts')
<script>
// ===== BIỂU ĐỒ DOANH THU =====
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
new Chart(revenueCtx, {
    type: 'bar',
    data: {
        labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6'],
        datasets: [{
            label: 'Doanh thu (đ)',
            data: [12000000, 19000000, 15000000, 25000000, 22000000, 30000000],
            backgroundColor: 'rgba(6, 95, 70, 0.8)',
            borderRadius: 8,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// ===== BIỂU ĐỒ TRẠNG THÁI ĐƠN HÀNG =====
const orderCtx = document.getElementById('orderChart').getContext('2d');
new Chart(orderCtx, {
    type: 'doughnut',
    data: {
        labels: ['Chờ xác nhận', 'Đang giao', 'Hoàn thành', 'Đã hủy'],
        datasets: [{
            data: [{
                    {
                        $recentOrders - > where('status', 'pending') - > count()
                    }
                },
                {
                    {
                        $recentOrders - > where('status', 'shipping') - > count()
                    }
                },
                {
                    {
                        $recentOrders - > where('status', 'success') - > count()
                    }
                },
                {
                    {
                        $recentOrders - > where('status', 'canceled') - > count()
                    }
                },
            ],
            backgroundColor: ['#f59e0b', '#8b5cf6', '#065f46', '#ef4444'],
            borderWidth: 0,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>
@endpush