<?php

?>

<!-- BANNER QUẢNG CÁO -->
<section class="mb-4">
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="dtd-hero-banner p-4 p-md-5 h-100 d-flex flex-column justify-content-center shadow-sm">
                <span class="badge bg-white text-danger align-self-start mb-3 px-3 py-2 fw-bold">
                    SIÊU SALE SMARTPHONE CHÍNH HÃNG
                </span>
                <h1 class="display-6 fw-bold mb-3">Đỉnh cao công nghệ trong tầm tay tại <?= viewE(APP_NAME) ?></h1>
                <p class="mb-4 opacity-90">
                    Đầy đủ các phiên bản RAM, bộ nhớ trong và màu sắc thời thượng từ iPhone, Samsung, Xiaomi, OPPO, Vivo, Realme.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="<?= viewUrl('/products') ?>" class="btn btn-light text-danger fw-bold px-4 py-2">
                        Khám phá ngay <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                    <a href="<?= viewUrl('/category/iphone') ?>" class="btn btn-outline-light px-4 py-2">
                        Xem iPhone mới
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 d-flex flex-column gap-3">
            <div class="bg-white rounded-3 p-4 border shadow-sm flex-grow-1 d-flex flex-column justify-content-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-danger bg-opacity-10 text-danger rounded-circle p-3 fs-4">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div>
                        <h2 class="h6 fw-bold mb-1">100% Chính hãng VN/A</h2>
                        <p class="small text-muted mb-0">Bảo hành 12 tháng, lỗi 1 đổi 1 trong 30 ngày.</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-3 p-4 border shadow-sm flex-grow-1 d-flex flex-column justify-content-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-danger bg-opacity-10 text-danger rounded-circle p-3 fs-4">
                        <i class="bi bi-qr-code-scan"></i>
                    </div>
                    <div>
                        <h2 class="h6 fw-bold mb-1">Thanh toán linh hoạt</h2>
                        <p class="small text-muted mb-0">Hỗ trợ thanh toán COD và QR mô phỏng nhanh chóng.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 1. ĐIỆN THOẠI NỔI BẬT -->
<section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4 fw-bold mb-0"><i class="bi bi-fire text-danger me-2"></i>Điện thoại nổi bật</h2>
        <a href="<?= viewUrl('/products') ?>" class="text-danger text-decoration-none fw-semibold small">
            Xem tất cả <i class="bi bi-chevron-right"></i>
        </a>
    </div>
    <div class="row g-3">
        <?php foreach ($featuredProducts as $product): ?>
            <div class="col-6 col-md-4 col-lg-3">
                <?php require APP_PATH . '/client/partials/product_card.php'; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- 2. ĐIỆN THOẠI KHUYẾN MÃI -->
<section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4 fw-bold mb-0"><i class="bi bi-tag-fill text-danger me-2"></i>Điện thoại khuyến mãi</h2>
        <a href="<?= viewUrl('/products') ?>" class="text-danger text-decoration-none fw-semibold small">
            Xem tất cả <i class="bi bi-chevron-right"></i>
        </a>
    </div>
    <div class="row g-3">
        <?php foreach ($promoProducts as $product): ?>
            <div class="col-6 col-md-4 col-lg-3">
                <?php require APP_PATH . '/client/partials/product_card.php'; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- 3. ĐIỆN THOẠI MỚI NHẤT -->
<section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4 fw-bold mb-0"><i class="bi bi-stars text-danger me-2"></i>Điện thoại mới nhất</h2>
        <a href="<?= viewUrl('/products?sort=newest') ?>" class="text-danger text-decoration-none fw-semibold small">
            Xem tất cả <i class="bi bi-chevron-right"></i>
        </a>
    </div>
    <div class="row g-3">
        <?php foreach ($newestProducts as $product): ?>
            <div class="col-6 col-md-4 col-lg-3">
                <?php require APP_PATH . '/client/partials/product_card.php'; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- 4. ĐIỆN THOẠI BÁN CHẠY -->
<section class="mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4 fw-bold mb-0"><i class="bi bi-graph-up-arrow text-danger me-2"></i>Điện thoại bán chạy</h2>
        <a href="<?= viewUrl('/products') ?>" class="text-danger text-decoration-none fw-semibold small">
            Xem tất cả <i class="bi bi-chevron-right"></i>
        </a>
    </div>
    <div class="row g-3">
        <?php foreach ($bestSellingProducts as $product): ?>
            <div class="col-6 col-md-4 col-lg-3">
                <?php require APP_PATH . '/client/partials/product_card.php'; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
