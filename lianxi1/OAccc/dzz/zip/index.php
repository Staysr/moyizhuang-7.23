<?php
/*
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
//ini_set("display_errors","On");
//error_reporting(E_ALL);
require_once libfile('function/zip');
/*@ini_set("memory_limit",'2048');//内存限制调大；
@set_time_limit(0);//执行时间调大；
*/

//创建临时目录
$dfolder=$_GET['folder'];
$dpath=$_GET['path'];
if($folder=dzzdecode($dfolder)){
	$arr=explode('/',$folder);
	$pfolder=array();
	if(count($arr)>1){
		for($i=0;$i<count($arr)-1;$i++){
			$pfolder[]=$arr[$i];
		};
	}else{
		$pfolder[]=$arr[0];
	}
	$pfolder=dzzencode(implode('/',$pfolder));
}
/*if(!$folder=dzzencode($dfolder)){
	$folder=random(32);
	$pfolder=dzzencode($folder);
	$url=DZZSCRIPT.'?mod=zip&folder='.dzzencode($folder).'&path='.$dpath;
	header("Location: $url");
	exit();
}*/
$ismobile=helper_browser::ismobile();
include template('main');

?>
