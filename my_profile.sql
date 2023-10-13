-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 13, 2023 at 05:01 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_profile`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_09_041048_create_profiles_table', 1),
(6, '2023_04_09_081542_create_pendidikans_table', 1),
(7, '2023_04_13_143931_create_organisasis_table', 1),
(8, '2023_04_26_134846_create_pengalamen_table', 1),
(9, '2023_09_03_045811_create_ms_pemograman', 1),
(10, '2023_09_03_045857_create_ta_projek', 1),
(11, '2023_09_16_021719_create_ta_sertifikat', 1),
(12, '2023_09_16_021735_create_ms_sertifikat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ms_pemograman`
--

CREATE TABLE `ms_pemograman` (
  `id_bhs_pemograman` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_bahasa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tentang_bahasa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_urut` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ms_pemograman`
--

INSERT INTO `ms_pemograman` (`id_bhs_pemograman`, `slug`, `nama_bahasa`, `tentang_bahasa`, `foto`, `no_urut`, `created_at`, `updated_at`) VALUES
(1, 'framework-laravel', 'Framework Laravel', 'Laravel adalah kerangka kerja aplikasi web berbasis PHP yang sumber terbuka, menggunakan konsep Model-View-Controller', 'AAoarcpRzevVr6MTsvwZiqOUpDxOsr8prM6m72d6.png', 1, '2023-10-09 20:47:16', '2023-10-11 23:23:50'),
(2, 'react-native', 'React Native', 'React Native adalah kerangka perangkat lunak UI sumber terbuka yang dibuat oleh Meta Platforms, Inc. Ini digunakan untuk mengembangkan aplikasi untuk Android', 'sSNLNxLrVxz8ftOrpZNTSUNxo7dcTMsBxnPZXJ8s.png', 2, '2023-10-09 20:47:49', '2023-10-11 23:24:28'),
(3, 'react-js', 'React JS', 'React adalah libray JavaScript yang digunakan untuk membangun user interface yang interaktif berbasis component.', '6grt4HWdBPEaZXKN97RrvEkNPk7KPSgUVsYkC9sz.png', 3, '2023-10-11 23:25:23', '2023-10-11 23:25:46'),
(4, 'next-js', 'Next JS', 'Next.js adalah kerangka kerja pengembangan web sumber terbuka yang dibuat oleh perusahaan swasta Vercel yang menyediakan aplikasi web berbasis React dengan rendering sisi server dan pembuatan situs web statis.', 'qT9wuOP29DJNmW5XrPb34RXndJRydXdUd812D5M5.png', 4, '2023-10-11 23:26:36', '2023-10-11 23:26:36');

-- --------------------------------------------------------

--
-- Table structure for table `ms_sertifikat`
--

CREATE TABLE `ms_sertifikat` (
  `id_kategori` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_kategori` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_urut` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ms_sertifikat`
--

INSERT INTO `ms_sertifikat` (`id_kategori`, `slug`, `nama_kategori`, `keterangan_kategori`, `no_urut`, `created_at`, `updated_at`) VALUES
(1, 'pelatihan-dan-pemograman', 'Pelatihan dan Pemograman', 'Berisi data sertifikat pelatihan dan pemograman', 1, '2023-10-09 20:48:26', '2023-10-09 20:48:26'),
(2, 'relawan-tik-komisariat-stmik-indonesia-padang', 'Relawan TIK Komisariat STMIK Indonesia Padang', 'Sertifikat yang didapatkan dan dikumpulkan saat menjadi anggota RTIK Komisariat STMIK Indonesia Padang', 2, '2023-10-09 20:49:23', '2023-10-09 20:49:23'),
(3, 'bem-stmik-indonesia-padang', 'BEM STMIK Indonesia Padang', 'Kampus', 3, '2023-10-12 01:47:58', '2023-10-12 01:47:58'),
(4, 'hmi-stmik-indonesia-padang', 'HMI STMIK Indonesia Padang', 'Organisasi', 4, '2023-10-13 00:19:22', '2023-10-13 00:19:22'),
(5, 'kursus-pemograman', 'Kursus Pemograman', 'Pemograman', 5, '2023-10-13 00:19:58', '2023-10-13 00:19:58'),
(6, 'tes', 'tes', 'tes', 6, '2023-10-13 02:55:44', '2023-10-13 02:55:44');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
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
-- Table structure for table `ta_projek`
--

CREATE TABLE `ta_projek` (
  `id_projek` bigint(20) UNSIGNED NOT NULL,
  `id_bhs_pemograman` bigint(20) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_projek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_pembuatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tentang_projek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_urut` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ta_projek`
--

INSERT INTO `ta_projek` (`id_projek`, `id_bhs_pemograman`, `slug`, `nama_projek`, `tahun_pembuatan`, `tentang_projek`, `file`, `no_urut`, `created_at`, `updated_at`) VALUES
(1, 1, 'my-profile', 'My Profile', '2022', 'Projek pribadi', 'nLCxozfhQGBtXQGRVPEQwdacxyOECdNy1OXkIU4E.pdf', 1, '2023-10-09 21:02:41', '2023-10-09 21:02:41'),
(2, 2, 'foodmarket', 'FoodMarket', '2022', 'Projek belajar react native', 'hFiO6bonE82WGuVbxTL48J1EmYXHRBfYD72WI2wf.pdf', 2, '2023-10-09 21:05:54', '2023-10-09 21:05:54'),
(3, 2, 'jerseypedia', 'Jerseypedia', '2021', 'Enim adipisicing nes', 'ZXj70MSVivAW8TLOaflKMe0436wpIjIgxXOEVEWm.pdf', 2, '2023-10-11 20:54:11', '2023-10-11 23:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `ta_sertifikat`
--

CREATE TABLE `ta_sertifikat` (
  `id_sertifikat` bigint(20) UNSIGNED NOT NULL,
  `id_kategori` bigint(20) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tentang_sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_urut` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ta_sertifikat`
--

INSERT INTO `ta_sertifikat` (`id_sertifikat`, `id_kategori`, `slug`, `nama_sertifikat`, `tahun_sertifikat`, `tentang_sertifikat`, `file`, `no_urut`, `created_at`, `updated_at`) VALUES
(1, 1, 'pemograman-web-dasar', 'Pemograman web dasar', '2020', 'Pelatihan web pemula', '1MUvmNHHFBFvbbgSj8v4wpWZNHJbv0jACbMmhv7p.pdf', 1, '2023-10-09 21:07:32', '2023-10-09 21:07:32'),
(2, 2, 'kegiatan-pengabdian-masyarakat', 'Kegiatan pengabdian masyarakat', '2020', 'Kegiatan pengabdian masyarakat', 'bDqdrQkuANe6OsfsxGsAg1GD3K4qvP9wRouXixuE.pdf', 2, '2023-10-09 21:08:49', '2023-10-09 21:08:49'),
(3, 1, 'mengikuti-seminar', 'Mengikuti Seminar', '2020', 'Sertifikat pelatihan', 'AfHym2sSsGOQXmZQ6mGjLeW8C4qsws1sVdevVpi9.pdf', 2, '2023-10-12 01:47:23', '2023-10-12 01:47:23'),
(4, 1, 'sertifikat-pelatihan-untuk-menjaga-kehidupan-berbangsa-dan-bernegara', 'Sertifikat pelatihan untuk menjaga kehidupan berbangsa dan bernegara', '2023', 'qwerty', 'wyhG0gUlEiJCSj63xBWFMYRmyloqqBIMzpvkvKWR.pdf', 3, '2023-10-12 21:05:49', '2023-10-12 21:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_organisasi`
--

CREATE TABLE `tbl_organisasi` (
  `id_organisasi` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_organisasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tentang_organisasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat_organisasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tentang_jabatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_urut` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_organisasi`
--

INSERT INTO `tbl_organisasi` (`id_organisasi`, `slug`, `nama_organisasi`, `tentang_organisasi`, `tingkat_organisasi`, `jabatan`, `tentang_jabatan`, `tanggal_masuk`, `tanggal_keluar`, `logo`, `kota`, `provinsi`, `no_urut`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'bem-stmik-indonesia-padang', 'BEM STMIK Indonesia Padang', 'Badan Eksekutif Mahasiswa adalah organisasi mahasiswa intra kampus yang merupakan lembaga eksekutif di tingkat perguruan tinggi yang dipimpin oleh seorang Presiden Mahasiswa atau Ketua BEM.', 'Tingkat Kampus', 'Wakil Presiden Mahasiswa', 'Bertanggungjawab penuh terhadap pengelolaan fasilitas dan sarana serta melakukan inventarisasi aset yang dimiliki BEM', '2023-10-10', '2023-10-10', 'ga769IEfi2VX0N7v8Hf2cuIQemDT9DYAIiy2wrpG.jpg', 'Kota Padang', 'Sumatera Barat', 3, NULL, '2023-10-09 20:56:52', '2023-10-11 19:05:26'),
(2, 'et-quia-eius-labore', 'Et quia eius labore', 'Sint non inventore u sfsdfsdfsdf sfsdfs fsdfsdfs dfsdfsdfsd sdvxcvxc xcvxcv eg s dgsd sdgfg sdg sdg', 'Pariatur Aliqua Do', 'Perferendis dolore v', 'Ipsum magnam aut rep', '1982-02-01', '2009-05-08', '1vrSI69pb7YGxOKeYEiHBJUG95vVSBHr03alPgDx.png', 'Velit sit velit ex', 'Placeat consequat', 2, NULL, '2023-10-11 19:03:06', '2023-10-11 19:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendidikan`
--

CREATE TABLE `tbl_pendidikan` (
  `id_pendidikan` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pendidikan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `alamat_pendidikan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_urut` int(11) NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_pendidikan`
--

INSERT INTO `tbl_pendidikan` (`id_pendidikan`, `slug`, `nama_pendidikan`, `tanggal_masuk`, `tanggal_keluar`, `alamat_pendidikan`, `kota`, `provinsi`, `nilai`, `jurusan`, `no_urut`, `logo`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'sdn-23-kampung-palak-solok-selatan', 'SDN 23 KAMPUNG PALAK SOLOK SELATAN', '2023-10-10', '2023-10-10', 'Jl. Berlian I No.3-4, Tabing Banda Gadang, Kec. Nanggalo, Kota Padang, Sumatera Barat 25144', 'Solok Selatan', 'Sumatera Barat', '70', 'Tidak ada', 1, 'uVrUlgmDg42oNTPfxSbhsRo49qBvjZsBIhOq1mIx.png', NULL, '2023-10-09 20:54:38', '2023-10-11 19:01:14'),
(2, 'smp-n-1-solok-selatan', 'SMP N 1 SOLOK SELATAN', '2023-10-12', '2023-10-12', 'Jl. Jend. Sudirman No.51, Padang Pasir, Kec. Padang Bar., Kota Padang, Sumatera Barat 25129', 'Kota Padang', 'Sumatera Barat', '70', 'IPA', 2, '30Z7SBgxNWpop6fIy5VWNGlOr89mH4xx3KEBLigE.png', NULL, '2023-10-11 19:00:26', '2023-10-11 19:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengalaman_kerja`
--

CREATE TABLE `tbl_pengalaman_kerja` (
  `id_pengalaman` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `posisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tugas_wewenang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_urut` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_pengalaman_kerja`
--

INSERT INTO `tbl_pengalaman_kerja` (`id_pengalaman`, `slug`, `nama_perusahaan`, `tanggal_keluar`, `tanggal_masuk`, `posisi`, `tugas_wewenang`, `file`, `logo`, `no_urut`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'pt-hayati-pratama-mandiri', 'PT. HAYATI PRATAMA MANDIRI', '2023-10-10', '2023-10-10', 'Staff IT', 'IT support adalah seseorang atau suatu tim yang bertugas menjadi pelaksana dan pemelihara sistem informasi teknologi dalam sebuah perusahaan.', 'XdpVOx5kvKTuw6NUHCgfudESkes98itjPhefWBJU.pdf', 'OKVHjUe8iRrv2ix06lJdnqgKtuVvnQWdKfTzk2vr.png', 1, NULL, '2023-10-09 20:59:13', '2023-10-09 20:59:13'),
(2, 'cv-mediatama-web-indonesia', 'CV. Mediatama Web Indonesia', '2023-10-13', '2023-10-12', 'Web Programmer', 'asd', 'zeS50vIZNSEQgqp8XNH4VMiXcHfoCWjmUFPrpwRq.pdf', 'YtgdxrxdRiTCdxYXSSZcjB78E2f6iyi7esVx1suf.png', 2, NULL, '2023-10-11 19:09:29', '2023-10-11 20:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profile`
--

CREATE TABLE `tbl_profile` (
  `id_profile` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_panggilan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profil_singkat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_sekarang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota_asal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi_asal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_profile`
--

INSERT INTO `tbl_profile` (`id_profile`, `slug`, `nama_lengkap`, `nama_panggilan`, `tempat_lahir`, `tanggal_lahir`, `foto`, `email`, `no_hp`, `status`, `profil_singkat`, `pekerjaan`, `alamat_sekarang`, `kota_asal`, `provinsi_asal`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'putra-evans-pratama', 'Putra Evans Pratama', 'Putra', 'Muara Labuh', '1997-10-21', 'I3DHj9ziEiqJnctsibmEtnfhAsMeuKIKP0EmuoXR.jpg', 'putraevans001@gmail.com', '082285248130', 'Lanjang', 'Hai, Anda bisa memanggil saya Putra, saya Junior Programmer dan saya punya 3 orang\r\n pengalaman bertahun-tahun sebagai programmer web dan sekarang dalam proses pembelajaran\r\n dari React kurang lebih 1 tahun, saya suka bekerja dalam tim, saya punya yang bagus\r\n komunikasi dan saya suka mempelajari hal-hal baru', 'WEB PROGRAMMER', 'Jl. Berlian I No.3-4, Tabing Banda Gadang, Kec. Nanggalo, Kota Padang, Sumatera Barat 25144', 'Padang', 'Sumatera Barat', NULL, '2023-10-09 20:52:17', '2023-10-09 20:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Putra Evans Pratama', 'putraevans001@gmail.com', NULL, '$2y$10$UW4vIyWGFKzMdnLHzl6drudoH1O9y7PrpwndHgY925n/XOwllVppC', NULL, '2023-10-09 20:45:56', '2023-10-09 20:45:56');

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_pemograman`
--
ALTER TABLE `ms_pemograman`
  ADD PRIMARY KEY (`id_bhs_pemograman`),
  ADD UNIQUE KEY `ms_pemograman_slug_unique` (`slug`);

--
-- Indexes for table `ms_sertifikat`
--
ALTER TABLE `ms_sertifikat`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `ms_sertifikat_slug_unique` (`slug`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ta_projek`
--
ALTER TABLE `ta_projek`
  ADD PRIMARY KEY (`id_projek`),
  ADD UNIQUE KEY `ta_projek_slug_unique` (`slug`);

--
-- Indexes for table `ta_sertifikat`
--
ALTER TABLE `ta_sertifikat`
  ADD PRIMARY KEY (`id_sertifikat`),
  ADD UNIQUE KEY `ta_sertifikat_slug_unique` (`slug`);

--
-- Indexes for table `tbl_organisasi`
--
ALTER TABLE `tbl_organisasi`
  ADD PRIMARY KEY (`id_organisasi`),
  ADD UNIQUE KEY `tbl_organisasi_slug_unique` (`slug`);

--
-- Indexes for table `tbl_pendidikan`
--
ALTER TABLE `tbl_pendidikan`
  ADD PRIMARY KEY (`id_pendidikan`),
  ADD UNIQUE KEY `tbl_pendidikan_slug_unique` (`slug`);

--
-- Indexes for table `tbl_pengalaman_kerja`
--
ALTER TABLE `tbl_pengalaman_kerja`
  ADD PRIMARY KEY (`id_pengalaman`),
  ADD UNIQUE KEY `tbl_pengalaman_kerja_slug_unique` (`slug`);

--
-- Indexes for table `tbl_profile`
--
ALTER TABLE `tbl_profile`
  ADD PRIMARY KEY (`id_profile`),
  ADD UNIQUE KEY `tbl_profile_slug_unique` (`slug`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ms_pemograman`
--
ALTER TABLE `ms_pemograman`
  MODIFY `id_bhs_pemograman` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ms_sertifikat`
--
ALTER TABLE `ms_sertifikat`
  MODIFY `id_kategori` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ta_projek`
--
ALTER TABLE `ta_projek`
  MODIFY `id_projek` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ta_sertifikat`
--
ALTER TABLE `ta_sertifikat`
  MODIFY `id_sertifikat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_organisasi`
--
ALTER TABLE `tbl_organisasi`
  MODIFY `id_organisasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_pendidikan`
--
ALTER TABLE `tbl_pendidikan`
  MODIFY `id_pendidikan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_pengalaman_kerja`
--
ALTER TABLE `tbl_pengalaman_kerja`
  MODIFY `id_pengalaman` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_profile`
--
ALTER TABLE `tbl_profile`
  MODIFY `id_profile` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
