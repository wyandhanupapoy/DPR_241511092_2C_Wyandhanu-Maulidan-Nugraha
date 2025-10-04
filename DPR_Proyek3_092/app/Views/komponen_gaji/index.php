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
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>