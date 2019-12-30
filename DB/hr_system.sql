-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2019 at 06:01 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
(1, '2019-11-04', 45454, '', 1, 0, 0),
(2, '2019-11-11', 215487, '', 1, 0, 0),
(6, NULL, 9999999, '', 0, 0, 0),
(7, NULL, 20, NULL, 0, 0, 0),
(8, NULL, 10000, NULL, 0, 0, 0),
(24, NULL, NULL, NULL, 1, 1, 1),
(25, NULL, NULL, NULL, 0, 0, 0),
(26, NULL, NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `Value` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `Request_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `Value`, `user_id`, `Request_id`) VALUES
(5, 'asds', 0, 20),
(6, 'dsdasd', 0, 20);

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
(1, 'Islam', 'Islam', '40BD001563085FC35165329EA1FF5C5ECBDBBEEF', 'islammagdi1@gmail.com', '', '225999999', 1, 1, 'admin'),
(2, 'Zaky', 'Zaky', '40BD001563085FC35165329EA1FF5C5ECBDBBEEF', 'abanoubgeorge16@gmail.com', '', '225585', 1, 1, 'qc'),
(3, 'Fawler', 'Fawler', '40BD001563085FC35165329EA1FF5C5ECBDBBEEF', 'FawlerMorgan@gmail.com', '', '444487', 2, 1, 'user'),
(6, 'Micah', 'MBell', '40BD001563085FC35165329EA1FF5C5ECBDBBEEF', 'Micah@cowboy.com', '', '00000000', 0, 1, 'user'),
(7, 'fady', 'fady', '7C4A8D09CA3762AF61E59520943DC26494F8941B', 'fadybassel1@gmail.com', '', '12345678902332', 0, 1, 'user'),
(8, 'Ahmed Emad', 'aahmedeemad', '40BD001563085FC35165329EA1FF5C5ECBDBBEEF', 'ahmed3madeldin@gmail.com', '01001761142', '12345678912377', 1, 1, 'admin'),
(24, 'mark', 'mark', '7C4A8D09CA3762AF61E59520943DC26494F8941B', 'mark.refaat.ramzy@gmail.com', '01278249244', '29999999999999', 1, 1, 'user'),
(25, 'Eazy', 'Eazy-E', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'mohamed1701989@miuegypt.edu.eg', '01115558792', '12345678912345', 1, 1, 'admin'),
(26, 'paul', 'paul', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'paul@gmail.com', '01115558793', '12345678912347', 1, 1, 'user');

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
(1, 'What is SYSTEMNA', 'SYSTEMNA is our company&#39;s HR system, where you can register for an account to easily request HR letter at anytime & from anywhere.', NULL, 'aahmedeemad'),
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
  `requester_email` varchar(250) NOT NULL,
  `requester_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `subject`, `message`, `requester_name`, `requester_email`, `requester_id`) VALUES
(1, 'testing subject', 'testing message', '1', '1', '1');

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
  `Status` tinyint(1) DEFAULT NULL,
  `priority` tinyint(1) NOT NULL,
  `salary` tinyint(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`Request_id`, `emp_id`, `Status`, `priority`, `salary`, `date`, `type_name`) VALUES
(20, 26, 1, 0, 1, '2019-12-14 22:00:00', 'General HR Letter'),
(21, 26, 2, 1, 1, '2019-12-14 22:00:00', 'General HR Letter'),
(23, 26, 2, 0, 1, '2019-12-14 22:00:00', 'HR Letter directed to specific organization'),
(24, 26, 2, 1, 0, '2019-12-14 22:00:00', 'HR Letter to whom it may concern'),
(30, 26, 2, 0, 1, '2019-12-15 22:00:00', 'Embassy HR Letter'),
(35, 2, 2, 0, 1, '2019-12-20 22:00:00', 'HR Letter to whom it may concern'),
(36, 2, 2, 0, 0, '2019-12-21 00:15:31', 'Embassy HR Letter'),
(37, 2, 2, 1, 0, '2019-12-21 00:16:25', 'General HR Letter'),
(38, 8, 1, 1, 1, '2019-12-21 13:25:56', 'General HR Letter');

-- --------------------------------------------------------

--
-- Table structure for table `requests_types`
--

CREATE TABLE `requests_types` (
  `Type_id` int(50) NOT NULL,
  `Name` text NOT NULL,
  `description` text NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests_types`
--

INSERT INTO `requests_types` (`Type_id`, `Name`, `description`, `body`) VALUES
(2, 'Embassy HR Letter', 'This is a letter that is directed to the embassy for travelling', ''),
(3, 'HR Letter directed to specific organization', 'This is a letter for a specific place whether bank or any other institutions ', ''),
(4, 'HR Letter to whom it may concern', 'This is a letter that doesn\'t require to choose the person who would get the letter', ''),
(32, 'General HR Letter', 'This is a letter that could be submitted for any required paper', '<pre>Date: (.DATE.) \n\nTo Whom It May Concern:\n\n\nDear Sir or Madam,\n\nThis is to certify that (.NAME.)  is an employee at systemna and is working as a (.POSITION.)  since (.START.) . (.SALARY.).\n\nIf you have any questions , please contact our office at 0225633772.\n</pre>');

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
(53, 1, '5454545415154', 'Cairo,egypt', '2019-11-04', 'basic-info', 0),
(58, 24, 'mark@gmail.commmmm', '01278249244', NULL, 'contact-info', 0),
(59, 24, 'mark refatt', NULL, NULL, 'fullname', 0),
(60, 24, 'mark@gmail.commm', '01278249244', NULL, 'contact-info', 0);

-- --------------------------------------------------------

--
-- Table structure for table `update_info1`
--

CREATE TABLE `update_info1` (
  `ID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `OldValue` varchar(255) NOT NULL,
  `Value` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `update_info1`
--

INSERT INTO `update_info1` (`ID`, `UID`, `OldValue`, `Value`, `Type`, `Status`) VALUES
(2, 24, 'mark@gmail.com', 'mark@gmail.commm', 'email', 2),
(3, 24, 'mark', 'markkkk', 'fullname', 2),
(4, 24, 'mark@gmail.com', 'mark@gmail.comm', 'email', 2),
(5, 24, '01278249244', '012782492442', 'phone', 2),
(6, 24, 'mark', 'markk', 'username', 2),
(7, 24, '123456', '123', 'password', 2),
(8, 24, '29999999999999', '29999999999991', 'ssn', 2),
(9, 24, '', 'cairo', 'location', 2),
(10, 24, '', '2019-12-19', 'birthdate', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_info`
--
ALTER TABLE `add_info`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `emp_id` (`emp_id`);

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
-- Indexes for table `update_info1`
--
ALTER TABLE `update_info1`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `Request_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `requests_types`
--
ALTER TABLE `requests_types`
  MODIFY `Type_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `update_info`
--
ALTER TABLE `update_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `update_info1`
--
ALTER TABLE `update_info1`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`id`);

--
-- Constraints for table `update_info`
--
ALTER TABLE `update_info`
  ADD CONSTRAINT `update_info_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `employee` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
