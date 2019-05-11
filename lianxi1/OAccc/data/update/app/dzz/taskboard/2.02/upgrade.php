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

ALTER TABLE  `dzz_task_board` ADD  `orgid` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' AFTER  `tbid`;
ALTER TABLE  `dzz_task_board_user` ADD  `lastvisit` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0';
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
