<?php
/* @authorcode  codestrings
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

CREATE TABLE IF NOT EXISTS dzz_jilu (
  jid char(10) NOT NULL DEFAULT '',
  inarchive tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否归档',
  authorid int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建用户uid',
  author varchar(30) NOT NULL DEFAULT '',
  privacy tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:完全公开；1：本站公开；2:隐私',
  dateline int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  title varchar(255) NOT NULL DEFAULT '',
  titlehidden TINYINT( 1 ) NOT NULL DEFAULT  '0',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  cover int(10) NOT NULL DEFAULT '0' COMMENT '封面图片',
  color char(7) NOT NULL DEFAULT '' COMMENT '封面颜色',
  updatetime int(10) NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  lastactive text NOT NULL,
  archivetime int(10) unsigned NOT NULL DEFAULT '0',
  labels text NOT NULL,
  views smallint(6) unsigned NOT NULL COMMENT '浏览量',
  num smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '记录数',
  isdefault tinyint(1) NOT NULL DEFAULT '0' COMMENT '默认到用户首页',
  deleteuid int(11) NOT NULL,
  deletetime int(11) NOT NULL,
  recycledel smallint(2) NOT NULL DEFAULT '0' COMMENT '创建者是否在回收站删除（1:已删除 0：未删除）',
  PRIMARY KEY (jid),
  KEY privacy (privacy,dateline,updatetime),
  KEY authorid (authorid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS dzz_jilu_attach (
  qid int(10) unsigned NOT NULL AUTO_INCREMENT,
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  rid int(10) unsigned NOT NULL DEFAULT '0',
  cid int(11) NOT NULL DEFAULT '0' COMMENT '为LINK时的网址收藏ID（采集）',
  aid int(10) unsigned NOT NULL DEFAULT '0',
  title varchar(255) NOT NULL,
  downloads int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(30) NOT NULL DEFAULT '',
  img varchar(255) NOT NULL DEFAULT '',
  url varchar(255) NOT NULL DEFAULT '',
  ext varchar(32) NOT NULL,
  PRIMARY KEY (qid),
  KEY dateline (dateline),
  KEY tid (rid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS dzz_jilu_comment (
  cid int(10) unsigned NOT NULL AUTO_INCREMENT,
  rid int(10) unsigned NOT NULL DEFAULT '0',
  authorid int(10) unsigned NOT NULL DEFAULT '0',
  author varchar(15) NOT NULL DEFAULT '',
  ip varchar(20) NOT NULL DEFAULT '',
  `port` smallint(6) unsigned NOT NULL DEFAULT '0',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  message text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  ismobile varchar(60) NOT NULL DEFAULT '',
  pcid int(11) NOT NULL DEFAULT '0' COMMENT '回复的评论ID',
  pauthorid int(11) NOT NULL DEFAULT '0' COMMENT '被回复人id',
  PRIMARY KEY (cid),
  KEY authorid (authorid),
  KEY rid (rid,dateline)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS dzz_jilu_comment_at (
  cid int(10) unsigned NOT NULL DEFAULT '0',
  uid int(10) unsigned NOT NULL DEFAULT '0',
  dateline int(10) unsigned NOT NULL,
  UNIQUE KEY pid_uid (cid,uid),
  KEY dateline (dateline)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS dzz_jilu_item (
  rid int(10) unsigned NOT NULL AUTO_INCREMENT,
  jid char(10) NOT NULL DEFAULT '',
  authorid int(10) unsigned NOT NULL DEFAULT '0',
  author char(30) NOT NULL DEFAULT '',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  inarchive tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否归档',
  comments smallint(6) NOT NULL DEFAULT '0',
  zan smallint(6) NOT NULL DEFAULT '0',
  content text NOT NULL,
  title varchar(255) NOT NULL DEFAULT '',
  location varchar(255) NOT NULL DEFAULT '' COMMENT '位置信息',
  location_x float NOT NULL DEFAULT '0' COMMENT '纬度',
  location_y float NOT NULL DEFAULT '0' COMMENT '经度',
  ismobile varchar(15) NOT NULL DEFAULT '' COMMENT '手机系统类型',
  tags varchar(255) NOT NULL DEFAULT '',
  `type` enum('text','image','attach','link','list','video','voice') NOT NULL DEFAULT 'text',
  style tinyint(1) NOT NULL DEFAULT '0',
  labels mediumint(8) unsigned NOT NULL DEFAULT '0',
  ats text NOT NULL,
  deleteuid int(11) NOT NULL,
  deletetime int(11) NOT NULL,
  recycledel smallint(2) NOT NULL DEFAULT '0' COMMENT '作者回收站删除  1：已删除 0：未删除',
  PRIMARY KEY (rid),
  KEY jid (jid),
  KEY dateline (dateline)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS dzz_jilu_setting (
  skey varchar(255) NOT NULL DEFAULT '',
  svalue text NOT NULL,
  PRIMARY KEY (skey)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS dzz_jilu_todolist (
  todoid int(10) unsigned NOT NULL AUTO_INCREMENT,
  content varchar(255) NOT NULL,
  rid int(10) unsigned NOT NULL DEFAULT '0',
  checked tinyint(1) NOT NULL DEFAULT '0',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (todoid),
  KEY rid (rid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS dzz_jilu_user (
  id int(10) NOT NULL AUTO_INCREMENT,
  enter_agent tinyint(1) NOT NULL DEFAULT '0',
  jid char(10) NOT NULL DEFAULT '',
  uid int(10) unsigned NOT NULL DEFAULT '0',
  username char(30) NOT NULL DEFAULT '',
  perm tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:关注；2：:普通成员;3：管理员',
  dateline int(10) NOT NULL DEFAULT '0',
  lastvisit int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后访问时间',
  cover int(10) unsigned NOT NULL DEFAULT '0',
  color char(7) NOT NULL DEFAULT '',
  PRIMARY KEY (id),
  UNIQUE KEY jid_uid (jid,uid),
  KEY uid (uid),
  KEY dateline (dateline),
  KEY perm (perm),
  KEY jid (jid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS dzz_jilu_pin (
  `pin_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `data_id` varchar(30) NOT NULL COMMENT '记录本ID（jid）或者单条记录ID（rid）',
  `type` tinyint(4) NOT NULL COMMENT '1：记录本置顶 2：单条记录置顶',
  `pin_type` tinyint(4) NOT NULL COMMENT '1：个人置顶 2：全局置顶',
  `dateline` int(11) NOT NULL COMMENT '置顶时间',
  PRIMARY KEY (`pin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS dzz_jilu_zan (
  zid int(10) unsigned NOT NULL AUTO_INCREMENT,
  rid int(10) unsigned NOT NULL DEFAULT '0',
  uid int(10) unsigned NOT NULL DEFAULT '0',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (zid),
  UNIQUE KEY rid (rid,uid),
  KEY dateline (dateline)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS dzz_user_wechat (
  uid int(10) unsigned NOT NULL DEFAULT '0',
  openid char(28) NOT NULL DEFAULT '',
  appid char(18) NOT NULL DEFAULT '',
  unionid char(29) NOT NULL DEFAULT '',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY uid (uid),
  UNIQUE KEY openid (openid,appid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

EOF;

runquery($sql);


$finish = true;
