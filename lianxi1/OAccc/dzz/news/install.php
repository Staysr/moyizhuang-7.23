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
DROP TABLE IF EXISTS dzz_news;
CREATE TABLE IF NOT EXISTS dzz_news (
  newid mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '新闻id',
  `subject` varchar(200) NOT NULL DEFAULT '' COMMENT '标题',
  content MEDIUMTEXT NOT NULL COMMENT '内容',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '内容类型 0为文章 1为图片 2为链接',
  author varchar(30) NOT NULL DEFAULT '' COMMENT '作者',
  authorid int(10) unsigned NOT NULL DEFAULT '0',
  modtime int(10) NOT NULL DEFAULT '0',
  moduid int(10) unsigned NOT NULL DEFAULT '0' COMMENT '审批人',
  modreason varchar(255) NOT NULL DEFAULT '' COMMENT '退回原因',
  dateline int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  updatetime int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  attachs text NOT NULL COMMENT '附件aids',
  commentstatus tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '评论状态，1为开启0为关闭',
  votestatus tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '投票状态 1为开启0为关闭',
  url char(255) NOT NULL DEFAULT '' COMMENT '超链接地址',
  catid smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '所属分类',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '新闻状态，1为公开2为审核3为草稿',
  orgids text NOT NULL COMMENT '阅读范围 部门',
  uids text NOT NULL COMMENT '阅读范围 人员',
  istop tinyint(1) NOT NULL DEFAULT '0' COMMENT '置顶顺序',
  toptime int(10) NOT NULL DEFAULT '0' COMMENT '置顶时间',
  topendtime int(10) unsigned NOT NULL DEFAULT '0' COMMENT '置顶过期时间',
  ishighlight tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否高亮',
  highlightstyle char(80) NOT NULL DEFAULT '' COMMENT '高亮样式',
  highlightendtime int(10) unsigned NOT NULL DEFAULT '0' COMMENT '高亮过期时间',
  comments int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数量',
  views smallint(6) NOT NULL DEFAULT '0',
  opuid int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (newid),
  KEY `SUBJECT` (`subject`) USING BTREE,
  KEY PROVIDER (author) USING BTREE,
  KEY NEWS_TIME (dateline) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS dzz_news_cat;
CREATE TABLE IF NOT EXISTS dzz_news_cat (
  catid smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  pid smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '父分类id',
  `name` char(60) NOT NULL COMMENT '新闻分类名称',
  disp smallint(6) NOT NULL DEFAULT '0' COMMENT '排序号',
  status TINYINT(1) NOT NULL DEFAULT '1' COMMENT '1正常;-1删除',
  PRIMARY KEY (catid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS dzz_news_pic;
CREATE TABLE IF NOT EXISTS dzz_news_pic (
  picid int(10) NOT NULL AUTO_INCREMENT,
  newid int(10) unsigned NOT NULL DEFAULT '0',
  title varchar(255) NOT NULL DEFAULT '',
  aid int(10) unsigned NOT NULL DEFAULT '0',
  disp smallint(6) unsigned DEFAULT '0',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (picid),
  KEY newid (newid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS dzz_news_setting;
CREATE TABLE IF NOT EXISTS dzz_news_setting (
  skey varchar(30) NOT NULL DEFAULT '',
  svalue text NOT NULL,
  PRIMARY KEY (skey)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS dzz_news_viewer;
CREATE TABLE IF NOT EXISTS dzz_news_viewer (
  vid mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '读者id',
  newid mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '新闻id',
  uid mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '阅读者UID',
  dateline int(10) unsigned NOT NULL DEFAULT '0' COMMENT '阅读时间',
  username varchar(30) NOT NULL,
  views int(10) unsigned NOT NULL DEFAULT '0' COMMENT '阅读次数',
  PRIMARY KEY (vid),
  UNIQUE KEY nuid (newid,uid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
EOF;
runquery($sql);
$finish = true;
