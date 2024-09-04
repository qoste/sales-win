-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2024 at 11:10 PM
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
-- Database: `tona_supermarket`
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
(1, 'bv', 'gfdfd', '2024-09-04 23:26:45', 0, 'abebe', 0, '809644816');

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
(1, 'sedfghj', 'fghjm', 'tfghj', 'M', '2022-08-16', '2022-08-26 23:43:06', 1),
(2, 'asrat', 'madebo', 'bunaro', 'M', '2022-08-16', '2022-08-26 23:43:06', 27),
(3, 'sdfghj', 'fgh', 'dfghj', 'male', '2022-08-02', '2022-08-30 14:00:47', 48),
(4, 'DFTGHJKdfghjk', 'jhgfds', 'jhgfds', 'male', '2022-08-22', '2022-08-30 14:03:19', 51),
(5, 'chaltu', 'chala', 'gurmessa', 'male', '2019-05-06', '2022-08-30 15:05:40', 52);

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
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `registered_at`, `total`, `category`, `registered_by_id`, `item_price`, `item_code`, `status`, `description`) VALUES
(2, 'Fruit item', '2024-09-04 22:53:34', 543, 'Fruit', 1, 432, '1863290255', 0, 'lorem ipsum dolor sit amet, consectetur adipis ac magna al met null a ante'),
(3, 'Fruit item 2', '2024-09-04 22:53:34', 543, 'Fruit', 1, 432, '1863290255', 0, 'lorem ipsum dolor sit amet, consectetur adipis ac magna al met null a ante'),
(4, 'this is another item name', '2024-09-05 00:08:49', 300, 'non Gruit', 1, 332, '1010025507', 0, 'this is another item name description');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `amount` float NOT NULL,
  `customer_id` int(11) NOT NULL,
  `transaction_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `item_id`, `created_at`, `amount`, `customer_id`, `transaction_code`) VALUES
(1, 1, '2024-09-04 23:30:12', 100, 1, '5643253465');

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
(1, 'abcd@gmail.com', '0912121212', '[]', '1234', 'abebe', 'bekele', 'gerba', 'male', 1, 1, 1, '2022-08-23 13:40:20', 1),
(5, 'dsfghj2DD@s.dd', '0987654321', NULL, '1234', 'gudeta', 'degefa', 'dfghj', 'male', 1, 1, 1, '2022-08-23 14:38:39', 1),
(18, 'www@s.ss', '52345', NULL, '1234', 'sdfgh', 'sdfgh', 'dfgh', 'male', 1, 1, 1, '2022-08-24 00:21:45', 1),
(19, 'sdfghd@df.dfd', '8765432', NULL, '1234', 'sdfghj', 'sdfljdflkgj', 'sdlgjdfklg', 'female', 2, 1, 1, '2022-08-26 21:55:17', 1),
(21, 'sdfghjhgf@s.sdfg', '+25191212121', NULL, '1234', 'dsfghj', 'sdfghj', 'sdfgh', 'male', 1, 1, 1, '2022-08-28 20:51:55', 1),
(26, 'sdfghjk@dfd.fedg', '0917866556', NULL, '1234', 'sdfghjk', 'dsfghjk', 'dfghjkl', 'male', 1, 1, 1, '2022-08-28 21:08:30', 1),
(27, 'abcde@gmail.com', '0912211221', NULL, '1234', 'asrat', 'madebo', 'bunaro', 'male', 2, 1, 1, '2022-08-28 21:19:19', 1),
(28, 'sdfghj@ff.dfg', '0912345542', NULL, '1234', 'dfghj', 'jhgfd', 'hgfds', 'male', 3, 1, 1, '2022-08-28 21:19:47', 1),
(29, 'nurse@gmail.com', '0912345678', NULL, '1234', 'nurse', 'nurse', 'nurse', 'female', 3, 1, 1, '2022-08-28 21:21:39', 1),
(34, 'hjgfds@gff.ff', '0987654321', NULL, 'i1rqRK', 'dfghjkl', 'sdfghjk', 'sdfghjkl', 'male', 2, 1, 1, '2022-08-30 13:51:49', 1),
(38, 'sdfgh@s.ss', '0987654321', NULL, 'WMcRnZ', 'sdfgh', 'sdfgh', 'dfghj', 'male', 2, 1, 1, '2022-08-30 13:53:55', 1),
(41, 'dfghj@dedfd.d', '0912345678', NULL, 'vQj1d4', 'sdfghjdfg', 'sdfgh', 'sdfghjk', 'male', 2, 1, 1, '2022-08-30 13:58:10', 1),
(42, 'dfghj@ddffedfd.d', '0912345678', NULL, 'd5wvTQ', 'sdfghjdfg', 'sdfgh', 'sdfghjk', 'male', 2, 1, 1, '2022-08-30 13:58:24', 1),
(44, 'sdfghj@dd.ddd', '0987654321', NULL, 'wIcMG8', 'dsfghjk', 'dfghj', 'fghjq', 'male', 2, 1, 1, '2022-08-30 13:59:07', 1),
(45, 'dfghj@dd.dd', '0987654321', NULL, 'yHcIo7', 'wertyu', 'werty', 'ertyu', 'male', 2, 1, 1, '2022-08-30 13:59:47', 1),
(48, 'sdfghj@edd.dd', '0987654321', NULL, 'qURd4H', 'sdfghj', 'fgh', 'dfghj', 'male', 2, 1, 1, '2022-08-30 14:00:47', 1),
(51, 'abbb@gmail.com', '0987654321', NULL, 'jh68Gw', 'DFTGHJKdfghjk', 'jhgfds', 'jhgfds', 'male', 2, 1, 1, '2022-08-30 14:03:19', 1),
(52, 'abcddddd@gmail.com', '0912121212', NULL, 'Bi4K0Q', 'chaltu', 'chala', 'gurmessa', 'male', 2, 1, 1, '2022-08-30 15:05:40', 1),
(53, 'nurse1@gmail.com', '0912121212', NULL, 'RbSzTw', 'nurse1', 'nurse1', 'nurser1', 'female', 3, 1, 1, '2022-08-30 15:19:58', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
