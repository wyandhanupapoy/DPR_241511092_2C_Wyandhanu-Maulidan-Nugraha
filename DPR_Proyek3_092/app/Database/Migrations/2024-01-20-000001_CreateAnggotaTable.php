<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAnggotaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_anggota' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_depan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nama_belakang' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'gelar_depan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'gelar_belakang' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'jabatan' => [
                'type'       => 'ENUM',
                'constraint' => ['Ketua', 'Wakil Ketua', 'Anggota'],
            ],
            'status_pernikahan' => [
                'type'       => 'ENUM',
                'constraint' => ['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati'],
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id_anggota', true);
        $this->forge->createTable('anggota');
    }

    public function down()
    {
        $this->forge->dropTable('anggota');
    }
}
