<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek dulu apakah pengguna sudah login
        if (!session()->get('isLoggedIn')) {
            // Jika belum, tendang ke halaman login
            return redirect()->to('/login');
        }

        // Cek apakah role pengguna BUKAN 'Admin'
        if (session()->get('role') !== 'Admin') {
            // Jika bukan admin, tendang ke dashboard biasa
            // Anda bisa juga arahkan ke halaman "Akses Ditolak"
            return redirect()->to('/dashboard');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu melakukan apa-apa setelah request
    }
}