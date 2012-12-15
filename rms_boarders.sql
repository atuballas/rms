-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 15, 2012 at 03:03 PM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `rms_boarders`
--


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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

--
-- Dumping data for table `rms_rooms`
--

