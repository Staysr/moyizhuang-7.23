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
//ALTER TABLE  `dzz_task_board` ADD  `orgid` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' AFTER  `tbid`
$sql = <<<EOF


CREATE TABLE IF NOT EXISTS `dzz_task` (
  `taskid` int(10) NOT NULL AUTO_INCREMENT,
  `tbid` int(10) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `username` char(30) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '任务到期时间',
  `labels` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '重要度色块，二进制表示',
  `replys` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '评论数量',
  `subs` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '子任务数量',
  `subs_c` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '子项完成数',
  `attachs` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '附件数',
  `money` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '任务预算',
  `money_u` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '事件花费',
  `worktime` float unsigned NOT NULL DEFAULT '0' COMMENT '预计工时',
  `worktime_u` float unsigned NOT NULL DEFAULT '0' COMMENT '实际使用工时',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:正常，1：进行中;2:已完成；3：归档;4：删除',
  `statustime` int(10) NOT NULL DEFAULT '0' COMMENT '状态时间戳',
  `statusuid` int(10) unsigned NOT NULL DEFAULT '0',
  `disp` smallint(6) NOT NULL DEFAULT '100',
  `deleteuid` int(10) unsigned NOT NULL DEFAULT '0',
  `deletetime` int(10) unsigned NOT NULL DEFAULT '0',
  `imageaid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`taskid`),
  KEY `endtime` (`endtime`),
  KEY `status` (`status`),
  KEY `catid` (`catid`),
  KEY `tbid` (`tbid`),
  KEY `deletetime` (`deletetime`)
) ENGINE=MyISAM ;


CREATE TABLE IF NOT EXISTS `dzz_task_archive` (
  `taskid` int(10) NOT NULL,
  `tbid` int(10) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `username` char(30) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '任务到期时间',
  `labels` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '重要度色块，二进制表示',
  `replys` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '评论数量',
  `subs` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '子任务数量',
  `subs_c` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '子项完成数',
  `attachs` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '附件数',
  `money` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '任务预算',
  `money_u` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '实际使用',
  `worktime` float(2,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '工时',
  `worktime_u` float(2,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '实际使用工时',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:正常，1：进行中;2:已完成；3：归档;4：删除',
  `statustime` int(10) NOT NULL DEFAULT '0' COMMENT '状态时间戳',
  `statusuid` int(10) unsigned NOT NULL DEFAULT '0',
  `disp` smallint(6) NOT NULL DEFAULT '100',
  `archivetime` int(10) NOT NULL DEFAULT '0' COMMENT '归档 时间',
  `deletetime` int(10) unsigned NOT NULL DEFAULT '0',
  `deleteuid` int(10) unsigned NOT NULL DEFAULT '0',
  `imageaid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`taskid`),
  KEY `endtime` (`endtime`),
  KEY `status` (`status`),
  KEY `catid` (`catid`),
  KEY `tbid` (`tbid`),
  KEY `archivetime` (`archivetime`),
  KEY `deletetime` (`deletetime`)
) ENGINE=MyISAM;


CREATE TABLE IF NOT EXISTS `dzz_task_attach` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `taskid` int(10) unsigned NOT NULL DEFAULT '0',
  `aid` int(10) unsigned NOT NULL DEFAULT '0',
  `tbid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `filesize` bigint(20) NOT NULL DEFAULT '0',
  `filetype` char(10) NOT NULL DEFAULT '',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `deletetime` int(10) unsigned NOT NULL DEFAULT '0',
  `deleteuid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(30) NOT NULL,
  `img` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `downloads` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `taskid` (`taskid`),
  KEY `tbid` (`tbid`)
) ENGINE=MyISAM ;


CREATE TABLE IF NOT EXISTS `dzz_task_attach_archive` (
  `id` int(10) unsigned NOT NULL,
  `taskid` int(10) unsigned NOT NULL DEFAULT '0',
  `aid` int(10) unsigned NOT NULL DEFAULT '0',
  `tbid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `filesize` bigint(20) NOT NULL DEFAULT '0',
  `filetype` char(10) NOT NULL DEFAULT '',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `deletetime` int(10) unsigned NOT NULL DEFAULT '0',
  `deleteuid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(30) NOT NULL,
  `img` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `downloads` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `taskid` (`taskid`),
  KEY `tbid` (`tbid`)
) ENGINE=MyISAM;


CREATE TABLE IF NOT EXISTS `dzz_task_board` (
  `tbid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orgid` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0',
  `name` varchar(80) NOT NULL DEFAULT '',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建用户uid',
  `username` char(30) NOT NULL DEFAULT '' COMMENT '创建者',
  `viewperm` tinyint(1) NOT NULL DEFAULT '0' COMMENT '查看权限',
  `tasks` int(10) NOT NULL DEFAULT '0' COMMENT '任务数',
  `tasks_c` int(10) unsigned NOT NULL DEFAULT '0',
  `worktime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '工时',
  `worktime_u` int(10) unsigned NOT NULL DEFAULT '0',
  `money` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '预算',
  `money_u` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态：0:正常，1：归档；2：删除',
  `statusuid` int(10) NOT NULL DEFAULT '0' COMMENT '改变状态用户',
  `statustime` int(10) NOT NULL DEFAULT '0' COMMENT '改变状态时间',
  `autoarchive` tinyint(1) NOT NULL DEFAULT '0' COMMENT '完成的任务自动归档',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '封面图标',
  `forceindex` tinyint(1) NOT NULL DEFAULT '0',
  `desc` text NOT NULL,
  `layout` tinyint(1) NOT NULL DEFAULT '0',
  `desc_status` varchar(80) NOT NULL DEFAULT '',
  `desc_status_color` varchar(15) NOT NULL DEFAULT '',
  `desc_date` varchar(80) NOT NULL DEFAULT '',
  `desc_money` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`tbid`),
  KEY `status` (`status`),
  KEY `statusuid` (`statusuid`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM ;


CREATE TABLE IF NOT EXISTS `dzz_task_board_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tbid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `username` char(30) NOT NULL DEFAULT '',
  `perm` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:关注；2：:普通成员;3：管理员',
  `dateline` int(10) NOT NULL DEFAULT '0',
  `lastvisit` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '用户最后访问时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cid_uid` (`tbid`,`uid`),
  KEY `uid` (`uid`),
  KEY `cid` (`tbid`),
  KEY `dateline` (`dateline`),
  KEY `perm` (`perm`)
) ENGINE=MyISAM ;


CREATE TABLE IF NOT EXISTS `dzz_task_cat` (
  `catid` int(10) NOT NULL AUTO_INCREMENT,
  `tbid` int(10) NOT NULL DEFAULT '0',
  `catname` char(50) NOT NULL DEFAULT '',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `username` char(30) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:正常，4::删除',
  `statusuid` int(10) unsigned NOT NULL DEFAULT '0',
  `statustime` int(10) NOT NULL DEFAULT '0',
  `disp` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`catid`),
  KEY `status` (`status`),
  KEY `disp` (`disp`)
) ENGINE=MyISAM ;


CREATE TABLE IF NOT EXISTS `dzz_task_cat_archive` (
  `catid` int(10) NOT NULL AUTO_INCREMENT,
  `tbid` int(10) NOT NULL DEFAULT '0',
  `catname` char(50) NOT NULL DEFAULT '',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `username` char(30) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:正常，2:已完成；4：删除',
  `statusuid` int(10) unsigned NOT NULL DEFAULT '0',
  `statustime` int(10) NOT NULL DEFAULT '0',
  `disp` smallint(6) NOT NULL DEFAULT '0',
  `archivetime` int(10) NOT NULL DEFAULT '0' COMMENT '归档时间',
  PRIMARY KEY (`catid`),
  KEY `status` (`status`),
  KEY `disp` (`disp`),
  KEY `archivetime` (`archivetime`)
) ENGINE=MyISAM ;


CREATE TABLE IF NOT EXISTS `dzz_task_event` (
  `eid` int(10) NOT NULL AUTO_INCREMENT,
  `tbid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `username` char(30) NOT NULL DEFAULT '',
  `body_template` varchar(30) NOT NULL DEFAULT '',
  `body_data` text NOT NULL,
  `bz` varchar(80) NOT NULL DEFAULT '',
  `dateline` int(11) NOT NULL,
  PRIMARY KEY (`eid`),
  KEY `uid` (`uid`),
  KEY `dateline` (`dateline`),
  KEY `bz` (`bz`),
  KEY `tbid` (`tbid`)
) ENGINE=MyISAM ;


CREATE TABLE IF NOT EXISTS `dzz_task_event_archive` (
  `eid` int(10) NOT NULL,
  `tbid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `username` char(30) NOT NULL DEFAULT '',
  `body_template` varchar(30) NOT NULL DEFAULT '',
  `body_data` text NOT NULL,
  `bz` varchar(80) NOT NULL DEFAULT '',
  `dateline` int(11) NOT NULL,
  PRIMARY KEY (`eid`),
  KEY `uid` (`uid`),
  KEY `dateline` (`dateline`),
  KEY `bz` (`bz`),
  KEY `tbid` (`tbid`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `dzz_task_field` (
  `taskid` int(10) unsigned NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  `description` text NOT NULL,
  UNIQUE KEY `taskid` (`taskid`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `dzz_task_field_archive` (
  `taskid` int(10) unsigned NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  `description` text NOT NULL,
  UNIQUE KEY `taskid` (`taskid`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `dzz_task_setting` (
  `skey` varchar(255) NOT NULL DEFAULT '',
  `svalue` text NOT NULL,
  PRIMARY KEY (`skey`)
) ENGINE=MyISAM;


CREATE TABLE IF NOT EXISTS `dzz_task_sub` (
  `subid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tbid` int(10) unsigned NOT NULL DEFAULT '0',
  `taskid` int(10) unsigned NOT NULL DEFAULT '0',
  `subname` text NOT NULL,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `completed` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '完成时间',
  `disp` smallint(6) NOT NULL DEFAULT '100',
  `completeuid` int(10) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`subid`),
  KEY `statustime` (`completed`),
  KEY `taskid` (`taskid`),
  KEY `disp` (`disp`,`taskid`)
) ENGINE=MyISAM ;


CREATE TABLE IF NOT EXISTS `dzz_task_sub_archive` (
  `subid` int(10) unsigned NOT NULL,
  `tbid` int(10) unsigned NOT NULL DEFAULT '0',
  `taskid` int(10) NOT NULL DEFAULT '0',
  `subname` text NOT NULL,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `completed` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '完成时间',
  `completeuid` int(10) unsigned NOT NULL DEFAULT '0',
  `disp` smallint(6) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `subid` (`subid`),
  KEY `statustime` (`completed`),
  KEY `taskid` (`taskid`),
  KEY `disp` (`disp`)
) ENGINE=MyISAM;



CREATE TABLE IF NOT EXISTS `dzz_task_user` (
  `tuid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tbid` int(10) NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `idtype` enum('task','task_cat') NOT NULL DEFAULT 'task',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `username` char(30) NOT NULL DEFAULT '',
  `action` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:关注；2：指派;',
  `dateline` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tuid`),
  UNIQUE KEY `action_id_idtype` (`idtype`,`id`,`action`,`uid`),
  KEY `uid` (`uid`),
  KEY `dateline` (`dateline`),
  KEY `uid_action_idtype` (`idtype`,`action`,`uid`),
  KEY `tbid` (`tbid`)
) ENGINE=MyISAM ;



CREATE TABLE IF NOT EXISTS `dzz_task_user_archive` (
  `tuid` int(10) unsigned NOT NULL,
  `tbid` int(10) unsigned NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `idtype` enum('task','task_cat') NOT NULL DEFAULT 'task',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `username` char(30) NOT NULL DEFAULT '',
  `action` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:关注；2：指派;',
  `dateline` int(10) NOT NULL DEFAULT '0',
  UNIQUE KEY `key` (`tuid`),
  KEY `uid` (`uid`),
  KEY `dateline` (`dateline`),
  KEY `action_id_idtype` (`idtype`,`id`,`action`),
  KEY `uid_action_idtype` (`idtype`,`action`,`uid`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `dzz_task_organization` (
  orgid int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  cover int(10) unsigned NOT NULL DEFAULT '0' COMMENT '群组封面',
  logo int(10) unsigned NOT NULL DEFAULT '0',
  `desc` text NOT NULL,
  uid int(10) unsigned NOT NULL DEFAULT '0',
  username varchar(30) NOT NULL DEFAULT '',
  privacy tinyint(1) NOT NULL DEFAULT '1' COMMENT '隐私设置：1：隐私；0：公开',
  mperm_c tinyint(1) NOT NULL DEFAULT '7' COMMENT '成员创建版面权限：0：不能创建版，1：隐私；2：小组内可见，4：公开；二进制组合',
  inviteperm tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1:仅可邀请小组内成员；0：任意成员',
  emaildomain text NOT NULL COMMENT '允许添加到小组的成员的email域名',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  color char(7) NOT NULL DEFAULT '',
  website varchar(255) NOT NULL DEFAULT '',
  removeperm tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (orgid),
  KEY uid (uid),
  KEY dateline (dateline)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `dzz_task_organization_user` (
  orgid int(10) NOT NULL DEFAULT '0',
  uid int(11) NOT NULL,
  perm tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '1:观察员：2：普通成员；3：管理员',
  dateline int(10) unsigned NOT NULL DEFAULT '0',
  id int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (id),
  UNIQUE KEY uid (uid,orgid),
  KEY dateline (dateline)
) ENGINE=MyISAM;


EOF;

runquery($sql);


$finish = true;
