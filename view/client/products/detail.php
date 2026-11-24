<?php

$mainImage   = $images[0]['image_path'] ?? null;
$avgRating   = $product['avg_rating'] !== null ? (float) $product['avg_rating'] : 0;
$reviewCount = (int) ($product['review_count'] ?? 0);
$variantsJson = json_encode($variants, JSON_UNESCAPED_UNICODE);
?>

<!-- BREADCRUMB -->
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb small">
        <li class="breadcrumb-item"><a href="<?= viewUrl('/') ?>" class="text-danger text-decoration-none">Trang chủ</a></li>
        <li class="breadcrumb-item">
            <a href="<?= viewUrl('/category/' . $product['category_slug']) ?>" class="text-danger text-decoration-none">
                <?= viewE($product['category_name']) ?>
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"><?= viewE($product['name']) ?></li>
    </ol>
</nav>

<!-- THÔNG TIN CHÍNH & CHỌN BIẾN THỂ -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <div class="row g-4">
            <!-- Bộ sưu tập hình ảnh -->
            <div class="col-lg-5">
                <div class="dtd-main-image-box mb-3">
                    <img id="mainProductImage" src="<?= viewImage($mainImage) ?>" alt="<?= viewE($product['name']) ?>">
                </div>

                <?php if (count($images) > 1): ?>
                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                        <?php foreach ($images as $idx => $img): ?>
                            <button
                                type="button"
                                class="dtd-thumb-btn <?= $idx === 0 ? 'active' : '' ?>"
                                data-image="<?= viewE(viewImage($img['image_path'])) ?>"
                            >
                                <img src="<?= viewImage($img['image_path']) ?>" alt="Ảnh <?= $idx + 1 ?>">
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Chọn cấu hình & Thêm vào giỏ -->
            <div class="col-lg-7">
                <span class="badge bg-danger bg-opacity-10 text-danger mb-2">
                    Thương hiệu: <?= viewE($product['category_name']) ?>
                </span>
                <h1 class="h3 fw-bold mb-2"><?= viewE($product['name']) ?></h1>

                <div class="d-flex align-items-center gap-2 small text-muted mb-3">
                    <span>
                        <i class="bi bi-star-fill text-warning me-1"></i>
                        <strong><?= $reviewCount > 0 ? number_format($avgRating, 1) : '0.0' ?></strong>/5
                    </span>
                    <span>•</span>
                    <span><?= $reviewCount ?> đánh giá</span>
                </div>

                <!-- Hiển thị giá động theo biến thể -->
                <div class="bg-light rounded-3 p-3 mb-4 d-flex align-items-baseline flex-wrap gap-2">
                    <span id="variantPriceNow" class="fs-3 fw-bold text-danger">--</span>
                    <span id="variantPriceOld" class="fs-6 text-muted text-decoration-line-through d-none">--</span>
                    <span id="variantDiscountBadge" class="badge bg-danger d-none">-0%</span>
                </div>

                <?php if (!empty($variants)): ?>
                    <div id="variantSelectorContainer" data-variants='<?= viewE($variantsJson) ?>'>
                        <!-- 1. Chọn RAM -->
                        <div class="mb-3">
                            <div class="small fw-bold mb-2">Dung lượng RAM:</div>
                            <div class="d-flex flex-wrap gap-2">
                                <?php foreach ($ramOptions as $ram): ?>
                                    <button type="button" class="variant-btn variant-ram-btn" data-value="<?= viewE($ram) ?>">
                                        <?= viewE($ram) ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- 2. Chọn Bộ nhớ trong -->
                        <div class="mb-3">
                            <div class="small fw-bold mb-2">Dung lượng bộ nhớ:</div>
                            <div class="d-flex flex-wrap gap-2">
                                <?php foreach ($storageOptions as $storage): ?>
                                    <button type="button" class="variant-btn variant-storage-btn" data-value="<?= viewE($storage) ?>">
                                        <?= viewE($storage) ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- 3. Chọn Màu sắc -->
                        <div class="mb-3">
                            <div class="small fw-bold mb-2">Màu sắc:</div>
                            <div class="d-flex flex-wrap gap-2">
                                <?php foreach ($colorOptions as $color): ?>
                                    <button type="button" class="variant-btn variant-color-btn" data-value="<?= viewE($color) ?>">
                                        <?= viewE($color) ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <p id="selectedVariantSummary" class="small text-success fw-semibold mb-3"></p>
                    </div>

                    <!-- Form Thêm vào giỏ hàng (lưu đúng variant_id) -->
                    <form action="<?= viewUrl('/cart/add') ?>" method="POST" class="d-flex flex-wrap align-items-center gap-3">
                        <?= viewCsrfField() ?>
                        <input type="hidden" name="variant_id" id="selectedVariantId" value="">

                        <div class="ui-style-8 input-group qty-control">
                            <button class="btn btn-outline-secondary qty-minus" type="button">-</button>
                            <input type="number" name="quantity" class="form-control text-center" value="1" min="1" max="99">
                            <button class="btn btn-outline-secondary qty-plus" type="button">+</button>
                        </div>

                        <button id="addToCartBtn" type="submit" class="btn btn-dtd btn-lg px-4 flex-grow-1 flex-sm-grow-0">
                            <i class="bi bi-cart-plus me-2"></i>Thêm vào giỏ hàng
                        </button>
                    </form>
                <?php else: ?>
                    <div class="alert alert-warning mb-0">Sản phẩm hiện chưa có phiên bản biến thể khả dụng.</div>
                <?php endif; ?>

                <div class="border-top mt-4 pt-3 row g-2 small text-muted">
                    <div class="col-sm-6"><i class="bi bi-check-circle-fill text-danger me-1"></i>Nguyên seal, chính hãng 100%</div>
                    <div class="col-sm-6"><i class="bi bi-check-circle-fill text-danger me-1"></i>Bảo hành 12 tháng toàn quốc</div>
                    <div class="col-sm-6"><i class="bi bi-check-circle-fill text-danger me-1"></i>Hỗ trợ thanh toán COD & QR</div>
                    <div class="col-sm-6"><i class="bi bi-check-circle-fill text-danger me-1"></i>Giao hàng nhanh tận nơi</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MÔ TẢ & THÔNG SỐ KỸ THUẬT -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h2 class="h5 fw-bold mb-3">Mô tả sản phẩm</h2>
                <p class="text-secondary lh-lg mb-0">
                    <?= nl2br(viewE($product['description'] ?? 'Đang cập nhật mô tả.')) ?>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h2 class="h5 fw-bold mb-3">Thông số kỹ thuật</h2>
                <?php if (!empty($specsList)): ?>
                    <table class="table table-striped table-sm mb-0 small">
                        <tbody>
                            <?php foreach ($specsList as $spec): ?>
                                <tr>
                                    <th class="ui-style-9 text-muted"><?= viewE($spec['label']) ?></th>
                                    <td><?= viewE($spec['value']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-muted small mb-0">Chưa cập nhật thông số kỹ thuật.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- ĐÁNH GIÁ & BÌNH LUẬN -->
<div id="reviews" class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 fw-bold mb-0">Đánh giá & Bình luận (<?= $reviewCount ?>)</h2>
            <span class="badge bg-warning text-dark fs-6">
                <i class="bi bi-star-fill me-1"></i><?= $reviewCount > 0 ? number_format($avgRating, 1) : '0.0' ?> / 5
            </span>
        </div>

        <!-- Khu vực gửi đánh giá (chỉ dành cho khách đã mua & nhận hàng thành công) -->
        <div class="mb-4">
            <?php if (empty($isLoggedIn)): ?>
                <div class="alert alert-light border d-flex flex-wrap justify-content-between align-items-center gap-2 mb-0">
                    <span class="small text-secondary">
                        <i class="bi bi-info-circle me-1 text-danger"></i>
                        Vui lòng đăng nhập bằng tài khoản đã nhận hàng thành công để gửi đánh giá sản phẩm.
                    </span>
                    <a href="<?= viewUrl('/login') ?>" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Đăng nhập ngay
                    </a>
                </div>
            <?php elseif (!empty($userReview)): ?>
                <div class="alert alert-success bg-opacity-10 border-success border-opacity-25 mb-0">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-1">
                        <strong class="small text-success">
                            <i class="bi bi-check-circle-fill me-1"></i>Bạn đã gửi đánh giá cho sản phẩm này
                        </strong>
                        <span class="text-warning small">
                            <?php for ($s = 1; $s <= 5; $s++): ?>
                                <i class="bi <?= $s <= (int) $userReview['rating'] ? 'bi-star-fill' : 'bi-star' ?>"></i>
                            <?php endfor; ?>
                        </span>
                    </div>
                    <p class="small text-secondary mb-0"><?= nl2br(viewE($userReview['comment'])) ?></p>
                    <?php if ((int) $userReview['status'] === 0): ?>
                        <div class="small text-muted mt-1">
                            <i class="bi bi-eye-slash me-1"></i>Đánh giá của bạn hiện đang được quản trị viên ẩn khỏi danh sách công khai.
                        </div>
                    <?php endif; ?>
                </div>
            <?php elseif (!empty($canReview)): ?>
                <form action="<?= viewUrl('/product/' . $product['slug'] . '/review') ?>" method="POST" class="bg-light rounded-3 p-3 border">
                    <?= viewCsrfField() ?>
                    <h3 class="h6 fw-bold mb-3">Viết đánh giá của bạn</h3>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold d-block">Chọn số sao đánh giá <span class="text-danger">*</span></label>
                        <div class="d-flex flex-wrap gap-3">
                            <?php for ($star = 5; $star >= 1; $star--): ?>
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="rating"
                                        id="ratingStar<?= $star ?>"
                                        value="<?= $star ?>"
                                        <?= $star === 5 ? 'checked' : '' ?>
                                        required
                                    >
                                    <label class="form-check-label small" for="ratingStar<?= $star ?>">
                                        <span class="text-warning"><i class="bi bi-star-fill"></i></span> <?= $star ?> sao
                                    </label>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="reviewComment" class="form-label small fw-semibold">Nhận xét chi tiết <span class="text-danger">*</span></label>
                        <textarea
                            id="reviewComment"
                            name="comment"
                            rows="3"
                            class="form-control"
                            minlength="5"
                            maxlength="1000"
                            placeholder="Chia sẻ trải nghiệm thực tế của bạn về thiết kế, hiệu năng, camera, pin..."
                            required
                        ></textarea>
                        <div class="form-text">Tối thiểu 5 ký tự, tối đa 1000 ký tự. Mỗi khách hàng được gửi 1 đánh giá cho mỗi sản phẩm.</div>
                    </div>

                    <button type="submit" class="btn btn-dtd btn-sm px-4">
                        <i class="bi bi-send me-1"></i>Gửi đánh giá
                    </button>
                </form>
            <?php else: ?>
                <div class="alert alert-light border small text-secondary mb-0">
                    <i class="bi bi-bag-check me-1 text-danger"></i>
                    Chỉ khách hàng đã đặt mua và có đơn hàng ở trạng thái <strong>Đã giao hàng</strong> mới có thể gửi đánh giá cho sản phẩm này.
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($reviews)): ?>
            <div class="list-group list-group-flush">
                <?php foreach ($reviews as $review): ?>
                    <div class="list-group-item px-0 py-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <strong class="small"><?= viewE($review['full_name']) ?></strong>
                            <small class="text-muted"><?= viewE(date('d/m/Y H:i', strtotime($review['created_at']))) ?></small>
                        </div>
                        <div class="mb-2 text-warning small">
                            <?php for ($s = 1; $s <= 5; $s++): ?>
                                <i class="bi <?= $s <= (int) $review['rating'] ? 'bi-star-fill' : 'bi-star' ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="mb-0 small text-secondary"><?= nl2br(viewE($review['comment'])) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted small mb-0">Chưa có đánh giá công khai nào cho sản phẩm này.</p>
        <?php endif; ?>
    </div>
</div>

<!-- SẢN PHẨM LIÊN QUAN -->
<?php if (!empty($relatedProducts)): ?>
    <section>
        <h2 class="h5 fw-bold mb-3">Điện thoại cùng thương hiệu</h2>
        <div class="row g-3">
            <?php foreach ($relatedProducts as $product): ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <?php require APP_PATH . '/client/partials/product_card.php'; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>
