<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit Data Anggota</h2>
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if(isset($validation)): ?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php endif; ?>
    <form method="post" action="<?= base_url('anggota/update/'.$anggota['id_anggota']) ?>">
        <div class="mb-3">
            <label class="form-label">Nama Depan</label>
            <input type="text" name="nama_depan" class="form-control" value="<?= esc($anggota['nama_depan']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Belakang</label>
            <input type="text" name="nama_belakang" class="form-control" value="<?= esc($anggota['nama_belakang']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Gelar Depan</label>
            <input type="text" name="gelar_depan" class="form-control" value="<?= esc($anggota['gelar_depan']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Gelar Belakang</label>
            <input type="text" name="gelar_belakang" class="form-control" value="<?= esc($anggota['gelar_belakang']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <select name="jabatan" class="form-select" required>
                <option value="">--Pilih--</option>
                <option value="Ketua" <?= $anggota['jabatan']=='Ketua'?'selected':'' ?>>Ketua</option>
                <option value="Wakil Ketua" <?= $anggota['jabatan']=='Wakil Ketua'?'selected':'' ?>>Wakil Ketua</option>
                <option value="Anggota" <?= $anggota['jabatan']=='Anggota'?'selected':'' ?>>Anggota</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Status Pernikahan</label>
            <select name="status_pernikahan" class="form-select" required>
                <option value="">--Pilih--</option>
                <option value="Kawin" <?= $anggota['status_pernikahan']=='Kawin'?'selected':'' ?>>Kawin</option>
                <option value="Belum Kawin" <?= $anggota['status_pernikahan']=='Belum Kawin'?'selected':'' ?>>Belum Kawin</option>
                <option value="Cerai Hidup" <?= $anggota['status_pernikahan']=='Cerai Hidup'?'selected':'' ?>>Cerai Hidup</option>
                <option value="Cerai Mati" <?= $anggota['status_pernikahan']=='Cerai Mati'?'selected':'' ?>>Cerai Mati</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="<?= base_url('anggota') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
