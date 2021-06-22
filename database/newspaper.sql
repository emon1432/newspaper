-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2021 at 07:18 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newspaper`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `post` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `post`) VALUES
(1, 'C', 12),
(2, 'C++', 12),
(3, 'PHP', 3),
(4, 'JAVA', 3),
(5, 'HTML', 3),
(6, 'JavaScript', 1),
(9, 'Node JS', 1),
(10, 'CSS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `post_date` varchar(50) NOT NULL,
  `author` int(11) NOT NULL,
  `post_img` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES
(3, 'Old is Gold', 'PHP is a server side language,\r\nbest of all,easy to learn', '3', '20 Jun, 2021', 11, 'php.jpeg'),
(2, 'Best Language', 'C is the mother of all language,\r\nand it\'s best for beginner to learning programming language.', '1', '20 Jun, 2021', 11, 'C.jpg'),
(1, 'Best for programming', 'C++ is the best language for programming,\r\nand also problem solving.', '2', '20 Jun, 2021', 11, 'c++.png'),
(4, 'Android', 'Java is best for android app development,and also for oracle server', '4', '20 Jun, 2021', 11, 'java.png'),
(5, 'Web Design', 'HTML is the language for Web designing structure.', '5', '21 Jun, 2021', 11, 'html.png'),
(6, 'Web design - CSS', 'CSS - Cascading Style Sheet.\r\nIts use for color , margin and many designing attempt.', '10', '21 Jun, 2021', 7, 'css.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `role`) VALUES
(1, 'Md. Khairul Islam', 'Emon', 'emon1432', '82263621ae01cea333ec0bdfdaeb5b06', 0),
(2, 'Sharmin Akter', 'Adhora', 'adhoramon', '588253cd912cefbaa591e260720fd105', 1),
(3, 'Priyanka', 'Rani', 'pghosh', 'e10adc3949ba59abbe56e057f20f883e', 1),
(4, 'Naimul Islam', 'Naim', 'naimislam', 'e10adc3949ba59abbe56e057f20f883e', 0),
(6, 'Abir Hossain', 'Raju', 'abir2', 'e10adc3949ba59abbe56e057f20f883e', 0),
(7, 'Nazmul Hassan', 'bappy', 'nhb', 'e10adc3949ba59abbe56e057f20f883e', 0),
(8, 'Allem Hossain', 'hasib', 'lms', 'e10adc3949ba59abbe56e057f20f883e', 1),
(9, 'Prince Mahmud ', 'Hridoy', 'pm500', 'e10adc3949ba59abbe56e057f20f883e', 0),
(5, 'Abu Huzaifa', 'As-Sahmi', 'saikat', '123456', 0),
(10, 'Ayesha Akter', 'Toma', 'ayesha', 'e10adc3949ba59abbe56e057f20f883e', 0),
(11, 'emon', 'mon', 'e_mon', 'e10adc3949ba59abbe56e057f20f883e', 1),
(12, 'emon', 'emu', 'emon_mon', 'e10adc3949ba59abbe56e057f20f883e', 0),
(13, 'mon', 'adho', 'adho', 'e10adc3949ba59abbe56e057f20f883e', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `post_id` (`post_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
