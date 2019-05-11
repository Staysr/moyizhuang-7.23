<?php
/*
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */

if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
class table_jilu_attach extends dzz_table
{
	public function __construct() {
		$this->_table = 'jilu_attach';
		$this->_pk    = 'qid';
		$this->_pre_cache_key = 'jilu_attach_';
		$this->_cache_ttl = 0;
		parent::__construct();
	}
	public function fetch_by_qid($qid){
		global $_G;
		if(!$data=self::fetch($qid)) return false;
		if($data['aid']>0){
			$attach=C::t('attachment')->fetch($data['aid']);
			if(in_array(strtolower($attach['filetype']),array('png','jpeg','jpg','gif'))){
				$attach['img']=C::t('attachment')->getThumbByAid($attach,120,80);
				$attach['isimage']=1;
				$attach['type']='image';
				$attach['url']=C::t('attachment')->getThumbByAid($attach,120,80,1);
			}else{
				$attach['img']=geticonfromext($attach['filetype'],'');
				$attach['isimage']=0;
				$attach['url']=IO::getFileUri('attach::'.$attach['aid']);
			}
			
			$attach['filename']=$data['title'];
			$data = array_merge($data,$attach);
		}
		return $data;
	}

	public function fetch_all_by_rid($rid){
		global $_G;
		include_once libfile('function/code');
		$data=array();
		if(DB::result_first('select count(*) from %t where rid = %d', array('jilu_item',$rid))){
			//$openext=C::t('app_open')->fetch_all_orderby_ext($_G['uid']);
			foreach(DB::fetch_all("select * from %t where rid= %d",array($this->_table,$rid)) as $value){
				if($value['aid']){
					$attach=C::t('attachment')->fetch($value['aid']);
					if(in_array(strtolower($attach['filetype']),array('png','jpeg','jpg','gif','bmp'))){
						$attach['ico_img']=C::t('attachment')->getThumbByAid($attach, 100, 100);
						$attach['img']=C::t('attachment')->getThumbByAid($attach, 680, 420);
						$attach['big_img']=C::t('attachment')->getThumbByAid($attach,1440,900);
						$path = dzzencode('attach::'.$value['aid']);
						$attach['down_url']=(defined('DZZSCRIPT')?DZZSCRIPT:'index.php').'?mod=io&op=download&path='.$path;
						$attach['isimage']=1;
					}else{
						$attach['img']=geticonfromext($attach['filetype'],'');
						$attach['isimage']=0;
					}
					$attach['url']=IO::getFileUri('attach::'.$attach['aid']);//C::t('attachment')->getThumbByAid($attach,120,80,1);
					$attach['preview']=1;
					$attach['filesize']=formatsize($attach['filesize']);
					$data[$value['qid']]=array_merge($value,$attach);
				}else{
					$value['preview']=1;
					$data[$value['qid']]=$value;
				}
			}
			return $data;
		}
	}
	  public function update_by_rid($rid,$attach,$ismp=0){
		global $setting;
		$ret=0;
		$qids=array();
		foreach(DB::fetch_all("select qid from %t where rid=%d",array($this->_table,$rid)) as $value){
			$qids['qid_'.$value['qid']]=$value['qid'];
		}
		
		if($setting['AppID'] && $setting['AppSecret']){
			$wx=new Wechat(array('appid'=>$setting['AppID'],'appsecret'=>$setting['AppSecret']));
		}elseif(getglobal('setting/CorpID') && getglobal('setting/CorpSecret')){
			$wx=new qyWechat(array('appid'=>getglobal('setting/CorpID'),'appsecret'=>getglobal('setting/CorpSecret')));
		}
		foreach($attach['title'] as $key=> $value){
			$qid=intval($attach['qid'][$key]);
			if($qid>0){
				unset($qids['qid_'.$qid]);
				if($attach['type'][$key] == 'link') DB::update('jilu_attach', array('title' => $value), array('qid' => $qid));
			}else{
				if($attach['mediaid'][$key]){
					if($return=self::getAidByMediaId($attach['mediaid'][$key],$wx)){
						
						$setarr=array('rid'=>$rid,
									  'dateline'=>TIMESTAMP,
									  'aid'=>intval($return['aid']),
									  'title'=>$return['filename'],
									  'type'=>'image',
									  'img'=>'',
									  'url'=>'',
									  'ext'=>$return['filetype']
									  );
					}else{
						 continue;
					}
				}else{
					$setarr=array('rid'=>$rid,
							  'dateline'=>TIMESTAMP,
							  'aid'=>intval($attach['aid'][$key]),
							  'title'=>trim($value),
							  'type'=>trim($attach['type'][$key]),
							  'img'=>trim($attach['img'][$key]),
							  'url'=>trim($attach['url'][$key]),
							  'ext'=>trim($attach['ext'][$key])
							  );
				}
				if(!preg_match("/^(http|ftp|https|mms)\:\/\/.{5,300}$/i", (trim($attach['link'][$key])))){
					$link='http://'.preg_replace("/^(http|ftp|https|mms)\:\/\//i",'',trim($attach['link'][$key]));
				} else {
					$link = trim($attach['link'][$key]) ? trim($attach['link'][$key]) : '';
				}
				$cid = DB::result_first('select cid from %t where ourl = %s', array('collect', $link));
				if($cid){
					C::t('collect')->addcopy_by_cid($cid);
			 		$setarr['cid'] = $cid; 
				}
				if($ret+=parent::insert($setarr)){
					if($setarr['aid']) C::t('attachment')->addcopy_by_aid($setarr['aid']);
					if($setarr['type']=='link'){
						 $imgarr=$setarr['img']?explode('icon',$setarr['img']):array();
						 if(isset($imgarr[1]) && ($did=DB::result_first("select did from %t where pic=%s",array('icon','icon'.$imgarr[1])))) C::t('icon')->update_copys_by_did($did);
					}
				}
			}
		}
		if($qids) $ret+=self::delete_by_qid($qids);
		return $ret;
	}
	public function getAidByMediaId($mediaid,$wx,$ext='png'){
		/*if($type=='image') $ext='png';
		elseif($type=='video') $ext='mp4';
		elseif($type=='voice') $ext='amr';*/
		$subdir = $subdir1 = $subdir2 = '';
		$subdir1 = date('Ym');
		$subdir2 = date('d');
		$subdir = $subdir1.'/'.$subdir2.'/';
		$target='dzz/'.$subdir.''.date('His').''.strtolower(random(16)).'.'.$ext;
		$target1=getglobal('setting/attachurl').$target;
		$targetpath = dirname($target1);
		dmkdir($targetpath);
		
		if($data=$wx->getMedia($mediaid)){
			file_put_contents($target1,$data);
		}else{
			return false;
		}
		$file_path=$_G['setting']['attachdir'].$target;
		$md5=md5_file($file_path);
		$filesize=filesize($file_path);
		if($md5 && ($attach=DB::fetch_first("select * from %t where md5=%s and filesize=%d",array('attachment',$md5,$filesize)))){
			@unlink($file_path);
			return $attach;
		}else{
			$unrun=0;
			$remote=0;
			$attach=array(
				'filesize'=>$filesize,
				'attachment'=>$target,
				'filetype'=>strtolower($ext),
				'filename' =>'wx',
				'remote'=>$remote,
				'copys' => 0,
				'md5'=>$md5,
				'unrun'=>$unrun,
				'dateline' => $_G['timestamp'],
			);
			
			if($attach['aid']=C::t('attachment')->insert($attach,1)){
				C::t('local_storage')->update_usesize_by_remoteid($attach['remote'],$attach['filesize']);
				dfsockopen($_G['siteurl'].'misc.php?mod=movetospace&aid='.$attach['aid'].'&remoteid=0',0, '', '', FALSE, '',1);
				return $attach;
			}else{
				return false;
			}
		}
		return false;
	}
	public function delete_by_qid($qids){
		$qids=(array)$qids;
		$ret=0;
		foreach(DB::fetch_all("select qid,aid,type,img from %t where qid IN(%n)",array($this->_table,$qids)) as $value){
		  if(parent::delete($value['qid'])){
			  $ret+=1;
			  if($value['aid']>0)  C::t('attachment')->delete_by_aid($value['aid']);
			   if($value['type']=='link'){
				   $imgarr=$value['img']?explode('icon',$value['img']):array();
				   if(isset($imgarr[1]) && ($did=DB::result_first("select did from %t where pic=%s",array('icon','icon'.$imgarr[1])))) C::t('icon')->update_copys_by_did($did,-1);
			  }
		  }
	   }
	   return $ret;
	}
	public function delete_by_rid($rids){
		$rids=(array)$rids;
		$ret=0;
		foreach(DB::fetch_all("select qid,aid,type,img,url,cid from %t where rid IN(%n)",array($this->_table,$rids)) as $value){
		  if(parent::delete($value['qid'])){
			  $ret+=1;
			  if($value['aid']>0)  C::t('attachment')->delete_by_aid($value['aid']);
			   if($value['type']=='link'){
				   $imgarr=$value['img']?explode('icon',$value['img']):array();
				   if(isset($imgarr[1]) && ($did=DB::result_first("select did from %t where pic=%s",array('icon','icon'.$imgarr[1])))) C::t('icon')->update_copys_by_did($did,-1);
			  }
			  //网址收藏ID(采集)
			   if($value['cid']) C::t('collect')->delete_by_cid($value['cid']);
		  }
	   }
	   return $ret;
	}
}
?>
