<?= $this->extend('user/layout/user_sidebar') ?>

<?= $this->section('title') ?>
Tambah Produk
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4 py-4">
    <div class="card shadow-sm rounded-4 mx-auto" style="max-width: 900px;">
        <div class="card-body">
            <h3 class="text-center mb-4 fw-semibold text-uppercase text-brown">Tambah Produk</h3>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('/product/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row g-4">
                    <!-- Kiri -->
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="title" id="title"
                                placeholder="Judul Produk" value="<?= old('title') ?>" required>
                            <label for="title">Judul Produk</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="description" id="description"
                                placeholder="Deskripsi" style="height: 120px" required><?= old('description') ?></textarea>
                            <label for="description">Deskripsi</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" name="price" id="price"
                                placeholder="Harga" value="<?= old('price') ?>" required>
                            <label for="price">Harga (Rp)</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" name="product_condition" id="product_condition" required>
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="baru" <?= old('product_condition') === 'baru' ? 'selected' : '' ?>>Baru</option>
                                <option value="bekas" <?= old('product_condition') === 'bekas' ? 'selected' : '' ?>>Bekas</option>
                            </select>
                            <label for="product_condition">Kondisi</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" name="category_id" id="category_id" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= old('category_id') == $cat['id'] ? 'selected' : '' ?>>
                                        <?= esc(ucfirst($cat['name'])) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <label for="category_id">Kategori</label>
                        </div>
                    </div>

                    <!-- Kanan -->
                    <div class="col-md-6">
                        <label for="photo" class="form-label">Foto Produk</label>
                        <input type="file" name="photo" id="photo" class="form-control mb-3" required onchange="previewImage(event)">
                        <img id="preview" class="img-fluid rounded d-none border border-secondary" alt="Preview Gambar">
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="<?= base_url('/product/my') ?>" class="btn btn-outline-secondary rounded-pill px-4">Kembali</a>
                    <button type="submit" class="btn btn-warning rounded-pill px-5">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Optional JavaScript Preview -->
<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.classList.remove('d-none');
    }
</script>
<?= $this->endSection() ?>
