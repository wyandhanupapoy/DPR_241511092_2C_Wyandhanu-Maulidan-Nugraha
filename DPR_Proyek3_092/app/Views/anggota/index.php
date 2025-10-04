<!DOCTYPE html>
<html>

<head>
    <title>Daftar Anggota</title>
</head>

<body>
    <h1>Daftar Anggota</h1>
    <?php if (session()->get('role') == 'Admin'): ?>
        <a href="<?= site_url('/anggota/create') ?>">+ Tambah Anggota Baru</a>
    <?php endif; ?>
    <hr>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Jabatan</th>
                <th>Status Pernikahan</th>
                <?php if (session()->get('role') == 'Admin'): ?>
                    <th>Aksi</th> <?php endif; ?>
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
                        <td>
    <a href="<?= site_url('anggota/edit/' . $item['id_anggota']) ?>">Ubah</a>
    &nbsp;|&nbsp; <a href="<?= site_url('anggota/delete/' . $item['id_anggota']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
</td>
                    <?php endif; ?>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>