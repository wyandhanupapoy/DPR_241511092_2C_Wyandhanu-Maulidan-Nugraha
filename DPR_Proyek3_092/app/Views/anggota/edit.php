<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Ubah Data Anggota
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5>Form Ubah Data Anggota</h5>
    </div>
    <div class="card-body">
        <form action="<?= site_url('anggota/update/' . $anggota['id_anggota']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-6 mb-3">
                    <label for="nama_depan" class="form-label">Nama Depan</label>
                    <input type="text" class="form-control" name="nama_depan" id="nama_depan" value="<?= esc($anggota['nama_depan']) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nama_belakang" class="form-label">Nama Belakang</label>
                    <input type="text" class="form-control" name="nama_belakang" id="nama_belakang" value="<?= esc($anggota['nama_belakang']) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <select name="jabatan" id="jabatan" class="form-select">
                        <option value="Ketua" <?= ($anggota['jabatan'] == 'Ketua') ? 'selected' : '' ?>>Ketua</option>
                        <option value="Wakil Ketua" <?= ($anggota['jabatan'] == 'Wakil Ketua') ? 'selected' : '' ?>>Wakil Ketua</option>
                        <option value="Anggota" <?= ($anggota['jabatan'] == 'Anggota') ? 'selected' : '' ?>>Anggota</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                    <select name="status_pernikahan" id="status_pernikahan" class="form-select">
                        <option value="Kawin" <?= ($anggota['status_pernikahan'] == 'Kawin') ? 'selected' : '' ?>>Kawin</option>
                        <option value="Belum Kawin" <?= ($anggota['status_pernikahan'] == 'Belum Kawin') ? 'selected' : '' ?>>Belum Kawin</option>
                        <option value="Cerai Hidup" <?= ($anggota['status_pernikahan'] == 'Cerai Hidup') ? 'selected' : '' ?>>Cerai Hidup</option>
                        <option value="Cerai Mati" <?= ($anggota['status_pernikahan'] == 'Cerai Mati') ? 'selected' : '' ?>>Cerai Mati</option>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="jumlah_anak" class="form-label">Jumlah Anak</label>
                    <input type="number" class="form-control" name="jumlah_anak" id="jumlah_anak" value="<?= old('jumlah_anak', $anggota['jumlah_anak'] ?? 0) ?>" required>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= site_url('/anggota') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>