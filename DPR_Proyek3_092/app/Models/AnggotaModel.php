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
        'status_pernikahan',
        'jumlah_anak'
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

    public function getLaporanGaji($keyword = null)
    {
        $builder = $this->db->table('anggota a');
        // Tambahkan a.jabatan ke select agar bisa dicari
        $builder->select('a.id_anggota, a.nama_depan, a.nama_belakang, a.jabatan');
        $builder->selectSum('kg.nominal', 'total_gaji');
        $builder->join('penggajian p', 'a.id_anggota = p.id_anggota', 'left');
        $builder->join('komponen_gaji kg', 'p.id_komponen_gaji = kg.id_komponen_gaji', 'left');
        // Group by semua kolom non-agregasi untuk kompatibilitas
        $builder->groupBy('a.id_anggota, a.nama_depan, a.nama_belakang, a.jabatan');

        // --- BLOK PENCARIAN YANG DIPERBAIKI ---
        if ($keyword) {
            $builder->groupStart();
            // Gunakan HAVING untuk memfilter semua kolom setelah agregasi
            $builder->having('a.id_anggota LIKE', '%' . $keyword . '%');
            $builder->orHaving('a.nama_depan LIKE', '%' . $keyword . '%');
            $builder->orHaving('a.nama_belakang LIKE', '%' . $keyword . '%');
            $builder->orHaving('a.jabatan LIKE', '%' . $keyword . '%');
            $builder->orHaving('total_gaji LIKE', '%' . $keyword . '%');
            $builder->groupEnd();
        }
        // --- AKHIR BLOK PENCARIAN ---

        $builder->orderBy('a.nama_depan', 'ASC');

        return $builder->get()->getResultArray();
    }

    public function search($keyword)
    {
        $builder = $this->table('anggota');
        // Mulai pengelompokan kondisi WHERE (agar tidak bentrok dengan kondisi lain)
        $builder->groupStart();
        $builder->like('id_anggota', $keyword);
        $builder->orLike('nama_depan', $keyword);
        $builder->orLike('nama_belakang', $keyword);
        $builder->orLike('jabatan', $keyword);
        // Akhiri pengelompokan
        $builder->groupEnd();

        return $builder->findAll();
    }

    public function getTakeHomePayReport()
    {
        // 1. Ambil data master: semua anggota dan semua komponen gaji
        $anggota = $this->findAll();
        $komponenGaji = $this->db->table('komponen_gaji')->get()->getResultArray();
        $penggajian = $this->db->table('penggajian')->get()->getResultArray();

        // 2. Siapkan "bahan baku" tunjangan khusus
        $tunjanganIstriSuami = 0;
        $tunjanganAnakPerAnak = 0;
        foreach ($komponenGaji as $komp) {
            if ($komp['nama_komponen'] === 'Tunjangan Istri/Suami') {
                $tunjanganIstriSuami = (float) $komp['nominal'];
            }
            if ($komp['nama_komponen'] === 'Tunjangan Anak') {
                $tunjanganAnakPerAnak = (float) $komp['nominal'];
            }
        }

        // 3. Proses kalkulasi untuk setiap anggota
        $laporanFinal = [];
        foreach ($anggota as $itemAnggota) {
            $takeHomePay = 0;

            // Ambil ID komponen yang dimiliki anggota ini
            $idKomponenDimiliki = [];
            foreach ($penggajian as $gaji) {
                if ($gaji['id_anggota'] == $itemAnggota['id_anggota']) {
                    $idKomponenDimiliki[] = $gaji['id_komponen_gaji'];
                }
            }

            // Hitung total dari komponen gaji regular (yang melekat)
            foreach ($komponenGaji as $komp) {
                // Jika komponen ini dimiliki oleh anggota DAN BUKAN tunjangan khusus
                if (in_array($komp['id_komponen_gaji'], $idKomponenDimiliki) && $komp['nama_komponen'] !== 'Tunjangan Istri/Suami' && $komp['nama_komponen'] !== 'Tunjangan Anak') {
                    $takeHomePay += (float) $komp['nominal'];
                }
            }

            // --- LOGIKA KALKULASI KHUSUS (CHALLENGE) ---
            // Cek Tunjangan Istri/Suami
            if ($itemAnggota['status_pernikahan'] === 'Kawin') {
                $takeHomePay += $tunjanganIstriSuami;
            }

            // Cek Tunjangan Anak
            if ($itemAnggota['jumlah_anak'] > 0) {
                $anakYangDihitung = min((int)$itemAnggota['jumlah_anak'], 2); // Ambil nilai terkecil antara jumlah anak dan 2
                $totalTunjanganAnak = $anakYangDihitung * $tunjanganAnakPerAnak;
                $takeHomePay += $totalTunjanganAnak;
            }

            // Masukkan hasil kalkulasi ke data anggota
            $itemAnggota['take_home_pay'] = $takeHomePay;
            $laporanFinal[] = $itemAnggota;
        }

        return $laporanFinal;
    }
}
