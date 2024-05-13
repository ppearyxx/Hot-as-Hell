-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 07:34 AM
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
-- Database: `hotashell`
--

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `Guest` (
  `GuestID` INT PRIMARY KEY,
  `FirstName` VARCHAR(50) NOT NULL,
  `LastName` VARCHAR(50) NOT NULL,
  `Telephone` VARCHAR(20) NOT NULL,
  `Email` VARCHAR(100) NOT NULL,
  `Password` VARCHAR(255) NOT NULL,
  `NationalID` VARCHAR(20) NOT NULL,
  `PassportNo` VARCHAR(20) NOT NULL,
  `DOB` DATE NOT NULL,
  `Gender` CHAR(1) NOT NULL
); ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`guestid`, `fname`, `lname`, `tel`, `email`, `gpassword`, `nationalid`, `passportno`, `dateofbirth`, `gender`) VALUES
('G1001', 'Skibidi', 'Sigma', '0928371111', 'rizzler44@hmail.com', 'skb37281', '1342342456455', 'PP9384827', '2023-02-07', 'O');

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
COMMIT;


----Employee--------
CREATE TABLE Employee (
  `EmployeeID` INT AUTO_INCREMENT PRIMARY KEY,
  `FirstName` VARCHAR(50) NOT NULL,
  `LastName` VARCHAR(50) NOT NULL,
  `PositionID` INT NOT NULL,
  `Contact` VARCHAR(20) NOT NULL,
  `DOB` DATE NOT NULL,
  `Gender` ENUM('Male', 'Female') NOT NULL
);


-----Payment-------
CREATE TABLE `Payment` (
  `PaymentID` INT AUTO_INCREMENT PRIMARY KEY,
  `EarnestPayCheck` DECIMAL(10, 2), 
  `PaymentMethodID` INT, 
  `PromotionID` INT, 
  `TotalAmount` DECIMAL(10, 2), 
  `EarnestPayDatetime` DATETIME, 
  `TotalPayDatetime` DATETIME 
);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
