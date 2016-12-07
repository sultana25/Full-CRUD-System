-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2009 at 09:10 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `atomicproject21`
--

-- --------------------------------------------------------

--
-- Table structure for table `birthday`
--

CREATE TABLE IF NOT EXISTS `birthday` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `description` text NOT NULL,
  `descriptionwohtml` text NOT NULL,
  `deleted_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `birthday`
--

INSERT INTO `birthday` (`id`, `name`, `birthdate`, `description`, `descriptionwohtml`, `deleted_at`) VALUES
(2, 'fg2', '2009-01-09', 'fjhj2', 'fjhj2', NULL),
(3, 'jlfjg', '2009-01-05', 'dgdh', 'dgdh', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `descriptionwohtml` text NOT NULL,
  `deleted_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `description`, `descriptionwohtml`, `deleted_at`) VALUES
(10, 'vcj125', 'vcjbm5', 'vcjbm5', NULL),
(12, 'dfgd', 'dhgf', '', NULL),
(13, 'bvxcn', 'xnvcb', '', NULL),
(14, 'cnb2', 'cbnc2', 'cbnc2', NULL),
(15, 'cbnc', 'cbnc', '', NULL),
(16, 'vbnv', 'vmvb', '', NULL),
(18, 'njg', 'gjmk', '', NULL),
(19, 'vb c', 'cnvc', '', NULL),
(20, 'fcgc', 'cncv', '', NULL),
(21, 'bvv', 'ghfh', '', NULL),
(22, 'uh', 'jhkl', 'hl', NULL),
(23, 'cvx5', 'bxvx5', 'bxvx5', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `descriptionwohtml` text NOT NULL,
  `deleted_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `city_name`, `description`, `descriptionwohtml`, `deleted_at`) VALUES
(1, 'sazeda sultana', 'Comilla', 'jh', 'jh', NULL),
(2, 'nishatq', 'Feni', 'hgkjjh', 'hgkjjh', NULL),
(3, 'brishty', 'Dhaka', '', '', NULL),
(4, 'pathar', 'Khulna', 'gf', 'gf', NULL),
(5, 'pathar1', 'Chittagong', '', '', NULL),
(6, 'brishty', 'Rangpur', '', '', NULL),
(7, 'sazeda sultana', 'Chittagong', '', '', NULL),
(8, 'jkh', 'Comilla', '', '', NULL),
(9, 'ghf', 'Comilla', '', '', NULL),
(10, 'ss', 'ss', 'ss', 'ss', NULL),
(11, 'fdh', 'Comilla', 'dh', 'dh', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
`id` int(11) NOT NULL,
  `email_address` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `descriptionwohtml` text NOT NULL,
  `deleted_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `email_address`, `description`, `descriptionwohtml`, `deleted_at`) VALUES
(1, 'sazu@gmail.com', '', '', NULL),
(2, 'dgrts@gmail.com', 'ssgr', 'ssgr', NULL),
(3, 'dsfah@yahoo.com', 'dgsdg', 'dgsdg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE IF NOT EXISTS `gender` (
`id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `gender_type` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `descriptionwohtml` text NOT NULL,
  `deleted_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `name`, `gender_type`, `description`, `descriptionwohtml`, `deleted_at`) VALUES
(1, 'xdbgcx', 'Male', '', '', NULL),
(2, 'sdgh', 'sdfgsh', 'sfgsh', 'sfgh', NULL),
(3, 'sdaf', 'Male', 'asdf', 'asdf', NULL),
(4, 'fgdh', 'Female', 'dhgd', 'dhgd', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hobby`
--

CREATE TABLE IF NOT EXISTS `hobby` (
`id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `hobby` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `descriptionwohtml` text NOT NULL,
  `deleted_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hobby`
--

INSERT INTO `hobby` (`id`, `firstname`, `lastname`, `hobby`, `description`, `descriptionwohtml`, `deleted_at`) VALUES
(1, 'frtu4h', 'rujygf', 'Coding,Browsing,Singing,Gardening', 'hgf', 'hgf', NULL),
(2, 'fsjk', 'sfgmn', 'sdsfbm', 'sfgsmb,', 'sgfb,m', NULL),
(3, 'fdsgd', 'dfhd', 'Coding', 'dgh', 'dgh', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profilepicture`
--

CREATE TABLE IF NOT EXISTS `profilepicture` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `descriptionwohtml` text NOT NULL,
  `deleted_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profilepicture`
--

INSERT INTO `profilepicture` (`id`, `name`, `images`, `description`, `descriptionwohtml`, `deleted_at`) VALUES
(1, 'gfnhcv', '1230750183term and conditions.png', '', '', NULL),
(2, 'sfsg', 'dfsg', 'sdfgg', 'sfgg', NULL),
(3, 'fg', '12307941581378449_523779527711367_1978100281_n.jpg', 'sg', 'sg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `textarea`
--

CREATE TABLE IF NOT EXISTS `textarea` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `summery` varchar(600) NOT NULL,
  `deleted_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `textarea`
--

INSERT INTO `textarea` (`id`, `name`, `summery`, `deleted_at`) VALUES
(2, 'sazeda sultanas', '	\r\nIf you have a new question, please ask it by clicking the Ask Question button. Include a link to this question if it helps provide contex', NULL),
(4, 'vxcf', 'cvhf', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `birthday`
--
ALTER TABLE `birthday`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hobby`
--
ALTER TABLE `hobby`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profilepicture`
--
ALTER TABLE `profilepicture`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `textarea`
--
ALTER TABLE `textarea`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `birthday`
--
ALTER TABLE `birthday`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hobby`
--
ALTER TABLE `hobby`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `profilepicture`
--
ALTER TABLE `profilepicture`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `textarea`
--
ALTER TABLE `textarea`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
