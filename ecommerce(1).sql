-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2019 at 11:11 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `realName` varchar(100) NOT NULL,
  `phoneNumber` int(20) NOT NULL,
  `userType` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`, `realName`, `phoneNumber`, `userType`) VALUES
(1, 'test', 'root', 'edtest@kappa.com', 'EdUser', 123123123, 'Buyer'),
(2, '', '', '', '', 0, 'Buyer'),
(3, 'Natasha', '$2y$10$aW9GdOGPEG9Wm8lKDHZW5OK5fXDtDhUHnK/X4kdeTP81amQrg/pOK', 'nadasha@gmail.com', 'Naytasha', 123123123, 'Seller'),
(4, 'Jay', '$2y$10$.W5NE/6Pyhv7f3MWS5mSEOjAr6uJAP3BlFesVh221ApFxCnPSnPdS', 'jaytianyu@outlook.com', 'Zhong Tian Yu', 15123125, 'Seller'),
(5, 'ghghghhgfghfgfh', '$2y$10$nYOMqQtXrMPsQd2wZ/o9b.1TdEUo3kdVFaHLiwua0enOSW0HD1z0.', 'edbertthegreat@greatmail.com', 'Yulius Faustinus Edbert', 123123123, 'Seller'),
(6, 'EdbertTheGreat', '$2y$10$r5NevCJ.moJImqm3w5SdNuvVw9ojnykurHtPM4GWR7RrN.UUYdYnO', 'EdbertTheGreat@greatmail.com', 'Edbert The Great', 1111111, 'Seller'),
(7, 'JayTheGay', '$2y$10$fEF/CJzO.tduGkIrUMu3YuY9iPfj3SqJXw2MHjBqcw8EIOepGg1k2', 'JayTheGay@gaymail.com', 'The Gayest Gay Lord', 123123123, 'Seller'),
(8, 'EdBuyer', '$2y$10$HW7yoaEsRNRUDQwFBiX0hOy.Mj7iVhj/sISWOw5uEp1HL9EGz7Mjy', 'ebduyer@buyer.com', 'Edbert', 123123123, 'Buyer'),
(9, 't1', '$2y$10$EDDly1ZgcAwL6h9CVxrEA.j.qsXzYYhKjYMqEhUYllZo8c3COg2g2', 'teacher@teaching.com', 'Teacher Girl', 123123123, 'Seller'),
(10, 'tbuy', '$2y$10$20dE.lqXlUy6/ONYz1gGAO/bFfXertNpcTdQqlozJQEeljSKHQSG6', 'tbuy@buy.com', 'buyer', 122211111, 'Buyer'),
(11, 'teacher', '$2y$10$3o1LzDJ17tGDqjcYjgbL9.PeKpVmdUoxKAAvSDj8YRvOZl/4HdlM6', 'teacher_new@gmail.com', 'Teacher', 123123123, 'Seller'),
(12, 'teacherbuy', '$2y$10$T2/n475pXutonfEOKvYy6OInem4ByJAlx1UxzCRpMxxWIYV5zzwG6', 'teacherbuy@buy.com', 'teacherbuy', 123123, 'Buyer');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `productID` int(11) NOT NULL,
  `buyerID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`productID`, `buyerID`, `orderID`) VALUES
(13, 12, 4523760),
(17, 12, 4523760);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `sellerName` varchar(200) NOT NULL,
  `productName` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `img` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sellerName`, `productName`, `description`, `price`, `quantity`, `img`, `date_added`) VALUES
(6, 'fakeTestUser', 'iPhone 11 128GB BLACK COLOUR, STILL IN GOOD CONDITION', '<p>Brand new iPhone 11 only used once, selling it because getting the new Xiaomi Phone. </p>', '8000.00', 10, 'iphone.jpg', '2019-12-17 00:00:00'),
(7, 'EdbertTheGreat', 'Kornet Imported  Indonesian Canned Beef Spam Healthy and Delicious', '<p>Imported high quality product from Indonesia crafted with love brought to you here to China. </p>', '20.00', 100, 'kornet.jpg', '2019-12-19 04:24:23'),
(9, 'EdbertTheGreat', 'TEST PRODUCT!!!!', 'NEW PRODUCT WOOHOOO', '99.99', 100, 'washing.jpg', '2019-12-20 07:41:00'),
(10, 'EdbertTheGreat', 'Bikes', 'SUPER WARM', '999.99', 50, 'bike.jpg', '2019-12-20 12:39:00'),
(11, 'EdbertTheGreat', 'Bike', 'More Bike', '99999.99', 100, 'bike.jpg', '2019-12-20 12:40:00'),
(12, 'EdbertTheGreat', 'Bikerino', 'Awesome Test Product! Totally not Dangerous', '1000.00', 20, 'bike.jpg', '2019-12-20 12:40:00'),
(13, 'EdbertTheGreat', 'Beef', 'Canned Beef', '100.00', 20, 'kornet.jpg', '2019-12-20 12:41:00'),
(14, 'EdbertTheGreat', 'Korneto', 'kornet beef', '1000.00', 100, 'kornet.jpg', '2019-12-20 12:41:00'),
(16, 'JayTheGay', 'Apple AirPod Pro', 'Now you can only hear people in rich!', '2500.00', 1000, 'airpods.jpg', '2019-12-21 02:15:00'),
(17, 'EdbertTheGreat', 'Apple Airpod Extra Pro', 'FLEXXXX', '1000.25', 99, 'airpods.jpg', '2019-12-21 03:08:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
