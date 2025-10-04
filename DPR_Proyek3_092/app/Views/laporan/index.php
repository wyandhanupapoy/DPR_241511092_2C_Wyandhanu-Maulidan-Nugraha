<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Laporan Rincian Gaji
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Laporan Rincian Gaji Anggota</h5>
    </div>
    <div class="card-body">
        <form action="<?= site_url('laporan') ?>" method="post">
            <?= csrf_field() ?>
            <div class="row align-items-end">
                <div class="col-md-4">
                    <label for="id_anggota" class="form-label">Pilih Anggota:</label>
                    <select name="id_anggota" id="id_anggota" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Tampilkan Rincian --</option>
                        <?php foreach($all_anggota as $anggota): ?>
                            <option value="<?= $anggota['id_anggota'] ?>" <?= (isset($anggota_terpilih) && $anggota['id_anggota'] == $anggota_terpilih['id_anggota']) ? 'selected' : '' ?>>
                                <?= esc($anggota['nama_depan'] . ' ' . $anggota['nama_belakang']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </form>

        <hr class="my-4">

        <?php if ($anggota_terpilih): ?>
            <h4 class="mb-3">Rincian untuk: <?= esc($anggota_terpilih['nama_depan'] . ' ' . $anggota_terpilih['nama_belakang']) ?></h4>

            <?php if (!empty($detail_gaji)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Komponen Gaji</th>
                                <th class="text-end">Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            <?php foreach($detail_gaji as $item): ?>
                            <tr>
                                <td><?= esc($item['nama_komponen']) ?></td>
                                <td class="text-end">Rp <?= number_format($item['nominal'], 2, ',', '.') ?></td>
                            </tr>
                            <?php $total += $item['nominal']; ?>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th class="text-end">TOTAL</th>
                                <th class="text-end">Rp <?= number_format($total, 2, ',', '.') ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning" role="alert">
                    Anggota ini belum memiliki komponen gaji yang diatur.
                </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="alert alert-info" role="alert">
                Silakan pilih anggota dari daftar di atas untuk melihat rincian gajinya.
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>