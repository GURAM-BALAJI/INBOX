-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2024 at 07:10 AM
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
(1, '09035376766', 'near konnapna agrahara bus stop', 'scrvtb', '38e102a7c60e82e10e92', 'gurambalaji', 60),
(2, '09035376766', 'near konnapna agrahara bus stop', 'yjrf', '38e102a7c60e82e10e92', 'gurambalaji', 60),
(3, '07619321936', 'A205, 2nd main road, 9th cross, Upkhar solitaire, Attibele', 'sdfg', '12280ee578a3ec7eb424', 'pradeeprs176@gmail.com', 60),
(4, '8978456858', 'Humm', 'Humm', '7392c7f0decf333f9f3e', 'Humm', 60);

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
(100004, '$2y$10$CfbFV811Lj6U75VRkcQFuO7An3A22U360Ey2gMg3cM4gbbLMaSjNK', 'Srinivas1', 9108667340, 1, 0, '2024-01-31 05:33:47 ', '2024-02-01 02:37:44 ', 'ragv collorny ballari1', 2, 0),
(100005, '$2y$10$NU9HJEcIJLOq3chfBsBDKuMMSt5dUadjgFwLW20N1wIcCo85fN6bu', 'Rooooopashreee', 7619321936, 1, 0, '2024-01-31 05:34:36 ', '2024-01-31 05:34:36 ', 'vdxfbcngvhg esde sd', 2, 0),
(100006, '$2y$10$Y73uPXNTnGJWxm5eMXoPiOFsDMtGr.oMKVkL7imc2UqDhOTS.2XDS', 'BALAJI B', 9035376766, 1, 0, '2024-02-01 03:24:14 ', '2024-02-01 03:25:26 ', 'ragv collorny ballari', 3, 0);

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
(3, 3, 1, '404d3e31ad694b9cb18a', '2024-01-31 05:48:22 '),
(9, 8, 1, '404d3e31ad694b9cb18a', '2024-01-31 06:06:25 '),
(17, 8, 2, '96a631303adcecf13bb4', '2024-02-01 02:16:51 '),
(18, 3, 1, '96a631303adcecf13bb4', '2024-02-01 03:50:40 '),
(19, 5, 1, '96a631303adcecf13bb4', '2024-02-01 03:51:05 '),
(20, 6, 1, '96a631303adcecf13bb4', '2024-02-01 03:51:08 '),
(31, 1, 1, '880358a0710e4e74de9a', '2024-02-07 11:25:26 '),
(36, 3, 1, '7392c7f0decf333f9f3e', '2024-02-07 04:34:39 '),
(37, 8, 1, '7392c7f0decf333f9f3e', '2024-02-07 04:39:02 ');

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
(1, 'Breakfast', '2024-01-31_1706702743.jpg', 10, 0),
(2, 'Lunch', '2024-01-31_1706702797.jpeg', 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` bigint(20) NOT NULL,
  `contact_name` varchar(20) NOT NULL,
  `contact_email` varchar(35) NOT NULL,
  `contact_message` varchar(30) NOT NULL,
  `contact_subject` varchar(2000) NOT NULL,
  `contact_view` tinyint(1) NOT NULL,
  `contact_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_name`, `contact_email`, `contact_message`, `contact_subject`, `contact_view`, `contact_date`) VALUES
(1, 'Humm ', 'Balaji@gmail.com', 'Amar mate eta ki ', 'feedback', 0, '2024-02-07 04:05:24'),
(2, 'Amar ', 'Balaji@gmail.com', 'asfad', 'technical_support', 0, '2024-02-07 04:09:36'),
(3, 'Amar ', 'Balaji@gmail.com', 'asfad', 'technical_support', 0, '2024-02-07 04:10:22'),
(4, 'Amar ', 'Balaji@gmail.com', 'asfad', 'technical_support', 0, '2024-02-07 04:10:47'),
(5, 'Amar ', 'Balaji@gmail.com', 'asfad', 'technical_support', 0, '2024-02-07 04:10:50'),
(6, 'Amar ', 'Balaji@gmail.com', 'asfad', 'technical_support', 0, '2024-02-07 04:11:05'),
(7, 'Amar ', 'Balaji@gmail.com', 'asfad', 'technical_support', 0, '2024-02-07 04:11:06'),
(8, 'Amar ', 'Balaji@gmail.com', 'asfad', 'technical_support', 0, '2024-02-07 04:11:13'),
(9, 'Amar ', 'Balaji@gmail.com', 'asfad', 'technical_support', 0, '2024-02-07 04:11:20'),
(10, 'Amar ', 'Balaji@gmail.com', 'asfad', 'technical_support', 0, '2024-02-07 04:11:26'),
(11, 'Humm ', 'Balaji@gmail.com', 'Amar mate eta ki ', 'feedback', 0, '2024-02-07 04:12:57'),
(12, 'Humm ', 'Balaji@gmail.com', 'Amar mate eta ki ', 'feedback', 0, '2024-02-07 04:13:14');

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
(1, 2, 231, 1, '2024-02-02 11:06:29', 1, '38e102a7c60e82e10e92', 1, 1),
(2, 1, 220, 3, '2024-02-02 11:06:29', 2, '38e102a7c60e82e10e92', 1, 1);

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
  `items_ack` int(11) NOT NULL,
  `item_chef_id` int(11) NOT NULL,
  `item_category` tinyint(1) NOT NULL,
  `item_meal_type` int(11) NOT NULL,
  `item_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`items_id`, `items_name`, `items_image`, `items_cost`, `item_commission_cost`, `items_delete`, `items_add_date`, `items_ack`, `item_chef_id`, `item_category`, `item_meal_type`, `item_status`) VALUES
(1, 'dosa', '2024-01-31_1706702825.jpg', 210, 231, 0, '2024-01-31 05:37:05 ', 1, 100005, 0, 1, 1),
(3, 'IDLI', '2024-01-31_1706702845.jpg', 220, 220, 0, '2024-01-31 05:37:25 ', 1, 100005, 0, 1, 1),
(4, 'Idli + sambar + Chat', '2024-01-31_1706702885.jpg', 250, 275, 1, '2024-01-31 05:38:05 ', 2, 100004, 0, 1, 1),
(5, 'PURI', '2024-01-31_1706702911.jpg', 180, 198, 0, '2024-01-31 05:38:31 ', 1, 100005, 0, 1, 1),
(6, 'Paratha', '2024-01-31_1706702945.jpg', 240, 264, 0, '2024-01-31 05:39:05 ', 1, 100005, 1, 1, 1),
(7, 'Masal Dose + sambar ', '2024-01-31_1706703000.jpg', 150, 165, 1, '2024-01-31 05:40:00 ', 2, 100004, 0, 1, 1),
(8, 'Thali + xyz + xyz + ', '2024-01-31_1706703086.jpeg', 350, 402, 0, '2024-01-31 05:41:26 ', 1, 100004, 0, 2, 1);

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
(1, 30, 4, 0);

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
(3, '60');

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
(3, 1, 231, 1, '12280ee578a3ec7eb424', '2024-02-07 11:32:50', 0, 3, 1),
(4, 2, 231, 1, '7392c7f0decf333f9f3e', '2024-02-07 04:15:38', 0, 4, 1),
(5, 1, 402, 8, '7392c7f0decf333f9f3e', '2024-02-07 04:15:38', 0, 4, 1);

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
(1, '38e102a7c60e82e10e92', '776.1', '2024-02-02 11:06:29', 'TXN_Succes', 1),
(2, '12280ee578a3ec7eb424', '302.55', '2024-02-07 11:32:50', 'TXN_Succes', 3),
(3, '7392c7f0decf333f9f3e', '967.2', '2024-02-07 04:15:38', 'TXN_Succes', 4);

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
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100007;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `items_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
