<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px 0;
        }
        .register-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="register-card p-4">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-plus fa-4x text-primary mb-3"></i>
                        <h3 class="fw-bold">Daftar Akun</h3>
                        <p class="text-muted">Buat akun baru untuk memulai</p>
                    </div>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('auth/processRegister') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_depan" class="form-label">
                                    <i class="fas fa-user me-2"></i>Nama Depan
                                </label>
                                <input type="text" 
                                       class="form-control <?= ($validation->hasError('nama_depan')) ? 'is-invalid' : '' ?>" 
                                       id="nama_depan" 
                                       name="nama_depan" 
                                       value="<?= old('nama_depan') ?>"
                                       placeholder="Masukkan nama depan">
                                <?php if ($validation->hasError('nama_depan')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_depan') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nama_belakang" class="form-label">
                                    <i class="fas fa-user me-2"></i>Nama Belakang
                                </label>
                                <input type="text" 
                                       class="form-control <?= ($validation->hasError('nama_belakang')) ? 'is-invalid' : '' ?>" 
                                       id="nama_belakang" 
                                       name="nama_belakang" 
                                       value="<?= old('nama_belakang') ?>"
                                       placeholder="Masukkan nama belakang">
                                <?php if ($validation->hasError('nama_belakang')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_belakang') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">
                                <i class="fas fa-at me-2"></i>Username
                            </label>
                            <input type="text" 
                                   class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" 
                                   id="username" 
                                   name="username" 
                                   value="<?= old('username') ?>"
                                   placeholder="Masukkan username">
                            <?php if ($validation->hasError('username')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('username') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2"></i>Email
                            </label>
                            <input type="email" 
                                   class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" 
                                   id="email" 
                                   name="email" 
                                   value="<?= old('email') ?>"
                                   placeholder="Masukkan email">
                            <?php if ($validation->hasError('email')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Password
                                </label>
                                <input type="password" 
                                       class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Masukkan password">
                                <?php if ($validation->hasError('password')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="confirm_password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Konfirmasi Password
                                </label>
                                <input type="password" 
                                       class="form-control <?= ($validation->hasError('confirm_password')) ? 'is-invalid' : '' ?>" 
                                       id="confirm_password" 
                                       name="confirm_password" 
                                       placeholder="Konfirmasi password">
                                <?php if ($validation->hasError('confirm_password')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('confirm_password') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-register">
                                <i class="fas fa-user-plus me-2"></i>Daftar
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted">Sudah punya akun? 
                            <a href="<?= base_url('auth/login') ?>" class="text-decoration-none fw-bold">
                                Login di sini
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
