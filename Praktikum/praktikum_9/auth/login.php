<?php
session_start();
require_once '../config/database.php';

// Jika sudah login, arahkan ke halaman dashboard user
if (isset($_SESSION['user_id'])) {
    header("Location: ../users/index.php");
    exit();
}

$errors = [];
$username = "";

// Tampilkan pesan sukses dari registrasi jika ada
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Hapus pesan setelah ditampilkan
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username)) { $errors[] = "Username wajib diisi."; }
    if (empty($password)) { $errors[] = "Password wajib diisi."; }

    if (empty($errors)) {
        try {
            $stmt = $conn->prepare("SELECT id, username, password, nama_lengkap, role FROM users WHERE username = :username LIMIT 1");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                // Verifikasi password
                if (password_verify($password, $user['password'])) {
                    // Password cocok, simpan informasi user ke session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                    $_SESSION['role'] = $user['role']; // Simpan role

                    header("Location: ../users/index.php"); // Arahkan ke halaman dashboard user
                    exit();
                } else {
                    $errors[] = "Username atau password salah.";
                }
            } else {
                $errors[] = "Username atau password salah.";
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
    <title>Login User</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Login User</h2>

        <?php if (isset($success_message)): ?>
            <div class="success">
                <p><?php echo htmlspecialchars($success_message); ?></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="post">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <button type="submit">Login</button>
            </div>
            <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </form>
    </div>
</body>
</html>
