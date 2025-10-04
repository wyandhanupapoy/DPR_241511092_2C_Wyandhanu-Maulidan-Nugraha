<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Kelola Anggota
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Anggota DPR</h5>
        <?php if (session()->get('role') == 'Admin'): ?>
            <a href="<?= site_url('/anggota/create') ?>" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Tambah Anggota
            </a>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan</th>
                        <th>Status Pernikahan</th>
                        <?php if (session()->get('role') == 'Admin'): ?>
                            <th class="text-center">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($anggota as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($item['nama_depan']) . ' ' . esc($item['nama_belakang']) ?></td>
                        <td><?= esc($item['jabatan']) ?></td>
                        <td><?= esc($item['status_pernikahan']) ?></td>
                        <?php if (session()->get('role') == 'Admin'): ?>
                            <td class="text-center">
                                <a href="<?= site_url('anggota/edit/' . $item['id_anggota']) ?>" class="btn btn-warning btn-sm" title="Ubah"><i class="bi bi-pencil-fill"></i></a>
                                <a href="<?= site_url('anggota/delete/' . $item['id_anggota']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus"><i class="bi bi-trash-fill"></i></a>
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