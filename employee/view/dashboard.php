<?php

?>

<h1 class="h4 fw-bold mb-4">Tổng quan đơn hàng được phân công</h1>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-4 col-xl">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body">
                <div class="small text-muted mb-1">Đang phụ trách</div>
                <div class="h4 fw-bold mb-0"><?= (int) $stats['total_assigned'] ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body">
                <div class="small text-muted mb-1">Chờ xác nhận</div>
                <div class="h4 fw-bold text-warning mb-0"><?= (int) $stats['pending_count'] ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body">
                <div class="small text-muted mb-1">Đã xác nhận</div>
                <div class="h4 fw-bold text-info mb-0"><?= (int) $stats['confirmed_count'] ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-6 col-xl">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body">
                <div class="small text-muted mb-1">Đang giao hàng</div>
                <div class="h4 fw-bold text-primary mb-0"><?= (int) $stats['shipping_count'] ?></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body">
                <div class="small text-muted mb-1">Đã giao hàng</div>
                <div class="h4 fw-bold text-success mb-0"><?= (int) $stats['delivered_count'] ?></div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h6 fw-bold mb-0">Đơn hàng được giao gần đây</h2>
            <a href="<?= viewUrl('/employee/orders') ?>" class="btn btn-sm btn-outline-primary">Xem danh sách đơn được giao</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle small mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Mã đơn</th>
                        <th>Khách nhận</th>
                        <th>SĐT</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái đơn</th>
                        <th>Thanh toán</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($recentOrders)): ?>
                        <?php foreach ($recentOrders as $order): ?>
                            <?php
                            $orderBadge   = viewOrderStatusBadge($order['status']);
                            $paymentBadge = viewPaymentStatusBadge($order['payment_status'] ?? 'unpaid');
                            ?>
                            <tr>
                                <td class="fw-semibold">
                                    <a href="<?= viewUrl('/employee/orders/' . (int) $order['id']) ?>" class="text-danger text-decoration-none">
                                        #<?= viewE($order['order_code']) ?>
                                    </a>
                                </td>
                                <td><?= viewE($order['receiver_name']) ?></td>
                                <td><?= viewE($order['receiver_phone']) ?></td>
                                <td class="fw-bold text-danger"><?= viewPrice($order['total_amount']) ?></td>
                                <td><span class="badge <?= $orderBadge['class'] ?>"><?= $orderBadge['label'] ?></span></td>
                                <td><span class="badge <?= $paymentBadge['class'] ?>"><?= $paymentBadge['label'] ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center text-muted py-4">Bạn chưa được phân công đơn hàng nào.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
