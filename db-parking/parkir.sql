-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Des 2025 pada 10.17
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
-- Database: `parkir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `company`
--

INSERT INTO `company` (`id`, `name`, `address`, `message`, `currency`) VALUES
(1, 'Mall Afsal', 'Jln Raya Ciracas Gg Bangi 1', 'Thank your purchase please come back soon', 'IDR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `permission`) VALUES
(1, 'Super Administrator', 'a:28:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:14:\"createCategory\";i:9;s:14:\"updateCategory\";i:10;s:12:\"viewCategory\";i:11;s:14:\"deleteCategory\";i:12;s:11:\"createRates\";i:13;s:11:\"updateRates\";i:14;s:9:\"viewRates\";i:15;s:11:\"deleteRates\";i:16;s:11:\"createSlots\";i:17;s:11:\"updateSlots\";i:18;s:9:\"viewSlots\";i:19;s:11:\"deleteSlots\";i:20;s:13:\"createParking\";i:21;s:13:\"updateParking\";i:22;s:11:\"viewParking\";i:23;s:13:\"deleteParking\";i:24;s:13:\"updateCompany\";i:25;s:13:\"updateSetting\";i:26;s:11:\"viewReports\";i:27;s:11:\"viewProfile\";}'),
(5, 'Staff', 'a:7:{i:0;s:12:\"viewCategory\";i:1;s:9:\"viewRates\";i:2;s:9:\"viewSlots\";i:3;s:13:\"createParking\";i:4;s:13:\"updateParking\";i:5;s:11:\"viewParking\";i:6;s:11:\"viewReports\";}'),
(6, 'Kang parkir', 'a:7:{i:0;s:11:\"updateSlots\";i:1;s:9:\"viewSlots\";i:2;s:13:\"updateParking\";i:3;s:11:\"viewParking\";i:4;s:13:\"updateReports\";i:5;s:11:\"viewReports\";i:6;s:11:\"viewProfile\";}'),
(7, 'CEO', 'a:22:{i:0;s:8:\"viewUser\";i:1;s:9:\"viewGroup\";i:2;s:14:\"createCategory\";i:3;s:14:\"updateCategory\";i:4;s:12:\"viewCategory\";i:5;s:14:\"deleteCategory\";i:6;s:11:\"createRates\";i:7;s:11:\"updateRates\";i:8;s:9:\"viewRates\";i:9;s:11:\"deleteRates\";i:10;s:11:\"createSlots\";i:11;s:11:\"updateSlots\";i:12;s:9:\"viewSlots\";i:13;s:11:\"deleteSlots\";i:14;s:13:\"createParking\";i:15;s:13:\"updateParking\";i:16;s:11:\"viewParking\";i:17;s:13:\"deleteParking\";i:18;s:13:\"updateCompany\";i:19;s:13:\"updateSetting\";i:20;s:11:\"viewReports\";i:21;s:11:\"viewProfile\";}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `parking`
--

CREATE TABLE `parking` (
  `id` int(11) NOT NULL,
  `parking_code` varchar(255) NOT NULL,
  `vechile_cat_id` int(11) NOT NULL,
  `rate_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL,
  `plate_number` text NOT NULL,
  `in_time` varchar(255) NOT NULL,
  `out_time` varchar(255) NOT NULL,
  `total_time` varchar(255) NOT NULL,
  `earned_amount` varchar(255) NOT NULL,
  `paid_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `parking`
--

INSERT INTO `parking` (`id`, `parking_code`, `vechile_cat_id`, `rate_id`, `slot_id`, `plate_number`, `in_time`, `out_time`, `total_time`, `earned_amount`, `paid_status`) VALUES
(3, 'PA-D8E1FD', 2, 1, 1, 'B 4534 TKJ', '1764940441', '1765029780', '25', '75000', 1),
(4, 'PA-FDDC51', 2, 1, 1, 'B 2345 TT', '1764940759', '1765029765', '25', '75000', 1),
(5, 'PA-6FD7B5', 1, 2, 3, 'RI 1', '1764941122', '1764945375', '2', '100000', 1),
(6, 'PA-6C3E5B', 1, 5, 1, 'B 1703 JIA', '1764941180', '1765029752', '25', '100000', 1),
(7, 'PA-92A4DD', 1, 7, 5, 'B 3112 SAL', '1764944590', '1765029742', '24', '0', 1),
(8, 'PA-EB772F', 2, 8, 6, 'B 3119 SAL', '1764944634', '1765029733', '24', '0', 1),
(9, 'PA-B3098A', 1, 2, 3, 'RI 2', '1764944660', '1764945355', '1', '50000', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rate`
--

CREATE TABLE `rate` (
  `id` int(11) NOT NULL,
  `rate_name` varchar(255) NOT NULL,
  `vechile_cat_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `rate`
--

INSERT INTO `rate` (`id`, `rate_name`, `vechile_cat_id`, `type`, `rate`, `active`) VALUES
(1, 'parkir motor pengunjung', 2, 2, '3000', 1),
(2, 'VIP Mobil', 1, 2, '50000', 1),
(3, 'VIP Motor', 2, 2, '25000', 1),
(4, 'parkir mobil pengunjung', 1, 2, '5000', 1),
(5, 'parkir langganan mobil', 1, 1, '100000', 1),
(6, 'parkir langganan motor', 2, 1, '50000', 1),
(7, 'parkir mobil ceo', 1, 1, '0', 1),
(8, 'parkir motor ceo', 2, 1, '0', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `slots`
--

CREATE TABLE `slots` (
  `id` int(11) NOT NULL,
  `slot_name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `availability_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `slots`
--

INSERT INTO `slots` (`id`, `slot_name`, `active`, `availability_status`) VALUES
(1, 'Pengunjung', 1, 1),
(2, 'Staff', 1, 1),
(3, 'VIP Mobil', 1, 1),
(4, 'VIP Motor', 1, 1),
(5, 'CEO Mobil', 1, 1),
(6, 'CEO Motor', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `phone`, `gender`) VALUES
(1, 'admin', '$2y$10$xJxVCtsqxYCREfRAlSqzne/zUrNaK0r0vXcRq3iei/sGR7wBX03TW', 'admin@admin.com', 'Afsal', 'Maulana', '80789998', 1),
(4, 'afsal312', '$2y$10$OAqh8IlQS2sokjj0oeGWgec.ZJDC9rQCxYqfj65DYgNvWjQQ9ovZ2', 'afsal123@test.com', 'Afsal', 'Maulana', '08123456789', 1),
(5, 'arfa312', '$2y$10$LuF9B2ldlScdKtHSeuuUfOc/3tEbMSG.f5U5tTHsu/nvGOfjGvxPm', 'arfa@arfa.id', 'arfa', 'maulidza', '085694408183', 1),
(6, 'sandhi123', '$2y$10$CNnKZ6e7zvAjj/8/PGZW7Ov8JhIKrOMi85gvBSFChf1A2tyZK/deC', 'sandhi@test.com', 'Sandhi', 'Khadafi', '0812345679', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(3, 2, 4),
(4, 3, 4),
(5, 4, 7),
(6, 5, 6),
(7, 6, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `vechile_category`
--

CREATE TABLE `vechile_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `vechile_category`
--

INSERT INTO `vechile_category` (`id`, `name`, `active`) VALUES
(1, 'Mobil', 1),
(2, 'Motor', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `vechile_category`
--
ALTER TABLE `vechile_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `parking`
--
ALTER TABLE `parking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `rate`
--
ALTER TABLE `rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `slots`
--
ALTER TABLE `slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `vechile_category`
--
ALTER TABLE `vechile_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
