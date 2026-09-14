<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="page-hero compact">
    <div class="container page-heading-row">
        <div><p class="eyebrow">Team access</p><h1>User Accounts</h1><p>Account details for <?= count($users) ?> sample staff members stored in a temporary PHP array.</p></div>
        <div class="count-badge" aria-label="<?= count($users) ?> user records"><strong><?= count($users) ?></strong><span>Records</span></div>
    </div>
</section>
<section class="section table-section">
    <div class="container"><div class="table-card">
        <div class="table-card-header"><div><h2>Staff directory</h2><p>Sample data for demonstration only</p></div><span class="data-source">Static array</span></div>
        <div class="table-scroll"><table>
            <caption class="visually-hidden">User and staff account records</caption>
            <thead><tr><th scope="col">Username</th><th scope="col">Full name</th><th scope="col">Role</th></tr></thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr><td data-label="Username"><code><?= esc($user['username']) ?></code></td><td data-label="Full name"><strong><?= esc($user['fullName']) ?></strong></td><td data-label="Role"><span class="role-badge"><?= esc($user['role']) ?></span></td></tr>
                <?php endforeach ?>
            </tbody>
        </table></div>
    </div></div>
</section>
<?= $this->endSection() ?>
