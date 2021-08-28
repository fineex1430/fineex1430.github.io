-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 11, 2021 at 12:03 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coshield`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
CREATE TABLE IF NOT EXISTS `restaurant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_name` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `contact_no_1` text COLLATE utf8_unicode_ci NOT NULL,
  `contact_no_2` text COLLATE utf8_unicode_ci NOT NULL,
  `owner_name` text COLLATE utf8_unicode_ci NOT NULL,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `restaurant_name`, `address`, `image`, `contact_no_1`, `contact_no_2`, `owner_name`, `username`, `password`, `date`, `time`) VALUES
(1, 'BALAJI SAROVAR', 'ASRA CHOWK, HOTGI ROAD, SOLAPUR', 'AKCMYe9U35.pdf', '9587458563', '', 'REDDY', 'balaji', 'balaji', '2021-06-11', '17:13:47'),
(11, 'NISARG DHABA', 'PUNE ROAD', 'v6GsD5hLFu.jpg', '4567898521', '', 'JADHAV', 'nisarg', 'nisarg', '2021-05-16', '20:02:02'),
(13, 'Grand 11', 'Roop Nagar, Prem Gali, Kholi Number 420', 'GDYsCMvdn2.jpg', '7766554433', '9822202020', 'Nitin Anpat', 'nitin@mh13', 'nitin@mh13', '2021-05-21', '20:26:03'),
(14, 'vaibhavi', 'aaaa', 'a', '1122334455', '5544332211', 'vaibhavi', 'vaibhavi', 'password', '2021-05-28', '10:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` text COLLATE utf8_unicode_ci NOT NULL,
  `mobile_number` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `mobile_number`, `password`, `date`, `time`) VALUES
(10, 'ss', '1122334455', 'password', '2021-06-11', '17:12:42'),
(11, 'demo', '9988776655', 'password', '2021-05-27', '17:37:50 31'),
(12, 'demo', '1122334488', 'password', '2021-05-27', '17:57:59 31'),
(13, 'vaibhvai', '9822099177', 'new', '2021-06-11', '17:24:04');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
