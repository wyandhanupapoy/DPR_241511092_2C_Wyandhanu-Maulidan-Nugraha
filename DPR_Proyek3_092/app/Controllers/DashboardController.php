<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        // Ini adalah "Satpam" nya.
        // Cek apakah pengguna sudah login atau belum dari data session.
        if (!session()->get('isLoggedIn')) {
            // Jika belum, tendang ke halaman login
            return redirect()->to('/login');
        }

        // Jika berhasil login, siapkan data untuk ditampilkan
        $data = [
            'nama_lengkap' => session()->get('nama_lengkap'),
            'role'         => session()->get('role')
        ];

        // Tampilkan halaman dashboard
        return view('dashboard_view', $data);
    }

    public function adminPage()
    {
        // Di sini kita tidak perlu cek session lagi, 
        // karena tugas itu sudah diambil alih oleh Filter.
        // Cukup tampilkan view-nya saja.
        return view('admin_page_view');
    }
}