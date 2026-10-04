<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= esc($description) ?>">
    <title><?= esc($title) ?> | LokalCart POS</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to content</a>
    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="<?= site_url('/') ?>" aria-label="LokalCart POS home">
                <span class="brand-mark" aria-hidden="true">LC</span>
                <span><strong>LokalCart</strong><small>Point of Sale</small></span>
            </a>
            <nav class="primary-nav" aria-label="Primary navigation">
                <a href="<?= site_url('/') ?>" <?= $activePage === 'home' ? 'aria-current="page"' : '' ?>>Home</a>
                <a href="<?= site_url('about') ?>" <?= $activePage === 'about' ? 'aria-current="page"' : '' ?>>About</a>
                <a href="<?= site_url('customers') ?>" <?= $activePage === 'customers' ? 'aria-current="page"' : '' ?>>Customers</a>
                <a href="<?= site_url('users') ?>" <?= $activePage === 'users' ? 'aria-current="page"' : '' ?>>Users</a>
                <?php if (session('isLoggedIn') === true): ?>
                    <span class="signed-in-user">Signed in as <?= esc(session('username')) ?></span>
                    <form class="logout-form" method="post" action="<?= site_url('logout') ?>">
                        <?= csrf_field() ?>
                        <button class="nav-button" type="submit">Sign out</button>
                    </form>
                <?php else: ?>
                    <a href="<?= site_url('login') ?>" <?= $activePage === 'login' ? 'aria-current="page"' : '' ?>>Sign in</a>
                <?php endif ?>
            </nav>
        </div>
    </header>
    <main id="main-content"><?= $this->renderSection('content') ?></main>
    <footer class="site-footer">
        <div class="container footer-inner">
            <div><strong>LokalCart POS</strong><p>A CodeIgniter 4 MVC foundation for IT0049.</p></div>
            <p>Customer and user records are retrieved from the LokalCart MySQL database.</p>
        </div>
    </footer>
</body>
</html>
