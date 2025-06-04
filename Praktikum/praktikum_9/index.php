<?php
session_start(); // Mulai session di setiap halaman yang membutuhkannya
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link rel="stylesheet" href="public/css/style.css"> </head>
<body>
    <div class="container">
        <h1>Selamat Datang di Aplikasi Manajemen User</h1>
        <nav>
            <ul>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li>Halo, <?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?>!</li>
                    <li><a href="users/index.php">Manajemen User (CRUD)</a></li>
                    <li><a href="auth/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="auth/login.php">Login</a></li>
                    <li><a href="auth/register.php">Registrasi</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <p>Ini adalah halaman utama. Silakan login atau registrasi untuk melanjutkan.</p>
    </div>
</body>
</html>
