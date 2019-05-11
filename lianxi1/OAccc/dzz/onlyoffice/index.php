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

$app=C::t('app_market')->fetch_by_identifier('onlyoffice','dzz');
$app['extra']=unserialize($app['extra']);
$onlyDocumentUrl=$app['extra']['DocumentUrl'];
if(empty($onlyDocumentUrl)) showmessage('onlyoffice_enable_failed');

$path=dzzdecode(rawurldecode($_GET['path']));
if($_GET['do']=='savefile'){
	if (($body_stream = file_get_contents("php://input"))===FALSE){
		exit("Bad Request");
	}
	$data = json_decode($body_stream, TRUE);
    $uid=intval($_GET['uid']);
	$user=getuserbyuid($uid);
	include libfile('function/user','','user');
	setloginstatus($user,0);
	if ($data["status"] == 2){
		$downloadUri = $data["url"];
		$new_data = file_get_contents($downloadUri);
		if(empty($new_data)){
			//runlog('onlyoffice',' file_get_contents('.$downloadUri.') failure');
			exit("Bad Response");
		}else{
			$keys=explode('_',$data['key']);
			$path=dzzdecode($keys[0]);
			$re=IO::setFileContent($path,$new_data,true);
			if($re['error']){
				//runlog('onlyoffice',$re['error']);
				exit($re['error']);
			}
		}
	}
	exit("{\"error\":0}");
}else{
	$docexts=array('doc', 'docx', 'rtf', 'odt', 'htm', 'html', 'mht', 'txt');
	$sheetexts=array('xls', 'xlsx', 'ods',  'csv');
	$showexts=array('ppt', 'pptx', 'pps', 'ppsx', 'odp');

	$meta=IO::getMeta($path);
	if($meta['error']) showmessage($meta['error']);
	$navtitle=$meta['name'];
	if(in_array($meta['ext'],$docexts)){
		$documentType='text';
	}elseif(in_array($meta['ext'],$sheetexts)){
		$documentType='spreadsheet';
	}elseif(in_array($meta['ext'],$showexts)){
		$documentType='presentation';
	}

	if(!perm_check::checkperm('edit',$meta)){
		$mode='view';
		$perm_edit=0;
	}else{
		$mode='edit';
		$perm_edit=1;
	}
	if(!perm_check::checkperm('download',$meta)){
		$perm_download=0;
		$perm_print=0;
	}else{
		$perm_download=1;
		$perm_print=1;
	}
	$key=$_GET['path'].'_'.$meta['md5'];
	$stream=IO::getFileUri($path);
	$saveurl=$_G['siteurl'].DZZSCRIPT.'?mod=onlyoffice&do=savefile&path='.dzzencode($path).'&uid='.$_G['uid'];
	include template('main');
}
?>
