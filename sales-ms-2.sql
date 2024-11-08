-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2024 at 12:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales-ms`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_anonymous` tinyint(4) NOT NULL,
  `commented_by` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `comment_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `title`, `content`, `created_at`, `is_anonymous`, `commented_by`, `status`, `comment_code`) VALUES
(2, 'purity of water', 'purity of water is not such desired please work on it', '2024-11-06 23:14:00', 0, 'Feleke', 0, '1022915638');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `birth_date` date NOT NULL,
  `registered_at` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `middle_name`, `last_name`, `gender`, `birth_date`, `registered_at`, `user_id`) VALUES
(6, 'Customer', 'test', 'user', 'male', '2018-01-02', '2024-11-06 23:16:32', 55),
(7, 'customer2', 'test2', 'test2', 'male', '2024-11-05', '2024-11-06 23:19:12', 56);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `registered_at` datetime NOT NULL DEFAULT current_timestamp(),
  `total` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `registered_by_id` int(11) NOT NULL,
  `item_price` float NOT NULL,
  `item_code` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `description` text NOT NULL,
  `expiry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `registered_at`, `total`, `category`, `registered_by_id`, `item_price`, `item_code`, `status`, `description`, `expiry_date`) VALUES
(5, '2 litre', '2024-11-06 22:58:30', 5, 'Water', 1, 20, '908135129', 0, 'this is the description', '2024-11-07'),
(6, '1/2 liter', '2024-11-06 23:06:39', 8, 'Water', 54, 160, '1595242186', 0, 'drinkable water', '2024-10-29');

-- --------------------------------------------------------

--
-- Table structure for table `item_types`
--

CREATE TABLE `item_types` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `registered_at` datetime NOT NULL DEFAULT current_timestamp(),
  `min_target` int(11) NOT NULL,
  `max_target` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `registered_by_id` int(11) NOT NULL,
  `item_type_code` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_types`
--

INSERT INTO `item_types` (`id`, `name`, `registered_at`, `min_target`, `max_target`, `category`, `registered_by_id`, `item_type_code`, `status`, `description`) VALUES
(7, '5 litre', '2024-11-09 02:36:33', 10, 1000, 'Water', 1, '2146906058', 0, 'desc');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `item_price` float NOT NULL,
  `ordered_at` datetime NOT NULL DEFAULT current_timestamp(),
  `ordered_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `order_code` varchar(20) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `item_id`, `quantity`, `item_price`, `ordered_at`, `ordered_by`, `status`, `order_code`, `parent_id`) VALUES
(18, 6, 3, 160, '2024-11-09 02:35:42', 1, 0, '1560971698', 14);

-- --------------------------------------------------------

--
-- Table structure for table `orders_parent`
--

CREATE TABLE `orders_parent` (
  `id` int(11) NOT NULL,
  `approved_by` varchar(200) DEFAULT NULL,
  `item_count` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `ordered_at` datetime NOT NULL DEFAULT current_timestamp(),
  `ordered_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `order_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_parent`
--

INSERT INTO `orders_parent` (`id`, `approved_by`, `item_count`, `total_price`, `ordered_at`, `ordered_by`, `status`, `order_code`) VALUES
(14, 'Feleke Dingato', 3, 480, '2024-11-09 02:35:42', 1, 2, '1912661339');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `total_price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `transaction_code` varchar(20) NOT NULL,
  `processed_by` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `created_at`, `total_price`, `quantity`, `customer_id`, `transaction_code`, `processed_by`) VALUES
(6, '2024-11-09 02:35:48', 480, 3, 1, '1574469963', 'Feleke Dingato');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `registered_by_id` int(11) DEFAULT NULL,
  `registered_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_verified` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `phone`, `roles`, `password`, `first_name`, `middle_name`, `last_name`, `gender`, `user_type_id`, `is_active`, `registered_by_id`, `registered_at`, `is_verified`) VALUES
(1, 'felekedingato05@gmail.com', '0912121212', '[]', '1234', 'Feleke', 'Dingato', 'Lastname', 'male', 1, 1, 1, '2022-08-23 13:40:20', 1),
(54, 'abc@gmail.com', '+251947470098', NULL, 'jet7e4', 'first', 'middle', 'ijkl', 'male', 3, 1, 1, '2024-11-06 22:56:24', 1),
(55, 'customer@gmail.com', '+251947470097', NULL, '12345', 'Customer', 'test', 'user', 'male', 2, 1, 1, '2024-11-06 23:16:32', 1),
(56, 'customer2@gmail.com', '+251947470099', NULL, '12345', 'customer2', 'test2', 'test2', 'male', 2, 1, 1, '2024-11-06 23:19:12', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_types`
--
ALTER TABLE `item_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_parent`
--
ALTER TABLE `orders_parent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item_types`
--
ALTER TABLE `item_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders_parent`
--
ALTER TABLE `orders_parent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
