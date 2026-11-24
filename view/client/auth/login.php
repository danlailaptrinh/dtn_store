<?php

?>
<div class="row justify-content-center py-3">
    <div class="col-md-6 col-lg-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <h1 class="h4 fw-bold mb-1">Đăng nhập <?= viewE(APP_NAME) ?></h1>
                    <p class="text-muted small mb-0">Đăng nhập để đặt hàng và theo dõi lịch sử mua sắm</p>
                </div>

                <form action="<?= viewUrl('/login') ?>" method="POST">
                    <?= viewCsrfField() ?>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small">Mật khẩu</label>
                        <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
                    </div>

                    <button type="submit" class="btn btn-dtd w-100 py-2 mb-3">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Đăng nhập
                    </button>
                </form>

                <div class="text-center small">
                    Chưa có tài khoản?
                    <a href="<?= viewUrl('/register') ?>" class="text-danger fw-semibold text-decoration-none">Đăng ký ngay</a>
                </div>
            </div>
        </div>
    </div>
</div>
