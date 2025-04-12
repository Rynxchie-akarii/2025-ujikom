<?php
session_start(); 

include_once '../controllers/crud_distribusi.php'; 
include_once "navbar.php";

$DistribusiController = new DistribusiController();

$distribusi = $DistribusiController->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Distribusi - Manajemen Stok HP</title>
    <h1 style="text-align: center;">Data distribusi HP</h1>

    <link rel="stylesheet" href="../views/style/table.css">
<a href="add_distribusi.php" class="btn-add">Tambah Data</a>
    <link rel="stylesheet" href="../views/style/add_tombol.css">

    <style>
    .success-message {
        background-color: #4CAF50;
        color: white;
        padding: 15px 20px;
        margin: 0;
        position: fixed;
        top: 10%;
        left: 50%;
        transform: translate(-50%, -50%); 
        width: auto;
        max-width: 90%; 
        text-align: center;
        font-size: 18px;
        z-index: 1000;
        display: none;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        opacity: 0;
        animation: fadeInOut 4s ease-out forwards;
    }

    .success-message-edit {
        background-color: #2980b9;
        color: white;
        padding: 15px 20px;
        margin: 0;
        position: fixed;
        top: 10%; 
        left: 50%;
        transform: translate(-50%, -50%);
        width: auto;
        max-width: 90%;
        text-align: center;
        font-size: 18px;
        z-index: 1000;
        display: none;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        opacity: 0;
        animation: fadeInOutEdit 4s ease-out forwards;
    }

    @keyframes fadeInOut {
        0% {
            opacity: 0;
            transform: translate(-50%, -50%) translateY(-30px);
        }
        20% {
            opacity: 1;
            transform: translate(-50%, -50%) translateY(0);
        }
        80% {
            opacity: 1;
        }
        100% {
            opacity: 0;
            transform: translate(-50%, -50%) translateY(-30px);
        }
    }

    @keyframes fadeInOutEdit {
        0% {
            opacity: 0;
            transform: translate(-50%, -50%) translateY(-30px);
        }
        20% {
            opacity: 1;
            transform: translate(-50%, -50%) translateY(0);
        }
        80% {
            opacity: 1;
        }
        100% {
            opacity: 0;
            transform: translate(-50%, -50%) translateY(-30px);
        }
    }
</style>

</head>
<body>

<div id="successMessage" class="success-message">
    Data distribusi berhasil diproses!
</div>

<div id="successMessageEdit" class="success-message-edit">
    Data distribusi berhasil diperbarui!
</div>

<div class="container">
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama HP</th>
                <th>Stok</th>
                <th> Total Harga</th>
                <th>Nama Toko</th>
                <th>Tanggal Kirim</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        while ($row = $distribusi->fetch_assoc()) :
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama_hp']); ?></td>
                <td><?= htmlspecialchars($row['stok']); ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?= htmlspecialchars($row['nama_toko']); ?></td>
                <td><?= htmlspecialchars($row['tanggal_kirim']); ?></td>
                <td>
                    <a href="detail.php?id_distribusi=<?= $row['id_distribusi'] ?>" style="color: #3498db; font-weight: bold; text-decoration: none;" onmouseover="this.style.color='#2980b9';" onmouseout="this.style.color='#3498db';">Konfirmasi </a>|
                    <a href="delete_distribusi.php?id_distribusi=<?= $row['id_distribusi']; ?>" style="color: #e74c3c; font-weight: bold; text-decoration: none;" onmouseover="this.style.color='#c0392b';" onmouseout="this.style.color='#e74c3c';" onclick="return confirm('Yakin ingin menghapus distribusi ini?')">Mengembalikan</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
    <?php if (isset($_SESSION['success_message'])): ?>
        document.getElementById("successMessage").style.display = "block";
        setTimeout(function() {
            document.getElementById("successMessage").style.display = "none";
        }, 2000);
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success_message_edit'])): ?>
        document.getElementById("successMessageEdit").style.display = "block";
        setTimeout(function() {
            document.getElementById("successMessageEdit").style.display = "none";
        }, 2000);
        <?php unset($_SESSION['success_message_edit']); ?>
    <?php endif; ?>
</script>

</body>
</html>
