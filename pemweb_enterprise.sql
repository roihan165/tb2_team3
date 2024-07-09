-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.39 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for penjualan_apotik
CREATE DATABASE IF NOT EXISTS `penjualan_apotik` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `penjualan_apotik`;

-- Dumping structure for table penjualan_apotik.detail_resep
CREATE TABLE IF NOT EXISTS `detail_resep` (
  `id_detailResep` int(11) NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(3) DEFAULT NULL,
  `kode_resep` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_detailResep`) USING BTREE,
  KEY `FK_detailResep_resep` (`kode_resep`) USING BTREE,
  KEY `FK_detailresep_produk` (`kode_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Dumping data for table penjualan_apotik.detail_resep: ~4 rows (approximately)
INSERT INTO `detail_resep` (`id_detailResep`, `kode_produk`, `kode_resep`) VALUES
	(21, '001', '3'),
	(24, '007', '9'),
	(26, '008', '6'),
	(27, '007', '1'),
	(30, '002', '2');

-- Dumping structure for table penjualan_apotik.pelanggan
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table penjualan_apotik.pelanggan: ~0 rows (approximately)

-- Dumping structure for table penjualan_apotik.pembayaran
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT,
  `tipe_bayar` enum('Tunai','Kartu') NOT NULL,
  `kode_resep` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`),
  KEY `FK_pembayaran_resep` (`kode_resep`),
  CONSTRAINT `FK_pembayaran_resep` FOREIGN KEY (`kode_resep`) REFERENCES `resep` (`kode_resep`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Dumping data for table penjualan_apotik.pembayaran: ~4 rows (approximately)
INSERT INTO `pembayaran` (`id_pembayaran`, `tipe_bayar`, `kode_resep`) VALUES
	(20, 'Tunai', '3'),
	(22, 'Kartu', '9'),
	(24, 'Tunai', '6'),
	(25, 'Kartu', '1'),
	(28, 'Tunai', '2');

-- Dumping structure for table penjualan_apotik.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(3) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `harga_jual` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_produk` (`kode_produk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table penjualan_apotik.produk: ~8 rows (approximately)
INSERT INTO `produk` (`id`, `kode_produk`, `nama`, `harga_jual`) VALUES
	(1, '001', 'Paracetamol', 17000),
	(2, '002', 'Caladin', 25000),
	(3, '003', 'Antihistamin', 20000),
	(5, '005', 'Betadine 5ml', 6000),
	(6, '006', 'Betadine 60ml', 41000),
	(7, '007', 'shampoo', 15000),
	(10, '008', 'Naphazoline', 18000);

-- Dumping structure for table penjualan_apotik.produk_stok
CREATE TABLE IF NOT EXISTS `produk_stok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(3) DEFAULT NULL,
  `tipe` enum('IN','OUT') NOT NULL,
  `qty` int(11) NOT NULL,
  `kode_resep` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_produkStok_produk` (`kode_produk`),
  KEY `FK_produk_stok_resep` (`kode_resep`),
  CONSTRAINT `FK_produkStok_produk` FOREIGN KEY (`kode_produk`) REFERENCES `produk` (`kode_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_produk_stok_resep` FOREIGN KEY (`kode_resep`) REFERENCES `resep` (`kode_resep`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

-- Dumping data for table penjualan_apotik.produk_stok: ~11 rows (approximately)
INSERT INTO `produk_stok` (`id`, `kode_produk`, `tipe`, `qty`, `kode_resep`) VALUES
	(6, '001', 'IN', 7, NULL),
	(21, '005', 'IN', 10, NULL),
	(40, '001', 'IN', 5, NULL),
	(41, '001', 'OUT', -4, '3'),
	(43, '007', 'IN', 20, NULL),
	(44, '007', 'OUT', -2, '9'),
	(45, '007', 'IN', 30, NULL),
	(49, '007', 'OUT', -5, '1'),
	(54, '008', 'IN', 10, NULL),
	(58, '002', 'IN', 10, NULL),
	(59, '002', 'OUT', -5, '2');

-- Dumping structure for table penjualan_apotik.resep
CREATE TABLE IF NOT EXISTS `resep` (
  `id_resep` int(11) NOT NULL AUTO_INCREMENT,
  `kode_resep` varchar(15) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `total_tagihan` float NOT NULL,
  `status_terima` enum('0','1') NOT NULL,
  PRIMARY KEY (`id_resep`),
  UNIQUE KEY `kode_resep` (`kode_resep`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table penjualan_apotik.resep: ~4 rows (approximately)
INSERT INTO `resep` (`id_resep`, `kode_resep`, `tanggal`, `total_tagihan`, `status_terima`) VALUES
	(7, '3', '2024-07-03', 68000, '1'),
	(10, '9', '2024-07-03', 30000, '0'),
	(12, '6', '2024-07-03', 0, '0'),
	(13, '1', '2024-07-03', 75000, '1'),
	(16, '2', '2024-07-07', 125000, '0');

-- Dumping structure for table penjualan_apotik.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table penjualan_apotik.user: ~3 rows (approximately)
INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
	(1, 'Andre', 'Andre@umb.ac.id', 'default.jpg', '1234', 2, 1, 123456),
	(3, 'Muhammad Roihan', 'muhammadroihan165@gmail.com', 'default.jpg', '$2y$10$Fp7KKAPWLWsN/KhO.JlNfeiiSoYZhdj45l0mQ6fyw083UQ2ccHrrS', 1, 1, 1716467844),
	(5, 'Totti Irawan', 'tot123@gmail.com', 'default.jpg', '$2y$10$5tL7E3IR9CHpam3BZhSP4eYQM.DXwHwkFr0f/DcVD9eSmWPE7vuB2', 2, 1, 1719301673);

-- Dumping structure for table penjualan_apotik.user_access_menu
CREATE TABLE IF NOT EXISTS `user_access_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table penjualan_apotik.user_access_menu: ~4 rows (approximately)
INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(3, 1, 3),
	(4, 2, 2);

-- Dumping structure for table penjualan_apotik.user_menu
CREATE TABLE IF NOT EXISTS `user_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table penjualan_apotik.user_menu: ~3 rows (approximately)
INSERT INTO `user_menu` (`id`, `menu`) VALUES
	(1, 'ADMIN'),
	(2, 'USER'),
	(3, 'MENU');

-- Dumping structure for table penjualan_apotik.user_role
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table penjualan_apotik.user_role: ~2 rows (approximately)
INSERT INTO `user_role` (`id`, `role`) VALUES
	(1, 'Administrator'),
	(2, 'Member');

-- Dumping structure for table penjualan_apotik.user_sub_menu
CREATE TABLE IF NOT EXISTS `user_sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table penjualan_apotik.user_sub_menu: ~8 rows (approximately)
INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
	(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
	(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
	(3, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
	(4, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
	(5, 3, 'Status Resep Management', 'resep/', 'fas fa-fw fa-folder', 1),
	(6, 3, 'List Produk Management', 'menu/listproduk', 'fas fa-fw fa-folder', 0),
	(7, 3, 'List Produk Management', 'listproduk/', 'fas fa-fw fa-folder', 1),
	(8, 3, 'Produk Stok Management', 'produkstok/', 'fas fa-fw fa-folder', 1),
	(9, 3, 'Pembayaran Management', 'menu/pembayaran', 'fas fa-fw fa-folder-open', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
