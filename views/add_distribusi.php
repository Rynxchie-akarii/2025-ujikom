<?php
session_start(); // Start session to manage messages

include_once "../Config/Koneksi.php";  

$koneksi = new Koneksi();
$conn = $koneksi->getConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Distribusi HP - Form</title>
    <link rel="stylesheet" href="../views/style/add_distribusi.css">
</head>
<body>

<div class="container">
    <h2>Tambah Distribusi HP</h2>

    <!-- Display Success or Error Messages -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="success-message">
            <?= $_SESSION['success_message']; ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="error-message">
            <?= $_SESSION['error_message']; ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <form method="POST" action="../controllers/c_add_distribusi.php">
        <table>
            <tr>
                <td><label for="nama_hp">Nama HP</label></td>
                <td>
                    <select name="nama_hp" required>
                        <option>Pilih tipe hp</option>
                        <?php
                            include_once "../Config/Koneksi.php"; 

                            $koneksi = new Koneksi(); 
                            $conn = $koneksi->getConnection();

                            // Fetch mobile phones (hpsamsung table)
                            $sql = "SELECT * FROM hpsamsung";  
                            $result = $conn->query($sql);

                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row['nama_hp']) . "'>" . htmlspecialchars($row['nama_hp']) . "</option>";
                            } 
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td><label for="stok">Stok</label></td>
                <td><input type="number" id="stok" name="stok" required></td>
            </tr>
            

            <tr>
                <td><label for="id_toko">Nama Toko</label></td>
                <td>
                    <select name="id_toko" required>
                        <option>Pilih nama toko yang dituju</option>
                        <?php
                            include_once "../config/koneksi.php"; 

                            $koneksi = new Koneksi(); 
                            $conn = $koneksi->getConnection();

                            // Fetch toko data (tb_toko table)
                            $sql = "SELECT * FROM tb_toko";
                            $result = $conn->query($sql);

                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row['id_toko']) . "'>" . htmlspecialchars($row['nama_toko']) . "</option>";
                            } 
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td><label for="tanggal_kirim">Tanggal Kirim</label></td>
                <td><input type="date" id="tanggal_kirim" name="tanggal_kirim" required></td>
            </tr>

            <tr>
                <td colspan="3" class="button-container">
                    <div class="button-group">
                        <button type="button" onclick="window.location.href='distribusi.php';">Kembali ke halaman distribusi</button>
                        <button type="submit">Tambah data distribusi</button>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
