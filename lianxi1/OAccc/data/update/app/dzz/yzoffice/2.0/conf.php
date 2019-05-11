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
define('PATH_URL','dzz/'.array_pop(explode(DIRECTORY_SEPARATOR,dirname(__FILE__))));
define('PATH_DIR',dirname(__FILE__).'/');
define('PATH_NAME',array_pop(explode(DIRECTORY_SEPARATOR,dirname(__FILE__))));
define('APP_URL',DZZSCRIPT.'?mod='.array_pop(explode(DIRECTORY_SEPARATOR,dirname(__FILE__))));
define('APP_NAME','永中office预览');//应用名称



