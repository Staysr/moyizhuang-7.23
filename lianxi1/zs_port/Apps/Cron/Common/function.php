<?php

/**
 * 初始化统计文件
 * @param type $dir
 * @param type $mod
 */
function fileStatInitialize($dir, $mod) {
    if ($dirHandle = @opendir($dir)) {
	while ($filename = readdir($dirHandle)) {
	    if ($filename != '.' && $filename != '..' && $filename != '.svn') {
		$subFile = $dir . '/' . $filename;
		if (is_dir($subFile)) {
		    fileStatInitialize($subFile, $mod);
		} else {
		    if ($filename == 'index.html') {
			continue;
		    }
		    $md5Code = md5_file($subFile);
		    $pathinfo = explode('.', $filename);
		    if (count($pathinfo) < 2) {
			continue;
		    }
		    $fileData = array(
			'name' => $pathinfo[0],
			'ext' => $pathinfo[1],
			'path' => ltrim($dir, '.') . '/',
			'md5' => $md5Code,
			'add_time' => time()
		    );
		    $result = $mod->add($fileData);
		    if (!$result) {
			$logFile = RUNTIME_PATH . '/initialize_' . date("Ymd") . '.log';
			file_put_contents($logFile, $subFile, FILE_APPEND);
		    }
		}
	    }
	}
    }
}

/**
 * 下载文件到本地
 * @param type $url
 * @param type $file
 * @param type $timeout
 * @return boolean
 */
function httpcopy($url, $file = "", $timeout = 60) {
    $file = empty($file) ? pathinfo($url, PATHINFO_BASENAME) : $file;
    $dir = pathinfo($file, PATHINFO_DIRNAME);
    !is_dir($dir) && @mkdir($dir, 0755, true);
    $url = str_replace(" ", "%20", $url);

    if (function_exists('curl_init')) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$temp = curl_exec($ch);
	if (@file_put_contents($file, $temp) && !curl_error($ch)) {
	    return $file;
	} else {
	    return false;
	}
    } else {
	$opts = array(
	    "http" => array(
		"method" => "GET",
		"header" => "",
		"timeout" => $timeout)
	);
	$context = stream_context_create($opts);
	if (@copy($url, $file, $context)) {
	    //$http_response_header
	    return $file;
	} else {
	    return false;
	}
    }
}
