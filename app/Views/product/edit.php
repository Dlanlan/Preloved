<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <div class="card shadow rounded-4 mx-auto" style="max-width: 800px;">
            <div class="card-body">
                <h3 class="text-center mb-4 fw-semibold">Edit Produk</h3>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('/product/update/' . $product['id']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" name="title" id="title" class="form-control" required value="<?= esc($product['title']) ?>">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required><?= esc($product['description']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" name="price" id="price" class="form-control" required value="<?= esc($product['price']) ?>">
                    </div>

                    <div class="mb-3">
                        <label for="product_condition" class="form-label">Kondisi</label>
                        <select name="product_condition" id="product_condition" class="form-select" required>
                            <option value="baru" <?= $product['product_condition'] == 'baru' ? 'selected' : '' ?>>Baru</option>
                            <option value="bekas" <?= $product['product_condition'] == 'bekas' ? 'selected' : '' ?>>Bekas</option>
                        </select>
                    </div>

                    <?php if (isset($categories)): ?>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= $product['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                                        <?= esc(ucfirst($cat['name'])) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Ganti Foto (opsional)</label>
                        <input type="file" name="photo" id="photo" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('/product/my') ?>" class="btn btn-outline-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>
