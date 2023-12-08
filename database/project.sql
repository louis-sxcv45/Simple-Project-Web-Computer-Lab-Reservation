-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2023 at 07:40 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int NOT NULL,
  `nama_barang` varchar(40) DEFAULT NULL,
  `kode_barang` varchar(30) DEFAULT NULL,
  `stok_barang` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `kode_barang`, `stok_barang`) VALUES
(1, 'Proyektor', '001', '12');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_barang`
--

CREATE TABLE `peminjaman_barang` (
  `id_peminjaman` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_barang` int DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `tanggal_peminjaman` date DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `nama_barang` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjaman_barang`
--

INSERT INTO `peminjaman_barang` (`id_peminjaman`, `id_user`, `id_barang`, `jumlah`, `tanggal_peminjaman`, `status`, `nama_barang`) VALUES
(2, 1, 1, 2, '2023-12-10', 'Rejected', 'Proyektor'),
(3, 2, 1, 2, '2023-12-21', 'Approved', 'Proyektor'),
(4, 3, 1, 4, '2023-12-22', 'Approved', 'Proyektor');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_ruangan`
--

CREATE TABLE `peminjaman_ruangan` (
  `id_peminjaman` int NOT NULL,
  `id_ruangan` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `tanggal_peminjaman` date DEFAULT NULL,
  `waktu_mulai` date DEFAULT NULL,
  `waktu_selesai` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `nama_ruangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjaman_ruangan`
--

INSERT INTO `peminjaman_ruangan` (`id_peminjaman`, `id_ruangan`, `id_user`, `tanggal_peminjaman`, `waktu_mulai`, `waktu_selesai`, `status`, `nama_ruangan`) VALUES
(1, 1, 1, '2023-12-06', '2023-12-12', '2023-12-13', 'Approved', 'Lab Komputer - 02'),
(2, 6, 1, '2023-12-26', '2023-12-28', '2023-12-29', 'Rejected', 'Lab Komputer - 06'),
(3, 1, 1, '2023-12-15', '2023-12-09', '2023-12-10', 'Rejected', 'Lab Komputer - 01'),
(5, 4, 1, '2023-12-14', '2023-12-21', '2023-12-22', 'Approved', 'Lab Komputer - 04'),
(6, 5, 1, '2023-12-12', '2023-12-19', '2023-12-20', 'Approved', 'Lab Komputer - 05'),
(7, 5, 3, '2023-12-09', '2023-12-10', '2023-12-11', 'Approved', 'Lab Komputer - 05');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `nama_ruangan` varchar(40) DEFAULT NULL,
  `kode_ruangan` varchar(20) DEFAULT NULL,
  `id_ruangan` int NOT NULL,
  `img` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`nama_ruangan`, `kode_ruangan`, `id_ruangan`, `img`) VALUES
('Lab Komputer - 01', '001', 1, 0x2e2e2f696d672f4c61622d312e6a7067),
('Lab Komputer - 02', '002', 2, 0x2e2e2f696d672f7275616e67616e2d6b6f6d70757465722e6a7067),
('Lab Komputer - 03', '003', 3, 0x2e2e2f696d672f6c61622d372e6a7067),
('Lab Komputer - 04', '004', 4, 0x2e2e2f696d672f6c61622d352e6a7067),
('Lab Komputer - 05', '005', 5, 0x2e2e2f696d672f7275616e67616e2d332e6a7067),
('Lab Komputer - 06', '006', 6, 0x2e2e2f696d672f6c61622d362e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `nama_lengkap` varchar(40) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `kelas` varchar(15) DEFAULT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`nama_lengkap`, `email`, `kelas`, `nim`, `no_hp`, `username`, `password`, `id_user`) VALUES
('Louis Laskar Ginting', 'louisginting54@gmail.com', 'MI-3B', '2205102061', '081262462719', 'sxcv_45', '1234', 1),
('Raduola Ginting', 'raduola01@gmail.com', 'MI-2B', '2023941041', '081376543222', 'tch.tzy', '456', 2),
('Ahmad Yudha Aditya', 'ahmadyudha@gmail.com', 'MI-4B', '2206170817', '084719130134', 'ahmad_yudha', '345', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `peminjaman_barang`
--
ALTER TABLE `peminjaman_barang`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_ruangan` (`id_ruangan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `peminjaman_barang`
--
ALTER TABLE `peminjaman_barang`
  MODIFY `id_peminjaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  MODIFY `id_peminjaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman_barang`
--
ALTER TABLE `peminjaman_barang`
  ADD CONSTRAINT `peminjaman_barang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `peminjaman_barang_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  ADD CONSTRAINT `peminjaman_ruangan_ibfk_1` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`),
  ADD CONSTRAINT `peminjaman_ruangan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
