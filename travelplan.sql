-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 07, 2023 at 12:26 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TravelPlan`
--

-- --------------------------------------------------------

--
-- Table structure for table `travelplan`
--

CREATE TABLE `travelplan` (
  `ID` int(8) NOT NULL,
  `City` varchar(32) NOT NULL,
  `Country` varchar(32) NOT NULL,
  `Year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `travelplan`
--

INSERT INTO `travelplan` (`ID`, `City`, `Country`, `Year`) VALUES
(1, '', '', 0),
(2, '', '', 0),
(3, '', '', 0),
(4, '', '', 0),
(5, '', '', 0),
(6, 'Vancouver', 'Vancouver', 2022),
(7, 'Vancouver', 'Vancouver', 2022),
(8, 'Vancouver', 'Vancouver', 2022),
(9, 'Vancouver', 'Canada', 2022);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `travelplan`
--
ALTER TABLE `travelplan`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `travelplan`
--
ALTER TABLE `travelplan`
  MODIFY `ID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
