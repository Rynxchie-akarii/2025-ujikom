<?php
// Login.php
include_once "../Config/Koneksi.php";  // Include Koneksi.php file here

// Login class that extends Koneksi
class Login extends Koneksi
{
    // Method to log the user in
    public function login($username, $password)
    {
        $query = "SELECT * FROM login_user WHERE username = '$username' AND password = '$password'";
        $result = parent::Query_Tampil($query);  // Calling inherited Query_Tampil method

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // Method to add a new account
    public function tambah_akun($username, $password)
    {
        $query = "INSERT INTO login_user (username, password) VALUES ('$username', '$password')";
        return parent::Query_Perintah($query);  // Calling inherited Query_Perintah method
    }
}
?>
