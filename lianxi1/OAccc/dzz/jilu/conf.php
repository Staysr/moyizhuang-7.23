<?php
/* @authorcode  codestrings
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */

if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
// define('PATH_ROOT','dzz/'.array_pop(explode(DIRECTORY_SEPARATOR,dirname(__FILE__))));//MOD_PATH
define('BASEDIR',dirname(__FILE__));
// define('PATH_NAME',array_pop(explode(DIRECTORY_SEPARATOR,dirname(__FILE__))));//MOD_NAME
// define('PATH_URL',DZZSCRIPT.'?mod='.array_pop(explode(DIRECTORY_SEPARATOR,dirname(__FILE__))));//MOD_URL
define('APP_LIST_NAME',lang('record_book_list'));//列表名称
define('APP_ITEM_NAME',lang('record'));//条目名称

if(!$_G['cache']['jilu:setting']) loadcache('jilu:setting');
$setting=$_G['cache']['jilu:setting'];
$host=$_SERVER['HTTP_HOST'];
if($setting[$host]){
	if($setting[$host]=unserialize($setting[$host])) $setting=array_merge($setting,$setting[$host]);
}
if($setting['menu_mp_'.$host]){
	if($setting['menu_mp'.$host]=unserialize($setting['menu_mp_'.$host])) $setting['menu_mp']=$setting['menu_mp_'.$host];
}
