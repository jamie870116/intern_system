-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2017 at 02:50 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intern`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `anId` int(10) UNSIGNED NOT NULL,
  `anTittle` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anContent` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `anFile` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`anId`, `anTittle`, `anContent`, `anFile`, `created_at`, `updated_at`) VALUES
(1, '歡迎各位參與這次測試', '歡迎各位參與這次測試', NULL, '2017-11-18 23:04:32', '2017-11-18 23:04:32'),
(3, '106年暑假實習日程表', '暑期實習流程日程表\r\n\r\n4月1日~4月30日	實習媒合期，這段期間須完成媒合\r\n\r\n4月15日~5月7日	實習面試期，欲實習同學請於這段期間內與廠商完成洽談，並確定錄取\r\n\r\n5月10日~5月15日	實習分發結果發表，於這段期間內到系辦登記並分發課程、老師\r\n\r\n6月14日		舉行實習前說明會\r\n\r\n7月1日~8月31日	進行實習\r\n\r\n9月 繳交實習報告', NULL, '2017-11-19 05:36:43', '2017-11-19 05:36:43'),
(4, '106學年度暑期實習滿意度調查表', '請各位同學點擊以下網址，進行滿意度調查\r\nhttps://docs.google.com/forms/d/1E_AN52T7SrulZC3l29RhdWpohyDjAkDn76M3kmrKSZs/viewform?edit_requested=true', NULL, '2017-11-19 05:40:26', '2017-11-19 05:40:26'),
(5, '106學年度暑期實習說明會', '106學年度暑期實習說明會於4月15日(三)舉行\r\n請各位欲參加106學年度暑期實習說明會的同學，於4月15日(三)前往行政大樓98人會議室暑期實習說明會。', NULL, '2017-11-19 05:42:01', '2017-11-19 05:42:01'),
(6, '教育部-保障實習學生權益相關規定', '教育部-保障實習學生權益相關規定，請參閱附檔', '1511098927YmSYn_an.pdf,', '2017-11-19 05:42:45', '2017-11-19 05:42:45'),
(7, '實習單位報到確認書', '請參與企業會計實習課程實習生，至實習單位報到完成後，請實習單位填寫報到確認書(如附件)後，寄回系辦公室。', '1511099049WFDM1_an.docx,', '2017-11-19 05:44:13', '2017-11-19 05:44:13'),
(8, '106學年度暑期實習錄取學生', '暑期實習結果已傳送至告學生之帳號內，請各位實習同學前往確認，若有任何疑義者，請於6月30日之前前往系辦處理相關事務。', NULL, '2017-11-19 05:44:33', '2017-11-19 05:44:33'),
(9, '106學年暑假實習說明會簡報檔', '106學年暑假實習說明會簡報檔如附件，請參閱。\r\n\r\n補充說明：擔任「租稅與會計申報軟體」小老師，視實際開課情況而定。', '1511099386mgOMS_an.pdf,', '2017-11-19 05:49:48', '2017-11-19 05:49:48'),
(10, '105年暑假實習學生系統資料更新', '有關暑期實習同學，請登入系統進行基本資料維護，包括：\r\n\r\n地址、學歷、通過證照、社團與經歷，以提供實習單位查詢。\r\n\r\n請於6月3日前完成，謝謝\r\n\r\n網址：學生實習系統登入\r\n\r\n說明：\r\n\r\n5月26日早上因系統故障，造成部份資料流失，目前已經修復，\r\n\r\n但有部份同學資料需再次輸入，不便之處敬請原諒。\r\n\r\n有關學經歷資料、通過證照輸入字數不要太長(勿超過300字)\r\n\r\n如需要送詳細履歷資料，可送電子檔(PDF檔)，以網路連結方式呈現', NULL, '2017-11-19 05:50:23', '2017-11-19 05:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `assessment_com`
--

CREATE TABLE `assessment_com` (
  `asId` int(10) UNSIGNED NOT NULL,
  `SCid` int(11) NOT NULL,
  `asStart` date NOT NULL,
  `asEnd` date NOT NULL,
  `asDepartment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asStuName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asComName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asGrade1` int(11) NOT NULL,
  `asGrade2` int(11) NOT NULL,
  `asGrade3` int(11) NOT NULL,
  `asGrade4` int(11) NOT NULL,
  `asGrade5` int(11) NOT NULL,
  `asComment1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asComment2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asComment3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asComment4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asComment5` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asSickLeave_days` int(11) NOT NULL,
  `asSickLeave_hours` int(11) NOT NULL,
  `asOfficialLeave_days` int(11) NOT NULL,
  `asOfficialLeave_hours` int(11) NOT NULL,
  `asCasualLeave_days` int(11) NOT NULL,
  `asCasualLeave_hours` int(11) NOT NULL,
  `asMourningLeave_days` int(11) NOT NULL,
  `asMourningLeave_hours` int(11) NOT NULL,
  `asAbsenteeism_days` int(11) NOT NULL,
  `asAbsenteeism_hours` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assessment_teach`
--

CREATE TABLE `assessment_teach` (
  `asTId` int(10) UNSIGNED NOT NULL,
  `SCid` int(11) NOT NULL,
  `teacherGrade1` int(11) NOT NULL,
  `teacherGrade2` int(11) NOT NULL,
  `teacherGrade3` int(11) NOT NULL,
  `teacherGrade4` int(11) NOT NULL,
  `teacherGrade5` int(11) NOT NULL,
  `teacherGrade6` int(11) NOT NULL,
  `teacherGrade7` int(11) NOT NULL,
  `teacherGrade8` int(11) NOT NULL,
  `teacherGrade9` int(11) NOT NULL,
  `teacherGrade10` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalScore` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `com_basic`
--

CREATE TABLE `com_basic` (
  `c_account` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ctypes` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Information',
  `c_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caddress` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cfax` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cintroduction` longtext COLLATE utf8mb4_unicode_ci,
  `cempolyee_num` int(11) DEFAULT NULL,
  `cdeleteReason` longtext COLLATE utf8mb4_unicode_ci,
  `profilePic` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `introductionPic` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `com_basic`
--

INSERT INTO `com_basic` (`c_account`, `ctypes`, `c_name`, `caddress`, `cfax`, `cintroduction`, `cempolyee_num`, `cdeleteReason`, `profilePic`, `introductionPic`, `created_at`, `updated_at`, `deleted_at`) VALUES
('11223344', 'Information', '長榮企業', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-23 14:32:54', '2017-11-23 14:32:54', NULL),
('24584004', 'Information', '馥華生活股份有限公司', '台中市北屯區文心路三段447號13樓-1', '22112022', '電子商務網路購物平台', 0, NULL, '151110172572rwC_pro.jpg', NULL, '2017-11-15 06:47:37', '2017-11-19 06:28:45', NULL),
('2750963', 'Information', '工業技術研究院', '新竹縣竹東鎮頭重里中興路4段195號', '22112022', NULL, 0, NULL, '1511075288Uwu85_pro.png', NULL, '2017-11-15 06:47:36', '2017-11-18 23:08:09', NULL),
('43162200', 'Information', '宏碁雲端技術服務股份有限公司', '新竹縣竹東鎮頭重里中興路4段195號', '22112022', NULL, 0, NULL, '15110793527iLH3_pro.png', NULL, '2017-11-15 06:47:36', '2017-11-19 00:15:52', NULL),
('52010603', 'Information', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-24 10:22:22', '2017-11-24 10:22:22', NULL),
('52875138', 'Information', '國興資訊', '台中市西區梅川西路一段23號', '22112022', NULL, 0, NULL, NULL, NULL, '2017-11-15 06:47:37', '2017-11-15 06:47:37', NULL),
('54239825', 'Information', '遠景科技', '台中市北屯區文心路四段955號15樓之五', '22112022', '透過美國、亞太、歐洲、中東及非洲區的辦公室， 遠景科技協助世界頂尖的製造商快速地建構專屬的解決方案，並開創其物聯網商機；產業包括消費、商業及工業應用。遠景提供企業級、\n            巨量資料分析的物聯網平台，以供應原始設備製造商減低客製化設備的建構風險與障礙，同時開創高經濟價值。', 0, NULL, NULL, NULL, '2017-11-15 06:47:37', '2017-11-15 06:47:37', NULL),
('54891351', 'Information', '創科資訊股份有限公司', '臺中市西區臺灣大道二段2號16F-1', '22112022', NULL, 0, NULL, NULL, NULL, '2017-11-15 06:47:37', '2017-11-15 06:47:37', NULL),
('80231876', 'Information', '博科資訊', '臺中市 北屯區 松勇里 松明街68號1樓', '22112022', '本公司創始於1993年,以研發設計商用軟體及輔導客戶電腦化之商業活動為主.', 0, NULL, NULL, NULL, '2017-11-15 06:47:37', '2017-11-15 06:47:37', NULL),
('87878787', 'Information', '旻袁企業', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-23 14:50:11', '2017-11-23 14:50:11', NULL),
('99513636', 'Information', '台中科技大學', '台中市三民路三段129號', '22195678', NULL, 0, NULL, '1511356914ERBvY_pro.png', '123_up.JPG', '2017-11-15 06:47:36', '2017-11-22 05:21:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `counseling_result`
--

CREATE TABLE `counseling_result` (
  `counselingId` int(10) UNSIGNED NOT NULL,
  `SCid` int(11) NOT NULL,
  `counselingAddress` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counselingDate` datetime DEFAULT NULL,
  `cTeacherName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counselingContent` longtext COLLATE utf8mb4_unicode_ci,
  `counselingPic` longtext COLLATE utf8mb4_unicode_ci,
  `counselingText` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counseling_result`
--

INSERT INTO `counseling_result` (`counselingId`, `SCid`, `counselingAddress`, `counselingDate`, `cTeacherName`, `counselingContent`, `counselingPic`, `counselingText`, `created_at`, `updated_at`) VALUES
(1, 2, '新竹縣竹東鎮頭重里中興路4段195號', '2017-11-20 00:00:00', '蕭國輪', '環境優良,氣氛良好', '/CounselingResult/1511098652rmOKH_cr.jpg,', NULL, '2017-11-19 03:36:52', '2017-11-19 05:37:38'),
(2, 3, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-20 07:50:41', '2017-11-20 07:50:41'),
(3, 4, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22 02:50:00', '2017-11-22 02:50:00'),
(4, 5, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22 16:15:02', '2017-11-22 16:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseId` int(10) UNSIGNED NOT NULL,
  `courseName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courseJournal` int(11) NOT NULL,
  `courseDetail` longtext COLLATE utf8mb4_unicode_ci,
  `courseStart` datetime NOT NULL,
  `courseEnd` datetime NOT NULL,
  `courseSchoolSystem` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseId`, `courseName`, `courseJournal`, `courseDetail`, `courseStart`, `courseEnd`, `courseSchoolSystem`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '五專106學年學期實習', 8, '五專106學年學期實習', '2017-09-01 00:00:00', '2018-01-30 00:00:00', 0, '2017-11-18 22:05:29', '2017-11-18 22:10:52', NULL),
(2, '五專106學年暑期實習', 4, '五專106學年暑期實習', '2017-07-01 00:00:00', '2017-08-31 00:00:00', 0, '2017-11-18 22:07:51', '2017-11-18 22:10:42', NULL),
(3, '二技106學年暑期實習', 4, '二技106學年暑期實習', '2017-07-01 00:00:00', '2017-08-31 00:00:00', 1, '2017-11-18 22:08:58', '2017-11-18 22:08:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `intern_proposal`
--

CREATE TABLE `intern_proposal` (
  `IPId` int(10) UNSIGNED NOT NULL,
  `SCid` int(11) NOT NULL,
  `stuClass` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comDepartment` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comInstructor` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IPStart` date DEFAULT NULL,
  `IPEnd` date DEFAULT NULL,
  `IPGoal` longtext COLLATE utf8mb4_unicode_ci,
  `IPDescription` longtext COLLATE utf8mb4_unicode_ci,
  `IPTopic1` longtext COLLATE utf8mb4_unicode_ci,
  `IPTopic1Start` datetime DEFAULT NULL,
  `IPTopic1End` datetime DEFAULT NULL,
  `IPTopic2` longtext COLLATE utf8mb4_unicode_ci,
  `IPTopic2Start` datetime DEFAULT NULL,
  `IPTopic2End` datetime DEFAULT NULL,
  `IPTopic3` longtext COLLATE utf8mb4_unicode_ci,
  `IPTopic3Start` datetime DEFAULT NULL,
  `IPTopic3End` datetime DEFAULT NULL,
  `IPTopic4` longtext COLLATE utf8mb4_unicode_ci,
  `IPTopic4Start` datetime DEFAULT NULL,
  `IPTopic4End` datetime DEFAULT NULL,
  `IPTopic5` longtext COLLATE utf8mb4_unicode_ci,
  `IPTopic5Start` datetime DEFAULT NULL,
  `IPTopic5End` datetime DEFAULT NULL,
  `IPTopic6` longtext COLLATE utf8mb4_unicode_ci,
  `IPTopic6Start` datetime DEFAULT NULL,
  `IPTopic6End` datetime DEFAULT NULL,
  `IPTopic7` longtext COLLATE utf8mb4_unicode_ci,
  `IPTopic7Start` datetime DEFAULT NULL,
  `IPTopic7End` datetime DEFAULT NULL,
  `IPTopic8` longtext COLLATE utf8mb4_unicode_ci,
  `IPTopic8Start` datetime DEFAULT NULL,
  `IPTopic8End` datetime DEFAULT NULL,
  `IPInstruction` longtext COLLATE utf8mb4_unicode_ci,
  `IPComPlanning` longtext COLLATE utf8mb4_unicode_ci,
  `IPTeaPlanning` longtext COLLATE utf8mb4_unicode_ci,
  `IPIndicators` longtext COLLATE utf8mb4_unicode_ci,
  `IPAssessment` longtext COLLATE utf8mb4_unicode_ci,
  `IPFeedback` longtext COLLATE utf8mb4_unicode_ci,
  `IPRead` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `intern_proposal`
--

INSERT INTO `intern_proposal` (`IPId`, `SCid`, `stuClass`, `comDepartment`, `comInstructor`, `IPStart`, `IPEnd`, `IPGoal`, `IPDescription`, `IPTopic1`, `IPTopic1Start`, `IPTopic1End`, `IPTopic2`, `IPTopic2Start`, `IPTopic2End`, `IPTopic3`, `IPTopic3Start`, `IPTopic3End`, `IPTopic4`, `IPTopic4Start`, `IPTopic4End`, `IPTopic5`, `IPTopic5Start`, `IPTopic5End`, `IPTopic6`, `IPTopic6Start`, `IPTopic6End`, `IPTopic7`, `IPTopic7Start`, `IPTopic7End`, `IPTopic8`, `IPTopic8Start`, `IPTopic8End`, `IPInstruction`, `IPComPlanning`, `IPTeaPlanning`, `IPIndicators`, `IPAssessment`, `IPFeedback`, `IPRead`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2017-11-18 23:47:22', '2017-11-18 23:47:22'),
(2, 2, '資應五甲', '菁英代打', '李相赫', '2017-11-01', '2017-11-07', '實習課程目標', '實習課程內涵', '實習主題1', '2017-11-01 00:00:00', '2017-11-07 00:00:00', '實習主題2', '2017-11-08 00:00:00', '2017-11-14 00:00:00', '實習主題3', '2017-11-15 00:00:00', '2018-11-21 00:00:00', '實習主題4', '2017-11-22 00:00:00', '2017-11-29 00:00:00', '實習主題5', '2017-11-30 00:00:00', '2017-12-07 00:00:00', '實習主題6', '2017-12-08 00:00:00', '2017-12-15 00:00:00', '實習主題7', '2017-12-16 00:00:00', '2017-12-23 00:00:00', '實習主題8', '2017-12-24 00:00:00', '2017-12-31 00:00:00', '實習機構參與實習課程說明', '業界專家輔導實習課程規劃', '學校教師輔導學習課程規劃', '實習成效考核指標或項目', '實習成效或教學評量方式', '實習課後回饋規劃', 0, '2017-11-19 00:00:37', '2017-11-19 00:13:09'),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2017-11-20 07:50:41', '2017-11-20 07:50:41'),
(4, 4, '資應五甲', '資訊部', 'Jade', '2017-11-01', '2018-02-20', '學習雲端技術與應用', '學習雲端技術與應用', '學習雲端技術與應用', '2017-11-01 00:00:00', '2017-11-07 00:00:00', '學習雲端技術與應用', '2017-11-08 00:00:00', '2017-11-14 00:00:00', '學習雲端技術與應用', '2017-11-15 00:00:00', '2017-11-21 00:00:00', '學習雲端技術與應用', '2017-11-22 00:00:00', '2017-11-28 00:00:00', '學習雲端技術與應用', '2017-11-29 00:00:00', '2017-12-05 00:00:00', '學習雲端技術與應用', '2017-12-06 00:00:00', '2017-12-12 00:00:00', '學習雲端技術與應用', '2017-12-13 00:00:00', '2017-12-19 00:00:00', '學習雲端技術與應用', '2017-12-20 00:00:00', '2017-12-26 00:00:00', '學習雲端技術與應用', '學習雲端技術與應用', '學習雲端技術與應用', '學習雲端技術與應用', '學習雲端技術與應用', '學習雲端技術與應用', 0, '2017-11-22 02:50:00', '2017-11-22 06:39:05');

-- --------------------------------------------------------

--
-- Table structure for table `interviews`
--

CREATE TABLE `interviews` (
  `inid` int(10) UNSIGNED NOT NULL,
  `mid` int(11) NOT NULL,
  `inaddress` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intime` datetime NOT NULL,
  `jcontact_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jcontact_phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jcontact_email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `innotice` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interviews`
--

INSERT INTO `interviews` (`inid`, `mid`, `inaddress`, `intime`, `jcontact_name`, `jcontact_phone`, `jcontact_email`, `innotice`, `created_at`, `updated_at`) VALUES
(2, 2, '407台中市西屯區文華路100號', '2017-11-21 00:00:00', '李銘祥', '0987462591', 'zxc24630918@gmail.com', '不要遲到', '2017-11-18 23:59:07', '2017-11-18 23:59:07'),
(3, 3, '407台中市西屯區文華路100號', '2017-11-20 00:00:00', '李銘祥', '0987462591', 'zxc24630918@gmail.com', '不要遲到', '2017-11-19 00:03:30', '2017-11-19 00:03:30'),
(4, 4, '407台中市西屯區文華路100號', '2017-11-20 00:00:00', '李銘祥', '0987462591', 'zxc24630918@gmail.com', '不要遲到', '2017-11-19 00:21:09', '2017-11-19 00:21:09'),
(5, 22, '台中市三民路三段129號', '2017-11-30 00:00:00', '何明彥', '0922333655', 'mail4564585@gmail.com', '別遲到了', '2017-11-22 07:40:20', '2017-11-22 07:40:20');

-- --------------------------------------------------------

--
-- Table structure for table `interview_com`
--

CREATE TABLE `interview_com` (
  `insCId` int(10) UNSIGNED NOT NULL,
  `SCid` int(11) NOT NULL,
  `insCDate` date NOT NULL,
  `insCNum` int(11) NOT NULL,
  `insCVisitWay` tinyint(4) NOT NULL DEFAULT '0',
  `insCAns` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `insCQuestionVer` tinyint(4) NOT NULL DEFAULT '1',
  `insCComments` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interview_com`
--

INSERT INTO `interview_com` (`insCId`, `SCid`, `insCDate`, `insCNum`, `insCVisitWay`, `insCAns`, `insCQuestionVer`, `insCComments`, `created_at`, `updated_at`) VALUES
(1, 2, '2017-11-27', 30, 0, '2,0,1,0,1,0,1,0', 1, '大致上都不錯，但是交通有點不方便', '2017-11-27 05:06:13', '2017-11-27 05:06:13'),
(2, 2, '2017-11-28', 30, 1, '0,0,0,0,0,0,0,0', 1, '20', '2017-11-27 05:08:03', '2017-11-27 05:08:03'),
(3, 2, '2017-11-27', 3, 0, '0,0,0,0,0,0,0,0', 1, '很棒', '2017-11-27 15:53:27', '2017-11-27 15:53:27'),
(4, 4, '2017-11-27', 5, 0, '0,0,0,0,0,0,0,0', 1, 'Great', '2017-11-27 16:19:52', '2017-11-27 16:38:38');

-- --------------------------------------------------------

--
-- Table structure for table `interview_com_questions`
--

CREATE TABLE `interview_com_questions` (
  `insCQId` int(10) UNSIGNED NOT NULL,
  `insCQuestion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `insCAnswerType` tinyint(4) NOT NULL DEFAULT '0',
  `insCQuestionVer` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interview_com_questions`
--

INSERT INTO `interview_com_questions` (`insCQId`, `insCQuestion`, `insCAnswerType`, `insCQuestionVer`, `created_at`, `updated_at`) VALUES
(1, '您感覺實習機構提供實習員實習環境，是否滿意?', 0, 1, '2017-11-15 06:47:36', '2017-11-15 06:47:36'),
(2, '您感覺實習機構對於實習員訓練與輔導，是否落實?', 0, 1, '2017-11-15 06:47:36', '2017-11-15 06:47:36'),
(3, '當您請實習機構協助推動實習事宜時，其配合程度?', 0, 1, '2017-11-15 06:47:36', '2017-11-15 06:47:36'),
(4, '當您與實習機構承辦人員的交談、溝通及互動，其態度如何?', 0, 1, '2017-11-15 06:47:36', '2017-11-15 06:47:36'),
(5, '實習機構未來是否會優先綠用本系畢業生，您感覺其意願程度?', 0, 1, '2017-11-15 06:47:36', '2017-11-15 06:47:36'),
(6, '實習機構提供之工作內容與簽約內容、所學是否符合?', 0, 1, '2017-11-15 06:47:36', '2017-11-15 06:47:36'),
(7, '實習機構是否安排值錢與在職訓練?', 0, 1, '2017-11-15 06:47:36', '2017-11-15 06:47:36'),
(8, '實習機構是否有工作不當之分配?', 0, 1, '2017-11-15 06:47:36', '2017-11-15 06:47:36');

-- --------------------------------------------------------

--
-- Table structure for table `interview_stu`
--

CREATE TABLE `interview_stu` (
  `insId` int(10) UNSIGNED NOT NULL,
  `SCid` int(11) NOT NULL,
  `insDate` date NOT NULL,
  `insNum` int(11) NOT NULL,
  `insStuClass` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `insVisitWay` tinyint(4) NOT NULL,
  `insAns` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `insQuestionVer` tinyint(4) NOT NULL,
  `insComments` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interview_stu`
--

INSERT INTO `interview_stu` (`insId`, `SCid`, `insDate`, `insNum`, `insStuClass`, `insVisitWay`, `insAns`, `insQuestionVer`, `insComments`, `created_at`, `updated_at`) VALUES
(1, 2, '2017-11-29', 30, '資應五甲', 1, '0,0,1,0,1,0,1,1', 1, '交通有點不便 其他大致上都可以接受', '2017-11-27 05:10:36', '2017-11-27 05:10:36'),
(2, 4, '2017-11-27', 5, 'IA5', 1, '0,0,0,0,0,0,0', 2, 'Great', '2017-11-27 16:27:10', '2017-11-27 16:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `interview_stu_questions`
--

CREATE TABLE `interview_stu_questions` (
  `insQId` int(10) UNSIGNED NOT NULL,
  `insQuestion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `insAnswerType` tinyint(4) NOT NULL DEFAULT '0',
  `insQuestionVer` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interview_stu_questions`
--

INSERT INTO `interview_stu_questions` (`insQId`, `insQuestion`, `insAnswerType`, `insQuestionVer`, `created_at`, `updated_at`) VALUES
(1, '您感覺實習員對實習機構給予的實習訓練與輔導，是否落實而滿意?', 0, 1, '2017-11-15 06:47:36', '2017-11-15 06:47:36'),
(2, '與實習員訪談後，感受到其對實習工作的滿意度如何?', 0, 1, '2017-11-15 06:47:36', '2017-11-15 06:47:36'),
(3, '實習員談到工作時，其積極參與的程度如何?', 0, 1, '2017-11-15 06:47:36', '2017-11-15 06:47:36'),
(5, '實習員對於實習機構給予的輔導瞭解程度如何?', 0, 1, '2017-11-15 06:47:36', '2017-11-15 06:47:36'),
(6, '實習員對於工作量是否合理?', 0, 1, '2017-11-15 06:47:36', '2017-11-15 06:47:36'),
(7, '實習員對於工作中與主管、同事相處情形?', 0, 1, '2017-11-15 06:47:36', '2017-11-15 06:47:36'),
(8, '實習員對企業實習，是否滿意?', 1, 1, '2017-11-15 06:47:36', '2017-11-15 06:47:36'),
(9, '您感覺實習員對實習機構給予的實習訓練與輔導，是否落實而滿意??', 0, 2, '2017-11-27 12:51:22', '2017-11-27 12:51:22'),
(10, '與實習員訪談後，感受到其對實習工作的滿意度如何??', 0, 2, '2017-11-27 12:51:22', '2017-11-27 12:51:22'),
(11, '實習員談到工作時，其積極參與的程度如何?', 0, 2, '2017-11-27 12:51:22', '2017-11-27 12:51:22'),
(12, '實習員對於實習機構給予的輔導瞭解程度如何?', 0, 2, '2017-11-27 12:51:22', '2017-11-27 12:51:22'),
(13, '實習員對於工作量是否合理?', 0, 2, '2017-11-27 12:51:22', '2017-11-27 12:51:22'),
(14, '實習員對於工作中與主管、同事相處情形?', 0, 2, '2017-11-27 12:51:22', '2017-11-27 12:51:22'),
(15, '實習員對企業實習，是否滿意?', 1, 2, '2017-11-27 12:51:22', '2017-11-27 12:51:22');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(5, 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmail\",\"command\":\"O:18:\\\"App\\\\Jobs\\\\SendEmail\\\":5:{s:7:\\\"\\u0000*\\u0000data\\\";a:4:{s:4:\\\"mail\\\";s:21:\\\"a0981152468@gmail.com\\\";s:4:\\\"code\\\";s:10:\\\"jipe9ipmkw\\\";s:8:\\\"userName\\\";s:12:\\\"MINYUAN-TSAI\\\";s:7:\\\"account\\\";s:11:\\\"tsaihau1998\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;}\"}}', 0, NULL, 1510933767, 1510933767),
(8, 'default', '{\"displayName\":\"App\\\\Jobs\\\\sendResultmail_faild\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\sendResultmail_faild\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\sendResultmail_faild\\\":5:{s:7:\\\"\\u0000*\\u0000data\\\";a:2:{s:4:\\\"mail\\\";s:24:\\\"msphausung1998@gmail.com\\\";s:6:\\\"u_name\\\";s:12:\\\"\\u65fb\\u8881\\u4f01\\u696d\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;}\"}}', 0, NULL, 1511439985, 1511439985);

-- --------------------------------------------------------

--
-- Table structure for table `jopOpening`
--

CREATE TABLE `jopOpening` (
  `joid` int(10) UNSIGNED NOT NULL,
  `c_account` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jtypes` tinyint(4) NOT NULL DEFAULT '0',
  `jduties` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jdetails` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `jsalary_up` int(11) DEFAULT NULL,
  `jsalary_low` int(11) NOT NULL,
  `jcontact_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jcontact_phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jcontact_email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jaddress` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jStartDutyTime` time NOT NULL,
  `jEndDutyTime` time NOT NULL,
  `jdeadline` datetime NOT NULL,
  `jNOP` int(11) NOT NULL,
  `jdelete_reason` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jopOpening`
--

INSERT INTO `jopOpening` (`joid`, `c_account`, `c_name`, `jtypes`, `jduties`, `jdetails`, `jsalary_up`, `jsalary_low`, `jcontact_name`, `jcontact_phone`, `jcontact_email`, `jaddress`, `jStartDutyTime`, `jEndDutyTime`, `jdeadline`, `jNOP`, `jdelete_reason`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2750963', '工業技術研究院', 1, '前端實習生', '含勞健保 周休2日 一年兩次員工旅遊', 25000, 22000, '李銘祥', '0987462591', 'zxc24630918@gmail.com', '407台中市西屯區文華路100號', '09:00:00', '17:00:00', '2017-12-31 00:00:00', 3, NULL, '2017-11-18 22:27:14', '2017-11-18 22:27:14', NULL),
(2, '2750963', '工業技術研究院', 1, '後端作業員', '含勞健保 周休2日 一年兩次員工旅遊', 30000, 25000, '李銘祥', '0987462591', 'zxc24630918@gmail.com', '407台中市西屯區文華路100號', '09:00:00', '17:00:00', '2017-11-25 00:00:00', 2, NULL, '2017-11-18 22:28:37', '2017-11-19 00:00:37', NULL),
(3, '2750963', '工業技術研究院', 3, '伺服器管理', '含勞健保 周休2日 一年兩次員工旅遊\n須有相關工作經驗', 50000, 40000, '李銘祥', '0987462591', 'zxc24630918@gmail.com', '407台中市西屯區文華路100號', '09:00:00', '17:00:00', '2017-12-20 00:00:00', -1, NULL, '2017-11-18 22:30:19', '2017-11-20 07:50:40', NULL),
(4, '43162200', '宏碁雲端技術服務股份有限公司', 3, '網頁設計師', '含勞健保 \r\n周休2日 \r\n一年兩次員工旅遊 \r\n不須有相關工作經驗', 2000, 500, '吳佳原', '22112022', 'abcshie123456@gmail.com', '新竹縣竹東鎮頭重里中興路4段195號', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 6, NULL, '2017-11-19 00:12:51', '2017-11-22 02:49:59', NULL),
(5, '43162200', '宏碁雲端技術服務股份有限公司', 2, '後端工程師', '含勞健保 周休2日 一年兩次員工旅遊 不須有相關工作經驗', 133, 300, '吳佳原', '22112022', 'abcshie123456@gmail.com', '新竹縣竹東鎮頭重里中興路4段195號', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 3, NULL, '2017-11-19 05:05:27', '2017-11-19 05:05:27', NULL),
(6, '43162200', '宏碁雲端技術服務股份有限公司', 2, '全端工程師', '含勞健保 周休2日 一年兩次員工旅遊 不須有相關工作經驗', 600, 1000, '吳佳原', '22112022', 'abcshie123456@gmail.com', '新竹縣竹東鎮頭重里中興路4段195號', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 2, NULL, '2017-11-19 05:05:54', '2017-11-19 05:05:54', NULL),
(7, '99513636', '台中科技大學', 2, '網路工程師', '含勞健保 周休2日 一年兩次員工旅遊 不須有相關工作經驗', 600, 1000, '何明彥', '22112022', 'zxbcs56823@gmail.com', '台中市三民路三段129號', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 2, NULL, '2017-11-19 05:09:29', '2017-11-22 05:28:17', NULL),
(8, '99513636', '台中科技大學', 3, '工程師', '含勞健保 周休2日 一年兩次員工旅遊 不須有相關工作經驗', 600, 1000, '何明彥', '22112022', 'zxbcs56823@gmail.com', '台中市三民路三段129號', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 2, NULL, '2017-11-19 05:13:24', '2017-11-22 05:28:17', NULL),
(9, '99513636', '台中科技大學', 0, '儲備幹部', '含勞健保 周休2日 一年兩次員工旅遊 不須有相關工作經驗', 600, 1000, '何明彥', '22112022', 'zxbcs56823@gmail.com', '台中市三民路三段129號', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 2, NULL, '2017-11-19 05:13:43', '2017-11-22 05:28:17', NULL),
(10, '52875138', '國興資訊', 1, '多媒體網頁設計師', '含勞健保 周休2日 一年兩次員工旅遊 不須有相關工作經驗', 600, 1000, '葉怡君', '22112022', 'yy456823@gmail.com', '台中市西區梅川西路一段23號', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 2, NULL, '2017-11-19 05:15:22', '2017-11-19 05:15:22', NULL),
(11, '52875138', '國興資訊', 2, 'PHP程式設計師', '含勞健保 周休2日 一年兩次員工旅遊 不須有相關工作經驗', 600, 1000, '葉怡君', '22112022', 'yy456823@gmail.com', '台中市西區梅川西路一段23號', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 2, NULL, '2017-11-19 05:15:36', '2017-11-19 05:15:36', NULL),
(12, '52875138', '國興資訊', 0, '業務助理', '含勞健保 周休2日 一年兩次員工旅遊 不須有相關工作經驗', 600, 1000, '葉怡君', '22112022', 'yy456823@gmail.com', '台中市西區梅川西路一段23號', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 3, NULL, '2017-11-19 05:15:53', '2017-11-22 15:48:24', NULL),
(13, '54891351', '創科資訊股份有限公司', 0, 'UI設計', '含勞健保 周休2日 一年兩次員工旅遊 不須有相關工作經驗', 250, 1500, '吳明華', '22112022', 'zhunflspe123@gmail.com', '臺中市西區臺灣大道二段2號16F-1', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 2, NULL, '2017-11-19 05:21:31', '2017-11-19 05:21:31', NULL),
(14, '54891351', '創科資訊股份有限公司', 2, '網頁前端工程師', '01. HTML5，CSS3，jQuery，JAVASCRIPT、DIV+CSS，完成頁面架構和布局。 02. 具備響應\n無經驗可', 250, 1500, '吳明華', '22112022', 'zhunflspe123@gmail.com', '臺中市西區臺灣大道二段2號16F-1', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 2, NULL, '2017-11-19 05:22:10', '2017-11-19 05:22:10', NULL),
(15, '54891351', '創科資訊股份有限公司', 1, '視覺設計', '版面編排設計 經歷不拘學歷不拘', 250, 1500, '吳明華', '22112022', 'zhunflspe123@gmail.com', '臺中市西區臺灣大道二段2號16F-1', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 2, NULL, '2017-11-19 05:22:56', '2017-11-19 05:22:56', NULL),
(16, '80231876', '博科資訊', 1, '網站程式設計師', '依公司規定台中市南區經歷不拘學歷不拘', 250, 1500, '賴曉倩', '22112022', 'jasld56594@gmail.com', '臺中市 北屯區 松勇里 松明街68號1樓', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 2, NULL, '2017-11-19 05:25:54', '2017-11-19 05:25:54', NULL),
(17, '80231876', '博科資訊', 0, '網頁設計師(前端)', '依公司規定台中市南區經歷不拘學歷不拘', 250, 1500, '賴曉倩', '22112022', 'jasld56594@gmail.com', '臺中市 北屯區 松勇里 松明街68號1樓', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 2, NULL, '2017-11-19 05:26:09', '2017-11-19 05:26:09', NULL),
(18, '80231876', '博科資訊', 3, '程式設計師', '依公司規定台中市南區經歷不拘學歷不', 250, 1500, '賴曉倩', '22112022', 'jasld56594@gmail.com', '臺中市 北屯區 松勇里 松明街68號1樓', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 6, NULL, '2017-11-19 05:26:57', '2017-11-19 05:26:57', NULL),
(19, '54239825', '遠景科技', 3, 'Linux Embedded Engineer', '・About the role: We are looking for a Senior Embedded Firmware Engineer to join our', 250, 1500, '陳炎煌', '22112022', 'yrujd5659@gmail.com', '台中市北屯區文心路四段955號15樓之五', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 6, NULL, '2017-11-19 05:29:33', '2017-11-19 05:29:33', NULL),
(20, '54239825', '遠景科技', 1, '網管工程師', '1.負責Windows AD網域、Office365及Windows Server管理及維運。 2.負責Linux 系統與相關服', 250, 1500, '陳炎煌', '22112022', 'yrujd5659@gmail.com', '台中市北屯區文心路四段955號15樓之五', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 6, NULL, '2017-11-19 05:29:56', '2017-11-19 05:29:56', NULL),
(21, '54239825', '遠景科技', 0, '.Net 程式設計師', '1.好的撰寫程式習慣熟悉 MVC架構 2.熟悉MySQL資料庫 3.熟 .Net C# 4協同工程師整合Web', 250, 1500, '陳炎煌', '22112022', 'yrujd5659@gmail.com', '台中市北屯區文心路四段955號15樓之五', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 6, NULL, '2017-11-19 05:30:16', '2017-11-19 05:30:16', NULL),
(22, '24584004', '馥華生活股份有限公司', 1, '技術服務部副理 / 技術主管', '1.規劃技術服務部門人力配置，提升部門之人力素質，達成部門營運目標。 2.協助訂立與執行，系統', 250, 1500, '林炳賢', '22112022', 'oxc4842@gmail.com', '台中市北屯區文心路三段447號13樓-1', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 6, NULL, '2017-11-19 05:31:39', '2017-11-19 05:32:56', NULL),
(23, '24584004', '馥華生活股份有限公司', 1, 'DevOps Engineer', 'Job Description for DevOps position [Responsibilities] - Develop infrastructure for building,', 250, 1500, '林炳賢', '22112022', 'oxc4842@gmail.com', '台中市北屯區文心路三段447號13樓-1', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 4, NULL, '2017-11-19 05:31:55', '2017-11-22 16:15:01', NULL),
(24, '24584004', '馥華生活股份有限公司', 3, '軟體工程師', '1.負責軟體的分析、設計、程式撰寫與維護。 2.控管軟體設計進度。 3.進行軟體之測試與修改。', 250, 1500, '林炳賢', '22112022', 'oxc4842@gmail.com', '台中市北屯區文心路三段447號13樓-1', '09:30:00', '16:00:00', '2017-12-31 00:00:00', 6, NULL, '2017-11-19 05:32:24', '2017-11-19 05:32:47', NULL),
(25, '99513636', '台中科技大學', 2, '測試員', '含勞健保 周休2日 一年兩次員工旅遊 不須有相關工作經驗', 250, 140, '何明彥', '22112022', 'zxbcs56823@gmail.com', '台中市三民路三段129號', '14:00:00', '17:00:00', '2017-11-30 00:00:00', 3, NULL, '2017-11-22 07:11:24', '2017-11-22 07:26:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `journalID` int(10) UNSIGNED NOT NULL,
  `SCid` int(11) NOT NULL,
  `journalOrder` int(11) NOT NULL,
  `journalDetail_1` longtext COLLATE utf8mb4_unicode_ci,
  `journalDetail_2` longtext COLLATE utf8mb4_unicode_ci,
  `journalStart` datetime DEFAULT NULL,
  `journalEnd` datetime DEFAULT NULL,
  `journalInstructor` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `journalComments_ins` longtext COLLATE utf8mb4_unicode_ci,
  `journalComments_teacher` longtext COLLATE utf8mb4_unicode_ci,
  `grade_ins` int(11) DEFAULT NULL,
  `grade_teacher` int(11) DEFAULT NULL,
  `scoredTime_tea` datetime DEFAULT NULL,
  `scoredTime_com` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journal`
--

INSERT INTO `journal` (`journalID`, `SCid`, `journalOrder`, `journalDetail_1`, `journalDetail_2`, `journalStart`, `journalEnd`, `journalInstructor`, `journalComments_ins`, `journalComments_teacher`, `grade_ins`, `grade_teacher`, `scoredTime_tea`, `scoredTime_com`, `created_at`, `updated_at`) VALUES
(5, 2, 0, '第一天上班 有點緊張 陌生的環境 有點可怕', '學長來帶我參觀公司讓我熟悉環境 \r\n還有學長人很好 希望之後一千順利', '2017-11-01 00:00:00', '2017-11-14 00:00:00', '李銘祥', '很棒喔', '很好繼續努力', 99, 80, '2017-11-23 20:07:23', '2017-11-20 06:20:54', '2017-11-19 00:00:37', '2017-11-23 12:07:23'),
(6, 2, 1, '滾動條滑動事件 發生問題\r\n版面與後端api發生不一致問題', '需要注意滾動條是位於哪個標籤之下\r\n畫板人員與後端人員需要多多溝通', '2017-11-15 00:00:00', '2017-11-28 00:00:00', '李銘祥', '999999', NULL, 88, NULL, NULL, '2017-11-20 06:22:53', '2017-11-19 00:00:37', '2017-11-21 21:10:51'),
(7, 2, 2, '今天前端js引入檔出現問題', 'js引入檔出現問題的機會雖然少，可是出現的話也不好處理', '2017-11-29 00:00:00', '2017-12-12 00:00:00', '李銘祥', '很認真，願意與他人溝通', NULL, 80, NULL, NULL, '2017-11-22 23:49:36', '2017-11-19 00:00:37', '2017-11-22 15:49:36'),
(8, 2, 3, '主管今天很不高興，因為Server壞了，所以這兩天都寸步難行', 'server 壞了是很嚴重的大事 ，如果沒有經驗豐富的前輩的話，大概會出大事吧', '2017-12-13 00:00:00', '2017-12-26 00:00:00', '李銘祥', '在維修期間，也不忘學習，與前輩探討錯誤', NULL, 85, NULL, NULL, '2017-11-22 23:51:04', '2017-11-19 00:00:37', '2017-11-22 15:51:04'),
(9, 2, 4, '這禮拜有放到元旦假日大家回來後心情都很不錯\r\n所以進度很順利', '良好的工作環境有助於工作效率', '2017-12-27 00:00:00', '2018-01-09 00:00:00', '李銘祥', '心情好，工作效率也會好，我也好想放假。', NULL, 80, NULL, NULL, '2017-11-22 23:51:59', '2017-11-19 00:00:37', '2017-11-22 15:51:59'),
(10, 2, 5, '這禮拜前後端銜接得很順利，希望可以繼續保持', '前後端如果溝通良好的話，在製作銜接上會很輕鬆', '2018-01-10 00:00:00', '2018-01-23 00:00:00', '李銘祥', '恩，溝通是很重要的，不要害怕與他人談話。', NULL, 85, NULL, NULL, '2017-11-22 23:52:37', '2017-11-19 00:00:37', '2017-11-27 07:12:48'),
(11, 2, 6, '這禮拜差不多要把最後的工作做完，準備把系統上架了。\r\n但是發現還有一小部分的工作完全沒有動到，導致很多人都要加班', '如果你有漏掉的工作，在最後才被發現，就必須要大家幫你趕工完成，希望之後可以早點發現', '2018-01-24 00:00:00', '2018-02-06 00:00:00', '李銘祥', '突然多出來的工作真的是很辛苦呢，尤其是最後3天，還有很多學長都沒回家直接睡在公司，你還是實習生，出了社會就沒這麼輕鬆了。', NULL, 90, NULL, NULL, '2017-11-22 23:54:22', '2017-11-19 00:00:37', '2017-11-22 15:54:22'),
(12, 2, 7, '最後一個禮拜系統上線了，雖然還有一些後續問題，但是主管人很好，還是讓我用最後一個禮拜把後續工作交結完成。就結束這次的實習', '系統上架後，不是結束，而是更多問題的開始，因為使用者永遠可以發現你沒發現的問題。', '2018-02-07 00:00:00', '2018-02-20 00:00:00', '李銘祥', '辛苦了，雖然時間不長，但是這段期間內有你的加入，公司內的氣氛都變得熱絡起來了，希望在未來的路上，能夠在與你共事。', NULL, 100, NULL, NULL, '2017-11-22 23:56:19', '2017-11-19 00:00:37', '2017-11-22 15:56:19'),
(13, 3, 0, NULL, NULL, '2017-10-01 00:00:00', '2017-10-14 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-20 07:50:40', '2017-11-20 07:50:40'),
(14, 3, 1, NULL, NULL, '2017-10-15 00:00:00', '2017-10-28 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-20 07:50:40', '2017-11-20 07:50:40'),
(15, 3, 2, NULL, NULL, '2017-10-29 00:00:00', '2017-11-11 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-20 07:50:40', '2017-11-20 07:50:40'),
(16, 3, 3, NULL, NULL, '2017-11-12 00:00:00', '2017-11-25 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-20 07:50:40', '2017-11-20 07:50:40'),
(17, 4, 0, '學習雲端技術與應用', '學習雲端技術與應用', '2017-11-01 00:00:00', '2017-11-14 00:00:00', 'Jade', NULL, '讚哦', NULL, 87, '2017-11-23 22:07:06', NULL, '2017-11-22 02:49:59', '2017-11-23 14:07:06'),
(18, 4, 1, '學到了很多與雲端有關的硬體設備 (IOT)', '雲教授是個不錯的產品', '2017-11-15 00:00:00', '2017-11-28 00:00:00', 'Jade', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22 02:49:59', '2017-11-22 17:24:43'),
(19, 4, 2, '滾動條滑動事件 發生問題\r\n版面與後端api發生不一致問題', '需要注意滾動條是位於哪個標籤之下\r\n畫板人員與後端人員需要多多溝通', '2017-11-29 00:00:00', '2017-12-12 00:00:00', 'Jade', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22 02:50:00', '2017-11-23 01:55:04'),
(20, 4, 3, '今天前端js引入檔出現問題', 'js引入檔出現問題的機會雖然少，可是出現的話也不好處理', '2017-12-13 00:00:00', '2017-12-26 00:00:00', 'Jade', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22 02:50:00', '2017-11-23 01:55:45'),
(21, 4, 4, '最後一個禮拜系統上線了，雖然還有一些後續問題，但是主管人很好，還是讓我用最後一個禮拜把後續工作交結完成。就結束這次的實習', '系統上架後，不是結束，而是更多問題的開始，因為使用者永遠可以發現你沒發現的問題。', '2017-12-27 00:00:00', '2018-01-09 00:00:00', 'Jade', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22 02:50:00', '2017-11-23 01:56:30'),
(22, 4, 5, '這禮拜差不多要把最後的工作做完，準備把系統上架了。\r\n但是發現還有一小部分的工作完全沒有動到，導致很多人都要加班', '如果你有漏掉的工作，在最後才被發現，就必須要大家幫你趕工完成，希望之後可以早點發現', '2018-01-10 00:00:00', '2018-01-23 00:00:00', 'Jade', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22 02:50:00', '2017-11-23 01:56:44'),
(23, 4, 6, '主管今天很不高興，因為Server壞了，所以這兩天都寸步難行', 'server 壞了是很嚴重的大事 ，如果沒有經驗豐富的前輩的話，大概會出大事吧', '2018-01-24 00:00:00', '2018-02-06 00:00:00', 'Jade', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22 02:50:00', '2017-11-23 01:57:58'),
(24, 4, 7, '最後一個禮拜系統上線了，雖然還有一些後續問題，但是主管人很好，還是讓我用最後一個禮拜把後續工作交結完成。就結束這次的實習', '系統上架後，不是結束，而是更多問題的開始，因為使用者永遠可以發現你沒發現的問題。', '2018-02-07 00:00:00', '2018-02-20 00:00:00', 'Jade', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22 02:50:00', '2017-11-23 01:57:28'),
(25, 5, 0, NULL, NULL, '2017-11-05 00:00:00', '2017-11-18 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22 16:15:01', '2017-11-22 16:15:01'),
(26, 5, 1, NULL, NULL, '2017-11-19 00:00:00', '2017-12-02 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22 16:15:01', '2017-11-22 16:15:01'),
(27, 5, 2, NULL, NULL, '2017-12-03 00:00:00', '2017-12-16 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22 16:15:01', '2017-11-22 16:15:01'),
(28, 5, 3, NULL, NULL, '2017-12-17 00:00:00', '2017-12-30 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22 16:15:01', '2017-11-22 16:15:01'),
(29, 5, 4, NULL, NULL, '2017-12-31 00:00:00', '2018-01-13 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22 16:15:01', '2017-11-22 16:15:01'),
(30, 5, 5, NULL, NULL, '2018-01-14 00:00:00', '2018-01-27 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22 16:15:02', '2017-11-22 16:15:02'),
(31, 5, 6, NULL, NULL, '2018-01-28 00:00:00', '2018-02-10 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22 16:15:02', '2017-11-22 16:15:02'),
(32, 5, 7, NULL, NULL, '2018-02-11 00:00:00', '2018-02-24 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22 16:15:02', '2017-11-22 16:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `match`
--

CREATE TABLE `match` (
  `mid` int(10) UNSIGNED NOT NULL,
  `sid` int(11) NOT NULL,
  `c_account` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `joid` int(11) NOT NULL,
  `jduties` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jdetails` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `mstatus` tinyint(4) NOT NULL DEFAULT '1',
  `tid` int(11) DEFAULT NULL,
  `mfailedreason` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `match`
--

INSERT INTO `match` (`mid`, `sid`, `c_account`, `joid`, `jduties`, `jdetails`, `mstatus`, `tid`, `mfailedreason`, `created_at`, `updated_at`) VALUES
(1, 30, '2750963', 3, '伺服器管理', '含勞健保 周休2日 一年兩次員工旅遊\n須有相關工作經驗', 11, 15, NULL, '2017-11-18 23:45:24', '2017-11-20 07:50:40'),
(2, 30, '2750963', 2, '後端作業員', '含勞健保 周休2日 一年兩次員工旅遊', 11, 15, NULL, '2017-11-18 23:57:59', '2017-11-19 00:00:37'),
(3, 30, '2750963', 1, '前端實習生', '含勞健保 周休2日 一年兩次員工旅遊', 8, NULL, NULL, '2017-11-19 00:01:48', '2017-11-19 00:04:10'),
(4, 29, '2750963', 2, '後端作業員', '含勞健保 周休2日 一年兩次員工旅遊', 9, NULL, NULL, '2017-11-19 00:16:31', '2017-11-19 00:24:05'),
(5, 1, '43162200', 6, '全端工程師', '含勞健保 周休2日 一年兩次員工旅遊 不須有相關工作經驗', 9, NULL, NULL, '2017-11-19 06:02:30', '2017-11-19 06:04:00'),
(6, 3, '43162200', 6, '全端工程師', '含勞健保 周休2日 一年兩次員工旅遊 不須有相關工作經驗', 9, NULL, NULL, '2017-11-19 06:08:53', '2017-11-19 06:12:52'),
(7, 7, '2750963', 1, '前端實習生', '含勞健保 周休2日 一年兩次員工旅遊', 9, NULL, NULL, '2017-11-19 06:25:51', '2017-11-19 06:29:44'),
(8, 13, '24584004', 24, '軟體工程師', '1.負責軟體的分析、設計、程式撰寫與維護。 2.控管軟體設計進度。 3.進行軟體之測試與修改。', 9, NULL, NULL, '2017-11-19 06:30:11', '2017-11-19 06:31:21'),
(9, 12, '2750963', 1, '前端實習生', '含勞健保 周休2日 一年兩次員工旅遊', 9, NULL, NULL, '2017-11-19 06:30:19', '2017-11-19 06:34:00'),
(10, 11, '24584004', 23, 'DevOps Engineer', 'Job Description for DevOps position [Responsibilities] - Develop infrastructure for building,', 9, NULL, NULL, '2017-11-19 06:32:30', '2017-11-19 06:33:13'),
(11, 16, '24584004', 23, 'DevOps Engineer', 'Job Description for DevOps position [Responsibilities] - Develop infrastructure for building,', 9, NULL, NULL, '2017-11-19 06:34:33', '2017-11-19 06:36:24'),
(12, 9, '54239825', 21, '.Net 程式設計師', '1.好的撰寫程式習慣熟悉 MVC架構 2.熟悉MySQL資料庫 3.熟 .Net C# 4協同工程師整合Web', 9, NULL, NULL, '2017-11-19 06:36:32', '2017-11-19 06:37:36'),
(13, 8, '24584004', 23, 'DevOps Engineer', 'Job Description for DevOps position [Responsibilities] - Develop infrastructure for building,', 9, NULL, NULL, '2017-11-19 06:37:56', '2017-11-19 06:40:18'),
(14, 7, '54239825', 19, 'Linux Embedded Engineer', '・About the role: We are looking for a Senior Embedded Firmware Engineer to join our', 6, NULL, NULL, '2017-11-19 06:38:54', '2017-11-19 06:40:22'),
(15, 6, '54239825', 19, 'Linux Embedded Engineer', '・About the role: We are looking for a Senior Embedded Firmware Engineer to join our', 9, NULL, NULL, '2017-11-19 06:41:22', '2017-11-19 06:41:59'),
(16, 5, '80231876', 17, '網頁設計師(前端)', '依公司規定台中市南區經歷不拘學歷不拘', 9, NULL, NULL, '2017-11-19 06:41:40', '2017-11-19 06:42:50'),
(17, 3, '54239825', 19, 'Linux Embedded Engineer', '・About the role: We are looking for a Senior Embedded Firmware Engineer to join our', 9, NULL, NULL, '2017-11-19 06:42:30', '2017-11-19 06:43:28'),
(18, 26, '43162200', 4, '網頁設計師', '含勞健保 \r\n周休2日 \r\n一年兩次員工旅遊 \r\n不須有相關工作經驗', 11, 15, NULL, '2017-11-20 03:03:57', '2017-11-22 02:49:59'),
(19, 26, '2750963', 1, '前端實習生', '含勞健保 周休2日 一年兩次員工旅遊', 1, NULL, NULL, '2017-11-20 03:04:16', '2017-11-20 03:04:16'),
(20, 26, '24584004', 22, '技術服務部副理 / 技術主管', '1.規劃技術服務部門人力配置，提升部門之人力素質，達成部門營運目標。 2.協助訂立與執行，系統', 1, NULL, NULL, '2017-11-20 03:04:47', '2017-11-20 03:04:47'),
(21, 1, '2750963', 3, '伺服器管理', '含勞健保 周休2日 一年兩次員工旅遊\n須有相關工作經驗', 1, NULL, NULL, '2017-11-20 05:17:52', '2017-11-20 05:17:52'),
(22, 29, '52875138', 10, '多媒體網頁設計師', '含勞健保 周休2日 一年兩次員工旅遊 不須有相關工作經驗', 8, NULL, NULL, '2017-11-22 07:39:00', '2017-11-22 07:40:51'),
(23, 33, '24584004', 24, '軟體工程師', '1.負責軟體的分析、設計、程式撰寫與維護。 2.控管軟體設計進度。 3.進行軟體之測試與修改。', 9, NULL, NULL, '2017-11-22 16:00:00', '2017-11-22 16:02:37'),
(24, 33, '24584004', 23, 'DevOps Engineer', 'Job Description for DevOps position [Responsibilities] - Develop infrastructure for building,', 11, 15, NULL, '2017-11-22 16:10:03', '2017-11-22 16:15:01'),
(25, 30, '99513636', 25, '測試員', '含勞健保 周休2日 一年兩次員工旅遊 不須有相關工作經驗', 1, NULL, NULL, '2017-11-24 10:11:54', '2017-11-24 10:11:54'),
(26, 30, '99513636', 7, '網路工程師', '含勞健保 周休2日 一年兩次員工旅遊 不須有相關工作經驗', 1, NULL, NULL, '2017-11-27 07:02:00', '2017-11-27 07:02:00'),
(27, 30, '43162200', 6, '全端工程師', '含勞健保 周休2日 一年兩次員工旅遊 不須有相關工作經驗', 1, NULL, NULL, '2017-11-28 13:23:08', '2017-11-28 13:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `matchLog`
--

CREATE TABLE `matchLog` (
  `logid` int(10) UNSIGNED NOT NULL,
  `mstatus` tinyint(4) NOT NULL DEFAULT '0',
  `mid` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matchLog`
--

INSERT INTO `matchLog` (`logid`, `mstatus`, `mid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, '2017-11-18 23:45:24', '2017-11-18 23:45:24'),
(2, 6, 1, NULL, '2017-11-18 23:45:42', '2017-11-18 23:45:42'),
(3, 9, 1, NULL, '2017-11-18 23:45:53', '2017-11-18 23:45:53'),
(4, 11, 1, NULL, '2017-11-18 23:47:22', '2017-11-18 23:47:22'),
(5, 1, 2, NULL, '2017-11-18 23:57:59', '2017-11-18 23:57:59'),
(6, 3, 2, NULL, '2017-11-18 23:59:07', '2017-11-18 23:59:07'),
(7, 4, 2, NULL, '2017-11-18 23:59:23', '2017-11-18 23:59:23'),
(8, 7, 2, NULL, '2017-11-18 23:59:51', '2017-11-18 23:59:51'),
(9, 9, 2, NULL, '2017-11-19 00:00:04', '2017-11-19 00:00:04'),
(10, 11, 2, NULL, '2017-11-19 00:00:37', '2017-11-19 00:00:37'),
(11, 1, 3, NULL, '2017-11-19 00:01:48', '2017-11-19 00:01:48'),
(12, 3, 3, NULL, '2017-11-19 00:03:30', '2017-11-19 00:03:30'),
(13, 4, 3, NULL, '2017-11-19 00:03:54', '2017-11-19 00:03:54'),
(14, 8, 3, NULL, '2017-11-19 00:04:10', '2017-11-19 00:04:10'),
(15, 1, 4, NULL, '2017-11-19 00:16:31', '2017-11-19 00:16:31'),
(16, 3, 4, NULL, '2017-11-19 00:21:09', '2017-11-19 00:21:09'),
(17, 4, 4, NULL, '2017-11-19 00:23:06', '2017-11-19 00:23:06'),
(18, 7, 4, NULL, '2017-11-19 00:23:52', '2017-11-19 00:23:52'),
(19, 9, 4, NULL, '2017-11-19 00:24:05', '2017-11-19 00:24:05'),
(20, 1, 5, NULL, '2017-11-19 06:02:30', '2017-11-19 06:02:30'),
(21, 6, 5, NULL, '2017-11-19 06:03:41', '2017-11-19 06:03:41'),
(22, 9, 5, NULL, '2017-11-19 06:04:00', '2017-11-19 06:04:00'),
(23, 1, 6, NULL, '2017-11-19 06:08:53', '2017-11-19 06:08:53'),
(24, 6, 6, NULL, '2017-11-19 06:12:14', '2017-11-19 06:12:14'),
(25, 9, 6, NULL, '2017-11-19 06:12:52', '2017-11-19 06:12:52'),
(26, 1, 7, NULL, '2017-11-19 06:25:51', '2017-11-19 06:25:51'),
(27, 6, 7, NULL, '2017-11-19 06:29:12', '2017-11-19 06:29:12'),
(28, 9, 7, NULL, '2017-11-19 06:29:44', '2017-11-19 06:29:44'),
(29, 1, 8, NULL, '2017-11-19 06:30:11', '2017-11-19 06:30:11'),
(30, 1, 9, NULL, '2017-11-19 06:30:19', '2017-11-19 06:30:19'),
(31, 6, 8, NULL, '2017-11-19 06:31:07', '2017-11-19 06:31:07'),
(32, 9, 8, NULL, '2017-11-19 06:31:21', '2017-11-19 06:31:21'),
(33, 1, 10, NULL, '2017-11-19 06:32:30', '2017-11-19 06:32:30'),
(34, 6, 10, NULL, '2017-11-19 06:33:00', '2017-11-19 06:33:00'),
(35, 9, 10, NULL, '2017-11-19 06:33:13', '2017-11-19 06:33:13'),
(36, 6, 9, NULL, '2017-11-19 06:33:32', '2017-11-19 06:33:32'),
(37, 9, 9, NULL, '2017-11-19 06:34:00', '2017-11-19 06:34:00'),
(38, 1, 11, NULL, '2017-11-19 06:34:33', '2017-11-19 06:34:33'),
(39, 6, 11, NULL, '2017-11-19 06:35:12', '2017-11-19 06:35:12'),
(40, 9, 11, NULL, '2017-11-19 06:36:24', '2017-11-19 06:36:24'),
(41, 1, 12, NULL, '2017-11-19 06:36:32', '2017-11-19 06:36:32'),
(42, 6, 12, NULL, '2017-11-19 06:37:05', '2017-11-19 06:37:05'),
(43, 9, 12, NULL, '2017-11-19 06:37:36', '2017-11-19 06:37:36'),
(44, 1, 13, NULL, '2017-11-19 06:37:56', '2017-11-19 06:37:56'),
(45, 1, 14, NULL, '2017-11-19 06:38:54', '2017-11-19 06:38:54'),
(46, 6, 13, NULL, '2017-11-19 06:39:36', '2017-11-19 06:39:36'),
(47, 9, 13, NULL, '2017-11-19 06:40:18', '2017-11-19 06:40:18'),
(48, 6, 14, NULL, '2017-11-19 06:40:22', '2017-11-19 06:40:22'),
(49, 1, 15, NULL, '2017-11-19 06:41:22', '2017-11-19 06:41:22'),
(50, 1, 16, NULL, '2017-11-19 06:41:40', '2017-11-19 06:41:40'),
(51, 6, 15, NULL, '2017-11-19 06:41:43', '2017-11-19 06:41:43'),
(52, 9, 15, NULL, '2017-11-19 06:41:59', '2017-11-19 06:41:59'),
(53, 6, 16, NULL, '2017-11-19 06:42:21', '2017-11-19 06:42:21'),
(54, 1, 17, NULL, '2017-11-19 06:42:30', '2017-11-19 06:42:30'),
(55, 9, 16, NULL, '2017-11-19 06:42:50', '2017-11-19 06:42:50'),
(56, 6, 17, NULL, '2017-11-19 06:42:51', '2017-11-19 06:42:51'),
(57, 9, 17, NULL, '2017-11-19 06:43:28', '2017-11-19 06:43:28'),
(58, 1, 18, NULL, '2017-11-20 03:03:58', '2017-11-20 03:03:58'),
(59, 1, 19, NULL, '2017-11-20 03:04:16', '2017-11-20 03:04:16'),
(60, 1, 20, NULL, '2017-11-20 03:04:47', '2017-11-20 03:04:47'),
(61, 1, 21, NULL, '2017-11-20 05:17:52', '2017-11-20 05:17:52'),
(62, 11, 1, NULL, '2017-11-20 07:50:40', '2017-11-20 07:50:40'),
(63, 6, 18, NULL, '2017-11-22 02:44:12', '2017-11-22 02:44:12'),
(64, 9, 18, NULL, '2017-11-22 02:46:02', '2017-11-22 02:46:02'),
(65, 11, 18, NULL, '2017-11-22 02:49:59', '2017-11-22 02:49:59'),
(66, 1, 22, NULL, '2017-11-22 07:39:00', '2017-11-22 07:39:00'),
(67, 3, 22, NULL, '2017-11-22 07:40:20', '2017-11-22 07:40:20'),
(68, 4, 22, NULL, '2017-11-22 07:40:37', '2017-11-22 07:40:37'),
(69, 8, 22, NULL, '2017-11-22 07:40:51', '2017-11-22 07:40:51'),
(70, 1, 23, NULL, '2017-11-22 16:00:00', '2017-11-22 16:00:00'),
(71, 6, 23, NULL, '2017-11-22 16:00:47', '2017-11-22 16:00:47'),
(72, 9, 23, NULL, '2017-11-22 16:02:37', '2017-11-22 16:02:37'),
(73, 1, 24, NULL, '2017-11-22 16:10:03', '2017-11-22 16:10:03'),
(74, 6, 24, NULL, '2017-11-22 16:10:20', '2017-11-22 16:10:20'),
(75, 9, 24, NULL, '2017-11-22 16:10:31', '2017-11-22 16:10:31'),
(76, 11, 24, NULL, '2017-11-22 16:15:01', '2017-11-22 16:15:01'),
(77, 1, 25, NULL, '2017-11-24 10:11:54', '2017-11-24 10:11:54'),
(78, 1, 26, NULL, '2017-11-27 07:02:00', '2017-11-27 07:02:00'),
(79, 1, 27, NULL, '2017-11-28 13:23:08', '2017-11-28 13:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_05_10_071202_create_tokens_table', 1),
(4, '2017_06_023_074404_create_stu_basic_table', 1),
(5, '2017_06_23_074509_create_stu_exp_table', 1),
(6, '2017_06_23_081553_create_stu_works_table', 1),
(7, '2017_07_03_155732_create_jobs_table', 1),
(8, '2017_07_09_092127_create_job_openning_table', 1),
(9, '2017_07_12_080346_create_com_basic_table', 1),
(10, '2017_07_18_085547_create_match_table', 1),
(11, '2017_07_19_073108_create_interviews_table', 1),
(12, '2017_07_25_044249_create_matchLog_table', 1),
(13, '2017_07_27_145348_create_stu_ability_table', 1),
(14, '2017_08_08_060752_create_course_table', 1),
(15, '2017_08_08_061505_create_stu_course_course_table', 1),
(16, '2017_08_08_070606_create_journal_table', 1),
(17, '2017_08_14_034931_create_reviews_table', 1),
(18, '2017_08_14_042131_create_interview_stu_table', 1),
(19, '2017_08_14_044716_create_interview_stu_questions_table', 1),
(20, '2017_08_14_051111_create_interview_com_table', 1),
(21, '2017_08_14_052206_create_interview_com_questions_table', 1),
(22, '2017_08_17_062103_create_assessment_com_table', 1),
(23, '2017_08_21_021012_create_announcement_table', 1),
(24, '2017_08_22_150151_create_assessment_teach_table', 1),
(25, '2017_08_28_122115_create_station_letter_table', 1),
(26, '2017_09_03_061903_create_teacher_profile_pic_table', 1),
(27, '2017_09_14_022650_create_sendmail_bc_table', 1),
(28, '2017_10_07_122124_create_counseling_result_table', 1),
(29, '2017_10_07_125712_create_intern_proposal_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reId` int(10) UNSIGNED NOT NULL,
  `SCid` int(11) NOT NULL,
  `reContent` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `reRead` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reId`, `SCid`, `reContent`, `reRead`, `created_at`, `updated_at`) VALUES
(2, 2, '最重要的是：每件事都必須有個目的\n\n在 AmazingTalker 實習這三個月中，我學到很重要的一件事是：社群不能只做自己開心，如果受眾或顧客不買帳，或是你沒辦法配合產品檔期做規劃跟宣傳，前與後對不起來的結果，你再怎麼用力推都只是白費工夫。而這個「到底要幹嘛？」就會變得很重要，因為你要先有具體的訴求或結果，才可以針對這個目標做所有規劃，在跟著幾次的行銷宣傳活動後，我更加明白這個道理，不然目無目的放箭，最後得不到實質成效，自己也是會很灰心的。\n\n而對我來說，學習永遠是不斷延續的一趟旅程，你可能覺得自己對於某一個領域稍微有點了解，但其實，過一段時間都會有更多新技術、新事物湧現，你又要開始去了解這些東西到底是什麼。我覺得實習的過程就像在「打怪練功」，每天都會有各種挑戰，然後有很多機會去接觸各種好玩的東西，過程可能很辛苦、很迷惘，但每過了一個階段就會覺得，自己真的有一點點的進步了，這些都是學校裡面很難遇到的珍貴機會。\n\n\n在 AmazingTalker 實習的這段期間，我更知道「主動學習」的重要，因為有些東西是當你開始實作之後才會發現問題在哪，比起跟人請教，自己去發掘到底是哪個癥結卡住了，並且親手去找答案、解決問題，相比之下還更加有趣，當然如果遇到超出自己等級的還是要問別人啊！所以要說深刻的感受，那就是實習每天都在吸收新知，無論是社群行銷上面的 know-how，或者各種數據的分析、追蹤，如果沒有真的踏入公司實際操作，平常真的很難有機會接觸到，所以，知道自己的目標，並且不斷的篩選、學習相關的知識，永遠是成長路上最有效的一個方法。\n\n\n雖然，成長與學習是相當重要的課題，但是我覺得實習最重要的一件事，是這段過程中認識的每一個人，在這段時間要感謝很多朋友的協助，尤其是時常合作的 Emily，有時候假日、半夜還會互相確認各種進度，不管是在社群經營或者部落格撰寫，都得到很多協助，在 AmazingTalker 跟這些非常認真、努力的人一起共事、一起講垃圾話真的很開心，這才是我得到最棒的收穫。\n\n最後，真的很感謝 AmazingTalker 大家的照顧，這三個月得到了很多成長與啟發，希望可以帶著這些收穫繼續前進，克服所有迎來的挑戰！\n\nhttps://blog-tw.amazingtalker.com/blog/2017/5/4/wei', 0, '2017-11-19 00:00:37', '2017-11-23 01:44:19'),
(3, 3, '', 0, '2017-11-20 07:50:40', '2017-11-20 07:50:40'),
(4, 4, '2017 年的暑假，我加入了微軟學生大使的行列，成為第 12 屆微軟學生大使，在裡面不僅僅提升了技術方面的專業知識，也學習了企劃及美宣各方面的技巧、訓練，更體會在團隊中互相幫助，在這一年中可以和大家一起挑戰一重又一重的難關、完成一次又一次的活動，是我最大的收穫。\n \n\n　　這項微軟學生大使計畫主要是期待我們能夠學習微軟的最新技術並且將學習到的最新技術推廣到校園去。當時參加面試，第一階段為履歷海選；第二階段是團體競賽，一組大概 5 ~ 6 人，會給每組一個題目，而題目必須結合 Microsoft Azure 雲端計算平台的服務，必須在時間內想出一個方案或產品並進行現場簡報，由此可知，這次實習相當注重團隊精神；而最後一關就是主管面試，還好運氣好我只是被問一些履歷上的問題，後來知道其他間有當場寫程式碼。最後錄取上時也是十分興奮，想說機會難得可以進來磨練看看。\n \n\n　　我們這屆技術組收的人比較多，大概是希望我們在技術推廣可以多下點工，工欲善其事，必先利其器，在暑假期間就邀請了好幾位高手來教導我們微軟的最新技術，像是 Microsoft Azure 雲端計算平台、Xamarin 跨平台開發、以及現在最流行的聊天機器人（BOT）等等，當然也邀請企畫及美宣的達人來教導我們當我們進行提案要注意甚麼、可以往什麼方向思考才可以抓住觀眾的心、及一些設計的軟體要如何操作，過了充實的兩個月後在最後有 Boot Camp 的活動，這也是令我印象深刻的一個活動，感受很深，透過一個個的活動，短短的兩天一夜，大家又更加親近，更熟悉彼此的個性，少了一層隔閡，更懂得團隊合作。\n \n\n　　而在進行下半年的活動前，當然要先進行寒假訓練，在這四天中，我們討論了 Imagine Cup 全球學生科技競賽要實作的作品並進行小小的黑客松，還有討論各小組在下半年的招生、想要推廣的技術及 Imagine Cup 的內容及時程，並進行簡報，雖然很多方案連我們自己都不知道行不行得通，但就像主管說的，因為沒有人做過所以你們就去試試看，成敗事後再來討論，可以邊做邊修改，說不定會有意想不到的成效。這就是我們可以在實習中很自由的做自己想做的事，還可以使用 MSDN 的訂閱來使用一些需要付費的服務來做自己平常想嘗試卻無法嘗試的東西，再將成品推廣出去，大膽、自由嘗試，這應該也算微軟學生實習的一大特點。', 0, '2017-11-22 02:50:00', '2017-11-23 02:01:02'),
(5, 5, '七月一日我就開始了我的工作，見到老闆的第一天，他跟我說第一個\n月先學如何做帳，知道整個業務的流程，第二個月再開始接觸個案執行。\n其實老實說，我那時候還挺興奮的，覺得真的可以接觸實務的生活了。\n這次的實習如果自己不夠積極、努力、多觀察、多問問題的話，其實也只\n能學到些基本的輸入資料。但是人一旦開始接觸到陌生的環境，五官就會\n敏銳的去察覺周邊的變化，學習就在這時候開始。\n我們也開始學會問問題或上網找資料，問說為什麼會這樣，為什麼要那樣，\n要如何節稅、避稅的話題也漸漸成為大家午餐時討論的主題，因為我們都\n不想抱著遺憾回家，總不可能都只有呆呆的坐在椅子上打那些資料而已，\n坐到我的屁股都變的超大的。\n我也很慶幸我是生在台灣，我們的身邊總是有很多的資訊和情報，比起生\n活在沒有電視機、不能輕鬆上學，不能掌握到正確情報的貧窮世界的國家\n的人們，大家是處於多麼有利的地位阿!可以在大企業內部當那些玩弄數字\n的人，少打一個零和多打一個零，足以讓企業快樂的不得了，但在這之前\n你會先被你的上司給”OUT”!\n實習完後我變的更有遠見，原來這些懂規則的社會中上階層的人是過的如\n此快樂、臉總是笑瞇瞇的生活時，比起我辛苦打工還賺不到他們 1/4 的薪\n水時我真的要做些【改變】和【學習】。\n在公司裡跟同事相處是一件很開心的事，不像我以前想像的在公司，出社\n會的人都會變的很險惡，雖然老闆也真的會生氣，但都是因為員工們的目\n標沒有達成或做出錯誤的決定，平常的時候，老闆也會請大家喝咖啡，吃\n蛋糕什麼的，在這樣能學到很多東西又和同事相處愉快的公司裡，或許只\n能說是我的幸運吧！\n人生中有很多經歷都是要在事後才能去體會它所帶來的意義，這一次實\n習對我的影響當然不止上述的專業養成及工作態度，但在很多方面它的\n確是影響了我，希望在未來最後一年的學生生涯可以用在這裡學到的工\n作態度努力去學習，並在未來職場上將這兩個月的所學加以應用。', 0, '2017-11-22 16:15:02', '2017-11-22 16:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `send_mail_bc`
--

CREATE TABLE `send_mail_bc` (
  `slId` int(10) UNSIGNED NOT NULL,
  `lStatus` tinyint(4) NOT NULL DEFAULT '0',
  `lSender` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin123',
  `lSenderName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '系辦',
  `lRecipient` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lRecipientName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lTitle` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lContent` longtext COLLATE utf8mb4_unicode_ci,
  `lNotes` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `send_mail_bc`
--

INSERT INTO `send_mail_bc` (`slId`, `lStatus`, `lSender`, `lSenderName`, `lRecipient`, `lRecipientName`, `lTitle`, `lContent`, `lNotes`, `created_at`, `updated_at`) VALUES
(1, 0, 's111111111', '李庚翰', '99513636', '長安工程行', '你好', '你好', NULL, '2017-11-19 22:24:11', '2017-11-19 22:24:11'),
(2, 0, 's111111111', '李庚翰', '2750963', '工業技術研究院', '請問test1', '請問test1', NULL, '2017-11-27 16:05:46', '2017-11-27 16:05:46'),
(3, 0, 's111111111', '李庚翰', '2750963', '工業技術研究院', '請問test2', '請問test2', NULL, '2017-11-27 16:06:08', '2017-11-27 16:06:08'),
(4, 0, 's111111111', '李庚翰', '2750963', '工業技術研究院', '請問test3', '請問test3', NULL, '2017-11-27 16:09:24', '2017-11-27 16:09:24'),
(5, 0, 's111111111', '李庚翰', '2750963', '工業技術研究院', 'test4', 'test4', NULL, '2017-11-27 16:10:43', '2017-11-27 16:10:43'),
(6, 0, 's111111111', '李庚翰', '2750963', '工業技術研究院', 'test5', 'test5', NULL, '2017-11-27 16:10:49', '2017-11-27 16:10:49'),
(7, 0, 's111111111', '李庚翰', '2750963', '工業技術研究院', 'test6', 'test6', NULL, '2017-11-27 16:10:55', '2017-11-27 16:10:55'),
(8, 0, 's111111111', '李庚翰', '2750963', '工業技術研究院', 'test7', 'test7', NULL, '2017-11-27 16:11:00', '2017-11-27 16:11:00'),
(9, 0, 's111111111', '李庚翰', '2750963', '工業技術研究院', 'test8', 'test8', NULL, '2017-11-27 16:11:05', '2017-11-27 16:11:05'),
(10, 0, '2750963', '工業技術研究院', 's111111111', '李庚翰', 'RE:[test8] #1', '安安以回復', NULL, '2017-11-27 16:18:28', '2017-11-27 16:18:28'),
(11, 0, 's1110234006', '許歆荷', '2750963', '工業技術研究院', '您好', '您好，請問還有職缺嗎?', NULL, '2017-11-27 16:26:09', '2017-11-27 16:26:09'),
(12, 0, '2750963', '工業技術研究院', 's1110234006', '許歆荷', 'RE:[您好] #1', '有的', NULL, '2017-11-27 16:26:42', '2017-11-27 16:26:42'),
(13, 0, '2750963', '工業技術研究院', 's1110234006', '許歆荷', 'RE:[您好] #1', '有的2', NULL, '2017-11-27 16:26:54', '2017-11-27 16:26:54');

-- --------------------------------------------------------

--
-- Table structure for table `station_letter`
--

CREATE TABLE `station_letter` (
  `slId` int(10) UNSIGNED NOT NULL,
  `lStatus` tinyint(4) NOT NULL DEFAULT '0',
  `lSender` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin123',
  `lSenderName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '系辦',
  `lRecipient` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lRecipientName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lTitle` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lContent` longtext COLLATE utf8mb4_unicode_ci,
  `lNotes` longtext COLLATE utf8mb4_unicode_ci,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `favourite` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `station_letter`
--

INSERT INTO `station_letter` (`slId`, `lStatus`, `lSender`, `lSenderName`, `lRecipient`, `lRecipientName`, `lTitle`, `lContent`, `lNotes`, `read`, `favourite`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin123', '系辦', '2750963', '工業技術研究院', '學生 李庚翰對您投出履歷', '李庚翰對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '1', 1, 0, NULL, '2017-11-18 23:45:24', '2017-11-18 23:45:32'),
(2, 6, 'admin123', '系辦', 's111111111', '李庚翰', '工業技術研究院履歷投遞結果', '您已被工業技術研究院直接錄取\\n\n                                            請點選下列按鈕回覆該企業是否到職\\n', '1', 1, 0, NULL, '2017-11-18 23:45:42', '2017-11-28 10:46:10'),
(3, 9, 'admin123', '系辦', '2750963', '工業技術研究院', '李庚翰到職意願結果', '李庚翰已接受您的到職邀請\\n', '1', 1, 0, NULL, '2017-11-18 23:45:53', '2017-11-18 23:46:02'),
(4, 11, 'admin123', '系辦', 'teacher456', '蕭國倫', '媒合成功通知信', '您的學生 李庚翰成為您的指導實習生', '1', 1, 0, NULL, '2017-11-18 23:47:22', '2017-11-20 00:34:39'),
(5, 11, 'admin123', '系辦', 's111111111', '李庚翰', '媒合成功通知信', '您已加入五專106學年暑期實習課程，該課程的實習指導老師為 蕭國倫', '1', 1, 0, NULL, '2017-11-18 23:47:22', '2017-11-18 23:58:12'),
(6, 11, 'admin123', '系辦', '2750963', '工業技術研究院', '媒合成功通知信', '李庚翰已成為工業技術研究院的實習生', '1', 1, 0, NULL, '2017-11-18 23:47:22', '2017-11-18 23:58:09'),
(7, 1, 'admin123', '系辦', '2750963', '工業技術研究院', '學生 李庚翰對您投出履歷', '李庚翰對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '2', 1, 0, NULL, '2017-11-18 23:57:59', '2017-11-18 23:58:11'),
(8, 3, 'admin123', '系辦', 's111111111', '李庚翰', '工業技術研究院邀請您前來面試', '您的履歷已被接受，工業技術研究院邀請您參加面試\\n\n                                        面試資訊如下:\\n\n                                        公司名稱:工業技術研究院\\n\n                                        面試日期:2017-11-21\\n\n                                        面試時間:12:00:00\\n\n                                        面試地點:407台中市西屯區文華路100號\\n\n                                        聯絡人姓名:李銘祥\\n\n                                        聯絡人電話:0987462591\\n\n                                        聯絡人信箱:zxc24630918@gmail.com\\n\n                                        注意事項:不要遲到\\n\n                                        請點選下列按鈕回覆該企業是否接受面試\\n', '2', 1, 0, NULL, '2017-11-18 23:59:07', '2017-11-28 10:45:53'),
(9, 4, 'admin123', '系辦', '2750963', '工業技術研究院', '李庚翰面試意願結果', '李庚翰願意接受面試\\n\n                                        面試資訊如下:\\n\n                                        公司名稱:工業技術研究院\\n\n                                        面試日期:2017-11-21\\n\n                                        面試時間:12:00:00\\n\n                                        面試地點:\\n\n                                        聯絡人姓名:李銘祥\\n\n                                        聯絡人電話:0987462591\\n\n                                        聯絡人信箱:zxc24630918@gmail.com\\n\n                                        注意事項:不要遲到\\n\n                                        面試完畢後請點選下列按鈕回覆該學生是否通過面試\\n', '2', 1, 0, NULL, '2017-11-18 23:59:23', '2017-11-18 23:59:32'),
(10, 7, 'admin123', '系辦', 's111111111', '李庚翰', '工業技術研究院面試結果', '您已通過面試，被工業技術研究院錄取\\n\n                                        請點選下列按鈕回覆該企業是否到職\\n', '2', 1, 0, NULL, '2017-11-18 23:59:51', '2017-11-19 00:00:01'),
(11, 9, 'admin123', '系辦', '2750963', '工業技術研究院', '李庚翰到職意願結果', '李庚翰已接受您的到職邀請\\n', '2', 1, 0, NULL, '2017-11-19 00:00:04', '2017-11-19 00:01:21'),
(12, 11, 'admin123', '系辦', 'teacher456', '蕭國倫', '媒合成功通知信', '您的學生 李庚翰成為您的指導實習生', '2', 1, 0, NULL, '2017-11-19 00:00:37', '2017-11-19 22:51:19'),
(13, 11, 'admin123', '系辦', 's111111111', '李庚翰', '媒合成功通知信', '您已加入五專106學年學期實習課程，該課程的實習指導老師為 蕭國倫', '2', 1, 0, NULL, '2017-11-19 00:00:37', '2017-11-19 00:02:49'),
(14, 11, 'admin123', '系辦', '2750963', '工業技術研究院', '媒合成功通知信', '李庚翰已成為工業技術研究院的實習生', '2', 1, 0, NULL, '2017-11-19 00:00:37', '2017-11-19 00:01:24'),
(15, 1, 'admin123', '系辦', '2750963', '工業技術研究院', '學生 李庚翰對您投出履歷', '李庚翰對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '3', 1, 0, NULL, '2017-11-19 00:01:49', '2017-11-19 00:02:46'),
(16, 3, 'admin123', '系辦', 's111111111', '李庚翰', '工業技術研究院邀請您前來面試', '您的履歷已被接受，工業技術研究院邀請您參加面試\\n\n                                        面試資訊如下:\\n\n                                        公司名稱:工業技術研究院\\n\n                                        面試日期:2017-11-20\\n\n                                        面試時間:12:00:00\\n\n                                        面試地點:407台中市西屯區文華路100號\\n\n                                        聯絡人姓名:李銘祥\\n\n                                        聯絡人電話:0987462591\\n\n                                        聯絡人信箱:zxc24630918@gmail.com\\n\n                                        注意事項:不要遲到\\n\n                                        請點選下列按鈕回覆該企業是否接受面試\\n', '3', 1, 0, NULL, '2017-11-19 00:03:30', '2017-11-28 13:57:33'),
(17, 4, 'admin123', '系辦', '2750963', '工業技術研究院', '李庚翰面試意願結果', '李庚翰願意接受面試\\n\n                                        面試資訊如下:\\n\n                                        公司名稱:工業技術研究院\\n\n                                        面試日期:2017-11-20\\n\n                                        面試時間:12:00:00\\n\n                                        面試地點:\\n\n                                        聯絡人姓名:李銘祥\\n\n                                        聯絡人電話:0987462591\\n\n                                        聯絡人信箱:zxc24630918@gmail.com\\n\n                                        注意事項:不要遲到\\n\n                                        面試完畢後請點選下列按鈕回覆該學生是否通過面試\\n', '3', 1, 0, NULL, '2017-11-19 00:03:54', '2017-11-19 00:20:37'),
(18, 8, 'admin123', '系辦', 's111111111', '李庚翰', '工業技術研究院面試結果', '您未通過面試，未被工業技術研究院錄取\\n\n                                        工業技術研究院聯絡資訊如下:\\n\n                                        姓名:李庚翰\\n\n                                        電話:22112022\\n\n                                        E-mail:mail@gmail.com\\n\n                                        住址:新竹縣竹東鎮頭重里中興路4段195號\\n', '3', 1, 0, NULL, '2017-11-19 00:04:10', '2017-11-28 13:56:56'),
(19, 13, 'admin123', '系辦', '2750963', '工業技術研究院', '李庚翰 完成週誌填寫', '李庚翰已填寫完週誌，請至學生管理頁面查看', '1', 0, 0, NULL, '2017-11-19 00:14:41', '2017-11-19 00:14:41'),
(20, 13, 'admin123', '系辦', 'teacher456', '蕭國倫', '李庚翰 完成週誌填寫', '李庚翰已填寫完週誌，請至學生管理頁面查看', '1', 1, 0, NULL, '2017-11-19 00:14:41', '2017-11-19 22:51:08'),
(21, 13, 'admin123', '系辦', '2750963', '工業技術研究院', '李庚翰 完成週誌填寫', '李庚翰已填寫完週誌，請至學生管理頁面查看', '1', 1, 0, NULL, '2017-11-19 00:15:11', '2017-11-19 00:20:27'),
(22, 13, 'admin123', '系辦', 'teacher456', '蕭國倫', '李庚翰 完成週誌填寫', '李庚翰已填寫完週誌，請至學生管理頁面查看', '1', 1, 0, NULL, '2017-11-19 00:15:11', '2017-11-19 22:51:03'),
(23, 1, 'admin123', '系辦', '2750963', '工業技術研究院', '學生 賴潔瑩對您投出履歷', '賴潔瑩對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '4', 1, 0, NULL, '2017-11-19 00:16:31', '2017-11-19 00:48:01'),
(24, 3, 'admin123', '系辦', 'jamie870116', '賴潔瑩', '工業技術研究院邀請您前來面試', '您的履歷已被接受，工業技術研究院邀請您參加面試\\n\n                                        面試資訊如下:\\n\n                                        公司名稱:工業技術研究院\\n\n                                        面試日期:2017-11-20\\n\n                                        面試時間:12:00:00\\n\n                                        面試地點:407台中市西屯區文華路100號\\n\n                                        聯絡人姓名:李銘祥\\n\n                                        聯絡人電話:0987462591\\n\n                                        聯絡人信箱:zxc24630918@gmail.com\\n\n                                        注意事項:不要遲到\\n\n                                        請點選下列按鈕回覆該企業是否接受面試\\n', '4', 1, 0, NULL, '2017-11-19 00:21:09', '2017-11-19 00:21:17'),
(25, 4, 'admin123', '系辦', '2750963', '工業技術研究院', '賴潔瑩面試意願結果', '賴潔瑩願意接受面試\\n\n                                        面試資訊如下:\\n\n                                        公司名稱:工業技術研究院\\n\n                                        面試日期:2017-11-20\\n\n                                        面試時間:12:00:00\\n\n                                        面試地點:407台中市西屯區文華路100號\\n\n                                        聯絡人姓名:李銘祥\\n\n                                        聯絡人電話:0987462591\\n\n                                        聯絡人信箱:zxc24630918@gmail.com\\n\n                                        注意事項:不要遲到\\n\n                                        面試完畢後請點選下列按鈕回覆該學生是否通過面試\\n', '4', 1, 0, NULL, '2017-11-19 00:23:06', '2017-11-19 04:52:54'),
(26, 7, 'admin123', '系辦', 'jamie870116', '賴潔瑩', '工業技術研究院面試結果', '您已通過面試，被工業技術研究院錄取\\n\n                                        請點選下列按鈕回覆該企業是否到職\\n', '4', 1, 0, NULL, '2017-11-19 00:23:52', '2017-11-19 00:24:01'),
(27, 9, 'admin123', '系辦', '2750963', '工業技術研究院', '賴潔瑩到職意願結果', '賴潔瑩已接受您的到職邀請\\n', '4', 1, 0, NULL, '2017-11-19 00:24:05', '2017-11-19 05:06:28'),
(28, 1, 'admin123', '系辦', '43162200', '宏碁雲端技術服務股份有限公司', '學生 吳玟憲對您投出履歷', '吳玟憲對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '5', 1, 0, NULL, '2017-11-19 06:02:30', '2017-11-19 06:02:41'),
(29, 6, 'admin123', '系辦', 's1410331025', '吳玟憲', '宏碁雲端技術服務股份有限公司履歷投遞結果', '您已被宏碁雲端技術服務股份有限公司直接錄取\\n\n                                            請點選下列按鈕回覆該企業是否到職\\n', '5', 1, 0, NULL, '2017-11-19 06:03:41', '2017-11-20 00:33:24'),
(30, 9, 'admin123', '系辦', '43162200', '宏碁雲端技術服務股份有限公司', '吳玟憲到職意願結果', '吳玟憲已接受您的到職邀請\\n', '5', 0, 0, NULL, '2017-11-19 06:04:00', '2017-11-19 06:04:00'),
(31, 1, 'admin123', '系辦', '43162200', '宏碁雲端技術服務股份有限公司', '學生 陳復陞對您投出履歷', '陳復陞對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '6', 1, 0, NULL, '2017-11-19 06:08:53', '2017-11-19 06:09:57'),
(32, 6, 'admin123', '系辦', 's1410331037', '陳復陞', '宏碁雲端技術服務股份有限公司履歷投遞結果', '您已被宏碁雲端技術服務股份有限公司直接錄取\\n\n                                            請點選下列按鈕回覆該企業是否到職\\n', '6', 1, 0, NULL, '2017-11-19 06:12:14', '2017-11-19 06:43:18'),
(33, 9, 'admin123', '系辦', '43162200', '宏碁雲端技術服務股份有限公司', '陳復陞到職意願結果', '陳復陞已接受您的到職邀請\\n', '6', 0, 0, NULL, '2017-11-19 06:12:52', '2017-11-19 06:12:52'),
(34, 1, 'admin123', '系辦', '2750963', '工業技術研究院', '學生 張家銓對您投出履歷', '張家銓對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '7', 0, 0, NULL, '2017-11-19 06:25:51', '2017-11-19 06:25:51'),
(35, 6, 'admin123', '系辦', 's1310534021', '張家銓', '工業技術研究院履歷投遞結果', '您已被工業技術研究院直接錄取\\n\n                                            請點選下列按鈕回覆該企業是否到職\\n', '7', 1, 0, NULL, '2017-11-19 06:29:12', '2017-11-19 06:40:07'),
(36, 9, 'admin123', '系辦', '2750963', '工業技術研究院', '張家銓到職意願結果', '張家銓已接受您的到職邀請\\n', '7', 0, 0, NULL, '2017-11-19 06:29:44', '2017-11-19 06:29:44'),
(37, 1, 'admin123', '系辦', '24584004', '馥華生活股份有限公司', '學生 王宏霖對您投出履歷', '王宏霖對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '8', 1, 0, NULL, '2017-11-19 06:30:11', '2017-11-19 06:30:58'),
(38, 1, 'admin123', '系辦', '2750963', '工業技術研究院', '學生 張哲嘉對您投出履歷', '張哲嘉對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '9', 0, 0, NULL, '2017-11-19 06:30:19', '2017-11-19 06:30:19'),
(39, 6, 'admin123', '系辦', 's1410331020', '王宏霖', '馥華生活股份有限公司履歷投遞結果', '您已被馥華生活股份有限公司直接錄取\\n\n                                            請點選下列按鈕回覆該企業是否到職\\n', '8', 1, 0, NULL, '2017-11-19 06:31:07', '2017-11-19 06:31:19'),
(40, 9, 'admin123', '系辦', '24584004', '馥華生活股份有限公司', '王宏霖到職意願結果', '王宏霖已接受您的到職邀請\\n', '8', 0, 0, NULL, '2017-11-19 06:31:21', '2017-11-19 06:31:21'),
(41, 1, 'admin123', '系辦', '24584004', '馥華生活股份有限公司', '學生 許歆荷對您投出履歷', '許歆荷對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '10', 0, 0, NULL, '2017-11-19 06:32:31', '2017-11-19 06:32:31'),
(42, 6, 'admin123', '系辦', 's1110234006', '許歆荷', '馥華生活股份有限公司履歷投遞結果', '您已被馥華生活股份有限公司直接錄取\\n\n                                            請點選下列按鈕回覆該企業是否到職\\n', '10', 1, 0, '2017-11-27 16:27:35', '2017-11-19 06:33:00', '2017-11-27 16:27:35'),
(43, 9, 'admin123', '系辦', '24584004', '馥華生活股份有限公司', '許歆荷到職意願結果', '許歆荷已接受您的到職邀請\\n', '10', 0, 0, NULL, '2017-11-19 06:33:13', '2017-11-19 06:33:13'),
(44, 6, 'admin123', '系辦', 's1410331034', '張哲嘉', '工業技術研究院履歷投遞結果', '您已被工業技術研究院直接錄取\\n\n                                            請點選下列按鈕回覆該企業是否到職\\n', '9', 1, 0, NULL, '2017-11-19 06:33:32', '2017-11-19 06:35:22'),
(45, 9, 'admin123', '系辦', '2750963', '工業技術研究院', '張哲嘉到職意願結果', '張哲嘉已接受您的到職邀請\\n', '9', 0, 0, NULL, '2017-11-19 06:34:00', '2017-11-19 06:34:00'),
(46, 1, 'admin123', '系辦', '24584004', '馥華生活股份有限公司', '學生 王敬夫對您投出履歷', '王敬夫對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '11', 0, 0, NULL, '2017-11-19 06:34:33', '2017-11-19 06:34:33'),
(47, 6, 'admin123', '系辦', 's1110234014', '王敬夫', '馥華生活股份有限公司履歷投遞結果', '您已被馥華生活股份有限公司直接錄取\\n\n                                            請點選下列按鈕回覆該企業是否到職\\n', '11', 1, 0, NULL, '2017-11-19 06:35:12', '2017-11-19 06:36:22'),
(48, 9, 'admin123', '系辦', '24584004', '馥華生活股份有限公司', '王敬夫到職意願結果', '王敬夫已接受您的到職邀請\\n', '11', 0, 0, NULL, '2017-11-19 06:36:24', '2017-11-19 06:36:24'),
(49, 1, 'admin123', '系辦', '54239825', '遠景科技', '學生 施怡如對您投出履歷', '施怡如對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '12', 0, 0, NULL, '2017-11-19 06:36:32', '2017-11-19 06:36:32'),
(50, 6, 'admin123', '系辦', 's1310531009', '施怡如', '遠景科技履歷投遞結果', '您已被遠景科技直接錄取\\n\n                                            請點選下列按鈕回覆該企業是否到職\\n', '12', 1, 0, NULL, '2017-11-19 06:37:05', '2017-11-19 06:38:24'),
(51, 9, 'admin123', '系辦', '54239825', '遠景科技', '施怡如到職意願結果', '施怡如已接受您的到職邀請\\n', '12', 0, 0, NULL, '2017-11-19 06:37:37', '2017-11-19 06:37:37'),
(52, 1, 'admin123', '系辦', '24584004', '馥華生活股份有限公司', '學生 林姿伸對您投出履歷', '林姿伸對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '13', 0, 0, NULL, '2017-11-19 06:37:56', '2017-11-19 06:37:56'),
(53, 1, 'admin123', '系辦', '54239825', '遠景科技', '學生 張家銓對您投出履歷', '張家銓對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '14', 0, 0, NULL, '2017-11-19 06:38:54', '2017-11-19 06:38:54'),
(54, 6, 'admin123', '系辦', 's1310531005', '林姿伸', '馥華生活股份有限公司履歷投遞結果', '您已被馥華生活股份有限公司直接錄取\\n\n                                            請點選下列按鈕回覆該企業是否到職\\n', '13', 1, 0, NULL, '2017-11-19 06:39:36', '2017-11-19 06:40:17'),
(55, 9, 'admin123', '系辦', '24584004', '馥華生活股份有限公司', '林姿伸到職意願結果', '林姿伸已接受您的到職邀請\\n', '13', 0, 0, NULL, '2017-11-19 06:40:19', '2017-11-19 06:40:19'),
(56, 6, 'admin123', '系辦', 's1310534021', '張家銓', '遠景科技履歷投遞結果', '您已被遠景科技直接錄取\\n\n                                            請點選下列按鈕回覆該企業是否到職\\n', '14', 0, 0, NULL, '2017-11-19 06:40:22', '2017-11-19 06:40:22'),
(57, 1, 'admin123', '系辦', '54239825', '遠景科技', '學生 林惠新對您投出履歷', '林惠新對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '15', 0, 0, NULL, '2017-11-19 06:41:22', '2017-11-19 06:41:22'),
(58, 1, 'admin123', '系辦', '80231876', '博科資訊', '學生 黃立翔對您投出履歷', '黃立翔對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '16', 0, 0, NULL, '2017-11-19 06:41:40', '2017-11-19 06:41:40'),
(59, 6, 'admin123', '系辦', 's1310534004', '林惠新', '遠景科技履歷投遞結果', '您已被遠景科技直接錄取\\n\n                                            請點選下列按鈕回覆該企業是否到職\\n', '15', 1, 0, NULL, '2017-11-19 06:41:43', '2017-11-19 06:41:58'),
(60, 9, 'admin123', '系辦', '54239825', '遠景科技', '林惠新到職意願結果', '林惠新已接受您的到職邀請\\n', '15', 0, 0, NULL, '2017-11-19 06:41:59', '2017-11-19 06:41:59'),
(61, 6, 'admin123', '系辦', 's1310534025', '黃立翔', '博科資訊履歷投遞結果', '您已被博科資訊直接錄取\\n\n                                            請點選下列按鈕回覆該企業是否到職\\n', '16', 1, 0, NULL, '2017-11-19 06:42:21', '2017-11-19 06:43:37'),
(62, 1, 'admin123', '系辦', '54239825', '遠景科技', '學生 陳復陞對您投出履歷', '陳復陞對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '17', 0, 0, NULL, '2017-11-19 06:42:31', '2017-11-19 06:42:31'),
(63, 9, 'admin123', '系辦', '80231876', '博科資訊', '黃立翔到職意願結果', '黃立翔已接受您的到職邀請\\n', '16', 1, 0, NULL, '2017-11-19 06:42:50', '2017-11-19 09:58:10'),
(64, 6, 'admin123', '系辦', 's1410331037', '陳復陞', '遠景科技履歷投遞結果', '您已被遠景科技直接錄取\\n\n                                            請點選下列按鈕回覆該企業是否到職\\n', '17', 1, 0, NULL, '2017-11-19 06:42:51', '2017-11-19 06:43:25'),
(65, 9, 'admin123', '系辦', '54239825', '遠景科技', '陳復陞到職意願結果', '陳復陞已接受您的到職邀請\\n', '17', 0, 0, NULL, '2017-11-19 06:43:28', '2017-11-19 06:43:28'),
(66, 0, 's111111111', '李庚翰', '99513636', '長安工程行', '你好', '你好', NULL, 0, 0, NULL, '2017-11-19 22:24:11', '2017-11-19 22:24:11'),
(67, 1, 'admin123', '系辦', '43162200', '宏碁雲端技術服務股份有限公司', '學生 蔡旻袁對您投出履歷', '蔡旻袁對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '18', 0, 0, NULL, '2017-11-20 03:03:58', '2017-11-20 03:03:58'),
(68, 1, 'admin123', '系辦', '2750963', '工業技術研究院', '學生 蔡旻袁對您投出履歷', '蔡旻袁對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '19', 0, 0, NULL, '2017-11-20 03:04:16', '2017-11-20 03:04:16'),
(69, 1, 'admin123', '系辦', '24584004', '馥華生活股份有限公司', '學生 蔡旻袁對您投出履歷', '蔡旻袁對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '20', 1, 0, NULL, '2017-11-20 03:04:47', '2017-11-23 14:59:52'),
(70, 1, 'admin123', '系辦', '2750963', '工業技術研究院', '學生 吳玟憲對您投出履歷', '吳玟憲對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '21', 0, 0, NULL, '2017-11-20 05:17:52', '2017-11-20 05:17:52'),
(71, 11, 'admin123', '系辦', 'teacher456', '蕭國倫', '媒合成功通知信', '您的學生 李庚翰成為您的指導實習生', '3', 1, 0, NULL, '2017-11-20 07:50:41', '2017-11-23 02:26:12'),
(72, 11, 'admin123', '系辦', 's111111111', '李庚翰', '媒合成功通知信', '您已加入五專106學年暑期實習課程，該課程的實習指導老師為 蕭國倫', '3', 1, 0, NULL, '2017-11-20 07:50:41', '2017-11-28 10:47:09'),
(73, 11, 'admin123', '系辦', '2750963', '工業技術研究院', '媒合成功通知信', '李庚翰已成為工業技術研究院的實習生', '3', 0, 0, NULL, '2017-11-20 07:50:41', '2017-11-20 07:50:41'),
(74, 13, 'admin123', '系辦', '2750963', '工業技術研究院', '李庚翰 完成週誌填寫', '李庚翰已填寫完週誌，請至學生管理頁面查看', '1,2', 0, 0, NULL, '2017-11-21 21:08:35', '2017-11-21 21:08:35'),
(75, 13, 'admin123', '系辦', 'teacher456', '蕭國倫', '李庚翰 完成週誌填寫', '李庚翰已填寫完週誌，請至學生管理頁面查看', '1,2', 0, 0, NULL, '2017-11-21 21:08:35', '2017-11-21 21:08:35'),
(76, 13, 'admin123', '系辦', '2750963', '工業技術研究院', '李庚翰 完成週誌填寫', '李庚翰已填寫完週誌，請至學生管理頁面查看', '1,2', 0, 0, NULL, '2017-11-21 21:15:23', '2017-11-21 21:15:23'),
(77, 13, 'admin123', '系辦', 'teacher456', '蕭國倫', '李庚翰 完成週誌填寫', '李庚翰已填寫完週誌，請至學生管理頁面查看', '1,2', 0, 0, NULL, '2017-11-21 21:15:23', '2017-11-21 21:15:23'),
(78, 13, 'admin123', '系辦', '2750963', '工業技術研究院', '李庚翰 完成週誌填寫', '李庚翰已填寫完週誌，請至學生管理頁面查看', '1,2', 0, 0, NULL, '2017-11-21 21:17:17', '2017-11-21 21:17:17'),
(79, 13, 'admin123', '系辦', 'teacher456', '蕭國倫', '李庚翰 完成週誌填寫', '李庚翰已填寫完週誌，請至學生管理頁面查看', '1,2', 0, 0, NULL, '2017-11-21 21:17:17', '2017-11-21 21:17:17'),
(80, 13, 'admin123', '系辦', '2750963', '工業技術研究院', '李庚翰 完成週誌填寫', '李庚翰已填寫完週誌，請至學生管理頁面查看', '1,2', 1, 0, NULL, '2017-11-21 21:18:12', '2017-11-27 14:52:46'),
(81, 13, 'admin123', '系辦', 'teacher456', '蕭國倫', '李庚翰 完成週誌填寫', '李庚翰已填寫完週誌，請至學生管理頁面查看', '1,2', 0, 0, NULL, '2017-11-21 21:18:12', '2017-11-21 21:18:12'),
(82, 13, 'admin123', '系辦', '2750963', '工業技術研究院', '李庚翰 完成週誌填寫', '李庚翰已填寫完週誌，請至學生管理頁面查看', '1,2', 1, 0, NULL, '2017-11-21 21:22:24', '2017-11-27 14:52:42'),
(83, 13, 'admin123', '系辦', 'teacher456', '蕭國倫', '李庚翰 完成週誌填寫', '李庚翰已填寫完週誌，請至學生管理頁面查看', '1,2', 1, 0, NULL, '2017-11-21 21:22:24', '2017-11-23 02:26:07'),
(84, 6, 'admin123', '系辦', 'tsaihau1998', '蔡旻袁', '宏碁雲端技術服務股份有限公司履歷投遞結果', '您已被宏碁雲端技術服務股份有限公司直接錄取\\n\n                                            請點選下列按鈕回覆該企業是否到職\\n', '18', 1, 0, NULL, '2017-11-22 02:44:12', '2017-11-22 02:45:53'),
(85, 9, 'admin123', '系辦', '43162200', '宏碁雲端技術服務股份有限公司', '蔡旻袁到職意願結果', '蔡旻袁已接受您的到職邀請\\n', '18', 0, 0, NULL, '2017-11-22 02:46:02', '2017-11-22 02:46:02'),
(86, 11, 'admin123', '系辦', 'teacher456', '蕭國倫', '媒合成功通知信', '您的學生 蔡旻袁成為您的指導實習生', '4', 1, 0, NULL, '2017-11-22 02:50:00', '2017-11-22 06:42:09'),
(87, 11, 'admin123', '系辦', 'tsaihau1998', '蔡旻袁', '媒合成功通知信', '您已加入五專106學年學期實習課程，該課程的實習指導老師為 蕭國倫', '4', 1, 0, NULL, '2017-11-22 02:50:00', '2017-11-22 02:50:28'),
(88, 11, 'admin123', '系辦', '43162200', '宏碁雲端技術服務股份有限公司', '媒合成功通知信', '蔡旻袁已成為宏碁雲端技術服務股份有限公司的實習生', '4', 0, 0, NULL, '2017-11-22 02:50:00', '2017-11-22 02:50:00'),
(89, 13, 'admin123', '系辦', '43162200', '宏碁雲端技術服務股份有限公司', '蔡旻袁 完成週誌填寫', '蔡旻袁已填寫完週誌，請至學生管理頁面查看', '4', 1, 0, NULL, '2017-11-22 06:40:13', '2017-11-28 13:48:57'),
(90, 13, 'admin123', '系辦', 'teacher456', '蕭國倫', '蔡旻袁 完成週誌填寫', '蔡旻袁已填寫完週誌，請至學生管理頁面查看', '4', 1, 0, NULL, '2017-11-22 06:40:13', '2017-11-22 06:42:19'),
(91, 13, 'admin123', '系辦', '2750963', '工業技術研究院', '李庚翰 完成週誌填寫', '李庚翰已填寫完週誌，請至學生管理頁面查看', '2', 1, 0, NULL, '2017-11-22 07:21:44', '2017-11-27 14:47:47'),
(92, 13, 'admin123', '系辦', 'teacher456', '蕭國倫', '李庚翰 完成週誌填寫', '李庚翰已填寫完週誌，請至學生管理頁面查看', '2', 1, 0, NULL, '2017-11-22 07:21:44', '2017-11-22 17:23:38'),
(93, 1, 'admin123', '系辦', '52875138', '國興資訊', '學生 賴潔瑩對您投出履歷', '賴潔瑩對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '22', 1, 0, NULL, '2017-11-22 07:39:00', '2017-11-22 07:39:24'),
(94, 3, 'admin123', '系辦', 'jamie870116', '賴潔瑩', '國興資訊邀請您前來面試', '您的履歷已被接受，國興資訊邀請您參加面試\\n\n                                        面試資訊如下:\\n\n                                        公司名稱:國興資訊\\n\n                                        面試日期:2017-11-30\\n\n                                        面試時間:12:00:00\\n\n                                        面試地點:台中市三民路三段129號\\n\n                                        聯絡人姓名:何明彥\\n\n                                        聯絡人電話:0922333655\\n\n                                        聯絡人信箱:mail4564585@gmail.com\\n\n                                        注意事項:別遲到了\\n\n                                        請點選下列按鈕回覆該企業是否接受面試\\n', '22', 1, 0, NULL, '2017-11-22 07:40:20', '2017-11-22 07:40:33'),
(95, 4, 'admin123', '系辦', '52875138', '國興資訊', '賴潔瑩面試意願結果', '賴潔瑩願意接受面試\\n\n                                        面試資訊如下:\\n\n                                        公司名稱:國興資訊\\n\n                                        面試日期:2017-11-30\\n\n                                        面試時間:12:00:00\\n\n                                        面試地點:台中市三民路三段129號\\n\n                                        聯絡人姓名:何明彥\\n\n                                        聯絡人電話:0922333655\\n\n                                        聯絡人信箱:mail4564585@gmail.com\\n\n                                        注意事項:別遲到了\\n\n                                        面試完畢後請點選下列按鈕回覆該學生是否通過面試\\n', '22', 1, 0, NULL, '2017-11-22 07:40:37', '2017-11-22 07:40:48'),
(96, 8, 'admin123', '系辦', 'jamie870116', '賴潔瑩', '國興資訊面試結果', '您未通過面試，未被國興資訊錄取\\n\n                                        國興資訊聯絡資訊如下:\\n\n                                        姓名:賴潔瑩\\n\n                                        電話:22112022\\n\n                                        E-mail:mail4@gmail.com\\n\n                                        住址:台中市西區梅川西路一段23號\\n', '22', 1, 0, NULL, '2017-11-22 07:40:51', '2017-11-22 07:44:22'),
(97, 1, 'admin123', '系辦', '24584004', '馥華生活股份有限公司', '學生 鄭秉松對您投出履歷', '鄭秉松對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '23', 1, 0, NULL, '2017-11-22 16:00:00', '2017-11-22 16:00:32'),
(98, 6, 'admin123', '系辦', 's1110234021', '鄭秉松', '馥華生活股份有限公司履歷投遞結果', '您已被馥華生活股份有限公司直接錄取\\n\n                                            請點選下列按鈕回覆該企業是否到職\\n', '23', 1, 0, NULL, '2017-11-22 16:00:47', '2017-11-22 16:09:05'),
(99, 9, 'admin123', '系辦', '24584004', '馥華生活股份有限公司', '鄭秉松到職意願結果', '鄭秉松已接受您的到職邀請\\n', '23', 1, 0, NULL, '2017-11-22 16:02:37', '2017-11-23 14:59:50'),
(100, 1, 'admin123', '系辦', '24584004', '馥華生活股份有限公司', '學生 鄭秉松對您投出履歷', '鄭秉松對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '24', 1, 0, NULL, '2017-11-22 16:10:03', '2017-11-22 16:10:12'),
(101, 6, 'admin123', '系辦', 's1110234021', '鄭秉松', '馥華生活股份有限公司履歷投遞結果', '您已被馥華生活股份有限公司直接錄取\\n\n                                            請點選下列按鈕回覆該企業是否到職\\n', '24', 1, 0, NULL, '2017-11-22 16:10:20', '2017-11-22 16:10:29'),
(102, 9, 'admin123', '系辦', '24584004', '馥華生活股份有限公司', '鄭秉松到職意願結果', '鄭秉松已接受您的到職邀請\\n', '24', 1, 0, NULL, '2017-11-22 16:10:31', '2017-11-22 16:10:39'),
(103, 11, 'admin123', '系辦', 'teacher456', '蕭國倫', '媒合成功通知信', '您的學生 鄭秉松成為您的指導實習生', '5', 1, 0, NULL, '2017-11-22 16:15:02', '2017-11-22 17:23:26'),
(104, 11, 'admin123', '系辦', 's1110234021', '鄭秉松', '媒合成功通知信', '您已加入五專106學年學期實習課程，該課程的實習指導老師為 蕭國倫', '5', 1, 0, NULL, '2017-11-22 16:15:02', '2017-11-22 16:15:29'),
(105, 11, 'admin123', '系辦', '24584004', '馥華生活股份有限公司', '媒合成功通知信', '鄭秉松已成為馥華生活股份有限公司的實習生', '5', 1, 0, NULL, '2017-11-22 16:15:02', '2017-11-23 14:59:43'),
(106, 13, 'admin123', '系辦', '43162200', '宏碁雲端技術服務股份有限公司', '蔡旻袁 完成週誌填寫', '蔡旻袁已填寫完週誌，請至學生管理頁面查看', '4', 0, 0, '2017-11-28 13:51:43', '2017-11-22 17:24:42', '2017-11-28 13:51:43'),
(107, 13, 'admin123', '系辦', 'teacher456', '蕭國倫', '蔡旻袁 完成週誌填寫', '蔡旻袁已填寫完週誌，請至學生管理頁面查看', '4', 1, 0, NULL, '2017-11-22 17:24:43', '2017-11-22 17:24:53'),
(108, 13, 'admin123', '系辦', '43162200', '宏碁雲端技術服務股份有限公司', '蔡旻袁 完成週誌填寫', '蔡旻袁已填寫完週誌，請至學生管理頁面查看', '4', 0, 0, '2017-11-28 13:51:42', '2017-11-23 01:55:04', '2017-11-28 13:51:42'),
(109, 13, 'admin123', '系辦', 'teacher456', '蕭國倫', '蔡旻袁 完成週誌填寫', '蔡旻袁已填寫完週誌，請至學生管理頁面查看', '4', 1, 0, NULL, '2017-11-23 01:55:04', '2017-11-27 07:18:44'),
(110, 13, 'admin123', '系辦', '43162200', '宏碁雲端技術服務股份有限公司', '蔡旻袁 完成週誌填寫', '蔡旻袁已填寫完週誌，請至學生管理頁面查看', '4', 0, 0, '2017-11-28 13:51:42', '2017-11-23 01:55:45', '2017-11-28 13:51:42'),
(111, 13, 'admin123', '系辦', 'teacher456', '蕭國倫', '蔡旻袁 完成週誌填寫', '蔡旻袁已填寫完週誌，請至學生管理頁面查看', '4', 0, 0, NULL, '2017-11-23 01:55:45', '2017-11-23 01:55:45'),
(112, 13, 'admin123', '系辦', '43162200', '宏碁雲端技術服務股份有限公司', '蔡旻袁 完成週誌填寫', '蔡旻袁已填寫完週誌，請至學生管理頁面查看', '4', 1, 0, '2017-11-28 13:51:42', '2017-11-23 01:56:14', '2017-11-28 13:51:48'),
(113, 13, 'admin123', '系辦', 'teacher456', '蕭國倫', '蔡旻袁 完成週誌填寫', '蔡旻袁已填寫完週誌，請至學生管理頁面查看', '4', 0, 0, NULL, '2017-11-23 01:56:14', '2017-11-23 01:56:14'),
(114, 13, 'admin123', '系辦', '43162200', '宏碁雲端技術服務股份有限公司', '蔡旻袁 完成週誌填寫', '蔡旻袁已填寫完週誌，請至學生管理頁面查看', '4', 0, 1, NULL, '2017-11-23 01:56:44', '2017-11-28 13:50:46'),
(115, 13, 'admin123', '系辦', 'teacher456', '蕭國倫', '蔡旻袁 完成週誌填寫', '蔡旻袁已填寫完週誌，請至學生管理頁面查看', '4', 1, 0, NULL, '2017-11-23 01:56:44', '2017-11-27 07:18:42'),
(116, 13, 'admin123', '系辦', '43162200', '宏碁雲端技術服務股份有限公司', '蔡旻袁 完成週誌填寫', '蔡旻袁已填寫完週誌，請至學生管理頁面查看', '4', 0, 1, NULL, '2017-11-23 01:57:28', '2017-11-28 13:50:45'),
(117, 13, 'admin123', '系辦', 'teacher456', '蕭國倫', '蔡旻袁 完成週誌填寫', '蔡旻袁已填寫完週誌，請至學生管理頁面查看', '4', 1, 0, '2017-11-29 08:21:37', '2017-11-23 01:57:28', '2017-11-29 08:21:37'),
(118, 13, 'admin123', '系辦', '43162200', '宏碁雲端技術服務股份有限公司', '蔡旻袁 完成週誌填寫', '蔡旻袁已填寫完週誌，請至學生管理頁面查看', '4', 1, 1, NULL, '2017-11-23 01:57:58', '2017-11-28 15:43:17'),
(119, 13, 'admin123', '系辦', 'teacher456', '蕭國倫', '蔡旻袁 完成週誌填寫', '蔡旻袁已填寫完週誌，請至學生管理頁面查看', '4', 1, 1, '2017-11-29 08:21:37', '2017-11-23 01:57:58', '2017-11-29 08:21:37'),
(120, 1, 'admin123', '系辦', '99513636', '台中科技大學', '學生 李庚翰對您投出履歷', '李庚翰對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '25', 0, 0, NULL, '2017-11-24 10:11:54', '2017-11-24 10:11:54'),
(121, 1, 'admin123', '系辦', '99513636', '台中科技大學', '學生 李庚翰對您投出履歷', '李庚翰對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '26', 0, 0, NULL, '2017-11-27 07:02:00', '2017-11-27 07:02:00'),
(122, 0, 's111111111', '李庚翰', '2750963', '工業技術研究院', '請問test1', '請問test1', NULL, 0, 0, NULL, '2017-11-27 16:05:46', '2017-11-27 16:05:46'),
(123, 0, 's111111111', '李庚翰', '2750963', '工業技術研究院', '請問test2', '請問test2', NULL, 0, 0, NULL, '2017-11-27 16:06:08', '2017-11-27 16:06:08'),
(124, 0, 's111111111', '李庚翰', '2750963', '工業技術研究院', '請問test3', '請問test3', NULL, 0, 0, NULL, '2017-11-27 16:09:24', '2017-11-27 16:09:24'),
(125, 0, 's111111111', '李庚翰', '2750963', '工業技術研究院', 'test4', 'test4', NULL, 0, 0, NULL, '2017-11-27 16:10:43', '2017-11-27 16:10:43'),
(126, 0, 's111111111', '李庚翰', '2750963', '工業技術研究院', 'test5', 'test5', NULL, 0, 0, NULL, '2017-11-27 16:10:49', '2017-11-27 16:10:49'),
(127, 0, 's111111111', '李庚翰', '2750963', '工業技術研究院', 'test6', 'test6', NULL, 0, 0, NULL, '2017-11-27 16:10:55', '2017-11-27 16:10:55'),
(128, 0, 's111111111', '李庚翰', '2750963', '工業技術研究院', 'test7', 'test7', NULL, 0, 0, NULL, '2017-11-27 16:11:00', '2017-11-27 16:11:00'),
(129, 0, 's111111111', '李庚翰', '2750963', '工業技術研究院', 'test8', 'test8', NULL, 1, 0, NULL, '2017-11-27 16:11:05', '2017-11-27 16:18:10'),
(130, 0, '2750963', '工業技術研究院', 's111111111', '李庚翰', 'RE:[test8] #1', '安安以回復', NULL, 1, 0, NULL, '2017-11-27 16:18:28', '2017-11-28 10:45:21'),
(131, 0, 's1110234006', '許歆荷', '2750963', '工業技術研究院', '您好', '您好，請問還有職缺嗎?', NULL, 1, 0, NULL, '2017-11-27 16:26:09', '2017-11-27 16:26:45'),
(132, 0, '2750963', '工業技術研究院', 's1110234006', '許歆荷', 'RE:[您好] #1', '有的', NULL, 0, 0, '2017-11-27 16:27:34', '2017-11-27 16:26:42', '2017-11-27 16:27:34'),
(133, 0, '2750963', '工業技術研究院', 's1110234006', '許歆荷', 'RE:[您好] #1', '有的2', NULL, 1, 0, '2017-11-27 16:27:33', '2017-11-27 16:26:54', '2017-11-27 16:27:33'),
(134, 1, 'admin123', '系辦', '43162200', '宏碁雲端技術服務股份有限公司', '學生 李庚翰對您投出履歷', '李庚翰對您投出履歷，請至職缺管理的學生投遞紀錄頁面查看', '27', 1, 0, '2017-11-28 13:51:16', '2017-11-28 13:23:09', '2017-11-28 13:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `stu_ability`
--

CREATE TABLE `stu_ability` (
  `abiid` int(10) UNSIGNED NOT NULL,
  `sid` int(11) NOT NULL,
  `abiType` tinyint(4) NOT NULL DEFAULT '0',
  `abiName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stu_ability`
--

INSERT INTO `stu_ability` (`abiid`, `sid`, `abiType`, `abiName`) VALUES
(6, 29, 4, 'laravel'),
(9, 30, 3, 'sql'),
(10, 30, 4, 'asp'),
(11, 30, 4, 'php'),
(12, 30, 5, 'js'),
(13, 30, 5, 'html+css'),
(14, 30, 6, 'flash'),
(15, 30, 7, 'word'),
(16, 14, 3, 'MS SQL'),
(17, 14, 5, 'HTML，CSS'),
(18, 3, 2, 'sql'),
(19, 13, 6, '3Dmax'),
(20, 13, 4, 'asp.net ，java'),
(21, 12, 2, 'Linux'),
(22, 12, 5, 'jQuery,JS,HTML'),
(23, 16, 4, 'asp.net'),
(24, 26, 2, '自架 Azure VM Ubuntu'),
(25, 26, 3, '熟關聯式資料庫'),
(26, 26, 4, '熟 ASP.NET Web API\n略懂 Laravel'),
(27, 26, 5, '熟 Android\n普通 iOS'),
(28, 31, 5, 'HTML5,CSS'),
(29, 33, 4, 'PHPlaravel');

-- --------------------------------------------------------

--
-- Table structure for table `stu_basic`
--

CREATE TABLE `stu_basic` (
  `sid` int(11) NOT NULL,
  `chiName` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `engName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bornedPlace` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` tinyint(4) DEFAULT '0',
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eTypes` tinyint(4) DEFAULT '0',
  `ES` tinyint(4) DEFAULT '0',
  `ER` tinyint(4) DEFAULT '0',
  `EW` tinyint(4) DEFAULT '0',
  `TOEIC` int(11) DEFAULT '0',
  `TOEFL` int(11) DEFAULT '0',
  `Oname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `OS` tinyint(4) DEFAULT '0',
  `OR` tinyint(4) DEFAULT '0',
  `OW` tinyint(4) DEFAULT '0',
  `graduateYear` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `graduatedSchool` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `autobiography` longtext COLLATE utf8mb4_unicode_ci,
  `profilePic` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `licenceFile` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '/licences/example.docx'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stu_basic`
--

INSERT INTO `stu_basic` (`sid`, `chiName`, `engName`, `bornedPlace`, `birthday`, `gender`, `address`, `email`, `contact`, `eTypes`, `ES`, `ER`, `EW`, `TOEIC`, `TOEFL`, `Oname`, `OS`, `OR`, `OW`, `graduateYear`, `graduatedSchool`, `department`, `section`, `autobiography`, `profilePic`, `licenceFile`) VALUES
(1, '吳玟憲', 'wu', '台中', '2017-01-01', 0, '台中', 's1410331025@nutc.edu.tw', '0922222222', 0, 1, 1, 1, 0, 0, '日文', 3, 3, 3, '106', '國立台中科技大學', '資管系', '資管科', '安安test', '1511099973tbK0a_pro.png', NULL),
(2, '張若翔', NULL, NULL, NULL, NULL, NULL, 's1410331033@nutc.edu.tw', NULL, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '陳復陞', 'cheng', '台中', '1997-12-30', 0, '台中', 's1410331037@nutc.edu.tw', '09222222564', 0, 3, 3, 3, 0, 0, NULL, 0, 0, 0, '106', '國立台中科技大學', '資管系', '資管科', '安安~test', '1511100319Bf7bD_pro.jpg', NULL),
(4, '林俊豪', NULL, NULL, NULL, NULL, NULL, 's1110234016@nutc.edu.tw', NULL, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '黃立翔', 'huang', '台中', '1998-03-03', 0, '台中', 's1310534025@nutc.edu.tw', '0933113164', 1, 2, 2, 1, 0, 0, NULL, 0, 0, 0, '106', '國立台中科技大學', '資管系', '資管科', 'test', '1511100819NWsbo_pro.jpg', NULL),
(6, '林惠新', 'lin', '高雄', '1998-01-01', 1, '高雄', 's1310534004@nutc.edu.tw', '09221121654', 1, 3, 2, 3, 0, 0, NULL, 0, 0, 0, '106', '國立台中科技大學', '資管系', '資管科', 'test', '1511101279OnYv1_pro.jpg', NULL),
(7, '張家銓', 'chung', '台中', '1997-11-30', 0, '台中', 's1310534021@nutc.edu.tw', '023456789', 1, 2, 2, 3, 0, 0, NULL, 0, 0, 0, '107', '國立台中科技大學', '資管系', '資管科', 'test', '1511101386WcjSk_pro.jpg', NULL),
(8, '林姿伸', 'lin', '新竹市', '1992-10-29', 1, '新竹市三民路', 's1310531005@nutc.edu.tw', '0956332599', 3, 1, 2, 1, 0, 0, NULL, 0, 0, 0, '2013', 'NUTC', '資訊管理系', NULL, '我的成長－我的家庭\r\n桃園縣八德市─一個民風純樸，充滿人情味的地方，那裡就是我的故鄉。民國七十年○○月○○日，我在桃園出生，我家人口簡單，家父在中科院上班，是個公職人員，家母在詠航公司上班。家裡的小孩只有我和弟弟，弟弟今年國中三年級，和我相差三歲，在父親恩威並施的教導下，我和弟弟都受有良好的教育，家裡充滿和諧的氣氛。\r\n求學過程\r\n父親從小就很注重我們的教育，在我國小三年級時，就讓我到兒童美語班學習英文，為我將來在英文上的學習打下基礎。升上國中，曾擔任一學期的班長，因為如此，所以學到滿多的課外知識，也具備領導者的能力。國中時期，因為念的是Ａ段班所以課業較為繁重，英文則是我引以為傲的科目。曾在一次的校內英文競試中，拿到全校第二名。由於我對英文的熱衷，加上對商科的興趣，所以立志要考中壢高商的國貿科。民國八十六年國中畢業，在父母親的支持下與鼓勵下，終於進入了我心中最理想的學校─中壢高商就讀，也達成願望念了自己所喜愛的國貿科。經過三年老師用心的教導及個人的努力，我的英文不斷的進步。高二校內抽考英文，很榮幸的拿到全年級第一名，那時很開心，讓我對英文越來越有信心。念國貿科，也讓我學到很多貿易上的程序，對經濟方面也較深入的了解，但我認為最重要的還是得先將語文學好，所以我選擇報考「真理大學─外國語文系」，希望在大學四年中，好好的學習外文。\r\n形容自己\r\n朋友都說我是一個不太容易生氣的人，我想我只是覺得在許多時候，其實只要敞開心胸，將事情講開來就會沒事了，如果能冷靜的思考每一件事，也就不會和別人吵架。兩個都在氣頭上的人，說出的話總是容易傷害到別人，我也覺得凡事不要太計較，有一句話說「吃虧就是佔便宜」，做的比別人多，相對的學到的也比別人多。人最好的溝通方式就是微笑，我也時常將它掛在臉上，這樣也較容易和人親近。\r\n人生觀\r\n我是一個很樂觀的人，做任何事都會全力以赴，即使失敗了，也不會氣餒，檢討失敗的原因，下次再接再厲。文學家史蒂文曾說：「未得快樂，一無所有。」，美國名心理學家海華斯博士說：「世界上每個人都在追求快樂，有一個方法，那就是探索自己的思想，因為快樂與否，並靠你對各事物所抱持的態度和看法。」，我深信不疑，所以我都保持一顆快樂的心，去看待每一件事物。\r\n興趣志向\r\n自從小學三年級在兒童全語班學習英文後，我發現在歌唱、遊戲中，這種無壓力的情況下，學習效果是最好的。所以我就常聽西洋歌曲，我會拿著歌詞，邊看、邊聽，會試著去了解歌詞的意思，因此學到許多的單字。我也喜歡接獨電腦，常會上網去吸收最近的資訊。在資訊化的社會下，網路是吸取新資訊最便利的方法。在壢商學習的計算機概論中，也有談到一些軟體的應用，所以也略知一二、對網頁的創作也很有興趣，希望將來能有機會創作一個屬於自己的網站。\r\n團體生活－班級幹部\r\n我是一個很活潑的女孩，對團體中的事情，我都很熱情去參與，所以很榮幸的在壢商擔任兩學期的風紀股長，雖然常常都要點名，但我並不覺得累，我很高興能為班上服務。我也擔任了兩學期的英文小老師，我也都盡力的讓班上的成績更好，從中接觸英文的時間也變多了，所以我很樂於當英文小老師。\r\n未來計劃\r\n一個老師曾經說過：「只要有目標，你就不會慌；只要有計劃，你就不會亂；只要有決心，你就不必怕；只要有信心，你就不會氣餒；只要肯奮鬥，你就不會偷懶。有準備的人，成功一定是屬於你的，而機會更是永遠留給有準備及渴望改變的人。」所以我也對我的未來做好了規劃：\r\n一、基本能力\r\n我必需要不斷的提升語文的能力，包括：聽、說、讀、寫四方面。還要不斷的汲取最新的資訊，更要開闊自己的視野，遨遊於世界的大觀園。\r\n二、專業能力\r\n斷續攻讀英文，並再學習另一種語言，憑藉著將來良好的語文能力，進入國際貿易的領域中，讓我更深入的了解國際貿易的意義。現代社會變遷快速，具知識爆發的社會資訊傳送快速，從網路能聞天下事，知識的取得除了透過正式的教育途徑外，非教育的途徑也是很重要的，我將以任何可能的方法，增進個己對語文及國貿的專業能力', NULL, NULL),
(9, '施怡如', 'shi,yi-ru', '台北市', '1998-02-10', 1, '台北市信義區', 's1310531009@nutc.edu.tw', '0955632147', 3, 1, 2, 1, 0, 0, NULL, 0, 0, 0, '2012', '衛道中學', NULL, NULL, '一、簡述:\r\n　    我叫陳證傑，出生於高雄巿，家中排行老大。我活潑開朗、樂觀進取、個性隨和，所以人緣頗佳，有『好好先生』之稱。我九歲喪父，慈愛的母親要母兼父職的養育我和弟弟，為了維持家計，母親平常工作極為忙碌，還好，弟弟和我都很懂事，課業認真，凡事不用媽媽操心，兩兄弟在學校除了成績優良，也都是班上的領導人物，因此，媽媽也頗為安慰。\r\n　    我家境清寒，但志節高超、不怕艱難，遇事越挫越勇。興趣廣泛，喜歡閱讀、運動、唱歌….。課餘常至圖書館閱讀電腦書籍及報章雜誌，充實自己；空閒，喜愛打球(藍球及羽毛球)和唱歌，因為打球的競技及歌曲的旋律都能給我愉悅的心境。連續假日裡，親戚及我們母子三人也會大伙兒結伴去爬山踏青，放鬆一下緊張的心情，縱然我家成員只有三人，在親友的溫情滋潤下，平常也不會感到孤單寂寞。\r\n二、求學：\r\n　    國中時期，由於『理化』課，讓我接觸了電子，並想探求『電子學』的奧秘。因此，國三時，便立下志願──朝『技職教育』發展。在母親的支持下，我如願進了高雄高工電子科。進入高職後，為我帶來了多樣化的發展空間，學業成績也名列前茅，同學們的互相砌蹉更使我獲益良多。在技術士證照方面，也順利的通過『電力電子乙級檢定』，但力爭上游的我，總喜歡觀察身旁的人、事、物並努力發掘。我在高職時，擔任班長、衛生股長、風紀股長等，使我在待人處世方面能圓融，個性上也變得更加成熟穩重。另一面在師長的潛移默化之下，幫我建立思考的邏輯，並且學習到如何有系統地去發掘問題、分析問題、進而解決問題的能力。\r\n　   對於未來，希望能由『基礎課業』開始學習，並能融會貫通而運用於生活中，期許自己能成為優秀的科技人才。\r\n　　　　　　　　　 　     　', '1511101087UVaJ8_pro.jpg', NULL),
(11, '許歆荷', 'hsu,xin-he', '台中市', '1998-05-26', 1, '台中市中區', 's1110234006@nutc.edu.tw', '0965445872', 0, 1, 1, 1, 0, 0, NULL, 0, 0, 0, '2012', '光明國中', NULL, NULL, '一、家庭生活：\r\n          從小我就有一個幸福的家庭，家父是一位數學教師，因此從 小受到數學的陶養，也奠定了喜愛數學的基礎，而母親是位樸實的家庭主婦，在為人處世、美術方面給我薰陶，另外還有一個聰明伶俐就讀國中的妹妹，是我談心的好對象，而一貫化、有效率是家庭裡的座右銘，因此我家永遠是有條不紊。\r\n 二、學習過程：\r\n         小學就讀於中山國小，到了國中，我參加的是志願就學方案，因此讓我有更多時間在數學、理化上發揮長處，我常想以後我要在這方面一展長才，高中就讀美工科，是出於內心的歡喜在工藝造型設計、色彩學…等專業科目都盡其在我不斷地學習，這二年來最得意的是在校段考曾經數學有三次皆滿分的記錄，而成為班上的僥僥者，這讓我毅然選擇工業工程，相信自己必可以克服相關課程。\r\n三、性格、專長與興趣：\r\n(1)我的個性執著、有耐性，凡事秉持著不給人添麻煩,使人順心為原則。\r\n (2)我的專長是數學，也研究科學與造型設計，相信科學、人文配合才能相得益彰，我喜歡什麼都學習，使自己有更多的技能，能左右逢源發揮專長。\r\n四、生涯規劃：\r\n        我希望在大學四年能成為生產研究、工程研究等專業人才，因此和家人經過幾番思考後，決定報考工業工程為下階段學習目標同時兼並英文、電腦能力輔助自己所學，畢業後能以優秀的成績申請本校的研究所～生產系統工程與管理研究所～，學有專精，投身環工、半導體、金融…等等來貢獻社會國家。', '1511100748Cuzfs_pro.png', NULL),
(12, '張哲嘉', 'chang,che-chia', '台中市太平區', '1997-01-22', 1, '台中市太平區', 's1410331034@nutc.edu.tw', '0985632144', 2, 1, 2, 2, 0, 0, NULL, 0, 0, 0, '2013', '光華高工', NULL, '電子工程科', '一、家庭背景：\r\n        土木工程一直都是家族中世代相傳的事業，在我很小的時候，我們家隨著父親到台北創業，父親現在是土木包工的負責人，母親是一位全職的家庭主婦；弟弟現在是高二電子科的學生，家人生活十分融洽。\r\n二、興趣與專長\r\n         平時，我最大的興趣就是玩電腦和打籃球。第一次接觸電腦是在我國小五年級的時候，而在我六年級時，獲得學校舉辦 BASIC 語言程式設計比賽第一名及中文輸入亞軍的榮譽。\r\n         在求學過程中，我最喜歡的科目是數學及英文，尤其是數學，當我費盡了九牛二虎之力，解出一個數學問題時，那種苦盡甘來的感覺，真是筆墨難以形容的。我的專長是「跑步」，我一直認為做一個真正的學生不應該只會唸書，而應該是廣泛的接觸各種事物，並且培養自己的專長，發展健康的身心。\r\n         除了興趣與專長之外，我最大的特色就是具有領導能力，從小學、國中到高中，我都曾擔任過班長，認真負責的態度，受到老師們的肯定。\r\n三、求學歷程：\r\n        在讀國小的時候，學業成績相當不錯，經常得到班上的第一名。我也學過珠心算，「曾經」有過初段的水準；五年級時加入學校田徑隊，參加三重市運動會，獲得不錯的成績；六年級時參加學校「每月徵文」獲得佳作的成績，同時作品被刊登在報上，真是一個令人難忘的經驗。\r\n        升上國中之後，讀書與運動成了生活的重心。我的學業成績表現不錯，在國三時獲得了全校第一名，同時也在學校的運動會上大放異彩。國中一年級時，和同學參加校內科學展覽比賽，是有關電動玩具店出入分子年齡層的調查，得到了「特優」的評價，在這次的活動中，學到了許多關於製作科展的知識與方法，更是一項難得而寶貴的經驗。國二到國三的時候，在訓導處擔任電腦打字及為同學服務的工作，熱心服務的精神受到了肯定，畢業時獲頒「熱心服務獎」。\r\n四、確定目標：\r\n        考完高中聯考後，就利用暑假和父親到工地去見識見識，雖然只是一些簡單的工作，例如挑磚塊、貼磁磚等，但就是這些簡單的工作燃起了我對土木工程的強烈熱誠，進了附中之後，因為一心想成為土木工程系的一員，而選擇了理工類組，現在很幸運地能夠依照我的興趣與熱誠，參加這次台大土木系的甄試，而讓我得到了一個實現理想的好機會。\r\n五、附中生活：\r\n        進入高中，除了在功課上的表現外，還曾經擔任過班長、風紀、康樂股長以及數學小老師，並多次當「模範學生」和三次國文競試第一名。在體育方面，校運會時曾經獲得二百公尺金牌，四百公尺銅牌及校園迷你馬拉松第二十二名，尤其是那份金牌的榮耀，更是令我難以忘懷。也因此，在高二時，由於對團體貢獻良多而獲頒榮譽狀。\r\n        附中蓬勃發展的社團生活是人人嚮往的，我高一時就曾經加入吉他社及舞蹈社，學到了一些基本的技巧，同時也能強烈感受到附中的傳承精神。高一寒假時，曾經參加救國團舉辦的「南橫健行」，深深體會到團隊行動與互動合作的重要，並且從小隊生活中認識了許多來自不同地方的朋友，這是我高中生活中，收穫最大的課外活動。\r\n六、未來展望：\r\n         近程方面，我希望能夠進入培育優秀土木工程人才的台灣大學，廣泛的涉獵土木工程在各方面的知識，打穩自己的基礎，作為將來選擇工程組別的依據，進一步希望能爭取台大土木研究所的名額，甚至能夠出國深造，將國外較我們先進的技術帶回台灣，為台灣的工程建設做一番努力。\r\n         生涯規劃方面，我希望能夠成為一個傑出的土木工程師，使理論與實務結合，為國家的公共建設貢獻自己的一份力量。', '1511100579uT10b_pro.jpg', NULL),
(13, '王宏霖', 'wang,hung-lin', '桃園市', '1998-04-21', 0, '桃園市', 's1410331020@nutc.edu.tw', '0955632145', 1, 2, 3, 2, 0, 0, NULL, 0, 0, 0, '2016', 'NUTC', '資訊管理系', NULL, '我出生在一個很平凡但很美滿的小家庭，父親是個公務員，在台電服務，母親是個家庭主婦，而弟弟和我都還在學校求學。父母用民主的方式管教我們，希望我們能夠獨立自主、主動學習，累積人生經驗，但他們會適時的給予鼓勵和建議，父母親只對我們要求兩件事，第一是保持健康，第二是著重課業。因為沒有健康的身體，就算有再多的才華、再大的抱負也無法發揮出來。又因為家境並不富裕，所以必須專心於課業上，學得一技之長，將來才能自立更生。\r\n          在小學時代的我很活潑、很好動，在課業上表現平平，但課外表現不錯，除了擔任過班長等幹部外，還參加樂隊、糾察隊等，另外還曾獲選為校隊參加跳高比賽。\r\n         小學畢業後，進入了一所私立中學，因為校規嚴格，使原本好動的我變得較為文靜，不過在那裡我學會了許多應有的禮節與待人處世的道理。在國中時期的我，好像開了竅，代表全校接受縣政府的表揚，在國三畢業典禮上，更代表了全體畢業生上台領取畢業證書。\r\n         進附中後，每天都覺得很充實、很快樂。附中學生的特色是能K、能玩，所以我不斷地努力學習，希望能夠達到此目標。在課業方面，我都能保持在一定的水準，因為上課專心聽講、仔細思考、體會老師所說的每一句話，在腦海裡架構重要觀念，一有問題就立刻發問，因此上課的吸收效率很高，不但使得複習的工作能夠很快完成，還有多餘的時間從事課外活動。在這麼多的科目當中，我最喜歡的是數學、化學和生物，因為數學、化學能夠訓練我們組織與思考能力。而生物則和日常生活有密切的關係，且它為我們揭開人體的奧秘。\r\n         我在學校人際關係良好，因為無論何時，總是笑臉迎人，微笑已成為我個人的正字招牌。老師們常稱讚我是個品學兼優的好學生，常給我許多的鼓勵，而同學間的相處十分融洽，彼此之間很有默契，團結一心。\r\n         除了課業之外，其他方面我也沒有偏廢。在高一時加入學校管樂隊，吹奏低音號，每天升旗參加出勤，在這裡不但使我對管樂器有進一步的認識，還認識了許多朋友，因此在那個時候，參加社團已成為我放學後的一大休閒。而我最喜歡的運動是棒球，我常在電視上或球場上觀賞職棒比賽，欣賞球員的美姿，模仿其動作。我常利用課餘時間約同學一起出外打球，記得在高二時，班上組隊參加班際壘球賽，那時我擔任隊長，防守二壘，首先展開攻勢，激起球隊士氣，最後終以一分之差贏得了最後勝利。除了棒球之外，我也很喜歡藍球、排球等，因此使得原本瘦弱的身體，變得強壯許多。\r\n         我從小就立志要當醫生，近年來當我接觸了有關醫學系的相關資訊，漸漸地了解到當個醫生並不是那麼簡單的事，需要對服務人群有興趣，及擅長人際溝通，且在求學的過程中也相當辛苦。但疾病加諸在病人身上的痛苦是無法言諭的，來自醫生的關懷與勉勵，能讓病人產生無比的信念，勇敢地向疾病宣戰，在病人痊癒時，看到病人及家屬喜形於色，那種喜悅，令我十分嚮往，而且醫生不僅僅是要免除病人的疾病和虛弱，也要能兼顧對人們的整體關懷，使病患的身心達到安寧的狀態，在這一方面，它讓我更確定了讀醫學系的志向。', '1511100380TK2YL_pro.png', NULL),
(14, '王俊淵', 'wang,chun-yuan', '台中', '1997-07-09', 0, '台中北區文心路二段45號', 's1410331021@nutc.edu.tw', '0965883264', 1, 1, 1, 1, 550, 0, NULL, 0, 0, 0, '2011', '新民高中', NULL, '資處科', '大家好啊', '1511100101MUQ88_pro.png', NULL),
(16, '王敬夫', 'wang,chig-fu', '雲林縣', '1997-09-24', 0, '雲林縣西螺鄉', 's1110234014@nutc.edu.tw', '0975666214', 0, 1, 1, 1, 0, 0, NULL, 0, 0, 0, '2011', 'XX國中', NULL, NULL, '一、家庭生活\r\n我家有五個人，爸爸是電信研究所的高級技術員，媽媽是國小老師。姊姊剛從台大會計系畢業，準備出國留學；哥哥就讀於長庚大學物理治療系四年級。爸媽對我們的教養方式十分民主，也十分尊重我們的選擇，從不對我們做不合理的要求或限制。閒暇時，我喜歡留在家裡做些餅乾或蛋糕之類的小點心，給家人或同學分享。\r\n二、在校的表現：\r\nl           課業成績一直是班上前兩名。\r\nl           參加舞蹈、朗讀、賽跑等競賽，得到前三名。\r\nl           獲得英文二、三級及會計、英打證照。\r\nl           擔任副班長及小老師，也當選優良青年代表及模範生。\r\nl           參加過糾察隊、合唱團、網球等社團。\r\n三、申請動機：\r\nl           高二的寒假，因為閱讀了總裁獅子心這本書，讓我了解企業管理對一個企業的重要  性，也使我對企管充滿濃厚的興趣。\r\nl           從小到大，擔任許多幹部，例如班長、副班長等，使我有豐富的管理經驗。\r\nl           台科大畢業生是企業界爭相取用的人才，所以台科大企管系是我唯一的選擇。\r\n四、大學的學習計畫及生活：\r\n1．大一：\r\nl      著重課業學習，為專業領域奠定良好基礎。\r\nl      多閱讀英文雜誌及書刊。\r\nl      希望能做個志工，為他人服務。\r\n2．大二：\r\nl      保持課業方面的成績。\r\nl      善用學校視聽中心，提升英文能力。\r\nl      到圖書館瀏覽企業方面的書籍及名人傳記；研究各種成功的企業，其不同的領導統御管理風格，以增加自己的管理能力及知識。\r\n３．大三：\r\nl      深入研究管理方面的專業知識。\r\nl      加強英文會話能力，與好友組成學習小組，每週限定一天以英文溝通。\r\nl      我將特別關注台灣本島新興或知名企業的發展方向及經營概況。利用寒暑假期間，進入有制度、有規模的公司打工，以增進實務經驗。\r\n４．大四：\r\nl      整理並複習所學的知識，為報考研究所或出國留學而努力。', '1511101507twvdH_pro.jpg', NULL),
(26, '蔡旻袁', 'Leo', '臺北', '1998-05-17', 0, '竹北', 'a0981152468@gmail.com', '0917332517', 0, 0, 1, 0, 0, 0, '無', 0, 0, 0, '102', '南崁國中', NULL, NULL, '我很猛', '1511175495V1Uy0_pro.jpg', NULL),
(29, '賴潔瑩', 'jamie', '台中', '1998-01-16', 1, '台中市東區東英二街', 'jamie870116@gmail.com', '0972012889', 0, 1, 2, 1, 0, 0, '日文', 2, 3, 2, '2012', '曉明女中', NULL, NULL, '大家好', '1511080256DgBgO_pro.PNG', NULL),
(30, '李庚翰', 'Li-Geng-Hen', '台中市', '1997-11-21', 0, '台中市西屯區福雅里福科路407號10樓', 'h12345566h@gmail.com', '0922112164', 0, 2, 2, 2, 0, 0, NULL, 0, 0, 0, '107', '國立台中科技大學', '資管系', '資應科', 'ya~測試一下~carry', '1511072531Uzk9o_pro.jpg', '/licences/15118049397Iwzd_lic.docx'),
(31, '黃語萱', 'HUANG YU SYUAN', '台灣', '1997-11-29', 0, '台中市太平區新平路一段35巷', 's1110234010@gmail.com', '0917771185', 0, 1, 2, 0, 730, 0, NULL, 0, 0, 0, '2013', '國立臺中科技大學', NULL, NULL, 'test', NULL, NULL),
(33, '鄭秉松', 'Kevin Cheng', 'Honolulu,Hawaii', '1995-09-25', 0, '雲林縣斗南鎮大安路六十巷42號', 'kevin5970403@gmail.com', '0980365799', 0, 2, 2, 1, 0, 0, '日語', 1, 1, 1, '2010', '斗南國中', NULL, NULL, '無', '1511366011AlldS_pro.jpg', NULL),
(37, '蔡旻元', NULL, NULL, NULL, 0, NULL, 'b0981152468@gmail.com', '0922151548', 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, '試試看', NULL, NULL, NULL, 0, NULL, 'delmar.darious@oou.us', '021231222', 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, '侯蓓臻', NULL, NULL, NULL, 0, NULL, 'n1429ns@gmail.com', '0911827713', 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '/licences/example.docx');

-- --------------------------------------------------------

--
-- Table structure for table `stu_course`
--

CREATE TABLE `stu_course` (
  `SCid` int(10) UNSIGNED NOT NULL,
  `c_account` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `courseId` int(11) NOT NULL,
  `assessmentStatus` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stu_course`
--

INSERT INTO `stu_course` (`SCid`, `c_account`, `sid`, `tid`, `mid`, `courseId`, `assessmentStatus`, `created_at`, `updated_at`) VALUES
(2, '2750963', 30, 15, 2, 1, 0, '2017-11-19 00:00:37', '2017-11-19 00:00:37'),
(3, '2750963', 30, 15, 1, 2, 0, '2017-11-20 07:50:40', '2017-11-20 07:50:40'),
(4, '43162200', 26, 15, 18, 1, 0, '2017-11-22 02:49:59', '2017-11-22 02:49:59'),
(5, '24584004', 33, 15, 24, 1, 0, '2017-11-22 16:15:01', '2017-11-22 16:15:01');

-- --------------------------------------------------------

--
-- Table structure for table `stu_jexp`
--

CREATE TABLE `stu_jexp` (
  `sid` int(11) NOT NULL,
  `jid` int(10) UNSIGNED NOT NULL,
  `comName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobTitle` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stu_jexp`
--

INSERT INTO `stu_jexp` (`sid`, `jid`, `comName`, `jobTitle`) VALUES
(30, 1, '工讀生', '國立台中科技大學'),
(26, 2, '博科資訊', '實習生'),
(26, 3, '微軟', '學生大使');

-- --------------------------------------------------------

--
-- Table structure for table `stu_works`
--

CREATE TABLE `stu_works` (
  `sid` int(11) NOT NULL,
  `wid` int(10) UNSIGNED NOT NULL,
  `wName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wLink` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wCreatedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stu_works`
--

INSERT INTO `stu_works` (`sid`, `wid`, `wName`, `wLink`, `wCreatedDate`) VALUES
(30, 1, 'ConGroup', NULL, '2017-06-22'),
(26, 2, '很多作品', 'github.com/fsmytsai', '2017-11-20');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_profile_pic`
--

CREATE TABLE `teacher_profile_pic` (
  `tid` int(11) NOT NULL,
  `profilePic` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `token` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` int(11) NOT NULL,
  `types` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `u_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `u_status` int(11) NOT NULL,
  `u_tel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `started` tinyint(4) NOT NULL DEFAULT '0',
  `check_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `u_name`, `email`, `password`, `u_status`, `u_tel`, `account`, `started`, `check_code`) VALUES
(1, '吳玟憲', 's1410331025@nutc.edu.tw', '$2y$10$hrQTtLfGr6RGyUEl4q.mpuxjtiqzmSvfqgRE4ERt26GZhGnnjJbQW', 0, '0980365799', 's1410331025', 1, NULL),
(2, '張若翔', 's1410331033@nutc.edu.tw', '$2y$10$xTfOqDclhkPBw0EXcRtQG.sDlEDMGRV13FFJDuEIhluvQk4n9HS/m', 0, '0972012889', 's1410331033', 1, NULL),
(3, '陳復陞', 's1410331037@nutc.edu.tw', '$2y$10$AJE6W6KOtrx1QbYv9O6nFuXyCUlS6/Qzr7gstr5IWQ9zGHpUN0uua', 0, '0972012889', 's1410331037', 1, NULL),
(4, '林俊豪', 's1110234016@nutc.edu.tw', '$2y$10$yWChE0lFe1yl6XW2sWgctON6a32Zk6R/EWtdoSTMr/xZySsfOLsD6', 0, '0972012889', 's1110234016', 1, NULL),
(5, '黃立翔', 's1310534025@nutc.edu.tw', '$2y$10$DO6Zhbt0Pw4zlyQ6DzzkR.dF8EingAx4NSMbjGerGatUX4T/n1hR2', 0, '0972012889', 's1310534025', 1, NULL),
(6, '林惠新', 's1310534004@nutc.edu.tw', '$2y$10$XNz67X2yqVJbkeWU1vpfXe.2AKxD/fdeI3e3ylcjx7MliNTxaJC3e', 0, '0972012889', 's1310534004', 1, NULL),
(7, '張家銓', 's1310534021@nutc.edu.tw', '$2y$10$eHLKhr1KVMfK9XyXjYLyLeDaSn4DDhdmv8I/y6WKaueqO1p.Odkyq', 0, '0972012889', 's1310534021', 3, NULL),
(8, '林姿伸', 's1310531005@nutc.edu.tw', '$2y$10$SBQztSE4kVLnAFWWpH63XuQ/4UNAFYQHoR4k8vgtSEdgm/TqfoEZi', 0, '0972012889', 's1310531005', 3, NULL),
(9, '施怡如', 's1310531009@nutc.edu.tw', '$2y$10$JbStEWSaS7CFmYX49vU6xOOMf91CYJQtzTcTUuQAdefYO0o15hjoC', 0, '0972012889', 's1310531009', 3, NULL),
(11, '許歆荷', 's1110234006@nutc.edu.tw', '$2y$10$xvUt7I6QfEe.EiT3L/0T.eoUdm8wm.5Rgh61mHNT/2WCvtx0BfmmK', 0, '0972012889', 's1110234006', 3, NULL),
(12, '張哲嘉', 's1410331034@nutc.edu.tw', '$2y$10$2GT8saoUIy2SYyVIUTzW7.KSVQcFC03FsnCigoDJ8dRfTu2FaVU3y', 0, '0972012889', 's1410331034', 3, NULL),
(13, '王宏霖', 's1410331020@nutc.edu.tw', '$2y$10$lEr7hirrfp6xzlEDmaNok.PHuvL/n8flb3/61fSwVBHMuImBnKgFK', 0, '0972012889', 's1410331020', 1, NULL),
(14, '王俊淵', 's1410331021@nutc.edu.tw', '$2y$10$xO0A4AAYrlas47Emn2R3uePO7n5fRGmJoYnBhM2xMMkiGlStRJdry', 0, '0972012889', 's1410331021', 1, NULL),
(15, '蕭國倫', 'teacher456@nutc.edu.tw', '$2y$10$7S8m0PmnjMEm9FXW62eCyedMIbMzVD4eqkIY.lLNgTeNqgyqjAsWe', 1, '0980365799', 'teacher456', 1, NULL),
(16, '王敬夫', 's1110234014@nutc.edu.tw', '$2y$10$9umn/f95eFDDPFOrGk46oOv4Z02U8IRMPxVzbXx2LQ0ThREUhWb4i', 0, '0972012889', 's1110234014', 1, NULL),
(17, '系辦', 'admin@mail.com', '$2y$10$XM4O6e8.uYk7KR8tFWG3peCJoHVyMPyjLeI6v2IRZLOfmTH22nBou', 3, '0422115588', 'admin123', 1, NULL),
(18, '工業技術研究院', 'mail@gmail.com', '$2y$10$YWieIdiIIf39m2keic36hejAobJmX3GkHE.gA./Jx2Sd0DzYh1ZEO', 2, '22112022', '2750963', 1, NULL),
(19, '宏碁雲端技術服務股份有限公司', 'mail2@gmail.com', '$2y$10$6ZQy19z0KXSKd43/Me4bqu.izoJRpUtXeH6MGalcD.8p/d8eNqHTG', 2, '22112022', '43162200', 1, NULL),
(20, '台中科技大學', 'mail3@gmail.com', '$2y$10$hXGtRSPpIBDEQi2NgVMZ9eWGOK4Vpr89dmDo/M2PqR1gK2rHj1llK', 2, '04 22195678', '99513636', 1, NULL),
(21, '國興資訊', 'mail4@gmail.com', '$2y$10$I/sk9Uz5CdSH2a4R22zIbe67IRxiBxwq8Dkrw8RM8RXfnduml94Gy', 2, '22112022', '52875138', 1, NULL),
(22, '創科資訊股份有限公司', 'mail5@gmail.com', '$2y$10$9LydkT1URrsfxBNyBExooeMq1uK8PICt9Om421RhJ/81fqjqSiqem', 2, '22112022', '54891351', 2, NULL),
(23, '博科資訊', 'mail6@gmail.com', '$2y$10$YTHkpJ.80R05BKwWAA9fx.MaW5BrvWEx6Vm4YPZghvbJY4OzYtWyW', 2, '22112022', '80231876', 2, NULL),
(24, '遠景科技', 'mail7@gmail.com', '$2y$10$zY/3NCgN5eP02/2L5dtrY.3graQtza5aUEDg1wEA7Iqxh7C6t3xBa', 2, '22112022', '54239825', 2, NULL),
(25, '馥華生活股份有限公司', 'mail8@gmail.com', '$2y$10$UyxJQPFdzjX7B4b44qJRvOxr9lX4a3JbNeEUc028lFYzNClDMs5Y6', 2, '22112022', '24584004', 1, NULL),
(26, '蔡旻袁', 'a0981152468@gmail.com', '$2y$10$lCIEXV.MhwnuOWjVig/YdOJGTUkXp6o/zxiIdM0V/lAuhUwgdhpP2', 0, '0917332517', 'tsaihau1998', 1, 'jipe9ipmkw'),
(29, '賴潔瑩', 'jamie870116@gmail.com', '$2y$10$H9ctEXSEwH40UkHSQFLnkeH2iMs3a1H0Av.4VqlIQRK8OG3IGit7e', 0, '0922333556', 'jamie870116', 1, 'ltddrzarx9'),
(30, '李庚翰', 'h12345566h@gmail.com', '$2y$10$T4b3HZIUKKJTWj4Z2PV78OpyY1oXd5YndJrulaPzZ3HaEnddUog8.', 0, '0922112164', 's111111111', 1, 'j8t220h6u7l96ln'),
(31, '黃語萱', 's1110234010@gmail.com', '$2y$10$FB1ojyW/ZKJYdEkRDRN2c.ZTbbgi9hw.eFuqS7WFU/WXQpZlF2.Pe', 0, '0917771185', 's1110234010', 1, 'cail6s2o6c'),
(32, 'tsai', 'andhausung1998@gmail.com', '$2y$10$R7sxFs9Wr7wFi2/SD5OGROWKAA7mFwZ9y934NY2sdzzdavN7MmlVe', 1, '0917332517', 'teacher123', 1, 'hme7biiiro'),
(33, '鄭秉松', 'kevin5970403@gmail.com', '$2y$10$5toBc/ZhS8C1eqxisQo3QeEVUR4PChjrxlNSKqsBc/WJ6GYRlvc2W', 0, '0980365799', 's1110234021', 1, 'xprh88lqou'),
(34, '旻袁企業', 'msphausung1998@gmail.com', '$2y$10$fQTdWuh64oZ7glpuK1w4Ne3K4Fvk3IXvvIfnyOj9jpLal1/uCM/Ky', 2, '0917332517', '87878787', 1, 'yyh7s8gjr9'),
(35, '長榮企業', 'kevin5972243@gmail.com', '$2y$10$01uhbKo02t5pd6oG0l6lZuqE2H4/0Kd9pajtVs.3/s8S6.Xdz/fYe', 2, '22445623', '11223344', 1, 'skzzc1ripe'),
(36, '李庚翰', 's1110234015@gms.nutc.edu.tw', '$2y$10$UYua/y07VvOQblsbAikOfOtVCKmeH7YMwJ.XENkGUlzws.KQv7DqC', 2, '0922112164', '12345678', 0, 'c68rv6ijrl'),
(37, '蔡旻元', 'b0981152468@gmail.com', '$2y$10$y1OntULsGxCuzc5Vu2DFTOLhnYIfz4lRhQAxZ3CfVxcx4UoAqbPOW', 0, '0922151548', '987654321', 1, '3l1hqan8ev'),
(38, '台中科技大學', 'im@nutc.edu.tw', '$2y$10$zr5ieG4Wz98pyfofKErqke.1fqWgEUIU8yZjrqzVuC8nZOfOXLP4.', 2, '0422190000', '52010606', 0, 'xxt1rsq16r'),
(39, '123', 'juyagu@ether123.net', '$2y$10$fLEZ9gL8i3DcGAvELHUcqefTGHpq/8Z3ri82WK9Mjcg0tUwckJ9Lq', 2, '0422190000', '52010600', 0, 'y3jt5v2xzc'),
(40, '123', 'haiden.jasian@oou.us', '$2y$10$EbU3f7sex3Hn/u1RziBcAOrlkcM.QmN.Qn7gCLEcuhqWuECxfaxMW', 2, '04123123', '52010603', 2, 't2uahlxam4'),
(41, '試試看', 'delmar.darious@oou.us', '$2y$10$RfIIopnwDklN6Pn/ER94juXolEUXGG2FCaextetchvLv7Oavpyms2', 0, '021231222', 's1410331038@nutc.edu.tw', 1, 'cnjmwq6gdj'),
(42, '林玟瑜', 's1110302062@nutc.edu.tw', '$2y$10$v06kWqTY4h9ieUdW927QDu8ZlKiJbWtBE.VnbsoTjp45Qwdr0ZxGK', 0, '0963900863', '1110302062', 0, 'aw144xeipm'),
(43, '侯蓓臻', 'n1429ns@gmail.com', '$2y$10$qqGLqBaIe4qgj9TL/WCdjuaHiZYT09rKmBOp64qIWhCd/RPu94ezG', 0, '0911827713', 's1310534006', 1, 'inxnpwxwe9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`anId`);

--
-- Indexes for table `assessment_com`
--
ALTER TABLE `assessment_com`
  ADD PRIMARY KEY (`asId`);

--
-- Indexes for table `assessment_teach`
--
ALTER TABLE `assessment_teach`
  ADD PRIMARY KEY (`asTId`);

--
-- Indexes for table `com_basic`
--
ALTER TABLE `com_basic`
  ADD PRIMARY KEY (`c_account`);

--
-- Indexes for table `counseling_result`
--
ALTER TABLE `counseling_result`
  ADD PRIMARY KEY (`counselingId`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseId`);

--
-- Indexes for table `intern_proposal`
--
ALTER TABLE `intern_proposal`
  ADD PRIMARY KEY (`IPId`);

--
-- Indexes for table `interviews`
--
ALTER TABLE `interviews`
  ADD PRIMARY KEY (`inid`);

--
-- Indexes for table `interview_com`
--
ALTER TABLE `interview_com`
  ADD PRIMARY KEY (`insCId`);

--
-- Indexes for table `interview_com_questions`
--
ALTER TABLE `interview_com_questions`
  ADD PRIMARY KEY (`insCQId`);

--
-- Indexes for table `interview_stu`
--
ALTER TABLE `interview_stu`
  ADD PRIMARY KEY (`insId`);

--
-- Indexes for table `interview_stu_questions`
--
ALTER TABLE `interview_stu_questions`
  ADD PRIMARY KEY (`insQId`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_at_index` (`queue`,`reserved_at`);

--
-- Indexes for table `jopOpening`
--
ALTER TABLE `jopOpening`
  ADD PRIMARY KEY (`joid`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`journalID`);

--
-- Indexes for table `match`
--
ALTER TABLE `match`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `matchLog`
--
ALTER TABLE `matchLog`
  ADD PRIMARY KEY (`logid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reId`);

--
-- Indexes for table `send_mail_bc`
--
ALTER TABLE `send_mail_bc`
  ADD PRIMARY KEY (`slId`);

--
-- Indexes for table `station_letter`
--
ALTER TABLE `station_letter`
  ADD PRIMARY KEY (`slId`);

--
-- Indexes for table `stu_ability`
--
ALTER TABLE `stu_ability`
  ADD PRIMARY KEY (`abiid`);

--
-- Indexes for table `stu_basic`
--
ALTER TABLE `stu_basic`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `stu_course`
--
ALTER TABLE `stu_course`
  ADD PRIMARY KEY (`SCid`);

--
-- Indexes for table `stu_jexp`
--
ALTER TABLE `stu_jexp`
  ADD PRIMARY KEY (`jid`);

--
-- Indexes for table `stu_works`
--
ALTER TABLE `stu_works`
  ADD PRIMARY KEY (`wid`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `anId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `assessment_com`
--
ALTER TABLE `assessment_com`
  MODIFY `asId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assessment_teach`
--
ALTER TABLE `assessment_teach`
  MODIFY `asTId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `counseling_result`
--
ALTER TABLE `counseling_result`
  MODIFY `counselingId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `intern_proposal`
--
ALTER TABLE `intern_proposal`
  MODIFY `IPId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `interviews`
--
ALTER TABLE `interviews`
  MODIFY `inid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `interview_com`
--
ALTER TABLE `interview_com`
  MODIFY `insCId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `interview_com_questions`
--
ALTER TABLE `interview_com_questions`
  MODIFY `insCQId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5695;

--
-- AUTO_INCREMENT for table `interview_stu`
--
ALTER TABLE `interview_stu`
  MODIFY `insId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `interview_stu_questions`
--
ALTER TABLE `interview_stu_questions`
  MODIFY `insQId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jopOpening`
--
ALTER TABLE `jopOpening`
  MODIFY `joid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `journalID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `match`
--
ALTER TABLE `match`
  MODIFY `mid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `matchLog`
--
ALTER TABLE `matchLog`
  MODIFY `logid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `send_mail_bc`
--
ALTER TABLE `send_mail_bc`
  MODIFY `slId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `station_letter`
--
ALTER TABLE `station_letter`
  MODIFY `slId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `stu_ability`
--
ALTER TABLE `stu_ability`
  MODIFY `abiid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `stu_course`
--
ALTER TABLE `stu_course`
  MODIFY `SCid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stu_jexp`
--
ALTER TABLE `stu_jexp`
  MODIFY `jid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stu_works`
--
ALTER TABLE `stu_works`
  MODIFY `wid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
