<?php
session_start();

// Memeriksa apakah pengguna mengonfirmasi logout
if (isset($_GET['confirm_logout'])) {
    // Hancurkan semua data sesi jika konfirmasi logout diterima
    session_unset();
    session_destroy();

    // Arahkan pengguna kembali ke halaman login setelah logout
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
    <style>
        /* Styling untuk halaman konfirmasi logout */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg,rgb(255, 110, 110),rgb(62, 134, 242)); /* Gradient background */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            color: #fff;
        }

        /* Animasi masuk untuk konfirmasi */
        @keyframes slideIn {
            0% {
                transform: translateY(-30px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .logout-container {
            width: 100%;
            max-width: 450px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
            text-align: center;
            animation: slideIn 0.6s ease-out;
            overflow: hidden;
        }

        .logout-container h3 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .logout-container p {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
        }

        .logout-container button {
            padding: 15px 30px;
            font-size: 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            width: 150px;
            margin: 10px;
            font-weight: bold;
        }

        .logout-container button:hover {
            transform: scale(1.05);
        }

        /* Tombol "Ya" */
        .logout-container button.confirm {
            background-color: #4CAF50;
            color: white;
        }

        .logout-container button.confirm:hover {
            background-color: #45a049;
            box-shadow: 0 5px 15px rgba(0, 255, 0, 0.3);
        }

        /* Tombol "Tidak" */
        .logout-container button.cancel {
            background-color: #f44336;
            color: white;
        }

        .logout-container button.cancel:hover {
            background-color: #e53935;
            box-shadow: 0 5px 15px rgba(255, 0, 0, 0.3);
        }

        /* Efek fokus pada tombol */
        .logout-container button:focus {
            outline: none;
            box-shadow: 0 0 5px 2px rgba(0, 123, 255, 0.7);
        }

        /* Responsif untuk perangkat kecil */
        @media (max-width: 500px) {
            .logout-container {
                width: 90%;
                padding: 25px;
            }

            .logout-container h3 {
                font-size: 20px;
            }

            .logout-container button {
                width: 100%;
                padding: 12px 0;
            }
        }
    </style>
</head>
<body>

<div class="logout-container">
    <h3>Apakah Anda yakin ingin keluar?</h3>
    <p>Jika Anda keluar, Anda akan kembali ke halaman login.</p>
    <a href="dashboard.php">
        <button class="cancel">Tidak</button>
    </a>
    <a href="?confirm_logout=true">
        <button class="confirm">Ya</button>
    </a>
</div>

</body>
</html>
