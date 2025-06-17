<?= $this->extend('layout/home') ?>

<?= $this->section('title') ?>
PRELOVED - Tentang Kami
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row"></div>
    
<div class="container py-5">
    <h3 class="mb-4 text-center fw-semibold">Tim pengembang website ini:</h3>

    <div class="row g-4 justify-content-center">
        <?php
        $team = [
            [
                'name' => 'Fadlan',
                'role' => 'membuat login, register, dan dashboard penjual',
                'img' => 'https://randomuser.me/api/portraits/men/32.jpg',
                'instagram' => 'https://www.instagram.com/dlan.dz',
                'github' => 'https://github.com/Dlanlan',
                'whatsapp' => 'https://wa.me/628983900756'
            ],
            [
                'name' => 'Toti',
                'role' => 'membuat dashboard admin, dan database',
                'img' => 'https://randomuser.me/api/portraits/men/77.jpg',
                'instagram' => 'https://www.instagram.com/_terserahlu',
                'github' => 'https://github.com/CallMeShinX',
                'whatsapp' => 'https://wa.me/'
            ],
            [
                'name' => 'Agil',
                'role' => 'membuat halaman utama dan katalog',
                'img' => 'https://randomuser.me/api/portraits/men/35.jpg',
                'instagram' => 'https://www.instagram.com/glscarletz',
                'github' => 'https://github.com/',
                'whatsapp' => 'https://wa.me/'
            ],
            [
                'name' => 'El',
                'role' => 'membuat halaman utama dan transaksi',
                'img' => 'https://randomuser.me/api/portraits/men/1.jpg',
                'instagram' => 'https://www.instagram.com/elridho__',
                'github' => 'https://github.com/Eruuuxz',
                'whatsapp' => 'https://wa.me/'
            ]
        ];
        foreach ($team as $member): ?>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 text-center border-0 shadow-sm rounded-4">
                    <div class="mt-4">
                        <img src="<?= $member['img'] ?>" alt="<?= esc($member['name']) ?>" class="rounded-circle shadow-sm" style="width:100px; height:100px; object-fit:cover;">
                    </div>
                    <div class="card-body bg-white rounded-bottom">
                        <h6 class="card-title fw-semibold mb-1"><?= esc($member['name']) ?></h6>
                        <p class="text-muted small mb-3"><?= esc($member['role']) ?></p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="<?= $member['instagram'] ?>" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="<?= $member['github'] ?>" target="_blank" class="btn btn-outline-dark btn-sm rounded-pill">
                                <i class="fab fa-github"></i>
                            </a>
                            <a href="<?= $member['whatsapp'] ?>" target="_blank" class="btn btn-outline-success btn-sm rounded-pill">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>