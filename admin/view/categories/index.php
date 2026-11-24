<?php

?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h1 class="h4 fw-bold mb-1">Quản lý danh mục (Thương hiệu)</h1>
        <p class="text-muted small mb-0">Tổng số: <strong><?= (int) $totalItems ?></strong> danh mục</p>
    </div>
    <a href="<?= viewUrl('/admin/categories/create') ?>" class="btn btn-dtd">
        <i class="bi bi-plus-circle me-1"></i>Thêm danh mục
    </a>
</div>

<form action="<?= viewUrl('/admin/categories') ?>" method="GET" class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="row g-2 align-items-center">
            <div class="col-md-6">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm theo tên hoặc mô tả danh mục..." value="<?= viewE($keyword) ?>">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-dtd"><i class="bi bi-search me-1"></i>Tìm kiếm</button>
                <a href="<?= viewUrl('/admin/categories') ?>" class="btn btn-outline-secondary">Đặt lại</a>
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
                    <th>Tên danh mục</th>
                    <th>Slug</th>
                    <th>Số điện thoại</th>
                    <th>Trạng thái</th>
                    <th class="text-end">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $cat): ?>
                        <tr>
                            <td>#<?= (int) $cat['id'] ?></td>
                            <td>
                                <div class="fw-semibold"><?= viewE($cat['name']) ?></div>
                                <?php if (!empty($cat['description'])): ?>
                                    <div class="small text-muted"><?= viewE($cat['description']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td><code><?= viewE($cat['slug']) ?></code></td>
                            <td><span class="badge bg-light text-dark border"><?= (int) $cat['product_count'] ?> sản phẩm</span></td>
                            <td>
                                <?= (int) $cat['status'] === 1
                                    ? '<span class="badge bg-success">Hiển thị</span>'
                                    : '<span class="badge bg-secondary">Ẩn</span>' ?>
                            </td>
                            <td class="text-end">
                                <a href="<?= viewUrl('/admin/categories/edit/' . (int) $cat['id']) ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i> Sửa
                                </a>
                                <form action="<?= viewUrl('/admin/categories/delete') ?>" method="POST" class="d-inline">
                                    <?= viewCsrfField() ?>
                                    <input type="hidden" name="category_id" value="<?= (int) $cat['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xác nhận xóa danh mục này?');">
                                        <i class="bi bi-trash"></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center text-muted py-4">Không tìm thấy danh mục nào.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if ($totalPages > 1): ?>
    <nav class="mt-4 d-flex justify-content-center">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php $url = viewUrl('/admin/categories') . '?' . http_build_query(array_filter(['keyword' => $keyword, 'page' => $i])); ?>
                <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                    <a class="page-link <?= $i === $currentPage ? 'bg-danger border-danger' : 'text-danger' ?>" href="<?= viewE($url) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>
