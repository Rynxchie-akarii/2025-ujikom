<?php
include_once '../models/detail.php';

class DetailController {
    private $model;

    public function __construct() {
        $this->model = new ModelDetail();
    }

    public function detail($id) {
        return $this->model->getById($id);
    }

    public function simpanStatus($id, $keterangan) {
        return $this->model->simpanKeterangan($id, $keterangan);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_distribusi = $_POST['id_distribusi'];
    $keterangan = $_POST['keterangan'];

    $controller = new DetailController();
    $result = $controller->simpanStatus($id_distribusi, $keterangan);

    if ($result) {
        header("Location: ../views/distribusi.php");
        exit();
    } else {
        echo "❌ Gagal menyimpan keterangan ke detail distribusi.";
    }
}