<?php

namespace App\Models;

use CodeIgniter\Model;

class KomponenGajiModel extends Model
{
    // Dari: CREATE TABLE `komponen_gaji`
    protected $table            = 'komponen_gaji';

    // Dari: `id_komponen_gaji` bigint PRIMARY KEY
    protected $primaryKey       = 'id_komponen_gaji';

    protected $useAutoIncrement = true;

    // Semua kolom lain yang boleh diisi dari form
    protected $allowedFields    = [
        'nama_komponen',
        'kategori',
        'jabatan',
        'nominal',
        'satuan'
    ];

    // Opsional: Tipe data return
    protected $returnType       = 'array';

    // Opsional: Validasi di level model
    protected $validationRules = [
        'nama_komponen' => 'required|max_length[255]',
        'kategori'      => 'required',
        'jabatan'       => 'required',
        'nominal'       => 'required|numeric',
        'satuan'        => 'required'
    ];

    protected $validationMessages = [
        'nama_komponen' => [
            'required' => 'Nama komponen harus diisi.'
        ],
        'nominal' => [
            'numeric' => 'Nominal harus berupa angka.'
        ]
    ];

    /**
     * Mencari komponen gaji berdasarkan keyword
     */
    public function search($keyword)
    {
        $builder = $this->table('komponen_gaji');
        $builder->groupStart();
        $builder->like('id_komponen_gaji', $keyword);
        $builder->orLike('nama_komponen', $keyword);
        $builder->orLike('kategori', $keyword);
        $builder->orLike('jabatan', $keyword); // Fixed: typo 'keyword' -> $keyword
        $builder->orLike('nominal', $keyword);
        $builder->orLike('satuan', $keyword);
        $builder->groupEnd();

        return $builder->findAll();
    }

    /**
     * Mengambil komponen gaji berdasarkan jabatan tertentu atau 'Semua'
     */
    public function getKomponenByJabatan($jabatan)
    {
        // Cari komponen yang jabatannya cocok ATAU yang jabatannya 'Semua'
        return $this->where('jabatan', $jabatan)
            ->orWhere('jabatan', 'Semua')
            ->findAll();
    }

    /**
     * Cek apakah kombinasi nama_komponen dan jabatan sudah ada
     * 
     * @param string $namaKomponen
     * @param string $jabatan
     * @param int|null $excludeId ID yang dikecualikan (untuk update)
     * @return bool
     */
    public function isDuplicate($namaKomponen, $jabatan, $excludeId = null)
    {
        $builder = $this->where('nama_komponen', $namaKomponen)
                        ->where('jabatan', $jabatan);
        
        if ($excludeId !== null) {
            $builder->where('id_komponen_gaji !=', $excludeId);
        }
        
        return $builder->first() !== null;
    }

    /**
     * Cek apakah komponen gaji masih digunakan di tabel penggajian
     * 
     * @param int $idKomponenGaji
     * @return bool
     */
    public function isUsedInPenggajian($idKomponenGaji)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('penggajian');
        
        $count = $builder->where('id_komponen_gaji', $idKomponenGaji)
                        ->countAllResults();
        
        return $count > 0;
    }

    /**
     * Hitung berapa kali komponen gaji digunakan di tabel penggajian
     * 
     * @param int $idKomponenGaji
     * @return int
     */
    public function countUsageInPenggajian($idKomponenGaji)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('penggajian');
        
        return $builder->where('id_komponen_gaji', $idKomponenGaji)
                       ->countAllResults();
    }
}