/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : dares

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-11-09 13:20:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `academy_structre_subject`
-- ----------------------------
DROP TABLE IF EXISTS `academy_structre_subject`;
CREATE TABLE `academy_structre_subject` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_name` varchar(255) DEFAULT NULL,
  `sub_term_id` int(11) DEFAULT NULL,
  `sub_hour` tinyint(4) DEFAULT NULL,
  `sub_code` varchar(25) DEFAULT NULL,
  `sub_description` text,
  `sub_type` tinyint(4) DEFAULT NULL,
  `sub_created_by` int(11) DEFAULT NULL,
  `sub_created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of academy_structre_subject
-- ----------------------------
INSERT INTO `academy_structre_subject` VALUES ('1', 'sub1', '1', '2', 'ew34t', 'dfsfgdg\r\ndfhgdghs', '2', null, '2015-10-28 13:27:26');
INSERT INTO `academy_structre_subject` VALUES ('2', 'esrwer', '1', '0', 'wrewr4', 'rewtfrva\r\nsgfas', '1', '1', '2015-10-28 13:29:19');

-- ----------------------------
-- Table structure for `academy_structure_department`
-- ----------------------------
DROP TABLE IF EXISTS `academy_structure_department`;
CREATE TABLE `academy_structure_department` (
  `dep_id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_name` varchar(255) DEFAULT NULL,
  `dep_term_id` tinyint(4) DEFAULT NULL,
  `dep_created_by` int(11) DEFAULT NULL,
  `dep_created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`dep_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of academy_structure_department
-- ----------------------------
INSERT INTO `academy_structure_department` VALUES ('1', 'dep4', '1', null, '2015-10-28 12:44:50');
INSERT INTO `academy_structure_department` VALUES ('2', 'dep9', '1', '1', '2015-10-28 12:45:39');

-- ----------------------------
-- Table structure for `academy_structure_dep_sub`
-- ----------------------------
DROP TABLE IF EXISTS `academy_structure_dep_sub`;
CREATE TABLE `academy_structure_dep_sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_id` int(11) DEFAULT NULL,
  `sub_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of academy_structure_dep_sub
-- ----------------------------

-- ----------------------------
-- Table structure for `academy_structure_faculty`
-- ----------------------------
DROP TABLE IF EXISTS `academy_structure_faculty`;
CREATE TABLE `academy_structure_faculty` (
  `faculty_id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_name` varchar(255) DEFAULT NULL,
  `faculty_created_by` int(11) DEFAULT NULL,
  `faculty_created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of academy_structure_faculty
-- ----------------------------
INSERT INTO `academy_structure_faculty` VALUES ('1', 'ÙƒÙ„ÙŠØ© Ø§Ù„Ø¹Ù„ÙˆÙ… Ø§Ù„Ø´Ø±Ø¹ÙŠØ©', '1', '2015-10-28 11:54:13');

-- ----------------------------
-- Table structure for `academy_structure_term`
-- ----------------------------
DROP TABLE IF EXISTS `academy_structure_term`;
CREATE TABLE `academy_structure_term` (
  `term_id` int(11) NOT NULL AUTO_INCREMENT,
  `term_name` varchar(255) DEFAULT NULL,
  `term_year_id` int(11) DEFAULT NULL,
  `term_created_by` int(11) DEFAULT NULL,
  `term_created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`term_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of academy_structure_term
-- ----------------------------
INSERT INTO `academy_structure_term` VALUES ('1', 'one', '1', '1', '2015-10-28 12:26:04');
INSERT INTO `academy_structure_term` VALUES ('2', 'three', '1', '1', '2015-10-28 12:26:07');

-- ----------------------------
-- Table structure for `academy_structure_year`
-- ----------------------------
DROP TABLE IF EXISTS `academy_structure_year`;
CREATE TABLE `academy_structure_year` (
  `year_id` int(11) NOT NULL AUTO_INCREMENT,
  `year_name` varchar(255) DEFAULT NULL,
  `year_faculty_id` tinyint(4) DEFAULT NULL,
  `year_created_by` int(11) DEFAULT NULL,
  `year_created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`year_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of academy_structure_year
-- ----------------------------
INSERT INTO `academy_structure_year` VALUES ('1', 'year one', '1', '1', '2015-10-28 12:07:59');
INSERT INTO `academy_structure_year` VALUES ('2', 'year twohree', '1', '1', '2015-10-28 12:15:03');

-- ----------------------------
-- Table structure for `sys_permission`
-- ----------------------------
DROP TABLE IF EXISTS `sys_permission`;
CREATE TABLE `sys_permission` (
  `prem_id` int(11) NOT NULL AUTO_INCREMENT,
  `prem_name` varchar(255) DEFAULT NULL,
  `prem_url` varchar(255) DEFAULT NULL,
  `prem_categ_id` tinyint(4) DEFAULT NULL,
  `prem_role_ids` varchar(255) DEFAULT NULL,
  `prem_created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `prem_created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`prem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_permission
-- ----------------------------
INSERT INTO `sys_permission` VALUES ('1', 'Ø§Ù„Ø±Ø¯ Ø¹Ù„Ù‰ Ø´ÙƒÙˆÙ‰', '/dares/sys/roles.php', '2', '5,4,1,2,3', '2015-10-27 09:23:27', null);
INSERT INTO `sys_permission` VALUES ('2', 'users', '/dares/sys/users.php', '2', '1,2,3,4', '2015-10-27 09:23:23', null);
INSERT INTO `sys_permission` VALUES ('3', 'yyyy', '/dares/sys/permission.php', '2', '1,2,3,4', '2015-10-27 10:27:39', null);
INSERT INTO `sys_permission` VALUES ('4', 'Ø«ØµÙ‚Ù‚', '/dares/sys/prem_categ.php', '1', '1', '2015-10-27 10:46:36', '1');
INSERT INTO `sys_permission` VALUES ('6', 'gfsdgdfgfd', '/dares/admin/academy_structure/faculty.php', '1', '1,3,6', '2015-10-28 11:53:43', '1');
INSERT INTO `sys_permission` VALUES ('7', 'year', '/dares/admin/academy_structure/year.php', '1', '1,3,6', '2015-10-28 12:07:02', '1');
INSERT INTO `sys_permission` VALUES ('8', 'term', '/dares/admin/academy_structure/term.php', '1', '1,3,6', '2015-10-28 12:25:09', '1');
INSERT INTO `sys_permission` VALUES ('9', 'subject', '/dares/admin/academy_structure/subject.php', '2', '1,3,6', '2015-10-28 13:29:02', '1');

-- ----------------------------
-- Table structure for `sys_permission_category`
-- ----------------------------
DROP TABLE IF EXISTS `sys_permission_category`;
CREATE TABLE `sys_permission_category` (
  `categ_id` int(11) NOT NULL AUTO_INCREMENT,
  `categ_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`categ_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_permission_category
-- ----------------------------
INSERT INTO `sys_permission_category` VALUES ('1', 'Ø§Ù„Ù…Ø§Ù„ÙŠÙ‡');
INSERT INTO `sys_permission_category` VALUES ('2', 'Ø§Ù„Ø´ÙƒØ§ÙˆÙ‰');
INSERT INTO `sys_permission_category` VALUES ('3', 'Ø§Ù„Ø¯Ø¹Ù… Ø§Ù„ÙÙ†Ù‰');
INSERT INTO `sys_permission_category` VALUES ('4', 'Ø§Ù„Ù‚Ø¨ÙˆÙ„ ÙˆØ§Ù„ØªØ³Ø¬ÙŠÙ„');

-- ----------------------------
-- Table structure for `sys_role`
-- ----------------------------
DROP TABLE IF EXISTS `sys_role`;
CREATE TABLE `sys_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) DEFAULT NULL,
  `role_created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role_created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_role
-- ----------------------------
INSERT INTO `sys_role` VALUES ('1', 'Ø§Ù„Ø¯Ø¹Ù… ', '2015-10-26 11:18:51', null);
INSERT INTO `sys_role` VALUES ('3', 'Ø§Ù„ØªØµÙ…ÙŠÙ… Ø§Ù„ØªØ¹Ù„ÙŠÙ…ÙŠ', '2015-10-26 12:52:11', '1');
INSERT INTO `sys_role` VALUES ('6', 'Ø§Ù„Ù‚Ø¨ÙˆÙ„', '2015-10-27 10:43:48', '1');

-- ----------------------------
-- Table structure for `sys_users`
-- ----------------------------
DROP TABLE IF EXISTS `sys_users`;
CREATE TABLE `sys_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `user_pwd` varchar(255) DEFAULT NULL,
  `user_role_ids` varchar(255) DEFAULT NULL,
  `user_fullname` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_mobile` varchar(15) DEFAULT NULL,
  `user_photo` varchar(255) DEFAULT NULL,
  `user_state` tinyint(1) DEFAULT '1' COMMENT '1=active,0=notactive',
  `user_last_login` datetime DEFAULT NULL,
  `user_created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_users
-- ----------------------------
INSERT INTO `sys_users` VALUES ('1', 'sami', '123456', '1,2', 'Ø³Ø§Ù…ÙŠ Ø§Ù„Ù…Ø¹Ù…Ø±ÙŠ', 'sami@gmail.com', '96663254', 'sdasd.jpg', '1', null, '2015-10-26 12:45:58', null);
INSERT INTO `sys_users` VALUES ('2', 'ahmed', '123', '1,2', 'Ø§Ø­Ù…Ø¯ Ø§Ù„ÙƒØ¯Ù†Ø¯Ù‰', 'ahmed@yahoo.com', '123456789', '111.png', '1', null, '2015-10-26 11:43:09', null);
INSERT INTO `sys_users` VALUES ('3', 'hithm', 'dd458505749b2941217ddd59394240e8', ',1', 'Ù‡ÙŠØ«Ù… Ø­Ù…Ø¯ÙŠ', '111', null, null, '0', null, '2015-10-26 12:04:36', null);
INSERT INTO `sys_users` VALUES ('4', null, 'd41d8cd98f00b204e9800998ecf8427e', '3', null, null, null, null, '1', null, '2015-10-27 10:21:36', '1');
