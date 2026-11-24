<?php

?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 fw-bold mb-0">Sửa biến thể: <?= viewE($product['name'] ?? '') ?></h1>
    <a href="<?= viewUrl('/admin/products/' . (int) $variant['product_id'] . '/variants') ?>" class="btn btn-outline-secondary btn-sm">Quay lại</a>
</div>

<div class="ui-style-11 card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="<?= viewUrl('/admin/variants/update/' . (int) $variant['id']) ?>" method="POST">
            <?= viewCsrfField() ?>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">RAM <span class="text-danger">*</span></label>
                    <input type="text" name="ram" class="form-control" value="<?= viewE($variant['ram']) ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Dung lượng <span class="text-danger">*</span></label>
                    <input type="text" name="storage" class="form-control" value="<?= viewE($variant['storage']) ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Màu sắc <span class="text-danger">*</span></label>
                    <input type="text" name="color" class="form-control" value="<?= viewE($variant['color']) ?>" required>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Giá bán gốc (VNĐ) <span class="text-danger">*</span></label>
                    <input type="number" name="price" class="form-control" min="1000" step="1000" value="<?= (int) $variant['price'] ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Giá khuyến mãi (VNĐ)</label>
                    <input type="number" name="sale_price" class="form-control" min="1000" step="1000" value="<?= $variant['sale_price'] !== null ? (int) $variant['sale_price'] : '' ?>">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-semibold">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="1" <?= (int) $variant['status'] === 1 ? 'selected' : '' ?>>Đang kinh doanh</option>
                    <option value="0" <?= (int) $variant['status'] === 0 ? 'selected' : '' ?>>Ngừng hiển thị</option>
                </select>
            </div>

            <button type="submit" class="btn btn-dtd px-4">Lưu thay đổi</button>
        </form>
    </div>
</div>
