<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Dashboard') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        nav {
            background: #263859;
            color: #fff;
            margin-bottom: 0;
            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }
        .nav-container {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 24px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
            font-weight: 500;
            transition: color 0.2s;
        }
        nav a:last-child {
            margin-right: 0;
        }
        nav a:hover {
            color: #f7b731;
        }
        .user-info {
            font-weight: 500;
            margin-right: 16px;
        }
        .container {
            background: #fff;
            margin: 32px auto;
            padding: 32px 36px 28px 36px;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            width: 95%;
            max-width: 950px;
        }
        h2 {
            margin-top: 0;
            color: #263859;
            font-size: 2rem;
            margin-bottom: 10px;
        }
        h3 {
            color: #263859;
            margin-bottom: 8px;
            margin-top: 28px;
        }
        ul {
            padding-left: 22px;
            margin-top: 0;
            margin-bottom: 16px;
        }
        ul li {
            margin-bottom: 4px;
        }
        .success-message {
            color: #155724;
            background: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 10px 16px;
            border-radius: 5px;
            margin-bottom: 18px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 18px;
            background: #fafbfc;
        }
        table th, table td {
            border: 1px solid #d1d5db;
            padding: 10px 12px;
            text-align: left;
        }
        table th {
            background: #e3e8ee;
            color: #263859;
            font-weight: 600;
        }
        table tr:nth-child(even) {
            background: #f4f6f8;
        }
        .quick-actions {
            margin-top: 24px;
        }
        .quick-actions ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .quick-actions li {
            display: inline-block;
            margin-right: 18px;
            margin-bottom: 8px;
        }
        .quick-actions a {
            background: #3f72af;
            color: #fff;
            padding: 8px 18px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.2s;
            border: none;
            display: inline-block;
        }
        .quick-actions a:hover {
            background: #263859;
        }
        @media (max-width: 700px) {
            .container {
                padding: 14px 4px;
            }
            .nav-container {
                flex-direction: column;
                align-items: flex-start;
                padding: 10px 8px;
            }
            .quick-actions li {
                display: block;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <?php
        // Ensure $user and other variables exist to prevent notices
        $user = $user ?? ['nama_depan' => '', 'nama_belakang' => '', 'role' => null];
        $anggota = $anggota ?? [];
        $komponen_gaji = $komponen_gaji ?? [];
        $total_anggota = $total_anggota ?? (is_array($anggota) ? count($anggota) : 0);
        $gaji_pokok = $gaji_pokok ?? null;
        $total_anggaran = $total_anggaran ?? null;
    ?>
    <nav>
        <div class="nav-container">
            <div>
                <a href="<?= base_url('dashboard') ?>"><b>Dashboard</b></a>
                <a href="#">Laporan</a>
                <a href="#">Kalkulator</a>
            </div>
            <div>
                <span class="user-info"><?= esc(trim(($user['nama_depan'] ?? '') . ' ' . ($user['nama_belakang'] ?? ''))) ?></span>
                <a href="<?= base_url('auth/logout') ?>">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="success-message">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <h2>Selamat Datang di Sistem Transparansi Gaji DPR</h2>
        <p style="margin-bottom:18px;">Aplikasi berbasis web untuk penghitungan dan transparansi gaji anggota DPR RI. Data yang ditampilkan bersifat informatif dan transparan.</p>

        <!-- Statistics Section -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Anggota DPR</h5>
                        <p class="card-text"><?= esc($total_anggota) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Gaji Pokok per Bulan</h5>
                        <p class="card-text">
                            <?php if ($gaji_pokok !== null): ?>
                                <?= 'Rp ' . number_format($gaji_pokok, 0, ',', '.') ?>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Total Anggaran Tahunan</h5>
                        <p class="card-text">
                            <?php if ($total_anggaran !== null): ?>
                                <?= 'Rp ' . number_format($total_anggaran, 0, ',', '.') ?>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Tahun Anggaran</h5>
                        <p class="card-text"><?= date('Y') ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Tables -->
        <div class="row mb-4">
            <div class="col-12">
                <h3>Data Komponen Gaji Anggota DPR RI</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Komponen Gaji</th>
                                <th>Jumlah (Rp)</th>
                                <th>Kategori</th>
                                <th>Jabatan</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($komponen_gaji)): ?>
                                <?php $no = 1; foreach ($komponen_gaji as $kg): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($kg['nama_komponen'] ?? '') ?></td>
                                        <td><?= isset($kg['nominal']) ? number_format($kg['nominal'], 0, ',', '.') : '-' ?></td>
                                        <td><?= esc($kg['kategori'] ?? '') ?></td>
                                        <td><?= esc($kg['jabatan'] ?? '') ?></td>
                                        <td><?= esc($kg['satuan'] ?? '') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="text-center">Tidak ada data komponen gaji.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <h3>Daftar Anggota DPR</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Gelar Depan</th>
                                <th>Gelar Belakang</th>
                                <th>Jabatan</th>
                                <th>Status Pernikahan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($anggota)): ?>
                                <?php $no = 1; foreach ($anggota as $a): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc(trim(
                                            (!empty($a['gelar_depan']) ? $a['gelar_depan'] . ' ' : '') .
                                            ($a['nama_depan'] ?? '') . ' ' . ($a['nama_belakang'] ?? '') .
                                            (!empty($a['gelar_belakang']) ? ' ' . $a['gelar_belakang'] : '')
                                        )) ?></td>
                                        <td><?= esc($a['gelar_depan'] ?? '') ?></td>
                                        <td><?= esc($a['gelar_belakang'] ?? '') ?></td>
                                        <td><?= esc($a['jabatan'] ?? '') ?></td>
                                        <td><?= esc($a['status_pernikahan'] ?? '') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="text-center">Tidak ada data anggota.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Distribusi Komponen Gaji</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="salaryChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Perbandingan Anggaran</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="budgetChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h3>Menu Utama</h3>
            <ul>
                <li><a href="#">Kalkulator Gaji</a></li>
                <li><a href="#">Laporan Detail</a></li>
                <li><a href="#">Export Data</a></li>
                <?php if (!empty($user['role']) && $user['role'] === 'Admin'): ?>
                    <li><a href="<?= base_url('anggota/create') ?>">Tambah Anggota</a></li>
                    <li><a href="<?= base_url('anggota') ?>">Lihat Data Anggota</a></li>
                <?php else: ?>
                    <li><a href="<?= base_url('auth/logout') ?>">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize Charts
        document.addEventListener('DOMContentLoaded', function() {
            // Salary Distribution Chart
            const salaryCtx = document.getElementById('salaryChart').getContext('2d');
            new Chart(salaryCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Gaji Pokok', 'Tunjangan Kehormatan', 'Tunjangan Komunikasi', 'Tunjangan Perumahan'],
                    datasets: [{
                        data: [15500000, 7500000, 3000000, 5000000],
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Budget Comparison Chart
            const budgetCtx = document.getElementById('budgetChart').getContext('2d');
            new Chart(budgetCtx, {
                type: 'bar',
                data: {
                    labels: ['2020', '2021', '2022', '2023', '2024'],
                    datasets: [{
                        label: 'Anggaran (Triliun Rp)',
                        data: [7.2, 7.8, 8.1, 8.5, 8.9],
                        backgroundColor: '#36A2EB'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>
</body>
</html>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-file-alt fa-3x text-warning mb-3"></i>
                        <h5>Laporan</h5>
                        <p class="text-muted">Generate laporan detail gaji dan anggaran DPR</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Menu Utama</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <a href="#" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-calculator me-2"></i>Kalkulator Gaji
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="#" class="btn btn-outline-success w-100">
                                    <i class="fas fa-chart-bar me-2"></i>Laporan Detail
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="#" class="btn btn-outline-info w-100">
                                    <i class="fas fa-download me-2"></i>Export Data
                                </a>
                            </div>
                            <?php if (isset($user['role']) && $user['role'] === 'Admin'): ?>
                            <div class="col-md-3 mb-3">
                                <a href="<?= base_url('anggota/create') ?>" class="btn btn-outline-warning w-100">
                                    <i class="fas fa-user-plus me-2"></i>Tambah Anggota
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="<?= base_url('anggota') ?>" class="btn btn-outline-dark w-100">
                                    <i class="fas fa-users me-2"></i>Lihat Data Anggota
                                </a>
                            </div>
                            <?php else: ?>
                            <div class="col-md-3 mb-3">
                                <a href="<?= base_url('auth/logout') ?>" class="btn btn-logout w-100 text-white">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Chart untuk Distribusi Komponen Gaji
        const salaryCtx = document.getElementById('salaryChart').getContext('2d');
        new Chart(salaryCtx, {
            type: 'doughnut',
            data: {
                labels: ['Gaji Pokok', 'Tunjangan Kehormatan', 'Tunjangan Komunikasi', 'Tunjangan Perumahan', 'Tunjangan Transportasi', 'Tunjangan Kesehatan', 'Uang Kehadiran', 'Uang Saku'],
                datasets: [{
                    data: [15500000, 7500000, 3000000, 5000000, 2000000, 1500000, 500000, 300000],
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40',
                        '#FF6384',
                        '#C9CBCF'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.parsed;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return context.label + ': Rp ' + value.toLocaleString('id-ID') + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });

        // Chart untuk Perbandingan Anggaran
        const budgetCtx = document.getElementById('budgetChart').getContext('2d');
        new Chart(budgetCtx, {
            type: 'bar',
            data: {
                labels: ['2020', '2021', '2022', '2023', '2024'],
                datasets: [{
                    label: 'Anggaran DPR (Triliun)',
                    data: [7.2, 7.8, 8.1, 8.5, 8.9],
                    backgroundColor: 'rgba(54, 162, 235, 0.8)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Anggaran: Rp ' + context.parsed.y + 'T';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value + 'T';
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
