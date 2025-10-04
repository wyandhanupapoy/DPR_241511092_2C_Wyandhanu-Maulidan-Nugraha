<?php

namespace App\Models;

use CodeIgniter\Model;

class KomponenGajiModel extends Model
{
    // Dari: CREATE TABLE `komponen_gaji`
    protected $table            = 'komponen_gaji';
    
    // Dari: `id_komponen_gaji` bigint PRIMARY KEY
    protected $primaryKey       = 'id_komponen_gaji';
    
    protected $useAutoIncrement = true; // Kita asumsikan ID ini akan auto-increment
    
    // Semua kolom lain yang boleh diisi dari form
    protected $allowedFields    = [
        'nama_komponen',
        'kategori',
        'jabatan',
        'nominal',
        'satuan'
    ];
}