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
function getViewPerm($news){
	global $_G;
	//自己发布的有权限
	if($news['authorid']==$_G['uid']) return true;
	//管理员有权限
	if(getPermByUid($_G['uid'])>1) return true; 
	//游客时，只要设置了范围，就没有权限；
	if($_G['uid']<1 && ($news['orgids'] || $news['uids'])) return false; 
	
	
	//转换为数组
	if($news['orgids']){
		$news['orgids']=explode(',',$news['orgids']);
	}else{
		$news['orgids']=array();
	}
	//转换为数组
	if($news['uids']){
		$news['uids']=explode(',',$news['uids']);
	}else{
		$news['uids']=array();
	}
	
	//判断普通用户权限
	if(!$news['uids'] && !$news['orgids']) return   true; //未设置范围，全部有权限
	if($news['uids'] && in_array($_G['uid'],$news['uids'])){ //用户在用户列表内，允许查看
		return true;
	}
	//当未加入机构和部门在部门列表中时，单独判断;
	if(in_array('other',$news['orgids']) && !DB::result_first("SELECT COUNT(*) from %t where uid=%d",array('organization_user',$_G['uid']))){ 
		 return true;		
	}
	//获取用户所在的机构或部门
	$orgids=C::t('organization_user')->fetch_orgids_by_uid($_G['uid']);
	
	if(array_intersect($orgids,$news['orgids'])) return true;
	
	//检查每个部门的下级
	foreach($orgids as $orgid){
		$upids= C::t('organization')->fetch_parent_by_orgid($orgid,true);
		if($upids && array_intersect($upids,$news['orgids'])) return true;
	}
	return false;
}
function getPermByUid($uid){ //获取用户权限；
	global $_G;
	if($_G['uid']<1) return 0;
	if($_G['adminid']==1) return 3;
	if(!$_G['cache']['news:setting']) loadcache('news:setting');
	$setting=$_G['cache']['news:setting'];
	if(in_array($_G['uid'],$setting['moderators'])) return 2;
	elseif($setting['allownewnews'] && in_array($_G['uid'],$setting['posters'])) return 1;
	elseif($setting['allownewnews']<1) return 1;
	else return 0;
}
function getCatOptions($catid=0,$scatid=0,$notcatid=0,$padding='' ){
	foreach(C::t('news_cat')->fetch_all_by_pid($catid) as $value){
		if($notcatid==$value['catid']) continue;
		$html.='<option value="'.$value['catid'].'" '.($value['catid']==$scatid?'selected="selected"':'').'>'.$padding.$value['name'].'</option>';
		$html.=getCatOptions($value['catid'],$scatid,$notcatid,$padding.'&nbsp;&nbsp;&nbsp;&nbsp;');
	}
	return $html;
}
function getOrgOptions($orgid=0,$sorgid=array(),$padding=''){
	foreach(C::t('organization')->fetch_all_by_forgid($orgid) as $value){
		$html.='<option value="gid_'.$value['orgid'].'" '.(in_array($value['orgid'],$scatid)?'selected="selected"':'').'>'.$padding.$value['orgname'].'</option>';
		$html.=getOrgOptions($value['orgid'],$sorgid,$padding.'&nbsp;&nbsp;&nbsp;&nbsp;');
	}
	return $html;
}
function getCatList($catid=0,$scatid=0){
	$html='<ul class="nav-stacked">';
	$list = DB::fetch_all("select * from %t where pid=%d and `status`='1' order by disp desc",array('news_cat',$catid));//C::tp_t('news_cat')->where(array("status"=>1,"pid"=>$catid ) )->order("disp asc")->select();
	foreach($list as $value){
		$html.='<li id="cat_'.$value['catid'].'" data-catid="'.$value['catid'].'" data-pid="'.$value['pid'].'" role="presentation" '.($value['catid']==$scatid?'class="active"':'').'><a href="'.DZZSCRIPT.'?mod=news&catid='.$value['catid'].'"><i class="dzz dzz-news" style="padding-right: 14px;font-size: 22px;vertical-align: -4px;"></i><span class="catname">'.$value['name'].'</span><span class="cat-ctrl js-popbox" data-href="catmenu&catid='.$value['catid'].'"  data-placement="right" data-auto-adapt="true"><i class="glyphicon glyphicon-chevron-right"></i></span></a>';
		
		//$html.=getCatList($value['catid'],$scatid);
		$html.='</li>';
	}
	$html.='</ul>';
	return $html;
}
function getUidsByOrgid($orgids,$uids){ //通过获取在此机构数组下的所有用户
	@set_time_limit(0);
	if($uids) $uids=explode(',',$uids);
	else $uids=array();
	if($orgids) $orgids=explode(',',$orgids);
	else $orgids=array();
	if($orgids){//获取机构的id
		if(in_array('other',$orgids)){
			if($nots=C::t('organization_user')->fetch_user_not_in_orgid(1000)) $uids=array($uids,array_keys($nots));
			$orgids=array_diff($orgids,array('other'));
		}
		if($orgids && ($ouids=getUserByOrgid($orgids,1,array(),true))){
			$uids=array_merge($uids,$ouids);
			unset($ouids);
		}
		return array_unique($uids);
	}else{//orgids为空时
		if($uids) return array_unique($uids);
		else{ //返回全体成员id
			foreach(DB::fetch_all("select u.uid from %t u LEFT JOIN %t s on u.uid=s.uid where  u.status<1 order by s.lastactivity DESC limit 1000",array('user','user_status')) as $value){
				$uids[]=$value['uid'];
			}
			return array_unique($uids);
		}
	}
}
?>
