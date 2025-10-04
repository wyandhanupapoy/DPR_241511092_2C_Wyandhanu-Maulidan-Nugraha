<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KomponenGajiModel;

class KomponenGajiController extends BaseController
{
    public function index()
    {
        $model = new KomponenGajiModel();

        // Ambil semua data dari model
        $data['komponen_gaji'] = $model->findAll();

        // Kirim data ke view
        return view('komponen_gaji/index', $data);
    }

    public function create()
    {
        return view('komponen_gaji/create');
    }

    public function store()
    {
        // 1. Siapkan model
        $model = new KomponenGajiModel();

        // 2. Ambil data dari form
        $data = [
            'nama_komponen' => $this->request->getPost('nama_komponen'),
            'kategori'      => $this->request->getPost('kategori'),
            'jabatan'       => $this->request->getPost('jabatan'),
            'nominal'       => $this->request->getPost('nominal'),
            'satuan'        => $this->request->getPost('satuan'),
        ];

        // 3. Simpan data
        $model->save($data);

        // 4. Redirect ke halaman daftar (yang akan kita buat nanti)
        return redirect()->to('/komponen-gaji');
    }
}
