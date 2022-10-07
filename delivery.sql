-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 20 Φεβ 2018 στις 20:00:34
-- Έκδοση διακομιστή: 10.1.30-MariaDB
-- Έκδοση PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `delivery`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `customer`
--

CREATE TABLE `customer` (
  `password` varchar(40) NOT NULL,
  `phone_number` double NOT NULL,
  `email` varchar(50) NOT NULL,
  `Address` text NOT NULL,
  `Address_number` int(10) NOT NULL,
  `City` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `customer`
--

INSERT INTO `customer` (`password`, `phone_number`, `email`, `Address`, `Address_number`, `City`) VALUES
('1234', 2610905463, 'george@gmail.com', 'Pantanassis', 34, 'Patra'),
('1234', 698546732, 'panos@gmail.com', 'Φειδίου', 28, 'Πάτρα');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `delivery`
--

CREATE TABLE `delivery` (
  `Location` point NOT NULL,
  `Available` enum('yes','no') NOT NULL,
  `Kilometers` float NOT NULL DEFAULT '0',
  `Salary` int(30) NOT NULL DEFAULT '0',
  `Username` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Time_start` time(6) NOT NULL,
  `AFM` varchar(60) NOT NULL,
  `AMKA` varchar(60) NOT NULL,
  `IBAN` varchar(30) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `delivery`
--

INSERT INTO `delivery` (`Location`, `Available`, `Kilometers`, `Salary`, `Username`, `Password`, `Time_start`, `AFM`, `AMKA`, `IBAN`, `name`, `surname`) VALUES
('\0\0\0\0\0\0\0����!C@�O���5@', 'no', 22.5, 700, 'deliveras', '1234', '20:31:36.000000', '1345697658', '25476676554', '13245367385348538393534', 'Χρήστος', 'Ανδρέου'),
('\0\0\0\0\0\0\0:��slC@��ƻ5@', 'no', 0, 10, 'user1', '1234', '12:08:10.000000', '4679855', '167946789', '12343253464574365523432454', 'Γιώργος', 'Καραγιώργος');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `manager`
--

CREATE TABLE `manager` (
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salary` int(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `AFM` varchar(60) NOT NULL,
  `AMKA` varchar(60) NOT NULL,
  `IBAN` varchar(30) NOT NULL,
  `Store_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `manager`
--

INSERT INTO `manager` (`username`, `password`, `salary`, `name`, `surname`, `AFM`, `AMKA`, `IBAN`, `Store_name`) VALUES
('managerNot', '1234', 0, 'Γιώργος', 'Χρήστου', '134623467', '5358753453', '754354327653475634676432', 'Κατάστημα Νοταρά');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `orders`
--

CREATE TABLE `orders` (
  `τυρόπιτα` smallint(5) NOT NULL,
  `χορτόπιτα` smallint(5) NOT NULL,
  `τόστ` smallint(5) NOT NULL,
  `κέικ` smallint(5) NOT NULL,
  `κουλούρι` smallint(5) NOT NULL,
  `ελληνικός` smallint(5) NOT NULL,
  `φραπέ` smallint(5) NOT NULL,
  `εσπρέσο` smallint(5) NOT NULL,
  `καπουτσίνο` smallint(5) NOT NULL,
  `φίλτρου` smallint(5) NOT NULL,
  `delivered` tinyint(1) NOT NULL,
  `Store` varchar(20) NOT NULL,
  `Id` int(11) NOT NULL,
  `Deliver` varchar(30) DEFAULT NULL,
  `Customer` varchar(30) NOT NULL,
  `price` float NOT NULL,
  `Year` int(20) NOT NULL DEFAULT '0',
  `Month` int(10) NOT NULL DEFAULT '0',
  `Day` int(5) NOT NULL,
  `Km` int(25) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `orders`
--

INSERT INTO `orders` (`τυρόπιτα`, `χορτόπιτα`, `τόστ`, `κέικ`, `κουλούρι`, `ελληνικός`, `φραπέ`, `εσπρέσο`, `καπουτσίνο`, `φίλτρου`, `delivered`, `Store`, `Id`, `Deliver`, `Customer`, `price`, `Year`, `Month`, `Day`, `Km`) VALUES
(1, 1, 1, 0, 1, 1, 1, 1, 0, 0, 1, 'κτελ', 86, 'deliveras', 'panos@gmail.com', 4.2, 2018, 2, 19, 1),
(1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 'physiq', 87, 'user1', 'george@gmail.com', 4.5, 2018, 2, 19, 6),
(1, 1, 0, 0, 0, 1, 1, 1, 0, 0, 1, 'κτελ', 88, 'deliveras', 'panos@gmail.com', 3.4, 2018, 2, 19, 1),
(0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 'κτελ', 89, 'user1', 'george@gmail.com', 3.4, 2018, 2, 19, 8),
(13, 0, 0, 13, 2, 1, 1, 1, 1, 1, 1, 'Κατάστημα Νοταρά', 90, 'deliveras', 'george@gmail.com', 10000, 2018, 2, 19, 1000),
(1, 1, 0, 0, 0, 1, 1, 1, 0, 0, 1, 'κτελ', 91, 'deliveras', 'panos@gmail.com', 1, 2018, 2, 20, 1),
(1, 1, 0, 0, 0, 1, 1, 1, 0, 0, 1, 'κτελ', 94, 'deliveras', 'panos@gmail.com ', 2.3, 2018, 2, 20, 5),
(1, 1, 0, 0, 0, 0, 1, 1, 0, 0, 1, 'physiq', 95, 'deliveras', 'panos@gmail.com', 4.5, 2018, 2, 20, 1),
(1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'physiq', 96, 'deliveras', 'panos@gmail.com', 2.4, 2018, 2, 20, 2);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `prices`
--

CREATE TABLE `prices` (
  `price` float NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL,
  `name` varchar(10) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `prices`
--

INSERT INTO `prices` (`price`, `id`, `name`) VALUES
(1, 1, 'Τυρόπιτα'),
(1.4, 2, 'Χορτόπιτα'),
(1.4, 3, 'Κέικ'),
(1.2, 4, 'Τόστ'),
(0.7, 5, 'Κουλούρι'),
(1.3, 6, 'Ελληνικός'),
(1, 7, 'Φραπέ'),
(1.1, 8, 'Εσπρέσο'),
(1.2, 9, 'Καπουτσίνο'),
(1.1, 10, 'Φίλτρου');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `quantities`
--

CREATE TABLE `quantities` (
  `Store_name` varchar(25) CHARACTER SET utf8 NOT NULL,
  `τυρόπιτα` int(15) NOT NULL DEFAULT '0',
  `χορτόπιτα` int(10) NOT NULL DEFAULT '0',
  `κέικ` int(15) NOT NULL DEFAULT '0',
  `τοστ` int(15) NOT NULL DEFAULT '0',
  `κουλούρι` int(15) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `quantities`
--

INSERT INTO `quantities` (`Store_name`, `τυρόπιτα`, `χορτόπιτα`, `κέικ`, `τοστ`, `κουλούρι`, `id`) VALUES
('Κατάστημα Νοταρά', 120, 1000, 100, 120, 10000, 1),
('κτελ', 1, 0, 0, 16, 4, 2),
('physiq', 8, 8, 10, 9, 9, 3);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `store`
--

CREATE TABLE `store` (
  `Store_name` varchar(25) NOT NULL,
  `Address` text NOT NULL,
  `Address_number` int(11) NOT NULL,
  `Location` point NOT NULL,
  `City` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `store`
--

INSERT INTO `store` (`Store_name`, `Address`, `Address_number`, `Location`, `City`) VALUES
('physiq', 'Μειλίχου', 54, '\0\0\0\0\0\0\0G ^�/\"C@D�H���5@', 'Πάτρα'),
('Κατάστημα Νοταρά', 'Νοταρά', 25, '\0\0\0\0\0\0\0$���� C@�*����5@', 'Πάτρα'),
('κτελ', 'Ζαίμη', 2, '\0\0\0\0\0\0\0}( C@�ECƣ�5@', 'Πάτρα');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `work_hours`
--

CREATE TABLE `work_hours` (
  `Deliver` varchar(20) NOT NULL,
  `Hours` int(10) NOT NULL DEFAULT '0',
  `Day` int(10) NOT NULL,
  `Month` int(10) NOT NULL,
  `Year` int(15) NOT NULL,
  `id` int(30) NOT NULL,
  `Routes` int(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `work_hours`
--

INSERT INTO `work_hours` (`Deliver`, `Hours`, `Day`, `Month`, `Year`, `id`, `Routes`) VALUES
('user1', 13, 19, 2, 2018, 7, 0),
('deliveras', 4, 19, 2, 2018, 9, 0),
('user1', 23, 20, 2, 2018, 10, 0),
('deliveras', 38, 20, 2, 2018, 11, 3);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`email`);

--
-- Ευρετήρια για πίνακα `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`Username`);

--
-- Ευρετήρια για πίνακα `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`AFM`),
  ADD UNIQUE KEY `Store` (`Store_name`),
  ADD KEY `Store_name` (`Store_name`),
  ADD KEY `Store_2` (`Store_name`),
  ADD KEY `Store_name_2` (`Store_name`);

--
-- Ευρετήρια για πίνακα `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `store` (`Store`),
  ADD KEY `assignment` (`Deliver`),
  ADD KEY `Customer` (`Customer`);

--
-- Ευρετήρια για πίνακα `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `quantities`
--
ALTER TABLE `quantities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Store_name` (`Store_name`),
  ADD KEY `Store_name_2` (`Store_name`);

--
-- Ευρετήρια για πίνακα `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`Store_name`);

--
-- Ευρετήρια για πίνακα `work_hours`
--
ALTER TABLE `work_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Deliver` (`Deliver`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT για πίνακα `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT για πίνακα `quantities`
--
ALTER TABLE `quantities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT για πίνακα `work_hours`
--
ALTER TABLE `work_hours`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `Cancer` FOREIGN KEY (`Store_name`) REFERENCES `store` (`Store_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `Customer` FOREIGN KEY (`Customer`) REFERENCES `customer` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Employee` FOREIGN KEY (`Deliver`) REFERENCES `delivery` (`Username`),
  ADD CONSTRAINT `Store` FOREIGN KEY (`Store`) REFERENCES `store` (`Store_name`);

--
-- Περιορισμοί για πίνακα `quantities`
--
ALTER TABLE `quantities`
  ADD CONSTRAINT `store_quantity` FOREIGN KEY (`Store_name`) REFERENCES `store` (`Store_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `work_hours`
--
ALTER TABLE `work_hours`
  ADD CONSTRAINT `Deliveras` FOREIGN KEY (`Deliver`) REFERENCES `delivery` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
