-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 01:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mec-users`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `permissions` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `user_id`, `role_name`, `permissions`) VALUES
(1, 9, 'low', '[\"read\"]'),
(2, 10, 'mid', '[\"read\",\"create\"]'),
(3, 11, 'super', '[\"read\",\"create\",\"update\",\"delete\"]'),
(4, 12, 'mid', '{\"admin\":[\"read\"],\"user\":[\"read\",\"create\",\"update\",\"delete\"]}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `category` enum('client','admin') NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `user_image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_email`, `password`, `category`, `is_active`, `user_image`, `created_at`, `updated_at`) VALUES
(1, 'khaeled', 'khaled@khaled.com', '123', 'client', 1, './uploads/67011350214d9_1728123728.', '2024-09-28 11:47:14', '2024-10-05 14:10:40'),
(2, 'eslam', 'eslam@eslam.com', '$2y$10$qhJq7Q2T.gAProqI.e6wNe63k8vv1.dzOwKz30h75yhjDxoZNhNte', 'client', 1, './uploads/67011350214d9_1728123728.', '2024-09-28 12:06:53', '2024-10-05 14:10:42'),
(3, 'test', 'test@test.com', '$2y$10$TXKAtGlTN5sDiLevXw8/8e2Ofoo1iblTCWeA7wznRFt4CIyQqTSBy', 'client', 1, './uploads/67011350214d9_1728123728.', '2024-09-28 12:30:57', '2024-10-05 14:10:44'),
(4, 'mahmoud', 'mahmoud@mahmoud.com', '$2y$10$VScL55yqUxbmsqlZGwXQhuz2r7Y0fo5C2quz52bjVfzkO4D5IyeDK', 'client', 1, './uploads/67011350214d9_1728123728.', '2024-09-28 12:41:20', '2024-10-05 14:10:45'),
(5, 'islam', 'islam@islam.com', '$2y$10$islJ8JBEG4RHizBFR86ka.RQEmMkbW4qSZb9WPCss1UIYLylBogyS', 'client', 1, './uploads/66f7d4da53e2a_1727517914.webp', '2024-09-28 13:05:14', '2024-10-05 14:09:52'),
(6, 'zz', 'zz@zz.com', '$2y$10$1vfXIDIATYW5JM9EkQEb2elfXgSMV/SahwkANI7uHEZRWa5e2YOfS', 'client', 1, './uploads/66f7d81df12c9_1727518749.jpg', '2024-09-28 13:19:09', '2024-10-05 14:09:51'),
(7, 'bassem', 'bassem@bassem.com', '$2y$10$GmVQGv8W0eozI./0YTwRWOMouXWaTV5dU.dgSXnqlCIvnBycVYoLC', 'client', 0, './uploads/6700ec35a0d62_1728113717.jpg', '2024-10-05 10:35:17', '2024-10-05 14:12:03'),
(8, 'Admin', 'admin@admin.com', '$2y$10$GmVQGv8W0eozI./0YTwRWOMouXWaTV5dU.dgSXnqlCIvnBycVYoLC', 'admin', 1, './uploads/6700ec35a0d62_1728113717.jpg', '2024-10-05 11:01:51', '2024-10-05 11:02:05'),
(9, 'low admin', 'lAdmin@admin.com', '$2y$10$3R/bsBJFjCWnKHfbh505FOEEGDELeYADX9VOx0SB4vU5sd0gOX2Oi', 'admin', 1, './uploads/67010cb516967_1728122037.', '2024-10-05 12:53:57', '2024-10-05 12:53:57'),
(10, 'mid admin', 'mAdmin@admin.com', '$2y$10$3kcKrAPtYyh2TrDmADsDw.bBB/oLN5b98yG/JHEdT4wJOS85bjXKC', 'admin', 1, './uploads/67010d2ad6058_1728122154.', '2024-10-05 12:55:54', '2024-10-05 12:55:54'),
(11, 'Superadmin', 'Superadmin@admin.com', '$2y$10$P7ex6u/HqPj3GRxk9DDhHekrV3IeefPPpS4msI21xe/eBSuQxdN4q', 'admin', 1, './uploads/6701113e8bf65_1728123198.', '2024-10-05 13:13:18', '2024-10-05 13:13:18'),
(12, 'admin3', 'admin3@admin.com', '$2y$10$PBPVRTNuie56Zho1qUBmlOGGO7ALuVYDZ4ofim/1NHIYBfPnlDUhe', 'admin', 1, './uploads/67011350214d9_1728123728.', '2024-10-05 13:22:08', '2024-10-05 13:22:08'),
(13, 'hosny', 'hosny@hosny.com', '$2y$10$CvIdqxwxqMGyl3gEmHsgV.mKNsoRTJrddZ62Tw0dzI/0hfbBiJ8fS', 'client', 1, './uploads/670121db4282c_1728127451.png', '2024-10-05 14:24:11', '2024-10-05 14:24:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD CONSTRAINT `admin_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
