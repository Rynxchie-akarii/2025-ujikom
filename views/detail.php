<?php
include_once '../config/koneksi.php';

$id_distribusi = $_GET['id_distribusi'] ?? 0;
$conn = (new Koneksi())->getConnection();

$query = "SELECT d.*, t.nama_toko FROM tb_distribusi d
          JOIN tb_toko t ON d.id_toko = t.id_toko
          WHERE d.id_distribusi = $id_distribusi";
$result = $conn->query($query);
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Distribusi</title>
    <link rel="stylesheet" href="../views/style/detail.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2>Detail Distribusi</h2>

        <?php if ($data): ?>
        <form action="../controllers/detail_c.php" method="POST">
            <input type="hidden" name="id_distribusi" value="<?= $data['id_distribusi'] ?>">

            <p><strong>Nama HP:</strong> <?= $data['nama_hp'] ?></p>
            <p><strong>Stok</strong> <?= $data['stok'] ?></p>
            <p><strong>Total Harga:</strong> Rp <?= number_format($data['harga'], 0, ',', '.') ?></p>
            <p><strong>Toko hp</strong> <?= $data['nama_toko'] ?></p>
            <p><strong>Tanggal Kirim:</strong> <?= $data['tanggal_kirim'] ?></p>

            <label for="keterangan"><strong>Status Distribusi:</strong></label>
            <select name="keterangan" required>
                <option value="">-- Pilih Status --</option>
                <option value="Dikembalikan">Dikembalikan</option>
                <option value="Diperjalanan">Diperjalanan</option>
                <option value="Terkirim">Terkirim</option>
            </select>

            <button type="submit" class="btn-add">Simpan</button>
        </form>
        <?php else: ?>
            <p>Data tidak ditemukan.</p>
        <?php endif; ?>

        <div class="back-btn-container">
            <a href="distribusi.php" class="btn-back">Kembali</a>
        </div>
    </div>
</body>
</html>
