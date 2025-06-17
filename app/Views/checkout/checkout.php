<?= $this->extend('layout/home') ?>

<?= $this->section('title') ?>
Checkout - <?= esc($product['title']) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-10">
            <div class="d-flex flex-lg-row flex-column gap-4 align-items-start align-items-lg-center">

                <!-- Gambar Produk -->
                <div class="card shadow-sm border-0 rounded-4 w-100" style="max-width: 420px;">
                    <img src="<?= base_url('uploads/' . $product['photo']) ?>" alt="<?= esc($product['title']) ?>"
                        class="card-img-top rounded-top">
                    <div class="card-body">
                        <h5 class="fw-bold mb-1"><?= esc($product['title']) ?></h5>
                        <p class="text-muted text-capitalize small mb-0"><?= esc($product['category_name']) ?></p>
                    </div>
                </div>

                <!-- Form Checkout -->
                <div class="flex-grow-1 w-100">
                    <h5 class="fw-bold mb-1"><?= esc($product['title']) ?></h5>
                    <p class="text-muted mb-2"><?= esc($product['description']) ?></p>

                    <?php
                    $harga_awal = $product['price'];
                    $diskon_persen = $product['discount'] ?? 0;
                    $harga_diskon = $harga_awal - ($harga_awal * $diskon_persen / 100);
                    ?>
                    <div class="mb-4">
                        <?php if ($diskon_persen > 0): ?>
                            <div class="d-flex align-items-center gap-2">
                                <del class="text-muted">Rp <?= number_format($harga_awal, 0, ',', '.') ?></del>
                                <span class="text-danger fw-bold">Rp <?= number_format($harga_diskon, 0, ',', '.') ?></span>
                                <span class="badge bg-danger">-<?= $diskon_persen ?>%</span>
                            </div>
                        <?php else: ?>
                            <span class="fw-bold text-dark">Rp <?= number_format($harga_awal, 0, ',', '.') ?></span>
                        <?php endif; ?>
                    </div>

                    <form action="<?= base_url('checkout/proses') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="price" value="<?= $harga_diskon ?>">

                        <!-- Ukuran -->
                        <div class="mb-3">
                            <label for="size" class="form-label">Ukuran</label>
                            <select name="size" id="size" class="form-select" required>
                                <option value="">Pilih Ukuran</option>
                                <?php if (!empty($product['available_sizes'])): ?>
                                    <?php foreach (explode(',', $product['available_sizes']) as $size): ?>
                                        <option value="<?= trim($size) ?>"><?= trim($size) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <!-- Jumlah -->
                        <div class="mb-3">
                            <label for="qty" class="form-label">Jumlah</label>
                            <input type="number" name="qty" id="qty" class="form-control" min="1" value="1" required>
                        </div>

                        <!-- Nama Penerima -->
                        <div class="mb-3">
                            <label for="nama_penerima" class="form-label">Nama Penerima</label>
                            <input type="text" name="nama_penerima" id="nama_penerima" class="form-control" required>
                        </div>

                        <!-- Telepon -->
                        <div class="mb-3">
                            <label for="telepon" class="form-label">No. Telepon</label>
                            <input type="text" name="telepon" id="telepon" class="form-control" required>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-4">
                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat" rows="2" class="form-control" required></textarea>
                        </div>

                        <!-- Tombol -->
                        <button type="submit" class="btn btn-dark w-100">Checkout</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>