<?= $this->include('admin/layout/header') ?>

<div class="container py-4">
    <h4 class="mb-4">User Messages</h4>

    <?php if (empty($messages)): ?>
        <div class="alert alert-info">Belum ada pesan dari pengguna.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Username</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Sent At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $msg): ?>
                        <tr>
                            <td><?= esc($msg['username'] ?? 'Guest') ?></td>
                            <td><?= esc($msg['subject']) ?></td>
                            <td><?= esc($msg['message']) ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($msg['created_at'])) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</div>

<?= $this->include('admin/layout/footer') ?>