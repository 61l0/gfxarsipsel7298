/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : 127.0.0.1:3306
Source Database       : db_arsip

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2014-07-03 22:13:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `c_user`
-- ----------------------------
DROP TABLE IF EXISTS `c_user`;
CREATE TABLE `c_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` tinyint(4) DEFAULT NULL,
  `user_name` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `user_password` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `instansi` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `id_skpd_sotk` int(11) NOT NULL,
  `nama_pengguna` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `id_unit_pengolah` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of c_user
-- ----------------------------
INSERT INTO `c_user` VALUES ('1', '1', 'superadmin', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', 'Superadministrator', '0', 'Khairul Anwar', '40');
INSERT INTO `c_user` VALUES ('2', '2', 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Dindin', '44', 'Dindin', '40');
INSERT INTO `c_user` VALUES ('52', '5', 'arsip_cms', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', 'dwie', '0', 'dwie', '40');
INSERT INTO `c_user` VALUES ('20', '6', 'JUMHANA', 'c75b7ce848979cba0469278e2263c53fc8f2e04d', 'operator1', '44', 'JUMHANA', '40');
INSERT INTO `c_user` VALUES ('4', '6', 'depo2', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', 'Darama', '44', 'depo2', '40');
INSERT INTO `c_user` VALUES ('5', '6', 'DINNY', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', 'Ali Pasa Alhakim', '44', 'DINNY', '40');
INSERT INTO `c_user` VALUES ('6', '6', 'test', '64c6a90683ce6c5062ba614d3463e3a3f34dfb04', 'operator4', '44', 'Okem', '40');
INSERT INTO `c_user` VALUES ('7', '6', 'depo4', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'depo4', '40');
INSERT INTO `c_user` VALUES ('8', '6', 'FIFI', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', 'Ahmad', '10', 'FIFI', '40');
INSERT INTO `c_user` VALUES ('9', '6', 'ANANGSUNARDI', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'ANANGSUNARDI', '40');
INSERT INTO `c_user` VALUES ('10', '6', 'AGUSDAROJAT', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'AGUSDAROJAT', '40');
INSERT INTO `c_user` VALUES ('21', '6', 'NETTI', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'NETTI', '40');
INSERT INTO `c_user` VALUES ('13', '6', 'SRIHANDAYANI', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'SRIHANDAYANI', '40');
INSERT INTO `c_user` VALUES ('14', '6', 'DIDIN', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'DIDIN', '40');
INSERT INTO `c_user` VALUES ('19', '6', 'SATNAHWATI', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'SATNAHWATI', '40');
INSERT INTO `c_user` VALUES ('16', '6', 'SAMSUDIN', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'SAMSUDIN', '40');
INSERT INTO `c_user` VALUES ('17', '6', 'SRIUTAMI', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'SRIUTAMI', '40');
INSERT INTO `c_user` VALUES ('18', '6', 'CHATLINA', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'CHATLINA', '40');
INSERT INTO `c_user` VALUES ('22', '6', 'DADANG', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'DADANG', '40');
INSERT INTO `c_user` VALUES ('23', '6', 'MAYA', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'MAYA', '40');
INSERT INTO `c_user` VALUES ('24', '6', 'CUCUSURYANI', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'CUCUSURYANI', '40');
INSERT INTO `c_user` VALUES ('25', '6', 'JUNAEDI', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'JUNAEDI', '40');
INSERT INTO `c_user` VALUES ('26', '6', 'YULIARSYAM', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'YULIARSYAM', '40');
INSERT INTO `c_user` VALUES ('27', '6', 'SUPARMAN', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'SUPARMAN', '40');
INSERT INTO `c_user` VALUES ('28', '6', 'WIDODO', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'WIDODO', '40');
INSERT INTO `c_user` VALUES ('29', '6', 'SIFAH', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'SIFAH', '40');
INSERT INTO `c_user` VALUES ('30', '6', 'yasin', 'c74b92b8a2d37015162a9b0f8f3c26369f78b772', null, '44', 'yasin', '40');
INSERT INTO `c_user` VALUES ('65', '6', 'wahyuni', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Sri Wahyuni', '0', 'Sri Wahyuni', '10');
INSERT INTO `c_user` VALUES ('64', '3', 'bbd33', '8078d62377a127125bfcc3f9b47524d911b797d2', 'bbd33', '8', 'Putra Budiman', '10');
