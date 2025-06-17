<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $this->renderSection('title') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body style="background-color: #f9f6f1;">
    <div class="container-fluid">
        <div class="row min-vh-100">
            <!-- Sidebar -->
            <aside class="col-md-3 col-lg-2 d-flex flex-column p-0" style="background-color: #4a2f00; color: #fff;">
                <div class="text-center py-4 border-bottom border-secondary">
                    <?php if (session()->get('photo')): ?>
                        <img src="<?= base_url('uploads/avatar/' . session()->get('photo')) ?>"
                            class="rounded-circle border mb-2" width="72" height="72" style="object-fit: cover;"
                            alt="Avatar">
                    <?php else: ?>
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-2"
                            style="width: 72px; height: 72px; font-size: 28px;">
                            <?= strtoupper(substr(session()->get('username'), 0, 1)) ?>
                        </div>
                    <?php endif; ?>
                    <div class="fw-semibold"><?= esc(session()->get('username')) ?></div>
                    <small class="text-capitalize"><?= esc(session()->get('role')) ?></small>
                </div>

                <!-- Menu -->
                <nav class="nav flex-column mt-3 px-2">
                    <a href="<?= base_url('/profile') ?>"
                        class="nav-link <?= uri_string() === 'profile' ? 'bg-warning text-dark fw-bold rounded' : 'text-white' ?>">
                        <i class="bi bi-person me-1"></i> Profil
                    </a>
                    <a href="<?= base_url('/user/create') ?>"
                        class="nav-link <?= uri_string() === 'user/create' ? 'bg-warning text-dark fw-bold rounded' : 'text-white' ?>">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Produk
                    </a>
                    <a href="<?= base_url('/product/my') ?>"
                        class="nav-link <?= uri_string() === 'product/my' ? 'bg-warning text-dark fw-bold rounded' : 'text-white' ?>">
                        <i class="bi bi-box-seam me-1"></i> Produk Saya
                    </a>
                    <a href="<?= base_url('/pesanan') ?>"
                        class="nav-link <?= uri_string() === 'pesanan' ? 'bg-warning text-dark fw-bold rounded' : 'text-white' ?>">
                        <i class="bi bi-receipt me-1"></i> Pesanan Saya
                    </a>
                    <a href="<?= base_url('/penjualan') ?>"
                        class="nav-link <?= uri_string() === 'penjualan' ? 'bg-warning text-dark fw-bold rounded' : 'text-white' ?>">
                        <i class="bi bi-bar-chart-line me-1"></i> Data Penjualan
                    </a>
                </nav>

                <!-- Footer Button -->
                <div class="mt-auto p-3">
                    <a href="<?= base_url('/') ?>" class="btn btn-outline-light w-100">
                        <i class="bi bi-house me-1"></i> Beranda
                    </a>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="col-md-9 col-lg-10 p-4">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <?= $this->renderSection('scripts') ?>
</body>

</html>