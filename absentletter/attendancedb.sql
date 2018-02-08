-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2015 at 07:35 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `attendancedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `absent_tbl`
--

CREATE TABLE IF NOT EXISTS `absent_tbl` (
  `student_id` int(10) NOT NULL,
  `class_id` int(100) NOT NULL,
  `date` date NOT NULL,
  `further_status` tinyint(1) NOT NULL,
  `letters_given` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absent_tbl`
--

INSERT INTO `absent_tbl` (`student_id`, `class_id`, `date`, `further_status`, `letters_given`) VALUES
(3, 1, '2014-12-26', 1, 0),
(2, 1, '2015-07-29', 1, 1),
(7, 1, '2015-01-01', 1, 0),
(1, 1, '2015-01-06', 0, 1),
(1, 1, '2015-01-02', 0, 0),
(3, 1, '2014-12-26', 1, 0),
(2, 2, '2015-07-29', 1, 1),
(7, 2, '2015-01-01', 1, 0),
(5, 1, '2014-12-29', 1, 0),
(4, 1, '2014-12-30', 1, 0),
(0, 0, '2015-01-05', 0, 0),
(1, 1, '2015-01-07', 1, 1),
(2, 1, '2015-01-07', 1, 0),
(7, 2, '2015-01-07', 1, 1),
(6, 1, '2015-01-07', 1, 1),
(5, 1, '2015-01-07', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `classtbl`
--

CREATE TABLE IF NOT EXISTS `classtbl` (
  `Level` int(10) NOT NULL,
  `Class_ID` int(11) NOT NULL,
  `Class` varchar(50) NOT NULL,
  `Teacher_ID` varchar(100) NOT NULL,
  `Cohort` varchar(100) NOT NULL,
  PRIMARY KEY (`Class_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classtbl`
--

INSERT INTO `classtbl` (`Level`, `Class_ID`, `Class`, `Teacher_ID`, `Cohort`) VALUES
(1, 1, 'sec 4 peace', 'honey', '1'),
(2, 2, 'sec 4 grace', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `studentlisttbl`
--

CREATE TABLE IF NOT EXISTS `studentlisttbl` (
  `Student_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Student_Name` varchar(100) NOT NULL,
  `Class_ID` int(10) NOT NULL,
  `Teacher_ID` int(10) NOT NULL,
  `Chinese_Level` varchar(50) NOT NULL,
  `English_Level` int(50) NOT NULL,
  PRIMARY KEY (`Student_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `studentlisttbl`
--

INSERT INTO `studentlisttbl` (`Student_ID`, `Student_Name`, `Class_ID`, `Teacher_ID`, `Chinese_Level`, `English_Level`) VALUES
(1, 'will graham', 1, 1, '1', 1),
(2, 'Alana Bloom', 1, 1, '1', 1),
(3, 'Jack Crowford', 1, 2, '1', 1),
(4, 'Freddie Lounds', 1, 1, '1', 1),
(5, 'Georgia Madchen', 1, 1, '1', 1),
(6, 'Abigail hobbs', 1, 1, '1', 1),
(7, 'Randall Tier', 2, 2, '1', 1),
(8, 'Frederick Chilton', 2, 2, '1', 1),
(9, 'matthew brown', 2, 2, '2', 2),
(10, 'mason verger', 2, 2, '2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `teacherstbl`
--

CREATE TABLE IF NOT EXISTS `teacherstbl` (
  `Teacher_ID` varchar(50) NOT NULL,
  `Teacher_Name` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Class_ID` int(10) NOT NULL,
  `User_Type` varchar(100) NOT NULL DEFAULT 'Teacher'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacherstbl`
--

INSERT INTO `teacherstbl` (`Teacher_ID`, `Teacher_Name`, `Username`, `Password`, `Class_ID`, `User_Type`) VALUES
('honey', 'hanniqueen', 'honeyboiled', 'leggter', 1, 'discp'),
('2', 'bedalia', 'queenofshadows', 'leggter', 2, 'Teacher');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
