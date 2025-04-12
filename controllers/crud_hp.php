<?php
include_once '../models/HpModel.php'; // Ensure that HpModel is correctly referenced

class HpController {
    private $hpModel;

    public function __construct() {
        $this->hpModel = new HpModel(); // Create an instance of the HpModel class
    }

    // Create a new HP record
    public function create($nama_hp, $varian, $stok, $harga, $tanggal_masuk, $id_supplier) {
        // Create a new HP record using the HpModel
        $result = $this->hpModel->create($nama_hp, $varian, $stok, $harga, $tanggal_masuk, $id_supplier);

        // If the insert was successful, set a success message
        session_start();
        if ($result) {
            $_SESSION['success_message'] = "Data berhasil ditambahkan!";
        } else {
            $_SESSION['error_message'] = "Terjadi kesalahan saat menambahkan data!";
        }

        return $result;  // Return the result of the create operation
    }

    // Get all HP records
    public function read() {
        $result = $this->hpModel->read();
        $hps = [];
        while ($row = $result->fetch_assoc()) {
            $hps[] = $row;  // Fetch the result and store in an array
        }
        return $hps;  // Return an array of HP records
    }

    // Get a single HP record by ID
    public function readOne($id) {
        return $this->hpModel->readOne($id);
    }

    // Update an existing HP record by ID
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

    // Delete an HP record by ID
    public function delete($id) {
        return $this->hpModel->delete($id);
    }

    // Get all Suppliers (to be used when creating/updating HP records)
    public function getAllSuppliers() {
        $result = $this->hpModel->getAllSuppliers();
        $suppliers = [];
        while ($row = $result->fetch_assoc()) {
            $suppliers[] = $row;
        }
        return $suppliers;
    }

    // Close database connection (optional)
    public function closeConnection() {
        $this->hpModel->closeConnection();
    }
}
?>
