<?= $this->include('admin/layout/header') ?>

<link rel="stylesheet" href="<?= base_url('css/category.css') ?>">

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Manajemen Kategori Produk</h4>
    </div>

    <!-- Flash Error -->
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger shadow-sm">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Form Tambah Kategori -->
    <form action="<?= base_url('/admin/add-category') ?>" method="post" class="row g-2 align-items-center mb-4">
        <?= csrf_field() ?>
        <div class="col-md-10">
            <input type="text" name="name" placeholder="Nama kategori baru" class="form-control rounded-pill shadow-sm"
                required>
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-warning rounded-pill shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah
            </button>
        </div>
    </form>

    <!-- Tabel Kategori -->
    <?php if (empty($categories)): ?>
        <div class="alert alert-warning text-center">Belum ada kategori ditambahkan.</div>
    <?php else: ?>
        <div class="table-responsive shadow-sm rounded-4 overflow-hidden">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Nama Kategori</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $index => $cat): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td class="text-start"><?= esc($cat['name']) ?></td>
                            <td>
                                <form action="<?= base_url('/admin/delete-category/' . $cat['id']) ?>" method="post"
                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    <?= csrf_field() ?>
                                    <button class="btn btn-sm btn-outline-danger rounded-pill">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<script src="<?= base_url('js/category.js') ?>"></script>
<?= $this->include('admin/layout/footer') ?>