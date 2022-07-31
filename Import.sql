-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 31, 2022 at 11:39 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restful_seven`
--
CREATE DATABASE IF NOT EXISTS `restful_seven` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `restful_seven`;

-- --------------------------------------------------------

--
-- Table structure for table `Countries`
--

CREATE TABLE `Countries` (
  `id` int(11) NOT NULL,
  `continent_code` varchar(20) NOT NULL,
  `currency_code` varchar(20) NOT NULL,
  `iso2_code` varchar(20) NOT NULL,
  `iso3_code` varchar(20) NOT NULL,
  `iso_numeric_code` varchar(20) NOT NULL,
  `fips_code` varchar(20) NOT NULL,
  `calling_code` varchar(20) NOT NULL,
  `common_name` varchar(255) NOT NULL,
  `official_name` varchar(255) NOT NULL,
  `endonym` varchar(255) NOT NULL,
  `demonym` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Currencies`
--

CREATE TABLE `Currencies` (
  `id` int(11) NOT NULL,
  `iso_code` varchar(20) NOT NULL,
  `iso_numeric_code` varchar(20) NOT NULL,
  `common_name` varchar(255) NOT NULL,
  `official_name` varchar(255) NOT NULL,
  `symbol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Countries`
--
ALTER TABLE `Countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Currencies`
--
ALTER TABLE `Currencies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Countries`
--
ALTER TABLE `Countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1191;

--
-- AUTO_INCREMENT for table `Currencies`
--
ALTER TABLE `Currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=451;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
