-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 24 Nov 2023 pada 08.07
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
('596f8002-5608-424d-baac-3dbbbd4e39ed', 'Fashion Pria', '2023-11-18 08:21:40', '2023-11-18 08:21:40'),
('abf33cf9-7e38-4fa9-8e59-9f7c3a057923', 'Fashion Muslim Wanita', '2023-11-18 08:21:51', '2023-11-18 08:21:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_profile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `province_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `username`, `name`, `password`, `phone`, `email`, `address`, `image_profile`, `active_status`, `province_id`, `city_id`, `zip_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
('a3dba310-459f-4bbe-80b9-bc6ad008a714', 'septi', 'Septi Anna Sholikhah', '$2y$10$ptHLHPrOrIV5rC/9V0f6RuUTZdEuDusNlVpQ1VLNOcN42a.PAqXvK', '0898412331', 'septi@email.com', NULL, 'default.png', 'active', NULL, NULL, '', '2023-11-22 09:43:12', '2023-11-22 09:44:01', NULL),
('ece9fc42-1ba5-4660-bf30-9cd5cb180e64', 'siska', 'Siska Endah Pramesti', '$2y$10$1jWCh91VS2PnkSitxNVc9u7tE5B2xG3SSuR78SiVF/TnI0fc0cy0C', '08123984734', 'siska@email.com', 'Pemalang', 'siska-1700662756.jpg', 'active', '10', '477', '97714', '2023-11-18 11:55:41', '2023-11-22 22:08:31', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_13_053136_create_customers_table', 1),
(6, '2023_11_13_055143_create_products_table', 1),
(7, '2023_11_13_060314_create_categories_table', 1),
(8, '2023_11_13_060455_create_transactions_table', 1),
(10, '2023_11_13_062255_create_product_category_table', 2),
(11, '2023_11_13_063541_add_customer_id_and_product_id_column_to_transactions_table', 3),
(12, '2023_11_16_135826_create_roles_table', 4),
(13, '2023_11_16_140040_add_role_id_column_to_users_table', 4),
(16, '2023_11_21_082526_create_sizes_table', 5),
(17, '2023_11_21_082647_create_product_size_table', 5),
(18, '2023_11_23_052243_create_trasanction_details_table', 6),
(19, '2023_11_23_070633_create_product_transaction_table', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `weight` int NOT NULL,
  `stock` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status_stock` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'out of stock',
  `status_product` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpublished',
  `image_product1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_product2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_product3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `product_code`, `product_name`, `price`, `description`, `weight`, `stock`, `status_stock`, `status_product`, `image_product1`, `image_product2`, `image_product3`, `created_at`, `updated_at`) VALUES
('0468a17e-b471-46c6-8d48-6a45d1b0b588', 'GYBRBKIQ', 'AM - Kimia Long Tunik LD100-120 / Tunik Wanita Panjang Belah sampingd', '55000', '🏆Tunik Kaos Knit 🏆\r\n\r\n \r\nTersedia 3 Ukuran:   \r\n\r\n \r\n✅ Ukuran L        \r\n\r\n- LD 100      \r\n- Rekomen BB 45-69 kilo (Perkiraan)        \r\n- Panjang Tangan 55 cm       \r\n- Lingkar Ketiak 42 cm\r\n- Lingkar Lengan 40 cm - 50 cm\r\n\r\n\r\n✅ Ukuran XL        \r\n\r\n- LD 110       \r\n- Rekomen BB 70-85 kilo (Perkiraan)        \r\n- Panjang Tangan 57 cm\r\n- Lingkar Ketiak 43 cm       \r\n- Lingkar Lengan 42cm - 52cm\r\n\r\n\r\n✅ Ukuran XXL\r\n\r\n- LD 120\r\n- Rekomen BB 86-95 kilo (Perkiraan)\r\n- Panjang Tangan 59 cm\r\n- Lingkar Ketiak 45 cm\r\n- Lingkar Lengan 45cm - 54cm\r\n\r\n \r\n✅ Ujung Tangan Karet       \r\n\r\n✅ Lengan Semi Balon         \r\n\r\n✅ Panjang Tunik 115cm', 1000, '3', 'in stock', 'published', 'TPKXGyZ0amh0nZ3YmaCw-1700578140.jpeg', 'YahlA041LYSg0pcCQavE-1700578140.jpeg', 'Z4rxusnKMjgg8Im4bAgl-1700578141.jpeg', '2023-11-18 08:23:32', '2023-11-22 13:36:17'),
('9bf9906a-3f1a-4a91-b3ec-a4f5fa3be4a1', 'JOJOPOUC', 'Heaven Lights Zariya Series Zeeya Blouse - Cinnamon ( Atasan Muslim )', '259900', 'Buat gaya harian kamu lebih stunning dari biasanya dengan Zeeya Blouse. Koleksi printed blouse eksklusif yang memadukan ornament pleats kontras dengan sentuhan warna elegan dan desain chic. Materialnya sangat ringan, tidak panas, dan nyaman dikenakan untuk menemani setiap aktivitas. Material kombinasi cotton and silk dengan digital print.\r\n\r\nSIZE CHART:\r\n\r\n\r\nLingkar Dada: XS=92cm | S=96cm | M=104cm | L=108cm | XL=112cm | XXL=116cm\r\nPanjang Badan: XS=70cm | S=72cm | M=75cm | L=77cm | XL=79cm | XXL=80cm\r\nPanjang Lengan: XS=56cm |  S=56cm |  M= 57cm |  L= 57cm | XL=58cm | XXL=58cm', 700, '5', 'in stock', 'published', '2mYu6botPiYd4125RcBz-1700578159.jpg', 'default_product.jpg', 'default_product.jpg', '2023-11-18 08:22:51', '2023-11-22 13:36:27'),
('a9589f40-bb13-48f8-a313-f57508add719', 'ENHXJCUK', 'Hoodie cowok distro gambar depan blakang kekinian 2023 akazoo TODAYS KOMITMEN', '72500', 'ukuran :\r\n\r\nM : ( Panjang 75cm - Lebar 56 cm - \r\n\r\nL : ( Panjang 77 cm - Lebar 57 cm - \r\n\r\nXL : ( Panjang 78 cm - Lebar 60 cm - \r\n\r\nXXL;(Panjang 80 cm-Lebar 64 cm\r\n\r\n\r\nREADY STOCK .....!!!!\r\n\r\nLangsung Order yah kak :)\r\n\r\nJadi ngga perlu kakak bertanya Ready atau tidak nya\r\n\r\n•	Disarankan memilih size lebih besar dr size yg biasa dipakai, karena produk kami memakai pola size lokal.\r\n\r\n•	Tidak perlu menanyakan resi, karna kami menggunakan resi otomatis. Utk mengetahui resi, silahkan cek secara berkala pada pesanan anda setelah pukul 23:00 WIB.\r\n\r\n. tali nya sewaktu2 bisa random kaka ya... mohon pengertian nya trimakasi\r\n\r\nCARA PESAN :\r\n\r\nSilahkan Via lazada\r\n\r\n\r\nBukan Reseller dan Dropship\r\n\r\n• Pesan di Hari Kerja langsung di kirim di hari yang sama\r\n\r\n• Tangan Pertama\r\n\r\n\r\nKelebihan Belanja di sini :\r\n\r\n- Respon cepat\r\n\r\n- Pelayanan cepat\r\n\r\n- Pengiriman tepat\r\n\r\n- Harga dan product kami 100% Baru dan BERGARANSI ( barang2 tertentu )\r\n\r\nYang Pastinya AMANAH\r\n\r\n- 100% Real Pict \r\n\r\n\r\nPENGIRIMAN :\r\n\r\n• Batas Order Jam 16.00 ( Di kirim hari yang sama )\r\n\r\nLewat dari jam 16.00 akan di kirim esok hari nya\r\n\r\n\r\nNOTE :\r\n\r\n\r\n• Pastikan menulis warna dan ukuran yang akan di pesan di kolom keterangan\r\n\r\n• Pelisih warna dari fato sekitar 0-1% pengaruh kamera,pencahayaan,dan setingan komputer/handphone masing-masing\r\n\r\n• APABILA MAU MELIHAT MODEL LAIN SILAHKAN SAJA MASUK KE DAFTAR PRODUK KAMI DI ETALASE PRODUK , BARANG YANG MASIH TERCANTUM DI LAPAK KAMI BERARTI MASIH TERSEDIA,\r\n\r\n• JANGAN LUPA FOLLOW DAN JADIKAN TOKO FAVORITE ANDA , AGAR DAPAT CEK SELALU BARANG TERUPDATE DARI TOKO KAMI :)\r\n\r\n• MOHON KERJASAMANYA UNTUK MEMBERIKAN ULASAN *****5 & KONFIRMASI PENERIMAAN BARANG \r\n\r\n\r\nKepuasan Pelanggan Kebahagiaan Bagi Kami..\r\n\r\nSelamat Berbelanja\r\n\r\nTerima Kasih :)', 1500, '15', 'in stock', 'published', 'oYCi5TlDjTCFZn6RR110-1700578190.jpg', '3fLLA7XJ6r7XSXdx034d-1700578190.jpg', 'TbqWX1usH22fYjFtXimO-1700578190.jpg', '2023-11-18 23:54:02', '2023-11-22 13:36:34'),
('c284ae5f-3962-4ae7-bd85-0f6bcd05fd87', '4FBIMPWJ', 'iNI CONTOH PRODUK', '12000', 'Ini desc', 0, '0', 'out of stock', 'unpublished', 'n0IdMwAZCUXJgAddaqLq-1700577916.jpeg', 'default_product.jpg', 'default_product.jpg', '2023-11-21 02:15:16', '2023-11-21 07:45:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_category`
--

CREATE TABLE `product_category` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_category`
--

INSERT INTO `product_category` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, '9bf9906a-3f1a-4a91-b3ec-a4f5fa3be4a1', 'abf33cf9-7e38-4fa9-8e59-9f7c3a057923', NULL, NULL),
(2, '0468a17e-b471-46c6-8d48-6a45d1b0b588', 'abf33cf9-7e38-4fa9-8e59-9f7c3a057923', NULL, NULL),
(8, 'a9589f40-bb13-48f8-a313-f57508add719', '596f8002-5608-424d-baac-3dbbbd4e39ed', NULL, NULL),
(10, 'c284ae5f-3962-4ae7-bd85-0f6bcd05fd87', '596f8002-5608-424d-baac-3dbbbd4e39ed', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_size`
--

CREATE TABLE `product_size` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_size`
--

INSERT INTO `product_size` (`id`, `product_id`, `size_id`, `created_at`, `updated_at`) VALUES
(1, '9bf9906a-3f1a-4a91-b3ec-a4f5fa3be4a1', 3, '2023-11-21 09:13:25', '2023-11-21 09:13:25'),
(2, '9bf9906a-3f1a-4a91-b3ec-a4f5fa3be4a1', 4, '2023-11-21 09:13:25', '2023-11-21 09:13:25'),
(3, 'c284ae5f-3962-4ae7-bd85-0f6bcd05fd87', 1, NULL, NULL),
(4, 'c284ae5f-3962-4ae7-bd85-0f6bcd05fd87', 4, NULL, NULL),
(7, '0468a17e-b471-46c6-8d48-6a45d1b0b588', 4, NULL, NULL),
(8, '0468a17e-b471-46c6-8d48-6a45d1b0b588', 5, NULL, NULL),
(9, '0468a17e-b471-46c6-8d48-6a45d1b0b588', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_transaction`
--

CREATE TABLE `product_transaction` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `role_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2023-11-16 14:03:00', '2023-11-16 14:03:00'),
(2, 'staff', '2023-11-16 14:03:00', '2023-11-16 14:03:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint UNSIGNED NOT NULL,
  `size_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sizes`
--

INSERT INTO `sizes` (`id`, `size_name`, `created_at`, `updated_at`) VALUES
(1, 'XS', NULL, NULL),
(2, 'S', NULL, NULL),
(3, 'M', NULL, NULL),
(4, 'L', NULL, NULL),
(5, 'XL', NULL, NULL),
(6, 'XXL', NULL, NULL),
(7, 'XXXL', NULL, NULL),
(8, 'ALLSIZE', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipient_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total_price` int DEFAULT NULL,
  `order_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_code` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trasanction_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_time` datetime DEFAULT NULL,
  `bank` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `va_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_profile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `phone`, `email`, `address`, `image_profile`, `active_status`, `role_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('5b08106a-8654-11ee-a14b-1831bf849076', 'admin', 'Administrator', '$2y$10$QMiW7/L7w.aKHacKZrsGk.WYrgzphNPcEqsFscB.JLmoJTa2f2F1e', '08123456789', 'admin@email.com', '-', 'default.png', 'active', 1, '2023-11-18 20:51:23', '2023-11-18 20:51:23', NULL),
('c3361cee-2231-4f8b-bf47-f11442781b9b', 'roi', 'Roihatul Jannah', '$2y$10$24p5xruiVrUoWvKKeE45XudBpWLYBMP5qzGd9LhqWqTMO13YP6KUW', '08123987465', 'roihatuljannah2704@gmail.com', 'Pangkalan Buun', 'roi-1700662134.jpg', 'active', 2, '2023-11-17 06:57:01', '2023-11-22 07:08:54', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_username_unique` (`username`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_product_code_unique` (`product_code`);

--
-- Indeks untuk tabel `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_category_id_foreign` (`category_id`),
  ADD KEY `product_category_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_size_size_id_foreign` (`size_id`),
  ADD KEY `product_size_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `product_transaction`
--
ALTER TABLE `product_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_transaction_transaction_id_foreign` (`transaction_id`),
  ADD KEY `product_transaction_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_customer_id_foreign` (`customer_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `product_transaction`
--
ALTER TABLE `product_transaction`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_category_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `product_size_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `product_transaction`
--
ALTER TABLE `product_transaction`
  ADD CONSTRAINT `product_transaction_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_transaction_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
