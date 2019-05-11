<?php
/*
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
//此页的调用地址  index.php?mod=test;
//同目录的其他php文件调用  index.php?mod=test&op=test1;

if (!defined('IN_DZZ')) {//所有的php文件必须加上此句，防止被外部调用
	exit('Access Denied');
}
$navtitle=lang('appname');
Hook::listen('check_login');//检查是否登录，
$app_version='DzzContracts 2.0';
$ismobile=helper_browser::ismobile();
if($ismobile) {
    dheader('Location:'.outputurl($_G['siteurl'].MOD_URL.'&op=list&gid=frequent'));
}else {
    include  template('main');
}
