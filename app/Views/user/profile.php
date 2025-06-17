<?= $this->extend('user/layout/user_sidebar') ?>

<?= $this->section('title') ?>
Profil Saya
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container py-4">
    <h3 class="mb-4 fw-semibold">Profil Saya</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>

    <form action="<?= base_url('/profile/update') ?>" method="post" enctype="multipart/form-data"
        class="needs-validation" novalidate>
        <?= csrf_field() ?>
        <div class="row g-4 align-items-start">

            <!-- Avatar -->
            <div class="col-md-4 text-center">
                <div class="position-relative mb-3">
                    <?php if (!empty($user['photo'])): ?>
                        <img src="<?= base_url('uploads/avatar/' . $user['photo']) ?>" alt="Avatar"
                            class="rounded-circle shadow border border-3"
                            style="width: 120px; height: 120px; object-fit: cover;">
                    <?php else: ?>
                        <div class="circle-icon mx-auto mb-2"
                            style="width: 120px; height: 120px; font-size: 40px; background-color: #6c757d; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <?= strtoupper(substr($user['username'], 0, 1)) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <input type="file" class="form-control" name="avatar" accept="image/*">
                <small class="text-muted d-block mt-2">Format JPG/PNG, Maks. 2MB</small>
            </div>

            <!-- Form -->
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded-4 p-4">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="username" id="username"
                            value="<?= esc($user['username']) ?>" required>
                        <label for="username">Username</label>
                        <div class="invalid-feedback">Username tidak boleh kosong.</div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Biarkan kosong jika tidak ingin mengganti">
                        <label for="password">Password Baru (opsional)</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">Login Terakhir:
                            <?= date('d M Y H:i', session()->get('login_time') ?? time()) ?>
                        </small>

                        <div>
                            <a href="<?= base_url('/') ?>" class="btn btn-outline-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>

<script>
    (function () {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

<?= $this->endSection() ?>