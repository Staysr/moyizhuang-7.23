-- ----------------------------
-- Table structure for pv_advert
-- ----------------------------
DROP TABLE IF EXISTS `pv_advert`;
CREATE TABLE `pv_advert` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ckey` varchar(32) NOT NULL DEFAULT '',
  `descrip` varchar(255) NOT NULL DEFAULT '',
  `config` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pv_artclass
-- ----------------------------
DROP TABLE IF EXISTS `pv_artclass`;
CREATE TABLE `pv_artclass` (
  `cid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `caption` varchar(80) NOT NULL DEFAULT '',
  `vieworder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pv_artclass
-- ----------------------------
INSERT INTO `pv_artclass` VALUES ('1', '网站公告', '0');
INSERT INTO `pv_artclass` VALUES ('2', '帮助文档', '0');

-- ----------------------------
-- Table structure for pv_article
-- ----------------------------
DROP TABLE IF EXISTS `pv_article`;
CREATE TABLE `pv_article` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `classid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `author` char(20) NOT NULL DEFAULT '',
  `authorid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `vieworder` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pv_buy
-- ----------------------------
DROP TABLE IF EXISTS `pv_buy`;
CREATE TABLE `pv_buy` (
  `bid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`bid`),
  KEY `vid` (`vid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pv_class
-- ----------------------------
DROP TABLE IF EXISTS `pv_class`;
CREATE TABLE `pv_class` (
  `cid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `cup` smallint(6) unsigned NOT NULL DEFAULT '0',
  `lv` tinyint(2) NOT NULL DEFAULT '0',
  `fathers` varchar(255) NOT NULL DEFAULT '',
  `caption` varchar(80) NOT NULL DEFAULT '',
  `vieworder` tinyint(3) NOT NULL DEFAULT '0',
  `type` enum('hidden','members','free') NOT NULL DEFAULT 'free',
  `orderway` enum('replier','hits','lastdate','postdate') NOT NULL DEFAULT 'postdate',
  `orderasc` tinyint(1) NOT NULL DEFAULT '1',
  `link` varchar(255) NOT NULL DEFAULT '',
  `tplfile` varchar(255) NOT NULL DEFAULT '',
  `read_tplfile` varchar(255) NOT NULL DEFAULT '',
  `play_tplfile` varchar(255) NOT NULL DEFAULT '',
  `atccheck` tinyint(1) NOT NULL DEFAULT '0',
  `rvrcneed` int(11) NOT NULL DEFAULT '0',
  `moneyneed` int(11) NOT NULL DEFAULT '0',
  `postneed` int(11) NOT NULL DEFAULT '0',
  `password` char(32) NOT NULL DEFAULT '',
  `allowvisit` varchar(255) NOT NULL DEFAULT '',
  `allowplay` varchar(255) NOT NULL DEFAULT '',
  `allowpost` varchar(255) NOT NULL DEFAULT '',
  `allowrp` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`cid`),
  KEY `hup` (`cup`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pv_class
-- ----------------------------
INSERT INTO `pv_class` VALUES ('1', '0', '0', '', '电影', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('2', '0', '0', '', '电视剧', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('3', '0', '0', '', '动漫', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('4', '0', '0', '', '综艺', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('5', '1', '1', '1', '动作片', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('6', '1', '1', '1', '科幻片', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('7', '1', '1', '1', '战争片', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('8', '1', '1', '1', '爱情片', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('9', '1', '1', '1', '喜剧片', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('10', '1', '1', '1', '恐怖片', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('11', '1', '1', '1', '剧情片', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('12', '1', '1', '1', '微电影', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('13', '2', '1', '2', '国产剧', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('14', '2', '1', '2', '港台剧', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('15', '2', '1', '2', '欧美剧', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('16', '2', '1', '2', '韩日剧', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('17', '2', '1', '2', '其它剧', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('18', '3', '1', '3', '国产动漫', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('19', '3', '1', '3', '港台动漫', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('20', '3', '1', '3', '欧美动漫', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('21', '3', '1', '3', '韩日动漫', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('22', '3', '1', '3', '其它动漫', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('23', '4', '1', '4', '国产综艺', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('24', '4', '1', '4', '港台综艺', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('25', '4', '1', '4', '欧美综艺', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('26', '4', '1', '4', '韩日综艺', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');
INSERT INTO `pv_class` VALUES ('27', '4', '1', '4', '其它综艺', '0', 'free', 'postdate', '1', '', '', '', '', '0', '0', '0', '0', '', '', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for pv_config
-- ----------------------------
DROP TABLE IF EXISTS `pv_config`;
CREATE TABLE `pv_config` (
  `db_name` varchar(30) NOT NULL DEFAULT '',
  `db_value` text NOT NULL,
  `decrip` text NOT NULL,
  PRIMARY KEY (`db_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pv_config
-- ----------------------------
INSERT INTO `pv_config` VALUES ('db_keywords', 'phpvod,电影,视频,影视,点播,直播', '');
INSERT INTO `pv_config` VALUES ('db_description', 'PHPVOD视频点播系统', '');
INSERT INTO `pv_config` VALUES ('db_copyright', '<font color=#999999>Copyright 2009-2099 版权所有 <a href=http://www.phpvod.com/ target=_blank><b>PHPvod</b><b style=color:#FF9900>.com</b></a></font>', '');
INSERT INTO `pv_config` VALUES ('db_icp', '湘ICP备09015407号', '');
INSERT INTO `pv_config` VALUES ('db_statcode', '', '');
INSERT INTO `pv_config` VALUES ('db_obstart', '0', '');
INSERT INTO `pv_config` VALUES ('db_debug', '0', '');
INSERT INTO `pv_config` VALUES ('rg_regcheck', '0', '');
INSERT INTO `pv_config` VALUES ('db_mobileifopen', '1', '');
INSERT INTO `pv_config` VALUES ('db_mobiledirname', 'mobile', '');
INSERT INTO `pv_config` VALUES ('db_mobiledomain', '', '');
INSERT INTO `pv_config` VALUES ('db_cc', '1', '');
INSERT INTO `pv_config` VALUES ('db_xforwardip', '0', '');
INSERT INTO `pv_config` VALUES ('db_charset', 'utf-8', '');
INSERT INTO `pv_config` VALUES ('db_forcecharset', '0', '');
INSERT INTO `pv_config` VALUES ('db_timedf', '8', '');
INSERT INTO `pv_config` VALUES ('db_datefm', 'Y-n-j H:i', '');
INSERT INTO `pv_config` VALUES ('db_defaultstyle', 'phpvod', '');
INSERT INTO `pv_config` VALUES ('db_tplrefresh', '1', '');
INSERT INTO `pv_config` VALUES ('db_iconupload', '1', '');
INSERT INTO `pv_config` VALUES ('db_iconsize', '2000', '');
INSERT INTO `pv_config` VALUES ('db_cookiepre', 'pv', '');
INSERT INTO `pv_config` VALUES ('db_cookiepath', '/', '');
INSERT INTO `pv_config` VALUES ('db_sitehash', '3d78b93e89c4', '');
INSERT INTO `pv_config` VALUES ('db_gdtype', '0', '');
INSERT INTO `pv_config` VALUES ('db_gdstyle', '1', '');
INSERT INTO `pv_config` VALUES ('db_gdsize', '150	60	4', '');
INSERT INTO `pv_config` VALUES ('db_showpic', '1', '');
INSERT INTO `pv_config` VALUES ('db_indexlink', '1', '');
INSERT INTO `pv_config` VALUES ('db_indexmqlink', '0', '');
INSERT INTO `pv_config` VALUES ('db_adminperpage', '20', '');
INSERT INTO `pv_config` VALUES ('db_perpage', '20', '');
INSERT INTO `pv_config` VALUES ('db_readperpage', '10', '');
INSERT INTO `pv_config` VALUES ('db_postmin', '6', '');
INSERT INTO `pv_config` VALUES ('db_postmax', '100', '');
INSERT INTO `pv_config` VALUES ('db_reply', '1', '');
INSERT INTO `pv_config` VALUES ('db_yearstart', '1980', '');
INSERT INTO `pv_config` VALUES ('db_yearend', '2018', '');
INSERT INTO `pv_config` VALUES ('db_autochange', '0', '');
INSERT INTO `pv_config` VALUES ('db_hour', '4', '');
INSERT INTO `pv_config` VALUES ('db_htmifopen', '0', '');
INSERT INTO `pv_config` VALUES ('db_dir', '.php?', '');
INSERT INTO `pv_config` VALUES ('db_ext', '.html', '');
INSERT INTO `pv_config` VALUES ('db_cookiedomain', '', '');
INSERT INTO `pv_config` VALUES ('db_uploadvodpic', '1', '');
INSERT INTO `pv_config` VALUES ('db_picdir', '3', '');
INSERT INTO `pv_config` VALUES ('db_picfiletype', 'jpg,jpeg,png,gif,bmp', '');
INSERT INTO `pv_config` VALUES ('db_picmaxsize', '3072000', '');
INSERT INTO `pv_config` VALUES ('db_createthumb', '1', '');
INSERT INTO `pv_config` VALUES ('db_thumbwidth', '200', '');
INSERT INTO `pv_config` VALUES ('db_thumbheight', '260', '');
INSERT INTO `pv_config` VALUES ('db_watermark', '0', '');
INSERT INTO `pv_config` VALUES ('db_waterpos', '9', '');
INSERT INTO `pv_config` VALUES ('db_waterimg', 'mark.gif', '');
INSERT INTO `pv_config` VALUES ('db_watertext', 'phpvod', '');
INSERT INTO `pv_config` VALUES ('db_waterfont', '10', '');
INSERT INTO `pv_config` VALUES ('db_watercolor', '#FF0000', '');
INSERT INTO `pv_config` VALUES ('db_waterpct', '80', '');
INSERT INTO `pv_config` VALUES ('db_jpgquality', '80', '');
INSERT INTO `pv_config` VALUES ('db_creditset', 'a:4:{s:5:\"money\";a:4:{s:4:\"Post\";i:3;s:5:\"Reply\";i:1;s:6:\"Delete\";i:3;s:8:\"Deleterp\";i:1;}s:4:\"rvrc\";a:4:{s:4:\"Post\";i:1;s:5:\"Reply\";i:0;s:6:\"Delete\";i:1;s:8:\"Deleterp\";i:0;}i:3;a:4:{s:4:\"Post\";i:3;s:5:\"Reply\";i:1;s:6:\"Delete\";i:3;s:8:\"Deleterp\";i:1;}i:4;a:4:{s:4:\"Post\";i:0;s:5:\"Reply\";i:0;s:6:\"Delete\";i:0;s:8:\"Deleterp\";i:0;}}', '');
INSERT INTO `pv_config` VALUES ('db_gdcheck', '15', '');
INSERT INTO `pv_config` VALUES ('rg_allowregister', '1', '');
INSERT INTO `pv_config` VALUES ('db_mailmethod', '1', '');
INSERT INTO `pv_config` VALUES ('db_upgrade', 'a:5:{s:7:\"postnum\";i:1;s:4:\"rvrc\";i:2;s:5:\"money\";i:3;i:3;i:4;i:4;i:5;}', '');
INSERT INTO `pv_config` VALUES ('rg_regminname', '3', '');
INSERT INTO `pv_config` VALUES ('rg_regmaxname', '12', '');
INSERT INTO `pv_config` VALUES ('rg_regmaxhonor', '30', '');
INSERT INTO `pv_config` VALUES ('rg_regmaxsign', '100', '');
INSERT INTO `pv_config` VALUES ('rg_regrvrc', '0', '');
INSERT INTO `pv_config` VALUES ('rg_regmoney', '0', '');
INSERT INTO `pv_config` VALUES ('rg_banname', 'admin,管理员,站长', '');
INSERT INTO `pv_config` VALUES ('db_siteifopen', '1', '');
INSERT INTO `pv_config` VALUES ('db_whyclose', '网站暂时关闭15分钟，请稍候访问。', '');
INSERT INTO `pv_config` VALUES ('db_lp', '0', '');
INSERT INTO `pv_config` VALUES ('db_wwwname', 'PHPVOD视频点播系统', '');
INSERT INTO `pv_config` VALUES ('db_wwwurl', 'http://vod.phpvod.com', '');
INSERT INTO `pv_config` VALUES ('db_bfn', 'index.php', '');
INSERT INTO `pv_config` VALUES ('db_ceoconnect', 'http://vod.phpvod.com', '');
INSERT INTO `pv_config` VALUES ('db_ceoemail', 'phpvod@qq.com', '');
INSERT INTO `pv_config` VALUES ('db_mailsmtp', '', '');
INSERT INTO `pv_config` VALUES ('db_mailport', '', '');
INSERT INTO `pv_config` VALUES ('db_mailfrom', '', '');
INSERT INTO `pv_config` VALUES ('db_mailfromname', '', '');
INSERT INTO `pv_config` VALUES ('db_mailauth', '1', '');
INSERT INTO `pv_config` VALUES ('db_mailuser', '', '');
INSERT INTO `pv_config` VALUES ('db_mailpass', '', '');
INSERT INTO `pv_config` VALUES ('db_mergesystype', '0', '');
INSERT INTO `pv_config` VALUES ('db_mergeshowapp', '0', '');
INSERT INTO `pv_config` VALUES ('db_mergefeed', '0', '');
INSERT INTO `pv_config` VALUES ('db_optimizelink', '0', '');
INSERT INTO `pv_config` VALUES ('db_setshowpic', 'a:3:{i:0;s:23:\"image1.jpg|#|image1.jpg\";i:1;s:23:\"image2.jpg|#|image2.jpg\";i:2;s:23:\"image3.jpg|#|image3.jpg\";}', '');
INSERT INTO `pv_config` VALUES ('db_cachetime', '30', '');
INSERT INTO `pv_config` VALUES ('db_hotsearch', '', '');
INSERT INTO `pv_config` VALUES ('db_setads', '0', '');
INSERT INTO `pv_config` VALUES ('db_setadsnum', '0', '');
INSERT INTO `pv_config` VALUES ('db_setadstype', 'money', '');

-- ----------------------------
-- Table structure for pv_credits
-- ----------------------------
DROP TABLE IF EXISTS `pv_credits`;
CREATE TABLE `pv_credits` (
  `cid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pv_credits
-- ----------------------------
INSERT INTO `pv_credits` VALUES ('3', '贡献度', '自定义积分');
INSERT INTO `pv_credits` VALUES ('4', '交易币', '自定义积分');

-- ----------------------------
-- Table structure for pv_extgroups
-- ----------------------------
DROP TABLE IF EXISTS `pv_extgroups`;
CREATE TABLE `pv_extgroups` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `groups` mediumtext NOT NULL,
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pv_favorite
-- ----------------------------
DROP TABLE IF EXISTS `pv_favorite`;
CREATE TABLE `pv_favorite` (
  `fid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fid`),
  KEY `vid` (`vid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pv_hack
-- ----------------------------
DROP TABLE IF EXISTS `pv_hack`;
CREATE TABLE `pv_hack` (
  `hid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `directory` varchar(100) NOT NULL DEFAULT '',
  `hidden` tinyint(1) NOT NULL DEFAULT '1',
  `spos` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `listener` varchar(255) NOT NULL DEFAULT '',
  `version` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`hid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pv_hackvar
-- ----------------------------
DROP TABLE IF EXISTS `pv_hackvar`;
CREATE TABLE `pv_hackvar` (
  `hk_name` varchar(30) NOT NULL DEFAULT '',
  `hk_value` text NOT NULL,
  `decrip` text NOT NULL,
  PRIMARY KEY (`hk_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pv_listener
-- ----------------------------
DROP TABLE IF EXISTS `pv_listener`;
CREATE TABLE `pv_listener` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(255) NOT NULL DEFAULT '',
  `callorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pv_membercredit
-- ----------------------------
DROP TABLE IF EXISTS `pv_membercredit`;
CREATE TABLE `pv_membercredit` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `cid` tinyint(3) NOT NULL DEFAULT '0',
  `value` mediumint(8) NOT NULL DEFAULT '0',
  KEY `uid` (`uid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pv_memberdata
-- ----------------------------
DROP TABLE IF EXISTS `pv_memberdata`;
CREATE TABLE `pv_memberdata` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `postnum` int(10) unsigned NOT NULL DEFAULT '0',
  `rvrc` int(10) NOT NULL DEFAULT '0',
  `money` int(10) NOT NULL DEFAULT '0',
  `onlineip` char(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pv_memberinfo
-- ----------------------------
DROP TABLE IF EXISTS `pv_memberinfo`;
CREATE TABLE `pv_memberinfo` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `adsips` mediumtext NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pv_members
-- ----------------------------
DROP TABLE IF EXISTS `pv_members`;
CREATE TABLE `pv_members` (
  `uid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ucuid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(40) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `publicmail` tinyint(1) NOT NULL DEFAULT '1',
  `groupid` smallint(6) NOT NULL DEFAULT '-1',
  `memberid` smallint(6) NOT NULL DEFAULT '0',
  `groupexpiry` int(10) unsigned NOT NULL DEFAULT '0',
  `togid` smallint(6) NOT NULL DEFAULT '-1',
  `icon` varchar(100) NOT NULL DEFAULT 'none.gif',
  `gender` tinyint(1) NOT NULL DEFAULT '0',
  `regdate` int(10) unsigned NOT NULL DEFAULT '0',
  `signature` varchar(255) NOT NULL DEFAULT '',
  `oicq` varchar(12) NOT NULL DEFAULT '',
  `msn` varchar(35) NOT NULL DEFAULT '',
  `site` varchar(75) NOT NULL DEFAULT '',
  `honor` varchar(30) NOT NULL DEFAULT '',
  `bday` varchar(10) NOT NULL DEFAULT '',
  `receivemail` tinyint(1) NOT NULL DEFAULT '1',
  `yz` int(10) NOT NULL DEFAULT '1',
  `newpm` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  KEY `username` (`username`),
  KEY `groupid` (`groupid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pv_msg
-- ----------------------------
DROP TABLE IF EXISTS `pv_msg`;
CREATE TABLE `pv_msg` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('rebox','sebox','public') NOT NULL DEFAULT 'rebox',
  `touid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fromuid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `ifnew` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(130) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `mdate` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`),
  KEY `touid` (`touid`),
  KEY `fromuid` (`fromuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pv_nations
-- ----------------------------
DROP TABLE IF EXISTS `pv_nations`;
CREATE TABLE `pv_nations` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `subject` char(20) NOT NULL DEFAULT '',
  `vieworder` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `subject` (`subject`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pv_nations
-- ----------------------------
INSERT INTO `pv_nations` VALUES ('1', '国产', '1');
INSERT INTO `pv_nations` VALUES ('2', '港台', '2');
INSERT INTO `pv_nations` VALUES ('3', '欧美', '3');
INSERT INTO `pv_nations` VALUES ('4', '韩日', '4');
INSERT INTO `pv_nations` VALUES ('5', '其它', '5');

-- ----------------------------
-- Table structure for pv_player
-- ----------------------------
DROP TABLE IF EXISTS `pv_player`;
CREATE TABLE `pv_player` (
  `pid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL DEFAULT '',
  `subject` char(100) NOT NULL DEFAULT '',
  `playpath` char(100) NOT NULL DEFAULT '',
  `hidden` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pv_player
-- ----------------------------
INSERT INTO `pv_player` VALUES ('2', 'ckplayer', '支持 flv,mp4 等常用格式', 'ckplayer.htm', '1');

-- ----------------------------
-- Table structure for pv_reply
-- ----------------------------
DROP TABLE IF EXISTS `pv_reply`;
CREATE TABLE `pv_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `author` varchar(50) NOT NULL DEFAULT '',
  `authorid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `postdate` int(10) unsigned NOT NULL DEFAULT '0',
  `top` int(10) unsigned NOT NULL DEFAULT '0',
  `down` int(10) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  `yz` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `vid` (`vid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pv_report
-- ----------------------------
DROP TABLE IF EXISTS `pv_report`;
CREATE TABLE `pv_report` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) NOT NULL DEFAULT '0',
  `type` char(255) NOT NULL DEFAULT '0',
  `reason` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pv_sharelinks
-- ----------------------------
DROP TABLE IF EXISTS `pv_sharelinks`;
CREATE TABLE `pv_sharelinks` (
  `sid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `threadorder` tinyint(3) NOT NULL DEFAULT '0',
  `name` char(100) NOT NULL DEFAULT '',
  `url` char(100) NOT NULL DEFAULT '',
  `descrip` char(200) NOT NULL DEFAULT '0',
  `logo` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pv_sharelinks
-- ----------------------------
INSERT INTO `pv_sharelinks` VALUES ('1', '0', 'PHPVOD视频点播系统', 'http://www.phpvod.com', 'PHPVOD视频点播系统', '');
INSERT INTO `pv_sharelinks` VALUES ('2', '0', 'PHPVOD视频网', 'http://vod.phpvod.com', 'PHPVOD视频网', '');

-- ----------------------------
-- Table structure for pv_styles
-- ----------------------------
DROP TABLE IF EXISTS `pv_styles`;
CREATE TABLE `pv_styles` (
  `sid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL DEFAULT '',
  `stylepath` char(50) NOT NULL DEFAULT '',
  `tplpath` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pv_styles
-- ----------------------------
INSERT INTO `pv_styles` VALUES ('1', 'phpvod', 'phpvod', 'phpvod');

-- ----------------------------
-- Table structure for pv_urls
-- ----------------------------
DROP TABLE IF EXISTS `pv_urls`;
CREATE TABLE `pv_urls` (
  `uid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `vid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `pid` smallint(6) NOT NULL DEFAULT '1',
  `url` text NOT NULL,
  `playgroup` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`),
  KEY `vid` (`vid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pv_usergroups
-- ----------------------------
DROP TABLE IF EXISTS `pv_usergroups`;
CREATE TABLE `pv_usergroups` (
  `gid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `gptype` enum('default','member','system','special') NOT NULL DEFAULT 'member',
  `grouptitle` varchar(60) NOT NULL DEFAULT '',
  `groupimg` varchar(15) NOT NULL DEFAULT '',
  `grouppost` int(10) NOT NULL DEFAULT '0',
  `maxmsg` int(10) NOT NULL DEFAULT '10',
  `allowread` tinyint(1) NOT NULL DEFAULT '0',
  `allowrp` tinyint(1) NOT NULL DEFAULT '0',
  `allowhonor` tinyint(1) NOT NULL DEFAULT '0',
  `alloweditatc` tinyint(1) NOT NULL DEFAULT '0',
  `allowdelatc` tinyint(1) NOT NULL DEFAULT '0',
  `allowpost` tinyint(1) NOT NULL DEFAULT '0',
  `allowmessage` tinyint(1) NOT NULL DEFAULT '0',
  `allowplay` tinyint(1) NOT NULL DEFAULT '0',
  `allowplayvip` tinyint(1) NOT NULL DEFAULT '0',
  `atccheck` tinyint(1) NOT NULL DEFAULT '0',
  `rpcheck` tinyint(1) NOT NULL DEFAULT '0',
  `allowprofile` tinyint(1) NOT NULL DEFAULT '0',
  `allowseticon` tinyint(1) NOT NULL DEFAULT '0',
  `allowupicon` tinyint(1) NOT NULL DEFAULT '0',
  `allowsell` tinyint(1) NOT NULL DEFAULT '0',
  `allowbuy` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `selltype` varchar(60) NOT NULL DEFAULT '',
  `sellprice` smallint(5) unsigned NOT NULL DEFAULT '0',
  `selllimit` smallint(5) unsigned NOT NULL DEFAULT '1',
  `sellinfo` varchar(255) NOT NULL DEFAULT '',
  `ifdefault` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `allowadmincp` tinyint(1) NOT NULL DEFAULT '0',
  `allowadminedit` tinyint(1) NOT NULL DEFAULT '0',
  `allowadmindel` tinyint(1) NOT NULL DEFAULT '0',
  `allowadminshow` tinyint(1) NOT NULL DEFAULT '0',
  `permissions` text NOT NULL,
  PRIMARY KEY (`gid`),
  KEY `gptype` (`gptype`),
  KEY `grouppost` (`grouppost`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pv_usergroups
-- ----------------------------
INSERT INTO `pv_usergroups` VALUES ('1', 'default', 'default', '6', '0', '10', '1', '1', '1', '1', '1', '1', '0', '1', '0', '1', '1', '1', '1', '1', '1', '0', '', '0', '1', '', '1', '0', '0', '0', '0', '');
INSERT INTO `pv_usergroups` VALUES ('2', 'default', '游客', '7', '0', '0', '1', '0', '0', '0', '0', '1', '0', '1', '0', '1', '1', '0', '0', '0', '0', '0', '', '0', '1', '', '0', '0', '0', '0', '0', '');
INSERT INTO `pv_usergroups` VALUES ('3', 'system', '管理员', '3', '0', '500', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '1', '1', '1', '1', '0', '', '0', '1', '', '0', '1', '1', '1', '1', '');
INSERT INTO `pv_usergroups` VALUES ('4', 'system', '未验证会员', '8', '0', '10', '1', '0', '0', '0', '0', '0', '0', '1', '0', '1', '1', '0', '0', '0', '0', '0', '', '0', '1', '', '0', '0', '0', '0', '0', '');
INSERT INTO `pv_usergroups` VALUES ('5', 'member', '路人甲', '9', '0', '50', '1', '1', '1', '1', '1', '1', '1', '1', '0', '1', '1', '1', '1', '1', '1', '0', '', '0', '1', '', '0', '0', '0', '0', '0', '');
INSERT INTO `pv_usergroups` VALUES ('6', 'member', '跑龙套', '10', '100', '50', '1', '1', '1', '1', '1', '1', '1', '1', '0', '1', '1', '1', '1', '1', '1', '0', '', '0', '1', '', '0', '0', '0', '0', '0', '');
INSERT INTO `pv_usergroups` VALUES ('7', 'member', '小配角', '11', '300', '100', '1', '1', '1', '1', '1', '1', '1', '1', '0', '1', '1', '1', '1', '1', '1', '0', '', '0', '1', '', '0', '0', '0', '0', '0', '');
INSERT INTO `pv_usergroups` VALUES ('8', 'member', '演艺新秀', '12', '500', '100', '1', '1', '1', '1', '1', '1', '1', '1', '0', '1', '1', '1', '1', '1', '1', '0', '', '0', '1', '', '0', '0', '0', '0', '0', '');
INSERT INTO `pv_usergroups` VALUES ('9', 'member', '二线明星', '13', '1000', '150', '1', '1', '1', '1', '1', '1', '1', '1', '0', '1', '1', '1', '1', '1', '1', '0', '', '0', '1', '', '0', '0', '0', '0', '0', '');
INSERT INTO `pv_usergroups` VALUES ('10', 'member', '担当主角', '14', '2000', '150', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '0', '1', '1', '1', '1', '0', '', '0', '1', '', '0', '0', '0', '0', '0', '');
INSERT INTO `pv_usergroups` VALUES ('11', 'member', '大牌明星', '15', '5000', '200', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '0', '1', '1', '1', '1', '0', '', '0', '1', '', '0', '0', '0', '0', '0', '');
INSERT INTO `pv_usergroups` VALUES ('12', 'member', '超级明星', '16', '10000', '200', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '0', '1', '1', '1', '1', '0', '', '0', '1', '', '0', '0', '0', '0', '0', '');
INSERT INTO `pv_usergroups` VALUES ('13', 'special', 'VIP会员', '17', '0', '300', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '1', '1', '1', '1', '1', 'money', '10', '1', '', '0', '0', '0', '0', '0', '');

-- ----------------------------
-- Table structure for pv_video
-- ----------------------------
DROP TABLE IF EXISTS `pv_video`;
CREATE TABLE `pv_video` (
  `vid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `nid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `author` varchar(20) NOT NULL DEFAULT '',
  `authorid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `postdate` int(10) unsigned NOT NULL DEFAULT '0',
  `lastdate` int(10) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(100) NOT NULL DEFAULT '',
  `picserver` varchar(255) NOT NULL DEFAULT '',
  `picfolder` varchar(50) NOT NULL DEFAULT '',
  `pic` varchar(100) NOT NULL DEFAULT '',
  `playactor` varchar(30) NOT NULL DEFAULT '',
  `director` varchar(30) NOT NULL DEFAULT '',
  `tag` varchar(100) NOT NULL DEFAULT '',
  `year` varchar(10) NOT NULL DEFAULT '',
  `best` tinyint(1) NOT NULL DEFAULT '0',
  `serialise` smallint(5) unsigned NOT NULL DEFAULT '0',
  `memo` varchar(100) NOT NULL,
  `reply` int(10) unsigned NOT NULL DEFAULT '0',
  `sale` varchar(30) NOT NULL DEFAULT '',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `yesterday_hits` int(10) unsigned NOT NULL DEFAULT '0',
  `day_hits` int(10) unsigned NOT NULL DEFAULT '0',
  `week_hits` int(10) unsigned NOT NULL DEFAULT '0',
  `month_hits` int(10) unsigned NOT NULL DEFAULT '0',
  `hits_update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `usernth` int(10) unsigned NOT NULL DEFAULT '0',
  `fraction` int(10) unsigned NOT NULL DEFAULT '0',
  `star` float(10,1) unsigned NOT NULL DEFAULT '0.0',
  `yz` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`vid`),
  KEY `bid` (`cid`),
  KEY `nid` (`nid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pv_videodata
-- ----------------------------
DROP TABLE IF EXISTS `pv_videodata`;
CREATE TABLE `pv_videodata` (
  `vid` mediumint(8) unsigned NOT NULL,
  `synopsis` mediumtext NOT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;