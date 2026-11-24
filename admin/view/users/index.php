<?php

?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h1 class="h4 fw-bold mb-1">Quản lý người dùng & Phân quyền</h1>
        <p class="text-muted small mb-0">Tổng số: <strong><?= (int) $totalItems ?></strong> tài khoản</p>
    </div>
    <a href="<?= viewUrl('/admin/users/create') ?>" class="btn btn-dtd">
        <i class="bi bi-person-plus me-1"></i>Tạo tài khoản nhân viên / người dùng
    </a>
</div>

<!-- TÌM KIẾM & LỌC VAI TRÒ -->
<form action="<?= viewUrl('/admin/users') ?>" method="GET" class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="row g-3 align-items-end">
            <div class="col-md-5">
                <label class="form-label small fw-semibold">Tìm kiếm (Tên, Email, SĐT)</label>
                <input type="text" name="keyword" class="form-control" value="<?= viewE($keyword) ?>" placeholder="Nhập từ khóa...">
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-semibold">Lọc theo vai trò</label>
                <select name="role" class="form-select">
                    <option value="">Tất cả vai trò</option>
                    <?php foreach ($roles as $r): ?>
                        <option value="<?= viewE($r['name']) ?>" <?= $roleFilter === $r['name'] ? 'selected' : '' ?>>
                            <?= viewE(strtoupper($r['name'])) ?> - <?= viewE($r['description']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-dtd w-100"><i class="bi bi-search me-1"></i>Tìm kiếm</button>
                <a href="<?= viewUrl('/admin/users') ?>" class="btn btn-outline-secondary">Đặt lại</a>
            </div>
        </div>
    </div>
</form>

<!-- BẢNG DANH SÁCH NGƯỜI DÙNG -->
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small text-uppercase">
                <tr>
                    <th>ID</th>
                    <th>Họ và tên</th>
                    <th>Email</th>
                    <th>SĐT</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                    <th class="text-end">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $u): ?>
                        <?php
                        $roleBadge = match ($u['role_name']) {
                            'admin'    => 'bg-danger',
                            'employee' => 'bg-primary',
                            default    => 'bg-secondary',
                        };
                        ?>
                        <tr>
                            <td>#<?= (int) $u['id'] ?></td>
                            <td class="fw-semibold"><?= viewE($u['full_name']) ?></td>
                            <td><?= viewE($u['email']) ?></td>
                            <td><?= viewE($u['phone'] ?: '-') ?></td>
                            <td><span class="badge <?= $roleBadge ?>"><?= viewE(strtoupper($u['role_name'])) ?></span></td>
                            <td>
                                <?php if ((int) $u['status'] === 1): ?>
                                    <span class="badge bg-success">Hoạt động</span>
                                <?php else: ?>
                                    <span class="badge bg-dark">Đã khóa</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <a href="<?= viewUrl('/admin/users/' . (int) $u['id']) ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye me-1"></i>Chi tiết & Quyền
                                </a>

                                <?php if ((int) $u['id'] !== (int) $currentUser['id']): ?>
                                    <form action="<?= viewUrl('/admin/users/toggle-status') ?>" method="POST" class="d-inline">
                                        <?= viewCsrfField() ?>
                                        <input type="hidden" name="user_id" value="<?= (int) $u['id'] ?>">
                                        <?php if ((int) $u['status'] === 1): ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xác nhận khóa tài khoản này?');">
                                                <i class="bi bi-lock"></i> Khóa
                                            </button>
                                        <?php else: ?>
                                            <button type="submit" class="btn btn-sm btn-outline-success">
                                                <i class="bi bi-unlock"></i> Mở khóa
                                            </button>
                                        <?php endif; ?>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center text-muted py-4">Không có người dùng nào phù hợp.</td></tr>
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
                $url = viewUrl('/admin/users') . '?' . http_build_query(array_filter([
                    'keyword' => $keyword,
                    'role'    => $roleFilter,
                    'page'    => $i,
                ]));
                ?>
                <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                    <a class="page-link <?= $i === $currentPage ? 'bg-danger border-danger' : 'text-danger' ?>" href="<?= viewE($url) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>
