-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2021 at 05:46 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `migo`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id_checkout` int(11) NOT NULL,
  `nama_pembeli` varchar(50) NOT NULL,
  `nama_kota` varchar(50) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `kode_pos` int(7) NOT NULL,
  `jenis_pengiriman` enum('Instant','Medium','Premium') NOT NULL,
  `jenis_pembayaran` enum('COD','Gopay','Ovo') NOT NULL,
  `status` enum('pending','accept','reject') NOT NULL,
  `waktu_belanja` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id_checkout`, `nama_pembeli`, `nama_kota`, `alamat`, `kode_pos`, `jenis_pengiriman`, `jenis_pembayaran`, `status`, `waktu_belanja`) VALUES
(23, 'Ipin', 'Bandung', 'alamat palsu', 11111, 'Medium', 'Gopay', 'accept', '2021-05-05 22:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_migo` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `harga` int(200) NOT NULL,
  `gambar` varchar(250) NOT NULL,
  `stock` int(200) NOT NULL,
  `deskripsi` char(200) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_migo`, `nama`, `harga`, `gambar`, `stock`, `deskripsi`, `createdAt`) VALUES
(34, 'Printer HP', 300000, '6093418fed363.jpg', 4, 'Baru banget', '0000-00-00 00:00:00'),
(35, 'Printer epson', 20000000, '609341c7eb6a2.jpg', 10, 'SUMPAH INI BARU', '0000-00-00 00:00:00'),
(39, 'Printer pitri', 300000, '609361d4b173e.jpg', 4, 'fitri', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` enum('penjual','pembeli') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`) VALUES
(19, 'ipin', '$2y$10$ayUvP5lxoaZsUtE4B.PWA.yFjfUbbbXMrGd2xwD3KThoSDus9Clri', 'pembeli'),
(28, 'jean', '$2y$10$egpXwqO9SajrbRcRXI0AWuJUjbrklr9xs/ARYJVbfYu8WR.Isg16O', 'pembeli'),
(32, 'yeji', '$2y$10$/GX4zRp/kE7UYVQXzpgH0euOeOOovHg4f7MHGz18Ei/BqpxNuZaZu', 'penjual');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id_checkout`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_migo`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id_checkout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_migo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
