-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2025 at 09:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `study_compass`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(155) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `password`) VALUES
(1, 'admin', 'admin@email.com', 'admin', 'admin1234'),
(2, 'Tanzil Rayhan', 'tanzil@email.com', 'tanzil', 'tanzil1234'),
(3, 'Ariful Islam', 'arif@email.com', 'arif', 'arif1234'),
(4, 'Sabbir Sikder', 'sabbir@email.com', 'sabbir', 'sabbir1234'),
(5, 'Mofakkar Hossain Mahim', 'mahim@email.com', 'mahim', 'mahim1234'),
(7, 'random', 'random@email.com', 'random', 'random1234');

-- --------------------------------------------------------

--
-- Table structure for table `news_articles`
--

CREATE TABLE `news_articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_articles`
--

INSERT INTO `news_articles` (`id`, `title`, `category`, `content`) VALUES
(1, 'Global Scholarship Opportunities for 2025', 'Scholarships', 'As 2025 approaches, numerous universities and organizations are rolling out new scholarship opportunities for international students. \r\n  These scholarships cover a wide range of disciplines, allowing students from different academic backgrounds to apply. \r\n  Some notable programs include full-ride scholarships, partial funding, and specialized grants for research and innovation. \r\n  Students are encouraged to start their application process early and prepare strong personal statements and recommendation letters \r\n  to maximize their chances of success. Here is a detailed breakdown of the top 10 scholarships currently available and how to apply for them.'),
(2, 'Upcoming Changes to Visa Policies in 2024', 'Visa Updates', 'The new year will bring significant changes to the visa policies affecting international students. \r\n  Countries like the United States, Canada, and Australia are expected to introduce new requirements for student visas, \r\n  including financial proof, language proficiency tests, and stricter background checks. \r\n  These changes aim to enhance security measures and streamline the visa process, ensuring better integration of international students \r\n  into academic institutions. Prospective students must stay updated with the latest policy announcements and seek guidance from their \r\n  respective embassies or immigration offices.'),
(3, 'Ranking the Best Universities for Engineering in 2024', 'University Rankings', 'The 2024 university rankings have been released, showcasing the best institutions for engineering across the globe. \r\n  Massachusetts Institute of Technology (MIT) continues to lead the list, followed closely by Stanford and Cambridge. \r\n  The rankings are based on various criteria, including research output, student satisfaction, employability, and faculty expertise. \r\n  Aspiring engineers can use these rankings to identify the best programs that align with their career goals. \r\n  Additionally, many of these institutions offer generous funding packages and scholarships to attract top talent from around the world.'),
(4, 'Tips for Thriving as an International Student', 'Tips and Stories', 'Adjusting to life in a new country can be challenging for international students. \r\n  From managing finances to adapting to new cultural norms, the transition requires careful planning and resilience. \r\n  In this article, experienced international students share their top tips for thriving abroad, including building a strong support network, \r\n  participating in student organizations, and utilizing campus resources. \r\n  The key takeaway is to stay proactive and seek help when needed, ensuring a fulfilling and successful educational experience.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(155) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` int(50) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `gender` varchar(155) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `age`, `dob`, `gender`, `address`) VALUES
(1, 'John Don', 'john@email.com', 'johndon', '$2y$10$CUlh/.Z/qVNtwinhsvK5luFDC3NHgfKsfDWGiMDQEOvGWWxzwPirK', 30, '1993-05-15', 'male', '123 Main St, New York, NY'),
(2, 'Robin Bruce', 'robin@email.com', 'robin', '$2y$10$MU3IS91V.dWgNnJ1lr5K7eliYNIqGACJEtO1JpBU5LKuVtTVJzMzy', 20, '2000-01-01', 'male', 'USA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `news_articles`
--
ALTER TABLE `news_articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news_articles`
--
ALTER TABLE `news_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
