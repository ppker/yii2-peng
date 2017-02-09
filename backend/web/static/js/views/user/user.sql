/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 50714
Source Host           : 127.0.0.1:3306
Source Database       : yii2-peng

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-02-09 09:08:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别',
  `avatar` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '头像',
  `signature` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '个性签名',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '0', '', '我是一只小鱼人', 'se12G7gpXVZGk8QTO2H5DYh4fz0s2GKE', '$2y$13$.fVfZfmW/48XyUMKfqF5le.4FxRiTzhh7BINbwKb5HCoL3u82nh82', null, '1366525100@qq.com', '10', '1484749417', '1484749417');
INSERT INTO `user` VALUES ('2', 'ppker', '0', '', '', 'LupUDlJWiWB-Qt92WeqL9t2viXrXAJga', '$2y$13$T/H.Kb.4SVwl1vYEdJR6TejNDHlWkhBWf9OY.r22lTnxDyj/7UGme', null, '454545@qq.com', '10', '1486576456', '1486576456');
INSERT INTO `user` VALUES ('3', 'jiudi', '0', '', '', 'KiwDfvZGYt_W1vnwrvMsYq6j71WMzVB1', '$2y$13$HbG5r3Mcgavr0QOwPmEIJ.dLWL1hMKG7AjrCkLhbuNN/Kj0ta04xa', null, 'jiudi@163.com', '10', '1486576811', '1486576811');
