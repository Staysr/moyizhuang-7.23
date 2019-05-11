<?php
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}

function build_cache_jilu_setting() {
	global $_G;
	$data=array();
	$data=C::t('#jilu#jilu_setting')->fetch_all();
	$data['allownew']=intval($data['allownew']);
	
	if($data['moderators']){
		$data['moderators']=explode(',',$data['moderators']);
	}else{
		$data['moderators']=array();
	}
	if($data['posters']){
		$data['posters']=explode(',',$data['posters']);
	}else{
		$data['posters']=array();
	}
   
	savecache('jilu:setting', $data);
}

?>