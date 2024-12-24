-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2024 at 08:53 PM
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
-- Database: `secure_gate_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `gated_admin`
--

CREATE TABLE `gated_admin` (
  `id` int(11) NOT NULL,
  `gated_name` varchar(255) NOT NULL,
  `gated_address` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gated_admin`
--

INSERT INTO `gated_admin` (`id`, `gated_name`, `gated_address`, `name`, `mobile`, `email`, `pass`, `date_time`) VALUES
(1, 'Hampton Square', 'Near Parul Appt, Fatehgunj Vadodara 390002', 'MD', '987654321', 'admin@test.com', '$2y$10$SkGE9hLnsJKGFqyimtPj/uQ2IxqaTbytC3YRVByGMVBFzrUCzDBs6', '2024-09-09 00:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `gated_amenities`
--

CREATE TABLE `gated_amenities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gated_amenities`
--

INSERT INTO `gated_amenities` (`id`, `name`, `date_time`) VALUES
(1, 'Hall', '2024-09-23 22:04:00'),
(2, 'Pool', '2024-09-23 22:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `gated_amenities_booking`
--

CREATE TABLE `gated_amenities_booking` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `house` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `amenity` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gated_amenities_booking`
--

INSERT INTO `gated_amenities_booking` (`id`, `name`, `house`, `mobile`, `email`, `amenity`, `date`, `time`, `status`, `date_time`) VALUES
(1, 'Md', '101', '9999999999', 'md@test.com', 'Pool', '2024-09-23', '02:12:00', 'Accepted', '2024-09-24 00:13:13'),
(2, 'Md', '205', '9999999999', 'md@test.com', 'Hall', '2024-09-23', '01:14:00', 'Accepted', '2024-09-24 00:14:04'),
(6, 'Md', 'A - 203', '9999999999', 'md@test.com', 'Pool', '2024-10-03', '00:53:00', 'Rejected', '2024-09-24 00:50:20'),
(7, 'Md', 'A - 203', '9999999999', 'md@test.com', 'Pool', '2024-10-01', '07:24:00', 'Accepted', '2024-09-24 07:24:45');

-- --------------------------------------------------------

--
-- Table structure for table `gated_inquiries`
--

CREATE TABLE `gated_inquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `house` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` varchar(700) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gated_inquiries`
--

INSERT INTO `gated_inquiries` (`id`, `name`, `house`, `email`, `mobile`, `subject`, `body`, `date_time`) VALUES
(3, 'Md', 'A - 203', 'md@test.com', '9999999999', 'test', 'testing', '2024-09-24 08:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `gated_notice`
--

CREATE TABLE `gated_notice` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` varchar(700) NOT NULL,
  `doc_img` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gated_notice`
--

INSERT INTO `gated_notice` (`id`, `subject`, `body`, `doc_img`, `date_time`) VALUES
(1, 'This is for urgent Meating in Club House', 'Hsudjz hc hbub yjc. Uc HDD HDD HDD HDD HDD diff ho su TDY dv dei if su udh it sh yeh su reh ha toh vi gchi FB ku tu hav ucch gchi ucch to je db HDFC hu fruit su udh u too ha fun it sh ha hu give by FB jgh HV hu FB ku gg HB di truth hu eng gg jy ho he thi din hu hbe hi HDFC Judit to ha ghr DH ha ej ke ek je db ha ghr tu he DNT fruit fish he rush hath uth he thrur hu te tu yeh he thi us frk yet ugg rit tu he th hu jab ucch dh he th bf und tu hav hy aaaaas', '', '2024-09-17 06:37:56');

-- --------------------------------------------------------

--
-- Table structure for table `gated_rep_ser`
--

CREATE TABLE `gated_rep_ser` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gated_rep_ser`
--

INSERT INTO `gated_rep_ser` (`id`, `name`, `mobile`, `role`, `date_time`) VALUES
(3, 'Raju', '9898989898', 'Plumber', '2024-10-09 18:56:42');

-- --------------------------------------------------------

--
-- Table structure for table `gated_resident`
--

CREATE TABLE `gated_resident` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `members` varchar(255) NOT NULL,
  `fourwheeler` varchar(255) NOT NULL,
  `twowheeler` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `block` varchar(255) NOT NULL,
  `housenum` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gated_resident`
--

INSERT INTO `gated_resident` (`id`, `name`, `email`, `mobile`, `pass`, `members`, `fourwheeler`, `twowheeler`, `status`, `block`, `housenum`, `date_time`) VALUES
(1, 'Md', 'md@test.com', '9999999999', '$2y$10$eYl0tTGzjJqPFgawndWmgO6Au3VZIJ.S8XbH.mzkKMNtRf3krCiEu', '5', '2', '2', 'Owner', 'A', '203', '2024-09-13 23:35:20'),
(6, 'Mohammad', 'test@test.test', '1234567890', '$2y$10$FNKtz4mAr19QYfENiuZ/JOsH/4gwOkPyaBnGm9c/JZgZPHIcZtLc6', '4', '2', '3', 'Owner', 'NA', '203', '2024-09-25 21:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `gated_staff`
--

CREATE TABLE `gated_staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `address` varchar(500) NOT NULL,
  `img` varchar(255) NOT NULL,
  `doc_img` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gated_staff`
--

INSERT INTO `gated_staff` (`id`, `name`, `email`, `mobile`, `pass`, `role`, `address`, `img`, `doc_img`, `date_time`) VALUES
(4, 'Imdad Aghariya ', 'imdad@gmail.com', '9999999999', '$2y$10$rxEGzx.M/GHx3l4fADjrAukqSvNmSuKxvN.fkNt5/SseA/7bLk1E.', 'Watch man', '203, Hampden to the office and will be able to see you by the way to the office ', 'IMG-20240916-WA0001.jpg', 'IMG-20240914-WA0000.jpg', '2024-09-17 01:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `gated_visitors`
--

CREATE TABLE `gated_visitors` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `members` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `fourWheeler` varchar(255) NOT NULL,
  `twoWheeler` varchar(255) NOT NULL,
  `verification_code` varchar(255) NOT NULL,
  `res_name` varchar(255) NOT NULL,
  `res_house` varchar(255) NOT NULL,
  `res_mobile` varchar(255) NOT NULL,
  `res_email` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gated_visitors`
--

INSERT INTO `gated_visitors` (`id`, `status`, `name`, `mobile`, `members`, `date`, `time`, `fourWheeler`, `twoWheeler`, `verification_code`, `res_name`, `res_house`, `res_mobile`, `res_email`, `date_time`) VALUES
(1, '1', 'Sajid', '1234567890', '5', '2024-09-24', '09:40', '5', '0', '000001', 'Md', 'A - 203', '9999999999', 'md@test.com', '2024-09-24 09:39:41'),
(3, '1', 'Md', '9999999999', '2', '2024-09-25', '01:17', '1', '0', '82657', 'Md', 'A - 203', '9999999999', 'md@test.com', '2024-09-25 01:17:44'),
(4, '1', 'Test', '9876543210', '2', '2024-10-09', '18:58', '2', '0', '620822', 'Md', 'A - 203', '9999999999', 'md@test.com', '2024-10-09 18:58:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gated_admin`
--
ALTER TABLE `gated_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gated_amenities`
--
ALTER TABLE `gated_amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gated_amenities_booking`
--
ALTER TABLE `gated_amenities_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gated_inquiries`
--
ALTER TABLE `gated_inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gated_notice`
--
ALTER TABLE `gated_notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gated_rep_ser`
--
ALTER TABLE `gated_rep_ser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gated_resident`
--
ALTER TABLE `gated_resident`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gated_staff`
--
ALTER TABLE `gated_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gated_visitors`
--
ALTER TABLE `gated_visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gated_admin`
--
ALTER TABLE `gated_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gated_amenities`
--
ALTER TABLE `gated_amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gated_amenities_booking`
--
ALTER TABLE `gated_amenities_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gated_inquiries`
--
ALTER TABLE `gated_inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gated_notice`
--
ALTER TABLE `gated_notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gated_rep_ser`
--
ALTER TABLE `gated_rep_ser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gated_resident`
--
ALTER TABLE `gated_resident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gated_staff`
--
ALTER TABLE `gated_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gated_visitors`
--
ALTER TABLE `gated_visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
