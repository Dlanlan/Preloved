<?= $this->extend('layout/home') ?>

<?= $this->section('title') ?>
PRELOVED - Kontak Kami
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4 py-4">
    <div class="card shadow-sm rounded-4 mx-auto" style="max-width: 700px;">
        <div class="card-body">
            <h3 class="text-center mb-4 fw-semibold text-uppercase text-brown">Hubungi Kami</h3>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= esc(session()->getFlashdata('success')) ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('/contact/send') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="subject" id="subject"
                        placeholder="Subjek Pesan" value="<?= old('subject') ?>" required>
                    <label for="subject">Subjek</label>
                </div>

                <div class="form-floating mb-4">
                    <textarea class="form-control" name="message" id="message"
                        placeholder="Pesan Anda" style="height: 150px" required><?= old('message') ?></textarea>
                    <label for="message">Pesan</label>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning rounded-pill px-5">Kirim Pesan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection() ?>