-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2022 at 05:24 PM
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
-- Database: `fuelinfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `petrolrecord`
--

CREATE TABLE `petrolrecord` (
  `recordid` int(11) NOT NULL,
  `provider` mediumtext NOT NULL,
  `stationName` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `town` mediumtext NOT NULL,
  `stationAddress` longtext NOT NULL,
  `stationPhone` int(11) NOT NULL,
  `date` date NOT NULL,
  `isBasedOnLastNumber` mediumtext NOT NULL,
  `numberRange` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petrolrecord`
--

INSERT INTO `petrolrecord` (`recordid`, `provider`, `stationName`, `district`, `town`, `stationAddress`, `stationPhone`, `date`, `isBasedOnLastNumber`, `numberRange`) VALUES
(1, 'ceypetco', 'Thirunelveli', 'Jaffna', 'Jaffna', 'Thirunelveli Station', 779900058, '2022-07-24', 'no', 'All'),
(2, 'ceypetco', 'Chundikuli', 'Jaffna', 'Chundikuli', 'MPCS Station', 772116778, '2022-07-25', 'yes', '5-9'),
(3, 'ceypetco', 'Kaithadi', 'Jaffna', 'Kaitadi', 'Kaithadi Station', 772116778, '2022-07-25', 'yes', '5-9'),
(4, 'ceypetco', 'Jaffna Town', 'Jaffna', 'Jaffna', 'Stanly Road', 77568756, '2022-07-25', 'yes', '1-5'),
(5, 'ceypetco', 'sg', 'Monaragala', 'Angunakolawewa', 'sg', 0, '2022-07-25', 'yes', 'sdg'),
(6, '', 'sg', 'Monaragala', 'Angunakolawewa', 'sg', 0, '2022-07-25', 'yes', 'sdg'),
(7, 'Ceypetco', 'ABC', 'Jaffna', 'Jaffna', 'Jaffna', 212222222, '2022-07-31', 'yes', '5-9'),
(8, 'Ceypetco', 'ABC', 'Jaffna', 'Chundikuli', 'Jaffna', 212222222, '2022-07-31', 'no', 'All');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `fueluserid` int(11) NOT NULL,
  `firstname` longtext NOT NULL,
  `lastname` longtext NOT NULL,
  `district` mediumtext NOT NULL,
  `town` mediumtext NOT NULL,
  `email` longtext NOT NULL,
  `password` longtext NOT NULL,
  `usertype` mediumtext NOT NULL,
  `resetText` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`fueluserid`, `firstname`, `lastname`, `district`, `town`, `email`, `password`, `usertype`, `resetText`) VALUES
(1, 'Mathesh', 'Sivanantham', 'Jaffna', 'Jaffna', 'admin@mail.com', '$2y$10$cPqej80HfMUTtMD3SLqwg..BsuO5sf33XLKUfQVdEQbfUvkv0b8ay', 'admin', ''),
(3, 'Mathesh', 'Yogeswaran', 'Jaffna', 'Chundikuli', 'm@mail.com', '$2y$10$FFLQHke1ab0Fiazc3GHTRe1cfm1Z16/S1TfM29qHFR8W8.XTvZiki', 'user', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `petrolrecord`
--
ALTER TABLE `petrolrecord`
  ADD PRIMARY KEY (`recordid`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`fueluserid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `petrolrecord`
--
ALTER TABLE `petrolrecord`
  MODIFY `recordid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `fueluserid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
