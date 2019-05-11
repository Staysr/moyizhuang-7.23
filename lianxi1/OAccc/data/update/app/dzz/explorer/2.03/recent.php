<?php
if (!defined('IN_DZZ')) {
    exit('Access Denied');
}
Hook::listen('check_login');//检查是否登录，未登录跳转到登录界面
$uid = $_G['uid'];
$do = isset($_GET['do']) ? trim($_GET['do']):'';
if($do == 'filelist'){
	$sid=htmlspecialchars($_GET['sid']);
    $limit=isset($_GET['perpage'])?intval($_GET['perpage']):20;//默认每页条数
    $page = empty($_GET['page'])?1:intval($_GET['page']);//页码数
    $start = ($page-1)*$perpage;//开始条数
    $limitsql = "limit $start,$limit";
	$perpage=25;
    $disp = isset($_GET['disp']) ? intval($_GET['disp']):4;

    $keyword = isset($_GET['keyword']) ? urldecode($_GET['keyword']) : '';

    $asc = isset($_GET['asc'])?intval($_GET['asc']):1;

    $order = $asc > 0 ? 'ASC' : "DESC";

    switch ($disp) {
        case 0:
            $orderby = 'filename';
            break;
        case 1:
            $orderby = 'size';
            break;
        case 2:
            $orderby = 'type';
            break;
        case 3:
            $orderby = 'dateline';
            break;

    }
    $ordersql='';
    if(is_array($orderby)){
        foreach($orderby as $key=>$value){
            $orderby[$key]=$value.' '.$order;
        }
        $ordersql=' ORDER BY '.implode(',',$orderby);
    }elseif($orderby){
        $ordersql=' ORDER BY '.$orderby.' '.$order;
    }
	//最近使用文件
    $explorer_setting = get_resources_some_setting();
    $recents = C::t('resources_statis')->fetch_recent_files_by_uid();
	$data=array();
	$folderids=$folderdata=array();
    foreach($recents as $val){
        if($val = C::t('resources')->fetch_by_rid($val['rid'])){
            if(!$explorer_setting['useronperm'] && $val['gid'] == 0){
                continue;
            }
            if(!$explorer_setting['grouponperm'] && $val['gid'] > 0){
                if(DB::result_first("select `type` from %t where orgid = %d",array('organization',$val['gid'])) == 1){
                    continue;
                }
            }
            if(!$explorer_setting['orgonperm'] && $val['gid'] > 0){
                if(DB::result_first("select `type` from %t where orgid = %d",array('organization',$val['gid'])) == 0){
                    continue;
                }
            }
			$folderids[$val['pfid']]=$val['pfid'];
			if($val['type']=='folder') $folderids[$val['oid']]=$val['oid'];
			if($val['isdelete'] == 0){
                $data[$val['rid']]=$val;
            }

		}
		
	}
	//获取目录信息
	foreach($folderids as $fid){
		if($folder = C::t('folder')->fetch_by_fid($fid)) $folderdata[$fid] =$folder;
	}
	
	$disp = isset($_GET['disp']) ? intval($_GET['disp']) : 0;//文件排序
    $iconview=isset($_GET['iconview']) ? intval($_GET['iconview']):4;//排列方式
    if(count($data) >= $perpage){
        $total = $start + $perpage*2 -1;
    }else{
        $total = $start + count($data);
    }
    if(!$json_data=json_encode($data)) $data=array();
    if(!$json_data=json_encode($foldedata)) $folderdata=array();
    //返回数据
    $return=array(
        'sid'=>$sid,
        'total'=>$total,

        'data'=>$data?$data:array(),
        'folderdata'=>$folderdata?$folderdata:array(),
        'param'=>array(
			'disp'=>$disp,
			'view'=>$iconview,
            'page'=>$page,
            'perpage'=>$perpage,
            'bz'=>$bz,
            'total'=>$total,
            'asc'=>$asc,
            'keyword'=>$keyword,
			'tags'=>'',
			'exts'=>'',
            'localsearch'=>$bz?1:0
        )
    );
    exit(json_encode($return));

}else{
	include template('recent_content');
}