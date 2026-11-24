<?php


?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h4 fw-bold mb-1">Thêm điện thoại mới</h1>
        <p class="text-muted small mb-0">
            Nhập thông tin điện thoại để thêm vào cửa hàng
        </p>
    </div>

    <a href="/admin/index.php?route=/admin/products"
        class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Quay lại
    </a>
</div>


<form
    action="/admin/index.php?route=/admin/products/store"
    method="POST"
    enctype="multipart/form-data">


    <?= viewCsrfField() ?>

    <div class="row g-4">

        <!-- CỘT TRÁI -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">

                    <h2 class="h6 fw-bold mb-3">
                        Thông tin điện thoại
                    </h2>

                    <div class="mb-3">
                        <label class="form-label">Tên điện thoại *</label>
                        <input type="text"
                            name="product_name"
                            class="form-control"
                            placeholder="Ví dụ: iPhone 17 Pro Max"
                            required>
                    </div>

                    <div class="row g-3 mb-3">

                        <div class="col-md-6">
                            <label class="form-label">Danh mục *</label>
                            <select name="category_id"
                                class="form-select"
                                required>
                                <option value="">Chọn danh mục</option>

                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= (int)$cat['id'] ?>">
                                        <?= viewE($cat['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Thương hiệu *</label>
                            <input type="text"
                                name="brand"
                                class="form-control"
                                placeholder="Apple, Samsung..."
                                required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mô tả sản phẩm</label>
                        <textarea name="description"
                            class="form-control"
                            rows="4"
                            placeholder="Nhập mô tả..."></textarea>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Màn hình</label>
                            <input type="text"
                                name="screen"
                                class="form-control"
                                placeholder="6.9 inch OLED">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Chip</label>
                            <input type="text"
                                name="chip"
                                class="form-control"
                                placeholder="Apple A18 Pro">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Giá niêm yết</label>
                            <input type="number"
                                name="list_price"
                                class="form-control"
                                min="0"
                                placeholder="29990000">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Giá cũ</label>
                            <input type="number"
                                name="old_price"
                                class="form-control"
                                min="0"
                                placeholder="34990000">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nhãn khuyến mãi</label>
                        <input type="text"
                            name="promotion_label"
                            class="form-control"
                            placeholder="Bán chạy, Giảm 10%...">
                    </div>

                    <div>
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="dang_ban">Đang bán</option>
                            <option value="ngung_ban">Ngừng bán</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- CỘT PHẢI -->
        <div class="col-lg-5">

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">

                    <h2 class="h6 fw-bold mb-3">
                        Hình ảnh sản phẩm
                    </h2>

                    <input type="file"
                        name="images[]"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                        multiple>

                    <p class="small text-muted mt-2">
                        Chọn nhiều ảnh JPG, PNG hoặc WEBP.
                        Ảnh sẽ được xử lý ở bước lưu dữ liệu.
                    </p>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">

                    <h2 class="h6 fw-bold mb-3">
                        Biến thể đầu tiên
                    </h2>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label">RAM (GB)</label>
                            <input type="number"
                                name="init_ram"
                                class="form-control"
                                min="0"
                                placeholder="8">
                        </div>

                        <div class="col-6">
                            <label class="form-label">Dung lượng (GB)</label>
                            <input type="number"
                                name="init_storage"
                                class="form-control"
                                min="0"
                                placeholder="256">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Màu sắc</label>
                        <input type="text"
                            name="init_color"
                            class="form-control"
                            placeholder="Titan đen">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mã SKU</label>
                        <input type="text"
                            name="init_sku"
                            class="form-control"
                            placeholder="IP17PM-256-BLACK">
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label">Giá bán</label>
                            <input type="number"
                                name="init_sale_price"
                                class="form-control"
                                min="0"
                                placeholder="29990000">
                        </div>

                        <div class="col-6">
                            <label class="form-label">Số lượng tồn</label>
                            <input type="number"
                                name="init_stock"
                                class="form-control"
                                min="0"
                                placeholder="10">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dtd w-100">
                        <i class="bi bi-save me-1"></i>
                        Lưu sản phẩm
                    </button>

                </div>
            </div>
        </div>
    </div>
</form>