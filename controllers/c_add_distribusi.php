<?php
session_start(); 
include_once '../controllers/crud_distribusi.php'; 
include_once "../config/koneksi.php";  

$DistribusiController = new Distribusi();  

$koneksi = new Koneksi();
$conn = $koneksi->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_hp = $_POST['nama_hp'];  
    $stok = $_POST['stok'];  
    $harga = $_POST['harga'];  
    $id_toko = $_POST['id_toko'];  
    $tanggal_kirim = $_POST['tanggal_kirim']; 

    if (empty($nama_hp) || empty($stok) || empty($id_toko) || empty($tanggal_kirim)) {
        $error_message = "Semua kolom harus diisi.";
        header("Location: ../views/add_distribusi.php?error=" . urlencode($error_message));
        exit;
    }

    $sql_check = "SELECT stok, harga FROM hpsamsung WHERE nama_hp = '$nama_hp'";  
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stok_tersedia = $row['stok']; 
        $harga_per_unit = $row['harga'];

        if ($stok > $stok_tersedia) {
            $error_message = "Jumlah barang yang diminta melebihi stok yang tersedia!";
            header("Location: ../views/add_distribusi.php?error=" . urlencode($error_message));
            exit();
        }

        $total_harga = $harga_per_unit * $stok;

        $new_stok_hp = $stok_tersedia - $stok;  
        $sql_update = "UPDATE hpsamsung SET stok = $new_stok_hp WHERE nama_hp = '$nama_hp'";
        if ($conn->query($sql_update) === TRUE) {
            if ($new_stok_hp == 0) {
                $sql_delete = "DELETE FROM hpsamsung WHERE nama_hp = '$nama_hp'";
                if ($conn->query($sql_delete) !== TRUE) {
                    $error_message = "Error deleting HP data: " . $conn->error;
                    header("Location: ../views/add_distribusi.php?error=" . urlencode($error_message));
                    exit();
                }
            }

            $DistribusiController->create($nama_hp, $stok, $total_harga, $tanggal_kirim, $id_toko);

            $_SESSION['success_message'] = "Data distribusi HP berhasil ditambahkan!";
            header("Location: ../views/distribusi.php");
            exit();
        } else {
            $error_message = "Error updating stock: " . $conn->error;
            header("Location: ../views/add_distribusi.php?error=" . urlencode($error_message));
            exit();
        }
    } else {
        $error_message = "HP yang diminta tidak ditemukan dalam stok!";
        header("Location: ../views/add_distribusi.php?error=" . urlencode($error_message));
        exit();
    }
}
?>
