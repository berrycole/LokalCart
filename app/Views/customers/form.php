<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="page-hero compact"><div class="container narrow"><p class="eyebrow">Customer accounts</p><h1><?= $id === null ? 'New Customer' : 'Edit Customer' ?></h1><p>Enter a name and valid email address to save the customer.</p></div></section>
<section class="section form-section"><div class="container narrow"><div class="form-card">
    <?php if ($errors !== []): ?><div class="notice error" role="alert"><strong>Please correct the highlighted fields.</strong></div><?php endif ?>
    <form method="post" action="<?= $id === null ? site_url('customers') : site_url('customers/' . $id) ?>">
        <?= csrf_field() ?>
        <div class="form-field"><label for="full_name">Full name <span aria-hidden="true">*</span></label><input id="full_name" name="full_name" type="text" maxlength="100" required value="<?= esc($values['full_name'], 'attr') ?>" <?= isset($errors['full_name']) ? 'aria-invalid="true" aria-describedby="full_name-error"' : '' ?>><?php if (isset($errors['full_name'])): ?><p class="field-error" id="full_name-error"><?= esc($errors['full_name']) ?></p><?php endif ?></div>
        <div class="form-field"><label for="email">Email address <span aria-hidden="true">*</span></label><input id="email" name="email" type="email" maxlength="100" required value="<?= esc($values['email'], 'attr') ?>" <?= isset($errors['email']) ? 'aria-invalid="true" aria-describedby="email-error"' : '' ?>><?php if (isset($errors['email'])): ?><p class="field-error" id="email-error"><?= esc($errors['email']) ?></p><?php endif ?></div>
        <div class="form-field"><label for="phone">Phone number</label><input id="phone" name="phone" type="tel" maxlength="30" value="<?= esc($values['phone'], 'attr') ?>" <?= isset($errors['phone']) ? 'aria-invalid="true" aria-describedby="phone-error"' : '' ?>><?php if (isset($errors['phone'])): ?><p class="field-error" id="phone-error"><?= esc($errors['phone']) ?></p><?php endif ?></div>
        <div class="form-actions"><button class="button button-primary" type="submit"><?= $id === null ? 'Create customer' : 'Save changes' ?></button><a class="button button-secondary" href="<?= site_url('customers') ?>">Cancel</a></div>
    </form>
</div></div></section>
<?= $this->endSection() ?>
