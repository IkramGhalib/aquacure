-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2022 at 06:59 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sas_uetpswr`
--

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `pid` varchar(100) DEFAULT NULL,
  `person_name` varchar(100) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `pid`, `person_name`, `datetime`) VALUES
(1, '0', 'Abdul Muneeb', '2022-05-26 04:53:12'),
(2, '01', 'Arsalan Ali Mujtaba', '2022-05-26 04:53:12'),
(3, '2', 'Asad Ullah', '2022-05-26 04:53:12'),
(4, '3', 'Bahawal Khan-Internee', '2022-05-26 04:53:12'),
(5, '4', 'Dr Atif Jan', '2022-05-26 04:53:12'),
(6, '5', 'Dr Gul Muhammad', '2022-05-26 04:53:12'),
(7, '6', 'Dr Gul Rukh Khattak', '2022-05-26 04:53:12'),
(8, '7', 'Dr Suhail Yousaf', '2022-05-26 04:53:12'),
(9, '8', 'Dr Zeeshan Shafiq', '2022-05-26 04:53:12'),
(10, '9', 'Hamid Ali Khan', '2022-05-26 04:53:12'),
(11, '10', 'Haseeb Jan', '2022-05-26 04:53:12'),
(12, '11', 'Ikram Ullah', '2022-05-26 04:53:12'),
(13, '12', 'Jahanzeb', '2022-05-26 04:53:12'),
(14, '13', 'Jamshaid Khan', '2022-05-26 04:53:12'),
(15, '14', 'Kaleem Ullah', '2022-05-26 04:53:12'),
(16, '15', 'M.Bilal Khan', '2022-05-26 04:53:12'),
(17, '16', 'Mahnoor Habib', '2022-05-26 04:53:12'),
(18, '17', 'Mansoor Khan', '2022-05-26 04:53:12'),
(19, '18', 'Mehreen Mubashar', '2022-05-26 04:53:12'),
(20, '19', 'Mehreen Mubashir', '2022-05-26 04:53:12'),
(21, '20', 'Moiz ullah khilji-Internee', '2022-05-26 04:53:12'),
(22, '21', 'Muhammad Ali', '2022-05-26 04:53:12'),
(23, '22', 'Muhammad Sami-Internee', '2022-05-26 04:53:12'),
(24, '23', 'Muhammad Suleman', '2022-05-26 04:53:12'),
(25, '24', 'Musa Khan', '2022-05-26 04:53:12'),
(26, '25', 'Muteeb', '2022-05-26 04:53:12'),
(27, '26', 'Muzammil Ali-Internee', '2022-05-26 04:53:12'),
(28, '27', 'Muzzammil Mehmood', '2022-05-26 04:53:12'),
(29, '28', 'Naqib Muhammad-Internee', '2022-05-26 04:53:12'),
(30, '29', 'Niaz Muhammad', '2022-05-26 04:53:12'),
(31, '30', 'Rabia Haseeb', '2022-05-26 04:53:12'),
(32, '31', 'Saba Gul', '2022-05-26 04:53:12'),
(33, '32', 'Sarmad Rafique', '2022-05-26 04:53:12'),
(34, '33', 'Shaheer Intern', '2022-05-26 04:53:12'),
(35, '34', 'Shahid Laiq', '2022-05-26 04:53:12'),
(36, '35', 'Sohail Intern', '2022-05-26 04:53:12'),
(37, '36', 'Tahir Ullah - Intern', '2022-05-26 04:53:12'),
(38, '37', 'Touqir Gohar', '2022-05-26 04:53:12'),
(39, '38', 'Wagma Farid', '2022-05-26 04:53:12'),
(40, '39', 'Wajahat ali khan -Internee', '2022-05-26 04:53:12'),
(41, '40', 'Yaseen Ali', '2022-05-26 04:53:12'),
(42, '41', 'Abdul Muneeb', '2022-05-26 04:53:12');

-- --------------------------------------------------------

--
-- Table structure for table `raw_data`
--

CREATE TABLE `raw_data` (
  `id` int(11) NOT NULL,
  `mid` varchar(20) DEFAULT NULL,
  `pid` varchar(20) DEFAULT NULL,
  `mood` int(11) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `serverdatetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `raw_data`
--

INSERT INTO `raw_data` (`id`, `mid`, `pid`, `mood`, `date_time`, `serverdatetime`) VALUES
(1, 'C01', '1', 0, '2022-05-26 02:09:04', '2022-05-20 10:03:08'),
(2, 'C01', '01', 0, '2022-05-27 00:00:00', '2022-05-20 10:11:05'),
(3, 'C01', '01', 0, '2022-01-01 00:00:00', '2022-05-20 10:11:39'),
(4, 'C01', '01', 0, '2022-01-01 00:00:00', '2022-05-20 10:27:59'),
(5, 'C01', '01', 0, '2022-01-01 00:00:00', '2022-05-20 10:29:23'),
(6, 'C01', '01', 0, '2022-01-01 00:00:00', '2022-05-20 10:32:10'),
(7, 'C01', '01', 0, '2022-01-01 00:00:00', '2022-05-20 10:34:36'),
(8, 'C01', '01', 0, '2022-01-01 00:00:00', '2022-05-20 10:37:36'),
(9, 'C01', '01', 0, '2022-01-01 00:00:00', '2022-05-20 12:06:14'),
(10, 'C01', '01', 0, '2022-01-01 00:00:00', '2022-05-20 12:07:43'),
(11, 'C01Hi', '01', 0, '2022-01-01 00:00:00', '2022-05-20 12:07:54'),
(12, 'C01', '01', 0, '2022-01-01 00:00:00', '2022-05-20 16:35:02'),
(13, 'C01', '1', 0, '2022-01-01 16:33:09', '2022-05-20 16:37:04'),
(14, 'C01', '1', 0, '2022-01-01 16:33:09', '2022-05-20 16:37:17'),
(15, 'C01', '1', 0, '2022-05-20 16:37:46', '2022-05-20 16:37:47'),
(16, 'C01', '6', 0, '2022-06-01 16:38:04', '2022-05-20 16:38:05'),
(17, 'C01', '18', 0, '2022-05-20 16:39:10', '2022-05-20 16:39:10'),
(18, 'C01', '24', 0, '2022-05-31 09:39:24', '2022-05-20 16:39:25'),
(19, 'C01', '25', 0, '2022-05-20 16:40:05', '2022-05-20 16:40:06'),
(20, 'C01', '58', 0, '2022-05-20 16:45:48', '2022-05-20 16:45:49'),
(21, 'C01', '76', 0, '2022-05-20 16:46:47', '2022-05-20 16:46:48'),
(22, 'C01', '80', 0, '2022-05-20 16:47:06', '2022-05-20 16:47:07'),
(23, 'C01', '2', 0, '2022-05-23 08:55:48', '2022-05-23 08:55:51'),
(24, 'C01', '7', 0, '2022-05-23 08:56:44', '2022-05-23 08:56:43'),
(25, 'C01', '8', 0, '2022-05-23 08:56:59', '2022-05-23 08:56:58'),
(26, 'C01', '18', 0, '2022-05-23 08:58:06', '2022-05-23 08:58:05'),
(27, 'C01', '20', 0, '2022-05-23 08:58:32', '2022-05-23 08:58:31'),
(28, 'C01', '26', 0, '2022-05-23 09:00:24', '2022-05-23 09:00:23'),
(29, 'C01', '27', 0, '2022-05-23 09:00:34', '2022-05-23 09:00:33'),
(30, 'C01', '40', 0, '2022-05-23 09:02:16', '2022-05-23 09:02:15'),
(31, 'C01', '2', 0, '2022-05-23 09:05:55', '2022-05-23 09:05:54'),
(32, 'C01', '4', 0, '2022-05-23 09:06:23', '2022-05-23 09:06:22'),
(33, 'C01', '5', 0, '2022-05-23 09:06:31', '2022-05-23 09:06:31'),
(34, 'C01', '61', 0, '2022-05-23 09:13:42', '2022-05-23 09:13:41'),
(35, 'C01', '88', 0, '2022-05-23 09:23:50', '2022-05-23 09:23:50'),
(36, 'C01', '96', 0, '2022-05-23 09:26:42', '2022-05-23 09:26:41'),
(37, 'C01', '123', 0, '2022-05-23 09:31:00', '2022-05-23 09:30:59'),
(38, 'C01', '124', 0, '2022-05-23 09:31:21', '2022-05-23 09:31:20'),
(39, 'C01', '162', 0, '2022-05-23 09:38:15', '2022-05-23 09:38:14'),
(40, 'C01', '266', 0, '2022-05-23 09:56:46', '2022-05-23 09:56:46'),
(41, 'C01', '272', 0, '2022-05-23 09:57:52', '2022-05-23 09:57:51'),
(42, 'C01', '01', 0, '2022-01-01 00:00:00', '2022-05-23 10:06:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_data`
--
ALTER TABLE `raw_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `raw_data`
--
ALTER TABLE `raw_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
