<?php
include_once '../config/koneksi.php';

class Distribusi {
    private $conn;
    private $table = "tb_distribusi"; // Tabel tetap "tb_distribusi"

    public function __construct() {
        $db = new Koneksi();
        $this->conn = $db->getConnection();
    }

    // Create (Menambah distribusi HP baru)
    public function create($nama_hp, $stok, $harga, $tanggal_kirim, $id_toko) {
        if (empty($nama_hp) || empty($stok) || empty($harga) || empty($tanggal_kirim) || empty($id_toko)) {
            die('Semua kolom harus diisi.');
        }

        // Query untuk insert distribusi HP
        $query = "INSERT INTO $this->table (nama_hp, stok, harga, tanggal_kirim, id_toko) 
                  VALUES ('$nama_hp', $stok, $harga, '$tanggal_kirim', '$id_toko')";

        if (!$this->conn->query($query)) {
            die('Error executing query: ' . $this->conn->error);
        }
    }

    // Read (Mengambil semua data distribusi HP)
    public function read() {
        $query = "SELECT * FROM $this->table, tb_toko WHERE $this->table.id_toko = tb_toko.id_toko";
        return $this->conn->query($query);
    }

    // Read One (Mengambil data distribusi HP berdasarkan ID)
    public function readOne($id_distribusi) {
        $query = "SELECT * FROM $this->table WHERE id_distribusi = $id_distribusi";
        return $this->conn->query($query)->fetch_assoc();
    }

    // Update (Memperbarui data distribusi HP berdasarkan ID)
    public function update($id_distribusi, $tanggal_kirim) {
        $query = "UPDATE $this->table 
                  SET tanggal_kirim = '$tanggal_kirim' 
                  WHERE id_distribusi = $id_distribusi";

        if (!$this->conn->query($query)) {
            die('Error executing query: ' . $this->conn->error);
        }
    }

    // Delete (Menghapus data distribusi HP berdasarkan ID)
    public function delete($id_distribusi) {
        $query = "DELETE FROM $this->table WHERE id_distribusi = $id_distribusi";
        return $this->conn->query($query);
    }
}
?>
