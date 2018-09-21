-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 21, 2018 at 03:33 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

CREATE TABLE `bed` (
  `id_bed` int(11) NOT NULL,
  `id_type_room` int(11) NOT NULL,
  `id_type_bed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`id_bed`, `id_type_room`, `id_type_bed`) VALUES
(1, 1, 1),
(2, 1, 1),
(4, 2, 1),
(6, 3, 2),
(7, 3, 3),
(8, 3, 3),
(9, 4, 2),
(10, 5, 2),
(11, 6, 2),
(13, 7, 2),
(14, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `nb_night` int(11) NOT NULL,
  `nb_person` int(11) NOT NULL,
  `add_info` varchar(255) NOT NULL,
  `id_guest` int(11) NOT NULL,
  `id_room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `created_at`, `check_in`, `check_out`, `nb_night`, `nb_person`, `add_info`, `id_guest`, `id_room`) VALUES
(1, '2018-09-11 10:41:26', '2018-09-13', '2018-09-14', 1, 4, '', 1, 1),
(2, '2018-09-11 10:41:26', '2018-09-13', '2018-09-15', 2, 2, '', 2, 8),
(3, '2018-09-11 10:41:26', '2018-09-13', '2018-09-14', 1, 4, '', 1, 11),
(4, '2018-09-12 16:29:59', '2018-09-12', '2018-09-14', 2, 2, '', 2, 7),
(5, '2018-09-13 09:31:55', '2018-09-10', '2018-09-14', 4, 2, '', 2, 3),
(7, '2018-09-13 09:39:35', '2018-09-14', '2018-09-15', 1, 2, '', 2, 2),
(8, '2018-09-13 09:40:34', '2018-09-14', '2018-09-15', 1, 2, '', 2, 1),
(9, '2018-09-13 10:00:15', '2018-09-06', '2018-09-11', 4, 2, '', 1, 14),
(10, '2018-09-13 10:44:45', '2018-09-09', '2018-09-12', 2, 2, '', 1, 4),
(11, '2018-09-13 10:44:45', '2018-09-15', '2018-09-17', 2, 2, '', 2, 4),
(13, '2018-09-13 13:39:57', '2018-09-12', '2018-09-15', 3, 4, '', 22, 4),
(14, '2018-09-13 13:41:08', '2018-09-12', '2018-09-15', 3, 4, '', 23, 13),
(15, '2018-09-13 13:50:44', '2018-09-12', '2018-09-14', 2, 2, '', 24, 39),
(32, '2018-09-13 14:32:07', '2018-09-11', '2018-09-16', 5, 5, '', 41, 10),
(33, '2018-09-13 14:32:54', '2018-09-11', '2018-09-15', 4, 4, '', 42, 15),
(34, '2018-09-13 16:42:55', '2018-09-16', '2018-09-19', 3, 2, '', 43, 2),
(35, '2018-09-13 16:55:27', '2018-09-11', '2018-09-18', 7, 4, '', 44, 27),
(36, '2018-09-14 16:15:03', '2018-09-13', '2018-09-16', 3, 2, '', 45, 9),
(37, '2018-09-14 16:16:00', '2018-09-14', '2018-09-16', 2, 4, '', 46, 21),
(38, '2018-09-14 16:16:49', '2018-09-12', '2018-09-14', 2, 5, '', 47, 6),
(39, '2018-09-19 11:31:50', '2018-09-21', '2018-09-23', 2, 2, '', 48, 2),
(40, '2018-09-21 14:25:36', '2018-09-17', '2018-09-22', 5, 3, '', 50, 3),
(41, '2018-09-21 14:27:58', '2018-09-17', '2018-09-22', 5, 3, '', 51, 3),
(42, '2018-09-21 14:29:43', '2018-09-17', '2018-09-22', 5, 3, '', 52, 3),
(43, '2018-09-21 15:31:46', '2018-09-22', '2018-09-25', 3, 4, '', 53, 8);

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `id_guest` int(11) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(15) NOT NULL,
  `add_info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`id_guest`, `firstname`, `lastname`, `email`, `phone`, `add_info`) VALUES
(1, 'William', 'Wauters', 'william.wauters@outlook.com', 475263512, ''),
(2, 'Jean', 'Marc', 'jean.marc@outlook.com', 489957521, ''),
(12, 'Jean', 'Francois', 'j.f@outlook.com', 7895412, ''),
(13, 'Jean', 'Francois', 'j.f@outlook.com', 7895412, ''),
(14, 'Jean', 'Francois', 'j.f@outlook.com', 7895412, ''),
(15, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(16, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(17, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(18, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(19, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(20, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(21, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(22, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(23, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(24, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(25, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(26, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(27, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(28, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(29, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(30, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(31, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(32, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(33, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(34, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(35, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(36, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(37, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(38, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(39, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(40, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(41, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(42, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(43, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(44, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(45, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(46, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(47, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(48, 'Jean', 'Francois', 'j.f@outlook.com', 1112354, ''),
(49, 'Marie', 'Jeanne', 'Jeanne.Marie@hotmail.com', 0, ''),
(50, 'Marie', 'Jeanne', 'Jeanne.Marie@hotmail.com', 0, ''),
(51, 'Marie', 'Jeanne', 'Jeanne.Marie@hotmail.com', 0, ''),
(52, 'Marie', 'Jeanne', 'Jeanne.Marie@hotmail.com', 0, ''),
(53, 'Marie', 'Jeanne', 'Jeanne.Marie@hotmail.com', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `rang_people_room`
--

CREATE TABLE `rang_people_room` (
  `id_range` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `id_type_room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rang_people_room`
--

INSERT INTO `rang_people_room` (`id_range`, `min`, `max`, `id_type_room`) VALUES
(1, 4, 6, 1),
(2, 2, 4, 2),
(3, 4, 4, 3),
(4, 2, 2, 4),
(5, 2, 2, 5),
(6, 2, 3, 6),
(7, 2, 2, 7),
(8, 2, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id_room` int(11) NOT NULL,
  `num` varchar(10) NOT NULL,
  `add_info` varchar(255) NOT NULL,
  `id_type_room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id_room`, `num`, `add_info`, `id_type_room`) VALUES
(1, '1', '', 1),
(2, '2', '', 1),
(3, '3', 'Need Mouse Trap', 1),
(4, '4', '', 1),
(5, '5', '', 5),
(6, '5A', '', 5),
(7, '6', '', 1),
(8, '7', '', 2),
(9, '7A', '', 7),
(10, '8', '', 1),
(11, '9', '', 2),
(12, '9A', '', 7),
(13, '10', '', 1),
(14, '11', '', 1),
(15, '12', '', 1),
(16, '13', '', 2),
(17, '13A', '', 7),
(18, '14', '', 2),
(19, '14A', '', 7),
(20, '15', '', 2),
(21, '15A', 'Need Paint', 7),
(22, '16', '', 6),
(23, '17', '', 6),
(24, '18', '', 3),
(25, '19', '', 6),
(26, '20', '', 3),
(27, '21', 'Fix Fireplace', 6),
(28, '22', '', 3),
(29, '23', '', 6),
(30, '24', '', 6),
(31, '25', '', 6),
(32, '26', '', 3),
(33, '27', '', 6),
(34, '28', '', 6),
(35, '29', '', 6),
(36, '30', '', 6),
(37, '31', '', 6),
(38, '32', '', 4),
(39, '33', '', 4),
(40, '34', '', 4),
(41, '35', '', 4),
(42, 'pilot', '', 8);

-- --------------------------------------------------------

--
-- Table structure for table `type_bed`
--

CREATE TABLE `type_bed` (
  `id_type_bed` int(11) NOT NULL,
  `type_name` varchar(20) NOT NULL,
  `type_sheet` varchar(10) NOT NULL,
  `price_sheet` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_bed`
--

INSERT INTO `type_bed` (`id_type_bed`, `type_name`, `type_sheet`, `price_sheet`) VALUES
(1, 'king', 'KS', '1.50'),
(2, 'queen', 'QS', '1.40'),
(3, 'single', 'SS', '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `type_room`
--

CREATE TABLE `type_room` (
  `id_type_room` int(11) NOT NULL,
  `type_name` varchar(20) NOT NULL,
  `capacity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `kitchen` tinyint(1) NOT NULL,
  `tub` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_room`
--

INSERT INTO `type_room` (`id_type_room`, `type_name`, `capacity`, `price`, `kitchen`, `tub`) VALUES
(1, 'classic bungalow', 4, '400', 1, 1),
(2, 'deluxe bungalow', 2, '350', 0, 1),
(3, 'family cottage', 4, '200', 0, 1),
(4, 'standard cottage', 2, '150', 0, 0),
(5, 'duplex cottage', 2, '200', 0, 0),
(6, 'fireplace cottage', 2, '180', 0, 0),
(7, 'bungalow unit', 2, '150', 0, 0),
(8, 'pilot bungalow', 2, '370', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bed`
--
ALTER TABLE `bed`
  ADD PRIMARY KEY (`id_bed`),
  ADD KEY `FK_id_type_room` (`id_type_room`),
  ADD KEY `FK_id_type_bed` (`id_type_bed`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `FK_id_room` (`id_room`),
  ADD KEY `FK_id_guest` (`id_guest`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id_guest`);

--
-- Indexes for table `rang_people_room`
--
ALTER TABLE `rang_people_room`
  ADD PRIMARY KEY (`id_range`),
  ADD KEY `FK_id_type_room3` (`id_type_room`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id_room`),
  ADD KEY `FK_id_type_room2` (`id_type_room`);

--
-- Indexes for table `type_bed`
--
ALTER TABLE `type_bed`
  ADD PRIMARY KEY (`id_type_bed`);

--
-- Indexes for table `type_room`
--
ALTER TABLE `type_room`
  ADD PRIMARY KEY (`id_type_room`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bed`
--
ALTER TABLE `bed`
  MODIFY `id_bed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id_guest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `rang_people_room`
--
ALTER TABLE `rang_people_room`
  MODIFY `id_range` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `type_bed`
--
ALTER TABLE `type_bed`
  MODIFY `id_type_bed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type_room`
--
ALTER TABLE `type_room`
  MODIFY `id_type_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bed`
--
ALTER TABLE `bed`
  ADD CONSTRAINT `FK_id_type_bed` FOREIGN KEY (`id_type_bed`) REFERENCES `type_bed` (`id_type_bed`),
  ADD CONSTRAINT `FK_id_type_room` FOREIGN KEY (`id_type_room`) REFERENCES `type_room` (`id_type_room`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `FK_id_guest` FOREIGN KEY (`id_guest`) REFERENCES `guest` (`id_guest`),
  ADD CONSTRAINT `FK_id_room` FOREIGN KEY (`id_room`) REFERENCES `room` (`id_room`);

--
-- Constraints for table `rang_people_room`
--
ALTER TABLE `rang_people_room`
  ADD CONSTRAINT `FK_id_type_room3` FOREIGN KEY (`id_type_room`) REFERENCES `type_room` (`id_type_room`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `FK_id_type_room2` FOREIGN KEY (`id_type_room`) REFERENCES `type_room` (`id_type_room`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
