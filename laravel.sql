-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Feb 2026 pada 09.07
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
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `model_type` varchar(255) DEFAULT NULL,
  `model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `old_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`old_values`)),
  `new_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`new_values`)),
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `model_type`, `model_id`, `old_values`, `new_values`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 2, 'update', 'Parking Area', NULL, 1, '{\"id\":1,\"name\":\"LOBBY C\",\"code\":\"1220\",\"capacity\":150,\"available_spaces\":150,\"location\":\"GRAND BATAM LOBBY C\",\"is_active\":true,\"created_at\":\"2026-02-25T06:34:36.000000Z\",\"updated_at\":\"2026-02-25T06:34:36.000000Z\"}', '{\"id\":1,\"name\":\"LOBBY C\",\"code\":\"1220\",\"capacity\":150,\"available_spaces\":150,\"location\":\"GRAND BATAM LOBBY C\",\"is_active\":true,\"created_at\":\"2026-02-25T06:34:36.000000Z\",\"updated_at\":\"2026-02-25T06:34:36.000000Z\"}', '127.0.0.1', '2026-02-24 23:49:38', '2026-02-24 23:49:38'),
(2, 2, 'update', 'Tariff', NULL, 1, '{\"id\":1,\"name\":\"TARIF GRAND BATAM\",\"price_per_hour\":\"1000.00\",\"price_per_day\":\"20000.00\",\"description\":\"TARIF GRAND BATAM\",\"is_active\":true,\"created_at\":\"2026-02-25T06:19:56.000000Z\",\"updated_at\":\"2026-02-25T06:19:56.000000Z\"}', '{\"id\":1,\"name\":\"TARIF GRAND BATAM\",\"price_per_hour\":\"2000.00\",\"price_per_day\":\"20000.00\",\"description\":\"TARIF GRAND BATAM\",\"is_active\":true,\"created_at\":\"2026-02-25T06:19:56.000000Z\",\"updated_at\":\"2026-02-25T06:57:38.000000Z\"}', '127.0.0.1', '2026-02-24 23:57:38', '2026-02-24 23:57:38'),
(3, 2, 'create', 'Vehicle', NULL, 1, NULL, '{\"plate_number\":\"BP 1029 AC\",\"type\":\"mobil\",\"brand\":\"TOYOTA\",\"color\":\"WHITE\",\"owner_name\":\"SS\",\"owner_phone\":\"089635514488\",\"updated_at\":\"2026-02-25T07:01:32.000000Z\",\"created_at\":\"2026-02-25T07:01:32.000000Z\",\"id\":1}', '127.0.0.1', '2026-02-25 00:01:32', '2026-02-25 00:01:32'),
(4, 3, 'create', 'Parking Entry', NULL, 1, NULL, '{\"vehicle_id\":2,\"parking_area_id\":\"1\",\"tariff_id\":\"2\",\"user_id\":3,\"ticket_number\":\"PK-VFUDUX\",\"entry_time\":\"2026-02-25T07:11:33.000000Z\",\"status\":\"parking\",\"updated_at\":\"2026-02-25T07:11:33.000000Z\",\"created_at\":\"2026-02-25T07:11:33.000000Z\",\"id\":1}', '127.0.0.1', '2026-02-25 00:11:33', '2026-02-25 00:11:33'),
(5, 3, 'update', 'Parking Exit', NULL, 1, '{\"id\":1,\"vehicle_id\":2,\"parking_area_id\":1,\"tariff_id\":2,\"user_id\":3,\"ticket_number\":\"PK-VFUDUX\",\"entry_time\":\"2026-02-25T07:11:33.000000Z\",\"exit_time\":null,\"total_price\":\"0.00\",\"status\":\"parking\",\"notes\":null,\"created_at\":\"2026-02-25T07:11:33.000000Z\",\"updated_at\":\"2026-02-25T07:11:33.000000Z\",\"tariff\":{\"id\":2,\"name\":\"TARIF GRAND BATAM\",\"price_per_hour\":\"1000.00\",\"price_per_day\":\"20000.00\",\"description\":\"TARIF GRAND BATAM\",\"is_active\":true,\"created_at\":\"2026-02-25T06:23:21.000000Z\",\"updated_at\":\"2026-02-25T06:23:21.000000Z\"}}', '{\"id\":1,\"vehicle_id\":2,\"parking_area_id\":1,\"tariff_id\":2,\"user_id\":3,\"ticket_number\":\"PK-VFUDUX\",\"entry_time\":\"2026-02-25T07:11:33.000000Z\",\"exit_time\":\"2026-02-25T07:16:17.000000Z\",\"total_price\":\"1000.00\",\"status\":\"completed\",\"notes\":\"Paid: 2000, Change: 1000\",\"created_at\":\"2026-02-25T07:11:33.000000Z\",\"updated_at\":\"2026-02-25T07:16:17.000000Z\"}', '127.0.0.1', '2026-02-25 00:16:17', '2026-02-25 00:16:17'),
(6, 3, 'create', 'Parking Entry', NULL, 2, NULL, '{\"vehicle_id\":1,\"parking_area_id\":\"1\",\"tariff_id\":\"2\",\"user_id\":3,\"ticket_number\":\"PK-XYD7FL\",\"entry_time\":\"2026-02-25T08:06:07.000000Z\",\"status\":\"parking\",\"updated_at\":\"2026-02-25T08:06:07.000000Z\",\"created_at\":\"2026-02-25T08:06:07.000000Z\",\"id\":2}', '127.0.0.1', '2026-02-25 01:06:07', '2026-02-25 01:06:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-admi@gmail.com|127.0.0.1', 'i:1;', 1772005131),
('laravel-cache-admi@gmail.com|127.0.0.1:timer', 'i:1772005131;', 1772005131);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
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
  `attempts` tinyint(3) UNSIGNED NOT NULL,
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
(4, '2024_01_01_000001_add_role_to_users_table', 1),
(5, '2024_01_01_000002_create_tariffs_table', 1),
(6, '2024_01_01_000003_create_parking_areas_table', 1),
(7, '2024_01_01_000004_create_vehicles_table', 1),
(8, '2024_01_01_000005_create_transactions_table', 1),
(9, '2024_01_01_000006_create_activity_logs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `parking_areas`
--

CREATE TABLE `parking_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `available_spaces` int(11) NOT NULL DEFAULT 0,
  `location` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `parking_areas`
--

INSERT INTO `parking_areas` (`id`, `name`, `code`, `capacity`, `available_spaces`, `location`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'LOBBY C', '1220', 150, 149, 'GRAND BATAM LOBBY C', 1, '2026-02-24 23:34:36', '2026-02-25 01:06:07');

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
('B5uutWZLcX27wUjkDNTUKx4kM3gJhQDR9ftTU10h', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNmNBcE8wNjNDSzIzS3VwQnFLWVBnc1prVUlkSzh3M0xGMlZTY0JqciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXR1Z2FzL2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czoxNzoicGV0dWdhcy5kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1772006834);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tariffs`
--

CREATE TABLE `tariffs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price_per_hour` decimal(10,2) NOT NULL,
  `price_per_day` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tariffs`
--

INSERT INTO `tariffs` (`id`, `name`, `price_per_hour`, `price_per_day`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'TARIF GRAND BATAM', 2000.00, 20000.00, 'TARIF GRAND BATAM', 1, '2026-02-24 23:19:56', '2026-02-24 23:57:38'),
(2, 'TARIF GRAND BATAM', 1000.00, 20000.00, 'TARIF GRAND BATAM', 1, '2026-02-24 23:23:21', '2026-02-24 23:23:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `parking_area_id` bigint(20) UNSIGNED NOT NULL,
  `tariff_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_number` varchar(255) NOT NULL,
  `entry_time` datetime NOT NULL,
  `exit_time` datetime DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('parking','completed','cancelled') NOT NULL DEFAULT 'parking',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `vehicle_id`, `parking_area_id`, `tariff_id`, `user_id`, `ticket_number`, `entry_time`, `exit_time`, `total_price`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 2, 3, 'PK-VFUDUX', '2026-02-25 07:11:33', '2026-02-25 07:16:17', 1000.00, 'completed', 'Paid: 2000, Change: 1000', '2026-02-25 00:11:33', '2026-02-25 00:16:17'),
(2, 1, 1, 2, 3, 'PK-XYD7FL', '2026-02-25 08:06:07', NULL, 0.00, 'parking', NULL, '2026-02-25 01:06:07', '2026-02-25 01:06:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','petugas','owner') NOT NULL DEFAULT 'petugas',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin@gmail.com', 'admin', NULL, '$2y$12$ivf3oer7Zc0i0AgrWh5KVez4bZf7tnD0Oq/IVLy4qcpK7hQrW3ldK', NULL, '2026-02-24 22:01:42', '2026-02-24 22:01:42'),
(3, 'Petugas', 'petugas@gmail.com', 'petugas', NULL, '$2y$12$RRs.IWAO7Drw0BO7Yg7hSOLfNM1egtX6MeItfYo1/nK..EDYPoW.W', NULL, '2026-02-24 23:10:36', '2026-02-24 23:10:36'),
(4, 'owner', 'owner@gmail.com', 'owner', NULL, '$2y$12$l2nY7I9z9qnBlHZdCLaFge.Z8eD9zBtAq9PAEqKw78.1PvO8/7Lz.', NULL, '2026-02-24 23:12:53', '2026-02-24 23:12:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plate_number` varchar(255) NOT NULL,
  `type` enum('motor','mobil','truk','sepeda') NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `owner_name` varchar(255) DEFAULT NULL,
  `owner_phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `vehicles`
--

INSERT INTO `vehicles` (`id`, `plate_number`, `type`, `brand`, `color`, `owner_name`, `owner_phone`, `created_at`, `updated_at`) VALUES
(1, 'BP 1029 AC', 'mobil', 'TOYOTA', 'WHITE', 'SS', '089635514488', '2026-02-25 00:01:32', '2026-02-25 00:01:32'),
(2, 'BP 1089 AC', 'mobil', NULL, NULL, NULL, NULL, '2026-02-25 00:11:32', '2026-02-25 00:11:32');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

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
-- Indeks untuk tabel `parking_areas`
--
ALTER TABLE `parking_areas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parking_areas_code_unique` (`code`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `tariffs`
--
ALTER TABLE `tariffs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_ticket_number_unique` (`ticket_number`),
  ADD KEY `transactions_vehicle_id_foreign` (`vehicle_id`),
  ADD KEY `transactions_parking_area_id_foreign` (`parking_area_id`),
  ADD KEY `transactions_tariff_id_foreign` (`tariff_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicles_plate_number_unique` (`plate_number`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `parking_areas`
--
ALTER TABLE `parking_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tariffs`
--
ALTER TABLE `tariffs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_parking_area_id_foreign` FOREIGN KEY (`parking_area_id`) REFERENCES `parking_areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_tariff_id_foreign` FOREIGN KEY (`tariff_id`) REFERENCES `tariffs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
