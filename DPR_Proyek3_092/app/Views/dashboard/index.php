<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        .navbar {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            color: white !important;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        .welcome-card {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }
        .welcome-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .salary-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }
        .transparency-card {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }
        .btn-logout {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            border: none;
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        }
        .alert {
            border-radius: 15px;
            border: none;
        }
        .salary-amount {
            font-size: 2.5rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .chart-container {
            position: relative;
            height: 300px;
            margin: 20px 0;
        }
        .dpr-logo {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .data-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .table th {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            border: none;
            font-weight: 600;
        }
        .table td {
            border: none;
            padding: 15px;
            vertical-align: middle;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .badge-salary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('dashboard') ?>">
                <div class="dpr-logo">
                    <i class="fas fa-landmark text-primary"></i>
                </div>
                <span>APLIKASI PENGHITUNGAN & TRANSPARANSI GAJI DPR</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('dashboard') ?>">
                            <i class="fas fa-home me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-chart-bar me-2"></i>Laporan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-calculator me-2"></i>Kalkulator
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-2"></i><?= $user['nama_depan'] . ' ' . $user['nama_belakang'] ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Pengaturan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Welcome Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card welcome-card">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h2 class="card-title mb-2">
                                    <i class="fas fa-landmark me-2"></i>
                                    Selamat Datang di Sistem Transparansi Gaji DPR
                                </h2>
                                <p class="card-text mb-0">
                                    Aplikasi berbasis web untuk penghitungan dan transparansi gaji anggota DPR RI. 
                                    Data yang ditampilkan bersifat informatif dan transparan.
                                </p>
                            </div>
                            <div class="col-md-4 text-end">
                                <i class="fas fa-balance-scale fa-5x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x mb-3"></i>
                        <h3 class="salary-amount">575</h3>
                        <p class="mb-0">Total Anggota DPR</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card salary-card">
                    <div class="card-body text-center">
                        <i class="fas fa-money-bill-wave fa-3x mb-3"></i>
                        <h3 class="salary-amount">Rp 15.5M</h3>
                        <p class="mb-0">Gaji Pokok per Bulan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card transparency-card">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-line fa-3x mb-3"></i>
                        <h3 class="salary-amount">Rp 8.9T</h3>
                        <p class="mb-0">Total Anggaran Tahunan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar-alt fa-3x mb-3"></i>
                        <h3 class="salary-amount">2024</h3>
                        <p class="mb-0">Tahun Anggaran</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Gaji DPR -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-table me-2"></i>Data Komponen Gaji Anggota DPR RI</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="data-table">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Komponen Gaji</th>
                                        <th>Jumlah (Rp)</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><strong>Gaji Pokok</strong></td>
                                        <td><span class="badge-salary">15.500.000</span></td>
                                        <td>Gaji dasar anggota DPR</td>
                                        <td><span class="badge bg-success">Aktif</span></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><strong>Tunjangan Kehormatan</strong></td>
                                        <td><span class="badge-salary">7.500.000</span></td>
                                        <td>Tunjangan kehormatan jabatan</td>
                                        <td><span class="badge bg-success">Aktif</span></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><strong>Tunjangan Komunikasi</strong></td>
                                        <td><span class="badge-salary">3.000.000</span></td>
                                        <td>Biaya komunikasi dan koordinasi</td>
                                        <td><span class="badge bg-success">Aktif</span></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><strong>Tunjangan Perumahan</strong></td>
                                        <td><span class="badge-salary">5.000.000</span></td>
                                        <td>Bantuan perumahan</td>
                                        <td><span class="badge bg-success">Aktif</span></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td><strong>Tunjangan Transportasi</strong></td>
                                        <td><span class="badge-salary">2.000.000</span></td>
                                        <td>Biaya transportasi dinas</td>
                                        <td><span class="badge bg-success">Aktif</span></td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td><strong>Tunjangan Kesehatan</strong></td>
                                        <td><span class="badge-salary">1.500.000</span></td>
                                        <td>Asuransi kesehatan</td>
                                        <td><span class="badge bg-success">Aktif</span></td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td><strong>Uang Kehadiran</strong></td>
                                        <td><span class="badge-salary">500.000</span></td>
                                        <td>Per pertemuan sidang</td>
                                        <td><span class="badge bg-warning">Variabel</span></td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td><strong>Uang Saku</strong></td>
                                        <td><span class="badge-salary">300.000</span></td>
                                        <td>Per hari kerja</td>
                                        <td><span class="badge bg-warning">Variabel</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik dan Analisis -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Distribusi Komponen Gaji</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="salaryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Perbandingan Anggaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="budgetChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Tambahan -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-info-circle fa-3x text-info mb-3"></i>
                        <h5>Transparansi</h5>
                        <p class="text-muted">Data gaji DPR ditampilkan secara transparan dan dapat diakses publik</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-calculator fa-3x text-success mb-3"></i>
                        <h5>Kalkulator</h5>
                        <p class="text-muted">Hitung total gaji berdasarkan komponen yang dipilih</p>
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
                            <div class="col-md-3 mb-3">
                                <a href="<?= base_url('auth/logout') ?>" class="btn btn-logout w-100 text-white">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                            </div>
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
