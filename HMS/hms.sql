-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2015 at 09:28 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'hassan', '123');

-- --------------------------------------------------------

--
-- Table structure for table `doc_on_call`
--

CREATE TABLE IF NOT EXISTS `doc_on_call` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_name` varchar(255) NOT NULL,
  `qulification` varchar(255) NOT NULL,
  `salary` int(11) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`doc_name`),
  KEY `doctors_fk` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `doc_on_call`
--

INSERT INTO `doc_on_call` (`id`, `doc_name`, `qulification`, `salary`, `address`, `phone`) VALUES
(1, 'agha', 'MBBS', 6767, 'something', '0334-65066567'),
(2, 'ajuba', 'MBBS', 17887, 'something', '0334587878');

-- --------------------------------------------------------

--
-- Table structure for table `other_satff`
--

CREATE TABLE IF NOT EXISTS `other_satff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `jo_type` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other_satff`
--

INSERT INTO `other_satff` (`id`, `name`, `jo_type`, `phone`, `address`) VALUES
(0, 'piago', 'sweeper', '0900767678', 'something');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` text NOT NULL,
  `diagnostic` text NOT NULL,
  `treatement` text NOT NULL,
  `doc_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `age`, `sex`, `diagnostic`, `treatement`, `doc_name`) VALUES
(1, 'ahsan', 20, 'male', 'lungs Cancer', 'nothing', 'waleed'),
(2, 'nida', 21, 'male', 'something', 'something', 'a.j');

-- --------------------------------------------------------

--
-- Table structure for table `regular_doctor`
--

CREATE TABLE IF NOT EXISTS `regular_doctor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_name` varchar(255) NOT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `entry_time` varchar(255) DEFAULT NULL,
  `exit_time` varchar(255) DEFAULT NULL,
  `address` text,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `regular_doctor`
--

INSERT INTO `regular_doctor` (`id`, `doc_name`, `qualification`, `salary`, `entry_time`, `exit_time`, `address`, `phone`) VALUES
(2, 'waleed', 'MBBS', 1890, '18:30', '17:30', 'ds', 'sdd');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `room_no` int(11) NOT NULL AUTO_INCREMENT,
  `r_type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `daily_charges` int(11) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  PRIMARY KEY (`room_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_no`, `r_type`, `status`, `daily_charges`, `patient_name`) VALUES
(1, 'simple', 'available', 1000, 'waleed');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
