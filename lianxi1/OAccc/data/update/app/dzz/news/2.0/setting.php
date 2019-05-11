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
include libfile('function/cache');
include libfile('function/news');


Hook::listen('adminlogin'); 
$navtitle=lang('informations');
$navlast=lang('base_setting');
$operation=trim($_GET['operation']);
$muids=array();
//error_reporting(E_ALL);
//判断用户是否有管理员权限
$perm=getPermByUid($_G['uid']);
if($perm<2){
	showmessage(lang('have_no_right'),dreferer());
}
if(!$_G['cache']['news:setting']) loadcache('news:setting');
$setting=$_G['cache']['news:setting'];
$do=empty($_GET['do'])?'basic':trim($_GET['do']);
//$catlist=getCatList(0,0);

$cat_list = DB::fetch_all("select * from %t where `status`='1' ORDER BY disp desc",array('news_cat'));//C::tp_t('news_cat')->where(array("status"=>1))->order("disp asc")->select();
//print_r($cat_list);
if($do=='basic'){
	include libfile('function/organization');
	if($operation=='selectuser'){
		$type=intval($_GET['type']) ? 1 : 0;
		$muids=$type?$setting['moderators']:$setting['posters'];
		
		if(submitcheck('selectsubmit')){
			$uids = array();
			foreach (explode(',', $_GET['uids']) as $v) {
				$uids[] = str_replace('uid_', '', $v);	
			}
			if($uids){
				// $muids=array_unique(array_merge($muids,$uids));//纯增加
				$muids = array_unique($uids);//修改（会删除）
				C::t('news_setting')->update($type?'moderators':'posters',implode(',',$muids));
				if(!$type) C::t('news_setting')->update('allownew',1);
				updatecache('news:setting');
			}
			$users = C::t('user')->fetch_all($muids);
			foreach ($users as $key => $value) {
				$users[$key]['avatar'] = avatar_block($value['uid']);
			}
			include template('user_select_list');
			exit();
			//exit(json_encode(array('success' => 1, 'type' => $type, 'basic' => 'basic', 'user' => $user)));
		}
	}
	elseif($operation=='deleteModerator'){
		$uid=intval($_GET['uid']);
		$type=intval($_GET['type']);
		$muids=$type?$setting['moderators']:$setting['posters'];
		foreach($muids as $key=>$value){
			if($value==$uid) unset($muids[$key]);
		}
		if(C::t('news_setting')->update($type?'moderators':'posters',implode(',',$muids))){
			updatecache('news:setting');
			
		}
		$users = C::t('user')->fetch_all($muids);
		foreach ($users as $key => $value) {
			$users[$key]['avatar'] = avatar_block($value['uid']);
		}
		include template('user_select_list');
		exit();
	}else{
		if(submitcheck('settingsubmit')){
			$setarr=$_GET['settingnew'];
			
			$setarr['allownewnews']=intval($setarr['allownewnews']);
			$setarr['newsmod']=intval($_GET['newsmod']);
			$moderators=$_GET['user_1'];
			if($moderators) $setarr['moderators']=implode(',',$moderators);
			if($setarr['allownewnews']){
				$posters=$_GET['user_0'];
				if($posters) $setarr['posters']=implode(',',$posters);
			}
			C::t('news_setting')->update_batch($setarr);
			updatecache('news:setting');
			showmessage('do_success',DZZSCRIPT.'?mod=news&op=setting',array(),array('alert'=>'right'));
		}else{
			
			$setting['allownewnews']=intval($setting['allownewnews']);
			$setting['newsmod']=intval($setting['newsmod']);
			$moderators=C::t('user')->fetch_all($setting['moderators']);
			$posters=C::t('user')->fetch_all($setting['posters']);
		}
	}
}elseif($do=='wxapp'){
	$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=news',1);
	$baseurl_info=DZZSCRIPT.'?mod=news&op=setting&do=wxapp';
	$baseurl_menu=DZZSCRIPT.'?mod=news&op=setting&do=wxapp&operation=menu';
	$baseurl_ajax=DZZSCRIPT.'?mod=news&op=setting&do=wxapp&operation=ajax';
	if(empty($operation)){
		if(submitcheck('settingsubmit')){
			$settingnew=array();
			$settingnew['agentid']=intval($_GET['agentid']);
			$settingnew['appstatus']=intval($_GET['appstatus']);
			if($appid) C::t('wx_app')->update($appid,array('agentid'=>$settingnew['agentid'],'status'=>$settingnew['appstatus']));
			C::t('news_setting')->update_batch($settingnew);
			updatecache('news:setting');
			showmessage('do_success',dreferer(),array(),array('alert'=>'right'));
		}else{
			$navtitle=lang('wechat_apply_settings');
			$navlast=lang('wx_setting');
			$settingnew=array();
			if(empty($setting['token'])) $settingnew['token']=$setting['token']=random(8);
			if(empty($setting['encodingaeskey']))  $settingnew['encodingaeskey']=$setting['encodingaeskey']=random(43);
			if($settingnew){
				C::t('news_setting')->update_batch($settingnew);
				updatecache('news:setting');
			}
			$wxapp=array('appid'=>$appid,
						 'name'=>lang('information_center'),
						 'desc'=>lang('enterprise_news_information_application'),
						 'icon'=>'dzz/news/images/0.jpg',
						 'agentid'=> $setting['agentid'],
						 'token'=>$setting['token'],
						 'encodingaeskey'=>$setting['encodingaeskey'],
						 'host'=>$_SERVER['HTTP_HOST'],
						 'callback'=>$_G['siteurl'].'index.php?mod=news&op=wxreply',
						 'otherpic'=>'dzz/news/images/c.png',
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
			$menu_select=array('click'=>array('latest'=>lang('new_news')),
								'link'=>array(
										$_G['siteurl'].DZZSCRIPT.'?mod=news&status=6'=>lang('my_released'),
										$_G['siteurl'].DZZSCRIPT.'?mod=news&status=2'=>lang('check_pending_is'),
										$_G['siteurl'].DZZSCRIPT.'?mod=news&status=3'=>lang('my_draft'),
										$_G['siteurl'].DZZSCRIPT.'?mod=news&status=4'=>lang('my_unread')
								)
						);
			 foreach(DB::fetch_all("select * from %t where pid=0 order by disp",array('news_cat')) as $value){
				$menu_select['link'][$_G['siteurl'].DZZSCRIPT.'?mod=news&catid='.$value['catid']]=$value['name'];
			}
			
			$json_menu_select=json_encode($menu_select);
			$type=trim($_GET['type']);
			$typetitle=array('click'=>lang('setup_menu'),'link'=>lang('setup_menu_href'));
			
		}elseif($_GET['action']=='menu_save'){ //菜单保存
				C::t('news_setting')->update('menu',array('button'=>$_GET['menu']));
				if($appid) C::t('wx_app')->update($appid,array('menu'=>serialize(array('button'=>$_GET['menu']))));
				updatecache('news:setting');
				exit(json_encode(array('msg'=>'success')));
		}elseif($_GET['action']=='menu_publish'){//发布到微信
				$data=array('button'=>$_GET['menu']);
				C::t('news_setting')->update('menu',$data);
				if($appid) C::t('wx_app')->update($appid,array('menu'=>serialize($data)));
				updatecache('news:setting');
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
						exit(json_encode(array('error'=>lang('tape_release_failure').',errCode:'.$wx->errCode.',errMsg:'.$wx->errMsg)));
					}
				}else{
					exit(json_encode(array('error'=>lang('tape_release_failure_agentid'))));
				}
				
		}elseif($_GET['action']=='menu_default'){//恢复默认
			$subclass=array();
		    foreach(DB::fetch_all("select * from %t where pid=0 order by disp limit 5",array('news_cat')) as $value){
				$subclass[]=array(
								 'type'=>'view',
								 'name'=>$value['name'],
								 'url'=>$_G['siteurl'].DZZSCRIPT.'?mod=news&catid='.$value['catid']
								 );
			}
			$menu_default=array('button'=>array(
												array(
													'type'=>'click',	
													'name'=>lang('new_news'),
													'key'=>'latest'
												),
												array(
													'name'=>lang('news_type'),
													'sub_button'=>$subclass
												),
												array(
													'name'=>lang('my_news'),
													'sub_button'=>array(
														array(
															'type'=>'view',	
															'name'=>lang('my_released'),
															'url'=>$_G['siteurl'].DZZSCRIPT.'?mod=news&status=6'
														),
														array(
															'type'=>'view',	
															'name'=>lang('check_pending'),
															'url'=>$_G['siteurl'].DZZSCRIPT.'?mod=news&status=2'
														),
														array(
															'type'=>'view',	
															'name'=>lang('unread_messages'),
															'url'=>$_G['siteurl'].DZZSCRIPT.'?mod=news&status=4'
														),
														array(
															'type'=>'view',	
															'name'=>lang('draft'),
															'url'=>$_G['siteurl'].DZZSCRIPT.'?mod=news&status=3'
														),
														/*array(
															'type'=>'view',	
															'name'=>'发布信息',
															'url'=>$_G['siteurl'].DZZSCRIPT.'?mod=news&op=edit'
														)*/
													)
												)
								)
						  );
			C::t('news_setting')->update('menu',$menu_default);
		    updatecache('news:setting');
			exit('success');
		}
		include template('common/wx_ajax');
		exit();
	}
}

include template('news_setting');
?>
 
