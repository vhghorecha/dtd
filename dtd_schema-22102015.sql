-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 22, 2015 at 09:43 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dtd_schema`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dtd_cust`
--

INSERT INTO `dtd_cust` (`cust_id`, `user_id`, `user_regno`, `vendor_id`, `user_grade`, `user_lob`, `user_sercomp`) VALUES
(1, 2, 'E-Commerce', 1, 1, 'US-REG-OS258694', 'Flipcarto Inc.'),
(2, 3, '', NULL, NULL, NULL, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dtd_custdep`
--

INSERT INTO `dtd_custdep` (`dep_id`, `dep_custid`, `dep_date`, `dep_amount`, `dep_transno`, `dep_bankname`) VALUES
(1, 2, '2015-09-14 00:00:00', 100.00, '2452546', 'Bank of Sanghai');

-- --------------------------------------------------------

--
-- Table structure for table `dtd_cust_grade`
--

DROP TABLE IF EXISTS `dtd_cust_grade`;
CREATE TABLE IF NOT EXISTS `dtd_cust_grade` (
  `grade_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `grade_name` varchar(45) NOT NULL,
  PRIMARY KEY (`grade_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dtd_cust_grade`
--

INSERT INTO `dtd_cust_grade` (`grade_id`, `grade_name`) VALUES
(1, 'Purple'),
(2, 'Silver'),
(3, 'Gold');

-- --------------------------------------------------------

--
-- Table structure for table `dtd_gradeprice`
--

DROP TABLE IF EXISTS `dtd_gradeprice`;
CREATE TABLE IF NOT EXISTS `dtd_gradeprice` (
  `gp_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `gp_fromdt` date NOT NULL,
  `gp_todt` date NOT NULL,
  `gp_no_order` smallint(5) NOT NULL,
  `gp_grade` smallint(5) unsigned NOT NULL,
  `gp_disc` decimal(8,2) NOT NULL,
  PRIMARY KEY (`gp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dtd_gradeprice`
--

INSERT INTO `dtd_gradeprice` (`gp_id`, `gp_fromdt`, `gp_todt`, `gp_no_order`, `gp_grade`, `gp_disc`) VALUES
(1, '2015-01-01', '2015-12-31', 1, 1, 10.00),
(2, '2015-01-01', '2015-12-31', 1, 2, 20.00),
(3, '2015-01-01', '2015-12-31', 1, 3, 30.00);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dtd_itemprice`
--

INSERT INTO `dtd_itemprice` (`gi_id`, `gi_type`, `gi_price`) VALUES
(1, 1, 100.00),
(2, 2, 200.00),
(3, 3, 300.00);

-- --------------------------------------------------------

--
-- Table structure for table `dtd_item_type`
--

DROP TABLE IF EXISTS `dtd_item_type`;
CREATE TABLE IF NOT EXISTS `dtd_item_type` (
  `type_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(20) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dtd_item_type`
--

INSERT INTO `dtd_item_type` (`type_id`, `type_name`) VALUES
(1, 'Small Box '),
(2, 'Medium Box'),
(3, 'Large Box');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dtd_order`
--

INSERT INTO `dtd_order` (`order_id`, `order_custid`, `order_vendorid`, `order_date`, `order_recipient`, `order_address`, `order_zipcode`, `order_telp`, `order_telno`, `order_mobp`, `order_mobno`, `order_typeid`, `order_amount`, `order_itemname`, `order_desc`, `order_memo`, `order_status`, `order_updatecode`) VALUES
(1, 2, 1, '2015-09-22 05:37:03', 'Hardik Mehta', '                                              Rasala Road, New York Building, New York                                                          ', '0', '0', '221617', '0', '9427157507', 1, 90.00, 'Motorola Mobile E', '                            Motorola Mobile E                                                                            ', '                            Motorola Mobile E. Urgent Delivery                                                                            ', 'Pending', NULL),
(2, 2, 1, '2015-09-22 05:39:47', 'Vimal Ghorecha', '                            Paris, Eifel Tower                                                                            ', '0', '0', '221117', '0', '9797232323', 2, 180.00, 'Moto G', '                            Motorola Mobile. Item Code: Moto G                                                                            ', '                            Motorola Mobile. Item Code: Moto G                                                                            ', 'Created', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dtd_users`
--

INSERT INTO `dtd_users` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_add`, `user_zipcode`, `user_tel`, `user_mob`, `user_site`, `user_balance`, `user_staffname`, `user_stafftel`, `user_memo`, `is_active`, `user_role`) VALUES
(1, 'DFX Courier Service', 'chiragbhattmca@gmail.com', 'asd', 'Park Street, 178 Lane, New Joursey', '36000', '011-586-933004', '9685472356', 'www.dfx.com', 0.00, 'Mr. CHIRAG BHATT', '98765432100', 'This is a Vendor who can provide the service', 1, 'vendor'),
(2, 'Flipcarto Inc.', 'vimalghorecha@gmail.com', 'vhg', 'Arcane Complex, 122 Lane, Wall Street, Callifornia', '36985', '055-987-635-41', '074-7532-698', 'www.flipcarto.com', -170.00, 'Vimal Ghorecha', '074-3214-578', 'This is Customer who can use the courier service from allocated vendor', 1, 'customer'),
(3, 'Hardik Mehta', 'hardik.rkcet@gmail.com', 'hsm', 'C/o S. M. Mehta, Rasala Road, ', '36000', '02828', '9427157507', 'www.hsm.in', 0.00, 'Hardik Mehta', '9427157507', NULL, 0, 'customer');

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
