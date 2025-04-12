<?php
session_start(); // Start session to manage messages

include_once '../controllers/crud_distribusi.php'; // Ensure the path to your controller is correct
include_once "navbar.php";

$DistribusiController = new DistribusiController();

// Fetch data from the controller (it should return data of HP distribution)
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
        top: 10%; /* Adjust the percentage to control the vertical position */
        left: 50%; /* Center horizontally */
        transform: translate(-50%, -50%); /* Offset both horizontally and vertically */
        width: auto;
        max-width: 90%; /* Ensure the box doesn't overflow */
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
        background-color: #2980b9; /* Blue background for Edit Success */
        color: white;
        padding: 15px 20px;
        margin: 0;
        position: fixed;
        top: 10%; /* Adjust the percentage to control the vertical position */
        left: 50%; /* Center horizontally */
        transform: translate(-50%, -50%); /* Offset both horizontally and vertically */
        width: auto;
        max-width: 90%; /* Ensure the box doesn't overflow */
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

<!-- Success Message for Add -->
<div id="successMessage" class="success-message">
    Data distribusi berhasil diproses!
</div>

<!-- Success Message for Edit -->
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
                <th>Harga</th>
                <th>Nama Toko</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Tanggal Kirim</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        while ($row = $distribusi->fetch_assoc()) :  // Fetch data from the controller
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama_hp']); ?></td>
                <td><?= htmlspecialchars($row['stok']); ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?= htmlspecialchars($row['nama_toko']); ?></td>
                <td><?= htmlspecialchars($row['alamat']); ?></td>
                <td><?= '08' . htmlspecialchars($row['no_telepon']); ?></td>
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
    // Check if the session variable 'success_message' is set for add operation
    <?php if (isset($_SESSION['success_message'])): ?>
        // Display success message for add
        document.getElementById("successMessage").style.display = "block";
        setTimeout(function() {
            document.getElementById("successMessage").style.display = "none";
        }, 2000); // Hide after 2 seconds
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    // Check if the session variable 'success_message_edit' is set for edit operation
    <?php if (isset($_SESSION['success_message_edit'])): ?>
        // Display success message for edit
        document.getElementById("successMessageEdit").style.display = "block";
        setTimeout(function() {
            document.getElementById("successMessageEdit").style.display = "none";
        }, 2000); // Hide after 2 seconds
        <?php unset($_SESSION['success_message_edit']); ?>
    <?php endif; ?>
</script>

</body>
</html>
