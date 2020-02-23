-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2019 at 10:35 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `ejmt`
--

CREATE TABLE `ejmt` (
  `M_id` int(11) NOT NULL,
  `T_id` int(11) NOT NULL,
  `E_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ejmt`
--

INSERT INTO `ejmt` (`M_id`, `T_id`, `E_id`) VALUES
(16, 4, 2),
(16, 4, 3),
(16, 4, 12),
(16, 4, 3),
(16, 4, 12),
(16, 4, 11),
(16, 4, 8),
(16, 4, 8),
(16, 4, 3),
(12, 4, 3),
(12, 4, 4),
(12, 4, 8),
(12, 4, 9),
(12, 4, 1),
(12, 4, 2),
(12, 4, 4),
(12, 4, 2),
(12, 4, 3),
(12, 4, 4),
(12, 4, 7),
(12, 4, 3),
(12, 4, 4),
(12, 4, 3),
(12, 4, 4),
(12, 4, 7),
(12, 4, 8),
(14, 1, 1),
(14, 1, 2),
(14, 1, 3),
(14, 1, 4),
(14, 1, 7),
(14, 1, 12),
(17, 1, 1),
(17, 1, 12),
(17, 1, 3),
(17, 1, 7),
(14, 1, 3),
(14, 1, 2),
(14, 1, 3),
(14, 1, 4),
(14, 1, 9),
(14, 1, 2),
(14, 1, 2),
(14, 1, 3),
(14, 1, 3),
(14, 1, 3),
(14, 1, 4),
(14, 1, 2),
(14, 1, 3),
(14, 1, 4),
(14, 1, 7),
(14, 1, 11),
(14, 1, 2),
(14, 1, 3),
(14, 1, 3),
(14, 1, 4),
(14, 1, 7),
(14, 1, 3),
(14, 1, 4),
(14, 1, 3),
(14, 1, 4),
(11, 1, 3),
(11, 1, 4),
(11, 1, 7),
(11, 1, 9),
(11, 1, 10),
(11, 1, 11),
(11, 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `exercise`
--

CREATE TABLE `exercise` (
  `E_id` int(11) NOT NULL,
  `E_name` varchar(50) NOT NULL,
  `E_type` varchar(50) NOT NULL,
  `E_level` varchar(50) NOT NULL,
  `E_filepath` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exercise`
--

INSERT INTO `exercise` (`E_id`, `E_name`, `E_type`, `E_level`, `E_filepath`) VALUES
(1, 'Sit-Up', 'Abs', 'Beginner', 'img/exercise/sit_up.gif'),
(2, 'Bench Press', 'Chest', 'Intermediate', 'img/exercise/bench_press.gif'),
(3, 'Shoulder Press', 'Shoulder', 'Intermadiate', 'img/exercise/shoulder_press.gif'),
(4, 'Lat Pull Down', 'Back', 'Intermediate', 'img/exercise/lat.gif'),
(7, 'Squats', 'Legs', 'Intermadiate', 'img/exercise/squats.gif'),
(8, 'Bicep  Curls', 'Arms', 'Intermediate', 'img/exercise/bicep_curl.gif'),
(9, 'Triceps Extension', 'Arms', 'Intermadiate', 'img/exercise/tricep_ext.gif'),
(10, 'Pec Fly', 'Chest', 'Intermediate', 'img/exercise/pec_fly.gif'),
(11, 'Pistol Squats', 'Legs', 'Advanced', 'img/exercise/pistol.gif'),
(12, 'Triceps Kickback', 'Arms', 'Beginner', 'img/exercise/kickback.gif');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `M_id` int(11) NOT NULL,
  `M_Fname` varchar(50) NOT NULL,
  `M_Lname` varchar(50) NOT NULL,
  `M_email` varchar(50) NOT NULL,
  `M_pass` varchar(50) NOT NULL,
  `M_photo` varchar(500) DEFAULT NULL,
  `M_chest` int(11) NOT NULL,
  `M_shoulder` int(11) NOT NULL,
  `M_waist` int(11) NOT NULL,
  `M_desc` varchar(1000) NOT NULL,
  `T_id` int(11) DEFAULT NULL,
  `E_id` int(11) DEFAULT NULL,
  `M_weight` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`M_id`, `M_Fname`, `M_Lname`, `M_email`, `M_pass`, `M_photo`, `M_chest`, `M_shoulder`, `M_waist`, `M_desc`, `T_id`, `E_id`, `M_weight`) VALUES
(11, 'Ali', 'Iktider', 'aisayam.sayam@gmail.com', '7533b23c04ca07b8f9563f6f88e3e22c', NULL, 42, 48, 35, 'I have been working out for 2years now. I consider myself to be decently-versed in terms of working out. During my stay here I want the trainer to guide and monitor my food intakes, as where I come from its very hard to get healthy sources of food.', NULL, NULL, 79),
(12, 'Ali', 'Intisar', 'aisamin.samin@gmail.com', 'samin', NULL, 52, 50, 58, 'I am a noob', NULL, NULL, 115),
(13, 'rehman', 'mashfe', 'rehman@yahoo.com', 'mashfe', NULL, 32, 35, 30, 'I had previous leg injuries', NULL, NULL, 60),
(14, 'Monty', 'hasan', 'monty@gmail.com', 'monty', NULL, 12, 12, 12, 'I have been working out for 3months, and I am quite happy with the progress', NULL, NULL, 12),
(15, 'anik', 'mehedi', 'anik@hotmail.com', 'anik', NULL, 25, 25, 25, 'I wanna gain some weight', NULL, NULL, 25),
(16, 'Afif', 'Ahnaf', 'aa@gmail.com', 'afif', NULL, 15, 15, 15, 'I am looking for the best trainer Out there', NULL, NULL, 15),
(17, 'Jahid', 'Hasan', 'jh@yahoo.com', 'jahid', NULL, 65, 65, 65, 'I have a beginner', NULL, NULL, 65),
(24, 'Ahad', 'Prottoy', 'ahad@gmail.com', '7533b23c04ca07b8f9563f6f88e3e22c', NULL, 95, 95, 95, 'i wanna loose weight\r\n', NULL, NULL, 95);

-- --------------------------------------------------------

--
-- Table structure for table `mjt`
--

CREATE TABLE `mjt` (
  `M_id` int(11) NOT NULL,
  `T_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mjt`
--

INSERT INTO `mjt` (`M_id`, `T_id`) VALUES
(12, 4),
(16, 4),
(14, 1),
(17, 1),
(11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `T_id` int(11) NOT NULL,
  `T_Fname` varchar(50) NOT NULL,
  `T_Lname` varchar(50) NOT NULL,
  `T_email` varchar(50) NOT NULL,
  `T_pass` varchar(50) NOT NULL,
  `T_desc` varchar(1000) NOT NULL,
  `T_monrate` int(11) NOT NULL,
  `T_semirate` int(11) NOT NULL,
  `T_anrate` int(11) NOT NULL,
  `T_photo` varchar(500) NOT NULL,
  `T_achievements` varchar(1000) DEFAULT NULL,
  `M_id` int(11) DEFAULT NULL,
  `E_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`T_id`, `T_Fname`, `T_Lname`, `T_email`, `T_pass`, `T_desc`, `T_monrate`, `T_semirate`, `T_anrate`, `T_photo`, `T_achievements`, `M_id`, `E_id`) VALUES
(1, 'Ali', 'Iktider', 'aisayam.sayam@gmail.com', '7533b23c04ca07b8f9563f6f88e3e22c', 'I am resourcefull', 1000, 5000, 10000, '', 'SELF TAUGHT BODYBUILDER', NULL, NULL),
(4, 'Arnold', 'Schwarzenegger', 'ab@gmail.com', 'arnld', 'I am the one who started it all', 15000, 70000, 120000, '', 'MR OLYMPIA', NULL, NULL),
(5, 'Rana', 'Nahiyan', 'rana@gmail.com', 'rana', 'I provide special Arm Wrestling training', 10000, 50000, 100000, '', 'Mr Dhaka 2013', NULL, NULL),
(6, 'Ahnan', 'Dipu', 'ad@gmail.com', 'ahnan', 'I provide full one on one sessions with my clients', 800, 4500, 8000, '', 'SELF TAUGHT BODYBUILDER', NULL, NULL),
(7, 'Tanvir', 'Alam', 'ta@gmail.com', 'tanvir', 'I am new as a trainer but I assure you, you wont have a chance to complain', 500, 3500, 6500, '', 'working out for 5years', NULL, NULL),
(8, 'Rashik', 'Ishrak', 'rashik@gmail.com', 'rashik', 'I am good for athletic training', 500, 2500, 4500, '', 'World Class Footballer ', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ejmt`
--
ALTER TABLE `ejmt`
  ADD KEY `T_id` (`T_id`),
  ADD KEY `M_id` (`M_id`),
  ADD KEY `E_id` (`E_id`);

--
-- Indexes for table `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`E_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`M_id`),
  ADD KEY `T_id` (`T_id`),
  ADD KEY `E_id` (`E_id`);

--
-- Indexes for table `mjt`
--
ALTER TABLE `mjt`
  ADD KEY `T_id` (`T_id`),
  ADD KEY `M_id` (`M_id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`T_id`),
  ADD KEY `E_id` (`E_id`),
  ADD KEY `M_id` (`M_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exercise`
--
ALTER TABLE `exercise`
  MODIFY `E_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `M_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `T_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ejmt`
--
ALTER TABLE `ejmt`
  ADD CONSTRAINT `ejmt_ibfk_1` FOREIGN KEY (`T_id`) REFERENCES `trainers` (`T_id`),
  ADD CONSTRAINT `ejmt_ibfk_2` FOREIGN KEY (`M_id`) REFERENCES `members` (`M_id`),
  ADD CONSTRAINT `ejmt_ibfk_3` FOREIGN KEY (`E_id`) REFERENCES `exercise` (`E_id`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`T_id`) REFERENCES `trainers` (`T_id`),
  ADD CONSTRAINT `members_ibfk_2` FOREIGN KEY (`E_id`) REFERENCES `exercise` (`E_id`);

--
-- Constraints for table `mjt`
--
ALTER TABLE `mjt`
  ADD CONSTRAINT `mjt_ibfk_1` FOREIGN KEY (`T_id`) REFERENCES `trainers` (`T_id`),
  ADD CONSTRAINT `mjt_ibfk_2` FOREIGN KEY (`M_id`) REFERENCES `members` (`M_id`);

--
-- Constraints for table `trainers`
--
ALTER TABLE `trainers`
  ADD CONSTRAINT `trainers_ibfk_1` FOREIGN KEY (`E_id`) REFERENCES `exercise` (`E_id`),
  ADD CONSTRAINT `trainers_ibfk_2` FOREIGN KEY (`M_id`) REFERENCES `members` (`M_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
