<?php
include_once '../models/distribusi.php'; // Pastikan model distribusi sudah mendukung field 'harga'

class DistribusiController {
    private $model;

    public function __construct() {
        $this->model = new Distribusi(); // Model untuk distribusi HP
    }

    // Create (Menambah distribusi HP baru)
    public function create($nama_hp, $stok, $harga, $tanggal_kirim, $id_toko) {
        return $this->model->create($nama_hp, $stok, $harga, $tanggal_kirim, $id_toko);
    }

    // Read (Mengambil semua data distribusi HP)
    public function read() {
        return $this->model->read();  
    }

    // Read One (Mengambil data distribusi HP berdasarkan ID)
    public function readOne($id_distribusi) {
        return $this->model->readOne($id_distribusi);
    }

    // Update (Memperbarui data distribusi HP berdasarkan ID)
    public function update($id_distribusi, $tanggal_kirim) {
        return $this->model->update($id_distribusi, $tanggal_kirim); // Memanggil metode update() di model
    }

    // Delete (Menghapus data distribusi HP berdasarkan ID)
    public function delete($id_distribusi) {
        return $this->model->delete($id_distribusi);
    }

    // Delete and Restore (Menghapus dan mengembalikan stok HP serta harga ke tabel hpsamsung)
    public function deleteAndRestore($id, $conn) {
        $sql_get = "SELECT * FROM tb_distribusi WHERE id_distribusi = '$id'";
        $result = $conn->query($sql_get);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nama_hp = $row['nama_hp']; // Mengganti nama_motor dengan nama_hp
            $stok = $row['stok']; // Changed from 'jumlah' to 'stok'
            $harga = $row['harga']; // Ambil harga dari distribusi

            // Cek apakah HP dengan nama yang sama masih ada di hpsamsung
            $sql_check = "SELECT stok, harga FROM hpsamsung WHERE nama_hp = '$nama_hp'"; // Mengambil stok dan harga
            $result_check = $conn->query($sql_check);

            if ($result_check->num_rows > 0) {
                // Jika HP sudah ada di hpsamsung, update stok dan harga
                $stok_tersedia = $result_check->fetch_assoc(); // Ambil hasil pertama untuk stok dan harga
                $stok_tersedia = $stok_tersedia['stok'];
                $existing_price = $result_check->fetch_assoc()['harga']; // Ambil harga yang ada sekarang

                $new_stok = $stok_tersedia + $stok;

                // Jika harga yang baru lebih tinggi, update harga
                if ($harga > $existing_price) {
                    // Update harga hanya jika harga baru lebih tinggi
                    $conn->query("UPDATE hpsamsung SET stok = $new_stok, harga = $harga WHERE nama_hp = '$nama_hp'");
                } else {
                    // Jika harga sama atau lebih rendah, hanya update stok
                    $conn->query("UPDATE hpsamsung SET stok = $new_stok WHERE nama_hp = '$nama_hp'");
                }
            } else {
                // Jika HP belum ada di hpsamsung, tambahkan data baru dengan harga
                $conn->query("INSERT INTO hpsamsung (nama_hp, stok, harga) VALUES ('$nama_hp', $stok, $harga)");
            }

            // Hapus data dari distribusi
            $conn->query("DELETE FROM tb_distribusi WHERE id_distribusi = '$id'");
        }
    }
}
?>
