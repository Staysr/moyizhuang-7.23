DROP TABLE IF EXISTS `pv_repos`;
CREATE TABLE `pv_repos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `rid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资源库ID',
  `rvid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资源库视频ID',
  `vid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '本地视频ID',
  `playgroup` varchar(255) NOT NULL DEFAULT '' COMMENT '播放组ID(JSON)',
  `lasttime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `downpic` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '图片是否下载',
  PRIMARY KEY (`id`),
  KEY `rid, rvid` (`rid`,`rvid`),
  KEY `rid, downpic` (`rid`,`downpic`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pv_reposlog`;
CREATE TABLE `pv_reposlog` (
  `lid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `rid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资源库ID',
  `log` char(255) NOT NULL DEFAULT '' COMMENT '日志文本(JSON)',
  PRIMARY KEY (`lid`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pv_reposreplace`;
CREATE TABLE `pv_reposreplace` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `rid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资源库ID',
  `type` char(255) NOT NULL DEFAULT '' COMMENT '替换类型',
  `str1` char(255) NOT NULL DEFAULT '' COMMENT '被替换字符串',
  `str2` char(255) NOT NULL DEFAULT '' COMMENT '替换字符串',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `pv_hackvar` VALUES ('col_update_subject', '0', '');
INSERT INTO `pv_hackvar` VALUES ('col_update_pic', '0', '');
INSERT INTO `pv_hackvar` VALUES ('col_update_playactor', '0', '');
INSERT INTO `pv_hackvar` VALUES ('col_update_director', '0', '');
INSERT INTO `pv_hackvar` VALUES ('col_update_year', '0', '');
INSERT INTO `pv_hackvar` VALUES ('col_update_memo', '0', '');
INSERT INTO `pv_hackvar` VALUES ('col_update_content', '0', '');
INSERT INTO `pv_hackvar` VALUES ('col_samename', '1', '');
INSERT INTO `pv_hackvar` VALUES ('col_compare_cid', '0', '');
INSERT INTO `pv_hackvar` VALUES ('col_compare_nid', '0', '');
INSERT INTO `pv_hackvar` VALUES ('col_compare_director', '0', '');
INSERT INTO `pv_hackvar` VALUES ('col_compare_playactor', '1', '');
INSERT INTO `pv_hackvar` VALUES ('col_compare_year', '0', '');
INSERT INTO `pv_hackvar` VALUES ('col_compare_memo', '0', '');
INSERT INTO `pv_hackvar` VALUES ('col_random_username', '', '');
INSERT INTO `pv_hackvar` VALUES ('col_random_postdate_start', '', '');
INSERT INTO `pv_hackvar` VALUES ('col_random_postdate_end', '', '');
INSERT INTO `pv_hackvar` VALUES ('col_random_hits_min', '', '');
INSERT INTO `pv_hackvar` VALUES ('col_random_hits_max', '', '');
INSERT INTO `pv_hackvar` VALUES ('col_downpic_auto', '0', '');
INSERT INTO `pv_hackvar` VALUES ('col_downpic_step', '3', '');
INSERT INTO `pv_hackvar` VALUES ('col_random_userinfo', '', '');