<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggunaModel; // <-- Perhatikan ini

class AuthController extends BaseController
{
    public function index()
    {
        // Fungsi ini akan menampilkan halaman login
        return view('login_view');
    }

    public function processLogin()
    {
        // 1. Ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // 2. Cari pengguna berdasarkan username
        $model = new PenggunaModel();
        $pengguna = $model->where('username', $username)->first();

        // 3. Cek apakah pengguna ditemukan dan passwordnya cocok
        if ($pengguna && password_verify($password, $pengguna['password'])) {
            // 4. Jika cocok, buat session
            $sessionData = [
                'id_pengguna'   => $pengguna['id_pengguna'],
                'nama_lengkap'  => $pengguna['nama_depan'] . ' ' . $pengguna['nama_belakang'],
                'role'          => $pengguna['role'],
                'isLoggedIn'    => true
            ];
            session()->set($sessionData);

            // Arahkan ke dashboard
            return redirect()->to('/dashboard');
        } else {
            // 5. Jika tidak cocok, kembali ke login dengan pesan error
            return redirect()->back()->with('error', 'Username atau Password salah.');
        }
    }

    public function logout()
{
    // Hancurkan semua data session
    session()->destroy();

    // Arahkan kembali ke halaman login dengan pesan
    return redirect()->to('/login');
}
}