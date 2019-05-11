<?php
function file_icon( $file ) {
		$ext_arr = array( 'doc', 'docx', 'ppt', 'xls', 'xlsx', 'txt', 'pdf', 'jpg', 'gif', 'png', 'bmp', 'jpeg', 'rar', 'zip', 'swf', 'flv', 'htm', 'html' );
		$ext = strtolower( trim( substr( strrchr( $file, '.' ), 1 ) ) );
		if ( in_array( $ext, $ext_arr ) ) return SAXUE_SKIN_SERVER . '/ext/' . $ext . '.gif';
		else return SAXUE_SKIN_SERVER . '/ext/file.gif';
} 
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'attachs' );
if ( SAXUE_ATTACHS_FTP && SAXUE_ATTACHS_FTPURL != '' && SAXUE_ATTACHS_PATH != '' && strpos( SAXUE_ATTACHS_PATH, "/" ) === false && strpos( SAXUE_ATTACHS_PATH, "\\" ) === false ) {
		// FTP模式
		$errtext = '';
		if ( empty( $saxueConfigs['system']['attachsftpurl'] ) ) {
				saxue_printfail( 'FTP服务器URL为空', 0 );
		} elseif ( !preg_match( "/^(ftps?):\\/\\/([^:\\/]+):([^:\\/]*)@([0-9a-z\\-\\.]+)(:(\\d+))?([0-9a-z_\\-\\/\\.]*)/is", $saxueConfigs['system']['attachsftpurl'], $matches ) ) {
				saxue_printfail( 'FTP服务器URL格式错误', 0 );
		} elseif ( strpos( $saxueConfigs['system']['attachsdir'], "/" ) !== false || strpos( $saxueConfigs['system']['attachsdir'], "\\" ) !== false ) {
				saxue_printfail( '系统附件目录错误，FTP模式目录只能为字母或数字', 0 );
		} 
		include_once( SAXUE_ROOT_PATH . "/lib/util/ftp.php" );
		$ftpssl = strtolower( $matches[1] ) == "ftps" ? 1 : 0;
		$matches[6] = intval( trim( $matches[6] ) );
		$ftpport = 0 < $matches[6] ? $matches[6] : 21;
		$ftp = &saxueftp :: getinstance( $matches[4], $matches[2], $matches[3], ".", $ftpport, 0, $ftpssl );
		if ( !$ftp ) {
				saxue_printfail( '无法连接FTP服务器', 0 );
		} 
		$matches[7] = trim( $matches[7] );
		if ( !$ftp -> ftp_chdir( dirname( $matches[7] ) ) ) {
				saxue_printfail( '无法打开FTP服务器目录"/' . $saxueConfigs['system']['attachsdir'] . '/"', 0 );
		} 
		if ( isset( $_REQUEST['checkaction'] ) && $_REQUEST['checkaction'] == 'delete' && is_array( $_REQUEST['attachs'] ) && 0 < count( $_REQUEST['attachs'] ) ) {
				foreach( $_REQUEST['attachs'] as $v ) {
						saxue_delfile( $saxueConfigs['system']['attachsftpurl'] . '/' . $saxueConfigs['system']['attachsdir'] . '/' . $v );
				} 
		} 
		$dir = isset( $_REQUEST['dir'] ) && trim( $_REQUEST['dir'] ) ? str_replace( array( '..\\', '../', './', '.\\' ), '', trim( $_REQUEST['dir'] ) . '/' ) : '';
		$fileurl = '/' . $dir;
		$filepath = $saxueConfigs['system']['attachsdir'] . '/' . $dir;
		$list = $ftp -> ftp_rawlist( $filepath );
		$ftp -> ftp_close();
		if ( !$list ) {
				saxue_printfail( '附件目录/' . $filepath . '是空目录', 0 );
		} 
		$dirlist = $filelist = array();
		$k = 0;
		foreach( $list as $file ) {
				if ( ereg ( "([-d][rwxst-]+).* ([0-9]) ([a-zA-Z0-9]+).* ([a-zA-Z0-9]+).* ([0-9]*) ([a-zA-Z]+[0-9: ]*[0-9]) ( [0-9]{4}|[0-9]{2}:[0-9]{2}) (.+)", $file, $regs ) ) {
						$filename = mb_convert_encoding( $regs[8], "utf-8", "gb2312" );
						if ( $filename == '.' || $filename == '..' ) continue;
						$isdir = ( substr ( $regs[1], 0, 1 ) == "d" );
						if ( $isdir ) {
								$dirlist[$k]['dirname'] = $filename;
								$dirlist[$k]['dirurl'] = '?dir=' . ( isset( $_REQUEST['dir'] ) && !empty( $_REQUEST['dir'] ) ? stripslashes( $_REQUEST['dir'] ) . '/' : '' ) . $filename;
								if ( strlen( trim( $regs[7] ) ) == 4 ) {
										$dirlist[$k]['dirtime'] = date( 'Y-m-d', strtotime( $regs[6] . ' ' . trim( $regs[7] ) ) );
								} else {
										$dirlist[$k]['dirtime'] = date( 'Y-m-d H:i', strtotime( $regs[6] . ' ' . trim( $regs[7] ) ) );
								} 
						} else {
								$filelist[$k]['filename'] = $filename;
								$filelist[$k]['fileicon'] = file_icon( $filename );
								$filelist[$k]['filesize'] = round( $regs[5] / 1024, 2 );
								if ( strlen( trim( $regs[7] ) ) == 4 ) {
										$filelist[$k]['filetime'] = date( 'Y-m-d', strtotime( $regs[6] . ' ' . trim( $regs[7] ) ) );
								} else {
										$filelist[$k]['filetime'] = date( 'Y-m-d H:i', strtotime( $regs[6] . ' ' . trim( $regs[7] ) ) );
								} 
						} 
				} 
				++$k;
		} 
		if ( $dir != '' && $dir != '/' ) $parentdir = '?dir=' . stripslashes( dirname( $dir ) );
		else $parentdir = '';
		$mode = 'ftp';
} else {
		// 本地模式
		$basedir = realpath( saxue_uploadpath() );
		if ( isset( $_REQUEST['checkaction'] ) && $_REQUEST['checkaction'] == 'delete' && is_array( $_REQUEST['attachs'] ) && 0 < count( $_REQUEST['attachs'] ) ) {
				foreach( $_REQUEST['attachs'] as $v ) {
						saxue_delfile( $basedir . '/' . $v );
				} 
		} 
		$dir = isset( $_REQUEST['dir'] ) && trim( $_REQUEST['dir'] ) ? str_replace( array( '..\\', '../', './', '.\\' ), '', trim( $_REQUEST['dir'] ) . '/' ) : '';
		$filepath = $basedir . '/' . $dir;
		$fileurl = '/' . $dir;
		$list = glob( $filepath . '*' );
		if ( !empty( $list ) ) rsort( $list );
		$dirlist = $filelist = array();
		$k = 0;
		foreach( $list as $file ) {
				$filename = basename( $file );
				if ( is_dir( $file ) ) {
						$dirlist[$k]['dirname'] = $filename;
						$dirlist[$k]['dirurl'] = '?dir=' . ( isset( $_REQUEST['dir'] ) && !empty( $_REQUEST['dir'] ) ? stripslashes( $_REQUEST['dir'] ) . '/' : '' ) . $filename;
						$dirlist[$k]['dirtime'] = date( 'Y-m-d H:i', filemtime( $file ) );
				} else {
						$filelist[$k]['filename'] = $filename;
						$filelist[$k]['fileicon'] = file_icon( $filename );
						$filelist[$k]['filesize'] = round( filesize( $file ) / 1024, 2 );
						$filelist[$k]['filetime'] = date( 'Y-m-d H:i', filemtime( $file ) );
				} 
				++$k;
		} 
		if ( $dir != '' && $dir != '.' ) $parentdir = '?dir=' . stripslashes( dirname( $dir ) );
		else $parentdir = '';
		$mode = 'local';
} 
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign( "attachsurl", saxue_uploadurl() . '/' . $dir );
$saxueTpl -> assign( "dir", $dir );
$saxueTpl -> assign( "mode", $mode );
$saxueTpl -> assign( "parentdir", $parentdir );
$saxueTpl -> assign( "fileurl", $fileurl );
$saxueTpl -> assign_by_ref( "dirlist", $dirlist );
$saxueTpl -> assign_by_ref( "filelist", $filelist );
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/attachs.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
