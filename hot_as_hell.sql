-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2024 at 09:36 PM
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
-- Database: `hot_as_hell`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `BookingNo` varchar(10) NOT NULL,
  `BookingDate` date NOT NULL,
  `BookingTime` time NOT NULL,
  `GuestID` varchar(11) NOT NULL,
  `PaymentID` varchar(12) NOT NULL,
  `AdultCount` int(11) NOT NULL,
  `ChildrenCount` int(11) DEFAULT NULL,
  `SpecialRequests` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeID` varchar(12) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `PositionID` varchar(4) NOT NULL,
  `Contact` varchar(11) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeID`, `FirstName`, `LastName`, `PositionID`, `Contact`, `DOB`, `Gender`) VALUES
('E65070503435', 'John', 'Doe', 'P001', '+669345678', '1990-05-15', 'M'),
('E65070503436', 'Jane', 'Smith', 'P002', '+669876543', '1998-08-25', 'F'),
('E65070503437', 'Michael', 'Johnson', 'P003', '+668654328', '1988-02-10', 'M'),
('E65070503438', 'Emily', 'Brown', 'P004', '+669543218', '1987-11-30', 'F'),
('E65070503439', 'David', 'Wilson', 'P005', '+668765432', '1992-04-20', 'M'),
('E65070503440', 'Jessica', 'Lee', 'P006', '+668907654', '2002-09-12', 'F'),
('E65070503441', 'Matthew', 'Taylor', 'P007', '+669876543', '2000-06-18', 'M'),
('E65070503442', 'Emma', 'Anderson', 'P001', '+668654328', '1991-07-22', 'F'),
('E65070503443', 'Christopher', 'White', 'P002', '+669543218', '1996-12-05', 'M'),
('E65070503444', 'Sophia', 'Martinez', 'P003', '+668765432', '1996-03-28', 'F'),
('E65070503445', 'Andrew', 'Garcia', 'P004', '+668907654', '1989-10-17', 'M'),
('E65070503446', 'Olivia', 'Hernandez', 'P005', '+669276543', '1990-08-08', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `employee_position`
--

CREATE TABLE `employee_position` (
  `PositionID` varchar(4) NOT NULL,
  `Position` varchar(30) NOT NULL,
  `Salary` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_position`
--

INSERT INTO `employee_position` (`PositionID`, `Position`, `Salary`) VALUES
('P001', 'Manager', '250000'),
('P002', 'Receptionist', '50000'),
('P003', 'CEO', '300000'),
('P004', 'Managing Director', '280000'),
('P005', 'Assistant Manager', '200000'),
('P006', 'Human Resource', '150000'),
('P007', 'Housekeeper', '20000');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `GuestID` varchar(11) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Telephone` varchar(13) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(12) NOT NULL,
  `NationalID` varchar(13) NOT NULL,
  `PassportNo` varchar(9) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`GuestID`, `FirstName`, `LastName`, `Telephone`, `Email`, `Password`, `NationalID`, `PassportNo`, `DOB`, `Gender`) VALUES
('GKBOOFK713', 'Krisha', 'Botadara', '0123456789', 'krishabotadara@gmail.com', 'krisha', '123456', '2R5WX9', '2024-05-02', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `ReservationID` int(11) NOT NULL,
  `BookingNo` varchar(10) NOT NULL,
  `RoomID` varchar(5) NOT NULL,
  `CheckInDate` date NOT NULL,
  `CheckInTime` time NOT NULL,
  `CheckOutDate` date NOT NULL,
  `CheckOutTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `RoomID` varchar(5) NOT NULL,
  `RoomType` varchar(4) NOT NULL,
  `EmployeeID` varchar(12) NOT NULL,
  `RoomStatus` text NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`RoomID`, `RoomType`, `EmployeeID`, `RoomStatus`) VALUES
('R1001', 'DLX', 'E65070503435', 'Available'),
('R1002', 'FAM', 'E65070503436', 'Not Available'),
('R1003', 'STD', 'E65070503437', 'Available'),
('R1004', 'SUI', 'E65070503438', 'Available'),
('R1005', 'DLX', 'E65070503439', 'Not Available'),
('R1006', 'FAM', 'E65070503440', 'Available'),
('R1007', 'STD', 'E65070503441', 'Not Available'),
('R1008', 'SUI', 'E65070503442', 'Available'),
('R1009', 'DLX', 'E65070503443', 'Available'),
('R1010', 'FAM', 'E65070503444', 'Not Available'),
('R1011', 'STD', 'E65070503445', 'Available'),
('R1012', 'SUI', 'E65070503446', 'Not Available'),
('R1013', 'DLX', 'E65070503444', 'Available'),
('R1014', 'FAM', 'E65070503438', 'Available'),
('R1015', 'STD', 'E65070503439', 'Not Available'),
('R1016', 'SUI', 'E65070503440', 'Available'),
('R1017', 'DLX', 'E65070503441', 'Not Available'),
('R1018', 'FAM', 'E65070503442', 'Available'),
('R1019', 'STD', 'E65070503437', 'Available'),
('R1020', 'SUI', 'E65070503445', 'Not Available');

-- --------------------------------------------------------

--
-- Table structure for table `room_details`
--

CREATE TABLE `room_details` (
  `RoomType` varchar(4) NOT NULL,
  `RoomDetail` text NOT NULL,
  `RoomPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_details`
--

INSERT INTO `room_details` (`RoomType`, `RoomDetail`, `RoomPrice`) VALUES
('DLX', 'Deluxe room with river view and balcony', 1500),
('FAM', 'Family suite with multiple bedrooms and living area', 2800),
('STD', 'Standard room with city view and basic amenities', 900),
('SUI', 'Luxury suite with private pool and panoramic city view', 4800);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`BookingNo`),
  ADD KEY `GuestID` (`GuestID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD KEY `PositionID` (`PositionID`);

--
-- Indexes for table `employee_position`
--
ALTER TABLE `employee_position`
  ADD PRIMARY KEY (`PositionID`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`GuestID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`ReservationID`),
  ADD KEY `BookingNo` (`BookingNo`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`RoomID`),
  ADD KEY `RoomType` (`RoomType`);

--
-- Indexes for table `room_details`
--
ALTER TABLE `room_details`
  ADD PRIMARY KEY (`RoomType`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`GuestID`) REFERENCES `guest` (`GuestID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`PositionID`) REFERENCES `employee_position` (`PositionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`BookingNo`) REFERENCES `booking_details` (`BookingNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`RoomType`) REFERENCES `room_details` (`RoomType`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
