<?php
use CodeIgniter\I18n\Time;
?>

<?= $this->extend('user/layout/user_sidebar') ?>

<?= $this->section('title') ?>
Data Penjualan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <h3 class="mb-4 fw-semibold">Data Penjualan</h3>

    <?php if (empty($penjualan)): ?>
        <div class="alert alert-info">Belum ada data penjualan.</div>
    <?php else: ?>

        <!-- Grafik -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Grafik Penjualan Bulanan</h5>
                <canvas id="salesChart" height="120"></canvas>
            </div>
        </div>

        <!-- Tabel -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-warning text-center">
                    <tr>
                        <th>Produk</th>
                        <th>Ukuran</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        <th>Pembeli</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($penjualan as $item): ?>
                        <tr>
                            <td>
                                <strong><?= esc($item['product']['title'] ?? '-') ?></strong><br>
                                <small class="text-muted">Kategori: <?= esc($item['product']['category_name'] ?? '-') ?></small>
                            </td>
                            <td class="text-center"><?= esc($item['size']) ?></td>
                            <td class="text-center"><?= esc($item['qty']) ?></td>
                            <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                            <td><?= esc($item['buyer_username'] ?? '-') ?></td>
                            <td>
                                <?php if (!empty($item['created_at'])): ?>
                                    <?= Time::parse($item['created_at'])->toLocalizedString('d MMM yyyy HH:mm') ?>
                                <?php else: ?>
                                    <em class="text-muted">-</em>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</div>

<?php
// Buat data grafik
$salesData = array_reduce($penjualan, function ($carry, $item) {
    $bulan = date('M Y', strtotime($item['created_at']));
    if (!isset($carry[$bulan]))
        $carry[$bulan] = 0;
    $carry[$bulan] += (int) $item['subtotal'];
    return $carry;
}, []);
?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const salesChartData = <?= json_encode($salesData) ?>;
</script>
<script src="<?= base_url('js/sales_chart.js') ?>"></script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>