<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table            = 'anggota';
    protected $primaryKey       = 'id_anggota';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'nama_depan',
        'nama_belakang',
        'gelar_depan',
        'gelar_belakang',
        'jabatan',
        'status_pernikahan'
    ];

    public function getGajiDetail($id_anggota)
    {
        // Menggunakan Query Builder untuk menggabungkan tabel
        return $this->db->table('anggota a')
            ->select('a.nama_depan, a.nama_belakang, kg.nama_komponen, kg.nominal')
            ->join('penggajian p', 'a.id_anggota = p.id_anggota')
            ->join('komponen_gaji kg', 'p.id_komponen_gaji = kg.id_komponen_gaji')
            ->where('a.id_anggota', $id_anggota)
            ->get()
            ->getResultArray();
    }

    public function getLaporanGaji()
    {
        // Query ini menggabungkan anggota dengan total gajinya
        return $this->db->table('anggota a')
            // Pilih ID dan nama anggota
            ->select('a.id_anggota, a.nama_depan, a.nama_belakang')
            // Jumlahkan nominal dari komponen gaji dan beri nama alias 'total_gaji'
            ->selectSum('kg.nominal', 'total_gaji')
            // Gabungkan dengan tabel lain menggunakan LEFT JOIN
            // agar anggota tanpa komponen gaji tetap tampil
            ->join('penggajian p', 'a.id_anggota = p.id_anggota', 'left')
            ->join('komponen_gaji kg', 'p.id_komponen_gaji = kg.id_komponen_gaji', 'left')
            // Kelompokkan hasil berdasarkan ID anggota
            ->groupBy('a.id_anggota')
            ->get()
            ->getResultArray();
    }
}
