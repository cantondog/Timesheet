/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50141
Source Host           : localhost:3306
Source Database       : timesheet

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001

Date: 2013-01-20 14:01:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `departments`
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(255) NOT NULL,
  `manager` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO `departments` VALUES ('1', 'Executives', null, '2012-09-28 17:21:37', '2012-09-28 17:21:37');
INSERT INTO `departments` VALUES ('2', 'Client Services', null, '2012-09-28 17:21:47', '2012-09-28 17:21:47');
INSERT INTO `departments` VALUES ('3', 'Creative', null, '2012-09-28 18:30:47', '2012-09-28 18:34:38');
INSERT INTO `departments` VALUES ('4', 'Data', null, '2012-09-28 18:34:19', '2012-09-28 18:34:50');
INSERT INTO `departments` VALUES ('6', 'Production', null, '2012-09-28 18:35:22', '2012-09-28 18:35:22');
INSERT INTO `departments` VALUES ('7', 'Technology', null, '2012-09-28 18:35:30', '2012-09-28 18:35:30');

-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'Administrators', '2012-09-28 18:21:17', '2012-09-28 18:21:17');
INSERT INTO `groups` VALUES ('2', 'Managers', '2012-09-28 18:21:27', '2012-09-28 18:21:27');
INSERT INTO `groups` VALUES ('3', 'Users', '2012-09-28 18:21:33', '2012-09-28 18:21:33');

-- ----------------------------
-- Table structure for `holidays`
-- ----------------------------
DROP TABLE IF EXISTS `holidays`;
CREATE TABLE `holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of holidays
-- ----------------------------
INSERT INTO `holidays` VALUES ('1', 'Thanksgiving', '2012-11-22', '2012-09-30 03:56:21', '2012-10-25 08:07:13');
INSERT INTO `holidays` VALUES ('2', 'Day After Thanksgiving', '2012-11-23', '2012-09-30 03:59:39', '2012-09-30 03:59:39');
INSERT INTO `holidays` VALUES ('3', 'Christmas Eve', '2012-12-24', '2012-09-30 04:00:42', '2012-12-04 17:23:34');
INSERT INTO `holidays` VALUES ('4', 'Christmas', '2012-12-25', '2012-09-30 04:00:59', '2012-09-30 04:00:59');
INSERT INTO `holidays` VALUES ('5', 'New Years Eve', '2012-12-31', '2012-09-30 04:01:25', '2012-09-30 04:01:25');
INSERT INTO `holidays` VALUES ('6', 'New Years Day', '2013-01-01', '2012-09-30 04:01:44', '2012-09-30 04:01:44');

-- ----------------------------
-- Table structure for `masters`
-- ----------------------------
DROP TABLE IF EXISTS `masters`;
CREATE TABLE `masters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `period_start_date` date NOT NULL,
  `period_end_date` date NOT NULL,
  `dates` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of masters
-- ----------------------------
INSERT INTO `masters` VALUES ('16', '2012-11-16', '2012-11-30', '{\"dates\":[{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"11-16-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"11-17-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"11-18-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"11-19-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"11-20-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"11-21-2012\"},{\"type\":\"holiday\",\"dayofweek\":\"weekday\",\"datestamp\":\"11-22-2012\"},{\"type\":\"holiday\",\"dayofweek\":\"weekday\",\"datestamp\":\"11-23-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"11-24-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"11-25-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"11-26-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"11-27-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"11-28-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"11-29-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"11-30-2012\"}]}', '2012-11-27 09:34:40', '2012-11-27 09:34:40');
INSERT INTO `masters` VALUES ('17', '2012-12-01', '2012-12-15', '{\"dates\":[{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"12-1-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"12-2-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-3-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-4-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-5-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-6-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-7-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"12-8-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"12-9-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-10-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-11-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-12-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-13-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-14-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"12-15-2012\"}]}', '2012-11-28 14:21:03', '2012-11-28 14:21:03');
INSERT INTO `masters` VALUES ('18', '2012-12-16', '2012-12-31', '{\"dates\":[{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"12-16-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-17-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-18-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-19-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-20-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-21-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"12-22-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"12-23-2012\"},{\"type\":\"holiday\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-24-2012\"},{\"type\":\"holiday\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-25-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-26-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-27-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-28-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"12-29-2012\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"12-30-2012\"},{\"type\":\"holiday\",\"dayofweek\":\"weekday\",\"datestamp\":\"12-31-2012\"}]}', '2012-11-28 14:21:23', '2012-11-28 14:21:23');
INSERT INTO `masters` VALUES ('22', '2013-01-06', '2013-01-19', '{\"dates\":[{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"1-6-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-7-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-8-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-9-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-10-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-11-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"1-12-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"1-13-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-14-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-15-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-16-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-17-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-18-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"1-19-2013\"}]}', '2013-01-16 07:31:09', '2013-01-16 07:31:09');
INSERT INTO `masters` VALUES ('23', '2013-01-20', '2013-02-02', '{\"dates\":[{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"1-20-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-21-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-22-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-23-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-24-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-25-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"1-26-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"1-27-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-28-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-29-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-30-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"1-31-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-1-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"2-2-2013\"}]}', '2013-01-16 07:31:27', '2013-01-16 07:31:27');
INSERT INTO `masters` VALUES ('24', '2013-02-03', '2013-02-16', '{\"dates\":[{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"2-3-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-4-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-5-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-6-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-7-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-8-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"2-9-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"2-10-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-11-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-12-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-13-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-14-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-15-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"2-16-2013\"}]}', '2013-01-16 07:31:41', '2013-01-16 07:31:41');
INSERT INTO `masters` VALUES ('25', '2013-02-17', '2013-03-02', '{\"dates\":[{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"2-17-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-18-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-19-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-20-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-21-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-22-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"2-23-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"2-24-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-25-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-26-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-27-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"2-28-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-1-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"3-2-2013\"}]}', '2013-01-16 07:31:55', '2013-01-16 07:31:55');
INSERT INTO `masters` VALUES ('26', '2013-03-03', '2013-03-16', '{\"dates\":[{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"3-3-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-4-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-5-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-6-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-7-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-8-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"3-9-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"3-10-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-11-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-12-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-13-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-14-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-15-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"3-16-2013\"}]}', '2013-01-16 07:32:08', '2013-01-16 07:32:08');
INSERT INTO `masters` VALUES ('27', '2013-03-17', '2013-03-30', '{\"dates\":[{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"3-17-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-18-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-19-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-20-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-21-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-22-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"3-23-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"3-24-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-25-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-26-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-27-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-28-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekday\",\"datestamp\":\"3-29-2013\"},{\"type\":\"regular\",\"dayofweek\":\"weekend\",\"datestamp\":\"3-30-2013\"}]}', '2013-01-16 07:32:20', '2013-01-16 07:32:20');

-- ----------------------------
-- Table structure for `ptos`
-- ----------------------------
DROP TABLE IF EXISTS `ptos`;
CREATE TABLE `ptos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date NOT NULL,
  `hours_requested` varchar(0) DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT '2',
  `notes` text,
  `paid` int(2) DEFAULT NULL,
  `manager_notes` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ptos
-- ----------------------------

-- ----------------------------
-- Table structure for `settings`
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `time_in1` varchar(255) DEFAULT NULL,
  `time_out1` varchar(255) DEFAULT NULL,
  `meal_period` varchar(255) DEFAULT NULL,
  `time_in2` varchar(255) DEFAULT NULL,
  `time_out2` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('1', '5', '8am', '12 pm', '2.00', '02:00 pm', '06:00 pm', '', '2012-10-22 11:59:57', '2012-11-15 12:43:46');
INSERT INTO `settings` VALUES ('12', '45', '07:30 am', '12:00 pm', '0.50', '12:30 pm', '04:00 pm', '', '2013-01-20 12:49:39', '2013-01-20 12:49:39');

-- ----------------------------
-- Table structure for `statuses`
-- ----------------------------
DROP TABLE IF EXISTS `statuses`;
CREATE TABLE `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of statuses
-- ----------------------------
INSERT INTO `statuses` VALUES ('1', 'New');
INSERT INTO `statuses` VALUES ('2', 'Pending');
INSERT INTO `statuses` VALUES ('3', 'Submitted');
INSERT INTO `statuses` VALUES ('4', 'Returned');
INSERT INTO `statuses` VALUES ('5', 'Rejected');
INSERT INTO `statuses` VALUES ('6', 'Approved');
INSERT INTO `statuses` VALUES ('7', 'Closed');

-- ----------------------------
-- Table structure for `timesheets`
-- ----------------------------
DROP TABLE IF EXISTS `timesheets`;
CREATE TABLE `timesheets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `master_id` int(11) NOT NULL,
  `period_start_date` date NOT NULL,
  `period_end_date` date NOT NULL,
  `dates` text NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '0',
  `approved` int(3) NOT NULL DEFAULT '0',
  `submit_date` date DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of timesheets
-- ----------------------------
INSERT INTO `timesheets` VALUES ('46', '45', '17', '2012-12-01', '2012-12-15', '{\"12-1-2012\":{\"MT_12-1-2012\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_12-1-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-1-2012\":\"0.00\"},\"12-2-2012\":{\"MT_12-2-2012\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_12-2-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-2-2012\":\"0.00\"},\"12-3-2012\":{\"MT_12-3-2012\":\"1.00\",\"period1_in\":\"08:00 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"01:00 pm\",\"period2_out\":\"05:00 pm\",\"OT_12-3-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-3-2012\":\"8.00\"},\"12-4-2012\":{\"MT_12-4-2012\":\"1.00\",\"period1_in\":\"08:00 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"01:00 pm\",\"period2_out\":\"03:00 pm\",\"OT_12-4-2012\":\"0\",\"pto_taken\":\"2\",\"DT_12-4-2012\":\"6.00\"},\"12-5-2012\":{\"MT_12-5-2012\":\"1.00\",\"period1_in\":\"08:00 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"01:00 pm\",\"period2_out\":\"04:00 pm\",\"makeup\":\"1\",\"OT_12-5-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-5-2012\":\"7.00\"},\"12-6-2012\":{\"MT_12-6-2012\":\"1.00\",\"period1_in\":\"07:00 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"01:00 pm\",\"period2_out\":\"05:00 pm\",\"makeup\":\"1\",\"OT_12-6-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-6-2012\":\"9.00\"},\"12-7-2012\":{\"MT_12-7-2012\":\"1.00\",\"period1_in\":\"07:00 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"01:00 pm\",\"period2_out\":\"05:00 pm\",\"OT_12-7-2012\":\"1.00\",\"pto_taken\":\"\",\"DT_12-7-2012\":\"8.00\"},\"12-8-2012\":{\"MT_12-8-2012\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_12-8-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-8-2012\":\"0.00\"},\"12-9-2012\":{\"MT_12-9-2012\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_12-9-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-9-2012\":\"0.00\"},\"12-10-2012\":{\"MT_12-10-2012\":\"1.00\",\"period1_in\":\"08:00 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"01:00 pm\",\"period2_out\":\"05:00 pm\",\"OT_12-10-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-10-2012\":\"8.00\"},\"12-11-2012\":{\"MT_12-11-2012\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_12-11-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-11-2012\":\"0.00\"},\"12-12-2012\":{\"MT_12-12-2012\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_12-12-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-12-2012\":\"0.00\"},\"12-13-2012\":{\"MT_12-13-2012\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_12-13-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-13-2012\":\"0.00\"},\"12-14-2012\":{\"MT_12-14-2012\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_12-14-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-14-2012\":\"0.00\"},\"12-15-2012\":{\"MT_12-15-2012\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_12-15-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-15-2012\":\"0.00\"},\"ot_carryover\":\"0\",\"notes\":\"\",\"TotalRegularHours\":\"46.00\",\"MaxRegularHours\":\"80\",\"TotalOT\":\"1.00\",\"TotalPTO\":\"2\",\"TotalHoliday\":\"0\",\"Data\":{\"user_id\":\"45\",\"master_id\":\"17\",\"period_start_date\":\"2012-12-01\",\"period_end_date\":\"2012-12-15\",\"id\":\"46\"}}', '2', '0', '2013-01-20', '2012-12-10 08:04:30', '2013-01-20 13:39:16');
INSERT INTO `timesheets` VALUES ('71', '45', '18', '2012-12-16', '2012-12-31', '{\"12-16-2012\":{\"MT_12-16-2012\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_12-16-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-16-2012\":\"0.00\"},\"12-17-2012\":{\"MT_12-17-2012\":\"0.50\",\"period1_in\":\"07:30 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"12:30 pm\",\"period2_out\":\"06:00 pm\",\"OT_12-17-2012\":\"2.00\",\"pto_taken\":\"\",\"DT_12-17-2012\":\"8\"},\"12-18-2012\":{\"MT_12-18-2012\":\"0.50\",\"period1_in\":\"07:30 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"12:30 pm\",\"period2_out\":\"04:00 pm\",\"OT_12-18-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-18-2012\":\"8\"},\"12-19-2012\":{\"MT_12-19-2012\":\"0.50\",\"period1_in\":\"07:30 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"12:30 pm\",\"period2_out\":\"04:00 pm\",\"OT_12-19-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-19-2012\":\"8\"},\"12-20-2012\":{\"MT_12-20-2012\":\"0.50\",\"period1_in\":\"07:30 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"12:30 pm\",\"period2_out\":\"04:00 pm\",\"OT_12-20-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-20-2012\":\"8\"},\"12-21-2012\":{\"MT_12-21-2012\":\"0.50\",\"period1_in\":\"07:30 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"12:30 pm\",\"period2_out\":\"04:00 pm\",\"OT_12-21-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-21-2012\":\"8\"},\"12-22-2012\":{\"MT_12-22-2012\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_12-22-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-22-2012\":\"0.00\"},\"12-23-2012\":{\"MT_12-23-2012\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_12-23-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-23-2012\":\"0.00\"},\"12-24-2012\":{\"MT_12-24-2012\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_12-24-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-24-2012\":\"0.00\"},\"12-25-2012\":{\"MT_12-25-2012\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_12-25-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-25-2012\":\"0.00\"},\"12-26-2012\":{\"MT_12-26-2012\":\"0.50\",\"period1_in\":\"07:30 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"12:30 pm\",\"period2_out\":\"02:00 pm\",\"OT_12-26-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-26-2012\":\"6.00\"},\"12-27-2012\":{\"MT_12-27-2012\":\"0.50\",\"period1_in\":\"07:30 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"12:30 pm\",\"period2_out\":\"06:00 pm\",\"makeup\":\"1\",\"OT_12-27-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-27-2012\":\"10.00\"},\"12-28-2012\":{\"MT_12-28-2012\":\"0.50\",\"period1_in\":\"07:30 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"12:30 pm\",\"period2_out\":\"04:00 pm\",\"OT_12-28-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-28-2012\":\"8\"},\"12-29-2012\":{\"MT_12-29-2012\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_12-29-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-29-2012\":\"0.00\"},\"12-30-2012\":{\"MT_12-30-2012\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_12-30-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-30-2012\":\"0.00\"},\"12-31-2012\":{\"MT_12-31-2012\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_12-31-2012\":\"0\",\"pto_taken\":\"\",\"DT_12-31-2012\":\"0.00\"},\"ot_carryover\":\"0\",\"notes\":\"This is the notes section and will show up to the people who can view this sheet\",\"TotalRegularHours\":\"64.00\",\"MaxRegularHours\":\"64\",\"TotalOT\":\"2.00\",\"TotalPTO\":\"0.00\",\"TotalHoliday\":\"24\",\"Data\":{\"user_id\":\"45\",\"master_id\":\"18\",\"period_start_date\":\"2012-12-16\",\"period_end_date\":\"2012-12-31\"}}', '7', '0', '2013-01-20', '2013-01-20 12:53:10', '2013-01-20 12:59:04');
INSERT INTO `timesheets` VALUES ('72', '45', '23', '2013-01-20', '2013-02-02', '{\"1-20-2013\":{\"MT_1-20-2013\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_1-20-2013\":\"0\",\"pto_taken\":\"\",\"DT_1-20-2013\":\"0.00\"},\"1-21-2013\":{\"MT_1-21-2013\":\"0.50\",\"period1_in\":\"07:30 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"12:30 pm\",\"period2_out\":\"04:00 pm\",\"OT_1-21-2013\":\"0\",\"pto_taken\":\"\",\"DT_1-21-2013\":\"8\"},\"1-22-2013\":{\"MT_1-22-2013\":\"0.50\",\"period1_in\":\"07:30 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"12:30 pm\",\"period2_out\":\"04:00 pm\",\"OT_1-22-2013\":\"0\",\"pto_taken\":\"\",\"DT_1-22-2013\":\"8\"},\"1-23-2013\":{\"MT_1-23-2013\":\"0.50\",\"period1_in\":\"07:30 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"12:30 pm\",\"period2_out\":\"04:00 pm\",\"OT_1-23-2013\":\"0\",\"pto_taken\":\"\",\"DT_1-23-2013\":\"8\"},\"1-24-2013\":{\"MT_1-24-2013\":\"0.50\",\"period1_in\":\"07:30 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"12:30 pm\",\"period2_out\":\"04:00 pm\",\"OT_1-24-2013\":\"0\",\"pto_taken\":\"\",\"DT_1-24-2013\":\"8\"},\"1-25-2013\":{\"MT_1-25-2013\":\"0.50\",\"period1_in\":\"07:30 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"12:30 pm\",\"period2_out\":\"04:00 pm\",\"OT_1-25-2013\":\"0\",\"pto_taken\":\"\",\"DT_1-25-2013\":\"8\"},\"1-26-2013\":{\"MT_1-26-2013\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_1-26-2013\":\"0\",\"pto_taken\":\"\",\"DT_1-26-2013\":\"0.00\"},\"1-27-2013\":{\"MT_1-27-2013\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_1-27-2013\":\"0\",\"pto_taken\":\"\",\"DT_1-27-2013\":\"0.00\"},\"1-28-2013\":{\"MT_1-28-2013\":\"0.50\",\"period1_in\":\"07:30 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"12:30 pm\",\"period2_out\":\"04:00 pm\",\"OT_1-28-2013\":\"0\",\"pto_taken\":\"\",\"DT_1-28-2013\":\"8\"},\"1-29-2013\":{\"MT_1-29-2013\":\"0.50\",\"period1_in\":\"07:30 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"12:30 pm\",\"period2_out\":\"04:00 pm\",\"OT_1-29-2013\":\"0\",\"pto_taken\":\"\",\"DT_1-29-2013\":\"8\"},\"1-30-2013\":{\"MT_1-30-2013\":\"0.50\",\"period1_in\":\"07:30 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"12:30 pm\",\"period2_out\":\"04:00 pm\",\"OT_1-30-2013\":\"0\",\"pto_taken\":\"\",\"DT_1-30-2013\":\"8\"},\"1-31-2013\":{\"MT_1-31-2013\":\"0.50\",\"period1_in\":\"07:30 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"12:30 pm\",\"period2_out\":\"04:00 pm\",\"OT_1-31-2013\":\"0\",\"pto_taken\":\"\",\"DT_1-31-2013\":\"8\"},\"2-1-2013\":{\"MT_2-1-2013\":\"0.50\",\"period1_in\":\"07:30 am\",\"period1_out\":\"12:00 pm\",\"period2_in\":\"12:30 pm\",\"period2_out\":\"04:00 pm\",\"OT_2-1-2013\":\"0\",\"pto_taken\":\"\",\"DT_2-1-2013\":\"8\"},\"2-2-2013\":{\"MT_2-2-2013\":\"0.00\",\"period1_in\":\"\",\"period1_out\":\"\",\"period2_in\":\"\",\"period2_out\":\"\",\"OT_2-2-2013\":\"0\",\"pto_taken\":\"\",\"DT_2-2-2013\":\"0.00\"},\"ot_carryover\":\"0\",\"notes\":\"\",\"TotalRegularHours\":\"80\",\"MaxRegularHours\":\"80\",\"TotalOT\":\"0\",\"TotalPTO\":\"0\",\"TotalHoliday\":\"0\",\"Data\":{\"user_id\":\"45\",\"master_id\":\"23\",\"period_start_date\":\"2013-01-20\",\"period_end_date\":\"2013-02-02\"}}', '7', '0', '2013-01-20', '2013-01-20 12:59:45', '2013-01-20 13:08:48');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `role` enum('admin','manager','regular') NOT NULL DEFAULT 'regular',
  `department_id` int(11) DEFAULT NULL,
  `ext` varchar(30) DEFAULT NULL,
  `emailaddress` varchar(255) DEFAULT NULL,
  `pto_balance` float(11,2) DEFAULT NULL,
  `pto_rate` float(11,2) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('5', 'admin', '4590c7919bbbbe4ab2f4987e70296e3c796ce292', 'Admin', 'User', 'admin', '7', '0001', 'admin@example.com', '8.92', '3.34', '2011-09-01', '2012-09-28 18:24:47', '2013-01-20 13:54:49');
INSERT INTO `users` VALUES ('6', 'manager', '4590c7919bbbbe4ab2f4987e70296e3c796ce292', 'Manager', 'User', 'manager', '7', '0002', 'manager@example.com', '18.46', '5.00', '2007-05-30', '2012-09-28 18:36:36', '2013-01-20 13:56:19');
INSERT INTO `users` VALUES ('45', 'test', '4590c7919bbbbe4ab2f4987e70296e3c796ce292', 'Test', 'User', 'regular', '7', '0000', 'test@advecor.com', '6.68', '3.34', '2012-12-01', '2012-12-01 16:20:15', '2013-01-20 13:08:48');
