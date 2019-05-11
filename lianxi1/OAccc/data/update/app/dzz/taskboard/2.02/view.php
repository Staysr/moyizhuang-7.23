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
require_once libfile('function/taskboard');
$ismobile=helper_browser::ismobile();
$taskid=intval($_GET['taskid']);
$task=C::t('task')->fetch_by_taskid($taskid,1);
$tbid=$task['tbid'];
if(!$taskboard=C::t('task_board')->fetch_by_tbid($tbid,$_G['uid']) ){
	showmessage('任务板不存在或已删除',dreferer());
}
$json_board=json_encode($taskboard);

if($taskboard['perm']<1 && $taskboard['viewperm']<2){ //私有的文件只有成员才能查看
	showmessage('此任务板为私有，你不是任务板成员，无法查看',dreferer());
}
if($taskboard['status'] == 1 || $task['archivetime']>0){
	$task['disable']=3;
}elseif($taskboard['status'] == 2 || $task['deletetime']>0){
	$task['disable']=2;
}elseif($taskboard['perm']<2){
	$task['disable']=1;
}else{
	$task['disable']=0;
}

//$cat=C::t('task_cat')->fetch($task['catid']);

$json_board=json_encode($taskboard);


$navtitle=$task['name'];

 $task=formatTask($task);

if($ismobile){
	include template('mobile/view');
}else{
	include template('list/view');
}
?>
