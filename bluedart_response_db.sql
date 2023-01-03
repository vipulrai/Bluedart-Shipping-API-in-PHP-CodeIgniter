-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2023 at 06:53 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antesports`
--

-- --------------------------------------------------------

--
-- Table structure for table `bluedart_response_db`
--

CREATE TABLE `bluedart_response_db` (
  `id` int(11) NOT NULL,
  `AWBNo` varchar(200) NOT NULL,
  `AWBPrintContent` longblob NOT NULL,
  `AvailableAmountForBooking` varchar(150) NOT NULL,
  `AvailableBalance` varchar(150) NOT NULL,
  `CCRCRDREF` varchar(100) NOT NULL,
  `DestinationArea` varchar(50) NOT NULL,
  `DestinationLocation` varchar(50) NOT NULL,
  `IsError` varchar(150) NOT NULL,
  `IsErrorInPU` varchar(150) NOT NULL,
  `ShipmentPickupDate` varchar(200) NOT NULL,
  `Status_WayBill_StatusCode` varchar(150) NOT NULL,
  `Status_Pickup_StatusCode` varchar(200) NOT NULL,
  `TokenNumber` varchar(200) NOT NULL,
  `TransactionAmount` varchar(150) NOT NULL,
  `rmanumber` varchar(150) NOT NULL,
  `date` varchar(150) NOT NULL,
  `status` int(11) NOT NULL,
  `full_result` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bluedart_response_db`
--
ALTER TABLE `bluedart_response_db`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bluedart_response_db`
--
ALTER TABLE `bluedart_response_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
