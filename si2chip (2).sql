-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2016 at 08:05 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `si2chip`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp_details`
--

CREATE TABLE IF NOT EXISTS `emp_details` (
  `eid` int(10) NOT NULL,
  `fname` varchar(150) NOT NULL,
  `mname` varchar(150) NOT NULL,
  `lname` varchar(150) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `dob` date NOT NULL,
  `mstatus` enum('Single','Married','Divorced','Widowed','') NOT NULL,
  `email` varchar(200) NOT NULL,
  `department` varchar(150) NOT NULL,
  `designation` varchar(150) NOT NULL,
  `address` varchar(500) NOT NULL,
  `joiningdate` date NOT NULL,
  `contact` varchar(13) NOT NULL,
  `alternate_contact` varchar(13) NOT NULL,
  `photo` varchar(200) NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_details`
--

INSERT INTO `emp_details` (`eid`, `fname`, `mname`, `lname`, `gender`, `dob`, `mstatus`, `email`, `department`, `designation`, `address`, `joiningdate`, `contact`, `alternate_contact`, `photo`) VALUES
(0, '', '', '', 'Male', '0000-00-00', 'Single', 'followtushar@gmail.com', '', '', '', '0000-00-00', '', '', ''),
(0, '', '', '', 'Male', '0000-00-00', 'Single', 'jindgiwap@gmail.com', '', '', '', '0000-00-00', '', '', ''),
(0, 'Tushar', 'mname', 'Kumar', 'Male', '2016-02-08', 'Single', 'mistrymant@gmail.com', 'Cse', 'prog', 'asdfasdadfas', '2016-02-06', '9643033241', '9540169530', ' images/user/1454789652.jpg'),
(0, '', '', '', 'Male', '0000-00-00', 'Single', 'myselfumang.roy@gmail.com', '', '', '', '0000-00-00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(300) NOT NULL,
  `salt` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `activation` varchar(300) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `activation` (`activation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `email`, `salt`, `password`, `activation`, `status`) VALUES
(1, 'followtushar@gmail.com', 'ff44c1', '9a4c5e7729989904047c818ecef65d64658aec1f29cd5b1dc8c420e2c8faed0a', 'e8e32e558f0a7c4bc2f8f6af17d47125', '1'),
(2, 'mis@as.com', '', '62c57819981c6fa38c8128b8a92de81356275f8bc7fc395d5d52351db113a53c', 'fae1b7ea0378e76a78fdb09c5b9039a0', '0'),
(3, 'follow@gm.com', '', '4baea98ab2409856800d933715eeaef11b00efa181ef28ccb4a2bb631a7b90a8', 'a', '0'),
(4, 'f@gmi.com', '', '4baea98ab2409856800d933715eeaef11b00efa181ef28ccb4a2bb631a7b90a8', 'dcc321ce68e6fc0a2256e49bd56f75195598892ae003ad8897e5685da5146272', '0'),
(5, 'tushar@gmail.com', '', '4baea98ab2409856800d933715eeaef11b00efa181ef28ccb4a2bb631a7b90a8', '03bc9961110e9f466a3ef433d098bb55eaa6c52834eee1f6c221e047eb697248', '1'),
(6, 'mistrymant@gmail.com', '', 'Menmylife1@', 'ad5d9737fd2c165b9df1d54d52fa4fc3a8fdf5d2d4ee86c08d991b2198f088d6', '1'),
(7, 'jindgiwap@gmail.com', '3c3e98', 'b8ee1ef0eba6249b6d6997dd220ab0f1e847c98ff5c82227edd874bfd0565ed7', '9aa47091255e4f3188ccb9120b3e5e65cf1cadee985fe9da967fb0516ce0c457', '1'),
(8, 'af@dsa.vom', 'a11ba0', 'f3ec92c5882492e989f898183a75b2430eefc0381ff93784e2c76883e6f95d2b', 'e1be8230826a17a8302700e6e784f421ddffd0e05cdc0b1bb9193fab39232491', '0'),
(9, 'myselfumang.roy@gmail.com', 'a3cf7c', '50fb03a6cd125afad65eea4300f75d6324bcf7e61a04eb103a12913f85cde0bc', 'b358d73524d042445fc41c7c895024d350a3c6b6d50a525e2518d8e207ac81d4', '0');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emp_details`
--
ALTER TABLE `emp_details`
  ADD CONSTRAINT `email` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
