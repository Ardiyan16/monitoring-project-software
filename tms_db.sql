-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2022 at 02:42 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `project_list`
--

CREATE TABLE `project_list` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `manager_id` int(30) NOT NULL,
  `user_ids` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_list`
--

INSERT INTO `project_list` (`id`, `name`, `description`, `status`, `start_date`, `end_date`, `manager_id`, `user_ids`, `date_created`) VALUES
(15, 'Project 1', 'Tugas Baru', 0, '2022-06-13', '2022-06-15', 2, '6', '2022-06-13 11:42:20'),
(16, 'Project 3', 'tugas&nbsp;', 0, '2022-06-14', '2022-06-16', 2, '3', '2022-06-13 11:43:24'),
(17, 'ada', '																						', 0, '2022-06-13', '2022-06-14', 2, '6', '2022-06-13 11:43:48'),
(18, 'project 4', '																						', 5, '2022-06-15', '2022-06-17', 2, '3', '2022-06-15 06:25:09'),
(19, 'project bary', 'tes', 0, '2022-06-22', '2022-06-30', 2, '6', '2022-06-22 05:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `cover_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `address`, `cover_img`) VALUES
(1, 'Task Management System', 'info@sample.comm', '+6948 8542 623', '2102  Caldwell Road, Rochester, New York, 14608', '');

-- --------------------------------------------------------

--
-- Table structure for table `task_list`
--

CREATE TABLE `task_list` (
  `id` int(30) NOT NULL,
  `project_id` int(30) NOT NULL,
  `task` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_list`
--

INSERT INTO `task_list` (`id`, `project_id`, `task`, `description`, `status`, `date_created`) VALUES
(8, 12, 'test1', 'tugas 1', 2, '2022-06-11 20:46:24'),
(9, 0, 'Task baru23', 'taskku', 2, '2022-06-11 04:45:38'),
(10, 0, 'test23', 'tugas baru gan', 2, '2022-06-11 04:47:10'),
(20, 17, 'task baru', '																					', 2, '2022-06-14 05:22:17'),
(21, 17, 'task 2', '														', 3, '2022-06-15 04:59:07'),
(22, 18, 'task1', '														', 3, '2022-06-15 06:26:32'),
(23, 17, 'task 3', '							', 1, '2022-06-15 06:48:04'),
(24, 17, 'task 4', '														', 1, '2022-06-15 06:48:11'),
(25, 19, 'task baru', '							', 1, '2022-06-22 05:09:43'),
(26, 19, 'task baru 1', '							', 1, '2022-06-22 05:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 = admin; 2 = staff;',
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `type`, `date_created`) VALUES
(1, 'Administrator', '', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', 1, '2020-11-26 10:57:04'),
(2, 'Suyanto', 'Agus', 'suyanto@sample.com', '202cb962ac59075b964b07152d234b70', 2, '2020-12-03 09:26:03'),
(3, 'Agus', 'Suyanto', 'agus@sample.com', '202cb962ac59075b964b07152d234b70', 3, '2020-12-03 09:26:42'),
(6, 'bagus', 'prakoso jayatri', 'bagus@gmail.com', '202cb962ac59075b964b07152d234b70', 3, '0000-00-00 00:00:00'),
(7, 'bagus', 'prakoso', 'bp@gmail.com', '202cb962ac59075b964b07152d234b70', 3, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1 = admin, 2 = staff',
  `avatar` text NOT NULL DEFAULT 'no-image-available.png',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `type`, `avatar`, `date_created`) VALUES
(1, 'Administrator', '', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', 1, 'no-image-available.png', '2020-11-26 10:57:04'),
(2, 'Suyanto', 'Agus', 'suyanto@sample.com', '202cb962ac59075b964b07152d234b70', 2, '1606978560_avatar.jpg', '2020-12-03 09:26:03'),
(3, 'Agus', 'Suyanto', 'agus@sample.com', '202cb962ac59075b964b07152d234b70', 3, '1606958760_47446233-clean-noir-et-gradient-sombre-image-de-fond-abstrait-.jpg', '2020-12-03 09:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `user_productivity`
--

CREATE TABLE `user_productivity` (
  `id` int(30) NOT NULL,
  `project_id` int(30) NOT NULL,
  `task_id` int(30) NOT NULL,
  `comment` text NOT NULL,
  `subject` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `user_id` int(30) NOT NULL,
  `time_rendered` float NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_productivity`
--

INSERT INTO `user_productivity` (`id`, `project_id`, `task_id`, `comment`, `subject`, `date`, `start_time`, `end_time`, `user_id`, `time_rendered`, `date_created`) VALUES
(1, 1, 1, '							&lt;p&gt;Sample Progress&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Test 1&lt;/li&gt;&lt;li&gt;Test 2&lt;/li&gt;&lt;li&gt;Test 3&lt;/li&gt;&lt;/ul&gt;																			', 'Sample Progress', '2020-12-03', '08:00:00', '10:00:00', 1, 2, '2020-12-03 12:13:28'),
(2, 1, 1, '							Sample Progress						', 'Sample Progress 2', '2020-12-03', '13:00:00', '14:00:00', 1, 1, '2020-12-03 13:48:28'),
(3, 1, 2, '							Sample						', 'Test', '2020-12-03', '08:00:00', '09:00:00', 5, 1, '2020-12-03 13:57:22'),
(4, 1, 2, 'asdasdasd', 'Sample Progress', '2020-12-02', '08:00:00', '10:00:00', 2, 2, '2020-12-03 14:36:30'),
(6, 3, 0, '													', 'asd', '2022-05-14', '01:23:00', '02:23:00', 1, 1, '2022-05-14 01:24:08'),
(8, 3, 0, '													', '', '2022-05-29', '23:25:00', '12:25:00', 3, -11, '2022-05-28 23:25:57'),
(9, 3, 0, '													', 'test', '2022-05-28', '23:28:00', '00:28:00', 3, -23, '2022-05-28 23:29:16'),
(10, 3, 0, '													', 'test', '2022-05-29', '23:29:00', '00:29:00', 3, -23, '2022-05-28 23:30:08'),
(11, 3, 0, 'gfs', 'test1', '2022-05-28', '15:32:00', '17:32:00', 3, 2, '2022-05-28 23:33:01'),
(16, 3, 0, '', '', '2022-06-12', '04:41:55', '05:41:55', 3, 1, '2022-06-12 04:44:50'),
(24, 12, 8, 'berhasil?', 'coba 12', '2022-06-05', '21:15:00', '22:15:00', 1, 1, '2022-06-12 21:15:52'),
(25, 3, 17, '													', 'uji coba', '2022-06-13', '07:00:00', '10:00:00', 1, 3, '2022-06-13 17:12:22'),
(26, 3, 17, '													', 'coba baru', '2022-06-13', '07:48:00', '10:48:00', 1, 3, '2022-06-13 20:48:27'),
(27, 3, 17, 'testing', 'tes 31', '2022-06-14', '09:22:00', '11:22:00', 3, 2, '2022-06-14 09:22:56'),
(29, 17, 20, '													', 'uji coba', '2022-06-15', '09:57:00', '10:57:00', 1, 1, '2022-06-15 09:58:02'),
(30, 17, 21, '													', 'uji coba 2', '2022-06-15', '09:59:00', '13:00:00', 1, 4, '2022-06-15 09:59:40'),
(31, 18, 22, '													', 'ui/IX', '2022-06-15', '11:27:00', '00:28:00', 1, -11, '2022-06-15 11:28:17'),
(32, 17, 21, '													', 'membuat interfance', '2022-06-15', '11:56:00', '00:56:00', 1, -11, '2022-06-15 11:56:47'),
(33, 19, 25, '													', 'tampilan awal aplikasi', '2022-06-22', '10:11:00', '11:11:00', 1, 1, '2022-06-22 10:11:29'),
(34, 19, 26, '													', 'halaman dashboard', '2022-06-23', '10:13:00', '11:14:00', 1, 1, '2022-06-22 10:14:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project_list`
--
ALTER TABLE `project_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_list`
--
ALTER TABLE `task_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_productivity`
--
ALTER TABLE `user_productivity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `project_list`
--
ALTER TABLE `project_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task_list`
--
ALTER TABLE `task_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_productivity`
--
ALTER TABLE `user_productivity`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
