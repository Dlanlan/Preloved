<!-- NAVBAR ATAS -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #5a3601;">
    <div class="container-fluid px-4">
        <!-- Logo -->
        <a class="navbar-brand fw-bold text-white me-4" href="<?= base_url('/') ?>">PRELOVED</a>

        <!-- Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavbar"
            aria-controls="topNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="topNavbar">
            <!-- Search Bar -->
            <form method="get" action="<?= base_url('/katalog') ?>" class="d-flex me-auto"
                style="max-width: 400px; width: 100%;">
                <input type="text" name="search" class="form-control" placeholder="Cari produk..."
                    value="<?= esc($_GET['search'] ?? '') ?>">
            </form>

            <!-- User Menu -->
            <div class="d-flex align-items-center ms-3">
                <?php if (session()->has('isLoggedIn')): ?>
                    <div class="dropdown">
                        <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" href="#"
                            id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php if (session()->get('photo')): ?>
                                <img src="<?= base_url('uploads/avatar/' . session()->get('photo')) ?>" alt="Avatar"
                                    class="rounded-circle me-2" width="36" height="36" style="object-fit: cover;">
                            <?php else: ?>
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-2"
                                    style="width: 36px; height: 36px; font-size: 14px;">
                                    <?= strtoupper(substr(session()->get('username'), 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
                            <li>
                                <a class="dropdown-item" href="<?= base_url('/profile') ?>">
                                    Profil
                                </a>
                            </li>

                            <?php if (session()->get('role') === 'admin'): ?>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('/admin/dashboard') ?>">
                                        Dashboard Admin
                                    </a>
                                </li>
                            <?php elseif (session()->get('role') === 'user'): ?>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('/pesanan') ?>">Pesanan Saya</a>
                                </li>
                            <?php endif; ?>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="<?= base_url('/logout') ?>" method="post" class="px-3">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm text-danger w-100 text-start"
                                        style="background: none; border: none;">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="<?= base_url('/login') ?>" class="btn btn-sm btn-dark">Login / Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- NAVBAR BAWAH -->
<nav class="navbar navbar-expand navbar-dark py-1" style="background-color: #4a2f00;">
    <div class="container-fluid px-4">
        <ul class="navbar-nav me-auto text-uppercase fw-semibold small">
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url('/') ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url('/katalog') ?>">Katalog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url('/about') ?>">Tentang Kami</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url('/contact') ?>">Kontak</a>
            </li>
        </ul>
    </div>
</nav>