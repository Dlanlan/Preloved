<?= $this->extend('layout/home') ?>
<?= $this->section('title') ?>Detail Pesanan #<?= $order['id'] ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="mb-5">
        <h3 class="fw-semibold mb-3">🧾 Detail Pesanan</h3>
        <div class="rounded-4 bg-white shadow-sm p-4 d-inline-block">
            <div class="mb-2"><strong>ID Pesanan:</strong> <?= $order['id'] ?></div>
            <div class="mb-2">
                <strong>Status:</strong>
                <span class="badge bg-<?= $order['status'] === 'selesai' ? 'success' : 'secondary' ?> px-3 py-1">
                    <?= ucfirst($order['status']) ?>
                </span>
            </div>
            <div><strong>Tanggal:</strong> <?= date('d M Y H:i', strtotime($order['created_at'])) ?></div>
        </div>
    </div>

    <div class="row gy-4">
        <?php foreach ($items as $item): ?>
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                    <div class="row g-0 align-items-center">
                        <div class="col-5">
                            <img src="<?= base_url('uploads/' . $item['product']['photo']) ?>"
                                class="img-fluid w-100 h-100 object-fit-cover" style="aspect-ratio: 1/1; object-fit: cover;"
                                alt="<?= esc($item['product']['title']) ?>">
                        </div>
                        <div class="col-7">
                            <div class="card-body py-3 px-4">
                                <h6 class="fw-bold mb-1"><?= esc($item['product']['title']) ?></h6>
                                <p class="text-muted small mb-2"><?= esc($item['product']['description']) ?></p>
                                <ul class="list-unstyled mb-0 small">
                                    <li><strong>Ukuran:</strong> <?= esc($item['size']) ?></li>
                                    <li><strong>Jumlah:</strong> <?= esc($item['qty']) ?></li>
                                    <li><strong>Harga Satuan:</strong> Rp <?= number_format($item['price'], 0, ',', '.') ?>
                                    </li>
                                    <li><strong>Subtotal:</strong> Rp <?= number_format($item['subtotal'], 0, ',', '.') ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <div class="mt-5 text-end">
        <h5 class="fw-semibold">
            Total Pembayaran:
            <span class="text-warning">Rp <?= number_format($order['total_amount'], 0, ',', '.') ?></span>
        </h5>
    </div>
</div>
<?= $this->endSection() ?>