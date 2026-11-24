<?php

$queryBase = [
    'keyword'     => $keyword ?? '',
    'category'    => $selectedCatId > 0 ? $selectedCatId : '',
    'price_range' => $priceRange ?? '',
    'sort'        => $sort ?? 'newest',
];
?>

<!-- TIÊU ĐỀ TRANG -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <div>
        <h1 class="h4 fw-bold mb-1">
            <?= $activeCategory ? 'Điện thoại ' . viewE($activeCategory['name']) : 'Danh sách điện thoại' ?>
        </h1>
        <p class="text-muted small mb-0">Tìm thấy <strong><?= (int) $totalItems ?></strong> sản phẩm phù hợp</p>
    </div>
</div>

<!-- BỘ LỌC & SẮP XẾP -->
<form action="<?= viewUrl('/products') ?>" method="GET" class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label small fw-semibold">Tìm theo tên</label>
                <input
                    type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="VD: iPhone 17, Galaxy S25..."
                    value="<?= viewE($keyword ?? '') ?>"
                >
            </div>

            <div class="col-md-3">
                <label class="form-label small fw-semibold">Thương hiệu / Danh mục</label>
                <select name="category" class="form-select">
                    <option value="">Tất cả thương hiệu</option>
                    <?php foreach ($navCategories as $cat): ?>
                        <option value="<?= (int) $cat['id'] ?>" <?= ((int) $selectedCatId === (int) $cat['id']) ? 'selected' : '' ?>>
                            <?= viewE($cat['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label small fw-semibold">Khoảng giá</label>
                <select name="price_range" class="form-select">
                    <option value="">Tất cả mức giá</option>
                    <option value="under_20" <?= $priceRange === 'under_20' ? 'selected' : '' ?>>Dưới 20 triệu</option>
                    <option value="20_to_30" <?= $priceRange === '20_to_30' ? 'selected' : '' ?>>20 - 30 triệu</option>
                    <option value="30_to_40" <?= $priceRange === '30_to_40' ? 'selected' : '' ?>>30 - 40 triệu</option>
                    <option value="over_40"  <?= $priceRange === 'over_40'  ? 'selected' : '' ?>>Trên 40 triệu</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label small fw-semibold">Sắp xếp</label>
                <select name="sort" class="form-select">
                    <option value="newest"     <?= $sort === 'newest'     ? 'selected' : '' ?>>Mới nhất</option>
                    <option value="price_asc"  <?= $sort === 'price_asc'  ? 'selected' : '' ?>>Giá tăng dần</option>
                    <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Giá giảm dần</option>
                </select>
            </div>

            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-dtd w-100">
                    <i class="bi bi-funnel me-1"></i>Lọc
                </button>
                <a href="<?= viewUrl('/products') ?>" class="btn btn-outline-secondary" title="Đặt lại">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            </div>
        </div>
    </div>
</form>

<!-- LƯỚI SẢN PHẨM -->
<?php if (!empty($products)): ?>
    <div class="row g-3">
        <?php foreach ($products as $product): ?>
            <div class="col-6 col-md-4 col-lg-3">
                <?php require APP_PATH . '/client/partials/product_card.php'; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- PHÂN TRANG -->
    <?php if ($totalPages > 1): ?>
        <nav class="mt-4 d-flex justify-content-center" aria-label="Phân trang sản phẩm">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <?php
                    $params         = array_filter($queryBase, fn($v) => $v !== '' && $v !== null);
                    $params['page'] = $i;
                    $pageUrl        = viewUrl('/products') . '?' . http_build_query($params);
                    ?>
                    <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                        <a class="page-link <?= $i === $currentPage ? 'bg-danger border-danger' : 'text-danger' ?>" href="<?= viewE($pageUrl) ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>
<?php else: ?>
    <div class="card border-0 shadow-sm text-center p-5">
        <i class="bi bi-search fs-1 text-muted mb-3"></i>
        <h2 class="h5 fw-bold">Không tìm thấy điện thoại phù hợp</h2>
        <p class="text-muted mb-3">Hãy thử thay đổi từ khóa hoặc đặt lại bộ lọc tìm kiếm.</p>
        <div>
            <a href="<?= viewUrl('/products') ?>" class="btn btn-dtd">Xem tất cả điện thoại</a>
        </div>
    </div>
<?php endif; ?>
