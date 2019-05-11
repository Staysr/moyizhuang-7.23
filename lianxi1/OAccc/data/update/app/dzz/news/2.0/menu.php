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
require_once libfile('function/news');

$do=trim($_GET['do']);

if($do=='newsmenu'){
	$step=intval($_GET['step']);

	
	if(!$step){
		$status=empty($_GET['status'])?1:intval($_GET['status']);
	}elseif($step==1 ){	//移动
	    if(submitcheck('catmovesubmit')){
			$perm=getPermByUid($_G['uid']);
			if($perm<2) showmessage(lang('have_no_right'),dreferer(),array(),array('showmsg'=>true));
			$catid=intval($_GET['catid']);
			$newids=!empty($_GET['newid'])?explode(',',$_GET['newid']):array();
			if($catid) DB::update('news',array('catid'=>$catid),"newid IN (".dimplode($newids).")");
			showmessage('do_success',dreferer(),array(),array('showmsg'=>true));
		}else{
			$catoptions=getCatOptions();
		}
	}elseif($step==2){//置顶
		if(submitcheck('istopsubmit')){
			$perm=getPermByUid($_G['uid']);
			if($perm<2) showmessage(lang('have_no_right'),dreferer(),array(),array('showmsg'=>true));
			$topendtime=strtotime($_GET['topendtime']);
			$today=strtotime(dgmdate(TIMESTAMP,'Y-m-d'));
			if($topendtime<$today) $istop=0;
			else $istop=1;
			$newids=!empty($_GET['newid'])?explode(',',$_GET['newid']):array();
			if($newids) DB::update('news',array('istop'=>$istop,'topendtime'=>$topendtime),"newid IN (".dimplode($newids).")");
			showmessage('do_success',dreferer(),array(),array('showmsg'=>true));
		}else{
			$now=dgmdate(TIMESTAMP,'Y-m-d');
		}
	}elseif($step==3){
		if(submitcheck('highlightsubmit')){
			$perm=getPermByUid($_G['uid']);
			if($perm<2) showmessage(lang('have_no_right'),dreferer(),array(),array('showmsg'=>true));
			$highlightendtime=strtotime($_GET['highlightendtime']);
			$today=strtotime(dgmdate(TIMESTAMP,'Y-m-d'));
			if($highlightendtime<$today) $ishighlight=0;
			else $ishighlight=1;
			$highlightstyle='';
			if($_GET['highlight_color']) $highlightstyle.='color:'.trim($_GET['highlight_color']).';';
			if($_GET['highlight_bold']) $highlightstyle.='font-weight:700;';
			if($_GET['highlight_italic']) $highlightstyle.='font-style:italic;';
			if($_GET['highlight_underline']) $highlightstyle.='text-decoration:underline;';
			if(empty($highlightstyle)) $ishighlight=0;
			$newids=!empty($_GET['newid'])?explode(',',$_GET['newid']):array();
			if($newids) DB::update('news',array('ishighlight'=>$ishighlight,'highlightendtime'=>$highlightendtime,'highlightstyle'=>$highlightstyle),"newid IN (".dimplode($newids).")");
			showmessage('do_success',dreferer(),array(),array('showmsg'=>true));
		}else{
			$now=dgmdate(TIMESTAMP,'Y-m-d');
		}
	}elseif($step==4){//删除
		if(submitcheck('deletesubmit')){
			$perm=getPermByUid($_G['uid']);
			if($perm<2) showmessage(lang('have_no_right'),dreferer(),array(),array('showmsg'=>true));
			
			$newids=!empty($_GET['newid'])?explode(',',$_GET['newid']):array();
			
			if($newids) C::t('news')->batch_delete_by_newid($newids);
			showmessage('do_success',dreferer(),array(),array('showmsg'=>true));
		}else{
			$now=dgmdate(TIMESTAMP,'Y-m-d');
		}
	}elseif($step==5){//审核
		if(submitcheck('modsubmit')){
			$perm=getPermByUid($_G['uid']);
			if($perm<2) showmessage(lang('have_no_right'),dreferer(),array(),array('showmsg'=>true));
			$modreason=trim($_GET['modreason']);
			$pass=intval($_GET['pass']);
			$newids=!empty($_GET['newid'])?explode(',',$_GET['newid']):array();
			if($newids) C::t('news')->mod_by_newid($newids,$pass,$modreason);
			showmessage('do_success',dreferer(),array(),array('showmsg'=>true));
		}else{
			
		}
	}
}elseif($do=='catmenu'){
	$catid=intval($_GET['catid']);
	$step=intval($_GET['step']);
	if(!$step){ //主菜单
		
	
	}elseif($step==1 || $step==2){//编辑
		if(submitcheck('cateditsubmit')){
			$perm=getPermByUid($_G['uid']);
			if($perm<2) showmessage(lang('have_no_right'),dreferer(),array(),array('showmsg'=>true));
			$ncatid=intval($_GET['ncatid']);
			$pid=intval($_GET['pid']);
			$name=getstr(trim($_GET['name']),60);
			if($ncatid){
				C::t('news_cat')->update_by_catid($ncatid,array('name'=>$name,'pid'=>$pid));
				showmessage('do_success',dreferer(),array('data'=>rawurlencode(json_encode(array('catid'=>$ncatid,'pid'=>$pid,'name'=>$name)))),array('showmsg'=>true));
			}else {
				if($ncatid=C::t('news_cat')->insert_by_catid(array('name'=>$name,'pid'=>$pid))){
					showmessage('do_success',dreferer(),array('data'=>rawurlencode(json_encode(array('catid'=>$ncatid,'pid'=>$pid,'name'=>$name)))),array('showmsg'=>true));
				}else{
					showmessage(lang('type_add_failure'),dreferer(),array(),array('showmsg'=>true));
				}
			}
			
		}else{
			$catoptions=getCatOptions(0,$catid);
			if($step==2){
				$cat=C::t('news_cat')->fetch($catid);
				$catoptions=getCatOptions(0,$cat['pid'],$cat['catid']);
			}else{
				$cat=array('catid'=>0);
				$catoptions=getCatOptions(0,$catid);
			}
		}
	
	}elseif($step==4){//删除
		if(submitcheck('catdeletesubmit')){
			$perm=getPermByUid($_G['uid']);
			if($perm<2) showmessage(lang('have_no_right'),dreferer(),array(),array('showmsg'=>true));
			if(C::t('news_cat')->delete_by_catid($catid)){
			   showmessage('do_success',dreferer(),array('catid'=>$catid),array('showmsg'=>true));
			}else{
				showmessage(lang('delete_failure'),dreferer(),array(),array('showmsg'=>true));
			}
		}else{
			$cat=C::t('news_cat')->fetch($catid);
		}
	}
}elseif($do=='catmove'){
	$catid=intval($_GET['catid']);
	$up=intval($_GET['up']);
	$perm=getPermByUid($_G['uid']);
	if($perm<2) exit(json_encode(array('error'=>lang('have_no_right'))));
	C::t('news_cat')->catmove_by_catid($catid,$up);
	exit(json_encode(array('msg'=>'success','catid'=>$catid,'up'=>$up)));
}
include template('news_menu');




?>
