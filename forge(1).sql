-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25 Feb 2020 pada 13.03
-- Versi Server: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forge`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `article`
--

CREATE TABLE `article` (
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `article_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_status` tinyint(1) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `article`
--

INSERT INTO `article` (`article_id`, `article_title`, `article_description`, `article_status`, `category_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`, `file`, `date_created`) VALUES
(7, 'Title 3', 'Presiden Jokowi dan Presiden Singapura Halimah Yacob membahas sejumlah kerja sama di bidang pendidikan dan penelitian. Salah satunya yakni, kerja sama pelatihan untuk dosen politeknik.\r\n\r\nMelalui program ini, para dosen politeknik Indonesia akan diberikan pelatihan oleh pengajar Singapura. Pemerintah Indonesia dan Singapura siap memfasilitasi program tersebut.', 1, 1, 1, '2020-02-04 10:01:50', '2020-02-14 03:37:14', NULL, '1581383384_Capture.PNG', '2020-02-04'),
(9, 'Title 6', 'Jumlah korban tewas akibat wabah virus corona semakin mendekati angka 500 orang. Lebih dari 25.400 orang terkonfirmasi positif virus corona di lebih dari 20 negara, termasuk China.\r\n\r\nSeperti dilansir media nasional China Global Television Network (CGTN) dan AFP, Rabu (5/2/2020), data terbaru Komisi Kesehatan Nasional China menyebut 490 orang meninggal akibat virus corona di wilayah China daratan. Jumlah korban tewas bertambah setelah ada laporan 65 kematian baru di Provinsi Hubei, pusat wabah ini.', 1, 5, 1, '2020-02-05 08:59:53', '2020-02-06 06:10:50', NULL, NULL, '2020-02-05'),
(11, 'Ciri-Ciri Virus Corona, Pada Penderita Hingga Pencegahannya', 'Ciri-ciri virus corona dari orang yang terinfeksi\r\nUntuk mengantisipasi adanya virus corona di lingkungan sekitar, ada ciri-ciri yang bisa dikenali dari orang yang terinfeksi. Berdasarkan Centers for Disease Control and Prevention (CDC) AS, ciri-cirinya yaitu:\r\n\r\n1. Mempunyai riwayat bepergian ke negara China, terutama kota Wuhan dan sekitarnya.\r\n2. Mengalami demam tinggi\r\n3. Sakit kepala\r\n4. Flu atau pilek\r\n5. Batuk-batuk parah\r\n6. Sesak nafas', 0, 5, 1, '2020-02-07 09:04:41', '2020-02-11 04:39:52', NULL, '1581395992_images.jpg', '2020-02-07'),
(22, 'Daripada-Pulangkan-600-Eks-ISIS,-Lebih-Baik-Lindungi-267-Juta-Orang-Indonesia', '600 WNI berangkat ke Suriah bergabung dengan organisasi teroris ISIS. Mereka perang guna mendirikan negara versi mereka. Setelah ISIS kalah, 600-an WNI anggota teroris itu kini terkatung-katung. Pemerintah tegas menolak memulangkan mereka karena 600-an WNI itu bergabung dengan anggota teroris internasional.\r\n\r\nOleh sebab itu, Prof Hikmahanto Juwana mengapresiasi langkah pemerintah untuk tidak memulangkan 600-an WNI pengikut eks ISIS. Sebab, lebih baik melindungi 267 juta nyawa rakyat Indonesia daripada memulangkan 600-an pengikut teroris.', 0, 3, 1, '2020-02-12 01:22:53', '2020-02-18 02:16:51', NULL, NULL, '2020-02-12'),
(23, 'Test-5-6', 'Description 5', 1, 3, 1, '2020-02-13 03:51:31', '2020-02-18 02:30:46', NULL, '1581663001_green-leafed-plants-2810774.jpg', '2020-02-13'),
(24, 'Test 6', 'Yuhuu', 1, 1, 1, '2020-02-13 03:51:43', '2020-02-14 08:02:25', NULL, NULL, '2020-02-13'),
(28, 'a b c d ', 'efghij', 0, 1, 1, '2020-02-18 01:56:35', '2020-02-19 03:15:45', '2020-02-19 03:15:45', NULL, '2020-02-18'),
(29, 'A-b-c-d-e', 'tests', 0, 1, 1, '2020-02-18 02:11:20', '2020-02-18 02:14:49', NULL, NULL, '2020-02-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Politic', '2020-02-04 06:45:42', '2020-02-04 06:45:42'),
(2, 'Opinion', '2020-02-04 06:45:42', '2020-02-04 06:45:42'),
(3, 'Investigative', '2020-02-04 06:45:42', '2020-02-04 06:45:42'),
(4, 'Kids', '2020-02-04 06:45:42', '2020-02-04 06:45:42'),
(5, 'Health', '2020-02-04 17:00:00', '2020-02-04 17:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_02_04_031721_create_users_table', 1),
(2, '2020_02_04_031947_create_category_table', 1),
(3, '2020_02_04_032039_create_article_table', 1),
(4, '2020_02_05_023012_create_softdelete_article_table', 2),
(5, '2020_02_06_020205_add_role_to_users_table', 3),
(6, '2020_02_07_091523_add_file_to_article_table', 4),
(7, '2020_02_07_091651_add_file_to_article_table', 5),
(8, '2020_02_10_081632_add_datecreated_to_article_table', 6),
(9, '2020_02_20_091452_create_tblinvoice_table', 7),
(10, '2020_02_20_092540_add_notes_column_to_tblinvoice', 8),
(11, '2020_02_20_095251_rename_tblinvoice_table', 9),
(12, '2020_02_20_101802_remove_column_tblinvoice_table', 10),
(13, '2020_02_20_102133_remove_column_tblinvoice', 11),
(14, '2020_02_20_102242_create_tblitems_table', 12),
(15, '2020_02_21_010132_create_client_table', 13),
(16, '2020_02_21_011203_alter_client_table', 14),
(17, '2020_02_21_022410_add_credit_to_client_table', 15),
(18, '2020_02_21_030949_add_status_to_tblclient_table', 16),
(19, '2020_02_21_031330_rename_tax', 17),
(20, '2020_02_21_033649_remove_language_from_tblclient_table', 18),
(21, '2020_02_21_034104_alter_tblclient_table', 19),
(22, '2020_02_21_034545_change_fieldtype_currency', 20),
(23, '2020_02_24_015839_add_datepaid_to_tblinvoice_table', 21),
(24, '2020_02_24_021059_rename_column_datepaid_tblinvoice_table', 22),
(25, '2020_02_24_021641_change_column_tblinvoice_tabel', 23),
(26, '2020_02_25_020921_add_published_at_to_tblinvoice_table', 24),
(27, '2020_02_25_025844_create_tblcredit_table', 25),
(28, '2020_02_25_030721_alter_tblcredit_table', 26),
(29, '2020_02_25_031110_alter_tblcredit_table2', 27),
(30, '2020_02_25_031311_alter_tblcredit_table3', 28),
(31, '2020_02_25_044335_add_invoiceid_to_tblcredit_table', 29),
(32, '2020_02_25_070344_create_tblpayment_table', 30),
(33, '2020_02_25_074753_add_method_to_tblpayment_table', 31),
(34, '2020_02_25_075359_add_createdat_to_tblpayment_table', 32);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblclient`
--

CREATE TABLE `tblclient` (
  `clientid` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `companyname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymentmethod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `credit` double(8,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `adminid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tblclient`
--

INSERT INTO `tblclient` (`clientid`, `firstname`, `lastname`, `companyname`, `email`, `address`, `city`, `postcode`, `country`, `phonenumber`, `paymentmethod`, `password`, `notes`, `currency`, `created_at`, `updated_at`, `credit`, `status`, `date`, `adminid`) VALUES
(1, 'Ahmad', 'Ghazali', NULL, 'ghazali@gmail.com', 'Simolawang 6 No. 20A', 'Surabaya', '60143', 'Indonesia', '087854848430', 'Bank Transfer', '$2y$10$2GWxfbF239os3I5PCqNpdOX766zul7BwHbOb7.s2QxiAhTRQ4lMd.', NULL, 'IDR', '2020-02-21 03:47:05', '2020-02-25 10:59:50', 13.00, 'Active', NULL, NULL),
(2, 'Bela', 'B', NULL, 'salsabylaalya@gmail.com', 'Sidodadi 8', 'Sby', '6015', 'Indonesia', '087851351641', 'Paypal', '$2y$10$BBNsybABpZBbMsFxFZykjemIe6VkAsH1auHG4soYYXiC5dIzPWskK', NULL, 'USD', '2020-02-21 06:46:44', '2020-02-25 09:53:06', 40.00, 'Active', NULL, NULL),
(5, 'Anisa', 'Rajwa', 'PT PT', 'anis@gmail.com', 'sidodadi', 'sby', '60145', 'ina', '087525554365', 'Paypal', '$2y$10$Lytm4SqwGW0Q/CBMDz2awuJE0Z.39OQ7xqVsIXTpe1v1rfWLPWHfu', NULL, 'USD', '2020-02-25 06:13:17', '2020-02-25 06:13:17', 0.00, 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblcredit`
--

CREATE TABLE `tblcredit` (
  `creditid` bigint(20) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `amount` double NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `date` timestamp NULL DEFAULT NULL,
  `adminid` int(11) DEFAULT NULL,
  `invoiceid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tblcredit`
--

INSERT INTO `tblcredit` (`creditid`, `userid`, `amount`, `type`, `date`, `adminid`, `invoiceid`) VALUES
(1, 2, 10, 'Add', '2020-02-25 06:27:07', NULL, 1),
(2, 1, 20, 'Add', '2020-02-25 10:59:50', 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblinvoice`
--

CREATE TABLE `tblinvoice` (
  `invoiceid` bigint(20) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymentmethod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `draft` tinyint(1) NOT NULL DEFAULT '0',
  `sendinvoice` tinyint(1) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `duedate` date NOT NULL,
  `taxrate` double(8,2) NOT NULL,
  `autoapplycredit` tinyint(1) NOT NULL DEFAULT '0',
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datepaid` date DEFAULT NULL,
  `total` double(8,2) NOT NULL,
  `published_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tblinvoice`
--

INSERT INTO `tblinvoice` (`invoiceid`, `userid`, `status`, `paymentmethod`, `draft`, `sendinvoice`, `date`, `duedate`, `taxrate`, `autoapplycredit`, `notes`, `datepaid`, `total`, `published_at`) VALUES
(1, 2, 'Paid', 'Bank Transfer', 1, 1, '2020-02-25', '2020-03-03', 10.00, 0, 'Notes Invoice #1', NULL, 27.00, '2020-02-25 08:48:57'),
(2, 1, 'Paid', 'Bank Transfer', 1, 1, '2020-02-25', '2020-03-03', 10.00, 0, 'inv 1 client 1', NULL, 10.50, '2020-02-25 06:38:30'),
(3, 2, 'Draft', 'Bank Transfer', 1, 0, '2020-02-25', '2020-03-03', 10.00, 0, 'asdadasdasdasd', NULL, 17.60, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblitems`
--

CREATE TABLE `tblitems` (
  `itemid` bigint(20) UNSIGNED NOT NULL,
  `invoiceid` int(11) NOT NULL,
  `itemdescription` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `itemamount` double NOT NULL DEFAULT '0',
  `itemtaxed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tblitems`
--

INSERT INTO `tblitems` (`itemid`, `invoiceid`, `itemdescription`, `itemamount`, `itemtaxed`) VALUES
(15, 1, 'item #1', 20, 1),
(16, 1, 'item #2', 15, 0),
(21, 2, 'itemmmmmm1', 14, 0),
(22, 2, 'itemmmmmm2', 15, 1),
(23, 3, 'dasdasdad', 16, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblpayment`
--

CREATE TABLE `tblpayment` (
  `paymentid` bigint(20) UNSIGNED NOT NULL,
  `invoiceid` int(11) NOT NULL,
  `datepaid` date DEFAULT NULL,
  `amount` double(8,2) NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tblpayment`
--

INSERT INTO `tblpayment` (`paymentid`, `invoiceid`, `datepaid`, `amount`, `method`, `created_at`) VALUES
(2, 1, '2020-02-25', 20.00, 'Bank Transfer', '2020-02-25 10:14:12'),
(3, 1, '2020-02-25', 17.00, 'Bank Transfer', '2020-02-25 10:14:43'),
(5, 2, '2020-02-25', 10.50, 'Bank Transfer', '2020-02-25 11:07:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `api_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Istiqomah Nur Fatayati', 'istiqomahnurfatayati@gmail.com', '$2y$10$q/l6nH5/A1uy3KBn/GxS6.sBQSAhslCS7612Y8wq9D4sGPRVU.fZ.', NULL, '2020-02-12 04:49:07', '2020-02-12 04:49:07', 'admin'),
(2, 'Salsabyla', 'salsabyla@gmail.com', '$2y$10$xhrgzc1aM8NxJrOMuDK1KObI/yuQfbWX19bXzM0v4a/y29fczo1ku', NULL, '2020-02-12 07:57:03', '2020-02-12 07:57:03', 'user'),
(3, 'Annisa', 'annisa@gmail.com', '$2y$10$MIHkUYcUtWRXphfdE986ku6Am/UZ8O.cxVQPjIQyOKcOGQSAtXhNq', NULL, '2020-02-12 07:58:18', '2020-02-12 07:58:18', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblclient`
--
ALTER TABLE `tblclient`
  ADD PRIMARY KEY (`clientid`);

--
-- Indexes for table `tblcredit`
--
ALTER TABLE `tblcredit`
  ADD PRIMARY KEY (`creditid`);

--
-- Indexes for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  ADD PRIMARY KEY (`invoiceid`);

--
-- Indexes for table `tblitems`
--
ALTER TABLE `tblitems`
  ADD PRIMARY KEY (`itemid`);

--
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tblclient`
--
ALTER TABLE `tblclient`
  MODIFY `clientid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblcredit`
--
ALTER TABLE `tblcredit`
  MODIFY `creditid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  MODIFY `invoiceid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblitems`
--
ALTER TABLE `tblitems`
  MODIFY `itemid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
  MODIFY `paymentid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
