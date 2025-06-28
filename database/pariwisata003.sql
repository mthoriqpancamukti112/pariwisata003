-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2025 at 03:55 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pariwisata003`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeris`
--

CREATE TABLE `galeris` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kapasitas_mejas`
--

CREATE TABLE `kapasitas_mejas` (
  `id` bigint UNSIGNED NOT NULL,
  `kuliner_id` bigint UNSIGNED NOT NULL,
  `nama_meja` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('Tersedia','Full') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kapasitas_mejas`
--

INSERT INTO `kapasitas_mejas` (`id`, `kuliner_id`, `nama_meja`, `jumlah`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '1A', '10', NULL, 'Full', '2024-06-18 00:21:43', '2024-10-22 15:26:09'),
(2, 1, '2A', '5', NULL, 'Full', '2024-06-18 00:21:56', '2024-06-20 04:36:25'),
(3, 1, '3A', '20', NULL, 'Tersedia', '2024-06-18 00:22:09', '2024-06-18 00:22:09'),
(4, 2, '1A', '15', NULL, 'Tersedia', '2024-06-18 00:22:21', '2024-06-18 00:22:21'),
(5, 2, '2A', '18', NULL, 'Tersedia', '2024-06-18 00:22:32', '2024-06-18 00:22:32'),
(6, 2, '3A', '12', NULL, 'Tersedia', '2024-06-18 00:22:44', '2024-06-18 00:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Restoran', '2024-06-17 23:28:21', '2024-06-17 23:28:21'),
(2, 'Warung Makan', '2024-06-17 23:35:51', '2024-06-17 23:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `kontaks`
--

CREATE TABLE `kontaks` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perihal` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kuliners`
--

CREATE TABLE `kuliners` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_kuliner` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kategori` bigint UNSIGNED NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_operasional` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fasilitas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `galeri` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_upload` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kuliners`
--

INSERT INTO `kuliners` (`id`, `image`, `tempat_kuliner`, `id_kategori`, `deskripsi`, `lokasi`, `jam_operasional`, `fasilitas`, `kontak`, `galeri`, `tgl_upload`, `created_at`, `updated_at`) VALUES
(1, '20240618073406.jpg', 'Pondok Galih Signature', 1, 'Bebek Pondok Galih merupakan restoran keluarga yang menyajikan menu utama berupa olahan bebek dengan cita rasa rempah khas nusantara yang dijamin lezat. Kami hadir dengan mengusung konsep taman yang sejuk dan nyaman. Kebersihan dan Kualitas Masakan adalah dua hal utama yang selalu menjadi perhatian kami demi kepuasan pelanggan.', 'Jempong Baru, Kec. Sekarbela, Kota Mataram, Nusa Tenggara Barat 83116', 'Setiap hari pukul 10.00 - 22.00', 'Mushola, Sejuk, Hidangan Lezat, Parkiran Luar, Pembayaran Mudah', '0812212121333', '[\"20240618073406_20240329064523_2023-01-22.jpg\",\"20240618073406_20240329064523_2023-02-05.jpg\",\"20240618073406_20240329064523_2023-03-01 (1).jpg\",\"20240618073406_20240329064523_2023-03-03 (1).jpg\",\"20240618073406_20240329064523_2023-03-03.jpg\",\"20240618073406_20240329064523_2023-03-03-4.jpg\",\"20240618073406_20240329064523_2023-03-09.jpg\",\"20240618073406_20240329064523_2024-03-22.jpg\",\"20240618073406_20240329064523_20240103_202334.jpg\",\"20240618073406_20240331230749_2024-01-11.jpg\"]', '2024-06-18', '2024-06-17 23:34:06', '2024-06-17 23:34:06'),
(2, '20240618074550.jpg', 'Warung Jamaq Jamaq', 2, 'Warung jamaq jamaq yang berada di depan kantor BMKG, menawarkan berbagai macam menu khas Lombok.', 'Jl. Adi Sucipto No.8-10 Rembiga, Kec. Selaparang, Kota Mataram, Nusa Tenggara Barat 83123', 'Setiap hari pukul 10.00 - 22.00', 'Parkiran Luar, Makanan Lezat, Toilet', '087864272177', '[\"20240618074550_20240329054217_2021-07-12.jpg\",\"20240618074550_20240329054217_2023-04-26.jpg\",\"20240618074550_20240329054217_2023-05-13.jpg\",\"20240618074550_20240329054217_2023-08-18 (1).jpg\",\"20240618074550_20240329054217_2024-01-05.jpg\"]', '2024-06-18', '2024-06-17 23:45:50', '2024-06-17 23:45:50'),
(3, '20240618075212.jpg', 'Omah Cobek Resto', 1, 'Omah dalam bahasa jawa berarti rumah, sementara cobek merupakan alat untuk menghaluskan bumbu dan seringnya digunakan untuk membuat sambal, sehingga yang dimaksud dengan “OMAH COBEK”adalah rumahnya cobek yang berarti banyak tersedia sambal-sambal. Berdasarkan nama tersebut, OMAH COBEK merupakan restaurant dengan kekhasan aneka macam sambal yang menggugah selera. Akhirnya dengan tekad dan keberanian serta memohon pertolongan TUHAN YME kami membuka outlet kami yang pertama di Jl.Maktal 6 Mataram pada tanggal 11 Januari 2009.', 'Jl. Terusan Bung Hatta, Monjok, Kec. Selaparang, Kota Mataram, Nusa Tenggara Bar.', 'Setiap hari pukul 10.00 - 22.00', 'Pengiriman, Bawa Pulang, Reservasi, Tempat Duduk di Area Terbuka, Prasmanan, Tempat Duduk, Tersedia Tempat Parkir, Parkir Pinggir Jalan, Parkir Tervalidasi, Parkir Pinggir Jalan Gratis, Televisi, Tersedia Kursi Tinggi, Akses Kursi Roda, Menerima Mastercard, Menerima Visa, Pembayaran Digital, Hanya Tunai, Wi-Fi Gratis, Pelayanan di Meja', '087878921000', '[\"20240618075212_20240331230749_2024-01-14.jpg\",\"20240618075212_20240331230749_2024-02-01 (1).jpg\",\"20240618075212_20240331230749_2024-02-10.jpg\",\"20240618075212_20240331230749_2024-03-19.jpg\",\"20240618075212_20240331230749_2024-03-21 (1).jpg\",\"20240618075212_20240331230749_2024-03-21.jpg\",\"20240618075212_20240331230749_2024-03-26 (1).jpg\",\"20240618075212_20240331230749_2024-03-26.jpg\",\"20240618075212_20240331230958_2024-02-10.jpg\"]', '2024-06-18', '2024-06-17 23:52:12', '2024-06-17 23:52:12');

-- --------------------------------------------------------

--
-- Table structure for table `makanans`
--

CREATE TABLE `makanans` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kuliner_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `makanans`
--

INSERT INTO `makanans` (`id`, `image`, `kuliner_id`, `nama`, `created_at`, `updated_at`) VALUES
(1, '20240618081437.jpg', 1, 'Bebek Goreng', '2024-06-18 00:14:37', '2024-06-18 00:14:37'),
(2, '20240618081453.jpg', 1, 'Bebek Bakar', '2024-06-18 00:14:53', '2024-06-18 00:14:53'),
(3, '20240618081509.jpg', 1, 'Ikan Nila Goreng', '2024-06-18 00:15:09', '2024-06-18 00:15:09'),
(4, '20240618081535.jpg', 1, 'Ayam Goreng', '2024-06-18 00:15:35', '2024-06-18 00:15:35'),
(5, '20240618081651.jpg', 1, 'Ayam Lalapan', '2024-06-18 00:16:51', '2024-06-18 00:16:51'),
(6, '20240618081714.jpg', 1, 'Sayur Bening', '2024-06-18 00:17:14', '2024-06-18 00:17:14'),
(7, '20240618081751.jpg', 2, 'Nasi Goreng', '2024-06-18 00:17:51', '2024-06-18 00:17:51'),
(8, '20240618081805.jpg', 2, 'Mie Goreng', '2024-06-18 00:18:05', '2024-06-18 00:18:05'),
(9, '20240618081825.jpg', 2, 'Es Segar', '2024-06-18 00:18:25', '2024-06-18 00:18:25'),
(10, '20240618081843.jpg', 2, 'Piscok', '2024-06-18 00:18:43', '2024-06-18 00:18:43'),
(11, '20240618081903.jpg', 2, 'Pelecing', '2024-06-18 00:19:03', '2024-06-18 00:19:03'),
(12, '20240618081918.jpg', 2, 'Pecel', '2024-06-18 00:19:18', '2024-06-18 00:19:18'),
(13, '20240618081950.jpg', 2, 'Mie Ayam', '2024-06-18 00:19:50', '2024-06-18 00:19:50'),
(14, '20240618082015.jpg', 3, 'Ayam Bakar', '2024-06-18 00:20:15', '2024-06-18 00:20:15'),
(15, '20240618082034.jpg', 3, 'Urap Timun', '2024-06-18 00:20:34', '2024-06-18 00:20:34'),
(16, '20240618082052.jpg', 3, 'Teri', '2024-06-18 00:20:52', '2024-06-18 00:20:52'),
(17, '20240618082119.jpg', 3, 'Ikan Nila Bakar', '2024-06-18 00:21:19', '2024-06-18 00:21:19');

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayarans`
--

CREATE TABLE `metode_pembayarans` (
  `id` bigint UNSIGNED NOT NULL,
  `kuliner_id` bigint UNSIGNED NOT NULL,
  `nama_metode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metode_pembayarans`
--

INSERT INTO `metode_pembayarans` (`id`, `kuliner_id`, `nama_metode`, `nomor`, `nama`, `biaya`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rekening Bank BNI', '0587765382', 'Ahmad Jaelani', '50000.00', '2024-06-18 00:26:43', '2024-06-18 00:26:43'),
(2, 2, 'Rekening Bank Mandiri', '1113309274259', 'Mukti Hanan Hakiki', '50000.00', '2024-06-18 00:28:20', '2024-06-18 00:28:20'),
(3, 3, 'Rekening Bank BRI', '422765234864190', 'Maulana Malik', '50000.00', '2024-06-18 00:30:15', '2024-06-18 00:30:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_03_19_160809_create_galeris_table', 1),
(5, '2024_03_21_214603_create_kategoris_table', 1),
(6, '2024_03_26_044517_create_kontaks_table', 1),
(7, '2024_03_29_035630_create_kuliners_table', 1),
(8, '2024_03_29_084524_create_makanans_table', 1),
(9, '2024_04_03_031436_create_slider_table', 1),
(10, '2024_04_18_182535_create_users_table', 2),
(11, '2024_04_24_075501_create_metode_pembayarans_table', 2),
(12, '2024_05_02_135309_create_kapasitas_mejas_table', 3),
(13, '2024_06_18_065844_create_ratings_table', 3),
(14, '2024_06_18_070553_create_reservasis_table', 4),
(15, '2024_06_18_070758_create_pembayaran_table', 4),
(16, '2024_06_18_070922_create_ulasans_table', 4),
(17, '2024_06_23_125718_add_google2fa_secret_to_users_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` bigint UNSIGNED NOT NULL,
  `reservasi_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama_pengirim` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `reservasi_id`, `user_id`, `nama_pengirim`, `foto_bukti_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'M Thoriq Panca Mukti', '1718885839.jpg', '2024-06-20 04:17:19', '2024-06-20 04:17:19');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `makanan_id` bigint UNSIGNED NOT NULL,
  `kuliner_id` bigint UNSIGNED NOT NULL,
  `rating` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `makanan_id`, `kuliner_id`, `rating`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, 5, '2024-06-18 00:40:40', '2024-06-18 00:40:40');

-- --------------------------------------------------------

--
-- Table structure for table `reservasis`
--

CREATE TABLE `reservasis` (
  `id` bigint UNSIGNED NOT NULL,
  `id_tempat` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `id_meja` bigint UNSIGNED NOT NULL,
  `id_metode_pembayaran` bigint UNSIGNED NOT NULL,
  `nama_pengunjung` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `jumlah_orang` int NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservasis`
--

INSERT INTO `reservasis` (`id`, `id_tempat`, `user_id`, `id_meja`, `id_metode_pembayaran`, `nama_pengunjung`, `no_hp`, `email`, `tgl_pesan`, `jumlah_orang`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 2, 1, 'M Thoriq Panca Muti', '081233799312', 'thor@gmail.com', '2024-06-20 20:05:00', 4, 'Lunas', '2024-06-20 04:06:03', '2024-06-20 04:25:20'),
(2, 1, 4, 1, 1, 'thor', '081233799312', 'thor@gmail.com', '2024-10-23 07:25:00', 2, 'Dipending', '2024-10-22 15:26:09', '2024-10-22 15:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, '20240618084241.jpg', '2024-06-18 00:42:41', '2024-06-18 00:42:41'),
(2, '20240618084249.jpg', '2024-06-18 00:42:49', '2024-06-18 00:42:49'),
(3, '20240618084259.jpg', '2024-06-18 00:42:59', '2024-06-18 00:42:59');

-- --------------------------------------------------------

--
-- Table structure for table `ulasans`
--

CREATE TABLE `ulasans` (
  `id` bigint UNSIGNED NOT NULL,
  `reservasi_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `id_tempat` bigint UNSIGNED NOT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL,
  `tgl_ulasan` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ulasans`
--

INSERT INTO `ulasans` (`id`, `reservasi_id`, `user_id`, `id_tempat`, `komentar`, `rating`, `tgl_ulasan`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, 'Tempat nya nyaman dan fasilitasnya lumayan lengkap..', 5, '2024-06-20', '2024-06-20 04:26:36', '2024-06-20 04:26:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google2fa_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hak_akses` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `image`, `name`, `no_hp`, `alamat`, `jenis_kelamin`, `email`, `password`, `google2fa_secret`, `hak_akses`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Lalu Admin Ye', '089876665434', 'Mataram', 'Laki-laki', 'admin@gmail.com', '$2y$10$SwFAQ1kGYTx4TL4i3hYZ7.kphjp0FfEvWFZV4a6S/O1ipJqlzRetS', 'TSIKISR5RW5B5IMX', 'Admin', NULL, '2024-06-17 23:11:40', '2024-06-23 05:09:41'),
(2, NULL, 'M Thoriq Panca Mukti', '081233799312', 'Mataram', 'Laki-laki', 'thoriq@gmail.com', '$2y$10$ipNthJL2QoyJYEO8r8Wo1uVEHFGRlDAUpi5ui8mGoHQT6IycJ/mqy', '', 'User', NULL, '2024-06-17 23:11:40', '2024-06-30 20:32:59'),
(3, NULL, 'Ahyar Hadi', '089876564443', 'Jln. Lestari Gg. Mawar Lingkungan Penan', 'Laki-laki', 'ahyarhadi70@gmail.com', '$2y$10$ePnTm6e9nnFPin8kdumkW.3veHBdYAP0HMFvBpxIgz7ZV7dBFgQBm', NULL, 'Pengunjung', NULL, '2024-06-18 00:32:42', '2024-06-18 00:32:42'),
(4, '20241028102503.jpg', 'M Thoriq Panca Mukti', '081233799312', 'Penan', 'Laki-laki', 'thor@gmail.com', '$2y$10$f.yYnhKR4ocFm9uKtaeJXO6chLq4YtJAzsR/bbQhSPiEiaYgUvsEC', '', 'Pengunjung', NULL, '2024-06-20 02:10:19', '2024-10-28 02:25:03'),
(5, '20240701060927.jpeg', 'Contoh Admin', '089876564443', 'mataram', 'Laki-laki', 'contohadmin@gmail.com', '$2y$10$k.obY9Qi6IOlVH3LT/ZmxuFDfgxaKCRCt9ghkbQ9NYzb8rDRyHPFi', NULL, 'Admin', NULL, '2024-06-30 22:09:27', '2024-06-30 22:09:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galeris`
--
ALTER TABLE `galeris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapasitas_mejas`
--
ALTER TABLE `kapasitas_mejas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kapasitas_mejas_kuliner_id_foreign` (`kuliner_id`),
  ADD KEY `kapasitas_mejas_user_id_foreign` (`user_id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontaks`
--
ALTER TABLE `kontaks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kuliners`
--
ALTER TABLE `kuliners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kuliners_id_kategori_foreign` (`id_kategori`);

--
-- Indexes for table `makanans`
--
ALTER TABLE `makanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `makanans_kuliner_id_foreign` (`kuliner_id`);

--
-- Indexes for table `metode_pembayarans`
--
ALTER TABLE `metode_pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `metode_pembayarans_kuliner_id_foreign` (`kuliner_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_reservasi_id_foreign` (`reservasi_id`),
  ADD KEY `pembayaran_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_makanan_id_foreign` (`makanan_id`),
  ADD KEY `ratings_user_id_foreign` (`user_id`),
  ADD KEY `ratings_kuliner_id_foreign` (`kuliner_id`);

--
-- Indexes for table `reservasis`
--
ALTER TABLE `reservasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservasis_id_tempat_foreign` (`id_tempat`),
  ADD KEY `reservasis_user_id_foreign` (`user_id`),
  ADD KEY `reservasis_id_meja_foreign` (`id_meja`),
  ADD KEY `reservasis_id_metode_pembayaran_foreign` (`id_metode_pembayaran`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ulasans`
--
ALTER TABLE `ulasans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ulasans_user_id_foreign` (`user_id`),
  ADD KEY `ulasans_reservasi_id_foreign` (`reservasi_id`),
  ADD KEY `ulasans_id_tempat_foreign` (`id_tempat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeris`
--
ALTER TABLE `galeris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kapasitas_mejas`
--
ALTER TABLE `kapasitas_mejas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kontaks`
--
ALTER TABLE `kontaks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kuliners`
--
ALTER TABLE `kuliners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `makanans`
--
ALTER TABLE `makanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `metode_pembayarans`
--
ALTER TABLE `metode_pembayarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservasis`
--
ALTER TABLE `reservasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ulasans`
--
ALTER TABLE `ulasans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kapasitas_mejas`
--
ALTER TABLE `kapasitas_mejas`
  ADD CONSTRAINT `kapasitas_mejas_kuliner_id_foreign` FOREIGN KEY (`kuliner_id`) REFERENCES `kuliners` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kapasitas_mejas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `kuliners`
--
ALTER TABLE `kuliners`
  ADD CONSTRAINT `kuliners_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `makanans`
--
ALTER TABLE `makanans`
  ADD CONSTRAINT `makanans_kuliner_id_foreign` FOREIGN KEY (`kuliner_id`) REFERENCES `kuliners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `metode_pembayarans`
--
ALTER TABLE `metode_pembayarans`
  ADD CONSTRAINT `metode_pembayarans_kuliner_id_foreign` FOREIGN KEY (`kuliner_id`) REFERENCES `kuliners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_reservasi_id_foreign` FOREIGN KEY (`reservasi_id`) REFERENCES `reservasis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembayaran_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_kuliner_id_foreign` FOREIGN KEY (`kuliner_id`) REFERENCES `kuliners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_makanan_id_foreign` FOREIGN KEY (`makanan_id`) REFERENCES `makanans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservasis`
--
ALTER TABLE `reservasis`
  ADD CONSTRAINT `reservasis_id_meja_foreign` FOREIGN KEY (`id_meja`) REFERENCES `kapasitas_mejas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservasis_id_metode_pembayaran_foreign` FOREIGN KEY (`id_metode_pembayaran`) REFERENCES `metode_pembayarans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservasis_id_tempat_foreign` FOREIGN KEY (`id_tempat`) REFERENCES `kuliners` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservasis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `ulasans`
--
ALTER TABLE `ulasans`
  ADD CONSTRAINT `ulasans_id_tempat_foreign` FOREIGN KEY (`id_tempat`) REFERENCES `kuliners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulasans_reservasi_id_foreign` FOREIGN KEY (`reservasi_id`) REFERENCES `reservasis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulasans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
