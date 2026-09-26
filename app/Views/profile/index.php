<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="page-hero compact"><div class="container narrow"><p class="eyebrow">Demo user</p><h1>Profile</h1><p>The single user record stored for this assessment.</p></div></section>
<section class="section"><div class="container narrow"><div class="table-card"><div class="table-card-header"><div><h2><?= esc($user['full_name']) ?></h2><p>@<?= esc($user['username']) ?></p></div><span class="data-source">UserModel</span></div><dl class="profile-details"><div><dt>Full name</dt><dd><?= esc($user['full_name']) ?></dd></div><div><dt>Username</dt><dd><?= esc($user['username']) ?></dd></div><div><dt>Email</dt><dd><a href="mailto:<?= esc($user['email'], 'attr') ?>"><?= esc($user['email']) ?></a></dd></div><div><dt>Created at</dt><dd><?= esc(date('M j, Y g:i A', strtotime($user['created_at']))) ?></dd></div></dl></div></div></section>
<?= $this->endSection() ?>
