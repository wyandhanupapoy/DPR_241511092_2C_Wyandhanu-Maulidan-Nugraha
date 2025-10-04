<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Gaji DPR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f4f7f6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-content {
            flex-grow: 1;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-wallet-fill"></i>
                Aplikasi Gaji DPR
            </a>
        </div>
    </nav>

    <main class="main-content container d-flex align-items-center">
        <div class="row justify-content-center w-100">
            <div class="col-md-6 col-lg-4">
                <div class="text-center mb-4">
                    <h1 class="h3 mb-3 fw-normal">Selamat Datang</h1>
                    <p class="text-muted">Silakan login untuk mengakses sistem</p>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        
                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= site_url('login/process') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="form-floating mb-3">
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                                <label for="username">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                <label for="password">Password</label>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center mt-auto py-3">
        <p class="text-muted mb-0">Aplikasi Penghitungan & Transparansi Gaji DPR &copy; <?= date('Y') ?></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>