<?php
include_once '../controllers/crud_hp.php'; // Include the correct controller for HP

$hpController = new HpController(); // Use HpController to handle HP-related functionality

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $hp = $hpController->readOne($id); // Use readOne method from HpController to fetch the HP record by ID

    if (!$hp) {
        die("Data tidak ditemukan"); // Handle if no HP record is found
    }
} else {
    die("ID tidak diberikan"); // Handle if no ID is provided in the URL
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the POST data from the form submission
    $nama_hp = $_POST['nama_hp'];
    $varian = $_POST['varian'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $id_supplier = $_POST['id_supplier']; // Assuming this is part of the form as well

    // Call the update method in the HpController to update the record
    $hpController->update($id, $nama_hp, $varian, $stok, $harga, $tanggal_masuk);

    // Set the session variable to show success message
    $_SESSION['edit_success_message'] = "Data berhasil diperbarui!";

    // After updating, redirect to tampil_data.php to show all HP records
    header("Location: tampil_data.php");
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data HP</title>
    <link rel="stylesheet" href="../views/style/edit_hp.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Edit Data HP</h2>
    </div>
    
    <form method="POST" action="">
        <label for="nama_hp">NAMA HP</label>
        <input type="text" id="nama_hp" name="nama_hp" value="<?= htmlspecialchars($hp['nama_hp']) ?>" required><br>

        <div class="form-group">
            <label>Pilih Varian</label>
            <div class="radio-group">
                <div class="radio-option">
                    <input type="radio" id="varian128gb" name="varian" value="128 GB" <?= $hp['varian'] == '128 GB' ? 'checked' : '' ?>>
                    <label for="varian128gb">128 GB</label>
                </div>
                <div class="radio-option">
                    <input type="radio" id="varian256gb" name="varian" value="256 GB" <?= $hp['varian'] == '256 GB' ? 'checked' : '' ?>>
                    <label for="varian256gb">256 GB</label>
                </div>
            </div>
        </div>
        
        <label for="stok">STOK</label>
        <input type="number" id="stok" name="stok" value="<?= htmlspecialchars($hp['stok']) ?>" required><br>

        <label for="harga">Harga</label>
        <input type="number" id="harga" name="harga" value="<?= htmlspecialchars($hp['harga']) ?>" required><br>
        
        <label for="tanggal_masuk">TANGGAL MASUK</label>
        <input type="date" id="tanggal_masuk" name="tanggal_masuk" value="<?= htmlspecialchars($hp['tanggal_masuk']) ?>" required><br>
        
        <label for="id_supplier">NAMA SUPPLIER</label>
        <select name="id_supplier" required>
            <option value="">Pilih nama supplier</option>
        <?php
            include_once "../Config/Koneksi.php"; 

            $koneksi = new koneksi(); 
            $conn = $koneksi->getConnection();

            // Fetch all suppliers from the database
            $sql = "SELECT * FROM tb_supplier";
            $result = $conn->query($sql);

            // Populate the supplier options in the dropdown
            while ($row = $result->fetch_assoc()) {
                echo "<option value=\"$row[id_supplier]\" " . ($hp['id_supplier'] == $row['id_supplier'] ? "selected" : "") . ">$row[nama_supplier]</option>";
            } 
        ?>
        </select>
        <br><br>

        <div class="btn-container">
    <a href="tampil_data.php" class="btn-back">Kembali ke Daftar HP</a>
    <button type="submit">Update data hp</button>
</div>

    </form>
</div>

</body>
</html>
