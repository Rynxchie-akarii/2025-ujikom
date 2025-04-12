<?php
include_once '../controllers/crud_distribusi.php';
include_once "../config/koneksi.php";  

$distribusiController = new DistribusiController(); 
$koneksi = new Koneksi();
$conn = $koneksi->getConnection();

// Check if 'id_distribusi' is provided via GET request
if (isset($_GET['id_distribusi']) && !empty($_GET['id_distribusi'])) {
    $id_distribusi = $_GET['id_distribusi'];
    
    // Retrieve the distribusi data by id_distribusi
    $distribusi = $distribusiController->readOne($id_distribusi);

    // Check if the distribusi data is found
    if (!$distribusi) {
        die("Data tidak ditemukan");  // No data found with this ID
    }
} else {
    // If ID is not provided, display an error message
    die("ID tidak diberikan. Pastikan URL memiliki parameter id_distribusi.");
}

// Handle the form submission to update the distribusi data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the tanggal_kirim from the form
    $tanggal_kirim = $_POST['tanggal_kirim'];

    // Call the controller's update method to update the record
    $distribusiController->update($id_distribusi, $tanggal_kirim); // Perbaiki objek yang dipanggil

    // Set a session variable for success message
    session_start();
    $_SESSION['success_message_edit'] = "Data distribusi berhasil diperbarui!";

    // Redirect to the distribusi page after successful update
    header("Location: distribusi.php"); // Pastikan tidak ada output sebelum header
    exit(); 
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Distribusi HP</title>
    <link rel="stylesheet" href="../views/style/edit_distribusi.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Edit Data Distribusi HP</h2>
    </div>
    
    <form method="POST" action="">
<!-- Display the 'nama_hp' in an editable input field -->
<label for="nama_hp">NAMA HP</label>
    <input type="text" id="nama_hp" name="nama_hp" value="<?= htmlspecialchars($distribusi['nama_hp']) ?>" required><br><br>

    <!-- Display the 'stok' in an editable input field -->
    <label for="stok">Stok</label>
    <input type="number" id="stok" name="stok" value="<?= htmlspecialchars($distribusi['stok']) ?>" required><br><br>

        <!-- Dropdown to select 'id_toko' (dealer name) -->
        <label for="id_toko">NAMA TOKO</label>
        <select name="id_toko">
            <option>-----</option>
            <?php
                // Fetch all the dealer names from the tb_toko table
                $sql = "SELECT * FROM tb_toko";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    // Populate the dropdown with the dealer names
                    echo "  <option value='{$row['id_toko']}'" . ($row['id_toko'] == $distribusi['id_toko'] ? ' selected' : '') . ">{$row['nama_toko']}</option>";
                } 
            ?>
        </select><br>

        <!-- Date field for 'tanggal_kirim' -->
        <label for="tanggal_kirim">TANGGAL KIRIM</label>
        <input type="date" id="tanggal_kirim" name="tanggal_kirim" value="<?= htmlspecialchars($distribusi['tanggal_kirim']) ?>" required><br>

        <div class="btn-container">
    <a href="distribusi.php" class="btn-back">Kembali ke Daftar distribusi</a>
    <button type="submit">Update data distribusi</button>
</div>
    </form>

</div>

</body>
</html>
