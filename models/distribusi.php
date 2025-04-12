<?php
include_once '../config/koneksi.php';

class Distribusi {
    private $conn;
    private $table = "tb_distribusi"; 

    public function __construct() {
        $db = new Koneksi();
        $this->conn = $db->getConnection();
    }

    public function create($nama_hp, $stok, $harga, $tanggal_kirim, $id_toko) {
        if (empty($nama_hp) || empty($stok) || empty($harga) || empty($tanggal_kirim) || empty($id_toko)) {
            die('Semua kolom harus diisi.');
        }

        $query = "INSERT INTO $this->table (nama_hp, stok, harga, tanggal_kirim, id_toko) 
                  VALUES ('$nama_hp', $stok, $harga, '$tanggal_kirim', '$id_toko')";

        if (!$this->conn->query($query)) {
            die('Error executing query: ' . $this->conn->error);
        }
    }

    public function read() {
        $query = "SELECT * FROM $this->table, tb_toko WHERE $this->table.id_toko = tb_toko.id_toko";
        return $this->conn->query($query);
    }

    public function readOne($id_distribusi) {
        $query = "SELECT * FROM $this->table WHERE id_distribusi = $id_distribusi";
        return $this->conn->query($query)->fetch_assoc();
    }

    public function update($id_distribusi, $tanggal_kirim) {
        $query = "UPDATE $this->table 
                  SET tanggal_kirim = '$tanggal_kirim' 
                  WHERE id_distribusi = $id_distribusi";

        if (!$this->conn->query($query)) {
            die('Error executing query: ' . $this->conn->error);
        }
    }

    public function delete($id_distribusi) {
        $query = "DELETE FROM $this->table WHERE id_distribusi = $id_distribusi";
        return $this->conn->query($query);
    }
}
?>
