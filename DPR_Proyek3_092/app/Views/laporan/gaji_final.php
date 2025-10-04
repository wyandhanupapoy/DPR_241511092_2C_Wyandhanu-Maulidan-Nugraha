<!DOCTYPE html>
<html>
<head>
    <title>Laporan Gaji Final</title>
</head>
<body>
    <h1>Laporan Gaji Final Anggota</h1>

    <p>
        <a href="<?= site_url('/laporan') ?>">&laquo; Kembali ke Laporan Rincian</a>
    </p>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Total Gaji Diterima</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach($laporan_gaji as $item): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($item['nama_depan'] . ' ' . $item['nama_belakang']) ?></td>
                <td align="right">
                    Rp <?= number_format($item['total_gaji'] ?? 0, 2, ',', '.') ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>