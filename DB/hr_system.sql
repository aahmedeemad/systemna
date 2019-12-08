-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 08, 2019 at 07:24 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `hr_system`
--

-- --------------------------------------------------------
--
-- Table structure for table `add_info`
--

CREATE TABLE `add_info` (
  `emp_id` int(11) NOT NULL,
  `bdate` date DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `profile_picture` tinyint(1) NOT NULL DEFAULT '0',
  `passport_picture` tinyint(1) DEFAULT '0',
  `n_id_picture` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_info`
--

INSERT INTO `add_info` (`emp_id`, `bdate`, `salary`, `location`, `profile_picture`, `passport_picture`, `n_id_picture`) VALUES
(1, '2019-11-04', 45454, '', 1, NULL, NULL),
(2, '2019-11-11', 215487, '', 1, NULL, NULL),
(6, NULL, 9999999, '', 0, NULL, NULL),
(24, NULL, NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------
--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `ssn` varchar(255) NOT NULL,
  `accepted` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `privilege` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `fullname`, `username`, `password`, `email`, `phone`, `ssn`, `accepted`, `active`, `privilege`) VALUES
(1, 'Islam', 'Islam', '123', 'islam@gmail.com', '', '225999999', 1, 1, 'admin'),
(2, 'Zaky', 'Zaky', '123', 'zaky@gmail.com', '', '225585', 1, 1, 'user'),
(3, 'Fawler', 'Fawler', '123', 'FawlerMorgan@gmail.com', '', '444487', 1, 1, 'user'),
(6, 'Micah', 'MBell', '123', 'Micah@cowboy.com', '', '00000000', 0, 1, 'user'),
(7, 'fady', 'fady', '123456', 'fady@hotmail.com', '', '12345678902332', 0, 1, 'user'),
(8, 'Ahmed Emad', 'aahmedeemad', '123', 'ahmed3madeldin@gmail.com', '', '12345678912377', 0, 1, 'admin'),
(24, 'mark', 'mark', '123456', 'mark@gmail.com', '01278249244', '29999999999999', 1, 1, 'user');

-- --------------------------------------------------------
--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `ID` int(11) NOT NULL,
  `Question` text NOT NULL,
  `Answer` text NOT NULL,
  `Requested_by` varchar(250) DEFAULT NULL,
  `Added_by` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`ID`, `Question`, `Answer`, `Requested_by`, `Added_by`) VALUES
(1, 'What is SYSTEMNA ?', 'SYSTEMNA is our company\'s HR system, where you can register for an account to easily request HR letter at anytime & from anywhere.', NULL, 'aahmedeemad'),
(2, 'How to view your profile ?', 'You can click here to go to your profile and view your info & requests notifications.', NULL, 'aahmedeemad'),
(3, 'How to request an HR letter ?', 'Click on this link, choose the letter type and then fill in the info.', NULL, 'aahmedeemad'),
(4, 'How to request a new question to be added ?', 'At the end of this page you will find an area to send an inquiry, feel free to message us, if the question was commonly asked, it will be added to the FAQ list.', NULL, 'aahmedeemad');

-- --------------------------------------------------------
--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `requester_name` varchar(250) NOT NULL,
  `requester_email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `subject`, `message`, `requester_name`, `requester_email`) VALUES
(1, 'testing subject', 'testing message', '1', '1');

-- --------------------------------------------------------
--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `ID` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `userid` int(11) NOT NULL,
  `notidata` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`ID`, `status`, `userid`, `notidata`) VALUES
(1, 0, 8, 'Welcome to SYSTEMNA'),
(2, 0, 8, 'This is notification number 2 for user number 8'),
(3, 0, 8, 'This is notification number 3 for user number 8'),
(4, 1, 7, 'This is notification number 1 for user number 7'),
(5, 1, 7, 'This is notification number 2 for user number 7'),
(6, 1, 1, 'This is notification number 1 for user number 1'),
(7, 1, 2, 'This is notification number 1 for user number 2'),
(8, 1, 2, 'Welcome to SYSTEMNA'),
(9, 1, 1, 'Welcome to SYSTEMNA'),
(10, 0, 3, 'Welcome to SYSTEMNA');

-- --------------------------------------------------------
--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `Request_id` int(50) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `Type_id` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `priority` tinyint(1) NOT NULL,
  `salary` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
--
-- Table structure for table `requests_types`
--

CREATE TABLE `requests_types` (
  `Type_id` int(50) NOT NULL,
  `Name` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests_types`
--

INSERT INTO `requests_types` (`Type_id`, `Name`, `description`) VALUES
(1, 'General HR Letter', 'This is a letter that could be submitted for any required paper'),
(2, 'Embassy HR Letter', 'This is a letter that is directed to the embassy for travelling'),
(3, 'HR Letter directed to specific organization', 'This is a letter for a specific place whether bank or any other institutions '),
(4, 'HR Letter to whom it may concern', 'This is a letter that doesn\'t require to choose the person who would get the letter');

-- --------------------------------------------------------
--
-- Table structure for table `update_info`
--

CREATE TABLE `update_info` (
  `ID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `val1` varchar(255) DEFAULT NULL,
  `val2` varchar(255) DEFAULT NULL,
  `val3` date DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `update_info`
--

INSERT INTO `update_info` (`ID`, `UID`, `val1`, `val2`, `val3`, `type`, `status`) VALUES
(48, 1, 'islam@gmail.com', '0111251183000', NULL, 'contact-info', 0),
(49, 1, 'Islam', NULL, NULL, 'fullname', 0),
(50, 1, '5454545415154', 'Cairo,egypt', '2019-11-04', 'basic-info', 0),
(51, 1, 'islam@gmail.com', '01112511830', NULL, 'contact-info', 0),
(52, 1, 'Islam', '1234', NULL, 'company-info', 0),
(53, 1, '5454545415154', 'Cairo,egypt', '2019-11-04', 'basic-info', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_info`
--
ALTER TABLE `add_info`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `ssn` (`ssn`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`Request_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `Type_id` (`Type_id`);

--
-- Indexes for table `requests_types`
--
ALTER TABLE `requests_types`
  ADD PRIMARY KEY (`Type_id`);

--
-- Indexes for table `update_info`
--
ALTER TABLE `update_info`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UID` (`UID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `Request_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests_types`
--
ALTER TABLE `requests_types`
  MODIFY `Type_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `update_info`
--
ALTER TABLE `update_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_info`
--
ALTER TABLE `add_info`
  ADD CONSTRAINT `add_info_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`id`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`Type_id`) REFERENCES `requests_types` (`Type_id`);

COMMIT;