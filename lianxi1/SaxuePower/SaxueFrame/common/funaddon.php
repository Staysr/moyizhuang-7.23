<?php
function saxue_run( $msg, $url = '' ) {
		if ( !is_object( $saxueTpl ) ) {
				include_once( SAXUE_ROOT_PATH . "/lib/template/template.php" );
				$saxueTpl = &saxuetpl :: getinstance();
		}
		$saxueTpl -> assign( array( "msg" => $msg, "url" => $url ) );
		$saxueTpl -> setcaching( 0 );
		$saxueTpl -> display( SAXUE_ROOT_PATH . '/templates/admin/msgrun.html' );
}
function saxue_copyaddon( $dirfrom, $dirto, $cover = true ) {
		// 如果目录不存在，则建立之
		saxue_checkdir( $dirto, true );
		//打开当前目录
		$handle = opendir( $dirfrom );
		// 循环读取文件
		while ( false !== ( $file = readdir( $handle ) ) ) {
				if ( $file != '.' && $file != '..' ) {
						// 生成源文件名
						$filefrom = $dirfrom . DIRECTORY_SEPARATOR . $file; 
						// 生成目标文件名
						if ( $file == 'admin' && $dirto == SAXUE_WEB_PATH ) {
								// 后台目录
								$fileto = SAXUE_ADMIN_PATH;
						} elseif ( $file == 'SaxueFrame' ) {
								// SaxueFrame目录
								$fileto = SAXUE_ROOT_PATH;
						} else {
								$fileto = $dirto . DIRECTORY_SEPARATOR . $file;
						}
						if ( is_dir( $filefrom ) ) { 
								// 如果是子目录，则进行递归操作
								saxue_copyaddon( $filefrom, $fileto, $cover );
						} elseif ( $cover || !file_exists( $fileto ) ) { 
								// 如果是文件，则直接用copy函数复制
								if ( !copy( $filefrom, $fileto ) ) {
										ob_clean();
										saxue_printfail( '复制文件失败，请检查目录权限<br>源文件：' . $filefrom . '<br>目标文件：' . $fileto );
								} 
						} 
				} 
		} 
} 
function saxue_sockopen( $url, $timeout = 15, $limit = 0, $post = '', $cookie = '', $ip = '', $block = true, $encodetype = 'URLENCODE', $allowcurl = true, $position = 0, $files = array() ) {
		$return = '';
		$matches = parse_url( $url );
		$scheme = $matches['scheme'];
		$host = $matches['host'];
		$path = $matches['path'] ? $matches['path'] . ( $matches['query'] ? '?' . $matches['query'] : '' ) : '/';
		$port = !empty( $matches['port'] ) ? $matches['port'] : ( $scheme == 'http' ? '80' : '' );
		$boundary = $encodetype == 'URLENCODE' ? '' : random( 40 );

		if ( $post ) {
				if ( !is_array( $post ) ) {
						parse_str( $post, $post );
				} 
				_format_postkey( $post, $postnew );
				$post = $postnew;
		} 
		if ( function_exists( 'curl_init' ) && function_exists( 'curl_exec' ) && $allowcurl ) {
				$ch = curl_init();
				$httpheader = array();
				if ( $ip ) {
						$httpheader[] = "Host: " . $host;
				} 
				if ( $httpheader ) {
						curl_setopt( $ch, CURLOPT_HTTPHEADER, $httpheader );
				} 
				curl_setopt( $ch, CURLOPT_URL, $scheme . '://' . ( $ip ? $ip : $host ) . ( $port ? ':' . $port : '' ) . $path );
				curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
				curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
				curl_setopt( $ch, CURLOPT_HEADER, 1 );
				if ( $post ) {
						curl_setopt( $ch, CURLOPT_POST, 1 );
						if ( $encodetype == 'URLENCODE' ) {
								curl_setopt( $ch, CURLOPT_POSTFIELDS, $post );
						} else {
								foreach( $post as $k => $v ) {
										if ( isset( $files[$k] ) ) {
												$post[$k] = '@' . $files[$k];
										} 
								} 
								foreach( $files as $k => $file ) {
										if ( !isset( $post[$k] ) && file_exists( $file ) ) {
												$post[$k] = '@' . $file;
										} 
								} 
								curl_setopt( $ch, CURLOPT_POSTFIELDS, $post );
						} 
				} 
				if ( $cookie ) {
						curl_setopt( $ch, CURLOPT_COOKIE, $cookie );
				} 
				curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
				curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
				$data = curl_exec( $ch );
				$status = curl_getinfo( $ch );
				$errno = curl_errno( $ch );
				curl_close( $ch );
				if ( $errno || $status['http_code'] != 200 ) {
						return;
				} else {
						$GLOBALS['filesockheader'] = substr( $data, 0, $status['header_size'] );
						$data = substr( $data, $status['header_size'] );
						return !$limit ? $data : substr( $data, 0, $limit );
				} 
		} 

		if ( $post ) {
				if ( $encodetype == 'URLENCODE' ) {
						$data = http_build_query( $post );
				} else {
						$data = '';
						foreach( $post as $k => $v ) {
								$data .= "--$boundary\r\n";
								$data .= 'Content-Disposition: form-data; name="' . $k . '"' . ( isset( $files[$k] ) ? '; filename="' . basename( $files[$k] ) . '"; Content-Type: application/octet-stream' : '' ) . "\r\n\r\n";
								$data .= $v . "\r\n";
						} 
						foreach( $files as $k => $file ) {
								if ( !isset( $post[$k] ) && file_exists( $file ) ) {
										if ( $fp = @fopen( $file, 'r' ) ) {
												$v = fread( $fp, filesize( $file ) );
												fclose( $fp );
												$data .= "--$boundary\r\n";
												$data .= 'Content-Disposition: form-data; name="' . $k . '"; filename="' . basename( $file ) . '"; Content-Type: application/octet-stream' . "\r\n\r\n";
												$data .= $v . "\r\n";
										} 
								} 
						} 
						$data .= "--$boundary\r\n";
				} 
				$out = "POST $path HTTP/1.0\r\n";
				$header = "Accept: */*\r\n";
				$header .= "Accept-Language: zh-cn\r\n";
				$header .= $encodetype == 'URLENCODE' ? "Content-Type: application/x-www-form-urlencoded\r\n" : "Content-Type: multipart/form-data; boundary=$boundary\r\n";
				$header .= 'Content-Length: ' . strlen( $data ) . "\r\n";
				$header .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
				$header .= "Host: $host:$port\r\n";
				$header .= "Connection: Close\r\n";
				$header .= "Cache-Control: no-cache\r\n";
				$header .= "Cookie: $cookie\r\n\r\n";
				$out .= $header;
				$out .= $data;
		} else {
				$out = "GET $path HTTP/1.0\r\n";
				$header = "Accept: */*\r\n";
				$header .= "Accept-Language: zh-cn\r\n";
				$header .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
				$header .= "Host: $host:$port\r\n";
				$header .= "Connection: Close\r\n";
				$header .= "Cookie: $cookie\r\n\r\n";
				$out .= $header;
		} 

		$fpflag = 0;
		if ( !$fp = @fsocketopen( ( $ip ? $ip : $host ), $port, $errno, $errstr, $timeout ) ) {
				$context = array( 'http' => array( 'method' => $post ? 'POST' : 'GET',
								'header' => $header,
								'content' => $post,
								'timeout' => $timeout, 
								), 
						);
				$context = stream_context_create( $context );
				$fp = @fopen( $scheme . '://' . ( $ip ? $ip : $host ) . ':' . $port . $path, 'b', false, $context );
				$fpflag = 1;
		} 

		if ( !$fp ) {
				return '';
		} else {
				stream_set_blocking( $fp, $block );
				stream_set_timeout( $fp, $timeout );
				@fwrite( $fp, $out );
				$status = stream_get_meta_data( $fp );
				if ( !$status['timed_out'] ) {
						while ( !feof( $fp ) && !$fpflag ) {
								$header = @fgets( $fp );
								$headers .= $header;
								if ( $header && ( $header == "\r\n" || $header == "\n" ) ) {
										break;
								} 
						} 
						$GLOBALS['filesockheader'] = $headers;

						if ( $position ) {
								for( $i = 0; $i < $position; $i++ ) {
										$char = fgetc( $fp );
										if ( $char == "\n" && $oldchar != "\r" ) {
												$i++;
										} 
										$oldchar = $char;
								} 
						} 

						if ( $limit ) {
								$return = stream_get_contents( $fp, $limit );
						} else {
								$return = stream_get_contents( $fp );
						} 
				} 
				@fclose( $fp );
				return $return;
		} 
} 

function _format_postkey( $post, &$result, $key = '' ) {
		foreach( $post as $k => $v ) {
				$_k = $key ? $key . '[' . $k . ']' : $k;
				if ( is_array( $v ) ) {
						_format_postkey( $v, $result, $_k );
				} else {
						$result[$_k] = $v;
				} 
		} 
} 