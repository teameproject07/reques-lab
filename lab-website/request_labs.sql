-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2024 at 03:16 PM
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
-- Database: `request_labs`
--

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `ID` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `expire` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `feedback` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `lab_id` int(11) DEFAULT NULL,
  `generation` varchar(50) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `app` varchar(100) DEFAULT NULL,
  `number_students` int(11) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `other` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 

--
-- Table structure for table `lab`
--

CREATE TABLE `lab` (
  `ID` int(11) NOT NULL,
  `name_lab` varchar(50) DEFAULT NULL,
  `image-lab` varchar(255) NOT NULL,
  `lab_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`ID`, `name_lab`, `image-lab`, `lab_status`) VALUES
(1, 'Lab IT', 'https://cbx-prod.b-cdn.net/COLOURBOX47851339.jpg?width=800&height=800&quality=70', ''),
(2, 'Lab013', 'https://st4.depositphotos.com/1001599/40602/v/450/depositphotos_406023562-stock-illustration-workplace-culture-abstract-concept-vector.jpg', ''),
(3, 'Lab010', 'https://thumbs.dreamstime.com/b/computer-animation-abstract-concept-vector-illustration-graphic-software-cartoon-video-creation-character-design-game-art-creative-198851157.jpg', ''),
(4, 'Lab civil', 'https://img.freepik.com/premium-vector/school-illustration_1086266-27248.jpg', ''),
(5, 'Lab Network', 'https://img.freepik.com/premium-vector/school-illustration_1086266-27284.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `ID` int(11) NOT NULL,
  `sessions` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`ID`, `sessions`) VALUES
(1, 'Session1'),
(2, 'Session2'),
(3, 'Session3'),
(4, 'Session4'),
(5, 'Session5'),
(6, 'Session6');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `full_name` varchar(200) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` enum('user','admin') DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `position` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

-- Indexes for dumped tables
--

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `email` (`email`),
  ADD KEY `code` (`code`),
  ADD KEY `expire` (`expire`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `lab_id` (`lab_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `lab`
--
ALTER TABLE `lab`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lab`
--
ALTER TABLE `lab`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);

--
-- Constraints for table `information`
--
ALTER TABLE `information`
  ADD CONSTRAINT `information_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `information_ibfk_2` FOREIGN KEY (`lab_id`) REFERENCES `lab` (`ID`),
  ADD CONSTRAINT `information_ibfk_3` FOREIGN KEY (`session_id`) REFERENCES `session` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
