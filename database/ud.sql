-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2018 at 12:18 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ud`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_meeting`
--

CREATE TABLE IF NOT EXISTS `t_meeting` (
`mid` int(200) NOT NULL,
  `mmid` text NOT NULL,
  `oid` text NOT NULL,
  `oname` text NOT NULL,
  `oemail` text NOT NULL,
  `rid` text NOT NULL,
  `rname` text NOT NULL,
  `remail` text NOT NULL,
  `fromdatetime` text NOT NULL,
  `todatetime` text NOT NULL,
  `subject` text NOT NULL,
  `location` text NOT NULL,
  `description` text NOT NULL,
  `state` text NOT NULL,
  `statedescription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
`uid` int(11) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `timezone` text NOT NULL,
  `lastsignin` text NOT NULL,
  `lastsignout` text NOT NULL,
  `state` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`uid`, `f_name`, `l_name`, `email`, `password`, `timezone`, `lastsignin`, `lastsignout`, `state`) VALUES
(1, 'Kanagaraj', 'Subramaniam', 'kanagaraj@prodesk.in', '1234', 'Asia/Kolkata', '2018-06-23 03:44', '-', 'Logged In'),
(2, 'Imran', 'Siraj', 'imran@prodesk.in', '1234', 'Asia/Ho_Chi_Minh', '2018-06-23 03:36', '2018-06-23 00:07', 'Logged Out'),
(3, 'Hariharan', 'Subramaniam', 'hari@prodesk.in', '1234', 'America/New_York', '2018-06-23 03:37', '2018-06-23 00:07', 'Logged Out'),
(4, 'Preethi', 'Manoharan', 'preethi@prodesk.in', '1234', 'Asia/Singapore', '2018-06-23 03:38', '2018-06-23 00:08', 'Logged Out'),
(5, 'Siva', 'Venkat', 'siva@prodesk.in', '1234', 'Australia/Melbourne', '2018-06-23 03:39', '2018-06-23 00:09', 'Logged Out'),
(6, 'Boobalan', 'Ramasamy', 'boobalan@prodesk.in', '1234', 'Europe/London', '2018-06-23 03:40', '2018-06-23 00:10', 'Logged Out');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_history`
--

CREATE TABLE IF NOT EXISTS `t_user_history` (
`id` int(200) NOT NULL,
  `uid` text NOT NULL,
  `signin` text NOT NULL,
  `signout` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user_history`
--

INSERT INTO `t_user_history` (`id`, `uid`, `signin`, `signout`) VALUES
(1, '1', '2018-06-23 03:36', '2018-06-23 00:06'),
(2, '2', '2018-06-23 03:36', '2018-06-23 00:07'),
(3, '3', '2018-06-23 03:37', '2018-06-23 00:07'),
(4, '4', '2018-06-23 03:38', '2018-06-23 00:08'),
(5, '5', '2018-06-23 03:39', '2018-06-23 00:09'),
(6, '6', '2018-06-23 03:40', '2018-06-23 00:10'),
(7, '1', '2018-06-23 03:44', '2018-06-23 03:44'),
(8, '1', '2018-06-23 03:44', '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_meeting`
--
ALTER TABLE `t_meeting`
 ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
 ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `t_user_history`
--
ALTER TABLE `t_user_history`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_meeting`
--
ALTER TABLE `t_meeting`
MODIFY `mid` int(200) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `t_user_history`
--
ALTER TABLE `t_user_history`
MODIFY `id` int(200) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
