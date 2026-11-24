<?php

?>
<div class="row justify-content-center py-3">
    <div class="col-md-7 col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <h1 class="h4 fw-bold mb-1">Đăng ký tài khoản</h1>
                    <p class="text-muted small mb-0">Tạo tài khoản khách hàng tại <?= viewE(APP_NAME) ?></p>
                </div>

                <form action="<?= viewUrl('/register') ?>" method="POST">
                    <?= viewCsrfField() ?>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Họ và tên <span class="text-danger">*</span></label>
                        <input type="text" name="full_name" class="form-control" placeholder="Nguyễn Văn A" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="email@gmail.com" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" placeholder="09xxxxxxxx" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Địa chỉ giao hàng</label>
                        <input type="text" name="address" class="form-control" placeholder="Số nhà, đường, quận/huyện, tỉnh/thành">
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Mật khẩu <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" minlength="6" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                            <input type="password" name="confirm_password" class="form-control" minlength="6" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dtd w-100 py-2 mb-3">
                        <i class="bi bi-person-plus me-1"></i>Tạo tài khoản
                    </button>
                </form>

                <div class="text-center small">
                    Đã có tài khoản?
                    <a href="<?= viewUrl('/login') ?>" class="text-danger fw-semibold text-decoration-none">Đăng nhập</a>
                </div>
            </div>
        </div>
    </div>
</div>
