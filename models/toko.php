<?php
include_once '../config/koneksi.php';

class Toko {
    private $conn;

    public function __construct() {
        $db = new Koneksi();
        $this->conn = $db->getConnection();
    }

    public function getAllToko() {
        $sql = "SELECT * FROM tb_toko"; // Mengubah nama tabel menjadi tb_toko

        $result = $this->conn->query($sql);
        
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
}
?>
