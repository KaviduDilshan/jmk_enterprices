-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 07:18 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `order_view`
--

CREATE TABLE `order_view` (
  `ov_id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `unit_price` decimal(13,2) NOT NULL,
  `total_amount` decimal(13,2) NOT NULL,
  `qty` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_view`
--

INSERT INTO `order_view` (`ov_id`, `order_id`, `pro_id`, `product_name`, `unit_price`, `total_amount`, `qty`) VALUES
(1, '0001', 2255, '4 legs Chair', '10000.00', '20000.00', '2.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_view`
--
ALTER TABLE `order_view`
  ADD PRIMARY KEY (`ov_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_view`
--
ALTER TABLE `order_view`
  MODIFY `ov_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
