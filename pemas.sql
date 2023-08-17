-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jan 2023 pada 16.37
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dekripsi`
--

CREATE TABLE `dekripsi` (
  `id_dekripsi` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `ukuran_file` float NOT NULL,
  `pesan_pengaduan` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dekripsi`
--

INSERT INTO `dekripsi` (`id_dekripsi`, `nama_file`, `ukuran_file`, `pesan_pengaduan`) VALUES
(19, 'b3.jpg', 647598, 'Percobaan'),
(20, 'organik.jpg', 80843, 'Percobaan Sajaaaa'),
(21, 'b3.jpg', 647796, 'Siapa pun yang melihat gambar ini, tolong ke alamat blabla, saya disekap'),
(22, 'organik.jpg', 80892, 'harga pembuangan sampah kok mahal'),
(23, 'organik.jpg', 80892, 'harga pembuangan sampah kok mahal'),
(40, 'b3.jpg', 647610, 'Saya ada masalah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `enkripsi`
--

CREATE TABLE `enkripsi` (
  `id_enkripsi` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `nama_file_enkripsi` varchar(255) NOT NULL,
  `letak_file_enkripsi` varchar(255) NOT NULL,
  `ukuran_file` float NOT NULL,
  `tanggal_upload` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `enkripsi`
--

INSERT INTO `enkripsi` (`id_enkripsi`, `user`, `nama_file`, `nama_file_enkripsi`, `letak_file_enkripsi`, `ukuran_file`, `tanggal_upload`) VALUES
(16, 'admin', 'b3.jpg', 'enkripsi9609.png', 'file_enkripsi/enkripsi9609.png', 228700, 2147483647),
(17, 'admin', 'organik.jpg', 'enkripsi4856.png', 'file_enkripsi/enkripsi4856.png', 22214, 2147483647),
(18, 'admin', 'b3.jpg', 'enkripsi4452.png', 'file_enkripsi/enkripsi4452.png', 228700, 2147483647),
(19, 'admin', 'organik.jpg', 'enkripsi525.png', 'file_enkripsi/enkripsi525.png', 22214, 2147483647),
(20, 'febri', 'Screenshot 2023-01-05 162001.jpg', 'enkripsi7877.png', 'file_enkripsi/enkripsi7877.png', 56844, 2147483647),
(21, 'febri', 'Screenshot 2023-01-05 162001.jpg', 'enkripsi2603.png', 'file_enkripsi/enkripsi2603.png', 56844, 2147483647),
(22, 'febri', 'Screenshot 2023-01-05 162001.jpg', 'enkripsi8503.png', 'file_enkripsi/enkripsi8503.png', 56844, 2147483647),
(23, 'hafiz', 'b3.jpg', 'enkripsi8568.png', 'file_enkripsi/enkripsi8568.png', 228700, 2147483647);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `username` varchar(15) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `job_title` varchar(50) DEFAULT NULL,
  `join_date` timestamp NULL DEFAULT NULL,
  `last_activity` timestamp NULL DEFAULT NULL,
  `status` enum('1','2') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`username`, `password`, `fullname`, `job_title`, `join_date`, `last_activity`, `status`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'Project Manager', '2017-04-28 08:48:55', '2023-01-05 15:36:22', '1'),
('febri', '12345', 'Febri Maulana', 'Manager', '2023-01-05 13:51:31', '2023-01-05 14:11:42', '2'),
('hafiz', '12345', 'Hafiz asasa', 'Manager', '2023-01-05 15:35:01', '2023-01-05 15:35:32', '2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dekripsi`
--
ALTER TABLE `dekripsi`
  ADD PRIMARY KEY (`id_dekripsi`);

--
-- Indeks untuk tabel `enkripsi`
--
ALTER TABLE `enkripsi`
  ADD PRIMARY KEY (`id_enkripsi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dekripsi`
--
ALTER TABLE `dekripsi`
  MODIFY `id_dekripsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `enkripsi`
--
ALTER TABLE `enkripsi`
  MODIFY `id_enkripsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
