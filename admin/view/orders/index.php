<?php

?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h1 class="h4 fw-bold mb-1">Quản lý đơn hàng</h1>
        <p class="text-muted small mb-0">Tổng số: <strong><?= (int) $totalItems ?></strong> đơn hàng</p>
    </div>
</div>

<!-- BỘ LỌC TÌM KIẾM ĐƠN HÀNG -->
<form action="<?= viewUrl('/admin/orders') ?>" method="GET" class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label small fw-semibold">Tìm kiếm</label>
                <input
                    type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Mã đơn, tên hoặc SĐT nhận..."
                    value="<?= viewE($filters['keyword'] ?? '') ?>"
                >
            </div>

            <div class="col-md-2">
                <label class="form-label small fw-semibold">Trạng thái đơn</label>
                <select name="status" class="form-select">
                    <option value="">Tất cả</option>
                    <option value="pending"   <?= ($filters['status'] ?? '') === 'pending'   ? 'selected' : '' ?>>Chờ xác nhận</option>
                    <option value="confirmed" <?= ($filters['status'] ?? '') === 'confirmed' ? 'selected' : '' ?>>Đã xác nhận</option>
                    <option value="shipping"  <?= ($filters['status'] ?? '') === 'shipping'  ? 'selected' : '' ?>>Đang giao hàng</option>
                    <option value="delivered" <?= ($filters['status'] ?? '') === 'delivered' ? 'selected' : '' ?>>Đã giao hàng</option>
                    <option value="cancelled" <?= ($filters['status'] ?? '') === 'cancelled' ? 'selected' : '' ?>>Đã hủy</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label small fw-semibold">Trạng thái thanh toán</label>
                <select name="payment_status" class="form-select">
                    <option value="">Tất cả</option>
                    <option value="unpaid"              <?= ($filters['payment_status'] ?? '') === 'unpaid'              ? 'selected' : '' ?>>Chưa thanh toán</option>
                    <option value="paid"                <?= ($filters['payment_status'] ?? '') === 'paid'                ? 'selected' : '' ?>>Đã thanh toán (COD)</option>
                    <option value="simulated_confirmed" <?= ($filters['payment_status'] ?? '') === 'simulated_confirmed' ? 'selected' : '' ?>>Đã xác nhận QR mô phỏng</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label small fw-semibold">Phân công NV</label>
                <select name="assignment" class="form-select">
                    <option value="">Tất cả</option>
                    <option value="unassigned" <?= ($filters['assignment'] ?? '') === 'unassigned' ? 'selected' : '' ?>>Chưa phân công</option>
                    <option value="assigned"   <?= ($filters['assignment'] ?? '') === 'assigned'   ? 'selected' : '' ?>>Đã phân công</option>
                </select>
            </div>

            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-dtd w-100"><i class="bi bi-search me-1"></i>Lọc</button>
                <a href="<?= viewUrl('/admin/orders') ?>" class="btn btn-outline-secondary" title="Đặt lại">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            </div>
        </div>
    </div>
</form>

<!-- DANH SÁCH ĐƠN HÀNG -->
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
                    <th>Nhân viên phụ trách</th>
                    <th>Ngày đặt</th>
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
                            <td>
                                <?php if (!empty($order['active_employee_name'])): ?>
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">
                                        <i class="bi bi-person-check me-1"></i><?= viewE($order['active_employee_name']) ?>
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-light text-secondary border">Chưa phân công</span>
                                <?php endif; ?>
                            </td>
                            <td class="small text-muted">
                                <?= viewE(date('d/m/Y H:i', strtotime($order['created_at']))) ?>
                            </td>
                            <td class="text-end">
                                <a href="<?= viewUrl('/admin/orders/' . (int) $order['id']) ?>" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-eye me-1"></i>Chi tiết
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8" class="text-center text-muted py-4">Không tìm thấy đơn hàng nào phù hợp.</td></tr>
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
                $url = viewUrl('/admin/orders') . '?' . http_build_query(array_filter([
                    'keyword'        => $filters['keyword'] ?? '',
                    'status'         => $filters['status'] ?? '',
                    'payment_status' => $filters['payment_status'] ?? '',
                    'assignment'     => $filters['assignment'] ?? '',
                    'page'           => $i,
                ], fn($v) => $v !== '' && $v !== null));
                ?>
                <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                    <a class="page-link <?= $i === $currentPage ? 'bg-danger border-danger' : 'text-danger' ?>" href="<?= viewE($url) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>
