-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2022 at 11:26 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_list`
--

INSERT INTO `account_list` (`id`, `code`, `student_id`, `room_id`, `rate`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, '202205070001', 1, 5, 5000.00, 1, 0, '2022-05-07 13:46:00', '2022-12-02 13:33:39');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dorm_list`
--

INSERT INTO `dorm_list` (`id`, `name`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Male Dorm 1', 1, 0, '2022-12-02 13:17:34', '2022-12-02 13:17:34'),
(2, 'Female Dorm 1', 1, 0, '2022-12-02 13:21:31', '2022-12-02 13:21:31'),
(3, 'Male Dorm 2', 1, 0, '2022-12-02 13:23:08', '2022-12-02 13:23:08'),
(4, 'Female Dorm 2', 1, 0, '2022-12-02 13:25:06', '2022-12-02 13:25:06'),
(5, 'Male Dorm 101', 0, 0, '2022-12-02 13:26:10', '2022-12-02 13:26:10');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_list`
--

INSERT INTO `payment_list` (`id`, `account_id`, `month_of`, `amount`, `date_created`, `date_updated`) VALUES
(3, 1, '2022-04', 5000.00, '2022-12-02 13:35:02', '2022-12-02 13:35:02'),
(4, 1, '2022-05', 5000.00, '2022-12-02 13:36:45', '2022-12-02 13:36:45'),
(5, 2, '2022-05', 3500.00, '2022-12-02 13:37:48', '2022-12-02 13:37:48');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(7, 2, 'Room 103', 6, 1000.00, 0, 0, '2022-12-02 14:20:11', '2022-12-02 14:20:11');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`id`, `code`, `firstname`, `middlename`, `lastname`, `department`, `birthdate`, `course`, `gender`, `contact`, `religion`, `email`, `address`, `emergency_name`, `emergency_contact`, `emergency_address`, `emergency_relation`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, '6231415', 'Juan', 'D', 'dela Cruz', 'College of Engineering', NULL, 'Bachelor of Science in Computer  Science', 'Male', '09123456789', '', 'jdelacruz@gmail.com', '23 St, Here City, Over There Province,  2306', 'Ivan dela Cruz', '09654789123', '23 St, Here City, Over There Province,  2306', 'Father', 1, 0, '2022-12-02 14:22:55', '2022-12-02 14:22:55'),
(2, 'asd', 'Andy', 'Fuentecilla', 'Nieves', 'asdas', '2022-12-09', 'dasd', 'Male', '09469137286', 'sdasd', 'andinieves151720@gmail.com', 'asdasd', 'Andy Fuentecilla Nieves', 'asd', '', 'asdasd', 0, 0, '2022-12-08 17:41:47', '2022-12-08 17:41:47'),
(3, '05-11553i', 'Andy', 'Fuentecilla', 'Nieves', 'College of Communication and Information Technology', '1989-12-02', 'Bachelor of Science in Computer Science', 'Male', '09469137286', 'Roman Catholic', 'andinieves151720@gmail.com', 'Purok 2, Bangantalinga', 'Andy Fuentecilla Nieves', '0192039102390123', 'Ohio', 'Twin', 0, 0, '2022-12-08 17:43:53', '2022-12-08 17:43:53'),
(4, 'xxxx', 'Andy', 'Fuentecilla', 'Nieves', 'x', '2022-12-03', 'x', 'Male', '09469137286', 'xx', 'andinieves151720@gmail.com', 'Purok 2, Bangantalinga', 'Andy Fuentecilla Nieves', 'xx', 'xx', 'xx', 1, 0, '2022-12-08 17:44:52', '2022-12-08 18:08:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `middle_name` text DEFAULT NULL,
  `last_name` varchar(250) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
    `profile_avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `username`, `password`, `profile_avatar`, `last_login`, `type`, `status`, `delete_flag`, `date_created`, `date_added`, `date_updated`) VALUES
(1, 'Admin', 'Admin123'),
(1, '', NULL, '', 'Dhey05', '12345', NULL, NULL, 1, 1, 1, '2022-12-28 17:16:14', '2022-12-28 14:49:30', '2022-12-28 17:51:35'),
(2, '', NULL, '', 'Dhey', '41125', 'img/avatars/1.jpg', NULL, 1, 1, 0, '2022-12-28 17:16:14', '2022-12-28 14:49:30', '2022-12-29 07:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE `user_meta` (
  `id` int(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_meta`
--

INSERT INTO `user_meta` (`id`, `user_id`, `meta_key`, `meta_value`) VALUES
(0, 1, '', ''),
(1, 1, '', '');

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
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dorm_list`
--
ALTER TABLE `dorm_list`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_list`
--
ALTER TABLE `payment_list`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room_list`
--
ALTER TABLE `room_list`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
