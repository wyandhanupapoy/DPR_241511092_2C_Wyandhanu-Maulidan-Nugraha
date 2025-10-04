<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> | Aplikasi Gaji DPR</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url('/dashboard') ?>">
                <i class="bi bi-wallet-fill"></i>
                Aplikasi Gaji DPR
            </a>
            <div class="d-flex">
                <?php if(session()->get('isLoggedIn')): ?>
                    <span class="navbar-text me-3">
                        Halo, <?= esc(session()->get('nama_lengkap')) ?>!
                    </span>
                    <a href="<?= site_url('/logout') ?>" class="btn btn-outline-light">Logout</a>
                <?php else: ?>
                    <a href="<?= site_url('/login') ?>" class="btn btn-outline-light">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="container mt-4 py-4">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="text-center mt-auto py-3">
        <p class="text-muted">Aplikasi Penghitungan & Transparansi Gaji DPR &copy; <?= date('Y') ?></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>