<?php

?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <h1 class="h4 fw-bold mb-0">Sửa sản phẩm: <?= viewE($product['name']) ?></h1>
    <div class="d-flex gap-2">
        <a href="<?= viewUrl('/admin/products/' . (int) $product['id'] . '/images') ?>" class="btn btn-outline-info btn-sm">
            <i class="bi bi-images me-1"></i>Quản lý ảnh
        </a>
        <a href="<?= viewUrl('/admin/products/' . (int) $product['id'] . '/variants') ?>" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-cpu me-1"></i>Quản lý biến thể
        </a>
        <a href="<?= viewUrl('/admin/products') ?>" class="btn btn-outline-secondary btn-sm">Quay lại</a>
    </div>
</div>

<div class="ui-style-15 card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="<?= viewUrl('/admin/products/update/' . (int) $product['id']) ?>" method="POST">
            <?= viewCsrfField() ?>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Tên điện thoại <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="<?= viewE($product['name']) ?>" required>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Danh mục (Thương hiệu) <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select" required>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= (int) $cat['id'] ?>" <?= (int) $product['category_id'] === (int) $cat['id'] ? 'selected' : '' ?>>
                                <?= viewE($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Trạng thái hiển thị</label>
                    <select name="status" class="form-select">
                        <option value="1" <?= (int) $product['status'] === 1 ? 'selected' : '' ?>>Hiển thị</option>
                        <option value="0" <?= (int) $product['status'] === 0 ? 'selected' : '' ?>>Ẩn</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Mô tả sản phẩm</label>
                <textarea name="description" class="form-control" rows="4"><?= viewE($product['description'] ?? '') ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Thông số kỹ thuật (ngăn cách bởi dấu <code>|</code>)</label>
                <textarea name="specifications" class="form-control" rows="3"><?= viewE($product['specifications'] ?? '') ?></textarea>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="is_featured" id="isFeaturedEdit" value="1" <?= (int) $product['is_featured'] === 1 ? 'checked' : '' ?>>
                <label class="form-check-label small fw-semibold" for="isFeaturedEdit">
                    Đánh dấu là Điện thoại nổi bật trên Trang chủ
                </label>
            </div>

            <button type="submit" class="btn btn-dtd px-4">Lưu thay đổi</button>
        </form>
    </div>
</div>
