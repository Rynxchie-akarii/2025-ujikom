<?php
include_once '../config/koneksi.php';

class ModelDetail {
    private $conn;

    public function __construct() {
        $koneksi = new Koneksi();
        $this->conn = $koneksi->getConnection();
    }

    public function getById($id) {
        $query = "SELECT d.*, t.nama_toko FROM tb_distribusi d 
                  JOIN tb_toko t ON d.id_toko = t.id_toko
                  WHERE d.id_distribusi = $id";
        $result = $this->conn->query($query);
        return $result->fetch_assoc();
    }

    public function simpanKeterangan($id_distribusi, $keterangan) {
        $query = "INSERT INTO tb_detail_distribusi (id_distribusi, keterangan) 
                  VALUES ($id_distribusi, '$keterangan')";
        return $this->conn->query($query);
    }
}
?>