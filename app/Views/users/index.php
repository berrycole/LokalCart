<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="page-hero compact">
    <div class="container page-heading-row">
        <div><p class="eyebrow">Team access</p><h1>User Accounts</h1><p>Account details for <?= count($users) ?> users retrieved from the LokalCart database.</p></div>
        <div class="count-badge" aria-label="<?= count($users) ?> user records"><strong><?= count($users) ?></strong><span>Records</span></div>
    </div>
</section>
<section class="section table-section">
    <div class="container"><div class="table-card">
        <div class="table-card-header"><div><h2>User directory</h2><p>Records retrieved through UserModel</p></div><span class="data-source">MySQL database</span></div>
        <div class="table-scroll"><table>
            <caption class="visually-hidden">User account records</caption>
            <thead><tr><th scope="col">Username</th><th scope="col">Full name</th><th scope="col">Created at</th></tr></thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr><td data-label="Username"><code><?= esc($user['username']) ?></code></td><td data-label="Full name"><strong><?= esc($user['full_name']) ?></strong></td><td data-label="Created at"><?= esc(date('M j, Y g:i A', strtotime($user['created_at']))) ?></td></tr>
                <?php endforeach ?>
            </tbody>
        </table></div>
    </div></div>
</section>
<?= $this->endSection() ?>
