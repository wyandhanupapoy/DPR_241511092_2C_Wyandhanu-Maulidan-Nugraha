<?php

namespace App\Controllers;

use App\Models\PenggunaModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    protected $penggunaModel;
    protected $session;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
        $this->session = \Config\Services::session();
    }

    public function login()
    {
        // Check if user is already logged in
        if ($this->session->get('user_id')) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/login', $data);
    }

    public function processLogin()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        $messages = [
            'username' => [
                'required' => 'Username harus diisi'
            ],
            'password' => [
                'required' => 'Password harus diisi'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->penggunaModel->authenticate($username, $password);

        if ($user) {
            // Set session data
            $sessionData = [
                'user_id' => $user['id_pengguna'],
                'username' => $user['username'],
                'email' => $user['email'],
                'nama_depan' => $user['nama_depan'],
                'nama_belakang' => $user['nama_belakang'],
                'role' => $user['role'],
                'is_logged_in' => true
            ];

            $this->session->set($sessionData);

            // Redirect based on role
            if ($user['role'] === 'admin') {
                return redirect()->to('/admin/dashboard')->with('success', 'Login berhasil!');
            } else {
                return redirect()->to('/dashboard')->with('success', 'Login berhasil!');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Username atau password salah!');
        }
    }

    public function logout()
    {
        // Destroy session
        $this->session->destroy();
        
        return redirect()->to('/auth/login')->with('success', 'Logout berhasil!');
    }

    public function register()
    {
        $data = [
            'title' => 'Register',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/register', $data);
    }

    public function processRegister()
    {
        $rules = [
            'username' => 'required|max_length[15]|is_unique[pengguna.username]',
            'email' => 'required|valid_email|is_unique[pengguna.email]',
            'nama_depan' => 'required|max_length[100]',
            'nama_belakang' => 'required|max_length[100]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]'
        ];

        $messages = [
            'username' => [
                'required' => 'Username harus diisi',
                'max_length' => 'Username maksimal 15 karakter',
                'is_unique' => 'Username sudah digunakan'
            ],
            'email' => [
                'required' => 'Email harus diisi',
                'valid_email' => 'Format email tidak valid',
                'is_unique' => 'Email sudah digunakan'
            ],
            'nama_depan' => [
                'required' => 'Nama depan harus diisi',
                'max_length' => 'Nama depan maksimal 100 karakter'
            ],
            'nama_belakang' => [
                'required' => 'Nama belakang harus diisi',
                'max_length' => 'Nama belakang maksimal 100 karakter'
            ],
            'password' => [
                'required' => 'Password harus diisi',
                'min_length' => 'Password minimal 6 karakter'
            ],
            'confirm_password' => [
                'required' => 'Konfirmasi password harus diisi',
                'matches' => 'Konfirmasi password tidak cocok'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'nama_depan' => $this->request->getPost('nama_depan'),
            'nama_belakang' => $this->request->getPost('nama_belakang'),
            'password' => $this->request->getPost('password'),
            'role' => 'user'
        ];

        if ($this->penggunaModel->save($data)) {
            return redirect()->to('/auth/login')->with('success', 'Registrasi berhasil! Silakan login.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal melakukan registrasi!');
        }
    }
}
