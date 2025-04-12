-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Apr 2025 pada 15.52
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gudang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hpsamsung`
--

CREATE TABLE `hpsamsung` (
  `id` int(11) NOT NULL,
  `nama_hp` varchar(25) NOT NULL,
  `varian` enum('128 gb','256 gb') NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `id_supplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hpsamsung`
--

INSERT INTO `hpsamsung` (`id`, `nama_hp`, `varian`, `stok`, `harga`, `tanggal_masuk`, `id_supplier`) VALUES
(42, 'samsung a31', '256 gb', 15, 1000000, '2025-02-05', 3),
(44, 'samsung a99', '256 gb', 25, 2500000, '2025-02-22', 2),
(53, 'samsung a05', '128 gb', 7, 1600000, '2025-03-27', 2),
(56, 'samsung a56', '256 gb', 12, 2000000, '2025-03-27', 2),
(57, 'samsung a28', '256 gb', 6, 2300000, '2025-03-29', 1),
(58, 'samsung a80', '128 gb', 9, 6400000, '2025-03-29', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_user`
--

CREATE TABLE `login_user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login_user`
--

INSERT INTO `login_user` (`iduser`, `username`, `password`) VALUES
(1, 'ridwan', '1wan'),
(2, 'Admin ', '12345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_distribusi`
--

CREATE TABLE `tb_detail_distribusi` (
  `id_detail` int(11) NOT NULL,
  `id_distribusi` int(11) NOT NULL,
  `keterangan` enum('Dikembalikan','Diperjalanan','Terkirim') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_detail_distribusi`
--

INSERT INTO `tb_detail_distribusi` (`id_detail`, `id_distribusi`, `keterangan`) VALUES
(2, 92, 'Diperjalanan'),
(3, 93, 'Terkirim');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_distribusi`
--

CREATE TABLE `tb_distribusi` (
  `id_distribusi` int(11) NOT NULL,
  `nama_hp` varchar(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `tanggal_kirim` date NOT NULL,
  `id_toko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_distribusi`
--

INSERT INTO `tb_distribusi` (`id_distribusi`, `nama_hp`, `stok`, `harga`, `tanggal_kirim`, `id_toko`) VALUES
(92, 'samsung a99', 6, 15000000, '2025-04-26', 2),
(93, 'samsung a05', 2, 3200000, '2025-04-25', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(35) NOT NULL,
  `alamat` varchar(35) NOT NULL,
  `no_telepon` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `nama_supplier`, `alamat`, `no_telepon`) VALUES
(1, 'pt samsung sukamaju', 'bandung', 881526632),
(2, 'pt samsung electronics indonesia', 'jln jababeka raya blok f29 cikarang', 877665544);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_toko`
--

CREATE TABLE `tb_toko` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(35) NOT NULL,
  `alamat` varchar(35) NOT NULL,
  `no_telepon` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_toko`
--

INSERT INTO `tb_toko` (`id_toko`, `nama_toko`, `alamat`, `no_telepon`) VALUES
(1, 'ask cell cimindi', 'jl mahar martahnegara no 10', 77742157),
(2, 'mega cell phone bandung', 'Jl. Abdul Rahman Saleh No.30, Husen', 896534513);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hpsamsung`
--
ALTER TABLE `hpsamsung`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `login_user`
--
ALTER TABLE `login_user`
  ADD PRIMARY KEY (`iduser`);

--
-- Indeks untuk tabel `tb_detail_distribusi`
--
ALTER TABLE `tb_detail_distribusi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_distribusi` (`id_distribusi`);

--
-- Indeks untuk tabel `tb_distribusi`
--
ALTER TABLE `tb_distribusi`
  ADD PRIMARY KEY (`id_distribusi`);

--
-- Indeks untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `tb_toko`
--
ALTER TABLE `tb_toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hpsamsung`
--
ALTER TABLE `hpsamsung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT untuk tabel `login_user`
--
ALTER TABLE `login_user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_detail_distribusi`
--
ALTER TABLE `tb_detail_distribusi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_distribusi`
--
ALTER TABLE `tb_distribusi`
  MODIFY `id_distribusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_toko`
--
ALTER TABLE `tb_toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_detail_distribusi`
--
ALTER TABLE `tb_detail_distribusi`
  ADD CONSTRAINT `tb_detail_distribusi_ibfk_1` FOREIGN KEY (`id_distribusi`) REFERENCES `tb_distribusi` (`id_distribusi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
