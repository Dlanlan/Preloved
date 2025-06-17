<?= $this->extend('layout/home') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Produk Saya</h4>
        <a href="<?= base_url('/product/create') ?>" class="btn btn-primary">+ Tambah Produk</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (!empty($products)): ?>
        <div class="row g-4">
            <?php foreach ($products as $item): ?>
                <div class="col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm">
                        <img src="<?= base_url('uploads/' . $item['photo']) ?>" class="card-img-top"
                            alt="<?= esc($item['title']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($item['title']) ?></h5>
                            <p class="card-text text-muted">Rp <?= number_format($item['price'], 0, ',', '.') ?></p>
                            <span class="badge bg-secondary"><?= ucfirst($item['product_condition']) ?></span>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="<?= base_url('/product/edit/' . $item['id']) ?>"
                                class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="<?= base_url('/product/delete/' . $item['id']) ?>" method="post"
                                onsubmit="return confirm('Hapus produk ini?')">
                                <?= csrf_field() ?>
                                <button class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center mt-4">Belum ada produk. Yuk tambahkan sekarang!</div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>