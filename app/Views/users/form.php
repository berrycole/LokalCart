<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="page-hero compact"><div class="container narrow"><p class="eyebrow">User accounts</p><h1><?= $id === null ? 'New User' : 'Edit User' ?></h1><p>Choose a unique username and enter the account holder's name.</p></div></section>
<section class="section form-section"><div class="container narrow"><div class="form-card">
    <?php if ($errors !== []): ?><div class="notice error" role="alert"><strong>Please correct the highlighted fields.</strong></div><?php endif ?>
    <form method="post" action="<?= $id === null ? site_url('users') : site_url('users/' . $id) ?>" <?= $id !== null ? 'enctype="multipart/form-data"' : '' ?>>
        <?= csrf_field() ?>
        <div class="form-field"><label for="username">Username <span aria-hidden="true">*</span></label><input id="username" name="username" type="text" maxlength="50" required value="<?= esc($values['username'], 'attr') ?>" <?= isset($errors['username']) ? 'aria-invalid="true" aria-describedby="username-error"' : '' ?>><?php if (isset($errors['username'])): ?><p class="field-error" id="username-error"><?= esc($errors['username']) ?></p><?php endif ?></div>
        <div class="form-field"><label for="full_name">Full name <span aria-hidden="true">*</span></label><input id="full_name" name="full_name" type="text" maxlength="100" required value="<?= esc($values['full_name'], 'attr') ?>" <?= isset($errors['full_name']) ? 'aria-invalid="true" aria-describedby="full_name-error"' : '' ?>><?php if (isset($errors['full_name'])): ?><p class="field-error" id="full_name-error"><?= esc($errors['full_name']) ?></p><?php endif ?></div>
        <div class="form-field"><label for="email">Email address</label><input id="email" name="email" type="email" maxlength="100" value="<?= esc($values['email'], 'attr') ?>" <?= isset($errors['email']) ? 'aria-invalid="true" aria-describedby="email-error"' : '' ?>><?php if (isset($errors['email'])): ?><p class="field-error" id="email-error"><?= esc($errors['email']) ?></p><?php endif ?></div>
        <?php if ($id !== null): ?>
            <div class="form-field"><label for="avatar">Profile picture</label><div class="avatar-preview"><img class="avatar-thumb" src="<?= esc(! empty($values['avatar']) ? base_url('uploads/avatars/' . rawurlencode(basename($values['avatar']))) : base_url('assets/img/avatar-placeholder.svg'), 'attr') ?>" alt="Current avatar" width="64" height="64"><span>Current picture</span></div><input id="avatar" name="avatar" type="file" accept=".jpg,.jpeg,.png,image/jpeg,image/png" aria-describedby="avatar-help<?= isset($errors['avatar']) ? ' avatar-error' : '' ?>"><p class="field-help" id="avatar-help">JPG or PNG, up to 2 MB. The app saves a 256 × 256 pixel copy.</p><?php if (isset($errors['avatar'])): ?><p class="field-error" id="avatar-error"><?= esc($errors['avatar']) ?></p><?php endif ?></div>
        <?php endif ?>
        <div class="form-actions"><button class="button button-primary" type="submit"><?= $id === null ? 'Create user' : 'Save changes' ?></button><a class="button button-secondary" href="<?= site_url('users') ?>">Cancel</a></div>
    </form>
</div></div></section>
<?= $this->endSection() ?>
