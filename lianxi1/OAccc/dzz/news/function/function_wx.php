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
include_once libfile('function/organization');

//获取最新的信息
/**
	 * 设置回复图文
	 * @param array $newsData 
	 * 数组结构:
	 *  array(
	 *  	"0"=>array(
	 *  		'Title'=>'msg title',
	 *  		'Description'=>'summary text',
	 *  		'PicUrl'=>'http://www.domain.com/1.jpg',
	 *  		'Url'=>'http://www.domain.com/1.html'
	 *  	),
	 *  	"1"=>....
	 *  )
	 */
function getLatestData($wx,$uid,$limit=10){
	$param=array('news');
	$sql="status<2";
	$orderby="ORDER BY dateline DESC";
	
	//阅读范围查询语句
	$sql.=" and (";
	$sql_gid=array("orgids=''");
	$orgarr=getDepartmentByUid($uid); //获取当前用户所在的部门数组
	foreach($orgarr as $value){
		foreach($value as $value1){
			$sql_gid[]="FIND_IN_SET(%d,orgids)";
			$param[]=$value1['orgid'];
		}
	}
	$sql.="(".implode(' OR ',$sql_gid).") and ( uids='' OR FIND_IN_SET(%d,uids)))";
	$param[]=$uid;
		
	$data=array();
	$limit=intval($limit);
	if(!$limit) $limit=10;
	foreach(DB::fetch_all("select * from %t where $sql $orderby limit $limit ",$param) as $value){
		$temp=array();
		$temp['Title']=$value['subject'];
		$url=getglobal('siteurl').'index.php?mod=news&op=view&newid='.$value['newid'];
		if($value['type']==0){ //文本模式
			$temp['Description']=getstr($value['content'],300,0,0,0,-1);
			$temp['Url']=getOauthRedirect($url);
		}elseif($value['type']==1){ //图片模式
			$temp['Description']='';
			$temp['Url']=getOauthRedirect($url);
			if($pic=DB::fetch_first("select aid from %t where newid=%d limit 1",array('news_pic',$value['newid']))){
				$temp['PicUrl']=getglobal('siteurl').'index.php?mod=io&op=thumbnail&original=1&path='.dzzencode('attach::'.$pic['aid']);
			}
		}else{ //链接模式
		    $temp['Url']=$value['url'];
			$temp['Description']='';
		}
		$data[]=$temp;
	}
	return $data;
}
?>
