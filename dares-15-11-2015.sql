/*
Navicat MySQL Data Transfer

Source Server         : dares_internal
Source Server Version : 50546
Source Host           : 10.80.32.224:3306
Source Database       : dares

Target Server Type    : MYSQL
Target Server Version : 50546
File Encoding         : 65001

Date: 2015-11-15 14:09:24
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
-- Table structure for `academy_structure_faculty`
-- ----------------------------
DROP TABLE IF EXISTS `academy_structure_faculty`;
CREATE TABLE `academy_structure_faculty` (
  `faculty_id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_name` varchar(255) DEFAULT NULL,
  `faculty_created_by` int(11) DEFAULT NULL,
  `faculty_created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of academy_structure_faculty
-- ----------------------------
INSERT INTO `academy_structure_faculty` VALUES ('52', 'ÙƒÙ„ÙŠØ© Ø§Ù„Ø¹Ù„ÙˆÙ… Ø§Ù„Ø´Ø±Ø¹ÙŠØ© 2', '1', '2015-11-15 13:17:50');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of academy_structure_year
-- ----------------------------
INSERT INTO `academy_structure_year` VALUES ('1', 'Ø§Ù„Ø³Ù†Ø© Ø§Ù„Ø§ÙˆÙ„Ù‰', '1', '1', '2015-10-28 12:07:59');
INSERT INTO `academy_structure_year` VALUES ('2', 'Ø§Ù„Ø³Ù†Ø© Ø§Ù„Ø«Ø§Ù†ÙŠØ©', '1', '1', '2015-10-28 12:15:03');
INSERT INTO `academy_structure_year` VALUES ('3', 'Ø§Ù„Ø³Ù†Ø© Ø§Ù„Ø«Ø§Ù„Ø«Ø©', '1', '1', '2015-11-12 12:47:51');
INSERT INTO `academy_structure_year` VALUES ('4', 'Ø§Ù„Ø³Ù†Ø© Ø§Ù„Ø±Ø§Ø¨Ø¹Ø©', '1', '1', '2015-11-12 12:47:55');

-- ----------------------------
-- Table structure for `subject_element`
-- ----------------------------
DROP TABLE IF EXISTS `subject_element`;
CREATE TABLE `subject_element` (
  `element_id` int(11) NOT NULL AUTO_INCREMENT,
  `element_title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `element_lesson_id` int(11) DEFAULT NULL,
  `element_order` tinyint(4) DEFAULT NULL,
  `element_type` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `element_value` text COLLATE utf8_bin,
  `element_created_by` int(11) DEFAULT NULL,
  `element_created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`element_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of subject_element
-- ----------------------------
INSERT INTO `subject_element` VALUES ('1', 'first element', '1', '55', '2', 0x31, null, '2015-11-11 10:37:39');
INSERT INTO `subject_element` VALUES ('4', 'uuu', '1', '33', '3', 0x33, null, '2015-11-15 11:18:05');
INSERT INTO `subject_element` VALUES ('5', 'tttt', '1', '44', '4', 0x343434, null, '2015-11-15 11:18:38');

-- ----------------------------
-- Table structure for `subject_lesson`
-- ----------------------------
DROP TABLE IF EXISTS `subject_lesson`;
CREATE TABLE `subject_lesson` (
  `lesson_id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `lesson_sub_id` int(11) DEFAULT NULL,
  `lesson_order` tinyint(4) DEFAULT NULL,
  `lesson_type` tinyint(1) DEFAULT '0' COMMENT 'intro = 1 , lesson = 0 default , ',
  `lesson_state` tinyint(1) DEFAULT NULL COMMENT '0=notactive , 1=active',
  `lesson_created_by` int(11) DEFAULT NULL,
  `lesson_created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`lesson_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of subject_lesson
-- ----------------------------
INSERT INTO `subject_lesson` VALUES ('1', 'first lesson', '1', '3', '1', '0', null, '2015-11-11 09:45:13');
INSERT INTO `subject_lesson` VALUES ('2', 'second lesson', '2', '2', '1', '1', null, '2015-11-11 09:59:16');
INSERT INTO `subject_lesson` VALUES ('3', 'second lesson', '2', '1', '2', '0', null, '2015-11-11 09:59:57');
INSERT INTO `subject_lesson` VALUES ('5', 'yyyy', null, '1', '1', '1', null, '2015-11-15 10:31:22');
INSERT INTO `subject_lesson` VALUES ('6', 'yyyy', '1', '1', '1', '1', '1', '2015-11-15 10:32:08');
INSERT INTO `subject_lesson` VALUES ('8', 'test', '1', '3', '1', '1', '1', '2015-11-15 12:34:02');
INSERT INTO `subject_lesson` VALUES ('9', 'test', '1', '3', '1', '1', '1', '2015-11-15 12:34:40');
INSERT INTO `subject_lesson` VALUES ('10', 'test', '1', '55', '1', '1', '1', '2015-11-15 12:36:38');
INSERT INTO `subject_lesson` VALUES ('11', 'test', '1', '55', '1', '1', '1', '2015-11-15 12:39:14');
INSERT INTO `subject_lesson` VALUES ('12', 'test', '1', '55', '1', '1', '1', '2015-11-15 12:39:16');
INSERT INTO `subject_lesson` VALUES ('13', 'test', '1', '55', '1', '1', '1', '2015-11-15 12:39:59');
INSERT INTO `subject_lesson` VALUES ('17', 'ttt', '1', '127', '1', '1', '1', '2015-11-15 12:43:20');

-- ----------------------------
-- Table structure for `sys_log`
-- ----------------------------
DROP TABLE IF EXISTS `sys_log`;
CREATE TABLE `sys_log` (
  `sys_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `sys_log_userid` int(11) NOT NULL,
  `sys_log_created_date` datetime NOT NULL,
  PRIMARY KEY (`sys_log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of sys_log
-- ----------------------------
INSERT INTO `sys_log` VALUES ('1', '1', '2015-11-10 00:00:00');
INSERT INTO `sys_log` VALUES ('2', '1', '2015-11-10 11:43:05');
INSERT INTO `sys_log` VALUES ('3', '1', '2015-11-10 11:43:17');
INSERT INTO `sys_log` VALUES ('4', '1', '2015-11-10 11:43:44');
INSERT INTO `sys_log` VALUES ('5', '1', '2015-11-10 11:51:32');
INSERT INTO `sys_log` VALUES ('6', '1', '2015-11-10 11:51:36');
INSERT INTO `sys_log` VALUES ('7', '1', '2015-11-10 11:51:54');
INSERT INTO `sys_log` VALUES ('8', '1', '2015-11-10 11:52:11');
INSERT INTO `sys_log` VALUES ('9', '1', '2015-11-10 11:53:16');
INSERT INTO `sys_log` VALUES ('10', '1', '2015-11-10 12:08:17');
INSERT INTO `sys_log` VALUES ('11', '1', '2015-11-10 12:13:56');
INSERT INTO `sys_log` VALUES ('12', '1', '2015-11-10 12:15:27');
INSERT INTO `sys_log` VALUES ('13', '1', '2015-11-10 12:15:30');
INSERT INTO `sys_log` VALUES ('14', '1', '2015-11-10 12:20:46');
INSERT INTO `sys_log` VALUES ('15', '1', '2015-11-10 12:20:48');
INSERT INTO `sys_log` VALUES ('16', '1', '2015-11-10 12:20:49');
INSERT INTO `sys_log` VALUES ('17', '1', '2015-11-10 12:21:24');
INSERT INTO `sys_log` VALUES ('18', '1', '2015-11-10 12:21:58');
INSERT INTO `sys_log` VALUES ('19', '1', '2015-11-10 12:25:17');
INSERT INTO `sys_log` VALUES ('20', '1', '2015-11-10 12:25:19');
INSERT INTO `sys_log` VALUES ('21', '1', '2015-11-10 12:25:25');
INSERT INTO `sys_log` VALUES ('22', '1', '2015-11-10 12:27:04');
INSERT INTO `sys_log` VALUES ('23', '1', '2015-11-10 13:00:50');
INSERT INTO `sys_log` VALUES ('24', '1', '2015-11-10 13:04:51');
INSERT INTO `sys_log` VALUES ('25', '1', '2015-11-11 09:53:29');
INSERT INTO `sys_log` VALUES ('26', '1', '2015-11-11 09:59:32');
INSERT INTO `sys_log` VALUES ('27', '1', '2015-11-11 10:04:04');
INSERT INTO `sys_log` VALUES ('28', '1', '2015-11-11 10:42:19');
INSERT INTO `sys_log` VALUES ('29', '1', '2015-11-11 10:53:40');
INSERT INTO `sys_log` VALUES ('30', '1', '2015-11-11 10:54:38');
INSERT INTO `sys_log` VALUES ('31', '1', '2015-11-11 10:57:27');
INSERT INTO `sys_log` VALUES ('32', '1', '2015-11-11 11:23:35');
INSERT INTO `sys_log` VALUES ('33', '1', '2015-11-11 11:47:54');
INSERT INTO `sys_log` VALUES ('34', '1', '2015-11-11 12:21:35');
INSERT INTO `sys_log` VALUES ('35', '1', '2015-11-11 09:35:35');
INSERT INTO `sys_log` VALUES ('36', '1', '2015-11-11 09:40:19');
INSERT INTO `sys_log` VALUES ('37', '1', '2015-11-11 12:48:36');
INSERT INTO `sys_log` VALUES ('38', '1', '2015-11-11 09:54:04');
INSERT INTO `sys_log` VALUES ('39', '1', '2015-11-11 09:54:33');
INSERT INTO `sys_log` VALUES ('40', '1', '2015-11-11 09:57:34');
INSERT INTO `sys_log` VALUES ('41', '1', '2015-11-11 12:59:06');
INSERT INTO `sys_log` VALUES ('42', '1', '2015-11-11 10:00:08');
INSERT INTO `sys_log` VALUES ('43', '1', '2015-11-11 13:01:02');
INSERT INTO `sys_log` VALUES ('44', '1', '2015-11-11 13:04:00');
INSERT INTO `sys_log` VALUES ('45', '1', '2015-11-11 13:04:30');
INSERT INTO `sys_log` VALUES ('46', '1', '2015-11-11 13:09:13');
INSERT INTO `sys_log` VALUES ('47', '1', '2015-11-11 13:10:52');
INSERT INTO `sys_log` VALUES ('48', '1', '2015-11-11 13:18:20');
INSERT INTO `sys_log` VALUES ('49', '1', '2015-11-11 13:19:48');
INSERT INTO `sys_log` VALUES ('50', '1', '2015-11-11 13:19:53');
INSERT INTO `sys_log` VALUES ('51', '1', '2015-11-11 13:20:14');
INSERT INTO `sys_log` VALUES ('52', '1', '2015-11-11 13:21:27');
INSERT INTO `sys_log` VALUES ('53', '1', '2015-11-11 13:29:54');
INSERT INTO `sys_log` VALUES ('54', '1', '2015-11-11 13:30:25');
INSERT INTO `sys_log` VALUES ('55', '1', '2015-11-11 13:30:47');
INSERT INTO `sys_log` VALUES ('56', '1', '2015-11-11 13:31:33');
INSERT INTO `sys_log` VALUES ('57', '1', '2015-11-11 13:33:38');
INSERT INTO `sys_log` VALUES ('58', '1', '2015-11-11 13:58:18');
INSERT INTO `sys_log` VALUES ('59', '1', '2015-11-11 11:02:58');
INSERT INTO `sys_log` VALUES ('60', '1', '2015-11-12 07:58:49');
INSERT INTO `sys_log` VALUES ('61', '1', '2015-11-12 08:48:59');
INSERT INTO `sys_log` VALUES ('62', '1', '2015-11-12 08:55:23');
INSERT INTO `sys_log` VALUES ('63', '1', '2015-11-12 09:01:00');
INSERT INTO `sys_log` VALUES ('64', '1', '2015-11-12 09:02:45');
INSERT INTO `sys_log` VALUES ('65', '1', '2015-11-12 09:48:02');
INSERT INTO `sys_log` VALUES ('66', '1', '2015-11-12 10:11:54');
INSERT INTO `sys_log` VALUES ('67', '1', '2015-11-12 12:10:44');
INSERT INTO `sys_log` VALUES ('68', '1', '2015-11-12 12:19:17');
INSERT INTO `sys_log` VALUES ('69', '1', '2015-11-12 12:36:43');
INSERT INTO `sys_log` VALUES ('70', '1', '2015-11-12 12:43:14');
INSERT INTO `sys_log` VALUES ('71', '1', '2015-11-12 12:43:24');
INSERT INTO `sys_log` VALUES ('72', '1', '2015-11-12 12:44:25');
INSERT INTO `sys_log` VALUES ('73', '1', '2015-11-12 12:44:48');
INSERT INTO `sys_log` VALUES ('74', '1', '2015-11-12 10:46:21');
INSERT INTO `sys_log` VALUES ('75', '1', '2015-11-15 08:20:27');
INSERT INTO `sys_log` VALUES ('76', '1', '2015-11-15 05:31:56');
INSERT INTO `sys_log` VALUES ('77', '1', '2015-11-15 05:33:37');
INSERT INTO `sys_log` VALUES ('78', '1', '2015-11-15 08:42:25');
INSERT INTO `sys_log` VALUES ('79', '1', '2015-11-15 08:43:48');
INSERT INTO `sys_log` VALUES ('80', '1', '2015-11-15 09:33:35');
INSERT INTO `sys_log` VALUES ('81', '1', '2015-11-15 09:40:01');
INSERT INTO `sys_log` VALUES ('82', '1', '2015-11-15 12:00:28');
INSERT INTO `sys_log` VALUES ('83', '1', '2015-11-15 09:50:06');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_permission
-- ----------------------------
INSERT INTO `sys_permission` VALUES ('1', 'Ø§Ù„Ø±Ø¯ Ø¹Ù„Ù‰ Ø´ÙƒÙˆÙ‰', '/sys/roles.php', '2', '5,4,1,2,3', '2015-10-27 09:23:27', null);
INSERT INTO `sys_permission` VALUES ('2', 'users', '/sys/users.php', '4', '6,8', '2015-10-27 09:23:23', null);
INSERT INTO `sys_permission` VALUES ('3', 'yyyy', '/sys/permission.php', '2', '1,2,3,4', '2015-10-27 10:27:39', null);
INSERT INTO `sys_permission` VALUES ('7', 'year', '/admin/academy_structure/year.php', '1', '1,3,6', '2015-10-28 12:07:02', '1');
INSERT INTO `sys_permission` VALUES ('8', 'term', '/admin/academy_structure/term.php', '1', '1,3,6', '2015-10-28 12:25:09', '1');
INSERT INTO `sys_permission` VALUES ('9', 'subject', '/admin/academy_structure/subject.php', '2', '1,3,6', '2015-10-28 13:29:02', '1');
INSERT INTO `sys_permission` VALUES ('10', 'الأقسام', '/admin/academy_structure/subject.php', '1', '1,3,6', '2015-11-12 10:17:18', '1');
INSERT INTO `sys_permission` VALUES ('11', 'Ø§Ù„Ø±Ø¯ Ø¹Ù„Ù‰ Ø´ÙƒÙˆÙ‰', '/admin/index.php', '2', '5,4,1,2,3', '2015-10-27 09:23:27', null);

-- ----------------------------
-- Table structure for `sys_permission_category`
-- ----------------------------
DROP TABLE IF EXISTS `sys_permission_category`;
CREATE TABLE `sys_permission_category` (
  `categ_id` int(11) NOT NULL AUTO_INCREMENT,
  `categ_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`categ_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_permission_category
-- ----------------------------
INSERT INTO `sys_permission_category` VALUES ('2', 'Ø§Ù„Ø´ÙƒØ§ÙˆÙ‰');
INSERT INTO `sys_permission_category` VALUES ('3', 'Ø§Ù„Ø¯Ø¹Ù… Ø§Ù„ÙÙ†Ù‰');
INSERT INTO `sys_permission_category` VALUES ('4', 'Ø§Ù„Ù‚Ø¨ÙˆÙ„ ÙˆØ§Ù„ØªØ³Ø¬ÙŠÙ„');
INSERT INTO `sys_permission_category` VALUES ('6', 'Ø§Ù„Ù…Ø§Ù„ÙŠØ© ');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_role
-- ----------------------------
INSERT INTO `sys_role` VALUES ('3', 'Ø§Ù„ØªØµÙ…ÙŠÙ… Ø§Ù„ØªØ¹Ù„ÙŠÙ…ÙŠ', '2015-10-26 12:52:11', '1');
INSERT INTO `sys_role` VALUES ('6', 'Ø§Ù„Ù‚Ø¨ÙˆÙ„', '2015-10-27 10:43:48', '1');
INSERT INTO `sys_role` VALUES ('8', 'Ø§Ù„Ø´Ø¤Ù† Ø§Ù„Ø£ÙƒØ§Ø¯ÙŠÙ…ÙŠØ©', '2015-11-15 11:49:17', '0');

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
  `user_sex` varchar(1) DEFAULT NULL COMMENT 'f=female , m =male',
  `user_last_login` datetime DEFAULT NULL,
  `user_created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_users
-- ----------------------------
INSERT INTO `sys_users` VALUES ('1', 'sami', '123456', '1,3,6', 'Ø³Ø§Ù…ÙŠ Ø§Ù„Ù…Ø¹Ù…Ø±ÙŠ', 'sami@gmail.com', '96663254', null, '1', '1', '2015-11-15 09:50:06', '2015-10-26 12:45:58', null);
INSERT INTO `sys_users` VALUES ('2', 'ahmed', '123', '1,2', 'Ø§Ø­Ù…Ø¯ Ø§Ù„ÙƒØ¯Ù†Ø¯Ù‰', 'ahmed@yahoo.com', '123456789', null, '1', null, null, '2015-10-26 11:43:09', null);
INSERT INTO `sys_users` VALUES ('3', 'hithm', 'dd458505749b2941217ddd59394240e8', ',1', 'Ù‡ÙŠØ«Ù… Ø­Ù…Ø¯ÙŠ', '111', null, null, '0', null, null, '2015-10-26 12:04:36', null);
INSERT INTO `sys_users` VALUES ('5', 'ali', 'e10adc3949ba59abbe56e057f20f883e', '1,3,6', 'Ø¹Ù„ÙŠ Ø§Ù„ÙŠØ²ÙŠØ¯ÙŠ', 'aalyazeedi@css.edu.om', '95845885', null, '1', null, null, '2015-11-10 13:20:51', '1');
