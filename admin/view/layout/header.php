<?php


$flash      = viewGetFlash();
$activeMenu = $activeMenu ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= viewE($pageTitle ?? 'Quản trị | ' . APP_NAME) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?= viewAsset('css/dashboard.css') ?>" rel="stylesheet">
</head>
<body>
<div class="d-flex flex-column flex-lg-row dashboard-wrapper">
    <!-- SIDEBAR ADMIN -->
    <aside class="dashboard-sidebar p-3 d-flex flex-column">
        <div class="brand-box pb-3 mb-3 d-flex align-items-center justify-content-between">
            <a href="<?= viewUrl('/admin') ?>" class="text-white text-decoration-none fw-bold fs-5">
                <i class="bi bi-phone-fill text-danger me-2"></i><?= viewE(APP_NAME) ?>
                <span class="ui-style-2 badge bg-danger ms-1">ADMIN</span>
            </a>
        </div>

        <nav class="nav flex-column flex-grow-1">
            <a class="nav-link <?= $activeMenu === 'dashboard' ? 'active' : '' ?>" href="<?= viewUrl('/admin') ?>">
                <i class="bi bi-speedometer2 me-2"></i>Tổng quan
            </a>
            <a class="nav-link <?= $activeMenu === 'categories' ? 'active' : '' ?>" href="<?= viewUrl('/admin/categories') ?>">
                <i class="bi bi-tags me-2"></i>Quản lý danh mục
            </a>
            <a class="nav-link <?= $activeMenu === 'products' ? 'active' : '' ?>" href="<?= viewUrl('/admin/products') ?>">
                <i class="bi bi-phone me-2"></i>Quản lý sản phẩm
            </a>
            <a class="nav-link <?= $activeMenu === 'orders' ? 'active' : '' ?>" href="<?= viewUrl('/admin/orders') ?>">
                <i class="bi bi-receipt me-2"></i>Quản lý đơn hàng
            </a>
            <a class="nav-link <?= $activeMenu === 'users' ? 'active' : '' ?>" href="<?= viewUrl('/admin/users') ?>">
                <i class="bi bi-people me-2"></i>Người dùng & Phân quyền
            </a>
            <a class="nav-link <?= $activeMenu === 'reviews' ? 'active' : '' ?>" href="<?= viewUrl('/admin/reviews') ?>">
                <i class="bi bi-chat-square-text me-2"></i>Đánh giá & Bình luận
            </a>
        </nav>

        <div class="border-top border-secondary pt-3 mt-3">
            <a class="nav-link" href="<?= viewUrl('/') ?>">
                <i class="bi bi-shop me-2"></i>Xem trang bán hàng
            </a>
            <form action="<?= viewUrl('/logout') ?>" method="POST" class="mt-1">
                <?= viewCsrfField() ?>
                <button type="submit" class="btn btn-outline-light btn-sm w-100 text-start">
                    <i class="bi bi-box-arrow-right me-2"></i>Đăng xuất
                </button>
            </form>
        </div>
    </aside>

    <!-- KHU VỰC NỘI DUNG CHÍNH -->
    <div class="dashboard-main d-flex flex-column">
        <header class="dashboard-topbar px-4 py-3 d-flex justify-content-between align-items-center">
            <div class="fw-semibold text-secondary small">
                Hệ thống quản trị bán hàng điện thoại <?= viewE(APP_NAME) ?>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-danger">ADMIN</span>
                <span class="fw-semibold small"><?= viewE($currentUser['full_name'] ?? '') ?></span>
            </div>
        </header>

        <main class="p-4 flex-grow-1">
            <?php if ($flash): ?>
                <div class="alert alert-<?= viewE($flash['type']) ?> alert-dismissible fade show shadow-sm" role="alert">
                    <?= viewE($flash['message']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                </div>
            <?php endif; ?>

            