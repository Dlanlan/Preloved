<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>PRELOVED - Discover Everything</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-lg">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand fw-bold" href="#">PRELOVED</a>

            <div class="d-none d-lg-flex gap-3">
                <a class="nav-link" href="#">Discover</a>
                <a class="nav-link" href="#">Apparel</a>
                <a class="nav-link" href="#">Bags</a>
                <a class="nav-link" href="#">Shoes</a>
                <a class="nav-link" href="#">Holiday Picks</a>
                <a class="nav-link" href="#">Others</a>
            </div>

            <div>
                <?php if (session()->has('isLoggedIn')): ?>
                    <div class="dropdown">
                        <a class="btn btn-sm nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <?= esc($user['username']) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
                            <li><a class="dropdown-item" href="<?= base_url('/profile') ?>">Profil</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('/settings') ?>">Pengaturan</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="<?= base_url('/logout') ?>" method="post" class="px-3">
                                    <?= csrf_field() ?>
                                    <button class="btn btn-sm text-danger w-100 text-start" type="submit"
                                        style="background:none; border:none;">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="<?= base_url('/login') ?>" class="nav-link">Login / Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Spacer -->
    <div style="height: 70px;"></div>

    <!-- Hero Section - Slider -->
    <div id="heroCarousel" class="carousel slide mb-5" data-bs-ride="carousel">

        <div class="carousel-inner" style="min-height: 300px;">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <section
                    class="hero-section text-center d-flex flex-column justify-content-center align-items-center text-white"
                    style="background-image: url('<?= base_url('assets/banner1.jpg') ?>'); background-size: cover; background-position: center; min-height: 300px;">
                    <h1 class="display-5 fw-bold hero-title mb-2">Discover Affordable Preloved Items</h1>
                    <p class="lead mb-3">Shop quality secondhand products at low prices</p>
                    <a href="#produk" class="btn btn-custom px-4 py-2">Shop Now</a>
                </section>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <section
                    class="hero-section text-center d-flex flex-column justify-content-center align-items-center text-white"
                    style="background-image: url('<?= base_url('assets/banner2.jpg') ?>'); background-size: cover; background-position: center; min-height: 300px;">
                    <h1 class="display-5 fw-bold hero-title mb-2">Great Deals Await</h1>
                    <p class="lead mb-3">Find handpicked preloved items just for you</p>
                    <a href="#produk" class="btn btn-custom px-4 py-2">Explore</a>
                </section>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item">
                <section
                    class="hero-section text-center d-flex flex-column justify-content-center align-items-center text-white"
                    style="background-image: url('<?= base_url('assets/banner3.jpg') ?>'); background-size: cover; background-position: center; min-height: 300px;">
                    <h1 class="display-5 fw-bold hero-title mb-2">Sustainable Style</h1>
                    <p class="lead mb-3">Reduce waste, shop smart, and stay stylish</p>
                    <a href="#produk" class="btn btn-custom px-4 py-2">Get Started</a>
                </section>
            </div>
        </div>

        <!-- Kategori Bulat - Button -->
        <div class="kategori-floating position-relative" style="margin-top: -40px; z-index: 10;">
            <div class="d-flex justify-content-center gap-3 gap-md-4 gap-lg-5">
                <div class="text-center">
                    <button
                        class="rounded-circle bg-white shadow border-0 d-flex align-items-center justify-content-center"
                        style="width: 60px; height: 60px;">
                        👚
                    </button>
                    <small class="d-block mt-1 fw-semibold text-dark">Apparel</small>
                </div>
                <div class="text-center">
                    <button
                        class="rounded-circle bg-white shadow border-0 d-flex align-items-center justify-content-center"
                        style="width: 60px; height: 60px;">
                        👜
                    </button>
                    <small class="d-block mt-1 fw-semibold text-dark">Bags</small>
                </div>
                <div class="text-center">
                    <button
                        class="rounded-circle bg-white shadow border-0 d-flex align-items-center justify-content-center"
                        style="width: 60px; height: 60px;">
                        👟
                    </button>
                    <small class="d-block mt-1 fw-semibold text-dark">Shoes</small>
                </div>
                <div class="text-center">
                    <button
                        class="rounded-circle bg-white shadow border-0 d-flex align-items-center justify-content-center"
                        style="width: 60px; height: 60px;">
                        🎁
                    </button>
                    <small class="d-block mt-1 fw-semibold text-dark">Holiday</small>
                </div>
                <div class="text-center">
                    <button
                        class="rounded-circle bg-white shadow border-0 d-flex align-items-center justify-content-center"
                        style="width: 60px; height: 60px;">
                        🧾
                    </button>
                    <small class="d-block mt-1 fw-semibold text-dark">Others</small>
                </div>
            </div>
        </div>



        <!-- Navigasi Panah -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>




    <!-- Produk Section -->
    <div class="container py-5" id="produk">
        <h3 class="mb-4 text-center">Produk Terbaru</h3>
        <?php if (!empty($items)): ?>
            <div class="row g-4">
                <?php foreach ($items as $item): ?>
                    <div class="col-6 col-md-3 col-lg-2"> <!-- sebelumnya col-md-3 -->
                        <div class="card product-card h-100">
                            <img src="<?= base_url('uploads/' . $item['photo']) ?>" class="card-img-top"
                                alt="<?= esc($item['title']) ?>">
                            <div class="card-body">
                                <h6 class="card-title"><?= esc($item['title']) ?></h6>
                                <p class="text-muted mb-1 small">Rp <?= number_format($item['price'], 0, ',', '.') ?></p>
                                <span class="badge badge-highlight"><?= ucfirst($item['condition']) ?></span>

                                <?php if (isset($user) && $user['role'] === 'pembeli'): ?>
                                    <a href="<?= base_url('/keranjang/tambah/' . $item['id']) ?>"
                                        class="btn btn-success btn-sm w-100 mt-2">Tambah ke Keranjang</a>
                                <?php elseif (isset($user) && $user['role'] === 'penjual' && $item['user_id'] == $user['id']): ?>
                                    <div class="d-flex justify-content-between mt-2">
                                        <a href="<?= base_url('/produk/edit/' . $item['id']) ?>"
                                            class="btn btn-outline-primary btn-sm w-50 me-1">Edit</a>
                                        <form action="<?= base_url('/produk/delete/' . $item['id']) ?>" method="post"
                                            onsubmit="return confirm('Hapus produk ini?')">
                                            <?= csrf_field() ?>
                                            <button class="btn btn-outline-danger btn-sm w-100">Hapus</button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center mt-5">Belum ada produk tersedia.</div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer>
        &copy; <?= date('Y') ?> PRELOVED. Semua hak dilindungi.
    </footer>

    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>