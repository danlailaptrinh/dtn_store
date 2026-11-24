<?php

/** @var array $product */
$origPrice   = (float) ($product['display_original_price'] ?? 0);
$salePrice   = $product['display_sale_price'] !== null ? (float) $product['display_sale_price'] : null;
$hasDiscount = $salePrice !== null && $salePrice > 0 && $salePrice < $origPrice;
$finalPrice  = $hasDiscount ? $salePrice : $origPrice;
$discountPct = $hasDiscount ? (int) round((($origPrice - $salePrice) / $origPrice) * 100) : 0;
$avgRating   = $product['avg_rating'] !== null ? (float) $product['avg_rating'] : 0;
$reviewCount = (int) ($product['review_count'] ?? 0);
?>
<div class="dtd-product-card">
    <a href="<?= viewUrl('/product/' . $product['slug']) ?>" class="dtd-product-thumb text-decoration-none">
        <?php if ($hasDiscount): ?>
            <span class="dtd-discount-badge">-<?= $discountPct ?>%</span>
        <?php endif; ?>
        <img
            src="<?= viewImage($product['primary_image'] ?? null) ?>"
            alt="<?= viewE($product['name']) ?>"
            loading="lazy"
        >
    </a>

    <div class="p-3 d-flex flex-column flex-grow-1">
        <div class="mb-1">
            <span class="badge bg-light text-secondary border small">
                <?= viewE($product['category_name']) ?>
            </span>
        </div>

        <a href="<?= viewUrl('/product/' . $product['slug']) ?>" class="dtd-product-title mb-2">
            <?= viewE($product['name']) ?>
        </a>

        <div class="mt-auto">
            <div class="d-flex align-items-baseline flex-wrap gap-2 mb-2">
                <span class="dtd-price-now"><?= viewPrice($finalPrice) ?></span>
                <?php if ($hasDiscount): ?>
                    <span class="dtd-price-old"><?= viewPrice($origPrice) ?></span>
                <?php endif; ?>
            </div>

            <div class="d-flex align-items-center justify-content-between small text-muted mb-3">
                <span>
                    <i class="bi bi-star-fill text-warning me-1"></i>
                    <?= $reviewCount > 0 ? number_format($avgRating, 1) : 'Chưa có' ?>
                    (<?= $reviewCount ?> đánh giá)
                </span>
            </div>

            <a href="<?= viewUrl('/product/' . $product['slug']) ?>" class="btn btn-outline-dtd btn-sm w-100">
                Chọn cấu hình & Mua
            </a>
        </div>
    </div>
</div>
