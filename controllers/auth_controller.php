<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once __DIR__ . '/../models/user_model.php';

if (!class_exists('Login')) {
    die('Class Login tidak ditemukan. Periksa file user_model.php');
}

$user = new Login();

function redirectWithMessage($url, $message) {
    $_SESSION['message'] = $message;
    header("Location: $url");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        redirectWithMessage('../index.php', 'Username atau password tidak boleh kosong');
    }

    $aksi = $user->login($username, $password);

    if ($aksi) {
        $_SESSION['username'] = $username;
        header("Location: ../views/dashboard.php"); 
        exit;
    } else {
        redirectWithMessage('../index.php', 'Username atau password salah');
    }
}

if (isset($_GET['aksi']) && $_GET['aksi'] === 'logout') {
    session_destroy();
    redirectWithMessage('../index.php', 'Anda telah keluar dari sistem');
}
?>
