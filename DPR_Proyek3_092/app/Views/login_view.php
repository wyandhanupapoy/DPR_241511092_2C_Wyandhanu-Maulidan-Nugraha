<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Silakan Login</h2>

    <?php if(session()->getFlashdata('error')): ?>
        <div style="color: red;">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('login/process') ?>" method="post">
        <?= csrf_field() ?>
        <div>
            <label for="username">Username</label><br>
            <input type="text" name="username" id="username" required>
        </div>
        <br>
        <div>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" required>
        </div>
        <br>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>