-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 06, 2016 at 03:54 PM
-- Server version: 5.5.49-log
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineautopartsstore`
--
CREATE DATABASE IF NOT EXISTS `onlineautopartsstore` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `onlineautopartsstore`;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_ID` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `num_available` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `tags` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_ID`, `item_name`, `price`, `num_available`, `category`, `description`, `tags`) VALUES
(3, 'Duralast Break Pads', 24.99, 24, 'brake', 'This is a test brake', 'brake brakes duralast'),
(4, 'Duralast Break Rotors', 39.99, 13, 'brake', 'This is a test rotor', 'brake brakes duralast rotor rotors'),
(5, 'Duralast Break Hose', 13.5, 2, 'brake', 'This is a test brake hose', 'brake brakes duralast hose front'),
(6, 'Surefire Engine', 499.99, 12, 'engine mechanical', 'This is a test engine', 'engine surefire sure fire '),
(7, 'Valvoline Engine Oil', 6, 24, 'engine mechanical', 'This is a test engine oil', 'engine oil valvoline'),
(8, 'Surefire Engine Cylinder Head', 500.99, 4, 'engine mechanical', 'This is a test engine head', 'engine sure fire surefire head cylinder'),
(9, 'Walker Exhaust Pipe', 14.99, 3, 'exhaust', 'This is a test exhaust pipe', 'walker exhaust pipe'),
(10, 'Thrush Turbo Exhaust Muffler', 13.99, 24, 'exhaust', 'This is a test exhaust muffler', 'exhaust'),
(12, 'Wheel', 10.75, 9, 'steering', 'This is a test wheel', 'Tags'),
(14, 'Autozone Transmission Fluid\r\n', 5.99, 22, 'transmission', 'This is a test transmission fluid ', 'transmission fluid automatic'),
(15, 'Valvoline Transmission Fluid\r\n', 6.99, 17, 'transmission', 'transmission fluid test', 'transmission fluid test');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_ID` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hashed_password` varchar(200) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `street_address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zip` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `first_name`, `last_name`, `email`, `hashed_password`, `phone_number`, `is_admin`, `street_address`, `city`, `state`, `zip`) VALUES
(1, 'John', 'Smith', 'John.Smith@gmail.com', 'password', '1234567891', 0, '1234 fake', 'dallas', 'texas', 75021),
(2, 'elon', 'musk', 'elon@tesla.com', 'password', '', 1, '', '', '', 0),
(3, 'bill', 'gates', 'bill.gates@microsoft.com', '12345678', '', 0, '', '', '', 0),
(6, 'admin', 'admin', 'admin@gmail.com', '$2y$10$xHKgwjfRMmpsQ5fC3ZJIWedjvaGuXBQGzr6rTZwmHC4MfptYQk52a', '', 1, '', '', '', 0),
(7, 'User', 'User', 'user@gmail.com', '$2y$10$fNr9IF65vj.rLAMB/3/pkuwp2Jq6BvRS7mg4G1ug1kZ8dHtshIfN2', '', 0, '', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
