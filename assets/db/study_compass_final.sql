-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2025 at 08:23 PM
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
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `adminId` int(11) NOT NULL,
  `eventName` varchar(50) NOT NULL,
  `eventVenue` varchar(50) NOT NULL,
  `eventDate` date NOT NULL,
  `eventTime` time NOT NULL,
  `eventOrganizer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`adminId`, `eventName`, `eventVenue`, `eventDate`, `eventTime`, `eventOrganizer`) VALUES
(1, '59th Bangladesh International Education Expo 2025', 'ICC', '2025-01-23', '22:00:00', 'PFEC Global'),
(1, 'event1', 'venue1', '2025-01-23', '20:58:00', 'organizer1'),
(1, 'test4', 'International Convention City Bashundhara (ICCB), ', '2025-01-24', '20:59:00', 'organizer2');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(56) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `username`, `email`, `message`, `status`) VALUES
(1, 'sabbir', 'mdsabbirh083@gmail.com', 'test 1', 1),
(16, 'alin', 'asifuralin64@gmail.com', 'software er user friendly koro.', 1),
(18, 'sabbir', 'contact@coretales.com', 'Hello?????????', 0);

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
(3, 'Ranking the Best Universities for Engineering in 2024', 'University Rankings', 'The 2024 university rankings have been released, showcasing the best institutions for engineering across the globe. \r\n  Massachusetts Institute of Technology (MIT) continues to lead the list, followed closely by Stanford and Cambridge. \r\n  The rankings are based on various criteria, including research output, student satisfaction, employability, and faculty expertise. \r\n  Aspiring engineers can use these rankings to identify the best programs that align with their career goals. \r\n  Additionally, many of these institutions offer generous funding packages and scholarships to attract top talent from around the world.');

-- --------------------------------------------------------

--
-- Table structure for table `scholarships`
--

CREATE TABLE `scholarships` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `university_name` varchar(255) NOT NULL,
  `scholarship_url` varchar(255) NOT NULL,
  `country` varchar(100) NOT NULL,
  `budget` decimal(10,2) NOT NULL,
  `course` varchar(255) NOT NULL,
  `deadline` date NOT NULL,
  `eligibility` text DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scholarships`
--

INSERT INTO `scholarships` (`id`, `name`, `university_name`, `scholarship_url`, `country`, `budget`, `course`, `deadline`, `eligibility`, `description`) VALUES
(1, 'Global Excellence Award', 'University of Sydney', 'https://sydney.edu.au/scholarships/global-excellence', 'Australia', 5000.00, 'Engineering', '2025-03-31', 'GPA ≥ 3.5', 'Open to undergraduate students.'),
(2, 'Chevening Scholarship', 'University of Cambridge', 'https://chevening.org/apply', 'UK', 20000.00, 'Social Sciences', '2025-05-15', 'Bangladeshi citizens', 'Covers full tuition fees and living expenses.'),
(3, 'ASEAN Scholarship', 'NUS', 'https://nus.edu.sg/scholarships', 'Singapore', 10000.00, 'Any', '2025-06-30', 'ASEAN nationals', 'Includes living costs and tuition fees.'),
(4, 'Fulbright Scholarship', 'Harvard University', 'https://us.fulbrightonline.org', 'USA', 25000.00, 'Any', '2025-07-15', 'Master\'s programs', 'Covers tuition, travel, and living costs.'),
(5, 'Eiffel Excellence Scholarship', 'University of Paris', 'https://campusfrance.org/en/eiffel-scholarship', 'France', 15000.00, 'Engineering', '2025-05-30', 'International students under 30', 'Covers tuition and living costs.'),
(6, 'DAAD Scholarship', 'Technical University of Munich', 'https://daad.de/en/study-and-research-in-germany/scholarships/', 'Germany', 18000.00, 'STEM', '2025-05-31', 'Graduates with GPA ≥ 3.0', 'Covers tuition, living costs, and travel allowance.');

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `budget_range` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`id`, `name`, `location`, `budget_range`, `major`, `website`) VALUES
(2, 'Oxford University', 'UK', '40000', 'Medicine', 'https://www.ox.ac.uk'),
(3, 'University of Tokyo', 'Japan', '3500000', 'Science', 'https://www.u-tokyo.ac.jp'),
(4, 'Stanford University', 'USA', '50000', 'Business', 'https://www.stanford.edu'),
(5, 'University of Cambridge', 'UK', '42000', 'Arts', 'https://www.cam.ac.uk'),
(6, 'Australian National University', 'Australia', '35000', 'EEE', 'https://www.anu.edu.au'),
(7, 'National University of Singapore', 'Singapore', '37000', 'Technology', 'https://www.nus.edu.sg'),
(8, 'ETH Zurich', 'Switzerland', '40000', 'Architecture', 'https://ethz.ch'),
(9, 'Peking University', 'China', '260000', 'Economics', 'https://www.pku.edu.cn'),
(10, 'University of Toronto', 'Canada', '40000', 'Health Sciences', 'https://www.utoronto.ca'),
(14, 'Oxford University', 'UK', '30000', 'Engineering', 'https://www.u-tokyo.ac.jp'),
(15, 'Oxford University', 'UK', '32000', 'Engineering', 'https://www.ox.ac.uk'),
(17, 'Oxford University', 'UK', '34000', 'CS', 'https://www.oxford.edu'),
(18, 'Oxford University', 'USA', '', 'CS', 'https://www.oxford.edu');

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
(1, 'John Don', 'john@email.com', 'john', 'john', 30, '1993-05-15', 'male', '123 Main St, New York, NY'),
(2, 'Robin Bruce', 'robin@email.com', 'robin', 'robin', 20, '2000-01-01', 'male', 'USA');

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
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventName`),
  ADD KEY `adminId` (`adminId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `news_articles`
--
ALTER TABLE `news_articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `news_articles`
--
ALTER TABLE `news_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `scholarships`
--
ALTER TABLE `scholarships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
