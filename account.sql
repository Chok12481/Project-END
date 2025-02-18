-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2025 at 05:58 PM
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
-- Database: `admins_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `income` int(11) NOT NULL,
  `contact_info` text DEFAULT NULL,
  `activities` text DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `email`, `username`, `password`, `address`, `phone`, `occupation`, `income`, `contact_info`, `activities`, `profile_image`, `role`, `name`, `created_at`, `updated_at`) VALUES
(1, 'phansa12481@gmail.com', 'phansa', '$2y$10$U3uhh1pA2xICeRyoIAlvwudeEYr1HDnbZfTBfDhKD3yVjmk4ensMK', 'นนทบุรี', '0928214562', 'นักศึกษา', 2147483647, '111111', 'ฝึกฝีมือส่งเสริมอาชีพ', 'uploads/67aa03ff87481_Untitled-2.jpg', 'admin', 'โชค', '2025-02-10 15:36:12', '2025-02-10 15:36:12'),
(2, 'zero12481@gmail.com', 'zero', '$2y$10$QCFhGb5V19sT2phWbYunq.y02wq9wCKpDN/Qhy6F7YDh74zViaRPy', 'นนทบุรี', '0928214562', 'นักศึกษา', 2147483647, '11111', 'ฝึกสอนฟุตซอล', 'uploads/1738599833_d7da642a2a04228de977577e9aef9443a527b745ace15cbcaf72d00f87d453f0.jpg', 'member', NULL, '2025-02-10 15:36:12', '2025-02-10 15:40:12'),
(3, 'mk@gmail.com', 'mk', '$2y$10$fO/QLVrb/Rz8nZLK9iaCy.k90LISx/wNifA8./tNGvZn.V3xrwHR6', 'กรุงเทพ', '087993222', 'ครู', 50000, '', 'ร้องเพลง, เต้น, ฝึกสอนดนตรีไทย', NULL, NULL, NULL, '2025-02-10 15:43:34', '2025-02-10 15:43:34'),
(6, 'thanarat1@gmail.com', 'thanarat', '$2y$10$bMcXUYLQZkzV0ecGocgxfORG8T7g.RRaBsp3WQZUTYhp.T9l2k6lS', 'กรุงเทพ', '000000', 'นักศึกษา', 700000, '', 'ฝึกสอนฟุตซอล', 'uploads/1739202830_Untitled-2.jpg', NULL, NULL, '2025-02-10 15:53:50', '2025-02-10 15:53:50'),
(7, 'chok@gmail.ccom', 'chok', '$2y$10$rntaDotszjgGD8SzMlSr4.GAbBrtM0ZMi0rBy4Nuzp7oeSJFw6mSi', 'นนทบุรี', '0928214562', 'นักศึกษา', 1000000, 'chok phansa', 'ร้องเพลง', 'uploads/1739202906_dqqq.jpg', NULL, NULL, '2025-02-10 15:55:06', '2025-02-10 15:55:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
