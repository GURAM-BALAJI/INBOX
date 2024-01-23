-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2023 at 10:00 AM
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
-- Database: `pesu_vend1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint(20) NOT NULL,
  `admin_email` varchar(35) NOT NULL,
  `admin_password` varchar(300) NOT NULL,
  `admin_name` varchar(20) NOT NULL,
  `admin_phone` bigint(50) NOT NULL,
  `admin_photo` varchar(150) NOT NULL,
  `admin_dob` date NOT NULL,
  `admin_status` tinyint(1) NOT NULL,
  `users_view` tinyint(1) NOT NULL,
  `users_create` tinyint(1) NOT NULL,
  `users_edit` tinyint(1) NOT NULL,
  `users_del` tinyint(1) NOT NULL,
  `admin_view` tinyint(1) NOT NULL,
  `admin_create` tinyint(1) NOT NULL,
  `admin_edit` tinyint(1) NOT NULL,
  `admin_del` tinyint(1) NOT NULL,
  `items_view` tinyint(1) NOT NULL,
  `items_create` tinyint(1) NOT NULL,
  `items_edit` tinyint(1) NOT NULL,
  `items_del` tinyint(1) NOT NULL,
  `users_special` tinyint(1) NOT NULL,
  `admin_special` tinyint(1) NOT NULL,
  `contact_view` tinyint(1) NOT NULL,
  `contact_edit` tinyint(1) NOT NULL,
  `message_view` tinyint(1) NOT NULL,
  `admin_delete` tinyint(1) NOT NULL,
  `admin_added_date` varchar(20) NOT NULL,
  `admin_updated_date` varchar(20) NOT NULL,
  `display_items_view` tinyint(1) NOT NULL,
  `display_items_edit` tinyint(1) NOT NULL,
  `display_items_create` tinyint(1) NOT NULL,
  `display_items_del` tinyint(1) NOT NULL,
  `history_view` tinyint(1) NOT NULL,
  `orders_view` tinyint(1) NOT NULL,
  `slogan_view` tinyint(1) NOT NULL,
  `slogan_create` tinyint(1) NOT NULL,
  `slogan_edit` tinyint(1) NOT NULL,
  `slogan_del` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `admin_phone`, `admin_photo`, `admin_dob`, `admin_status`, `users_view`, `users_create`, `users_edit`, `users_del`, `admin_view`, `admin_create`, `admin_edit`, `admin_del`, `items_view`, `items_create`, `items_edit`, `items_del`, `users_special`, `admin_special`, `contact_view`, `contact_edit`, `message_view`, `admin_delete`, `admin_added_date`, `admin_updated_date`, `display_items_view`, `display_items_edit`, `display_items_create`, `display_items_del`, `history_view`, `orders_view`, `slogan_view`, `slogan_create`, `slogan_edit`, `slogan_del`) VALUES
(1, 'admin@admin.com', '$2y$10$yZFyBC/3udbhyWJQ8LebC.zwCaUWe6Wgf6J07C/fPXWgM5oaD8aR6', 'Elons', 9696969696, 'happy-birthday-g500f90242_640.jpg', '2020-11-10', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, '2021-01-04', '2022-08-17 01:21:10 ', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(100000, 'pradeeprs@gmail.com', '$2y$10$ipf8fePZGxWhMIxQOpStI.jwqLdCSiyAbesr7ZEAXyLv4DNGcMfIS', 'Pradeep', 7619321936, '', '0000-00-00', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, '2023-10-05 05:27:01 ', '2023-10-05 05:31:23 ', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(100001, 'sandhya@gmail.com', '$2y$10$ipf8fePZGxWhMIxQOpStI.jwqLdCSiyAbesr7ZEAXyLv4DNGcMfIS', 'sandhya', 9876543210, '', '0000-00-00', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, '2023-10-05 05:28:30 ', '2023-10-05 05:31:15 ', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

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
-- Table structure for table `adminqrcode`
--

CREATE TABLE `adminqrcode` (
  `qr_code` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminqrcode`
--

INSERT INTO `adminqrcode` (`qr_code`) VALUES
('12345678901234567890123456789012345678901234567890');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` bigint(20) NOT NULL,
  `cart_spring_id` int(11) NOT NULL,
  `cart_qty` int(11) NOT NULL,
  `cart_user_id` bigint(20) NOT NULL,
  `cart_added_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_spring_id`, `cart_qty`, `cart_user_id`, `cart_added_date`) VALUES
(100043, 2, 1, 131, '2022-08-17 07:40:01 ');

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
(34, 'Wedding Photography', 'admin@admin.com', '23424242424', 'gedsfdsg', 1, '2022-07-27 11:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `display_items`
--

CREATE TABLE `display_items` (
  `display_id` bigint(20) NOT NULL,
  `display_items_id` bigint(20) NOT NULL,
  `display_items_add_date` varchar(20) NOT NULL,
  `display_items_updated_date` varchar(20) NOT NULL,
  `display_spring_id` bigint(20) NOT NULL,
  `display_items_qty` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `display_items`
--

INSERT INTO `display_items` (`display_id`, `display_items_id`, `display_items_add_date`, `display_items_updated_date`, `display_spring_id`, `display_items_qty`) VALUES
(3, 3, '25-07-2022 09:31:37 ', '2023-10-31 03:31:00 ', 4, 9),
(4, 2, '27-07-2022 11:37:42 ', '2023-10-31 03:30:55 ', 2, 8),
(100001, 100001, '2023-10-14 11:04:50 ', '2023-10-31 03:31:06 ', 5, 11);

--
-- Triggers `display_items`
--
DELIMITER $$
CREATE TRIGGER `update_items_count` BEFORE UPDATE ON `display_items` FOR EACH ROW BEGIN
  IF NEW.display_items_qty < OLD.display_items_qty AND NEW.display_items_id = OLD.display_items_id THEN
    -- Decrease the items_count in the items table
    UPDATE items
    SET items_count = items_count + (OLD.display_items_qty - NEW.display_items_qty)
    WHERE items_id = NEW.display_items_id;
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` varchar(25) NOT NULL,
  `history_qty` varchar(100) NOT NULL,
  `history_cost` varchar(100) NOT NULL,
  `history_item` varchar(100) NOT NULL,
  `history_date` datetime NOT NULL,
  `history_delivered` int(11) NOT NULL DEFAULT 0,
  `history_user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `history_qty`, `history_cost`, `history_item`, `history_date`, `history_delivered`, `history_user_id`) VALUES
('08VvCCoX6YSyWHQ', '1', '20', '100001', '2023-10-30 12:20:37', 3, 100001),
('1DJbwYfKLyn9BI2', '1', '30', '4', '2023-10-30 12:14:14', 3, 100001),
('1tHcpmBgDpgaKSB', '1', '30', '100000', '2023-10-05 07:57:50', 0, 100001),
('2FVekqZt4PHW0kt', '1', '30', '100000', '2023-10-05 06:33:52', 0, 100001),
('2GCD9zSqU4zktWi', '1', '30', '4', '2023-10-05 07:46:55', 1, 100001),
('3hGawX5QjJgNtU7', '1', '30', '100000', '2023-10-05 06:21:10', 2, 100001),
('4HMQQ4uXG911CFl', '1', '30', '100000', '2023-10-05 07:02:16', 0, 100002),
('53aP5sziI0SCTJP', '1,1', '50,30', '3,4', '2022-07-31 04:15:19', 2, 131),
('93KUAPnxYJhawFu', '1', '50', '3', '2022-08-02 10:44:31', 2, 131),
('ccFb205xntrgPa1', '1', '30', '4', '2022-07-31 08:23:32', 1, 131),
('cTIhJoddGRVyeCC', '1', '50', '3', '2022-07-31 08:13:02', 3, 131),
('FMM1w6VpjUsKNtf', '1', '30', '4', '2022-07-31 08:21:57', 2, 131),
('GjHkR0ozJyfd9ck', '1', '50', '3', '2022-07-31 04:14:41', 2, 131),
('Hr9SYyG8PxcvvPA', '4', '30', '4', '2022-07-31 08:16:04', 3, 131),
('I66f4pLV4d7fx2I', '1', '50', '3', '2022-08-02 09:56:43', 2, 131),
('IjmvMqelcUrodhr', '3', '30', '4', '2022-07-31 08:17:12', 1, 131),
('iZfLERSfnBFp1UC', '1', '50', '3', '2022-07-31 04:11:21', 2, 131),
('MpCIrYV1XeGbWex', '1', '30', '4', '2023-10-05 07:26:51', 3, 100001),
('MSn2BkPMJf8ohnD', '1', '50', '3', '2022-07-31 01:40:15', 3, 131),
('olAYNyWbR8gw9MX', '1', '30', '100000', '2023-10-05 06:22:57', 2, 100001),
('ONIeCzCEaEAUW7Q', '1', '50', '3', '2022-07-31 03:47:51', 1, 131),
('QEiunXAeSfOauZ8', '1', '30', '4', '2022-07-31 04:21:32', 2, 131),
('Tql3HOadwKgK9yU', '1', '50', '3', '2022-08-03 01:51:51', 2, 131),
('unaJjUPSjVvVLME', '1,1,1', '50,30,30', '3,4,100000', '2023-10-05 05:50:08', 3, 100001),
('Up5ibHfBSRnMMjb', '2', '50', '3', '2022-08-03 01:52:08', 3, 131),
('WNSPJyBl3q8TQb2', '1', '50', '3', '2022-08-02 10:52:48', 2, 131),
('XXz3bcDM2kU3PX2', '1', '30', '4', '2023-10-05 06:23:41', 2, 100001),
('yVn5ldPkElNi5aA', '1', '30', '100000', '2023-10-05 06:32:36', 2, 100001),
('zt3uTRS03PSeBaG', '1', '30', '4', '2023-10-05 08:00:15', 0, 100001);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `items_id` bigint(20) NOT NULL,
  `items_name` varchar(20) NOT NULL,
  `items_image` varchar(150) NOT NULL,
  `items_cost` bigint(20) NOT NULL,
  `items_delete` tinyint(1) NOT NULL,
  `items_add_date` varchar(20) NOT NULL,
  `items_updated_date` varchar(20) NOT NULL,
  `items_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`items_id`, `items_name`, `items_image`, `items_cost`, `items_delete`, `items_add_date`, `items_updated_date`, `items_count`) VALUES
(1, 'brike', '2022-03-02_1646238597.jpg', 20, 1, '2022-03-02 21:59:57', '', 0),
(2, 'Green Lays', '2023-10-14_1697304972.jpg', 30, 0, '2022-03-02 22:08:54', '2023-10-14 11:06:12 ', 24),
(3, 'Butter Biscuits', '2022-07-25_1658765093.jpeg', 50, 0, '25-07-2022 09:28:32 ', '2022-08-17 01:28:03 ', 20),
(100000, 'lays', '', 10, 1, '2023-10-05 05:46:06 ', '2023-10-14 11:02:33 ', 0),
(100001, 'Dairy Milk', '2023-10-14_1697304773.jpg', 20, 0, '2023-10-14 11:02:53 ', '2023-10-14 11:02:53 ', 12);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `logs_id` int(11) NOT NULL,
  `logs_order` int(11) NOT NULL,
  `logs_active_users` int(11) NOT NULL,
  `logs_inactive_users` int(11) NOT NULL,
  `logs_active_admin` int(11) NOT NULL,
  `logs_inactive_admin` int(11) NOT NULL,
  `logs_amount` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`logs_id`, `logs_order`, `logs_active_users`, `logs_inactive_users`, `logs_active_admin`, `logs_inactive_admin`, `logs_amount`) VALUES
(1, 26, 1, -2, 3, 0, 8620);

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
(1, ' '),
(2, ''),
(3, 'hey!!, join us www.pesuvend.com');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` varchar(25) NOT NULL,
  `orders_qty` varchar(100) NOT NULL,
  `orders_cost` varchar(100) NOT NULL,
  `orders_items` varchar(100) NOT NULL,
  `orders_spring_id` varchar(100) NOT NULL,
  `orders_user_id` bigint(20) NOT NULL,
  `orders_date` datetime NOT NULL,
  `orders_delivered` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `orders_qty`, `orders_cost`, `orders_items`, `orders_spring_id`, `orders_user_id`, `orders_date`, `orders_delivered`) VALUES
('3s7pcVXkSPSJrye', '1', '30', '4', '2', 100001, '2023-10-11 06:11:42', 0),
('4UKq7qLmiK0YnJy', '1', '50', '3', '4', 100001, '2023-10-12 02:03:41', 0),
('9p9UqgJPs3mKlyI', '3,1', '50,30', '3,4', '4,2', 100001, '2023-10-12 02:10:12', 0),
('AFYbvkOfHSCX8C0', '1', '30', '4', '2', 100001, '2023-10-31 03:31:15', 0),
('amtK8rDkRJqWn0p', '2,1', '50,30', '3,100000', '4,3', 100001, '2023-10-11 02:58:44', 0),
('cGHV2OFZzqmabcI', '1', '50', '3', '4', 100001, '2023-10-31 02:47:22', 0),
('cj0d7F0qaQsRVBJ', '1,1', '50,30', '3,4', '4,2', 100001, '2023-10-14 11:08:33', 0),
('DoLbeXSy70BfFMA', '1', '30', '4', '2', 100001, '2023-10-12 12:41:09', 0),
('eHTYWrRq6pkrdWt', '1,1,2', '50,30,20', '3,4,100001', '4,2,5', 100001, '2023-10-30 12:55:25', 0),
('H7f5EJRceJ4M8zn', '1', '50', '3', '4', 100001, '2023-11-02 11:36:30', 0),
('JhdnBHqyCKQBMuD', '1', '30', '4', '2', 100001, '2023-10-12 12:40:32', 0),
('jPt1Ayddl1hLgE0', '1,1', '50,30', '3,100000', '', 100001, '2023-10-11 02:18:43', 0),
('jXEb8kAKVtM3TcT', '1', '30', '4', '2', 100001, '2023-11-02 10:38:43', 0),
('nsSHKSG4pzxozEc', '1', '30', '4', '2', 100001, '2023-10-11 06:13:49', 0),
('od2F7cDgeuZnVUM', '1', '50', '3', '4', 100001, '2023-11-02 11:30:21', 0),
('OuzIv3hy2sGWunX', '2,1,1', '50,30,30', '3,4,100000', '', 100001, '2023-10-10 12:17:16', 0),
('PYba8kRikhMI6Go', '2,6', '50,30', '3,4', '4,2', 100001, '2023-10-30 12:53:13', 0),
('rrOfTEsgoWywGKU', '1', '50', '3', '4', 100001, '2023-10-31 12:16:33', 0),
('sLmEgqDAaLFwggC', '4,3,7', '50,30,20', '3,4,100001', '4,2,5', 100001, '2023-10-30 12:56:25', 0),
('sM98e18euuE0QLp', '1,1', '50,20', '3,100001', '4,5', 100001, '2023-11-03 08:25:28', 0),
('tZPyc4RE1gYo6yj', '1', '30', '4', '2', 100001, '2023-11-02 11:34:23', 0),
('v1Bwcih4OGpmduC', '1', '20', '100001', '5', 100001, '2023-11-02 11:37:28', 0),
('V3YpTJjn6rTLgqL', '1', '30', '4', '2', 100001, '2023-11-02 11:31:30', 0),
('w9CKPb97XaHa8fS', '1', '50', '3', '4', 100001, '2023-10-31 12:29:02', 0),
('XRIvBXMO6pZdzGd', '1', '50', '3', '4', 100001, '2023-10-31 11:24:31', 0),
('Y5rH8vVRi0hejlK', '1', '30', '4', '2', 100001, '2023-11-02 11:32:33', 0);

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `deleted_order` AFTER DELETE ON `orders` FOR EACH ROW UPDATE logs SET logs_order=logs.logs_order-1
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `deleted_order_insert_history` BEFORE DELETE ON `orders` FOR EACH ROW INSERT INTO history (`history_id`,`history_qty`,`history_cost`,`history_item`,`history_date`,`history_delivered`,`history_user_id`) VALUES (OLD.orders_id,OLD.orders_qty,OLD.orders_cost,OLD.orders_items,OLD.orders_date,OLD.orders_delivered,OLD.orders_user_id)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_order` AFTER INSERT ON `orders` FOR EACH ROW UPDATE logs SET logs_order=logs.logs_order+1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `qr_counter`
--

CREATE TABLE `qr_counter` (
  `id` int(11) NOT NULL,
  `last_qr_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semopher`
--

CREATE TABLE `semopher` (
  `semopher_id` int(11) NOT NULL,
  `semopher_value` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `semopher`
--

INSERT INTO `semopher` (`semopher_id`, `semopher_value`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessionss`
--

CREATE TABLE `sessionss` (
  `sessionss_id` bigint(20) NOT NULL,
  `sessionss_user_id` bigint(20) NOT NULL,
  `sessionss_cookies_id` varchar(40) NOT NULL,
  `sessionss_created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sessionss`
--

INSERT INTO `sessionss` (`sessionss_id`, `sessionss_user_id`, `sessionss_cookies_id`, `sessionss_created_date`) VALUES
(1, 131, '03581d2d71171c051311660844107', '2022-08-18 11:05:07'),
(2, 100000, '6ed86dba70f5b8b51000001660750414', '2022-08-17 09:03:34'),
(3, 132, 'b555e7d40694f6b11321660749714', '2022-08-17 08:51:54'),
(4, 100001, '3346ad0dc3fcedff1000011698648244', '2023-10-30 12:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `slogan`
--

CREATE TABLE `slogan` (
  `slogan_id` int(11) NOT NULL,
  `slogan_sentance` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `slogan`
--

INSERT INTO `slogan` (`slogan_id`, `slogan_sentance`) VALUES
(2, 'Your stomach is not a dustbin;fill it with some healthy stuff.'),
(3, 'Your stomach shouldn\'t be a waist basket.'),
(4, 'No development with an empty stomach'),
(5, 'Don\'t let your hungry stomach quake, come along and buy some snack!'),
(6, 'Your stomach needs me'),
(7, 'Listen to your stomach, it\'s calling for Magnesium'),
(8, 'It will fill your stomach as well as your heart.'),
(9, 'Don\'t make your stomach a dustbin, eat right and healthy.'),
(10, 'Don\'t use your stomach as a trash can!'),
(11, 'Junk belongs in the trash, not in your stomach! '),
(12, 'Makes your stomach feel good.'),
(13, 'Take your stomach on a joy ride with yummy.'),
(14, 'Give your stomach the taste of love.'),
(15, 'The urge to fill your hungry stomach.'),
(16, 'A Trendy snack means Hungry Stomach.'),
(17, 'We are for your hungry stomach'),
(18, 'You cant live a full life on an empty stomach.'),
(19, 'Good Stomach Good Digest'),
(20, 'We cant stomach this find a cure.'),
(21, 'A day is best started on a full stomach.'),
(22, 'A full stomach means a happy heart. Happy Day.'),
(23, 'Your Stomach Is Empty.');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` bigint(20) NOT NULL,
  `transaction_user_id` bigint(20) NOT NULL,
  `transaction_send_to` varchar(100) NOT NULL,
  `transaction_amount` varchar(10) NOT NULL,
  `transaction_order` varchar(25) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `transaction_added_by` bigint(20) NOT NULL,
  `transaction_type` int(11) NOT NULL,
  `transaction_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `transaction_user_id`, `transaction_send_to`, `transaction_amount`, `transaction_order`, `transaction_date`, `transaction_added_by`, `transaction_type`, `transaction_status`) VALUES
(201, 131, '', '500.00', 'NB', '2022-07-25 18:20:01', 131, 5, 'TXN_SUCCES'),
(202, 131, '', '100.00', 'NB', '2022-07-25 18:20:33', 131, 0, 'TXN_SUCCES'),
(203, 131, '', '900.00', 'NB', '2022-07-25 21:59:15', 131, 0, 'TXN_SUCCES'),
(204, 131, '', '200.00', 'NB', '2022-07-25 21:59:36', 131, 5, 'TXN_SUCCES'),
(205, 131, '', '300.00', 'NB', '2022-07-25 22:00:03', 131, 5, 'TXN_SUCCES'),
(206, 131, '', '500.00', 'NB', '2022-07-25 22:01:12', 131, 5, 'TXN_SUCCES'),
(207, 131, '12345675342', '-1000', 'pay friend', '2022-07-25 10:29:05', 131, 2, ''),
(208, 132, '9108667341', '1000', 'pay friend', '2022-07-25 10:29:05', 131, 2, ''),
(209, 132, '9108667341', '-1010', 'pay friend', '2022-07-25 10:37:11', 132, 2, ''),
(210, 131, '12345675342', '1010', 'pay friend', '2022-07-25 10:37:11', 132, 2, ''),
(211, 131, '', '200.00', 'NB', '2022-07-26 15:29:59', 131, 5, 'TXN_SUCCES'),
(212, 131, 'Recharged', '100.00', 'NB', '2022-07-26 15:36:19', 131, 0, 'TXN_SUCCES'),
(213, 131, 'Order', '130', 'Ordered', '0000-00-00 00:00:00', 131, 1, ''),
(214, 131, 'Order', '30', 'Ordered', '0000-00-00 00:00:00', 131, 1, ''),
(215, 131, 'Order', '30', 'Ordered', '2022-07-27 03:06:48', 131, 1, ''),
(216, 131, 'Order', '30', 'Ordered', '2022-07-27 15:07:59', 131, 1, ''),
(217, 131, 'Order', '30', 'Ordered', '2022-07-27 03:09:17', 131, 1, ''),
(218, 134, '0', '43', 'login', '0000-00-00 00:00:00', 1, 0, ''),
(219, 132, 'Added Manually', '100', 'add amount', '0000-00-00 00:00:00', 1, 0, ''),
(220, 132, 'Added Manually', '-10', 'add amount', '0000-00-00 00:00:00', 1, 0, ''),
(221, 132, 'Added Manually', '10', 'add amount', '0000-00-00 00:00:00', 1, 0, ''),
(222, 131, 'Added Manually', '-30', 'add amount', '0000-00-00 00:00:00', 1, 0, ''),
(223, 132, 'Added Manually', '-100', 'add amount', '0000-00-00 00:00:00', 1, 0, ''),
(224, 131, 'Order', '50', 'Ordered', '2022-07-27 04:49:59', 131, 1, ''),
(225, 132, 'Added Manually', '10', 'add amount', '0000-00-00 00:00:00', 1, 0, ''),
(226, 131, 'Recharged', '100.00', 'NB', '2022-07-27 23:18:09', 131, 0, 'TXN_SUCCES'),
(227, 131, '12345675342', '-1000', 'pay friend', '2022-07-27 11:18:46', 131, 2, ''),
(228, 132, '9108667341', '1000', 'pay friend', '2022-07-27 11:18:46', 131, 2, ''),
(229, 131, 'Recharged', '100.00', 'NB', '2022-07-28 21:02:31', 131, 0, 'TXN_SUCCES'),
(230, 131, 'Recharged', '100.00', 'NB', '2022-07-28 21:03:04', 131, 0, 'TXN_SUCCES'),
(231, 131, 'Recharged', '100.00', 'NB', '2022-07-28 21:03:21', 131, 0, 'TXN_SUCCES'),
(232, 131, 'Recharged', '100.00', 'NB', '2022-07-28 21:03:38', 131, 0, 'TXN_SUCCES'),
(233, 131, 'Recharged', '100', 'ORDS85163882', '2022-07-28 10:22:17', 131, 5, 'TXN_INIT'),
(234, 131, 'Recharged', '100', 'ORDS89951854', '2022-07-28 10:29:00', 131, 5, 'TXN_INIT'),
(235, 131, 'Recharged', '50', 'ORDS99899930', '2022-07-28 10:32:02', 131, 5, 'TXN_SUCCES'),
(236, 131, 'Recharged', '100', 'ORDS38341480', '2022-07-28 10:32:22', 131, 5, 'TXN_INIT'),
(237, 131, 'Recharged', '50', 'ORDS90064865', '2022-07-28 10:34:21', 131, 5, 'TXN_INIT'),
(238, 131, 'Recharged', '100', 'ORDS9474214', '2022-07-28 10:34:43', 131, 5, 'TXN_INIT'),
(239, 131, 'Recharged', '100', 'ORDS12783727', '2022-07-28 10:37:54', 131, 5, 'TXN_SUCCES'),
(240, 131, 'Recharged', '100', 'ORDS73871561', '2022-07-28 10:43:21', 131, 5, 'TXN_INIT'),
(241, 131, 'Recharged', '100', 'ORDS86072762', '2022-07-28 10:48:21', 131, 5, 'TXN_SUCCES'),
(242, 131, 'Recharged', '100', 'ORDS12440641', '2022-07-28 10:52:07', 131, 5, 'TXN_FAILUR'),
(243, 131, 'Recharged', '100', 'ORDS47401475', '2022-07-28 10:53:42', 131, 5, 'TXN_FAILUR'),
(244, 131, 'Recharged', '100', '131741541659029455', '2022-07-28 11:00:55', 131, 5, 'TXN_SUCCES'),
(245, 131, 'Recharged', '100', '131261531659029777', '2022-07-28 23:06:20', 131, 5, 'TXN_SUCCES'),
(246, 131, 'Recharged', '100', '131761051659029829', '2022-07-28 23:07:13', 131, 5, 'TXN_SUCCES'),
(247, 131, 'Recharged', '100', '131449171659030665', '2022-07-28 11:21:05', 131, 5, 'TXN_INIT'),
(248, 131, 'Recharged', '100', '131812131659030787', '0000-00-00 00:00:00', 131, 5, 'TXN_SUCCES'),
(249, 131, 'Recharged', '500', '131725381659030870', '2022-07-28 23:24:33', 131, 5, 'TXN_SUCCES'),
(100000, 131, 'Order', '50', '', '2022-07-30 07:49:51', 131, 1, ''),
(100001, 131, 'Order', '50', '', '2022-07-30 07:52:26', 131, 1, ''),
(100002, 131, 'Order', '100', '', '2022-07-30 09:37:17', 131, 1, ''),
(100003, 131, 'Order', '50', '', '2022-07-30 10:45:32', 131, 1, ''),
(100004, 131, 'Order', '50', '', '2022-07-30 11:54:06', 131, 1, ''),
(100005, 131, 'Order', '50', '', '2022-07-31 12:44:59', 131, 1, ''),
(100006, 131, 'Order', '220', '', '2022-07-31 12:48:38', 131, 1, ''),
(100007, 131, 'Order', '50', '', '2022-07-31 12:53:41', 131, 1, ''),
(100008, 131, 'Order', '-100', '', '2022-07-31 01:24:43', 131, 1, ''),
(100009, 131, 'Refunded', '100', '', '2022-07-31 01:27:13', 131, 1, ''),
(100010, 131, 'Refunded', '100', '', '2022-07-31 01:27:15', 131, 1, ''),
(100011, 131, 'Refunded', '100', '', '2022-07-31 01:27:53', 131, 1, ''),
(100012, 131, 'Order', '-50', '', '2022-07-31 01:29:33', 131, 1, ''),
(100013, 131, 'Refunded', '50', '', '2022-07-31 01:30:33', 131, 1, ''),
(100014, 131, 'Order', '-50', '', '2022-07-31 01:31:28', 131, 1, ''),
(100015, 131, 'Refunded', '50', '', '2022-07-31 01:32:03', 131, 1, ''),
(100016, 131, 'Order', '-50', '', '2022-07-31 01:32:30', 131, 1, ''),
(100017, 131, 'Refunded', '50', '', '2022-07-31 01:33:32', 131, 1, ''),
(100018, 131, 'Order', '-50', '', '2022-07-31 01:35:27', 131, 1, ''),
(100019, 131, 'Refunded', '50', '', '2022-07-31 01:36:27', 131, 1, ''),
(100020, 131, 'Order', '-50', '', '2022-07-31 01:40:15', 131, 1, ''),
(100021, 131, 'Refunded', '50', '', '2022-07-31 01:55:15', 131, 1, ''),
(100022, 131, 'Order', '-50', '', '2022-07-31 03:47:51', 131, 1, ''),
(100023, 131, 'Order', '-50', '', '2022-07-31 04:11:21', 131, 1, ''),
(100024, 131, 'Refunded', '50', '', '2022-07-31 04:12:19', 131, 1, ''),
(100025, 131, 'Order', '-50', '', '2022-07-31 04:14:41', 131, 1, ''),
(100026, 131, 'Refunded', '50', '', '2022-07-31 04:14:43', 131, 1, ''),
(100027, 131, 'Order', '-80', '', '2022-07-31 04:15:19', 131, 1, ''),
(100028, 131, 'Refunded', '80', '', '2022-07-31 04:21:16', 131, 1, ''),
(100029, 131, 'Order', '-30', '', '2022-07-31 04:21:32', 131, 1, ''),
(100030, 131, 'Refunded', '30', '', '2022-07-31 04:21:45', 131, 1, ''),
(100031, 131, 'Order', '-50', '', '2022-07-31 08:13:02', 131, 1, ''),
(100032, 131, 'Refunded', '50', '', '2022-07-31 08:13:15', 131, 1, ''),
(100033, 131, 'Order', '-120', '', '2022-07-31 08:16:04', 131, 1, ''),
(100034, 131, 'Refunded', '120', '', '2022-07-31 08:16:17', 131, 1, ''),
(100035, 131, 'Order', '-90', '', '2022-07-31 08:17:12', 131, 1, ''),
(100036, 131, 'Order', '-30', '', '2022-07-31 08:21:57', 131, 1, ''),
(100037, 131, 'Refunded', '30', '', '2022-07-31 08:23:23', 131, 1, ''),
(100038, 131, 'Order', '-30', '', '2022-07-31 08:23:32', 131, 1, ''),
(100039, 131, 'Ordered', '-50', 'I66f4pLV4d7fx2I', '2022-08-02 09:56:43', 131, 1, ''),
(100040, 131, 'Refunded', '50', '', '2022-08-02 09:59:18', 131, 3, ''),
(100041, 131, 'Ordered', '-50', '93KUAPnxYJhawFu', '2022-08-02 09:59:31', 131, 1, ''),
(100042, 131, 'Refunded', '50', '', '2022-08-02 10:52:43', 131, 3, ''),
(100043, 131, 'Ordered', '-50', 'WNSPJyBl3q8TQb2', '2022-08-02 10:52:48', 131, 1, ''),
(100044, 131, 'Refunded', '50', '', '2022-08-02 10:54:24', 131, 3, ''),
(100045, 131, 'Ordered', '-50', 'Tql3HOadwKgK9yU', '2022-08-03 01:51:51', 131, 1, ''),
(100046, 131, 'Refunded', '50', '', '2022-08-03 01:52:00', 131, 3, ''),
(100047, 131, 'Ordered', '-100', 'Up5ibHfBSRnMMjb', '2022-08-03 01:52:08', 131, 1, ''),
(100048, 131, 'Refunded', '100', '', '2022-08-03 05:36:43', 131, 3, ''),
(100049, 100000, 'Recharged', '100', '931291000001660749293', '2022-08-17 08:44:53', 100000, 4, 'TXN_INIT'),
(100050, 100000, 'Recharged', '100', '902451000001660749299', '2022-08-17 08:44:59', 100000, 4, 'TXN_INIT'),
(100051, 100000, 'Recharged', '100', '279091000001660749420', '2022-08-17 08:47:00', 100000, 4, 'TXN_INIT'),
(100052, 100000, 'Recharged', '100', '338461000001660749658', '2022-08-17 08:50:58', 100000, 4, 'TXN_INIT'),
(100053, 132, '9035376766', '-500', '', '2022-08-17 08:52:19', 132, 2, ''),
(100054, 100000, '9876543210', '500', '', '2022-08-17 08:52:19', 132, 2, ''),
(100055, 132, '9035376766', '-100', '', '2022-08-17 08:58:48', 132, 2, ''),
(100056, 100000, '9876543210', '100', '', '2022-08-17 08:58:48', 132, 2, ''),
(100057, 100001, 'Added Manually', '100000', '', '2023-10-05 01:03:39', 1, 4, ''),
(100058, 100001, 'Recharged', '100', '589341000011696506295', '2023-10-05 05:14:55', 100001, 4, 'TXN_INIT'),
(100059, 100002, 'Added Manually', '100000', '', '2023-10-05 05:29:42', 1, 4, ''),
(100060, 100001, 'Ordered', '-110', 'unaJjUPSjVvVLME', '2023-10-05 05:50:08', 100001, 1, ''),
(100061, 100001, 'Refunded', '110', '', '2023-10-05 06:21:05', 100001, 3, ''),
(100062, 100001, 'Ordered', '-30', '3hGawX5QjJgNtU7', '2023-10-05 06:21:10', 100001, 1, ''),
(100063, 100001, 'Refunded', '30', '', '2023-10-05 06:21:51', 100001, 3, ''),
(100064, 100001, 'Ordered', '-30', 'olAYNyWbR8gw9MX', '2023-10-05 06:22:57', 100001, 1, ''),
(100065, 100001, 'Refunded', '30', '', '2023-10-05 06:23:24', 100001, 3, ''),
(100066, 100001, 'Ordered', '-30', 'XXz3bcDM2kU3PX2', '2023-10-05 06:23:41', 100001, 1, ''),
(100067, 100001, 'Refunded', '30', '', '2023-10-05 06:26:17', 100001, 3, ''),
(100068, 100001, 'Ordered', '-30', 'yVn5ldPkElNi5aA', '2023-10-05 06:32:36', 100001, 1, ''),
(100069, 100001, 'Refunded', '30', '', '2023-10-05 06:33:29', 100001, 3, ''),
(100070, 100001, 'Ordered', '-30', '2FVekqZt4PHW0kt', '2023-10-05 06:33:52', 100001, 1, ''),
(100071, 100002, 'Ordered', '-30', '4HMQQ4uXG911CFl', '2023-10-05 07:02:16', 100002, 1, ''),
(100072, 100001, 'Ordered', '-30', 'MpCIrYV1XeGbWex', '2023-10-05 07:26:51', 100001, 1, ''),
(100073, 100001, 'Refunded', '30', '', '2023-10-05 07:45:42', 100001, 3, ''),
(100074, 100001, 'Ordered', '-30', '2GCD9zSqU4zktWi', '2023-10-05 07:46:55', 100001, 1, ''),
(100075, 100001, 'Ordered', '-30', '1tHcpmBgDpgaKSB', '2023-10-05 07:57:50', 100001, 1, ''),
(100076, 100001, 'Ordered', '-30', 'zt3uTRS03PSeBaG', '2023-10-05 08:00:15', 100001, 1, ''),
(100077, 100001, 'Ordered', '-110', 'OuzIv3hy2sGWunX', '2023-10-10 12:17:16', 100001, 1, ''),
(100078, 100001, 'Ordered', '-80', 'jPt1Ayddl1hLgE0', '2023-10-11 02:18:43', 100001, 1, ''),
(100079, 100001, 'Ordered', '-130', 'amtK8rDkRJqWn0p', '2023-10-11 02:58:44', 100001, 1, ''),
(100080, 100001, 'Recharged', '100', '498341000011697021811', '2023-10-11 04:26:51', 100001, 4, 'TXN_INIT'),
(100081, 100001, 'Ordered', '-30', '3s7pcVXkSPSJrye', '2023-10-11 06:11:42', 100001, 1, ''),
(100082, 100001, 'Ordered', '-30', 'nsSHKSG4pzxozEc', '2023-10-11 06:13:49', 100001, 1, ''),
(100083, 100001, 'Ordered', '-30', 'JhdnBHqyCKQBMuD', '2023-10-12 12:40:32', 100001, 1, ''),
(100084, 100001, 'Ordered', '-30', 'DoLbeXSy70BfFMA', '2023-10-12 12:41:09', 100001, 1, ''),
(100085, 100001, 'Ordered', '-50', '4UKq7qLmiK0YnJy', '2023-10-12 02:03:41', 100001, 1, ''),
(100086, 100001, 'Ordered', '-180', '9p9UqgJPs3mKlyI', '2023-10-12 02:10:12', 100001, 1, ''),
(100087, 100001, 'Ordered', '-80', 'cj0d7F0qaQsRVBJ', '2023-10-14 11:08:33', 100001, 1, ''),
(100088, 100001, 'Ordered', '-30', '1DJbwYfKLyn9BI2', '2023-10-30 12:14:14', 100001, 1, ''),
(100089, 100001, 'Ordered', '-20', '08VvCCoX6YSyWHQ', '2023-10-30 12:20:37', 100001, 1, ''),
(100090, 100001, 'Ordered', '-280', 'PYba8kRikhMI6Go', '2023-10-30 12:53:13', 100001, 1, ''),
(100091, 100001, 'Ordered', '-120', 'eHTYWrRq6pkrdWt', '2023-10-30 12:55:25', 100001, 1, ''),
(100092, 100001, 'Ordered', '-430', 'sLmEgqDAaLFwggC', '2023-10-30 12:56:25', 100001, 1, ''),
(100093, 100001, 'Ordered', '-50', 'XRIvBXMO6pZdzGd', '2023-10-31 11:24:31', 100001, 1, ''),
(100094, 100001, 'Ordered', '-50', 'rrOfTEsgoWywGKU', '2023-10-31 12:16:33', 100001, 1, ''),
(100095, 100001, 'Ordered', '-50', 'w9CKPb97XaHa8fS', '2023-10-31 12:29:02', 100001, 1, ''),
(100096, 100001, 'Ordered', '-50', 'cGHV2OFZzqmabcI', '2023-10-31 02:47:22', 100001, 1, ''),
(100097, 100001, 'Ordered', '-30', 'AFYbvkOfHSCX8C0', '2023-10-31 03:31:15', 100001, 1, ''),
(100098, 100001, 'Ordered', '-30', 'jXEb8kAKVtM3TcT', '2023-11-02 10:38:43', 100001, 1, ''),
(100099, 100001, 'Ordered', '-50', 'od2F7cDgeuZnVUM', '2023-11-02 11:30:21', 100001, 1, ''),
(100100, 100001, 'Ordered', '-30', 'V3YpTJjn6rTLgqL', '2023-11-02 11:31:30', 100001, 1, ''),
(100101, 100001, 'Ordered', '-30', 'Y5rH8vVRi0hejlK', '2023-11-02 11:32:33', 100001, 1, ''),
(100102, 100001, 'Ordered', '-30', 'tZPyc4RE1gYo6yj', '2023-11-02 11:34:23', 100001, 1, ''),
(100103, 100001, 'Ordered', '-50', 'H7f5EJRceJ4M8zn', '2023-11-02 11:36:30', 100001, 1, ''),
(100104, 100001, 'Ordered', '-20', 'v1Bwcih4OGpmduC', '2023-11-02 11:37:28', 100001, 1, ''),
(100105, 100001, 'Ordered', '-70', 'sM98e18euuE0QLp', '2023-11-03 08:25:28', 100001, 1, ''),
(100106, 100001, 'Refunded', '20', '', '2023-11-03 08:28:54', 100001, 3, ''),
(100107, 100001, 'Refunded', '30', '', '2023-11-03 08:28:58', 100001, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `user_email` varchar(35) NOT NULL,
  `user_password` varchar(300) NOT NULL,
  `name` varchar(20) NOT NULL,
  `user_phone` varchar(30) NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  `user_photo` varchar(150) NOT NULL,
  `user_delete` tinyint(1) NOT NULL,
  `user_added_date` varchar(20) NOT NULL,
  `user_updated_date` varchar(20) NOT NULL,
  `user_amount` bigint(20) NOT NULL,
  `updated_by_id` bigint(20) NOT NULL,
  `user_token` varchar(255) NOT NULL,
  `user_semaphore` tinyint(1) NOT NULL DEFAULT 0,
  `user_attempts` int(11) NOT NULL,
  `user_login_time` varchar(15) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `name`, `user_phone`, `user_status`, `user_photo`, `user_delete`, `user_added_date`, `user_updated_date`, `user_amount`, `updated_by_id`, `user_token`, `user_semaphore`, `user_attempts`, `user_login_time`) VALUES
(131, 'Balaji@gmail.com', '$2y$10$Sz/BnYaiAvH4gd/AQNDNLuYiu5Iwk7/a0eb3neXy.iF.mfyMMBIMC', 'Balaji', '9108667341', 1, '', 1, '2022-08-17 01:23:34 ', '2022-08-17 07:38:15 ', 9880, 1, '0', 0, 5, '1660844483'),
(132, 'srinivasvk77@gmail.com', '$2y$10$/ZmEF2fQz0JS5PihVlQC5OMsFNrajmEKZdW161jsqcA3OlZUfBBf2', 'srinivas', '9876543210', 1, '132_2022-08-17_1660749819.jpg', 1, '2022-08-17 01:25:55 ', '2022-08-17 08:53:39 ', 410, 1, '420f09387d2bd22b06d2d189928f04', 0, 0, '0'),
(134, 'pppp@gmail.com', '$2y$10$Xr/7cZHgoU/GePK5.WcNSeyO0mK7Shdvu0aBR6KHNDDQXtsLlx47O', 'Pradeep RS', '8660901237', 0, '', 1, '27-07-2022 04:00:51 ', '27-07-2022 04:00:51 ', 43, 0, '', 0, 0, '0'),
(100000, 'darlingbalaji55@gmail.com', '$2y$10$/ZmEF2fQz0JS5PihVlQC5OMsFNrajmEKZdW161jsqcA3OlZUfBBf2', 'balaji', '9035376766', 1, '', 1, '2022-08-17 08:41:59 ', '2022-08-17 08:41:59 ', 600, 0, '0', 0, 0, '0'),
(100001, 'pradeeprs@gmail.com', '$2y$10$ipf8fePZGxWhMIxQOpStI.jwqLdCSiyAbesr7ZEAXyLv4DNGcMfIS', 'pradeep', '7619321936', 1, '', 0, '2023-10-05 05:46:59 ', '2023-10-05 05:46:59 ', 97760, 0, '', 0, 0, '1696508287'),
(100002, 'sandhya@gmail.com', '$2y$10$AUmHjQMvrBtX/euNJdYfD.SqyzsXi9T0MjpdEAoG1P/Fk6kwZW2Wy', 'sandhya', '1234567891', 1, '', 0, '2023-10-05 05:29:42 ', '2023-10-05 05:29:42 ', 99970, 0, '', 0, 0, '0');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `active_users` BEFORE UPDATE ON `users` FOR EACH ROW UPDATE logs SET logs.logs_inactive_users=logs.logs_inactive_users+1 WHERE OLD.user_status=1 AND NEW.user_status=0
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `amount_update` BEFORE UPDATE ON `users` FOR EACH ROW UPDATE logs SET logs_amount=(logs_amount+(NEW.user_amount-OLD.user_amount)) WHERE NEW.user_amount!=OLD.user_amount
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `deleted_users` AFTER UPDATE ON `users` FOR EACH ROW UPDATE logs SET logs_active_users=logs.logs_active_users-1 WHERE NEW.user_delete = 1
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inactive_users` BEFORE UPDATE ON `users` FOR EACH ROW UPDATE logs SET logs.logs_inactive_users=logs.logs_inactive_users-1 WHERE OLD.user_status=0 AND NEW.user_status=1
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inactive_users_on_delete` BEFORE UPDATE ON `users` FOR EACH ROW UPDATE logs SET logs_inactive_users=logs.logs_inactive_users-1 WHERE NEW.user_status = 0 AND NEW.user_delete = 1
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_user` AFTER INSERT ON `users` FOR EACH ROW UPDATE logs SET logs_active_users=logs.logs_active_users+1
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cart_user_id` (`cart_user_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `display_items`
--
ALTER TABLE `display_items`
  ADD PRIMARY KEY (`display_id`),
  ADD KEY `display_item_id` (`display_items_id`);

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
  ADD PRIMARY KEY (`orders_id`),
  ADD KEY `order_user_id` (`orders_user_id`);

--
-- Indexes for table `qr_counter`
--
ALTER TABLE `qr_counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessionss`
--
ALTER TABLE `sessionss`
  ADD PRIMARY KEY (`sessionss_id`),
  ADD KEY `session_user_id` (`sessionss_user_id`);

--
-- Indexes for table `slogan`
--
ALTER TABLE `slogan`
  ADD PRIMARY KEY (`slogan_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `transaction_user_id` (`transaction_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100002;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100107;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100000;

--
-- AUTO_INCREMENT for table `display_items`
--
ALTER TABLE `display_items`
  MODIFY `display_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100002;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `items_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100002;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `qr_counter`
--
ALTER TABLE `qr_counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessionss`
--
ALTER TABLE `sessionss`
  MODIFY `sessionss_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `slogan`
--
ALTER TABLE `slogan`
  MODIFY `slogan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100000;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100108;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100003;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_user_id` FOREIGN KEY (`cart_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `display_items`
--
ALTER TABLE `display_items`
  ADD CONSTRAINT `display_item_id` FOREIGN KEY (`display_items_id`) REFERENCES `items` (`items_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_user_id` FOREIGN KEY (`orders_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `sessionss`
--
ALTER TABLE `sessionss`
  ADD CONSTRAINT `session_user_id` FOREIGN KEY (`sessionss_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_user_id` FOREIGN KEY (`transaction_user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
