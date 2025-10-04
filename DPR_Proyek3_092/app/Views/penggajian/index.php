<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Atur Gaji Anggota
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Atur Komponen Gaji per Anggota</h5>
    </div>
    <div class="card-body">
        <?php if(session()->getFlashdata('message')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('penggajian/store') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="id_anggota" class="form-label fw-bold">Pilih Anggota untuk Diatur Gajinya:</label>
                <select name="id_anggota" id="id_anggota" class="form-select">
                    <option value="">-- Pilih Anggota --</option>
                    <?php foreach($anggota as $item): ?>
                        <option value="<?= $item['id_anggota'] ?>"><?= $item['nama_depan'] . ' ' . $item['nama_belakang'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <hr>
            
            <div id="checklist-komponen">
                <p class="text-muted">Pilih anggota di atas untuk menampilkan daftar komponen gaji.</p>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save-fill"></i> Simpan Pengaturan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?php // Bagian khusus untuk JavaScript ?>
<?= $this->section('scripts') ?>
<script>
    document.getElementById('id_anggota').addEventListener('change', function() {
        const anggotaId = this.value;
        const checklistContainer = document.getElementById('checklist-komponen');

        if (!anggotaId) {
            checklistContainer.innerHTML = '<p class="text-muted">Pilih anggota di atas untuk menampilkan daftar komponen gaji.</p>';
            return;
        }

        checklistContainer.innerHTML = '<p>Memuat...</p>';

        fetch('<?= site_url('penggajian/get-komponen/') ?>' + anggotaId)
            .then(response => response.json())
            .then(data => {
                checklistContainer.innerHTML = ''; // Kosongkan kontainer
                
                if(data.semua_komponen.length > 0){
                    const heading = document.createElement('h6');
                    heading.classList.add('mb-3');
                    heading.innerText = 'Pilih Komponen Gaji yang Berlaku:';
                    checklistContainer.appendChild(heading);

                    data.semua_komponen.forEach(komponen => {
                        const isChecked = data.id_komponen_dimiliki.includes(komponen.id_komponen_gaji);
                        
                        // Buat checkbox dengan gaya Bootstrap
                        const checkboxDiv = document.createElement('div');
                        checkboxDiv.classList.add('form-check');
                        checkboxDiv.innerHTML = `
                            <input class="form-check-input" type="checkbox" name="komponen[]" value="${komponen.id_komponen_gaji}" id="komp-${komponen.id_komponen_gaji}" ${isChecked ? 'checked' : ''}>
                            <label class="form-check-label" for="komp-${komponen.id_komponen_gaji}">
                                ${komponen.nama_komponen}
                            </label>
                        `;
                        checklistContainer.appendChild(checkboxDiv);
                    });
                } else {
                    checklistContainer.innerHTML = '<div class="alert alert-warning">Belum ada komponen gaji yang dibuat. Silakan tambahkan di menu Kelola Komponen Gaji.</div>';
                }
            });
    });
</script>
<?= $this->endSection() ?>