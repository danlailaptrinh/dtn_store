<?php

?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 fw-bold mb-0">Thêm danh mục điện thoại mới</h1>
    <a href="<?= viewUrl('/admin/categories') ?>" class="btn btn-outline-secondary btn-sm">Quay lại</a>
</div>

<div class="ui-style-11 card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="<?= viewUrl('/admin/categories/store') ?>" method="POST">
            <?= viewCsrfField() ?>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Tên danh mục / Thương hiệu <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="VD: Google Pixel, Asus ROG..." required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Mô tả</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Mô tả ngắn về thương hiệu điện thoại..."></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-semibold">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="1" selected>Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>

            <button type="submit" class="btn btn-dtd px-4">Lưu danh mục</button>
        </form>
    </div>
</div>
