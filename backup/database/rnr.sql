-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Sep 09, 2015 at 12:04 AM
-- Server version: 5.6.23
-- PHP Version: 5.5.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rnr_prod`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email_id` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Email-id of the admin '
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='admin creds';

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `user_name`, `password`, `email_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '');

-- --------------------------------------------------------

--
-- Table structure for table `cms_homepage_people_stories`
--

CREATE TABLE IF NOT EXISTS `cms_homepage_people_stories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_text` text NOT NULL,
  `created_on` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_homepage_people_stories`
--

INSERT INTO `cms_homepage_people_stories` (`id`, `user_id`, `article_text`, `created_on`, `status`) VALUES
(1, 1, 'sample text goes here , ', '2015-06-23 00:00:00', 'Active'),
(2, 2, 'Voluptatem accusantium doloremque laudantium, totam rem aperianventore et quasi architecto beatae vitae dicta explicaboVoluptatem accusantium doloremque laudantium, totam rem aperianventore et quasi architecto beatae vitae dicta explicaboVoluptatem accusantium doloremque laudantium, totam rem aperianventore et quasi architecto beatae vitae dicta explicabo', '2015-07-01 00:00:00', 'Active'),
(3, 1, 'Voluptatem accusantium doloremque laudantium, totam rem aperianventore et quasi architecto beatae vitae dicta explicaboVoluptatem accusantium doloremque laudantium, totam rem aperianventore et quasi architecto beatae vitae dicta explicaboVoluptatem accusantium doloremque laudantium, totam rem aperianventore et quasi architecto beatae vitae dicta explicabo', '2015-06-01 00:00:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_homepage_slides`
--

CREATE TABLE IF NOT EXISTS `cms_homepage_slides` (
  `id` int(11) NOT NULL,
  `slider_image` text NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_homepage_slides`
--

INSERT INTO `cms_homepage_slides` (`id`, `slider_image`, `type`) VALUES
(1, 'slide1.jpg', 'home'),
(2, 'slide1.jpg', 'home'),
(3, 'slide1.jpg', 'home'),
(4, 'slide1.jpg', 'home'),
(5, 'overview-slide1.jpg', 'search'),
(6, 'overview-slide1.jpg', 'search'),
(7, 'overview-slide1.jpg', 'search'),
(8, 'overview-slide1.jpg', 'search');

-- --------------------------------------------------------

--
-- Table structure for table `cms_homepage_whats_happening`
--

CREATE TABLE IF NOT EXISTS `cms_homepage_whats_happening` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_homepage_whats_happening`
--

INSERT INTO `cms_homepage_whats_happening` (`id`, `title`, `description`, `image`, `date`) VALUES
(1, 'Sula Wines Festival, Nashik', 'With a culture as vibrant as ours, there are always festivities in place. Experience \nthe true color and vigor of these celebrations in person.', 'grapes.png', '2015-07-22');

-- --------------------------------------------------------

--
-- Table structure for table `host_language`
--

CREATE TABLE IF NOT EXISTS `host_language` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `host_language`
--

INSERT INTO `host_language` (`id`, `name`) VALUES
(1, 'Hindi'),
(2, 'English'),
(3, 'Marathi'),
(4, 'Telgu'),
(5, 'Bengali');

-- --------------------------------------------------------

--
-- Table structure for table `master_amenities`
--

CREATE TABLE IF NOT EXISTS `master_amenities` (
  `amenities_id` int(11) NOT NULL,
  `amenities_type` int(11) DEFAULT NULL,
  `amenities_subtype` varchar(45) DEFAULT NULL,
  `images` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_amenities`
--

INSERT INTO `master_amenities` (`amenities_id`, `amenities_type`, `amenities_subtype`, `images`, `status`) VALUES
(1, 1, 'BAR', 'bar.png', 'Inactive'),
(2, 2, 'AIR CONDTIONING', 'ac.png', 'Inactive'),
(4, 1, 'KITCHEN', 'kitchen.png', 'Inactive'),
(5, 1, 'INTERNET', 'locker.png', 'Active'),
(6, 2, 'SMOKING ALLOWED', 'smoking.png', 'Inactive'),
(7, 2, 'WASHER', 'washer.png', 'Inactive'),
(8, 3, 'WHEEL CHAIR ', 'wheel-chair.png', 'Inactive'),
(14, 2, 'SMOKE DETECTOR', 'smoke-detector1.png', 'Inactive'),
(15, 4, 'FIRE EXTINGUISHER', 'fire-extinguisher1.png', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `master_amenities_type`
--

CREATE TABLE IF NOT EXISTS `master_amenities_type` (
  `amenities_type_id` int(11) NOT NULL,
  `amenities_type_name` char(120) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_amenities_type`
--

INSERT INTO `master_amenities_type` (`amenities_type_id`, `amenities_type_name`, `status`) VALUES
(1, 'COMMON', 'Active'),
(2, 'FEATURE', 'Active'),
(3, 'EXTRA', 'Active'),
(4, 'SAFETY', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `master_cancellation_policy`
--

CREATE TABLE IF NOT EXISTS `master_cancellation_policy` (
  `id` int(11) NOT NULL,
  `policy` varchar(30) NOT NULL,
  `policy_description` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_cancellation_policy`
--

INSERT INTO `master_cancellation_policy` (`id`, `policy`, `policy_description`) VALUES
(1, 'Strict ', 'Strict ....'),
(2, 'Moderate', '50% extra ... details....'),
(3, 'Flexible', 'flexible .... '),
(4, 'Test ', 'Test ...details');

-- --------------------------------------------------------

--
-- Table structure for table `master_city`
--

CREATE TABLE IF NOT EXISTS `master_city` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_name` char(120) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_city`
--

INSERT INTO `master_city` (`id`, `country_id`, `state_id`, `city_name`, `status`) VALUES
(13, 8, 21, 'Mumbai', 'Active'),
(14, 8, 22, 'Delhi', 'Active'),
(15, 8, 21, 'Pune', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `master_country`
--

CREATE TABLE IF NOT EXISTS `master_country` (
  `country_id` int(11) NOT NULL,
  `country_name` char(120) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_country`
--

INSERT INTO `master_country` (`country_id`, `country_name`, `status`) VALUES
(8, 'India', 'Active'),
(9, 'USA', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `master_document`
--

CREATE TABLE IF NOT EXISTS `master_document` (
  `id` int(11) NOT NULL,
  `document` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0: Inactive; 1: Active'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_document`
--

INSERT INTO `master_document` (`id`, `document`, `status`) VALUES
(1, 'Driving License', 1),
(2, 'Voter ID Card', 1),
(3, 'PAN Card', 1),
(4, 'AADHAR Card', 1),
(5, 'Passport', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_host_tabstatus`
--

CREATE TABLE IF NOT EXISTS `master_host_tabstatus` (
  `id` int(11) NOT NULL,
  `tab_name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_host_tabstatus`
--

INSERT INTO `master_host_tabstatus` (`id`, `tab_name`) VALUES
(1, 'overview'),
(2, 'photo'),
(3, 'pricing'),
(4, 'amenities'),
(5, 'info'),
(6, 'location');

-- --------------------------------------------------------

--
-- Table structure for table `master_language`
--

CREATE TABLE IF NOT EXISTS `master_language` (
  `id` int(11) NOT NULL,
  `language` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Active; 1: Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_language`
--

INSERT INTO `master_language` (`id`, `language`, `status`) VALUES
(1, 'Marathi', 1),
(2, 'Kannad', 1),
(3, 'Tamil', 1),
(4, 'Bengali', 1),
(5, 'Telugu', 1),
(6, 'Hindi', 1),
(7, 'English', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_price_period`
--

CREATE TABLE IF NOT EXISTS `master_price_period` (
  `id` int(11) NOT NULL,
  `period` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_price_period`
--

INSERT INTO `master_price_period` (`id`, `period`) VALUES
(1, 'Weekly'),
(2, 'Daily'),
(3, 'Monthly'),
(4, 'Yearly');

-- --------------------------------------------------------

--
-- Table structure for table `master_price_seasontype`
--

CREATE TABLE IF NOT EXISTS `master_price_seasontype` (
  `id` int(11) NOT NULL,
  `season_type` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_price_seasontype`
--

INSERT INTO `master_price_seasontype` (`id`, `season_type`) VALUES
(2, 'Season 1'),
(4, 'Season 2'),
(5, 'Season 4');

-- --------------------------------------------------------

--
-- Table structure for table `master_property_type`
--

CREATE TABLE IF NOT EXISTS `master_property_type` (
  `property_type_id` int(11) NOT NULL,
  `property_type` varchar(45) DEFAULT NULL,
  `element_type` varchar(30) NOT NULL,
  `images` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_property_type`
--

INSERT INTO `master_property_type` (`property_type_id`, `property_type`, `element_type`, `images`) VALUES
(1, 'Apartment', 'button', 'building.png'),
(2, 'House', 'button', 'home.png'),
(3, 'Bed & Breakfast', 'button', 'cup.png'),
(4, 'Villa', 'option', 'cup.png'),
(5, 'Castle', 'option', 'cup.png'),
(7, 'Villa 121', 'option', 'building.png');

-- --------------------------------------------------------

--
-- Table structure for table `master_room_type`
--

CREATE TABLE IF NOT EXISTS `master_room_type` (
  `room_type_id` int(11) NOT NULL,
  `roomtype` varchar(45) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `images` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_room_type`
--

INSERT INTO `master_room_type` (`room_type_id`, `roomtype`, `title`, `images`) VALUES
(1, 'Private', 'You''re renting private rooms within home', 'door.png'),
(2, 'Shared', 'You''re renting shared room within home', 'bed.png'),
(3, 'Entire Home apt', 'Your''re renting entire home apartment', 'home.png');

-- --------------------------------------------------------

--
-- Table structure for table `master_smiley`
--

CREATE TABLE IF NOT EXISTS `master_smiley` (
  `smiley_id` int(11) NOT NULL,
  `smiley_type` varchar(45) DEFAULT NULL,
  `smiley_icon` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_smiley`
--

INSERT INTO `master_smiley` (`smiley_id`, `smiley_type`, `smiley_icon`) VALUES
(1, '1', 'excelent.png'),
(2, '2', 'happy.png'),
(3, '3', 'not-happy.png'),
(4, '4', 'sad.png'),
(5, '5', 'angry.png');

-- --------------------------------------------------------

--
-- Table structure for table `master_smiley_alt`
--

CREATE TABLE IF NOT EXISTS `master_smiley_alt` (
  `smiley_id` int(11) NOT NULL,
  `smiley_type` varchar(45) DEFAULT NULL,
  `smiley_image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_smiley_alt`
--

INSERT INTO `master_smiley_alt` (`smiley_id`, `smiley_type`, `smiley_image`) VALUES
(1, 'Angry', 'angry.png'),
(2, 'Sad', 'sad.png'),
(3, 'Not Happy', 'not-happy.png'),
(4, 'Happy', 'happy.png'),
(5, 'Excellent', 'excellent.png'),
(6, 'Excellent Big Time', 'excellent-big.png');

-- --------------------------------------------------------

--
-- Table structure for table `master_state`
--

CREATE TABLE IF NOT EXISTS `master_state` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_name` char(120) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_state`
--

INSERT INTO `master_state` (`id`, `country_id`, `state_name`, `status`) VALUES
(21, 8, 'Maharashtra', 'Active'),
(22, 8, 'Delhi', 'Active'),
(23, 8, 'Tamil Nadu', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `master_tag`
--

CREATE TABLE IF NOT EXISTS `master_tag` (
  `id` int(11) NOT NULL,
  `tag` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_tag`
--

INSERT INTO `master_tag` (`id`, `tag`) VALUES
(1, 'Beach Side'),
(2, 'Adventure'),
(3, 'Romantic'),
(4, 'TEST B'),
(5, 'TEST C');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE IF NOT EXISTS `properties` (
  `property_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `property_title` varchar(45) NOT NULL,
  `guest_allow` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `neighbourhood_highlight` text NOT NULL,
  `min_night_stay` varchar(45) NOT NULL,
  `bedrooms` varchar(45) NOT NULL,
  `bathrooms` varchar(45) NOT NULL,
  `bed` varchar(45) NOT NULL,
  `check_in_time` varchar(20) NOT NULL,
  `check_out_time` varchar(20) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `property_type_id` int(11) NOT NULL,
  `cancellation_policy_id` int(10) NOT NULL,
  `price` varchar(45) DEFAULT NULL,
  `address_line1` varchar(140) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `latitude` varchar(200) NOT NULL,
  `longitude` varchar(200) NOT NULL,
  `clean_charge` varchar(30) NOT NULL,
  `guest_charge` varchar(30) NOT NULL,
  `security_charge` varchar(30) NOT NULL,
  `rnr_recommended` tinyint(1) NOT NULL DEFAULT '0',
  `trending_destination` tinyint(1) NOT NULL,
  `hot_offer` tinyint(1) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `area` varchar(50) NOT NULL,
  `house_rule` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `host_language` int(11) NOT NULL,
  `service_fee` varchar(10) NOT NULL,
  `tax_fee` varchar(10) NOT NULL,
  `cancellation_detail` varchar(200) NOT NULL,
  `view_count` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=259 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`property_id`, `parent_id`, `user_id`, `property_title`, `guest_allow`, `description`, `neighbourhood_highlight`, `min_night_stay`, `bedrooms`, `bathrooms`, `bed`, `check_in_time`, `check_out_time`, `room_type_id`, `property_type_id`, `cancellation_policy_id`, `price`, `address_line1`, `country_id`, `state_id`, `city_id`, `zip`, `latitude`, `longitude`, `clean_charge`, `guest_charge`, `security_charge`, `rnr_recommended`, `trending_destination`, `hot_offer`, `created_on`, `modified_on`, `area`, `house_rule`, `status`, `host_language`, `service_fee`, `tax_fee`, `cancellation_detail`, `view_count`) VALUES
(1, NULL, 1, 'Nandas', '5', 'Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', '', '2', '2', '2', '3', '2015-07-01', '2015-07-10', 1, 2, 1, '7000', 'Malviya Nagar', 8, 22, 14, '', '28.643317500000000000', '77.338189399999920000', '', '', '', 1, 0, 1, '2015-07-01 16:16:58', '2015-07-01 16:16:58', '', 'house rules', 'Active', 1, '', '', '', 0),
(2, NULL, 2, 'Cottage house', '3', 'Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', 'Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', '3', '1', '1', '2', '2015-07-01', '2015-07-10', 2, 2, 2, '7000', 'Dwarka', 8, 22, 14, '', '28.643317500000000000', '77.338189399999920000', '210', '1200', '240', 0, 0, 1, '2015-07-01 16:32:40', '2015-07-01 16:32:40', 'AZ road', 'Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', 'Inactive', 2, '120', '160', '', 0),
(6, NULL, 1, 'Sidz Cottage', '1', 'Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', 'Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', '3', '1', '1', '1', '2015-07-01', '2015-07-10', 1, 1, 3, '7000', 'Mg Road', 8, 22, 14, '', '28.643317500000000000', '77.338189399999920000', '', '', '', 0, 0, 1, '2015-07-01 11:39:57', '2015-07-01 11:39:57', 'Lonavala', 'Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', '', 1, '', '', 'test cancellation text....', 0),
(8, NULL, 1, 'Valvan Cottage', '5', 'Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', '', '', '', '', '', '2015-07-01', '2015-07-10', 2, 1, 0, '7000', 'Exhibition Road', 1, 1, 1, '', '', '', '', '', '', 0, 0, 0, '2015-07-07 06:13:11', '2015-07-07 06:13:11', '', '', 'Inactive', 0, '', '', '', 0),
(16, NULL, 1, 'Maddy House', '10', 'Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', '', '', '2', '1', '3', '2015-07-01', '2015-07-10', 3, 2, 0, '7000', 'Marine House', 1, 3, 3, '', '', '', '', '', '', 0, 0, 0, '2015-07-13 09:14:27', '2015-07-13 09:14:27', '', '', 'Active', 0, '', '', '', 0),
(19, NULL, 2, 'Diamond house', '2', 'Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', 'description  diamond housedescription  diamon', '1', '', '', '', '2015-07-01', '2015-07-10', 1, 1, 0, '7000', '', 0, 0, 1, '', '', '', '', '', '', 0, 0, 0, '2015-07-17 11:51:19', '2015-07-17 11:51:19', '', 'description  diamond housev', '', 0, '', '', '', 0),
(39, NULL, 2, 'title', '3', 'Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', 'neighberhood', '1', '', '', '', '2015-07-01', '2015-07-10', 1, 1, 0, '7000', '', 0, 0, 1, '', '', '', '234', '', '', 0, 0, 0, '2015-07-20 10:15:17', '2015-07-20 10:15:17', '', 'house rules', '', 0, '', '', '', 0),
(40, NULL, 2, '', '3', 'Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', '', '', '', '', '', '2015-07-01', '2015-07-10', 1, 1, 0, '7000', '', 0, 0, 7, '', '', '', '', '', '', 0, 0, 0, '2015-07-20 10:53:01', '2015-07-20 10:53:01', '', '', '', 0, '', '', '', 0),
(41, NULL, 2, 'title ', '4', 'Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', 'neighberhood hei', '1', '', '', '', '2015-07-01', '2015-07-10', 1, 1, 0, '7000', '', 0, 0, 1, '', '', '', '', '', '', 0, 0, 0, '2015-07-21 08:07:43', '2015-07-21 08:07:43', '', 'house rules', '', 0, '', '', '', 0),
(42, NULL, 2, 'title', '3', 'Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', 'description  description  description  descri', '1', '', '', '', '2015-07-01', '2015-07-10', 1, 1, 0, '7000', '', 0, 0, 1, '', '', '', '', '', '', 0, 0, 0, '2015-07-21 08:13:18', '2015-07-21 08:13:18', '', '', '', 0, '', '', '', 0),
(43, NULL, 2, 'title', '1', 'descritpion  descritpion  descritpion  descritpion  descritpion  descritpion  descritpion  descritpion  descritpion  descritpion  descritpion  descritpion  descritpion  ', 'neighberhood highlights', '1', '', '', '', '2015-07-01', '2015-07-10', 1, 1, 0, '7000', '', 0, 0, 1, '', '', '', '', '', '', 0, 0, 0, '2015-07-23 11:51:25', '2015-07-23 11:51:25', '', 'house rules', '', 0, '', '', '', 0),
(44, NULL, 2, 'title and summary displayed on your public li', '2', '  title and summary displayed on your public listing pagetitle and summary displayed on your public listing pagetitle and summary displayed on your public listing page', 'title and summary displayed on your public li', '1', '', '', '', '2015-07-01', '2015-07-10', 1, 1, 0, '7000', '', 0, 0, 1, '', '', '', '', '', '', 0, 0, 0, '2015-07-24 08:24:09', '2015-07-24 08:24:09', '', 'title and summary displayed on your public listing page', '', 0, '', '', '', 0),
(48, NULL, 2, 'Title test check', '4', 'A title and summary displayed on your public listing pageA title and summary displayed on your public listing page', 'A title and summary displayed on your public ', '1', '', '', '', '2015-07-01', '2015-07-10', 1, 1, 0, '7000', '', 0, 0, 1, '', '', '', '', '', '', 0, 0, 0, '2015-07-30 06:07:15', '2015-07-30 06:07:15', '', 'A title and summary displayed on your public listing pageA title and summary displayed on your public listing page', '', 0, '', '', '', 0),
(50, NULL, 2, 'senthil test', '4', '  senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test   senthil test ', 'NEIGHBERHOOD HIGHLIGHTS\nNEIGHBERHOOD HIGHLIGH', '4', '', '', '', '2015-07-01', '2015-07-10', 3, 2, 0, '7000', '', 0, 0, 1, '', '', '', '', '', '', 0, 0, 0, '2015-07-30 06:44:24', '2015-07-30 06:44:24', '', 'HOUSE RULES (IF ANY)\nHOUSE RULES (IF ANY)\n\nHOUSE RULES (IF ANY)\n\n', '', 0, '', '', '', 0),
(74, NULL, 2, 'sadasd', '1', '  asdasdasdsadasdas  asdasdasdsadasdas  asdasdasdsadasdas  asdasdasdsadasdas  asdasdasdsadasdas  asdasdasdsadasdas  asdasdasdsadasdas  asdasdasdsadasdas  asdasdasdsadasdas  asdasdasdsadasdas  asdasdasdsadasdas  asdasdasdsadasdas  asdasdasdsadasdas  asdasdasdsadasdas  asdasdasdsadasdas  asdasdasdsadasdas  asdasdasdsadasdas  asdasdasdsadasdas', '', '1', '', '', '', '2015-07-01', '2015-07-10', 1, 1, 0, '7000', '', 0, 0, 3, '', '', '', '', '', '', 0, 0, 0, '2015-08-03 07:13:27', '2015-08-03 07:13:27', '', '', '', 0, '', '', '', 0),
(78, NULL, 32, ' test', '1', 'test     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewrtest     wwerewrewrewr ewrew rewr ewrewr ewr', 'test ', '1', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 1, '', '', '', '', '', '', 0, 0, 0, '2015-08-05 10:49:46', '2015-08-05 10:49:46', '', 'test ', '', 0, '', '', '', 0),
(81, NULL, 31, '', '10+', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, 'Narayantal west', 8, 21, 15, '700059', '18.52110', '73.85645', '', '', '', 0, 0, 0, '2015-08-15 07:50:04', '2015-08-15 07:50:04', 'Dum dum', '', '', 0, '', '', '', 0),
(82, NULL, 31, 'Test property 1', '2', 'Test property 1 Test property 1 Test property 1 Test property 1', '', '1', '1', '2', '1', '7:00 AM', '12:00 PM', 1, 1, 1, NULL, 'Narayantal west', 8, 21, 13, '700059', '19.07624', '72.87785', '112.50', '', '', 0, 0, 0, '2015-08-15 14:01:38', '2015-08-15 14:01:38', 'Dum dum', '', 'Active', 0, '', '', '', 0),
(83, NULL, 31, 'Test property 1', '2', 'Test property 1 Test property 1 Test property 1 Test property 1', '', '4', '1', '2', '1', '8:00 PM', '8:00 AM', 1, 1, 3, NULL, 'Narayantal west', 8, 21, 13, '700059', '22.60832', '88.42499', '', '', '', 0, 0, 0, '2015-08-15 14:33:35', '2015-08-15 14:33:35', 'Dum dum', '', 'Active', 0, '', '', '', 0),
(86, NULL, 57, 'test', '1', 'test...test...test...test...test...test...test...test...test...test...test...test...test...test...test...test...test...test... test...test...test...test...test...test...test...test...test...test...test...test...test...test...test...test...test... ', 'test...test...test...test...test...test...tes', '1', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 15, '', '', '', '', '', '', 0, 0, 0, '2015-08-21 05:46:21', '2015-08-21 05:46:21', '', 'test...', 'Active', 0, '', '', '', 0),
(88, NULL, 66, 'raji vilas', '2', 'welcome home Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', 'no no', '2', '1', '1', '2', '', '', 1, 1, 1, '15000', 'chennai', 0, 0, 0, '', '0.24353555', '12.6867355662', '100', '300', '', 0, 0, 0, '2015-08-24 08:31:16', '2015-08-24 08:31:16', 'vnr', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(92, NULL, 66, 'raji vilas', '2', 'welcome home Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', 'no no', '2', '1', '1', '2', '', '', 1, 1, 1, '15000', 'chennai', 0, 0, 0, '', '0.24353555', '12.6867355662', '100', '300', '', 0, 0, 0, '2015-08-25 05:08:29', '2015-08-25 05:08:29', 'vnr', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(93, NULL, 66, 'ravi vilas', '2', 'Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 05:36:09', '2015-08-25 05:36:09', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(94, NULL, 66, 'ravi vilas', '2', 'Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 05:38:41', '2015-08-25 05:38:41', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(95, NULL, 66, 'ravi vilas', '2', 'Description: give your listing a title and summary ... details that highlight your space and hospitality and outline your house rules', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 05:39:11', '2015-08-25 05:39:11', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(96, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 05:40:58', '2015-08-25 05:40:58', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(97, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 05:42:49', '2015-08-25 05:42:49', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(98, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 05:43:27', '2015-08-25 05:43:27', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(99, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 05:46:54', '2015-08-25 05:46:54', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(101, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 06:21:23', '2015-08-25 06:21:23', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(102, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 06:39:47', '2015-08-25 06:39:47', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(103, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:19:22', '2015-08-25 07:19:22', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(104, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:21:21', '2015-08-25 07:21:21', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(105, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:24:38', '2015-08-25 07:24:38', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(106, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:24:39', '2015-08-25 07:24:39', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(107, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:25:07', '2015-08-25 07:25:07', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(108, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:26:29', '2015-08-25 07:26:29', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(109, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:26:37', '2015-08-25 07:26:37', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(110, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:32:04', '2015-08-25 07:32:04', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(111, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:32:11', '2015-08-25 07:32:11', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(112, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:32:16', '2015-08-25 07:32:16', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(113, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:32:54', '2015-08-25 07:32:54', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(114, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:33:00', '2015-08-25 07:33:00', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(115, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:33:05', '2015-08-25 07:33:05', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(116, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:33:11', '2015-08-25 07:33:11', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(117, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:33:38', '2015-08-25 07:33:38', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(118, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:33:44', '2015-08-25 07:33:44', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(119, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:35:41', '2015-08-25 07:35:41', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(120, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:35:47', '2015-08-25 07:35:47', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(121, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:36:22', '2015-08-25 07:36:22', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(122, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:36:28', '2015-08-25 07:36:28', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(123, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:36:36', '2015-08-25 07:36:36', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(124, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:39:49', '2015-08-25 07:39:49', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(125, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:39:55', '2015-08-25 07:39:55', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(126, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:45:13', '2015-08-25 07:45:13', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(127, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 07:59:46', '2015-08-25 07:59:46', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(128, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 08:00:21', '2015-08-25 08:00:21', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(129, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 08:00:33', '2015-08-25 08:00:33', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(130, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 10:12:24', '2015-08-25 10:12:24', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(131, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 10:18:58', '2015-08-25 10:18:58', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(132, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 10:19:05', '2015-08-25 10:19:05', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(133, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-25 10:20:28', '2015-08-25 10:20:28', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(134, NULL, 32, '', '1', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 13, '', '', '', '', '', '', 0, 0, 0, '2015-08-27 05:57:34', '2015-08-27 05:57:34', '', '', 'Active', 0, '', '', '', 0),
(135, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 06:18:54', '2015-08-27 06:18:54', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(136, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 06:21:02', '2015-08-27 06:21:02', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(137, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 06:21:42', '2015-08-27 06:21:42', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(138, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 06:22:35', '2015-08-27 06:22:35', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(139, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 06:23:35', '2015-08-27 06:23:35', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(140, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 06:38:38', '2015-08-27 06:38:38', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(141, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 06:38:51', '2015-08-27 06:38:51', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(142, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 06:39:02', '2015-08-27 06:39:02', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(143, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 06:39:15', '2015-08-27 06:39:15', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(144, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 06:45:39', '2015-08-27 06:45:39', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(145, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:09:12', '2015-08-27 07:09:12', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(146, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:09:22', '2015-08-27 07:09:22', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(147, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:09:33', '2015-08-27 07:09:33', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(148, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:09:45', '2015-08-27 07:09:45', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(149, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:09:56', '2015-08-27 07:09:56', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(150, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:11:04', '2015-08-27 07:11:04', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(151, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:33:04', '2015-08-27 07:33:04', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(152, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:33:17', '2015-08-27 07:33:17', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(153, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:33:35', '2015-08-27 07:33:35', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(154, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:33:47', '2015-08-27 07:33:47', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(155, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:34:00', '2015-08-27 07:34:00', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(156, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:34:09', '2015-08-27 07:34:09', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(157, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:34:21', '2015-08-27 07:34:21', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(158, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:34:58', '2015-08-27 07:34:58', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(159, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:37:58', '2015-08-27 07:37:58', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(160, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:38:14', '2015-08-27 07:38:14', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(161, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:47:22', '2015-08-27 07:47:22', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(162, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:47:31', '2015-08-27 07:47:31', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(163, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:47:40', '2015-08-27 07:47:40', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(164, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 07:47:49', '2015-08-27 07:47:49', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(165, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 08:07:20', '2015-08-27 08:07:20', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(166, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 09:14:37', '2015-08-27 09:14:37', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(167, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 09:20:43', '2015-08-27 09:20:43', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(168, NULL, 66, 'ravi vilas', '2', 'dangerous', 'no', '2', '2', '3', '2', '', '', 1, 1, 0, '12000', 'madurai', 0, 0, 12, '', '12.234233', '45.2343434', '250', '200', '', 0, 0, 0, '2015-08-27 09:20:52', '2015-08-27 09:20:52', 'madurai', 'strict', 'Inactive', 0, '1000', '100', '', 0),
(169, NULL, 32, '', '1', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 13, '', '', '', '', '', '', 0, 0, 0, '2015-08-27 10:13:19', '2015-08-27 10:13:19', '', '', 'Active', 0, '', '', '', 0),
(170, 169, 32, '', '1', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '2015-08-27 10:13:20', '2015-08-27 10:13:20', '', '', 'Active', 0, '', '', '', 0),
(171, 169, 32, '', '1', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '2015-08-27 10:13:20', '2015-08-27 10:13:20', '', '', 'Active', 0, '', '', '', 0),
(174, NULL, 31, '', '10+', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 13, '', '', '', '', '', '', 0, 0, 0, '2015-08-31 09:27:43', '2015-08-31 09:27:43', '', '', 'Active', 0, '', '', '', 100),
(175, NULL, 31, '', '3', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 15, '', '', '', '12', '', '', 0, 0, 0, '2015-08-31 12:56:20', '2015-08-31 12:56:20', '', '', 'Active', 0, '', '', '', 0),
(176, NULL, 61, '', '10+', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 15, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(177, NULL, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 15, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(178, 177, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '12', '13', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(179, 177, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(180, 177, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(181, NULL, 31, '', '4', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 13, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', 0, '', '', '', 0),
(182, NULL, 31, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 13, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', 0, '', '', '', 0),
(183, 182, 31, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(184, 182, 31, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(185, 182, 31, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(186, 182, 31, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(187, NULL, 31, '', '4', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 13, '', '', '', '12', '16', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', 0, '', '', '', 0),
(188, NULL, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 15, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', 0, '', '', '', 0),
(189, 188, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(190, 188, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(191, 188, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(192, 188, 31, 'dasdsa', '5', 'sadsa sadsa sadsa sadsa sadsa sadsa sadsa ASasas ssadsad', 'sadasdas', '2', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(193, 188, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(194, NULL, 31, '', '7', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 13, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', 0, '', '', '', 0),
(195, 194, 31, '', '7', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(196, 194, 31, '', '7', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(197, 194, 31, '', '7', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(198, 194, 31, '', '7', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(199, 194, 31, '', '7', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(200, 194, 31, '', '7', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(201, NULL, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 13, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', 0, '', '', '', 0),
(202, 201, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', 0, '', '', '', 0),
(203, 201, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', 0, '', '', '', 0),
(204, 201, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', 0, '', '', '', 0),
(205, 201, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', 0, '', '', '', 0),
(206, 201, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', 0, '', '', '', 0),
(207, NULL, 31, '', '8', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 15, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(208, 207, 31, '', '8', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(209, 207, 31, '', '8', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(210, 207, 31, '', '8', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(211, NULL, 31, '', '6', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 13, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(212, NULL, 31, '', '5', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 15, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(213, NULL, 31, '', '3', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 13, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(214, NULL, 31, '', '2', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 13, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(215, NULL, 31, '', '8', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 13, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(216, 215, 31, '', '8', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(217, 215, 31, '', '8', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(218, 215, 31, '', '8', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(219, 215, 31, '', '8', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(220, NULL, 31, '', '3', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 15, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(221, NULL, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 15, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(222, 221, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(223, 221, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(224, 221, 31, '', '5', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(225, NULL, 31, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 13, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(226, 225, 31, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(227, 225, 31, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(228, 225, 31, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(229, 225, 31, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(230, 225, 31, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(231, 225, 31, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(232, NULL, 31, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 15, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(233, 232, 31, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(234, 232, 31, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(235, 232, 31, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(236, 232, 31, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(237, NULL, 61, '', '7', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 15, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(238, NULL, 61, '', '4', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 15, '', '', '', '1', '2', '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(239, NULL, 61, 'test title for property 239', '5', 'test title for property 239 test title for property 239 test title for property 239 test title for property 239', '', '4', '', '', '', '', '', 3, 3, 0, NULL, '', 0, 0, 13, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(240, NULL, 61, '', '4', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 15, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0);
INSERT INTO `properties` (`property_id`, `parent_id`, `user_id`, `property_title`, `guest_allow`, `description`, `neighbourhood_highlight`, `min_night_stay`, `bedrooms`, `bathrooms`, `bed`, `check_in_time`, `check_out_time`, `room_type_id`, `property_type_id`, `cancellation_policy_id`, `price`, `address_line1`, `country_id`, `state_id`, `city_id`, `zip`, `latitude`, `longitude`, `clean_charge`, `guest_charge`, `security_charge`, `rnr_recommended`, `trending_destination`, `hot_offer`, `created_on`, `modified_on`, `area`, `house_rule`, `status`, `host_language`, `service_fee`, `tax_fee`, `cancellation_detail`, `view_count`) VALUES
(241, NULL, 31, '', '4', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 13, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(242, NULL, 31, '', '2', '', '', '', '', '', '', '', '', 3, 1, 0, NULL, '', 0, 0, 15, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(243, NULL, 31, '', '4', '', '', '', '', '', '', '', '', 3, 1, 0, NULL, '', 0, 0, 13, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(244, NULL, 31, '', '3', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 15, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(245, NULL, 31, '', '10+', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 15, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(246, 245, 31, '', '10+', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '12', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(247, 245, 31, '', '10+', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(248, 245, 31, '', '10+', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(249, 245, 31, '', '10+', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(250, 245, 31, 'Room 5', '4', 'Room 5 Room 5 Room 5 Room 5 Room 5 Room 5 Room 5 Room 5 Room 5 Room 5', '', '4', '3', '2', '2', '6:34 AM', '6:34 AM', 2, 3, 3, NULL, '', 0, 0, 0, '', '', '', '500', '600', '700', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(251, NULL, 31, '', '3', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 15, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(252, NULL, 31, '', '6', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 15, '', '', '', '1', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Active', 0, '', '', '', 0),
(253, NULL, 71, '', '1', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 14, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(254, NULL, 72, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 13, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(255, 254, 72, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(256, 254, 72, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(257, 254, 72, '', '4', '', '', '', '', '', '', '', '', 2, 1, 0, NULL, '', 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0),
(258, NULL, 71, '', '1', '', '', '', '', '', '', '', '', 1, 1, 0, NULL, '', 0, 0, 14, '', '', '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Inactive', 0, '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `properties_amenities`
--

CREATE TABLE IF NOT EXISTS `properties_amenities` (
  `property_amenities_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `amenities_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties_amenities`
--

INSERT INTO `properties_amenities` (`property_amenities_id`, `property_id`, `amenities_id`) VALUES
(1, 2, 1),
(2, 2, 4),
(5, 2, 2),
(7, 6, 1),
(8, 6, 2),
(9, 6, 1),
(10, 6, 4),
(11, 2, 5),
(12, 6, 2),
(14, 6, 1),
(15, 6, 4),
(16, 6, 5),
(17, 6, 2),
(18, 2, 8),
(20, 6, 1),
(21, 6, 4),
(22, 6, 5),
(23, 6, 2),
(24, 6, 6),
(25, 6, 7),
(26, 2, 14),
(27, 6, 1),
(28, 6, 2),
(30, 6, 4),
(31, 6, 5),
(32, 6, 2),
(35, 39, 1),
(36, 39, 4),
(37, 39, 1),
(38, 39, 4),
(48, 82, 1),
(49, 82, 2),
(118, 83, 1),
(119, 83, 5),
(126, 250, 1),
(127, 250, 4),
(130, 241, 2),
(131, 241, 6),
(132, 241, 15);

-- --------------------------------------------------------

--
-- Table structure for table `properties_availability`
--

CREATE TABLE IF NOT EXISTS `properties_availability` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `effective_from` date NOT NULL,
  `effective_to` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0: Unavailable; 1: Available'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties_availability`
--

INSERT INTO `properties_availability` (`id`, `property_id`, `effective_from`, `effective_to`, `status`) VALUES
(1, 174, '2015-09-01', '2015-09-10', 0),
(2, 174, '2015-09-03', '2015-09-05', 1),
(3, 174, '2015-09-04', '2015-09-04', 0),
(4, 175, '2015-09-01', '2015-09-05', 1),
(5, 175, '2015-09-01', '2015-09-03', 1),
(6, 175, '2015-09-01', '2015-09-05', 0),
(7, 175, '2015-09-01', '2015-09-04', 1),
(8, 175, '2015-09-06', '2015-09-06', 0),
(9, 178, '2015-09-02', '2015-09-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `properties_booking`
--

CREATE TABLE IF NOT EXISTS `properties_booking` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `booking_to` datetime NOT NULL,
  `booking_upto` datetime NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `guest_no` int(11) NOT NULL,
  `status` enum('Pending','Booked') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties_booking`
--

INSERT INTO `properties_booking` (`id`, `property_id`, `user_id`, `booking_date`, `booking_to`, `booking_upto`, `user_name`, `guest_no`, `status`) VALUES
(1, 174, 32, '2015-09-08 07:11:09', '2015-09-01 00:00:00', '2015-09-03 00:00:00', '', 0, 'Pending'),
(2, 174, 32, '2015-09-08 07:11:13', '2015-09-10 00:00:00', '2015-09-12 00:00:00', '', 0, 'Pending'),
(3, 174, 32, '2015-09-08 07:11:18', '2015-09-20 00:00:00', '2015-09-22 00:00:00', '', 0, 'Pending'),
(4, 174, 32, '2015-09-08 07:11:23', '2015-09-25 00:00:00', '2015-09-26 00:00:00', '', 0, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `properties_daily_price`
--

CREATE TABLE IF NOT EXISTS `properties_daily_price` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `effective_from` date NOT NULL,
  `effective_to` date NOT NULL,
  `price` float(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties_daily_price`
--

INSERT INTO `properties_daily_price` (`id`, `property_id`, `effective_from`, `effective_to`, `price`) VALUES
(1, 174, '2015-09-01', '2015-09-10', 8000.99),
(2, 174, '2015-09-03', '2015-09-05', 7000.99),
(3, 174, '2015-09-04', '2015-09-04', 7000.99),
(4, 175, '2015-09-01', '2015-09-05', 100.00),
(5, 175, '2015-09-01', '2015-09-03', 500.00),
(6, 175, '2015-09-01', '2015-09-05', 500.00),
(7, 175, '2015-09-01', '2015-09-04', 700.00),
(8, 175, '2015-09-06', '2015-09-06', 600.00),
(9, 178, '2015-09-02', '2015-09-10', 40.00);

-- --------------------------------------------------------

--
-- Table structure for table `properties_images`
--

CREATE TABLE IF NOT EXISTS `properties_images` (
  `property_image_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `images` text,
  `thumbs` varchar(255) NOT NULL,
  `description` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties_images`
--

INSERT INTO `properties_images` (`property_image_id`, `property_id`, `images`, `thumbs`, `description`) VALUES
(1, 1, 'bird.png', '', 'hi'),
(2, 2, 'bird.png', '', 'hello'),
(55, 16, 'delhi.png', '', NULL),
(56, 6, 'login4.png', '', 'asdf'),
(60, 39, 'gendr_dob_-_Copy.png', '', 'sdfgdfg'),
(62, 39, 'signup4.png', '', 'adf'),
(69, 74, '1f2de83937da6c1918e4f005ed7f4de8.jpg', '1f2de83937da6c1918e4f005ed7f4de8_thumb.jpg', ''),
(70, 74, 'a60242f0ebbf271d595f20488366016c.jpg', 'a60242f0ebbf271d595f20488366016c_thumb.jpg', ''),
(71, 74, '6fd5bff6941d65811b6e10f2e8d6e509.JPG', '6fd5bff6941d65811b6e10f2e8d6e509_thumb.JPG', ''),
(72, 74, '833c60848b14bbd4fb845ea3004f32e0.JPG', '833c60848b14bbd4fb845ea3004f32e0_thumb.JPG', ''),
(73, 74, 'b0eb1cde1c3e927ba58c0a6f248dde39.JPG', 'b0eb1cde1c3e927ba58c0a6f248dde39_thumb.JPG', ''),
(74, 78, '454ba1cb86409b18c56078b51ababfcf.JPG', '454ba1cb86409b18c56078b51ababfcf_thumb.JPG', 'fdsfsdf'),
(75, 78, '7054457ce73c8d7be5f931a84ef56c11.JPG', '7054457ce73c8d7be5f931a84ef56c11_thumb.JPG', 'ssdfdsf'),
(76, 78, '1785696ecb402ae7e6f2dd6e602fcf8d.JPG', '1785696ecb402ae7e6f2dd6e602fcf8d_thumb.JPG', 'wsdffwfdf'),
(77, 78, 'f15977d4ab09b0d632f74011dd714a70.JPG', 'f15977d4ab09b0d632f74011dd714a70_thumb.JPG', 'wsfdf'),
(78, 2, 'Winter5.jpg', 'Cover_4.jpg', 'Photo 1'),
(79, 82, 'Cover_5.jpg', 'Cover_5.jpg', 'Photo 2'),
(80, 82, 'Cover_6.jpg', 'Cover_6.jpg', 'Photo 3'),
(81, 83, 'Cover_2.jpg', 'Cover_2.jpg', 'Photo 2'),
(82, 83, 'Cover_1.jpg', 'Cover_1.jpg', 'Photo 1'),
(83, 240, 'Winter (1).jpg', 'Winter (1).jpg', 'Test photo 4'),
(84, 240, 'Winter (2).jpg', 'Winter (2).jpg', 'Test Photo 1'),
(85, 241, 'Winter (3).jpg', 'Winter (3).jpg', '1'),
(86, 242, 'Winter (4).jpg', 'Winter (4).jpg', '1'),
(87, 242, 'Winter (5).jpg', 'Winter (5).jpg', '2'),
(88, 242, 'Winter (6).jpg', 'Winter (6).jpg', '3'),
(89, 242, 'Winter (7).jpg', 'Winter (7).jpg', '4'),
(90, 242, 'roamNrent_Website_AboutUs1.jpg', 'roamNrent_Website_AboutUs1.jpg', ''),
(91, 242, 'roamNrent_ProfileOverview_V4.jpg', 'roamNrent_ProfileOverview_V4.jpg', 'test'),
(92, 242, 'roamNrent_Website_Profile5_V8.jpg', 'roamNrent_Website_Profile5_V8.jpg', 'eqwe'),
(93, 242, 'roamNrent_Website_Profile4_V8.jpg', 'roamNrent_Website_Profile4_V8.jpg', 'qwewqe'),
(94, 242, 'roamNrent_Website_Profile3a_V8.jpg', 'roamNrent_Website_Profile3a_V8.jpg', 'qwewqe'),
(95, 242, 'roamNrent_Website_Profile3_V8.jpg', 'roamNrent_Website_Profile3_V8.jpg', 'qwewqe'),
(96, 242, 'roamNrent_Website_Profile_V8.jpg', 'roamNrent_Website_Profile_V8.jpg', 'wqeqweqwewq'),
(97, 250, 'RNR_CMS_Design_Login_a.jpg', 'RNR_CMS_Design_Login_a.jpg', 'room 5 pic 3'),
(98, 250, 'RNR_CMS_Design_Form_a.jpg', 'RNR_CMS_Design_Form_a.jpg', 'room 5 pic 1'),
(99, 250, 'RNR_CMS_Design_b.jpg', 'RNR_CMS_Design_b.jpg', 'room 5 pic 2'),
(100, 252, 'Winter (8).jpg', 'Winter (8).jpg', '1'),
(101, 246, 'Winter (9).jpg', 'Winter (9).jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `properties_price`
--

CREATE TABLE IF NOT EXISTS `properties_price` (
  `price_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `master_price_period_id` int(11) NOT NULL,
  `master_price_seasontype_id` int(11) NOT NULL,
  `price` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=313 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `properties_price`
--

INSERT INTO `properties_price` (`price_id`, `property_id`, `master_price_period_id`, `master_price_seasontype_id`, `price`) VALUES
(1, 2, 1, 1, '1000'),
(2, 2, 2, 1, '3000'),
(3, 2, 3, 1, '5120'),
(4, 2, 4, 1, '1000'),
(5, 2, 1, 2, '420'),
(6, 2, 2, 2, '420'),
(7, 2, 3, 2, '420'),
(8, 2, 4, 2, '420'),
(9, 2, 1, 3, '124'),
(10, 2, 2, 3, '123'),
(11, 2, 3, 3, '123'),
(12, 2, 4, 3, '124'),
(13, 2, 1, 4, '1313'),
(14, 2, 2, 4, '133241'),
(15, 2, 3, 4, '2312'),
(16, 2, 4, 4, '331'),
(17, 39, 1, 1, '234'),
(18, 39, 2, 1, '32432'),
(19, 39, 3, 1, '4324'),
(20, 39, 4, 1, '23432'),
(21, 39, 1, 1, '234'),
(22, 39, 2, 1, '32432'),
(23, 39, 3, 1, '4324'),
(24, 39, 4, 1, '23432'),
(25, 39, 1, 1, '234'),
(26, 39, 2, 1, '32432'),
(27, 39, 3, 1, '4324'),
(28, 39, 4, 1, '23432'),
(29, 20, 1, 1, '100'),
(30, 20, 2, 1, '500'),
(31, 20, 3, 1, '2000'),
(32, 20, 4, 1, '200'),
(33, 74, 1, 1, '100'),
(34, 74, 2, 1, '200'),
(35, 74, 3, 1, '300'),
(36, 74, 4, 1, '400'),
(37, 78, 1, 1, '100'),
(38, 78, 2, 1, '1001'),
(39, 78, 3, 1, '1001'),
(40, 78, 4, 1, '100'),
(45, 77, 1, 1, '500.99'),
(46, 77, 2, 1, '500.99'),
(47, 77, 3, 1, '1500'),
(48, 77, 4, 1, '1500'),
(49, 82, 1, 1, '1100.99'),
(50, 82, 2, 1, '1800.00'),
(51, 82, 3, 1, '3000.99'),
(52, 82, 4, 1, '5100.00'),
(177, 83, 1, 1, '1100.99'),
(178, 83, 2, 1, '1800.00'),
(179, 83, 3, 1, '3000.99'),
(180, 83, 4, 1, '5100.00'),
(181, 174, 1, 1, '1000.99'),
(182, 174, 2, 1, '7000.99'),
(183, 174, 3, 1, '30000.99'),
(184, 174, 4, 1, '8000.99'),
(233, 175, 1, 2, '1000'),
(234, 175, 1, 4, '200'),
(235, 175, 1, 5, '300'),
(236, 175, 2, 2, '600'),
(237, 175, 2, 4, '500'),
(238, 175, 2, 5, '400'),
(239, 175, 3, 2, '700'),
(240, 175, 3, 4, '800'),
(241, 175, 3, 5, '900'),
(242, 175, 4, 2, '1200'),
(243, 175, 4, 4, '1100'),
(244, 175, 4, 5, '1000'),
(257, 178, 1, 2, '1'),
(258, 178, 2, 2, '4'),
(259, 178, 3, 2, '7'),
(260, 178, 4, 2, '10'),
(273, 187, 1, 2, '12'),
(274, 187, 1, 4, '12'),
(275, 187, 1, 5, '12'),
(276, 187, 2, 2, '12'),
(277, 187, 2, 4, '12'),
(278, 187, 2, 5, '12'),
(279, 187, 3, 2, '12'),
(280, 187, 3, 4, '12'),
(281, 187, 3, 5, '12'),
(282, 187, 4, 2, '12'),
(283, 187, 4, 4, '12'),
(284, 187, 4, 5, '12'),
(289, 238, 1, 2, '1'),
(290, 238, 2, 2, '2'),
(291, 238, 3, 2, '3'),
(292, 238, 4, 2, '4'),
(301, 250, 1, 2, '100'),
(302, 250, 2, 2, '200'),
(303, 250, 3, 2, '300'),
(304, 250, 4, 2, '400'),
(305, 252, 1, 2, '1'),
(306, 252, 2, 2, '2'),
(307, 252, 3, 2, '3'),
(308, 252, 4, 2, '44'),
(309, 246, 1, 2, '10'),
(310, 246, 2, 2, '20'),
(311, 246, 3, 2, '21'),
(312, 246, 4, 2, '22');

-- --------------------------------------------------------

--
-- Table structure for table `properties_rating`
--

CREATE TABLE IF NOT EXISTS `properties_rating` (
  `review_rating_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` text,
  `comment_text` longtext,
  `comment_date` date DEFAULT NULL,
  `smiley_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties_rating`
--

INSERT INTO `properties_rating` (`review_rating_id`, `property_id`, `user_id`, `rating`, `comment_text`, `comment_date`, `smiley_id`) VALUES
(1, 174, 1, '5', 'excellent excellent excellent excellent excellent excellent excellent excellent \r\n\r\nexcellent excellent excellent excellent excellent excellent excellent excellent excellent excellent excellent excellent excellent excellent excellent excellent excellent excellent excellent excellent excellent excellent excellent \r\n\r\nexcellent excellent excellent excellent excellent excellent excellent excellent excellent excellent excellent excellent excellent excellent ', '2015-08-20', 5),
(2, 174, 2, '4', 'good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good \r\n\r\ngood good good good good good good good good good good good good good good good good good good good good good good good good good good good good ', '2015-08-21', 4),
(3, 174, 32, '3', 'good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good \r\n\r\n\r\n\r\ngood good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good ', '2015-09-01', 3),
(4, 174, 42, '3', 'good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good \r\n\r\n\r\n\r\ngood good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good good ', '2015-09-03', 3);

-- --------------------------------------------------------

--
-- Table structure for table `properties_rating_alt`
--

CREATE TABLE IF NOT EXISTS `properties_rating_alt` (
  `review_rating_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` text,
  `comment_text` varchar(45) DEFAULT NULL,
  `comment_date` date DEFAULT NULL,
  `smiley_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties_rating_alt`
--

INSERT INTO `properties_rating_alt` (`review_rating_id`, `property_id`, `user_id`, `rating`, `comment_text`, `comment_date`, `smiley_id`) VALUES
(0, 9, 31, 'Test review Test review Test review Test review Test review Test review Test review Test review Test review Test review Test review Test review \n\nTest review Test review Test review Test review Test review Test review Test review Test review Test review Test review Test review Test review ', NULL, '2015-08-15', 6);

-- --------------------------------------------------------

--
-- Table structure for table `properties_reviews`
--

CREATE TABLE IF NOT EXISTS `properties_reviews` (
  `property_review_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_message` text,
  `images` text NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Inactive',
  `smiley_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties_reviews`
--

INSERT INTO `properties_reviews` (`property_review_id`, `property_id`, `user_id`, `review_message`, `images`, `created_on`, `status`, `smiley_id`) VALUES
(1, 2, 1, 'Sed ut perspiciatis unde omnis iste natus error siteritatis et quasi architecto beatae vitae dicta sunt exipsam. \n						', '', '2015-07-20 03:07:51', 'Inactive', 1),
(2, 2, 1, 'Sed ut perspiciatis unde omnis iste natus error siteritatis et quasi architecto beatae vitae dicta sunt exipsam. \r\n						Sed ut perspiciatis unde omnis iste natus error siteritatis et quasi architecto beatae vitae dicta sunt exipsam. \r\n						', '', '2015-07-20 03:07:51', 'Inactive', 2),
(5, 2, 1, 'Sed ut perspiciatis unde omnis iste natus error siteritatis et quasi architecto beatae vitae dicta sunt exipsam. \r\n						', '', '2015-08-31 07:02:20', 'Inactive', 2),
(6, 2, 5, 'Sed ut perspiciatis unde omnis iste natus error siteritatis et quasi architecto beatae vitae dicta sunt exipsam. \r\n						', '', '2015-08-31 07:02:20', 'Inactive', 3);

-- --------------------------------------------------------

--
-- Table structure for table `properties_rooms`
--

CREATE TABLE IF NOT EXISTS `properties_rooms` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(30) NOT NULL,
  `property_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `guest_no` int(11) NOT NULL,
  `room_details` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `properties_rooms`
--

INSERT INTO `properties_rooms` (`room_id`, `room_name`, `property_id`, `room_type_id`, `guest_no`, `room_details`, `status`) VALUES
(1, 'room 1', 6, 1, 2, 'details test ... update', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `properties_tab_state`
--

CREATE TABLE IF NOT EXISTS `properties_tab_state` (
  `id` int(11) NOT NULL,
  `tab_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `properties_tab_state`
--

INSERT INTO `properties_tab_state` (`id`, `tab_id`, `property_id`) VALUES
(1, 1, 2),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `properties_tag`
--

CREATE TABLE IF NOT EXISTS `properties_tag` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `master_tag_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `properties_tag`
--

INSERT INTO `properties_tag` (`id`, `property_id`, `master_tag_id`) VALUES
(1, 1, 1),
(2, 20, 1),
(3, 20, 2),
(4, 20, 3),
(5, 20, 4),
(6, 20, 1),
(7, 20, 2),
(8, 20, 3),
(9, 20, 4),
(10, 20, 1),
(11, 20, 2),
(12, 2, 3),
(13, 20, 4),
(20, 77, 3),
(21, 77, 4),
(22, 82, 1),
(23, 82, 3),
(92, 83, 1),
(93, 83, 3),
(96, 250, 1),
(97, 250, 2);

-- --------------------------------------------------------

--
-- Table structure for table `properties_video`
--

CREATE TABLE IF NOT EXISTS `properties_video` (
  `property_video_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `youtube_video_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties_video`
--

INSERT INTO `properties_video` (`property_video_id`, `property_id`, `youtube_video_id`) VALUES
(1, 1, ' https://www.youtube.com/embed/IOZqRgOgSu4'),
(2, 6, 'https://www.youtube.com/watch?v=a657676876'),
(3, 6, 'https://www.youtube.com/watch?v=a657676876'),
(4, 6, 'https://www.youtube.com/watch?v='),
(5, 6, 'https://www.youtube.com/watch?v=a657676876'),
(6, 6, 'https://www.youtube.com/watch?v=asdf'),
(7, 39, 'https://www.youtube.com/watch?v=asdf'),
(10, 74, 'http://www.youtube.com/watch?v=EKyirtVHsK0'),
(11, 74, 'http://www.youtube.com/watch?v=EKyirtVHsK0'),
(12, 74, 'http://www.youtube.com/watch?v=ExJShDhLzQU'),
(13, 78, 'http://www.youtube.com/watch?v=jvSJaU8y1AM'),
(15, 82, '67215zbSNQ4'),
(16, 83, '67215zbSNQ4'),
(17, 240, 'p31_e1rqxYQ'),
(18, 241, 'p31_e1rqxYQ'),
(19, 242, 'p31_e1rqxYQ'),
(20, 250, 'p31_e1rqxYQ'),
(21, 252, 'p31_e1rqxYQ'),
(22, 246, 'p31_e1rqxYQ');

-- --------------------------------------------------------

--
-- Table structure for table `trending_destination`
--

CREATE TABLE IF NOT EXISTS `trending_destination` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `overlay_image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trending_destination`
--

INSERT INTO `trending_destination` (`id`, `image`, `overlay_image`, `title`) VALUES
(1, 'hyderabad.png', 'hyderabad-overlay.png', 'Hyderabad'),
(2, 'goa.png', 'goa-overlay.png', 'Goa'),
(3, 'jaipur.png', 'jaipur-overlay.png', 'Jaipur'),
(4, 'kashmir.png', 'kashmir-overlay.png', 'Kashmir'),
(5, 'madhya-pradesh.png', 'madhya-pradesh-overlay.png', 'Madhya Pradesh'),
(6, 'mumbai.png', 'mumbai-overlay.png', 'Mumbai'),
(7, 'sikkim.png', 'sikkim-overlay.png', 'Sikkim'),
(8, 'trivenipuram.png', 'trivenipuram-overlay.png', 'Trivenipuram');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` text,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `user_emergency_contact_no` varchar(45) DEFAULT NULL,
  `profile_pic` varchar(150) NOT NULL,
  `captcha` int(5) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `fb_id` varchar(255) NOT NULL,
  `device_token` varchar(255) NOT NULL,
  `is_email_verified` tinyint(4) NOT NULL DEFAULT '0',
  `verification_code` varchar(255) NOT NULL,
  `user_emergency_contact_prefix` varchar(255) NOT NULL,
  `is_emergency_contact_verified` tinyint(4) NOT NULL DEFAULT '0',
  `contact_verification_code` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `school` varchar(255) NOT NULL,
  `college` varchar(255) NOT NULL,
  `work` varchar(255) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `about` longtext NOT NULL,
  `languages` varchar(255) NOT NULL,
  `address_line_1` varchar(255) NOT NULL,
  `address_line_2` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `user_details` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `created_on`, `updated_on`, `gender`, `user_emergency_contact_no`, `profile_pic`, `captcha`, `status`, `fb_id`, `device_token`, `is_email_verified`, `verification_code`, `user_emergency_contact_prefix`, `is_emergency_contact_verified`, `contact_verification_code`, `birth_date`, `school`, `college`, `work`, `hobbies`, `about`, `languages`, `address_line_1`, `address_line_2`, `country_id`, `state_id`, `city_id`, `zip`, `user_details`) VALUES
(1, 'Sonam', 'Mahto', 'sonam@appsembly.com', '19dc046a00bda2a8ed9c4faebf5fd790', '2015-07-01 11:21:37', '2015-07-01 11:21:37', 'Female', '987456123', 'namita.png', 0, 'Active', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(2, 'Ravi ', 'Kumar', 'rai@appsembly.com', '123456', '2015-07-01 02:07:12', '2015-07-01 10:05:47', 'Male', '9999999999', 'geeta.png', 1234, 'Active', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', 'Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.'),
(3, 'Test', 'Tester', 'Test@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-07-28 20:26:32', '2015-07-28 20:26:32', 'Male', '54355', '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(4, 'Test', 'Tester', 'Test1@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-07-29 16:16:42', '2015-07-29 16:16:42', NULL, NULL, '', 0, 'Active', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(5, 'Test', 'Tester', 'Jul29215646@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-07-29 16:26:16', '2015-07-29 16:26:16', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(6, 'Test', 'Tester', 'Jul29221312@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-07-29 16:42:41', '2015-07-29 16:42:41', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(7, 'Test', 'Tester', 'Jul29221552@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-07-29 16:45:22', '2015-07-29 16:45:22', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(8, 'Test', 'Tester', 'Jul29233110@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-07-29 18:00:41', '2015-07-29 18:00:41', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(9, 'Test', 'Tester', 'Jul29233457@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-07-29 18:04:26', '2015-07-29 18:04:26', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(10, 'Test', 'Tester', 'Jul29233809@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-07-29 18:07:38', '2015-07-29 18:07:38', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(11, 'test', 'Tester', 'Jul29234629@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-07-29 18:16:02', '2015-07-29 18:16:02', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(12, 'Test', 'Tester', 'Jul29235025@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-07-29 18:19:54', '2015-07-29 18:19:54', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(13, 'Test', 'Tester', 'Jul29235251@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-07-29 18:22:20', '2015-07-29 18:22:20', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(14, 'Test', 'Tester', 'Jul29235457@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-07-29 18:24:25', '2015-07-29 18:24:25', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(15, 'Test', 'Tester', 'Jul30001435@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-07-29 18:44:06', '2015-07-29 18:44:06', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(16, 'Test', 'Tester', 'Jul30002717@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-07-29 18:56:46', '2015-07-29 18:56:46', 'Male', '4321', '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(17, 'Test', 'Tester', 'Jul30002922@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-07-29 18:58:51', '2015-07-29 18:58:51', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(18, 'Test', 'Tester', 'Jul30003405@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-07-29 19:03:34', '2015-07-29 19:03:34', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(19, 'Test', 'Tester', 'Jul30003649@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-07-29 19:06:18', '2015-07-29 19:06:18', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(22, 'Test', 'Tester', 'Aug04122038@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-08-04 06:52:36', '2015-08-04 06:52:36', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(23, 'test', 'etst', 'test45@test.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-08-04 06:55:22', '2015-08-04 06:55:22', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(31, 'Saptarshi', 'Mandal', 'saptarshiofficial2012@gmail.com', NULL, '2015-08-05 08:20:16', '2015-09-02 14:50:12', 'male', '8017238480', 'profile_pic_31_1439620930.png', 0, 'Active', '', '', 0, 'MUaUkEjKXkTJ5XzNg9REXPdptRF0ZFM5m/fk/AKk8XD2GYEizriNYdKJGJtb8J/G', '91', 0, '', '0000-00-00', '', '', 'Test Work 1', '', 'Test about Test about Test about Test about Test about Test about Test about Test about', '4,6,7', 'Test address line 111', '', 8, 21, 13, '736121', ''),
(32, 'Tass', 'Kumar', 'tnav077346@gmail.com', NULL, '2015-08-05 10:44:42', '2015-08-05 10:44:42', NULL, NULL, 'profile_pic_32_1440620651.png', 0, 'Active', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(33, 'kumar', 'mini', 'ravi', '81dc9bdb52d04dc20036dbd8313ed055', '2015-08-05 12:33:19', '2015-08-05 12:33:19', NULL, NULL, '', 0, 'Active', '', 'dfgret3423', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(34, 'mini', 'raji', 'ravikumar', '01fc4aa12a6426c2385d1ec995758c21', '2015-08-05 18:18:55', '2015-08-05 18:18:55', NULL, NULL, '', 0, 'Active', '', 'sdf23', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(35, 'sdf', 'sf', 'ravi@gmail.com', 'dc8c30e328e1cef5f78f6d42cc9b4f61', '2015-08-06 05:28:35', '2015-08-06 05:28:35', NULL, NULL, '', 0, 'Active', '', 'dfgret3423', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(36, 'sfff', 'srfr', 'mini@gmail.com', '1eb2f86dfdc20031f82f75805152faba', '2015-08-06 05:31:59', '2015-08-06 05:31:59', NULL, NULL, '', 0, 'Active', '', '0', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(37, 'sfffdf', 'srfr', 'dfr@gm.com', '1eb2f86dfdc20031f82f75805152faba', '2015-08-06 05:35:31', '2015-08-06 05:35:31', NULL, NULL, '', 0, 'Active', '', '0', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(38, 'sfffdf', 'srfr', 'dfr@gm.co', '1eb2f86dfdc20031f82f75805152faba', '2015-08-06 05:35:38', '2015-08-06 05:35:38', NULL, NULL, '', 0, 'Active', '', '0', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(39, 'sfffdf', 'srfr', 'ravimini@gmail.com', '44c6c370fd1859325f7119e96a81584e', '2015-08-06 05:48:24', '2015-08-06 05:48:24', NULL, NULL, '', 0, 'Active', '', '0', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(40, 'mini', 'mini', 'google@gmail.com', '8b9035807842a4e4dbe009f3f1478127', '2015-08-06 10:05:06', '2015-08-06 10:05:06', NULL, NULL, '', 0, 'Active', '', '0', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(41, 'mini', 'sff', 'raji@gmail.com', 'f1faddd3b5d4c7d8def634296586236a', '2015-08-06 10:11:24', '2015-08-06 10:11:24', NULL, NULL, '', 0, 'Active', '', '0', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(42, 'ravi', 'kumar', 'raviminiraji@gmail.com', '44c6c370fd1859325f7119e96a81584e', '2015-08-06 10:19:39', '2015-08-06 10:19:39', NULL, NULL, '', 0, 'Active', '', '0', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(43, 'kumar', 'rani', 'kumar@gmail.com', 'b9f81618db3b0d7a8be8fd904cca8b6a', '2015-08-06 10:24:40', '2015-08-06 10:24:40', NULL, NULL, '', 0, 'Active', '', '0', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(44, 'ravi', 'kumar', 'ravikumar.pvm@gmail.com', '2fdafc70dc37d33d567fb2c3de75aaa7', '2015-08-06 11:36:11', '2015-08-06 11:36:11', NULL, NULL, '', 0, 'Active', '', '0', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(45, 'Test', 'Tester', 'Aug06131042@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-08-06 18:10:05', '2015-08-06 18:10:05', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(46, 'Test', 'Tester', 'Aug06135918@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-08-06 18:58:39', '2015-08-06 18:58:39', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(47, 'mini', 'mini', 'ravi123@gmail.com', '44c6c370fd1859325f7119e96a81584e', '2015-08-08 06:29:48', '2015-08-08 06:29:48', NULL, NULL, '', 0, 'Active', '', '0', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(48, 'Test', 'Tester', 'Aug08045636@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-08-08 09:55:54', '2015-08-08 09:55:54', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(49, 'Test', 'Tester', 'Aug09130040@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-08-09 17:59:54', '2015-08-09 17:59:54', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(50, 'ravikumar', 'mini', 'miniravi123@gmail.com', '44c6c370fd1859325f7119e96a81584e', '2015-08-10 07:29:30', '2015-08-10 07:29:30', NULL, NULL, '', 0, 'Active', '', '0', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(51, 'Test', 'Tester', 'Aug10130045@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-08-10 17:59:57', '2015-08-10 17:59:57', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(52, 'Test', 'Tester', 'Aug11130049@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-08-11 17:59:59', '2015-08-11 17:59:59', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(53, 'raik', 'kk', 'raikk@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2015-08-14 07:59:34', '2015-08-14 07:59:34', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(54, 'Test', 'Tester', 'Aug14130139@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-08-14 18:01:38', '2015-08-14 18:01:38', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(55, 'Raikk', 'kumar', 'raik@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-08-15 05:58:00', '2015-08-15 05:58:00', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(56, 'Test', 'Tester', 'Aug16130142@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-08-16 18:01:36', '2015-08-16 18:01:36', NULL, NULL, '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(57, 'Raikumar', 'Khangembam', 'raik.kh@gmail.com', NULL, '2015-08-18 05:50:36', '2015-08-18 05:50:36', NULL, NULL, 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/c15.0.50.50/p50x50/10354686_10150004552801856_220367501106153455_n.jpg?oh=82c2ce067f9c7', 0, 'Active', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(58, 'test5', 'test', 'test5@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-08-18 06:03:58', '2015-08-18 06:03:58', NULL, '', '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(59, 'Test', 'Tester', 'Aug18130138@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-08-18 18:01:33', '2015-08-18 18:01:33', NULL, '', '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(60, 'Test', 'Tester', 'Aug19130142@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-08-19 18:01:34', '2015-08-19 18:01:34', NULL, '', '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(61, 'saptarshi', 'mandal', 'saptarshi@matrixnmedia.com', '202cb962ac59075b964b07152d234b70', '2015-08-20 06:27:10', '2015-08-20 06:27:10', NULL, '', '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(62, 'rai', 'kumar', 'ravi1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-08-20 07:13:22', '2015-08-20 07:13:22', NULL, '', '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(63, 'Test', 'Tester', 'Aug20130139@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-08-20 18:01:37', '2015-08-20 18:01:37', NULL, '', '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(64, 'Dimitri', 'White', 'dimitriwhite14@gmail.com', NULL, '2015-08-21 19:53:55', '2015-08-21 19:53:55', NULL, NULL, 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/p50x50/1507864_1446285135621035_1626796138767190718_n.jpg?oh=86790ebc4c6fe307ee4f20b2e5', 0, 'Active', '', '', 1, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(65, 'Test', 'Tester', 'Aug23130129@Tester.com', '3fc0a7acf087f549ac2b266baf94b8b1', '2015-08-23 18:01:18', '2015-08-23 18:01:18', NULL, '', '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(66, 'raj', 'raji', 'raviraji@gmail.com', '44c6c370fd1859325f7119e96a81584e', '2015-08-24 05:52:55', '2015-08-24 05:52:55', NULL, NULL, '', 0, 'Active', '', '0', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(67, 'mini', 'ravi', 'rajimca@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2015-08-25 06:18:48', '2015-08-25 06:18:48', NULL, NULL, '', 0, 'Active', '', '0', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(68, 'kgumaom', 'kumar', 'rai@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-08-25 07:56:27', '2015-08-25 07:56:27', NULL, NULL, '', 0, 'Active', '', '0', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(69, 'senthil', 'kumar', 'senthil@gmail.com', '4c64ac4638b88ebca6e29ac0a8113691', '2015-08-26 07:12:07', '2015-08-26 07:12:07', NULL, '', '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(70, 'ravi', 'kumar', 'ravi12345@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2015-08-27 05:59:49', '2015-08-27 05:59:49', NULL, NULL, '', 0, 'Active', '', '0', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(71, 'test', 'test', 'test@test.com', '098f6bcd4621d373cade4e832627b4f6', NULL, NULL, NULL, '', '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
(72, 'siddharth', 'shah', 'siddharth@appsembly.com', '88dea44a25d69167b424a41812e96e25', NULL, NULL, NULL, '', '', 0, 'Inactive', '', '', 0, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_contact`
--

CREATE TABLE IF NOT EXISTS `users_contact` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prefix` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `contact_verification_code` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_contact`
--

INSERT INTO `users_contact` (`id`, `user_id`, `prefix`, `number`, `is_verified`, `contact_verification_code`) VALUES
(102, 31, '91', '8017238480', 0, ''),
(103, 31, '', '9051078942', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users_document`
--

CREATE TABLE IF NOT EXISTS `users_document` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `document_image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: Not Verified; 1: Verified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_email`
--

CREATE TABLE IF NOT EXISTS `users_email` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: NO; 1: YES',
  `verification_code` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_email`
--

INSERT INTO `users_email` (`id`, `user_id`, `email`, `is_verified`, `verification_code`) VALUES
(94, 31, 'saptarshimandal2012@rediffmail.com', 0, 'LKj4Bard1UGyQxp3nWVzi0LosA3aDjZhy//tO3q+anN4//3B3XuKhZCD9Iq+fVcI'),
(95, 31, 'saptarshi@matrixnmedia.com', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users_message`
--

CREATE TABLE IF NOT EXISTS `users_message` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `sent_on` datetime NOT NULL,
  `status` enum('pending','inquiry','declined','accepted') NOT NULL DEFAULT 'pending',
  `response_time` datetime NOT NULL,
  `response_flags` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_message`
--

INSERT INTO `users_message` (`id`, `sender_id`, `receiver_id`, `property_id`, `message`, `sent_on`, `status`, `response_time`, `response_flag`) VALUES
(1, 1, 2, 2, 'Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.', '2015-08-10 05:00:00', 'inquiry', '2015-08-10 05:30:00', 0),
(2, 6, 2, 2, 'Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.', '2015-08-25 11:00:00', 'inquiry', '2015-08-25 11:10:00', 1),
(3, 1, 31, 174, 'Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1,\r\n\r\nTest message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, \r\n\r\nTest message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, Test message 1, ', '2015-08-26 11:00:00', 'inquiry', '0000-00-00 00:00:00', 1),
(4, 2, 31, 174, 'Test message 2 Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2\r\n\r\nTest message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2\r\n\r\nTest message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2Test message 2', '2015-08-27 11:00:00', 'declined', '0000-00-00 00:00:00', 0),
(5, 1, 31, 174, 'Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 Test message 3 ', '2015-08-28 11:00:00', 'accepted', '0000-00-00 00:00:00', 0),
(6, 2, 31, 174, 'Test message 4 Test message 4 Test message 4 Test message 4', '2015-09-01 11:42:00', 'inquiry', '0000-00-00 00:00:00', 1),
(7, 1, 31, 174, 'Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 \r\n\r\nTest message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 Test message 5 ', '2015-09-01 10:42:00', 'pending', '0000-00-00 00:00:00', 1),
(8, 2, 31, 174, 'Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 \r\n\r\nTest message 6 Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 \r\n\r\nTest message 6 Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 Test message 6 ', '2015-09-01 09:42:00', 'pending', '0000-00-00 00:00:00', 0),
(9, 1, 31, 174, 'Test message 7 Test message 7 Test message 7 Test message 7 Test message 7', '2015-08-31 13:22:00', 'pending', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_number`
--

CREATE TABLE IF NOT EXISTS `users_number` (
  `id` int(11) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `send_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_number`
--

INSERT INTO `users_number` (`id`, `mobile_number`, `send_status`) VALUES
(1, '2147483647', 0),
(2, '2147483647', 0),
(3, '7299299082', 0),
(4, '7070707070', 0),
(5, '1234567890', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_social_media`
--

CREATE TABLE IF NOT EXISTS `users_social_media` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `social_media` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_social_media`
--

INSERT INTO `users_social_media` (`id`, `user_id`, `social_media`) VALUES
(1, 31, 'facebook'),
(2, 64, 'facebook');

-- --------------------------------------------------------

--
-- Table structure for table `user_documents`
--

CREATE TABLE IF NOT EXISTS `user_documents` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_proof` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_documents`
--

INSERT INTO `user_documents` (`id`, `user_id`, `id_proof`) VALUES
(1, 1, 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_wishlist`
--

CREATE TABLE IF NOT EXISTS `user_wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_wishlist`
--

INSERT INTO `user_wishlist` (`id`, `user_id`, `property_id`, `date`) VALUES
(50, 7, 6, '2015-09-07 09:10:07'),
(51, 7, 2, '2015-09-07 09:18:03'),
(52, 7, 1, '2015-09-07 09:18:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cms_homepage_people_stories`
--
ALTER TABLE `cms_homepage_people_stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_homepage_slides`
--
ALTER TABLE `cms_homepage_slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_homepage_whats_happening`
--
ALTER TABLE `cms_homepage_whats_happening`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `host_language`
--
ALTER TABLE `host_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_amenities`
--
ALTER TABLE `master_amenities`
  ADD PRIMARY KEY (`amenities_id`),
  ADD KEY `rnr_amenities_type` (`amenities_type`);

--
-- Indexes for table `master_amenities_type`
--
ALTER TABLE `master_amenities_type`
  ADD PRIMARY KEY (`amenities_type_id`);

--
-- Indexes for table `master_cancellation_policy`
--
ALTER TABLE `master_cancellation_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_city`
--
ALTER TABLE `master_city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `master_country`
--
ALTER TABLE `master_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `master_document`
--
ALTER TABLE `master_document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_host_tabstatus`
--
ALTER TABLE `master_host_tabstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_language`
--
ALTER TABLE `master_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_price_period`
--
ALTER TABLE `master_price_period`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_price_seasontype`
--
ALTER TABLE `master_price_seasontype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_property_type`
--
ALTER TABLE `master_property_type`
  ADD PRIMARY KEY (`property_type_id`);

--
-- Indexes for table `master_room_type`
--
ALTER TABLE `master_room_type`
  ADD PRIMARY KEY (`room_type_id`);

--
-- Indexes for table `master_smiley`
--
ALTER TABLE `master_smiley`
  ADD PRIMARY KEY (`smiley_id`);

--
-- Indexes for table `master_smiley_alt`
--
ALTER TABLE `master_smiley_alt`
  ADD PRIMARY KEY (`smiley_id`);

--
-- Indexes for table `master_state`
--
ALTER TABLE `master_state`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `master_tag`
--
ALTER TABLE `master_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_type_id` (`room_type_id`),
  ADD KEY `property_type_id` (`property_type_id`),
  ADD KEY `host_language` (`host_language`);

--
-- Indexes for table `properties_amenities`
--
ALTER TABLE `properties_amenities`
  ADD PRIMARY KEY (`property_amenities_id`),
  ADD KEY `fk_property_amenities_user_property1_idx` (`property_id`),
  ADD KEY `fk_property_amenities_amenities1_idx` (`amenities_id`);

--
-- Indexes for table `properties_availability`
--
ALTER TABLE `properties_availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `properties_booking`
--
ALTER TABLE `properties_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties_daily_price`
--
ALTER TABLE `properties_daily_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `properties_images`
--
ALTER TABLE `properties_images`
  ADD PRIMARY KEY (`property_image_id`),
  ADD KEY `fk_property_image_user_property1_idx` (`property_id`);

--
-- Indexes for table `properties_price`
--
ALTER TABLE `properties_price`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `properties_rating`
--
ALTER TABLE `properties_rating`
  ADD PRIMARY KEY (`review_rating_id`),
  ADD KEY `fk_review_rating_user1_idx` (`user_id`),
  ADD KEY `fk_review_rating_user_property1_idx` (`property_id`),
  ADD KEY `fk_review_rating_smiley1_idx` (`smiley_id`);

--
-- Indexes for table `properties_reviews`
--
ALTER TABLE `properties_reviews`
  ADD PRIMARY KEY (`property_review_id`),
  ADD KEY `fk_people_stories_user1_idx` (`user_id`),
  ADD KEY `fk_people_stories_user_property1_idx` (`property_id`);

--
-- Indexes for table `properties_rooms`
--
ALTER TABLE `properties_rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `properties_tab_state`
--
ALTER TABLE `properties_tab_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties_tag`
--
ALTER TABLE `properties_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties_video`
--
ALTER TABLE `properties_video`
  ADD PRIMARY KEY (`property_video_id`),
  ADD KEY `fk_property_video_user_property1_idx` (`property_id`);

--
-- Indexes for table `trending_destination`
--
ALTER TABLE `trending_destination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_contact`
--
ALTER TABLE `users_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_document`
--
ALTER TABLE `users_document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `document_id` (`document_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indexes for table `users_email`
--
ALTER TABLE `users_email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_message`
--
ALTER TABLE `users_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `users_number`
--
ALTER TABLE `users_number`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_social_media`
--
ALTER TABLE `users_social_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_wishlist`
--
ALTER TABLE `user_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cms_homepage_people_stories`
--
ALTER TABLE `cms_homepage_people_stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cms_homepage_slides`
--
ALTER TABLE `cms_homepage_slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `cms_homepage_whats_happening`
--
ALTER TABLE `cms_homepage_whats_happening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `host_language`
--
ALTER TABLE `host_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `master_amenities`
--
ALTER TABLE `master_amenities`
  MODIFY `amenities_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `master_amenities_type`
--
ALTER TABLE `master_amenities_type`
  MODIFY `amenities_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `master_cancellation_policy`
--
ALTER TABLE `master_cancellation_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `master_city`
--
ALTER TABLE `master_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `master_country`
--
ALTER TABLE `master_country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `master_document`
--
ALTER TABLE `master_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `master_host_tabstatus`
--
ALTER TABLE `master_host_tabstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `master_language`
--
ALTER TABLE `master_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `master_price_period`
--
ALTER TABLE `master_price_period`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `master_price_seasontype`
--
ALTER TABLE `master_price_seasontype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `master_property_type`
--
ALTER TABLE `master_property_type`
  MODIFY `property_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `master_room_type`
--
ALTER TABLE `master_room_type`
  MODIFY `room_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `master_smiley`
--
ALTER TABLE `master_smiley`
  MODIFY `smiley_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `master_smiley_alt`
--
ALTER TABLE `master_smiley_alt`
  MODIFY `smiley_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `master_state`
--
ALTER TABLE `master_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `master_tag`
--
ALTER TABLE `master_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=259;
--
-- AUTO_INCREMENT for table `properties_amenities`
--
ALTER TABLE `properties_amenities`
  MODIFY `property_amenities_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=133;
--
-- AUTO_INCREMENT for table `properties_availability`
--
ALTER TABLE `properties_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `properties_booking`
--
ALTER TABLE `properties_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `properties_daily_price`
--
ALTER TABLE `properties_daily_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `properties_images`
--
ALTER TABLE `properties_images`
  MODIFY `property_image_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `properties_price`
--
ALTER TABLE `properties_price`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=313;
--
-- AUTO_INCREMENT for table `properties_rating`
--
ALTER TABLE `properties_rating`
  MODIFY `review_rating_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `properties_reviews`
--
ALTER TABLE `properties_reviews`
  MODIFY `property_review_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `properties_rooms`
--
ALTER TABLE `properties_rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `properties_tab_state`
--
ALTER TABLE `properties_tab_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `properties_tag`
--
ALTER TABLE `properties_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `properties_video`
--
ALTER TABLE `properties_video`
  MODIFY `property_video_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `trending_destination`
--
ALTER TABLE `trending_destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `users_contact`
--
ALTER TABLE `users_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `users_document`
--
ALTER TABLE `users_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_email`
--
ALTER TABLE `users_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `users_message`
--
ALTER TABLE `users_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users_number`
--
ALTER TABLE `users_number`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users_social_media`
--
ALTER TABLE `users_social_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_documents`
--
ALTER TABLE `user_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_wishlist`
--
ALTER TABLE `user_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `master_amenities`
--
ALTER TABLE `master_amenities`
  ADD CONSTRAINT `master_amenities_ibfk_1` FOREIGN KEY (`amenities_type`) REFERENCES `master_amenities_type` (`amenities_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `master_city`
--
ALTER TABLE `master_city`
  ADD CONSTRAINT `master_country_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `master_country` (`country_id`);

--
-- Constraints for table `master_state`
--
ALTER TABLE `master_state`
  ADD CONSTRAINT `master_state_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `master_country` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_ibfk_2` FOREIGN KEY (`room_type_id`) REFERENCES `master_room_type` (`room_type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_ibfk_3` FOREIGN KEY (`property_type_id`) REFERENCES `master_property_type` (`property_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `properties_amenities`
--
ALTER TABLE `properties_amenities`
  ADD CONSTRAINT `properties_amenities_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_amenities_ibfk_2` FOREIGN KEY (`amenities_id`) REFERENCES `master_amenities` (`amenities_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `properties_availability`
--
ALTER TABLE `properties_availability`
  ADD CONSTRAINT `properties_availability_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `properties_daily_price`
--
ALTER TABLE `properties_daily_price`
  ADD CONSTRAINT `properties_daily_price_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `properties_images`
--
ALTER TABLE `properties_images`
  ADD CONSTRAINT `properties_images_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `properties_rating`
--
ALTER TABLE `properties_rating`
  ADD CONSTRAINT `properties_rating_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_rating_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_rating_ibfk_3` FOREIGN KEY (`smiley_id`) REFERENCES `master_smiley` (`smiley_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `properties_reviews`
--
ALTER TABLE `properties_reviews`
  ADD CONSTRAINT `properties_reviews_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `properties_video`
--
ALTER TABLE `properties_video`
  ADD CONSTRAINT `properties_video_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_document`
--
ALTER TABLE `users_document`
  ADD CONSTRAINT `users_document_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_document_ibfk_2` FOREIGN KEY (`document_id`) REFERENCES `master_document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_message`
--
ALTER TABLE `users_message`
  ADD CONSTRAINT `users_message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_message_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_message_ibfk_3` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_social_media`
--
ALTER TABLE `users_social_media`
  ADD CONSTRAINT `users_social_media_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
