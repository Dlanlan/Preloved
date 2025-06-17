<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PRELOVED Login/Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('css/auth.css') ?>">
</head>

<body>
    <div class="wrapper <?= old('form_mode') === 'register' ? 'register-mode' : '' ?>" id="wrapper">
        <div class="branding">
            <img src="https://cdn-icons-png.flaticon.com/512/3239/3239952.png" alt="Logo">
            <h2>PRELOVED</h2>
            <p>Temukan barang bekas berkualitas, harga bersahabat, <br> dan bantu lingkungan 🌿</p>
        </div>

        <div class="form-container">
            <div class="slider" id="slider">
                <!-- Login Form -->
                <div class="form-box login">
                    <h4>Login ke <span>PRELOVED</span></h4>

                    <?php if (session()->getFlashdata('error') && old('form_mode') !== 'register'): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('/login') ?>" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        <input type="hidden" name="form_mode" value="login">

                        <input type="text" name="username" class="form-control mb-2" placeholder="Username" required
                            value="<?= old('form_mode') === 'login' ? old('username') : '' ?>">

                        <input type="password" name="password" class="form-control mb-2" placeholder="Password"
                            required>

                        <button type="submit" class="btn btn-custom w-100">Login</button>
                        <p class="text-center mt-3">
                            Belum punya akun? <a href="#" onclick="toggleForm(true); return false;">Daftar di sini</a>
                        </p>
                    </form>
                </div>

                <!-- Register Form -->
                <div class="form-box register">
                    <h4>Daftar <span>PRELOVED</span></h4>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success" id="registerSuccess"><?= session()->getFlashdata('success') ?>
                        </div>
                    <?php elseif (session()->getFlashdata('error') && old('form_mode') === 'register'): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('/register') ?>" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        <input type="hidden" name="form_mode" value="register">

                        <input type="text" name="username" class="form-control mb-2" placeholder="Username" required
                            value="<?= old('form_mode') === 'register' ? old('username') : '' ?>">

                        <input type="password" name="password" class="form-control mb-2" placeholder="Password"
                            required>

                        <button type="submit" class="btn btn-custom w-100">Register</button>
                        <p class="text-center mt-3">
                            Sudah punya akun? <a href="#" onclick="toggleForm(false); return false;">Login di sini</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('js/auth.js') ?>"></script>
</body>

</html>