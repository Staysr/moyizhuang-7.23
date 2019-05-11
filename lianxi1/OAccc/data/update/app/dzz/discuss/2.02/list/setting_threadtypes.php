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
}exit('已经没有了这项设置');
$type=trim($_GET['type']);
$navtitle='主题分类 - '.$discuss['name'];
$navlast='主题分类';
if(submitcheck('discusssubmit')){
	if($type=='item'){
		$types=array();
		$icons=array();
		if($_GET['delete']) C::t('discuss_threadclass')->delete($_GET['delete']);
		foreach($_GET['newname'] as $key=>$value){
			if(empty($value)) continue;
			$setarr=array('fid'=>$fid,
						  'displayorder'=>$_GET['newdisplayorder'][$key],
						  'name'=>str_replace('...','',getstr($value,50)),
						  'icon'=>$_GET['newicon'][$key],
						  'enable'=>intval($_GET['newenable'][$key]),
						  'moderators'=>intval($_GET['newmoderators'][$key])
						  );
			
			$setarr['typeid']=C::t('discuss_threadclass')->insert($setarr,1);
			$types[$setarr['typeid']]=$setarr['name'];
			$icons[$setarr['typeid']]=$setarr['icon'];
		}
		foreach($_GET['name'] as $key=>$value){
			if(empty($value)) continue;
			if(in_array($key,$_GET['delete'])) continue;
			$setarr=array('fid'=>$fid,
						  'displayorder'=>$_GET['displayorder'][$key],
						  'name'=>str_replace('...','',getstr($value,50)),
						  'icon'=>$_GET['icon'][$key],
						  'enable'=>intval($_GET['enable'][$key]),
						  'moderators'=>intval($_GET['moderators'][$key])
						  );
			
			C::t('discuss_threadclass')->update($key,$setarr);
			$setarr['typeid']=$key;
			$types[$key]=$setarr['name'];
			$icons[$key]=$setarr['icon'];
			
		}
		//更新论坛
		$discuss['threadtypes']['types']=$types;
		$discuss['threadtypes']['icons']=$icons;
		C::t('discuss_field')->update($fid,array('threadtypes'=>serialize($discuss['threadtypes'])));
		showmessage('do_success',dreferer());
	}else{
		$_GET['threadtypes']['types']=$discuss['threadtypes']['types'];
		$_GET['threadtypes']['icons']=$discuss['threadtypes']['icons'];
		C::t('discuss_field')->update($fid,array('threadtypes'=>serialize($_GET['threadtypes'])));
		showmessage('do_success',dreferer());
	}
}elseif($type=='item'){
	
	$list=C::t('discuss_threadclass')->fetch_all_by_fid($fid);
}else{
	$threadtypes=$discuss['threadtypes'];
}
?>
