<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\KomponenGajiModel;
use App\Models\PenggajianModel;

class PenggajianController extends BaseController
{
    // Menampilkan halaman utama untuk mengatur gaji
    public function index()
    {
        $anggotaModel = new AnggotaModel();

        $data = [
            'anggota' => $anggotaModel->findAll(), // Ambil semua anggota untuk dropdown
        ];

        return view('penggajian/index', $data);
    }

    // Menyimpan data penggajian yang dipilih
    public function store()
    {
        $anggotaModel = new AnggotaModel();
        $komponenModel = new KomponenGajiModel();
        $penggajianModel = new PenggajianModel();

        $id_anggota = $this->request->getPost('id_anggota');
        $komponenTerpilih = $this->request->getPost('komponen') ?? [];

        // --- BLOK VALIDASI ---
        $anggota = $anggotaModel->find($id_anggota);
        if (!$anggota) {
            return redirect()->to('/penggajian')->with('error', 'Anggota tidak valid.');
        }

        // Ambil daftar ID komponen yang SAH untuk jabatan ini
        $komponenSah = $komponenModel->getKomponenByJabatan($anggota['jabatan']);
        $idKomponenSah = array_column($komponenSah, 'id_komponen_gaji');

        // Periksa setiap komponen yang dikirim dari form
        foreach ($komponenTerpilih as $id_komponen) {
            if (!in_array($id_komponen, $idKomponenSah)) {
                // Jika ada 1 saja yang tidak sah, batalkan semua proses
                return redirect()->to('/penggajian')->with('error', 'Terdeteksi komponen gaji yang tidak sesuai dengan jabatan.');
            }
        }
        // --- AKHIR BLOK VALIDASI ---

        // Hapus semua komponen gaji lama untuk anggota ini
        $penggajianModel->where('id_anggota', $id_anggota)->delete();

        // Jika ada komponen yang dipilih, masukkan yang baru
        if (!empty($komponenTerpilih)) {
            $dataToInsert = [];
            foreach ($komponenTerpilih as $id_komponen) {
                $dataToInsert[] = [
                    'id_anggota' => $id_anggota,
                    'id_komponen_gaji' => $id_komponen
                ];
            }
            $penggajianModel->insertBatch($dataToInsert);
        }

        return redirect()->to('/penggajian')->with('message', 'Data penggajian berhasil diperbarui.');
    }

    // Fungsi ini akan dipanggil oleh JavaScript
    public function getKomponenByAnggota($id_anggota)
    {
        $anggotaModel = new AnggotaModel();
        $komponenModel = new KomponenGajiModel();
        $penggajianModel = new PenggajianModel();

        // 1. Dapatkan data anggota untuk mengetahui jabatannya
        $anggota = $anggotaModel->find($id_anggota);
        if (!$anggota) {
            return $this->response->setJSON(['error' => 'Anggota tidak ditemukan.']);
        }
        $jabatanAnggota = $anggota['jabatan'];

        // 2. Ambil komponen yang SESUAI dengan jabatan anggota
        $semuaKomponen = $komponenModel->getKomponenByJabatan($jabatanAnggota);

        // 3. Ambil komponen yang sudah dimiliki anggota ini
        $komponenDimiliki = $penggajianModel->where('id_anggota', $id_anggota)->findAll();
        $idKomponenDimiliki = array_column($komponenDimiliki, 'id_komponen_gaji');

        $data = [
            'semua_komponen' => $semuaKomponen,
            'id_komponen_dimiliki' => $idKomponenDimiliki
        ];

        return $this->response->setJSON($data);
    }
}
