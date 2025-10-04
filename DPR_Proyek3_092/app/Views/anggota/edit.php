<!DOCTYPE html>
<html>
<head>
    <title>Ubah Anggota</title>
</head>
<body>
    <h1>Form Ubah Anggota</h1>
    
    <form action="<?= site_url('anggota/update/' . $anggota['id_anggota']) ?>" method="post">
        <?= csrf_field() ?>

        <div>
            <label>Nama Depan</label><br>
            <input type="text" name="nama_depan" value="<?= esc($anggota['nama_depan']) ?>" required>
        </div>
        <br>
        <div>
            <label>Nama Belakang</label><br>
            <input type="text" name="nama_belakang" value="<?= esc($anggota['nama_belakang']) ?>" required>
        </div>
        <br>
        <div>
            <label>Jabatan</label><br>
            <select name="jabatan">
                <option value="Ketua" <?= ($anggota['jabatan'] == 'Ketua') ? 'selected' : '' ?>>Ketua</option>
                <option value="Wakil Ketua" <?= ($anggota['jabatan'] == 'Wakil Ketua') ? 'selected' : '' ?>>Wakil Ketua</option>
                <option value="Anggota" <?= ($anggota['jabatan'] == 'Anggota') ? 'selected' : '' ?>>Anggota</option>
            </select>
        </div>
        <br>
        <div>
            <label>Status Pernikahan</label><br>
            <select name="status_pernikahan">
                <option value="Kawin" <?= ($anggota['status_pernikahan'] == 'Kawin') ? 'selected' : '' ?>>Kawin</option>
                <option value="Belum Kawin" <?= ($anggota['status_pernikahan'] == 'Belum Kawin') ? 'selected' : '' ?>>Belum Kawin</option>
            </select>
        </div>
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>