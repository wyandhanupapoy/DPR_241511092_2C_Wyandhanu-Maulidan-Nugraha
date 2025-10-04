<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Laporan Gaji Final
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Laporan Gaji Final Anggota</h5>
        <a href="<?= site_url('/laporan') ?>" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali ke Rincian
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th class="text-end">Total Gaji Diterima</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach($laporan_gaji as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($item['nama_depan'] . ' ' . $item['nama_belakang']) ?></td>
                        <td class="text-end">
                            Rp <?= number_format($item['total_gaji'] ?? 0, 2, ',', '.') ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>