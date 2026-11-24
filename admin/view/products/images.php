<?php

?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h1 class="h4 fw-bold mb-1">Quản lý hình ảnh: <?= viewE($product['name']) ?></h1>
        <p class="text-muted small mb-0">Thương hiệu: <strong><?= viewE($product['category_name']) ?></strong></p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= viewUrl('/admin/products/' . (int) $product['id'] . '/variants') ?>" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-cpu me-1"></i>Quản lý biến thể
        </a>
        <a href="<?= viewUrl('/admin/products') ?>" class="btn btn-outline-secondary btn-sm">Quay lại danh sách</a>
    </div>
</div>

<!-- FORM UPLOAD THÊM ẢNH -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <h2 class="h6 fw-bold mb-2">Tải lên hình ảnh mới</h2>
        <p class="small text-muted mb-3">Chấp nhận JPG, JPEG, PNG, WEBP (tối đa 2MB mỗi ảnh). Có thể chọn cùng lúc nhiều ảnh.</p>

        <form action="<?= viewUrl('/admin/products/' . (int) $product['id'] . '/images/upload') ?>" method="POST" enctype="multipart/form-data" class="row g-3 align-items-center">
            <?= viewCsrfField() ?>
            <div class="col-md-8">
                <input type="file" name="images[]" class="form-control" accept=".jpg,.jpeg,.png,.webp" multiple required>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-dtd w-100">
                    <i class="bi bi-cloud-upload me-1"></i>Tải ảnh lên
                </button>
            </div>
        </form>
    </div>
</div>

<!-- BỘ SƯU TẬP ẢNH HIỆN CÓ -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <h2 class="h6 fw-bold mb-3">Bộ sưu tập hình ảnh hiện có (<?= count($images) ?>)</h2>

        <?php if (!empty($images)): ?>
            <div class="row g-3">
                <?php foreach ($images as $img): ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card h-100 <?= (int) $img['is_primary'] === 1 ? 'border-danger border-2' : 'border' ?>">
                            <div class="ui-style-16 p-3 text-center bg-light">
                                <img
                                    src="<?= viewImage($img['image_path']) ?>"
                                    alt="Ảnh sản phẩm"
                                    style="max-height: 160px; max-width: 100%; object-fit: contain;"
                                >
                            </div>
                            <div class="card-body p-2 text-center">
                                <?php if ((int) $img['is_primary'] === 1): ?>
                                    <span class="badge bg-danger mb-2">Ảnh đại diện chính</span>
                                <?php else: ?>
                                    <form action="<?= viewUrl('/admin/products/' . (int) $product['id'] . '/images/primary') ?>" method="POST" class="d-inline">
                                        <?= viewCsrfField() ?>
                                        <input type="hidden" name="image_id" value="<?= (int) $img['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-primary mb-1">Đặt làm ảnh chính</button>
                                    </form>
                                <?php endif; ?>

                                <form action="<?= viewUrl('/admin/products/' . (int) $product['id'] . '/images/delete') ?>" method="POST" class="d-inline">
                                    <?= viewCsrfField() ?>
                                    <input type="hidden" name="image_id" value="<?= (int) $img['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger mb-1" onclick="return confirm('Xóa hình ảnh này?');">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted small mb-0">Sản phẩm này chưa có hình ảnh nào.</p>
        <?php endif; ?>
    </div>
</div>
