-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 19, 2012 at 10:34 AM
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
-- Table structure for table `rms_amenities`
--

CREATE TABLE IF NOT EXISTS `rms_amenities` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `rms_amenities`
--

INSERT INTO `rms_amenities` (`id`, `name`, `description`, `status`, `timestamp`) VALUES
(1, 'Free Electric', 'Free electric for boarders as long as they follow rules', 1, '2012-12-19 00:00:00'),
(2, 'Free Water', 'Free water for boarder who''s following rules', 1, '2012-12-19 12:55:52'),
(3, 'Free Food', 'free food', 0, '2012-12-19 12:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `rms_appliances`
--

CREATE TABLE IF NOT EXISTS `rms_appliances` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rms_appliances`
--

INSERT INTO `rms_appliances` (`id`, `name`, `status`, `timestamp`) VALUES
(1, 'Television', 1, '2012-12-19 15:28:58'),
(2, 'Refrigerator', 1, '2012-12-19 15:42:31');

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
  `board_status` tinyint(1) NOT NULL COMMENT '0-inactive, 1-active, 2-evicted',
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `room_number` (`room_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rms_boarders`
--

INSERT INTO `rms_boarders` (`id`, `name`, `address`, `telephone`, `status`, `profession`, `boarding_type`, `checked_in_date`, `room_number`, `additional_appliances`, `board_status`, `timestamp`) VALUES
(1, 'Alvin', '2064 Tuyan Naga', '0322592664', 'married', 'Senior Web Developer', 'monthly', '2012-12-25 00:00:00', 1, 'television,refrigerator,radio,fan', 1, '2012-12-17 12:51:28'),
(2, 'Alvin Mark', '2064 Tuyan Naga', '0322592664', 'single', 'Web Developer', 'monthly', '2012-12-17 00:00:00', 2, 'television,refrigerator,radio,fan', 1, '2012-12-17 12:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `rms_rooms`
--

CREATE TABLE IF NOT EXISTS `rms_rooms` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `room_no` bigint(25) NOT NULL,
  `room_description` text NOT NULL,
  `room_rate` double NOT NULL,
  `room_max` tinyint(2) NOT NULL,
  `room_amenities` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `room_no` (`room_no`),
  KEY `status` (`status`),
  KEY `room_max` (`room_max`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rms_rooms`
--

INSERT INTO `rms_rooms` (`id`, `room_no`, `room_description`, `room_rate`, `room_max`, `room_amenities`, `status`, `timestamp`) VALUES
(1, 1, 'elegant room', 2500, 2, 'free electric and water', 'reserved', '2012-12-17 12:03:48'),
(2, 2, 'Big Room', 3000, 3, 'free water and electric', 'occupied', '2012-12-17 12:52:55');
