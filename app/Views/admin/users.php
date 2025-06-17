<?= $this->include('admin/layout/header') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Kelola Pengguna</h4>
    </div>

    <?php if (empty($users)): ?>
        <div class="alert alert-warning text-center">Belum ada pengguna terdaftar.</div>
    <?php else: ?>
        <div class="table-responsive shadow-sm rounded-4">
            <table class="table table-striped table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td><?= $u['id'] ?></td>
                            <td class="text-start"><?= esc($u['username']) ?></td>
                            <td>
                                <span class="badge bg-<?= $u['role'] === 'admin' ? 'primary' : 'secondary' ?>">
                                    <?= ucfirst($u['role']) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</div>

<?= $this->include('admin/layout/footer') ?>