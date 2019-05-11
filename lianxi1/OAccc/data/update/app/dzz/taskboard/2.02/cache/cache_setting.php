<?php
if(!defined('IN_DZZ')) {
	exit('Access Denied');
}

function build_cache_taskboard_setting() {
	$data=array();
	$data=C::t('#taskboard#task_setting')->fetch_all();
	savecache('taskboard:setting', $data);
}