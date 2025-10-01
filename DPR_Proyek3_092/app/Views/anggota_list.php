<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Daftar Anggota DPR</h2>
    <a href="<?= base_url('anggota/create') ?>" class="btn btn-primary mb-3">Tambah Anggota</a>
    <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Gelar Depan</th>
                <th>Gelar Belakang</th>
                <th>Jabatan</th>
                <th>Status Pernikahan</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($anggota)): $no=1; foreach($anggota as $a): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($a['nama_depan'].' '.$a['nama_belakang']) ?></td>
                <td><?= esc($a['gelar_depan']) ?></td>
                <td><?= esc($a['gelar_belakang']) ?></td>
                <td><?= esc($a['jabatan']) ?></td>
                <td><?= esc($a['status_pernikahan']) ?></td>
            </tr>
            <?php endforeach; else: ?>
            <tr>
                <td colspan="6" class="text-center">Belum ada data anggota.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
