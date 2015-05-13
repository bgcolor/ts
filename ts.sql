-- phpMyAdmin SQL Dump
-- version 4.4.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-05-13 09:09:14
-- 服务器版本： 5.6.24-log
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ts`
--

-- --------------------------------------------------------

--
-- 表的结构 `constant_string`
--

CREATE TABLE IF NOT EXISTS `constant_string` (
  `id` varchar(45) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `constant_string`
--

INSERT INTO `constant_string` (`id`, `value`) VALUES
('login_title', '登录'),
('powered_by', '@ 2015 物流管理培训系统 备案号:xxxx'),
('system_sub_title', '管理平台'),
('system_title', '物流管理培训系统');

-- --------------------------------------------------------

--
-- 表的结构 `download`
--

CREATE TABLE IF NOT EXISTS `download` (
  `id` int(11) NOT NULL COMMENT '下载记录id',
  `file_id` int(11) NOT NULL COMMENT '文件id',
  `owner_id` int(11) NOT NULL COMMENT '上传者id',
  `owner_name` varchar(45) NOT NULL COMMENT '上传者姓名',
  `downloader_id` int(11) NOT NULL COMMENT '下载者id',
  `downloader_name` varchar(45) NOT NULL COMMENT '下载者姓名',
  `pathname` varchar(255) NOT NULL COMMENT '文件路径名',
  `filename` varchar(255) NOT NULL COMMENT '文件名',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间（无实际意义）',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '下载时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='下载记录表';

-- --------------------------------------------------------

--
-- 表的结构 `evaluation`
--

CREATE TABLE IF NOT EXISTS `evaluation` (
  `user_id` int(11) NOT NULL COMMENT '被评审人id',
  `evaluator_id` int(11) NOT NULL COMMENT '评审人id',
  `evaluator_name` varchar(45) NOT NULL COMMENT '评审人姓名',
  `progress` int(11) NOT NULL COMMENT '进度百分数',
  `description` varchar(255) DEFAULT NULL COMMENT '评审描述'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评审表';

-- --------------------------------------------------------

--
-- 表的结构 `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL COMMENT '文件id',
  `pathname` varchar(255) NOT NULL COMMENT '文件路径名',
  `filename` varchar(255) NOT NULL COMMENT '文件名',
  `user_id` int(11) NOT NULL COMMENT '上传文件的用户id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '上传时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间(无意义,框架需要)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='上传文件表';

-- --------------------------------------------------------

--
-- 表的结构 `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL COMMENT '项目id',
  `name` varchar(45) NOT NULL COMMENT '项目名称',
  `description` varchar(255) DEFAULT NULL COMMENT '项目描述',
  `creator_id` int(11) DEFAULT NULL COMMENT '创建者id',
  `creator_name` varchar(45) DEFAULT NULL COMMENT '创建者姓名'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='项目表';

--
-- 转存表中的数据 `project`
--

INSERT INTO `project` (`id`, `name`, `description`, `creator_id`, `creator_name`) VALUES
(1, '项目一', '项目一描述', 1, '系统管理员');

-- --------------------------------------------------------

--
-- 表的结构 `status_info`
--

CREATE TABLE IF NOT EXISTS `status_info` (
  `status_code` varchar(4) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `status_info`
--

INSERT INTO `status_info` (`status_code`, `description`) VALUES
('1000', '不正确的参数'),
('1001', '必须指定学徒的导师'),
('1002', '选择系统中已存在的导师'),
('1003', '用户名已存在'),
('1004', '您已成功添加用户'),
('1005', '用户名密码为空'),
('1006', '用户不存在'),
('1007', '用户名或密码错误'),
('1008', '您已登录成功！'),
('1009', '请选择已存在的项目'),
('2001', '上传文件大小超过限制'),
('2002', '文件上传成功'),
('3000', '不正确的参数'),
('3001', '您已成功添加项目'),
('503', 'Internal Server Error');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL COMMENT '用户id',
  `username` varchar(45) NOT NULL COMMENT '用户账号',
  `password` varchar(255) NOT NULL COMMENT '用户密码',
  `role` int(11) NOT NULL COMMENT '用户角色,1->学徒,2->评估师,3->内审员,4->外审员,5->系统管理员',
  `project_id` int(11) DEFAULT NULL COMMENT '项目id',
  `name` varchar(45) NOT NULL COMMENT '用户姓名',
  `email` varchar(255) DEFAULT NULL COMMENT '用户邮箱',
  `phone_no` varchar(45) DEFAULT NULL COMMENT '用户电话号码',
  `tutor_id` int(11) DEFAULT NULL COMMENT '导师id',
  `tutor_name` varchar(45) DEFAULT NULL COMMENT '导师姓名',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  `photo_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用户表,系统中以role区分角色';

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `project_id`, `name`, `email`, `phone_no`, `tutor_id`, `tutor_name`, `created_at`, `updated_at`, `photo_url`) VALUES
(1, 'admin', '$2y$10$GbWC3DvvdzPM1z8FdjYj3u76vBgH.98qOnDJKcQYYAJrvo9KMk4lG', 5, NULL, '系统管理员', NULL, NULL, NULL, NULL, '2015-05-08 07:07:44', '2015-05-08 07:07:44', NULL),
(2, 'eauditor', '$2y$10$RJWyzjauANVkZUUi7Pj3y.otrs5XpNI.b8tr91.vem30B4a3mcYqW', 4, 1, '外审员A', NULL, NULL, NULL, NULL, '2015-05-12 07:17:32', '2015-05-12 07:17:32', NULL),
(3, 'iauditor', '$2y$10$KLSt6I/6GkmvDSgJz/NZnuue/EVVFiqSxSYdijOqkasPN2rqF.I8u', 3, 1, '内审员A', NULL, NULL, NULL, NULL, '2015-05-12 07:18:02', '2015-05-12 07:18:02', NULL),
(4, 'tutor', '$2y$10$UQHaGsU4ON3QXsJyn.mmfOEWMstaGRKBG/AsK.Sp8T0Y3NtJ7E7ba', 2, 1, '评估师A', NULL, NULL, 3, '内审员A', '2015-05-12 07:19:02', '2015-05-12 07:19:02', NULL),
(5, 'st', '$2y$10$f1RP1/ieAS/fHyMhDysMceE6MXDYQUcGhor1LYmwUV3BEM31w.FSC', 1, 1, '学徒A', NULL, NULL, 4, '评估师A', '2015-05-12 07:22:46', '2015-05-13 05:25:10', NULL),
(6, 'tutorB', '$2y$10$MkONrBHE2.MRS/99oLtfQePjE3idnCwSYHXRUTxje9Uz612UAhPjm', 1, 1, '导师B', NULL, NULL, 3, '内审员A', '2015-05-12 07:23:32', '2015-05-12 07:23:32', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `constant_string`
--
ALTER TABLE `constant_string`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_info`
--
ALTER TABLE `status_info`
  ADD PRIMARY KEY (`status_code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `download`
--
ALTER TABLE `download`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '下载记录id';
--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文件id';
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '项目id',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
