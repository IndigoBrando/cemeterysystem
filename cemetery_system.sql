-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 07:07 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cemetery_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `role`, `first_name`, `last_name`, `created_at`, `email`, `contact_number`, `sex`, `middle_name`) VALUES
(5, 'Manager', '$2y$10$bjJIdBX3VnhXq1DI.C6LBOazJROpZotF0Lbflm2Va5o9eyql3gWbS', 'Manager', 'Marjohn', 'Bayla', '2023-12-11 06:58:50', 'mj@gmail.com', '09696320124', 'Male', 'Mundas');

-- --------------------------------------------------------

--
-- Table structure for table `graves`
--

CREATE TABLE `graves` (
  `id` int(11) NOT NULL,
  `square_meters` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Available',
  `image_path` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `graves`
--

INSERT INTO `graves` (`id`, `square_meters`, `status`, `image_path`, `type`) VALUES
(1, 100, 'Reserved', 'img/grave1.jpg', 'Regular'),
(2, 120, 'Available', 'img/grave1.jpg', 'Regular'),
(3, 150, 'Available', 'img/grave1.jpg', 'Regular'),
(4, 80, 'Available', 'img/grave1.jpg', 'Regular'),
(5, 50, 'Available', 'img/grave1.jpg', 'Regular'),
(6, 180, 'Available', 'img/grave1.jpg', 'Regular'),
(7, 160, 'Available', 'img/grave1.jpg', 'Regular'),
(8, 140, 'Available', 'img/grave1.jpg', 'Regular'),
(9, 130, 'Available', 'img/grave2.jpg', 'Cemented'),
(10, 110, 'Available', 'img/grave2.jpg', 'Cemented'),
(11, 90, 'Available', 'img/grave2.jpg', 'Cemented'),
(12, 170, 'Reserved', 'img/grave2.jpg', 'Cemented'),
(13, 190, 'Available', 'img/grave2.jpg', 'Cemented'),
(14, 175, 'Available', 'img/grave2.jpg', 'Cemented'),
(15, 195, 'Available', 'img/grave2.jpg', 'Cemented'),
(16, 185, 'Available', 'img/grave3.jpg', 'House'),
(17, 155, 'Available', 'img/grave3.jpg', 'House'),
(18, 125, 'Available', 'img/grave3.jpg', 'House'),
(19, 150, 'Available', 'img/grave2.jpg', 'Cemented');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `graveyard_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `password`, `first_name`, `last_name`, `contact_number`, `email`, `sex`, `registration_date`, `graveyard_id`, `status`, `birthday`, `middle_name`) VALUES
(7, 'MBYL', '$2y$10$aWUNnor.MZgSmIQ.mUKlve.6zXUgbLA5NLVGATaVhGHVlTuOWegJ6', 'Marjohn', 'Bayla', '09613799175', 'mj@gmail.com', 'Male', '2023-12-12 17:57:11', 1, 'approved', '2222-02-22', 'Mundas'),
(8, 'Chan', '$2y$10$Tg0A80kItQAAH40VrRsEN.ILKv23EunBGHmfZlSTeczdj43ORgC/C', 'Christian', 'Malimit', '09613799175', 'chan@gmail.com', 'Male', '2023-12-12 18:03:08', 12, 'pending', '1211-02-21', 'Paul');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `image`, `description`, `created`, `modified`) VALUES
(1, 'natures1.jpg', 'Nature1 images', '2017-07-29 00:00:00', '2017-07-29 00:00:00'),
(2, 'natures2.jpg', 'nature 2 images', '2017-07-29 00:00:00', '2017-07-29 00:00:00'),
(3, 'natures3.jpg', 'nature3 images', '2017-07-29 00:00:00', '2017-07-29 00:00:00'),
(4, 'naturess4.jpg', 'nature4 images', '2017-07-29 00:00:00', '2017-07-29 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `graves`
--
ALTER TABLE `graves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_members_graves` (`graveyard_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `graves`
--
ALTER TABLE `graves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `FK_members_graves` FOREIGN KEY (`graveyard_id`) REFERENCES `graves` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `members` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
