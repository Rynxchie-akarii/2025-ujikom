<?php
session_start(); // Memulai sesi untuk memeriksa apakah pengguna sudah login

// Jika pengguna sudah login, arahkan ke dashboard
if (isset($_SESSION['username'])) {
    header("Location: ../views/dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./views/style/v_login.css">
</head>
<body>
<div class="login-container">
    <h2>Login</h2>
    <form action="controllers/auth_controller.php" method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <div class="input-wrapper">
                <div class="input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                <input type="text" name="username" id="username" required>
            </div>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <div class="input-wrapper">
                <div class="input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                    </svg>
                </div>
                <input type="password" name="password" id="password" required>
            </div>
        </div>
        <button type="submit" name="login">Login</button>
    </form>
</div>
</body>
</html>
