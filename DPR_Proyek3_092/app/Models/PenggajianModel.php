<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggajianModel extends Model
{
    // Dari: CREATE TABLE `penggajian`
    protected $table            = 'penggajian';
    protected $allowedFields    = ['id_komponen_gaji', 'id_anggota'];
}