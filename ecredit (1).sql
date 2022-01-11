-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2020 at 03:21 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_kurir`
--

CREATE TABLE `active_kurir` (
  `id_kurir` int(11) NOT NULL,
  `nama_kurir` varchar(255) NOT NULL,
  `waktu` datetime NOT NULL,
  `order_pesanan` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `satuan` varchar(30) NOT NULL,
  `harga_pokok` int(11) NOT NULL,
  `stok` int(11) DEFAULT NULL,
  `kategori` varchar(100) NOT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `foto_barang` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `qr_code` varchar(50) NOT NULL,
  `key_barang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_id` int(11) NOT NULL,
  `pengirim` int(11) NOT NULL,
  `penerima` int(11) NOT NULL,
  `message` mediumtext NOT NULL,
  `timestamp` datetime NOT NULL,
  `read_status` enum('Sudah','Belum') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_tambahan`
--

CREATE TABLE `detail_tambahan` (
  `nis` int(11) DEFAULT NULL,
  `saldo_tambahan` varchar(11) DEFAULT NULL,
  `waktu` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ip_captcha`
--

CREATE TABLE `ip_captcha` (
  `address` char(16) COLLATE utf8_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `kantin`
--

CREATE TABLE `kantin` (
  `id_kantin` int(11) NOT NULL,
  `kode_kantin` varchar(100) NOT NULL,
  `nama_kantin` varchar(255) NOT NULL,
  `no_hp_kantin` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pengurus_kantin` varchar(255) NOT NULL,
  `foto_kantin` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `id_kurir` int(11) NOT NULL,
  `nis_kurir` int(11) NOT NULL,
  `nama_kurir` varchar(255) NOT NULL,
  `no_hp_kurir` varchar(20) NOT NULL,
  `email_kurir` varchar(255) NOT NULL,
  `foto_kurir` varchar(255) NOT NULL,
  `id_qrcode` varchar(255) NOT NULL,
  `tanggal_pembuatan` datetime NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `like_produk`
--

CREATE TABLE `like_produk` (
  `id_like` int(11) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nis` varchar(100) NOT NULL,
  `jum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like_produk`
--

INSERT INTO `like_produk` (`id_like`, `kode_barang`, `nis`, `jum`) VALUES
(3, 'BRG0031', '5106', 1),
(4, 'BRG0029', '5106', 1),
(5, 'BRG0001', '5106', 1),
(6, 'BRG0032', '5106', 1);

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `nama_situs` varchar(100) NOT NULL,
  `maintenance` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`nama_situs`, `maintenance`) VALUES
('Kantin', 'false'),
('Siswa', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `order_pesanan`
--

CREATE TABLE `order_pesanan` (
  `id_order` int(11) NOT NULL,
  `invoice_order` varchar(255) NOT NULL,
  `nama_pembeli` varchar(255) NOT NULL,
  `nama_kurir` varchar(255) NOT NULL,
  `pesanan` text NOT NULL,
  `kantin` varchar(255) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `tujuan` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `note` mediumtext NOT NULL,
  `metode_pembayaran` varchar(100) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penarikan_saldo`
--

CREATE TABLE `penarikan_saldo` (
  `id_penarikan` int(11) NOT NULL,
  `kode_penarikan` varchar(255) NOT NULL,
  `jumlah_penarikan` int(10) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `kode_penjualan` varchar(20) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `qty` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_header`
--

CREATE TABLE `penjualan_header` (
  `id_penjualan` int(11) NOT NULL,
  `kode_penjualan` varchar(20) DEFAULT NULL,
  `nis` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `key_barang` varchar(100) NOT NULL,
  `tgl_penjualan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(10) NOT NULL,
  `kode_pesan` varchar(15) NOT NULL,
  `pengirim` varchar(100) NOT NULL,
  `to_nis` varchar(100) NOT NULL,
  `tanggal` datetime NOT NULL,
  `subjek_pesan` varchar(255) NOT NULL,
  `isi_pesan` text NOT NULL,
  `baca` enum('belum','sudah') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rekomendasi`
--

CREATE TABLE `rekomendasi` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(20) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `kode_rekom` varchar(100) NOT NULL,
  `tgl_awal_rekom` date NOT NULL,
  `tgl_akhir_rekom` date NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tabungan`
--

CREATE TABLE `tabungan` (
  `id_tabungan` int(11) NOT NULL,
  `nis` int(11) DEFAULT NULL,
  `saldo` int(10) DEFAULT NULL,
  `pengeluaran` int(10) DEFAULT '0',
  `waktu` varchar(50) DEFAULT NULL,
  `saldo_tambahan` int(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tabungan_kantin`
--

CREATE TABLE `tabungan_kantin` (
  `id_tabungan_kantin` int(11) NOT NULL,
  `kode_kantin` varchar(100) NOT NULL,
  `total_saldo` int(10) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tabungan_kurir`
--

CREATE TABLE `tabungan_kurir` (
  `id_tabungan_kurir` int(11) NOT NULL,
  `nis_kurir` int(11) NOT NULL,
  `total_saldo` int(11) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_siswa` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `jurusan` varchar(64) NOT NULL,
  `tanggal_pembuatan` varchar(50) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `detail_tambahan`
--
ALTER TABLE `detail_tambahan`
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `kantin`
--
ALTER TABLE `kantin`
  ADD PRIMARY KEY (`id_kantin`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indexes for table `like_produk`
--
ALTER TABLE `like_produk`
  ADD PRIMARY KEY (`id_like`);

--
-- Indexes for table `order_pesanan`
--
ALTER TABLE `order_pesanan`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `penarikan_saldo`
--
ALTER TABLE `penarikan_saldo`
  ADD PRIMARY KEY (`id_penarikan`);

--
-- Indexes for table `penjualan_header`
--
ALTER TABLE `penjualan_header`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD PRIMARY KEY (`id_tabungan`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `tabungan_kantin`
--
ALTER TABLE `tabungan_kantin`
  ADD PRIMARY KEY (`id_tabungan_kantin`);

--
-- Indexes for table `tabungan_kurir`
--
ALTER TABLE `tabungan_kurir`
  ADD PRIMARY KEY (`id_tabungan_kurir`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_siswa`,`nis`),
  ADD KEY `nis` (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kantin`
--
ALTER TABLE `kantin`
  MODIFY `id_kantin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `like_produk`
--
ALTER TABLE `like_produk`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_pesanan`
--
ALTER TABLE `order_pesanan`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `penarikan_saldo`
--
ALTER TABLE `penarikan_saldo`
  MODIFY `id_penarikan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan_header`
--
ALTER TABLE `penjualan_header`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tabungan`
--
ALTER TABLE `tabungan`
  MODIFY `id_tabungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tabungan_kantin`
--
ALTER TABLE `tabungan_kantin`
  MODIFY `id_tabungan_kantin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tabungan_kurir`
--
ALTER TABLE `tabungan_kurir`
  MODIFY `id_tabungan_kurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
