-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2024 at 12:10 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_details`
--

CREATE TABLE `address_details` (
  `address_id` int(11) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `Landmark` varchar(400) NOT NULL,
  `address` varchar(400) NOT NULL,
  `user_id` varchar(25) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `address_delivery_charges` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address_details`
--

INSERT INTO `address_details` (`address_id`, `phone`, `Landmark`, `address`, `user_id`, `user_name`, `address_delivery_charges`) VALUES
(24, '09035376766', 'near konnapna agrahara bus stop', 'shanker narayana pg', '131', 'balaji g12241', 0),
(25, '09035376766', 'near konnapna agrahara bus stop', 'shanker narayana pg', '131', 'balaji g', 0),
(26, '09035376766', 'near konnapna agrahara bus stop', 'shanker narayana pg', '131', 'balaji g', 0),
(27, '7868458658', 'ghhg', '765iytg67tiyukgh', '131', '', 0),
(28, '09035376766', 'near konnapna agrahara bus stop', 'rferfdb', '131', '', 0),
(29, '09035376766', 'near konnapna agrahara bus stop', 'ewrty', '131', '', 0),
(30, '09035376766', 'near konnapna agrahara bus stop', '2324424', '131', 'pes2ug20cs805', 10),
(31, '09035376766', 'near konnapna agrahara bus stop', '', '131', 'pes2ug20cs805', 10),
(32, '235235', 'near konnapna agrahara bus stop', '46tewgdsv', '131', 'admin@admin.com', 10);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint(20) NOT NULL,
  `admin_password` varchar(300) NOT NULL,
  `admin_name` varchar(20) NOT NULL,
  `admin_phone` bigint(50) NOT NULL,
  `admin_status` tinyint(1) NOT NULL,
  `admin_delete` tinyint(1) NOT NULL,
  `admin_added_date` varchar(20) NOT NULL,
  `admin_updated_date` varchar(20) NOT NULL,
  `admin_address` varchar(100) NOT NULL,
  `admin_type` int(11) NOT NULL,
  `admin_rateing` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_password`, `admin_name`, `admin_phone`, `admin_status`, `admin_delete`, `admin_added_date`, `admin_updated_date`, `admin_address`, `admin_type`, `admin_rateing`) VALUES
(1, '$2y$10$7YkAFIRC.TIzrEoB6M3gM.Gly95mF4xcUSis8RtL5b9Mep84WsCYq', 'Balaji', 9696969696, 1, 0, '2021-01-04', '2024-01-22 04:55:51 ', 'Ballari', 1, 0),
(100000, '$2y$10$uCHfmFGE1ruXqVnzhiI9XuPeqwGjjFCYpb8Ofxlv5fo7A0c2972Ba', 'Pradeep', 7619321936, 1, 1, '2023-10-05 05:27:01 ', '2024-01-22 02:56:53 ', 'qqqqqqqqqqqqqqqqqqqqqqqqde sd', 2, 0),
(100001, '$2y$10$48QsuwQc6A0BstwktVSdFu9gddp7LlWlL5aseBdliJwnDENi.GLWq', 'sandhya', 9876543210, 1, 1, '2023-10-05 05:28:30 ', '2024-01-22 02:56:51 ', 'vdxfbcngvhg esde sd', 2, 0),
(100002, '$2y$10$7YkAFIRC.TIzrEoB6M3gM.Gly95mF4xcUSis8RtL5b9Mep84WsCYq', 'BALAJI', 8123112359, 1, 0, '2024-01-22 02:42:57 ', '2024-01-24 06:03:08 ', 'qqqqqqqqqqqqqqqqqqqqqqqqde sd', 3, 0),
(100003, '$2y$10$7YkAFIRC.TIzrEoB6M3gM.Gly95mF4xcUSis8RtL5b9Mep84WsCYq', 'Roopashree', 8792041412, 1, 0, '2024-01-22 05:44:29 ', '2024-01-22 05:44:29 ', 'qqqqqqqqqqqqqqqqqqqqqqqqde sd', 2, 0);

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `active_admin` BEFORE UPDATE ON `admin` FOR EACH ROW UPDATE logs SET logs.logs_inactive_admin=logs.logs_inactive_admin+1 WHERE OLD.admin_status=1 AND NEW.admin_status=0
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `deleted_admin` AFTER UPDATE ON `admin` FOR EACH ROW UPDATE logs SET logs_active_admin=logs.logs_active_admin-1 WHERE NEW.admin_delete = 1
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inactive_admin` BEFORE UPDATE ON `admin` FOR EACH ROW UPDATE logs SET logs.logs_inactive_admin=logs.logs_inactive_admin-1 WHERE OLD.admin_status=0 AND NEW.admin_status=1
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inactive_admin_on_delete` BEFORE UPDATE ON `admin` FOR EACH ROW UPDATE logs SET logs_inactive_admin=logs.logs_inactive_admin-1 WHERE NEW.admin_status = 0 AND NEW.admin_delete = 1
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_admin` AFTER INSERT ON `admin` FOR EACH ROW UPDATE logs SET logs_active_admin=logs.logs_active_admin+1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` bigint(20) NOT NULL,
  `cart_items_id` bigint(20) NOT NULL,
  `cart_qty` int(11) NOT NULL,
  `cart_user_id` varchar(25) NOT NULL,
  `cart_added_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_items_id`, `cart_qty`, `cart_user_id`, `cart_added_date`) VALUES
(100290, 2, 1, '38e102a7c60e82e10e92', '2024-01-31 04:19:58 '),
(100292, 100007, 2, '38e102a7c60e82e10e92', '2024-01-31 04:23:43 ');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `category_commission` float NOT NULL,
  `category_delete` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_image`, `category_commission`, `category_delete`) VALUES
(3, 'Breakfast', '2024-01-25_1706182856.jpg', 50, 0),
(4, 'Dinner', '2024-01-25_1706182866.jpeg', 5, 0),
(5, 'Lunch', '2024-01-25_1706182884.jpeg', 10, 0),
(6, 'Snacks', '2024-01-25_1706182915.jpg', 5, 0),
(7, 'Singles', '2024-01-25_1706182951.jpg', 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` bigint(20) NOT NULL,
  `contact_name` varchar(20) NOT NULL,
  `contact_email` varchar(35) NOT NULL,
  `contact_phone` varchar(30) NOT NULL,
  `contact_subject` varchar(2000) NOT NULL,
  `contact_view` tinyint(1) NOT NULL,
  `contact_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_name`, `contact_email`, `contact_phone`, `contact_subject`, `contact_view`, `contact_date`) VALUES
(32, 'Pradeep RS', 'pradeeprs176@gmail.com', '07619321936', 'dffgxcz', 1, '2022-07-27 00:00:00'),
(33, 'Pradeep RS', 'pradeeprs176@gmail.com', '07619321936', 'sadds', 1, '2022-07-26 00:00:00'),
(34, 'Wedding Photography', 'admin@admin.com', '23424242424', 'gedsfdsg', 1, '2022-07-27 11:24:53'),
(100000, 'roopashree', 'sroopashree28@gmail.com', '9880559606', 'hii', 0, '2023-11-09 04:13:17'),
(100001, 'mr kane', 'Balaji@gmail.com', '7349647783', 'aFSDGFHG', 1, '2023-11-23 01:54:18');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `history_qty` int(11) NOT NULL,
  `history_cost` int(11) NOT NULL,
  `history_item` int(11) NOT NULL,
  `history_date` datetime NOT NULL,
  `history_delivered` tinyint(1) NOT NULL DEFAULT 0,
  `history_user_id` varchar(25) NOT NULL,
  `history_address_id` int(11) NOT NULL,
  `history_accept` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `history_qty`, `history_cost`, `history_item`, `history_date`, `history_delivered`, `history_user_id`, `history_address_id`, `history_accept`) VALUES
(1, 1, 20, 100002, '2024-01-30 11:42:32', 1, '131', 31, 1),
(2, 1, 300, 100005, '2024-01-30 11:42:32', 1, '131', 31, 1),
(45, 2, 50, 3, '2024-01-24 07:09:15', 0, '100001', 1, 0),
(46, 2, 30, 2, '2024-01-24 12:42:27', 0, '100000', 8, 0),
(47, 1, 20, 100002, '2024-01-24 12:42:27', 1, '100000', 8, 0),
(70, 1, 20, 100002, '2024-01-27 12:02:23', 0, '131', 25, 0),
(71, 1, 30, 2, '2024-01-27 12:02:23', 0, '131', 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `items_id` bigint(20) NOT NULL,
  `items_name` varchar(20) NOT NULL,
  `items_image` varchar(150) NOT NULL,
  `items_cost` bigint(20) NOT NULL,
  `item_commission_cost` float NOT NULL,
  `items_delete` tinyint(1) NOT NULL,
  `items_add_date` varchar(20) NOT NULL,
  `items_count` int(11) NOT NULL,
  `item_chef_id` int(11) NOT NULL,
  `item_category` tinyint(1) NOT NULL,
  `item_meal_type` int(11) NOT NULL,
  `item_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`items_id`, `items_name`, `items_image`, `items_cost`, `item_commission_cost`, `items_delete`, `items_add_date`, `items_count`, `item_chef_id`, `item_category`, `item_meal_type`, `item_status`) VALUES
(1, 'brike', '2022-03-02_1646238597.jpg', 20, 0, 1, '2022-03-02 21:59:57', 0, 100003, 0, 1, 1),
(2, 'Green Lays', '2023-10-14_1697304972.jpg', 30, 20, 0, '2022-03-02 22:08:54', 84, 100001, 0, 3, 1),
(3, 'Butter Biscuits', '2022-07-25_1658765093.jpeg', 50, 89, 0, '25-07-2022 09:28:32 ', 49, 100001, 0, 2, 1),
(4, 'lays', '', 10, 0, 0, '2023-10-05 05:46:06 ', 2, 100001, 0, 3, 1),
(100001, 'Dairy Milk', '2023-10-14_1697304773.jpg', 20, 0, 0, '2023-10-14 11:02:53 ', 36, 100003, 0, 2, 0),
(100002, 'diry', '2023-11-23_1700729724.png', 20, 0, 0, '2023-11-23 02:25:24 ', 2, 100000, 0, 3, 1),
(100003, 'Update_age', '2024-01-23_1706015459.png', 23, 0, 0, '2024-01-23 06:40:59 ', 0, 100003, 1, 2, 0),
(100004, 'esmdxn es', '2024-01-23_1706018839.png', 120, 0, 0, '2024-01-23 07:37:19 ', 0, 100003, 0, 3, 0),
(100005, 'available_not_exceed', '2024-01-29_1706514119.png', 300, 0, 0, '2024-01-29 01:11:59 ', 0, 100003, 0, 3, 1),
(100006, 'biriyani', '2024-01-29_1706514773.jpg', 600, 0, 0, '2024-01-29 01:22:53 ', 0, 100003, 1, 4, 1),
(100007, 'balaji Dosa', '2024-01-31_1706685000.png', 50, 50, 0, '2024-01-31 12:40:00 ', 0, 100003, 0, 3, 1),
(100008, 'Masale Dosa', '2024-01-31_1706685129.png', 50, 75, 0, '2024-01-31 12:42:09 ', 0, 100003, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `logs_id` int(11) NOT NULL,
  `logs_order` int(11) NOT NULL,
  `logs_active_admin` int(11) NOT NULL,
  `logs_inactive_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`logs_id`, `logs_order`, `logs_active_admin`, `logs_inactive_admin`) VALUES
(1, 27, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(20) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `message`) VALUES
(1, ''),
(2, ''),
(3, '10');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL,
  `orders_qty` int(11) NOT NULL,
  `orders_cost` int(11) NOT NULL,
  `orders_items` int(11) NOT NULL,
  `orders_user_id` varchar(25) NOT NULL,
  `orders_date` datetime NOT NULL,
  `orders_delivered` tinyint(1) NOT NULL,
  `orders_address_id` int(11) NOT NULL,
  `orders_accept` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `orders_qty`, `orders_cost`, `orders_items`, `orders_user_id`, `orders_date`, `orders_delivered`, `orders_address_id`, `orders_accept`) VALUES
(3, 1, 75, 100008, '131', '2024-01-31 12:53:29', 0, 32, 1);

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `deleted_order` AFTER DELETE ON `orders` FOR EACH ROW UPDATE logs SET logs_order=logs.logs_order-1
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `deleted_order_insert_history` BEFORE DELETE ON `orders` FOR EACH ROW INSERT INTO history (`history_id`,`history_qty`,`history_cost`,`history_item`,`history_date`,`history_delivered`,`history_user_id`,`history_address_id`,`history_accept`) VALUES (OLD.orders_id,OLD.orders_qty,OLD.orders_cost,OLD.orders_items,OLD.orders_date,OLD.orders_delivered,OLD.orders_user_id,  OLD.orders_address_id,OLD.orders_accept)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_order` AFTER INSERT ON `orders` FOR EACH ROW UPDATE logs SET logs_order=logs.logs_order+1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` bigint(20) NOT NULL,
  `transaction_user_id` varchar(25) NOT NULL,
  `transaction_amount` varchar(10) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `transaction_status` varchar(10) NOT NULL,
  `transaction_address_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `transaction_user_id`, `transaction_amount`, `transaction_date`, `transaction_status`, `transaction_address_id`) VALUES
(100208, '131', '60', '2024-01-25 06:59:43', 'TXN_Succes', 23),
(100209, '131', '50', '2024-01-25 07:16:17', 'TXN_Succes', 24),
(100210, '92438d17b86057d30012', '50', '2024-01-27 12:02:23', 'TXN_Succes', 25),
(100211, '131', '60', '2024-01-27 03:03:08', 'TXN_Succes', 26),
(100212, '131', '40', '2024-01-29 12:02:22', 'TXN_Succes', 27),
(100213, '131', '671.5', '2024-01-30 11:24:16', 'TXN_Succes', 29),
(100214, '131', '346', '2024-01-30 11:42:32', 'TXN_Succes', 31),
(100215, '131', '88.75', '2024-01-31 12:53:29', 'TXN_Succes', 32);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_details`
--
ALTER TABLE `address_details`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`items_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_details`
--
ALTER TABLE `address_details`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100004;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100295;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100002;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `items_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100009;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100216;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
