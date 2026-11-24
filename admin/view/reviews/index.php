<?php


$currentQuery = http_build_query(array_filter([
    'keyword' => $filters['keyword'] ?? '',
    'rating'  => $filters['rating'] ?? '',
    'status'  => $filters['status'] ?? '',
    'page'    => $currentPage > 1 ? $currentPage : null,
], fn($v) => $v !== '' && $v !== null));
?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h1 class="h4 fw-bold mb-1">Quản lý đánh giá & bình luận</h1>
        <p class="text-muted small mb-0">Tổng số: <strong><?= (int) $totalItems ?></strong> đánh giá</p>
    </div>
</div>

<!-- BỘ LỌC ĐÁNH GIÁ -->
<form action="<?= viewUrl('/admin/reviews') ?>" method="GET" class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="row g-3 align-items-end">
            <div class="col-md-5">
                <label class="form-label small fw-semibold">Tìm kiếm</label>
                <input
                    type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Tên sản phẩm, khách hàng, email hoặc nội dung..."
                    value="<?= viewE($filters['keyword'] ?? '') ?>">
            </div>

            <div class="col-md-3">
                <label class="form-label small fw-semibold">Số sao</label>
                <select name="rating" class="form-select">
                    <option value="">Tất cả số sao</option>
                    <?php for ($r = 5; $r >= 1; $r--): ?>
                        <option value="<?= $r ?>" <?= (string) ($filters['rating'] ?? '') === (string) $r ? 'selected' : '' ?>>
                            <?= $r ?> sao
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label small fw-semibold">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="">Tất cả</option>
                    <option value="1" <?= ($filters['status'] ?? '') === '1' ? 'selected' : '' ?>>Đang hiển thị</option>
                    <option value="0" <?= ($filters['status'] ?? '') === '0' ? 'selected' : '' ?>>Đang ẩn</option>
                </select>
            </div>

            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-dtd w-100"><i class="bi bi-search me-1"></i>Lọc</button>
                <a href="<?= viewUrl('/admin/reviews') ?>" class="btn btn-outline-secondary" title="Đặt lại">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            </div>
        </div>
    </div>
</form>

<!-- BẢNG DANH SÁCH ĐÁNH GIÁ -->
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small text-uppercase">
                <tr>
                    <th>Khách hàng</th>
                    <th>Sản phẩm</th>
                    <th>Số sao</th>
                    <th class="ui-style-18">Bình luận</th>
                    <th>Trạng thái</th>
                    <th>Ngày gửi</th>
                    <th class="ui-style-19 text-end">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reviews)): ?>
                    <?php foreach ($reviews as $review): ?>
                        <?php $isVisible = (int) $review['status'] === 1; ?>
                        <tr>
                            <td>
                                <div class="fw-semibold"><?= viewE($review['user_name']) ?></div>
                                <div class="small text-muted"><?= viewE($review['user_email']) ?></div>
                            </td>
                            <td>
                                <?php if ((int) $review['product_status'] === 1): ?>
                                    <a href="<?= viewUrl('/product/' . $review['product_slug']) ?>#reviews" target="_blank" class="text-decoration-none fw-semibold text-dark">
                                        <?= viewE($review['product_name']) ?>
                                        <i class="bi bi-box-arrow-up-right small text-muted ms-1"></i>
                                    </a>
                                <?php else: ?>
                                    <span class="fw-semibold text-muted"><?= viewE($review['product_name']) ?></span>
                                    <div class="small text-muted">(Đang ngừng bán)</div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="text-warning text-nowrap" title="<?= (int) $review['rating'] ?>/5 sao">
                                    <?php for ($s = 1; $s <= 5; $s++): ?>
                                        <i class="bi <?= $s <= (int) $review['rating'] ? 'bi-star-fill' : 'bi-star' ?>"></i>
                                    <?php endfor; ?>
                                </div>
                                <small class="text-muted"><?= (int) $review['rating'] ?>/5</small>
                            </td>
                            <td class="small text-secondary">
                                <?= nl2br(viewE($review['comment'])) ?>
                            </td>
                            <td>
                                <?php if ($isVisible): ?>
                                    <span class="badge bg-success">Đang hiển thị</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Đang ẩn</span>
                                <?php endif; ?>
                            </td>
                            <td class="small text-muted text-nowrap">
                                <?= viewE(date('d/m/Y H:i', strtotime($review['created_at']))) ?>
                            </td>
                            <td class="text-end text-nowrap">
                                <form action="<?= viewUrl('/admin/reviews/toggle-status') ?>" method="POST" class="d-inline">
                                    <?= viewCsrfField() ?>
                                    <input type="hidden" name="review_id" value="<?= (int) $review['id'] ?>">
                                    <input type="hidden" name="return_query" value="<?= viewE($currentQuery) ?>">
                                    <?php if ($isVisible): ?>
                                        <button type="submit" class="btn btn-sm btn-outline-warning" title="Ẩn đánh giá này">
                                            <i class="bi bi-eye-slash me-1"></i>Ẩn
                                        </button>
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-sm btn-outline-success" title="Hiển thị lại đánh giá này">
                                            <i class="bi bi-eye me-1"></i>Hiện
                                        </button>
                                    <?php endif; ?>
                                </form>

                                <form action="<?= viewUrl('/admin/reviews/delete') ?>" method="POST" class="d-inline ms-1" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn đánh giá này?');">
                                    <?= viewCsrfField() ?>
                                    <input type="hidden" name="review_id" value="<?= (int) $review['id'] ?>">
                                    <input type="hidden" name="return_query" value="<?= viewE($currentQuery) ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa đánh giá">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Không tìm thấy đánh giá nào phù hợp.</td>
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
                $url = viewUrl('/admin/reviews') . '?' . http_build_query(array_filter([
                    'keyword' => $filters['keyword'] ?? '',
                    'rating'  => $filters['rating'] ?? '',
                    'status'  => $filters['status'] ?? '',
                    'page'    => $i,
                ], fn($v) => $v !== '' && $v !== null));
                ?>
                <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                    <a class="page-link <?= $i === $currentPage ? 'bg-danger border-danger' : 'text-danger' ?>" href="<?= viewE($url) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>