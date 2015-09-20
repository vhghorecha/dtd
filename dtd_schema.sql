-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2015 at 12:01 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dtd_schema`
--
CREATE DATABASE IF NOT EXISTS `dtd_schema` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dtd_schema`;

-- --------------------------------------------------------

--
-- Table structure for table `dtd_admin`
--

DROP TABLE IF EXISTS `dtd_admin`;
CREATE TABLE IF NOT EXISTS `dtd_admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_user` varchar(45) NOT NULL,
  `admin_pass` varchar(40) NOT NULL,
  `admin_name` varchar(45) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_user_UNIQUE` (`admin_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dtd_cust`
--

DROP TABLE IF EXISTS `dtd_cust`;
CREATE TABLE IF NOT EXISTS `dtd_cust` (
  `cust_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `user_regno` varchar(45) NOT NULL,
  `vendor_id` int(20) unsigned DEFAULT NULL,
  `user_grade` smallint(5) unsigned DEFAULT NULL,
  `user_lob` varchar(45) DEFAULT NULL,
  `user_sercomp` varchar(100) NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dtd_cust`
--

INSERT INTO `dtd_cust` (`cust_id`, `user_id`, `user_regno`, `vendor_id`, `user_grade`, `user_lob`, `user_sercomp`) VALUES
(1, 2, 'E-Commerce', NULL, NULL, 'US-REG-OS258694', 'Flipcarto Inc.');

-- --------------------------------------------------------

--
-- Table structure for table `dtd_custdep`
--

DROP TABLE IF EXISTS `dtd_custdep`;
CREATE TABLE IF NOT EXISTS `dtd_custdep` (
  `dep_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dep_custid` int(10) unsigned NOT NULL,
  `dep_date` datetime NOT NULL,
  `dep_amount` decimal(8,2) NOT NULL,
  `dep_transno` varchar(45) NOT NULL,
  `dep_bankname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`dep_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dtd_cust_grade`
--

DROP TABLE IF EXISTS `dtd_cust_grade`;
CREATE TABLE IF NOT EXISTS `dtd_cust_grade` (
  `grade_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `grade_name` varchar(45) NOT NULL,
  PRIMARY KEY (`grade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dtd_gradeprice`
--

DROP TABLE IF EXISTS `dtd_gradeprice`;
CREATE TABLE IF NOT EXISTS `dtd_gradeprice` (
  `gp_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `gp_fromdt` datetime NOT NULL,
  `gp_todt` datetime NOT NULL,
  `gp_grade` smallint(5) unsigned NOT NULL,
  `gp_disc` decimal(8,2) NOT NULL,
  PRIMARY KEY (`gp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dtd_itemprice`
--

DROP TABLE IF EXISTS `dtd_itemprice`;
CREATE TABLE IF NOT EXISTS `dtd_itemprice` (
  `gi_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `gi_type` smallint(5) unsigned NOT NULL,
  `gi_price` decimal(8,2) NOT NULL,
  PRIMARY KEY (`gi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dtd_item_type`
--

DROP TABLE IF EXISTS `dtd_item_type`;
CREATE TABLE IF NOT EXISTS `dtd_item_type` (
  `type_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(20) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dtd_order`
--

DROP TABLE IF EXISTS `dtd_order`;
CREATE TABLE IF NOT EXISTS `dtd_order` (
  `order_id` bigint(40) unsigned NOT NULL AUTO_INCREMENT,
  `order_custid` int(10) unsigned NOT NULL,
  `order_vendorid` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_recipient` varchar(100) NOT NULL,
  `order_address` varchar(255) NOT NULL,
  `order_zipcode` varchar(6) NOT NULL,
  `order_telp` varchar(10) DEFAULT NULL,
  `order_telno` varchar(20) DEFAULT NULL,
  `order_mobp` varchar(10) DEFAULT NULL,
  `order_mobno` varchar(20) DEFAULT NULL,
  `order_typeid` smallint(4) unsigned NOT NULL,
  `order_amount` decimal(8,2) NOT NULL,
  `order_itemname` varchar(100) NOT NULL,
  `order_desc` text,
  `order_memo` text,
  `order_status` varchar(20) NOT NULL,
  `order_updatecode` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dtd_users`
--

DROP TABLE IF EXISTS `dtd_users`;
CREATE TABLE IF NOT EXISTS `dtd_users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(45) NOT NULL,
  `user_add` varchar(200) DEFAULT NULL,
  `user_zipcode` varchar(5) NOT NULL,
  `user_tel` varchar(20) DEFAULT NULL,
  `user_mob` varchar(20) NOT NULL,
  `user_site` varchar(255) DEFAULT NULL,
  `user_balance` decimal(8,2) DEFAULT '0.00',
  `user_staffname` varchar(45) DEFAULT NULL,
  `user_stafftel` varchar(20) DEFAULT NULL,
  `user_memo` text,
  `is_active` tinyint(1) DEFAULT '0',
  `user_role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email_UNIQUE` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dtd_users`
--

INSERT INTO `dtd_users` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_add`, `user_zipcode`, `user_tel`, `user_mob`, `user_site`, `user_balance`, `user_staffname`, `user_stafftel`, `user_memo`, `is_active`, `user_role`) VALUES
(1, 'DFX Courier Service', 'chiragbhattmca@gmail.com', 'abc', 'Park Street, 178 Lane, New Joursey', '36000', '011-586-933004', '9685472356', 'www.dfx.com', '0.00', 'Mr. CHIRAG BHATT', '98765432100', 'This is a Vendor who can provide the service', 1, 'vendor'),
(2, 'Flipcarto Inc.', 'vimalghorecha@gmail.com', 'vhg', 'Arcane Complex, 122 Lane, Wall Street, Callifornia', '36985', '055-987-635-41', '074-7532-698', 'www.flipcarto.com', '0.00', 'Vimal Ghorecha', '074-3214-578', 'This is Customer who can use the courier service from allocated vendor', 1, 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `dtd_vendor`
--

DROP TABLE IF EXISTS `dtd_vendor`;
CREATE TABLE IF NOT EXISTS `dtd_vendor` (
  `vendor_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `vendor_taxno` varchar(45) NOT NULL,
  `vendor_comp` varchar(100) NOT NULL,
  `vendor_hq1` varchar(45) DEFAULT NULL,
  `vendor_hq2` varchar(45) DEFAULT NULL,
  `vendor_hq3` varchar(45) DEFAULT NULL,
  `pay_bankacno` varchar(30) NOT NULL,
  `pay_bankname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dtd_vendor`
--

INSERT INTO `dtd_vendor` (`vendor_id`, `user_id`, `vendor_taxno`, `vendor_comp`, `vendor_hq1`, `vendor_hq2`, `vendor_hq3`, `pay_bankacno`, `pay_bankname`) VALUES
(1, 1, 'AQDLLOP234EERRT6G', 'DFX Inc', 'New Joursey', 'New York', 'Filadelphia', '526335589472563', 'New York Cooperative Bank');

-- --------------------------------------------------------

--
-- Table structure for table `dtd_vendorpay`
--

DROP TABLE IF EXISTS `dtd_vendorpay`;
CREATE TABLE IF NOT EXISTS `dtd_vendorpay` (
  `dep_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pay_vendorid` int(10) unsigned NOT NULL,
  `pay_date` datetime NOT NULL,
  `pay_amount` decimal(8,2) NOT NULL,
  `pay_transno` varchar(45) NOT NULL,
  `pay_bankacno` varchar(30) NOT NULL,
  `pay_bankname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`dep_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dtd_vendorprice`
--

DROP TABLE IF EXISTS `dtd_vendorprice`;
CREATE TABLE IF NOT EXISTS `dtd_vendorprice` (
  `vp_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `gp_vendorid` int(10) unsigned NOT NULL,
  `gp_typeid` smallint(5) unsigned NOT NULL,
  `gp_price` decimal(8,2) NOT NULL,
  PRIMARY KEY (`vp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
