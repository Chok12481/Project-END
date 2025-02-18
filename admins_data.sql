-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2025 at 04:52 PM
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
(2, 'zero12481@gmail.com', 'zero', '$2y$10$QCFhGb5V19sT2phWbYunq.y02wq9wCKpDN/Qhy6F7YDh74zViaRPy', 'นนทบุรี', '0928214562', 'นักศึกษา', 2147483647, '11111', 'ร้องเพลง', 'uploads/1738599833_d7da642a2a04228de977577e9aef9443a527b745ace15cbcaf72d00f87d453f0.jpg', 'member', NULL, '2025-02-10 15:36:12', '2025-02-17 15:47:28'),
(7, 'chok@gmail.ccom', 'chok', '$2y$10$rntaDotszjgGD8SzMlSr4.GAbBrtM0ZMi0rBy4Nuzp7oeSJFw6mSi', 'นนทบุรี', '0928214562', 'นักศึกษา', 1000000, 'chok phansa', 'ร้องเพลง', 'uploads/1739202906_dqqq.jpg', 'member', NULL, '2025-02-10 15:55:06', '2025-02-11 17:24:24'),
(8, 'lol@gmail.com', 'lol', '$2y$10$/YuuARuDmk9ouhKEH6wZpunm9d/nfxP8uyOn2zw4IR6R7f8cBSCN2', 'นนทบุรี', '0928214562', 'นักศึกษา', 1000000, '1111', 'ร้องเพลง', 'uploads/Untitled-2.jpg', 'member', NULL, '2025-02-11 16:56:11', '2025-02-11 17:24:25'),
(9, 'kok@gmail.com', 'kok', '$2y$10$Hkalqg2hN/8DDkQ9iLyWROm47fIe0r24HQHVGHJMPTt0nXQkySJCK', 'นนทบุรี', '0928214562', 'นักศึกษา', 1000000, 'ๅๅๅ', 'ฝึกฝีมือส่งเสริมอาชีพ', NULL, 'member', NULL, '2025-02-14 04:24:31', '2025-02-14 04:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `title`, `description`, `image`, `date`, `time`, `location`, `capacity`, `created_at`, `updated_at`) VALUES
(1, 'ร้องเพลง', 'กิจกรรมฝึกทักษะการร้องเพลงสำหรับเยาวชน', 'uploads/—Pngtree—singing little girl_7042878.png', '2026-02-25', '09:30:00', 'ศูนย์เยาวชนสวนอ้อย', 20, '2025-02-11 16:08:22', '2025-02-11 16:45:04'),
(2, 'เต้น', 'กิจกรรมฝึกทักษะการเต้นสำหรับเยาวชน', 'uploads/—Pngtree—black and white hand drawn_5479216.png', '2026-02-25', '10:30:00', 'ศูนย์เยาวชนสวนอ้อย', 40, '2025-02-11 16:16:49', '2025-02-11 16:45:25'),
(3, 'ฝึกดนตรีไทย', 'กิจกรรมฝึกทักษะดนตรีไทยสำหรับเยาวชน', 'uploads/—Pngtree—musical instrument wallpaper vector_3247119.png', '2026-02-25', '13:00:00', 'ศูนย์เยาวชนสวนอ้อย', 10, '2025-02-11 16:17:43', '2025-02-11 16:45:53'),
(4, 'ฝึกฟุตซอล', 'กิจกรรมฝึกทักษะฟุตซอลสำหรับเยาวชน', 'uploads/—Pngtree—motion sports competitive sports football_3841222.png', '2026-02-25', '15:30:00', 'ศูนย์เยาวชนสวนอ้อย', 30, '2025-02-11 16:18:34', '2025-02-11 16:46:04'),
(5, 'ฝีมือส่งเสริมอาชีพ', 'กิจกรรมฝึกทักษะฝีมือส่งเสริมอาชีพสำหรับเยาวชน', 'uploads/—Pngtree—labor day various occupations vector_5764572.png', '2026-02-25', '17:00:00', 'ศูนย์เยาวชนสวนอ้อย', 10, '2025-02-11 16:19:29', '2025-02-11 16:46:13');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `activity_id`, `user_id`, `booking_date`, `username`, `title`) VALUES
(1, 1, 2, '2025-02-11 16:34:08', 'zero', NULL),
(2, 3, 7, '2025-02-11 16:35:38', 'chok', NULL),
(3, 1, 8, '2025-02-11 16:57:21', 'lol', NULL),
(4, 2, 8, '2025-02-11 16:57:34', 'lol', NULL),
(5, 5, 9, '2025-02-14 04:28:51', 'kok', NULL),
(6, 4, 9, '2025-02-14 04:34:53', 'kok', NULL),
(10, 1, 9, '2025-02-14 04:44:08', 'kok', NULL),
(11, 3, 9, '2025-02-14 04:54:34', 'kok', 'ฝึกดนตรีไทย'),
(12, 4, 2, '2025-02-17 15:48:09', 'zero', 'ฝึกฟุตซอล');

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
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_id` (`activity_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
