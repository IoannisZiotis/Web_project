-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2017 at 12:47 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `password` varchar(40) NOT NULL,
  `phone_number` int(40) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`password`, `phone_number`, `email`) VALUES
('1234', 261090546, 'george@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `Location` point NOT NULL,
  `Available` enum('yes','no') NOT NULL,
  `Kilometers` int(30) NOT NULL,
  `Salary` int(30) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`Location`, `Available`, `Kilometers`, `Salary`, `Username`, `Password`) VALUES
('\0\0\0\0\0\0\0����C@\0\r�\\�5@', 'yes', 30, 700, 'deliveras', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salary` int(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `AFM` mediumint(30) NOT NULL,
  `AMKA` mediumint(30) NOT NULL,
  `IBAN` varchar(20) NOT NULL,
  `Store_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`username`, `password`, `salary`, `name`, `surname`, `AFM`, `AMKA`, `IBAN`, `Store_name`) VALUES
('managerNot', '1234', 0, 'George', 'Sergianis', 1242356, 5358753, 'GR5432765347563467TH', 'Κατάστημα Νοταρά');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `τυρόπιτα` smallint(5) NOT NULL,
  `χορτόπιτα` smallint(5) NOT NULL,
  `τοστ` smallint(5) NOT NULL,
  `κέικ` smallint(5) NOT NULL,
  `κουλούρι` smallint(5) NOT NULL,
  `ελληνικός` smallint(5) NOT NULL,
  `φραπέ` smallint(5) NOT NULL,
  `εσπρέσο` smallint(5) NOT NULL,
  `καπουτσίνο` smallint(5) NOT NULL,
  `φίλτρου` smallint(5) NOT NULL,
  `address` varchar(20) NOT NULL,
  `number` int(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `delivered` tinyint(1) NOT NULL,
  `Store` varchar(20) NOT NULL,
  `Id` int(11) NOT NULL,
  `Deliver` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`τυρόπιτα`, `χορτόπιτα`, `τοστ`, `κέικ`, `κουλούρι`, `ελληνικός`, `φραπέ`, `εσπρέσο`, `καπουτσίνο`, `φίλτρου`, `address`, `number`, `phone`, `delivered`, `Store`, `Id`, `Deliver`) VALUES
(2, 0, 0, 0, 0, 0, 2, 0, 0, 0, 'Δοιρανης', 13, '2142356', 0, 'Κατάστημα Νοταρά', 1, 'deliveras');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Type` enum('τυρόπιτα','τοστ','κέικ','κουλούρι','χορτόπιτα','ελληνικός','φραπέ','εσπρέσο','καπουτσίνο','φίλτρου') NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(10) NOT NULL,
  `Store` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Type`, `Price`, `Quantity`, `Store`) VALUES
('τυρόπιτα', 1.2, 100, 'Κατάστημα Νοταρά'),
('τοστ', 1.5, 50, 'Κατάστημα Νοταρά');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `Store_name` varchar(25) NOT NULL,
  `Adress` varchar(25) NOT NULL,
  `Adress_number` int(11) NOT NULL,
  `Location` point NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`Store_name`, `Adress`, `Adress_number`, `Location`) VALUES
('Κατάστημα Νοταρά', 'Νοταρά', 25, '\0\0\0\0\0\0\0�>e�!C@xNi���5@');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`AFM`),
  ADD UNIQUE KEY `Store` (`Store_name`),
  ADD KEY `Store_name` (`Store_name`),
  ADD KEY `Store_2` (`Store_name`),
  ADD KEY `Store_name_2` (`Store_name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `store` (`Store`),
  ADD KEY `assignment` (`Deliver`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD KEY `Store` (`Store`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`Store_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `Cancer` FOREIGN KEY (`Store_name`) REFERENCES `store` (`Store_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `Employee` FOREIGN KEY (`Deliver`) REFERENCES `delivery` (`Username`),
  ADD CONSTRAINT `Store` FOREIGN KEY (`Store`) REFERENCES `store` (`Store_name`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `φοοδ` FOREIGN KEY (`Store`) REFERENCES `store` (`Store_name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
