<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Laporan Take Home Pay
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Laporan Take Home Pay Seluruh Anggota</h5>
    </div>
    <div class="card-body">
        <form action="<?= site_url('/laporan/take-home-pay') ?>" method="get" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" name="keyword" value="<?= esc($keyword ?? '') ?>" placeholder="Cari berdasarkan Nama, Jabatan, ID, atau Take Home Pay...">
                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Cari</button>
                <a href="<?= site_url('/laporan/take-home-pay') ?>" class="btn btn-secondary"><i class="bi bi-arrow-clockwise"></i> Reset</a>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID Anggota</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan</th>
                        <th class="text-end">Take Home Pay</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($laporan as $item): ?>
                    <tr>
                        <td><?= esc($item['id_anggota']) ?></td>
                        <td>
                            <?php
                                $nama_lengkap = [];
                                if ($item['gelar_depan']) $nama_lengkap[] = $item['gelar_depan'];
                                $nama_lengkap[] = $item['nama_depan'];
                                if ($item['nama_belakang']) $nama_lengkap[] = $item['nama_belakang'];
                                if ($item['gelar_belakang']) $nama_lengkap[] = $item['gelar_belakang'];
                                echo esc(implode(' ', $nama_lengkap));
                            ?>
                        </td>
                        <td><?= esc($item['jabatan']) ?></td>
                        <td class="text-end">
                            Rp <?= number_format($item['take_home_pay'] ?? 0, 2, ',', '.') ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>