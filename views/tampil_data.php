<?php
session_start(); // Start session to manage messages
error_reporting(E_ALL);
ini_set('display_errors', 1);


include_once "../models/HpModel.php"; // Memasukkan HpModel
include_once "navbar.php"; // Memasukkan navbar terpisah

$hpModel = new HpModel();
$dataHp = $hpModel->read(); // Mengambil semua data HP menggunakan metode read() dari HpModel
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Gudang HP</title>
    <h1 style="text-align: center;">Data Gudang HP</h1>
    <a href="v_add.php" class="btn-add">Tambah Data</a>
    <link rel="stylesheet" href="../views/style/add_tombol.css"> 
    <link rel="stylesheet" href="../views/style/table.css"> <!-- Style untuk tabel -->

    <style>
    .success-message {
        background-color: #4CAF50; /* Green background for Add Success */
        color: white;
        padding: 15px 20px; /* Padding with more space */
        margin: 0;
        position: fixed;
        top: 10px; /* Added slight margin from the top */
        left: 50%;
        transform: translateX(-50%); /* Center the notification */
        width: auto; /* Let the box adjust width based on content */
        max-width: 90%; /* Ensure the box doesn't overflow */
        text-align: center;
        font-size: 18px; /* Slightly larger font size */
        z-index: 1000;
        display: none;
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Soft shadow */
        opacity: 0; /* Start invisible for the fade-in effect */
        animation: fadeInOut 4s ease-out forwards; /* Animation for fading in and out */
    }

    .success-message-edit {
        background-color: #2980b9; /* Blue background for Edit Success */
        color: white;
        padding: 15px 20px; /* Padding with more space */
        margin: 0;
        position: fixed;
        top: 10px; /* Added slight margin from the top */
        left: 50%;
        transform: translateX(-50%); /* Center the notification */
        width: auto; /* Let the box adjust width based on content */
        max-width: 90%; /* Ensure the box doesn't overflow */
        text-align: center;
        font-size: 18px; /* Slightly larger font size */
        z-index: 1000;
        display: none;
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Soft shadow */
        opacity: 0; /* Start invisible for the fade-in effect */
        animation: fadeInOutEdit 4s ease-out forwards; /* Animation for fading in and out */
    }

    /* Animation for fade-in and fade-out */
    @keyframes fadeInOut {
        0% {
            opacity: 0;
            transform: translateX(-50%) translateY(-30px); /* Start from slightly above */
        }
        20% {
            opacity: 1;
            transform: translateX(-50%) translateY(0); /* Move to the regular position */
        }
        80% {
            opacity: 1; /* Fully visible */
        }
        100% {
            opacity: 0;
            transform: translateX(-50%) translateY(-30px); /* Fade out and move upwards */
        }
    }

    /* Animation for fade-in and fade-out (Edit) */
    @keyframes fadeInOutEdit {
        0% {
            opacity: 0;
            transform: translateX(-50%) translateY(-30px); /* Start from slightly above */
        }
        20% {
            opacity: 1;
            transform: translateX(-50%) translateY(0); /* Move to the regular position */
        }
        80% {
            opacity: 1; /* Fully visible */
        }
        100% {
            opacity: 0;
            transform: translateX(-50%) translateY(-30px); /* Fade out and move upwards */
        }
    }
    </style>
</head>
<body>

<!-- Success Message for Add -->
<div id="successMessageAdd" class="success-message">
    Data berhasil ditambahkan!
</div>

<!-- Success Message for Edit -->
<div id="successMessageEdit" class="success-message-edit">
    Data berhasil diperbarui!
</div>

<div class="container">
    <!-- Display the success message if set using JavaScript -->
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama HP</th>
                <th>Varian</th>
                <th>Stok</th>
                <th>Harga 1 unit hp</th>
                <th>Nama Supplier</th>
                <th>Tanggal Masuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1; // Inisialisasi nomor urut
        while ($row = $dataHp->fetch_assoc()) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama_hp']); ?></td>
                <td><?= htmlspecialchars($row['varian']); ?></td>
                <td><?= htmlspecialchars($row['stok']); ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?= htmlspecialchars($row['nama_supplier']); ?></td>
                <td><?= htmlspecialchars($row['tanggal_masuk']); ?></td>
                <td>
                   <a href="v_edit.php?id=<?= $row['id']; ?>" style="color: #3498db; font-weight: bold; text-decoration: none;" onmouseover="this.style.color='#2980b9';" onmouseout="this.style.color='#3498db';">Edit</a> |
                   <a href="delete.php?id=<?= $row['id']; ?>" style="color: #e74c3c; font-weight: bold; text-decoration: none;" onmouseover="this.style.color='#c0392b';" onmouseout="this.style.color='#e74c3c';" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- JavaScript for showing the notification -->
<script>
    // Check if the session variable 'success_message' is set in the PHP session
    <?php if (isset($_SESSION['success_message'])): ?>
        // Show the success message for adding data
        document.getElementById("successMessageAdd").style.display = "block";

        setTimeout(function() {
            document.getElementById("successMessageAdd").style.display = "none";
        }, 2000); // Hide after 2 seconds

        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    // Check if the session variable 'edit_success_message' is set in the PHP session
    <?php if (isset($_SESSION['edit_success_message'])): ?>
        // Show the success message for editing data
        document.getElementById("successMessageEdit").style.display = "block";

        setTimeout(function() {
            document.getElementById("successMessageEdit").style.display = "none";
        }, 2000); // Hide after 2 seconds

        <?php unset($_SESSION['edit_success_message']); ?>
    <?php endif; ?>
</script>

</body>
</html>
