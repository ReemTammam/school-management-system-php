-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2025 at 08:19 PM
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
-- Database: `hogwarts_middle_school_performance_and_records_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `absences`
--

CREATE TABLE `absences` (
  `AbsenceID` int(11) NOT NULL,
  `StudID` int(11) NOT NULL,
  `ClassID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absences`
--

INSERT INTO `absences` (`AbsenceID`, `StudID`, `ClassID`, `Date`, `Reason`) VALUES
(1, 1003, 6, '2025-11-02', 'Sick'),
(2, 1007, 4, '2025-11-02', 'Family emergency'),
(3, 1007, 7, '2025-11-10', 'Overslept'),
(4, 1009, 2, '2025-11-05', 'Doctor appointment'),
(5, 1004, 4, '2025-11-12', 'Track meet');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `ClassID` int(11) NOT NULL,
  `Subject` varchar(50) NOT NULL,
  `Grade` int(11) NOT NULL,
  `ProfID` int(11) NOT NULL,
  `Difficulty` tinyint(4) NOT NULL CHECK (`Difficulty` between 1 and 10),
  `SupplyFee` int(11) NOT NULL CHECK (`SupplyFee` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`ClassID`, `Subject`, `Grade`, `ProfID`, `Difficulty`, `SupplyFee`) VALUES
(1, 'Mathematics', 6, 110, 8, 40),
(2, 'Science', 8, 111, 7, 50),
(3, 'History', 7, 112, 6, 30),
(4, 'Physical Education', 6, 113, 5, 20),
(5, 'English Literature', 8, 114, 9, 45),
(6, 'Geography', 7, 115, 7, 35),
(7, 'Art', 6, 116, 4, 25),
(8, 'Computer Science', 8, 117, 9, 60),
(9, 'Biology', 7, 118, 8, 55),
(10, 'Music', 6, 119, 5, 30),
(11, 'Arabic', 7, 119, 7, 40);

-- --------------------------------------------------------

--
-- Table structure for table `discipline_log`
--

CREATE TABLE `discipline_log` (
  `LogID` int(11) NOT NULL,
  `StudID` int(11) NOT NULL,
  `Date` date NOT NULL DEFAULT curdate(),
  `Description` text NOT NULL,
  `Severity` enum('Low','Medium','High') NOT NULL DEFAULT 'Low'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discipline_log`
--

INSERT INTO `discipline_log` (`LogID`, `StudID`, `Date`, `Description`, `Severity`) VALUES
(1, 1000, '2025-10-12', 'Minor disruption during class', 'Low'),
(2, 1003, '2025-10-01', 'Talking during instruction time', 'Low'),
(3, 1003, '2025-10-15', 'Failure to follow safety rules', 'Medium'),
(4, 1007, '2025-09-20', 'Horseplay during PE', 'Low'),
(5, 1007, '2025-09-28', 'Ignored teacher instructions', 'Medium'),
(6, 1007, '2025-10-03', 'Pushed another student', 'High'),
(7, 1009, '2025-10-22', 'Late to class repeatedly	', 'Medium');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `EnrollmentID` int(11) NOT NULL,
  `StudID` int(11) NOT NULL,
  `ClassID` int(11) NOT NULL,
  `FinalGrade` decimal(4,2) DEFAULT NULL,
  `Attendance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`EnrollmentID`, `StudID`, `ClassID`, `FinalGrade`, `Attendance`) VALUES
(1, 1000, 1, 95.00, 98),
(2, 1000, 3, 92.00, 97),
(3, 1000, 5, 96.00, 99),
(4, 1000, 7, 94.00, 96),
(5, 1000, 9, 93.00, 95),
(6, 1001, 2, 91.00, 96),
(7, 1001, 4, 89.00, 94),
(8, 1001, 6, 93.00, 98),
(9, 1001, 8, 95.00, 97),
(10, 1001, 10, 90.00, 95),
(11, 1002, 1, 98.00, 100),
(12, 1002, 2, 96.00, 99),
(13, 1002, 3, 97.00, 100),
(14, 1002, 4, 95.00, 98),
(15, 1002, 5, 99.00, 100),
(16, 1003, 6, 85.00, 90),
(17, 1003, 7, 87.00, 92),
(18, 1003, 8, 88.00, 93),
(19, 1003, 9, 86.00, 91),
(20, 1003, 10, 89.00, 94),
(21, 1004, 1, 94.00, 98),
(22, 1004, 4, 93.00, 96),
(23, 1004, 6, 95.00, 97),
(24, 1004, 8, 97.00, 99),
(25, 1004, 10, 92.00, 95),
(26, 1005, 2, 88.00, 94),
(27, 1005, 3, 90.00, 96),
(28, 1005, 5, 91.00, 96),
(29, 1005, 7, 91.00, 95),
(30, 1005, 9, 89.00, 93),
(31, 1006, 1, 93.00, 97),
(32, 1006, 3, 91.00, 95),
(33, 1006, 5, 92.00, 96),
(34, 1006, 7, 94.00, 98),
(35, 1006, 9, 90.00, 94),
(36, 1007, 4, 82.00, 88),
(37, 1007, 5, 84.00, 90),
(38, 1007, 6, 83.00, 89),
(39, 1007, 7, 85.00, 91),
(40, 1007, 8, 86.00, 92),
(41, 1008, 2, 97.00, 99),
(42, 1008, 4, 98.00, 100),
(43, 1008, 6, 96.00, 98),
(44, 1008, 8, 99.00, 100),
(45, 1008, 10, 97.00, 99),
(46, 1009, 1, 88.00, 94),
(47, 1009, 2, 87.00, 93),
(48, 1009, 3, 89.00, 95),
(49, 1009, 4, 95.00, 98),
(50, 1009, 5, 91.00, 97),
(51, 1009, 6, 99.99, 95);

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

CREATE TABLE `professors` (
  `ProfID` int(11) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `Age` int(11) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `Subject` varchar(50) NOT NULL,
  `Grade` int(11) NOT NULL,
  `YearTeach` int(11) NOT NULL,
  `YearlySalary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`ProfID`, `FName`, `LName`, `Age`, `Gender`, `Subject`, `Grade`, `YearTeach`, `YearlySalary`) VALUES
(110, 'Olivia', 'Bennett', 39, 'Female', 'Mathemarics', 6, 12, 68000),
(111, 'Ethan', 'Cole', 42, 'Male', 'Science', 8, 15, 72000),
(112, 'Sophia', 'Lopez', 35, 'Female', 'History', 7, 9, 61000),
(113, 'Liam', 'Hughes', 50, 'Male', 'Physical Education', 6, 22, 58000),
(114, 'Isabella', 'Nguyen', 44, 'Female', 'English Literature', 8, 17, 70000),
(115, 'Jackson', 'Perez', 38, 'Male', 'Geography', 7, 11, 64000),
(116, 'Ava', 'Reed', 29, 'Female', 'Art', 6, 5, 53000),
(117, 'Lucas', 'Morgan', 47, 'Male', 'Computer Science', 8, 20, 76000),
(118, 'Mia', 'Patel', 41, 'Female', 'Biology', 7, 14, 71000),
(119, 'Noah', 'Anderson', 33, 'Male', 'Music', 6, 8, 55000),
(120, 'Mary', 'Smith', 33, 'Female', 'Art', 6, 7, 55000);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudID` int(11) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `Age` int(11) NOT NULL CHECK (`Age` between 10 and 18),
  `Gender` varchar(50) NOT NULL,
  `Grade` int(11) NOT NULL CHECK (`Grade` between 1 and 8),
  `GPA` decimal(3,2) NOT NULL CHECK (`GPA` between 0.00 and 4.00),
  `ClassCount` int(11) NOT NULL DEFAULT 0,
  `FavSubject` varchar(50) NOT NULL,
  `FavTeacher` varchar(50) NOT NULL,
  `DisciplineProbs` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudID`, `FName`, `LName`, `Age`, `Gender`, `Grade`, `GPA`, `ClassCount`, `FavSubject`, `FavTeacher`, `DisciplineProbs`) VALUES
(1000, 'Walaa', 'Davis', 12, 'Female', 7, 4.00, 5, 'Mathematics', 'Bennett', 0),
(1001, 'Liam', 'Brooks', 13, 'Male', 7, 3.70, 6, 'History', 'Lopez', 0),
(1002, 'Ava', 'Carter', 14, 'Female', 8, 3.90, 7, 'English Literature', 'Nguyen', 0),
(1003, 'Noah', 'Diaz', 12, 'Male', 6, 3.20, 5, 'Science', 'Cole', 2),
(1004, 'Sophia', 'Green', 13, 'Female', 7, 3.80, 6, 'Biology', 'Patel', 0),
(1005, 'Ethan', 'Reed', 14, 'Male', 8, 3.40, 7, 'Computer Science', 'Morgan', 1),
(1006, 'Isabella', 'Foster', 13, 'Female', 7, 3.60, 6, 'Art', 'Reed', 0),
(1007, 'Mason', 'Hayes', 12, 'Male', 6, 3.10, 5, 'Physical Education', 'Hughes', 3),
(1008, 'Mia', 'Parker', 14, 'Female', 8, 4.00, 7, 'English Literature', 'Nguyen', 0),
(1009, 'Lucas', 'Morris', 14, 'Male', 7, 3.30, 6, 'Geography', 'Perez', 1),
(1019, 'Kamsy', 'Ezevillo', 14, 'Female', 8, 3.90, 5, 'Science', 'Hughes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `Role` enum('admin','teacher') NOT NULL DEFAULT 'teacher',
  `ProfID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `PasswordHash`, `Role`, `ProfID`) VALUES
(1, 'admin', 'admin123', 'admin', NULL),
(2, 'obennett', 'obennett123', 'teacher', 110),
(3, 'ecole', 'ecole123', 'teacher', 111),
(4, 'slopez', 'slopez123', 'teacher', 112),
(5, 'lhughes', 'lhughes123', 'teacher', 113),
(6, 'inguyen', 'inguyen123', 'teacher', 114),
(7, 'jperez', 'jperez123', 'teacher', 115),
(8, 'areed', 'areed123', 'teacher', 116),
(9, 'lmorgan', 'lmorgan123', 'teacher', 117),
(10, 'mpatel', 'mpatel123', 'teacher', 118),
(11, 'nanderson', 'nanderson123', 'teacher', 119);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absences`
--
ALTER TABLE `absences`
  ADD PRIMARY KEY (`AbsenceID`),
  ADD KEY `fk_abs_stud` (`StudID`),
  ADD KEY `fk_abs_class` (`ClassID`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`ClassID`),
  ADD KEY `fk_prof` (`ProfID`);

--
-- Indexes for table `discipline_log`
--
ALTER TABLE `discipline_log`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `fk_discipline_student` (`StudID`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`EnrollmentID`),
  ADD UNIQUE KEY `unique_enroll` (`StudID`,`ClassID`),
  ADD KEY `StudID` (`StudID`),
  ADD KEY `ClassID` (`ClassID`);

--
-- Indexes for table `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`ProfID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `fk_user_prof` (`ProfID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absences`
--
ALTER TABLE `absences`
  MODIFY `AbsenceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `ClassID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `discipline_log`
--
ALTER TABLE `discipline_log`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `EnrollmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `professors`
--
ALTER TABLE `professors`
  MODIFY `ProfID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `StudID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1020;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absences`
--
ALTER TABLE `absences`
  ADD CONSTRAINT `fk_abs_class` FOREIGN KEY (`ClassID`) REFERENCES `class` (`ClassID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_abs_stud` FOREIGN KEY (`StudID`) REFERENCES `students` (`StudID`) ON DELETE CASCADE;

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `fk_prof` FOREIGN KEY (`ProfID`) REFERENCES `professors` (`ProfID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discipline_log`
--
ALTER TABLE `discipline_log`
  ADD CONSTRAINT `fk_discipline_student` FOREIGN KEY (`StudID`) REFERENCES `students` (`StudID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `fk_enroll_class` FOREIGN KEY (`ClassID`) REFERENCES `class` (`ClassID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_enroll_student` FOREIGN KEY (`StudID`) REFERENCES `students` (`StudID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_prof` FOREIGN KEY (`ProfID`) REFERENCES `professors` (`ProfID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
