<?= $this->extend('layout/home') ?>

<?= $this->section('title') ?>
PRELOVED - <?= esc($kategori) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <h3 class="mb-4 text-center fw-semibold"><?= esc($kategori) ?></h3>

    <?php if (!empty($items)): ?>
        <div class="row g-4 justify-content-center">
            <?php foreach ($items as $item): ?>
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="card product-card h-100 border-0 shadow-sm rounded-4">
                        <div data-bs-toggle="modal" data-bs-target="#previewModal<?= $item['id'] ?>" style="cursor: pointer;">
                            <img src="<?= base_url('uploads/' . $item['photo']) ?>" class="card-img-top rounded-top"
                                alt="<?= esc($item['title']) ?>">
                        </div>
                        <div class="card-body bg-white rounded-bottom">
                            <h6 class="card-title mb-1 fw-semibold"><?= esc($item['title']) ?></h6>
                            <p class="text-muted small mb-1">Rp <?= number_format($item['price'], 0, ',', '.') ?></p>
                            <span class="badge bg-warning text-dark"><?= ucfirst($item['product_condition']) ?></span>
                        </div>
                    </div>
                </div>

                <!-- Modal Preview -->
                <div class="modal fade" id="previewModal<?= $item['id'] ?>" tabindex="-1"
                    aria-labelledby="previewModalLabel<?= $item['id'] ?>" aria-hidden="true">
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
                                        <h5 class="text-warning fw-semibold mb-2">
                                            Rp <?= number_format($item['price'], 0, ',', '.') ?>
                                        </h5>
                                        <span class="badge bg-secondary px-3 py-2 rounded-pill text-capitalize mb-4">
                                            <?= esc($item['product_condition']) ?>
                                        </span>
                                        <?php if (isset($user) && $user['role'] === 'user' && $user['id'] == $item['user_id']): ?>
                                            <div class="mt-3">
                                                <a href="<?= base_url('/product/edit/' . $item['id']) ?>"
                                                    class="btn btn-outline-warning rounded-pill px-4">Edit Produk</a>
                                            </div>
                                            <form action="<?= base_url('/product/delete/' . $item['id']) ?>" method="post"
                                                onsubmit="return confirm('Hapus produk ini?')">
                                                <?= csrf_field() ?>
                                                <button class="btn btn-outline-danger btn-sm w-100 mt-2">Hapus</button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">Belum ada produk untuk kategori ini.</div>
    <?php endif ?>
</div>
<?= $this->endSection() ?>