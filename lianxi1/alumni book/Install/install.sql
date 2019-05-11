set names 'utf8';
DROP TABLE IF EXISTS `{$prefix}config`;
CREATE TABLE `{$prefix}config` (
  `vkey` varchar(255) NOT NULL,
  `value` text,
  PRIMARY KEY (`vkey`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `{$prefix}config` VALUES ('Ver', '3.0');
INSERT INTO `{$prefix}config` VALUES ('Webtitle', '似水年华V3 - 一个实用的云端同学录');
INSERT INTO `{$prefix}config` VALUES ('Webname', '似水年华V3');
INSERT INTO `{$prefix}config` VALUES ('Webqq', '211154860');
INSERT INTO `{$prefix}config` VALUES ('Webemail', '211154860@qq.com');
INSERT INTO `{$prefix}config` VALUES ('Index_jianjie', '本站是由似水年华开发的一款班级同学录网站，可以在云端储存下同学的信息，网站内含有很多实用功能，网站采用PHP+MySQL进行操作，用户密码加密储存，不定期的更新程序，保证您的信息安全');
INSERT INTO `{$prefix}config` VALUES ('Index_miaoshu', '一个实用的云端同学录');
INSERT INTO `{$prefix}config` VALUES ('Index_foot', 'CopyRight 2017 似水年华');
INSERT INTO `{$prefix}config` VALUES ('Gonggao', '<div class="alert alert-info fade in">                                  <strong>1.</strong>欢迎各位同学们注册似水年华同学录!
</div>
<div class="alert alert-info fade in">                                  <strong>2.</strong>请各位同学注册账号后,尽快将资料填写完整,方便以后的联系!
</div>
<div class="alert alert-info fade in">                                  <strong>3.</strong>欢迎大家加入似水年华官方交流群:602654521
</div>
<div class="alert alert-info fade in">                                  <strong>4.</strong>相册已开放上传,快去上传一张与同学们的照片或自拍吧!
</div>
<div class="alert alert-info fade in">                                  <strong>5.</strong>如果你有什么想说的话或事,可以前往留言板发表!
</div>');
INSERT INTO `{$prefix}config` VALUES ('Index_bgapi', '1');
INSERT INTO `{$prefix}config` VALUES ('scale', '1');
INSERT INTO `{$prefix}config` VALUES ('player', '1');
INSERT INTO `{$prefix}config` VALUES ('playerkey', 'lxlby');
INSERT INTO `{$prefix}config` VALUES ('zc', '1');
INSERT INTO `{$prefix}config` VALUES ('pjax_loadanimation', '#FF80AB');
DROP TABLE IF EXISTS `{$prefix}users`;
CREATE TABLE `{$prefix}users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `pwd` varchar(40) NOT NULL,
  `cookie` varchar(50) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `login` tinyint(255) DEFAULT '1',
  `mail` varchar(100) NOT NULL,
  `qq` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sr` varchar(255) DEFAULT NULL,
  `xb` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `dz` varchar(255) DEFAULT NULL,
  `xh` varchar(255) DEFAULT NULL,
  `xz` varchar(255) DEFAULT NULL,
  `ah` varchar(255) DEFAULT NULL,
  `tc` varchar(255) DEFAULT NULL,
  `gxqm` varchar(255) DEFAULT NULL,
  `tj` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `{$prefix}chat`;
CREATE TABLE `{$prefix}chat` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `{$prefix}photo`;
CREATE TABLE `{$prefix}photo` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `{$prefix}bbq`;
CREATE TABLE `{$prefix}bbq` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `ta` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;