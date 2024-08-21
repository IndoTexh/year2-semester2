-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2024 at 04:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `adminName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminName`) VALUES
(1, 'pheakdey'),
(2, 'sombath'),
(3, 'sothanroth');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `loginAs` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `loginAs`) VALUES
(1, 'Administrator'),
(2, 'Teacher'),
(3, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `newstatus`
--

CREATE TABLE `newstatus` (
  `NewStatusID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `ProgramID` int(11) NOT NULL,
  `Assigned` varchar(100) NOT NULL,
  `Note` varchar(100) DEFAULT NULL,
  `AssignDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newstatus`
--

INSERT INTO `newstatus` (`NewStatusID`, `StudentID`, `ProgramID`, `Assigned`, `Note`, `AssignDate`) VALUES
(191, 1, 4, 'Assign', 'New program', '2024-07-08'),
(192, 2, 4, 'Assign', 'New program', '2024-07-08'),
(193, 3, 4, 'Assign', 'New program', '2024-07-08'),
(194, 4, 4, 'Assign', 'New program', '2024-07-08'),
(195, 5, 4, 'Assign', 'New program', '2024-07-08');

-- --------------------------------------------------------

--
-- Table structure for table `tblacademicyear`
--

CREATE TABLE `tblacademicyear` (
  `AcademicYearID` int(11) NOT NULL,
  `AcademicYear` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblacademicyear`
--

INSERT INTO `tblacademicyear` (`AcademicYearID`, `AcademicYear`) VALUES
(1, '2020--2021'),
(2, '2021--2022'),
(3, '2022--2023'),
(4, '2023--2024');

-- --------------------------------------------------------

--
-- Table structure for table `tblattendance`
--

CREATE TABLE `tblattendance` (
  `AttendanceID` int(11) NOT NULL,
  `StudentStatusID` int(11) DEFAULT NULL,
  `SubjectID` varchar(100) NOT NULL,
  `Attended` varchar(50) DEFAULT NULL,
  `AttendNote` varchar(50) DEFAULT NULL,
  `Section` int(11) NOT NULL,
  `LecturerID` varchar(100) NOT NULL,
  `DateIssue` date DEFAULT NULL,
  `AttendanceDateIssue` date DEFAULT NULL,
  `StudentID` varchar(100) NOT NULL,
  `studentQR` int(10) DEFAULT NULL,
  `timeIn` datetime NOT NULL,
  `dateOfAtt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblattendance`
--

INSERT INTO `tblattendance` (`AttendanceID`, `StudentStatusID`, `SubjectID`, `Attended`, `AttendNote`, `Section`, `LecturerID`, `DateIssue`, `AttendanceDateIssue`, `StudentID`, `studentQR`, `timeIn`, `dateOfAtt`) VALUES
(748, 131, 'Client server-side programming', 'Absent', NULL, 0, 'Doeuk Sothanroth', NULL, NULL, 'Natalie Portman', 22750627, '2024-07-08 21:31:49', '2024-07-08'),
(749, 130, 'Client server-side programming', 'Absent', NULL, 1, 'Doeuk Sothanroth', '2024-07-01', '2024-07-07', 'Doeuk Sothanroth', 40316971, '2024-07-08 21:34:25', '2024-07-08'),
(750, 132, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Justin Li', 58058357, '2024-07-08 21:34:25', '2024-07-08'),
(751, 133, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Kendall J', 57351528, '2024-07-08 21:34:25', '2024-07-08'),
(752, 134, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Madison Beer', 3235285, '2024-07-08 21:34:25', '2024-07-08'),
(753, 135, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Margot Robbie', 94602243, '2024-07-08 21:34:25', '2024-07-08'),
(754, 136, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Keo Borrmey', 32118015, '2024-07-08 21:34:25', '2024-07-08'),
(755, 137, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Tom Cruise', 76395822, '2024-07-08 21:34:25', '2024-07-08'),
(756, 138, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Jennifer Lawrence', 88871247, '2024-07-08 21:34:25', '2024-07-08'),
(757, 139, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Jennifer connelly', 6953514, '2024-07-08 21:34:25', '2024-07-08'),
(758, 140, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Denzel Washington', 66027919, '2024-07-08 21:34:25', '2024-07-08'),
(759, 141, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Samuel l jackson', 43914803, '2024-07-08 21:34:25', '2024-07-08'),
(760, 142, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Sandra Bullock', 18274716, '2024-07-08 21:34:25', '2024-07-08'),
(761, 143, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Anne Hathaway', 67500191, '2024-07-08 21:34:25', '2024-07-08'),
(762, 144, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Nicole Kidman', 11996512, '2024-07-08 21:34:25', '2024-07-08'),
(763, 145, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Emma Stone', 43029243, '2024-07-08 21:34:25', '2024-07-08'),
(764, 146, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Jennifer Aniston', 50896776, '2024-07-08 21:34:25', '2024-07-08'),
(765, 147, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Jodie Foster', 76655158, '2024-07-08 21:34:25', '2024-07-08'),
(766, 148, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Ana de Armas', 36770355, '2024-07-08 21:34:25', '2024-07-08'),
(767, 149, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Mackenzie Davis', 65218727, '2024-07-08 21:34:25', '2024-07-08'),
(768, 150, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'josephine langford', 51046409, '2024-07-08 21:34:25', '2024-07-08'),
(769, 151, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Katy Perry', 81990918, '2024-07-08 21:34:25', '2024-07-08'),
(770, 152, 'Client server-side programming', 'Present', NULL, 1, 'Doeuk Sothanroth', '2024-07-07', '2024-07-07', 'Nghet Sokunparany', 41371690, '2024-07-08 21:34:25', '2024-07-08');

-- --------------------------------------------------------

--
-- Table structure for table `tblbatch`
--

CREATE TABLE `tblbatch` (
  `BatchID` int(11) NOT NULL,
  `BatchKH` varchar(50) NOT NULL,
  `BatchEN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbatch`
--

INSERT INTO `tblbatch` (`BatchID`, `BatchKH`, `BatchEN`) VALUES
(1, 'ជំនាន់ទីមូយ', 'Batch 1'),
(2, 'ជំនាន់ទីពីរ', 'Batch 2'),
(3, 'ជំនាន់ទីបី', 'Batch 3'),
(4, 'ជំនាន់ទីបួន', 'Batch 4'),
(5, 'ជំនាន់ទីប្រាំ', 'Batch 5');

-- --------------------------------------------------------

--
-- Table structure for table `tblcampus`
--

CREATE TABLE `tblcampus` (
  `CampusID` int(11) NOT NULL,
  `CampusKH` varchar(150) NOT NULL,
  `CampusEN` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcampus`
--

INSERT INTO `tblcampus` (`CampusID`, `CampusKH`, `CampusEN`) VALUES
(1, 'សាខាចោមចៅ', 'Chom Chao'),
(2, 'ទួលស្លែង', 'Toul Sleng');

-- --------------------------------------------------------

--
-- Table structure for table `tblcountry`
--

CREATE TABLE `tblcountry` (
  `CountryID` int(11) NOT NULL,
  `CountryKH` varchar(100) NOT NULL,
  `CountryEN` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbldays`
--

CREATE TABLE `tbldays` (
  `DayID` int(11) NOT NULL,
  `DayName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbldays`
--

INSERT INTO `tbldays` (`DayID`, `DayName`) VALUES
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednesday'),
(4, 'Thursday'),
(5, 'Friday'),
(6, 'Saturday'),
(7, 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `tbldayweek`
--

CREATE TABLE `tbldayweek` (
  `DayWeekID` int(11) NOT NULL,
  `ShiftID` int(11) NOT NULL,
  `DayWeekName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbldayweek`
--

INSERT INTO `tbldayweek` (`DayWeekID`, `ShiftID`, `DayWeekName`) VALUES
(1, 1, 'Monday - Friday'),
(2, 1, 'Weekend');

-- --------------------------------------------------------

--
-- Table structure for table `tbldegree`
--

CREATE TABLE `tbldegree` (
  `DegreeID` int(11) NOT NULL,
  `DegreeKH` varchar(150) NOT NULL,
  `DegreeEN` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbldegree`
--

INSERT INTO `tbldegree` (`DegreeID`, `DegreeKH`, `DegreeEN`) VALUES
(1, 'បរិញ្ញបត្ររង', 'Associate degree'),
(2, 'បរិញ្ញបត្រ', 'Bachelor degree'),
(3, 'ថ្នាក់អនុបណ្ឌិត', 'Master degree'),
(4, 'ថា្នក់បណ្ឌិត', 'Doctoral degree');

-- --------------------------------------------------------

--
-- Table structure for table `tbleducationalbackground`
--

CREATE TABLE `tbleducationalbackground` (
  `EducattionalBackgroundID` int(11) NOT NULL,
  `SchoolTypeID` int(11) NOT NULL,
  `NameSchool` int(11) NOT NULL,
  `AcademicYear` int(11) NOT NULL,
  `Province` varchar(100) NOT NULL,
  `StudentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblfaculty`
--

CREATE TABLE `tblfaculty` (
  `FacultyID` int(11) NOT NULL,
  `FacultyKH` varchar(250) NOT NULL,
  `FacultyEN` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblfaculty`
--

INSERT INTO `tblfaculty` (`FacultyID`, `FacultyKH`, `FacultyEN`) VALUES
(1, 'មហាវិទ្យាល័យ គ្រប់គ្រងពាណិជ្ជកម្ម', 'Faculty of Business Administration'),
(2, 'មហាវិទ្យាល័យ ហិរញ្ញវត្ថុ និងធនាគារ', 'Faculty of Finance and Banking'),
(3, 'មហាវិទ្យាល័យ សេដ្ឋកិច្ច', 'Faculty of Economics'),
(4, 'មហាវិទ្យាល័យ ច្បាប់', 'Faculty of Law'),
(5, 'មហាវិទ្យាល័យ អប់រំ សិល្បះ និងមនុស្សសាស្ត្រ', 'Faculty of Education, Arts, and Humanities'),
(6, 'មហាវិទ្យាល័យ ទេសចរណ៏ និងបដិសណ្ឋារកិច្ច', 'Faculty of Tourism and Hospitality'),
(7, 'មហាវិទ្យាល័យ ព័ត៍មានវិទ្យា និងវិទ្យាសាស្ត្រ', 'Faculty of Information Technology and Science'),
(8, 'មហាវិទ្យាល័យ បច្ចេកវិទ្យាឌីជីថល​ និងទូរគមនាគមន៏', 'Faculty of Digital Technology and Telecommunication'),
(9, 'មហាវិទ្យាល័យ វិស្វកម្ម', 'Faculty of Engineering'),
(10, 'មហាវិទ្យាល័យ ស្ថាបត្យកម្ម', 'Faculty of Architecture'),
(11, 'មហាវិទ្យាល័យ ទំនាក់ទំនងអន្តរជាតិ', 'Faculty of International Relations'),
(12, 'មហាវិទ្យាល័យ អកាសចរស៊ីវិល', 'Faculty of Civil Aviation');

-- --------------------------------------------------------

--
-- Table structure for table `tblfamilybackground`
--

CREATE TABLE `tblfamilybackground` (
  `FamilyBackgroundID` int(11) NOT NULL,
  `FatherName` varchar(100) NOT NULL,
  `FatherAge` int(11) NOT NULL,
  `FatherNationalityID` int(11) NOT NULL,
  `FatherCountryID` int(11) NOT NULL,
  `FatherOccupationID` int(11) NOT NULL,
  `MotherName` varchar(100) NOT NULL,
  `MotherAge` int(11) NOT NULL,
  `MotherNationalityID` int(11) NOT NULL,
  `MotherCountryID` int(11) NOT NULL,
  `MotherOccupationID` int(11) NOT NULL,
  `FamilyCurrentAddress` varchar(300) NOT NULL,
  `SpouseName` varchar(100) NOT NULL,
  `SpouseAge` int(11) NOT NULL,
  `GuardianPhoneNumber` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbllecturer`
--

CREATE TABLE `tbllecturer` (
  `LecturerID` int(11) NOT NULL,
  `LecturerName` varchar(100) NOT NULL,
  `lecturer_number` int(10) NOT NULL,
  `Photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbllecturer`
--

INSERT INTO `tbllecturer` (`LecturerID`, `LecturerName`, `lecturer_number`, `Photo`) VALUES
(2, 'Doeuk Sothanroth', 53223732, 'mypic.jpg'),
(3, 'Neng Sereyrith', 66146698, 'rith.jpg'),
(4, 'Dom', 75335899, 'd_g650ER_a_mkt_00483_PROD.jpg'),
(5, 'Justin bieber', 83098104, 'download (1).jpg'),
(6, 'Margot robbie', 53734627, 'MV5BMTgxNDcwMzU2Nl5BMl5BanBnXkFtZTcwNDc4NzkzOQ@@._V1_FMjpg_UX1000_.jpg'),
(7, 'Madison beer', 43538739, 'madison-beer-2021-RS-1800.webp'),
(8, 'Kendall Jenner', 4812260, 'download (2).jpg'),
(9, 'Chris Evans', 93379372, 'download.jpg'),
(10, 'Shaquille ONeal', 82826976, 'images (3).jpg'),
(11, 'Ryan Gosling', 65064389, 'MV5BMTQzMjkwNTQ2OF5BMl5BanBnXkFtZTgwNTQ4MTQ4MTE@._V1_.jpg'),
(12, 'Emma stone', 49131696, 'download (11).jpg'),
(13, 'Andrew garfield', 34774716, 'British-American-actor-Andrew-Garfield-2018.webp'),
(14, 'zendaya', 37177266, 'Zendaya_-_2019_by_Glenn_Francis.jpg'),
(15, 'Tom holland', 96886644, 'images (4).jpg'),
(16, 'Christian bale', 73158762, 'Bruce_Wayne_(The_Dark_Knight_Trilogy).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblmajor`
--

CREATE TABLE `tblmajor` (
  `MajorID` int(11) NOT NULL,
  `MajorKH` varchar(250) NOT NULL,
  `MajorEN` varchar(250) NOT NULL,
  `FacultyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblmajor`
--

INSERT INTO `tblmajor` (`MajorID`, `MajorKH`, `MajorEN`, `FacultyID`) VALUES
(1, 'បរិញ្ញាបត្រ គ្រប់គ្រងពាណិជ្ជកម្ម ផ្នែក គ្រប់គ្រងទូទៅ', 'Bachelor of Business Administration in General Management ', 1),
(2, 'បរិញ្ញាបត្រ គ្រប់គ្រងពាណិជ្ជកម្ម ផ្នែក ពាណិជ្ជកម្មអន្តរជាតិ', 'Bachelor of Business Administration in International Business', 1),
(3, 'បរិញ្ញាបត្រ គ្រប់គ្រងពាណិជ្ជកម្ម ផ្នែក សហគ្រិនភាព​ និង នុវានុវត្តន៏', 'Bachelor of Business Administration in Entrepreneurship and Innovation', 1),
(4, 'បរិញ្ញាបត្រ គ្រប់គ្រងពាណិជ្ជកម្ម ផ្នែក គណនេយ្យ', 'Bachelor of Business Administration in Accounting', 1),
(5, 'បរិញ្ញាបត្រ គ្រប់គ្រងពាណិជ្ជកម្ម ផ្នែក ទីផ្សារ', 'Bachelor of Business Administration in Marketing', 1),
(6, 'បរិញ្ញាបត្រ ហិរញ្ញវត្ថុ និងធនាគារ ផ្នែក ហិរញ្ញវត្ថុ និងធនាគារ', 'Bachelor of Finance and Banking in Finance and Banking', 2),
(7, 'បរិញ្ញាបត្រ ហិរញ្ញវត្ថុ និងធនាគារ ផ្នែក ធនាគារអន្តរជាតិ', 'Bachelor of Finance and Banking in International Banking', 2),
(8, 'បរិញ្ញាបត្រ ហិរញ្ញវត្ថុ និងធនាគារ ផ្នែក បច្ចេកវិទ្យាហិរញ្ញវត្ថុ', 'Bachelor of Finance and Banking in Financial Technology', 2),
(9, 'បរិញ្ញាបត្រ សេដ្ឋកិច្ច', 'Bachelor of Arts in Economics', 3),
(10, 'បរិញ្ញាបត្រ អភិវឌ្ឃន៏សេដ្ឋកិច្ច', 'Bachelor of Arts in Development Economics', 3),
(11, 'បរិញ្ញាបត្រ សេដ្ឋកិច្ចអន្តរជាតិ', 'Bachelor of Arts in International Economics', 3),
(12, 'បរិញ្ញាបត្រ សេដ្ឋកិច្ចឌីជីថល', 'Bachelor of Arts in Digital Economy', 3),
(13, 'បរិញ្ញាបត្រ ច្បាប់ ផ្នែកច្បាប់', 'Bachelor of Laws in Law', 4),
(14, 'បរិញ្ញាបត្រ ច្បាប់ ផ្នែកច្បាប់ឯកជន', 'Bachelor of Laws in Private Law', 4),
(15, 'បរិញ្ញាបត្រ ច្បាប់ ផ្នែកច្បាប់អន្តរជាតិ', 'Bachelor of Laws in International Law', 4),
(20, 'បរិញ្ញាបត្រ ច្បាប់ផ្នែករដ្ឋបាលសាធារណៈ', 'Bachelor of Laws in Public Administration', 4),
(31, 'បរិញ្ញាបត្រ អប់រំ ផ្នែករដ្ឋបាលអប់រំ និងភាពជាអ្នកដឹកនាំ', 'Bachelor of Educational Administration and Leadership', 5),
(32, 'បរិញ្ញាបត្រ អប់រំ ផ្នែកបង្រៀនភាសារអង់គ្លេស', 'Bachelor of Education in Teaching English as a Foreign Language', 5),
(33, 'បរិញ្ញាបត្រ អប់រំ ផ្នែកសារគមនារគមន៏អប់រំ', 'Bachelor of Education in Communication Education', 5),
(34, 'បរិញ្ញាបត្រ អប់រំ ផ្នែកអក្សរសាស្ត្រខ្មែរ', 'Bachelor of Education in Khmer Literature', 5),
(35, 'បរិញ្ញាបត្រ អប់រំ ផ្នែកគណិតវិទ្យា', 'Bachelor of Education in Mathematics', 5),
(36, 'បរិញ្ញាបត្រ អប់រំ ផ្នែករូបវិទ្យា', 'Bachelor of Education in Physics', 5),
(37, 'បរិញ្ញាបត្រ អប់រំ ផ្នែកគីមីវិទ្យា', 'Bachelor of Education in Chemistry', 5),
(38, 'បរិញ្ញាបត្រ ទេសចរណ៏​ និងបដិសណ្ឋារកិច្ច', 'Bachelor of Tourism and Hospitality in Tourism Management', 6),
(39, 'បរិញ្ញាបត្រ ទេសចរណ៏​ និងបដិសណ្ឋារកិច្ច​ ផ្នែក គ្រប់គ្រងសណ្ឋាគារ', 'Bachelor of Tourism and Hospitality in Hotel Management', 6),
(40, 'បរិញ្ញាបត្រ ទេសចរណ៏​ និងបដិសណ្ឋារកិច្ច ផ្នែក គ្រប់គ្រងបដិសណ្ឋារកិច្ច', 'Bachelor of Tourism and Hospitality in Hospitality Management', 6),
(41, 'បរិញ្ញាបត្រ ព័តិមានវិទ្យា ផ្នែកវិស្វកម្មសហ្វវែ', 'Bachelor of Information Technology in Software Engineering', 7),
(42, 'បរិញ្ញាបត្រ ព័តិមានវិទ្យា ផ្នែកបណ្តាញកំព្យូទ័រ និងសុវត្ថិភាពព័តិមានវិទ្យា', 'Bachelor of Information Technology in Computer Networking and Cyber Security', 7),
(43, 'បរិញ្ញាបត្រ ព័តិមានវិទ្យា ផ្នែករចនាពហុប្រព័ន្ធផ្សព្វផ្សាយ', 'Bachelor of Information Technology in Computer Multimedia Design', 7),
(44, 'បរិញ្ញាបត្រ វិទ្យាសាស្ត្រ ផ្នែកបច្ចេកវិទ្យាឌីជីថល', 'Bachelor of Science in Digital Technology', 8),
(45, 'បរិញ្ញាបត្រ វិទ្យាសាស្ត្រ ផ្នែកទំនាក់ទំនងឌីជីថល និងប្រព័ន្ធផ្សព្វផ្សាយ', 'Bachelor of Science in Digital Communication and Media', 8),
(46, 'បរិញ្ញាបត្រ វិទ្យាសាស្ត្រ ផ្នែកវិស្វកម្មអេឡិចត្រូនិក​ និងទូរគមនាគមន៏', 'Bachelor of Science in Eletronic Engineering and Telecommunication', 8),
(47, 'បរិញ្ញាបត្រ វិស្វកម្ម ផ្នែក វិស្វកម្មសំណង់ស៊ីវិល', 'Bachelor of Engineering in Civil Engineering', 9),
(48, 'បរិញ្ញាបត្រ វិស្វកម្ម ផ្នែក គ្រប់គ្រងវិស្វកម្មសំណង់', 'Bachelor of Engineering in Construction Engineering and Management ', 9),
(49, 'បរិញ្ញបត្រ ស្ថាបត្យកម្ម ផ្នែក ស្ថាបត្យកម្មនិងនគររូបនីយវិទ្យា', 'Bachelor of Architecture in Architecture and Urbanism', 10),
(50, 'បរិញ្ញាបត្រ ស្ថាបត្យកម្ម ផ្នែក ស្ថាបត្យកម្មក្នុងអាគារ', 'Bachelor of Architecture in Interior Design', 10),
(51, 'បរិញ្ញាបត្រ ទំនាក់ទំនងអន្តរជាតិ', 'Bachelor of Arts in International Relations', 11),
(52, 'បរិញ្ញាបត្រ ការទូត', 'Bachelor of Arts in Diplomacy', 11),
(53, 'បរិញ្ញាបត្រ កិច្ចការអន្តរជាតិ និងការចរចា', 'Bachelor of Arts in International Affairs and Negotiations', 11),
(54, 'បរិញ្ញាបត្រ អាកាសចរ ផ្នែក គ្រប់គ្រងក្រុមហ៊ុនអាកាសចរណ៏ និងអាកាសយានដ្ឋាន', 'Bachelor of Aviation in Airline and Airport Management', 12),
(55, 'បរិញ្ញាបត្រ អាកាសចរ ផ្នែក គ្រប់គ្រងវិស័យអកាសចរណ៏', 'Bachelor of Aviation in Aviation Management', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tblnatioanlity`
--

CREATE TABLE `tblnatioanlity` (
  `NationalityID` int(11) NOT NULL,
  `NationalityKH` varchar(100) NOT NULL,
  `NationalityEN` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblprogram`
--

CREATE TABLE `tblprogram` (
  `ProgramID` int(11) NOT NULL,
  `YearID` int(11) NOT NULL,
  `SemesterID` int(11) NOT NULL,
  `ShiftID` int(11) NOT NULL,
  `DegreeID` int(11) NOT NULL,
  `AcademicYearID` int(11) NOT NULL,
  `MajorID` int(11) NOT NULL,
  `BatchID` int(11) NOT NULL,
  `CampusID` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `DateIssue` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblprogram`
--

INSERT INTO `tblprogram` (`ProgramID`, `YearID`, `SemesterID`, `ShiftID`, `DegreeID`, `AcademicYearID`, `MajorID`, `BatchID`, `CampusID`, `StartDate`, `EndDate`, `DateIssue`) VALUES
(1, 1, 1, 1, 2, 4, 41, 5, 2, '2023-12-28', '2024-08-28', '2024-05-28'),
(2, 2, 2, 4, 3, 4, 41, 5, 1, '2023-11-26', '2024-06-30', '2024-06-30'),
(3, 2, 2, 3, 3, 4, 41, 5, 2, '2023-11-20', '2024-05-28', '2024-05-28'),
(4, 2, 1, 1, 2, 4, 41, 5, 2, '2024-06-07', '2024-06-07', '2024-06-07'),
(5, 2, 2, 1, 2, 4, 41, 5, 2, '2024-06-15', '2024-06-15', '2024-06-15'),
(6, 3, 1, 1, 2, 4, 41, 5, 1, '2024-06-15', '2024-06-15', '2024-06-15'),
(7, 4, 1, 1, 2, 4, 41, 5, 2, '2024-07-25', '2024-07-30', '2024-07-08');

-- --------------------------------------------------------

--
-- Table structure for table `tblroom`
--

CREATE TABLE `tblroom` (
  `RoomID` int(11) NOT NULL,
  `CampusID` int(11) NOT NULL,
  `RoomName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblroom`
--

INSERT INTO `tblroom` (`RoomID`, `CampusID`, `RoomName`) VALUES
(1, 1, 'Software engineering'),
(2, 1, 'Design'),
(3, 1, 'Network');

-- --------------------------------------------------------

--
-- Table structure for table `tblschedule`
--

CREATE TABLE `tblschedule` (
  `ScheduleID` int(11) NOT NULL,
  `SubjectID` varchar(100) NOT NULL,
  `LecturerID` varchar(100) NOT NULL,
  `DayWeekID` int(11) NOT NULL,
  `TimeID` varchar(100) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `AcademicProgramID` int(11) NOT NULL,
  `DateStart` varchar(50) NOT NULL,
  `DateEnd` varchar(50) NOT NULL,
  `ScheduleDate` varchar(50) NOT NULL,
  `days` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblschedule`
--

INSERT INTO `tblschedule` (`ScheduleID`, `SubjectID`, `LecturerID`, `DayWeekID`, `TimeID`, `RoomID`, `AcademicProgramID`, `DateStart`, `DateEnd`, `ScheduleDate`, `days`) VALUES
(46, 'Client server-side programming', 'Doeuk Sothanroth', 1, '8:00AM--11:15AM', 1, 1, '2024-06-11', '2024-06-16', '2024-06-16', 'Monday'),
(58, 'Professional web development', 'Doeuk Sothanroth', 2, '8:00AM--11:15AM', 1, 1, '2024-07-07', '2024-07-07', '2024-07-07', 'Tuesday'),
(59, 'Computer Networking l', 'Neng Sereyrith', 1, '8:00AM--11:15AM', 1, 1, '2024-07-07', '2024-07-07', '2024-07-07', 'Wednesday'),
(60, 'Front-End Development wit API', 'Chris Evans', 1, '8:00AM--11:15AM', 1, 1, '2024-07-07', '2024-07-07', '2024-07-07', 'Thursday'),
(61, 'C# Progamming ll', 'zendaya', 1, '8:00AM--11:15AM', 1, 1, '2024-07-07', '2024-07-30', '2024-07-18', 'Friday');

-- --------------------------------------------------------

--
-- Table structure for table `tblschooltype`
--

CREATE TABLE `tblschooltype` (
  `SchoolTypeID` int(11) NOT NULL,
  `SchoolTypeKH` varchar(100) NOT NULL,
  `SchoolTypeEN` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblsemester`
--

CREATE TABLE `tblsemester` (
  `SemesterID` int(11) NOT NULL,
  `SemesterKH` varchar(250) NOT NULL,
  `SemesterEN` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsemester`
--

INSERT INTO `tblsemester` (`SemesterID`, `SemesterKH`, `SemesterEN`) VALUES
(1, '១', '1'),
(2, '២', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tblsex`
--

CREATE TABLE `tblsex` (
  `SexID` int(11) NOT NULL,
  `SexKH` varchar(50) NOT NULL,
  `SexEN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblshift`
--

CREATE TABLE `tblshift` (
  `ShiftID` int(11) NOT NULL,
  `ShiftKH` varchar(50) NOT NULL,
  `ShiftEN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblshift`
--

INSERT INTO `tblshift` (`ShiftID`, `ShiftKH`, `ShiftEN`) VALUES
(1, 'ព្រឹក', 'Morning'),
(2, 'រសៀល', 'Afternoon'),
(3, 'ល្ងាច', 'Evening'),
(4, 'ចុងសប្តាហ៏', 'Weekend');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent`
--

CREATE TABLE `tblstudent` (
  `StudentID` int(11) NOT NULL,
  `NameInKhmer` varchar(100) NOT NULL,
  `NameInLatin` varchar(100) NOT NULL,
  `FamilyName` varchar(100) NOT NULL,
  `GivenName` varchar(100) NOT NULL,
  `SexID` varchar(100) NOT NULL,
  `IDPassportNo` varchar(100) NOT NULL,
  `NationalityID` varchar(100) NOT NULL,
  `CountryID` varchar(100) NOT NULL,
  `DOB` varchar(100) NOT NULL,
  `POB` varchar(300) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `CurrentAddress` varchar(300) NOT NULL,
  `Photo` varchar(200) NOT NULL,
  `DateOfRegister` varchar(100) NOT NULL,
  `student_number` int(200) NOT NULL,
  `qrCode` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblstudent`
--

INSERT INTO `tblstudent` (`StudentID`, `NameInKhmer`, `NameInLatin`, `FamilyName`, `GivenName`, `SexID`, `IDPassportNo`, `NationalityID`, `CountryID`, `DOB`, `POB`, `PhoneNumber`, `Email`, `CurrentAddress`, `Photo`, `DateOfRegister`, `student_number`, `qrCode`) VALUES
(1, 'ឌឿក សុឋានរដ្ឋ', 'Doeuk Sothanroth', 'Doeuk', 'Sothanroth', 'Male', 'Cambodia', 'cambodian', 'Cambodia', '2005-01-01', 'Phnom Penh', '098656743', 'Doe@gmail.com', 'Beoung Salang', 'photo_2024-04-24_15-05-20.jpg', '2005-01-01', 40316971, 'image/40316971.png'),
(2, 'ណាតាលី​ ផតមេន', 'Natalie Portman', 'Natalie', 'Portman', 'Female', 'United States', 'american', 'United States', '1988-02-01', 'Jerusalem', '08765655', 'Natalie@gmail.com', 'New York', '006310795219870-nm_200.jpg', '2024-05-22', 22750627, 'image/22750627.png'),
(3, 'ចាស្ទីន លី', 'Justin Li', 'Justin', 'LI', 'Male', 'Canada', 'canadian', 'Canada', '1995-02-26', 'Toronto', '087876888', 'Justin23@gmail.com', 'California', 'download (1).jpg', '2024-06-03', 58058357, 'image/58058357.png'),
(4, 'ខេនដល ចេ', 'Kendall J', 'Kendall', 'J', 'Female', 'United States', 'american', 'United States', '1995-01-05', 'California', '0128489872', 'kendall134@gmail.com', 'North Carolina', 'download (2).jpg', '2024-06-03', 57351528, 'image/57351528.png'),
(5, 'ម៉៉ាឌីសាន់ បៀរ', 'Madison Beer', 'Madison', 'Beer', 'Female', 'United States', 'american', 'United States', '2000-07-02', 'California', '017965832', 'madison@gmail.com', 'New Jersey', 'madison-beer-2021-RS-1800.webp', '2024-05-22', 3235285, 'image/03235285.png'),
(6, 'ម៉៉ាហ្គុដ រ៉៉បបុី', 'Margot Robbie', 'Margot', 'Robbie', 'Female', 'Australia', 'australian', 'Australia', '1990-04-19', 'Melbourne', '8551284898', 'margot@gmail.com', 'Sydney', 'MV5BMTgxNDcwMzU2Nl5BMl5BanBnXkFtZTcwNDc4NzkzOQ@@._V1_FMjpg_UX1000_.jpg', '2024-05-22', 94602243, 'image/94602243.png'),
(7, 'កែវ​​ បរមី', 'Keo Borrmey', 'Keo', 'Borrmey', 'Female', 'Cambodia', 'cambodian', 'Cambodia', '2005-04-03', 'Sihanouk ville', '012537645', 'Borrmey@gamil.com', 'Phnom Penh', 'images.jpg', '2024-06-03', 32118015, 'image/32118015.png'),
(8, 'ថម គ្រូស', 'Tom Cruise', 'Tom', 'Cruise', 'Male', 'United States', 'american', 'United States', '1977-05-29', 'New Jersey', '01245354', 'tomcruise123@gmail.com', 'California', 'download (3).jpg', '2024-06-03', 76395822, 'image/76395822.png'),
(9, 'ចេនីហ្វឹ ឡរ៉ែន', 'Jennifer Lawrence', 'Jennifer', 'Lawrence', 'Female', 'United States', 'american', 'United States', '1990-07-01', 'Florida', '098673453', 'jennifer@gmail.com', 'New York', 'download (4).jpg', '2024-06-03', 88871247, 'image/88871247.png'),
(10, 'ចេនីហ្វឹ ខុនលី', 'Jennifer connelly', 'Jennifer', 'connelly', 'Female', 'United States', 'american', 'United States', '1980-11-17', 'Washington DC', '077654841', 'connelly5435@gmail.com', 'Washington DC', 'download (5).jpg', '2024-06-03', 6953514, 'image/06953514.png'),
(11, 'ដេនហ្សែល វ៉ាស៊ីញតុន', 'Denzel Washington', 'Denzel', 'Washington', 'Male', 'United States', 'american', 'United States', '1970-03-16', 'California', '013533356', 'denzel@gmail.com', 'New York', 'download (6).jpg', '2024-06-03', 66027919, 'image/66027919.png'),
(12, 'សេម្ញុអេល ចេកសិន', 'Samuel l jackson', 'Samuel', 'jackson', 'Male', 'United States', 'american', 'United States', '1968-06-10', 'Long Island', '019348654', 'samuel@gmail.com', 'New York', 'download (7).jpg', '2024-06-03', 43914803, 'image/43914803.png'),
(13, 'សានត្រា ប៉ូលុក', 'Sandra Bullock', 'Sandra', 'Bullock', 'Female', 'United States', 'american', 'United States', '1985-04-29', 'Florida', '052464634', 'san@gmail.com', 'Washington DC', 'download (8).jpg', '2024-06-03', 18274716, 'image/18274716.png'),
(14, 'អាន ហាដាវេ', 'Anne Hathaway', 'Anne', 'Hathaway', 'Female', 'United States', 'american', 'United States', '1985-08-12', 'Arizona', '023584963', 'Hathaway@gmail.com', 'New York', 'download (9).jpg', '2024-06-03', 67500191, 'image/67500191.png'),
(15, 'នីខូល ឃីដមែន', 'Nicole Kidman', 'Nicole', 'Kidman', 'Female', 'United States', 'american', 'United States', '1980-06-16', 'Jerusalem', '087656786', 'nicole@gmail.com', 'California', 'download (10).jpg', '2024-06-03', 11996512, 'image/11996512.png'),
(16, 'ចេនីហ្វឺ អានីស្តុន', 'Jennifer Aniston', 'Jennifer', 'Aniston', 'Male', 'United States', 'american', 'United States', '1974-10-21', 'Texas', '025675766', 'aniston@gmail.com', 'Las Angeles', 'download.webp', '2024-06-03', 50896776, 'image/50896776.png'),
(17, 'អេម៉ា​ ស្តូន', 'Emma Stone', 'Emma ', 'Stone', 'Female', 'United States', 'american', 'United States', '1980-05-04', 'New Jersey', '099765455', 'emma@gmail.com', 'New York', 'download (11).jpg', '2024-06-03', 43029243, 'image/43029243.png'),
(18, 'ចូឌី ហ្វូស្ទឺ', 'Jodie Foster', 'Jodie', ' Foster', 'Female', 'United States', 'american', 'United States', '1985-10-13', 'Massachusets', '019385755', 'foster@gmail.com', 'New York', 'download (12).jpg', '2024-06-03', 76655158, 'image/76655158.png'),
(19, 'អាណឌេ អាម៉ាស', 'Ana de Armas', 'Ana', 'de Armas', 'Female', 'United States', 'american', 'United States', '1989-05-10', 'Cuban', '099745832', 'ana@gmail.com', 'New York', 'download (1).webp', '2024-06-03', 36770355, 'image/36770355.png'),
(20, 'ម៉៉ាខានស់ី ដាវីស', 'Mackenzie Davis', 'Mackenzie', 'Davis', 'Female', 'Canada', 'canadian', 'Canada', '1990-11-05', 'Canada Toronto', '014585855', 'davis@gmail.com', 'Toronto,Canada', 'images (2).jpg', '2024-06-03', 65218727, 'image/65218727.png'),
(21, 'ចូស្សាហ្វីន លែងហ្វត', 'josephine langford', 'josephine', 'langford', 'Female', 'Australia', 'australian', 'Australia', '2000-06-04', 'Perth', '08765655', 'josephine@gmail.com', 'Australia', 'Josephine_Langford_in_2021.png', '2024-06-05', 51046409, 'image/51046409.png'),
(22, 'ខេធី ផេរី', 'Katy Perry', 'Katy', 'Perry', 'Female', 'United States', 'american', 'United States', '2024-06-05', 'California', '08765655', 'katyperry@gmail.com', 'New York', 'katy-perry-harrison-butker.webp', '2024-06-05', 81990918, 'image/81990918.png'),
(23, 'ង៉ែត សុគន្ធផារ៉ានី', 'Nghet Sokunparany', 'Nghet', 'Sokunparany', 'Female', 'Cambodia', 'cambodian', 'Cambodia', '2004-02-24', 'Phnom Penh', '071 567 879', 'Sokunparany@gmail.com', 'North Carolina', 'Zendaya_-_2019_by_Glenn_Francis.jpg', '2024-06-25', 41371690, 'image/41371690.png'),
(24, 'ស្រីលីន', 'srey lin', 'srey', 'lin ', 'Female', 'Cambodia', 'cambodian', 'Cambodia', '2004-06-15', 'Phnom Penh', '0348443333', 'sreylin@gmail.com', 'Beoung Kok', 'images (2).jpg', '2024-07-08', 34503679, 'image/34503679.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudentstatus`
--

CREATE TABLE `tblstudentstatus` (
  `StudentStatusID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `ProgramID` int(11) NOT NULL,
  `Assigned` varchar(100) NOT NULL,
  `Note` varchar(100) NOT NULL,
  `AssignDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblstudentstatus`
--

INSERT INTO `tblstudentstatus` (`StudentStatusID`, `StudentID`, `ProgramID`, `Assigned`, `Note`, `AssignDate`) VALUES
(130, 1, 1, 'Choose status', 'Individuals project', '2024-06-30'),
(131, 2, 1, 'Assign', 'Individuals project', '2024-06-30'),
(132, 3, 1, 'Assign', 'Individuals project', '2024-06-30'),
(133, 4, 1, 'Assign', 'Individuals project', '2024-06-30'),
(134, 5, 1, 'Assign', 'Individuals project', '2024-06-30'),
(135, 6, 1, 'Assign', 'Individuals project', '2024-06-30'),
(136, 7, 1, 'Assign', 'Individuals project', '2024-06-30'),
(137, 8, 1, 'Assign', 'Individuals project', '2024-06-30'),
(138, 9, 1, 'Assign', 'Individuals project', '2024-06-30'),
(139, 10, 1, 'Assign', 'Individuals project', '2024-06-30'),
(140, 11, 1, 'Assign', 'Individuals project', '2024-06-30'),
(141, 12, 1, 'Assign', 'Individuals project', '2024-06-30'),
(142, 13, 1, 'Assign', 'Individuals project', '2024-06-30'),
(143, 14, 1, 'Assign', 'Individuals project', '2024-06-30'),
(144, 15, 1, 'Assign', 'Individuals project', '2024-06-30'),
(145, 17, 1, 'Assign', 'Individuals project', '2024-06-30'),
(146, 16, 1, 'Assign', 'Individuals project', '2024-06-30'),
(147, 18, 1, 'Assign', 'Individuals project', '2024-06-30'),
(148, 19, 1, 'Assign', 'Individuals project', '2024-06-30'),
(149, 20, 1, 'Assign', 'Individuals project', '2024-07-01'),
(150, 21, 1, 'Assign', 'Individuals project', '2024-07-01'),
(151, 22, 1, 'Assign', 'Individuals project', '2024-07-01'),
(152, 23, 1, 'Assign', 'Individuals project', '2024-07-01'),
(210, 1, 0, 'Assign', '', '0000-00-00'),
(211, 2, 0, 'Assign', '', '0000-00-00'),
(212, 3, 0, 'Assign', '', '0000-00-00'),
(213, 4, 0, 'Assign', '', '0000-00-00'),
(214, 5, 0, 'Assign', '', '0000-00-00'),
(215, 6, 0, 'Assign', '', '0000-00-00'),
(216, 7, 0, 'Assign', '', '0000-00-00'),
(217, 8, 0, 'Assign', '', '0000-00-00'),
(218, 9, 0, 'Assign', '', '0000-00-00'),
(219, 10, 0, 'Assign', '', '0000-00-00'),
(220, 11, 0, 'Assign', '', '0000-00-00'),
(221, 12, 0, 'Assign', '', '0000-00-00'),
(222, 13, 0, 'Assign', '', '0000-00-00'),
(223, 14, 0, 'Assign', '', '0000-00-00'),
(224, 15, 0, 'Assign', '', '0000-00-00'),
(225, 17, 0, 'Assign', '', '0000-00-00'),
(226, 16, 0, 'Assign', '', '0000-00-00'),
(227, 18, 0, 'Assign', '', '0000-00-00'),
(228, 19, 0, 'Assign', '', '0000-00-00'),
(229, 20, 0, 'Assign', '', '0000-00-00'),
(230, 21, 0, 'Assign', '', '0000-00-00'),
(231, 22, 0, 'Assign', '', '0000-00-00'),
(232, 23, 0, 'Assign', '', '0000-00-00'),
(233, 1, 4, 'Assign', 'New program', '2024-07-08'),
(234, 2, 4, 'Assign', 'New program', '2024-07-08'),
(235, 3, 4, 'Assign', 'New program', '2024-07-08'),
(236, 4, 4, 'Assign', 'New program', '2024-07-08'),
(237, 5, 4, 'Assign', 'New program', '2024-07-08');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubject`
--

CREATE TABLE `tblsubject` (
  `SubjectID` int(11) NOT NULL,
  `SubjectKH` varchar(250) NOT NULL,
  `SubjectEN` varchar(250) NOT NULL,
  `Credit` int(11) NOT NULL,
  `Hour` int(11) NOT NULL,
  `FacultyID` int(11) NOT NULL,
  `MajorID` int(11) NOT NULL,
  `Semester` varchar(11) NOT NULL,
  `Year` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsubject`
--

INSERT INTO `tblsubject` (`SubjectID`, `SubjectKH`, `SubjectEN`, `Credit`, `Hour`, `FacultyID`, `MajorID`, `Semester`, `Year`) VALUES
(8, 'កម្មវិធីអឹមអេសកម្រិតខ្ពស់', 'Advanced MS Application', 3, 45, 7, 41, '2', '1'),
(9, 'ភាសារអង់គ្លេសសម្រាប់កំព្យូទ័រ', 'English for Computer', 3, 45, 7, 41, '1', '1'),
(10, 'ថែទាំនិងជួសជុលកំព្យូទ័រ', 'Computer repairs and maintainance', 3, 45, 7, 41, '1', '1'),
(11, 'គោលការណ៏នៃសេដ្ឋកិច្ច', 'Principles of Economics', 3, 45, 7, 41, '1', '1'),
(12, 'ឌីហ្សាញកំព្យូទ័រ', 'Computer graphic design', 3, 45, 7, 41, '1', '1'),
(13, 'ស៊ីផ្លឹសផ្លឹស ១', 'C++ programming 1', 3, 45, 7, 41, '1', '1'),
(14, 'វេបផេជដាយណាមិក', 'Web page dynamic', 3, 45, 7, 41, '2', '1'),
(15, 'ស៊ីផ្លឹសផ្លឹស ២', 'C++ programming 2', 3, 45, 7, 41, '2', '1'),
(16, 'គណិតវិទ្យាសម្រាប់កំព្យូទ័រ', 'Mathematics for computing', 3, 45, 7, 41, '2', '1'),
(17, 'ការអភិវឌ្ឃន៏វរបបេស', 'Web-based development', 3, 45, 7, 41, '2', '1'),
(18, 'ការគ្រប់គ្រងដាតាបេស', 'Database management system', 3, 45, 7, 41, '1', '2'),
(19, 'កំព្យូទ័រណេតវើក', 'Computer Networking l', 3, 45, 7, 41, '2', '2'),
(20, 'ស៊ុឺវើសាយ', 'Client server-side programming', 3, 45, 7, 41, '2', '2'),
(21, 'ហ្សីសាប២', 'C# Progamming ll', 3, 45, 7, 41, '2', '2'),
(22, 'អេភីអាយ', 'Front-End Development wit API', 3, 45, 7, 41, '2', '2'),
(23, 'ការអភិវឌ្ឍ៏វេបសាយ', 'Professional web development', 3, 45, 7, 41, '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tbltime`
--

CREATE TABLE `tbltime` (
  `TimeID` int(11) NOT NULL,
  `ShiftID` int(11) NOT NULL,
  `TimeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbltime`
--

INSERT INTO `tbltime` (`TimeID`, `ShiftID`, `TimeName`) VALUES
(1, 1, '8:00AM--11:15AM'),
(2, 2, '2:00AM--5:15PM'),
(3, 3, '5:30PM--8:45PM');

-- --------------------------------------------------------

--
-- Table structure for table `tblyear`
--

CREATE TABLE `tblyear` (
  `YearID` int(11) NOT NULL,
  `YearKH` varchar(250) NOT NULL,
  `YearEN` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblyear`
--

INSERT INTO `tblyear` (`YearID`, `YearKH`, `YearEN`) VALUES
(1, '១', '1'),
(2, '២', '2'),
(3, '៣', '3'),
(4, '៤', '4');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `studentID`, `date`) VALUES
(6, 51046409, '2024-06-08'),
(7, 81990918, '2024-06-08'),
(8, 87775104, '2024-06-08'),
(9, 16979562, '2024-06-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newstatus`
--
ALTER TABLE `newstatus`
  ADD PRIMARY KEY (`NewStatusID`);

--
-- Indexes for table `tblacademicyear`
--
ALTER TABLE `tblacademicyear`
  ADD PRIMARY KEY (`AcademicYearID`);

--
-- Indexes for table `tblattendance`
--
ALTER TABLE `tblattendance`
  ADD PRIMARY KEY (`AttendanceID`);

--
-- Indexes for table `tblbatch`
--
ALTER TABLE `tblbatch`
  ADD PRIMARY KEY (`BatchID`);

--
-- Indexes for table `tblcampus`
--
ALTER TABLE `tblcampus`
  ADD PRIMARY KEY (`CampusID`);

--
-- Indexes for table `tblcountry`
--
ALTER TABLE `tblcountry`
  ADD PRIMARY KEY (`CountryID`);

--
-- Indexes for table `tbldays`
--
ALTER TABLE `tbldays`
  ADD PRIMARY KEY (`DayID`);

--
-- Indexes for table `tbldayweek`
--
ALTER TABLE `tbldayweek`
  ADD PRIMARY KEY (`DayWeekID`);

--
-- Indexes for table `tbldegree`
--
ALTER TABLE `tbldegree`
  ADD PRIMARY KEY (`DegreeID`);

--
-- Indexes for table `tbleducationalbackground`
--
ALTER TABLE `tbleducationalbackground`
  ADD PRIMARY KEY (`EducattionalBackgroundID`);

--
-- Indexes for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  ADD PRIMARY KEY (`FacultyID`);

--
-- Indexes for table `tblfamilybackground`
--
ALTER TABLE `tblfamilybackground`
  ADD PRIMARY KEY (`FamilyBackgroundID`);

--
-- Indexes for table `tbllecturer`
--
ALTER TABLE `tbllecturer`
  ADD PRIMARY KEY (`LecturerID`);

--
-- Indexes for table `tblmajor`
--
ALTER TABLE `tblmajor`
  ADD PRIMARY KEY (`MajorID`);

--
-- Indexes for table `tblnatioanlity`
--
ALTER TABLE `tblnatioanlity`
  ADD PRIMARY KEY (`NationalityID`);

--
-- Indexes for table `tblprogram`
--
ALTER TABLE `tblprogram`
  ADD PRIMARY KEY (`ProgramID`);

--
-- Indexes for table `tblroom`
--
ALTER TABLE `tblroom`
  ADD PRIMARY KEY (`RoomID`);

--
-- Indexes for table `tblschedule`
--
ALTER TABLE `tblschedule`
  ADD PRIMARY KEY (`ScheduleID`);

--
-- Indexes for table `tblschooltype`
--
ALTER TABLE `tblschooltype`
  ADD PRIMARY KEY (`SchoolTypeID`);

--
-- Indexes for table `tblsemester`
--
ALTER TABLE `tblsemester`
  ADD PRIMARY KEY (`SemesterID`);

--
-- Indexes for table `tblsex`
--
ALTER TABLE `tblsex`
  ADD PRIMARY KEY (`SexID`);

--
-- Indexes for table `tblshift`
--
ALTER TABLE `tblshift`
  ADD PRIMARY KEY (`ShiftID`);

--
-- Indexes for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `tblstudentstatus`
--
ALTER TABLE `tblstudentstatus`
  ADD PRIMARY KEY (`StudentStatusID`);

--
-- Indexes for table `tblsubject`
--
ALTER TABLE `tblsubject`
  ADD PRIMARY KEY (`SubjectID`);

--
-- Indexes for table `tbltime`
--
ALTER TABLE `tbltime`
  ADD PRIMARY KEY (`TimeID`);

--
-- Indexes for table `tblyear`
--
ALTER TABLE `tblyear`
  ADD PRIMARY KEY (`YearID`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `newstatus`
--
ALTER TABLE `newstatus`
  MODIFY `NewStatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `tblacademicyear`
--
ALTER TABLE `tblacademicyear`
  MODIFY `AcademicYearID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblattendance`
--
ALTER TABLE `tblattendance`
  MODIFY `AttendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=771;

--
-- AUTO_INCREMENT for table `tblbatch`
--
ALTER TABLE `tblbatch`
  MODIFY `BatchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblcampus`
--
ALTER TABLE `tblcampus`
  MODIFY `CampusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblcountry`
--
ALTER TABLE `tblcountry`
  MODIFY `CountryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbldays`
--
ALTER TABLE `tbldays`
  MODIFY `DayID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbldayweek`
--
ALTER TABLE `tbldayweek`
  MODIFY `DayWeekID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbldegree`
--
ALTER TABLE `tbldegree`
  MODIFY `DegreeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbleducationalbackground`
--
ALTER TABLE `tbleducationalbackground`
  MODIFY `EducattionalBackgroundID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  MODIFY `FacultyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `tblfamilybackground`
--
ALTER TABLE `tblfamilybackground`
  MODIFY `FamilyBackgroundID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbllecturer`
--
ALTER TABLE `tbllecturer`
  MODIFY `LecturerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblmajor`
--
ALTER TABLE `tblmajor`
  MODIFY `MajorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tblnatioanlity`
--
ALTER TABLE `tblnatioanlity`
  MODIFY `NationalityID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblprogram`
--
ALTER TABLE `tblprogram`
  MODIFY `ProgramID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblroom`
--
ALTER TABLE `tblroom`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblschedule`
--
ALTER TABLE `tblschedule`
  MODIFY `ScheduleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tblschooltype`
--
ALTER TABLE `tblschooltype`
  MODIFY `SchoolTypeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblsemester`
--
ALTER TABLE `tblsemester`
  MODIFY `SemesterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblsex`
--
ALTER TABLE `tblsex`
  MODIFY `SexID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblshift`
--
ALTER TABLE `tblshift`
  MODIFY `ShiftID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblstudent`
--
ALTER TABLE `tblstudent`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tblstudentstatus`
--
ALTER TABLE `tblstudentstatus`
  MODIFY `StudentStatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT for table `tblsubject`
--
ALTER TABLE `tblsubject`
  MODIFY `SubjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbltime`
--
ALTER TABLE `tbltime`
  MODIFY `TimeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblyear`
--
ALTER TABLE `tblyear`
  MODIFY `YearID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
