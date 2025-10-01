<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'email' => 'admin@example.com',
                'nama_depan' => 'Admin',
                'nama_belakang' => 'System',
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'user1',
                'password' => password_hash('user123', PASSWORD_DEFAULT),
                'email' => 'user1@example.com',
                'nama_depan' => 'John',
                'nama_belakang' => 'Doe',
                'role' => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'user2',
                'password' => password_hash('user123', PASSWORD_DEFAULT),
                'email' => 'user2@example.com',
                'nama_depan' => 'Jane',
                'nama_belakang' => 'Smith',
                'role' => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('pengguna')->insertBatch($data);
    }
}
