<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="page-hero">
    <div class="container narrow">
        <p class="eyebrow">About LokalCart</p>
        <h1>A focused foundation for a future point-of-sale system.</h1>
        <p>This milestone demonstrates how CodeIgniter turns a browser request into a database-backed page through routing, controller logic, models, and reusable views.</p>
    </div>
</section>
<section class="section">
    <div class="container split-grid">
        <div><p class="eyebrow">How it works</p><h2>A simple MVC request flow.</h2><p class="lead">The application keeps responsibilities separate so each part is easy to understand, test, and extend.</p></div>
        <ol class="process-list">
            <li><span>1</span><div><h3>Route</h3><p>The URL is matched in <code>app/Config/Routes.php</code>.</p></div></li>
            <li><span>2</span><div><h3>Controller and model</h3><p>The controller uses a CodeIgniter Model and Query Builder methods to retrieve the requested records.</p></div></li>
            <li><span>3</span><div><h3>View</h3><p>The view safely renders the retrieved information as accessible HTML.</p></div></li>
        </ol>
    </div>
</section>
<section class="section section-tint">
    <div class="container">
        <div class="section-heading"><p class="eyebrow">Current scope</p><h2>Ready for database-backed account listings.</h2></div>
        <div class="scope-grid">
            <article><h3>Included now</h3><ul class="check-list"><li>Four working routes and pages</li><li>Separate controllers and database models</li><li>MySQL customers and users tables</li><li>Reusable layout and navigation</li><li>Responsive, accessible tables</li></ul></article>
            <article><h3>Reserved for later</h3><ul class="plain-list"><li>Authentication and permissions</li><li>Product and inventory records</li><li>Sales transactions and receipts</li><li>Create, update, and delete actions</li><li>Reports and analytics</li></ul></article>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
