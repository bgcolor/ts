-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-05-25 02:48:46
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
-- 表的结构 `authority`
--

CREATE TABLE IF NOT EXISTS `authority` (
  `id` varchar(45) NOT NULL,
  `role` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统权限表，id的键值与views层变量对应，role为角色身份。用户角色,1->学徒,2->评估师,3->内审员,4->外审员,5->系统管理员';

--
-- 转存表中的数据 `authority`
--

INSERT INTO `authority` (`id`, `role`, `description`) VALUES
('all_users', 5, '用户一览'),
('change_others_pass', 5, '修改其他账号密码'),
('change_pass', 1, '修改本账号密码'),
('change_pass', 2, '修改本账号密码'),
('change_pass', 3, '修改本账号密码'),
('change_pass', 4, '修改本账号密码'),
('change_pass', 5, '修改本账号密码'),
('check_all_files', 5, '查看所有文件'),
('check_others_files', 3, '查看项目内他人文件'),
('check_others_files', 4, '查看项目内他人文件'),
('create_project', 5, '添加项目'),
('create_user', 5, '添加用户'),
('delete_users', 5, '删除用户'),
('downloads_delete', 5, '我的下载页面删除'),
('downloads_download', 1, '我的下载页面下载按钮'),
('downloads_download', 2, '我的下载页面下载按钮'),
('downloads_download', 3, '我的下载页面下载按钮'),
('downloads_download', 5, '我的下载页面下载按钮'),
('evaluate_others', 3, '评审他人'),
('evaluate_others', 5, '评审他人'),
('manage_files', 5, '显示上传下载管理'),
('my_download', 1, '查看我的下载'),
('my_download', 2, '查看我的下载'),
('my_download', 3, '查看我的下载'),
('my_profile', 1, '查看我的信息'),
('my_profile', 2, '查看我的信息'),
('my_profile', 3, '查看我的信息'),
('my_profile', 4, '查看我的信息'),
('my_profile', 5, '查看我的信息'),
('my_progress', 1, '显示我的进度'),
('my_progress', 2, '显示我的进度'),
('my_student', 2, '查看我的学徒'),
('my_student', 3, '查看我的学徒'),
('my_tutor', 1, '查看我的导师'),
('my_tutor', 2, '查看我的导师'),
('my_upload', 1, '查看我的上传'),
('my_upload', 2, '查看我的上传'),
('my_upload', 3, '查看我的上传'),
('project_files', 3, '查看项目上传下载一览'),
('project_files', 4, '查看项目上传下载一览'),
('project_users', 3, '项目用户一览'),
('project_users', 4, '项目用户一览');

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
('change_pass_title', '修改密码'),
('default_password', 'qwe123'),
('download_title', '我的下载'),
('evaluate_title', '评审'),
('list_title', '用户列表'),
('login_title', '登录'),
('no_downloads', '暂无资料下载'),
('no_evaluation', '评审员还未评审'),
('no_students', '暂无学徒'),
('no_tutors', '暂无导师'),
('no_uploads', '您还未上传资料'),
('photo_remark1', '为了更好低让系统显示，上传头像的长宽比应为1:1，大小不得超过xxx(支持png,gif,jpeg,jpg)'),
('photo_remark2', '请选择要上传的文件'),
('post_max_size', '8388608'),
('powered_by', ' 2015 物流管理培训系统 备案号:xxxx'),
('profile_title', '我的信息'),
('project_title', '添加项目'),
('public_msg', '如对系统使用有疑问请咨询系统管理员，联系方式：xxx@xx.com'),
('system_sub_title', '管理平台'),
('system_title', '物流管理培训系统'),
('upload_title', '我的上传'),
('user_title', '添加用户');

-- --------------------------------------------------------

--
-- 表的结构 `download`
--

CREATE TABLE IF NOT EXISTS `download` (
  `id` int(11) NOT NULL COMMENT '下载记录id',
  `file_id` int(11) NOT NULL COMMENT '文件id',
  `downloader_id` int(11) NOT NULL COMMENT '下载者id',
  `downloader_name` varchar(45) NOT NULL COMMENT '下载者姓名',
  `pathname` varchar(255) NOT NULL COMMENT '文件路径名',
  `filename` varchar(255) NOT NULL COMMENT '文件名',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间（无实际意义）',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '下载时间',
  `owner_id` int(11) NOT NULL,
  `owner_name` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COMMENT='下载记录表';

--
-- 转存表中的数据 `download`
--

INSERT INTO `download` (`id`, `file_id`, `downloader_id`, `downloader_name`, `pathname`, `filename`, `updated_at`, `created_at`, `owner_id`, `owner_name`) VALUES
(13, 29, 4, '评估师A', 'uploads/tutor/Thunder-Download-Extension-for-Chrome_v3.1.crx', 'Thunder-Download-Extension-for-Chrome_v3.1.crx', '2015-05-23 02:44:44', '2015-05-23 02:44:44', 4, '评估师A'),
(15, 29, 1, '系统管理员', 'uploads/tutor/Thunder-Download-Extension-for-Chrome_v3.1.crx', 'Thunder-Download-Extension-for-Chrome_v3.1.crx', '2015-05-23 02:44:44', '2015-05-23 02:44:44', 4, '评估师A'),
(18, 32, 1, '系统管理员A', 'uploads/st/7b16c243dcbac457bef2f0fba710f14b.jpg', '7b16c243dcbac457bef2f0fba710f14b.jpg', '2015-05-23 08:34:29', '2015-05-23 04:44:36', 5, '学徒A'),
(22, 23, 1, '系统管理员A', 'uploads/tutor/Shadowsocks-win-2.3.1.zip', 'Shadowsocks-win-2.3.1.zip', '2015-05-23 06:21:41', '2015-05-23 06:21:41', 4, '评估师A'),
(23, 25, 1, '系统管理员A', 'uploads/tutor/goagent-3.0.zip', 'goagent-3.0.zip', '2015-05-23 07:25:53', '2015-05-23 07:25:53', 4, '评估师A'),
(44, 29, 5, '学徒A', 'uploads/tutor/Thunder-Download-Extension-for-Chrome_v3.1.crx', 'Thunder-Download-Extension-for-Chrome_v3.1.crx', '2015-05-24 07:25:33', '2015-05-24 07:25:33', 4, '评估师A'),
(45, 32, 5, '学徒A', 'uploads/st/7b16c243dcbac457bef2f0fba710f14b.jpg', '7b16c243dcbac457bef2f0fba710f14b.jpg', '2015-05-24 11:54:00', '2015-05-24 11:00:40', 5, '学徒A');

-- --------------------------------------------------------

--
-- 表的结构 `evaluation`
--

CREATE TABLE IF NOT EXISTS `evaluation` (
  `user_id` int(11) NOT NULL COMMENT '被评审人id',
  `evaluator_id` int(11) NOT NULL COMMENT '评审人id',
  `evaluator_name` varchar(45) NOT NULL COMMENT '评审人姓名',
  `progress` int(11) NOT NULL COMMENT '进度百分数',
  `description` varchar(255) DEFAULT NULL COMMENT '评审描述',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评审表';

--
-- 转存表中的数据 `evaluation`
--

INSERT INTO `evaluation` (`user_id`, `evaluator_id`, `evaluator_name`, `progress`, `description`, `created_at`, `updated_at`) VALUES
(4, 3, '内审员A', 60, '明明还可以', '2015-05-24 18:16:35', '2015-05-24 18:16:35'),
(5, 3, '内审员A', 80, '完成了80%的学习情况', '2015-05-20 03:31:24', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='上传文件表';

--
-- 转存表中的数据 `file`
--

INSERT INTO `file` (`id`, `pathname`, `filename`, `user_id`, `created_at`, `updated_at`) VALUES
(23, 'uploads/tutor/Shadowsocks-win-2.3.1.zip', 'Shadowsocks-win-2.3.1.zip', 4, '2015-05-22 16:18:00', '2015-05-22 16:18:00'),
(25, 'uploads/tutor/goagent-3.0.zip', 'goagent-3.0.zip', 4, '2015-05-22 16:40:16', '2015-05-22 16:40:16'),
(29, 'uploads/tutor/Thunder-Download-Extension-for-Chrome_v3.1.crx', 'Thunder-Download-Extension-for-Chrome_v3.1.crx', 4, '2015-05-22 17:30:23', '2015-05-22 17:30:23'),
(32, 'uploads/st/7b16c243dcbac457bef2f0fba710f14b.jpg', '7b16c243dcbac457bef2f0fba710f14b.jpg', 5, '2015-05-23 02:45:50', '2015-05-23 02:45:50'),
(35, 'uploads/tutor2/thunder(129236).exe', 'thunder(129236).exe', 9, '2015-05-24 21:06:57', '2015-05-24 21:06:57'),
(36, 'uploads/tutor2/httpd-2.2.25-win32-x86-openssl-0.9.8y.msi', 'httpd-2.2.25-win32-x86-openssl-0.9.8y.msi', 9, '2015-05-24 21:07:10', '2015-05-24 21:07:10');

-- --------------------------------------------------------

--
-- 表的结构 `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL COMMENT '项目id',
  `name` varchar(45) NOT NULL COMMENT '项目名称',
  `description` varchar(255) DEFAULT NULL COMMENT '项目描述',
  `creator_id` int(11) DEFAULT NULL COMMENT '创建者id',
  `creator_name` varchar(45) DEFAULT NULL COMMENT '创建者姓名',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='项目表';

--
-- 转存表中的数据 `project`
--

INSERT INTO `project` (`id`, `name`, `description`, `creator_id`, `creator_name`, `created_at`, `updated_at`) VALUES
(1, '项目一', '项目一描述', 1, '系统管理员', '2015-05-17 03:02:03', '2015-05-17 03:02:03'),
(2, '项目二', '项目二的描述balabala', 1, '系统管理员A', '2015-05-24 06:38:28', '2015-05-24 06:38:28'),
(4, '天涯海角', '天涯海角', 1, '系统管理员A', '2015-05-24 14:33:54', '2015-05-24 14:33:54');

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
('0001', '没有相关权限！'),
('0002', '非法传参'),
('1000', '不正确的参数'),
('1001', '必须指定学徒的导师！'),
('1002', '选择系统中已存在的导师！'),
('1003', '用户名已存在！'),
('1004', '您已成功添加用户！'),
('1005', '用户名密码为空！'),
('1006', '用户不存在！'),
('1007', '用户名或密码错误！'),
('1008', '您已登录成功！'),
('1009', '请选择已存在的项目！'),
('1010', '旧密码错误，请重新输入'),
('1011', '信息修改成功！'),
('1012', '修改密码失败！'),
('1013', '修改密码成功！'),
('1014', '添加用户失败！'),
('1015', '学徒导师不在同一项目！'),
('1016', '用户操作失败！'),
('1017', '确认删除用户吗？（请确认此人无学徒，否则会产生异常）'),
('1018', '确认重置其密码？'),
('1019', '您已成功删除用户！'),
('2000', '上传文件参数错误'),
('2001', '上传文件大小超过限制！'),
('2002', '文件上传成功！'),
('2003', '没有文件上传！'),
('2004', '文件已存在！'),
('2005', '还未上传头像！'),
('2006', '文件删除失败'),
('2007', '您已成功删除文件！'),
('2008', '您确定要删除吗？'),
('3000', '不正确的参数'),
('3001', '您已成功添加项目！'),
('3002', '项目添加失败！'),
('3003', '存在同名项目！'),
('4000', '不正确的参数'),
('4001', '没有评审权限！'),
('4002', '您已评审成功！'),
('4003', '评审失败！'),
('503', 'Internal Server Error'),
('6000', '下载文件参数错误！'),
('6001', '没有找到要下载的文件！'),
('7000', '缺少参数');

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  `photo_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='用户表,系统中以role区分角色';

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `project_id`, `name`, `email`, `phone_no`, `tutor_id`, `tutor_name`, `created_at`, `updated_at`, `photo_url`) VALUES
(1, 'admin', '$2y$10$dczjDtsrzBWyohL/yC23SudPhgZLHyJPEukaqnm7fzME1GsZqoN5i', 5, NULL, '系统管理员A', 'admin@ts.com', '13888667755', NULL, NULL, '2015-05-25 02:41:49', '2015-05-25 02:41:49', 'http://localhost/ts/public/uploads/admin/4eda13211c63132675c7af06481a284e.jpg'),
(2, 'eauditor', '$2y$10$RJWyzjauANVkZUUi7Pj3y.otrs5XpNI.b8tr91.vem30B4a3mcYqW', 4, 1, '外审员A', NULL, NULL, NULL, NULL, '2015-05-24 20:38:59', '2015-05-24 20:38:59', NULL),
(3, 'iauditor', '$2y$10$KLSt6I/6GkmvDSgJz/NZnuue/EVVFiqSxSYdijOqkasPN2rqF.I8u', 3, 1, '内审员A', NULL, NULL, NULL, NULL, '2015-05-25 02:44:29', '2015-05-25 02:44:29', 'http://localhost/ts/public/uploads/iauditor/18843eeacba2c79edf5d3c9d9b5a3fdc.jpeg'),
(4, 'tutor', '$2y$10$xDa0Fhcg2vJvtdkJfBiriuAWkIsRCiHd8Q4sa.ex2ZwX9nFnYe.Me', 2, 1, '评估师A', '', '13889898989', 3, '内审员A', '2015-05-25 02:46:23', '2015-05-25 02:46:23', 'http://localhost/ts/public/uploads/tutor/835063b69e6fe032afde769cee704b25.jpg'),
(5, 'st', '$2y$10$f1RP1/ieAS/fHyMhDysMceE6MXDYQUcGhor1LYmwUV3BEM31w.FSC', 1, 1, '学徒A', NULL, NULL, 4, '评估师A', '2015-05-24 20:30:08', '2015-05-24 20:30:08', 'http://localhost/ts/public/uploads/st/7e4d4bb9ff104589fe135988d4f8060a.jpg'),
(6, 'tutorB', '$2y$10$MkONrBHE2.MRS/99oLtfQePjE3idnCwSYHXRUTxje9Uz612UAhPjm', 1, 1, '导师B', NULL, NULL, 3, '内审员A', '2015-05-12 07:23:32', '2015-05-12 07:23:32', NULL),
(7, 'admin2', '$2y$10$tUns2S5SuW9ulH3JCJxyz.QloP7X3ZANhoRtFjUQzNBJHxUAuxRDW', 5, NULL, 'bg', '', '', NULL, NULL, '2015-05-24 22:04:43', '2015-05-24 22:04:43', NULL),
(8, 'st2', '$2y$10$l5Sa1xXQz3g/QWfkKCj8..6C/FS/qzdxFuCKAR6zyes/gX.ugiXBe', 1, 1, '学徒B', 'st2@ts.com', '1387976', 4, '评估师A', '2015-05-24 21:07:29', '2015-05-24 21:07:29', NULL),
(9, 'tutor2', '$2y$10$P5IhkgRgcBa5c2h3u/l60O2eW461hWX8LnVf8SmCuWIrC.lKBhv3y', 2, 1, '评估师B', '', '', 3, '内审员A', '2015-05-24 21:06:17', '2015-05-24 21:06:17', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authority`
--
ALTER TABLE `authority`
  ADD PRIMARY KEY (`id`,`role`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '下载记录id',AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文件id',AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '项目id',AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
