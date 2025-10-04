<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KomponenGajiModel;

class KomponenGajiController extends BaseController
{
    public function index()
    {
        $model = new KomponenGajiModel();

        // Ambil kata kunci pencarian dari URL
        $keyword = $this->request->getGet('keyword') ?? '';

        // Lakukan pencarian jika ada kata kunci
        if ($keyword) {
            $data['komponen_gaji'] = $model->search($keyword);
        } else {
            // Jika tidak, tampilkan semua data
            $data['komponen_gaji'] = $model->findAll();
        }

        $data['keyword'] = $keyword;

        return view('komponen_gaji/index', $data);
    }

    public function create()
    {
        return view('komponen_gaji/create');
    }

    public function store()
    {
        // 1. Aturan validasi dasar
        $rules = [
            'nama_komponen' => [
                'label' => 'Nama Komponen',
                'rules' => 'trim|required|max_length[255]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'max_length' => '{field} maksimal 255 karakter.'
                ]
            ],
            'jabatan' => [
                'label' => 'Jabatan',
                'rules' => 'required|in_list[Semua,Ketua,Wakil Ketua,Anggota]',
                'errors' => [
                    'required' => '{field} harus dipilih.',
                    'in_list' => '{field} tidak valid.'
                ]
            ],
            'kategori' => [
                'label' => 'Kategori',
                'rules' => 'required|in_list[Gaji Pokok,Tunjangan Melekat,Tunjangan Lain]',
                'errors' => [
                    'required' => '{field} harus dipilih.'
                ]
            ],
            'nominal' => [
                'label' => 'Nominal',
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} harus berupa angka.',
                    'greater_than' => '{field} harus lebih besar dari 0.'
                ]
            ],
            'satuan' => [
                'label' => 'Satuan',
                'rules' => 'required|in_list[Bulan,Hari,Periode]',
                'errors' => [
                    'required' => '{field} harus dipilih.'
                ]
            ],
        ];

        // 2. Jalankan validasi dasar
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 3. Validasi custom: Cek duplikasi kombinasi nama_komponen + jabatan
        $model = new KomponenGajiModel();
        $namaKomponen = trim($this->request->getPost('nama_komponen'));
        $jabatan = $this->request->getPost('jabatan');

        $exists = $model->where('nama_komponen', $namaKomponen)
                        ->where('jabatan', $jabatan)
                        ->first();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->with('errors', [
                    'nama_komponen' => "Komponen '{$namaKomponen}' untuk jabatan '{$jabatan}' sudah ada di database."
                ]);
        }

        // 4. Jika semua validasi berhasil, simpan data ke database
        $model->save([
            'nama_komponen' => $namaKomponen,
            'kategori'      => $this->request->getPost('kategori'),
            'jabatan'       => $jabatan,
            'nominal'       => $this->request->getPost('nominal'),
            'satuan'        => $this->request->getPost('satuan'),
        ]);

        return redirect()->to('/komponen-gaji')->with('message', 'Komponen gaji berhasil ditambahkan.');
    }

    // Menampilkan form edit berdasarkan ID
    public function edit($id)
    {
        $model = new KomponenGajiModel();
        $data['komponen'] = $model->find($id);

        if (!$data['komponen']) {
            return redirect()->to('/komponen-gaji')->with('error', 'Data tidak ditemukan.');
        }

        return view('komponen_gaji/edit', $data);
    }

    // Memproses data dari form edit
    public function update($id)
    {
        // 1. Aturan validasi dasar
        $rules = [
            'nama_komponen' => [
                'label' => 'Nama Komponen',
                'rules' => 'trim|required|max_length[255]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'max_length' => '{field} maksimal 255 karakter.'
                ]
            ],
            'jabatan' => [
                'label' => 'Jabatan',
                'rules' => 'required|in_list[Semua,Ketua,Wakil Ketua,Anggota]',
                'errors' => [
                    'required' => '{field} harus dipilih.',
                    'in_list' => '{field} tidak valid.'
                ]
            ],
            'kategori' => [
                'label' => 'Kategori',
                'rules' => 'required|in_list[Gaji Pokok,Tunjangan Melekat,Tunjangan Lain]',
                'errors' => [
                    'required' => '{field} harus dipilih.'
                ]
            ],
            'nominal' => [
                'label' => 'Nominal',
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'numeric' => '{field} harus berupa angka.',
                    'greater_than' => '{field} harus lebih besar dari 0.'
                ]
            ],
            'satuan' => [
                'label' => 'Satuan',
                'rules' => 'required|in_list[Bulan,Hari,Periode]',
                'errors' => [
                    'required' => '{field} harus dipilih.'
                ]
            ],
        ];

        // 2. Jalankan validasi dasar
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 3. Validasi custom: Cek duplikasi (kecuali data yang sedang diedit)
        $model = new KomponenGajiModel();
        $namaKomponen = trim($this->request->getPost('nama_komponen'));
        $jabatan = $this->request->getPost('jabatan');

        $exists = $model->where('nama_komponen', $namaKomponen)
                        ->where('jabatan', $jabatan)
                        ->where('id_komponen_gaji !=', $id)
                        ->first();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->with('errors', [
                    'nama_komponen' => "Komponen '{$namaKomponen}' untuk jabatan '{$jabatan}' sudah ada di database."
                ]);
        }

        // 4. Update data
        $data = [
            'nama_komponen' => $namaKomponen,
            'kategori'      => $this->request->getPost('kategori'),
            'jabatan'       => $jabatan,
            'nominal'       => $this->request->getPost('nominal'),
            'satuan'        => $this->request->getPost('satuan'),
        ];

        $model->update($id, $data);

        return redirect()->to('/komponen-gaji')->with('message', 'Komponen gaji berhasil diperbarui.');
    }

    // Menghapus data komponen gaji berdasarkan ID
    public function delete($id)
    {
        $model = new KomponenGajiModel();
        
        // Cek apakah data ada
        $komponen = $model->find($id);
        if (!$komponen) {
            return redirect()->to('/komponen-gaji')->with('error', 'Data tidak ditemukan.');
        }

        // Opsi 1: Pesan sederhana (gunakan ini jika lebih simpel)
        // if ($model->isUsedInPenggajian($id)) {
        //     return redirect()->to('/komponen-gaji')->with('error', 
        //         'Komponen gaji "' . $komponen['nama_komponen'] . '" tidak dapat dihapus karena masih digunakan dalam data penggajian.');
        // }

        // Opsi 2: Pesan dengan detail jumlah penggunaan
        $usageCount = $model->countUsageInPenggajian($id);
        if ($usageCount > 0) {
            return redirect()->to('/komponen-gaji')->with('error', 
                'Komponen gaji "' . $komponen['nama_komponen'] . '" tidak dapat dihapus karena masih digunakan dalam ' . $usageCount . ' data penggajian.');
        }

        // Jika tidak digunakan, hapus
        $model->delete($id);

        return redirect()->to('/komponen-gaji')->with('message', 'Komponen gaji berhasil dihapus.');
    }
}