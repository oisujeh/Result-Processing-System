-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2018 at 12:00 AM
-- Server version: 10.3.8-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblactivity_log`
--

CREATE TABLE `tblactivity_log` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `ipaddress` varchar(30) NOT NULL,
  `computername` varchar(255) NOT NULL,
  `page` text NOT NULL,
  `role` varchar(30) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcourses`
--

CREATE TABLE `tblcourses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `load` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcourses`
--

INSERT INTO `tblcourses` (`id`, `title`, `code`, `load`, `semester`, `type`, `level`) VALUES
(1, 'Introduction to Computing', 'CSC110', 3, 1, 'Core', 1),
(2, 'Algebra and Trigonometry', 'MTH110', 3, 1, 'Core', 1),
(3, 'Calculus', 'MTH112', 3, 1, 'Core', 1),
(4, 'Mechanics, Thermal Physics', 'PHY111', 3, 1, 'Core', 1),
(5, 'General Chemistry I', 'CHM111', 3, 1, 'Core', 1),
(6, 'Use of English ', 'GST111', 2, 1, 'Core', 1),
(7, 'Philosophy and Logic', 'GST112', 2, 1, 'Core', 1),
(8, 'Programming Essentials', 'CSC111', 3, 1, 'Mandatory', 1),
(9, 'Practical Physics', 'PHY109', 2, 1, 'Elective', 1),
(10, 'Vibration, Wave and Optics', 'PHY113', 3, 1, 'Elective', 1),
(11, 'Peace Studies & Conflict Resolution', 'GST121', 2, 2, 'Core', 1),
(12, 'Nigeria People and Culture', 'GST122', 2, 2, 'Core', 1),
(13, 'History and Philosophy of Science', 'GST123', 2, 2, 'Core', 1),
(14, 'Vectors, Geometry and Statistics', 'MTH123', 3, 2, 'Core', 1),
(15, 'Differential Equation and Dynamics', 'MTH125', 3, 2, 'Core', 1),
(16, 'General Chemistry II', 'CHM122', 3, 2, 'Elective', 1),
(17, 'Electromagnetism and Modern Physics', 'PHY124', 4, 2, 'Core', 1),
(18, 'Introduction to Software Packages', 'CSC120', 3, 2, 'Core', 1),
(19, 'Structural Programming in PASCAL', 'CSC211', 3, 1, 'Core', 2),
(20, 'Symbolic Programming in FORTRAN', 'CSC212', 3, 1, 'Core', 2),
(21, 'Linear Algebra', 'MTH230', 3, 1, 'Core', 2),
(22, 'Probability Distribution', 'MTH219', 3, 1, 'Core', 2),
(23, 'Information Technology: Design, Policy and Application', 'CSC217', 3, 1, 'Mandatory', 2),
(24, 'Information Interfaces & Presentation', 'CSC237', 3, 1, 'Elective', 2),
(25, 'Assembly Language Programming I', 'CSC222', 3, 2, 'Core', 2),
(26, 'Introduction to Data Processing', 'CSC220', 3, 2, 'Core', 2),
(27, 'Electromagnetism and Electronics', 'PHY224', 3, 2, 'Core', 2),
(28, 'Introductory Numerical Analysis', 'MTH227', 3, 2, 'Core', 2),
(29, 'Introduction to C and C++ Programming', 'CSC224', 3, 2, 'Mandatory', 2),
(30, 'Applied Statistics', 'MTH228', 3, 2, 'Elective', 2),
(31, 'Data Structures', 'CSC313', 3, 1, 'Core', 3),
(32, 'Digital Computer Design', 'CSC316', 3, 1, 'Core', 3),
(33, 'Introduction to Formal Language', 'CSC318', 3, 1, 'Core', 3),
(34, 'Numerical Linear Algebra', 'MTH317', 3, 1, 'Core', 3),
(35, 'Operations Research', 'CSC314', 3, 1, 'Core', 3),
(36, 'Web Technology & Applications', 'CSC311', 3, 1, 'Elective', 3),
(37, 'Assembly Language II or C Programming', 'CSC312', 3, 1, 'Mandatory', 3),
(38, 'Human Computer Interaction', 'CSC333', 3, 1, 'Elective', 3),
(39, 'Discrete Mathematics, Network & Graph Theory', 'CSC328', 3, 2, 'Core', 3),
(40, 'Computer Architecture', 'CSC326', 3, 2, 'Core', 3),
(41, 'Compiler Construction', 'CSC325', 3, 2, 'Core', 3),
(42, 'Systems Analysis and Design', 'CSC321', 3, 2, 'Core', 3),
(43, 'Research Methodology', 'CSC329', 3, 2, 'Mandatory', 3),
(44, 'Electronics', 'PHY326', 3, 2, 'Elective', 3),
(45, 'Economics of Information Technology', 'CSC323', 3, 2, 'Elective', 3),
(46, 'Research Seminar', 'CSC419', 3, 1, 'Core', 4),
(47, 'Operating Systems', 'CSC411', 3, 1, 'Core', 4),
(48, 'Design & Analysis of Computer Algorithms', 'CSC418', 3, 1, 'Core', 4),
(49, 'Systems Programming', 'CSC432', 3, 1, 'Core', 4),
(50, 'Database Management', 'CSC413', 3, 1, 'Mandatory', 4),
(51, 'Artificial Intelligence', 'CSC415', 3, 1, 'Elective', 4),
(52, 'Advanced Programming Concepts', 'CSC412', 3, 1, 'Elective', 4),
(53, 'Management Science', 'CSC414', 3, 1, 'Elective', 4),
(54, 'Project', 'CSC499', 6, 2, 'Core', 4),
(55, 'Software Engineering', 'CSC421', 3, 2, 'Core', 4),
(56, 'Concept of Programming Languages', 'CSC422', 3, 2, 'Core', 4),
(57, 'Data Communications and Networks', 'CSC427', 3, 2, 'Core', 4),
(58, 'Graph Theory and Applications', 'CSC428', 3, 2, 'Elective', 4),
(59, 'Simulations & Probability Models in OR', 'CSC424', 3, 2, 'Elective', 4),
(60, 'Advanced Digital Computer Design', 'CSC426', 3, 2, 'Elective', 4),
(61, 'Introduction to Business I', 'BUS111', 3, 1, 'Elective', 1),
(62, 'Introduction to Business I', 'BUS121', 3, 2, 'Elective', 1),
(63, 'Principles of Management I', 'BUS211', 3, 1, 'Elective', 2),
(64, 'Principles of Management II', 'BUS221', 3, 2, 'Elective', 2),
(65, 'Entrepreneurship Development', 'CED300', 3, 1, 'Mandatory', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse_reg`
--

CREATE TABLE `tblcourse_reg` (
  `id` int(11) NOT NULL,
  `settings_id` int(11) NOT NULL DEFAULT 0,
  `course_id` int(11) NOT NULL,
  `mat_no` varchar(100) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcourse_reg`
--

INSERT INTO `tblcourse_reg` (`id`, `settings_id`, `course_id`, `mat_no`, `faculty_id`, `department_id`, `level_id`, `semester_id`, `session_id`, `date`) VALUES
(1, 0, 2, 'PSC1104165', 1, 1, 1, 1, 1, '2018-10-01 17:59:24'),
(2, 0, 3, 'PSC1104165', 1, 1, 1, 1, 1, '2018-10-01 17:59:24'),
(3, 0, 14, 'PSC1104165', 1, 1, 1, 2, 1, '2018-10-01 17:59:24'),
(4, 0, 15, 'PSC1104165', 1, 1, 1, 2, 1, '2018-10-01 17:59:24'),
(5, 0, 1, 'PSC1104165', 1, 1, 1, 1, 1, '2018-10-01 17:59:59'),
(6, 0, 4, 'PSC1104165', 1, 1, 1, 1, 1, '2018-10-01 17:59:59'),
(7, 0, 5, 'PSC1104165', 1, 1, 1, 1, 1, '2018-10-01 18:00:00'),
(8, 0, 6, 'PSC1104165', 1, 1, 1, 1, 1, '2018-10-01 18:00:00'),
(9, 0, 7, 'PSC1104165', 1, 1, 1, 1, 1, '2018-10-01 18:00:00'),
(10, 0, 8, 'PSC1104165', 1, 1, 1, 1, 1, '2018-10-01 18:00:00'),
(11, 0, 9, 'PSC1104165', 1, 1, 1, 1, 1, '2018-10-01 18:00:00'),
(12, 0, 11, 'PSC1104165', 1, 1, 1, 2, 1, '2018-10-01 18:00:24'),
(13, 0, 12, 'PSC1104165', 1, 1, 1, 2, 1, '2018-10-01 18:00:24'),
(14, 0, 13, 'PSC1104165', 1, 1, 1, 2, 1, '2018-10-01 18:00:24'),
(15, 0, 18, 'PSC1104165', 1, 1, 1, 2, 1, '2018-10-01 18:02:06'),
(16, 0, 17, 'PSC1104165', 1, 1, 1, 2, 1, '2018-10-01 18:02:32'),
(17, 0, 16, 'PSC1104165', 1, 1, 1, 2, 1, '2018-10-01 18:03:20'),
(18, 0, 1, 'PSC1102480', 1, 1, 1, 1, 1, '2018-10-01 18:05:59'),
(19, 0, 2, 'PSC1102480', 1, 1, 1, 1, 1, '2018-10-01 18:05:59'),
(20, 0, 3, 'PSC1102480', 1, 1, 1, 1, 1, '2018-10-01 18:05:59'),
(21, 0, 4, 'PSC1102480', 1, 1, 1, 1, 1, '2018-10-01 18:06:00'),
(22, 0, 5, 'PSC1102480', 1, 1, 1, 1, 1, '2018-10-01 18:06:00'),
(23, 0, 6, 'PSC1102480', 1, 1, 1, 1, 1, '2018-10-01 18:06:00'),
(24, 0, 7, 'PSC1102480', 1, 1, 1, 1, 1, '2018-10-01 18:06:00'),
(25, 0, 8, 'PSC1102480', 1, 1, 1, 1, 1, '2018-10-01 18:06:00'),
(26, 0, 9, 'PSC1102480', 1, 1, 1, 1, 1, '2018-10-01 18:06:00'),
(27, 0, 11, 'PSC1102480', 1, 1, 1, 2, 1, '2018-10-01 18:06:21'),
(28, 0, 12, 'PSC1102480', 1, 1, 1, 2, 1, '2018-10-01 18:06:21'),
(29, 0, 13, 'PSC1102480', 1, 1, 1, 2, 1, '2018-10-01 18:06:21'),
(30, 0, 14, 'PSC1102480', 1, 1, 1, 2, 1, '2018-10-01 18:06:21'),
(31, 0, 15, 'PSC1102480', 1, 1, 1, 2, 1, '2018-10-01 18:06:21'),
(32, 0, 16, 'PSC1102480', 1, 1, 1, 2, 1, '2018-10-01 18:06:21'),
(33, 0, 17, 'PSC1102480', 1, 1, 1, 2, 1, '2018-10-01 18:06:21'),
(34, 0, 18, 'PSC1102480', 1, 1, 1, 2, 1, '2018-10-01 18:06:21'),
(35, 0, 1, 'PSC1104149', 1, 1, 1, 1, 1, '2018-10-01 18:07:02'),
(36, 0, 2, 'PSC1104149', 1, 1, 1, 1, 1, '2018-10-01 18:07:02'),
(37, 0, 3, 'PSC1104149', 1, 1, 1, 1, 1, '2018-10-01 18:07:02'),
(38, 0, 4, 'PSC1104149', 1, 1, 1, 1, 1, '2018-10-01 18:07:02'),
(39, 0, 5, 'PSC1104149', 1, 1, 1, 1, 1, '2018-10-01 18:07:02'),
(40, 0, 6, 'PSC1104149', 1, 1, 1, 1, 1, '2018-10-01 18:07:02'),
(41, 0, 7, 'PSC1104149', 1, 1, 1, 1, 1, '2018-10-01 18:07:02'),
(42, 0, 8, 'PSC1104149', 1, 1, 1, 1, 1, '2018-10-01 18:07:02'),
(43, 0, 9, 'PSC1104149', 1, 1, 1, 1, 1, '2018-10-01 18:07:02'),
(44, 0, 11, 'PSC1104149', 1, 1, 1, 2, 1, '2018-10-01 18:07:22'),
(45, 0, 12, 'PSC1104149', 1, 1, 1, 2, 1, '2018-10-01 18:07:22'),
(46, 0, 13, 'PSC1104149', 1, 1, 1, 2, 1, '2018-10-01 18:07:22'),
(47, 0, 14, 'PSC1104149', 1, 1, 1, 2, 1, '2018-10-01 18:07:22'),
(48, 0, 15, 'PSC1104149', 1, 1, 1, 2, 1, '2018-10-01 18:07:22'),
(49, 0, 16, 'PSC1104149', 1, 1, 1, 2, 1, '2018-10-01 18:07:22'),
(50, 0, 17, 'PSC1104149', 1, 1, 1, 2, 1, '2018-10-01 18:07:22'),
(51, 0, 18, 'PSC1104149', 1, 1, 1, 2, 1, '2018-10-01 18:07:22'),
(52, 0, 1, 'PSC1104152', 1, 1, 1, 1, 1, '2018-10-01 18:07:53'),
(53, 0, 2, 'PSC1104152', 1, 1, 1, 1, 1, '2018-10-01 18:07:53'),
(54, 0, 3, 'PSC1104152', 1, 1, 1, 1, 1, '2018-10-01 18:07:53'),
(55, 0, 4, 'PSC1104152', 1, 1, 1, 1, 1, '2018-10-01 18:07:53'),
(56, 0, 5, 'PSC1104152', 1, 1, 1, 1, 1, '2018-10-01 18:07:53'),
(57, 0, 6, 'PSC1104152', 1, 1, 1, 1, 1, '2018-10-01 18:07:53'),
(58, 0, 7, 'PSC1104152', 1, 1, 1, 1, 1, '2018-10-01 18:07:53'),
(59, 0, 8, 'PSC1104152', 1, 1, 1, 1, 1, '2018-10-01 18:07:53'),
(60, 0, 9, 'PSC1104152', 1, 1, 1, 1, 1, '2018-10-01 18:07:53'),
(61, 0, 11, 'PSC1104152', 1, 1, 1, 2, 1, '2018-10-01 18:08:09'),
(62, 0, 12, 'PSC1104152', 1, 1, 1, 2, 1, '2018-10-01 18:08:09'),
(63, 0, 13, 'PSC1104152', 1, 1, 1, 2, 1, '2018-10-01 18:08:09'),
(64, 0, 14, 'PSC1104152', 1, 1, 1, 2, 1, '2018-10-01 18:08:09'),
(65, 0, 15, 'PSC1104152', 1, 1, 1, 2, 1, '2018-10-01 18:08:09'),
(66, 0, 16, 'PSC1104152', 1, 1, 1, 2, 1, '2018-10-01 18:08:09'),
(67, 0, 17, 'PSC1104152', 1, 1, 1, 2, 1, '2018-10-01 18:08:09'),
(68, 0, 18, 'PSC1104152', 1, 1, 1, 2, 1, '2018-10-01 18:08:09'),
(69, 0, 1, 'PSC1104161', 1, 1, 1, 1, 1, '2018-10-01 18:08:30'),
(70, 0, 2, 'PSC1104161', 1, 1, 1, 1, 1, '2018-10-01 18:08:30'),
(71, 0, 3, 'PSC1104161', 1, 1, 1, 1, 1, '2018-10-01 18:08:30'),
(72, 0, 4, 'PSC1104161', 1, 1, 1, 1, 1, '2018-10-01 18:08:30'),
(73, 0, 5, 'PSC1104161', 1, 1, 1, 1, 1, '2018-10-01 18:08:30'),
(74, 0, 6, 'PSC1104161', 1, 1, 1, 1, 1, '2018-10-01 18:08:30'),
(75, 0, 7, 'PSC1104161', 1, 1, 1, 1, 1, '2018-10-01 18:08:30'),
(76, 0, 8, 'PSC1104161', 1, 1, 1, 1, 1, '2018-10-01 18:08:30'),
(77, 0, 9, 'PSC1104161', 1, 1, 1, 1, 1, '2018-10-01 18:08:30'),
(78, 0, 11, 'PSC1104161', 1, 1, 1, 2, 1, '2018-10-01 18:08:48'),
(79, 0, 12, 'PSC1104161', 1, 1, 1, 2, 1, '2018-10-01 18:08:48'),
(80, 0, 13, 'PSC1104161', 1, 1, 1, 2, 1, '2018-10-01 18:08:48'),
(81, 0, 14, 'PSC1104161', 1, 1, 1, 2, 1, '2018-10-01 18:08:48'),
(82, 0, 15, 'PSC1104161', 1, 1, 1, 2, 1, '2018-10-01 18:08:48'),
(83, 0, 16, 'PSC1104161', 1, 1, 1, 2, 1, '2018-10-01 18:08:48'),
(84, 0, 17, 'PSC1104161', 1, 1, 1, 2, 1, '2018-10-01 18:08:48'),
(85, 0, 18, 'PSC1104161', 1, 1, 1, 2, 1, '2018-10-01 18:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartment`
--

CREATE TABLE `tbldepartment` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldepartment`
--

INSERT INTO `tbldepartment` (`id`, `faculty_id`, `title`, `code`, `description`) VALUES
(1, 1, 'Computer Science', 'csc', 'computer science department');

-- --------------------------------------------------------

--
-- Table structure for table `tblfaculty`
--

CREATE TABLE `tblfaculty` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfaculty`
--

INSERT INTO `tblfaculty` (`id`, `title`, `code`) VALUES
(1, 'Physical Science', 'PSC');

-- --------------------------------------------------------

--
-- Table structure for table `tblgpa`
--

CREATE TABLE `tblgpa` (
  `id` int(11) NOT NULL,
  `mat_no` varchar(10) NOT NULL,
  `level` int(10) NOT NULL,
  `session` varchar(30) NOT NULL,
  `gpa` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblgpa`
--

INSERT INTO `tblgpa` (`id`, `mat_no`, `level`, `session`, `gpa`) VALUES
(1, 'PSC1104149', 1, '1', '4.0'),
(2, 'PSC1102480', 1, '1', '3.0000'),
(3, 'PSC1104149', 1, '1', '4.0000'),
(4, 'PSC1104152', 1, '1', '3.0000'),
(5, 'PSC1104161', 1, '1', '4.0000');

-- --------------------------------------------------------

--
-- Table structure for table `tbllevel`
--

CREATE TABLE `tbllevel` (
  `id` int(11) NOT NULL,
  `title` varchar(20) DEFAULT NULL,
  `level_int` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllevel`
--

INSERT INTO `tbllevel` (`id`, `title`, `level_int`) VALUES
(1, '100', 100),
(2, '200', 200),
(3, '300', 300),
(4, '400', 400);

-- --------------------------------------------------------

--
-- Table structure for table `tblresults`
--

CREATE TABLE `tblresults` (
  `id` int(11) NOT NULL,
  `matno` varchar(255) NOT NULL,
  `level_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `settings_id` int(11) NOT NULL DEFAULT 0,
  `course_reg_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `grade` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblresults`
--

INSERT INTO `tblresults` (`id`, `matno`, `level_id`, `session_id`, `settings_id`, `course_reg_id`, `score`, `grade`) VALUES
(1, 'PSC1104165', 1, 1, 0, 7, 39, 'F'),
(2, 'PSC1102480', 1, 1, 0, 22, 55, 'C'),
(3, 'PSC1104149', 1, 1, 0, 39, 68, 'B'),
(4, 'PSC1104152', 1, 1, 0, 56, 50, 'C'),
(5, 'PSC1104161', 1, 1, 0, 73, 60, 'B'),
(6, 'PSC1104165', 1, 1, 0, 17, 56, 'C'),
(7, 'PSC1102480', 1, 1, 0, 32, 55, 'C'),
(8, 'PSC1104149', 1, 1, 0, 49, 70, 'A'),
(9, 'PSC1104152', 1, 1, 0, 66, 50, 'C'),
(10, 'PSC1104161', 1, 1, 0, 83, 60, 'B'),
(11, 'PSC1104165', 1, 1, 0, 5, 45, 'D'),
(12, 'PSC1102480', 1, 1, 0, 18, 55, 'C'),
(13, 'PSC1104149', 1, 1, 0, 35, 70, 'A'),
(14, 'PSC1104152', 1, 1, 0, 52, 78, 'A'),
(15, 'PSC1104161', 1, 1, 0, 69, 60, 'B'),
(16, 'PSC1104165', 1, 1, 0, 10, 45, 'D'),
(17, 'PSC1102480', 1, 1, 0, 25, 55, 'C'),
(18, 'PSC1104149', 1, 1, 0, 42, 70, 'A'),
(19, 'PSC1104152', 1, 1, 0, 59, 60, 'B'),
(20, 'PSC1104161', 1, 1, 0, 76, 60, 'B'),
(21, 'PSC1104165', 1, 1, 0, 15, 60, 'B'),
(22, 'PSC1102480', 1, 1, 0, 34, 55, 'C'),
(23, 'PSC1104149', 1, 1, 0, 51, 78, 'A'),
(24, 'PSC1104152', 1, 1, 0, 68, 50, 'C'),
(25, 'PSC1104161', 1, 1, 0, 85, 60, 'B'),
(26, 'PSC1104165', 1, 1, 0, 8, 50, 'C'),
(27, 'PSC1102480', 1, 1, 0, 23, 55, 'C'),
(28, 'PSC1104149', 1, 1, 0, 40, 68, 'B'),
(29, 'PSC1104152', 1, 1, 0, 57, 50, 'C'),
(30, 'PSC1104161', 1, 1, 0, 74, 60, 'B'),
(31, 'PSC1104165', 1, 1, 0, 9, 60, 'B'),
(32, 'PSC1102480', 1, 1, 0, 24, 55, 'C'),
(33, 'PSC1104149', 1, 1, 0, 41, 78, 'A'),
(34, 'PSC1104152', 1, 1, 0, 58, 50, 'C'),
(35, 'PSC1104161', 1, 1, 0, 75, 60, 'B'),
(36, 'PSC1104165', 1, 1, 0, 12, 35, 'F'),
(37, 'PSC1102480', 1, 1, 0, 27, 55, 'C'),
(38, 'PSC1104149', 1, 1, 0, 44, 70, 'A'),
(39, 'PSC1104152', 1, 1, 0, 61, 75, 'A'),
(40, 'PSC1104161', 1, 1, 0, 78, 60, 'B'),
(41, 'PSC1104165', 1, 1, 0, 13, 65, 'B'),
(42, 'PSC1102480', 1, 1, 0, 28, 55, 'C'),
(43, 'PSC1104149', 1, 1, 0, 45, 70, 'A'),
(44, 'PSC1104152', 1, 1, 0, 62, 75, 'A'),
(45, 'PSC1104161', 1, 1, 0, 79, 60, 'B'),
(46, 'PSC1104165', 1, 1, 0, 14, 39, 'F'),
(47, 'PSC1102480', 1, 1, 0, 29, 55, 'C'),
(48, 'PSC1104149', 1, 1, 0, 46, 70, 'A'),
(49, 'PSC1104152', 1, 1, 0, 63, 75, 'A'),
(50, 'PSC1104161', 1, 1, 0, 80, 60, 'B'),
(51, 'PSC1104165', 1, 1, 0, 1, 39, 'F'),
(52, 'PSC1102480', 1, 1, 0, 19, 55, 'C'),
(53, 'PSC1104149', 1, 1, 0, 36, 70, 'A'),
(54, 'PSC1104152', 1, 1, 0, 53, 50, 'C'),
(55, 'PSC1104161', 1, 1, 0, 70, 60, 'B'),
(56, 'PSC1104165', 1, 1, 0, 2, 39, 'F'),
(57, 'PSC1102480', 1, 1, 0, 20, 55, 'C'),
(58, 'PSC1104149', 1, 1, 0, 37, 70, 'A'),
(59, 'PSC1104152', 1, 1, 0, 54, 50, 'C'),
(60, 'PSC1104161', 1, 1, 0, 71, 60, 'B'),
(61, 'PSC1104165', 1, 1, 0, 3, 39, 'F'),
(62, 'PSC1102480', 1, 1, 0, 30, 55, 'C'),
(63, 'PSC1104149', 1, 1, 0, 47, 78, 'A'),
(64, 'PSC1104152', 1, 1, 0, 64, 50, 'C'),
(65, 'PSC1104161', 1, 1, 0, 81, 60, 'B'),
(66, 'PSC1104165', 1, 1, 0, 4, 39, 'F'),
(67, 'PSC1102480', 1, 1, 0, 31, 55, 'C'),
(68, 'PSC1104149', 1, 1, 0, 48, 78, 'A'),
(69, 'PSC1104152', 1, 1, 0, 65, 50, 'C'),
(70, 'PSC1104161', 1, 1, 0, 82, 60, 'B'),
(71, 'PSC1104165', 1, 1, 0, 11, 56, 'C'),
(72, 'PSC1102480', 1, 1, 0, 26, 55, 'C'),
(73, 'PSC1104149', 1, 1, 0, 43, 70, 'A'),
(74, 'PSC1104152', 1, 1, 0, 60, 50, 'C'),
(75, 'PSC1104161', 1, 1, 0, 77, 60, 'B'),
(76, 'PSC1104165', 1, 1, 0, 6, 39, 'F'),
(77, 'PSC1102480', 1, 1, 0, 21, 55, 'C'),
(78, 'PSC1104149', 1, 1, 0, 38, 70, 'A'),
(79, 'PSC1104152', 1, 1, 0, 55, 50, 'C'),
(80, 'PSC1104161', 1, 1, 0, 72, 60, 'B'),
(81, 'PSC1104165', 1, 1, 0, 16, 39, 'F'),
(82, 'PSC1102480', 1, 1, 0, 33, 55, 'C'),
(83, 'PSC1104149', 1, 1, 0, 50, 68, 'B'),
(84, 'PSC1104152', 1, 1, 0, 67, 50, 'C'),
(85, 'PSC1104161', 1, 1, 0, 84, 60, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `tblroles`
--

CREATE TABLE `tblroles` (
  `id` int(11) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblroles`
--

INSERT INTO `tblroles` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Course Adviser'),
(3, 'Examiner');

-- --------------------------------------------------------

--
-- Table structure for table `tblsemester`
--

CREATE TABLE `tblsemester` (
  `id` int(11) NOT NULL,
  `semester` varchar(30) DEFAULT NULL,
  `semester_code` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsemester`
--

INSERT INTO `tblsemester` (`id`, `semester`, `semester_code`) VALUES
(1, 'First Semester', 'First'),
(2, 'Second Semester', 'Second');

-- --------------------------------------------------------

--
-- Table structure for table `tblsession`
--

CREATE TABLE `tblsession` (
  `id` int(11) NOT NULL,
  `session` varchar(100) DEFAULT NULL,
  `session_code` varchar(100) DEFAULT NULL,
  `is_current` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsession`
--

INSERT INTO `tblsession` (`id`, `session`, `session_code`, `is_current`) VALUES
(1, '2013/14', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblsettings`
--

CREATE TABLE `tblsettings` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `mat_no` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsettings`
--

INSERT INTO `tblsettings` (`id`, `faculty_id`, `department_id`, `level_id`, `session_id`, `semester_id`, `mat_no`) VALUES
(1, 1, 1, 1, 2, 1, 'psc0904670');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `id` int(11) NOT NULL,
  `mat_no` varchar(30) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `department` int(11) NOT NULL,
  `faculty` int(11) NOT NULL,
  `leve` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`id`, `mat_no`, `firstname`, `middlename`, `lastname`, `password`, `department`, `faculty`, `leve`, `session`, `photo`, `status`, `date`) VALUES
(1, 'PSC1104149', 'David', 'Bankole', 'Abel', NULL, 1, 1, 1, 1, 'PSC0808809.jpg', NULL, '2018-10-01 17:40:14'),
(2, 'PSC1104152', 'John', 'Eshiobume', 'Adamu', NULL, 1, 1, 1, 1, 'PSC113801.jpg', NULL, '2018-10-01 17:44:04'),
(3, 'PSC1104161', 'Samuel', 'Osamuyi', 'Aigbomian', NULL, 1, 1, 1, 1, 'PSC0808805.jpg', NULL, '2018-10-01 17:45:19'),
(4, 'PSC1102480', 'Bright', 'Joseph', 'Aikhatuamen', NULL, 1, 1, 1, 1, 'PSC0808827.jpg', NULL, '2018-10-01 17:47:24'),
(5, 'PSC1104165', 'Akhere', 'Rufus', 'Akhiemen', NULL, 1, 1, 1, 1, 'PSC0808843.jpg', NULL, '2018-10-01 17:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `fullname` varchar(150) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `permission_level` int(11) DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `is_enabled` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`user_id`, `username`, `pass`, `fullname`, `email`, `role_id`, `permission_level`, `user_type`, `date_created`, `is_enabled`, `phone`, `photo`) VALUES
(1, 'admin', 'admin', 'Admin', 'admin@nnpc-group.com', 1, 1, 1, NULL, 1, '07033248431', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblactivity_log`
--
ALTER TABLE `tblactivity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcourses`
--
ALTER TABLE `tblcourses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcourse_reg`
--
ALTER TABLE `tblcourse_reg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldepartment`
--
ALTER TABLE `tbldepartment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblgpa`
--
ALTER TABLE `tblgpa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllevel`
--
ALTER TABLE `tbllevel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblresults`
--
ALTER TABLE `tblresults`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblroles`
--
ALTER TABLE `tblroles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsemester`
--
ALTER TABLE `tblsemester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsession`
--
ALTER TABLE `tblsession`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsettings`
--
ALTER TABLE `tblsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mat_no` (`mat_no`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblactivity_log`
--
ALTER TABLE `tblactivity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcourses`
--
ALTER TABLE `tblcourses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tblcourse_reg`
--
ALTER TABLE `tblcourse_reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tbldepartment`
--
ALTER TABLE `tbldepartment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblgpa`
--
ALTER TABLE `tblgpa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbllevel`
--
ALTER TABLE `tbllevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblresults`
--
ALTER TABLE `tblresults`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tblroles`
--
ALTER TABLE `tblroles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblsemester`
--
ALTER TABLE `tblsemester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblsession`
--
ALTER TABLE `tblsession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblsettings`
--
ALTER TABLE `tblsettings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
