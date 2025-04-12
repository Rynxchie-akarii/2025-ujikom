<?php
include_once '../controllers/crud_distribusi.php';  
include_once '../config/koneksi.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$koneksi = new Koneksi();
$conn = $koneksi->getConnection();

$distribusiController = new DistribusiController();

if (isset($_GET['id_distribusi'])) {
    $id = $_GET['id_distribusi'];
    $distribusi = $distribusiController->readOne($id);
} else {
    echo "No ID provided!";
    exit;
}

if (isset($_POST['confirm_delete'])) {
    $distribusiController->deleteAndRestore($id, $conn);  
    header("Location: ../views/distribusi.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../views/style/delete.css">
    <title>Confirm Deletion</title>
    <style>
        .confirmation-container {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            margin: 50px auto;
            text-align: center;
            opacity: 0; 
            transform: translateY(-30px); 
            animation: slideIn 0.8s ease-out forwards;
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            font-size: 22px;
            color: #333;
            margin-bottom: 20px;
        }

        .hp-details {
            margin-top: 20px;
            text-align: left;
        }

        .hp-details p {
            font-size: 16px;
            margin: 5px 0;
            color: #555;
        }

        .hp-details strong {
            color: #333;
        }

        button {
            padding: 10px 20px;
            margin-top: 20px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            width: 100%;
        }

        button[type="button"] {
            background-color: rgb(54, 152, 244);
            color: white;
        }

        button[type="submit"] {
            background-color: #f44336;
            color: white;
        }

        button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

    <div class="confirmation-container">
        <h2>Apa anda yakin ingin mengembalikan data ini?</h2>

        <div class="hp-details">
            <p><strong>Nama hp</strong> <?= htmlspecialchars($distribusi['nama_hp']) ?></p>
            <p><strong>Stok:</strong> <?= htmlspecialchars($distribusi['stok']) ?></p>
            <p><strong>Harga:</strong> <?= htmlspecialchars($distribusi['harga']) ?></p>
            <p><strong>Id toko:</strong> <?= htmlspecialchars($distribusi['id_toko']) ?></p>
            <p><strong>Tanggal kirim:</strong> <?= htmlspecialchars($distribusi['tanggal_kirim']) ?></p>
        </div>

        <form method="POST" action="">
            <button type="button" onclick="window.location.href='../views/distribusi.php';">Batal</button>
            <button type="submit" name="confirm_delete">Ya, hapus</button>
        </form>
    </div>

</body>
</html>
