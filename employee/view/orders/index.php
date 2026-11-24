<?php

?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h1 class="h4 fw-bold mb-1">Đơn hàng được phân công cho bạn</h1>
        <p class="text-muted small mb-0">Hiện có <strong><?= (int) $totalItems ?></strong> đơn hàng thuộc trách nhiệm xử lý của bạn</p>
    </div>
</div>

<!-- TÌM KIẾM & LỌC -->
<form action="<?= viewUrl('/employee/orders') ?>" method="GET" class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="row g-3 align-items-end">
            <div class="col-md-5">
                <label class="form-label small fw-semibold">Tìm kiếm (Mã đơn, Tên hoặc SĐT khách)</label>
                <input
                    type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Nhập từ khóa..."
                    value="<?= viewE($filters['keyword'] ?? '') ?>"
                >
            </div>

            <div class="col-md-4">
                <label class="form-label small fw-semibold">Lọc theo trạng thái đơn</label>
                <select name="status" class="form-select">
                    <option value="">Tất cả trạng thái</option>
                    <option value="pending"   <?= ($filters['status'] ?? '') === 'pending'   ? 'selected' : '' ?>>Chờ xác nhận</option>
                    <option value="confirmed" <?= ($filters['status'] ?? '') === 'confirmed' ? 'selected' : '' ?>>Đã xác nhận</option>
                    <option value="shipping"  <?= ($filters['status'] ?? '') === 'shipping'  ? 'selected' : '' ?>>Đang giao hàng</option>
                    <option value="delivered" <?= ($filters['status'] ?? '') === 'delivered' ? 'selected' : '' ?>>Đã giao hàng</option>
                    <option value="cancelled" <?= ($filters['status'] ?? '') === 'cancelled' ? 'selected' : '' ?>>Đã hủy</option>
                </select>
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search me-1"></i>Tìm kiếm</button>
                <a href="<?= viewUrl('/employee/orders') ?>" class="btn btn-outline-secondary">Đặt lại</a>
            </div>
        </div>
    </div>
</form>

<!-- DANH SÁCH ĐƠN ĐƯỢC GIAO -->
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small text-uppercase">
                <tr>
                    <th>Mã đơn</th>
                    <th>Người nhận</th>
                    <th class="text-end">Tổng tiền</th>
                    <th>Thanh toán</th>
                    <th>Trạng thái đơn</th>
                    <th>Thời gian nhận việc</th>
                    <th class="text-end">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <?php
                        $orderBadge   = viewOrderStatusBadge($order['status'] ?? 'pending');
                        $paymentBadge = viewPaymentStatusBadge($order['payment_status'] ?? 'unpaid');
                        $methodText   = ($order['payment_method'] ?? 'cod') === 'qr_simulation' ? 'QR mô phỏng' : 'COD';
                        ?>
                        <tr>
                            <td class="fw-bold text-danger">#<?= viewE($order['order_code']) ?></td>
                            <td>
                                <div class="fw-semibold"><?= viewE($order['receiver_name']) ?></div>
                                <div class="small text-muted"><?= viewE($order['receiver_phone']) ?></div>
                            </td>
                            <td class="text-end fw-bold text-danger"><?= viewPrice($order['total_amount']) ?></td>
                            <td>
                                <div class="small text-muted mb-1"><?= viewE($methodText) ?></div>
                                <span class="badge <?= viewE($paymentBadge['class']) ?>">
                                    <?= viewE($paymentBadge['label']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge <?= viewE($orderBadge['class']) ?>">
                                    <?= viewE($orderBadge['label']) ?>
                                </span>
                            </td>
                            <td class="small text-muted">
                                <?= viewE(date('d/m/Y H:i', strtotime($order['assigned_at']))) ?>
                            </td>
                            <td class="text-end">
                                <a href="<?= viewUrl('/employee/orders/' . (int) $order['id']) ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-clipboard-check me-1"></i>Xem &amp; Xử lý
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center text-muted py-4">Không có đơn hàng nào đang được phân công cho bạn.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if ($totalPages > 1): ?>
    <nav class="mt-4 d-flex justify-content-center">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php
                $url = viewUrl('/employee/orders') . '?' . http_build_query(array_filter([
                    'keyword' => $filters['keyword'] ?? '',
                    'status'  => $filters['status'] ?? '',
                    'page'    => $i,
                ], fn($v) => $v !== '' && $v !== null));
                ?>
                <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                    <a class="page-link" href="<?= viewE($url) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>
