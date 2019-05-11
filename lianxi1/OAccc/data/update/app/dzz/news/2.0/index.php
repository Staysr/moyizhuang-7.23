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
$ismobile=helper_browser::ismobile();
//error_reporting(E_ALL);
//判断用户访问权限
include libfile('function/organization');
include libfile('function/news');
$perm=getPermByUid($_G['uid']);

$catid=empty($_GET['catid'])?0:intval($_GET['catid']);
$status=empty($_GET['status'])?1:intval($_GET['status']);
$keyword=empty($_GET['keyword'])?'':trim($_GET['keyword']);

//分页
$page = empty($_GET['page'])?1:intval($_GET['page']);
$perpage=10;
$gets = array(
		'mod'=>'news',
		'keyword'=>$keyword,
		'catid'=>$catid,
		'status'=>$status
	);
$theurl = DZZSCRIPT."?".url_implode($gets);
$refer=urlencode($theurl.'&page='.$page);
$start=($page-1)*$perpage;

//查询
$param=array('news');
$param[]='news_viewer';
$param[]=$_G['uid'];
$sql="1";
$orderby="ORDER BY n.istop DESC , n.dateline DESC";
if($perm<2){
	
	//阅读范围查询语句
	if($_G['uid']<1){
		$sql.=" and n.orgids='' and n.uids=''";
	}else{
		
		$sql.=" and ( n.authorid=%d OR (";
		$param[]=$_G['uid'];
		
		$sql_gid=array("n.orgids=''");
		if($orgarr=getDepartmentByUid($_G['uid'])){ //获取当前用户所在的部门数组
			foreach($orgarr as $value){
				foreach($value as $value1){
					$sql_gid[]="FIND_IN_SET(%d,orgids)";
					$param[]=$value1['orgid'];
				}
			}
		}else{
			$sql_gid[]="FIND_IN_SET(%s,orgids)";
			$param[]='other';
		}
		
		$sql.="(".implode(' OR ',$sql_gid).") and ( n.uids='' OR FIND_IN_SET(%d,n.uids))";
		
		$sql.="))";
		$param[]=$_G['uid'];
	}
	
}
if(!empty($keyword)){ //关键词查询时忽略分类
	$sql.=' and n.subject like %s';
	$param[]='%'.$keyword.'%';
	$catid=0;
	$status=1;
}

if($catid){
	/*$sql.=' and n.catid=%d';
	$param[]=$catid;*/
	$subids=C::t('news_cat')->getSonByCatid($catid);
	$sql.=' and catid IN(%n)';
	$param[]=$subids;
}
if($status==1){//已发布，待审核和草稿
	$sql.=' and n.status=%d';
	$param[]=$status;
	$navlast=$keyword?lang('search').$keyword:lang('have_published');
}elseif($status==6 ){//我发布的
	$sql.=' and n.status<2 and authorid=%d';
	$param[]=$_G['uid'];
	$navlast=lang('my_released');
}elseif($status==2 ){//待审核
	if($perm>1){ //管理员，调取所有需要审核的
		$sql.=" and n.status='2'";
	}else{  //非管理员只调取本人发布的等待审核的条目
		$sql.=" and n.status='2' and authorid=%d ";
		$param[]=$_G['uid'];
	}
	$orderby="ORDER BY n.istop DESC , n.updatetime DESC";
	$navlast=lang('check_pending');
}elseif($status==3){ //草稿箱，只调取当前用户的
  $sql.=" and n.status='3' and authorid=%d ";
  $param[]=$_G['uid'];
  $navlast=lang('drafts');
}elseif($status==4 ){ //未读
   
    $sql.=" and status='1' and isnull(v.vid)";
	$param[]=$_G['uid'];
	
	$navlast=lang('unread');
	
}elseif($status==5){ //已读
	$sql.="  and status='1' and v.vid>0";
	$param[]=$_G['uid'];
	
	$navlast=lang('read');
}
$data=array();
$topupdate=array();
if($count=DB::result_first("select count(*) from %t n LEFT JOIN %t v ON n.newid=v.newid and v.uid=%d where $sql",$param)){
	foreach(DB::fetch_all("select n.*,v.vid as isread from %t  n LEFT JOIN %t v ON n.newid=v.newid and v.uid=%d where $sql $orderby limit $start,$perpage",$param) as $value){
		$today=strtotime(dgmdate(TIMESTAMP,'Y-m-d'));
		$value['real_set_endtime']="";
		if($value['highlightendtime'] ) $value["real_set_endtime"]= dgmdate($value['highlightendtime'],'Y-m-d') ;
		$value['real_set_topendtime']="";
		if($value['topendtime'] ) $value["real_set_topendtime"]= dgmdate($value['topendtime'],'Y-m-d') ;
		if($value['topendtime']<$today){
			if($value['istop']){
				$updatearr[]=$value['newid'];
			}
			 $value['istop']=0;
		}
		if($value['highlightendtime']<$today ){
			 $value['ishighlight']=0;
		}
		if($value['opuid'] && $opuser=getuserbyuid($value['opuid'])){
			$value['opauthor']=$opuser['username'];
		}
		if($status==2 && $value['moduid'] && $moduser=getuserbyuid($value['moduid'])){
			$value['modusername']=$moduser['username'];
		}
		$data[]=$value;
	}
	$multi=multi($count, $perpage, $page, $theurl,'pull-center');
}
if($topupdate){ //置顶时间过期的，设置istop=0
	DB::update('news',array('istop'=>0),"newid IN (".dimplode($topupdate).")");
}

$catlist=getCatList(0,$catid);
//if($ismobile){
//	include template('news_list_mobile');
//}else{
	include template('news_list');
//}
?>
