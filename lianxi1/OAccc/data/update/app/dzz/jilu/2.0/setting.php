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
require 'conf.php';
include_once libfile('function/cache');
include_once libfile('function/common');

$navtitle=lang('set').' - '.lang('record_book');
$operation=trim($_GET['operation']);
$muids=array();
//error_reporting(E_ALL);
//判断用户是否有管理员权限
$perm=getPermByUid($_G['uid']);
if($perm<2){
	@header("Location: ".MOD_URL);
	exit();
}

$do=empty($_GET['do'])?'basic':trim($_GET['do']);
if($do=='basic'){
	include libfile('function/organization');
	$navlast=lang('members_verify_base');
	if($operation=='selectuser'){
		$type=intval($_GET['type']) ? intval($_GET['type']) : 0;
		$muids=$type?$setting['moderators']:$setting['posters'];
		
		if(submitcheck('selectsubmit')){
			$uids = $_GET['uids'];
			// $muids=array_unique(array_merge($muids,$uids));//纯增加
			$muids = array_unique($uids);//修改（会删除）
			C::t('jilu_setting')->update($type?'moderators':'posters',implode(',',$muids));
			if(!$type) C::t('jilu_setting')->update('allownew',1);
			updatecache('jilu:setting');
			$users = C::t('user')->fetch_all($muids);
			foreach ($user as $key => $value) {
				$users[$key]['avatar'] = avatar_block($value['uid']);
			}
			include template('user_select_list');
			exit();
		}
	}elseif($operation=='deleteModerator'){
		$uid=intval($_GET['uid']);
		$type=intval($_GET['type']);
		$muids=$type?$setting['moderators']:$setting['posters'];
		foreach($muids as $key=>$value){
			if($value==$uid) unset($muids[$key]);
		}
		if(C::t('jilu_setting')->update($type?'moderators':'posters',implode(',',$muids))){
			updatecache('jilu:setting');
			exit(json_encode(array('msg'=>'success')));
		}else{
			exit(json_encode(array('msg'=>'removed')));
		}
	}elseif($operation=='getavatar'){
		$uids = is_array($_GET['uids']) ? $_GET['uids'] : array($_GET['uids']);
		$avatar = array();
		foreach ($uids as $key => $value) {
			$avatar[$value] = avatar_block($value);
		}
		exit(json_encode($avatar));
	}else{
		if(submitcheck('settingsubmit')){
			$setarr=$_GET['settingnew'];
			
			$setarr['allownew']=intval($setarr['allownew']);
			$moderators=$_GET['moderators'];
			if($moderators) $setarr['moderators']=implode(',',$moderators);
			if($setarr['allownew']){
				$posters=$_GET['posters'];
				if($posters) $setarr['posters']=implode(',',$posters);
			}
			C::t('jilu_setting')->update_batch($setarr);
			updatecache('jilu:setting');
			showmessage('do_success',MOD_URL.'&op=setting',array(),array('alert'=>'right'));
		}else{
			
			$setting['allownew']=intval($setting['allownew']);
			$moderators=C::t('user')->fetch_all($setting['moderators']);
			$posters=C::t('user')->fetch_all($setting['posters']);
			
		}
	}
}elseif($do=='wxmp'){
	if(!$setting['agentid']) $setting['agentid']=999;
	$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=jilu',1);
	$baseurl_info=MOD_URL.'&op=setting&do=wxmp';
	$base_info_title=lang('wechat_sub_bind');
	$baseurl_menu=MOD_URL.'&op=setting&do=wxmp&operation=menu';
	$base_menu_title=lang('wechat_sub_menu');
	$baseurl_ajax=MOD_URL.'&op=setting&do=wxmp&operation=ajax';
	if(empty($operation)){
		if(submitcheck('settingsubmit')){
			$settingnew=array();
			$settingnew[$host]['AppID']=trim($_GET['AppID']);
			$settingnew[$host]['AppSecret']=trim($_GET['AppSecret']);
			switch($_GET['fbind']){
				case 'bind':
					$wechat=new Wechat(array('appid'=>$settingnew[$host]['AppID'],'appsecret'=>$settingnew[$host]['AppSecret']));
					if(!$wechat->checkAuth()){
						showmessage(lang('validation_failure').',errCode：'.$wechat->errCode.'; errMsg:'.$wechat->errMsg,dreferer());
					}
					if(empty($setting['token_mp'])) $settingnew[$host]['token']=random(8);
					if(empty($setting['encodingaeskey_mp'])) $settingnew[$host]['encodingaeskey']=random(43);
					break;
				case 'unbind':
					$settingnew[$host]['CorpID']='';
					$settingnew[$host]['CorpSecret']='';
					break;
			}
			
			C::t('jilu_setting')->update_batch($settingnew);
			updatecache('jilu:setting');
			showmessage('do_success',dreferer(),array(),array('alert'=>'right'));
		}else{
			$navtitle=lang('wechat_sub_bind');
			$navlast=lang('wechat_sub_bind');
			$settingnew=array();
			if(empty($setting['token_mp'])) $settingnew[$host]['token_mp']=$setting['token_mp']=random(8);
			if(empty($setting['encodingaeskey_mp']))  $settingnew[$host]['encodingaeskey_mp']=$setting['encodingaeskey_mp']=random(43);
			if($settingnew){
				C::t('jilu_setting')->update_batch($settingnew);
				updatecache('jilu:setting');
			}
			$wxmp=array('appid'=>$appid,
						 
						 'token'=>$setting['token_mp'],
						 'encodingaeskey'=>$setting['encodingaeskey_mp'],
						 'host'=>$_SERVER['HTTP_HOST'],
						 'callback'=>$_G['siteurl'].MOD_URL.'&op=mpreply',
						
					);
			
		}
	}elseif($operation=='menu'){
		$menu=$setting['menu_mp']?unserialize($setting['menu_mp']):'';
	}elseif($operation=='ajax'){	
		if($_GET['action']=='setEventkey'){
			//支持的菜单事件
			$menu_select=array(
								'link'=>array(
										$_G['siteurl'].MOD_URL.'&op=item'=>lang('my'),APP_NAME,
										$_G['siteurl'].MOD_URL=>APP_LIST_NAME,//'记录列表',
										$_G['siteurl'].MOD_URL.'&op=publish&type=image'=>lang('publish_image'),
										$_G['siteurl'].MOD_URL.'&op=publish&type=attach'=>lang('publish_attach'),
										$_G['siteurl'].MOD_URL.'&op=publish&type=link'=>lang('publish_link'),
										$_G['siteurl'].MOD_URL.'&op=publish&type=list'=>lang('publish_list'),
								)
						);
			
			
			$json_menu_select=json_encode($menu_select);
			$type=trim($_GET['type']);
			$typetitle=array('click'=>lang('set_menu_key'),'link'=>lang('set_menu_link'));
			
		}elseif($_GET['action']=='menu_save'){ //菜单保存
				C::t('jilu_setting')->update('menu_mp_'.$host,array('button'=>$_GET['menu']));
				//if($appid) C::t('wx_app')->update($appid,array('menu'=>serialize(array('button'=>$_GET['menu']))));
				updatecache('jilu:setting');
				exit(json_encode(array('msg'=>'success')));
		}elseif($_GET['action']=='menu_publish'){//发布到微信
				$data=array('button'=>$_GET['menu']);
				C::t('jilu_setting')->update('menu_mp_'.$host,$data);
				//if($appid) C::t('wx_app')->update($appid,array('menu'=>serialize($data)));
				updatecache('jilu:setting');
				//发布菜单到微信
				if($setting[$host]['AppID'] && $setting[$host]['AppSecret']){
					$wx=new Wechat(array('appid'=>$setting[$host]['AppID'],'appsecret'=>$setting[$host]['AppSecret']));
					//处理菜单数据，所有本站链接添加oauth2地址
					foreach($data['button'] as $key=>$value){
						if($value['url'] && strpos($value['url'],$_G['siteurl'])===0){
							$data['button'][$key]['url']=$wx->getOauthRedirect(getglobal('siteurl').MOD_URL.'&op=mpredirect&url='.dzzencode($value['url']),'mp','snsapi_base');
						}elseif($value['sub_button']){
							foreach($value['sub_button'] as $key1=>$value1){
								if($value1['url'] && strpos($value1['url'],$_G['siteurl'])===0){
									$data['button'][$key]['sub_button'][$key1]['url']=$wx->getOauthRedirect(getglobal('siteurl').MOD_URL.'&op=mpredirect&url='.dzzencode($value1['url']),'mp','snsapi_base');
								}
							}
						}
					}
					if($wx->createMenu($data)){
						exit(json_encode(array('msg'=>'success')));
					}else{
						exit(json_encode(array('error'=>lang('publish_failed').',errCode:'.$wx->errCode.',errMsg:'.$wx->errMsg)));
					}
				}else{
					exit(json_encode(array('error'=>lang('publish_failed_not_bind'))));
				}
				
		}elseif($_GET['action']=='menu_default'){//恢复默认
			$subclass=array();
			$menu_default=array('button'=>array(
												
												array(
													'type'=>'view',	
													'name'=>lang('my').APP_NAME,
													'url'=>$_G['siteurl'].MOD_URL.'&op=item'
												),
												array(
													'type'=>'view',	
													'name'=>APP_LIST_NAME,
													'url'=>$_G['siteurl'].MOD_URL
												),
												array(
													'name'=>lang('quick_publish'),
													'sub_button'=>array(
														
														array(
															'type'=>'view',	
															'name'=>lang('publish_link'),
															'url'=>$_G['siteurl'].MOD_URL.'&op=publish&type=link'
														),
														array(
															'type'=>'view',	
															'name'=>lang('publish_attach'),
															'url'=>$_G['siteurl'].MOD_URL.'&op=publish&type=attach'
														),
														
														array(
															'type'=>'view',	
															'name'=>lang('publish_list'),
															'url'=>$_G['siteurl'].MOD_URL.'&op=publish&type=list'
														),
														array(
															'type'=>'view',	
															'name'=>lang('publish_image'),
															'url'=>$_G['siteurl'].MOD_URL.'&op=publish&type=image'
														)
													)
												),
												/*array(
													'type'=>'view',	
													'name'=>'绑定账号',
													'url'=>$_G['siteurl'].MOD_URL.'&op=bind'
												),*/
												
								)
						  );
			C::t('jilu_setting')->update('menu_mp_'.$host,$menu_default);
		    updatecache('jilu:setting');
			exit('success');
		}
		include template('common/wx_ajax');
		exit();
	}
}elseif($do=='wxapp'){
	$appid=C::t('app_market')->fetch_appid_by_mod('{dzzscript}?mod=jilu',1);
	$baseurl_info=MOD_URL.'&op=setting&do=wxapp';
	$baseurl_menu=MOD_URL.'&op=setting&do=wxapp&operation=menu';
	$baseurl_ajax=MOD_URL.'&op=setting&do=wxapp&operation=ajax';
	if(empty($operation)){
		if(submitcheck('settingsubmit')){
			$settingnew=array();
			$settingnew['agentid']=intval($_GET['agentid']);
			$settingnew['appstatus']=intval($_GET['appstatus']);
			if($appid) C::t('wx_app')->update($appid,array('agentid'=>$settingnew['agentid'],'status'=>$settingnew['appstatus']));
			C::t('jilu_setting')->update_batch($settingnew);
			updatecache('jilu:setting');
			showmessage('do_success',dreferer(),array(),array('alert'=>'right'));
		}else{
			$navtitle=lang('app_set');
			$navlast=lang('wechat_set');
			$settingnew=array();
			if(empty($setting['token'])) $settingnew['token']=$setting['token']=random(8);
			if(empty($setting['encodingaeskey']))  $settingnew['encodingaeskey']=$setting['encodingaeskey']=random(43);
			if($settingnew){
				C::t('jilu_setting')->update_batch($settingnew);
				updatecache('jilu:setting');
			}
			$wxapp=array('appid'=>$appid,
						 'name'=>APP_NAME,
						 'desc'=>lang('jilu_desc'),
						 'icon'=>MOD_PATH.'/images/0.png',
						 'agentid'=> $setting['agentid'],
						 'token'=>$setting['token'],
						 'encodingaeskey'=>$setting['encodingaeskey'],
						 'host'=>$_SERVER['HTTP_HOST'],
						 'callback'=>$_G['siteurl'].MOD_URL.'&op=wxreply',
						 'otherpic'=>MOD_PATH.'/images/c.png',
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
			$menu_select=array(
								'link'=>array(
										$_G['siteurl'].MOD_URL.'&op=item'=>lang('my').APP_NAME,
										$_G['siteurl'].MOD_URL=>APP_LIST_NAME,
										$_G['siteurl'].MOD_URL.'&op=publish&type=image'=>lang('publish_image'),
										$_G['siteurl'].MOD_URL.'&op=publish&type=attach'=>lang('publish_attach'),
										$_G['siteurl'].MOD_URL.'&op=publish&type=link'=>lang('publish_link'),
										$_G['siteurl'].MOD_URL.'&op=publish&type=list'=>lang('publish_list')
								)
						);
			
			
			$json_menu_select=json_encode($menu_select);
			$type=trim($_GET['type']);
			$typetitle=array('click'=>lang('set_menu_key'),'link'=>lang('set_menu_link'));
			
		}elseif($_GET['action']=='menu_save'){ //菜单保存
				C::t('jilu_setting')->update('menu',array('button'=>$_GET['menu']));
				if($appid) C::t('wx_app')->update($appid,array('menu'=>serialize(array('button'=>$_GET['menu']))));
				updatecache('jilu:setting');
				exit(json_encode(array('msg'=>'success')));
		}elseif($_GET['action']=='menu_publish'){//发布到微信
				$data=array('button'=>$_GET['menu']);
				C::t('jilu_setting')->update('menu',$data);
				if($appid) C::t('wx_app')->update($appid,array('menu'=>serialize($data)));
				updatecache('jilu:setting');
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
						exit(json_encode(array('error'=>lang('publish_failed').',errCode:'.$wx->errCode.',errMsg:'.$wx->errMsg)));
					}
				}else{
					exit(json_encode(array('error'=>lang('publish_failed_no_wxagentid'))));
				}
				
		}elseif($_GET['action']=='menu_default'){//恢复默认
			$subclass=array();
		   
			$menu_default=array('button'=>array(
												array(
													'type'=>'view',	
													'name'=>lang('my').APP_NAME,
													'url'=>$_G['siteurl'].MOD_URL.'&op=item'
												),
												array(
													'type'=>'view',	
													'name'=>APP_LIST_NAME,
													'url'=>$_G['siteurl'].MOD_URL
												),
												array(
													'name'=>lang('quick_publish'),
													'sub_button'=>array(
														
														array(
															'type'=>'view',	
															'name'=>lang('publish_link'),
															'url'=>$_G['siteurl'].MOD_URL.'&op=publish&type=link'
														),
														array(
															'type'=>'view',	
															'name'=>lang('publish_attach'),
															'url'=>$_G['siteurl'].MOD_URL.'&op=publish&type=attach'
														),
														
														array(
															'type'=>'view',	
															'name'=>lang('publish_list'),
															'url'=>$_G['siteurl'].MOD_URL.'&op=publish&type=list'
														),
														array(
															'type'=>'view',	
															'name'=>lang('publish_image'),
															'url'=>$_G['siteurl'].MOD_URL.'&op=publish&type=image'
														)
													)
												)
												
								)
						  );
			C::t('jilu_setting')->update('menu',$menu_default);
		    updatecache('jilu:setting');
			exit('success');
		}
		include template('common/wx_ajax');
		exit();
	}
}elseif($do=='jilu'){
		$navlast=APP_NAME.lang('management');
	if(!submitcheck('jilusubmit')){
		//分页
		$keyword=trim($_GET['keyword']);
		$order=in_array($_GET['order'],array('updatetime','dateline','archivetime'))?$_GET['order']:'updatetime';
		$authorid=intval($_GET['authorid']);
		$page = empty($_GET['page'])?1:intval($_GET['page']);
		$perpage=20;
		$gets = array(
				'mod'=>MOD_NAME,
				'op'=>'setting',
				'do'=>'jilu',
				'keyword'=>$keyword,
				'order'=>$order,
				'authorid'=>$authorid,
				'inarchive'=>intval($_GET['inarchive'])
			);
		$theurl = DZZSCRIPT."?".url_implode($gets);
		$start=($page-1)*$perpage;
		$param=array('jilu');
		$orderby=" order by j.$order DESC ,j.dateline DESC";
		if($count=DB::result_first("select COUNT(*) from %t",$param)){
			$param[] = 'jilu_pin';
			$list=DB::fetch_all("select j.*,p.type,p.pin_type from %t j left join %t p on j.jid = p.data_id and p.pin_type = 2 $orderby limit $start,$perpage",$param);
			$multi=multi($count, $perpage, $page, $theurl,'pull-right'); 
		}
	}else{
		$dels=$_GET['del'];
		foreach ($dels as $jid) {
			$jilu = C::t('jilu')->fetch($jid);
			if ($jilu['inarchive']) {
					exit(json_encode(array('code' => 400, 'info' => lang('archived_need_active_to_delete'))));
			}
		}
		if($dels){
			foreach($dels as $jid){
				C::t('jilu')->delete_by_jid($jid);//彻底删除
				C::t('jilu_pin')->deletePin(1, $jid);
				// DB::update('jilu', array('deleteuid' => $_G['uid'], 'deletetime' => TIMESTAMP), array('jid' => $jid));//进入回收站
			}
		} else {
			exit(json_encode(array('code' => 400, 'info' => lang('please_select_item'))));
		}
		exit(json_encode(array('code' => 200, 'info' => lang('delete_success'))));
	}
		
}

include template('setting');
?>
 
