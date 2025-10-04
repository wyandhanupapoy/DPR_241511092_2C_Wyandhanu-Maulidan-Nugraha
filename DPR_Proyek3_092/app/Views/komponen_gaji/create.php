<!DOCTYPE html>
<html>
<head>
    <title>Tambah Komponen Gaji</title>
</head>
<body>
    <h1>Form Tambah Komponen Gaji</h1>
    
    <form action="<?= site_url('komponen-gaji/store') ?>" method="post">
        <?= csrf_field() ?>

        <div>
            <label>Nama Komponen</label><br>
            <input type="text" name="nama_komponen" required>
        </div>
        <br>
        <div>
            <label>Kategori</label><br>
            <select name="kategori">
                <option value="Gaji Pokok">Gaji Pokok</option>
                <option value="Tunjangan Melekat">Tunjangan Melekat</option>
                <option value="Tunjangan Lain">Tunjangan Lain</option>
            </select>
        </div>
        <br>
        <div>
            <label>Berlaku untuk Jabatan</label><br>
            <select name="jabatan">
                <option value="Semua">Semua</option>
                <option value="Ketua">Ketua</option>
                <option value="Wakil Ketua">Wakil Ketua</option>
                <option value="Anggota">Anggota</option>
            </select>
        </div>
        <br>
        <div>
            <label>Nominal</label><br>
            <input type="number" name="nominal" step="0.01" required>
        </div>
        <br>
        <div>
            <label>Satuan</label><br>
            <select name="satuan">
                <option value="Bulan">Bulan</option>
                <option value="Hari">Hari</option>
                <option value="Periode">Periode</option>
            </select>
        </div>
        <br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>