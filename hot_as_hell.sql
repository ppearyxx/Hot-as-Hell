-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 09:26 AM
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
  `PaymentID` int(11) NOT NULL,
  `AdultCount` int(11) NOT NULL,
  `ChildrenCount` int(11) DEFAULT NULL,
  `SpecialRequests` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`BookingNo`, `BookingDate`, `BookingTime`, `GuestID`, `PaymentID`, `AdultCount`, `ChildrenCount`, `SpecialRequests`) VALUES
('B133781937', '2024-05-24', '23:41:59', 'GKBOOFK713', 0, 1, 0, ''),
('B22756248', '2024-05-25', '14:04:22', 'GJDBJTH753', 0, 1, 0, 'Vegetarian Food '),
('B356178603', '2024-05-24', '23:28:04', 'GKBOOFK713', 0, 0, 0, ''),
('B359620624', '2024-05-14', '17:15:59', 'GJWPSZW12', 0, 2, 1, 'Fruit bowl'),
('B369108625', '2024-05-25', '14:22:25', 'GJDBJTH753', 0, 2, 1, 'Fresh Orange Juice'),
('B4075589', '2024-05-14', '13:16:22', 'GKBOOFK713', 0, 2, 1, ''),
('B69181301', '2024-05-14', '16:58:34', 'GJWREPX398', 0, 2, 1, 'Fruit bowl'),
('B802481492', '2024-05-14', '14:25:17', 'GMLVWCS764', 0, 2, 1, 'Fruit bowl'),
('B879286470', '2024-05-14', '17:01:52', 'GJWREPX398', 0, 2, 1, ''),
('B914960379', '2024-05-25', '14:25:42', 'GJDBJTH753', 0, 2, 2, 'None'),
('B953339612', '2024-05-14', '13:16:14', 'GKBOOFK713', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeID` varchar(12) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `PositionID` varchar(4) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Contact` varchar(11) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD KEY `PositionID` (`PositionID`);

CREATE TABLE `employee_position` (
  `PositionID` varchar(4) NOT NULL,
  `Position` varchar(30) NOT NULL,
  `Salary` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `employee_position`
  ADD PRIMARY KEY (`PositionID`);

INSERT INTO `employee_position` (`PositionID`, `Position`, `Salary`) VALUES
('P001', 'Manager', '250000'),
('P002', 'Receptionist', '50000'),
('P003', 'CEO', '300000'),
('P004', 'Managing Director', '280000'),
('P005', 'Assistant Manager', '200000'),
('P006', 'Human Resource', '150000'),
('P007', 'Housekeeper', '20000');

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeID`, `FirstName`, `LastName`, `PositionID`, `Password`, `Contact`, `DOB`, `Gender`) VALUES
('E65070503435', 'John', 'Doe', 'P001', 'JohnDoe378', '+669345678', '1990-05-15', 'M'),
('E65070503436', 'Jane', 'Smith', 'P002', 'Smith@Jane02', '+669876543', '1998-08-25', 'F'),
('E65070503437', 'Michael', 'Johnson', 'P004', 'Michael2030', '+668654328', '1988-02-10', 'M'),
('E65070503438', 'Emily', 'Brown', 'P004', 'EBrown90', '+669543218', '1987-11-30', 'F'),
('E65070503439', 'David', 'Wilson', 'P005', 'David04Wilson', '+668765432', '1992-04-20', 'M'),
('E65070503440', 'Jessica', 'Lee', 'P006', 'Jessicalee08', '+668907654', '2002-09-12', 'F'),
('E65070503441', 'Matthew', 'Taylor', 'P007', 'Matthew0308', '+669876543', '2000-06-18', 'M'),
('E65070503442', 'Emma', 'Anderson', 'P001', 'Anderson@379', '+668654328', '1991-07-22', 'F'),
('E65070503443', 'Christopher', 'White', 'P002', 'White496', '+669543218', '1996-12-05', 'M'),
('E65070503444', 'Sophia', 'Martinez', 'P003', 'Sophia9860', '+668765432', '1996-03-28', 'F'),
('E65070503445', 'Andrew', 'Garcia', 'P004', 'GarciaA1039', '+668907654', '1989-10-17', 'M'),
('E65070503446', 'Olivia', 'Hernandez', 'P005', 'Olivia09582H', '+669276543', '1990-08-08', 'F');



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
('GJDBJTH753', 'John', 'Doe', '9876543210', 'JohnDoe@mail.com', 'John24', 'J14578', 'DX87C4', '2015-07-23', 'M'),
('GJWPSZW12', 'James', 'Woods', '0897655432', 'Jameswoods@gmail.com', 'James12', '98NJ76H', '67BH2SD', '2005-10-12', 'M'),
('GKBOOFK713', 'Krisha', 'Botadara', '0123456789', 'krishabotadara@gmail.com', 'krisha', '123456', '2R5WX9', '2024-05-02', 'F'),
('GMLVWCS764', 'Maria', 'Louis', '9876543210', 'maria@mail.com', 'ml980', 'HG7893', '2R5WX9', '2013-07-22', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `historyreservation`
--

CREATE TABLE `historyreservation` (
  `referenceno` int(10) NOT NULL,
  `guestid` varchar(11) NOT NULL,
  `cin` date NOT NULL,
  `cout` date NOT NULL,
  `rcin` datetime NOT NULL,
  `rcout` datetime NOT NULL,
  `roomid` varchar(5) NOT NULL,
  `ernestpay` varchar(3) NOT NULL,
  `specialreq` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `historyreservation`
--

INSERT INTO `historyreservation` (`referenceno`, `guestid`, `cin`, `cout`, `rcin`, `rcout`, `roomid`, `ernestpay`, `specialreq`) VALUES
(110473926, 'G1001', '2024-01-24', '2024-01-26', '2024-01-24 03:00:00', '2024-01-26 11:00:00', 'D001', 'Yes', '-');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `EarnestPayCheck` decimal(10,2) DEFAULT NULL,
  `PaymentMethodID` varchar(5) DEFAULT NULL,
  `PromotionID` varchar(5) DEFAULT NULL,
  `TotalAmount` decimal(10,2) DEFAULT NULL,
  `EarnestPayDatetime` datetime DEFAULT NULL,
  `TotalPayDatetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`);

CREATE TABLE `payment_method` (
  `PaymentMethodID` varchar(5) NOT NULL,
  `PaymentMethodName` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`PaymentMethodID`);

ALTER TABLE `payment`
  ADD CONSTRAINT `paymentmethod_ibfk_1` FOREIGN KEY (`PaymentMethodID`) REFERENCES `payment_method` (`PaymentMethodID`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `payment_method` (`PaymentMethodID`, `PaymentMethodName`) VALUES
('PM001', 'Mastercard'),
('PM002', 'Internet Bankin'),
('PM003', 'Bill Payment'),
('PM004', 'Paypal'),
('PM005', 'Alipay');

-- --------------------------------------------------------

--
-- Table structure for table `promotion_setup`
--

CREATE TABLE `promotion_setup` (
  `PromotionID` varchar(5) NOT NULL,
  `PercentPrice` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotion_setup`
--

INSERT INTO `promotion_setup` (`PromotionID`, `PercentPrice`) VALUES
('PRO01', 10.00),
('PRO02', 15.00),
('PRO03', 20.00),
('PRO04', 50.00);

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

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`ReservationID`, `BookingNo`, `RoomID`, `CheckInDate`, `CheckInTime`, `CheckOutDate`, `CheckOutTime`) VALUES
(57, 'B22756248', 'R1003', '2024-05-28', '14:03:00', '2024-05-29', '11:10:00'),
(59, 'B369108625', 'R1013', '2024-05-25', '14:49:32', '2024-05-25', '14:50:37'),
(61, 'B914960379', 'R1016', '2024-05-23', '18:30:00', '2024-05-27', '07:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `RoomID` varchar(5) NOT NULL,
  `RoomType` varchar(4) DEFAULT NULL,
  `EmployeeID` varchar(12) NOT NULL,
  `RoomStatus` text NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `room`
  ADD PRIMARY KEY (`RoomID`),
  ADD KEY `RoomType` (`RoomType`);
--

-- --------------------------------------------------------

--
-- Table structure for table `room_details`
--

CREATE TABLE `room_details` (
  `RoomType` varchar(4) NOT NULL,
  `RoomDetail` text NOT NULL,
  `RoomPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `room_details`
  ADD PRIMARY KEY (`RoomType`);

ALTER TABLE `room`
ADD CONSTRAINT `fk_room_room_type` FOREIGN KEY (`RoomType`) REFERENCES `room_details` (`RoomType`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Dumping data for table `room_details`
--

INSERT INTO `room_details` (`RoomType`, `RoomDetail`, `RoomPrice`) VALUES
('DLX', 'Deluxe room with river view and balcony', 1500),
('FAM', 'Family suite with multiple bedrooms and living area', 2800),
('STD', 'Standard room with city view and basic amenities', 900),
('SUI', 'Luxury suite with private pool and panoramic city view', 4800);

-- Dumping data for table `room`
--

INSERT INTO `room` (`RoomID`, `RoomType`, `EmployeeID`, `RoomStatus`) VALUES
('R1001', 'DLX', 'E65070503435', 'Not Available'),
('R1002', 'FAM', 'E65070503436', 'Not Available'),
('R1003', 'STD', 'E65070503437', 'Not Available'),
('R1004', 'SUI', 'E65070503438', 'Not Available'),
('R1005', 'DLX', 'E65070503439', 'Not Available'),
('R1006', 'FAM', 'E65070503440', 'Available'),
('R1007', 'STD', 'E65070503441', 'Not Available'),
('R1008', 'SUI', 'E65070503442', 'Not Available'),
('R1009', 'DLX', 'E65070503443', 'Not Available'),
('R1010', 'FAM', 'E65070503444', 'Not Available'),
('R1011', 'STD', 'E65070503445', 'Available'),
('R1012', 'SUI', 'E65070503446', 'Not Available'),
('R1013', 'DLX', 'E65070503444', 'Not Available'),
('R1014', 'FAM', 'E65070503438', 'Available'),
('R1015', 'STD', 'E65070503439', 'Not Available'),
('R1016', 'SUI', 'E65070503440', 'Not Available'),
('R1017', 'DLX', 'E65070503441', 'Not Available'),
('R1018', 'FAM', 'E65070503442', 'Not Available'),
('R1019', 'STD', 'E65070503437', 'Available'),
('R1020', 'SUI', 'E65070503445', 'Not Available');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`BookingNo`);

--
--


--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`GuestID`);

--
-- Indexes for table `promotion_setup`
--
ALTER TABLE `promotion_setup`
  ADD PRIMARY KEY (`PromotionID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`ReservationID`),
  ADD KEY `BookingNo` (`BookingNo`);



--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`GuestID`) REFERENCES `guest` (`GuestID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_guest_id` FOREIGN KEY (`GuestID`) REFERENCES `guest` (`GuestID`) ON DELETE CASCADE ON UPDATE CASCADE;

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






/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
