<?php

?>

<h1 class="h4 fw-bold mb-4"><i class="bi bi-cart3 text-danger me-2"></i>Giỏ hàng của bạn</h1>

<?php if (!empty($cartItems)): ?>
    <!-- Form cập nhật số lượng tách riêng để không lồng thẻ form -->
    <form id="updateCartForm" action="<?= viewUrl('/cart/update') ?>" method="POST">
        <?= viewCsrfField() ?>
    </form>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light small text-uppercase">
                            <tr>
                                <th>Sản phẩm</th>
                                <th class="text-end">Đơn giá</th>
                                <th class="ui-style-8 text-center">Số lượng</th>
                                <th class="text-end">Thành tiền</th>
                                <th class="text-center">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cartItems as $item): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <img
                                                src="<?= viewImage($item['primary_image']) ?>"
                                                alt="<?= viewE($item['product_name']) ?>"
                                                style="width: 64px; height: 64px; object-fit: contain;"
                                                class="border rounded p-1 bg-white"
                                            >
                                            <div>
                                                <a href="<?= viewUrl('/product/' . $item['product_slug']) ?>" class="fw-semibold text-dark text-decoration-none d-block">
                                                    <?= viewE($item['product_name']) ?>
                                                </a>
                                                <div class="small text-muted">
                                                    <span><?= viewE($item['category_name']) ?></span> •
                                                    <span>RAM <?= viewE($item['ram']) ?></span> •
                                                    <span><?= viewE($item['storage']) ?></span> •
                                                    <span>Màu <?= viewE($item['color']) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-end fw-semibold">
                                        <?= viewPrice($item['unit_price']) ?>
                                    </td>

                                    <td>
                                        <div class="input-group input-group-sm qty-control">
                                            <button class="btn btn-outline-secondary qty-minus" type="button">-</button>
                                            <input
                                                type="number"
                                                form="updateCartForm"
                                                name="quantities[<?= (int) $item['variant_id'] ?>]"
                                                class="form-control text-center"
                                                value="<?= (int) $item['quantity'] ?>"
                                                min="1"
                                                max="99"
                                            >
                                            <button class="btn btn-outline-secondary qty-plus" type="button">+</button>
                                        </div>
                                    </td>

                                    <td class="text-end fw-bold text-danger">
                                        <?= viewPrice($item['subtotal']) ?>
                                    </td>

                                    <td class="text-center">
                                        <form action="<?= viewUrl('/cart/remove') ?>" method="POST" class="d-inline">
                                            <?= viewCsrfField() ?>
                                            <input type="hidden" name="variant_id" value="<?= (int) $item['variant_id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa sản phẩm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white d-flex flex-wrap justify-content-between gap-2 py-3">
                    <a href="<?= viewUrl('/products') ?>" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>Tiếp tục mua sắm
                    </a>
                    <button type="submit" form="updateCartForm" class="btn btn-dark btn-sm px-3">
                        <i class="bi bi-arrow-repeat me-1"></i>Cập nhật giỏ hàng
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h6 fw-bold text-uppercase mb-3">Tóm tắt đơn hàng</h2>
                    <div class="d-flex justify-content-between mb-2 small text-muted">
                        <span>Tạm tính</span>
                        <span><?= viewPrice($grandTotal) ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 small text-muted">
                        <span>Phí giao hàng</span>
                        <span class="text-success fw-semibold">Miễn phí</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fw-bold">Tổng thanh toán</span>
                        <span class="fs-4 fw-bold text-danger"><?= viewPrice($grandTotal) ?></span>
                    </div>
                    <a href="<?= viewUrl('/checkout') ?>" class="btn btn-dtd btn-lg w-100">
                        Tiến hành đặt hàng <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="card border-0 shadow-sm text-center p-5">
        <i class="bi bi-cart-x fs-1 text-muted mb-3"></i>
        <h2 class="h5 fw-bold">Giỏ hàng của bạn đang trống</h2>
        <p class="text-muted mb-4">Hãy chọn cho mình một chiếc điện thoại ưng ý tại DTD STORE.</p>
        <div>
            <a href="<?= viewUrl('/products') ?>" class="btn btn-dtd px-4">Xem điện thoại ngay</a>
        </div>
    </div>
<?php endif; ?>
