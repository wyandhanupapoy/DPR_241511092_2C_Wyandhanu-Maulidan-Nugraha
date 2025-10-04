<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;

class AnggotaController extends BaseController
{
    public function index()
    {
        // 1. Buat instance model
        $model = new AnggotaModel();

        // 2. Ambil semua data menggunakan findAll()
        $data['anggota'] = $model->findAll();

        // 3. Kirim data ke view
        return view('anggota/index', $data);
    }

    // Fungsi untuk menampilkan form tambah data
    public function create()
    {
        return view('anggota/create');
    }

    // Fungsi untuk menyimpan data baru
    public function store()
    {
        // 1. Siapkan model
        $model = new AnggotaModel();

        // 2. Ambil semua data dari form
        $data = [
            'nama_depan'        => $this->request->getPost('nama_depan'),
            'nama_belakang'     => $this->request->getPost('nama_belakang'),
            'jabatan'           => $this->request->getPost('jabatan'),
            'status_pernikahan' => $this->request->getPost('status_pernikahan'),
        ];

        // 3. Simpan data ke database melalui model
        $model->save($data);

        // 4. Arahkan pengguna kembali ke halaman lain
        return redirect()->to('/anggota'); // Kita akan buat halaman ini nanti
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $model = new AnggotaModel();
        // Ambil data anggota spesifik berdasarkan $id
        $data['anggota'] = $model->find($id);

        return view('anggota/edit', $data);
    }

    // Memproses update data
    public function update($id)
    {
        $model = new AnggotaModel();

        $data = [
            'nama_depan'        => $this->request->getPost('nama_depan'),
            'nama_belakang'     => $this->request->getPost('nama_belakang'),
            'jabatan'           => $this->request->getPost('jabatan'),
            'status_pernikahan' => $this->request->getPost('status_pernikahan'),
        ];

        // Update data di database
        $model->update($id, $data);

        // Arahkan kembali ke halaman daftar anggota
        return redirect()->to('/anggota');
    }

    // Menghapus data anggota
    public function delete($id)
    {
        $model = new AnggotaModel();

        // Hapus data anggota spesifik berdasarkan $id
        $model->delete($id);

        // Arahkan kembali ke halaman daftar anggota dengan pesan sukses
        return redirect()->to('/anggota')->with('message', 'Data anggota berhasil dihapus.');
    }
}
