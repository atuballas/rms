-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 14, 2012 at 09:50 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `rms_boarders`
--

CREATE TABLE IF NOT EXISTS `rms_boarders` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `profession` varchar(100) NOT NULL,
  `boarding_type` varchar(50) NOT NULL,
  `checked_in_date` datetime NOT NULL,
  `room_number` int(11) NOT NULL,
  `additional_appliances` text NOT NULL,
  `board_status` tinyint(1) NOT NULL COMMENT '0-inactive,1-active, 2-transient, 3-evicted',
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `room_number` (`room_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rms_boarders`
--

INSERT INTO `rms_boarders` (`id`, `name`, `address`, `telephone`, `status`, `profession`, `boarding_type`, `checked_in_date`, `room_number`, `additional_appliances`, `board_status`, `timestamp`) VALUES
(1, 'Alvin Mark Tuballas', '2064 Tuyan Naga', '0322592264', 'married', 'Web Developer', 'monthly', '2012-12-28 00:00:00', 1, 'television,refrigerator,radio,fan', 0, '2012-12-14 13:51:22'),
(2, 'Alvin', '2064 Tuyan Naga', '0322592664', 'married', 'Web Developer', 'monthly', '2012-12-26 00:00:00', 1, 'television,refrigerator,radio,fan', 0, '2012-12-14 14:19:11');
