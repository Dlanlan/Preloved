<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Produk</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('/produk/store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" required value="<?= old('title') ?>">
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" required><?= old('description') ?></textarea>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="price" class="form-control" required value="<?= old('price') ?>">
        </div>
        <div class="mb-3">
            <label>Kondisi</label>
            <select name="condition" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="baru">Baru</option>
                <option value="bekas">Bekas</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Foto</label>
            <input type="file" name="photo" class="form-control" required>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('/') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
