-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 26, 2024 at 10:12 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinetech`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `media_id` int NOT NULL,
  `comment_text` text COLLATE utf8mb4_general_ci NOT NULL,
  `added_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `media_id`, `comment_text`, `added_at`) VALUES
(37, 1, 912649, '1', '2024-11-24 22:53:03'),
(38, 1, 912649, '2', '2024-11-24 22:53:09'),
(39, 1, 912649, '3', '2024-11-24 22:53:16'),
(40, 1, 912649, '4', '2024-11-24 23:00:31'),
(41, 1, 912649, 'hjfsbgr', '2024-11-24 23:09:49'),
(42, 1, 912649, 'hjfsbgr', '2024-11-24 23:09:49'),
(43, 1, 912649, 'bhdzjvaf&quot;r', '2024-11-24 23:12:15'),
(44, 1, 912649, 'jdaf qe', '2024-11-24 23:13:32'),
(45, 1, 912649, 'n vnznf', '2024-11-24 23:15:11'),
(46, 1, 912649, 'fizve&#039;', '2024-11-24 23:18:43'),
(47, 1, 912649, 'jad', '2024-11-24 23:21:56'),
(48, 4, 912649, 'LLLLLLLLLLLLLLLLLL', '2024-11-24 23:24:26'),
(49, 4, 912649, 'kktr', '2024-11-25 06:59:44'),
(50, 4, 912649, 'JUI3RFHAR', '2024-11-25 07:05:41'),
(51, 4, 912649, 'z&#039;h-ubrk_o', '2024-11-25 07:10:20'),
(52, 4, 912649, 'ghnjry,j', '2024-11-25 07:15:57'),
(53, 4, 912649, 'cgey', '2024-11-25 07:22:21'),
(54, 4, 912649, 'iuolèç', '2024-11-25 07:22:26'),
(55, 4, 912649, 'DZEF', '2024-11-25 07:25:29'),
(56, 4, 912649, 'azgvbg', '2024-11-25 07:35:00'),
(57, 4, 912649, '1', '2024-11-25 07:35:06'),
(58, 4, 912649, 'é', '2024-11-25 07:35:15'),
(59, 4, 912649, '1', '2024-11-25 07:37:11'),
(60, 1, 1100782, '1', '2024-11-25 07:40:42'),
(61, 1, 1100782, '1', '2024-11-25 07:40:52'),
(62, 1, 1100782, '2', '2024-11-25 07:41:52'),
(63, 1, 912649, 'DA', '2024-11-25 08:02:42'),
(64, 1, 1100782, '1', '2024-11-25 08:04:00'),
(65, 1, 1100782, '1', '2024-11-25 09:12:07'),
(66, 1, 1100782, '1', '2024-11-25 09:12:14'),
(67, 1, 1184918, 'NON', '2024-11-25 09:47:27'),
(68, 1, 1184918, 'Non', '2024-11-25 09:59:24'),
(69, 1, 558449, 'fjfh', '2024-11-25 12:03:09'),
(70, 1, 1034541, 'trop nul', '2024-11-25 12:26:23'),
(71, 1, 1184918, 'hello', '2024-11-25 13:09:32'),
(72, 1, 1184918, 'Hello', '2024-11-25 13:10:04'),
(73, 5, 12971, '&lt;script&gt;alert(&#039;Votre site est vulnérable au XSS !&#039;);&lt;/script&gt;', '2024-11-25 14:27:20'),
(74, 5, 12971, '&lt;script&gt;alert(&#039;Votre site est vulnérable au XSS !&#039;);&lt;/script&gt;', '2024-11-25 14:28:51'),
(75, 1, 698687, 'hello', '2024-11-26 08:16:05');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `media_id` int NOT NULL,
  `media_type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `added_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `media_id`, `media_type`, `added_at`) VALUES
(15, 2, 1184918, 'movie', '2024-11-24 18:25:37'),
(17, 3, 912649, 'movie', '2024-11-24 18:48:58'),
(38, 1, 912649, 'movie', '2024-11-25 12:31:58'),
(39, 1, 94605, 'tv', '2024-11-25 12:33:50'),
(40, 1, 274816, 'tv', '2024-11-25 12:33:57'),
(41, 1, 94722, 'tv', '2024-11-25 12:34:11'),
(42, 1, 90228, 'tv', '2024-11-25 12:37:59'),
(43, 1, 558449, 'movie', '2024-11-25 12:38:02'),
(44, 1, 1118031, 'movie', '2024-11-25 12:38:03'),
(45, 1, 791042, 'movie', '2024-11-25 12:38:04'),
(50, 5, 912649, 'movie', '2024-11-25 13:50:07'),
(51, 5, 94605, 'tv', '2024-11-25 13:50:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Ibra', 'vignes@gmail.com', '$2y$10$6/5I/Dx7wRCUH/ulSSVED.gI7RzNPDgl3YF5cdcST1mvkJuQ3H1UW'),
(2, 'Tey', 'ibrahim.vignes@laplateforme.io', '$2y$10$/qlqCiBJaqq4B.0H8Ory2.SbBcaEk7FeZyfU9NGbCE6LYUIJUffXS'),
(3, 'Taymiyalamoche', 'vigne@gmail.com', '$2y$10$JpQ97js/LuTyaXrwbF3b7uj3x5iM2lowwr8Y16E7sbAKdTv.fUzwC'),
(4, 'Vignes', 'Vignes@gmailA.com', '$2y$10$XWgOEl2627LgOAJXCD2S9uI9Z1QL4LtZ3MIutJa9qyH2WpL1Ur70.'),
(5, 'Zuoh', 'elyes.messaadia@laplateforme.io', '$2y$10$itsVOTtF7zo1WpqFMgwPpeQV5clmAfFX4GFbrPTNP0p1Hc9GnLE1a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
