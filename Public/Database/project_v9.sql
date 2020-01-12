-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2020 at 11:22 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `buildingID` int(11) NOT NULL,
  `buildingName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`buildingID`, `buildingName`) VALUES
(1, 'อาคารเรียนรวม1'),
(2, 'อาคารเรียนรวม3'),
(3, 'อาคารเรียนรวม5'),
(4, 'อาคารเรียนรวม7'),
(5, 'อาคารคอมพิวเตอร์'),
(6, 'อาคารสถาปัตยกรรม'),
(7, 'นวัตกรรม'),
(8, 'ศูนย์บรรณสาร'),
(9, 'สะพานปลา');

-- --------------------------------------------------------

--
-- Table structure for table `checkname`
--

CREATE TABLE `checkname` (
  `checknameID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `classID` int(7) DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `picture` varchar(255) NOT NULL,
  `status` varchar(45) NOT NULL,
  `latitude` varchar(45) NOT NULL,
  `longitude` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `checkname`
--

INSERT INTO `checkname` (`checknameID`, `studentID`, `classID`, `datetime`, `picture`, `status`, `latitude`, `longitude`) VALUES
(92, 59142901, 1, '2019-12-03 21:02:17', '5de66ae9a0739.png', '', '8.6520736', '99.9129955'),
(93, 59142901, 1, '2019-12-03 21:04:18', '5de66b620c94b.png', '', '8.6520736', '99.9129955'),
(94, 59142901, 1, '2019-12-03 21:29:11', '5de6713710d7a.png', '', '8.6520736', '99.9129955'),
(95, 59142901, 1, '2019-12-03 21:29:20', '5de6714050e51.png', '', '8.6520736', '99.9129955'),
(96, 59142901, 1, '2019-12-03 21:30:11', '5de6717317726.png', '', '8.6520736', '99.9129955'),
(97, 59142901, 1, '2019-12-04 09:36:11', '5de71b9ba1a35.png', '', 'err-latitude', 'err-longitude'),
(98, 59142901, 1, '2019-12-04 10:26:58', '5de72782e3d94.png', '', '', ''),
(99, 59142901, 1, '2019-12-04 10:32:21', '5de728c589cc7.png', '', '', ''),
(100, 59142901, 1, '2019-12-04 11:01:20', '5de72f908400c.png', '', '8.6414941', '99.8917365'),
(101, 59142901, 1, '2019-12-04 11:02:15', '5de72fc7b0c36.png', '', '8.6414618', '99.8917748'),
(102, 59142901, 1, '2019-12-04 11:03:00', '5de72ff4b4811.png', '', '8.6415066', '99.8916107'),
(103, 59142901, 1, '2019-12-04 11:03:21', '5de7300961cd9.png', '', '8.6415066', '99.8916107'),
(104, 59142901, 6, '2019-12-04 11:03:35', '5de7301746f22.png', '', '8.6415066', '99.8916107');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `classID` int(7) NOT NULL,
  `courseID` int(11) NOT NULL,
  `roomID` int(11) NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `startdate` date NOT NULL,
  `startcheck` time NOT NULL,
  `endcheck` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classID`, `courseID`, `roomID`, `starttime`, `endtime`, `startdate`, `startcheck`, `endcheck`) VALUES
(1, 6, 4, '09:00:00', '16:45:00', '2019-12-24', '14:00:00', '14:30:00'),
(2, 6, 4, '13:00:00', '17:00:00', '2019-12-09', '00:00:00', '00:00:00'),
(3, 6, 4, '13:00:00', '17:00:00', '2019-12-16', '00:00:00', '00:00:00'),
(4, 6, 4, '13:00:00', '17:00:00', '2019-12-23', '00:00:00', '00:00:00'),
(5, 6, 4, '13:00:00', '17:00:00', '2019-12-30', '00:00:00', '00:00:00'),
(6, 6, 4, '13:00:00', '17:00:00', '2019-12-30', '00:00:00', '00:00:00'),
(7, 6, 4, '13:00:00', '17:00:00', '2020-01-06', '00:00:00', '00:00:00'),
(8, 6, 4, '13:00:00', '17:00:00', '2020-01-13', '00:00:00', '00:00:00'),
(9, 6, 4, '13:00:00', '17:00:00', '2020-01-20', '00:00:00', '00:00:00'),
(10, 6, 4, '13:00:00', '17:00:00', '2020-01-27', '00:00:00', '00:00:00'),
(11, 6, 4, '13:00:00', '17:00:00', '2020-01-03', '00:00:00', '00:00:00'),
(43, 3, 6, '08:00:00', '15:00:00', '2019-12-09', '08:00:00', '15:15:00'),
(44, 7, 7, '09:00:00', '09:59:00', '2019-12-04', '09:05:00', '09:30:00'),
(45, 3, 6, '08:00:00', '15:00:00', '2019-12-26', '08:00:00', '15:15:00'),
(50, 6, 5, '06:00:00', '22:00:00', '2019-11-25', '06:00:00', '22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseID` int(11) NOT NULL,
  `courseCode` varchar(45) NOT NULL,
  `courseName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseID`, `courseCode`, `courseName`) VALUES
(3, 'SWE-204', 'Software Construction II'),
(4, 'SWE-315', 'Cloud Computing'),
(5, 'SWE-343', 'Service Oriented Architecture and Web Service Technology	'),
(6, 'SWE-345', 'Introduction to Embedded Systems'),
(7, 'SWE-372', 'Software Project Management'),
(8, 'SWE-386', 'Business Intelligence'),
(9, 'SWE-494', 'Senior Project in Software Engineering 1'),
(10, 'SWE-495', 'Senior Project in Software Engineering 2');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `lecturerID` int(11) NOT NULL,
  `prefix` varchar(12) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phoneNumber` int(10) NOT NULL,
  `roleID` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`lecturerID`, `prefix`, `firstName`, `lastName`, `email`, `phoneNumber`, `roleID`, `user_id`) VALUES
(1, 'นางสาว', 'พุทธิพร', 'ธนธรรมเมธี', 'putthiporn.th@wu.ac.th', 75672283, 2, '3'),
(2, 'นางสาว', 'เยาวเรศ', 'ศิริสถิตย์กุล', 'syaowara@wu.ac.th', 75672272, 2, '4'),
(3, 'นาย', 'qqqqqqqqqq', 'sdfsdlfkmsklasda', 'akmfwmpmqwsklfm', 778888, 1, '7');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `parentID` int(11) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleID` int(11) NOT NULL,
  `roleName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleID`, `roleName`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'lecturer');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomID` int(11) NOT NULL,
  `buildingID` int(11) NOT NULL,
  `roomname` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomID`, `buildingID`, `roomname`, `location`) VALUES
(1, 6, 'AD1106', ''),
(2, 7, 'ห้องศูนย์วิศวฯซอฟแวร', ''),
(3, 8, 'บรรณฯ 2', ''),
(4, 5, 'E-Testing 2', ''),
(5, 6, 'AD1301', ''),
(6, 6, 'AD1101', ''),
(7, 3, '05206', ''),
(8, 5, 'E-Testing 3', ''),
(9, 9, '', '98.584, 84.798');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentID` int(11) NOT NULL,
  `prefix` varchar(12) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentID`, `prefix`, `firstName`, `lastName`, `email`, `phone`, `user_id`) VALUES
(51247983, 'นางสาว', 'QQQQQ', 'QQQQQ', 'QQQQQQ', '78987897', 7),
(59123456, 'นาย', 'testest', 'lestlest', 'lestlest@gmail.com', '0874589652', 6),
(59142901, 'นาย', 'phatthanasak', 'phisatsin', 'test@gmail.com', '', 5);

-- --------------------------------------------------------

--
-- Table structure for table `studentsregeter`
--

CREATE TABLE `studentsregeter` (
  `courseID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studentsregeter`
--

INSERT INTO `studentsregeter` (`courseID`, `studentID`) VALUES
(3, 59123456),
(3, 59142901),
(4, 51247983),
(4, 59123456),
(4, 59142901),
(5, 51247983),
(5, 59142901),
(6, 59123456),
(6, 59142901),
(7, 59123456),
(7, 59142901),
(8, 59123456);

-- --------------------------------------------------------

--
-- Table structure for table `teaching`
--

CREATE TABLE `teaching` (
  `teachingID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  `lecturerID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teaching`
--

INSERT INTO `teaching` (`teachingID`, `courseID`, `lecturerID`, `roleID`) VALUES
(1, 9, 1, 2),
(2, 6, 2, 2),
(3, 5, 2, 2),
(4, 3, 2, 2),
(23, 6, 1, 0),
(36, 10, 2, 0),
(39, 7, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`, `name`) VALUES
(1, 'admin', '$2y$10$z0glw9l0y.YcYQGPmM7eCuRmuNoZgVED5YxP/yVKBkJYrFaaNIVpe', 1, 'admin'),
(2, 'lecturers', '$2y$10$z0glw9l0y.YcYQGPmM7eCuRmuNoZgVED5YxP/yVKBkJYrFaaNIVpe', 2, 'lecturers'),
(3, 'putthiporn.th', '$2y$10$/8R5pnqAIspk9ZkumJnIJuw8U9oKg1IBn13OgoVNPwuphAfUCe7bG', 3, 'lecturers'),
(4, 'syaowara', '$2y$10$gI9bo32r1D741RbQ1vk38ugH4OlZtwVH15ox.d4cbSIlX.o3QL2Du', 4, 'lecturers'),
(5, 'phatthanasak', '$2y$10$z0glw9l0y.YcYQGPmM7eCuRmuNoZgVED5YxP/yVKBkJYrFaaNIVpe', 4, 'phatthanasak'),
(6, 'test', 'test', 4, 'test'),
(7, 'niniininin', 'nininininin', 4, 'ninini');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`,`userID`),
  ADD KEY `fk_admin_user1_idx` (`userID`);

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`buildingID`);

--
-- Indexes for table `checkname`
--
ALTER TABLE `checkname`
  ADD PRIMARY KEY (`checknameID`),
  ADD KEY `fk_class_has_studentsRegeter_studentsRegeter1_idx` (`studentID`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classID`),
  ADD KEY `fk_courses_has_room_room1_idx` (`roomID`),
  ADD KEY `fk_courses_has_room_courses1_idx` (`courseID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`lecturerID`),
  ADD KEY `fk_lecturers_users_user_id` (`roleID`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`parentID`,`userID`),
  ADD KEY `fk_parent_user1_idx` (`userID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentID`,`user_id`),
  ADD KEY `fk_students_user1_idx` (`user_id`);

--
-- Indexes for table `studentsregeter`
--
ALTER TABLE `studentsregeter`
  ADD PRIMARY KEY (`courseID`,`studentID`),
  ADD KEY `fk_courses_has_students_students1_idx` (`studentID`),
  ADD KEY `fk_courses_has_students_courses1_idx` (`courseID`);

--
-- Indexes for table `teaching`
--
ALTER TABLE `teaching`
  ADD PRIMARY KEY (`teachingID`),
  ADD KEY `fk_courses_has_lecturers_lecturers1_idx` (`lecturerID`,`roleID`),
  ADD KEY `fk_courses_has_lecturers_courses1_idx` (`courseID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `buildingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `checkname`
--
ALTER TABLE `checkname`
  MODIFY `checknameID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `classID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `courseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `lecturerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teaching`
--
ALTER TABLE `teaching`
  MODIFY `teachingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkname`
--
ALTER TABLE `checkname`
  ADD CONSTRAINT `fk_checkname_studentregister_studentID` FOREIGN KEY (`studentID`) REFERENCES `studentsregeter` (`studentID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `fk_class_courses_coursesID` FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_class_room_roomID` FOREIGN KEY (`roomID`) REFERENCES `room` (`roomID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD CONSTRAINT `fk_lecturers_users_user_id` FOREIGN KEY (`roleID`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `studentsregeter`
--
ALTER TABLE `studentsregeter`
  ADD CONSTRAINT `fk_studentsregeter_courses_coursesID` FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_studentsregeter_students_studentID` FOREIGN KEY (`studentID`) REFERENCES `students` (`studentID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `teaching`
--
ALTER TABLE `teaching`
  ADD CONSTRAINT `fk__lecturerscourse_courses_coursesID` FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lecturersusers_lecturers_lecturersID` FOREIGN KEY (`lecturerID`) REFERENCES `lecturers` (`lecturerID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
