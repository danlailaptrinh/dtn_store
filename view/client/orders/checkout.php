<?php

?>

<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb small">
        <li class="breadcrumb-item"><a href="<?= viewUrl('/') ?>" class="text-decoration-none text-danger">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="<?= viewUrl('/cart') ?>" class="text-decoration-none text-danger">Giỏ hàng</a></li>
        <li class="breadcrumb-item active" aria-current="page">Đặt hàng &amp; Thanh toán</li>
    </ol>
</nav>

<h1 class="h4 fw-bold mb-4"><i class="bi bi-credit-card text-danger me-2"></i>Xác nhận đặt hàng</h1>

<form action="<?= viewUrl('/checkout/place') ?>" method="POST">
    <?= viewCsrfField() ?>

    <div class="row g-4">
        <!-- Cột trái: Thông tin nhận hàng & Phương thức thanh toán -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h2 class="h6 fw-bold mb-0"><i class="bi bi-geo-alt text-danger me-2"></i>Thông tin người nhận hàng</h2>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="receiver_name" class="form-label fw-semibold small">Họ và tên người nhận <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                id="receiver_name"
                                name="receiver_name"
                                class="form-control"
                                value="<?= viewE($user['full_name'] ?? '') ?>"
                                required
                                minlength="2"
                            >
                        </div>

                        <div class="col-md-6">
                            <label for="receiver_phone" class="form-label fw-semibold small">Số điện thoại nhận hàng <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                id="receiver_phone"
                                name="receiver_phone"
                                class="form-control"
                                placeholder="VD: 0901234567"
                                value="<?= viewE($user['phone'] ?? '') ?>"
                                required
                            >
                        </div>

                        <div class="col-12">
                            <label for="shipping_address" class="form-label fw-semibold small">Địa chỉ giao hàng chi tiết <span class="text-danger">*</span></label>
                            <textarea
                                id="shipping_address"
                                name="shipping_address"
                                rows="2"
                                class="form-control"
                                placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố"
                                required
                            ><?= viewE($user['address'] ?? '') ?></textarea>
                        </div>

                        <div class="col-12">
                            <label for="note" class="form-label fw-semibold small">Ghi chú đơn hàng (không bắt buộc)</label>
                            <textarea
                                id="note"
                                name="note"
                                rows="2"
                                class="form-control"
                                placeholder="VD: Giao giờ hành chính, gọi trước khi giao..."
                            ></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h2 class="h6 fw-bold mb-0"><i class="bi bi-wallet2 text-danger me-2"></i>Phương thức thanh toán</h2>
                </div>
                <div class="card-body p-4">
                    <div class="form-check border rounded p-3 mb-3">
                        <input class="form-check-input ms-1" type="radio" name="payment_method" id="pay_cod" value="cod" checked>
                        <label class="form-check-label d-block ms-4" for="pay_cod">
                            <span class="fw-bold d-block"><i class="bi bi-cash-coin text-success me-2"></i>Thanh toán khi nhận hàng (COD)</span>
                            <small class="text-muted">Thanh toán tiền mặt trực tiếp cho nhân viên giao hàng sau khi kiểm tra máy.</small>
                        </label>
                    </div>

                    <div class="form-check border rounded p-3">
                        <input class="form-check-input ms-1" type="radio" name="payment_method" id="pay_qr" value="qr_simulation">
                        <label class="form-check-label d-block ms-4" for="pay_qr">
                            <span class="fw-bold d-block"><i class="bi bi-qr-code-scan text-danger me-2"></i>Chuyển khoản QR mô phỏng</span>
                            <small class="text-muted">Hiển thị mã QR chuyển khoản mô phỏng phục vụ đồ án để xác nhận thanh toán trực tuyến.</small>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cột phải: Tóm tắt sản phẩm (snapshot giá từ DB) -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h2 class="h6 fw-bold mb-0"><i class="bi bi-bag-check text-danger me-2"></i>Sản phẩm đặt mua (<?= count($items) ?>)</h2>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex flex-column gap-3 mb-3">
                        <?php foreach ($items as $item): ?>
                            <div class="d-flex align-items-center gap-3 pb-3 border-bottom">
                                <img
                                    src="<?= viewImage($item['primary_image']) ?>"
                                    alt="<?= viewE($item['product_name']) ?>"
                                    class="border rounded p-1 bg-white flex-shrink-0"
                                    style="width: 56px; height: 56px; object-fit: contain;"
                                >
                                <div class="flex-grow-1 min-w-0">
                                    <div class="fw-semibold small text-truncate"><?= viewE($item['product_name']) ?></div>
                                    <div class="ui-style-5 text-muted">
                                        <?= viewE($item['category_name']) ?> •
                                        <?= viewE($item['ram']) ?> / <?= viewE($item['storage']) ?> •
                                        <?= viewE($item['color']) ?>
                                    </div>
                                    <div class="small mt-1">
                                        <span class="text-muted">SL: <?= (int) $item['quantity'] ?> × <?= viewPrice($item['unit_price']) ?></span>
                                    </div>
                                </div>
                                <div class="fw-bold text-danger small text-end flex-shrink-0">
                                    <?= viewPrice($item['subtotal']) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="d-flex justify-content-between small text-muted mb-2">
                        <span>Tạm tính</span>
                        <span><?= viewPrice($totalAmount) ?></span>
                    </div>
                    <div class="d-flex justify-content-between small text-muted mb-3">
                        <span>Phí vận chuyển</span>
                        <span class="text-success fw-semibold">Miễn phí</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fw-bold">Tổng thanh toán</span>
                        <span class="fs-4 fw-bold text-danger"><?= viewPrice($totalAmount) ?></span>
                    </div>

                    <button type="submit" class="btn btn-dtd btn-lg w-100 mb-2">
                        <i class="bi bi-check2-circle me-1"></i>Đặt hàng ngay
                    </button>
                    <a href="<?= viewUrl('/cart') ?>" class="btn btn-outline-secondary w-100 btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>Quay lại giỏ hàng
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
