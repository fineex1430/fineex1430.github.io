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
-- Database: `my_hotel`
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
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_mobile_number` text COLLATE utf8_unicode_ci NOT NULL,
  `restaurant_id` text COLLATE utf8_unicode_ci NOT NULL,
  `menu_item_id` text COLLATE utf8_unicode_ci NOT NULL,
  `quantity` text COLLATE utf8_unicode_ci NOT NULL,
  `total_amount` text COLLATE utf8_unicode_ci NOT NULL,
  `total_discount` text COLLATE utf8_unicode_ci NOT NULL,
  `final_amount` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_mobile_number`, `restaurant_id`, `menu_item_id`, `quantity`, `total_amount`, `total_discount`, `final_amount`, `date`, `time`) VALUES
(15, '9822099113', '22', '22', '2', '0', '0', '0', '2021-06-10', '16:34:27 30');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_id` text COLLATE utf8_unicode_ci NOT NULL,
  `menu_item_name` text COLLATE utf8_unicode_ci NOT NULL,
  `item_description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `thumbnail_item_image` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` text COLLATE utf8_unicode_ci NOT NULL,
  `item_id` text COLLATE utf8_unicode_ci NOT NULL,
  `item_name` text COLLATE utf8_unicode_ci NOT NULL,
  `item_price` text COLLATE utf8_unicode_ci NOT NULL,
  `item_max_price` text COLLATE utf8_unicode_ci NOT NULL,
  `item_discount` text COLLATE utf8_unicode_ci NOT NULL,
  `item_quantity` text COLLATE utf8_unicode_ci NOT NULL,
  `now_final_bill_amount` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `item_name`, `item_price`, `item_max_price`, `item_discount`, `item_quantity`, `now_final_bill_amount`, `date`, `time`) VALUES
(1, '1', '1', 'pasta', '100', '200', '10', '1', '180', '2021-06-07', '11:44:22 30'),
(2, '1', '1', 'pasta', '100', '200', '10', '1', '180', '2021-06-07', '11:45:56 30'),
(3, '1', '1', 'pasta', '100', '200', '10', '1', '180', '2021-06-07', '11:47:21 30'),
(4, '31', '1', 'pasta', '100', '200', '10', '1', '180', '2021-06-07', '11:54:55 30'),
(5, '31', '1', 'pizza', '100', '200', '50', '1', '190', '2021-06-07', '12:00:58 30'),
(6, '31', '1', 'pizza', '100', '200', '50', '1', '190', '2021-06-07', '12:01:37 30');

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
(1, 'BALAJI SAROVAR', 'ASRA CHOWK, HOTGI ROAD, SOLAPUR', 'kzJ3Tiik2Y.jpg', '9587458563', '', 'REDDY', 'balaji', 'balaji', '2021-05-16', '19:49:15'),
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
  `account_status` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `mobile_number`, `password`, `date`, `time`, `account_status`) VALUES
(10, 'vaibhavi', '1122334455', 'password', '2021-05-27', '17:29:30 31', ''),
(11, 'demo', '9988776655', 'password', '2021-05-27', '17:37:50 31', ''),
(12, 'demo', '1122334488', 'password', '2021-05-27', '17:57:59 31', ''),
(13, 'vaibhavi', '9822099113', 'new', '2021-06-11', '16:20:44 30', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

DROP TABLE IF EXISTS `user_orders`;
CREATE TABLE IF NOT EXISTS `user_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_contact_no` text COLLATE utf8_unicode_ci NOT NULL,
  `order_id` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` text COLLATE utf8_unicode_ci NOT NULL,
  `order_status` text COLLATE utf8_unicode_ci NOT NULL,
  `restaurant_id` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`id`, `user_contact_no`, `order_id`, `date`, `time`, `order_status`, `restaurant_id`) VALUES
(17, '2233114455', '5', '2021-06-03', '11:11:11', 'dispatched', ''),
(15, '1122553344', '3', '2021-06-03', '11:11:11', 'pending', ''),
(25, '1122334455', '1', '2021-06-07', '11:42:11 30', 'active', ''),
(31, '9988776655', '1', '2021-06-07', '11:54:55 30', 'pending', ''),
(30, '1122334400', '1', '2021-06-07', '11:47:21 30', 'active', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
