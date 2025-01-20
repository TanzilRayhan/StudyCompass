-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2025 at 12:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studycompass`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_applications`
--

CREATE TABLE `user_applications` (
  `application_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `application_number` varchar(255) NOT NULL,
  `status` enum('Pending','Reviewed','Accepted','Rejected') DEFAULT 'Pending',
  `response` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_applications`
--

INSERT INTO `user_applications` (`application_id`, `username`, `application_number`, `status`, `response`) VALUES
(1, 'john', 'APP12345', 'Pending', 'Congratulations, your application is accepted'),
(2, 'robin', 'APP67890', 'Reviewed', 'Application under review'),
(3, 'john', 'aabc1', 'Pending', 'Waiting for admin review'),
(7, 'john', 'qk691', 'Pending', 'Waiting for admin review');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_applications`
--
ALTER TABLE `user_applications`
  ADD PRIMARY KEY (`application_id`),
  ADD UNIQUE KEY `application_number` (`application_number`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_applications`
--
ALTER TABLE `user_applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_applications`
--
ALTER TABLE `user_applications`
  ADD CONSTRAINT `user_applications_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
