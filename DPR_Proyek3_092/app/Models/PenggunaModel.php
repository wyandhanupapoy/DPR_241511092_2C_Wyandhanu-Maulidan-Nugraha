<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'username',
        'password',
        'email',
        'nama_depan',
        'nama_belakang',
        'role'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'username' => 'required|max_length[15]|is_unique[pengguna.username,id_pengguna,{id_pengguna}]',
        'password' => 'required|max_length[128]',
        'email' => 'required|valid_email|max_length[255]|is_unique[pengguna.email,id_pengguna,{id_pengguna}]',
        'nama_depan' => 'required|max_length[100]',
        'nama_belakang' => 'required|max_length[100]',
        'role' => 'in_list[admin,user]'
    ];

    protected $validationMessages = [
        'username' => [
            'required' => 'Username harus diisi',
            'max_length' => 'Username maksimal 15 karakter',
            'is_unique' => 'Username sudah digunakan'
        ],
        'password' => [
            'required' => 'Password harus diisi',
            'max_length' => 'Password maksimal 128 karakter'
        ],
        'email' => [
            'required' => 'Email harus diisi',
            'valid_email' => 'Format email tidak valid',
            'max_length' => 'Email maksimal 255 karakter',
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
        'role' => [
            'in_list' => 'Role harus admin atau user'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    public function authenticate($username, $password)
    {
        $user = $this->where('username', $username)->first();
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    }

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}
