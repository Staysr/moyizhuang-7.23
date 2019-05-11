<?php
/* @authorcode  336d1ff1a00971b8c66ca668fda89fcc
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
if(!defined('IN_DZZ') || !defined('IN_ADMIN')) {
	exit('Access Denied');
}

$sql = <<<EOF

CREATE TABLE IF NOT EXISTS dzz_discuss (
  `fid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `inarchive` tinyint(1) NOT NULL DEFAULT '0',
  `archivetime` int(11) NOT NULL,
  `name` char(50) NOT NULL DEFAULT '',
  `username` char(30) NOT NULL DEFAULT '',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `perm` tinyint(1) NOT NULL DEFAULT '0',
  `threads` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `todayposts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `yesterdayposts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rank` smallint(6) unsigned NOT NULL DEFAULT '0',
  `oldrank` smallint(6) unsigned NOT NULL DEFAULT '0',
  `lastpost` char(110) NOT NULL DEFAULT '',
  `lastposttime` int(11) DEFAULT NULL COMMENT '最后回复时间',
  `lastthreadtime` int(11) DEFAULT NULL COMMENT '最后发帖时间',
  `allowanonymous` tinyint(1) NOT NULL DEFAULT '0',
  `favtimes` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `isdelete` tinyint(2) NOT NULL DEFAULT '0',
  `deletetime` int(10) unsigned NOT NULL DEFAULT '0',
  `deleteuid` int(10) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fid`),
  KEY `forum` (`perm`),
  KEY `deletetime` (`deletetime`),
  KEY `uid` (`uid`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS dzz_discuss_favorite (
  favid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  uid mediumint(8) unsigned NOT NULL DEFAULT '0',
  id mediumint(8) unsigned NOT NULL DEFAULT '0',
  idtype varchar(255) NOT NULL DEFAULT '',
  title varchar(255) NOT NULL DEFAULT '',
  description text NOT NULL,
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (favid),
  KEY idtype (id,idtype),
  KEY uid (uid,idtype,dateline)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS dzz_discuss_field (
  `fid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `icon` int(10) NOT NULL DEFAULT '0',
  `redirect` varchar(255) NOT NULL DEFAULT '',
  `attachextensions` varchar(255) NOT NULL DEFAULT '',
  `moderators` text NOT NULL,
  `rules` text NOT NULL,
  `threadtypes` text NOT NULL,
  `postperm` tinyint(1) NOT NULL DEFAULT '1',
  `replyperm` tinyint(1) NOT NULL DEFAULT '1',
  `order` tinyint(1) NOT NULL DEFAULT '0',
  `orderfield` tinyint(1) NOT NULL DEFAULT '0',
  `anonymous` tinyint(1) NOT NULL DEFAULT '0',
  `allowshare` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否允许被分享',
  `iconcolor` varchar(12) NOT NULL,
  `source` varchar(30) DEFAULT NULL COMMENT '来源设备',
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS dzz_discuss_post (
  `pid` int(10) unsigned NOT NULL,
  `fid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `first` tinyint(1) NOT NULL DEFAULT '0',
  `author` varchar(15) NOT NULL DEFAULT '',
  `authorid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(80) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `message` mediumtext NOT NULL,
  `useip` varchar(15) NOT NULL DEFAULT '',
  `port` smallint(6) unsigned NOT NULL DEFAULT '0',
  `invisible` tinyint(1) NOT NULL DEFAULT '0',
  `anonymous` tinyint(1) NOT NULL DEFAULT '0',
  `usesig` tinyint(1) NOT NULL DEFAULT '0',
  `attachment` tinyint(1) NOT NULL DEFAULT '0',
  `status` int(10) NOT NULL DEFAULT '0',
  `tags` varchar(255) NOT NULL DEFAULT '0',
  `position` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `lastcmttime` int(11) NOT NULL DEFAULT '0' COMMENT '最后评论时间',
  `source` varchar(30) DEFAULT NULL COMMENT '来源设备',
  PRIMARY KEY (`tid`,`position`),
  UNIQUE KEY `pid` (`pid`),
  KEY `fid` (`fid`),
  KEY `authorid` (`authorid`,`invisible`),
  KEY `dateline` (`dateline`),
  KEY `invisible` (`invisible`),
  KEY `displayorder` (`tid`,`invisible`,`dateline`),
  KEY `first` (`tid`,`first`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS dzz_discuss_post_attach (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tid` int(10) unsigned NOT NULL DEFAULT '0',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `aid` int(10) NOT NULL DEFAULT '0',
  `fid` int(11) NOT NULL DEFAULT '0',
  `uid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS dzz_discuss_post_tableid (
  pid int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (pid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS dzz_discuss_searchindex (
  searchid int(10) unsigned NOT NULL AUTO_INCREMENT,
  keywords varchar(255) NOT NULL DEFAULT '',
  searchstring text NOT NULL,
  useip varchar(15) NOT NULL DEFAULT '',
  uid mediumint(10) unsigned NOT NULL DEFAULT '0',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  expiration int(10) unsigned NOT NULL DEFAULT '0',
  threadsortid smallint(6) unsigned NOT NULL DEFAULT '0',
  num smallint(6) unsigned NOT NULL DEFAULT '0',
  ids text NOT NULL,
  PRIMARY KEY (searchid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS dzz_discuss_setting (
  skey varchar(255) NOT NULL DEFAULT '',
  svalue text NOT NULL,
  PRIMARY KEY (skey)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS dzz_discuss_statlog (
  logdate date NOT NULL,
  fid mediumint(8) unsigned NOT NULL,
  `type` smallint(5) unsigned NOT NULL DEFAULT '0',
  `value` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (logdate,fid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS dzz_discuss_thread (
  `tid` int(10) NOT NULL AUTO_INCREMENT,
  `inarchive` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否归档',
  `archivetime` int(11) NOT NULL DEFAULT '0',
  `fid` int(10) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '主题分类id',
  `readperm` smallint(6) NOT NULL DEFAULT '0' COMMENT '0:所有人可见；-1：仅@的人可见，>0：部门成员可见',
  `posttableid` smallint(6) NOT NULL DEFAULT '0',
  `authorid` int(10) NOT NULL DEFAULT '0',
  `author` char(30) NOT NULL DEFAULT '',
  `subject` char(80) NOT NULL DEFAULT '',
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `replies` int(10) NOT NULL DEFAULT '0' COMMENT '回复数',
  `heats` int(10) NOT NULL DEFAULT '0',
  `favtimes` int(10) NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `lastpost` int(10) unsigned NOT NULL DEFAULT '0',
  `lastposter` char(30) NOT NULL DEFAULT '',
  `bgcolor` char(8) NOT NULL DEFAULT '' COMMENT '保存高亮背景色',
  `icon` tinyint(3) NOT NULL DEFAULT '-1' COMMENT '主题图标',
  `digest` tinyint(1) NOT NULL DEFAULT '0' COMMENT '显示顺序',
  `highlight` varchar(255) NOT NULL DEFAULT '0' COMMENT '显示顺序',
  `displayorder` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '显示顺序',
  `closed` int(10) unsigned NOT NULL DEFAULT '0',
  `maxposition` int(10) NOT NULL DEFAULT '0',
  `attachment` tinyint(1) NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '0',
  `moderated` tinyint(1) NOT NULL DEFAULT '0' COMMENT ' 是否被管理员改动',
  `anonymous` tinyint(1) NOT NULL DEFAULT '0',
  `isdelete` tinyint(1) NOT NULL DEFAULT '0',
  `deletetime` int(11) DEFAULT NULL,
  `deleteuid` int(11) DEFAULT NULL,
  `startstick` int(11) NOT NULL DEFAULT '0',
  `starthighlight` int(11) NOT NULL DEFAULT '0',
  `startdigest` int(11) NOT NULL DEFAULT '0',
  `source` varchar(30) DEFAULT NULL COMMENT '来源设备',
  PRIMARY KEY (`tid`),
  KEY `uid` (`authorid`),
  KEY `dateline` (`dateline`),
  KEY `fid` (`fid`),
  KEY `typeid` (`typeid`,`displayorder`,`lastpost`,`fid`),
  KEY `displayorder` (`displayorder`,`fid`,`lastpost`),
  KEY `heats` (`heats`),
  KEY `digest` (`digest`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS dzz_discuss_threadaddviews (
  tid mediumint(8) unsigned NOT NULL DEFAULT '0',
  addviews int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (tid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS dzz_discuss_threadclass (
  typeid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  fid mediumint(8) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  displayorder mediumint(9) NOT NULL,
  icon varchar(255) NOT NULL,
  moderators tinyint(1) NOT NULL DEFAULT '0',
  `enable` tinyint(1) DEFAULT '1',
  PRIMARY KEY (typeid),
  KEY fid (fid,displayorder)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS dzz_discuss_threadmod (
  tid mediumint(8) unsigned NOT NULL DEFAULT '0',
  uid mediumint(8) unsigned NOT NULL DEFAULT '0',
  username char(15) NOT NULL DEFAULT '',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  expiration int(10) unsigned NOT NULL DEFAULT '0',
  `action` char(5) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  magicid smallint(6) unsigned NOT NULL,
  stamp tinyint(3) NOT NULL,
  reason char(40) NOT NULL DEFAULT '',
  KEY tid (tid,dateline),
  KEY expiration (expiration,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS dzz_discuss_user (
  id int(10) NOT NULL AUTO_INCREMENT,
  fid int(10) unsigned NOT NULL DEFAULT '0',
  uid int(10) unsigned NOT NULL DEFAULT '0',
  username char(30) NOT NULL DEFAULT '',
  perm tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:关注；2：:普通成员;3：管理员',
  hot int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户活跃度',
  threads int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建文档数',
  replys int(10) NOT NULL DEFAULT '0',
  dateline int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  UNIQUE KEY cid_uid (fid,uid),
  KEY uid (uid),
  KEY cid (fid),
  KEY hot (hot),
  KEY dateline (dateline),
  KEY perm (perm)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS dzz_discuss_userinfo (
  uid int(10) unsigned NOT NULL DEFAULT '0',
  threads int(10) unsigned NOT NULL DEFAULT '0',
  posts int(10) unsigned NOT NULL DEFAULT '0',
  hots int(10) unsigned NOT NULL DEFAULT '0',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  lastpost int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (uid),
  UNIQUE KEY uid (uid),
  KEY hots (hots)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS dzz_discuss_post_at (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tid` int(10) unsigned NOT NULL DEFAULT '0',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `fid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dzz_discuss_comment` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `pcid` int(11) DEFAULT NULL COMMENT '被回复的评论',
  `reuid` int(11) DEFAULT NULL COMMENT '被回复的评论的作者',
  `fid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL COMMENT '帖子ID',
  `pauthorid` int(11) NOT NULL COMMENT '帖子作者',
  `content` varchar(255) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dzz_discuss_recycle` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL COMMENT '讨论版id',
  `type` varchar(12) NOT NULL COMMENT 'field：讨论版  thread：主题',
  `id` int(11) NOT NULL COMMENT '被删除的主键',
  `authorid` int(11) NOT NULL,
  `deleteuid` int(11) NOT NULL,
  `deletetime` int(11) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



EOF;
runquery($sql);

$sql = <<<EOF
REPLACE INTO dzz_discuss_setting VALUES('maxboard', '10');
REPLACE INTO dzz_discuss_setting VALUES('allownewboard', '0');
REPLACE INTO dzz_discuss_setting VALUES('indexcache', '0');
REPLACE INTO dzz_discuss_setting VALUES('topperm', 'a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}');
REPLACE INTO dzz_discuss_setting VALUES('optimizeviews', '0');
REPLACE INTO dzz_discuss_setting VALUES('preventrefresh', '0');
REPLACE INTO dzz_discuss_setting VALUES('modreasons', '广告,恶意灌水,违规内容,文不对题,重复发帖,我很赞同,精品文章,原创内容');
REPLACE INTO dzz_discuss_setting VALUES('hotlevels', '50,100,200');
REPLACE INTO dzz_discuss_setting VALUES('postno', '#');
REPLACE INTO dzz_discuss_setting VALUES('postnocustom', '沙发\r\n板凳\r\n地板');
EOF;
runquery($sql);
$finish = true;
