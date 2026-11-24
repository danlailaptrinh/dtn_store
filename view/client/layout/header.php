<?php


$currentUser   = viewGetUser();
$cartCount     = viewCartCount();
$flash         = viewGetFlash();
$navCategories = $navCategories ?? [];
$keywordValue  = $keyword ?? '';
$activeCatSlug = $activeCategory['slug'] ?? '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= viewE($pageTitle ?? APP_NAME) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?= viewAsset('css/client.css') ?>" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
<!-- HEADER CHÍNH -->
    <header class="dtd-header text-white py-3 shadow-sm">
        <div class="container">
            <div class="row align-items-center g-3">
                <!-- Logo -->
                <div class="col-6 col-lg-3">
                    <a href="<?= viewUrl('/') ?>" class="text-white text-decoration-none d-inline-flex align-items-center gap-2">
                        <span class="bg-white text-danger rounded-3 px-2 py-1 fw-bold fs-5">
                            <i class="bi bi-phone-fill"></i>
                        </span>
                        <div>
                            <div class="fw-bold fs-5 lh-1"><?= viewE(APP_NAME) ?></div>
                            <small class="ui-style-3 opacity-75">Smartphone Chính Hãng</small>
                        </div>
                    </a>
                </div>

                <!-- Thanh tìm kiếm -->
                <div class="col-12 col-lg-5 order-3 order-lg-2">
                    <form action="<?= viewUrl('/products') ?>" method="GET" class="d-flex">
                        <input
                            type="text"
                            name="keyword"
                            class="form-control dtd-search-input"
                            placeholder="Tìm kiếm iPhone, Samsung, Xiaomi..."
                            value="<?= viewE($keywordValue) ?>"
                        >
                        <button type="submit" class="btn dtd-search-btn px-3" aria-label="Tìm kiếm">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>

                <!-- Tài khoản & Giỏ hàng -->
                <div class="col-6 col-lg-4 order-2 order-lg-3 d-flex justify-content-end align-items-center gap-2">
                    <!-- Giỏ hàng -->
                    <a href="<?= viewUrl('/cart') ?>" class="btn btn-outline-light position-relative btn-sm px-3 py-2">
                        <i class="bi bi-cart3 me-1"></i>
                        <span class="d-none d-sm-inline">Giỏ hàng</span>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
                            <?= (int) $cartCount ?>
                        </span>
                    </a>

                    <!-- Tài khoản -->
                    <?php if ($currentUser): ?>
                        <div class="dropdown">
                            <button class="btn btn-light text-danger fw-semibold btn-sm px-3 py-2 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>
                                <?= viewE($currentUser['full_name']) ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                <?php if (($currentUser['role_name'] ?? '') === 'admin'): ?>
                                    <li><a class="dropdown-item fw-semibold text-danger" href="<?= viewUrl('/admin') ?>"><i class="bi bi-speedometer2 me-2"></i>Trang quản trị Admin</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                <?php elseif (($currentUser['role_name'] ?? '') === 'employee'): ?>
                                    <li><a class="dropdown-item fw-semibold text-primary" href="<?= viewUrl('/employee') ?>"><i class="bi bi-clipboard-check me-2"></i>Khu vực Nhân viên</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="<?= viewUrl('/account') ?>"><i class="bi bi-person me-2"></i>Thông tin cá nhân</a></li>
                                <li><a class="dropdown-item" href="<?= viewUrl('/orders') ?>"><i class="bi bi-bag-check me-2"></i>Lịch sử đơn hàng</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="<?= viewUrl('/logout') ?>" method="POST" class="d-inline">
                                        <?= viewCsrfField() ?>
                                        <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="<?= viewUrl('/login') ?>" class="btn btn-light text-danger fw-semibold btn-sm px-3 py-2">
                            <i class="bi bi-person me-1"></i>
                            <span class="d-none d-sm-inline">Tài khoản</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <!-- MENU DANH MỤC ĐIỆN THOẠI -->
    <nav class="dtd-category-bar shadow-xs">
        <div class="container">
            <div class="d-flex align-items-center gap-2 py-2 overflow-auto">
                <a href="<?= viewUrl('/products') ?>"
                   class="dtd-category-link <?= ($activeCatSlug === '' && str_contains($_SERVER['REQUEST_URI'] ?? '', '/products')) ? 'active' : '' ?>">
                    <i class="bi bi-grid me-1"></i>Tất cả điện thoại
                </a>
                <?php foreach ($navCategories as $cat): ?>
                    <a href="<?= viewUrl('/category/' . $cat['slug']) ?>"
                       class="dtd-category-link <?= $activeCatSlug === $cat['slug'] ? 'active' : '' ?>">
                        <i class="bi bi-phone me-1"></i><?= viewE($cat['name']) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </nav>

    <!-- NỘI DUNG CHÍNH -->
    <main class="flex-grow-1 py-4">
        <div class="container">
            <?php if ($flash): ?>
                <div class="alert alert-<?= viewE($flash['type']) ?> alert-dismissible fade show shadow-sm" role="alert">
                    <?= viewE($flash['message']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                </div>
            <?php endif; ?>

            