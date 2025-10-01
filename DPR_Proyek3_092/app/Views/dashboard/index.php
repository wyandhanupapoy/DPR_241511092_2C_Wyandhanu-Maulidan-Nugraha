<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Dashboard') ?></title>
</head>
<body>
    <nav>
        <div class="nav-container">
            <div>
                <a href="<?= base_url('dashboard') ?>"><b>Dashboard</b></a>
            </div>
            <div>
                <?php if (!empty($user['role'])): ?>
                    <span class="user-info"><?= esc($user['role']) ?></span>
                <?php endif; ?>
                <a href="<?= base_url('auth/logout') ?>">Logout</a>
            </div>
        </div>
    </nav>
    <!-- Rest of the body content -->
</body>
</html>