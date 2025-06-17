<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - PrelovedMarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('/') ?>">PrelovedMarket</a>
        <div class="d-flex align-items-center">
            <span class="text-white me-3">Halo, <?= esc($user['name']) ?></span>
            <a href="<?= base_url('/logout') ?>" class="btn btn-outline-light">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">🛒 Produk Terbaru</h2>
        <?php if ($user['role'] === 'penjual') : ?>
            <a href="<?= base_url('/produk/create') ?>" class="btn btn-primary">+ Tambah Produk</a>
        <?php endif; ?>
    </div>

    <?php if (!empty($items)) : ?>
        <div class="row">
            <?php foreach ($items as $item) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card product-card shadow-sm h-100">
                        <img src="<?= base_url('uploads/' . $item['photo']) ?>" class="card-img-top" alt="<?= esc($item['title']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($item['title']) ?></h5>
                            <p class="card-text text-muted">Rp <?= number_format($item['price'], 0, ',', '.') ?></p>
                            <p class="badge bg-secondary"><?= ucfirst($item['condition']) ?></p>
                            
                            <?php if ($user['role'] === 'pembeli') : ?>
                                <a href="<?= base_url('/keranjang/tambah/' . $item['id']) ?>" class="btn btn-sm btn-success w-100">Tambah ke Keranjang</a>
                            <?php elseif ($user['role'] === 'penjual' && $item['user_id'] == $user['id']) : ?>
                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('/produk/edit/' . $item['id']) ?>" class="btn btn-sm btn-outline-primary w-50 me-1">Edit</a>
                                    <form action="<?= base_url('/produk/delete/' . $item['id']) ?>" method="post" onsubmit="return confirm('Hapus produk ini?')">
                                        <?= csrf_field() ?>
                                        <button class="btn btn-sm btn-outline-danger w-100">Hapus</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <div class="alert alert-warning">Belum ada produk tersedia.</div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
