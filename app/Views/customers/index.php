<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section class="page-hero compact">
    <div class="container page-heading-row">
        <div><p class="eyebrow">Directory</p><h1>Customer Accounts</h1><p>Manage <?= count($customers) ?> customer records.</p></div>
        <a class="button button-primary" href="<?= site_url('customers/new') ?>">New customer</a>
    </div>
</section>
<section class="section table-section">
    <div class="container">
        <?php if (session()->getFlashdata('success')): ?><p class="notice success" role="status"><?= esc(session()->getFlashdata('success')) ?></p><?php endif ?>
        <div class="table-card">
            <div class="table-card-header"><div><h2>Customer directory</h2><p>Contact details from the POS database</p></div><span class="data-source">MySQL database</span></div>
            <?php if ($customers === []): ?>
                <p class="empty-state">No customers yet. <a href="<?= site_url('customers/new') ?>">Add the first customer</a>.</p>
            <?php else: ?>
                <div class="table-scroll"><table>
                    <caption class="visually-hidden">Customer account records</caption>
                    <thead><tr><th scope="col">Full name</th><th scope="col">Email address</th><th scope="col">Phone number</th><th scope="col">Action</th></tr></thead>
                    <tbody>
                        <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td data-label="Full name"><strong><?= esc($customer['full_name']) ?></strong></td>
                                <td data-label="Email address"><a href="mailto:<?= esc($customer['email'], 'attr') ?>"><?= esc($customer['email']) ?></a></td>
                                <td data-label="Phone number"><?= esc($customer['phone'] ?: '—') ?></td>
                                <td data-label="Action"><a href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>">Edit</a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table></div>
            <?php endif ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
