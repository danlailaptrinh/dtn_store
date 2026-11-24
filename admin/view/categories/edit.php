<?php

?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 fw-bold mb-0">Sửa danh mục: <?= viewE($category['name']) ?></h1>
    <a href="<?= viewUrl('/admin/categories') ?>" class="btn btn-outline-secondary btn-sm">Quay lại</a>
</div>

<div class="ui-style-11 card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="<?= viewUrl('/admin/categories/update/' . (int) $category['id']) ?>" method="POST">
            <?= viewCsrfField() ?>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Tên danh mục / Thương hiệu <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="<?= viewE($category['name']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Mô tả</label>
                <textarea name="description" class="form-control" rows="3"><?= viewE($category['description'] ?? '') ?></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-semibold">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="1" <?= (int) $category['status'] === 1 ? 'selected' : '' ?>>Hiển thị</option>
                    <option value="0" <?= (int) $category['status'] === 0 ? 'selected' : '' ?>>Ẩn</option>
                </select>
            </div>

            <button type="submit" class="btn btn-dtd px-4">Cập nhật danh mục</button>
        </form>
    </div>
</div>
