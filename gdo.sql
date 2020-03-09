-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 09, 2020 at 09:23 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gdo`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

DROP TABLE IF EXISTS `applicant`;
CREATE TABLE IF NOT EXISTS `applicant` (
  `ApplicantId` int(10) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Address` varchar(40) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` varchar(40) NOT NULL,
  `ZipCode` int(5) NOT NULL,
  `PhoneNumber` int(10) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Ethnicity` varchar(60) NOT NULL,
  `Allergies` tinyint(1) NOT NULL,
  `Medications` tinyint(1) NOT NULL,
  `ParentsWithBachelors` tinyint(1) NOT NULL,
  `MilitaryRelatives` tinyint(1) NOT NULL,
  `RisingGradeLevel` varchar(4) NOT NULL,
  `AttendingSchool` varchar(40) NOT NULL,
  `CollegeOfInterest` varchar(40) DEFAULT NULL,
  `ShirtSize` varchar(3) NOT NULL,
  PRIMARY KEY (`ApplicantId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `applicant_programs`
--

DROP TABLE IF EXISTS `applicant_programs`;
CREATE TABLE IF NOT EXISTS `applicant_programs` (
  `ApplicantId` int(10) NOT NULL,
  `ProgramId` int(10) NOT NULL,
  PRIMARY KEY (`ApplicantId`,`ProgramId`),
  KEY `ApplicantId` (`ApplicantId`),
  KEY `ProgramId` (`ProgramId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `applicant_stem_interests`
--

DROP TABLE IF EXISTS `applicant_stem_interests`;
CREATE TABLE IF NOT EXISTS `applicant_stem_interests` (
  `ApplicantId` int(10) NOT NULL,
  `DisciplineId` int(10) NOT NULL,
  PRIMARY KEY (`ApplicantId`,`DisciplineId`),
  KEY `ApplicantId` (`ApplicantId`),
  KEY `DisciplineId` (`DisciplineId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contact`
--

DROP TABLE IF EXISTS `emergency_contact`;
CREATE TABLE IF NOT EXISTS `emergency_contact` (
  `EmergencyId` int(10) NOT NULL AUTO_INCREMENT,
  `ApplicantId` int(10) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Relationship` varchar(40) NOT NULL,
  `Address` varchar(40) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` varchar(40) NOT NULL,
  `ZipCode` int(5) NOT NULL,
  `MobilePhone` int(10) NOT NULL,
  `HomePhone` int(10) NOT NULL,
  `WorkPhone` int(10) NOT NULL,
  `InitialSignature` varchar(3) NOT NULL,
  PRIMARY KEY (`EmergencyId`),
  KEY `ApplicantId` (`ApplicantId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ethnicities`
--

DROP TABLE IF EXISTS `ethnicities`;
CREATE TABLE IF NOT EXISTS `ethnicities` (
  `EthnicityId` int(10) NOT NULL AUTO_INCREMENT,
  `EthnicityName` varchar(60) NOT NULL,
  PRIMARY KEY (`EthnicityId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ethnicities`
--

INSERT INTO `ethnicities` (`EthnicityId`, `EthnicityName`) VALUES
(1, 'American Indian or Alaska Native'),
(2, 'Asian'),
(3, 'Black or African American'),
(4, 'Hispanic or Latino'),
(5, 'Native Hawaiian or Other Pacific Islander'),
(6, 'White');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

DROP TABLE IF EXISTS `parent`;
CREATE TABLE IF NOT EXISTS `parent` (
  `ParentId` int(10) NOT NULL AUTO_INCREMENT,
  `ApplicantId` int(10) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Address` varchar(40) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` varchar(40) NOT NULL,
  `ZipCode` int(5) NOT NULL,
  `MobilePhone` int(10) NOT NULL,
  `WorkPhone` int(10) DEFAULT NULL,
  `HomePhone` int(10) DEFAULT NULL,
  `OtherParentFName` varchar(20) DEFAULT NULL,
  `OtherParentLName` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ParentId`),
  KEY `ApplicantId` (`ApplicantId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pre_college_programs`
--

DROP TABLE IF EXISTS `pre_college_programs`;
CREATE TABLE IF NOT EXISTS `pre_college_programs` (
  `ProgramId` int(10) NOT NULL AUTO_INCREMENT,
  `ProgramName` varchar(60) NOT NULL,
  PRIMARY KEY (`ProgramId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pre_college_programs`
--

INSERT INTO `pre_college_programs` (`ProgramId`, `ProgramName`) VALUES
(1, 'Gear Up'),
(2, 'Upward Bound'),
(3, 'Upward Bound - Math and Science'),
(4, 'Educational Talent Search');

-- --------------------------------------------------------

--
-- Table structure for table `rising_grade_level`
--

DROP TABLE IF EXISTS `rising_grade_level`;
CREATE TABLE IF NOT EXISTS `rising_grade_level` (
  `GradeId` int(10) NOT NULL AUTO_INCREMENT,
  `Grade` varchar(4) NOT NULL,
  PRIMARY KEY (`GradeId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rising_grade_level`
--

INSERT INTO `rising_grade_level` (`GradeId`, `Grade`) VALUES
(1, '8th'),
(2, '9th');

-- --------------------------------------------------------

--
-- Table structure for table `shirt_sizes`
--

DROP TABLE IF EXISTS `shirt_sizes`;
CREATE TABLE IF NOT EXISTS `shirt_sizes` (
  `SizeId` int(10) NOT NULL AUTO_INCREMENT,
  `Size` varchar(3) NOT NULL,
  PRIMARY KEY (`SizeId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shirt_sizes`
--

INSERT INTO `shirt_sizes` (`SizeId`, `Size`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `StateId` int(10) NOT NULL AUTO_INCREMENT,
  `StateName` varchar(40) NOT NULL,
  PRIMARY KEY (`StateId`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`StateId`, `StateName`) VALUES
(1, 'Alabama'),
(2, 'Alaska'),
(3, 'Arizona'),
(4, 'Arkansas'),
(5, 'California'),
(6, 'Colorado'),
(7, 'Connecticut'),
(8, 'Delaware'),
(9, 'Florida'),
(10, 'Georgia'),
(11, 'Hawaii'),
(12, 'Idaho'),
(13, 'Illinois'),
(14, 'Indiana'),
(15, 'Iowa'),
(16, 'Kansas'),
(17, 'Kentucky'),
(18, 'Louisiana'),
(19, 'Maine'),
(20, 'Maryland'),
(21, 'Massachusetts'),
(22, 'Michigan'),
(23, 'Minnesota'),
(24, 'Mississippi'),
(25, 'Missouri'),
(27, 'Montana'),
(28, 'Nebraska'),
(29, 'Nevada'),
(30, 'New Hampshire'),
(31, 'New Jersey'),
(32, 'New Mexico'),
(33, 'New York'),
(34, 'North Carolina'),
(35, 'North Dakota'),
(36, 'Ohio'),
(37, 'Oklahoma'),
(38, 'Oregon'),
(39, 'Pennsylvania'),
(40, 'Rhode Island'),
(41, 'South Carolina'),
(42, 'South Dakota'),
(43, 'Tennessee'),
(44, 'Texas'),
(45, 'Utah'),
(46, 'Vermont'),
(47, 'Virginia'),
(48, 'Washington'),
(49, 'West Virginia'),
(50, 'Wisconsin'),
(51, 'Wyoming');

-- --------------------------------------------------------

--
-- Table structure for table `stem_disciplines`
--

DROP TABLE IF EXISTS `stem_disciplines`;
CREATE TABLE IF NOT EXISTS `stem_disciplines` (
  `DisciplineId` int(10) NOT NULL AUTO_INCREMENT,
  `DisciplineName` varchar(20) NOT NULL,
  PRIMARY KEY (`DisciplineId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stem_disciplines`
--

INSERT INTO `stem_disciplines` (`DisciplineId`, `DisciplineName`) VALUES
(1, 'Science'),
(2, 'Technology'),
(3, 'Engineering'),
(4, 'Mathematics');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(7, 'admin', 'admin@admin.net', '$2y$10$1KCfSTiPvkRn1tiOVvuEVeShUY41uWNh.M4kexFG1/oayT7.OAl8O');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emergency_contact`
--
ALTER TABLE `emergency_contact`
  ADD CONSTRAINT `emergency_contact_ibfk_1` FOREIGN KEY (`ApplicantId`) REFERENCES `applicant` (`ApplicantId`) ON UPDATE CASCADE;

--
-- Constraints for table `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `parent_ibfk_1` FOREIGN KEY (`ApplicantId`) REFERENCES `applicant` (`ApplicantId`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
