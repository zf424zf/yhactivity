/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : activity

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-08-29 20:17:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for yh_ac_users
-- ----------------------------
DROP TABLE IF EXISTS `yh_ac_users`;
CREATE TABLE `yh_ac_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` char(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户表';

-- ----------------------------
-- Records of yh_ac_users
-- ----------------------------

-- ----------------------------
-- Table structure for yh_admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `yh_admin_menu`;
CREATE TABLE `yh_admin_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of yh_admin_menu
-- ----------------------------
INSERT INTO `yh_admin_menu` VALUES ('1', '0', '1', 'Index', 'fa-bar-chart', '/', null, null);
INSERT INTO `yh_admin_menu` VALUES ('2', '0', '2', 'Admin', 'fa-tasks', '', null, null);
INSERT INTO `yh_admin_menu` VALUES ('3', '2', '3', 'Users', 'fa-users', 'auth/users', null, null);
INSERT INTO `yh_admin_menu` VALUES ('4', '2', '4', 'Roles', 'fa-user', 'auth/roles', null, null);
INSERT INTO `yh_admin_menu` VALUES ('5', '2', '5', 'Permission', 'fa-user', 'auth/permissions', null, null);
INSERT INTO `yh_admin_menu` VALUES ('6', '2', '6', 'Menu', 'fa-bars', 'auth/menu', null, null);
INSERT INTO `yh_admin_menu` VALUES ('7', '2', '7', 'Operation log', 'fa-history', 'auth/logs', null, null);
INSERT INTO `yh_admin_menu` VALUES ('8', '0', '8', 'Helpers', 'fa-gears', '', null, null);
INSERT INTO `yh_admin_menu` VALUES ('9', '8', '9', 'Scaffold', 'fa-keyboard-o', 'helpers/scaffold', null, null);
INSERT INTO `yh_admin_menu` VALUES ('10', '8', '10', 'Database terminal', 'fa-database', 'helpers/terminal/database', null, null);
INSERT INTO `yh_admin_menu` VALUES ('11', '8', '11', 'Laravel artisan', 'fa-terminal', 'helpers/terminal/artisan', null, null);

-- ----------------------------
-- Table structure for yh_admin_operation_log
-- ----------------------------
DROP TABLE IF EXISTS `yh_admin_operation_log`;
CREATE TABLE `yh_admin_operation_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_operation_log_user_id_index` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of yh_admin_operation_log
-- ----------------------------
INSERT INTO `yh_admin_operation_log` VALUES ('1', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-08 08:29:01', '2017-08-08 08:29:01');
INSERT INTO `yh_admin_operation_log` VALUES ('2', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-09 12:22:25', '2017-08-09 12:22:25');
INSERT INTO `yh_admin_operation_log` VALUES ('3', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:21', '2017-08-19 07:06:21');
INSERT INTO `yh_admin_operation_log` VALUES ('4', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:23', '2017-08-19 07:06:23');
INSERT INTO `yh_admin_operation_log` VALUES ('5', '1', 'admin/auth/login', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:24', '2017-08-19 07:06:24');
INSERT INTO `yh_admin_operation_log` VALUES ('6', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:27', '2017-08-19 07:06:27');
INSERT INTO `yh_admin_operation_log` VALUES ('7', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:29', '2017-08-19 07:06:29');
INSERT INTO `yh_admin_operation_log` VALUES ('8', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:32', '2017-08-19 07:06:32');
INSERT INTO `yh_admin_operation_log` VALUES ('9', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:45', '2017-08-19 07:06:45');
INSERT INTO `yh_admin_operation_log` VALUES ('10', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:46', '2017-08-19 07:06:46');
INSERT INTO `yh_admin_operation_log` VALUES ('11', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:47', '2017-08-19 07:06:47');
INSERT INTO `yh_admin_operation_log` VALUES ('12', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:48', '2017-08-19 07:06:48');
INSERT INTO `yh_admin_operation_log` VALUES ('13', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:48', '2017-08-19 07:06:48');
INSERT INTO `yh_admin_operation_log` VALUES ('14', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:48', '2017-08-19 07:06:48');
INSERT INTO `yh_admin_operation_log` VALUES ('15', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:48', '2017-08-19 07:06:48');
INSERT INTO `yh_admin_operation_log` VALUES ('16', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:49', '2017-08-19 07:06:49');
INSERT INTO `yh_admin_operation_log` VALUES ('17', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:49', '2017-08-19 07:06:49');
INSERT INTO `yh_admin_operation_log` VALUES ('18', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:49', '2017-08-19 07:06:49');
INSERT INTO `yh_admin_operation_log` VALUES ('19', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:50', '2017-08-19 07:06:50');
INSERT INTO `yh_admin_operation_log` VALUES ('20', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:50', '2017-08-19 07:06:50');
INSERT INTO `yh_admin_operation_log` VALUES ('21', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:50', '2017-08-19 07:06:50');
INSERT INTO `yh_admin_operation_log` VALUES ('22', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:50', '2017-08-19 07:06:50');
INSERT INTO `yh_admin_operation_log` VALUES ('23', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:50', '2017-08-19 07:06:50');
INSERT INTO `yh_admin_operation_log` VALUES ('24', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:51', '2017-08-19 07:06:51');
INSERT INTO `yh_admin_operation_log` VALUES ('25', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:51', '2017-08-19 07:06:51');
INSERT INTO `yh_admin_operation_log` VALUES ('26', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:52', '2017-08-19 07:06:52');
INSERT INTO `yh_admin_operation_log` VALUES ('27', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:53', '2017-08-19 07:06:53');
INSERT INTO `yh_admin_operation_log` VALUES ('28', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:53', '2017-08-19 07:06:53');
INSERT INTO `yh_admin_operation_log` VALUES ('29', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:53', '2017-08-19 07:06:53');
INSERT INTO `yh_admin_operation_log` VALUES ('30', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:06:53', '2017-08-19 07:06:53');
INSERT INTO `yh_admin_operation_log` VALUES ('31', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:07:13', '2017-08-19 07:07:13');
INSERT INTO `yh_admin_operation_log` VALUES ('32', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:07:37', '2017-08-19 07:07:37');
INSERT INTO `yh_admin_operation_log` VALUES ('33', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-19 07:08:32', '2017-08-19 07:08:32');
INSERT INTO `yh_admin_operation_log` VALUES ('34', '1', 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-19 07:08:40', '2017-08-19 07:08:40');
INSERT INTO `yh_admin_operation_log` VALUES ('35', '1', 'admin/auth/permissions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-19 07:08:43', '2017-08-19 07:08:43');
INSERT INTO `yh_admin_operation_log` VALUES ('36', '1', 'admin/auth/roles', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-19 07:08:45', '2017-08-19 07:08:45');
INSERT INTO `yh_admin_operation_log` VALUES ('37', '1', 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-19 07:08:48', '2017-08-19 07:08:48');
INSERT INTO `yh_admin_operation_log` VALUES ('38', '1', 'admin/auth/users', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-19 07:08:50', '2017-08-19 07:08:50');
INSERT INTO `yh_admin_operation_log` VALUES ('39', '1', 'admin/auth/users/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-19 07:08:53', '2017-08-19 07:08:53');
INSERT INTO `yh_admin_operation_log` VALUES ('40', '1', 'admin/helpers/scaffold', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-19 07:14:05', '2017-08-19 07:14:05');
INSERT INTO `yh_admin_operation_log` VALUES ('41', '1', 'admin/helpers/terminal/database', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-19 07:16:44', '2017-08-19 07:16:44');
INSERT INTO `yh_admin_operation_log` VALUES ('42', '1', 'admin/helpers/terminal/artisan', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-19 07:16:46', '2017-08-19 07:16:46');
INSERT INTO `yh_admin_operation_log` VALUES ('43', '1', 'admin/helpers/scaffold', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-19 07:16:47', '2017-08-19 07:16:47');
INSERT INTO `yh_admin_operation_log` VALUES ('44', '1', 'admin/auth/logs', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-19 07:16:52', '2017-08-19 07:16:52');
INSERT INTO `yh_admin_operation_log` VALUES ('45', '1', 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-19 07:16:54', '2017-08-19 07:16:54');
INSERT INTO `yh_admin_operation_log` VALUES ('46', '1', 'admin/auth/permissions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-19 07:16:56', '2017-08-19 07:16:56');
INSERT INTO `yh_admin_operation_log` VALUES ('47', '1', 'admin/auth/roles', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-19 07:16:58', '2017-08-19 07:16:58');
INSERT INTO `yh_admin_operation_log` VALUES ('48', '1', 'admin/auth/users', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-19 07:17:00', '2017-08-19 07:17:00');
INSERT INTO `yh_admin_operation_log` VALUES ('49', '1', 'admin/helpers/scaffold', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-19 07:18:14', '2017-08-19 07:18:14');
INSERT INTO `yh_admin_operation_log` VALUES ('50', '1', 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2017-08-19 07:40:31', '2017-08-19 07:40:31');
INSERT INTO `yh_admin_operation_log` VALUES ('51', '1', 'admin/question', 'GET', '127.0.0.1', '[]', '2017-08-19 07:56:02', '2017-08-19 07:56:02');
INSERT INTO `yh_admin_operation_log` VALUES ('52', '1', 'admin/question', 'GET', '127.0.0.1', '[]', '2017-08-19 07:56:28', '2017-08-19 07:56:28');
INSERT INTO `yh_admin_operation_log` VALUES ('53', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-20 07:13:11', '2017-08-20 07:13:11');
INSERT INTO `yh_admin_operation_log` VALUES ('54', '1', 'admin/helpers/scaffold', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-20 07:13:41', '2017-08-20 07:13:41');
INSERT INTO `yh_admin_operation_log` VALUES ('55', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-20 07:40:14', '2017-08-20 07:40:14');
INSERT INTO `yh_admin_operation_log` VALUES ('56', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-20 07:55:27', '2017-08-20 07:55:27');
INSERT INTO `yh_admin_operation_log` VALUES ('57', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-20 07:56:43', '2017-08-20 07:56:43');
INSERT INTO `yh_admin_operation_log` VALUES ('58', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-20 07:58:50', '2017-08-20 07:58:50');
INSERT INTO `yh_admin_operation_log` VALUES ('59', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-20 07:59:35', '2017-08-20 07:59:35');
INSERT INTO `yh_admin_operation_log` VALUES ('60', '1', 'admin/setting/8', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"feOutTpAwFs2IFwkQwJ0HYBrvgZUgKOgwJzVa53x\"}', '2017-08-20 07:59:40', '2017-08-20 07:59:40');
INSERT INTO `yh_admin_operation_log` VALUES ('61', '1', 'admin/setting', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-20 07:59:40', '2017-08-20 07:59:40');
INSERT INTO `yh_admin_operation_log` VALUES ('62', '1', 'admin/setting/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-20 07:59:48', '2017-08-20 07:59:48');
INSERT INTO `yh_admin_operation_log` VALUES ('63', '1', 'admin/question', 'GET', '127.0.0.1', '[]', '2017-08-20 08:14:48', '2017-08-20 08:14:48');
INSERT INTO `yh_admin_operation_log` VALUES ('64', '1', 'admin/question/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-20 08:14:50', '2017-08-20 08:14:50');
INSERT INTO `yh_admin_operation_log` VALUES ('65', '1', 'admin/question', 'GET', '127.0.0.1', '[]', '2017-08-20 08:14:51', '2017-08-20 08:14:51');
INSERT INTO `yh_admin_operation_log` VALUES ('66', '1', 'admin/question', 'GET', '127.0.0.1', '[]', '2017-08-20 08:30:52', '2017-08-20 08:30:52');
INSERT INTO `yh_admin_operation_log` VALUES ('67', '1', 'admin/question/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-20 08:30:54', '2017-08-20 08:30:54');
INSERT INTO `yh_admin_operation_log` VALUES ('68', '1', 'admin/question/create', 'GET', '127.0.0.1', '[]', '2017-08-20 08:44:08', '2017-08-20 08:44:08');
INSERT INTO `yh_admin_operation_log` VALUES ('69', '1', 'admin/question', 'POST', '127.0.0.1', '{\"key\":null,\"value\":null,\"_token\":\"feOutTpAwFs2IFwkQwJ0HYBrvgZUgKOgwJzVa53x\",\"_previous_\":\"http:\\/\\/activity.dev\\/admin\\/question\"}', '2017-08-20 08:44:58', '2017-08-20 08:44:58');
INSERT INTO `yh_admin_operation_log` VALUES ('70', '1', 'admin/question/create', 'GET', '127.0.0.1', '[]', '2017-08-20 08:44:58', '2017-08-20 08:44:58');
INSERT INTO `yh_admin_operation_log` VALUES ('71', '1', 'admin/question', 'POST', '127.0.0.1', '{\"key\":\"\\u4f60\\u662f\\u732a\",\"value\":\"0\",\"_token\":\"feOutTpAwFs2IFwkQwJ0HYBrvgZUgKOgwJzVa53x\"}', '2017-08-20 08:45:07', '2017-08-20 08:45:07');
INSERT INTO `yh_admin_operation_log` VALUES ('72', '1', 'admin/question/create', 'GET', '127.0.0.1', '[]', '2017-08-20 08:45:07', '2017-08-20 08:45:07');
INSERT INTO `yh_admin_operation_log` VALUES ('73', '1', 'admin/question/create', 'GET', '127.0.0.1', '[]', '2017-08-20 08:45:32', '2017-08-20 08:45:32');
INSERT INTO `yh_admin_operation_log` VALUES ('74', '1', 'admin/question', 'POST', '127.0.0.1', '{\"question\":\"\\u4f60\\u662f\\u732a\\u5417\",\"order\":\"1\",\"_token\":\"feOutTpAwFs2IFwkQwJ0HYBrvgZUgKOgwJzVa53x\"}', '2017-08-20 08:45:38', '2017-08-20 08:45:38');
INSERT INTO `yh_admin_operation_log` VALUES ('75', '1', 'admin/question/create', 'GET', '127.0.0.1', '[]', '2017-08-20 08:45:39', '2017-08-20 08:45:39');
INSERT INTO `yh_admin_operation_log` VALUES ('76', '1', 'admin/question', 'POST', '127.0.0.1', '{\"question\":\"\\u4f60\\u662f\\u732a\\u5417\",\"order\":\"1\",\"_token\":\"feOutTpAwFs2IFwkQwJ0HYBrvgZUgKOgwJzVa53x\"}', '2017-08-20 08:46:34', '2017-08-20 08:46:34');
INSERT INTO `yh_admin_operation_log` VALUES ('77', '1', 'admin/question/create', 'GET', '127.0.0.1', '[]', '2017-08-20 08:46:34', '2017-08-20 08:46:34');
INSERT INTO `yh_admin_operation_log` VALUES ('78', '1', 'admin/question', 'POST', '127.0.0.1', '{\"question\":\"\\u4f60\\u662f\\u732a\\u5417\",\"order\":\"1\",\"_token\":\"feOutTpAwFs2IFwkQwJ0HYBrvgZUgKOgwJzVa53x\"}', '2017-08-20 08:46:41', '2017-08-20 08:46:41');
INSERT INTO `yh_admin_operation_log` VALUES ('79', '1', 'admin/question', 'GET', '127.0.0.1', '[]', '2017-08-20 08:46:41', '2017-08-20 08:46:41');
INSERT INTO `yh_admin_operation_log` VALUES ('80', '1', 'admin/question', 'GET', '127.0.0.1', '[]', '2017-08-20 11:27:00', '2017-08-20 11:27:00');
INSERT INTO `yh_admin_operation_log` VALUES ('81', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-20 11:27:11', '2017-08-20 11:27:11');
INSERT INTO `yh_admin_operation_log` VALUES ('82', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-20 11:29:27', '2017-08-20 11:29:27');
INSERT INTO `yh_admin_operation_log` VALUES ('83', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-20 11:29:29', '2017-08-20 11:29:29');
INSERT INTO `yh_admin_operation_log` VALUES ('84', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-20 11:29:48', '2017-08-20 11:29:48');
INSERT INTO `yh_admin_operation_log` VALUES ('85', '1', 'admin/setting/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-20 11:30:03', '2017-08-20 11:30:03');
INSERT INTO `yh_admin_operation_log` VALUES ('86', '1', 'admin/question/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-20 11:30:52', '2017-08-20 11:30:52');
INSERT INTO `yh_admin_operation_log` VALUES ('87', '1', 'admin/question', 'POST', '127.0.0.1', '{\"question\":\"\\u56de\\u5c31\\u56de\",\"order\":\"0\",\"_token\":\"IBnnURAthLxNNeHCBW5tt9KnavilWDbPKnBzynRD\",\"_previous_\":\"http:\\/\\/activity.dev\\/admin\\/question\"}', '2017-08-20 11:31:08', '2017-08-20 11:31:08');
INSERT INTO `yh_admin_operation_log` VALUES ('88', '1', 'admin/question', 'GET', '127.0.0.1', '[]', '2017-08-20 11:31:09', '2017-08-20 11:31:09');
INSERT INTO `yh_admin_operation_log` VALUES ('89', '1', 'admin', 'GET', '127.0.0.1', '[]', '2017-08-22 02:24:21', '2017-08-22 02:24:21');
INSERT INTO `yh_admin_operation_log` VALUES ('90', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-22 02:24:25', '2017-08-22 02:24:25');
INSERT INTO `yh_admin_operation_log` VALUES ('91', '1', 'admin/setting/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 02:24:28', '2017-08-22 02:24:28');
INSERT INTO `yh_admin_operation_log` VALUES ('92', '1', 'admin/setting', 'POST', '127.0.0.1', '{\"key\":\"yh_gift\",\"value\":\"40\",\"description\":\"\\u96c5\\u54c8\\u5496\\u5561\\u56db\\u8054\\u88c5\\u793c\\u76d2\",\"_token\":\"c5xkiGoeVLx61cUKINXzJDSKxaO730uizEGWn79u\",\"_previous_\":\"http:\\/\\/activity.dev\\/admin\\/setting\"}', '2017-08-22 02:38:49', '2017-08-22 02:38:49');
INSERT INTO `yh_admin_operation_log` VALUES ('93', '1', 'admin/setting/create', 'GET', '127.0.0.1', '[]', '2017-08-22 02:38:49', '2017-08-22 02:38:49');
INSERT INTO `yh_admin_operation_log` VALUES ('94', '1', 'admin/setting', 'POST', '127.0.0.1', '{\"key\":\"yh_gift\",\"value\":\"40\",\"description\":\"\\u96c5\\u54c8\\u5496\\u5561\\u56db\\u8054\\u88c5\\u793c\\u76d2\",\"_token\":\"c5xkiGoeVLx61cUKINXzJDSKxaO730uizEGWn79u\"}', '2017-08-22 02:40:47', '2017-08-22 02:40:47');
INSERT INTO `yh_admin_operation_log` VALUES ('95', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-22 02:40:47', '2017-08-22 02:40:47');
INSERT INTO `yh_admin_operation_log` VALUES ('96', '1', 'admin/setting/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 02:40:50', '2017-08-22 02:40:50');
INSERT INTO `yh_admin_operation_log` VALUES ('97', '1', 'admin/setting', 'POST', '127.0.0.1', '{\"key\":\"yh_cup\",\"value\":\"40\",\"description\":\"\\u96c5\\u54c8\\u5496\\u5561\\u00d7nice\\u5b9a\\u5236\\u5bf9\\u676f\",\"_token\":\"c5xkiGoeVLx61cUKINXzJDSKxaO730uizEGWn79u\",\"_previous_\":\"http:\\/\\/activity.dev\\/admin\\/setting\"}', '2017-08-22 02:41:25', '2017-08-22 02:41:25');
INSERT INTO `yh_admin_operation_log` VALUES ('98', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-22 02:41:25', '2017-08-22 02:41:25');
INSERT INTO `yh_admin_operation_log` VALUES ('99', '1', 'admin/setting/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 02:41:27', '2017-08-22 02:41:27');
INSERT INTO `yh_admin_operation_log` VALUES ('100', '1', 'admin/setting', 'POST', '127.0.0.1', '{\"key\":\"yh_cash\",\"value\":\"1\",\"description\":\"\\u73b0\\u91d1\\u7ea2\\u5305888\\u5143\",\"_token\":\"c5xkiGoeVLx61cUKINXzJDSKxaO730uizEGWn79u\",\"_previous_\":\"http:\\/\\/activity.dev\\/admin\\/setting\"}', '2017-08-22 02:45:56', '2017-08-22 02:45:56');
INSERT INTO `yh_admin_operation_log` VALUES ('101', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-22 02:45:56', '2017-08-22 02:45:56');
INSERT INTO `yh_admin_operation_log` VALUES ('102', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-22 02:47:31', '2017-08-22 02:47:31');
INSERT INTO `yh_admin_operation_log` VALUES ('103', '1', 'admin/setting/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 02:47:32', '2017-08-22 02:47:32');
INSERT INTO `yh_admin_operation_log` VALUES ('104', '1', 'admin/setting', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 02:47:35', '2017-08-22 02:47:35');
INSERT INTO `yh_admin_operation_log` VALUES ('105', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-22 02:49:13', '2017-08-22 02:49:13');
INSERT INTO `yh_admin_operation_log` VALUES ('106', '1', 'admin/setting/9/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 02:49:15', '2017-08-22 02:49:15');
INSERT INTO `yh_admin_operation_log` VALUES ('107', '1', 'admin/setting', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 02:49:18', '2017-08-22 02:49:18');
INSERT INTO `yh_admin_operation_log` VALUES ('108', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-22 02:49:19', '2017-08-22 02:49:19');
INSERT INTO `yh_admin_operation_log` VALUES ('109', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-22 02:49:20', '2017-08-22 02:49:20');
INSERT INTO `yh_admin_operation_log` VALUES ('110', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-22 02:49:53', '2017-08-22 02:49:53');
INSERT INTO `yh_admin_operation_log` VALUES ('111', '1', 'admin/setting/9/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 02:49:54', '2017-08-22 02:49:54');
INSERT INTO `yh_admin_operation_log` VALUES ('112', '1', 'admin/setting', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 02:49:56', '2017-08-22 02:49:56');
INSERT INTO `yh_admin_operation_log` VALUES ('113', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-22 02:49:57', '2017-08-22 02:49:57');
INSERT INTO `yh_admin_operation_log` VALUES ('114', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-22 02:49:58', '2017-08-22 02:49:58');
INSERT INTO `yh_admin_operation_log` VALUES ('115', '1', 'admin/setting/9/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 02:50:07', '2017-08-22 02:50:07');
INSERT INTO `yh_admin_operation_log` VALUES ('116', '1', 'admin/setting', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 02:50:09', '2017-08-22 02:50:09');
INSERT INTO `yh_admin_operation_log` VALUES ('117', '1', 'admin/setting/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 02:50:11', '2017-08-22 02:50:11');
INSERT INTO `yh_admin_operation_log` VALUES ('118', '1', 'admin/setting', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 02:50:13', '2017-08-22 02:50:13');
INSERT INTO `yh_admin_operation_log` VALUES ('119', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-22 02:50:35', '2017-08-22 02:50:35');
INSERT INTO `yh_admin_operation_log` VALUES ('120', '1', 'admin/setting/9/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 02:50:37', '2017-08-22 02:50:37');
INSERT INTO `yh_admin_operation_log` VALUES ('121', '1', 'admin/setting', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 02:50:39', '2017-08-22 02:50:39');
INSERT INTO `yh_admin_operation_log` VALUES ('122', '1', 'admin/setting/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 02:50:40', '2017-08-22 02:50:40');
INSERT INTO `yh_admin_operation_log` VALUES ('123', '1', 'admin/setting', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 02:50:43', '2017-08-22 02:50:43');
INSERT INTO `yh_admin_operation_log` VALUES ('124', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-22 02:50:58', '2017-08-22 02:50:58');
INSERT INTO `yh_admin_operation_log` VALUES ('125', '1', 'admin/setting/9/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 02:51:05', '2017-08-22 02:51:05');
INSERT INTO `yh_admin_operation_log` VALUES ('126', '1', 'admin/setting/9/edit', 'GET', '127.0.0.1', '[]', '2017-08-22 02:56:11', '2017-08-22 02:56:11');
INSERT INTO `yh_admin_operation_log` VALUES ('127', '1', 'admin/setting/9', 'PUT', '127.0.0.1', '{\"value\":\"40\",\"description\":\"\\u96c5\\u54c8\\u5496\\u5561\\u56db\\u8054\\u88c5\\u793c\\u76d2a\",\"_token\":\"c5xkiGoeVLx61cUKINXzJDSKxaO730uizEGWn79u\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/activity.dev\\/admin\\/setting\"}', '2017-08-22 02:56:18', '2017-08-22 02:56:18');
INSERT INTO `yh_admin_operation_log` VALUES ('128', '1', 'admin/setting/9/edit', 'GET', '127.0.0.1', '[]', '2017-08-22 02:56:19', '2017-08-22 02:56:19');
INSERT INTO `yh_admin_operation_log` VALUES ('129', '1', 'admin/setting/9', 'PUT', '127.0.0.1', '{\"value\":\"40\",\"description\":\"\\u96c5\\u54c8\\u5496\\u5561\\u56db\\u8054\\u88c5\\u793c\\u76d2a\",\"_token\":\"c5xkiGoeVLx61cUKINXzJDSKxaO730uizEGWn79u\",\"_method\":\"PUT\"}', '2017-08-22 02:56:33', '2017-08-22 02:56:33');
INSERT INTO `yh_admin_operation_log` VALUES ('130', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-22 02:56:33', '2017-08-22 02:56:33');
INSERT INTO `yh_admin_operation_log` VALUES ('131', '1', 'admin/setting/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 03:11:30', '2017-08-22 03:11:30');
INSERT INTO `yh_admin_operation_log` VALUES ('132', '1', 'admin/setting', 'POST', '127.0.0.1', '{\"key\":\"yh_gift_chance\",\"value\":\"5\",\"description\":\"5%\\u7684\\u6982\\u7387\",\"_token\":\"c5xkiGoeVLx61cUKINXzJDSKxaO730uizEGWn79u\",\"_previous_\":\"http:\\/\\/activity.dev\\/admin\\/setting\"}', '2017-08-22 03:12:44', '2017-08-22 03:12:44');
INSERT INTO `yh_admin_operation_log` VALUES ('133', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-22 03:12:44', '2017-08-22 03:12:44');
INSERT INTO `yh_admin_operation_log` VALUES ('134', '1', 'admin/setting/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 03:13:22', '2017-08-22 03:13:22');
INSERT INTO `yh_admin_operation_log` VALUES ('135', '1', 'admin/setting', 'POST', '127.0.0.1', '{\"key\":\"yh_cup_chance\",\"value\":\"3\",\"description\":\"3%\\u7684\\u6982\\u7387\",\"_token\":\"c5xkiGoeVLx61cUKINXzJDSKxaO730uizEGWn79u\",\"_previous_\":\"http:\\/\\/activity.dev\\/admin\\/setting\"}', '2017-08-22 03:13:51', '2017-08-22 03:13:51');
INSERT INTO `yh_admin_operation_log` VALUES ('136', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-22 03:13:51', '2017-08-22 03:13:51');
INSERT INTO `yh_admin_operation_log` VALUES ('137', '1', 'admin/setting/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 03:14:00', '2017-08-22 03:14:00');
INSERT INTO `yh_admin_operation_log` VALUES ('138', '1', 'admin/setting', 'POST', '127.0.0.1', '{\"key\":\"yh_cash_chance\",\"value\":\"1\",\"description\":\"1%\\u7684\\u6982\\u7387\",\"_token\":\"c5xkiGoeVLx61cUKINXzJDSKxaO730uizEGWn79u\",\"_previous_\":\"http:\\/\\/activity.dev\\/admin\\/setting\"}', '2017-08-22 03:14:19', '2017-08-22 03:14:19');
INSERT INTO `yh_admin_operation_log` VALUES ('139', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-22 03:14:19', '2017-08-22 03:14:19');
INSERT INTO `yh_admin_operation_log` VALUES ('140', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-22 08:36:28', '2017-08-22 08:36:28');
INSERT INTO `yh_admin_operation_log` VALUES ('141', '1', 'admin/setting/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 08:49:49', '2017-08-22 08:49:49');
INSERT INTO `yh_admin_operation_log` VALUES ('142', '1', 'admin/setting', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2017-08-22 08:49:54', '2017-08-22 08:49:54');
INSERT INTO `yh_admin_operation_log` VALUES ('143', '1', 'admin/setting', 'GET', '127.0.0.1', '[]', '2017-08-23 03:29:57', '2017-08-23 03:29:57');

-- ----------------------------
-- Table structure for yh_admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `yh_admin_permissions`;
CREATE TABLE `yh_admin_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_permissions_name_unique` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of yh_admin_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for yh_admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `yh_admin_roles`;
CREATE TABLE `yh_admin_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_roles_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of yh_admin_roles
-- ----------------------------
INSERT INTO `yh_admin_roles` VALUES ('1', 'Administrator', 'administrator', '2017-08-08 08:28:24', '2017-08-08 08:28:24');

-- ----------------------------
-- Table structure for yh_admin_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `yh_admin_role_menu`;
CREATE TABLE `yh_admin_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of yh_admin_role_menu
-- ----------------------------
INSERT INTO `yh_admin_role_menu` VALUES ('1', '2', null, null);
INSERT INTO `yh_admin_role_menu` VALUES ('1', '8', null, null);

-- ----------------------------
-- Table structure for yh_admin_role_permissions
-- ----------------------------
DROP TABLE IF EXISTS `yh_admin_role_permissions`;
CREATE TABLE `yh_admin_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of yh_admin_role_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for yh_admin_role_users
-- ----------------------------
DROP TABLE IF EXISTS `yh_admin_role_users`;
CREATE TABLE `yh_admin_role_users` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of yh_admin_role_users
-- ----------------------------
INSERT INTO `yh_admin_role_users` VALUES ('1', '1', null, null);

-- ----------------------------
-- Table structure for yh_admin_users
-- ----------------------------
DROP TABLE IF EXISTS `yh_admin_users`;
CREATE TABLE `yh_admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of yh_admin_users
-- ----------------------------
INSERT INTO `yh_admin_users` VALUES ('1', 'admin', '$2y$10$d1FbJdJxxTIL0brleOwGBu/fDwtSfEMxQ73jCAnxC4CD9VXHg4Mx2', 'Administrator', null, null, '2017-08-08 08:28:24', '2017-08-08 08:28:24');

-- ----------------------------
-- Table structure for yh_admin_user_permissions
-- ----------------------------
DROP TABLE IF EXISTS `yh_admin_user_permissions`;
CREATE TABLE `yh_admin_user_permissions` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_user_permissions_user_id_permission_id_index` (`user_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of yh_admin_user_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for yh_comment
-- ----------------------------
DROP TABLE IF EXISTS `yh_comment`;
CREATE TABLE `yh_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) DEFAULT NULL COMMENT '评论类容',
  `uid` int(11) DEFAULT NULL,
  `created_at` int(255) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `channel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yh_comment
-- ----------------------------
INSERT INTO `yh_comment` VALUES ('1', '你好', '1', '1502807193', '1502807193', '1');
INSERT INTO `yh_comment` VALUES ('2', '你好', '1', '1502807243', '1502807243', '1');
INSERT INTO `yh_comment` VALUES ('3', '你好', '1', '1502807274', '1502807274', '1');

-- ----------------------------
-- Table structure for yh_image
-- ----------------------------
DROP TABLE IF EXISTS `yh_image`;
CREATE TABLE `yh_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `module` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '0:left,1:right',
  `path` varchar(255) DEFAULT NULL,
  `picInfo` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `origin` int(10) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `module` (`module`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yh_image
-- ----------------------------
INSERT INTO `yh_image` VALUES ('9', '1', '1', '0', '//ricefur.oss-cn-beijing.aliyuncs.com/yh-activity/2017/08/18/20170818060328531103.jpg', null, '1503037405', '1503037405', null, '0000000000');
INSERT INTO `yh_image` VALUES ('19', '1', '1', '1', '//ricefur.oss-cn-beijing.aliyuncs.com/yh-activity/2017/08/18/20170818062434404348.png', null, '1503038558', '1503038558', null, '0000000009');
INSERT INTO `yh_image` VALUES ('20', '1', '1', '0', 'http:\\/\\/img08.oneniceapp.com\\/upload\\/show\\/2017\\/08\\/25\\/f46229bcd1acceb12c3b953199c46219.jpg', null, '1503652503', '1503652503', null, '0000000000');
INSERT INTO `yh_image` VALUES ('21', '1', '2', '0', 'http:\\/\\/img08.oneniceapp.com\\/upload\\/show\\/2017\\/08\\/25\\/f46229bcd1acceb12c3b953199c46219.jpg', null, '1503652546', '1503652546', null, '0000000000');
INSERT INTO `yh_image` VALUES ('22', '1', '2', '0', 'http:\\/\\/img08.oneniceapp.com\\/upload\\/show\\/2017\\/08\\/25\\/f46229bcd1acceb12c3b953199c46219.jpg', null, '1503652683', '1503652683', null, '0000000000');
INSERT INTO `yh_image` VALUES ('23', '1', '2', '1', 'http:\\/\\/img08.oneniceapp.com\\/upload\\/show\\/2017\\/08\\/25\\/f46229bcd1acceb12c3b953199c46219.jpg', null, '1503652715', '1503652715', null, '0000000021');
INSERT INTO `yh_image` VALUES ('24', '1', '2', '1', 'http:\\/\\/img08.oneniceapp.com\\/upload\\/show\\/2017\\/08\\/25\\/f46229bcd1acceb12c3b953199c46219.jpg', null, '1503652717', '1503652717', null, '0000000022');
INSERT INTO `yh_image` VALUES ('25', '1', '3', '0', 'http:\\/\\/img08.oneniceapp.com\\/upload\\/show\\/2017\\/08\\/25\\/f46229bcd1acceb12c3b953199c46219.jpg', null, '1503652797', '1503652797', null, '0000000000');
INSERT INTO `yh_image` VALUES ('26', '1', '3', '1', 'http:\\/\\/img08.oneniceapp.com\\/upload\\/show\\/2017\\/08\\/25\\/f46229bcd1acceb12c3b953199c46219.jpg', null, '1503652805', '1503652805', null, '0000000025');
INSERT INTO `yh_image` VALUES ('27', '1', '3', '1', 'http:\\/\\/img08.oneniceapp.com\\/upload\\/show\\/2017\\/08\\/25\\/f46229bcd1acceb12c3b953199c46219.jpg', null, '1503652812', '1503652812', null, '0000000025');
INSERT INTO `yh_image` VALUES ('28', '1', '3', '1', 'http:\\/\\/img08.oneniceapp.com\\/upload\\/show\\/2017\\/08\\/25\\/f46229bcd1acceb12c3b953199c46219.jpg', null, '1503652817', '1503652817', null, '0000000025');
INSERT INTO `yh_image` VALUES ('29', '1', '4', '0', 'http:\\/\\/img08.oneniceapp.com\\/upload\\/show\\/2017\\/08\\/25\\/f46229bcd1acceb12c3b953199c46219.jpg', null, '1503652827', '1503652827', null, '0000000000');
INSERT INTO `yh_image` VALUES ('30', '1', '4', '1', 'http:\\/\\/img08.oneniceapp.com\\/upload\\/show\\/2017\\/08\\/25\\/f46229bcd1acceb12c3b953199c46219.jpg', null, '1503652842', '1503652842', null, '0000000029');
INSERT INTO `yh_image` VALUES ('31', '1', '4', '1', 'http:\\/\\/img08.oneniceapp.com\\/upload\\/show\\/2017\\/08\\/25\\/f46229bcd1acceb12c3b953199c46219.jpg', null, '1503652843', '1503652843', null, '0000000029');
INSERT INTO `yh_image` VALUES ('32', '1', '4', '1', 'http:\\/\\/img08.oneniceapp.com\\/upload\\/show\\/2017\\/08\\/25\\/f46229bcd1acceb12c3b953199c46219.jpg', null, '1503652845', '1503652845', null, '0000000029');
INSERT INTO `yh_image` VALUES ('33', '1', '1', '0', '//ricefur.oss-cn-beijing.aliyuncs.com/yh-activity/2017/08/18/20170818060328531103.jpg', null, '1503848110', '1503848110', null, '0000000000');

-- ----------------------------
-- Table structure for yh_like
-- ----------------------------
DROP TABLE IF EXISTS `yh_like`;
CREATE TABLE `yh_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `module` int(11) DEFAULT NULL COMMENT '1-图片 2视频',
  `target_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `child` int(11) DEFAULT NULL COMMENT '子模块',
  PRIMARY KEY (`id`),
  KEY `module_target` (`module`,`child`,`target_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yh_like
-- ----------------------------
INSERT INTO `yh_like` VALUES ('45', '1', '1', '19', '1503558441', '1503558441', '1');
INSERT INTO `yh_like` VALUES ('46', '1', '1', '19', '1503558444', '1503558444', '1');
INSERT INTO `yh_like` VALUES ('47', '1', '1', '19', '1503558445', '1503558445', '1');
INSERT INTO `yh_like` VALUES ('48', '1', '1', '19', '1503558446', '1503558446', '1');
INSERT INTO `yh_like` VALUES ('49', '1', '1', '19', '1503558447', '1503558447', '1');
INSERT INTO `yh_like` VALUES ('50', '1', '1', '9', '1503558458', '1503558458', '1');
INSERT INTO `yh_like` VALUES ('51', '1', '1', '9', '1503558460', '1503558460', '1');
INSERT INTO `yh_like` VALUES ('52', '1', '1', '9', '1503558461', '1503558461', '1');
INSERT INTO `yh_like` VALUES ('53', '1', '1', '9', '1503558461', '1503558461', '1');
INSERT INTO `yh_like` VALUES ('54', '1', '1', '9', '1503558462', '1503558462', '1');
INSERT INTO `yh_like` VALUES ('55', '1', '1', '21', '1503653041', '1503653041', '2');
INSERT INTO `yh_like` VALUES ('56', '1', '1', '21', '1503653045', '1503653045', '2');
INSERT INTO `yh_like` VALUES ('57', '1', '1', '21', '1503653046', '1503653046', '2');
INSERT INTO `yh_like` VALUES ('58', '1', '1', '21', '1503653046', '1503653046', '2');
INSERT INTO `yh_like` VALUES ('59', '1', '1', '21', '1503653047', '1503653047', '2');
INSERT INTO `yh_like` VALUES ('60', '1', '1', '23', '1503653114', '1503653114', '2');
INSERT INTO `yh_like` VALUES ('61', '1', '1', '23', '1503653116', '1503653116', '2');
INSERT INTO `yh_like` VALUES ('62', '1', '1', '24', '1503653125', '1503653125', '2');
INSERT INTO `yh_like` VALUES ('63', '1', '1', '24', '1503653125', '1503653125', '2');
INSERT INTO `yh_like` VALUES ('64', '1', '1', '24', '1503653126', '1503653126', '2');
INSERT INTO `yh_like` VALUES ('65', '1', '1', '26', '1503653154', '1503653154', '3');
INSERT INTO `yh_like` VALUES ('66', '1', '1', '26', '1503653155', '1503653155', '3');
INSERT INTO `yh_like` VALUES ('67', '1', '1', '26', '1503653156', '1503653156', '3');
INSERT INTO `yh_like` VALUES ('68', '1', '1', '26', '1503653157', '1503653157', '3');
INSERT INTO `yh_like` VALUES ('69', '1', '1', '28', '1503653168', '1503653168', '3');
INSERT INTO `yh_like` VALUES ('70', '1', '1', '28', '1503653169', '1503653169', '3');
INSERT INTO `yh_like` VALUES ('71', '1', '1', '27', '1503653180', '1503653180', '3');
INSERT INTO `yh_like` VALUES ('72', '1', '1', '27', '1503653181', '1503653181', '3');
INSERT INTO `yh_like` VALUES ('73', '1', '1', '27', '1503653183', '1503653183', '3');
INSERT INTO `yh_like` VALUES ('74', '1', '1', '27', '1503653183', '1503653183', '3');
INSERT INTO `yh_like` VALUES ('75', '1', '1', '27', '1503653184', '1503653184', '3');
INSERT INTO `yh_like` VALUES ('76', '1', '1', '30', '1503653198', '1503653198', '4');
INSERT INTO `yh_like` VALUES ('77', '1', '1', '30', '1503653199', '1503653199', '4');
INSERT INTO `yh_like` VALUES ('78', '1', '1', '30', '1503653200', '1503653200', '4');
INSERT INTO `yh_like` VALUES ('79', '1', '1', '24', '1503905741', '1503905741', '2');
INSERT INTO `yh_like` VALUES ('80', '1', '1', '24', '1503905781', '1503905781', '2');
INSERT INTO `yh_like` VALUES ('81', '1', '1', '24', '1503905782', '1503905782', '2');
INSERT INTO `yh_like` VALUES ('82', '1', '1', '24', '1503905783', '1503905783', '2');
INSERT INTO `yh_like` VALUES ('83', '1', '1', '24', '1503905783', '1503905783', '2');
INSERT INTO `yh_like` VALUES ('84', '1', '1', '23', '1503906136', '1503906136', '2');
INSERT INTO `yh_like` VALUES ('85', '1', '1', '23', '1503906142', '1503906142', '2');
INSERT INTO `yh_like` VALUES ('86', '1', '1', '23', '1503906143', '1503906143', '2');
INSERT INTO `yh_like` VALUES ('87', '1', '1', '23', '1503906143', '1503906143', '2');
INSERT INTO `yh_like` VALUES ('88', '1', '1', '23', '1503906144', '1503906144', '2');
INSERT INTO `yh_like` VALUES ('89', '1', '1', '26', '1503906417', '1503906417', '3');
INSERT INTO `yh_like` VALUES ('90', '1', '1', '26', '1503906423', '1503906423', '3');
INSERT INTO `yh_like` VALUES ('91', '1', '1', '26', '1503906423', '1503906423', '3');
INSERT INTO `yh_like` VALUES ('92', '1', '1', '26', '1503906424', '1503906424', '3');
INSERT INTO `yh_like` VALUES ('93', '1', '1', '26', '1503906424', '1503906424', '3');
INSERT INTO `yh_like` VALUES ('94', '1', '1', '28', '1503906449', '1503906449', '3');
INSERT INTO `yh_like` VALUES ('95', '1', '1', '28', '1503906450', '1503906450', '3');
INSERT INTO `yh_like` VALUES ('96', '1', '1', '28', '1503906451', '1503906451', '3');
INSERT INTO `yh_like` VALUES ('97', '1', '1', '28', '1503906451', '1503906451', '3');
INSERT INTO `yh_like` VALUES ('98', '1', '1', '28', '1503906452', '1503906452', '3');
INSERT INTO `yh_like` VALUES ('99', '1', '1', '32', '1503909175', '1503909175', '4');
INSERT INTO `yh_like` VALUES ('100', '1', '1', '32', '1503909226', '1503909226', '4');
INSERT INTO `yh_like` VALUES ('101', '1', '1', '32', '1503909276', '1503909276', '4');
INSERT INTO `yh_like` VALUES ('102', '1', '1', '32', '1503909359', '1503909359', '4');
INSERT INTO `yh_like` VALUES ('103', '1', '1', '32', '1503909415', '1503909415', '4');
INSERT INTO `yh_like` VALUES ('104', '1', '1', '31', '1503909426', '1503909426', '4');
INSERT INTO `yh_like` VALUES ('105', '1', '1', '31', '1503909427', '1503909427', '4');
INSERT INTO `yh_like` VALUES ('106', '1', '1', '31', '1503909428', '1503909428', '4');
INSERT INTO `yh_like` VALUES ('107', '1', '1', '31', '1503909428', '1503909428', '4');
INSERT INTO `yh_like` VALUES ('108', '1', '1', '31', '1503909429', '1503909429', '4');
INSERT INTO `yh_like` VALUES ('109', '1', '1', '19', '1503913330', '1503913330', '1');
INSERT INTO `yh_like` VALUES ('110', '1', '1', '19', '1503913331', '1503913331', '1');
INSERT INTO `yh_like` VALUES ('111', '1', '1', '19', '1503913332', '1503913332', '1');
INSERT INTO `yh_like` VALUES ('112', '1', '1', '19', '1503913332', '1503913332', '1');
INSERT INTO `yh_like` VALUES ('113', '1', '1', '19', '1503913333', '1503913333', '1');

-- ----------------------------
-- Table structure for yh_migrations
-- ----------------------------
DROP TABLE IF EXISTS `yh_migrations`;
CREATE TABLE `yh_migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of yh_migrations
-- ----------------------------
INSERT INTO `yh_migrations` VALUES ('1', '2016_01_04_173148_create_admin_tables', '1');

-- ----------------------------
-- Table structure for yh_question
-- ----------------------------
DROP TABLE IF EXISTS `yh_question`;
CREATE TABLE `yh_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yh_question
-- ----------------------------
INSERT INTO `yh_question` VALUES ('1', '你是帅哥吗', '1', null, null);
INSERT INTO `yh_question` VALUES ('2', '你是猪吗', '1', '1503218801', '1503218801');
INSERT INTO `yh_question` VALUES ('3', '回就回', '0', '1503228669', '1503228669');

-- ----------------------------
-- Table structure for yh_settings
-- ----------------------------
DROP TABLE IF EXISTS `yh_settings`;
CREATE TABLE `yh_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` mediumtext,
  `description` varchar(255) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COMMENT='系统设置表';

-- ----------------------------
-- Records of yh_settings
-- ----------------------------
INSERT INTO `yh_settings` VALUES ('9', 'yh_gift', '9', '雅哈咖啡四联装礼盒a', '1503369647', '1503370593');
INSERT INTO `yh_settings` VALUES ('10', 'yh_cup', '10', '雅哈咖啡×nice定制对杯', '1503369685', '1503369685');
INSERT INTO `yh_settings` VALUES ('11', 'yh_cash', '0', '现金红包888元', '1503369956', '1503369956');
INSERT INTO `yh_settings` VALUES ('12', 'yh_gift_chance', '5', '5%的概率', '1503371564', '1503371564');
INSERT INTO `yh_settings` VALUES ('13', 'yh_cup_chance', '3', '3%的概率', '1503371631', '1503371631');
INSERT INTO `yh_settings` VALUES ('14', 'yh_cash_chance', '1', '1%的概率', '1503371659', '1503371659');

-- ----------------------------
-- Table structure for yh_users
-- ----------------------------
DROP TABLE IF EXISTS `yh_users`;
CREATE TABLE `yh_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) NOT NULL,
  `unionid` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `profile` mediumtext,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `headicon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yh_users
-- ----------------------------
INSERT INTO `yh_users` VALUES ('1', '1', 'asdadasds', 'asdas', null, '18705191169', '张帆', null, '1502800399', '1502800399', null);

-- ----------------------------
-- Table structure for yh_video
-- ----------------------------
DROP TABLE IF EXISTS `yh_video`;
CREATE TABLE `yh_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `module` int(11) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `videoinfo` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `qid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `module` (`module`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yh_video
-- ----------------------------
INSERT INTO `yh_video` VALUES ('2', '1', '1', '//ricefur.oss-cn-beijing.aliyuncs.com/yh-activity/2017/08/17/20170817070214296380.mp4', '[{\"type\":\"mp4\"}]', '1502953752', '1502953752', '1');
INSERT INTO `yh_video` VALUES ('3', '1', '2', '//ricefur.oss-cn-beijing.aliyuncs.com/yh-activity/2017/08/17/20170817070214296380.mp4', '[{\"type\":\"png\"}]', '1502953923', '1502953923', '1');
INSERT INTO `yh_video` VALUES ('4', '1', '3', '//ricefur.oss-cn-beijing.aliyuncs.com/yh-activity/2017/08/17/20170817070214296380.mp4', '[{\"type\":\"mp4\"}]', '1502953932', '1502953932', '1');
INSERT INTO `yh_video` VALUES ('5', '1', '4', '//ricefur.oss-cn-beijing.aliyuncs.com/yh-activity/2017/08/17/20170817070214296380.mp4', '[{\"type\":\"mp4\"}]', '1502953937', '1502953937', '1');
INSERT INTO `yh_video` VALUES ('6', '1', '2', '//ricefur.oss-cn-beijing.aliyuncs.com/yh-activity/2017/08/16/20170816135013144219.jpg', '[{\"type\":\"mp4\"}]', '1502954729', '1502954729', '1');
INSERT INTO `yh_video` VALUES ('7', '1', '2', '//ricefur.oss-cn-beijing.aliyuncs.com/yh-activity/2017/08/16/20170816135013144219.jpg', '[{\"type\":\"mp4\"}]', '1502954732', '1502954732', '1');
INSERT INTO `yh_video` VALUES ('8', '1', '3', '//ricefur.oss-cn-beijing.aliyuncs.com/yh-activity/2017/08/16/20170816135013144219.jpg', '[{\"type\":\"mp4\"}]', '1502954735', '1502954735', '1');
INSERT INTO `yh_video` VALUES ('9', '1', '4', '//ricefur.oss-cn-beijing.aliyuncs.com/yh-activity/2017/08/16/20170816135013144219.jpg', '[{\"type\":\"mp4\"}]', '1502954737', '1502954737', '1');
INSERT INTO `yh_video` VALUES ('10', '1', '4', '//ricefur.oss-cn-beijing.aliyuncs.com/yh-activity/2017/08/16/20170816135013144219.jpg', '[{\"type\":\"mp4\"}]', '1502954739', '1502954739', '1');
INSERT INTO `yh_video` VALUES ('11', '1', '4', '//ricefur.oss-cn-beijing.aliyuncs.com/yh-activity/2017/08/16/20170816135013144219.jpg', '[{\"type\":\"mp4\"}]', '1502954740', '1502954740', '1');

-- ----------------------------
-- Table structure for yh_win
-- ----------------------------
DROP TABLE IF EXISTS `yh_win`;
CREATE TABLE `yh_win` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `is_win` int(11) NOT NULL DEFAULT '0' COMMENT '是否中奖0-没中奖 1-中奖',
  `win_lv` int(11) NOT NULL DEFAULT '0' COMMENT '0-谢谢参与 1-1等奖....',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `page_url` varchar(255) NOT NULL COMMENT '晒单照片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yh_win
-- ----------------------------
INSERT INTO `yh_win` VALUES ('53', '1', '0', '0', '1503469370', '1503469370', 'www.baidu.com');
INSERT INTO `yh_win` VALUES ('54', '2', '0', '0', '1503469381', '1503469381', 'www.baidu.com');
INSERT INTO `yh_win` VALUES ('55', '3', '0', '0', '1503469386', '1503469386', 'www.baidu.com');
INSERT INTO `yh_win` VALUES ('56', '4', '0', '0', '1503469416', '1503469416', 'www.baidu.com');
INSERT INTO `yh_win` VALUES ('57', '5', '0', '0', '1503469422', '1503469422', 'www.baidu.com');
INSERT INTO `yh_win` VALUES ('58', '6', '1', '3', '1503469427', '1503469427', 'www.baidu.com');
INSERT INTO `yh_win` VALUES ('59', '7', '0', '0', '1503469446', '1503469446', 'www.baidu.com');
INSERT INTO `yh_win` VALUES ('60', '8', '0', '0', '1503469454', '1503469454', 'www.baidu.com');
INSERT INTO `yh_win` VALUES ('61', '9', '0', '0', '1503469459', '1503469459', 'www.baidu.com');
INSERT INTO `yh_win` VALUES ('62', '10', '1', '1', '1503469463', '1503469463', 'www.baidu.com');
