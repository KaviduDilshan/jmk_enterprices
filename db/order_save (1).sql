-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2025 at 04:51 AM
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
-- Database: `jmk_hire`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_save`
--

CREATE TABLE `order_save` (
  `os_id` int(11) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL,
  `gu_id_1` int(11) DEFAULT NULL,
  `gu_id_2` int(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `order_time` time DEFAULT NULL,
  `total_price` decimal(13,2) DEFAULT NULL,
  `order_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_save`
--

INSERT INTO `order_save` (`os_id`, `order_id`, `c_id`, `gu_id_1`, `gu_id_2`, `order_date`, `order_time`, `total_price`, `order_status`) VALUES
(1, '19725564928897984', 60, 1, 1, '2025-06-27', '08:03:17', 16940.00, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_save`
--
ALTER TABLE `order_save`
  ADD PRIMARY KEY (`os_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_save`
--
ALTER TABLE `order_save`
  MODIFY `os_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
