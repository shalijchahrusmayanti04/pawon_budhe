-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Feb 2023 pada 19.35
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pawon`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kode_kategori` varchar(11) NOT NULL,
  `nama_kategori` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kode_kategori`, `nama_kategori`) VALUES
('KAT0001', 'Makanan'),
('KAT0002', 'Minuman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `kode_menu` varchar(11) NOT NULL,
  `nama_menu` varchar(200) NOT NULL,
  `harga_menu` int(11) NOT NULL,
  `gambar_menu` text NOT NULL,
  `kategori_menu` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`kode_menu`, `nama_menu`, `harga_menu`, `gambar_menu`, `kategori_menu`) VALUES
('MN0001', 'Brongkos Sapi', 20000, 'default.jfif', 'KAT0001'),
('MN0002', 'Brongkos Lidah Kambing', 40000, 'default.jfif', 'KAT0001'),
('MN0003', 'Brongkos Telinga Kambing', 17000, 'default.jfif', 'KAT0001'),
('MN0004', 'Brongkos Mata Kambing', 20000, 'default.jfif', 'KAT0001'),
('MN0005', 'Brongkos Kaki Kambing', 15000, 'default.jfif', 'KAT0001'),
('MN0006', 'Gulai Kambing', 20000, 'default.jfif', 'KAT0001'),
('MN0007', 'Tongseng Kambing', 20000, 'default.jfif', 'KAT0001'),
('MN0008', 'Nasi', 3000, 'default.jfif', 'KAT0001'),
('MN0009', 'Soto Sapi', 10000, 'default.jfif', 'KAT0001'),
('MN0010', 'Rica-rica Enthok', 17000, 'default.jfif', 'KAT0001'),
('MN0011', 'Ayam Goreng', 12000, 'default.jfif', 'KAT0001'),
('MN0012', 'Nila, Lele', 12000, 'default.jfif', 'KAT0001'),
('MN0013', 'Pecel Mie', 10000, 'default.jfif', 'KAT0001'),
('MN0014', 'Telur Asin', 3500, 'default.jfif', 'KAT0001'),
('MN0015', 'Teh', 3000, 'default.jfif', 'KAT0002'),
('MN0016', 'Jeruk', 3000, 'default.jfif', 'KAT0002'),
('MN0017', 'Kopi', 3000, 'default.jfif', 'KAT0002'),
('MN0018', 'Kopi Susu', 5000, 'default.jfif', 'KAT0002'),
('MN0019', 'Susu Putih', 3000, 'default.jfif', 'KAT0002'),
('MN0020', 'Susu Coklat', 3000, 'default.jfif', 'KAT0002'),
('MN0021', 'Susu Jahe', 3000, 'default.jfif', 'KAT0002');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`kode_menu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
