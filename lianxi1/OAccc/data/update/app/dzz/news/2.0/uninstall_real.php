<?php
/* @authorcode  codestrings
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */

if(!defined('IN_DZZ') || !defined('IN_ADMIN')) {
	exit('Access Denied');
}
@set_time_limit(0);
//卸载程序；


//删除所有新闻附件
try{
	foreach(DB::fetch_all("select newid,attachs from %t where 1",array('news')) as $value){
		if($value['attachs']){
			 $attachs=explode(',',$value['attachs']);
			 foreach($attachs as $aid){
				 C::t('attachment')->delete_by_aid($aid);
			 }
		}
	}
	foreach(DB::fetch_all("select aid from %t where 1",array('news_pic')) as $value){
		C::t('attachment')->delete_by_aid($value['aid']);
	}
}catch(Exception $e){}
	//删除所有投票
	$voteids=array();
	foreach(DB::fetch_all("select voteid from %t where  idtype='news'",array('vote',$idtype)) as $value){
		$voteids[]=$value['voteid'];
	}
	if($voteids) C::t('vote')->delete_by_voteid($voteids);
	
	//删除所有评论
    $dels=array();
	foreach(DB::fetch_all("select cid from %t where  idtype='news'",array('comment')) as $value){
		$dels[]=$value['cid'];
	}
	C::t('comment')->delete($dels);
	
	C::t('comment_at')->delete_by_cid($dels); //删除@
	
	C::t('comment_attach')->delete_by_cid($dels);//删除附件
		
$sql = <<<EOF

DROP TABLE IF EXISTS `dzz_news`;
DROP TABLE IF EXISTS `dzz_news_cat`;
DROP TABLE IF EXISTS `dzz_news_setting`;
DROP TABLE IF EXISTS `dzz_news_pic`;
DROP TABLE IF EXISTS `dzz_news_viewer`;

EOF;
try{
runquery($sql);
}catch(Exception $e){}

$finish = true;
