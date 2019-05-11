<?php
/* @authorcode  codestrings
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
if (!defined('IN_DZZ') || !defined('IN_ADMIN')) {
	exit('Access Denied');
}
if( !isset($apparray['app']['extra']['ZohoAPIKey']) || !$apparray['app']['extra']['ZohoAPIKey'] ){
	showmessage('zoho_enable_failed' );
}
$finish = true;
 
