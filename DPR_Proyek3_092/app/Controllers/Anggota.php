<?php

namespace App\Controllers;
use App\Models\AnggotaModel;

class Anggota extends BaseController
{
    public function create()
    {
        // Hanya admin yang boleh akses
        if (session()->get('role') !== 'Admin') {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }
        return view('anggota_create');
    }

    public function store()
    {
        // Hanya admin yang boleh akses
        if (session()->get('role') !== 'Admin') {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }

        $validation = \Config\Services::validation();
        $rules = [
            'nama_depan'        => 'required',
            'nama_belakang'     => 'required',
            'gelar_depan'       => 'permit_empty',
            'gelar_belakang'    => 'permit_empty',
            'jabatan'           => 'required|in_list[Ketua,Wakil Ketua,Anggota]',
            'status_pernikahan' => 'required|in_list[Kawin,Belum Kawin,Cerai Hidup,Cerai Mati]',
        ];

        if (!$this->validate($rules)) {
            return view('anggota_create', [
                'validation' => $this->validator
            ]);
        }

        $model = new AnggotaModel();
        $model->insert([
            'nama_depan'        => $this->request->getPost('nama_depan'),
            'nama_belakang'     => $this->request->getPost('nama_belakang'),
            'gelar_depan'       => $this->request->getPost('gelar_depan'),
            'gelar_belakang'    => $this->request->getPost('gelar_belakang'),
            'jabatan'           => $this->request->getPost('jabatan'),
            'status_pernikahan' => $this->request->getPost('status_pernikahan'),
        ]);
        return redirect()->to('/anggota/create')->with('success', 'Data anggota berhasil ditambahkan');
    }
}
