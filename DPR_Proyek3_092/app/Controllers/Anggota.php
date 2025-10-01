<?php

namespace App\Controllers;

use App\Models\AnggotaModel;

class Anggota extends BaseController
{
    public function index()
    {
        $model = new AnggotaModel();
        $data['anggota'] = $model->findAll();
        // pass session user to the view to avoid undefined index
        $data['user'] = session()->get() ?? ['nama_depan'=>'','nama_belakang'=>'','role'=>null];
        return view('anggota_list', $data); // changed view name to anggota_list
    }

    public function create()
    {
        if (session()->get('role') !== 'Admin') {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }
        $data = [];
        $data['user'] = session()->get() ?? ['nama_depan'=>'','nama_belakang'=>'','role'=>null];
        return view('anggota_create', $data);
    }

    public function store()
    {
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
            return view('anggota_create', ['validation' => $this->validator, 'user' => session()->get()]);
        }
        $model = new AnggotaModel();
        $model->save([
            'nama_depan'        => $this->request->getPost('nama_depan'),
            'nama_belakang'     => $this->request->getPost('nama_belakang'),
            'gelar_depan'       => $this->request->getPost('gelar_depan'),
            'gelar_belakang'    => $this->request->getPost('gelar_belakang'),
            'jabatan'           => $this->request->getPost('jabatan'),
            'status_pernikahan' => $this->request->getPost('status_pernikahan'),
        ]);
        return redirect()->to('/anggota')->with('success', 'Data anggota berhasil ditambahkan');
    }

    public function edit($id)
    {
        if (session()->get('role') !== 'Admin') {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }
        $model = new AnggotaModel();
        $data['anggota'] = $model->find($id);
        if (!$data['anggota']) {
            return redirect()->to('/anggota')->with('error', 'Data tidak ditemukan');
        }
        $data['user'] = session()->get() ?? ['nama_depan'=>'','nama_belakang'=>'','role'=>null];
        return view('anggota_edit', $data);
    }

    public function update($id)
    {
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
            $model = new AnggotaModel();
            $data['anggota'] = $model->find($id);
            $data['validation'] = $this->validator;
            $data['user'] = session()->get();
            return view('anggota_edit', $data);
        }
        $model = new AnggotaModel();
        $model->update($id, [
            'nama_depan'        => $this->request->getPost('nama_depan'),
            'nama_belakang'     => $this->request->getPost('nama_belakang'),
            'gelar_depan'       => $this->request->getPost('gelar_depan'),
            'gelar_belakang'    => $this->request->getPost('gelar_belakang'),
            'jabatan'           => $this->request->getPost('jabatan'),
            'status_pernikahan' => $this->request->getPost('status_pernikahan'),
        ]);
        return redirect()->to('/anggota')->with('success', 'Data anggota berhasil diubah');
    }

    public function delete($id)
    {
        if (session()->get('role') !== 'Admin') {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }
        $model = new AnggotaModel();
        $model->delete($id);
        return redirect()->to('/anggota')->with('success', 'Data anggota berhasil dihapus');
    }
}