-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2023 at 12:15 PM
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
-- Database: `dbbriskvrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblavailability`
--

CREATE TABLE `tblavailability` (
  `availability_id` int(11) NOT NULL,
  `car_id` int(11) DEFAULT NULL,
  `pickup_date` datetime DEFAULT NULL,
  `return_date` datetime DEFAULT NULL,
  `available` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblcar`
--

CREATE TABLE `tblcar` (
  `car_id` int(11) NOT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `car_type` varchar(50) DEFAULT NULL,
  `transmission` varchar(50) DEFAULT NULL,
  `engine` varchar(50) DEFAULT NULL,
  `seat` int(11) DEFAULT NULL,
  `daily_rate` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcar`
--

INSERT INTO `tblcar` (`car_id`, `brand`, `model`, `year`, `car_type`, `transmission`, `engine`, `seat`, `daily_rate`) VALUES
(1, 'Toyota', 'Fortuner', 2023, 'SUV', 'Automatic', '2.8L Diesel', 7, 4700.00),
(2, 'Mitsubishi', 'Montero', 2023, 'SUV', 'Automatic', '3.0L Gasoline', 7, 4200.00),
(3, 'Nissan', 'Terra', 2023, 'SUV', 'Automatic', '2.5L Diesel', 7, 4500.00),
(4, 'Toyota', 'Vios', 2023, 'Sedan', 'Automatic', '1.5L Gasoline', 5, 2500.00),
(5, 'Mitsubishi', 'Mirage', 2023, 'Sedan', 'Automatic', '1.2L Gasoline', 5, 2200.00),
(6, 'Honda', 'Civic', 2023, 'Sedan', 'Automatic', '1.8L Gasoline', 5, 2900.00),
(7, 'Toyota', 'Innova', 2023, 'MPV', 'Automatic', '2.8L Diesel', 8, 3200.00),
(8, 'Mitsubishi', 'Xpander', 2023, 'MPV', 'Automatic', '1.5L Gasoline', 7, 2900.00),
(9, 'Honda', 'BR-V', 2023, 'MPV', 'Automatic', '1.5L Gasoline', 7, 2900.00),
(10, 'Toyota', 'Hilux', 2023, 'Pick up', 'Manual', '2.4L Diesel', 5, 2800.00),
(11, 'Mitsubishi', 'Strada', 2023, 'Pick up', 'Manual', '2.5L Diesel', 5, 2700.00),
(12, 'Nissan', 'Navara', 2023, 'Pick up', 'Automatic', '2.5L Diesel', 5, 3000.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbllogin_credential`
--

CREATE TABLE `tbllogin_credential` (
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbllogin_credential`
--

INSERT INTO `tbllogin_credential` (`user_id`, `username`, `password`, `email`) VALUES
(3, 'JDLC', 'Testing2', 'JDlCrz@example.com'),
(4, 'Sampleacc1', 'Testing3', 'Sampleacc1');

-- --------------------------------------------------------

--
-- Table structure for table `tblreservation`
--

CREATE TABLE `tblreservation` (
  `reservation_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `destination` varchar(50) DEFAULT NULL,
  `pickup_date` datetime DEFAULT NULL,
  `return_date` datetime DEFAULT NULL,
  `rental_days` int(11) DEFAULT NULL,
  `total_cost` decimal(10,2) DEFAULT NULL,
  `reservation_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblreservation`
--

INSERT INTO `tblreservation` (`reservation_id`, `user_id`, `car_id`, `destination`, `pickup_date`, `return_date`, `rental_days`, `total_cost`, `reservation_date`) VALUES
(1, 3, 2, 'San Fernando', '2023-05-01 22:02:00', '2023-05-02 22:02:00', 1, 4200.00, '2023-05-01 18:02:12'),
(2, 4, 2, 'Manila', '2023-05-01 18:12:00', '2023-05-03 18:12:00', 2, 8400.00, '2023-05-01 18:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`user_id`, `username`, `password`, `email`, `first_name`, `last_name`, `phone`, `address`) VALUES
(3, 'JDLC', 'Testing2', 'JDlCrz@example.com', 'Juan', 'Dela Cruz', '09182734612', 'Balibago'),
(4, 'Sampleacc1', 'Testing3', 'Sampleacc1', 'Sample', 'Activity', '09871236482', 'Santo Rosario');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblavailability`
--
ALTER TABLE `tblavailability`
  ADD PRIMARY KEY (`availability_id`),
  ADD KEY `fk_car_availability` (`car_id`);

--
-- Indexes for table `tblcar`
--
ALTER TABLE `tblcar`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `tbllogin_credential`
--
ALTER TABLE `tbllogin_credential`
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_user_login_credential` (`user_id`);

--
-- Indexes for table `tblreservation`
--
ALTER TABLE `tblreservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `fk_user_reservation` (`user_id`),
  ADD KEY `fk_car_reservation` (`car_id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblavailability`
--
ALTER TABLE `tblavailability`
  MODIFY `availability_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcar`
--
ALTER TABLE `tblcar`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblreservation`
--
ALTER TABLE `tblreservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblavailability`
--
ALTER TABLE `tblavailability`
  ADD CONSTRAINT `fk_car_availability` FOREIGN KEY (`car_id`) REFERENCES `tblcar` (`car_id`);

--
-- Constraints for table `tbllogin_credential`
--
ALTER TABLE `tbllogin_credential`
  ADD CONSTRAINT `fk_user_login_credential` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`user_id`);

--
-- Constraints for table `tblreservation`
--
ALTER TABLE `tblreservation`
  ADD CONSTRAINT `fk_car_reservation` FOREIGN KEY (`car_id`) REFERENCES `tblcar` (`car_id`),
  ADD CONSTRAINT `fk_user_reservation` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
