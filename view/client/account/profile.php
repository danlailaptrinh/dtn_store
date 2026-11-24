<?php

?>
<div class="row g-4">
    <div class="col-md-4 col-lg-3">
        <div class="card border-0 shadow-sm">
            <div class="list-group list-group-flush">
                <a href="<?= viewUrl('/account') ?>" class="list-group-item list-group-item-action active bg-danger border-danger">
                    <i class="bi bi-person me-2"></i>Thông tin cá nhân
                </a>
                <a href="<?= viewUrl('/account/edit') ?>" class="list-group-item list-group-item-action">
                    <i class="bi bi-pencil-square me-2"></i>Cập nhật hồ sơ & Mật khẩu
                </a>
                <a href="<?= viewUrl('/orders') ?>" class="list-group-item list-group-item-action">
                    <i class="bi bi-bag-check me-2"></i>Lịch sử đơn hàng
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-8 col-lg-9">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h5 fw-bold mb-0">Thông tin tài khoản</h1>
                    <a href="<?= viewUrl('/account/edit') ?>" class="btn btn-outline-dtd btn-sm">
                        <i class="bi bi-pencil me-1"></i>Chỉnh sửa
                    </a>
                </div>

                <table class="table table-borderless mb-0">
                    <tr>
                        <th class="ui-style-10 text-muted">Họ và tên:</th>
                        <td class="fw-semibold"><?= viewE($user['full_name']) ?></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Email:</th>
                        <td><?= viewE($user['email']) ?></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Số điện thoại:</th>
                        <td><?= viewE($user['phone'] ?: 'Chưa cập nhật') ?></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Địa chỉ:</th>
                        <td><?= viewE($user['address'] ?: 'Chưa cập nhật') ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
