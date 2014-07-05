/*
MySQL Data Transfer
Source Host: 127.0.0.1
Source Database: db_arsip
Target Host: 127.0.0.1
Target Database: db_arsip
Date: 6/23/2014 9:34:12 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for arsip_job
-- ----------------------------
DROP TABLE IF EXISTS `arsip_job`;
CREATE TABLE `arsip_job` (
  `token` varchar(225) NOT NULL,
  `progress` int(11) DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `date_started` datetime DEFAULT NULL,
  `date_ended` datetime DEFAULT NULL,
  PRIMARY KEY (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `arsip_job` VALUES ('07c2a4cc06167cae6be3d724b1c02876', '100', 'COMPLETE', '2014-06-22 06:25:00', '2014-06-22 06:25:00');
INSERT INTO `arsip_job` VALUES ('0dc2af89846e2ddb0a5a10bcc386d731', '100', 'COMPLETE', '2014-06-22 16:42:02', '2014-06-22 16:42:02');
INSERT INTO `arsip_job` VALUES ('4f2f97c64ec690ec86a6fddab5fa16cb', '100', 'COMPLETE', '2014-06-19 13:23:51', '2014-06-19 13:23:56');
INSERT INTO `arsip_job` VALUES ('8798eb5b7cbf0ee7c4569d5827120bf5', '100', 'COMPLETE', '2014-06-20 17:53:12', '2014-06-20 17:53:12');
INSERT INTO `arsip_job` VALUES ('ac16f9f10f5ef1afc6787ff33526193b', '100', 'COMPLETE', '2014-06-21 15:15:02', '2014-06-21 15:15:02');
INSERT INTO `arsip_job` VALUES ('db78fd7d2c5ebe7a6ac313356e469150', '100', 'COMPLETE', '2014-06-19 18:09:13', '2014-06-19 18:09:13');
