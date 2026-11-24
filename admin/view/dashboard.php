<?php

$chartLabels = array_map(fn($r) => date('d/m', strtotime($r['order_date'])), $revenueChart);
$chartValues = array_map(fn($r) => (float) $r['daily_revenue'], $revenueChart);
?>

<h1 class="h4 fw-bold mb-4">Tổng quan hệ thống</h1>

<!-- 6 THẺ THỐNG KÊ TỪ DATABASE -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body">
                <div class="small text-muted mb-1">Sản phẩm</div>
                <div class="h4 fw-bold mb-0"><?= (int) $stats['total_products'] ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body">
                <div class="small text-muted mb-1">Danh mục</div>
                <div class="h4 fw-bold mb-0"><?= (int) $stats['total_categories'] ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body">
                <div class="small text-muted mb-1">Đơn hàng</div>
                <div class="h4 fw-bold text-primary mb-0"><?= (int) $stats['total_orders'] ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body">
                <div class="small text-muted mb-1">Khách hàng</div>
                <div class="h4 fw-bold mb-0"><?= (int) $stats['total_customers'] ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body">
                <div class="small text-muted mb-1">Nhân viên</div>
                <div class="h4 fw-bold mb-0"><?= (int) $stats['total_employees'] ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card stat-card shadow-sm h-100 border-start border-4 border-danger">
            <div class="card-body">
                <div class="small text-muted mb-1">Tổng doanh thu</div>
                <div class="h6 fw-bold text-danger mb-0"><?= viewPrice($stats['total_revenue']) ?></div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- BIỂU ĐỒ DOANH THU -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h2 class="h6 fw-bold mb-3">Biểu đồ doanh thu theo ngày</h2>
                <canvas id="revenueChart" data-labels="<?= viewE(json_encode($chartLabels)) ?>" data-values="<?= viewE(json_encode($chartValues)) ?>" height="220"></canvas>
            </div>
        </div>
    </div>

    <!-- ĐƠN HÀNG MỚI NHẤT -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h6 fw-bold mb-0">Đơn hàng mới nhất</h2>
                    <a href="<?= viewUrl('/admin/orders') ?>" class="btn btn-sm btn-outline-danger">Xem tất cả</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle small mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Mã đơn</th>
                                <th>Khách nhận</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái đơn</th>
                                <th>Thanh toán</th>
                                <th>Nhân viên</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($latestOrders)): ?>
                                <?php foreach ($latestOrders as $order): ?>
                                    <?php
                                    $orderBadge   = viewOrderStatusBadge($order['status']);
                                    $paymentBadge = viewPaymentStatusBadge($order['payment_status'] ?? 'unpaid');
                                    ?>
                                    <tr>
                                        <td class="fw-semibold">
                                            <a href="<?= viewUrl('/admin/orders/' . (int) $order['id']) ?>" class="text-danger text-decoration-none">
                                                #<?= viewE($order['order_code']) ?>
                                            </a>
                                        </td>
                                        <td><?= viewE($order['receiver_name']) ?></td>
                                        <td class="fw-bold text-danger"><?= viewPrice($order['total_amount']) ?></td>
                                        <td><span class="badge <?= $orderBadge['class'] ?>"><?= $orderBadge['label'] ?></span></td>
                                        <td><span class="badge <?= $paymentBadge['class'] ?>"><?= $paymentBadge['label'] ?></span></td>
                                        <td><?= viewE($order['employee_name'] ?: 'Chưa giao') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="text-center text-muted py-3">Chưa có đơn hàng nào.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script src="<?= viewAsset('js/pages/dashboard.js') ?>"></script>
