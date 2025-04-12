<?php
include_once '../models/distribusi.php'; 

class DistribusiController {
    private $model;

    public function __construct() {
        $this->model = new Distribusi();
    }

    public function create($nama_hp, $stok, $harga, $tanggal_kirim, $id_toko) {
        return $this->model->create($nama_hp, $stok, $harga, $tanggal_kirim, $id_toko);
    }

    public function read() {
        return $this->model->read();  
    }

    public function readOne($id_distribusi) {
        return $this->model->readOne($id_distribusi);
    }

    public function update($id_distribusi, $tanggal_kirim) {
        return $this->model->update($id_distribusi, $tanggal_kirim);
    }

    public function delete($id_distribusi) {
        return $this->model->delete($id_distribusi);
    }

    public function deleteAndRestore($id, $conn) {
    $sql_get = "SELECT * FROM tb_distribusi WHERE id_distribusi = '$id'";
    $result = $conn->query($sql_get);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (!$row) {
            die("Data distribusi tidak ditemukan.");
        }

        $nama_hp = $row['nama_hp'];
        $stok = $row['stok'];

        $sql_check = "SELECT stok FROM hpsamsung WHERE nama_hp = '$nama_hp'";
        $result_check = $conn->query($sql_check);

        if ($result_check && $result_check->num_rows > 0) {
            $data_hp = $result_check->fetch_assoc();
            $stok_tersedia = $data_hp['stok'];
            $new_stok = $stok_tersedia + $stok;

            $conn->query("UPDATE hpsamsung SET stok = $new_stok WHERE nama_hp = '$nama_hp'");
        } else {
            $conn->query("INSERT INTO hpsamsung (nama_hp, stok) VALUES ('$nama_hp', $stok)");
        }

        $conn->query("DELETE FROM tb_detail_distribusi WHERE id_distribusi = '$id'");

        $conn->query("DELETE FROM tb_distribusi WHERE id_distribusi = '$id'");
    } else {
        die("Distribusi dengan ID $id tidak ditemukan.");
    }
}

}
?>
