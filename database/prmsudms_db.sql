-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2023 at 04:30 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prmsudms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_list`
--

CREATE TABLE `account_list` (
  `id` int(40) NOT NULL,
  `code` varchar(100) NOT NULL,
  `student_id` int(40) NOT NULL,
  `room_id` int(40) NOT NULL,
  `rate` float(12,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_list`
--

INSERT INTO `account_list` (`id`, `code`, `student_id`, `room_id`, `rate`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, '202205070001', 1, 5, 5000.00, 1, 0, '2022-05-07 13:46:00', '2022-12-02 13:33:39'),
(6, '', 4, 10, 0.00, 1, 0, '2022-12-12 23:06:12', '2022-12-19 10:19:35'),
(7, '', 2, 10, 0.00, 1, 0, '2022-12-12 23:35:51', '2022-12-19 10:21:04'),
(9, '', 3, 6, 0.00, 1, 0, '2022-12-13 00:16:10', '2022-12-13 00:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `dorm_list`
--

CREATE TABLE `dorm_list` (
  `id` int(40) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dorm_list`
--

INSERT INTO `dorm_list` (`id`, `name`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Male Dorm 1', 1, 0, '2022-12-02 13:17:34', '2022-12-02 13:17:34'),
(2, 'Female Dorm 1', 1, 0, '2022-12-02 13:21:31', '2022-12-02 13:21:31'),
(3, 'Male Dorm 2', 1, 0, '2022-12-02 13:23:08', '2022-12-02 13:23:08'),
(4, 'Female Dorm 2', 1, 0, '2022-12-02 13:25:06', '2022-12-02 13:25:06'),
(5, 'Male Dorm 101', 0, 0, '2022-12-02 13:26:10', '2022-12-02 13:26:10'),
(23, 'College of Education Dorm 1', 0, 0, '2022-12-16 16:28:13', '2022-12-16 16:28:22'),
(25, '233', 1, 0, '2022-12-16 17:31:13', '2022-12-19 08:28:03'),
(26, '22', 1, 0, '2022-12-16 17:31:16', '2022-12-16 17:40:40'),
(29, '22355', 1, 0, '2022-12-19 16:42:53', '2022-12-22 18:27:50');

-- --------------------------------------------------------

--
-- Table structure for table `payment_list`
--

CREATE TABLE `payment_list` (
  `id` int(40) NOT NULL,
  `account_id` int(40) NOT NULL,
  `month_of` varchar(10) NOT NULL,
  `amount` float(12,2) NOT NULL DEFAULT 0.00,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_list`
--

INSERT INTO `payment_list` (`id`, `account_id`, `month_of`, `amount`, `date_created`, `date_updated`) VALUES
(0, 3, '2022-12', 450.00, '2022-12-19 16:06:32', '2022-12-19 19:13:11'),
(3, 1, '2022-04', 5000.00, '2022-12-02 13:35:02', '2022-12-02 13:35:02'),
(4, 1, '2022-05', 5000.00, '2022-12-02 13:36:45', '2022-12-02 13:36:45'),
(5, 2, '2022-05', 3500.00, '2022-12-02 13:37:48', '2022-12-02 13:37:48'),
(6, 3, '2022-12-01', 1000.00, '2022-12-13 00:26:25', '2022-12-13 00:26:25'),
(8, 3, '2022-08', 201.00, '2022-12-19 15:34:28', '2022-12-19 16:40:21'),
(9, 0, '2022-03', 2.00, '2022-12-19 15:46:54', '2022-12-19 15:46:54'),
(10, 0, '2022-03', 2.00, '2022-12-19 15:47:03', '2022-12-19 15:47:03'),
(11, 0, '2022-03', 2.00, '2022-12-19 15:47:07', '2022-12-19 15:47:07'),
(12, 0, '2022-10', 200.00, '2022-12-19 15:48:07', '2022-12-19 15:48:07'),
(13, 0, '2022-10', 200.00, '2022-12-19 15:48:11', '2022-12-19 15:48:11'),
(14, 0, '2022-10', 200.00, '2022-12-19 15:48:15', '2022-12-19 15:48:15'),
(15, 3, '2022-11', 233.00, '2022-12-19 15:49:42', '2022-12-19 15:49:42'),
(21, 3, '2022-08', 1234.00, '2022-12-19 15:56:02', '2022-12-19 16:40:10'),
(22, 3, '2022-09', 123.00, '2022-12-19 15:57:01', '2022-12-19 15:57:01'),
(23, 3, '2022-07', 123.00, '2022-12-19 15:57:26', '2022-12-19 15:57:26'),
(25, 3, '2022-01', 123456.00, '2022-12-19 16:00:25', '2022-12-19 16:00:25'),
(26, 3, '2022-06', 56433.00, '2022-12-19 16:00:53', '2022-12-19 16:00:53'),
(28, 2, '2022-12', 200.00, '2022-12-19 19:06:06', '2022-12-19 19:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `room_list`
--

CREATE TABLE `room_list` (
  `id` int(40) NOT NULL,
  `dorm_id` int(40) NOT NULL,
  `name` text NOT NULL,
  `slots` int(10) NOT NULL DEFAULT 0,
  `price` float(12,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_list`
--

INSERT INTO `room_list` (`id`, `dorm_id`, `name`, `slots`, `price`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 1, 'Room 101', 3, 3500.00, 1, 0, '2022-12-02 13:39:43', '2022-12-02 13:39:43'),
(2, 1, 'Room 102', 4, 3500.00, 1, 0, '2022-12-02 13:58:12', '2022-12-02 13:58:12'),
(3, 2, 'Room 101', 4, 3500.00, 1, 0, '2022-12-02 14:11:15', '2022-12-02 14:11:15'),
(4, 2, 'Room 102', 4, 3500.00, 1, 0, '2022-12-02 14:15:32', '2022-12-02 14:15:32'),
(5, 3, 'Room 101', 2, 5000.00, 1, 0, '2022-12-02 14:17:30', '2022-12-02 14:17:30'),
(6, 4, 'Room 101', 2, 5000.00, 1, 0, '2022-12-02 14:18:45', '2022-12-02 14:18:45'),
(7, 2, 'Room 103', 6, 1000.00, 0, 0, '2022-12-02 14:20:11', '2022-12-02 14:20:11'),
(10, 29, 'CCIT STUDENTS 5', 4, 500.00, 1, 0, '2022-12-19 08:56:13', '2022-12-19 16:58:35'),
(12, 29, 'abcd', 23, 100.00, 1, 0, '2022-12-19 16:43:23', '2022-12-19 16:49:39'),
(13, 29, '1123', 23, 23.00, 1, 0, '2022-12-19 16:57:55', '2022-12-19 16:57:55'),
(14, 29, 'a', 2, 23.00, 1, 0, '2022-12-22 08:58:54', '2022-12-22 08:58:54'),
(15, 29, 'abcd3', 2, 23.00, 1, 0, '2022-12-22 09:00:10', '2022-12-22 09:00:10'),
(16, 29, '4444', 2, 1000.00, 1, 0, '2022-12-22 09:00:57', '2022-12-22 09:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `id` int(40) NOT NULL,
  `code` varchar(100) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text NOT NULL,
  `lastname` text NOT NULL,
  `department` text NOT NULL,
  `birthdate` date DEFAULT NULL,
  `course` text NOT NULL,
  `gender` varchar(20) NOT NULL,
  `contact` text NOT NULL,
  `religion` text NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `emergency_name` text NOT NULL,
  `emergency_contact` text NOT NULL,
  `emergency_address` text NOT NULL,
  `emergency_relation` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`id`, `code`, `firstname`, `middlename`, `lastname`, `department`, `birthdate`, `course`, `gender`, `contact`, `religion`, `email`, `address`, `emergency_name`, `emergency_contact`, `emergency_address`, `emergency_relation`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, '6231415', 'Juan', 'D', 'dela Cruz', 'College of Engineering', NULL, 'Bachelor of Science in Computer  Science', 'Male', '09123456789', '', 'jdelacruz@gmail.com', '23 St, Here City, Over There Province,  2306', 'Ivan dela Cruz', '09654789123', '23 St, Here City, Over There Province,  2306', 'Father', 1, 0, '2022-12-02 14:22:55', '2022-12-02 14:22:55'),
(2, 'asd', 'Andy', 'Fuentecilla', 'Nieves', 'asdas', '2022-12-09', 'dasd', 'Male', '09469137286', 'sdasd', 'andinieves151720@gmail.com', 'asdasd', 'Andy Fuentecilla Nieves', 'asd', '', 'asdasd', 0, 0, '2022-12-08 17:41:47', '2022-12-08 17:41:47'),
(3, '05-11553i', 'Andy', 'Fuentecilla', 'Nieves', 'College of Communication and Information Technology', '1989-12-02', 'Bachelor of Science in Computer Science', 'Male', '09469137286', 'Roman Catholic', 'andinieves151720@gmail.com', 'Purok 2, Bangantalinga', 'Andy Fuentecilla Nieves', '0192039102390123', 'Ohio', 'Twin', 0, 0, '2022-12-08 17:43:53', '2022-12-08 17:43:53'),
(4, 'xxxx', 'Andy', 'Fuentecilla', 'Nieves', 'x', '2022-12-03', 'x', 'Male', '09469137286', 'xx', 'andinieves151720@gmail.com', 'Purok 2, Bangantalinga', 'Andy Fuentecilla Nieves', 'xx', 'xx', 'xx', 1, 0, '2022-12-08 17:44:52', '2022-12-08 18:08:06'),
(5, '051234123123', 'Codi Kyler', 'Cayaban', 'Nieves', 'Department of Accountancy', '1989-12-23', 'BS in Accountancy Technology', 'Male', '09297752410', 'Roman Catholic', 'codi@nieves.com', 'Purok 2, Bangantalinga', 'Andy Fuentecilla Nieves', '09297752410', 'Purok 2, Bangantalinga', 'Father', 1, 0, '2022-12-23 10:37:02', '2022-12-23 10:37:02'),
(6, '22-123456a', 'Andy', 'Fuentecilla', 'Nieves', 'Department of Education', '2022-12-02', 'Bachelor of Elementary Education', 'Male', '09469137286', 'RC', 'codi@nieves.com', 'Purok 2, Bangantalinga', 'Andy Fuentecilla Nieves', '231231231212312312313123123', '123', 'asdasd', 1, 0, '2022-12-23 10:39:46', '2022-12-23 10:39:46'),
(7, 'xxxxx', 'Andy', 'Fuentecilla', 'Nieves', 'Department of Education', '2022-12-03', 'Bachelor of Elementary Education', 'Male', '09469137286', 'asd', 'andinieves@gmail.com', 'Purok 2, Bangantalinga', 'Andy Fuentecilla Nieves', '09469137286', '123', 'asdasd', 1, 0, '2022-12-23 12:25:35', '2022-12-23 12:25:35'),
(8, '22-123456at', 'Andy', 'Fuentecilla', 'Nieves', 'Department of Education', '2022-12-02', 'Bachelor of Elementary Education', 'Male', '09469137286', '123', 'zbsd@gmail.com', 'Purok 2, Bangantalinga', 'Andy Fuentecilla Nieves', '123', 'Purok 2, Bangantalinga', '23', 1, 0, '2022-12-23 12:26:20', '2022-12-23 12:26:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 3,
  `status` int(1) NOT NULL DEFAULT 1,
  `delete_flag` int(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `type`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Admin', 'Admin123', 1, 1, 0, '2022-12-21 08:35:22', '2022-12-21 08:35:22'),
(2, 'Dhey', '123456', 1, 1, 0, '2022-12-21 08:35:22', '2022-12-21 08:35:22'),
(26, 'andy', '123456', 1, 1, 0, '2022-12-22 18:39:32', '2022-12-22 18:39:32'),
(27, 'zbsd@gmail.com', '', 3, 1, 0, '2022-12-23 12:26:20', '2022-12-23 12:26:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE `user_meta` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meta_key` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_meta`
--

INSERT INTO `user_meta` (`id`, `user_id`, `meta_key`, `meta_value`) VALUES
(25, 1, 'first_name', 'Admin'),
(26, 2, 'first_name', 'Dhey'),
(28, 1, 'last_name', 'Dhey'),
(30, 2, 'last_name', 'Dhey'),
(77, 26, 'first_name', 'Andyx'),
(78, 26, 'middle_name', 'Fuentecillax'),
(79, 26, 'last_name', 'Nievesx'),
(83, 26, 'profile_avatar', 'profile-avatar-26.png'),
(84, 2, 'middle_name', 'Yehd'),
(85, 2, 'profile_avatar', 'profile-avatar-2.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_list`
--
ALTER TABLE `account_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dorm_list`
--
ALTER TABLE `dorm_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_list`
--
ALTER TABLE `payment_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_list`
--
ALTER TABLE `room_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_list`
--
ALTER TABLE `account_list`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dorm_list`
--
ALTER TABLE `dorm_list`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `payment_list`
--
ALTER TABLE `payment_list`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `room_list`
--
ALTER TABLE `room_list`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
