-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 08, 2026 at 03:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BRG001', 'Beras Sania 5Kg', 65000, 50, 2),
(2, 'BRG002', 'Gula Gulaku 1Kg', 15000, 100, 2),
(3, 'BRG003', 'Minyak Goreng Bimoli 2L', 35000, 40, 3),
(4, 'BRG004', 'Tepung Segitiga Biru 1Kg', 12000, 60, 4),
(5, 'BRG005', 'Indomie Goreng (Dus)', 110000, 20, 5),
(6, 'BRG006', 'Kopi Kapal Api 165gr', 13500, 80, 6),
(7, 'BRG007', 'Teh Sosro Celup', 8000, 150, 7),
(8, 'BRG008', 'Kecap Bango 520ml', 22000, 45, 8),
(9, 'BRG009', 'Susu Indomilk 1L', 17000, 30, 9),
(10, 'BRG010', 'Sabun Lifebuoy Cair', 25000, 70, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('PLG001', 'Budi Santoso', 'L', '08111111111', 'Jl. Merdeka No 1, Bangkalan'),
('PLG002', 'Siti Aminah', 'P', '08222222222', 'Jl. Pahlawan No 2, Surabaya'),
('PLG003', 'Andi Hermawan', 'L', '08333333333', 'Jl. Sudirman No 3, Sidoarjo'),
('PLG004', 'Rina Wati', 'P', '08444444444', 'Jl. Diponegoro No 4, Gresik'),
('PLG005', 'Doni Pratama', 'L', '08555555555', 'Jl. Kartini No 5, Malang'),
('PLG006', 'Maya Sari', 'P', '08666666666', 'Jl. Ahmad Yani No 6, Surabaya'),
('PLG007', 'Eko Saputro', 'L', '08777777777', 'Jl. Veteran No 7, Bangkalan'),
('PLG008', 'Lina Marlina', 'P', '08888888888', 'Jl. Gajah Mada No 8, Mojokerto'),
('PLG009', 'Fajar Sidik', 'L', '08999999999', 'Jl. Hayam Wuruk No 9, Pasuruan'),
('PLG010', 'Dewi Lestari', 'P', '08101010101', 'Jl. Pattimura No 10, Surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') NOT NULL,
  `transaksi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2026-11-01 10:00:00', 130000, 'TUNAI', 1),
(2, '2026-11-01 11:30:00', 30000, 'TRANSFER', 2),
(3, '2026-11-02 09:15:00', 70000, 'EDC', 3),
(4, '2026-11-02 14:20:00', 24000, 'TUNAI', 4),
(5, '2026-11-03 08:45:00', 110000, 'TRANSFER', 5),
(6, '2026-11-03 16:10:00', 27000, 'TUNAI', 6),
(7, '2026-11-04 12:05:00', 16000, 'EDC', 7),
(8, '2026-11-04 15:50:00', 44000, 'TUNAI', 8),
(9, '2026-11-05 10:25:00', 34000, 'TRANSFER', 9),
(10, '2026-11-05 13:40:00', 50000, 'EDC', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(2, 'PT. SUKA MAJU', '08345617', 'SURABAYA'),
(3, 'PT. MAJU TERUS', '08123458', 'BANGKALAN'),
(4, 'PT. AYAM JAGOO', '081273879', 'JAKARTA'),
(5, 'PT. NASI PUTIH', '0891738024', 'LAMONGAN'),
(6, 'PT. SAYUR ANTI LAYU', '08178356', 'JOMBANG'),
(7, 'PT. SINJAY MANTAP', '08314378', 'BANGKALAN'),
(8, 'PT. TELUR OK BOSS', '08154265782', 'MALANG'),
(9, 'PT. SUSU MURNI BALI', '08134658', 'BALI'),
(10, 'PT. TAHU JOSS', '08145277', 'PASURUAN'),
(11, 'PT. BAKSO MANG UCUP', '08123480', 'BANDUNG');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text NOT NULL,
  `total` int(11) NOT NULL,
  `pelanggan_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2026-11-01', 'Pembelian Sembako Budi', 363000, 'PLG001'),
(2, '2026-11-01', 'Pembelian Gula Siti', 30000, 'PLG002'),
(3, '2026-11-02', 'Belanja Bulanan Andi', 70000, 'PLG003'),
(4, '2026-11-02', 'Belanja Rina', 24000, 'PLG004'),
(5, '2026-11-03', 'Restok Warung Doni', 110000, 'PLG005'),
(6, '2026-11-03', 'Belanja Harian Maya', 27000, 'PLG006'),
(7, '2026-11-04', 'Pesenan Eko', 16000, 'PLG007'),
(8, '2026-11-04', 'Belanja Bumbu Lina', 44000, 'PLG008'),
(9, '2026-11-05', 'Pembelian Susu Fajar', 34000, 'PLG009'),
(10, '2026-11-05', 'Keperluan Mandi Dewi', 50000, 'PLG010');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 65000, 2),
(1, 7, 8000, 1),
(1, 10, 25000, 9),
(2, 2, 15000, 2),
(3, 3, 35000, 2),
(4, 4, 12000, 2),
(5, 5, 110000, 1),
(6, 6, 13500, 2),
(7, 7, 8000, 2),
(8, 8, 22000, 2),
(9, 9, 17000, 2),
(10, 10, 25000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(4) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin1', '21232f297a57a5a743894a0e4a801fc3', 'Admin Toko', 'Jl. Admin Raya 1', '08120000001', 1),
(2, 'kasir1', 'e10adc3949ba59abbe56e057f20f883e', 'Kasir Satu', 'Jl. Kasir Indah 1', '08120000002', 2),
(3, 'kasir2', 'e10adc3949ba59abbe56e057f20f883e', 'Kasir Dua', 'Jl. Kasir Indah 2', '08120000003', 2),
(4, 'gudang1', 'e10adc3949ba59abbe56e057f20f883e', 'Staff Gudang Satu', 'Jl. Gudang Baru 1', '08120000004', 3),
(5, 'gudang2', 'e10adc3949ba59abbe56e057f20f883e', 'Staff Gudang Dua', 'Jl. Gudang Baru 2', '08120000005', 3),
(6, 'manajer1', '21232f297a57a5a743894a0e4a801fc3', 'Manajer Toko', 'Jl. Manajer Sentosa', '08120000006', 1),
(7, 'kasir3', 'e10adc3949ba59abbe56e057f20f883e', 'Kasir Tiga', 'Jl. Kasir Indah 3', '08120000007', 2),
(8, 'kasir4', 'e10adc3949ba59abbe56e057f20f883e', 'Kasir Empat', 'Jl. Kasir Indah 4', '08120000008', 2),
(9, 'gudang3', 'e10adc3949ba59abbe56e057f20f883e', 'Staff Gudang Tiga', 'Jl. Gudang Baru 3', '08120000009', 3),
(10, 'admin2', '21232f297a57a5a743894a0e4a801fc3', 'Admin Toko Dua', 'Jl. Admin Raya 2', '08120000010', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`transaksi_id`,`barang_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
