<?php
session_start(); // Start the session to manage messages

include_once '../controllers/crud_hp.php'; // Ensure the correct path to the controller

// Create an instance of the HpController (adjust the class name accordingly)
$hpController = new HpController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the form
    $nama_hp = $_POST['nama_hp'];
    $varian = $_POST['varian'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $tanggal_masuk = $_POST['tanggal_masuk']; 
    $id_supplier = $_POST['id_supplier'];

    // Simple validation to check if all fields are filled
    if (empty($nama_hp) || empty($varian) || empty($stok) || empty($tanggal_masuk) || empty($id_supplier)) {
        echo "Semua kolom harus diisi."; // Error message if any field is empty
        exit; // Stop the script from executing further
    }

    // Call the create method in the HpController to insert the record
    $hpController->create($nama_hp, $varian, $stok, $harga, $tanggal_masuk, $id_supplier);

    // Set the success message in the session
    $_SESSION['success_message'] = "Data berhasil ditambahkan!";

    // Redirect to the tampil_data.php page after successful insertion
    header("Location: tampil_data.php");
    exit(); // Ensure no further code is executed
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data HP</title>
    <link rel="stylesheet" href="../views/style/add_hp.css">
</head>
<body>

<div class="container">
    <h2>Tambah Data HP</h2>

    <form method="POST" action="">
        <div class="form-group">
            <label for="nama_hp">Nama HP:</label>
            <input type="text" name="nama_hp" required>
        </div>

        <div class="form-group radio-buttons">
            <label for="varian">Varian:</label>
            <label>
                <input type="radio" name="varian" value="128 GB" required>
                128 GB
            </label>
            <label>
                <input type="radio" name="varian" value="256 GB" required>
                256 GB
            </label>
        </div>

        <div class="form-group">
            <label for="stok">Stok:</label>
            <input type="number" name="stok" required>
        </div>

        <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="number" name="harga" required>
        </div>

        <div class="form-group">
            <label for="tanggal_masuk">Tanggal Masuk:</label>
            <input type="date" name="tanggal_masuk" required>
        </div>

        <label for="id_supplierr">NAMA SUPPPLIER</label>
        <select name="id_supplier">
            <option>-----</option>
        <?php
            include_once "../config/koneksi.php"; 

            $koneksi = new koneksi(); 
            $conn = $koneksi->getConnection();

            $sql = "SELECT * FROM tb_supplier";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "  <option value=$row[id_supplier]>$row[nama_supplier]</option>";
            } 
        ?>
        </select>

        <td colspan="3" class="button-container">
                    <div class="button-group">
                        <button type="button" onclick="window.location.href='tampil_data.php';">Kembali ke halaman hp</button>
                        <button type="submit">Tambah data hp</button>
                    </div>
                </td>
    </form>
</div>

</body>
</html>
