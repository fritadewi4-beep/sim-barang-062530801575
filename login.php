<?php
session_start();

$error = '';

// Data pengguna terenkapsulasi pada array asosiatif
$users = [
    'admin' => 'password123'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION['is_logged_in'] = true;
        $_SESSION['user'] = $username;
        header('Location: index.php');
        exit;
    } else {
        $error = 'Username atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIM-Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>SIM-Barang</h1>
        <p>Sistem Informasi Manajemen Inventaris Barang Jurusan</p>
    </header>

    <main style="max-width: 400px; margin: 30px auto; grid-template-columns: 1fr;">
        <section>
            <h2>Login SIM-Barang</h2>
            <?php if (!empty($error)): ?>
                <p style="color: red; margin-bottom: 10px;"><?= $error ?></p>
            <?php endif; ?>
            <form action="login.php" method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required placeholder="Masukkan username">
                
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Masukkan password">
                
                <button type="submit" style="margin-top: 15px; width: 100%;">Login</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 SIM-Barang | Afrita Mukti Sari dewi | 062530801575 | 3IB</p>
    </footer>
</body>
</html>