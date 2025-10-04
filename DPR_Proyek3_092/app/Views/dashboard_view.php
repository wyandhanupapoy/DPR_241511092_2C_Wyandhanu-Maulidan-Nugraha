<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h1 class="display-6">Selamat Datang, <?= esc(session()->get('nama_lengkap')) ?></h1>
        <p class="lead text-muted">Anda login sebagai: <strong><?= esc(session()->get('role')) ?></strong></p>
        <hr class="my-4">
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header h5"><i class="bi bi-info-circle-fill"></i> Informasi & Laporan</div>
            <div class="list-group list-group-flush">
                <a href="<?= site_url('/komponen-gaji') ?>" class="list-group-item list-group-item-action"><i class="bi bi-tags-fill me-2"></i> Lihat Komponen Gaji</a>
                <a href="<?= site_url('/laporan') ?>" class="list-group-item list-group-item-action"><i class="bi bi-person-lines-fill me-2"></i> Laporan Rincian Gaji</a>
                <a href="<?= site_url('/laporan/gaji-final') ?>" class="list-group-item list-group-item-action"><i class="bi bi-table me-2"></i> Laporan Gaji Final</a>
                 <a href="<?= site_url('/laporan/take-home-pay') ?>" class="list-group-item list-group-item-action"><i class="bi bi-cash-stack me-2"></i> Laporan Take Home Pay</a>
            </div>
        </div>
    </div>

    <?php if (session()->get('role') == 'Admin'): ?>
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header h5"><i class="bi bi-pencil-square"></i> Administrasi</div>
             <div class="list-group list-group-flush">
                <a href="<?= site_url('/anggota') ?>" class="list-group-item list-group-item-action"><i class="bi bi-people-fill me-2"></i> Kelola Anggota</a>
                <a href="<?= site_url('/penggajian') ?>" class="list-group-item list-group-item-action"><i class="bi bi-gear-fill me-2"></i> Atur Gaji Anggota</a>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>