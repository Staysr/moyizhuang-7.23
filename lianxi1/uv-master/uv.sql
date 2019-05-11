# Host: 127.0.0.1  (Version: 5.5.40)
# Date: 2018-04-27 01:57:17
# Generator: MySQL-Front 5.3  (Build 4.120)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "info"
#

DROP TABLE IF EXISTS `info`;
CREATE TABLE `info` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `name_id` varchar(255) DEFAULT NULL,
  `fans` varchar(255) DEFAULT NULL,
  `sex_f` varchar(255) DEFAULT NULL,
  `uv` int(11) DEFAULT NULL,
  `jg` double DEFAULT NULL,
  `jg1` double DEFAULT NULL,
  `qq` varchar(255) DEFAULT NULL,
  `yg` varchar(255) DEFAULT NULL,
  `xs` varchar(255) DEFAULT NULL,
  `lb` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

#
# Data for table "info"
#

/*!40000 ALTER TABLE `info` DISABLE KEYS */;
INSERT INTO `info` VALUES (1,'影视娱乐城','abc123','2143214','',0,0,0,'120154788',NULL,'1','10','11'),(2,'芭蕾','1561','3213','1.5',3123123,2,3,'3123123',NULL,'0','1','11'),(3,'游戏','21321','32132','1.3',3213,3,5,'26263',NULL,'0','10','admin');
/*!40000 ALTER TABLE `info` ENABLE KEYS */;

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `admin` int(11) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "user"
#

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'11','11','11',0),(2,'admin','2018adminss','管理员',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
