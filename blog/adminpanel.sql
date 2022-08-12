-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2022 at 02:44 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adminpanel`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `name`, `date`, `description`, `images`) VALUES
(3, 'Hasibul Islam', '0000-00-00', 'I am an assistant lecturer at Dhaka University', 'shanto.jpg'),
(5, 'Swarnaly Saha ', '0000-00-00', 'I am a Lecturer of Physics in Banga Bandhu University.', 'swarnaly.jpg'),
(7, 'Sadia Hossen', '0000-00-00', 'I am a professor at Jahangirnagar University, Savar, Dhaka.', 'sadia.jpg'),
(11, 'W', '0000-00-00', 'ASi', 'me.jpg'),
(13, 'Job Offer', '0000-00-00', 'Software Engineer', 'rainbow.jpg'),
(16, 'OPPO', '2022-08-11', 'SQA', 'FWKRYjVacAAN-mJ.jpg'),
(18, 'ML', '2022-08-12', 'SWE Engineer for Brain Station 23', 'ip.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `username`, `email`, `password`, `usertype`) VALUES
(2, 'Khona Datta Koli', 'khona1180@gmail.com', '1180', 'admin'),
(4, 'Hasibul Islam Shanto', 'hishanto@gmail.com', '2018331078', 'user'),
(5, 'Hrithik Majumdar', 'hrithik4064@gmail.com', '4064', 'admin'),
(6, 'Swarnaly  Saha', 'swarnaly7890@gmail.com', '7890', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `role_as` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `username`, `email`, `password`, `cpassword`, `role_as`, `status`, `created_at`) VALUES
(1, 'Tufail', 'Ahmed', '', 'tufail10@gmail.com', '2018331010', '2018331010', 1, 0, '2022-02-12 15:06:19'),
(6, 'Hrithik', 'Majumdar', '', 'hrithik4064@gmail.com', '4064', '4064', 1, 0, '2022-02-15 05:18:03'),
(7, 'Khona', 'Datta', 'Khona Datta', 'khona1180@gmail.com', '1180', '', 1, 0, '2022-02-21 18:16:24'),
(8, '', '', 'me', 'ronyhajong2000@gmail.com', '12345', '', 1, 0, '2022-08-11 13:00:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
