<?php

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Không có quyền truy cập | <?= viewE(APP_NAME) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center min-vh-100">
    <div class="container text-center">
        <div class="ui-style-1 card border-0 shadow-sm mx-auto">
            <div class="card-body p-5">
                <h1 class="display-4 fw-bold text-danger">403</h1>
                <h2 class="h5 fw-bold mb-3">Truy cập bị từ chối</h2>
                <p class="text-muted mb-4">
                    <?= viewE($message ?? 'Bạn không có quyền truy cập khu vực này.') ?>
                </p>
                <a href="<?= viewUrl('/') ?>" class="btn btn-danger px-4">Về trang chủ</a>
            </div>
        </div>
    </div>
</body>
</html>
