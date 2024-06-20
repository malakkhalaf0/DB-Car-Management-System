# DB-Car-Management-System

## Overview

DB-Car-Management-System is a comprehensive application that allows users to manage car records in a database. Users can log in, search for cars, and manage orders and customers through various database operations including queries, insertions, updates, and deletions. The system ensures data integrity through robust validation mechanisms and provides detailed feedback messages to enhance user experience.

## Main Features

### Queries
- **Search (SELECT query)**: Allows users to find rows in a table by any combination of its fields.

### Insertion (INSERT query)
- Users can insert new rows into tables, considering foreign key references and null constraints.

### Updating Tuples (UPDATE query)
- Any value in a table can be updated by the row ID.

### Deleting Values (DELETE query)
- Users can delete any value, with cascading delete functionality where applicable.

## System Validation
The system validates input constraints to cover the following scenarios:
- Ensures that inserted values are of the same type and length defined in the database.
- Checks that primary keys are not null and are unique.
- Verifies that foreign keys in a table represent a primary key in the referenced table.
- Ensures that update or delete operations cascade on related tables.
- Provides detailed error and confirmation messages for each operation to enhance user experience.


## Usage

### Logging In
Users must log in to access the system. Credentials are validated against stored user data to ensure secure access.

### Searching for a Car
Users can search for cars by any combination of fields in the car table.

### Managing Data
Users can perform the following operations:

#### Insertion
- Insert new rows into the `Order`, `Customer`, and `Car` tables and other tables.
- Ensure foreign key references and null constraints are respected.

#### Updating
- Update existing rows by specifying the row ID.
- Ensure that updates adhere to data type and length constraints.

#### Deletion
- Delete rows, ensuring that delete operations cascade to maintain data integrity.

## Detailed Feedback
The system provides detailed feedback messages for each operation, including:
- Confirmation messages for successful operations.
- Error messages detailing the cause of any issues during operations.

## Example Usage
Technology Stack
Backend: php
Database: MySQL
Frontend: HTML, CSS

Getting Started
Prerequisites
apache server (Xamapp)
MySQL database

Running the Application
Clone the repository
import the sql file 
<code>
-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 07:39 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cars`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `buidling` int(11) NOT NULL,
  `street` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `buidling`, `street`, `city`, `country`) VALUES
(1111, 11, 'SQ_S', 'Dams', 'Syria'),
(2222, 22, 'Abdon', 'Amman', 'Jordan'),
(3333, 33, 'TrainST', 'Belfast', 'Ulster'),
(4444, 44, 'Aqua', 'Jerusalem', 'Palestine');

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `name` varchar(20) NOT NULL,
  `model` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `made` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`name`, `model`, `year`, `made`) VALUES
('Buick', 'SUV', 2023, 'General Motors'),
('Cadillac', 'elect', 2015, 'General Motors'),
('hyundai', 'Accent', 2020, 'Kyungsung'),
('Kia', 'Cerato', 2010, 'Kyungsung'),
('Malibu', 'Express', 2017, 'General Motors'),
('Opel', 'Astra', 2020, 'Vauxhall Motors');

-- --------------------------------------------------------

--
-- Table structure for table `car_part`
--

CREATE TABLE `car_part` (
  `car` varchar(20) NOT NULL,
  `part` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car_part`
--

INSERT INTO `car_part` (`car`, `part`) VALUES
('Buick', 546),
('Buick', 776),
('Buick', 321),
('Buick', 234),
('Buick', 123),
('Buick', 456),
('Cadillac', 776),
('hyundai', 321),
('Kia', 546),
('Opel', 456);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `f_name` varchar(20) NOT NULL,
  `l_name` varchar(20) NOT NULL,
  `address` int(11) NOT NULL,
  `job` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `f_name`, `l_name`, `address`, `job`) VALUES
(1, 'John', 'Doe', 4444, 'Student'),
(2, 'Sara', 'Khabib', 3333, 'Accountant'),
(3, 'Conor', 'Mcdonald', 1111, 'Couch'),
(4, 'David', 'PAt', 2222, 'Driver'),
(5, 'Ahmad', 'Daniel', 2222, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `no` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `weight` decimal(10,0) NOT NULL,
  `made` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`no`, `name`, `price`, `weight`, `made`) VALUES
(123, 'Radio', '554', '10', 'JVCKenwood'),
(234, 'nuts', '1', '1', 'EPS'),
(321, 'Bolts', '1', '2', 'EPS'),
(456, 'Wheel', '100', '50', 'Armours'),
(546, 'Battery', '560', '30', 'Philips'),
(776, 'Gearbox', '5678', '454', 'Vauxhall Motors');

-- --------------------------------------------------------

--
-- Table structure for table `manufacture`
--

CREATE TABLE `manufacture` (
  `name` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manufacture`
--

INSERT INTO `manufacture` (`name`, `type`, `city`, `country`) VALUES
('ABC', 'private', 'Jerusalem', 'Palestine'),
('Armours', 'private', 'Elk Grove Village', 'USA'),
('EPS', 'private', 'Alpharetta', 'USA'),
('General Motors', 'limited', 'Detroit', 'USA'),
('JVCKenwood', 'private', 'Tokyo', 'Japan'),
('Kyungsung', 'corporation', 'Seoul', 'South Korea'),
('Philips', 'corporation', 'Amsterdam', 'Netherlands'),
('Vauxhall Motors', 'private', 'Chalton', 'UK');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `car` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `date`, `customer`, `car`) VALUES
(9010, 112020, 5, 'Opel'),
(9011, 4122014, 3, 'hyundai'),
(9012, 452011, 4, 'Opel'),
(9013, 482017, 2, 'Kia'),
(9014, 992021, 2, 'Malibu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`name`),
  ADD KEY `made` (`made`);

--
-- Indexes for table `car_part`
--
ALTER TABLE `car_part`
  ADD KEY `car` (`car`),
  ADD KEY `part` (`part`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address` (`address`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`no`),
  ADD KEY `made` (`made`);

--
-- Indexes for table `manufacture`
--
ALTER TABLE `manufacture`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car` (`car`),
  ADD KEY `customer` (`customer`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`made`) REFERENCES `manufacture` (`name`);

--
-- Constraints for table `car_part`
--
ALTER TABLE `car_part`
  ADD CONSTRAINT `car_part_ibfk_1` FOREIGN KEY (`car`) REFERENCES `car` (`name`),
  ADD CONSTRAINT `car_part_ibfk_2` FOREIGN KEY (`part`) REFERENCES `device` (`no`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`address`) REFERENCES `address` (`id`);

--
-- Constraints for table `device`
--
ALTER TABLE `device`
  ADD CONSTRAINT `device_ibfk_1` FOREIGN KEY (`made`) REFERENCES `manufacture` (`name`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`car`) REFERENCES `car` (`name`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customer`) REFERENCES `customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

</code>
