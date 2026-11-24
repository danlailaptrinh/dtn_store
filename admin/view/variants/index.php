<?php

?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h1 class="h4 fw-bold mb-1">Quản lý biến thể: <?= viewE($product['product_name']) ?></h1>
        <p class="text-muted small mb-0">
            Thương hiệu: <strong><?= viewE($product['brand']) ?></strong> •
            Mỗi tổ hợp <strong>RAM + Dung lượng + Màu sắc</strong> là duy nhất.
        </p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= viewUrl('/admin/products/' . (int) $product['product_id'] . '/images') ?>" class="btn btn-outline-info btn-sm">
            <i class="bi bi-images me-1"></i>Quản lý ảnh
        </a>
        <a href="<?= viewUrl('/admin/products/edit/' . (int) $product['product_id']) ?>" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-pencil me-1"></i>Sửa thông tin máy
        </a>
        <a href="<?= viewUrl('/admin/products') ?>" class="btn btn-outline-secondary btn-sm">Quay lại</a>
    </div>
</div>

<div class="row g-4">
    <!-- FORM THÊM BIẾN THỂ MỚI -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h2 class="h6 fw-bold mb-3"><i class="bi bi-plus-circle text-danger me-1"></i>Thêm biến thể mới</h2>

                <form method="GET" action="#" onsubmit="return false;">
                    <div class="mb-3"><label class="form-label">RAM (GB)</label><input type="number" class="form-control" min="0" placeholder="8" disabled></div>
                    <div class="mb-3"><label class="form-label">Dung lượng (GB)</label><input type="number" class="form-control" min="1" placeholder="256" disabled></div>
                    <div class="mb-3"><label class="form-label">Màu sắc</label><input type="text" class="form-control" placeholder="Titan đen" disabled></div>
                    <div class="mb-3"><label class="form-label">SKU</label><input type="text" class="form-control" placeholder="IP-256" disabled></div>
                    <div class="mb-3"><label class="form-label">Giá bán</label><input type="number" class="form-control" placeholder="29990000" disabled></div>
                    <div class="mb-3"><label class="form-label">Tồn kho</label><input type="number" class="form-control" placeholder="10" disabled></div>
                    <div class="mb-3"><label class="form-label">Khuyến mãi</label><select class="form-select" disabled><option>Có khuyến mãi</option></select></div>
                    <button type="button" class="btn btn-dtd w-100" disabled>Thêm biến thể (bước sau)</button>
                </form>
            </div>
        </div>
    </div>

    <!-- DANH SÁCH BIẾN THỂ HIỆN CÓ -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="p-4 pb-2">
                    <h2 class="h6 fw-bold mb-0">Danh sách biến thể (<?= count($variants) ?>)</h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small text-uppercase">
                            <tr>
                                <th>RAM</th>
                                <th>Dung lượng</th>
                                <th>Màu sắc</th>
                                <th>SKU</th>
                                <th class="text-end">Giá bán</th>
                                <th>Tồn kho / KM</th>
                                <th class="text-end">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($variants)): ?>
                                <?php foreach ($variants as $v): ?>
                                    <tr>
                                        <td class="fw-semibold"><?= viewE($v['ram']) ?></td>
                                        <td><span class="badge bg-light text-dark border"><?= viewE($v['storage']) ?></span></td>
                                        <td><?= viewE($v['color']) ?></td>
                                        <td><?= viewE($v['sku']) ?></td>
                                        <td class="text-end fw-bold text-danger">
                                            <?= viewPrice($v['sale_price']) ?>
                                        </td>
                                        <td><?= (int)$v['stock_quantity'] ?> / <?= (int)$v['is_on_sale']?'Có':'Không' ?></td>
                                        <td class="text-end text-nowrap"><button class="btn btn-sm btn-outline-primary" disabled>Sửa</button> <button class="btn btn-sm btn-outline-danger" disabled>Xóa</button></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="7" class="text-center text-muted py-4">Chưa có biến thể nào. Hãy thêm biến thể ở khung bên trái.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
