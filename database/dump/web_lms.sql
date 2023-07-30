-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 29 Jul 2023 pada 15.38
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
-- Database: `web_lms`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `file` longtext DEFAULT NULL,
  `main_image` longtext NOT NULL,
  `sneek_peek_1` longtext DEFAULT NULL,
  `sneek_peek_2` longtext DEFAULT NULL,
  `sneek_peek_3` longtext DEFAULT NULL,
  `sneek_peek_4` longtext DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `request_status` int(11) NOT NULL DEFAULT 0,
  `upload_status` int(11) NOT NULL DEFAULT 0,
  `activation_status` int(11) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `courses`
--

INSERT INTO `courses` (`id`, `category_id`, `title`, `short_description`, `description`, `file`, `main_image`, `sneek_peek_1`, `sneek_peek_2`, `sneek_peek_3`, `sneek_peek_4`, `price`, `request_status`, `upload_status`, `activation_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(23, 1, 'Update judul', '<p>sdfs;ldfkl;k</p>', '<p>sfdlkssjldkjskldjlksdjlkfjklsdjlkjfds</p>', NULL, '64c49ef1ddd9a.jpg', '64c49ef1dde31.jpg', '64c49ef1dde8e.jpg', '64c49ef1ddee1.jpg', '64c4e127abda9.jpg', '69', 0, 0, 1, 1, NULL, '2023-07-29 05:09:05', '2023-07-29 09:54:37'),
(24, 2, 'Iure do dolor volupt', '<p>sklmflkdsmflksjlk</p>', '<p>lkdfjlkgjdflkjlkjlkjlkfdsklkldfgjlkdflkfkldjlkfgjlkdjfgl</p>', NULL, '64c4ed85b882d.jpg', '64c4e2b419be5.jpg', '64c4e2b419c6e.jpg', '64c4e2b419ced.jpg', '64c4e2b419d6f.jpg', '18', 0, 0, 1, 1, NULL, '2023-07-29 09:58:12', '2023-07-29 10:44:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `course_authors`
--

CREATE TABLE `course_authors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `course_benefits`
--

CREATE TABLE `course_benefits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `course_benefits`
--

INSERT INTO `course_benefits` (`id`, `course_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(49, 23, 'Non deserunt nostrum', 'Ratione sint omnis d', '2023-07-29 09:54:37', '2023-07-29 09:54:37'),
(50, 23, 'Laborum facilis eius', 'Reprehenderit ipsum', '2023-07-29 09:54:37', '2023-07-29 09:54:37'),
(51, 23, 'Veniam quia asperio', 'Obcaecati voluptate ', '2023-07-29 09:54:37', '2023-07-29 09:54:37'),
(52, 23, 'Minus autem voluptas', 'Deserunt corporis es', '2023-07-29 09:54:37', '2023-07-29 09:54:37'),
(57, 24, 'Sed id voluptatem V', 'Aut sapiente repelle', '2023-07-29 10:44:21', '2023-07-29 10:44:21'),
(58, 24, 'Consequat Elit pos', 'Omnis dolorem sit e', '2023-07-29 10:44:21', '2023-07-29 10:44:21'),
(59, 24, 'Voluptate qui eu eu ', 'Ratione nisi quis eu', '2023-07-29 10:44:21', '2023-07-29 10:44:21'),
(60, 24, 'Nihil non soluta rer', 'Delectus nulla ut e', '2023-07-29 10:44:21', '2023-07-29 10:44:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `course_categories`
--

CREATE TABLE `course_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `course_categories`
--

INSERT INTO `course_categories` (`id`, `icon`, `name`, `created_at`, `updated_at`) VALUES
(1, '<ion-icon name=\"settings-outline\"></ion-icon>', 'Mesin', '2023-07-28 23:45:32', '2023-07-28 23:45:32'),
(2, '<ion-icon name=\"accessibility-outline\"></ion-icon>', 'UI/UX', '2023-07-28 23:46:09', '2023-07-28 23:46:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `course_chapters`
--

CREATE TABLE `course_chapters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `course_objectives`
--

CREATE TABLE `course_objectives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `course_objectives`
--

INSERT INTO `course_objectives` (`id`, `course_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(13, 23, 'tujuan update', 'sdklfjslkjfklsjdlfjsdakljfklsjdfkljsdklfjlksjdlkfslkjfdklsjdklfjlskdjklsjkldjfklsdjklfjsdkljfklsdjlfksjkldfjkl', '2023-07-29 09:54:37', '2023-07-29 09:54:37'),
(14, 23, 'teroeropteirtpoi', 'dlfglkdfl;gdlkjflgdjk', '2023-07-29 09:54:37', '2023-07-29 09:54:37'),
(19, 24, 'Quaerat tempora odit', 'Dolores eligendi eni', '2023-07-29 10:44:21', '2023-07-29 10:44:21'),
(20, 24, 'Qui asperiores magna', 'Aliquam saepe sit d', '2023-07-29 10:44:21', '2023-07-29 10:44:21'),
(21, 24, 'Eos facere ab duis d', 'Animi dolores debit', '2023-07-29 10:44:21', '2023-07-29 10:44:21'),
(22, 24, 'Voluptates quisquam ', 'Quia omnis dolore in', '2023-07-29 10:44:21', '2023-07-29 10:44:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `course_sub_chapters`
--

CREATE TABLE `course_sub_chapters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_chapter_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `file` longtext DEFAULT NULL,
  `video` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `course_tech_specs`
--

CREATE TABLE `course_tech_specs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `course_tech_specs`
--

INSERT INTO `course_tech_specs` (`id`, `course_id`, `name`, `created_at`, `updated_at`) VALUES
(85, 23, 'Magni duis sed et si', '2023-07-29 09:54:37', '2023-07-29 09:54:37'),
(86, 23, 'Qui dignissimos temp', '2023-07-29 09:54:37', '2023-07-29 09:54:37'),
(90, 24, 'Perspiciatis Nam in', '2023-07-29 10:44:21', '2023-07-29 10:44:21'),
(91, 24, 'Provident et nesciu', '2023-07-29 10:44:21', '2023-07-29 10:44:21'),
(92, 24, 'Voluptate ut et repe', '2023-07-29 10:44:21', '2023-07-29 10:44:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transactions`
--

CREATE TABLE `detail_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_month` int(11) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `total_payment` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_07_27_020839_create_course_categories_table', 1),
(6, '2023_07_27_021003_create_courses_table', 1),
(7, '2023_07_27_022623_add_foreign_key_to_course_table', 1),
(8, '2023_07_27_023506_create_course_tech_specs_table', 1),
(9, '2023_07_27_023637_create_course_benefits_table', 1),
(10, '2023_07_27_023751_create_course_authors_table', 1),
(11, '2023_07_27_023914_create_min_course_purchase_at_reg_table', 1),
(12, '2023_07_27_051738_create_transactions_table', 1),
(13, '2023_07_27_061633_create_detail_transactions_table', 1),
(14, '2023_07_27_061934_create_rented_course_table', 1),
(15, '2023_07_27_103042_create_course_chapters_table', 1),
(16, '2023_07_27_103230_create_course_sub_chapters_table', 1),
(17, '2023_07_27_103400_create_quizzes_table', 1),
(18, '2023_07_27_103650_create_questions_table', 1),
(19, '2023_07_27_103808_create_user_quiz_attempts_table', 1),
(20, '2023_07_27_103947_create_user_course_access_logs_table', 1),
(21, '2023_07_29_160338_create_course_objectives_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `min_course_purchase_at_reg`
--

CREATE TABLE `min_course_purchase_at_reg` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) DEFAULT NULL,
  `option_d` varchar(255) DEFAULT NULL,
  `answer` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_chapter_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rented_course`
--

CREATE TABLE `rented_course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detail_transaction_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `rental_status` int(11) NOT NULL,
  `expired_date` date NOT NULL,
  `renewal_date` date NOT NULL,
  `renewal_fee` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_code` longtext NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `total_payment` varchar(255) NOT NULL,
  `status_order` int(11) NOT NULL DEFAULT 0,
  `status_payment` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('L','P') DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `avatar` longtext DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_verificator` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `email_verified_at`, `password`, `gender`, `birthday`, `avatar`, `phone`, `job`, `institution`, `role`, `status`, `is_verificator`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@mail.com', NULL, '$2y$10$SMLXgspEU0p9vzumUELBYO5abMdRG0a065Kg8ofcKdGsqSNsLQ.zW', 'L', '2023-07-29', '1690635371.jpg', '081515144981', 'Mahasiswa', 'Politeknik Negeri Jember', 1, 1, NULL, NULL, NULL, '2023-07-29 12:56:11'),
(2, 'andi saputra', 'andi@mail.com', NULL, '$2y$10$zie878dvuXoYQ3u592WP1.fhndQMZVq8Bl6r1HOz/ef0J5.c9N5gW', 'L', '2023-07-29', NULL, NULL, NULL, NULL, 4, 1, 1, NULL, NULL, '2023-07-28 23:38:27'),
(3, 'budi santoso', 'budi@mail.com', NULL, '$2y$10$N2SnkI94to6jaT0SUAqA2uu7Lz5ILS1xhGfilEGbrRcDIFb30JXIy', 'L', '2023-07-29', NULL, NULL, NULL, NULL, 4, 1, 1, NULL, NULL, '2023-07-28 23:31:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_course_access_logs`
--

CREATE TABLE `user_course_access_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_chapter_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_sub_chapter_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_quiz_attempts`
--

CREATE TABLE `user_quiz_attempts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `count_correct` int(11) NOT NULL DEFAULT 0,
  `count_incorrect` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_category_id_foreign` (`category_id`),
  ADD KEY `courses_created_by_foreign` (`created_by`),
  ADD KEY `courses_updated_by_foreign` (`updated_by`);

--
-- Indeks untuk tabel `course_authors`
--
ALTER TABLE `course_authors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_authors_course_id_foreign` (`course_id`),
  ADD KEY `course_authors_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `course_benefits`
--
ALTER TABLE `course_benefits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_benefits_course_id_foreign` (`course_id`);

--
-- Indeks untuk tabel `course_categories`
--
ALTER TABLE `course_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `course_chapters`
--
ALTER TABLE `course_chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_chapters_course_id_foreign` (`course_id`);

--
-- Indeks untuk tabel `course_objectives`
--
ALTER TABLE `course_objectives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_objectives_course_id_foreign` (`course_id`);

--
-- Indeks untuk tabel `course_sub_chapters`
--
ALTER TABLE `course_sub_chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_sub_chapters_course_chapter_id_foreign` (`course_chapter_id`);

--
-- Indeks untuk tabel `course_tech_specs`
--
ALTER TABLE `course_tech_specs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_tech_specs_course_id_foreign` (`course_id`);

--
-- Indeks untuk tabel `detail_transactions`
--
ALTER TABLE `detail_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_transactions_transaction_id_foreign` (`transaction_id`),
  ADD KEY `detail_transactions_course_id_foreign` (`course_id`);

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
-- Indeks untuk tabel `min_course_purchase_at_reg`
--
ALTER TABLE `min_course_purchase_at_reg`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_quiz_id_foreign` (`quiz_id`);

--
-- Indeks untuk tabel `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quizzes_course_chapter_id_foreign` (`course_chapter_id`);

--
-- Indeks untuk tabel `rented_course`
--
ALTER TABLE `rented_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rented_course_detail_transaction_id_foreign` (`detail_transaction_id`),
  ADD KEY `rented_course_customer_id_foreign` (`customer_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `user_course_access_logs`
--
ALTER TABLE `user_course_access_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_course_access_logs_user_id_foreign` (`user_id`),
  ADD KEY `user_course_access_logs_course_id_foreign` (`course_id`),
  ADD KEY `user_course_access_logs_course_chapter_id_foreign` (`course_chapter_id`),
  ADD KEY `user_course_access_logs_course_sub_chapter_id_foreign` (`course_sub_chapter_id`);

--
-- Indeks untuk tabel `user_quiz_attempts`
--
ALTER TABLE `user_quiz_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_quiz_attempts_user_id_foreign` (`user_id`),
  ADD KEY `user_quiz_attempts_quiz_id_foreign` (`quiz_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `course_authors`
--
ALTER TABLE `course_authors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `course_benefits`
--
ALTER TABLE `course_benefits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `course_categories`
--
ALTER TABLE `course_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `course_chapters`
--
ALTER TABLE `course_chapters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `course_objectives`
--
ALTER TABLE `course_objectives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `course_sub_chapters`
--
ALTER TABLE `course_sub_chapters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `course_tech_specs`
--
ALTER TABLE `course_tech_specs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT untuk tabel `detail_transactions`
--
ALTER TABLE `detail_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `min_course_purchase_at_reg`
--
ALTER TABLE `min_course_purchase_at_reg`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rented_course`
--
ALTER TABLE `rented_course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_course_access_logs`
--
ALTER TABLE `user_course_access_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_quiz_attempts`
--
ALTER TABLE `user_quiz_attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `course_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `course_authors`
--
ALTER TABLE `course_authors`
  ADD CONSTRAINT `course_authors_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_authors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `course_benefits`
--
ALTER TABLE `course_benefits`
  ADD CONSTRAINT `course_benefits_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `course_chapters`
--
ALTER TABLE `course_chapters`
  ADD CONSTRAINT `course_chapters_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Ketidakleluasaan untuk tabel `course_objectives`
--
ALTER TABLE `course_objectives`
  ADD CONSTRAINT `course_objectives_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `course_sub_chapters`
--
ALTER TABLE `course_sub_chapters`
  ADD CONSTRAINT `course_sub_chapters_course_chapter_id_foreign` FOREIGN KEY (`course_chapter_id`) REFERENCES `course_chapters` (`id`);

--
-- Ketidakleluasaan untuk tabel `course_tech_specs`
--
ALTER TABLE `course_tech_specs`
  ADD CONSTRAINT `course_tech_specs_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_transactions`
--
ALTER TABLE `detail_transactions`
  ADD CONSTRAINT `detail_transactions_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `detail_transactions_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);

--
-- Ketidakleluasaan untuk tabel `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);

--
-- Ketidakleluasaan untuk tabel `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_course_chapter_id_foreign` FOREIGN KEY (`course_chapter_id`) REFERENCES `course_chapters` (`id`);

--
-- Ketidakleluasaan untuk tabel `rented_course`
--
ALTER TABLE `rented_course`
  ADD CONSTRAINT `rented_course_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `rented_course_detail_transaction_id_foreign` FOREIGN KEY (`detail_transaction_id`) REFERENCES `detail_transactions` (`id`);

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `user_course_access_logs`
--
ALTER TABLE `user_course_access_logs`
  ADD CONSTRAINT `user_course_access_logs_course_chapter_id_foreign` FOREIGN KEY (`course_chapter_id`) REFERENCES `course_chapters` (`id`),
  ADD CONSTRAINT `user_course_access_logs_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `user_course_access_logs_course_sub_chapter_id_foreign` FOREIGN KEY (`course_sub_chapter_id`) REFERENCES `course_sub_chapters` (`id`),
  ADD CONSTRAINT `user_course_access_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `user_quiz_attempts`
--
ALTER TABLE `user_quiz_attempts`
  ADD CONSTRAINT `user_quiz_attempts_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`),
  ADD CONSTRAINT `user_quiz_attempts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;