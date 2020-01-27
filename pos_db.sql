-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2020 at 10:39 AM
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
-- Database: `pos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_employee`
--

CREATE TABLE `tb_employee` (
  `emp_id` int(3) NOT NULL,
  `emp_name` varchar(50) DEFAULT NULL,
  `emp_pass` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_employee`
--

INSERT INTO `tb_employee` (`emp_id`, `emp_name`, `emp_pass`) VALUES
(1, 'admin', '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G'),
(2, 'thida', '$2y$10$maK.BiaZnxh.pC2CpG5.eu4pJPWHP7XbKu1vPb4ljJvLUxTukfU5G');

-- --------------------------------------------------------

--
-- Table structure for table `tb_item`
--

CREATE TABLE `tb_item` (
  `item_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `item_name` varchar(150) DEFAULT NULL,
  `item_price` int(11) DEFAULT NULL,
  `item_unit` int(3) UNSIGNED ZEROFILL DEFAULT NULL,
  `item_stock` int(11) DEFAULT NULL,
  `item_orderpoint` int(11) DEFAULT NULL,
  `item_balance` int(11) DEFAULT NULL,
  `item_barcode` text DEFAULT NULL,
  `item_date` datetime DEFAULT NULL,
  `item_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_item_receive`
--

CREATE TABLE `tb_item_receive` (
  `receive_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `receive_item` varchar(5) DEFAULT NULL,
  `receive_bill` varchar(100) DEFAULT NULL,
  `receive_price` int(10) DEFAULT NULL,
  `receive_amount` int(10) DEFAULT NULL,
  `receive_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `receive_emp` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_item_unit`
--

CREATE TABLE `tb_item_unit` (
  `unit_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `unit_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_item_unit`
--

INSERT INTO `tb_item_unit` (`unit_id`, `unit_name`) VALUES
(001, 'ซอง'),
(002, 'ขวด'),
(003, 'กระป๋อง'),
(004, 'กล่อง'),
(005, 'เล่ม'),
(006, 'ด้าม'),
(007, 'ชิ้น');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `order_date` timestamp NULL DEFAULT current_timestamp(),
  `order_income` int(10) DEFAULT NULL,
  `emp_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_list`
--

CREATE TABLE `tb_order_list` (
  `list_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `list_qty` int(5) DEFAULT NULL,
  `list_barcode` text DEFAULT NULL,
  `order_id` int(5) UNSIGNED ZEROFILL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_employee`
--
ALTER TABLE `tb_employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `tb_item`
--
ALTER TABLE `tb_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tb_item_receive`
--
ALTER TABLE `tb_item_receive`
  ADD PRIMARY KEY (`receive_id`);

--
-- Indexes for table `tb_item_unit`
--
ALTER TABLE `tb_item_unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tb_order_list`
--
ALTER TABLE `tb_order_list`
  ADD PRIMARY KEY (`list_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_employee`
--
ALTER TABLE `tb_employee`
  MODIFY `emp_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_item`
--
ALTER TABLE `tb_item`
  MODIFY `item_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_item_receive`
--
ALTER TABLE `tb_item_receive`
  MODIFY `receive_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_item_unit`
--
ALTER TABLE `tb_item_unit`
  MODIFY `unit_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `order_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_order_list`
--
ALTER TABLE `tb_order_list`
  MODIFY `list_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
