<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="hero">
    <div class="container hero-grid">
        <div class="hero-copy">
            <p class="eyebrow">Retail operations made clear</p>
            <h1>Your store team and customers in one dependable workspace.</h1>
            <p class="hero-text">LokalCart is the first working foundation of a point-of-sale system, built with CodeIgniter 4 and a clean MVC structure.</p>
            <div class="button-row">
                <a class="button button-primary" href="<?= site_url('customers') ?>">View customers</a>
                <a class="button button-secondary" href="<?= site_url('users') ?>">View staff accounts</a>
            </div>
        </div>
        <div class="hero-panel" aria-label="Application summary">
            <p class="panel-label">Foundation status</p>
            <div class="status-line"><span class="status-dot" aria-hidden="true"></span><strong>All routes are ready</strong></div>
            <dl class="metric-grid">
                <div><dt>4</dt><dd>Working pages</dd></div>
                <div><dt>12</dt><dd>Sample accounts</dd></div>
                <div><dt>MVC</dt><dd>Organized structure</dd></div>
                <div><dt>0</dt><dd>Database tables</dd></div>
            </dl>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section-heading">
            <p class="eyebrow">Explore the foundation</p>
            <h2>Everything required for the first POS milestone.</h2>
            <p>Each page has a focused purpose while sharing one consistent navigation and visual system.</p>
        </div>
        <div class="card-grid">
            <article class="feature-card"><span class="card-number">01</span><h3>About the project</h3><p>See how routes, controllers, and views work together before a database is introduced.</p><a class="text-link" href="<?= site_url('about') ?>">Read the overview <span aria-hidden="true">&rarr;</span></a></article>
            <article class="feature-card"><span class="card-number">02</span><h3>Customer accounts</h3><p>Review customer names, email addresses, and phone numbers from a controller array.</p><a class="text-link" href="<?= site_url('customers') ?>">Open customers <span aria-hidden="true">&rarr;</span></a></article>
            <article class="feature-card"><span class="card-number">03</span><h3>User accounts</h3><p>Review usernames, staff names, and assigned roles from a separate controller array.</p><a class="text-link" href="<?= site_url('users') ?>">Open user accounts <span aria-hidden="true">&rarr;</span></a></article>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
