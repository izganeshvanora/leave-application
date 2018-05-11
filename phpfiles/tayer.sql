-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2018 at 03:57 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tayer`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `emp_id` int(11) NOT NULL,
  `day_date` date NOT NULL,
  `check_in` timestamp(2) NOT NULL DEFAULT CURRENT_TIMESTAMP(2) ON UPDATE CURRENT_TIMESTAMP(2),
  `check_out` timestamp(2) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`emp_id`, `day_date`, `check_in`, `check_out`) VALUES
(1, '2018-05-10', '2018-05-09 22:44:13.00', '2018-05-09 22:48:29.02'),
(2, '2018-05-01', '2018-05-11 13:06:02.66', '2018-05-11 03:56:18.00'),
(3, '2018-04-02', '2018-04-01 22:42:11.00', '2018-04-03 09:59:35.00'),
(4, '2017-11-01', '2017-10-31 20:38:09.00', '2017-11-01 02:49:18.00');

-- --------------------------------------------------------

--
-- Table structure for table `leave_application`
--

CREATE TABLE `leave_application` (
  `emp_id` int(11) NOT NULL,
  `reason` varchar(225) NOT NULL,
  `from_date` date NOT NULL,
  `to_leave` date NOT NULL,
  `no_of_days` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_application`
--

INSERT INTO `leave_application` (`emp_id`, `reason`, `from_date`, `to_leave`, `no_of_days`) VALUES
(1, 'fever', '2018-05-15', '2018-05-16', 2),
(2, 'stomach ace ', '2018-05-21', '2018-05-21', 1),
(3, 'family function', '2018-05-16', '2018-05-19', 4),
(4, 'tour', '2018-05-24', '2018-05-26', 3);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `slno_empid` int(11) NOT NULL,
  `emp_name` varchar(35) NOT NULL,
  `bio_metric` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `emp_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`slno_empid`, `emp_name`, `bio_metric`, `password`, `emp_pic`) VALUES
(1, 'john doe 1', 'a', 'asd', 'https://ibb.co/ehr95d'),
(2, 'john doe 2', 'b', 'asd', 'https://ibb.co/emGyyy'),
(3, 'john doe 3', 'a', 'asd', 'https://ibb.co/ehr95d'),
(4, 'john doe 4', 'a', 'asd', 'https://ibb.co/emGyyy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `leave_application`
--
ALTER TABLE `leave_application`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`slno_empid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `slno_empid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `login` (`slno_empid`);

--
-- Constraints for table `leave_application`
--
ALTER TABLE `leave_application`
  ADD CONSTRAINT `leave_application_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `login` (`slno_empid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
