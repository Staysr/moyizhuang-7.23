<?php
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}

function build_cache_news_setting() {
	global $_G;
	$data=array();
	$data=C::t('#news#news_setting')->fetch_all();
	$data['allownewnews']=intval($data['allownewnews']);
	
	$data['newsmod']=intval($data['newsmod']);
	if($data['moderators']){
		$data['moderators']=explode(',',$data['moderators']);
	}else{
		$data['moderators']=array();
	}
	if($data['posters']){
		$data['posters']=explode(',',$data['posters']);
	}else	$data['posters']=array();
   
	savecache('news:setting', $data);
}

?>