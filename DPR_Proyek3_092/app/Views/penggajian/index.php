<!DOCTYPE html>
<html>
<head>
    <title>Atur Gaji Anggota</title>
</head>
<body>
    <h1>Atur Gaji Anggota</h1>

    <?php if(session()->getFlashdata('message')): ?>
        <div style="color: green;">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('penggajian/store') ?>" method="post">
        <?= csrf_field() ?>

        <div>
            <label>Pilih Anggota</label><br>
            <select name="id_anggota" id="id_anggota">
                <option value="">-- Pilih Anggota --</option>
                <?php foreach($anggota as $item): ?>
                    <option value="<?= $item['id_anggota'] ?>"><?= $item['nama_depan'] . ' ' . $item['nama_belakang'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <br>
        
        <div id="checklist-komponen">
            <p>Silakan pilih anggota untuk melihat komponen gajinya.</p>
        </div>

        <br>
        <button type="submit">Simpan Pengaturan</button>
    </form>
    <script>
    // Jalankan saat elemen dropdown dengan id 'id_anggota' berubah
    document.getElementById('id_anggota').addEventListener('change', function() {
        // Ambil ID anggota yang dipilih
        const anggotaId = this.value;
        const checklistContainer = document.getElementById('checklist-komponen');

        // Jika tidak ada anggota yang dipilih, kosongkan checklist
        if (!anggotaId) {
            checklistContainer.innerHTML = '<p>Silakan pilih anggota untuk melihat komponen gajinya.</p>';
            return;
        }

        // Ambil data komponen dari server (AJAX)
        fetch('<?= site_url('penggajian/get-komponen/') ?>' + anggotaId)
            .then(response => response.json())
            .then(data => {
                // Kosongkan kontainer checklist
                checklistContainer.innerHTML = '';
                
                // Buat checklist dari data yang diterima
                data.semua_komponen.forEach(komponen => {
                    const isChecked = data.id_komponen_dimiliki.includes(komponen.id_komponen_gaji);
                    
                    const checkboxDiv = document.createElement('div');
                    checkboxDiv.innerHTML = `
                        <input type="checkbox" name="komponen[]" value="${komponen.id_komponen_gaji}" ${isChecked ? 'checked' : ''}>
                        <label>${komponen.nama_komponen}</label>
                    `;
                    checklistContainer.appendChild(checkboxDiv);
                });
            });
    });
</script>
</body>
</html>