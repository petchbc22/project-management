-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 10, 2019 at 06:22 PM
-- Server version: 5.5.31
-- PHP Version: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `buzzbkkc_vlog1`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `acc_id` int(4) NOT NULL AUTO_INCREMENT,
  `acc_username` varchar(200) NOT NULL,
  `acc_email` varchar(200) NOT NULL,
  `acc_name` varchar(200) NOT NULL,
  `acc_lastname` varchar(50) NOT NULL,
  `acc_password` varchar(50) NOT NULL,
  `acc_img` varchar(200) NOT NULL,
  `acc_permission` int(11) NOT NULL,
  `acc_status` int(3) NOT NULL,
  PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_id`, `acc_username`, `acc_email`, `acc_name`, `acc_lastname`, `acc_password`, `acc_img`, `acc_permission`, `acc_status`) VALUES
(1, 'petch', 'tayanchon.k@gmail.com', 'ทยานชล', 'กลั่นเทศ', '22t18287', '201908080307322033597047.jpg', 1, 1),
(2, 'tor', 'tor@storyboard.com', 'ศรายุทธ ', 'คงสมบูรณ์', '1234', 'avatar.png', 1, 1),
(5, 'tuck', 'jirapha.pkp@gmail.com', 'จิรภา', 'ประกอบผล', '22t18287', 'WMNV3471.JPEG', 1, 1),
(6, 'Jiranan.grape', 'jiranan.k@gmail.com', 'Jiranan', 'Klanted', '22t18287', 'avatar.png', 0, 1),
(7, 'nut22', 'natthapong.w@gmail.com', 'ณัฐพงค์', 'วงศ์ศรี', '22t18287', '20190808015753108022884.jpg', 0, 1),
(11, 'petch.bc', 'petch@storyboard.com', 'Tayanchon', 'Klanted', '22t18287', '20190801022946762123353.jpg', 2, 1),
(12, 'petchd', 'ddddd@fdsfdf', 'ddd', 'dddd', '22t18287', 'avatar.png', 2, 1),
(13, 'Rpure', 'test@test.com', 'tayanchon', 'klanted', '22t18287', 'avatar.png', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `board_comments`
--

CREATE TABLE IF NOT EXISTS `board_comments` (
  `bc_id` int(3) NOT NULL AUTO_INCREMENT,
  `pjt_id` int(3) NOT NULL,
  `acc_id` int(3) NOT NULL,
  `bc_detail` text NOT NULL,
  `bc_files` varchar(100) NOT NULL,
  `bc_datetime` datetime NOT NULL,
  `bc_status` varchar(1) NOT NULL,
  PRIMARY KEY (`bc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

-- --------------------------------------------------------

--
-- Table structure for table `logfile`
--

CREATE TABLE IF NOT EXISTS `logfile` (
  `logfile_id` int(3) NOT NULL AUTO_INCREMENT,
  `user` int(3) NOT NULL,
  `activity` varchar(200) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`logfile_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=379 ;

--
-- Dumping data for table `logfile`
--

INSERT INTO `logfile` (`logfile_id`, `user`, `activity`, `time`) VALUES
(366, 7, 'เข้าสู่ระบบ', '2019-09-10 14:47:08'),
(367, 7, 'ออกจากระบบ', '2019-09-10 14:47:16'),
(368, 7, 'เข้าสู่ระบบ', '2019-09-10 14:49:04'),
(369, 7, 'เข้าสู่ระบบ', '2019-09-10 14:54:55'),
(370, 7, 'เข้าสู่ระบบ', '2019-09-10 14:58:50'),
(371, 7, 'เข้าสู่ระบบ', '2019-09-10 15:29:46'),
(372, 2, 'เข้าสู่ระบบ', '2019-09-10 16:49:50'),
(373, 2, 'เข้าสู่ระบบ', '2019-09-10 17:31:32'),
(374, 7, 'เข้าสู่ระบบ', '2019-09-10 17:32:15'),
(375, 2, 'ออกจากระบบ', '2019-09-10 17:33:16'),
(376, 6, 'เข้าสู่ระบบ', '2019-09-10 17:33:27'),
(377, 6, 'ออกจากระบบ', '2019-09-10 17:33:56'),
(378, 5, 'เข้าสู่ระบบ', '2019-09-10 17:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(3) NOT NULL,
  `permission_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `permission_name`) VALUES
(0, 'SUPER ADMIN'),
(1, 'ADMIN'),
(2, 'STAFF');

-- --------------------------------------------------------

--
-- Table structure for table `production_type`
--

CREATE TABLE IF NOT EXISTS `production_type` (
  `pt_id` int(1) NOT NULL,
  `production_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `production_type`
--

INSERT INTO `production_type` (`pt_id`, `production_type_name`) VALUES
(1, 'Pre Production'),
(2, 'Production'),
(3, 'Post Production');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `pj_id` int(3) NOT NULL AUTO_INCREMENT,
  `tp_id` int(3) NOT NULL,
  `pj_process_title` varchar(50) NOT NULL,
  `pj_instructions` varchar(100) NOT NULL,
  `pj_customner` varchar(100) NOT NULL,
  `pj_process_start` datetime NOT NULL,
  `pj_process_deadline` datetime NOT NULL,
  `pj_dayofwork` varchar(50) NOT NULL,
  `color` varchar(10) NOT NULL,
  `pj_user_ceate` int(3) NOT NULL,
  `pj_complete` int(3) NOT NULL,
  `pj_status` varchar(1) NOT NULL,
  PRIMARY KEY (`pj_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=82 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`pj_id`, `tp_id`, `pj_process_title`, `pj_instructions`, `pj_customner`, `pj_process_start`, `pj_process_deadline`, `pj_dayofwork`, `color`, `pj_user_ceate`, `pj_complete`, `pj_status`) VALUES
(81, 0, 'ทดสอบ', '0', 'mike', '2019-09-12 00:00:00', '2019-09-28 00:00:00', '16', '#000000', 7, 0, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `project_assign_user`
--

CREATE TABLE IF NOT EXISTS `project_assign_user` (
  `pau_id` int(3) NOT NULL AUTO_INCREMENT,
  `pjt_id` int(3) NOT NULL,
  `acc_id` int(3) NOT NULL,
  `pau_reply` int(1) NOT NULL,
  `pau_status` varchar(1) NOT NULL,
  PRIMARY KEY (`pau_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `project_assign_user`
--

INSERT INTO `project_assign_user` (`pau_id`, `pjt_id`, `acc_id`, `pau_reply`, `pau_status`) VALUES
(10, 270, 2, 1, 'N'),
(11, 270, 5, 1, 'N'),
(12, 270, 6, 1, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `project_main_assign_user`
--

CREATE TABLE IF NOT EXISTS `project_main_assign_user` (
  `pmau_id` int(3) NOT NULL AUTO_INCREMENT,
  `pj_id` int(3) NOT NULL,
  `acc_id` int(3) NOT NULL,
  `pmau_status` varchar(1) NOT NULL,
  PRIMARY KEY (`pmau_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=96 ;

--
-- Dumping data for table `project_main_assign_user`
--

INSERT INTO `project_main_assign_user` (`pmau_id`, `pj_id`, `acc_id`, `pmau_status`) VALUES
(93, 81, 2, 'N'),
(94, 81, 5, 'N'),
(95, 81, 6, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `project_task`
--

CREATE TABLE IF NOT EXISTS `project_task` (
  `pjt_id` int(3) NOT NULL AUTO_INCREMENT,
  `pj_id` int(3) NOT NULL,
  `pt_id` int(1) NOT NULL,
  `tdf_id` int(3) NOT NULL,
  `pjt_title` varchar(50) NOT NULL,
  `pjt_description` varchar(200) NOT NULL,
  `pjt_colorstatus` varchar(10) NOT NULL,
  `pjt_complete` int(3) NOT NULL,
  `pjt_starteddate` datetime NOT NULL,
  `pjt_duedate` datetime NOT NULL,
  `pjt_dayofwork` varchar(50) NOT NULL,
  `pjt_status` varchar(1) NOT NULL,
  PRIMARY KEY (`pjt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=275 ;

--
-- Dumping data for table `project_task`
--

INSERT INTO `project_task` (`pjt_id`, `pj_id`, `pt_id`, `tdf_id`, `pjt_title`, `pjt_description`, `pjt_colorstatus`, `pjt_complete`, `pjt_starteddate`, `pjt_duedate`, `pjt_dayofwork`, `pjt_status`) VALUES
(270, 81, 1, 1, 'Casting Talent', 'ffff', '#28a745', 2, '2019-09-12 00:00:00', '2019-09-19 00:00:00', '7', 'N'),
(271, 81, 1, 3, 'Storyline writing', 'dfdf', '#f75f5f', 0, '2019-09-12 00:00:00', '2019-09-27 00:00:00', '15', 'N'),
(272, 81, 1, 4, 'Storyboard', 'sss', '#f75f5f', 0, '2019-09-12 00:00:00', '2019-09-28 00:00:00', '16', 'N'),
(273, 81, 2, 8, 'Director', 'dfdsf', '#f75f5f', 0, '2019-09-12 00:00:00', '2019-09-27 00:00:00', '15', 'N'),
(274, 81, 2, 10, 'producer', 'rterter', '#f75f5f', 0, '2019-09-12 00:00:00', '2019-09-21 00:00:00', '9', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `task_detail_fixed`
--

CREATE TABLE IF NOT EXISTS `task_detail_fixed` (
  `tdf_id` int(3) NOT NULL AUTO_INCREMENT,
  `pt_id` int(1) NOT NULL,
  `tdf_name` varchar(100) NOT NULL,
  `tdf_element` varchar(100) NOT NULL,
  PRIMARY KEY (`tdf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `task_detail_fixed`
--

INSERT INTO `task_detail_fixed` (`tdf_id`, `pt_id`, `tdf_name`, `tdf_element`) VALUES
(1, 1, 'Casting Talent', 'Casting_Talent'),
(2, 1, 'Location Survey Cost', 'Location_Survey_Cost'),
(3, 1, 'Storyline writing', 'Storyline_writing'),
(4, 1, 'Storyboard', 'Storyboard'),
(5, 1, 'Script', 'Script'),
(6, 2, 'Camera operator', 'Camera_operator'),
(7, 2, 'Assistance camera operator', 'Assistance_camera_operator'),
(8, 2, 'Director', 'Director'),
(9, 2, 'Assistance Director', 'Assistance_Director'),
(10, 2, 'producer', 'producer'),
(11, 2, 'staff', 'staff'),
(12, 2, 'Gear', 'Gear'),
(13, 3, 'Editing', 'Editing'),
(14, 3, 'Text Info', 'Text_Info'),
(15, 3, 'Song', 'Song');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_account`
--
CREATE TABLE IF NOT EXISTS `vw_account` (
`acc_permission` int(11)
,`permission_name` varchar(50)
,`acc_id` int(4)
,`acc_username` varchar(200)
,`acc_email` varchar(200)
,`acc_name` varchar(200)
,`acc_lastname` varchar(50)
,`acc_status` int(3)
,`acc_img` varchar(200)
);
-- --------------------------------------------------------

--
-- Table structure for table `vw_assign_taskname`
--

CREATE TABLE IF NOT EXISTS `vw_assign_taskname` (
  `acc_id` int(3) DEFAULT NULL,
  `pjt_id` int(3) DEFAULT NULL,
  `pjt_title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pjt_starteddate` datetime DEFAULT NULL,
  `pjt_duedate` datetime DEFAULT NULL,
  `pjt_status` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pj_id` int(3) DEFAULT NULL,
  `color` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pau_status` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vw_for_search`
--

CREATE TABLE IF NOT EXISTS `vw_for_search` (
  `pj_id` int(3) DEFAULT NULL,
  `pjt_id` int(3) DEFAULT NULL,
  `pj_process_title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pjt_title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pj_status` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pj_complete` int(3) DEFAULT NULL,
  `pjt_complete` int(3) DEFAULT NULL,
  `acc_id` int(3) DEFAULT NULL,
  `pau_status` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pjt_starteddate` datetime DEFAULT NULL,
  `pjt_duedate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vw_project`
--

CREATE TABLE IF NOT EXISTS `vw_project` (
  `acc_id` int(4) DEFAULT NULL,
  `acc_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `acc_lastname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pjt_id` int(3) DEFAULT NULL,
  `pj_id` int(3) DEFAULT NULL,
  `pau_status` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure for view `vw_account`
--
DROP TABLE IF EXISTS `vw_account`;

CREATE ALGORITHM=UNDEFINED DEFINER=`buzzbkkc`@`localhost` SQL SECURITY DEFINER VIEW `vw_account` AS select `account`.`acc_permission` AS `acc_permission`,`permission`.`permission_name` AS `permission_name`,`account`.`acc_id` AS `acc_id`,`account`.`acc_username` AS `acc_username`,`account`.`acc_email` AS `acc_email`,`account`.`acc_name` AS `acc_name`,`account`.`acc_lastname` AS `acc_lastname`,`account`.`acc_status` AS `acc_status`,`account`.`acc_img` AS `acc_img` from (`account` left join `permission` on((`permission`.`id` = `account`.`acc_permission`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
