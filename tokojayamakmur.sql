-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Waktu pembuatan: 05 Jun 2026 pada 16.58
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
-- Database: `tokojayamakmur`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(5) NOT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
('K01', 'Makanan Ringan'),
('K02', 'Minuman'),
('K03', 'Personal Care'),
('K04', 'Kebutuhan Dapur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` varchar(5) NOT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `id_kategori` varchar(5) DEFAULT NULL,
  `id_supplier` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_barang`, `harga_jual`, `stok`, `id_kategori`, `id_supplier`) VALUES
('P001', 'Chitato Sapi Panggang', 12500, 45, 'K01', 'S01'),
('P002', 'Coca-Cola 390ml', 6000, 60, 'K02', 'S02'),
('P003', 'Lifebuoy Merah 75g', 5000, 1000, 'K03', 'S03'),
('P004', 'Indomie Goreng', 3100, 100, 'K04', 'S01'),
('P005', 'Mie Sedap Goreng', 3000, 150, 'K04', 'S01'),
('P007', 'Kopi White Coffee', 3000, 1800, 'K02', 'S01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(5) NOT NULL,
  `nama_PT` varchar(100) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_PT`, `no_telp`, `alamat`) VALUES
('S01', 'PT Indofood CBP', '021-555123', 'Jakarta'),
('S02', 'PT Coca-Cola Bottling', '021-888456', 'Bekasi'),
('S03', 'PT Unilever Indonesia', '021-777890', 'Tangerang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(10) NOT NULL,
  `tgl_jam` datetime DEFAULT NULL,
  `id_produk` varchar(5) DEFAULT NULL,
  `jumlah_beli` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tgl_jam`, `id_produk`, `jumlah_beli`, `total_bayar`) VALUES
('TR001', '2026-04-08 09:15:00', 'P002', 2, 12000),
('TR26052902', NULL, 'P004', 3, 9300),
('TR6A18DF7C', NULL, 'P004', 4, 12400),
('TR6A18E207', NULL, 'P004', 10, 31000),
('TR6A18E484', NULL, 'P003', 500, 2500000),
('TR6A18E492', NULL, 'P007', 100, 300000),
('TR6A18E53B', NULL, 'P007', 2000, 6000000),
('TR999', '2026-04-08 17:29:07', 'P004', 10, 31000);

--
-- Trigger `transaksi`
--
DELIMITER $$
CREATE TRIGGER `potong_stok` AFTER INSERT ON `transaksi` FOR EACH ROW BEGIN
    UPDATE produk 
    SET stok = stok - NEW.jumlah_beli
    WHERE id_produk = NEW.id_produk;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
