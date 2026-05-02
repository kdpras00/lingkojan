-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 02 Bulan Mei 2026 pada 13.52
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lingkojan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_29_183211_create_permission_tables', 1),
(5, '2026_04_30_200515_add_details_to_users_table', 1),
(6, '2026_05_01_123056_create_lingkojan_tables', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 11),
(3, 'App\\Models\\User', 12),
(3, 'App\\Models\\User', 13),
(3, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 15),
(3, 'App\\Models\\User', 16),
(3, 'App\\Models\\User', 17),
(3, 'App\\Models\\User', 18),
(3, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 20),
(3, 'App\\Models\\User', 21),
(3, 'App\\Models\\User', 22),
(3, 'App\\Models\\User', 24),
(3, 'App\\Models\\User', 25),
(3, 'App\\Models\\User', 26),
(3, 'App\\Models\\User', 27),
(3, 'App\\Models\\User', 28),
(3, 'App\\Models\\User', 29),
(3, 'App\\Models\\User', 30),
(3, 'App\\Models\\User', 31),
(3, 'App\\Models\\User', 32),
(3, 'App\\Models\\User', 33),
(3, 'App\\Models\\User', 34),
(3, 'App\\Models\\User', 35),
(3, 'App\\Models\\User', 36),
(3, 'App\\Models\\User', 37),
(3, 'App\\Models\\User', 38),
(3, 'App\\Models\\User', 39),
(3, 'App\\Models\\User', 41),
(3, 'App\\Models\\User', 42),
(3, 'App\\Models\\User', 43),
(3, 'App\\Models\\User', 44),
(3, 'App\\Models\\User', 45),
(3, 'App\\Models\\User', 46),
(3, 'App\\Models\\User', 47),
(3, 'App\\Models\\User', 48),
(3, 'App\\Models\\User', 49),
(3, 'App\\Models\\User', 50),
(3, 'App\\Models\\User', 51),
(3, 'App\\Models\\User', 52),
(3, 'App\\Models\\User', 53),
(3, 'App\\Models\\User', 54),
(3, 'App\\Models\\User', 55),
(3, 'App\\Models\\User', 56),
(3, 'App\\Models\\User', 58),
(3, 'App\\Models\\User', 59),
(3, 'App\\Models\\User', 60),
(3, 'App\\Models\\User', 61),
(3, 'App\\Models\\User', 62),
(3, 'App\\Models\\User', 63),
(3, 'App\\Models\\User', 64),
(3, 'App\\Models\\User', 65),
(3, 'App\\Models\\User', 66),
(3, 'App\\Models\\User', 67),
(3, 'App\\Models\\User', 68),
(3, 'App\\Models\\User', 69),
(3, 'App\\Models\\User', 70),
(3, 'App\\Models\\User', 71),
(3, 'App\\Models\\User', 72),
(3, 'App\\Models\\User', 73),
(3, 'App\\Models\\User', 109),
(3, 'App\\Models\\User', 110),
(3, 'App\\Models\\User', 111),
(3, 'App\\Models\\User', 112),
(3, 'App\\Models\\User', 113),
(3, 'App\\Models\\User', 114),
(3, 'App\\Models\\User', 115),
(3, 'App\\Models\\User', 116),
(3, 'App\\Models\\User', 117),
(3, 'App\\Models\\User', 118),
(3, 'App\\Models\\User', 119),
(3, 'App\\Models\\User', 120),
(3, 'App\\Models\\User', 121),
(3, 'App\\Models\\User', 122),
(3, 'App\\Models\\User', 123),
(3, 'App\\Models\\User', 124),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 125),
(5, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduans`
--

CREATE TABLE `pengaduans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nomor_pengaduan` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `subjek` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `rt` varchar(255) NOT NULL,
  `rw` varchar(255) NOT NULL,
  `status` enum('New','On Progress','Done','Cancel') NOT NULL DEFAULT 'New',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengaduans`
--

INSERT INTO `pengaduans` (`id`, `user_id`, `nomor_pengaduan`, `kategori`, `subjek`, `foto`, `alamat`, `rt`, `rw`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'P-20260501-0001', 'Keamanan', 'perbaiki jalan ini', 'pengaduans/CEOmGAPd7vBCvE2tTPxz0rzuNElUlrSQj89HUj46.png', 'perbaiki jalan ini karena rusak tidak bisa di perbaiki', '001', '001', 'Cancel', '2026-05-01 07:34:47', '2026-05-01 07:35:23'),
(2, 2, 'P-20260501-0002', 'Fasilitas Umum', 'jalan rusak bisa diperbaiki segera ga', 'pengaduans/w4fSjWrkHV476DNfd130AAKFb1fnneo0hOMmETDq.png', 'jalan rusak bisa diperbaiki segera ga', '001', '001', 'Done', '2026-05-01 07:36:30', '2026-05-01 08:11:52'),
(3, 2, 'P-20260501-0003', 'Kebersihan', 'jalan rusak rt 007', 'pengaduans/xft0XYdrG7bRaRW92jw7PKX8BmOQVRqu9Y2Ge9lX.png', 'jalanannya masih rusak pak', '001', '006', 'Cancel', '2026-05-01 09:59:41', '2026-05-01 10:01:43'),
(4, 2, 'P-20260501-0004', 'Infrastruktur', 'jalan rusak', 'pengaduans/N2UekvDFVFPNL4BFZgIFaGp0MxIgwk1IDBZxGv3G.png', 'jalan rusak', '001', '006', 'On Progress', '2026-05-01 10:26:17', '2026-05-01 10:26:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2026-05-01 07:33:06', '2026-05-01 07:33:06'),
(2, 'warga', 'web', '2026-05-01 07:33:06', '2026-05-01 07:33:06'),
(3, 'rt', 'web', '2026-05-01 07:33:06', '2026-05-01 07:33:06'),
(4, 'rw', 'web', '2026-05-01 07:33:06', '2026-05-01 07:33:06'),
(5, 'petugas', 'web', '2026-05-01 07:33:06', '2026-05-01 07:33:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rukun_tetangga`
--

CREATE TABLE `rukun_tetangga` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `nama_ketua` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rukun_tetangga`
--

INSERT INTO `rukun_tetangga` (`id`, `nomor`, `nama_ketua`, `created_at`, `updated_at`) VALUES
(99, '001', 'Ketua RT 001', '2026-05-01 19:29:15', '2026-05-01 19:29:15'),
(100, '002', 'Ketua RT 002', '2026-05-01 19:29:15', '2026-05-01 19:29:15'),
(101, '003', 'Ketua RT 003', '2026-05-01 19:29:15', '2026-05-01 19:29:15'),
(102, '004', 'Ketua RT 004', '2026-05-01 19:29:15', '2026-05-01 19:29:15'),
(103, '005', 'Ketua RT 005', '2026-05-01 19:29:16', '2026-05-01 19:29:16'),
(104, '006', 'Ketua RT 006', '2026-05-01 19:29:16', '2026-05-01 19:29:16'),
(105, '007', 'Ketua RT 007', '2026-05-01 19:29:16', '2026-05-01 19:29:16'),
(106, '008', 'Ketua RT 008', '2026-05-01 19:29:17', '2026-05-01 19:29:17'),
(107, '009', 'Ketua RT 009', '2026-05-01 19:29:17', '2026-05-01 19:29:17'),
(108, '010', 'Ketua RT 010', '2026-05-01 19:29:17', '2026-05-01 19:29:17'),
(109, '011', 'Ketua RT 011', '2026-05-01 19:29:17', '2026-05-01 19:29:17'),
(110, '012', 'Ketua RT 012', '2026-05-01 19:29:18', '2026-05-01 19:29:18'),
(111, '013', 'Ketua RT 013', '2026-05-01 19:29:18', '2026-05-01 19:29:18'),
(112, '014', 'Ketua RT 014', '2026-05-01 19:29:18', '2026-05-01 19:29:18'),
(113, '015', 'Ketua RT 015', '2026-05-01 19:29:18', '2026-05-01 19:29:18'),
(114, '016', 'Ketua RT 016', '2026-05-01 19:29:19', '2026-05-01 19:29:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('I2lX1AQC2ZTjXwm03X1UkMWAX3fJa3cwFTzwj6vS', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJqOWxOZ0FDMFJheG5hSWdHblZ6ZjNhU1dHU1hMenZ0ZU04TWF2d2pqIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluXC9tZW51Iiwicm91dGUiOiJhZG1pbi5tZW51In0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==', 1777710517);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tindak_lanjuts`
--

CREATE TABLE `tindak_lanjuts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengaduan_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tindak_lanjuts`
--

INSERT INTO `tindak_lanjuts` (`id`, `pengaduan_id`, `user_id`, `status`, `detail`, `foto`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Cancel', 'Laporan dibatalkan oleh pelapor.', NULL, '2026-05-01 07:35:23', '2026-05-01 07:35:23'),
(2, 2, 5, 'On Progress', 'tes', 'tindak_lanjut/JkS3UANSRZvwaFT4dreu15AUje1g83oqbM7egnmq.png', '2026-05-01 07:59:57', '2026-05-01 07:59:57'),
(3, 2, 5, 'Done', 'selesai ya', 'tindak_lanjut/KK0nRHQbx7471ea7BWd6Zl2BI9ag0K1fQxNuNEoY.png', '2026-05-01 08:11:52', '2026-05-01 08:11:52'),
(4, 3, 5, 'On Progress', 'siapp', 'tindak_lanjut/tcOt38BrZadOZQ9mEDwyNTyFBNknKimTzlb8sl26.png', '2026-05-01 10:01:17', '2026-05-01 10:01:17'),
(5, 3, 5, 'Cancel', 'gagal', 'tindak_lanjut/mUdlFnQ8F7p0UkjelkXYarRWJ0CiYFogT33GI7yo.png', '2026-05-01 10:01:43', '2026-05-01 10:01:43'),
(6, 4, 5, 'On Progress', 'gasken', NULL, '2026-05-01 10:26:35', '2026-05-01 10:26:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `rt` varchar(255) DEFAULT NULL,
  `rw` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `nik`, `phone`, `rt`, `rw`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '3307000000363790', '0812000785659', NULL, NULL, 'admin@lingkojan.com', NULL, '$2y$12$HukodF5.tWLkdPnjpauKBu2ZxU2pVc74LYmT971wdw1cIwbJO.Mp6', NULL, '2026-05-01 07:33:06', '2026-05-01 09:58:45'),
(2, 'Warga User', 'warga', '3307000000124289', '0812000637097', '001', '006', 'warga@lingkojan.com', NULL, '$2y$12$0VhbhQxpx/7uP7vTq819bubf9Tqx2NHc/MLqhhNvTzoyqnj30v65K', NULL, '2026-05-01 07:33:07', '2026-05-01 09:58:45'),
(5, 'Petugas Lapangan', 'petugas', '3307000000147544', '0812000934257', NULL, NULL, 'petugas@lingkojan.com', NULL, '$2y$12$PKmB.YAQMyPg3E9Cw5uTUOBHRjm78ugDbv9P0m812fM2k9KVZFfOy', NULL, '2026-05-01 07:33:08', '2026-05-01 09:58:46'),
(109, 'Ketua RT 001', 'rt001', '3307000000000001', '0812000000001', '001', '006', 'rt001@lingkojan.com', NULL, '$2y$12$VHdhR7P01Wq9lqNDvWB3D.l5sM5g5NFyOmt1wVqhr4EgTq3wug/KW', NULL, '2026-05-01 19:29:15', '2026-05-01 19:29:15'),
(110, 'Ketua RT 002', 'rt002', '3307000000000002', '0812000000002', '002', '006', 'rt002@lingkojan.com', NULL, '$2y$12$PBBeX.C/OnvXhWotsQkGEOzzGsAvusNtms8rXOBq.P.naF4nnhp/q', NULL, '2026-05-01 19:29:15', '2026-05-01 19:29:15'),
(111, 'Ketua RT 003', 'rt003', '3307000000000003', '0812000000003', '003', '006', 'rt003@lingkojan.com', NULL, '$2y$12$X/AyRHxH9gQKXNqFgj2kuuJ1clWcJX9ZsUf.2WUI5BGkDBos9CoAa', NULL, '2026-05-01 19:29:15', '2026-05-01 19:29:15'),
(112, 'Ketua RT 004', 'rt004', '3307000000000004', '0812000000004', '004', '006', 'rt004@lingkojan.com', NULL, '$2y$12$rfsfAGG1MPDc/J397XuNKe6Fjm6s1fh8e5a5/pX.1qJMnhOeKRyJq', NULL, '2026-05-01 19:29:16', '2026-05-01 19:29:16'),
(113, 'Ketua RT 005', 'rt005', '3307000000000005', '0812000000005', '005', '006', 'rt005@lingkojan.com', NULL, '$2y$12$NbKqklFgebJFOti6RHmmtuqUsxQZMniwD6O/1KeTZH1/KnDFtzjQa', NULL, '2026-05-01 19:29:16', '2026-05-01 19:29:16'),
(114, 'Ketua RT 006', 'rt006', '3307000000000006', '0812000000006', '006', '006', 'rt006@lingkojan.com', NULL, '$2y$12$0dsWvRNR9UFUOaPnpTQBoOa6STEHfbGxbPfqPXAbMcM1zMRHn8H1W', NULL, '2026-05-01 19:29:16', '2026-05-01 19:29:16'),
(115, 'Ketua RT 007', 'rt007', '3307000000000007', '0812000000007', '007', '006', 'rt007@lingkojan.com', NULL, '$2y$12$K9ue3AF105z57i1lU2bRPu86hxfnoVIOv6q0o8hCvlszufllfisjy', NULL, '2026-05-01 19:29:17', '2026-05-01 19:29:17'),
(116, 'Ketua RT 008', 'rt008', '3307000000000008', '0812000000008', '008', '006', 'rt008@lingkojan.com', NULL, '$2y$12$JkrryerS2wA.tGvykVIUt.fLSDW0RQB4p0vjxzzruS.XkGpthaITK', NULL, '2026-05-01 19:29:17', '2026-05-01 19:29:17'),
(117, 'Ketua RT 009', 'rt009', '3307000000000009', '0812000000009', '009', '006', 'rt009@lingkojan.com', NULL, '$2y$12$Tb8dgYUzOtsOkcCG.VB/4O0yEXsUxZPYF9k90AyOJ45mW0XxXOXDK', NULL, '2026-05-01 19:29:17', '2026-05-01 19:29:17'),
(118, 'Ketua RT 010', 'rt010', '3307000000000010', '0812000000010', '010', '006', 'rt010@lingkojan.com', NULL, '$2y$12$YhfZr9naT03pQFyJ5LlSBuhgnQQFlWtUKo8kgx1ObXl4jiZPvAw36', NULL, '2026-05-01 19:29:17', '2026-05-01 19:29:17'),
(119, 'Ketua RT 011', 'rt011', '3307000000000011', '0812000000011', '011', '006', 'rt011@lingkojan.com', NULL, '$2y$12$iJ95dfEv.HcBApCk1NwPYOUQQwb7bKDBx3edh49rYDeGoNn53NGoe', NULL, '2026-05-01 19:29:18', '2026-05-01 19:29:18'),
(120, 'Ketua RT 012', 'rt012', '3307000000000012', '0812000000012', '012', '006', 'rt012@lingkojan.com', NULL, '$2y$12$qeYcLrlqcy4HjlPMJAccV.RNb7.FMlOV7kU7iE9lwziT1aMbXopO2', NULL, '2026-05-01 19:29:18', '2026-05-01 19:29:18'),
(121, 'Ketua RT 013', 'rt013', '3307000000000013', '0812000000013', '013', '006', 'rt013@lingkojan.com', NULL, '$2y$12$2npioR7G1Scw0X3rmr71gODriZU5VazuqcOga6mCmmfxTx7WUQ4MS', NULL, '2026-05-01 19:29:18', '2026-05-01 19:29:18'),
(122, 'Ketua RT 014', 'rt014', '3307000000000014', '0812000000014', '014', '006', 'rt014@lingkojan.com', NULL, '$2y$12$xa52rQj/TzukImUyPJrYdOahb/H3U.YfimZtp3aByFG91/C6L1lwe', NULL, '2026-05-01 19:29:18', '2026-05-01 19:29:18'),
(123, 'Ketua RT 015', 'rt015', '3307000000000015', '0812000000015', '015', '006', 'rt015@lingkojan.com', NULL, '$2y$12$E.t.Si5Sqz3swkykMZCKt.mdj7HJZvCmuI8ZdDxd2feLRreuS9DNC', NULL, '2026-05-01 19:29:19', '2026-05-01 19:29:19'),
(124, 'Ketua RT 016', 'rt016', '3307000000000016', '0812000000016', '016', '006', 'rt016@lingkojan.com', NULL, '$2y$12$HtHFyF5OQRqgggV2.1d1tOco9sM7oeX.ZrWkYptyJAoF4lbxQGqVe', NULL, '2026-05-01 19:29:19', '2026-05-01 19:29:19'),
(125, 'Ketua RW 006', 'rw006', '3307000000000999', '0812000000999', NULL, '006', 'rw006@lingkojan.com', NULL, '$2y$12$7Fi3sRie./d/7B4sNk.LzuHe/ildZOL0m7Z4UMG.adDqEgxttSzOa', NULL, '2026-05-01 19:29:19', '2026-05-01 19:29:19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pengaduans`
--
ALTER TABLE `pengaduans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengaduans_nomor_pengaduan_unique` (`nomor_pengaduan`),
  ADD KEY `pengaduans_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `rukun_tetangga`
--
ALTER TABLE `rukun_tetangga`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rukun_tetangga_nomor_unique` (`nomor`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `tindak_lanjuts`
--
ALTER TABLE `tindak_lanjuts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tindak_lanjuts_pengaduan_id_foreign` (`pengaduan_id`),
  ADD KEY `tindak_lanjuts_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_nik_unique` (`nik`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengaduans`
--
ALTER TABLE `pengaduans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `rukun_tetangga`
--
ALTER TABLE `rukun_tetangga`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT untuk tabel `tindak_lanjuts`
--
ALTER TABLE `tindak_lanjuts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengaduans`
--
ALTER TABLE `pengaduans`
  ADD CONSTRAINT `pengaduans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tindak_lanjuts`
--
ALTER TABLE `tindak_lanjuts`
  ADD CONSTRAINT `tindak_lanjuts_pengaduan_id_foreign` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tindak_lanjuts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
