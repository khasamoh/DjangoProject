-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2022 at 09:26 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kidoti_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `CsID` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`CsID`, `fname`, `lname`, `gender`, `address`, `phone`) VALUES
(1, 'Temp', 'Temp', 'Temp', 'Temp', '0773274743'),
(2, 'Khamis', 'Mohd', 'Male', 'Amani', '+886779878765'),
(3, 'Habil', 'Juma', 'Male', 'Kimara', '0779878765');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `PrID` int(11) NOT NULL,
  `PrName` varchar(70) NOT NULL,
  `Buyprice` int(11) NOT NULL,
  `Saleprice` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`PrID`, `PrName`, `Buyprice`, `Saleprice`, `Quantity`, `user_id`) VALUES
(1, 'Rasta', 3000, 4000, 8, 1),
(2, 'Mfuta', 2000, 2500, 92, 1),
(3, 'Surual', 20000, 28000, 114, 1),
(4, 'Lotion', 7000, 15000, 24, 1),
(5, 'Kibanio', 2000, 2500, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale`
--

CREATE TABLE `tbl_sale` (
  `SaleID` int(11) NOT NULL,
  `PrID` int(11) NOT NULL,
  `CsID` int(11) NOT NULL,
  `SaleQuantity` int(11) NOT NULL,
  `Discount` int(11) NOT NULL,
  `payment` varchar(5) NOT NULL,
  `SaleDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sale`
--

INSERT INTO `tbl_sale` (`SaleID`, `PrID`, `CsID`, `SaleQuantity`, `Discount`, `payment`, `SaleDate`) VALUES
(1, 1, 1, 3, 0, 'Yes', '2022-02-02'),
(2, 1, 1, 5, 500, 'Yes', '2022-02-02'),
(3, 1, 1, 8, 0, 'Yes', '2022-02-06'),
(4, 2, 1, 3, 400, 'Yes', '2022-02-06'),
(5, 3, 1, 4, 1000, 'Yes', '2022-02-06'),
(6, 2, 1, 1, 0, 'Yes', '2022-02-06'),
(7, 3, 1, 2, 2000, 'Yes', '2022-02-06'),
(8, 1, 1, 2, 0, 'Yes', '2022-02-06'),
(9, 2, 1, 5, 0, 'Yes', '2022-02-06'),
(10, 4, 2, 15, 0, 'Yes', '2022-02-07'),
(11, 2, 2, 5, 500, 'Yes', '2022-02-07'),
(12, 3, 3, 2, 0, 'Yes', '2022-02-18'),
(13, 2, 3, 3, 0, 'Yes', '2022-02-23'),
(14, 4, 1, 4, 0, 'No', '2022-02-23'),
(15, 3, 1, 2, 0, 'Yes', '2022-02-25'),
(16, 3, 1, 1, 1000, 'Yes', '2022-02-25'),
(17, 4, 1, 3, 500, 'Yes', '2022-02-27'),
(18, 4, 3, 5, 0, 'Yes', '2022-02-27'),
(19, 5, 1, 2, 0, 'Yes', '2022-02-27'),
(20, 5, 1, 3, 0, 'Yes', '2022-02-27'),
(21, 5, 3, 2, 0, 'Yes', '2022-04-13'),
(22, 4, 1, 20, 5000, 'Yes', '2022-04-13'),
(23, 3, 3, 3, 0, 'Yes', '2022-04-13'),
(24, 2, 3, 3, 0, 'No', '2022-04-21'),
(25, 2, 2, 5, 1000, 'Yes', '2022-04-21'),
(26, 4, 1, 3, 0, 'Yes', '2022-04-21'),
(27, 4, 2, 4, 0, 'Yes', '2022-04-21'),
(28, 3, 2, 2, 0, 'Yes', '2022-06-21'),
(29, 4, 1, 3, 500, 'Yes', '2022-06-21'),
(30, 4, 1, 1, 0, 'Yes', '2022-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `privilage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `fname`, `lname`, `email`, `phone`, `username`, `user_password`, `privilage`) VALUES
(1, 'Khamis', 'Mohd', 'khasamoh.12@gmail.com', '0773274743', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrator'),
(2, 'Ali', 'Haji', 'ali.12@gmail.com', '0773274743', 'saler', '202cb962ac59075b964b07152d234b70', 'Saler'),
(3, 'Akram', 'Mohd', 'akram.12@gmail.com', '+886779878765', 'testA', 'c20ad4d76fe97759aa27a0c99bff6710', 'Administrator'),
(4, 'Ayoub', 'Ali', 'ohdg.12@gmail.com', '0775296740', 'testS', 'c20ad4d76fe97759aa27a0c99bff6710', 'Saler'),
(5, 'Asha', 'Juma', 'akram.12@gmail.com', '+886779878765', 'ff', 'c51ce410c124a10e0db5e4b97fc2af39', 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`CsID`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`PrID`),
  ADD KEY `fk1` (`user_id`);

--
-- Indexes for table `tbl_sale`
--
ALTER TABLE `tbl_sale`
  ADD PRIMARY KEY (`SaleID`),
  ADD KEY `fk2` (`PrID`),
  ADD KEY `fk3` (`CsID`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `CsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `PrID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_sale`
--
ALTER TABLE `tbl_sale`
  MODIFY `SaleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_sale`
--
ALTER TABLE `tbl_sale`
  ADD CONSTRAINT `fk2` FOREIGN KEY (`PrID`) REFERENCES `tbl_product` (`PrID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk3` FOREIGN KEY (`CsID`) REFERENCES `tbl_customer` (`CsID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
