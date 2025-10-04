<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Kelola Komponen Gaji
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Komponen Gaji</h5>
        <?php if (session()->get('role') == 'Admin'): ?>
            <a href="<?= site_url('/komponen-gaji/create') ?>" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Tambah Komponen
            </a>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <form action="<?= site_url('/komponen-gaji') ?>" method="get" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" name="keyword" value="<?= esc($keyword ?? '') ?>" placeholder="Cari berdasarkan Nama, Kategori, Jabatan, dll...">
                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Cari</button>
                <a href="<?= site_url('/komponen-gaji') ?>" class="btn btn-secondary"><i class="bi bi-arrow-clockwise"></i> Reset</a>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Komponen</th>
                        <th>Kategori</th>
                        <th>Jabatan</th>
                        <th class="text-end">Nominal</th>
                        <th>Satuan</th>
                        <?php if (session()->get('role') == 'Admin'): ?>
                            <th class="text-center">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($komponen_gaji as $item): ?>
                    <tr>
                        <td><?= esc($item['nama_komponen']) ?></td>
                        <td><?= esc($item['kategori']) ?></td>
                        <td><?= esc($item['jabatan']) ?></td>
                        <td class="text-end">Rp <?= number_format($item['nominal'], 2, ',', '.') ?></td>
                        <td><?= esc($item['satuan']) ?></td>
                        <?php if (session()->get('role') == 'Admin'): ?>
                            <td class="text-center">
                                <a href="<?= site_url('komponen-gaji/edit/' . $item['id_komponen_gaji']) ?>" class="btn btn-warning btn-sm" title="Ubah"><i class="bi bi-pencil-fill"></i></a>
                                <a href="<?= site_url('komponen-gaji/delete/' . $item['id_komponen_gaji']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')" title="Hapus"><i class="bi bi-trash-fill"></i></a>
                            </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>