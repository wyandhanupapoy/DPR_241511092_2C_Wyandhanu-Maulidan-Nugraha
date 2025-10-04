<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;

class LaporanController extends BaseController
{
    public function index()
    {
        $anggotaModel = new AnggotaModel();

        $data = [
            'all_anggota' => $anggotaModel->findAll(), // Untuk mengisi dropdown
            'detail_gaji' => [],
            'anggota_terpilih' => null
        ];

        // Cek jika ada anggota yang dipilih dari form
        $id_anggota = $this->request->getPost('id_anggota');
        if ($id_anggota) {
            // Panggil fungsi cerdas yang kita buat di model
            $data['detail_gaji'] = $anggotaModel->getGajiDetail($id_anggota);
            // Ambil data anggota yang dipilih untuk ditampilkan
            $data['anggota_terpilih'] = $anggotaModel->find($id_anggota);
        }

        return view('laporan/index', $data);
    }

    public function gajiFinal()
    {
        $anggotaModel = new AnggotaModel();

        // Panggil fungsi query cerdas yang baru kita buat
        $data['laporan_gaji'] = $anggotaModel->getLaporanGaji();

        return view('laporan/gaji_final', $data);
    }
}
