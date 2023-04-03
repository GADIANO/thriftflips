-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 03, 2023 at 08:50 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wbapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_addtocart`
--

CREATE TABLE `tbl_addtocart` (
  `id` int(11) NOT NULL,
  `product_id` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_addtocart`
--

INSERT INTO `tbl_addtocart` (`id`, `product_id`, `quantity`, `status`, `user_id`) VALUES
(12, 10000001, 2, 0, 10000001),
(13, 10000002, 4, 0, 10000001),
(14, 10000008, 3, 0, 10000001);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checkout`
--

CREATE TABLE `tbl_checkout` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_checkout`
--

INSERT INTO `tbl_checkout` (`id`, `product_id`, `user_id`, `quantity`, `total`) VALUES
(1, 10000001, 10000001, 2, 4222),
(2, 10000002, 10000001, 4, 48),
(3, 10000001, 10000001, 2, 4222),
(4, 10000001, 10000001, 2, 4222),
(5, 10000001, 10000001, 2, 4222),
(6, 10000002, 10000001, 4, 48),
(7, 10000001, 10000001, 2, 4222),
(8, 10000002, 10000001, 4, 48),
(9, 10000008, 10000001, 3, 600);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_finish`
--

CREATE TABLE `tbl_finish` (
  `finish_id` int(3) UNSIGNED NOT NULL,
  `trans_id` int(3) NOT NULL DEFAULT 0,
  `user_id` int(3) NOT NULL DEFAULT 0,
  `finish_payment` int(9) NOT NULL DEFAULT 0,
  `finish_date_updated` date NOT NULL,
  `finish_time_updated` time NOT NULL,
  `finish_status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_finish`
--

INSERT INTO `tbl_finish` (`finish_id`, `trans_id`, `user_id`, `finish_payment`, `finish_date_updated`, `finish_time_updated`, `finish_status`) VALUES
(565, 3795, 0, 8000, '2023-03-05', '21:36:32', 1),
(566, 3795, 10000001, 6000, '2023-03-05', '22:34:33', 1),
(567, 3795, 10000001, 8000, '2023-03-05', '22:34:57', 1),
(568, 3795, 10000001, 8000, '2023-03-05', '22:35:48', 1),
(569, 3796, 10000001, 8000, '2023-03-05', '23:05:52', 1),
(570, 3796, 10000002, 3000, '2023-03-06', '14:46:41', 1),
(571, 3796, 10000002, 3131231, '2023-03-06', '14:47:02', 1),
(572, 3795, 10000001, 8000, '2023-03-06', '15:36:52', 1),
(573, 3795, 10000001, 13112, '2023-03-06', '15:44:53', 1),
(574, 3795, 10000002, 8000, '2023-03-06', '15:47:02', 1),
(575, 3796, 10000001, 133, '2023-03-06', '15:48:08', 1),
(576, 3795, 10000002, 8000, '2023-03-06', '15:49:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_order`
--

CREATE TABLE `tbl_job_order` (
  `trans_id` int(8) UNSIGNED NOT NULL,
  `customer_name` varchar(180) NOT NULL DEFAULT '',
  `customer_number` varchar(180) NOT NULL DEFAULT '',
  `job_date_added` date NOT NULL,
  `job_time_added` time NOT NULL,
  `job_date_updated` date NOT NULL,
  `job_time_updated` time NOT NULL,
  `prod_status` int(1) NOT NULL DEFAULT 0,
  `type_id` int(3) NOT NULL DEFAULT 0,
  `job_price` int(9) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_job_order`
--

INSERT INTO `tbl_job_order` (`trans_id`, `customer_name`, `customer_number`, `job_date_added`, `job_time_added`, `job_date_updated`, `job_time_updated`, `prod_status`, `type_id`, `job_price`) VALUES
(3795, 'Kerteezy', '+63', '2023-03-03', '23:24:40', '0000-00-00', '00:00:00', 1, 301, 5000),
(3796, 'K', '+141', '2023-03-03', '23:55:22', '0000-00-00', '00:00:00', 1, 302, 2111);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `prod_id` int(8) UNSIGNED NOT NULL,
  `prod_name` varchar(180) NOT NULL DEFAULT '',
  `prod_description` varchar(180) NOT NULL DEFAULT '',
  `prod_date_added` date NOT NULL,
  `prod_time_added` time NOT NULL,
  `prod_date_updated` date NOT NULL,
  `prod_time_updated` time NOT NULL,
  `prod_status` int(1) NOT NULL DEFAULT 0,
  `type_id` int(3) NOT NULL DEFAULT 0,
  `prod_price` int(9) NOT NULL DEFAULT 0,
  `img` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`prod_id`, `prod_name`, `prod_description`, `prod_date_added`, `prod_time_added`, `prod_date_updated`, `prod_time_updated`, `prod_status`, `type_id`, `prod_price`, `img`, `stock`) VALUES
(10000001, 'Kurt', 'Ass', '2023-03-04', '13:06:11', '0000-00-00', '00:00:00', 1, 301, 2111, 'image1.jpg', 1000),
(10000002, 'Test', 'Test', '2023-04-01', '22:32:53', '0000-00-00', '00:00:00', 1, 301, 12, 'image2.jpg', 1000),
(10000008, 'Final Test', 'This is a final test', '2023-04-03', '14:47:38', '0000-00-00', '00:00:00', 0, 301, 200, 'the-fated-0326-9952932-1.jpg', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_inv`
--

CREATE TABLE `tbl_product_inv` (
  `rec_id` int(8) NOT NULL DEFAULT 0,
  `prod_id` int(8) NOT NULL DEFAULT 0,
  `prod_qty` int(8) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_pricing`
--

CREATE TABLE `tbl_product_pricing` (
  `prod_id` int(8) NOT NULL DEFAULT 0,
  `prod_retail_price` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_qty`
--

CREATE TABLE `tbl_product_qty` (
  `prodqty_id` int(8) UNSIGNED NOT NULL,
  `prodqty_date_added` date NOT NULL,
  `prodqty_time_added` time NOT NULL,
  `prodqty_date_updated` date NOT NULL,
  `prodqty_time_updated` time NOT NULL,
  `prodqty_quantity` int(10) NOT NULL DEFAULT 0,
  `prod_id` int(8) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receive`
--

CREATE TABLE `tbl_receive` (
  `rec_id` int(8) UNSIGNED NOT NULL,
  `rec_supplier` varchar(180) NOT NULL DEFAULT '',
  `rec_description` varchar(180) NOT NULL DEFAULT '',
  `rec_amount` int(10) NOT NULL DEFAULT 0,
  `rec_date_added` date NOT NULL,
  `rec_time_added` time NOT NULL,
  `rec_saved` int(1) NOT NULL DEFAULT 0,
  `rec_status` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_receive`
--

INSERT INTO `tbl_receive` (`rec_id`, `rec_supplier`, `rec_description`, `rec_amount`, `rec_date_added`, `rec_time_added`, `rec_saved`, `rec_status`) VALUES
(10000001, 'K', 'Di', 3000, '2023-03-05', '15:35:44', 0, 1),
(10000002, 'Kurt', 'Ass', 5000, '2023-03-05', '15:39:37', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receive_items`
--

CREATE TABLE `tbl_receive_items` (
  `rec_id` int(8) NOT NULL DEFAULT 0,
  `prod_id` int(8) NOT NULL DEFAULT 0,
  `rec_qty` int(8) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_release`
--

CREATE TABLE `tbl_release` (
  `rel_id` int(8) UNSIGNED NOT NULL,
  `rel_customer` varchar(180) NOT NULL DEFAULT '',
  `rel_description` varchar(180) NOT NULL DEFAULT '',
  `rel_amount` int(10) NOT NULL DEFAULT 0,
  `rel_date_added` date NOT NULL,
  `rel_time_added` time NOT NULL,
  `rel_saved` int(1) NOT NULL DEFAULT 0,
  `rel_status` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_release`
--

INSERT INTO `tbl_release` (`rel_id`, `rel_customer`, `rel_description`, `rel_amount`, `rel_date_added`, `rel_time_added`, `rel_saved`, `rel_status`) VALUES
(10000001, 'K', 'Ambot', 8000, '2023-03-04', '16:26:13', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_release_inv`
--

CREATE TABLE `tbl_release_inv` (
  `rel_id` int(8) NOT NULL DEFAULT 0,
  `prod_id` int(8) NOT NULL DEFAULT 0,
  `prod_qty` int(8) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_release_items`
--

CREATE TABLE `tbl_release_items` (
  `rel_id` int(8) NOT NULL DEFAULT 0,
  `prod_id` int(8) NOT NULL DEFAULT 0,
  `rel_qty` int(8) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE `tbl_type` (
  `type_id` int(3) UNSIGNED NOT NULL,
  `prod_image` varchar(180) NOT NULL DEFAULT '',
  `type_name` varchar(180) NOT NULL DEFAULT '',
  `type_date_added` date NOT NULL,
  `type_time_added` time NOT NULL,
  `type_date_updated` date NOT NULL,
  `type_time_updated` time NOT NULL,
  `type_status` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`type_id`, `prod_image`, `type_name`, `type_date_added`, `type_time_added`, `type_date_updated`, `type_time_updated`, `type_status`) VALUES
(301, '', 'Fix', '2023-03-03', '23:18:46', '0000-00-00', '00:00:00', 1),
(302, '', 'IDK', '2023-03-03', '23:19:03', '0000-00-00', '00:00:00', 1),
(303, '', 'Battery', '2023-03-03', '23:20:27', '0000-00-00', '00:00:00', 1),
(304, '', 'Charger', '2023-03-03', '23:21:25', '0000-00-00', '00:00:00', 1),
(305, '', 'Ayambot', '2023-03-03', '23:22:13', '0000-00-00', '00:00:00', 1),
(306, '', 'Kkk', '2023-03-03', '23:23:51', '0000-00-00', '00:00:00', 1),
(307, '', 'Afasfs', '2023-03-04', '16:26:43', '0000-00-00', '00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(8) UNSIGNED NOT NULL,
  `user_lastname` varchar(180) NOT NULL DEFAULT '',
  `user_firstname` varchar(180) NOT NULL DEFAULT '',
  `user_email` varchar(180) NOT NULL DEFAULT '',
  `user_password` varchar(180) NOT NULL DEFAULT '',
  `user_date_added` date NOT NULL,
  `user_time_added` time NOT NULL,
  `user_date_updated` date NOT NULL,
  `user_time_updated` time NOT NULL,
  `user_status` int(1) NOT NULL DEFAULT 0,
  `user_token` varchar(255) NOT NULL DEFAULT '',
  `user_access` varchar(255) NOT NULL DEFAULT '',
  `prod_image` varchar(180) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_lastname`, `user_firstname`, `user_email`, `user_password`, `user_date_added`, `user_time_added`, `user_date_updated`, `user_time_updated`, `user_status`, `user_token`, `user_access`, `prod_image`) VALUES
(10000001, 'Blasurca', 'Kurt', 'kurt@gmail.com', '123', '2023-03-04', '13:49:58', '0000-00-00', '00:00:00', 1, '', 'Sagay', ''),
(10000002, 'Mendoza', 'Vincent', 'vince@gmail.com', '123', '2023-03-06', '14:41:25', '0000-00-00', '00:00:00', 1, '', 'Eroreco', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_addtocart`
--
ALTER TABLE `tbl_addtocart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_finish`
--
ALTER TABLE `tbl_finish`
  ADD PRIMARY KEY (`finish_id`),
  ADD KEY `trans_id` (`trans_id`,`user_id`);

--
-- Indexes for table `tbl_job_order`
--
ALTER TABLE `tbl_job_order`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `tbl_product_inv`
--
ALTER TABLE `tbl_product_inv`
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `rec_id` (`rec_id`);

--
-- Indexes for table `tbl_product_pricing`
--
ALTER TABLE `tbl_product_pricing`
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `tbl_product_qty`
--
ALTER TABLE `tbl_product_qty`
  ADD PRIMARY KEY (`prodqty_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `tbl_receive`
--
ALTER TABLE `tbl_receive`
  ADD PRIMARY KEY (`rec_id`);

--
-- Indexes for table `tbl_receive_items`
--
ALTER TABLE `tbl_receive_items`
  ADD KEY `rec_id` (`rec_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `tbl_release`
--
ALTER TABLE `tbl_release`
  ADD PRIMARY KEY (`rel_id`);

--
-- Indexes for table `tbl_release_inv`
--
ALTER TABLE `tbl_release_inv`
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `rel_id` (`rel_id`);

--
-- Indexes for table `tbl_release_items`
--
ALTER TABLE `tbl_release_items`
  ADD KEY `rel_id` (`rel_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `tbl_type`
--
ALTER TABLE `tbl_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_addtocart`
--
ALTER TABLE `tbl_addtocart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_finish`
--
ALTER TABLE `tbl_finish`
  MODIFY `finish_id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=577;

--
-- AUTO_INCREMENT for table `tbl_job_order`
--
ALTER TABLE `tbl_job_order`
  MODIFY `trans_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3797;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `prod_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000009;

--
-- AUTO_INCREMENT for table `tbl_product_qty`
--
ALTER TABLE `tbl_product_qty`
  MODIFY `prodqty_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000001;

--
-- AUTO_INCREMENT for table `tbl_receive`
--
ALTER TABLE `tbl_receive`
  MODIFY `rec_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000003;

--
-- AUTO_INCREMENT for table `tbl_release`
--
ALTER TABLE `tbl_release`
  MODIFY `rel_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000002;

--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `type_id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000003;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
