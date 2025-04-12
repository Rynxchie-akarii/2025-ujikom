<?php
include_once '../models/detail.php'; // pastikan file ini memuat class ModelDetail
include_once 'navbar.php';

$model = new ModelDetail();
$conn = (new Koneksi())->getConnection();

// Ambil semua data distribusi yang sudah punya keterangan (detail)
$query = "SELECT d.id_distribusi, d.nama_hp, d.stok, d.harga, d.tanggal_kirim, 
                 t.nama_toko, dd.keterangan 
          FROM tb_distribusi d
          JOIN tb_toko t ON d.id_toko = t.id_toko
          JOIN tb_detail_distribusi dd ON d.id_distribusi = dd.id_distribusi";
$result = $conn->query($query);

$details = [];
while ($row = $result->fetch_assoc()) {
    $details[] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Distribusi HP</title>
    <link rel="stylesheet" href="../views/style/table.css">
</head>
<body>

<div class="content-container">
    <h1 style="text-align: center;">Detail Distribusi HP</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama HP</th>
                <th>Stok</th>
                <th>Total Harga</th>
                <th>Toko</th>
                <th>Tanggal Kirim</th>
                <th>Status Distribusi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($details)): ?>
                <?php $no = 1; ?>
                <?php foreach ($details as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($item['nama_hp']) ?></td>
                        <td><?= $item['stok'] ?></td>
                        <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($item['nama_toko']) ?></td>
                        <td><?= date('d-m-Y', strtotime($item['tanggal_kirim'])) ?></td>
                        <td><?= htmlspecialchars($item['keterangan']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8">Belum ada detail distribusi yang tersedia.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
