-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2019 at 10:19 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

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
(8, 'ศูนย์บรรณสาร');

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
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `checkname`
--

INSERT INTO `checkname` (`checknameID`, `studentID`, `classID`, `datetime`, `picture`, `status`) VALUES
(64, 59142901, 6, '2019-11-30 09:46:46', '5de22c76f1740.png', ''),
(65, 59142901, 7, '2019-11-30 10:54:10', '5de23c4270bcc.png', '');

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
  `startdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classID`, `courseID`, `roomID`, `starttime`, `endtime`, `startdate`) VALUES
(1, 3, 1, '08:00:00', '19:00:00', '2019-11-28'),
(2, 4, 2, '08:00:00', '23:00:00', '2019-11-28'),
(3, 4, 2, '08:00:00', '10:00:00', '2019-11-28'),
(4, 5, 3, '10:00:00', '10:00:00', '2019-11-28'),
(5, 5, 3, '10:00:00', '10:00:00', '2019-11-28'),
(6, 6, 4, '08:00:00', '10:00:00', '2019-11-28'),
(7, 6, 7, '11:00:00', '15:00:00', '2019-11-30'),
(8, 7, 5, '08:00:00', '13:00:00', '2019-11-29'),
(9, 8, 6, '08:00:00', '13:00:00', '2019-11-28'),
(10, 8, 4, '08:00:00', '13:00:00', '2019-11-28'),
(11, 8, 5, '08:00:00', '13:00:00', '2019-11-28'),
(12, 9, 2, '08:00:00', '13:00:00', '2019-11-29'),
(13, 10, 2, '08:00:00', '13:00:00', '2019-11-28');

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
(8, 5, 'E-Testing 3', '');

-- --------------------------------------------------------

-- -----------------------------------------------------
-- Table `Project`.`lecturers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Project`.`lecturers` (
  `lecturerID` INT NOT NULL,
  `firstName` VARCHAR(45) NOT NULL,
  `lastName` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `phoneNumber` INT(10) NOT NULL,
  `roleID` INT NOT NULL,
  `userID` INT NOT NULL,
  PRIMARY KEY (`lecturerID`, `roleID`, `userID`),
  INDEX `fk_lecturers_role1_idx` (`roleID` ASC),
  INDEX `fk_lecturers_user1_idx` (`userID` ASC),
  CONSTRAINT `fk_lecturers_role1`
    FOREIGN KEY (`roleID`)
    REFERENCES `Project`.`role` (`roleID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lecturers_user1`
    FOREIGN KEY (`userID`)
    REFERENCES `Project`.`user` (`userID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentID` int(11) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentID`, `firstName`, `lastName`, `email`, `phone`, `userID`) VALUES
(51247983, 'Test', 'la', 'test1@gmail.com', '', 3),
(59142901, 'phatthanasak', 'phisatsin', 'test@gmail.com', '', 3);

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
(3, 59142901),
(4, 51247983),
(4, 59142901),
(5, 51247983),
(5, 59142901),
(6, 59142901),
(7, 59142901);

-- --------------------------------------------------------

--
-- Table structure for table `teaching`
--

CREATE TABLE `teaching` (
  `courseID` int(11) NOT NULL,
  `lecturerID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(2, 'user', '$2y$10$z0glw9l0y.YcYQGPmM7eCuRmuNoZgVED5YxP/yVKBkJYrFaaNIVpe', 2, 'user');

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
  ADD PRIMARY KEY (`studentID`,`userID`),
  ADD KEY `fk_students_user1_idx` (`userID`);

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
  ADD PRIMARY KEY (`courseID`,`lecturerID`,`roleID`),
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
  MODIFY `buildingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `checkname`
--
ALTER TABLE `checkname`
  MODIFY `checknameID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `classID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `courseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- Constraints for table `studentsregeter`
--
ALTER TABLE `studentsregeter`
  ADD CONSTRAINT `fk_studentsregeter_courses_coursesID` FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_studentsregeter_students_studentID` FOREIGN KEY (`studentID`) REFERENCES `students` (`studentID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
