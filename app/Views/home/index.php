<?= $this->extend('layout/home') ?>

<?= $this->section('title') ?>
PRELOVED - Discover Everything
<?= $this->endSection() ?>

<?= $this->section('content') ?>

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

    <!-- Kategori Bulat -->
    <div class="kategori-floating position-relative" style="margin-top: -40px; z-index: 10;">
        <div class="d-flex justify-content-center gap-3 gap-md-4 gap-lg-5">
            <?php
            $categories = [
                '👚' => ['label' => 'Apparel', 'slug' => 'apparel'],
                '👜' => ['label' => 'Bags', 'slug' => 'bags'],
                '👟' => ['label' => 'Shoes', 'slug' => 'shoes'],
                '🎁' => ['label' => 'Holiday', 'slug' => 'holiday'],
                '🧾' => ['label' => 'Others', 'slug' => 'others']
            ];
            foreach ($categories as $icon => $cat): ?>
                <div class="text-center">
                    <a href="<?= base_url('kategori/' . $cat['slug']) ?>" class="text-decoration-none">
                        <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center"
                            style="width: 60px; height: 60px;">
                            <span class="fs-4"><?= $icon ?></span>
                        </div>
                        <small class="d-block mt-1 fw-semibold text-dark"><?= esc($cat['label']) ?></small>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Navigasi Carousel -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Produk Section -->
<div class="container py-5" id="produk">
    <h3 class="mb-4 text-center fw-semibold">Produk Terbaru</h3>

    <?php if (!empty($items)): ?>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php foreach ($items as $item): ?>
                <div class="col">
                    <div class="card border-0 shadow-sm h-100 rounded-4 product-card">
                        <div data-bs-toggle="modal" data-bs-target="#previewModal<?= $item['id'] ?>" style="cursor: pointer;">
                            <img src="<?= base_url('uploads/' . $item['photo']) ?>" class="card-img-top rounded-top"
                                alt="<?= esc($item['title']) ?>">
                        </div>
                        <div class="card-body">
                            <h6 class="card-title mb-1 fw-semibold"><?= esc($item['title']) ?></h6>
                            <p class="text-muted small mb-1">Rp <?= number_format($item['price'], 0, ',', '.') ?></p>
                            <span class="badge bg-warning text-dark"><?= ucfirst($item['product_condition']) ?></span>
                        </div>
                    </div>
                </div>

                <!-- Modal Preview -->
                <div class="modal fade" id="previewModal<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0 rounded-4 shadow">
                            <div class="modal-body p-4 position-relative">
                                <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                <div class="row g-4 align-items-center">
                                    <div class="col-md-5">
                                        <img src="<?= base_url('uploads/' . $item['photo']) ?>"
                                            class="img-fluid rounded-4 shadow-sm w-100" alt="<?= esc($item['title']) ?>">
                                    </div>
                                    <div class="col-md-7">
                                        <h5 class="fw-bold mb-2 text-uppercase"><?= esc($item['title']) ?></h5>
                                        <p class="text-muted small mb-3"><?= esc($item['description']) ?></p>
                                        <h5 class="text-warning fw-semibold mb-2">Rp
                                            <?= number_format($item['price'], 0, ',', '.') ?>
                                        </h5>
                                        <span
                                            class="badge bg-secondary px-3 py-2 rounded-pill text-capitalize mb-4"><?= esc($item['product_condition']) ?></span>

                                        <div class="d-grid gap-2">
                                            <?php if (isset($user) && $user['role'] === 'user'): ?>
                                                <?php if ($user['id'] === $item['user_id']): ?>
                                                    <a href="<?= base_url('/product/edit/' . $item['id']) ?>"
                                                        class="btn btn-outline-warning rounded-pill">Edit Produk</a>
                                                    <form action="<?= base_url('/product/delete/' . $item['id']) ?>" method="post"
                                                        onsubmit="return confirm('Hapus produk ini?')">
                                                        <?= csrf_field() ?>
                                                        <button class="btn btn-outline-danger rounded-pill">Hapus</button>
                                                    </form>
                                                <?php else: ?>
                                                    <a href="<?= base_url('/checkout/' . $item['id']) ?>"
                                                        class="btn btn-primary rounded-pill">Checkout</a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center mt-5">Belum ada produk tersedia.</div>
    <?php endif; ?>
</div>

<!-- Styling hover -->
<style>
    .product-card {
        transition: all 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    }
</style>

<?= $this->endSection() ?>