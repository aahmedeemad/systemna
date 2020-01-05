-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 05, 2020 at 04:31 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

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
  `position` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `profile_picture` tinyint(1) NOT NULL DEFAULT 0,
  `passport_picture` tinyint(1) DEFAULT 0,
  `n_id_picture` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_info`
--

INSERT INTO `add_info` (`emp_id`, `bdate`, `salary`, `position`, `location`, `profile_picture`, `passport_picture`, `n_id_picture`) VALUES
(1, '2019-11-04', 45454, 'marketing manager', '', 1, 0, 0),
(2, '2019-11-11', 215487, 'sales representative', '', 1, 0, 0),
(6, NULL, 9999999, '', '', 0, 0, 0),
(7, NULL, 20, '', NULL, 0, 0, 0),
(8, NULL, 10000, 'accountant', NULL, 0, 0, 0),
(24, NULL, NULL, '', NULL, 1, 1, 1),
(25, NULL, NULL, '', NULL, 0, 0, 0),
(26, NULL, NULL, '', NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `Comment_id` int(11) NOT NULL,
  `Comment_value` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `Request_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`Comment_id`, `Comment_value`, `user_id`, `Request_id`) VALUES
(3, 'Ayhaga1', 26, 69),
(4, 'Ayhaga2', 26, 21),
(5, 'Ayhaga3', 26, 23);

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
  `start_date` date NOT NULL,
  `accepted` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `privilege` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `fullname`, `username`, `password`, `email`, `phone`, `ssn`, `start_date`, `accepted`, `active`, `privilege`) VALUES
(1, 'Islam', 'Islam', '40BD001563085FC35165329EA1FF5C5ECBDBBEEF', 'islammagdi1@gmail.com', '', '225999999', '2019-12-24', 1, 1, 'admin'),
(2, 'Bony', 'Bony', '40BD001563085FC35165329EA1FF5C5ECBDBBEEF', 'abanoubgeorge16@gmail.com', '', '225585', '0000-00-00', 1, 1, 'qc'),
(3, 'Fawler', 'Fawler', '40BD001563085FC35165329EA1FF5C5ECBDBBEEF', 'FawlerMorgan@gmail.com', '', '444487', '2020-01-05', 1, 1, 'user'),
(6, 'Micah', 'MBell', '40BD001563085FC35165329EA1FF5C5ECBDBBEEF', 'Micah@cowboy.com', '', '00000000', '0000-00-00', 0, 1, 'user'),
(7, 'fady', 'fady', '7C4A8D09CA3762AF61E59520943DC26494F8941B', 'fadybassel1@gmail.com', '', '12345678902332', '0000-00-00', 0, 1, 'user'),
(8, 'Ahmed Emad', 'aahmedeemad', '40BD001563085FC35165329EA1FF5C5ECBDBBEEF', 'ahmed3madeldin@gmail.com', '01001761142', '12345678912377', '2019-12-12', 1, 1, 'admin'),
(24, 'markkkk', 'mark', '7C4A8D09CA3762AF61E59520943DC26494F8941B', 'mark@gmail.commm', '012782492442', '29999999999991', '0000-00-00', 1, 1, 'admin'),
(25, 'Eazy', 'Eazy-E', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'mohamed1701989@miuegypt.edu.eg', '01115558792', '12345678912345', '0000-00-00', 1, 1, 'admin'),
(26, 'paul', 'paul', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'paul@gmail.com', '01115558793', '12345678912347', '0000-00-00', 1, 1, 'user'),
(27, NULL, '', '', '', '', '', '0000-00-00', NULL, NULL, NULL);

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
(2, 'How to view your profile ?', 'You can <a href=\"../pages/profile.php\" style=\"text-decoration: none;\">click here</a> to go to your profile and view or edit your info.', NULL, 'aahmedeemad'),
(3, 'How to request an HR letter ?', '<a href=\"../pages/MakeLetter.php\" style=\"text-decoration: none;\">Click on this link</a>, choose the letter type and then fill in the info.', NULL, 'aahmedeemad'),
(4, 'How to request a new question to be added ?', 'In this page you will find a form to send us an inquiry.<br>Feel free to message us, and we will get back to you.<br>If the question was commonly asked, it will be added to the FAQ list.', NULL, 'aahmedeemad');

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
(1, 'testing subject', 'testing message', '1', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `ID` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `userid` int(11) NOT NULL,
  `notidata` varchar(250) NOT NULL,
  `notihref` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`ID`, `status`, `userid`, `notidata`, `notihref`) VALUES
(26, 0, 3, 'Welcome to SYSTEMNA!', ''),
(27, 0, 3, 'Congratulations you have been promoted to an QC!', ''),
(28, 0, 1, 'Letter Request Added Successfully', ''),
(29, 0, 1, 'Letter Request Added Successfully', ''),
(30, 1, 24, 'Letter Request Added Successfully', ''),
(31, 1, 2, 'An action has been made to a letter request.', ''),
(32, 1, 2, 'An action has been made to a letter request.', ''),
(33, 0, 8, 'Your New Type of Letter Has Been Added Successfully!', '../pages/MakeLetter.php'),
(34, 0, 8, 'Your New Type of Letter Has Been Added Successfully!', '../pages/MakeLetter.php'),
(35, 0, 8, 'Your New Type of Letter Has Been Added Successfully!', '../pages/MakeLetter.php'),
(36, 0, 8, 'Your New Type of Letter Has Been Added Successfully!', '../pages/MakeLetter.php'),
(37, 0, 8, 'Your New Type of Letter Has Been Added Successfully!', '../pages/MakeLetter.php'),
(38, 0, 8, 'Your New Type of Letter Has Been Added Successfully!', '../pages/MakeLetter.php'),
(39, 0, 8, 'Your New Type of Letter Has Been Added Successfully!', '../pages/MakeLetter.php'),
(40, 0, 8, 'Your New Type of Letter Has Been Added Successfully!', '../pages/MakeLetter.php'),
(41, 0, 8, 'Your New Type of Letter Has Been Added Successfully!', '../pages/MakeLetter.php'),
(42, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(43, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(44, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(45, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(46, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(47, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(48, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(49, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(50, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(51, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(52, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(53, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(54, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(55, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(56, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(57, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(58, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(59, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(60, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(61, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(62, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(63, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(64, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(65, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(66, 0, 8, 'An action has been made to a letter request.', ''),
(67, 0, 8, 'An action has been made to a letter request.', ''),
(68, 0, 24, 'An action has been made to a letter request.', ''),
(71, 0, 8, 'An action has been made to a letter request.', ''),
(72, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(74, 0, 1, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(75, 0, 1, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(76, 0, 1, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(77, 0, 1, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(78, 0, 1, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(79, 0, 1, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(80, 0, 1, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(81, 0, 1, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(82, 0, 1, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(83, 0, 1, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(84, 0, 1, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(85, 0, 1, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(86, 0, 1, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(87, 0, 1, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(88, 0, 1, 'An action has been made to a letter request.', ''),
(89, 0, 1, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(90, 0, 1, 'An action has been made to a letter request.', ''),
(91, 0, 1, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(93, 0, 2, 'You Position has been updated to sales representative', '../pages/profile.php'),
(94, 0, 3, 'Welcome to SYSTEMNA!', '../pages/profile.php'),
(95, 0, 3, 'Welcome to SYSTEMNA!', '../pages/profile.php'),
(96, 0, 3, 'Welcome to SYSTEMNA!', '../pages/profile.php'),
(97, 0, 3, 'Welcome to SYSTEMNA!', '../pages/profile.php'),
(98, 0, 3, 'Welcome to SYSTEMNA!', '../pages/profile.php'),
(99, 0, 3, 'Welcome to SYSTEMNA!', '../pages/profile.php'),
(100, 0, 3, 'Welcome to SYSTEMNA!', '../pages/profile.php'),
(101, 0, 3, 'Welcome to SYSTEMNA!', '../pages/profile.php'),
(102, 0, 3, 'Welcome to SYSTEMNA!', '../pages/profile.php'),
(103, 0, 3, 'Welcome to SYSTEMNA!', '../pages/profile.php'),
(104, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(105, 0, 8, 'An action has been made to a letter request.', ''),
(106, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(107, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(108, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(110, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php'),
(112, 0, 8, 'Letter Request Added Successfully!', '../pages/viewRequest.php');

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
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `additional_info` varchar(200) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`Request_id`, `emp_id`, `Status`, `priority`, `salary`, `date`, `additional_info`, `type_name`) VALUES
(20, 26, 1, 0, 1, '2019-12-14 22:00:00', '', 'General HR Letter'),
(21, 26, 1, 1, 1, '2019-12-14 22:00:00', '', 'General HR Letter'),
(23, 26, 0, 0, 1, '2019-12-14 22:00:00', '', 'HR Letter directed to specific organization'),
(24, 26, 0, 1, 0, '2019-12-14 22:00:00', '', 'HR Letter to whom it may concern'),
(30, 26, 0, 0, 1, '2019-12-15 22:00:00', '', 'Embassy HR Letter'),
(35, 2, 1, 0, 1, '2019-12-20 22:00:00', '', 'HR Letter to whom it may concern'),
(36, 2, 0, 0, 0, '2019-12-21 00:15:31', '', 'Embassy HR Letter'),
(37, 2, 2, 1, 0, '2019-12-21 00:16:25', '', 'General HR Letter'),
(38, 8, 1, 1, 1, '2019-12-21 13:25:56', '', 'General HR Letter'),
(41, 24, 1, 1, 1, '2019-12-30 08:09:26', '', 'HR Letter directed to specific organization'),
(44, 1, 2, 1, 1, '2019-12-30 23:22:39', '', 'Embassy HR Letter'),
(69, 8, 1, 0, 0, '2020-01-03 02:39:26', 'medical', 'Other'),
(84, 1, 1, 0, 1, '2020-01-02 23:34:25', 'two', 'medical letter'),
(85, 1, 1, 1, 1, '2020-01-02 23:46:43', 'three', 'medical letter'),
(86, 1, 1, 1, 1, '2020-01-03 01:27:38', 'i need a letter for vacation two days', 'Other'),
(87, 8, 1, 0, 0, '2020-01-04 23:46:21', 'Sudan', 'Embassy HR Letter'),
(88, 8, 2, 1, 0, '2020-01-05 00:04:26', '0', 'General HR Letter'),
(89, 8, 2, 0, 1, '2020-01-05 01:19:59', '0', 'Embassy HR Letter'),
(90, 8, 1, 0, 1, '2020-01-05 01:23:16', 'medical letter', 'Other'),
(92, 8, 1, 1, 1, '2020-01-05 01:39:51', 'test test', 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `requests_types`
--

CREATE TABLE `requests_types` (
  `Type_id` int(50) NOT NULL,
  `Name` text NOT NULL,
  `description` text NOT NULL,
  `body` text NOT NULL,
  `additional_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests_types`
--

INSERT INTO `requests_types` (`Type_id`, `Name`, `description`, `body`, `additional_info`) VALUES
(1, 'Other', 'if non of the below', '', 'write what you need'),
(2, 'Embassy HR Letter', 'This is a letter that is directed to the embassy for travelling', '<pre>(.DATE.) \r\n\r\nDear Sir/Madam,\r\n\r\nI am writing to confirm that (.NAME.)  is an employee of systemna Co. and is working as a (.POSITION.) .\r\nhas been an employee since (.START.)  and (.SALARY.) . \r\nthey intend to visit (.ADDITIONAL.)  in the period spanning her work leave. Thus, we would appreciate it if you provided her with all the necessary assistance during this time. Probably, this might improve her performance when she resumes subsequently.\r\nKindly contact us for any further clarification you might require.\r\nThank you.\r\n\r\nSincerely\r\nHR team.</pre>', 'what country are you travelling to?'),
(3, 'HR Letter directed to specific organization', 'This is a letter for a specific place whether bank or any other institutions ', '<pre>Date: (.DATE.) \n\n\nDirected to (.ADDITIONAL.) :\n\n\nDear Sir or Madam,\n\nThis is to certify that Mr. (.NAME.)  is an employee at systemna and is working as a (.POSITION.)  since (.START.) . (.SALARY.).\n\nIf you have any questions , please contact our office at 022168645.\n\nsincerly,\nHR team</pre>', 'what is the Organization name ?'),
(32, 'General HR Letter', 'This is a letter that could be submitted for any required paper', '<pre>Date: (.DATE.) \n\nTo Whom It May Concern:\n\n\nDear Sir or Madam,\n\nThis is to certify that (.NAME.)  is an employee at systemna and is working as a (.POSITION.)  since (.START.) . (.SALARY.).\n\nIf you have any questions , please contact our office at 0225633772.\n</pre>', '0');

-- --------------------------------------------------------

--
-- Table structure for table `special_request`
--

CREATE TABLE `special_request` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `Name` text COLLATE utf8_bin NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `special_request`
--

INSERT INTO `special_request` (`id`, `request_id`, `Name`, `body`) VALUES
(13, 69, 'medical', 'this is for fady bassel'),
(18, 86, 'vacation letter', 'this is for islam regarding the two days vacation'),
(19, 90, 'medical test ', 'this is for ahmed emad for medical request'),
(21, 92, 'hhh', 'nqafwodpjk');

-- --------------------------------------------------------

--
-- Table structure for table `update_info`
--

CREATE TABLE `update_info` (
  `ID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `OldValue` varchar(255) NOT NULL,
  `Value` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `update_info`
--

INSERT INTO `update_info` (`ID`, `UID`, `OldValue`, `Value`, `Type`, `Status`) VALUES
(2, 24, 'mark@gmail.com', 'mark@gmail.commm', 'email', 1),
(3, 24, 'mark', 'markkkk', 'fullname', 1),
(4, 24, 'mark@gmail.com', 'mark@gmail.comm', 'email', 2),
(5, 24, '01278249244', '012782492442', 'phone', 1),
(6, 24, 'mark', 'markk', 'username', 2),
(7, 24, '123456', '123', 'password', 2),
(8, 24, '29999999999999', '29999999999991', 'ssn', 1),
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
  ADD PRIMARY KEY (`Comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `Request_id` (`Request_id`);

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
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userid` (`userid`);

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
-- Indexes for table `special_request`
--
ALTER TABLE `special_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`);

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
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `Comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `Request_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `requests_types`
--
ALTER TABLE `requests_types`
  MODIFY `Type_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `special_request`
--
ALTER TABLE `special_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `update_info`
--
ALTER TABLE `update_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_info`
--
ALTER TABLE `add_info`
  ADD CONSTRAINT `add_info_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`Request_id`) REFERENCES `requests` (`Request_id`),
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `comment_ibfk_4` FOREIGN KEY (`Request_id`) REFERENCES `requests` (`Request_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `employee` (`id`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`id`);

--
-- Constraints for table `special_request`
--
ALTER TABLE `special_request`
  ADD CONSTRAINT `special_request_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `requests` (`Request_id`);

--
-- Constraints for table `update_info`
--
ALTER TABLE `update_info`
  ADD CONSTRAINT `update_info_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `employee` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
