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
            'all_anggota' => $anggotaModel->findAll(),
            'detail_gaji' => [],
            'anggota_terpilih' => null
        ];

        // Cek jika ada anggota yang dipilih dari form
        $id_anggota = $this->request->getPost('id_anggota');
        if ($id_anggota) {
            $data['detail_gaji'] = $anggotaModel->getGajiDetail($id_anggota);
            $data['anggota_terpilih'] = $anggotaModel->find($id_anggota);
        }

        return view('laporan/index', $data);
    }
}