-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jun 2021 pada 19.40
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `malik_exlusive`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `admn_id` int(11) NOT NULL,
  `admn_nama` varchar(200) NOT NULL,
  `admn_alamat` varchar(200) NOT NULL,
  `admn_telepon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`admn_id`, `admn_nama`, `admn_alamat`, `admn_telepon`) VALUES
(1, 'Cigadung', 'Jl Cigadung', '081231313'),
(2, 'Jupiter', 'jupiter', '088132123131');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `perusahaan` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `nama`, `email`, `perusahaan`, `no_hp`, `alamat`, `status`, `tanggal`) VALUES
(1, 'ADIBA BUTIK', '', 'CGD', '', '', '', '2021-04-28 06:52:55'),
(2, 'FASYHA BUTIK', '', 'JUPITER', '', '', '', '2021-04-28 06:53:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(12) DEFAULT NULL,
  `driver` varchar(20) NOT NULL,
  `total_hutang` int(11) DEFAULT NULL,
  `dibayar` int(11) DEFAULT NULL,
  `sisa` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan_bayar`
--

CREATE TABLE `karyawan_bayar` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan_hutang`
--

CREATE TABLE `karyawan_hutang` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kate_id` int(11) NOT NULL,
  `kate_kate_id` int(11) NOT NULL,
  `kate_level` int(11) NOT NULL,
  `kate_nama` varchar(250) DEFAULT NULL,
  `kate_deskripsi` text DEFAULT NULL,
  `kate_status` varchar(50) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kate_id`, `kate_kate_id`, `kate_level`, `kate_nama`, `kate_deskripsi`, `kate_status`, `tanggal`) VALUES
(42, 0, 1, 'Fashion', '-', NULL, '2021-03-22 20:00:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id` int(11) NOT NULL,
  `jenis` varchar(20) DEFAULT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `plat_nomor` varchar(12) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `lev_id` int(11) NOT NULL,
  `lev_nama` varchar(50) DEFAULT NULL,
  `lev_deskripsi` varchar(200) DEFAULT NULL,
  `lev_status` varchar(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`lev_id`, `lev_nama`, `lev_deskripsi`, `lev_status`, `created_date`) VALUES
(1, 'Manager', '-', 'Aktif', '2019-09-22 12:06:31'),
(5, 'Admin', '-', 'Aktif', '2021-01-28 10:01:14'),
(7, 'Keuangan', '-', 'Aktif', '2021-04-16 11:59:28'),
(8, 'Gudang', '-', 'Aktif', '2021-01-28 09:52:33'),
(9, 'Administrator', '-', 'Aktif', '2021-02-25 10:25:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_menu_id` int(11) DEFAULT 0,
  `menu_name` varchar(100) DEFAULT NULL,
  `menu_description` text DEFAULT NULL,
  `menu_index` int(11) DEFAULT NULL,
  `menu_icon` varchar(100) DEFAULT NULL,
  `menu_url` varchar(200) DEFAULT NULL,
  `menu_status` varchar(10) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_menu_id`, `menu_name`, `menu_description`, `menu_index`, `menu_icon`, `menu_url`, `menu_status`, `created_date`) VALUES
(1, 0, 'Dashboard', '-', 1, 'fa fa-dashboard', 'dashboard', 'Aktif', '2019-06-03 22:01:40'),
(20, 0, 'Pembelian', '-', 3, 'fa fa-cart-plus', 'pengadaan/data', 'Aktif', '2021-03-20 12:21:15'),
(25, 20, 'Data Pemesanan', '-', 2, 'fa fa-caret-right', 'pemesanan/data', 'Aktif', '2019-06-11 09:58:24'),
(27, 37, 'Pengguna', '-', 1, 'fa fa-caret-right', 'pengaturan/pengguna', 'Aktif', '2019-06-03 22:36:24'),
(36, 0, 'Penjualan', '#', 4, 'fa fa-cubes', 'penjualan/data', 'Aktif', '2021-03-20 12:30:13'),
(37, 0, 'Pengaturan', '-', 8, 'fa fa-cogs', '#', 'Aktif', '2019-07-14 00:18:16'),
(38, 20, 'Tambah', '-', 1, 'fa fa-caret-right', 'pemesanan/tambah', 'Aktif', '2019-06-11 09:36:55'),
(56, 0, 'Produk', '-', 2, 'fa fa-archive', 'referensi/produk', 'Aktif', '2020-05-24 22:11:13'),
(61, 37, 'Level', '-', 2, 'fa fa-caret-right', 'pengaturan/level', 'Aktif', '2019-06-03 22:49:17'),
(62, 0, 'Referensi', '-', 7, 'fa fa-link', '#', 'Aktif', '2019-07-14 00:18:03'),
(63, 37, 'Menu', '-', 3, 'fa fa-caret-right', 'pengaturan/menu', 'Aktif', '2019-06-03 22:50:05'),
(64, 37, 'Hak Akses', '-', 4, 'fa fa-caret-right', 'pengaturan/hakAkses', 'Aktif', '2019-06-03 22:50:24'),
(67, 62, 'Kategori', '-', 2, 'fa fa-caret-right', 'referensi/kategori', 'Aktif', '2019-09-19 06:49:00'),
(68, 62, 'Sumber Penjualan', '-', 4, 'fa fa-caret-right', 'referensi/sumberPenjualan', 'Aktif', '2019-09-17 15:42:16'),
(69, 0, 'Laporan', '-', 10, 'fa fa-file', '#', 'Aktif', '2021-03-09 22:03:47'),
(70, 69, 'Penjualan', '-', 1, 'fa fa-caret-right', 'laporan/penjualan', 'Aktif', '2019-07-16 11:34:50'),
(71, 36, 'Transaksi', '-', 1, 'fa fa-caret-right', 'penjualan/data', 'Aktif', '2019-09-30 06:08:35'),
(72, 36, 'Tukar Domba', '-', 2, 'fa fa-caret-right', 'penjualan/tukarDomba', 'Aktif', '2019-07-31 07:40:03'),
(73, 36, 'Batal', '-', 3, 'fa fa-caret-right', 'penjualan/batal', 'Aktif', '2019-07-13 23:49:11'),
(74, 0, 'Pengeluaran', '-', 5, 'fa fa-money', 'pengeluaran/data', 'Aktif', '2019-07-14 00:21:54'),
(75, 0, 'Pengiriman', '-', 6, 'fa fa-truck', '#', 'Aktif', '2020-05-16 09:59:10'),
(76, 75, 'Belum', '-', 1, 'fa fa-caret-right', 'pengiriman/belum', 'Aktif', '2020-05-16 09:59:26'),
(77, 75, 'Dikirim', '-', 2, 'fa fa-caret-right', 'pengiriman/dikirim', 'Aktif', '2019-07-14 00:27:25'),
(78, 75, 'Sampai', '-', 3, 'fa fa-caret-right', 'pengiriman/sampai', 'Aktif', '2019-07-14 00:27:57'),
(81, 62, 'Supplier', '-', 3, 'fa fa-caret-right', 'referensi/supplier', 'Aktif', '2019-09-19 06:49:16'),
(82, 69, 'Pembelian', '-', 2, 'fa fa-caret-right', 'laporan/pengadaan', 'Aktif', '2021-03-09 22:02:13'),
(83, 69, 'Pengeluaran', '-', 3, 'fa fa-caret-right', 'laporan/pengeluaran', 'Aktif', '2019-07-16 11:39:16'),
(84, 62, 'Status', '-', 5, 'fa fa-caret-right', 'referensi/status', 'Aktif', '2019-09-19 06:49:27'),
(85, 20, 'Purchase Order', '-', 1, 'fa fa-caret-right', 'pengadaan/data', 'Aktif', '2019-10-18 20:15:49'),
(86, 20, 'History', '-', 2, 'fa fa-caret-right', 'pengadaan/history', 'Aktif', '2019-07-18 08:26:01'),
(87, 20, 'Purchase Order', '-', 1, 'fa fa-caret-right', 'pengadaan/data', 'Aktif', '2019-10-18 20:16:04'),
(89, 36, 'Data Pembayaran', '-', 4, 'fa fa-caret-right', 'penjualan/pembayaran', 'Aktif', '2019-09-30 06:08:56'),
(90, 69, 'Pemasukan', '-', 3, 'fa fa-caret-right', 'laporan/pemasukan', 'Aktif', '2019-07-30 18:21:02'),
(97, 69, 'Marketing - CS', '-', 4, 'fa fa-caret-right', 'laporan/marketingCs', 'Aktif', '2019-07-31 17:06:00'),
(98, 69, 'Marketing - Teller', '-', 5, 'fa fa-caret-right', 'lappran/marketingCs', 'Aktif', '2019-07-31 17:06:56'),
(99, 62, 'Produk', '-', 1, 'fa fa-caret-right', 'referensi/produk', 'Aktif', '2019-09-17 17:36:37'),
(100, 62, 'Rak', '-', 6, 'fa fa-right', 'referensi/rak', 'Aktif', '2019-09-22 12:54:52'),
(101, 62, 'Etalase', '-', 7, 'fa fa-right', 'referensi/etalase', 'Aktif', '2019-09-22 12:55:18'),
(102, 20, 'Transaksi', '-', 2, 'fa fa-caret-right', 'pengadaan/pengiriman', 'Aktif', '2019-10-18 20:16:21'),
(103, 0, 'Bulk Operation', '-', 6, 'fa fa-file', '#', 'Aktif', '2019-10-03 18:06:50'),
(104, 103, 'Produk', '-', 1, 'fa fa-caret-right', 'bulk/produk', 'Aktif', '2019-10-03 18:07:19'),
(105, 103, 'Kategori', '-', 2, 'fa fa-caret-right', 'bulk/kategori', 'Aktif', '2019-10-04 04:56:34'),
(106, 103, 'Supplier', '-', 3, 'fa fa-caret-right', 'bulk/supplier', 'Aktif', '2019-10-04 04:56:51'),
(107, 69, 'Keuangan', '-', 3, 'fa fa-caret-right', 'laporan/keuangan', 'Aktif', '2019-10-17 05:31:53'),
(108, 0, 'Pembelian', '-', 10, 'fa fa-caret-right', '#', 'Aktif', '2021-03-03 12:33:31'),
(109, 108, 'Transaksi', '-', 1, 'fa fa-caret-right', 'pengadaan/pengiriman', 'Aktif', '2019-10-18 20:16:28'),
(110, 20, 'Refund', '-', 5, 'fa fa-caret-right', 'pengadaan/refund', 'Aktif', '2019-10-18 20:16:52'),
(111, 69, 'Kurir', '-', 4, 'fa fa-caret-right', 'laporan/kurir', 'Aktif', '2019-11-11 04:24:50'),
(112, 69, 'Cash Flow', '-', 5, 'fa fa-caret-right', 'laporan/cashFLow', 'Aktif', '2019-11-11 04:25:11'),
(115, 56, 'Obat', '-', 2, 'fa fa-cubes', 'katalog/obat', 'Aktif', '2019-11-22 14:22:17'),
(116, 0, 'cek', '-', 1, 'fa fa-cubes', '#', 'Aktif', '2019-11-23 21:15:01'),
(117, 0, 'rty', '-', 10, 'fa fa-cubes', '#', 'Aktif', '2019-11-23 21:15:26'),
(118, 0, 'Supplier', '-', 6, 'fa fa-caret-right', 'referensi/supplier', 'Aktif', '2021-04-13 04:28:42'),
(119, 0, 'Laporan Penjualan', '-', 8, 'fa fa-caret-right', 'laporan/penjualan/kasir', 'Aktif', '2020-07-15 18:16:24'),
(120, 0, 'Kategori', '-', 9, 'fa fa-crosshairs', 'referensi/kategori', 'Aktif', '2021-03-16 11:03:16'),
(121, 0, 'Karyawan', '-', 7, 'fa fa-user-md', 'karyawan', 'Aktif', '2021-03-03 13:35:42'),
(122, 0, 'Customers', '', 8, 'fa fa-user-plus', 'customers', 'Aktif', '2021-03-16 11:05:12'),
(123, 0, 'Kendaraan', '-', 8, 'fa fa-taxi', 'kendaraan', 'Aktif', '2021-03-20 18:48:02'),
(124, 0, 'Packer', '', 8, 'fa fa-users', 'packer/data', 'Aktif', '2021-03-31 11:35:42'),
(125, 0, 'Toko', '-', 9, 'fa fa-user-md', 'toko/data', 'Aktif', '2021-04-06 14:25:29'),
(126, 69, 'Stok Supplier', '-', 3, 'fa fa-caret-right', 'laporan/stok_supplier', 'Aktif', '2021-04-13 07:54:33'),
(127, 69, 'Packer   ', '-', 4, 'fa fa-caret-right', 'laporan/packer', 'Aktif', '2021-06-01 13:37:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `packer`
--

CREATE TABLE `packer` (
  `pack_id` int(11) NOT NULL,
  `pack_kode` varchar(50) NOT NULL,
  `pack_nama` varchar(50) NOT NULL,
  `pack_email` varchar(50) NOT NULL,
  `pack_telepon` varchar(13) NOT NULL,
  `pack_alamat` text NOT NULL,
  `pack_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `packer`
--

INSERT INTO `packer` (`pack_id`, `pack_kode`, `pack_nama`, `pack_email`, `pack_telepon`, `pack_alamat`, `pack_status`) VALUES
(2, '', 'UMAN', 'indra@gmail.com', '0881321231239', 'Bandung', 0),
(3, '', 'TOHA', 'andri@gmail.com', '0881231231', 'Bandung', 0),
(7, '', 'FIRMAN', 'isep@gmail.com', '1234567890', 'Cianjur', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengadaan`
--

CREATE TABLE `pengadaan` (
  `peng_id` varchar(20) NOT NULL,
  `peng_total_harga` int(11) NOT NULL,
  `peng_dibayar` int(11) NOT NULL,
  `peng_sisa` int(11) DEFAULT NULL,
  `peng_keterangan` text DEFAULT NULL,
  `peng_tanggal` date DEFAULT NULL,
  `peng_cust_id` int(11) NOT NULL,
  `peng_supp_id` int(11) NOT NULL,
  `peng_status` varchar(50) DEFAULT NULL,
  `peng_generate` int(11) NOT NULL COMMENT '1 = sudah | 0 = belum',
  `peng_status_purchasing` varchar(20) NOT NULL,
  `peng_status_manager` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengadaan`
--

INSERT INTO `pengadaan` (`peng_id`, `peng_total_harga`, `peng_dibayar`, `peng_sisa`, `peng_keterangan`, `peng_tanggal`, `peng_cust_id`, `peng_supp_id`, `peng_status`, `peng_generate`, `peng_status_purchasing`, `peng_status_manager`) VALUES
('PMP-2021-00001', 600000, 0, 600000, '', '2021-06-02', 0, 9, 'Selesai', 0, 'terima', 'terima'),
('PMP-2021-00002', 600000, 0, 600000, '', '2021-06-02', 0, 4, 'Selesai', 0, 'terima', 'terima'),
('PMP-2021-00003', 300000, 0, 300000, '', '2021-06-02', 0, 9, 'Selesai', 0, 'terima', 'terima');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengadaan_detail`
--

CREATE TABLE `pengadaan_detail` (
  `pend_id` int(11) NOT NULL,
  `pend_peng_id` varchar(20) DEFAULT NULL,
  `pend_prod_id` int(11) NOT NULL,
  `pend_kate_id` int(11) DEFAULT NULL,
  `pend_kate_id_2` int(11) DEFAULT NULL,
  `pend_kate_id_3` int(11) DEFAULT NULL,
  `pend_jumlah` int(11) DEFAULT NULL,
  `pend_harga` int(11) DEFAULT NULL,
  `pend_total_harga` int(11) DEFAULT NULL,
  `pend_berat` varchar(20) NOT NULL,
  `pend_supp_id` int(11) NOT NULL,
  `pend_kode_produk_alias` varchar(200) NOT NULL,
  `pend_status_pengiriman` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengadaan_detail`
--

INSERT INTO `pengadaan_detail` (`pend_id`, `pend_peng_id`, `pend_prod_id`, `pend_kate_id`, `pend_kate_id_2`, `pend_kate_id_3`, `pend_jumlah`, `pend_harga`, `pend_total_harga`, `pend_berat`, `pend_supp_id`, `pend_kode_produk_alias`, `pend_status_pengiriman`) VALUES
(1, 'PMP-2021-00001', 51, 42, 0, 0, 10, 60000, 600000, '1', 9, '-', 'Selesai'),
(2, 'PMP-2021-00002', 51, 42, 0, 0, 10, 60000, 600000, '1', 4, '-', 'Selesai'),
(3, 'PMP-2021-00003', 51, 42, 0, 0, 5, 60000, 300000, '1', 9, '-', 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `penj_id` varchar(20) NOT NULL,
  `penj_toko_id` int(11) NOT NULL,
  `penj_user_id` int(11) DEFAULT NULL,
  `penj_pack_id` int(11) NOT NULL,
  `penj_nama` varchar(100) DEFAULT NULL,
  `penj_no_hp` varchar(20) DEFAULT NULL,
  `penj_alamat` varchar(250) DEFAULT NULL,
  `penj_total_harga` int(11) DEFAULT NULL,
  `penj_dibayar` int(11) DEFAULT NULL,
  `penj_sisa` int(11) DEFAULT NULL,
  `penj_status` varchar(50) DEFAULT NULL,
  `penj_lokasi` varchar(250) DEFAULT NULL,
  `penj_tanggal` date DEFAULT NULL,
  `penj_driver` varchar(50) NOT NULL,
  `penj_tanggal_pengiriman` date NOT NULL,
  `penj_status_pengiriman` varchar(50) NOT NULL,
  `penj_supe_id` int(11) NOT NULL,
  `penj_keterangan` text DEFAULT NULL,
  `penj_awal` varchar(250) NOT NULL,
  `penj_akhir` varchar(250) NOT NULL,
  `penj_kondisi` varchar(100) NOT NULL,
  `penj_kendaraan` varchar(50) NOT NULL,
  `penj_no_resi` varchar(50) NOT NULL,
  `penj_kurir` varchar(20) NOT NULL,
  `penj_admin` int(11) NOT NULL,
  `penj_berkas` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`penj_id`, `penj_toko_id`, `penj_user_id`, `penj_pack_id`, `penj_nama`, `penj_no_hp`, `penj_alamat`, `penj_total_harga`, `penj_dibayar`, `penj_sisa`, `penj_status`, `penj_lokasi`, `penj_tanggal`, `penj_driver`, `penj_tanggal_pengiriman`, `penj_status_pengiriman`, `penj_supe_id`, `penj_keterangan`, `penj_awal`, `penj_akhir`, `penj_kondisi`, `penj_kendaraan`, `penj_no_resi`, `penj_kurir`, `penj_admin`, `penj_berkas`) VALUES
('PMP-00001', 2, 56, 7, '', '', '', NULL, 700, NULL, 'Lunas', NULL, '2021-06-02', '', '2021-06-02', 'proses', 0, '', '', '', '', '', '', 'COD', 1, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `pede_id` int(11) NOT NULL,
  `pede_penj_id` varchar(20) DEFAULT NULL,
  `pede_kate_id` int(11) NOT NULL,
  `pede_kate_id_2` int(11) DEFAULT NULL,
  `pede_kate_id_3` int(11) DEFAULT NULL,
  `pede_status_pengiriman` varchar(50) NOT NULL,
  `pede_driver` varchar(50) NOT NULL,
  `pede_kendaraan` varchar(50) NOT NULL,
  `pede_tanggal_kirim` datetime NOT NULL,
  `pede_tanggal_retur` datetime DEFAULT NULL,
  `pede_jumlah` int(11) NOT NULL,
  `pede_total_harga` int(11) NOT NULL,
  `pede_prod_id` int(11) DEFAULT NULL,
  `pede_harga` int(11) DEFAULT NULL,
  `pede_keterangan` varchar(250) NOT NULL,
  `pede_supp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`pede_id`, `pede_penj_id`, `pede_kate_id`, `pede_kate_id_2`, `pede_kate_id_3`, `pede_status_pengiriman`, `pede_driver`, `pede_kendaraan`, `pede_tanggal_kirim`, `pede_tanggal_retur`, `pede_jumlah`, `pede_total_harga`, `pede_prod_id`, `pede_harga`, `pede_keterangan`, `pede_supp_id`) VALUES
(1, 'PMP-00001', 42, 0, 0, 'retur', '', '', '2021-06-02 00:36:49', '2021-06-02 00:37:56', 10, 700000, 51, 70000, '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_detail_vendor`
--

CREATE TABLE `penjualan_detail_vendor` (
  `id` int(11) NOT NULL,
  `pede_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_pembayaran`
--

CREATE TABLE `penjualan_pembayaran` (
  `pepe_id` int(11) NOT NULL,
  `pepe_penj_id` varchar(20) DEFAULT NULL,
  `pepe_total_harga` int(11) DEFAULT NULL,
  `pepe_nominal` int(11) DEFAULT NULL,
  `pepe_sisa` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan_pembayaran`
--

INSERT INTO `penjualan_pembayaran` (`pepe_id`, `pepe_penj_id`, `pepe_total_harga`, `pepe_nominal`, `pepe_sisa`, `tanggal`) VALUES
(1, 'PMP-00001', NULL, 700, NULL, '2021-06-02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `prod_id` int(11) NOT NULL,
  `prod_kode` varchar(20) DEFAULT NULL,
  `prod_kate_id` int(11) DEFAULT NULL,
  `prod_kate_id_2` int(11) DEFAULT NULL,
  `prod_kate_id_3` int(11) DEFAULT NULL,
  `prod_nama` varchar(200) DEFAULT NULL,
  `prod_stok` int(11) NOT NULL,
  `prod_harga_beli` double DEFAULT NULL,
  `prod_harga_jual` double DEFAULT NULL,
  `prod_status` varchar(50) DEFAULT '',
  `prod_gambar` varchar(250) NOT NULL,
  `prod_berat` varchar(20) NOT NULL,
  `prod_min_stok` int(11) NOT NULL,
  `prod_max_stok` int(11) NOT NULL,
  `prod_selisih_stok` int(11) NOT NULL,
  `prod_tahun` int(11) NOT NULL,
  `prod_supp_id` int(11) NOT NULL,
  `prod_vendor` varchar(100) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `prod_special` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`prod_id`, `prod_kode`, `prod_kate_id`, `prod_kate_id_2`, `prod_kate_id_3`, `prod_nama`, `prod_stok`, `prod_harga_beli`, `prod_harga_jual`, `prod_status`, `prod_gambar`, `prod_berat`, `prod_min_stok`, `prod_max_stok`, `prod_selisih_stok`, `prod_tahun`, `prod_supp_id`, `prod_vendor`, `tanggal`, `prod_special`) VALUES
(51, 'QMB -A', 42, 0, 0, ' Qilla Mustard Black  size L', 15, 60000, 70000, NULL, '', '1', 0, 0, 15, 0, 0, '', '2021-06-01 17:35:42', 'Pcs'),
(53, 'PD -C', 42, 0, 0, ' Prita Dusty Size XXL', 0, 60000, 70000, 'Tersedia', '', '1', 0, 0, 0, 0, 0, '', '2021-05-30 13:01:08', 'Pcs'),
(63, 'zm-zmyb', 42, 0, 0, 'ZM Zaskia Mecca - Yogya Blush Scarf Kerudung Segi Empat', 0, 45000, 55000, NULL, '', '1', 0, 0, 114, 0, 0, '', '2021-06-01 17:29:43', 'Pcs'),
(64, 'bjm-pdpl-xl', 42, 0, 0, 'Prita Dusty Size  XL', 0, 250000, 250000, NULL, '', '1', 0, 0, 6, 0, 0, '', '2021-06-01 17:29:29', 'Pcs');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_stok`
--

CREATE TABLE `produk_stok` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk_stok`
--

INSERT INTO `produk_stok` (`id`, `id_produk`, `id_supplier`, `jumlah`) VALUES
(8, 51, 9, 15),
(9, 51, 4, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_aplikasi`
--

CREATE TABLE `role_aplikasi` (
  `rola_id` int(11) NOT NULL,
  `rola_menu_id` int(11) DEFAULT NULL,
  `rola_lev_id` int(11) DEFAULT NULL,
  `rola_c` int(11) DEFAULT NULL,
  `rola_r` int(11) DEFAULT NULL,
  `rola_u` int(11) DEFAULT NULL,
  `rola_d` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role_aplikasi`
--

INSERT INTO `role_aplikasi` (`rola_id`, `rola_menu_id`, `rola_lev_id`, `rola_c`, `rola_r`, `rola_u`, `rola_d`, `created_date`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL, '2019-05-23 19:01:07'),
(2, 56, 1, NULL, NULL, NULL, NULL, '2019-05-23 19:10:43'),
(3, 20, 1, NULL, NULL, NULL, NULL, '2019-05-23 19:11:09'),
(15, 27, 1, NULL, NULL, NULL, NULL, '2019-06-11 10:24:53'),
(18, 37, 1, NULL, NULL, NULL, NULL, '2019-06-11 10:35:04'),
(45, 56, 8, NULL, NULL, NULL, NULL, '2019-07-15 13:20:17'),
(54, 69, 1, NULL, NULL, NULL, NULL, '2019-07-16 11:40:12'),
(55, 82, 1, NULL, NULL, NULL, NULL, '2019-07-16 11:40:20'),
(56, 70, 1, NULL, NULL, NULL, NULL, '2019-07-16 11:41:05'),
(61, 71, 1, NULL, NULL, NULL, NULL, '2021-01-28 10:42:21'),
(67, 56, 7, NULL, NULL, NULL, NULL, '2019-07-30 19:48:13'),
(101, 56, 5, NULL, NULL, NULL, NULL, '2019-09-28 11:16:03'),
(102, 20, 8, NULL, NULL, NULL, NULL, '2019-10-01 05:07:45'),
(110, 36, 5, NULL, NULL, NULL, NULL, '2019-10-04 06:40:44'),
(120, 111, 5, NULL, NULL, NULL, NULL, '2019-11-11 04:25:25'),
(121, 112, 5, NULL, NULL, NULL, NULL, '2019-11-11 04:25:33'),
(127, 85, 1, NULL, NULL, NULL, NULL, '2020-07-27 05:15:03'),
(129, 120, 8, NULL, NULL, NULL, NULL, '2021-01-28 10:18:57'),
(130, 1, 7, NULL, NULL, NULL, NULL, '2021-01-28 10:22:08'),
(132, 36, 1, NULL, NULL, NULL, NULL, '2021-01-28 10:41:46'),
(133, 1, 9, NULL, NULL, NULL, NULL, '2021-02-25 10:25:58'),
(134, 56, 9, NULL, NULL, NULL, NULL, '2021-02-25 10:26:05'),
(135, 20, 9, NULL, NULL, NULL, NULL, '2021-02-25 10:26:14'),
(138, 36, 9, NULL, NULL, NULL, NULL, '2021-02-25 10:29:34'),
(141, 120, 9, NULL, NULL, NULL, NULL, '2021-02-25 10:30:19'),
(144, 69, 9, NULL, NULL, NULL, NULL, '2021-03-09 22:01:13'),
(145, 70, 9, NULL, NULL, NULL, NULL, '2021-03-09 22:01:26'),
(146, 82, 9, NULL, NULL, NULL, NULL, '2021-03-09 22:01:46'),
(147, 122, 9, NULL, NULL, NULL, NULL, '2021-03-16 11:04:39'),
(149, 118, 9, NULL, NULL, NULL, NULL, '2021-03-22 20:59:56'),
(150, 36, 8, NULL, NULL, NULL, NULL, '2021-03-22 21:02:57'),
(151, 118, 8, NULL, NULL, NULL, NULL, '2021-03-22 21:03:46'),
(152, 124, 8, NULL, NULL, NULL, NULL, '2021-03-31 11:35:56'),
(154, 126, 9, NULL, NULL, NULL, NULL, '2021-04-13 04:46:03'),
(155, 127, 9, NULL, NULL, NULL, NULL, '2021-04-13 06:02:42'),
(156, 125, 9, NULL, NULL, NULL, NULL, '2021-04-13 07:39:51'),
(157, 124, 9, NULL, NULL, NULL, NULL, '2021-04-19 02:30:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_users`
--

CREATE TABLE `role_users` (
  `rolu_id` int(11) NOT NULL,
  `rolu_user_id` int(11) DEFAULT NULL,
  `rolu_lev_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role_users`
--

INSERT INTO `role_users` (`rolu_id`, `rolu_user_id`, `rolu_lev_id`, `created_at`, `created_date`) VALUES
(52, 55, 1, NULL, '2020-07-10 03:55:07'),
(53, 56, 5, NULL, '2021-01-28 10:01:49'),
(54, 57, 8, NULL, '2021-01-28 10:08:07'),
(55, 58, 7, NULL, '2021-04-16 12:00:17'),
(56, 59, 9, NULL, '2021-02-25 10:27:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `supp_id` int(11) NOT NULL,
  `supp_kode` varchar(20) NOT NULL,
  `supp_nama` varchar(100) DEFAULT NULL,
  `supp_email` varchar(100) NOT NULL,
  `supp_telpon` varchar(50) NOT NULL,
  `supp_no_hp` varchar(20) NOT NULL,
  `supp_alamat` text NOT NULL,
  `supp_status` varchar(20) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`supp_id`, `supp_kode`, `supp_nama`, `supp_email`, `supp_telpon`, `supp_no_hp`, `supp_alamat`, `supp_status`, `tanggal`) VALUES
(3, 'MA', 'Malsi', '', '', '', 'Jalan Mars 2', '', '2021-04-28 09:40:40'),
(4, 'TI', 'Titan', '', '', '', 'jl ujung berung', '', '2021-04-28 09:40:45'),
(8, 'FJ', 'Fajar', '', '', '', 'BDG', '', '2021-04-28 09:40:51'),
(9, 'RD', 'RIDHA-TSK', '', '', '', 'TASIK', '', '2021-06-01 16:12:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id`, `nama`, `nama_lengkap`, `no_hp`, `tanggal`) VALUES
(2, 'Butik Aqila 2', 'Butik Aqila 2', '123456789', '2021-04-01'),
(7, 'Butik Aqila 3', 'Butik Aqila 3', '1234567', '2021-04-19'),
(8, 'Butik Aqila 4', 'Butik Aqila 4', '1234567', '2021-04-19'),
(9, 'Butik Aqila 5', 'Butik Aqila 5', '1234567', '2021-04-19'),
(10, 'Butik Aqila 6', 'Butik Aqila 6', '1234567', '2021-04-19'),
(11, 'Butik Aqila 7', 'Butik Aqila 7', '12567', '2021-04-19'),
(12, 'Butik Aqila 8', 'Butik Aqila 8', '1234567', '2021-04-19'),
(13, 'Butik Aqila 9', 'Butik Aqila 9', '1234567', '2021-04-19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `user_name` varchar(200) DEFAULT NULL,
  `user_phone` varchar(20) DEFAULT NULL,
  `user_address` varchar(250) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_name`, `user_phone`, `user_address`, `created_date`) VALUES
(55, 'manager@gmail.com', 'RfpWGVxXg1hH/.KzBdnuieZd2KKr1wo.PZL/cAiB8WAjt.C3O3VAG', 'Manager', '0882 3321 5566', 'Bandung', '2021-04-16 08:15:43'),
(56, 'admin@gmail.com', 's19D7D6rY/YEv7qzjtpkteFtDf1phVKzfloLcsa.rHRigVcDBd73K', 'Admin', '0887 2255 3322', 'Bandung', '2021-01-28 10:01:49'),
(57, 'gudang@gmail.com', 'blCTUcUBmsLXMPDYMImuDOJf1JECszHVX1WDB1cwaHOjgGMz3H7fW', 'Gudang', '0887 8855 6652', 'Bandung', '2021-02-03 07:35:32'),
(58, 'keuangan@gmail.com', 'uEqVR3SwYW5iLGrng2xGZOrDVh6Q7O0kMpMC2FOz2IjKTLUVXzRSa', 'Keuangan', '082131231', 'bandung\n', '2021-04-16 12:00:17'),
(59, 'administrator@gmail.com', 'RfpWGVxXg1hH/.KzBdnuieZd2KKr1wo.PZL/cAiB8WAjt.C3O3VAG', 'Administrator', '08823131', 'bandung', '2021-02-25 10:27:13');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admn_id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `karyawan_bayar`
--
ALTER TABLE `karyawan_bayar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `karyawan_hutang`
--
ALTER TABLE `karyawan_hutang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kate_id`);

--
-- Indeks untuk tabel `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`lev_id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indeks untuk tabel `packer`
--
ALTER TABLE `packer`
  ADD PRIMARY KEY (`pack_id`);

--
-- Indeks untuk tabel `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD PRIMARY KEY (`peng_id`);

--
-- Indeks untuk tabel `pengadaan_detail`
--
ALTER TABLE `pengadaan_detail`
  ADD PRIMARY KEY (`pend_id`),
  ADD KEY `pend_peng_id` (`pend_peng_id`),
  ADD KEY `pend_prod_id` (`pend_prod_id`),
  ADD KEY `pend_kate_id` (`pend_kate_id`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`penj_id`);

--
-- Indeks untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`pede_id`),
  ADD KEY `pede_penj_id` (`pede_penj_id`),
  ADD KEY `pede_kate_id` (`pede_kate_id`),
  ADD KEY `pede_prod_id` (`pede_prod_id`);

--
-- Indeks untuk tabel `penjualan_detail_vendor`
--
ALTER TABLE `penjualan_detail_vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan_pembayaran`
--
ALTER TABLE `penjualan_pembayaran`
  ADD PRIMARY KEY (`pepe_id`),
  ADD KEY `pepe_penj_id` (`pepe_penj_id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `prod_kate_id` (`prod_kate_id`);

--
-- Indeks untuk tabel `produk_stok`
--
ALTER TABLE `produk_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role_aplikasi`
--
ALTER TABLE `role_aplikasi`
  ADD PRIMARY KEY (`rola_id`),
  ADD KEY `rola_menu_id` (`rola_menu_id`),
  ADD KEY `rola_lev_id` (`rola_lev_id`);

--
-- Indeks untuk tabel `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`rolu_id`),
  ADD KEY `rolu_user_id` (`rolu_user_id`),
  ADD KEY `rolu_lev_id` (`rolu_lev_id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supp_id`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `admn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `karyawan_bayar`
--
ALTER TABLE `karyawan_bayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `karyawan_hutang`
--
ALTER TABLE `karyawan_hutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `lev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT untuk tabel `packer`
--
ALTER TABLE `packer`
  MODIFY `pack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pengadaan_detail`
--
ALTER TABLE `pengadaan_detail`
  MODIFY `pend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `pede_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `penjualan_detail_vendor`
--
ALTER TABLE `penjualan_detail_vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `penjualan_pembayaran`
--
ALTER TABLE `penjualan_pembayaran`
  MODIFY `pepe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `produk_stok`
--
ALTER TABLE `produk_stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `role_aplikasi`
--
ALTER TABLE `role_aplikasi`
  MODIFY `rola_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT untuk tabel `role_users`
--
ALTER TABLE `role_users`
  MODIFY `rolu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pengadaan_detail`
--
ALTER TABLE `pengadaan_detail`
  ADD CONSTRAINT `pengadaan_detail_ibfk_1` FOREIGN KEY (`pend_peng_id`) REFERENCES `pengadaan` (`peng_id`),
  ADD CONSTRAINT `pengadaan_detail_ibfk_2` FOREIGN KEY (`pend_prod_id`) REFERENCES `produk` (`prod_id`),
  ADD CONSTRAINT `pengadaan_detail_ibfk_3` FOREIGN KEY (`pend_kate_id`) REFERENCES `kategori` (`kate_id`);

--
-- Ketidakleluasaan untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD CONSTRAINT `penjualan_detail_ibfk_1` FOREIGN KEY (`pede_penj_id`) REFERENCES `penjualan` (`penj_id`),
  ADD CONSTRAINT `penjualan_detail_ibfk_2` FOREIGN KEY (`pede_kate_id`) REFERENCES `kategori` (`kate_id`),
  ADD CONSTRAINT `penjualan_detail_ibfk_3` FOREIGN KEY (`pede_prod_id`) REFERENCES `produk` (`prod_id`);

--
-- Ketidakleluasaan untuk tabel `penjualan_pembayaran`
--
ALTER TABLE `penjualan_pembayaran`
  ADD CONSTRAINT `penjualan_pembayaran_ibfk_1` FOREIGN KEY (`pepe_penj_id`) REFERENCES `penjualan` (`penj_id`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`prod_kate_id`) REFERENCES `kategori` (`kate_id`);

--
-- Ketidakleluasaan untuk tabel `role_aplikasi`
--
ALTER TABLE `role_aplikasi`
  ADD CONSTRAINT `role_aplikasi_ibfk_1` FOREIGN KEY (`rola_menu_id`) REFERENCES `menu` (`menu_id`),
  ADD CONSTRAINT `role_aplikasi_ibfk_2` FOREIGN KEY (`rola_lev_id`) REFERENCES `level` (`lev_id`);

--
-- Ketidakleluasaan untuk tabel `role_users`
--
ALTER TABLE `role_users`
  ADD CONSTRAINT `role_users_ibfk_1` FOREIGN KEY (`rolu_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `role_users_ibfk_2` FOREIGN KEY (`rolu_lev_id`) REFERENCES `level` (`lev_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
