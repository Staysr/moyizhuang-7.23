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
require 'conf.php'; 
require_once libfile('function/common');
$do=trim($_GET['do']);
$ismobile=helper_browser::ismobile();
$step=intval($_GET['step']);
if($_GET['do']=='menu'){
	$jid=trim($_GET['jid']);
	$jilu=C::t('jilu')->fetch($jid);	
	if(!$step){
		$status=empty($_GET['status'])?1:intval($_GET['status']);
	}elseif($step==1 ){	//设置
	   $colors= array('#DB4550','#EB563E','#FAB943','#88C251','#36BC9B','#3BAEDA','#967BDC','#D870AD','#656D78','#434A54');
	}elseif($step==2 ){	//归档
	   if(submitcheck('inarchivesubmit')){
			$perm=getVPermByUid($jid);
			if($perm<2) showmessage(lang('privilege'),dreferer(),array(),array('showmsg'=>true));
			if (C::t('jilu')->archive_by_jid($jid)) {
				C::t('jilu_pin')->deletePin(1, $jid);
			}
			showmessage('do_success',dreferer(),array('jid'=>$jid),array('showmsg'=>true));
		}
	}elseif($step==5){	//激活
	   if(submitcheck('activesubmit')){
			$perm=getVPermByUid($jid);
			if($perm<2) showmessage(lang('privilege'),dreferer(),array(),array('showmsg'=>true));
			C::t('jilu')->active_by_jid($jid);
			showmessage('do_success',dreferer(),array('jid'=>$jid),array('showmsg'=>true));
		}
	}elseif($step==3){//分享地址
		$jilu['shareurl']=$_G['siteurl'].MOD_URL.'&id='.$jid;
		$target='./qrcode/'.$jid[0].$jid[1].'/'.$jid.'.png';
		if(is_file($_G['setting']['attachdir'].$target)) $jilu['qrcode']=$_G['setting']['attachurl'].$target;
		else{
			$jilu['qrcode']=C::t('jilu')->getQRcodeByjid($jid);
		}
	}elseif($step==4){//删除
		if(submitcheck('deletesubmit')){
			$perm=getVPermByUid($jid);
			if($perm<2 || $jilu['inarchive']>0) showmessage(lang('privilege'),dreferer(),array(),array('showmsg'=>true));
			// C::t('jilu')->delete_by_jid($jid);//彻底删除
			//入回收站并取消置顶
			if(DB::update('jilu',array('deleteuid' => $_G['uid'], 'deletetime' => TIMESTAMP), array('jid' => $jid))){
				C::t('jilu_pin')->deletePin(1, $jid);
			}
			showmessage('do_success',dreferer(),array('jid'=>$jid),array('showmsg'=>true));
		}
	}elseif($step==6){//筛选
		$alllabels=getLabelsByjid($jilu['jid']);
		$users=C::t('jilu_user')->fetch_all_by_perm($jid,array('2','3'));
		$jilus=array();
		foreach(DB::fetch_all("select j.jid,j.title from %t j LEFT JOIN %t u ON j.jid=u.jid where u.uid=%d and u.perm>1 and j.deletetime <= 0",array('jilu','jilu_user',$_G['uid'])) as $value){
			$jilus[]=$value;
		}
		$_GET['users'] = $users;
		$_GET['jilus'] = $jilus;
		$_GET['alllabels'] = $alllabels;
	}
}elseif($do=='itemmenu'){
	if(!$step){
		$rid=intval($_GET['rid']);
		$ismy=intval($_GET['ismy']);
		$item=C::t('jilu_item')->fetch($rid);
		$jilu=C::t('jilu')->fetch($item['jid']);
		$perm=getVPermByUid($item['jid']);
		$pin = DB::result_first('select pin_type from %t where type = 2 and pin_type = 2 and data_id = %d', array('jilu_pin', $rid));
		if (!$pin) {
			$pin = DB::result_first('select pin_type from %t where type = 2 and pin_type = 1 and data_id = %d and uid = %d', array('jilu_pin', $rid, $_G['uid']));
		}
		$item['pin_type'] = $pin;
	}elseif($step==1){
		$rid=intval($_GET['rid']);
		$item=C::t('jilu_item')->fetch($rid);
		$perm = getPermByUid($_G['uid']);
		$myjilu=array();
		if($perm > 1){
			$jilus = DB::fetch_all('select jid,title from %t where deletetime <= 0 and inarchive = 0', array('jilu'));
		}else{
			$jilus = DB::fetch_all("select j.jid,j.title from %t j LEFT JOIN %t u ON j.jid=u.jid where u.uid=%d and u.perm>1 and deletetime <= 0 and inarchive = 0",array('jilu','jilu_user',$_G['uid']));
		}
		foreach($jilus as $value){
			$value['cover_uids']=C::t('jilu_user')->fetch_cover_uids_by_jid($value['jid']);
			$myjilu[]=$value;
		} 
	}
	
}elseif($do=='labelmenu'){
	if($step==1){
		
		$rid=intval($_GET['rid']);
		$item=C::t('jilu_item')->fetch($rid);
		$perm=getVPermByUid($item['jid']);
		$alllabels=getLabelsByjid($item['jid']);
		if($item['labels']>0) $item['labels']=getLabels($item['labels'],$item['jid']);
	}elseif($step==2){
		$jid=trim($_GET['jid']);
		$jilu=C::t('jilu')->fetch($jid);
		$perm=getVPermByUid($jid);
		if($perm<2) showmessage(lang('privilege'));
		if($jilu['deletetime'] > 0) showmessage(lang('recycle_file_can_not_edit'));
		if(!submitcheck('labelsetting')){
			$labels_all=getAllLabels();
			$labels=unserialize($jilu['labels']);
			$labelarr=array();
			foreach($labels_all as $key =>$value){
				if(isset($labels[$value['pow']])) $value['title']=$labels[$value['pow']];
				else $value['title']='';
				$labelarr[]=$value;
			}
		}else{
			$labels=array();
			foreach(array_unique($_GET['labelname']) as $pow =>$title){
				if(!empty($title)) $labels[$pow]=$title;
			}
			if(C::t('jilu')->update($jid,array('labels'=>serialize($labels)))){
				exit(json_encode(array('code' => 200, 'data' => getLabelsByjid($jid))));
			} else {
				exit(json_encode(array('code' => 400, 'msg' => lang('do_failed'))));
			}
			// showmessage('do_success',dreferer(),array(),array('showmsg'=>true));
		}
	}
}elseif($do=='mymenu'){
	if($step==1){//筛选
		$myjilu=array();
		foreach(DB::fetch_all("select j.jid,j.title from %t j LEFT JOIN %t u ON j.jid=u.jid where u.uid=%d and u.perm>1 ",array('jilu','jilu_user',$_G['uid'])) as $value){
			$myjilu[]=$value;
		}
		
	}elseif($step==2){//设置
		 $colors= array('#DB4550','#EB563E','#FAB943','#88C251','#36BC9B','#3BAEDA','#967BDC','#D870AD','#656D78','#434A54');
		 $userdata=DB::fetch_first("select * from %t where jid='' and uid=%d ",array('jilu_user',$_G['uid']));
	}
}
include template('pop_menu');




?>
