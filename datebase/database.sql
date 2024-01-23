-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 03:58 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipl`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint(20) NOT NULL,
  `admin_email` varchar(1100) NOT NULL,
  `admin_password` varchar(2000) NOT NULL,
  `admin_name` varchar(1100) NOT NULL,
  `admin_phone` bigint(50) NOT NULL,
  `admin_photo` varchar(5000) NOT NULL,
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
  `orders_view` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `admin_phone`, `admin_photo`, `admin_dob`, `admin_status`, `users_view`, `users_create`, `users_edit`, `users_del`, `admin_view`, `admin_create`, `admin_edit`, `admin_del`, `items_view`, `items_create`, `items_edit`, `items_del`, `users_special`, `admin_special`, `contact_view`, `contact_edit`, `message_view`, `admin_delete`, `admin_added_date`, `admin_updated_date`, `display_items_view`, `display_items_edit`, `display_items_create`, `display_items_del`, `history_view`, `orders_view`) VALUES
(1, 'admin@admin.com', '$2y$10$tlJ7HiO6SfJcqzd0sztEgePf0Pl1GNHxcxkv36kppNjnesT8og7M.', 'Elon', 96969696, '', '2020-11-10', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, '2021-01-04', '21-03-2022 03:31:31 ', 1, 1, 1, 1, 1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` bigint(20) NOT NULL,
  `contact_name` varchar(2000) NOT NULL,
  `contact_email` varchar(2000) NOT NULL,
  `contact_phone` varchar(100) NOT NULL,
  `contact_country` varchar(200) NOT NULL,
  `contact_subject` varchar(20000) NOT NULL,
  `contact_view` tinyint(1) NOT NULL,
  `contact_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `display_items`
--

INSERT INTO `display_items` (`display_id`, `display_items_id`, `display_items_add_date`, `display_items_updated_date`, `display_spring_id`, `display_items_qty`) VALUES
(1, 2, '', '21-03-2022 02:29:57 ', 7, 5),
(2, 2, '', '21-03-2022 02:30:02 ', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` bigint(20) NOT NULL,
  `history_qty` varchar(100) NOT NULL,
  `history_cost` varchar(100) NOT NULL,
  `history_item` varchar(100) NOT NULL,
  `history_date` varchar(20) NOT NULL,
  `history_delivered` int(11) NOT NULL DEFAULT 0,
  `history_user_id` bigint(20) NOT NULL,
  `date_history` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `history_qty`, `history_cost`, `history_item`, `history_date`, `history_delivered`, `history_user_id`, `date_history`) VALUES
(5, '2,3', '30,10', '1,2', '2022-03-12 23:01:56', 0, 110, '2022-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `items_id` bigint(20) NOT NULL,
  `items_name` varchar(5010) NOT NULL,
  `items_image` varchar(1000) NOT NULL,
  `items_cost` bigint(20) NOT NULL,
  `items_delete` tinyint(1) NOT NULL,
  `items_add_date` varchar(20) NOT NULL,
  `items_updated_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`items_id`, `items_name`, `items_image`, `items_cost`, `items_delete`, `items_add_date`, `items_updated_date`) VALUES
(1, 'brike', '2022-03-02_1646238597.jpg', 20, 1, '2022-03-02 21:59:57', ''),
(2, 'brike2', '2022-03-02_1646240376.jpg', 30, 0, '2022-03-02 22:08:54', '21-03-2022 02:29:38 ');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(20) NOT NULL,
  `message` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `message`) VALUES
(1, ' '),
(2, '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` bigint(20) NOT NULL,
  `orders_qty` varchar(100) NOT NULL,
  `orders_cost` varchar(100) NOT NULL,
  `orders_items` varchar(100) NOT NULL,
  `orders_otp` varchar(20) NOT NULL,
  `orders_user_id` bigint(20) NOT NULL,
  `orders_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `orders_qty`, `orders_cost`, `orders_items`, `orders_otp`, `orders_user_id`, `orders_date`) VALUES
(9, '1', '30', '2', '6927', 110, '21-03-2022 02:47:04 ');

-- --------------------------------------------------------

--
-- Table structure for table `semopher`
--

CREATE TABLE `semopher` (
  `semopher_id` int(11) NOT NULL,
  `semopher_value` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semopher`
--

INSERT INTO `semopher` (`semopher_id`, `semopher_value`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` bigint(20) NOT NULL,
  `transaction_user_id` bigint(20) NOT NULL,
  `transaction_send_to` varchar(1100) NOT NULL,
  `transaction_amount` varchar(2000) NOT NULL,
  `transaction_method` varchar(2000) NOT NULL,
  `transaction_date` varchar(20) NOT NULL,
  `transaction_added_by` bigint(20) NOT NULL,
  `transaction_type` int(11) NOT NULL,
  `date_transaction` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `transaction_user_id`, `transaction_send_to`, `transaction_amount`, `transaction_method`, `transaction_date`, `transaction_added_by`, `transaction_type`, `date_transaction`) VALUES
(1, 110, 'wedfgbhn', '10', 'Ordered', '2022-03-12 15:30:41', 110, 2, '2022-03-21'),
(2, 110, 'Added Manually', '50', 'add amount', '21-03-2022 02:46:02 ', 1, 0, '2022-03-21'),
(3, 110, 'Order', '30', 'Ordered', '21-03-2022 02:47:04 ', 110, 1, '2022-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `user_email` varchar(5000) NOT NULL,
  `user_password` varchar(5000) NOT NULL,
  `name` varchar(500) NOT NULL,
  `user_phone` varchar(50) NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  `user_photo` varchar(2000) NOT NULL,
  `user_delete` tinyint(1) NOT NULL,
  `user_added_date` varchar(20) NOT NULL,
  `user_updated_date` varchar(20) NOT NULL,
  `user_amount` bigint(20) NOT NULL,
  `updated_by_id` bigint(20) NOT NULL,
  `user_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `name`, `user_phone`, `user_status`, `user_photo`, `user_delete`, `user_added_date`, `user_updated_date`, `user_amount`, `updated_by_id`, `user_code`) VALUES
(110, '123@admin.com', '$2y$10$Ri7ZqKZQzVVmTLML7U2uQekzQD0Z9Ib3E87fkZUs6i59cpn3wdqXW', 'qwertyu', '1234', 1, '', 0, '2022-03-12', '0000-00-00 00:00:00', 30, 1, '0');

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
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `display_items`
--
ALTER TABLE `display_items`
  ADD PRIMARY KEY (`display_id`);

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
-- Indexes for table `semopher`
--
ALTER TABLE `semopher`
  ADD PRIMARY KEY (`semopher_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

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
  MODIFY `admin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `display_items`
--
ALTER TABLE `display_items`
  MODIFY `display_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `items_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `semopher`
--
ALTER TABLE `semopher`
  MODIFY `semopher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
