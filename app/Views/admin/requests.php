<!DOCTYPE html>
<html>
<head>
    <title>Permintaan Jual Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container py-4">
    <h2>Daftar Permintaan Jual</h2>
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-info"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= esc($item['name']) ?></td>
                    <td><?= esc($item['description']) ?></td>
                    <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                    <td><img src="<?= base_url('uploads/' . $item['image']) ?>" width="100"></td>
                    <td>
                        <form method="post" action="<?= base_url('admin/approve/' . $item['id']) ?>" class="d-inline">
                            <button class="btn btn-success btn-sm">Setujui</button>
                        </form>
                        <form method="post" action="<?= base_url('admin/decline/' . $item['id']) ?>" class="d-inline">
                            <button class="btn btn-danger btn-sm">Tolak</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
