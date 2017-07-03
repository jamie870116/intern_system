-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2017-06-24 15:33:59
-- 伺服器版本: 10.1.21-MariaDB
-- PHP 版本： 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `intern`
--

-- --------------------------------------------------------

--
-- 資料表結構 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_05_10_071202_create_tokens_table', 2),
(4, '2017_06_23_074404_create_stu_basic_table', 2),
(5, '2017_06_23_074458_create_stu_edu_table', 2),
(6, '2017_06_23_074509_create_stu_exp_table', 2),
(7, '2017_06_23_074526_create_stu_licence_table', 2),
(8, '2017_06_23_081553_create_stu_works_table', 2),
(9, '2017_06_23_081613_create_stu_relatives_table', 2);

-- --------------------------------------------------------

--
-- 資料表結構 `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `stu_basic`
--

CREATE TABLE `stu_basic` (
  `sid` int(11) NOT NULL,
  `chiName` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `engName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bornedPlace` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nativePlace` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brithday` date DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `height` double(8,2) DEFAULT NULL,
  `weight` double(8,2) DEFAULT NULL,
  `bloodtype` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CL` tinyint(4) DEFAULT NULL,
  `CS` tinyint(4) DEFAULT NULL,
  `CR` tinyint(4) DEFAULT NULL,
  `CW` tinyint(4) DEFAULT NULL,
  `EL` tinyint(4) DEFAULT NULL,
  `ES` tinyint(4) DEFAULT NULL,
  `ER` tinyint(4) DEFAULT NULL,
  `EW` tinyint(4) DEFAULT NULL,
  `TL` tinyint(4) DEFAULT NULL,
  `TS` tinyint(4) DEFAULT NULL,
  `dataBase` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `programmingLanguage` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `webDesign` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imageProcessing` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `drawingSoftware` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `animation` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `OS` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `musicEditor` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `stu_edu`
--

CREATE TABLE `stu_edu` (
  `sid` int(11) NOT NULL,
  `edu_id` int(10) UNSIGNED NOT NULL,
  `school` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enterDate` date NOT NULL,
  `exitDate` date DEFAULT NULL,
  `graduate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `stu_jexp`
--

CREATE TABLE `stu_jexp` (
  `sid` int(11) NOT NULL,
  `jid` int(10) UNSIGNED NOT NULL,
  `semester` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobTitle` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `stu_licence`
--

CREATE TABLE `stu_licence` (
  `sid` int(11) NOT NULL,
  `lid` int(10) UNSIGNED NOT NULL,
  `agency` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ldate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `stu_relatives`
--

CREATE TABLE `stu_relatives` (
  `sid` int(11) NOT NULL,
  `rid` int(10) UNSIGNED NOT NULL,
  `rType` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rName` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rAge` int(11) DEFAULT NULL,
  `rEdu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rJob` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `stu_works`
--

CREATE TABLE `stu_works` (
  `sid` int(11) NOT NULL,
  `wid` int(10) UNSIGNED NOT NULL,
  `wName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wLink` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wCreatedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `tokens`
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
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `u_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `u_status` int(11) NOT NULL,
  `u_tel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `started` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `check_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`id`, `u_name`, `email`, `password`, `u_status`, `u_tel`, `account`, `started`, `check_code`) VALUES
(1, '學生', 's1110234000@nutc.edu.tw', '$2y$10$jDI7zftw.YGJrP/KQcFCAOJN1Z4NY4foJqL8ISMwpugwLv6WHulAO', 0, '0988379188', 's1110234000', '1', NULL),
(2, '老師', 'teacher123@nutc.edu.tw', '$2y$10$8dhWtXTQND.R/YRS8ghymOJkXWPQjD4AX8shqMsvHJR6rnJ3hblhm', 1, '0980365799', 'teacher123', '0', NULL),
(3, '企業', 'jamie870116@gmail.com', '$2y$10$H6kyLIKSRj2wLZbFCFfx7el770Wt.gt9pln9C/dHcX2tQngIv8YEO', 2, '0972012889', '12345678', '0', NULL),
(16, 'aaa', 's1110234021@nutc.edu.tw', '$2y$10$CDY1G6YHZIZDlOpH6U6wqOKWnL7iWLCz29D4jIcXaGO5vfvrTKTpS', 0, 'aaa', 's1110234021', '0', '9duon14nzy');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- 資料表索引 `stu_basic`
--
ALTER TABLE `stu_basic`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `stu_edu`
--
ALTER TABLE `stu_edu`
  ADD PRIMARY KEY (`edu_id`);

--
-- 資料表索引 `stu_jexp`
--
ALTER TABLE `stu_jexp`
  ADD PRIMARY KEY (`jid`);

--
-- 資料表索引 `stu_licence`
--
ALTER TABLE `stu_licence`
  ADD PRIMARY KEY (`lid`);

--
-- 資料表索引 `stu_relatives`
--
ALTER TABLE `stu_relatives`
  ADD PRIMARY KEY (`rid`);

--
-- 資料表索引 `stu_works`
--
ALTER TABLE `stu_works`
  ADD PRIMARY KEY (`wid`);

--
-- 資料表索引 `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`token`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- 使用資料表 AUTO_INCREMENT `stu_edu`
--
ALTER TABLE `stu_edu`
  MODIFY `edu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `stu_jexp`
--
ALTER TABLE `stu_jexp`
  MODIFY `jid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `stu_licence`
--
ALTER TABLE `stu_licence`
  MODIFY `lid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `stu_relatives`
--
ALTER TABLE `stu_relatives`
  MODIFY `rid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `stu_works`
--
ALTER TABLE `stu_works`
  MODIFY `wid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
