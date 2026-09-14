<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="page-hero compact">
    <div class="container page-heading-row">
        <div><p class="eyebrow">Directory</p><h1>Customer Accounts</h1><p>Contact details for <?= count($customers) ?> sample customers stored in a temporary PHP array.</p></div>
        <div class="count-badge" aria-label="<?= count($customers) ?> customer records"><strong><?= count($customers) ?></strong><span>Records</span></div>
    </div>
</section>
<section class="section table-section">
    <div class="container"><div class="table-card">
        <div class="table-card-header"><div><h2>Customer directory</h2><p>Sample data for demonstration only</p></div><span class="data-source">Static array</span></div>
        <div class="table-scroll"><table>
            <caption class="visually-hidden">Customer account records</caption>
            <thead><tr><th scope="col">Full name</th><th scope="col">Email address</th><th scope="col">Phone number</th></tr></thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                    <tr><td data-label="Full name"><strong><?= esc($customer['fullName']) ?></strong></td><td data-label="Email address"><a href="mailto:<?= esc($customer['email'], 'attr') ?>"><?= esc($customer['email']) ?></a></td><td data-label="Phone number"><?= esc($customer['phone']) ?></td></tr>
                <?php endforeach ?>
            </tbody>
        </table></div>
    </div></div>
</section>
<?= $this->endSection() ?>
