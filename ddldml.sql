-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 02, 2020 at 09:52 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic-reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(10) NOT NULL,
  `admin_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `admin_id`) VALUES
('admintest', 'a0001'),
('testadmin', 'a0002');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` varchar(5) NOT NULL,
  `comment_caption` varchar(5) DEFAULT NULL,
  `reservation_id` varchar(5) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `username` varchar(10) NOT NULL,
  `doctor_id` varchar(5) DEFAULT NULL,
  `doctor_type` varchar(10) DEFAULT NULL,
  `doctor_room` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`username`, `doctor_id`, `doctor_type`, `doctor_room`) VALUES
('doctor44', 'd0001', 'specialist', '3042'),
('doctorXD', 'd0002', 'general', '1323');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `document_id` varchar(5) NOT NULL,
  `document_type` varchar(10) DEFAULT NULL,
  `document_name` varchar(10) DEFAULT NULL,
  `document_format` varchar(10) DEFAULT NULL,
  `document_size` int(11) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `username` varchar(10) NOT NULL,
  `patient_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`username`, `patient_id`) VALUES
('pasien44', 'p0001'),
('lordkazuma', 'p0002'),
('patient72', 'p0003'),
('pasien11', 'p0004');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` varchar(5) NOT NULL,
  `reservation_date` date DEFAULT NULL,
  `reservation_caption` varchar(50) DEFAULT NULL,
  `reservation_time` time NOT NULL DEFAULT current_timestamp(),
  `reservation_status` varchar(10) NOT NULL,
  `patient_id` varchar(5) DEFAULT NULL,
  `doctor_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `reservation_date`, `reservation_caption`, `reservation_time`, `reservation_status`, `patient_id`, `doctor_id`) VALUES
('r0001', '2020-05-08', 'fox jumps over', '12:00:00', 'reserved', 'p0003', 'd0001'),
('r0002', '2020-05-08', 'abc\n', '16:30:00', 'reserved', 'p0003', 'd0001'),
('r0003', '2020-05-08', 'wfqcsa', '11:00:00', 'reserved', 'p0003', 'd0001');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` varchar(5) NOT NULL,
  `day` varchar(10) NOT NULL,
  `start_time` time NOT NULL DEFAULT current_timestamp(),
  `finish_time` time NOT NULL DEFAULT '00:00:00',
  `doctor_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `day`, `start_time`, `finish_time`, `doctor_id`) VALUES
('s0001', 'friday', '10:12:00', '12:17:00', 'd0001'),
('s0002', 'friday', '16:00:00', '18:00:00', 'd0001');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `account_type` varchar(10) NOT NULL,
  `complete_name` varchar(50) NOT NULL,
  `place_of_birth` varchar(20) NOT NULL,
  `date_of_birth` date NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(50) NOT NULL,
  `account_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `account_type`, `complete_name`, `place_of_birth`, `date_of_birth`, `phone_number`, `email`, `address`, `account_created`) VALUES
('admintest', '12345678', 'admin', '12345678', '0123012930', '2000-05-20', '08123456789', 'zar@gmail.com', 'mataram', '2020-05-01 22:27:27'),
('doctor44', '12345678', 'doctor', 'dokter', 'dokter', '2000-01-01', '08123456789', 'zar@gmail.com', 'mataram4', '2020-05-01 21:15:42'),
('doctorXD', '12345678', 'doctor', 'kazuma sensei', 'nippon', '2000-11-11', '08123456789', 'zar@gmail.com', 'mataram', '2020-05-02 06:06:06'),
('lordkazuma', 'kazumasan', 'patient', 'satou crapzuma', 'nippon', '2005-01-01', '08123456789', 'zar@gmail.com', 'mataram', '2020-05-01 15:23:32'),
('pasien11', 'pasien123', 'patient', 'pasient empat tujuh', 'djakarta', '1998-02-20', '08123456789', 'zar@gmail.com', 'mataram', '2020-05-02 04:04:12'),
('pasien44', '12345678', '', 'riza rizky', 'mtr', '2000-05-20', '08123456789', 'zar@gmail.com', 'matarama', '2020-05-01 09:15:14'),
('patient72', '12345678', 'patient', 'patient72', 'patient72', '2000-05-20', '08123456789', 'zar@gmail.com', '4mataram5', '2020-05-01 15:23:35'),
('testadmin', '12345678', 'admin', 'test_administrator', 'test', '2020-04-29', '08123456789', 'test@gmail.com', 'test_address', '2020-05-01 22:21:56'),
('testpat', '123456', 'patient', 'patient', 'test', '2020-04-29', 'test', 'test', 'test', '2020-04-29 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `admin_id` (`admin_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `reservation_id` (`reservation_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `patient_id` (`patient_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON DELETE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
