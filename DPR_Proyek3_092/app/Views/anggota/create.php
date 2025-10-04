<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Tambah Anggota Baru
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5>Form Tambah Anggota Baru</h5>
    </div>
    <div class="card-body">
        <form action="<?= site_url('anggota/store') ?>" method="post">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-6 mb-3">
                    <label for="nama_depan" class="form-label">Nama Depan</label>
                    <input type="text" class="form-control" name="nama_depan" id="nama_depan" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nama_belakang" class="form-label">Nama Belakang</label>
                    <input type="text" class="form-control" name="nama_belakang" id="nama_belakang" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <select name="jabatan" id="jabatan" class="form-select">
                        <option value="Ketua">Ketua</option>
                        <option value="Wakil Ketua">Wakil Ketua</option>
                        <option value="Anggota">Anggota</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                    <select name="status_pernikahan" id="status_pernikahan" class="form-select">
                        <option value="Kawin">Kawin</option>
                        <option value="Belum Kawin">Belum Kawin</option>
                        <option value="Cerai Hidup">Cerai Hidup</option>
                        <option value="Cerai Mati">Cerai Mati</option>
                    </select>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('/anggota') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>