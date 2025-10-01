<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'title' => 'Dashboard',
            'user' => [
                'username' => session()->get('username'),
                'nama_depan' => session()->get('nama_depan'),
                'nama_belakang' => session()->get('nama_belakang'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ]
        ];

        return view('dashboard/index', $data);
    }
}
