<!DOCTYPE html>
<html>
<head>
    <title>Laporan Rincian Gaji</title>
</head>
<body>
    <h1>Laporan Rincian Gaji Anggota</h1>

    <form action="<?= site_url('laporan') ?>" method="post">
        <?= csrf_field() ?>
        <label for="id_anggota">Pilih Anggota:</label>
        <select name="id_anggota" id="id_anggota" onchange="this.form.submit()">
            <option value="">-- Tampilkan Rincian --</option>
            <?php foreach($all_anggota as $anggota): ?>
                <option value="<?= $anggota['id_anggota'] ?>" <?= (isset($anggota_terpilih) && $anggota['id_anggota'] == $anggota_terpilih['id_anggota']) ? 'selected' : '' ?>>
                    <?= esc($anggota['nama_depan'] . ' ' . $anggota['nama_belakang']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
    <hr>
    <?php if ($anggota_terpilih): ?>
        <h3>Rincian untuk: <?= esc($anggota_terpilih['nama_depan'] . ' ' . $anggota_terpilih['nama_belakang']) ?></h3>

        <?php if (!empty($detail_gaji)): ?>
            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th>Komponen Gaji</th>
                        <th>Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach($detail_gaji as $item): ?>
                    <tr>
                        <td><?= esc($item['nama_komponen']) ?></td>
                        <td align="right"><?= number_format($item['nominal'], 2, ',', '.') ?></td>
                    </tr>
                    <?php $total += $item['nominal']; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>TOTAL</th>
                        <th align="right"><?= number_format($total, 2, ',', '.') ?></th>
                    </tr>
                </tfoot>
            </table>
        <?php else: ?>
            <p>Anggota ini belum memiliki komponen gaji yang diatur.</p>
        <?php endif; ?>

    <?php else: ?>
        <p>Silakan pilih anggota untuk melihat rincian gajinya.</p>
    <?php endif; ?>
</body>
</html>