<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $this->renderSection('title') ?: 'PRELOVED - Discover Everything' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <?= $this->renderSection('styles') ?>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <?= $this->include('partials/navbar') ?>

    <!-- Spacer -->
    <div style="height: 70px;"></div>

    <!-- Main Content -->
    <main class="flex-fill">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer class="text-center p-3 text-white" style="background-color: #5a3601;">
        &copy; <?= date('Y') ?> PRELOVED. Semua hak dilindungi.
    </footer>

    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>