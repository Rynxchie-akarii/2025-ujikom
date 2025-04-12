<?php
include_once '../controllers/crud_hp.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $hpController = new HpController();  
    $hp = $hpController->readOne($id);
}

if (isset($_POST['confirm_delete'])) {
    $hpController->delete($id);
    header("Location: tampil_data.php");  
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Deletion</title>
    <link rel="stylesheet" href="../views/style/delete.css">
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

        .hp-details {
            margin-top: 20px;
            text-align: left;
        }

        button {
            padding: 10px 20px;
            margin-top: 20px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            font-size: 16px;
        }

        button[type="button"] {
            background-color:rgb(54, 152, 244);
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
        <h2>Apa anda yakin ingin menghapus data ini?</h2>
        <div class="hp-details">
            <p><strong>Nama hp</strong> <?= htmlspecialchars($hp['nama_hp']) ?></p>
            <p><strong>Varian:</strong> <?= htmlspecialchars($hp['varian']) ?></p>
            <p><strong>Stok</strong> <?= htmlspecialchars($hp['stok']) ?></p>
            <p><strong>Harga</strong> <?= htmlspecialchars($hp['harga']) ?></p>
            <p><strong>Tanggal masuk</strong> <?= htmlspecialchars($hp['tanggal_masuk']) ?></p>
            <p><strong>Id supplier</strong> <?= htmlspecialchars($hp['id_supplier']) ?></p>
        </div>

        <form method="POST" action="">
            <button type="button" onclick="window.location.href='tampil_data.php';">Batal</button>
            <button type="submit" name="confirm_delete">Ya, hapus</button>
        </form>
    </div>
</body>
</html>
