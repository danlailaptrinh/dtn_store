<?php

$orderBadge   = viewOrderStatusBadge($order['status'] ?? 'pending');
$paymentBadge = viewPaymentStatusBadge($order['payment_status'] ?? 'unpaid');

// Nội dung chuỗi QR mô phỏng (chứa mã đơn, số tiền và nội dung chuyển khoản)
$qrPayload = sprintf(
    'DTDSTORE|ORDER:%s|AMOUNT:%d|CONTENT:%s',
    $order['order_code'],
    (int) round((float) $order['payment_amount']),
    $order['transfer_content'] ?? ('DTDSTORE ' . $order['order_code'])
);
$qrImageUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=240x240&data=' . rawurlencode($qrPayload);
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="alert alert-warning border-warning d-flex align-items-start gap-2 shadow-sm mb-4">
            <i class="bi bi-info-circle-fill fs-5 flex-shrink-0 mt-1"></i>
            <div>
                <strong>Lưu ý: Thanh toán QR mô phỏng phục vụ đồ án</strong>
                <div class="small">
                    Đây là giao diện quét mã QR chuyển khoản mô phỏng cho đồ án môn học (không kết nối cổng thanh toán thật).
                    Sau khi bấm xác nhận bên dưới, trạng thái thanh toán sẽ chuyển thành <em>“Đã xác nhận thanh toán mô phỏng”</em> và độc lập với trạng thái xử lý đơn hàng.
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div>
                    <h1 class="h5 fw-bold mb-0">
                        <i class="bi bi-qr-code text-danger me-2"></i>Thanh toán QR đơn hàng #<?= viewE($order['order_code']) ?>
                    </h1>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge <?= viewE($orderBadge['class']) ?>">
                        Đơn hàng: <?= viewE($orderBadge['label']) ?>
                    </span>
                    <span class="badge <?= viewE($paymentBadge['class']) ?>">
                        Thanh toán: <?= viewE($paymentBadge['label']) ?>
                    </span>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="row g-4 align-items-center">
                    <!-- Cột mã QR -->
                    <div class="col-md-5 text-center">
                        <div class="border rounded-3 p-3 bg-light d-inline-block">
                            <img
                                id="qrCodeImg"
                                src="<?= viewE($qrImageUrl) ?>"
                                alt="Mã QR thanh toán mô phỏng <?= viewE($order['order_code']) ?>"
                                class="img-fluid bg-white p-2 rounded border"
                                style="width: 220px; height: 220px; object-fit: contain;"
                                onerror="this.classList.add('d-none'); document.getElementById('qrFallbackSvg').classList.remove('d-none');"
                            >
                            <!-- Fallback SVG nội bộ nếu máy không có Internet -->
                            <div id="qrFallbackSvg" class="ui-style-6 d-none bg-white p-3 rounded border">
                                <svg viewBox="0 0 100 100" class="w-100 h-100" xmlns="http://www.w3.org/2000/svg" aria-label="QR Mô phỏng">
                                    <rect width="100" height="100" fill="#ffffff"/>
                                    <rect x="6" y="6" width="26" height="26" fill="none" stroke="#111" stroke-width="4"/>
                                    <rect x="13" y="13" width="12" height="12" fill="#111"/>
                                    <rect x="68" y="6" width="26" height="26" fill="none" stroke="#111" stroke-width="4"/>
                                    <rect x="75" y="13" width="12" height="12" fill="#111"/>
                                    <rect x="6" y="68" width="26" height="26" fill="none" stroke="#111" stroke-width="4"/>
                                    <rect x="13" y="75" width="12" height="12" fill="#111"/>
                                    <rect x="40" y="10" width="6" height="6" fill="#111"/><rect x="52" y="10" width="8" height="6" fill="#111"/>
                                    <rect x="40" y="22" width="12" height="6" fill="#111"/><rect x="10" y="40" width="14" height="6" fill="#111"/>
                                    <rect x="30" y="40" width="18" height="18" fill="#d70018"/>
                                    <rect x="54" y="42" width="10" height="8" fill="#111"/><rect x="72" y="40" width="18" height="6" fill="#111"/>
                                    <rect x="40" y="66" width="10" height="10" fill="#111"/><rect x="58" y="64" width="14" height="8" fill="#111"/>
                                    <rect x="78" y="72" width="14" height="14" fill="#111"/><rect x="46" y="84" width="20" height="8" fill="#111"/>
                                </svg>
                            </div>
                            <div class="small text-muted mt-2 fw-semibold">Quét mã bằng ứng dụng ngân hàng (Mô phỏng)</div>
                        </div>
                    </div>

                    <!-- Cột thông tin chuyển khoản -->
                    <div class="col-md-7">
                        <h2 class="h6 fw-bold text-uppercase text-muted mb-3">Thông tin chuyển khoản mô phỏng</h2>

                        <table class="table table-sm table-borderless mb-3">
                            <tr>
                                <th class="ui-style-7 text-muted">Ngân hàng:</th>
                                <td class="fw-semibold">Vietcombank (Tài khoản mô phỏng)</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Số tài khoản:</th>
                                <td class="fw-semibold font-monospace">0123 456 789 999</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Chủ tài khoản:</th>
                                <td class="fw-semibold">CỬA HÀNG DTD STORE</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Số tiền cần chuyển:</th>
                                <td class="fs-5 fw-bold text-danger"><?= viewPrice($order['payment_amount'] ?? $order['total_amount']) ?></td>
                            </tr>
                            <tr>
                                <th class="text-muted">Nội dung CK:</th>
                                <td>
                                    <span class="badge bg-dark font-monospace fs-6">
                                        <?= viewE($order['transfer_content'] ?? ('DTDSTORE ' . $order['order_code'])) ?>
                                    </span>
                                </td>
                            </tr>
                        </table>

                        <?php if ($order['status'] === 'cancelled'): ?>
                            <div class="alert alert-danger mb-3">
                                <i class="bi bi-x-circle-fill me-2"></i>
                                Đơn hàng này đã bị hủy nên không thể xác nhận thanh toán.
                            </div>
                            <a href="<?= viewUrl('/orders/' . (int) $order['id']) ?>" class="btn btn-dark">
                                <i class="bi bi-receipt me-1"></i>Xem chi tiết đơn hàng
                            </a>
                        <?php elseif ($order['payment_status'] === 'unpaid'): ?>
                            <form action="<?= viewUrl('/orders/' . (int) $order['id'] . '/qr-confirm') ?>" method="POST" class="d-grid gap-2">
                                <?= viewCsrfField() ?>
                                <button type="submit" class="btn btn-dtd btn-lg">
                                    <i class="bi bi-check-circle me-2"></i>Tôi đã hoàn tất thanh toán (Mô phỏng)
                                </button>
                                <a href="<?= viewUrl('/orders/' . (int) $order['id']) ?>" class="btn btn-outline-secondary btn-sm">
                                    Thanh toán sau &amp; Xem chi tiết đơn hàng
                                </a>
                            </form>
                        <?php else: ?>
                            <div class="alert alert-success mb-3">
                                <i class="bi bi-patch-check-fill me-2"></i>
                                Đơn hàng này đã được ghi nhận trạng thái: <strong><?= viewE($paymentBadge['label']) ?></strong>.
                                <?php if (!empty($order['payment_confirmed_at'])): ?>
                                    <div class="small mt-1">Thời gian xác nhận: <?= viewE(date('d/m/Y H:i:s', strtotime($order['payment_confirmed_at']))) ?></div>
                                <?php endif; ?>
                            </div>
                            <a href="<?= viewUrl('/orders/' . (int) $order['id']) ?>" class="btn btn-dark">
                                <i class="bi bi-receipt me-1"></i>Xem chi tiết đơn hàng
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
