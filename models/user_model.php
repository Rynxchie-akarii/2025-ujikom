<?php
require_once __DIR__ . '/../config/koneksi.php';

class Login extends koneksi{
    private $db;

    public function __construct() {
        $this->db = new koneksi(); 
    }

    public function login($username, $password) {
        $conn = $this->db->getConnection();  

        if (!$conn) {
            die("Koneksi gagal");
        }

        $query = "SELECT * FROM login_user WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            return true;  
        } else {
            return false;  
        }
    }

    public function tambah_akun($username, $password) {
        $query_check = "SELECT * FROM tb_user WHERE username = '$username'";
        $result = $this->Query_Tampil($query_check);
    
        if ($result) {
            return false;
        } else {
            $query = "INSERT INTO tb_user (username, password) VALUES ('$username', '$password')";
            $eksekusi = $this->Query_Perintah($query);
            return $eksekusi;
        }
    }
    
}
?>