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
@ini_set('memory_limit','2048M');
@set_time_limit(0);

$_G['config']['system_charset']=getClientEncode();
//压缩处理目录
if(!defined('TMPPRE')) define('TMPPRE','tmp_zip');
if (!defined('ZIP_CACHE_FOLDER_PRE')) {
	$tmpdir=sys_get_temp_dir().DIRECTORY_SEPARATOR.TMPPRE;
	if(!is_dir($tmpdir)) dmkdir($tmpdir,0777,false);
    define('ZIP_CACHE_FOLDER_PRE',$tmpdir);
}
require_once DZZ_ROOT.'./dzz/class/class_encode.php';
function getClientEncode(){//获取浏览器编码；
	 $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4); //只取前4位，这样只判断最优先的语言。如果取前5位，可能出现en,zh的情况，影响判断。  
    if (preg_match("/zh-t/i", $lang))  
   		return 'BIG-5';//echo "简体中文";  
    else if (preg_match("/zh-h/i", $lang))  
   		return 'BIG-5';// echo "繁體中文";
	else if (preg_match("/zh/i", $lang))  
   		return 'GBK';// echo "繁體中文";    
    else 
    	return 'UTF-8';//echo "German";  
}
function command($zip,$un=true){//$un==true 表示解压，反之压缩
	/*
	escapeshellarg 
	压缩
		tar -cvf jpg.tar *.jpg //将目录里所有jpg文件打包成tar.jpg 
		tar -czf jpg.tar.gz *.jpg   //将目录里所有jpg文件打包成jpg.tar后，并且将其用gzip压缩，生成一个gzip压缩过的包，命名为jpg.tar.gz
		 tar -cjf jpg.tar.bz2 *.jpg //将目录里所有jpg文件打包成jpg.tar后，并且将其用bzip2压缩，生成一个bzip2压缩过的包，命名为jpg.tar.bz2
		tar -cZf jpg.tar.Z *.jpg   //将目录里所有jpg文件打包成jpg.tar后，并且将其用compress压缩，生成一个umcompress压缩过的包，命名为jpg.tar.Z
		rar a jpg.rar *.jpg //rar格式的压缩，需要先下载rar for linux
		zip jpg.zip *.jpg //zip格式的压缩，需要先下载zip for linux
	解压
		tar -xvf file.tar //解压 tar包
		tar -xzvf file.tar.gz //解压tar.gz
		tar -xjvf file.tar.bz2   //解压 tar.bz2
		tar -xZvf file.tar.Z   //解压tar.Z
		unrar e file.rar //解压rar
		unzip file.zip //解压zip
	
	*/
	//zip:  unzip -o file1.zip -d /home/zip
	
}
function zip_extract($zip,$folder){
	
	
	$archive = new PclZip($zip);
	$tmpfolder=ZIP_CACHE_FOLDER_PRE.DIRECTORY_SEPARATOR.$folder;
	
	if(is_dir($tempfolder)){
		removedir($tmpfolder,true);
	}else{
		dmkdir($tmpfolder,0777,false);
	}
	$properties=$archive->properties();
	$comment=$properties['comment'];
	$p=new Encode_Core();
	if(!$charset=$p->get_encoding($comment)) $charset=getglobal('config/system_charset');
	if($comment) $comment=diconv($comment,$charset,CHARSET);
	if ($archive->extract(PCLZIP_OPT_PATH, $tmpfolder)) {
		@unlink($zip);
		return array('folder'=>$folder,'comment'=>$comment);
	}else{
		@unlink($zip);
		return array('error'=>$archive->errorInfo(true));
	}
	
}
/*
 *临时目录文件上传到桌面系统
 *array $list:所选文件列表
 *$path:解压目标目录
 *$root:解压此压缩包的所有
*/
function zip_extractTo($list,$path,$folder){//解压到
	$return=array();
	if($folder){
		$tmpfolder=ZIP_CACHE_FOLDER_PRE.DIRECTORY_SEPARATOR.$folder;
		$handle = opendir($tmpfolder);
		while(($file = readdir($handle)) !== FALSE) {
			if($file != '.' && $file != '..') {
				if($ret=uploadTodesktop($folder.'/'.$file,$path)){
					if($ret['icoid']) $return[]=array('icoarr'=>$ret);
					elseif($ret['type']=='folder'){
						$return[]=$ret['data'];
					}
				}
			}
		}
		closedir($handle);
	}elseif($list){
		foreach($list as $key => $file){
			if(!$file=dzzdecode($file)) continue;
			if($ret=uploadTodesktop($file,$path)){
				if($ret['icoid']) $return[]=array('icoarr'=>$ret);
				elseif($ret['type']=='folder'){
					$return[]=$ret['data'];
				}
			}
		}
	}
	return $return;
}
function uploadTodesktop($file,$path){
	$filepath=ZIP_CACHE_FOLDER_PRE.'/'.$file;
	if(is_dir($filepath)){//上传目录
		$fname=array_pop(explode('/',$file));
		$p=new Encode_Core();
		if(!$charset=$p->get_encoding($fname)){
			$charset=getglobal('config/system_charset');
		}
		$fname=diconv($fname,$charset,CHARSET);
		if(($ret=IO::CreateFolder($path,$fname,0,'overwrite')) && $ret['icoarr']){
			$handle = opendir($filepath);
			while(($subfile = readdir($handle)) !== FALSE) {
				if($subfile != '.' && $subfile != '..') {
					uploadTodesktop($file.'/'.$subfile,$ret['folderarr']['path']);
				}
			}
			return array('type'=>'folder','data'=>$ret);
		}
	}elseif(is_file($filepath)){//上传文件
		$fname=array_pop(explode('/',$file));
		$p=new Encode_Core();
		if(!$charset=$p->get_encoding($fname)){
			$charset=getglobal('config/system_charset');
		}
		$fname=diconv($fname,$charset,CHARSET);
		if($ret=IO::multiUpload('TMP::'.TMPPRE.'/'.$file,$path,$fname)){
			return $ret;
		}
	}else{
		return false;
	}
}
function zip_save($folder,$path,$filename,$type='save',$comment){
	$arr=explode('/',$folder);
	$tmpfolder=ZIP_CACHE_FOLDER_PRE.DIRECTORY_SEPARATOR.$arr[0];
	if(!is_dir($tmpfolder)) return false;
	$filepath=ZIP_CACHE_FOLDER_PRE.DIRECTORY_SEPARATOR.$arr[0].'.zip';
	$zip=new PclZip($filepath);
	if($comment) $comment=diconv($comment,CHARSET,getglobal('config/system_charset'));
	$ret=$zip->create($tmpfolder,PCLZIP_OPT_REMOVE_PATH,$tmpfolder,PCLZIP_OPT_COMMENT,$comment);
	if($ret===0) return array('error'=>'压缩失败');
	if($type=='save'){
		$result=IO::setFileContent($path,fopen($filepath,'rb'),true);
		return array('msg'=>'success','res'=>$result);
	
		if($return['error']){
            return array('error'=>$return['error']);
        }
		return array('msg'=>'success');
	}else{
		if($ret=IO::multiUpload('TMP::'.TMPPRE.'/'.$arr[0].'.zip',$path,$filename)){
			if($ret['icoarr']) return $ret['icoarr'][0];
			return $ret;
		}
		return array('error'=>'保存失败');
	}
	
}
function getFolderInfo($path){//获取目录的文件列表

	$data=array();
	$dirname = str_replace(array( "\n", "\r", '..'), array('', '', ''),ZIP_CACHE_FOLDER_PRE.DIRECTORY_SEPARATOR.$path);
	if(!is_dir($dirname)) {
		return $data;
	}
	$handle = opendir($dirname);
	while(($file = readdir($handle)) !== FALSE) {
		$value=array();
		if($file != '.' && $file != '..') {
			$dir = $dirname . DIRECTORY_SEPARATOR . $file;
			$value['mtime']=filemtime($dir);
			$value['path']=(($path?$path.'/':'').$file);
			$p=new Encode_Core();
			if(!$charset=$p->get_encoding($file)) $charset=getglobal('config/system_charset');
			$value['name']=diconv($file,$charset,CHARSET);
			if(is_dir($dir)){
				$value['type']='folder';
				$value['ext']='';
				$value['size']='-';
			    $value['img']='dzz/images/default/system/folder.png';
			}else{
				$value['type']='file';
				$value['ext']=strtolower(substr(strrchr($file, '.'), 1, 10));
				if(in_array($value['ext'],array('gif','png','jpg','jpeg','bmp'))){
					 $value['img']=DZZSCRIPT.'?mod=io&op=thumbnail&width=100&height=100&path='.dzzencode('TMP::'.TMPPRE.'/'.$value['path']);
					 $value['type']='image';
				}else{
					$value['type']='attach';
					 $value['img']=geticonfromext($value['ext'],$value['type']);
				}
				$value['size']=filesize($dir);
				$value['fsize']=formatsize($value['size']);
				$value['dpath']=dzzencode('TMP::'.TMPPRE.'/'.$value['path']);
			}
			$value['dpath']=dzzencode('TMP::'.TMPPRE.'/'.$value['path']);
			$value['folder']=dzzencode($value['path']);
			$value['ftype']=getFileTypeName($value['type'],$value['ext']);
			$data[]=$value;	
		}
	}
	closedir($handle);
	return $data;
}
function zip_addfile($opath,$file) {
	@set_time_limit(0);
	//$meta=IO::getMeta($opath);
	$file_source=IO::getStream($opath);
	$dir=dirname($file);
	if(!is_dir($dir)) dmkdir($dir,0777,false);
	$rh = fopen($file_source, 'rb');
	if ($rh===false) {
	   return false;
	}
	$wh = fopen($file, 'wb');
	if ($wh===false) {
	   return false;
	}
	while (!feof($rh)) {
		if (fwrite($wh, fread($rh, 8192)) === FALSE) {
			   // 'Download error: Cannot write to file ('.$file_target.')';
			   return false;
		   }
	}
	fclose($rh);
	fclose($wh);
	return $file;
}
function zip_addfolder($opath,$tpath) {
	
	@set_time_limit(0);
	if(!is_dir($tpath)) dmkdir($tpath,0777,false);
	foreach(IO::listFiles($opath) as $value){
		if($value['type']=='folder'){
			zip_addfolder($value['path'],$tpath.'/'.diconv($value['name'],CHARSET,getglobal('config/system_charset')));
		}else{
			zip_addfile($value['path'],$tpath.'/'.diconv($value['name'],CHARSET,getglobal('config/system_charset')));
		}
	}
}
function removedir($dirname, $keepdir = FALSE ,$time=0) {
	$dirname = str_replace(array( "\n", "\r", '..'), array('', '', ''), $dirname);

	if(!is_dir($dirname)) {
		return FALSE;
	}
	$handle = opendir($dirname);
	while(($file = readdir($handle)) !== FALSE) {
		if($file != '.' && $file != '..') {
			$dir = $dirname . DIRECTORY_SEPARATOR . $file;
			$mtime=filemtime($dir);
			is_dir($dir) ? removedir($dir) : (((TIMESTAMP-$mtime)>$time)? unlink($dir):'');
		}
	}
	closedir($handle);
	return !$keepdir ? (@rmdir($dirname) ? TRUE : FALSE) : TRUE;
}
?>
