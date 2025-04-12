<?php
include '../models/toko.php';  // Meng-include class Toko
include_once "navbar.php";  // Meng-include navbar

$toko = new Toko();  // Membuat instance dari class Toko
$toko = $toko->getAllToko();  // Mengambil semua data toko
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <h1 style="text-align: center;">Data toko hp</h1>
    <link rel="stylesheet" href="../views/style/table.css">
    <link rel="stylesheet" href="../views/style/tombol.css">
</head>
<body>

    <!-- Container Flex untuk menyusun tabel dan tombol -->
    <div class="content-container">
        <!-- Tabel Data Toko -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Toko</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($toko as $t): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($t['nama_toko']) ?></td>
                    <td><?= htmlspecialchars($t['alamat']) ?></td>
                    <td>
                        <?php 
                            // Menambahkan awalan '08' jika belum ada
                            $no_telepon = $t['no_telepon'];
                            if (substr($no_telepon, 0, 2) !== "08") {
                                $no_telepon = "08" . $no_telepon;
                            }
                            echo htmlspecialchars($no_telepon);
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
