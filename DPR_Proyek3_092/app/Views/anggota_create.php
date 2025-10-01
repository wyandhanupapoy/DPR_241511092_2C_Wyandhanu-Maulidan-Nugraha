<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Tambah Data Anggota</h2>
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if(isset($validation)): ?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php endif; ?>
    <form method="post" action="<?= base_url('anggota/store') ?>">
        <div class="mb-3">
            <label class="form-label">Nama Depan</label>
            <input type="text" name="nama_depan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Belakang</label>
            <input type="text" name="nama_belakang" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Gelar Depan</label>
            <input type="text" name="gelar_depan" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Gelar Belakang</label>
            <input type="text" name="gelar_belakang" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <select name="jabatan" class="form-select" required>
                <option value="">--Pilih--</option>
                <option value="Ketua">Ketua</option>
                <option value="Wakil Ketua">Wakil Ketua</option>
                <option value="Anggota">Anggota</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Status Pernikahan</label>
            <select name="status_pernikahan" class="form-select" required>
                <option value="">--Pilih--</option>
                <option value="Kawin">Kawin</option>
                <option value="Belum Kawin">Belum Kawin</option>
                <option value="Cerai Hidup">Cerai Hidup</option>
                <option value="Cerai Mati">Cerai Mati</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
