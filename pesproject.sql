-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2017 at 07:14 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pesproject`
--
CREATE DATABASE IF NOT EXISTS `pesproject` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pesproject`;

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE `organisation` (
  `id` int(11) NOT NULL,
  `name` varchar(254) NOT NULL,
  `address` varchar(128) NOT NULL,
  `town` varchar(64) NOT NULL,
  `postcode` varchar(32) NOT NULL,
  `country` varchar(128) NOT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organisation`
--

INSERT INTO `organisation` (`id`, `name`, `address`, `town`, `postcode`, `country`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Disney', '1 Main Street', 'Los Angeles', 'la1 1al', 'USA', '5551234', '2017-06-23 22:00:00', '2017-06-25 14:32:10'),
(2, 'BBC', 'Portland Place ', 'London', 'W1A 1AA', 'UK', '08444530231', '2017-06-23 22:00:00', '2017-06-25 14:32:10'),
(3, 'Chris Ltd', 'Grootzeilhof 116', 'Amsterdam', '1034 MB', 'The Netherlands', '31642154004', '2017-06-23 22:00:00', '2017-06-25 14:32:10'),
(5, 'test company', 'address 1', 'newtown', 'nt1 1tn', 'Canada', '23455678877', '2017-06-25 14:37:41', '2017-06-25 14:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(16) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2017-06-23 22:00:00', '2017-06-25 14:35:09'),
(2, 'Employer', '2017-06-23 22:00:00', '2017-06-25 14:35:09'),
(3, 'Employee', '2017-06-23 22:00:00', '2017-06-25 14:35:09');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `address` varchar(128) DEFAULT NULL,
  `town` varchar(32) DEFAULT NULL,
  `postcode` varchar(16) DEFAULT NULL,
  `country` varchar(32) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `email` varchar(64) NOT NULL,
  `empID` varchar(8) DEFAULT NULL,
  `password` varchar(8) NOT NULL,
  `role` tinyint(1) NOT NULL,
  `organisation` tinyint(1) NOT NULL,
  `dob` varchar(16) DEFAULT NULL,
  `probation` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `address`, `town`, `postcode`, `country`, `phone`, `email`, `empID`, `password`, `role`, `organisation`, `dob`, `probation`, `created_at`, `updated_at`) VALUES
(1, 'Mickey', 'Mouse', '2 Main Street', 'Paris', '456789', 'France', '5552345', 'mickie@disney.com', 'DIS001', 'qwerty', 2, 1, '18-11-1928', 0, '2017-06-23 22:00:00', '2017-06-25 14:33:21'),
(2, 'Minnie', 'Mouse', '2 Main Street', 'Paris', '456789', 'France', '5552345', 'minnie@disney.com', 'DIS002', 'zxcvbn', 3, 1, '18-11-1928', 0, '2017-06-23 22:00:00', '2017-06-25 14:33:21'),
(4, 'Chris', 'Saunders', 'Grootzeilhof 116', 'Amsterdam', '1034 MB', 'The Netherlands', '31642154004', 'chris@chris.com', '001', 'qwerty', 1, 3, '04-01-1962', 0, '2017-06-23 22:00:00', '2017-06-25 14:33:21'),
(5, 'Lenny', 'Henry', '4 The High Street', 'Dudley', 'DU1 1LE', 'UK', '012345678', 'lenny@bbc.co.uk', 'BBC002', 'qwerty', 3, 2, '29-08-1958', 0, '2017-06-23 22:00:00', '2017-06-25 14:33:21'),
(6, 'Tony', 'Hall', '1 Letsbe Ave', 'Birkenhead', 'BK1 1KB', 'UK', '0198776543', 'th@bbc.co.uk', 'BBC001', 'qwerty', 2, 2, '03-03-1951', 0, '2017-06-23 22:00:00', '2017-06-25 14:33:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `organisation`
--
ALTER TABLE `organisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
