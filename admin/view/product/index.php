<?php


?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h1 class="h4 fw-bold mb-1">Quản lý sản phẩm điện thoại</h1>
        <p class="text-muted small mb-0">Tổng số: <strong><?= (int) $totalItems ?></strong> dòng điện thoại</p>
    </div>
    <a href="/admin/index.php?route=/admin/products/create" class="btn btn-dtd">
        <i class="bi bi-plus-circle me-1"></i>Thêm điện thoại mới
    </a>
</div>

<form action="/admin/index.php" method="GET" class="card border-0 shadow-sm mb-4">
    <input type="hidden" name="route" value="/admin/products">
    <div class="card-body">
        <div class="row g-3 align-items-end">
            <div class="col-md-5">
                <label class="form-label small fw-semibold">Tìm kiếm theo tên điện thoại</label>
                <input type="text" name="keyword" class="form-control" value="<?= viewE($keyword) ?>" placeholder="VD: iPhone, Galaxy S25...">
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-semibold">Lọc theo danh mục</label>
                <select name="category_id" class="form-select">
                    <option value="0">Tất cả danh mục</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= (int) $cat['id'] ?>" <?= (int) $categoryId === (int) $cat['id'] ? 'selected' : '' ?>>
                            <?= viewE($cat['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-dtd w-100"><i class="bi bi-search me-1"></i>Tìm kiếm</button>
                <a href="/admin/index.php?route=/admin/products" class="btn btn-outline-secondary">Đặt lại</a>
            </div>
        </div>
    </div>
</form>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small text-uppercase">
                <tr>
                    <th>ID</th>
                    <th>Điện thoại</th>
                    <th>Thương hiệu</th>
                    <th>Khoảng giá</th>
                    <th>Biến thể</th>
                    <th>Trạng thái</th>
                    <th class="text-end">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $p): ?>
                        <tr>
                            <td>#<?= (int) $p['id'] ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img

                                        src="<?php
                                                $imagePath = ltrim((string)($p['primary_image'] ?? ''), '/');

                                                $imageUrl = '/assets/images/no-image.svg';

                                                if (
                                                    $imagePath !== '' &&
                                                    !str_contains($imagePath, '..') &&
                                                    preg_match(
                                                        '~^(assets/|uploads/)[a-zA-Z0-9/_(). -]+\.(jpg|jpeg|png|webp|gif)$~i',
                                                        $imagePath
                                                    )
                                                ) {
                                                    $localFile = dirname(__DIR__, 3) . '/' . $imagePath;

                                                    if (is_file($localFile)) {
                                                        $imageUrl = '/' . $imagePath;
                                                    }
                                                }

                                                echo htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8');
                                                ?>"

                                        alt="<?= viewE($p['name']) ?>"
                                        style="width: 48px; height: 48px; object-fit: contain;"
                                        class="border rounded bg-white p-1">
                                    <div>
                                        <div class="fw-semibold"><?= viewE($p['name']) ?></div>
                                        <?php if ((int) $p['is_featured'] === 1): ?>
                                            <span class="ui-style-17 badge bg-warning text-dark">Nổi bật</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-light text-dark border"><?= viewE($p['category_name']) ?></span></td>
                            <td class="small">
                                <?php if ($p['min_price'] !== null): ?>
                                    <span class="fw-bold text-danger"><?= viewPrice($p['min_price']) ?></span>
                                    <?php if ((float) $p['max_price'] > (float) $p['min_price']): ?>
                                        <span class="text-muted"> - <?= viewPrice($p['max_price']) ?></span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="text-warning fw-semibold">Chưa có biến thể</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= viewUrl('/admin/products/' . (int) $p['id'] . '/variants') ?>" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-cpu me-1"></i><?= (int) $p['variant_count'] ?> biến thể
                                </a>
                            </td>
                            <td>
                                <?= (int) $p['status'] === 1
                                    ? '<span class="badge bg-success">Hiển thị</span>'
                                    : '<span class="badge bg-secondary">Ẩn</span>' ?>
                            </td>
                            <td class="text-end text-nowrap">
                                <a href="<?= viewUrl('/admin/products/' . (int) $p['id'] . '/images') ?>" class="btn btn-sm btn-outline-info" title="Quản lý ảnh">
                                    <i class="bi bi-images"></i> Ảnh
                                </a>
                                <a href="<?= viewUrl('/admin/products/edit/' . (int) $p['id']) ?>" class="btn btn-sm btn-outline-primary" title="Sửa">
                                    <i class="bi bi-pencil"></i> Sửa
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" disabled title="Chưa triển khai Xóa sản phẩm"><i class="bi bi-trash"></i> Xóa</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Không tìm thấy sản phẩm nào.</td>
                    </tr>
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

                $url = '/admin/index.php?route=/admin/products'
                    . '&'
                    . http_build_query([
                        'keyword' => $keyword,
                        'category_id' => $categoryId,
                        'page' => $i
                    ]);

                ?>
                <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                    <a class="page-link <?= $i === $currentPage ? 'bg-danger border-danger' : 'text-danger' ?>" href="<?= viewE($url) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>