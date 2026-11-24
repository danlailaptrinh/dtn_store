<?php
// Form MVC chính thức. Bố cục một card theo giao diện demo gốc.
$productId = (int)($product['product_id'] ?? 0);
$images = is_array($images ?? null) ? $images : [];
?>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <h1 class="h4 fw-bold mb-0">Sửa sản phẩm: <?= viewE($product['product_name'] ?? '') ?></h1>
    <div class="d-flex gap-2">
        <a href="#product-images" class="btn btn-outline-info btn-sm">
            <i class="bi bi-images me-1"></i>Quản lý ảnh
        </a>
        <a href="/admin/index.php?route=/admin/products/<?= $productId ?>/variants" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-cpu me-1"></i>Quản lý biến thể
        </a>
        <a href="/admin/index.php?route=/admin/products" class="btn btn-outline-secondary btn-sm">Quay lại</a>
    </div>
</div>

<div class="ui-style-15 card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="/admin/index.php?route=/admin/products/update/<?= $productId ?>" method="POST" enctype="multipart/form-data">
            <?= viewCsrfField() ?>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Tên điện thoại <span class="text-danger">*</span></label>
                <input type="text" name="product_name" class="form-control" value="<?= viewE($product['product_name'] ?? '') ?>" required>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Danh mục (Thương hiệu) <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select" required>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= (int)$cat['id'] ?>" <?= (int)($product['category_id'] ?? 0) === (int)$cat['id'] ? 'selected' : '' ?>>
                                <?= viewE($cat['name'] ?? '') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Trạng thái hiển thị</label>
                    <select name="status" class="form-select">
                        <option value="dang_ban" <?= ($product['status'] ?? '') === 'dang_ban' ? 'selected' : '' ?>>Đang bán</option>
                        <option value="ngung_ban" <?= ($product['status'] ?? '') === 'ngung_ban' ? 'selected' : '' ?>>Ngừng bán</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Thương hiệu <span class="text-danger">*</span></label>
                <input type="text" name="brand" class="form-control" value="<?= viewE($product['brand'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label small fw-semibold">Mô tả sản phẩm</label>
                <textarea name="description" class="form-control" rows="4"><?= viewE($product['description'] ?? '') ?></textarea>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Màn hình</label>
                    <input type="text" name="screen" class="form-control" value="<?= viewE($product['screen'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Chip</label>
                    <input type="text" name="chip" class="form-control" value="<?= viewE($product['chip'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Giá niêm yết</label>
                    <input type="number" name="list_price" class="form-control" min="0" step="0.01" value="<?= viewE($product['list_price'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Giá cũ</label>
                    <input type="number" name="old_price" class="form-control" min="0" step="0.01" value="<?= viewE($product['old_price'] ?? '') ?>">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label small fw-semibold">Nhãn khuyến mãi</label>
                <input type="text" name="promotion_label" class="form-control" value="<?= viewE($product['promotion_label'] ?? '') ?>">
            </div>

            <section id="product-images" class="border-top pt-4 mt-4 mb-4">
                <h2 class="h6 fw-bold mb-3"><i class="bi bi-images me-2"></i>Quản lý ảnh sản phẩm</h2>
                <div class="d-flex flex-wrap gap-3 mb-3">
                    <?php if (empty($images)): ?>
                        <p class="text-muted small">Sản phẩm hiện chưa có ảnh.</p>
                    <?php endif; ?>
                    <?php foreach ($images as $image): ?>
                        <?php $imagePath = (string)$image; ?>
                        <label class="border rounded p-2 text-center" style="width:120px">
                            <img src="<?= viewE(viewImage($imagePath)) ?>" alt="Ảnh sản phẩm" class="rounded" style="width:100px;height:100px;object-fit:contain">
                            <span class="d-block small mt-2">
                                <input type="checkbox" name="delete_images[]" value="<?= viewE($imagePath) ?>"> Xóa ảnh
                            </span>
                        </label>
                    <?php endforeach; ?>
                </div>
                <label class="form-label small fw-semibold">Thêm ảnh mới</label>
                <input type="file" name="images[]" class="form-control" accept=".jpg,.jpeg,.png,.webp" multiple>
                <p class="text-muted small mt-2 mb-0">Ảnh được tích chọn sẽ bỏ khỏi danh sách sau khi lưu. Không chọn ảnh mới thì giữ ảnh cũ.</p>
            </section>

            <button type="submit" class="btn btn-dtd px-4"><i class="bi bi-save me-1"></i>Lưu thay đổi</button>
        </form>
    </div>
</div>
