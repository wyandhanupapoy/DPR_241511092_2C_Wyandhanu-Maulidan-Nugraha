<!DOCTYPE html>
<html>
<head>
    <title>Tambah Anggota</title>
</head>
<body>
    <h1>Form Tambah Anggota</h1>
    
    <form action="<?= site_url('anggota/store') ?>" method="post">
        <?= csrf_field() // Ini adalah fitur keamanan CI4 ?>

        <div>
            <label>Nama Depan</label><br>
            <input type="text" name="nama_depan" required>
        </div>
        <br>
        <div>
            <label>Nama Belakang</label><br>
            <input type="text" name="nama_belakang" required>
        </div>
        <br>
        <div>
            <label>Jabatan</label><br>
            <select name="jabatan">
                <option value="Ketua">Ketua</option>
                <option value="Wakil Ketua">Wakil Ketua</option>
                <option value="Anggota">Anggota</option>
            </select>
        </div>
        <br>
        <div>
            <label>Status Pernikahan</label><br>
            <select name="status_pernikahan">
                <option value="Kawin">Kawin</option>
                <option value="Belum Kawin">Belum Kawin</option>
            </select>
        </div>
        <br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>