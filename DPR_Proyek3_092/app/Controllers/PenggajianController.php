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
        $penggajianModel = new PenggajianModel();

        $id_anggota = $this->request->getPost('id_anggota');
        $komponen = $this->request->getPost('komponen');

        // 1. Hapus semua komponen gaji lama untuk anggota ini
        $penggajianModel->where('id_anggota', $id_anggota)->delete();

        // 2. Jika ada komponen yang dipilih, masukkan yang baru
        if (!empty($komponen)) {
            $dataToInsert = [];
            foreach ($komponen as $id_komponen) {
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
        $komponenModel = new KomponenGajiModel();
        $penggajianModel = new PenggajianModel();

        // 1. Ambil semua komponen gaji yang ada
        $semuaKomponen = $komponenModel->findAll();

        // 2. Ambil komponen yang sudah dimiliki anggota ini
        $komponenDimiliki = $penggajianModel->where('id_anggota', $id_anggota)->findAll();
        $idKomponenDimiliki = array_column($komponenDimiliki, 'id_komponen_gaji');

        $data = [
            'semua_komponen' => $semuaKomponen,
            'id_komponen_dimiliki' => $idKomponenDimiliki
        ];

        // 3. Kembalikan data dalam format JSON
        return $this->response->setJSON($data);
    }
}
