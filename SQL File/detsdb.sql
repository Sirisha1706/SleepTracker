-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2021 at 11:17 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `detsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblexpense`
--

CREATE TABLE `tblexpense` (
  `ID` int(10) NOT NULL,
  `UserId` int(10) NOT NULL,
  `NoteDate` timestamp NULL DEFAULT current_timestamp(),
  `SleepDate` date DEFAULT NULL,
  `SleepTime` time DEFAULT NULL,
  `WakeTime` time DEFAULT NULL,
  `Duration` text DEFAULT NULL,
  `DurFloat` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblexpense`
--

INSERT INTO `tblexpense` (`ID`, `UserId`, `NoteDate`, `SleepDate`, `SleepTime`, `WakeTime`, `Duration`, `DurFloat`) VALUES
(98, 11, '2021-06-08 15:48:38', '2021-06-05', '23:27:00', '08:32:00', '10hr  55min', NULL),
(99, 11, '2021-06-08 15:52:51', '2021-06-06', '23:24:00', '17:53:00', '19hr  31min', NULL),
(100, 11, '2021-06-08 15:55:58', '2021-06-02', '21:26:00', '05:30:00', '9hr  56min', 8.06667),
(101, 11, '2021-06-08 15:56:54', '2021-06-01', '22:26:00', '07:26:00', '9hr  0min', 9),
(102, 11, '2021-06-08 15:59:28', '2021-06-07', '21:30:00', '09:40:00', '12hr  10min', 11.8333),
(103, 11, '2021-06-08 16:02:05', '2021-06-03', '21:30:00', '09:41:00', '12hr  11min', 0),
(104, 11, '2021-06-08 16:03:10', '2021-06-02', '21:33:00', '07:43:00', '14hr  10min', 0),
(108, 11, '2021-06-08 16:16:57', '2021-06-04', '21:46:00', '07:56:00', '10hr  10min', 10.1667),
(110, 12, '2021-06-11 07:01:24', '2021-06-05', '12:31:00', '14:40:00', '2hr  9min', 2.15);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `ID` int(10) NOT NULL,
  `FullName` varchar(150) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`ID`, `FullName`, `Email`, `MobileNumber`, `Password`, `RegDate`) VALUES
(8, 'Test', 'test@gmail.com', 5656556565, '202cb962ac59075b964b07152d234b70', '2019-05-17 05:34:16'),
(10, 'Test User demo', 'testuser@gmail.com', 987654321, 'f925916e2754e5e03f75dd58a5733251', '2019-05-18 05:34:53'),
(11, 'phon says', 'okok@okok.ok', 9876543210, '0bb1800607ffd19151717f5266b3a738', '2021-06-05 19:09:31'),
(12, 'test user1', 'test1@test.com', 9876543210, '0bb1800607ffd19151717f5266b3a738', '2021-06-11 06:53:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblexpense`
--
ALTER TABLE `tblexpense`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblexpense`
--
ALTER TABLE `tblexpense`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
