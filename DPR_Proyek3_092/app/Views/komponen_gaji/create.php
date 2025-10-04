<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Tambah Komponen Gaji
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5>Form Tambah Komponen Gaji Baru</h5>
    </div>
    <div class="card-body">
        <?php $errors = session('errors'); ?>
        <form action="<?= site_url('komponen-gaji/store') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="nama_komponen" class="form-label">Nama Komponen</label>
                <input type="text" class="form-control <?= isset($errors['nama_komponen']) ? 'is-invalid' : '' ?>" name="nama_komponen" id="nama_komponen" value="<?= old('nama_komponen') ?>">
                <?php if(isset($errors['nama_komponen'])): ?>
                    <div class="invalid-feedback"><?= $errors['nama_komponen'] ?></div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-select">
                        <option value="Gaji Pokok" <?= old('kategori') == 'Gaji Pokok' ? 'selected' : '' ?>>Gaji Pokok</option>
                        <option value="Tunjangan Melekat" <?= old('kategori') == 'Tunjangan Melekat' ? 'selected' : '' ?>>Tunjangan Melekat</option>
                        <option value="Tunjangan Lain" <?= old('kategori') == 'Tunjangan Lain' ? 'selected' : '' ?>>Tunjangan Lain</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jabatan" class="form-label">Berlaku untuk Jabatan</label>
                    <select name="jabatan" id="jabatan" class="form-select <?= isset($errors['jabatan']) ? 'is-invalid' : '' ?>">
                        <option value="Semua" <?= old('jabatan') == 'Semua' ? 'selected' : '' ?>>Semua</option>
                        <option value="Ketua" <?= old('jabatan') == 'Ketua' ? 'selected' : '' ?>>Ketua</option>
                        <option value="Wakil Ketua" <?= old('jabatan') == 'Wakil Ketua' ? 'selected' : '' ?>>Wakil Ketua</option>
                        <option value="Anggota" <?= old('jabatan') == 'Anggota' ? 'selected' : '' ?>>Anggota</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nominal" class="form-label">Nominal</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control <?= isset($errors['nominal']) ? 'is-invalid' : '' ?>" name="nominal" id="nominal" step="0.01" value="<?= old('nominal') ?>">
                    </div>
                     <?php if(isset($errors['nominal'])): ?>
                        <div class="invalid-feedback d-block"><?= $errors['nominal'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="satuan" class="form-label">Satuan</label>
                    <select name="satuan" id="satuan" class="form-select">
                        <option value="Bulan" <?= old('satuan') == 'Bulan' ? 'selected' : '' ?>>Bulan</option>
                        <option value="Hari" <?= old('satuan') == 'Hari' ? 'selected' : '' ?>>Hari</option>
                        <option value="Periode" <?= old('satuan') == 'Periode' ? 'selected' : '' ?>>Periode</option>
                    </select>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('/komponen-gaji') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>