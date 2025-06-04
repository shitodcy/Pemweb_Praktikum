<?php
session_start();
require_once '../config/database.php'; // Hubungkan ke database

$errors = [];
$username = $nama_lengkap = $email = ""; // Inisialisasi variabel

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $email = trim($_POST['email']);
    $role = $_POST['role'] ?? 'user'; // Default ke 'user' jika tidak ada

    // --- Validasi Input Sederhana ---
    if (empty($username)) { $errors[] = "Username wajib diisi."; }
    if (strlen($username) < 4) { $errors[] = "Username minimal 4 karakter."; }
    if (empty($password)) { $errors[] = "Password wajib diisi."; }
    if (strlen($password) < 6) { $errors[] = "Password minimal 6 karakter."; }
    if ($password !== $konfirmasi_password) { $errors[] = "Konfirmasi password tidak cocok."; }
    if (empty($nama_lengkap)) { $errors[] = "Nama lengkap wajib diisi."; }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email tidak valid atau wajib diisi.";
    }
    if (!in_array($role, ['admin', 'user'])) { $errors[] = "Role tidak valid."; }


    // --- Cek apakah username atau email sudah ada ---
    if (empty($errors)) {
        try {
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = :username OR email = :email LIMIT 1");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $errors[] = "Username atau Email sudah terdaftar. Silakan gunakan yang lain.";
            }
        } catch (PDOException $e) {
            $errors[] = "Error saat memeriksa data: " . $e->getMessage();
        }
    }

    // --- Jika tidak ada error, simpan ke database ---
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Hash password

        try {
            $stmt = $conn->prepare("INSERT INTO users (username, password, nama_lengkap, email, role) VALUES (:username, :password, :nama_lengkap, :email, :role)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':nama_lengkap', $nama_lengkap);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':role', $role);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Registrasi berhasil! Silakan login.";
                header("Location: login.php"); // Arahkan ke halaman login
                exit();
            } else {
                $errors[] = "Registrasi gagal. Silakan coba lagi.";
            }
        } catch (PDOException $e) {
            $errors[] = "Error database: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi User</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Registrasi User Baru</h2>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="register.php" method="post">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="konfirmasi_password">Konfirmasi Password:</label>
                <input type="password" id="konfirmasi_password" name="konfirmasi_password" required>
            </div>
            <div>
                <label for="nama_lengkap">Nama Lengkap:</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo htmlspecialchars($nama_lengkap); ?>" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div>
                <label for="role">Role:</label>
                <select id="role" name="role">
                    <option value="user" selected>User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div>
                <button type="submit">Daftar</button>
            </div>
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </form>
    </div>
</body>
</html>
