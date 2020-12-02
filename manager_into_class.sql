-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2020 at 09:59 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manager_into_class`
--

-- --------------------------------------------------------

--
-- Table structure for table `discuss`
--

CREATE TABLE `discuss` (
  `email` varchar(50) NOT NULL,
  `content` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discuss`
--

INSERT INTO `discuss` (`email`, `content`) VALUES
('admin@gmail.com', 'af'),
('admin@gmail.com', 'asd'),
('admin@gmail.com', 'dddsa');

-- --------------------------------------------------------

--
-- Table structure for table `poster`
--

CREATE TABLE `poster` (
  `IDPost` int(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` varchar(100) DEFAULT NULL,
  `url` varchar(50) NOT NULL,
  `file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poster`
--

INSERT INTO `poster` (`IDPost`, `email`, `title`, `content`, `url`, `file`) VALUES
(8, 'admin@gmail.com', 'frdgsfdasd', 'ffdcv', '', NULL),
(9, 'admin@gmail.com', 'adaa', 'asd', '', NULL),
(10, 'admin@gmail.com', 'asd', 'dddsa', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_class`
--

CREATE TABLE `user_class` (
  `ID` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `active` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_class`
--

INSERT INTO `user_class` (`ID`, `email`, `active`) VALUES
('gv', 'admin@gmail.com', 0),
('gv', 'as@gmail.com', 0),
('st', 'duyntkh@gmail.com', 1),
('gv', 'duyntkhcm@gmail.com', 1),
('gv', 'sd@gmail.com', 0),
('st', 'st@gmail.com', 0),
('st', 'sv@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `discuss`
--
ALTER TABLE `discuss`
  ADD KEY `fk_iddiscuss` (`email`);

--
-- Indexes for table `poster`
--
ALTER TABLE `poster`
  ADD PRIMARY KEY (`IDPost`);

--
-- Indexes for table `user_class`
--
ALTER TABLE `user_class`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `poster`
--
ALTER TABLE `poster`
  MODIFY `IDPost` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `discuss`
--
ALTER TABLE `discuss`
  ADD CONSTRAINT `fk_iddiscuss` FOREIGN KEY (`email`) REFERENCES `user_class` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
