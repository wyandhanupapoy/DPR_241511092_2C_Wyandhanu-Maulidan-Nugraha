<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Ubah Komponen Gaji
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5>Form Ubah Komponen Gaji</h5>
    </div>
    <div class="card-body">
        <form action="<?= site_url('komponen-gaji/update/' . $komponen['id_komponen_gaji']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="nama_komponen" class="form-label">Nama Komponen</label>
                <input type="text" class="form-control" name="nama_komponen" id="nama_komponen" value="<?= esc($komponen['nama_komponen']) ?>" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-select">
                        <option value="Gaji Pokok" <?= ($komponen['kategori'] == 'Gaji Pokok') ? 'selected' : '' ?>>Gaji Pokok</option>
                        <option value="Tunjangan Melekat" <?= ($komponen['kategori'] == 'Tunjangan Melekat') ? 'selected' : '' ?>>Tunjangan Melekat</option>
                        <option value="Tunjangan Lain" <?= ($komponen['kategori'] == 'Tunjangan Lain') ? 'selected' : '' ?>>Tunjangan Lain</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jabatan" class="form-label">Berlaku untuk Jabatan</label>
                    <select name="jabatan" id="jabatan" class="form-select">
                        <option value="Semua" <?= ($komponen['jabatan'] == 'Semua') ? 'selected' : '' ?>>Semua</option>
                        <option value="Ketua" <?= ($komponen['jabatan'] == 'Ketua') ? 'selected' : '' ?>>Ketua</option>
                        <option value="Wakil Ketua" <?= ($komponen['jabatan'] == 'Wakil Ketua') ? 'selected' : '' ?>>Wakil Ketua</option>
                        <option value="Anggota" <?= ($komponen['jabatan'] == 'Anggota') ? 'selected' : '' ?>>Anggota</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nominal" class="form-label">Nominal</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control" name="nominal" id="nominal" step="0.01" value="<?= esc($komponen['nominal']) ?>" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="satuan" class="form-label">Satuan</label>
                    <select name="satuan" id="satuan" class="form-select">
                        <option value="Bulan" <?= ($komponen['satuan'] == 'Bulan') ? 'selected' : '' ?>>Bulan</option>
                        <option value="Hari" <?= ($komponen['satuan'] == 'Hari') ? 'selected' : '' ?>>Hari</option>
                        <option value="Periode" <?= ($komponen['satuan'] == 'Periode') ? 'selected' : '' ?>>Periode</option>
                    </select>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= site_url('/komponen-gaji') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>