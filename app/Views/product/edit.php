<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Produk</h2>

    <form action="<?= base_url('/produk/update/' . $product['id']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" required value="<?= esc($product['title']) ?>">
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" required><?= esc($product['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="price" class="form-control" required value="<?= esc($product['price']) ?>">
        </div>
        <div class="mb-3">
            <label>Kondisi</label>
            <select name="condition" class="form-select" required>
                <option value="baru" <?= $product['condition'] == 'baru' ? 'selected' : '' ?>>Baru</option>
                <option value="bekas" <?= $product['condition'] == 'bekas' ? 'selected' : '' ?>>Bekas</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Ganti Foto (opsional)</label>
            <input type="file" name="photo" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="<?= base_url('/') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
