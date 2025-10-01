<?php

namespace App\Models;
use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table         = 'anggota';
    protected $primaryKey   = 'id_anggota';
    protected $useAutoIncrement = true;
    protected $returnType   = 'array';
    protected $allowedFields = [
        'nama_depan', 'nama_belakang', 'gelar_depan', 'gelar_belakang', 
        'jabatan', 'status_pernikahan'
    ];
    
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
