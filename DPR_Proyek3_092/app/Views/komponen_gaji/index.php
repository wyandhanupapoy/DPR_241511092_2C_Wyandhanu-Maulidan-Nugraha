<!DOCTYPE html>
<html>
<head>
    <title>Daftar Komponen Gaji</title>
</head>
<body>
    <h1>Daftar Komponen Gaji</h1>

    <?php if (session()->get('role') == 'Admin'): ?>
        <a href="<?= site_url('/komponen-gaji/create') ?>">+ Tambah Komponen Baru</a>
    <?php endif; ?>
    
    <hr>
    
    <table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Nama Komponen</th>
            <th>Kategori</th>
            <th>Jabatan</th>
            <th>Nominal</th>
            <th>Satuan</th>
            <?php if (session()->get('role') == 'Admin'): ?>
                <th>Aksi</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($komponen_gaji as $item): ?>
        <tr>
            <td><?= esc($item['nama_komponen']) ?></td>
            <td><?= esc($item['kategori']) ?></td>
            <td><?= esc($item['jabatan']) ?></td>
            <td><?= esc($item['nominal']) ?></td>
            <td><?= esc($item['satuan']) ?></td>
            <?php if (session()->get('role') == 'Admin'): ?>
                <td>
    <a href="<?= site_url('komponen-gaji/edit/' . $item['id_komponen_gaji']) ?>">Ubah</a>
    &nbsp;|&nbsp; <a href="<?= site_url('komponen-gaji/delete/' . $item['id_komponen_gaji']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
</td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>