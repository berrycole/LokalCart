<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="page-hero compact">
    <div class="container page-heading-row">
        <div><p class="eyebrow">Team access</p><h1>User Accounts</h1><p>Manage <?= count($users) ?> user accounts.</p></div>
        <a class="button button-primary" href="<?= site_url('users/new') ?>">New user</a>
    </div>
</section>
<section class="section table-section">
    <div class="container">
        <?php if (session()->getFlashdata('success')): ?><p class="notice success" role="status"><?= esc(session()->getFlashdata('success')) ?></p><?php endif ?>
        <div class="table-card">
            <div class="table-card-header"><div><h2>User directory</h2><p>Accounts and prepared profile pictures</p></div><span class="data-source">MySQL database</span></div>
            <?php if ($users === []): ?>
                <p class="empty-state">No users yet. <a href="<?= site_url('users/new') ?>">Add the first user</a>.</p>
            <?php else: ?>
                <div class="table-scroll"><table>
                    <caption class="visually-hidden">User account records</caption>
                    <thead><tr><th scope="col">Avatar</th><th scope="col">Username</th><th scope="col">Full name</th><th scope="col">Created at</th><th scope="col">Action</th></tr></thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <?php $avatarUrl = ! empty($user['avatar']) ? base_url('uploads/avatars/' . rawurlencode(basename($user['avatar']))) : base_url('assets/img/avatar-placeholder.svg'); ?>
                            <tr>
                                <td data-label="Avatar"><img class="avatar-thumb" src="<?= esc($avatarUrl, 'attr') ?>" alt="<?= esc('Avatar for ' . $user['full_name'], 'attr') ?>" width="48" height="48"></td>
                                <td data-label="Username"><code><?= esc($user['username']) ?></code></td>
                                <td data-label="Full name"><strong><?= esc($user['full_name']) ?></strong></td>
                                <td data-label="Created at"><?= esc(date('M j, Y g:i A', strtotime($user['created_at']))) ?></td>
                                <td data-label="Action"><a href="<?= site_url('users/' . $user['id'] . '/edit') ?>">Edit</a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table></div>
            <?php endif ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
