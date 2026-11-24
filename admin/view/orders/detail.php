<?php

$orderBadge   = viewOrderStatusBadge($order['status'] ?? 'pending');
$paymentBadge = viewPaymentStatusBadge($order['payment_status'] ?? 'unpaid');
$methodLabel  = ($order['payment_method'] ?? 'cod') === 'qr_simulation'
    ? 'Chuyển khoản QR mô phỏng'
    : 'Thanh toán khi nhận hàng (COD)';

$statusLabels = [
    'pending'   => 'Chờ xác nhận',
    'confirmed' => 'Đã xác nhận',
    'shipping'  => 'Đang giao hàng',
    'delivered' => 'Đã giao hàng',
    'cancelled' => 'Đã hủy',
];

$allowedNextMap = [
    'pending'   => ['confirmed', 'shipping', 'delivered', 'cancelled'],
    'confirmed' => ['shipping', 'delivered', 'cancelled'],
    'shipping'  => ['delivered', 'cancelled'],
    'delivered' => [],
    'cancelled' => [],
];
$allowedNextStatuses = $allowedNextMap[$order['status']] ?? [];
$canAssign           = !in_array($order['status'], ['delivered', 'cancelled'], true);
?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <a href="<?= viewUrl('/admin/orders') ?>" class="text-decoration-none text-muted small">
            <i class="bi bi-arrow-left me-1"></i>Quay lại danh sách đơn hàng
        </a>
        <h1 class="h4 fw-bold mb-0 mt-1">
            Chi tiết đơn hàng #<?= viewE($order['order_code']) ?>
        </h1>
        <div class="small text-muted">
            Ngày đặt: <?= viewE(date('d/m/Y H:i:s', strtotime($order['created_at']))) ?>
        </div>
    </div>

    <div class="d-flex flex-wrap gap-2 align-items-center">
        <span class="badge <?= viewE($orderBadge['class']) ?> px-3 py-2">
            Đơn hàng: <?= viewE($orderBadge['label']) ?>
        </span>
        <span class="badge <?= viewE($paymentBadge['class']) ?> px-3 py-2">
            Thanh toán: <?= viewE($paymentBadge['label']) ?>
        </span>
    </div>
</div>

<div class="row g-4">
    <!-- Cột trái: Thông tin khách hàng, Sản phẩm snapshot & Lịch sử phân công -->
    <div class="col-lg-8">
        <!-- Thông tin khách hàng & giao hàng -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h2 class="h6 fw-bold mb-0"><i class="bi bi-person-vcard text-danger me-2"></i>Thông tin khách hàng &amp; Địa chỉ giao hàng</h2>
            </div>
            <div class="card-body">
                <div class="row g-3 small">
                    <div class="col-md-6">
                        <div class="text-muted">Tài khoản đặt hàng</div>
                        <div class="fw-semibold"><?= viewE($order['customer_name']) ?></div>
                        <div class="text-muted"><?= viewE($order['customer_email']) ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted">Người nhận hàng</div>
                        <div class="fw-semibold"><?= viewE($order['receiver_name']) ?></div>
                        <div>SĐT: <strong><?= viewE($order['receiver_phone']) ?></strong></div>
                    </div>
                    <div class="col-12">
                        <div class="text-muted">Địa chỉ giao hàng</div>
                        <div class="fw-semibold"><?= viewE($order['shipping_address']) ?></div>
                    </div>
                    <?php if (!empty($order['note'])): ?>
                        <div class="col-12">
                            <div class="text-muted">Ghi chú của khách hàng</div>
                            <div class="bg-light rounded p-2"><?= viewE($order['note']) ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Danh sách sản phẩm snapshot -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h2 class="h6 fw-bold mb-0"><i class="bi bi-phone text-danger me-2"></i>Sản phẩm trong đơn (Snapshot lúc mua)</h2>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light small text-uppercase">
                        <tr>
                            <th>Sản phẩm</th>
                            <th class="text-end">Đơn giá</th>
                            <th class="text-center">SL</th>
                            <th class="text-end">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($details as $item): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img
                                            src="<?= viewImage($item['product_image']) ?>"
                                            alt="<?= viewE($item['product_name']) ?>"
                                            class="border rounded p-1 bg-white"
                                            style="width: 52px; height: 52px; object-fit: contain;"
                                        >
                                        <div>
                                            <div class="fw-semibold"><?= viewE($item['product_name']) ?></div>
                                            <div class="small text-muted">
                                                <?= viewE($item['category_name']) ?> •
                                                RAM <?= viewE($item['ram']) ?> •
                                                <?= viewE($item['storage']) ?> •
                                                Màu <?= viewE($item['color']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end"><?= viewPrice($item['unit_price']) ?></td>
                                <td class="text-center"><?= (int) $item['quantity'] ?></td>
                                <td class="text-end fw-bold text-danger"><?= viewPrice($item['subtotal']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Tổng thanh toán:</td>
                            <td class="text-end fs-5 fw-bold text-danger"><?= viewPrice($order['total_amount']) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Lịch sử phân công nhân viên -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h2 class="h6 fw-bold mb-0"><i class="bi bi-clock-history text-danger me-2"></i>Lịch sử phân công nhân viên</h2>
                <span class="small text-muted"><?= count($assignmentHistory) ?> lượt phân công</span>
            </div>
            <div class="table-responsive">
                <table class="table table-sm align-middle mb-0">
                    <thead class="table-light small">
                        <tr>
                            <th>Nhân viên</th>
                            <th>Người giao</th>
                            <th>Ghi chú</th>
                            <th>Thời gian giao</th>
                            <th>Kết thúc</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <?php if (!empty($assignmentHistory)): ?>
                            <?php foreach ($assignmentHistory as $asg): ?>
                                <tr>
                                    <td>
                                        <div class="fw-semibold"><?= viewE($asg['employee_name']) ?></div>
                                        <div class="ui-style-12 text-muted"><?= viewE($asg['employee_email']) ?></div>
                                    </td>
                                    <td><?= viewE($asg['assigned_by_name']) ?></td>
                                    <td><?= viewE($asg['note'] ?: '-') ?></td>
                                    <td><?= viewE(date('d/m/Y H:i', strtotime($asg['assigned_at']))) ?></td>
                                    <td>
                                        <?= !empty($asg['unassigned_at'])
                                            ? viewE(date('d/m/Y H:i', strtotime($asg['unassigned_at'])))
                                            : '-' ?>
                                    </td>
                                    <td>
                                        <?php if ((int) ($asg['is_active'] ?? 0) === 1): ?>
                                            <span class="badge bg-success">Đang phụ trách</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Lịch sử cũ</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="text-center text-muted py-3">Đơn hàng này chưa từng được phân công cho nhân viên nào.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Cột phải: 3 khối thao tác độc lập -->
    <div class="col-lg-4">
        <!-- 1. Cập nhật trạng thái đơn hàng -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h2 class="h6 fw-bold mb-0"><i class="bi bi-arrow-repeat text-danger me-2"></i>1. Trạng thái xử lý đơn hàng</h2>
            </div>
            <div class="card-body">
                <div class="mb-3 small">
                    Trạng thái hiện tại:
                    <span class="badge <?= viewE($orderBadge['class']) ?> ms-1">
                        <?= viewE($orderBadge['label']) ?>
                    </span>
                </div>

                <?php if (!empty($allowedNextStatuses)): ?>
                    <form action="<?= viewUrl('/admin/orders/' . (int) $order['id'] . '/status') ?>" method="POST">
                        <?= viewCsrfField() ?>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Chuyển sang trạng thái</label>
                            <select name="status" class="form-select">
                                <?php foreach ($allowedNextStatuses as $st): ?>
                                    <option value="<?= viewE($st) ?>">
                                        <?= viewE($statusLabels[$st] ?? $st) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dtd w-100 btn-sm">
                            Cập nhật trạng thái đơn
                        </button>
                    </form>
                <?php else: ?>
                    <div class="alert alert-light border small mb-0">
                        Đơn hàng đang ở trạng thái cuối (<strong><?= viewE($orderBadge['label']) ?></strong>), không thể chuyển tiếp.
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- 2. Trạng thái thanh toán (Độc lập với trạng thái đơn) -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h2 class="h6 fw-bold mb-0"><i class="bi bi-cash-stack text-danger me-2"></i>2. Trạng thái thanh toán</h2>
            </div>
            <div class="card-body">
                <div class="small mb-2"><strong>Phương thức:</strong> <?= viewE($methodLabel) ?></div>
                <div class="small mb-2">
                    <strong>Trạng thái:</strong>
                    <span class="badge <?= viewE($paymentBadge['class']) ?> ms-1">
                        <?= viewE($paymentBadge['label']) ?>
                    </span>
                </div>
                <?php if (!empty($order['transfer_content'])): ?>
                    <div class="small mb-2">
                        <strong>Nội dung CK:</strong>
                        <span class="font-monospace"><?= viewE($order['transfer_content']) ?></span>
                    </div>
                <?php endif; ?>
                <?php if (!empty($order['payment_confirmed_at'])): ?>
                    <div class="small mb-2">
                        <strong>Xác nhận lúc:</strong>
                        <?= viewE(date('d/m/Y H:i:s', strtotime($order['payment_confirmed_at']))) ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($order['payment_note'])): ?>
                    <div class="small text-muted mb-3"><?= viewE($order['payment_note']) ?></div>
                <?php endif; ?>

                <?php if ($order['payment_method'] === 'cod'): ?>
                    <?php if ($order['status'] === 'cancelled' && $order['payment_status'] === 'unpaid'): ?>
                        <div class="alert alert-light border small mb-0">
                            Đơn hàng đã hủy nên không thể xác nhận thu tiền COD.
                        </div>
                    <?php else: ?>
                        <form action="<?= viewUrl('/admin/orders/' . (int) $order['id'] . '/payment') ?>" method="POST">
                            <?= viewCsrfField() ?>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Cập nhật thanh toán COD</label>
                                <select name="payment_status" class="form-select">
                                    <option value="unpaid" <?= $order['payment_status'] === 'unpaid' ? 'selected' : '' ?>>Chưa thanh toán</option>
                                    <option value="paid"   <?= $order['payment_status'] === 'paid'   ? 'selected' : '' ?>>Đã thanh toán (COD)</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-dark w-100 btn-sm">
                                Cập nhật thanh toán COD
                            </button>
                        </form>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="alert alert-info small mb-0">
                        <i class="bi bi-info-circle me-1"></i>
                        Đơn thanh toán QR mô phỏng do khách hàng tự bấm xác nhận trên màn hình QR (độc lập với tiến độ xử lý đơn).
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- 3. Phân công / Chuyển giao nhân viên -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h2 class="h6 fw-bold mb-0"><i class="bi bi-person-gear text-danger me-2"></i>3. Phân công nhân viên</h2>
            </div>
            <div class="card-body">
                <div class="small mb-3">
                    <strong>Đang phụ trách:</strong>
                    <?php if (!empty($order['active_employee_name'])): ?>
                        <div class="mt-1 p-2 rounded bg-light border">
                            <div class="fw-semibold text-primary"><?= viewE($order['active_employee_name']) ?></div>
                            <div class="ui-style-5 text-muted"><?= viewE($order['active_employee_email']) ?></div>
                        </div>
                    <?php else: ?>
                        <span class="badge bg-secondary ms-1">Chưa phân công</span>
                    <?php endif; ?>
                </div>

                <?php if ($canAssign): ?>
                    <?php if (!empty($employees)): ?>
                        <form action="<?= viewUrl('/admin/orders/' . (int) $order['id'] . '/assign') ?>" method="POST">
                            <?= viewCsrfField() ?>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Chọn nhân viên phụ trách</label>
                                <select name="employee_id" class="form-select" required>
                                    <option value="">-- Chọn nhân viên --</option>
                                    <?php foreach ($employees as $emp): ?>
                                        <option value="<?= (int) $emp['id'] ?>" <?= (int) ($order['active_employee_id'] ?? 0) === (int) $emp['id'] ? 'selected' : '' ?>>
                                            <?= viewE($emp['full_name']) ?> (<?= viewE($emp['email']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Ghi chú phân công / lý do chuyển</label>
                                <input
                                    type="text"
                                    name="note"
                                    class="form-control form-control-sm"
                                    placeholder="VD: Giao phụ trách khu vực Quận 1..."
                                >
                            </div>
                            <button type="submit" class="btn btn-outline-danger w-100 btn-sm fw-semibold">
                                <?= !empty($order['active_employee_id']) ? 'Chuyển giao cho nhân viên đã chọn' : 'Phân công nhân viên' ?>
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-warning small mb-0">Hiện chưa có nhân viên nào đang hoạt động để phân công.</div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="alert alert-light border small mb-0">
                        Không thể phân công hoặc chuyển giao đơn hàng đã kết thúc.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
