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

    public function gajiFinal()
{
    $anggotaModel = new AnggotaModel();
    
    // Ambil kata kunci pencarian dari URL
    $keyword = $this->request->getGet('keyword') ?? '';

    // 1. Selalu ambil data laporan LENGKAP dari model
    // Kita gunakan kembali fungsi getTakeHomePayReport() yang sudah kita buat
    // karena sudah menghitung gaji dengan benar (termasuk tunjangan)
    $fullReport = $anggotaModel->getTakeHomePayReport();

    $filteredReport = [];
    // 2. Jika ada kata kunci, saring (filter) data laporan di PHP
    if ($keyword) {
        foreach ($fullReport as $item) {
            // Cek apakah kata kunci cocok dengan salah satu kolom
            // stripos() digunakan untuk pencarian case-insensitive (tidak peduli huruf besar/kecil)
            if (
                stripos($item['id_anggota'], $keyword) !== false ||
                stripos($item['nama_depan'], $keyword) !== false ||
                stripos($item['nama_belakang'], $keyword) !== false ||
                stripos($item['jabatan'], $keyword) !== false ||
                // 'take_home_pay' adalah nama kolom yang dihitung di model
                stripos((string)$item['take_home_pay'], $keyword) !== false 
            ) {
                // Jika cocok, masukkan ke dalam array hasil filter
                $filteredReport[] = $item;
            }
        }
    }

    // 3. Siapkan data untuk dikirim ke view
    $data = [
        // Jika ada keyword, gunakan data hasil filter. Jika tidak, gunakan data lengkap.
        'laporan' => $keyword ? $filteredReport : $fullReport,
        'keyword' => $keyword
    ];
    
    // Kirim data ke view yang sama yaitu 'laporan/take_home_pay'
    return view('laporan/take_home_pay', $data);
}

    public function takeHomePay()
    {
        $anggotaModel = new AnggotaModel();

        // Ambil kata kunci pencarian dari URL
        $keyword = $this->request->getGet('keyword') ?? '';

        // 1. Selalu ambil data laporan LENGKAP dari model
        $fullReport = $anggotaModel->getTakeHomePayReport();

        $filteredReport = [];
        // 2. Jika ada kata kunci, saring (filter) data laporan di PHP
        if ($keyword) {
            foreach ($fullReport as $item) {
                // Cek apakah kata kunci cocok dengan salah satu kolom
                // stripos() digunakan untuk pencarian case-insensitive (tidak peduli huruf besar/kecil)
                if (
                    stripos($item['id_anggota'], $keyword) !== false ||
                    stripos($item['nama_depan'], $keyword) !== false ||
                    stripos($item['nama_belakang'], $keyword) !== false ||
                    stripos($item['jabatan'], $keyword) !== false ||
                    stripos((string)$item['take_home_pay'], $keyword) !== false
                ) {
                    // Jika cocok, masukkan ke dalam array hasil filter
                    $filteredReport[] = $item;
                }
            }
        }

        // 3. Siapkan data untuk dikirim ke view
        $data = [
            // Jika ada keyword, gunakan data hasil filter. Jika tidak, gunakan data lengkap.
            'laporan' => $keyword ? $filteredReport : $fullReport,
            'keyword' => $keyword
        ];

        return view('laporan/take_home_pay', $data);
    }
}
