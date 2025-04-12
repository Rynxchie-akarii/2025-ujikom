<?php
include_once '../config/Koneksi.php';

class HpModel {
    private $conn;

    public function __construct() {
        $db = new Koneksi();
        $this->conn = $db->getConnection();
    }

    // Fungsi untuk menambahkan data HP
    public function create($nama_hp, $varian, $stok, $harga, $tanggal_masuk, $id_supplier) {
        if (empty($nama_hp) || empty($varian) || empty($stok) || empty($harga) || empty($tanggal_masuk) || empty($id_supplier)) {
            die('Semua kolom harus diisi.');
        }
        
        $sql = "INSERT INTO hpsamsung (nama_hp, varian, stok, harga, tanggal_masuk, id_supplier) 
                VALUES ('$nama_hp', '$varian', $stok, $harga, '$tanggal_masuk', '$id_supplier')";

        if ($this->conn->query($sql)) {
            return true;
        } else {
            die('Error executing query: ' . $this->conn->error);
        }
    }

    // Fungsi untuk mengambil semua data HP
    public function read() {
        $sql = "SELECT * FROM hpsamsung, tb_supplier WHERE hpsamsung.id_supplier = tb_supplier.id_supplier";
        return $this->conn->query($sql);
    }

    // Fungsi untuk mengambil data HP berdasarkan ID
    public function readOne($id) {
        $sql = "SELECT * FROM hpsamsung WHERE id = $id";
        return $this->conn->query($sql)->fetch_assoc();
    }

    // Fungsi untuk mengedit data HP berdasarkan ID
    public function update($id, $nama_hp, $varian, $stok, $harga, $tanggal_masuk) {
        $sql = "UPDATE hpsamsung 
                SET nama_hp = '$nama_hp', varian = '$varian', stok = $stok, harga = $harga, tanggal_masuk = '$tanggal_masuk' 
                WHERE id = $id";
        
        if ($this->conn->query($sql)) {
            return true;
        } else {
            die('Error executing query: ' . $this->conn->error);
        }
    }

    // Fungsi untuk menghapus data HP berdasarkan ID
    public function delete($id) {
        $sql = "DELETE FROM hpsamsung WHERE id = $id";
        return $this->conn->query($sql);
    }

    // Fungsi untuk mengambil semua data Supplier
    public function getAllSuppliers() {
        $sql = "SELECT * FROM tb_supplier";
        return $this->conn->query($sql);
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
