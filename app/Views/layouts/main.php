<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= esc($description) ?>">
    <title><?= esc($title) ?> | LokalCart</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to content</a>
    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="<?= site_url('/') ?>" aria-label="Tasks for Today home">
                <span class="brand-mark" aria-hidden="true">LC</span>
                <span><strong>LokalCart</strong><small>Tasks for Today</small></span>
            </a>
            <nav class="primary-nav" aria-label="Primary navigation">
                <a href="<?= site_url('/') ?>" <?= $activePage === 'home' ? 'aria-current="page"' : '' ?>>Home</a>
                <a href="<?= site_url('about') ?>" <?= $activePage === 'about' ? 'aria-current="page"' : '' ?>>About</a>
                <a href="<?= site_url('tasks') ?>" <?= $activePage === 'tasks' ? 'aria-current="page"' : '' ?>>Task List</a>
                <a href="<?= site_url('profile') ?>" <?= $activePage === 'profile' ? 'aria-current="page"' : '' ?>>Profile</a>
                <a href="<?= site_url('customers') ?>" <?= $activePage === 'customers' ? 'aria-current="page"' : '' ?>>Customers</a>
                <a href="<?= site_url('users') ?>" <?= $activePage === 'users' ? 'aria-current="page"' : '' ?>>Users</a>
            </nav>
        </div>
    </header>
    <main id="main-content"><?= $this->renderSection('content') ?></main>
    <footer class="site-footer">
        <div class="container footer-inner">
            <div><strong>Tasks for Today</strong><p>A CodeIgniter 4 MVC application for IT0049.</p></div>
            <p>Tasks, customer accounts, and user accounts are stored in the LokalCart MySQL database.</p>
        </div>
    </footer>
</body>
</html>
