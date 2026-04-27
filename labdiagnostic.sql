-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2026 at 11:09 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `labdiagnostic`
--

-- --------------------------------------------------------

--
-- Table structure for table `clinicstaff`
--

CREATE TABLE `clinicstaff` (
  `id` int NOT NULL,
  `empid` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mi` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prc` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alternate` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `datehired` date DEFAULT NULL,
  `address` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `encodedby` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clinicstaff`
--

INSERT INTO `clinicstaff` (`id`, `empid`, `firstname`, `lastname`, `mi`, `extension`, `designation`, `prc`, `mobile`, `alternate`, `datehired`, `address`, `encodedby`) VALUES
(1, 'CS0001', 'Dela Cruz', 'Juan', 'B', '', 'Medical Technologist', '12345', '09199949717', '', '2026-03-02', 'Bacolod City', 'EM00001'),
(2, 'CS0002', 'Reyes', 'Maria', 'C', '', 'Laboratory Manager', '12345', '', '', NULL, 'Bacolod', 'EM00001');

-- --------------------------------------------------------

--
-- Table structure for table `logintracker`
--

CREATE TABLE `logintracker` (
  `id` int NOT NULL,
  `empid` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cdate` date NOT NULL,
  `ctime` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cday` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logintracker`
--

INSERT INTO `logintracker` (`id`, `empid`, `cdate`, `ctime`, `cday`) VALUES
(1, 'EM00001', '2026-02-16', '10:47 AM', 'Monday'),
(2, 'EM00001', '2026-02-16', '10:48 AM', 'Monday'),
(3, 'EM00001', '2026-02-16', '10:52 AM', 'Monday'),
(4, 'EM00001', '2026-02-16', '11:03 AM', 'Monday'),
(5, 'EM00001', '2026-02-16', '11:11 AM', 'Monday'),
(6, 'EM00001', '2026-02-16', '11:57 AM', 'Monday'),
(7, 'EM00001', '2026-02-16', '12:00 PM', 'Monday'),
(8, 'EM00001', '2026-02-16', '03:28 PM', 'Monday'),
(9, 'EM00001', '2026-02-16', '03:45 PM', 'Monday'),
(10, 'EM00001', '2026-02-16', '03:52 PM', 'Monday'),
(11, 'EM00001', '2026-02-16', '04:00 PM', 'Monday'),
(12, 'EM00001', '2026-02-16', '04:08 PM', 'Monday'),
(13, 'EM00001', '2026-02-16', '04:14 PM', 'Monday'),
(14, 'EM00001', '2026-02-16', '04:16 PM', 'Monday'),
(15, 'EM00001', '2026-02-16', '04:22 PM', 'Monday'),
(16, 'EM00001', '2026-02-16', '04:27 PM', 'Monday'),
(17, 'EM00001', '2026-02-16', '04:35 PM', 'Monday'),
(18, 'EM00001', '2026-03-01', '11:50 PM', 'Sunday'),
(19, 'EM00001', '2026-03-08', '01:24 PM', 'Sunday'),
(20, 'EM00001', '2026-03-08', '10:22 PM', 'Sunday'),
(21, 'EM00001', '2026-03-08', '10:31 PM', 'Sunday'),
(22, 'EM00001', '2026-03-08', '10:46 PM', 'Sunday'),
(23, 'EM00001', '2026-03-12', '01:32 AM', 'Thursday'),
(24, 'EM00001', '2026-03-12', '01:45 AM', 'Thursday'),
(25, 'EM00001', '2026-03-22', '11:13 PM', 'Sunday'),
(26, 'EM00001', '2026-03-22', '11:16 PM', 'Sunday'),
(27, 'EM00001', '2026-03-22', '11:24 PM', 'Sunday'),
(28, 'EM00001', '2026-03-22', '11:25 PM', 'Sunday'),
(29, 'EM00001', '2026-03-22', '11:29 PM', 'Sunday'),
(30, 'EM00001', '2026-03-23', '12:16 AM', 'Monday'),
(31, 'EM00001', '2026-03-23', '12:45 AM', 'Monday'),
(32, 'EM00001', '2026-03-23', '12:48 AM', 'Monday'),
(33, 'EM00001', '2026-03-23', '12:58 AM', 'Monday'),
(34, 'EM00001', '2026-03-23', '01:02 AM', 'Monday'),
(35, 'EM00001', '2026-03-23', '01:21 AM', 'Monday'),
(36, 'EM00001', '2026-03-23', '01:26 AM', 'Monday'),
(37, 'EM00001', '2026-03-23', '01:35 AM', 'Monday'),
(38, 'EM00001', '2026-03-23', '01:38 AM', 'Monday'),
(39, 'EM00001', '2026-03-23', '01:50 AM', 'Monday'),
(40, 'EM00001', '2026-03-23', '01:57 AM', 'Monday'),
(41, 'EM00001', '2026-03-23', '02:00 AM', 'Monday'),
(42, 'EM00001', '2026-03-23', '02:04 AM', 'Monday'),
(43, 'EM00001', '2026-03-23', '02:38 AM', 'Monday'),
(44, 'EM00001', '2026-03-23', '03:36 AM', 'Monday'),
(45, 'EM00001', '2026-03-29', '08:37 PM', 'Sunday'),
(46, 'EM00001', '2026-03-29', '09:00 PM', 'Sunday'),
(47, 'EM00001', '2026-03-29', '09:32 PM', 'Sunday'),
(48, 'EM00001', '2026-03-29', '09:32 PM', 'Sunday'),
(49, 'EM00001', '2026-03-29', '09:34 PM', 'Sunday'),
(50, 'EM00001', '2026-03-29', '09:55 PM', 'Sunday'),
(51, 'EM00001', '2026-03-29', '09:55 PM', 'Sunday'),
(52, 'EM00001', '2026-03-29', '09:59 PM', 'Sunday'),
(53, 'EM00001', '2026-03-29', '10:02 PM', 'Sunday'),
(54, 'EM00001', '2026-03-30', '07:46 AM', 'Monday'),
(55, 'EM00001', '2026-03-30', '08:20 AM', 'Monday'),
(56, 'EM00001', '2026-03-30', '08:32 AM', 'Monday'),
(57, 'EM00001', '2026-04-06', '08:47 AM', 'Monday'),
(58, 'EM00001', '2026-04-06', '08:49 AM', 'Monday'),
(59, 'EM00001', '2026-04-06', '09:09 AM', 'Monday'),
(60, 'EM00001', '2026-04-06', '12:33 PM', 'Monday'),
(61, 'EM00001', '2026-04-16', '01:46 PM', 'Thursday'),
(62, 'EM00001', '2026-04-16', '04:39 PM', 'Thursday'),
(63, 'EM00001', '2026-04-16', '05:25 PM', 'Thursday'),
(64, 'EM00001', '2026-04-16', '06:06 PM', 'Thursday'),
(65, 'EM00001', '2026-04-17', '01:07 AM', 'Friday'),
(66, 'EM00001', '2026-04-17', '01:22 AM', 'Friday'),
(67, 'EM00001', '2026-04-17', '02:02 AM', 'Friday'),
(68, 'EM00001', '2026-04-19', '07:05 PM', 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int NOT NULL,
  `patientid` varchar(10) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `mi` varchar(1) NOT NULL,
  `extension` varchar(35) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(6) NOT NULL,
  `nationality` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `alternate` varchar(45) NOT NULL,
  `address` varchar(80) NOT NULL,
  `encodedby` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `patientid`, `firstname`, `lastname`, `mi`, `extension`, `birthdate`, `gender`, `nationality`, `email`, `mobile`, `alternate`, `address`, `encodedby`) VALUES
(1, 'PI00000001', 'Juan', 'Dela Cruz', 'M', '', '2026-03-23', 'Male', 'Filipino', 'sample@gmail.com', '09199987675', 'Maria Dela Cruz', 'Bacolod City', 'EM00001'),
(2, 'PI00000002', 'Goldie Mae', 'Pacheco', 'J', '', '1979-11-14', 'Female', 'Filipino', '', '', '', '', 'EM00001');

-- --------------------------------------------------------

--
-- Table structure for table `userrights`
--

CREATE TABLE `userrights` (
  `id` int NOT NULL,
  `userid` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `empid` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `upassword` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userrights`
--

INSERT INTO `userrights` (`id`, `userid`, `empid`, `username`, `upassword`) VALUES
(1, 'U0001', 'EM00001', 'lab', 'lab');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clinicstaff`
--
ALTER TABLE `clinicstaff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logintracker`
--
ALTER TABLE `logintracker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empid` (`empid`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userrights`
--
ALTER TABLE `userrights`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userid` (`userid`),
  ADD KEY `empid` (`empid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clinicstaff`
--
ALTER TABLE `clinicstaff`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logintracker`
--
ALTER TABLE `logintracker`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userrights`
--
ALTER TABLE `userrights`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
