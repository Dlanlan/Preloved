<?= $this->extend('layout/home') ?>
<?= $this->section('title') ?>Kelola Pesanan<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <h3 class="mb-4">Kelola Pesanan</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pembeli</th>
                <th>Total</th>
                <th>Status</th>
                <th>Ubah Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= $order['buyer_id'] ?></td>
                    <td>Rp <?= number_format($order['total_amount'], 0, ',', '.') ?></td>
                    <td><span class="badge bg-secondary"><?= $order['status'] ?></span></td>
                    <td>
                        <form action="<?= base_url('/admin/orders/status/' . $order['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <select name="status" class="form-select form-select-sm d-inline w-auto"
                                onchange="this.form.submit()">
                                <?php foreach (['pending', 'dibayar', 'dikirim', 'selesai', 'dibatalkan'] as $s): ?>
                                    <option value="<?= $s ?>" <?= $order['status'] == $s ? 'selected' : '' ?>><?= ucfirst($s) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    </td>
                    <td><?= $order['created_at'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>