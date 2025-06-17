<?= $this->include('admin/layout/header') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Manajemen Produk</h4>
    </div>

    <?php if (empty($products)): ?>
        <div class="alert alert-warning text-center">Belum ada produk terdaftar.</div>
    <?php else: ?>
        <div class="table-responsive shadow-sm rounded-4">
            <table class="table table-striped table-hover table-bordered align-middle mb-0">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Penjual</th>
                        <th>Harga</th>
                        <th>Kondisi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $p): ?>
                        <tr class="text-center">
                            <td><?= esc($p['id']) ?></td>
                            <td class="text-start"><?= esc($p['title']) ?></td>
                            <td><?= esc($p['seller_username'] ?? '-') ?></td>
                            <td class="fw-semibold text-success">Rp <?= number_format($p['price'], 0, ',', '.') ?></td>
                            <td>
                                <span class="badge bg-<?= $p['product_condition'] === 'baru' ? 'primary' : 'secondary' ?>">
                                    <?= ucfirst($p['product_condition']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-<?= $p['status'] === 'tersedia' ? 'success' : 'secondary' ?>">
                                    <?= ucfirst($p['status']) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</div>

<?= $this->include('admin/layout/footer') ?>