<?php
include_once '../models/HpModel.php'; 

class HpController {
    private $hpModel;

    public function __construct() {
        $this->hpModel = new HpModel(); 
    }

    public function create($nama_hp, $varian, $stok, $harga, $tanggal_masuk, $id_supplier) {
        $result = $this->hpModel->create($nama_hp, $varian, $stok, $harga, $tanggal_masuk, $id_supplier);

        session_start();
        if ($result) {
            $_SESSION['success_message'] = "Data berhasil ditambahkan!";
        } else {
            $_SESSION['error_message'] = "Terjadi kesalahan saat menambahkan data!";
        }

        return $result;
    }

    public function read() {
        $result = $this->hpModel->read();
        $hps = [];
        while ($row = $result->fetch_assoc()) {
            $hps[] = $row;
        }
        return $hps;  
    }

    public function readOne($id) {
        return $this->hpModel->readOne($id);
    }

    public function update($id, $nama_hp, $varian, $stok, $harga, $tanggal_masuk) {
        $result = $this->hpModel->update($id, $nama_hp, $varian, $stok, $harga, $tanggal_masuk);

        session_start();
        if ($result) {
            $_SESSION['edit_success'] = "Edit berhasil!";
        } else {
            $_SESSION['edit_error'] = "Terjadi kesalahan saat memperbaharui data!";
        }

        return $result;
    }

    public function delete($id) {
        return $this->hpModel->delete($id);
    }

    public function getAllSuppliers() {
        $result = $this->hpModel->getAllSuppliers();
        $suppliers = [];
        while ($row = $result->fetch_assoc()) {
            $suppliers[] = $row;
        }
        return $suppliers;
    }

    public function closeConnection() {
        $this->hpModel->closeConnection();
    }
}
?>
