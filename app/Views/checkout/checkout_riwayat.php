<?= $this->extend('layout/home') ?>

<?= $this->section('title') ?>
Riwayat Pesanan Saya
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <h3 class="mb-4 fw-semibold text-center">Riwayat Pesanan</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success text-center"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (empty($orders)): ?>
        <div class="text-center py-5">
            <img src="<?= base_url('assets/img/empty-box.svg') ?>" alt="Kosong" style="max-width: 200px;" class="mb-3">
            <h5 class="fw-semibold">Belum ada pesanan</h5>
            <p class="text-muted">Silakan checkout barang favoritmu!</p>
            <a href="<?= base_url('/katalog') ?>" class="btn btn-warning mt-2">Lihat Produk</a>
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($orders as $order): ?>
                <div class="col">
                    <div class="card shadow-sm border-0 rounded-4 h-100">
                        <div class="card-body">
                            <h6 class="fw-bold mb-2">ID Pesanan: #<?= $order['id'] ?></h6>
                            <p class="mb-1 text-muted">Total: <strong>Rp
                                    <?= number_format($order['total_amount'], 0, ',', '.') ?></strong></p>
                            <p class="mb-1 text-muted">Tanggal: <?= date('d M Y, H:i', strtotime($order['created_at'])) ?></p>
                            <p class="mb-2">
                                Status:
                                <?php
                                $status = $order['status'];
                                $badge = 'secondary';
                                if ($status === 'pending')
                                    $badge = 'warning';
                                elseif ($status === 'diproses')
                                    $badge = 'info';
                                elseif ($status === 'selesai')
                                    $badge = 'success';
                                ?>
                                <span class="badge bg-<?= $badge ?> text-uppercase"><?= ucfirst($status) ?></span>
                            </p>
                            <a href="<?= base_url('/pesanan/detail/' . $order['id']) ?>"
                                class="btn btn-outline-primary btn-sm w-100 mt-2">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>