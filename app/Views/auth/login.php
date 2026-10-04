<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="page-hero compact">
    <div class="container login-container">
        <p class="eyebrow">Your store workspace</p>
        <h1>Welcome back.</h1>
        <p>Sign in to manage your customers and store team.</p>
    </div>
</section>
<section class="section form-section">
    <div class="container login-container">
        <div class="form-card">
            <h2 class="login-heading">Staff login</h2>
            <p class="field-help login-intro">Use the account provided by your store team.</p>
            <?php if ($error !== null): ?>
                <div class="notice error" role="alert"><?= esc($error) ?></div>
            <?php endif ?>
            <form method="post" action="<?= site_url('login') ?>">
                <?= csrf_field() ?>
                <div class="form-field">
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" autocomplete="username" maxlength="50" required value="<?= esc($username, 'attr') ?>">
                </div>
                <div class="form-field">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" maxlength="72" required>
                </div>
                <div class="form-actions"><button class="button button-primary login-submit" type="submit">Sign in</button></div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
