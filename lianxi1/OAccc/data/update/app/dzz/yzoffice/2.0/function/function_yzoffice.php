<?php
function downfile($meta) {
	$file_source=IO::getStream($meta['path']);
	if(file_exists($file_source)) return $file_source;
	$file=DZZ_ROOT.'./data/attachment/cache/'.md5($path).'.'.$meta['ext'];
	
	if(file_exists($file) && $meta['md5']==md5_file($file)) return $file;
	$rh = fopen($file_source, 'rb');
	$wh = fopen($file, 'wb');
	if ($rh===false || $wh===false) {
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
function mtime(){
	$t= explode(' ',microtime());
	$time = $t[0]+$t[1];
	return $time;
}

function parse_headers($raw_headers){
	$headers = array();
	$key = '';
	foreach (explode("\n", $raw_headers) as $h) {
		$h = explode(':', $h, 2);
		if (isset($h[1])) {
			if ( ! isset($headers[$h[0]])) {
				$headers[$h[0]] = trim($h[1]);
			} elseif (is_array($headers[$h[0]])) {
				$headers[$h[0]] = array_merge($headers[$h[0]], array(trim($h[1])) );
			} else {
				$headers[$h[0]] = array_merge(array($headers[$h[0]]), array(trim($h[1])) );
			}
			$key = $h[0];
		} else {
			if (substr($h[0], 0, 1) === "\t") {
				$headers[$key] .= "\r\n\t" . trim($h[0]);
			} elseif ( ! $key) {
				$headers[0] = trim($h[0]);
			}
			trim($h[0]);
		}
	}
	return $headers;
}


function curl_progress_bind($file,$uuid=''){
	if(!getglobal('curlCurrentFile')){
		$cacheFilePath = getglobal('setting/attachdir').'cache/yzoffice/curlProgress/';
		dmkdir($cacheFilePath);
		$cacheFile = $cacheFilePath.md5($file.$uuid).'.log';
		@touch($cacheFile);
		if(!file_exists($cacheFile)){
			return;
		}
		setglobal('curlCurrentFile',array(
									'path' => $file,
									'uuid' => $uuid,
									'time' => 0,
									'cacheFile' => $cacheFile,
			));
	}
	curl_progress_set(false,0,0,0,0);
}

function curl_progress_set(){
	$fileInfo = getglobal('curlCurrentFile');
	$file = $fileInfo['path'];
	$cacheFile = $fileInfo['cacheFile'];
	if(!is_array($fileInfo) || mtime() - $fileInfo['time'] <= 0.3){
		return;
	}
	clearstatcache();
	if (!file_exists($cacheFile) || !file_exists($file)){
		return;
	}
	setglobal('curlCurrentFile/time',mtime());
	$args = func_get_args();
	if (is_resource($args[0])) {// php 5.5
	    array_shift($args);
	}
	$downTotal = $args[0];
	$downSize = $args[1];
	$upTotal = $args[2];
	$upSize = $args[3];

	$size = @filesize($file);
	$sizeSuccess = $upSize;
	$reJson = array(
			'name'		=> basename($file),
			'taskUuid'	=> $fileInfo['uuid'],
			'type'		=> 'fileUpload',
			'sizeTotal' => $size,
			'sizeSuccess' => $sizeSuccess,
			'speed'		  =>0,
			'logList'	  => array()
		);
	if(time() - filemtime($cacheFile) <= 10){
		$data = @json_decode(file_get_contents($cacheFile),true);
		$reJson = $data ? $data : $reJson;
	}else{
		unlink($cacheFile);
		@touch($cacheFile);
	}
	$logList = &$reJson['logList'];
	if(count($logList) >= 10){
		$logList = array_slice($logList, -10);
	}
	$current = array('time' => time(), 'sizeSuccess' => $sizeSuccess);
	if(count($logList) == 0){
		$logList[] = $current;
	}else{
		$last = $logList[count($logList)-1];
		if(time() == $last['time']){
			$logList[count($logList)-1] = $current;
		}else{
			$logList[] = $current;
		}
	}
	$first = $logList[0];
	$last  = $logList[count($logList)-1];
	$time  = $last['time'] - $first['time'];
	$speed = $time?($last['sizeSuccess'] - $first['sizeSuccess'])/$time : 0;
	if($speed <0 || $speed>500*1024*1024){
		$speed = 0;
	}
	$reJson['speed'] = intval($speed);
	$reJson['sizeTotal'] = $size;
	$reJson['sizeSuccess']	= $sizeSuccess;
	file_put_contents($cacheFile,json_encode($reJson));
}
function curl_progress_get($file,$uuid=''){
	$cacheFile = getglobal('setting/attachdir').'cache/yzoffice/curlProgress/'.md5($file.$uuid).'.log';
	if(!file_exists($cacheFile) || $file == ''){
		return -1;
	}
	$data = @json_decode(file_get_contents($cacheFile),true);
	if(is_array($data)){
		unset($data['logList']);
		return $data;
	}
	return -3;
}
//文件上传 
function url_request($url,$method='GET',$data=false,$headers=false){
	$ch = curl_init();
	$upload = false;
	if(is_array($data)){//上传检测并兼容
		foreach($data as $key => &$value){
			if(!is_string($value) || substr($value,0,1) !== "@"){
				continue;
			}
			$upload = true;
			$path = ltrim($value,'@');
			$filename = basename($path);
			$mime = dzz_mime::get_type(fileext($filename));
			if (class_exists('\CURLFile')){
				$value = new CURLFile(realpath($path),$mime,$filename);
			}else{
				$value = "@".realpath($path).";type=".$mime.";filename=".$filename;
			}

			//上传进度记录并处理
			curl_progress_bind($path);
			curl_setopt($ch, CURLOPT_NOPROGRESS, false);
			curl_setopt($ch, CURLOPT_PROGRESSFUNCTION,'curl_progress_set');
		}
	}
	if($upload){
		if (class_exists('\CURLFile')){
			curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
		} else {
			if (defined('CURLOPT_SAFE_UPLOAD')) {
				curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
			}
		}
	}
	if ($data && is_array($headers) &&
		in_array('Content-Type: application/x-www-form-urlencoded',$headers)) {
		$data = http_build_query($data);
	}
	if($method == 'GET' && $data){
		if(strstr($url,'?')){
			$url = $url.'&'.$data;
		}else{
			$url = $url.'?'.$data;
		}
	}
	$urlres = parse_url($url);
	$port = (empty($urlres["port"]) || $urlres["port"] == '80')?'':':'.$urlres["port"];
	$urlrefer = $urlres['scheme']."://".$urlres["host"].$port.$urlres['path'];
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_HEADER,1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT,3600);
	curl_setopt($ch, CURLOPT_REFERER,$urlrefer);
	curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.94 Safari/537.36');
	if($headers){
		if(is_string($headers)){
			$headers = array($headers);
		}
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	}

	switch ($method) {
		case 'GET':
			curl_setopt($ch,CURLOPT_HTTPGET,1);
			break;
		case 'POST':
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
			break;
		default:break;
	}

	$response = curl_exec($ch);
	$header_size = curl_getinfo($ch,CURLINFO_HEADER_SIZE);
	$response_info = curl_getinfo($ch);
	$http_body   = substr($response, $header_size);
	$http_header = substr($response, 0, $header_size);
	$http_header = parse_headers($http_header);
	//error
	if($response_info['http_code'] == 0){
		$error_message = curl_error($ch);
		if (! empty($error_message)) {
			$error_message = "API call to $url failed;$error_message";
		} else {
			$error_message = "API call to $url failed;maybe network error!";
		}
		return array(
			'data'		=> $error_message,
			'code'		=> 0,
			'header'	=> $response_info,
		);
	}
	curl_close($ch);
	if(is_array(getglobal('curlCurrentFile'))){
		unlink(getglobal('curlCurrentFile/cacheFile'));
	}
	$success = $response_info['http_code'] >= 200 && $response_info['http_code'] <= 299;
	if($success){
		$data = @json_decode($http_body,true);
		if (json_last_error() == 0) { // string
			$http_body = $data;
		}
	}
	@unlink($data.'.downloading');

	$return = array(
		'data'		=> $http_body,
		'status'	=> $success,
		'code'		=> $response_info['http_code'],
		'header'	=> $http_header,
	);
	return $return;
}

function file_put_out($file){
	if (!file_exists($file)){
		@header('HTTP/1.1 403 Not Found');
		@header('Status: 403 Not Found');
		exit(lang('attachment_nonexistence')); 
	}
	
	$filename=basename($file);
	$ext=strtolower(substr(strrchr($filename, '.'), 1, 10));
	if(!$ext) $ext=strtolower(substr(strrchr(preg_replace("/\.dzz$/i",'',preg_replace("/\?.*/i",'',$url)), '.'), 1, 10));
	if($ext=='dzz' || ($ext && in_array($ext,$_G['setting']['unRunExts']))){//如果是本地文件,并且是阻止运行的后缀名时;
		$mime='text/plain';
	}else{
		$mime=dzz_mime::get_type($ext);
	}
	@header('cache-control:public'); 
	@header('Content-Type: '.$mime);
	@ob_end_clean();if(getglobal('gzipcompress')) @ob_start('ob_gzhandler');
	@readfile($file);
	@flush(); @ob_flush();
	exit();
}

