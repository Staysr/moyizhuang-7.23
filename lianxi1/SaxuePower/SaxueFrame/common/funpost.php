<?php
function saxue_geteditor( $name = '', $width = '580', $height = '400', $tool = 'user', $allowFileManager = true, $forbidUpload = array(), $min = true ) {
		if ( empty( $name ) ) return;
		if ( $min && !defined( "SAXUE_EDITOR" ) ) {
				$editor = '<script charset="utf-8" src="' . SAXUE_SKIN_SERVER . '/editor/kindeditor-min.js"></script>';
				define( "SAXUE_EDITOR", 1 );
		} elseif ( !defined( "SAXUE_EDITOR" ) ) {
				$editor = '<script charset="utf-8" src="' . SAXUE_SKIN_SERVER . '/editor/kindeditor.js"></script>';
				define( "SAXUE_EDITOR", 1 );
		} 
		$tmp = '
					width : \'' . $width . 'px\',
					height : \'' . $height . 'px\',
					urlType : \'absolute\',
					//newlineTag : \'br\',
					uploadJson : \'' . SAXUE_URL . '/api/upload_json.php\',
					fileManagerJson : \'' . SAXUE_URL . '/api/file_manager_json.php\',';
		if ( $allowFileManager ) {
				$tmp .= '
					allowFileManager : true,';
		} 
		if ( is_array( $forbidUpload ) && count( $forbidUpload ) > 0 ) {
				foreach( $forbidUpload as $v ) {
						$v = ucfirst( strtolower( trim( $v ) ) );
						if ( in_array( $v, array( 'Image', 'Flash', 'Media', 'File' ) ) ) {
								$tmp .= '
					allow' . $v . 'Upload : false,';
						} 
				} 
		} 
		$tmp .= '
					items : ' . saxue_gettools( $tool );
		$tmp .= ',	afterBlur: function(){this.sync();}';
		if ( !is_array( $name ) ) {
				$editor .= '
				<script>
				var o_' . $name . ' = {' . $tmp . ' 
				};
				var e_' . $name . ';
				KindEditor.ready(function(K) {
					e_' . $name . ' = K.create(\'textarea[name="' . $name . '"]\', o_' . $name . ');
				});
				</script>';
		} else {
				$editor .= '
				<script>
				var options = {
					' . $tmp . ' 
				};
				var e_' . $name . ';
				KindEditor.ready(function(K) {';
				foreach( $name as $v ) {
						$v = trim( $v );
						if ( !empty( $v ) ) {
								$editor .= '
							e_' . $v . ' = K.create(\'textarea[name="' . $v . '"]\', options);';
						} 
				} 
				$editor .= '
				});
				</script>';
		} 
		return $editor;
} 

function saxue_gettools( $tool = 'user' ) {
		if ( !empty( $_SESSION['saxueAdminId'] ) ) $items = '[\'source\', \'|\', ';
		else $items = '[';
		switch ( $tool ) {
				case "user" :
						$items .= '\'undo\', \'redo\', \'preview\', \'selectall\', \'|\', \'image\', \'flash\', \'media\', \'fullscreen\']';
						break;
				case "basic" :
						$items .= '\'bold\', \'forecolor\', \'removeformat\', \'|\', \'justifyleft\', \'justifycenter\', \'justifyright\', \'|\', \'link\', \'unlink\', \'emoticons\', \'image\']';
						break;
				case "simple" :
						$items .= '\'fontname\', \'fontsize\', \'|\', \'forecolor\', \'hilitecolor\', \'bold\', \'italic\', \'underline\',
						\'removeformat\', \'|\', \'justifyleft\', \'justifycenter\', \'justifyright\', \'insertorderedlist\',
						\'insertunorderedlist\', \'|\', \'link\', \'unlink\', \'emoticons\', \'image\']';
						break;
				default:
						$items .= '\'undo\', \'redo\', \'|\', \'preview\', \'print\', \'template\', \'code\', \'cut\', \'copy\', \'paste\',
								\'plainpaste\', \'wordpaste\', \'|\', \'justifyleft\', \'justifycenter\', \'justifyright\',
								\'justifyfull\', \'insertorderedlist\', \'insertunorderedlist\', \'indent\', \'outdent\', \'subscript\',
								\'superscript\', \'clearhtml\', \'quickformat\', \'selectall\', \'|\', \'fullscreen\', \'/\',
								\'formatblock\', \'fontname\', \'fontsize\', \'|\', \'forecolor\', \'hilitecolor\', \'bold\',
								\'italic\', \'underline\', \'strikethrough\', \'lineheight\', \'removeformat\', \'|\', \'image\', \'multiimage\',
								\'flash\', \'media\', \'insertfile\', \'table\', \'hr\', \'emoticons\', \'baidumap\', \'pagebreak\',
								\'anchor\', \'link\', \'unlink\']';
		} 
		return $items;
} 

function saxue_setcontent( $content = '' ) {
		if ( empty( $content ) ) return; 
		// 清除JS
		$content = preg_replace( array( "~<script[^>]*?>.*?</script>~is" ), array( "" ), $content );
		// 清除回车换行符和制表符
		$content = str_replace( array( chr( 13 ), chr( 10 ), "\n", "\r", "\t" ), array( '', '', '', '', '' ), $content );
		return $content;
} 

function clear_link( $content ) {
		return preg_replace_callback( "/<a[^>]*>(.*?)<\/a>/is", "_clear_link", $content );
}

function _clear_link( $matchs ) {
		if ( strpos( $matchs[0], SAXUE_URL ) !== false || strpos( $url, '://' ) === false ) return $matchs[0];
		if ( SAXUE_COOKIE_DOMAIN && strpos( $matchs[0], SAXUE_COOKIE_DOMAIN ) !== false ) return $matchs[0];
		if ( SAXUE_ATTACHS_URL && strpos( $matchs[0], SAXUE_ATTACHS_URL ) !== false ) return $matchs[0];
		return $matchs[1];
}

function save_remote( $content, $ext = 'jpg|jpeg|gif|png|bmp' ) {
		if ( !$content ) return $content; 
		// if ( !preg_match_all( "/src=([\"|']?)([^ \"'>]+\.($ext))\\1/i", $content, $matches ) ) return $content;
		if ( !preg_match_all( "/src=([\"|']?)([^ \"'>]+\.($ext)[^ \"'>]*)\\1/i", $content, $matches ) ) return $content;
		$save_path = saxue_uploadpath();
		if ( SAXUE_ATTACHS_PATH != '' && strpos( SAXUE_ATTACHS_PATH, "/" ) === false && strpos( SAXUE_ATTACHS_PATH, "\\" ) === false && SAXUE_ATTACHS_FTPURL != '' ) {
				$ftp_path = SAXUE_ATTACHS_FTPURL . '/' . SAXUE_ATTACHS_PATH . '/';
		} else {
				$ftp_path = '';
		} 
		$subdir = '/image/' . date( "ym" ) . '/'; 
		// 文件保存目录路径
		$save_path = realpath( $save_path ) . $subdir; 
		// 文件保存目录URL
		$save_url = saxue_uploadurl() . $subdir;

		$urls = $oldpath = $newpath = array();
		foreach( $matches[2] as $k => $url ) {
				// 已下载图片、图片URL错误、本站图片则忽略
				if ( in_array( $url, $urls ) || strpos( $url, '://' ) === false || strpos( $url, SAXUE_URL ) !== false ) continue;
				if ( SAXUE_ATTACHS_URL && strpos( $url, SAXUE_ATTACHS_URL ) !== false ) continue;
				if ( SAXUE_COOKIE_DOMAIN && strpos( $url, SAXUE_COOKIE_DOMAIN ) !== false ) continue;
				$urls[] = $url;
				$trueurl = check_imgurl( $url );
				$file_ext = file_ext( $trueurl );
				$filename = date( "dHis" ) . mt_rand( 10000, 99999 ) . '.' . $file_ext;
				$newfile = $save_path . $filename;
				if ( file_remote_copy( $trueurl, $newfile ) ) {
						// 开启FTP上传
						if ( SAXUE_ATTACHS_FTP && !empty( $ftp_path ) ) {
								saxue_copyfile( $newfile, $ftp_path . $subdir . $filename, 511, true );
						} 
						$oldpath[] = $url;
						$newpath[] = $save_url . $filename;
				} 
		} 
		unset( $matches );
		return str_replace( $oldpath, $newpath, $content );
} 

function check_imgurl( $url, $ext = 'jpg|jpeg|gif|png|bmp' ) {
		// 针对使用动态缓存图片URL的提取真实图片地址
		if ( !preg_match( "/src=([\"|']?)([^ \"'>]+\.($ext))\\1/i", $url, $match ) ) return $url;
		if ( strpos( $match[2], '://' ) !== false ) return $match[2];
		$rs = parse_url( $url );
		return $rs["scheme"] . '://' . $rs["host"] . $match[2];
} 

function file_remote_copy( $from, $to ) {
		saxue_checkdir( dirname( $to ), true );
		file_curlDownload( $from, $to );
		if ( is_file( $to ) ) {
				@chmod( $to, 511 );
				return true;
		} else {
				return false;
		} 
} 

function file_ext( $filename ) {
		return strtolower( trim( substr( strrchr( $filename, '.' ), 1 ) ) );
} 

function file_curlDownload( $remote, $local ) {
		$cp = curl_init( $remote );
		$fp = fopen( $local, "w" );
		curl_setopt( $cp, CURLOPT_FILE, $fp );
		curl_setopt( $cp, CURLOPT_HEADER, 0 );
		curl_exec( $cp );
		curl_close( $cp );
		fclose( $fp );
} 

function is_image( $file ) {
		return preg_match( "/^(jpg|jpeg|gif|png|bmp)$/i", file_ext( $file ) );
} 

function saxue_safestring( $_str ) {
		$_len = strlen( $_str );
		for ( $_i = 0; $_i < $_len; ++$_i ) {
				$_tmpval = ord( $_str[$_i] );
				if ( 128 < $_tmpval ) {
						++$_i;
				} else {
						if ( $_tmpval == 34 || $_tmpval == 38 || $_tmpval == 39 || $_tmpval == 44 || $_tmpval == 47 || $_tmpval == 59 || $_tmpval == 60 || $_tmpval == 62 || $_tmpval == 92 || $_tmpval == 124 ) {
								return false;
						} 
						continue;
				} 
		} 
		return true;
}