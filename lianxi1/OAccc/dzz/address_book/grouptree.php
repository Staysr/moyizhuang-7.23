<?php
if (!defined('IN_DZZ')) {
    exit('Access Denied');
}
global $_G;
Hook::listen('check_login');//检查是否登录，未登录跳转到登录界面
$ismobile=helper_browser::ismobile();
$uid = $_G['uid'];
$id = isset($_GET['id']) ? $_GET['id']:'';
$do=$_GET['do']?$_GET['do']:'get_children';
$data = array();
if($do=='get_children'){
	if(preg_match('/gid_\d+/',$id)){
		$gid = intval(str_replace('gid_','',$id));
		$groupinfo = C::t('organization')->fetch_all_by_forgid($gid);
		if($groupinfo) {
			foreach ($groupinfo as $val) {
                $children = (DB::result_first("select count(*) from %t where forgid = %d",array('organization',$val['orgid'])) > 0) ? true:false;
				$arr= array(
					'id' =>'gid_'.$val['orgid'],
					'type' => 'department',
					'children' => $children,
					'li_attr' => array('hashs' => 'gid-' . $val['orgid']),
					'gid' => $val['orgid']
				);
                if(intval($val['aid'])==0){
                    $arr['text'] = avatar_group($val['orgid']).$val['orgname'];
                    $arr['icon'] = false;
                }else{
                    $arr['text'] = $val['orgname'];
                    $arr['icon']='index.php?mod=io&op=thumbnail&width=24&height=24&path=' . dzzencode('attach::' . $val['aid']);
                }
                /*if(preg_match('/\d+/',$v['aid']) && $v['aid'] > 0 ) {
                    $arr['icon']='index.php?mod=io&op=thumbnail&width=24&height=24&path=' . dzzencode('attach::' . $v['aid']);
                }*/
				$data[]=$arr;
			}
		}
	}else {
           // $orgs = C::t('organization')->fetch_all_orggroup($uid);
			//机构和部门全部获取
		    $orgs=C::t('organization')->fetch_all_by_forgid(0);
		   //获取用户所在的群组
			
		  
            foreach ($orgs as $v) {
                if(DB::result_first("select count(*) from %t where forgid = %d",array('organization',$v['orgid'])) > 0 ){
                    $children = true;
                }else{
                    $children = false;
                }
				
                if (!empty($v)) {
                    $arr = array(
                        'id' => 'gid_' . $v['orgid'],
                       // 'text' => (!preg_match('/^\d+$/',$v['aid']))?'<span class="iconFirstWord" style="background:'.$v['aid'].';">'.strtoupper(new_strsubstr($v['orgname'],1,'')).'</span>'.$v['orgname']:$v['orgname'],
                        'type' => ($v['pfid'] > 0 ? 'department' : 'organization'),
                        'children' => $children,
                        'li_attr' => array('hashs' => 'gid-' . $v['orgid']),
                        'gid' => $v['orgid']
                    );
					
                    if(preg_match('/^\#.+/',$v['aid'])){
                        $arr['text'] = avatar_group($v['orgid']).$v['orgname'];
                        $arr['icon'] = false;
                    }elseif(preg_match('/^\d+$/',$v['aid']) && $v['aid'] > 0){
                        $arr['text'] = $v['orgname'];
                        $arr['icon']='index.php?mod=io&op=thumbnail&width=24&height=24&path=' . dzzencode('attach::' . $v['aid']);
                    }else{
                        $arr['text'] = $v['orgname'];
                    }
                    $data[] = $arr;
                }
            }
			
    }

/*}elseif($do == 'gettop'){
    $orgid = '';
    C::t('organization')->fetch_parent_by_orgid($orgid);*/
    if ($ismobile) {
    	include  template('mobile/department');
    	dexit();
    }
}elseif($do == 'getParentsArr'){//获取
	
	$gid=intval($_GET['gid']);
	$ret=array();
	if($gid){
		$subfix='';
		foreach(C::t('organization')->fetch_parent_by_orgid($gid) as $orgid){
			if(empty($subfix)){
					$org=C::t('organization')->fetch($orgid);
					if($org['type']==0){
						$subfix='gid_';
					}elseif($org['type']==1){
						$subfix='g_';
					}
			}
			$arr[]='gid_'.$orgid;
			
		}
		if($subfix=='g_') array_unshift($arr,'group');
	}
	$arr=array_unique($arr);
    exit(json_encode($arr));
}
exit(json_encode($data));