<?php

?>
<div class="row g-4">
    <div class="col-md-4 col-lg-3">
        <div class="card border-0 shadow-sm">
            <div class="list-group list-group-flush">
                <a href="<?= viewUrl('/account') ?>" class="list-group-item list-group-item-action">
                    <i class="bi bi-person me-2"></i>Thông tin cá nhân
                </a>
                <a href="<?= viewUrl('/account/edit') ?>" class="list-group-item list-group-item-action active bg-danger border-danger">
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
                <h1 class="h5 fw-bold mb-4">Cập nhật thông tin & Đổi mật khẩu</h1>

                <form action="<?= viewUrl('/account/update') ?>" method="POST">
                    <?= viewCsrfField() ?>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Họ và tên</label>
                        <input type="text" name="full_name" class="form-control" value="<?= viewE($user['full_name']) ?>" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control" value="<?= viewE($user['phone'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Email (không thay đổi)</label>
                            <input type="email" class="form-control bg-light" value="<?= viewE($user['email']) ?>" disabled>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-semibold">Địa chỉ giao hàng</label>
                        <input type="text" name="address" class="form-control" value="<?= viewE($user['address'] ?? '') ?>">
                    </div>

                    <hr class="my-4">
                    <h2 class="h6 fw-bold mb-3">Đổi mật khẩu (bỏ trống nếu không đổi)</h2>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Mật khẩu hiện tại</label>
                            <input type="password" name="current_password" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Mật khẩu mới</label>
                            <input type="password" name="new_password" class="form-control" minlength="6">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">Nhập lại mật khẩu mới</label>
                            <input type="password" name="confirm_new_password" class="form-control" minlength="6">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dtd px-4">Lưu thay đổi</button>
                </form>
            </div>
        </div>
    </div>
</div>
