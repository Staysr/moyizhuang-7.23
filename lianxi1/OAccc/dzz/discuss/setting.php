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
$navs=array('basic'=>lang('basic'),
			'manage'=>lang('manage'),
			'cover'=>lang('cover')
			);
$do=empty($_GET['do'])?'basic':trim($_GET['do']);
$navtitle=$navs[$do].' - '.lang('appname');
$navlast=$navs[$do];
$operation=trim($_GET['operation']);
$muids=array();

//判断用户是否有管理员权限
if (!$_G['adminid']) {
	showmessage(lang('no_privilege'),dreferer());
}
if($do=='basic'){
	if($operation=='selectuser'){
		// if($m=C::t('discuss_setting')->fetch('moderators')){
		// 	$muids=explode(',',$m);
		// }
		if(submitcheck('selectsubmit')){
			$uids=$_GET['uids'];
			if($uids){
				$muids=$uids;
				C::t('discuss_setting')->update('moderators',implode(',',$muids));
			}
			savecache('discuss_moderators',$muids);
			$moderators=C::t('user')->fetch_all($muids);
			include template('setting_basic_userlist');
			exit();
		}else{
			$title=lang('allow_create_member');
			$navtitle=$title." - ".$navtitle;
			$navlast=$title;
			$refer=dreferer();
			
			include template('setting_basic_userlist');
			exit();
		}
	}elseif($operation=='deleteModerator'){
		$uid=intval($_GET['uid']);
		if($m=C::t('discuss_setting')->fetch('moderators')){
			$muids=explode(',',$m);
		}
		foreach($muids as $key=>$value){
			if($value==$uid) unset($muids[$key]);
		}
		if(C::t('discuss_setting')->update('moderators',implode(',',$muids))){
			savecache('discuss_moderators',$muids);
			exit(json_encode(array('msg'=>'success')));
		}else{
			exit(json_encode(array('msg'=>'removed')));
		}
	}else{
		if(submitcheck('settingsubmit')){
			$setarr=$_GET['settingnew'];
			$setarr['modreasons'] = implode(',', $setarr['modreasons']);
			$setarr['maxboard']=intval($setarr['maxboard']);
			//$setarr['orderfield']=intval($setarr['orderfield']);
			$setarr['optimizeviews']=intval($setarr['optimizeviews']);
			$setarr['preventrefresh']=intval($setarr['preventrefresh']);
			$setarr['allownewboard']=intval($setarr['allownewboard']);
			$setarr['indexcache']=intval($setarr['indexcache']);
			if($setarr['allownewboard']){
				$moderators=$_GET['moderators'];
				if($moderators) $setarr['moderators']=implode(',',$moderators);
				savecache('discuss_moderators',$moderators);
			}
			C::t('discuss_setting')->update_batch($setarr);
			savecache('discuss_setting',$setarr);
			if($setarr['modresions']){
				$data = str_replace(array("\r\n", "\r"), array("\n", "\n"), $data);
				$data = explode("\n", trim($data));
				savecache($reasionkey, $data);
			}else{
				savecache($reasionkey, '');
			}
			showmessage('do_success',DZZSCRIPT.'?mod=discuss&op=setting&do=basic');
		}else{
			
			$setting=C::t('discuss_setting')->fetch_all(array('moderators','indexcache','maxboard','topperm','allownewboard','optimizeviews','preventrefresh','postno','postnocustom','modreasons','hotlevels','rules'));
			$setting['maxboard']=intval($setting['maxboard']);
			//$setting['orderfield']=intval($setting['orderfield']);
			$setting['optimizeviews']=intval($setting['optimizeviews']);
			$setting['preventrefresh']=intval($setting['preventrefresh']);
			$setting['allownewboard']=intval($setting['allownewboard']);
			$setting['topperm']=unserialize($setting['topperm']);
			$setting['indexcache']=intval($setting['indexcache']);
			if($setting['moderators']){
				$muids=explode(',',$setting['moderators']);
			}
			$setting['modreasons'] = explode(',', $setting['modreasons']);
			$moderators=array();
			$moderators=C::t('user')->fetch_all($muids);
			
		}
	}
}elseif($do=='manage'){//讨论版管理
	if(submitcheck('settingsubmit')){
		foreach($_GET['del'] as $fid){
			C::t('discuss')->delete_permanent_by_fid($fid);
		}
		showmessage(lang('discuss_delete_success'),$_GET['refer']);
	
	}elseif($operation=='restore'){
		$fid=intval($_GET['fid']);
		if(C::t('discuss')->restore_by_fid($fid)){
			showmessage(lang('discuss_recovery_success'),$_GET['refer']);
		}else{
			showmessage(lang('discuss_recovery_failed'),$_GET['refer']);
		}	
	}elseif($operation=='delete'){
		$fid=intval($_GET['fid']);
		if(C::t('discuss')->delete_permanent_by_fid($fid)){
			showmessage(lang('discuss_delete_success'),$_GET['refer']);
		}else{
			showmessage(lang('discuss_delete_failed'),$_GET['refer']);
		}
	}else{
		require_once libfile('function/discuss');
		//error_reporting(E_ALL);
		$page = empty($_GET['page'])?1:intval($_GET['page']);
		$perpage=10;
		$keyword=trim($_GET['keyword']);
		$delete=intval($_GET['delete']);
		$inarchive=intval($_GET['inarchive']) ? 1 : 0;
		$gets = array(
				'mod'=>'discuss',
				'keyword'=>$keyword,
				'op' =>'setting',
				'do'=>'manage',
				'delete'=>$delete,
				'inarchive'=>$inarchive,
				
			);
		$theurl = DZZSCRIPT."?".url_implode($gets);
		$refer=urlencode($theurl.'&page='.$page);
		$limit=($page-1)*$perpage.'-'.$perpage;
		$temp=$list=array();
		if($count=C::t('discuss')->fetch_all_for_manage($limit,$keyword,$delete,true, $inarchive)){
			$temp=C::t('discuss')->fetch_all_for_manage($limit,$keyword,$delete, 0, $inarchive);
		}
		foreach($temp as $value){
			if($value['deleteuid']){
				 $user=getuserbyuid($value['deleteuid']);
				 $value['deleteusername']=$user['username'];
			}
			$list[]=$value;
		}
		$multi=multi($count, $perpage, $page, $theurl);
		
	}
}elseif($do=='wxapp'){
	$setting=C::t('discuss_setting')->fetch_all();
	$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=discuss',0);
	$baseurl_info=DZZSCRIPT.'?mod=discuss&op=setting&do=wxapp';
	$baseurl_menu=DZZSCRIPT.'?mod=discuss&op=setting&do=wxapp&operation=menu';
	$baseurl_ajax=DZZSCRIPT.'?mod=discuss&op=setting&do=wxapp&operation=ajax';
	if(empty($operation)){
		if(submitcheck('settingsubmit')){
			$settingnew=array();
			$settingnew['agentid']=intval($_GET['agentid']);
			$settingnew['appstatus']=intval($_GET['appstatus']);
			if($appid) C::t('wx_app')->update($appid,array('agentid'=>$settingnew['agentid'],'status'=>$settingnew['appstatus']));
			C::t('discuss_setting')->update_batch($settingnew);
			
			showmessage('do_success',dreferer(),array(),array('alert'=>'right'));
		}else{
			$navtitle=lang('wxapp_setting');
			$navlast=lang('wx_setting');
			$settingnew=array();
			if(empty($setting['token'])) $settingnew['token']=$setting['token']=random(8);
			if(empty($setting['encodingaeskey']))  $settingnew['encodingaeskey']=$setting['encodingaeskey']=random(43);
			if($settingnew){
				C::t('discuss_setting')->update_batch($settingnew);
			}
			$wxapp=array('appid'=>$appid,
						 'name'=>lang('discuss'),
						 'desc'=>lang('app_desc'),
						 'icon'=>'dzz/discuss/images/0.jpg',
						 'agentid'=> $setting['agentid'],
						 'token'=>$setting['token'],
						 'encodingaeskey'=>$setting['encodingaeskey'],
						 'host'=>$_SERVER['HTTP_HOST'],
						 'callback'=>$_G['siteurl'].'index.php?mod=discuss&op=wxreply',
						 'otherpic'=>'dzz/discuss/images/c.png',
						 'status'=>$setting['appstatus'],	//应用状态
						 'report_msg'=>1,                	//用户消息上报
						 'notify'=>0,                   	 //用户状态变更通知
						 'report_location'=>0,           	//上报用户地理位置
					);
			C::t('wx_app')->insert($wxapp,1,1);
		}
	}elseif($operation=='menu'){
		$menu=$setting['menu']?unserialize($setting['menu']):'';
	}elseif($operation=='ajax'){	
		if($_GET['action']=='setEventkey'){
			//支持的菜单事件
			$menu_select=array('click'=>array(),
								'link'=>array(
										$_G['siteurl'].DZZSCRIPT.'?mod=discuss'=>lang('post'),
										$_G['siteurl'].DZZSCRIPT.'?mod=discuss&op=my&do=mythread'=>lang('my'),
										$_G['siteurl'].DZZSCRIPT.'?mod=discuss&op=my'=>lang('plate')
								)
						);
			 
			
			$json_menu_select=json_encode($menu_select);
			$type=trim($_GET['type']);
			$typetitle=array('click'=>lang('set_menu_key'),'link'=>lang('set_menu_redirect'));
			
		}elseif($_GET['action']=='menu_save'){ //菜单保存
				C::t('discuss_setting')->update('menu',array('button'=>$_GET['menu']));
				if($appid) C::t('wx_app')->update($appid,array('menu'=>serialize(array('button'=>$_GET['menu']))));
				exit(json_encode(array('msg'=>'success')));
		}elseif($_GET['action']=='menu_publish'){//发布到微信
				$data=array('button'=>$_GET['menu']);
				  C::t('discuss_setting')->update('menu',$data);
				if($appid) C::t('wx_app')->update($appid,array('menu'=>serialize($data)));
				//发布菜单到微信
				if(getglobal('setting/CorpID') && getglobal('setting/CorpSecret') && $setting['agentid']){
					$wx=new qyWechat(array('appid'=>getglobal('setting/CorpID'),'appsecret'=>getglobal('setting/CorpSecret')));
					//处理菜单数据，所有本站链接添加oauth2地址
					foreach($data['button'] as $key=>$value){
						if($value['url'] && strpos($value['url'],$_G['siteurl'])===0){
							$data['button'][$key]['url']=$wx->getOauthRedirect(getglobal('siteurl').'index.php?mod=system&op=wxredirect&url='.dzzencode($value['url']));
						}elseif($value['sub_button']){
							foreach($value['sub_button'] as $key1=>$value1){
								if($value1['url'] && strpos($value1['url'],$_G['siteurl'])===0){
									$data['button'][$key]['sub_button'][$key1]['url']=$wx->getOauthRedirect(getglobal('siteurl').'index.php?mod=system&op=wxredirect&url='.dzzencode($value1['url']));
								}
							}
						}
					}
					if($wx->createMenu($data,$setting['agentid'])){
						exit(json_encode(array('msg'=>'success')));
					}else{
						exit(json_encode(array('error'=>lang('send_failed').',errCode:'.$wx->errCode.',errMsg:'.$wx->errMsg)));
					}
				}else{
					exit(json_encode(array('error'=>lang('send_failed_wx_no_agentid'))));
				}
				
		}elseif($_GET['action']=='menu_default'){//恢复默认
			
			$menu_default=array('button'=>array(
												array(
													'type'=>'view',	
													'name'=>lang('post'),
													'url'=>$_G['siteurl'].DZZSCRIPT.'?mod=discuss'
												),
												array(
													'type'=>'view',	
													'name'=>lang('my'),
													'url'=>$_G['siteurl'].DZZSCRIPT.'?mod=discuss&op=my&do=mythread'
												),
												array(
													'type'=>'view',	
													'name'=>lang('discuss'),
													'url'=>$_G['siteurl'].DZZSCRIPT.'?mod=discuss&op=my'
												)
										
								)
						  );
			C::t('discuss_setting')->update('menu',$menu_default);
			exit('success');
		}
		include template('common/wx_ajax');
		exit();
	}


}

include template('discuss_setting');
?>
 
