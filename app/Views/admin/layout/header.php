<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - PRELOVED</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url('css/admin.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex">

        <!-- Sidebar -->
        <nav class="sidebar p-3  text-white" style="width: 250px; min-height: 100vh;">
            <h4 class="fw-bold mb-4">PRELOVED <br><small>Admin</small></h4>

            <!-- Kembali ke Beranda (Modern Look) -->
            <a href="<?= base_url('/') ?>"
                class="btn btn-outline-light d-flex align-items-center mb-4 rounded-pill px-3 py-2 shadow-sm"
                style="font-size: 0.9rem;">
                <i class="bi bi-house-door me-2"></i> Beranda Utama
            </a>


            <?php
            $current = service('uri')->getSegment(2); // e.g. 'dashboard', 'users'
            function active($segment, $current)
            {
                return $segment === $current ? 'active text-white bg-primary rounded px-2 py-1' : 'text-white';
            }
            ?>

            <ul class="nav flex-column small">
                <li class="nav-item">
                    <a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= active('dashboard', $current) ?>">
                        <i class="bi bi-speedometer2 me-2"></i> Overview
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/users') ?>" class="nav-link <?= active('users', $current) ?>">
                        <i class="bi bi-people me-2"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/products') ?>" class="nav-link <?= active('products', $current) ?>">
                        <i class="bi bi-box me-2"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/orders') ?>" class="nav-link <?= active('orders', $current) ?>">
                        <i class="bi bi-cart-check me-2"></i> Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/categories') ?>"
                        class="nav-link <?= active('categories', $current) ?>">
                        <i class="bi bi-tags me-2"></i> Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/messages') ?>" class="nav-link <?= active('messages', $current) ?>">
                        <i class="bi bi-chat-dots me-2"></i> Messages
                    </a>
                </li>
            </ul>

            <form action="<?= base_url('/logout') ?>" method="post" class="mt-4">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-danger w-100">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </nav>

        <!-- Main Content -->
        <main class="p-4 w-100 bg-light">