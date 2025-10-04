<!DOCTYPE html>
<html>
<head>
    <title>Ubah Komponen Gaji</title>
</head>
<body>
    <h1>Form Ubah Komponen Gaji</h1>
    
    <form action="<?= site_url('komponen-gaji/update/' . $komponen['id_komponen_gaji']) ?>" method="post">
        <?= csrf_field() ?>

        <div>
            <label>Nama Komponen</label><br>
            <input type="text" name="nama_komponen" value="<?= esc($komponen['nama_komponen']) ?>" required>
        </div>
        <br>
        <div>
            <label>Kategori</label><br>
            <select name="kategori">
                <option value="Gaji Pokok" <?= ($komponen['kategori'] == 'Gaji Pokok') ? 'selected' : '' ?>>Gaji Pokok</option>
                <option value="Tunjangan Melekat" <?= ($komponen['kategori'] == 'Tunjangan Melekat') ? 'selected' : '' ?>>Tunjangan Melekat</option>
                <option value="Tunjangan Lain" <?= ($komponen['kategori'] == 'Tunjangan Lain') ? 'selected' : '' ?>>Tunjangan Lain</option>
            </select>
        </div>
        <br>
        <div>
            <label>Berlaku untuk Jabatan</label><br>
            <select name="jabatan">
                <option value="Semua" <?= ($komponen['jabatan'] == 'Semua') ? 'selected' : '' ?>>Semua</option>
                <option value="Ketua" <?= ($komponen['jabatan'] == 'Ketua') ? 'selected' : '' ?>>Ketua</option>
                <option value="Wakil Ketua" <?= ($komponen['jabatan'] == 'Wakil Ketua') ? 'selected' : '' ?>>Wakil Ketua</option>
                <option value="Anggota" <?= ($komponen['jabatan'] == 'Anggota') ? 'selected' : '' ?>>Anggota</option>
            </select>
        </div>
        <br>
        <div>
            <label>Nominal</label><br>
            <input type="number" name="nominal" step="0.01" value="<?= esc($komponen['nominal']) ?>" required>
        </div>
        <br>
        <div>
            <label>Satuan</label><br>
            <select name="satuan">
                <option value="Bulan" <?= ($komponen['satuan'] == 'Bulan') ? 'selected' : '' ?>>Bulan</option>
                <option value="Hari" <?= ($komponen['satuan'] == 'Hari') ? 'selected' : '' ?>>Hari</option>
                <option value="Periode" <?= ($komponen['satuan'] == 'Periode') ? 'selected' : '' ?>>Periode</option>
            </select>
        </div>
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>