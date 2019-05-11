<?php
require_once 'JSON.php';
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include_once( "../core.php" );
} 
if ( empty( $_SESSION['saxueAdminId'] ) ) alert( '未登录' );

// 图片扩展名
$ext_arr = array( 'gif', 'jpg', 'jpeg', 'png', 'bmp' );
// 排序形式，name or size or type
$order = empty( $_GET['order'] ) ? 'name' : strtolower( $_GET['order'] );
// 根目录URL，可以指定绝对路径，比如 http://www.yoursite.com/attached/
$root_url = saxue_uploadurl() . '/';
if ( SAXUE_ATTACHS_FTP ) {
		// FTP模式
		if ( SAXUE_ATTACHS_FTPURL == '' ) {
				alert( 'FTP服务器URL为空' );
		} elseif ( !preg_match( "/^(ftps?):\\/\\/([^:\\/]+):([^:\\/]*)@([0-9a-z\\-\\.]+)(:(\\d+))?([0-9a-z_\\-\\/\\.]*)/is", SAXUE_ATTACHS_FTPURL, $matches ) ) {
				alert( 'FTP服务器URL格式错误' );
		} elseif ( strpos( SAXUE_ATTACHS_DIR, "/" ) !== false || strpos( SAXUE_ATTACHS_DIR, "\\" ) !== false ) {
				alert( '系统附件目录错误，FTP模式目录只能为字母或数字' );
		} 
		include_once( SAXUE_ROOT_PATH . "/lib/util/ftp.php" );
		$ftpssl = strtolower( $matches[1] ) == "ftps" ? 1 : 0;
		$matches[6] = intval( trim( $matches[6] ) );
		$ftpport = 0 < $matches[6] ? $matches[6] : 21;
		$ftp = &saxueftp :: getinstance( $matches[4], $matches[2], $matches[3], ".", $ftpport, 0, $ftpssl );
		if ( !$ftp ) {
				alert( '无法连接FTP服务器' );
		} 
		$matches[7] = trim( $matches[7] );
		if ( !$ftp -> ftp_chdir( dirname( $matches[7] ) ) ) {
				alert( '无法打开FTP服务器目录"/' . SAXUE_ATTACHS_DIR . '/"' );
		} 
		$root_path = SAXUE_ATTACHS_DIR . '/';
		// 目录名
		$dir_name = empty( $_GET['dir'] ) ? '' : trim( $_GET['dir'] );
		if ( !in_array( $dir_name, array( '', 'image', 'flash', 'media', 'file' ) ) ) {
				alert( 'Invalid Directory name.' );
		} 
		if ( $dir_name !== '' ) {
				$root_path .= $dir_name . '/';
				$root_url .= $dir_name . '/';
		} 
		// 根据path参数，设置各路径和URL
		if ( empty( $_GET['path'] ) ) {
				$current_path = $root_path;
				$current_url = $root_url;
				$current_dir_path = '';
				$moveup_dir_path = '';
		} else {
				$current_path = $root_path . $_GET['path'];
				$current_url = $root_url . $_GET['path'];
				$current_dir_path = $_GET['path'];
				$moveup_dir_path = preg_replace( '/(.*?)[^\/]+\/$/', '$1', $current_dir_path );
		} 
		$list = $ftp -> ftp_rawlist( $current_path );
		$ftp -> ftp_close();
		if ( !$list ) {
				alert( '附件目录/' . $current_path . '是空目录' );
		} 
		// 遍历目录取得文件信息
		$file_list = array();
		$i = 0;
		foreach( $list as $file ) {
				if ( ereg ( "([-d][rwxst-]+).* ([0-9]) ([a-zA-Z0-9]+).* ([a-zA-Z0-9]+).* ([0-9]*) ([a-zA-Z]+[0-9: ]*[0-9]) ( [0-9]{4}|[0-9]{2}:[0-9]{2}) (.+)", $file, $regs ) ) {
						$filename = mb_convert_encoding( $regs[8], "utf-8", "gb2312" );
						if ( $filename == '.' || $filename == '..' ) continue;
						$isdir = ( substr ( $regs[1], 0, 1 ) == "d" );
						if ( $isdir ) {
								$file_list[$i]['is_dir'] = true; //是否文件夹
								$file_list[$i]['has_file'] = true; //文件夹是否包含文件
								$file_list[$i]['filesize'] = 0; //文件大小
								$file_list[$i]['is_photo'] = false; //是否图片
								$file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
								$file_list[$i]['filename'] = $filename; //文件名，包含扩展名
								//文件最后修改时间
								if ( strlen( trim( $regs[7] ) ) == 4 ) {
										$file_list[$i]['datetime'] = date( 'Y-m-d', strtotime( $regs[6] . ' ' . trim( $regs[7] ) ) );
								} else {
										$file_list[$i]['datetime'] = date( 'Y-m-d H:i', strtotime( $regs[6] . ' ' . trim( $regs[7] ) ) );
								}
						} else {
								$file_list[$i]['is_dir'] = false;
								$file_list[$i]['has_file'] = false;
								$file_list[$i]['filesize'] = round( $regs[5] / 1024, 2 );
								$file_list[$i]['dir_path'] = '';
								$file_ext = strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );
								$file_list[$i]['is_photo'] = in_array( $file_ext, $ext_arr );
								$file_list[$i]['filetype'] = $file_ext;
								$file_list[$i]['filename'] = $filename;
								if ( strlen( trim( $regs[7] ) ) == 4 ) {
										$file_list[$i]['datetime'] = date( 'Y-m-d', strtotime( $regs[6] . ' ' . trim( $regs[7] ) ) );
								} else {
										$file_list[$i]['datetime'] = date( 'Y-m-d H:i', strtotime( $regs[6] . ' ' . trim( $regs[7] ) ) );
								}
						} 
				} 
				++$i;
		} 
} else {
		// 本地模式 
		$root_path = saxue_uploadpath();
		// 根目录路径，可以指定绝对路径，比如 /var/www/attached/
		$root_path .= '/';
		// 目录名
		$dir_name = empty( $_GET['dir'] ) ? '' : trim( $_GET['dir'] );
		if ( !in_array( $dir_name, array( '', 'image', 'flash', 'media', 'file' ) ) ) {
				alert( 'Invalid Directory name.' );
		} 
		if ( $dir_name !== '' ) {
				$root_path .= $dir_name . '/';
				$root_url .= $dir_name . '/';
				if ( !file_exists( $root_path ) ) {
						mkdir( $root_path );
				} 
		} 
		// 根据path参数，设置各路径和URL
		if ( empty( $_GET['path'] ) ) {
				$current_path = realpath( $root_path ) . '/';
				$current_url = $root_url;
				$current_dir_path = '';
				$moveup_dir_path = '';
		} else {
				$current_path = realpath( $root_path ) . '/' . $_GET['path'];
				$current_url = $root_url . $_GET['path'];
				$current_dir_path = $_GET['path'];
				$moveup_dir_path = preg_replace( '/(.*?)[^\/]+\/$/', '$1', $current_dir_path );
		} 
		// 不允许使用..移动到上一级目录
		if ( preg_match( '/\.\./', $current_path ) ) {
				alert( 'Access is not allowed.' );
		} 
		// 最后一个字符不是/
		if ( !preg_match( '/\/$/', $current_path ) ) {
				alert( 'Parameter is not valid.' );
		} 
		// 目录不存在或不是目录
		if ( !file_exists( $current_path ) || !is_dir( $current_path ) ) {
				alert( 'Directory does not exist.' );
		} 
		// 遍历目录取得文件信息
		$file_list = array();
		if ( $handle = opendir( $current_path ) ) {
				$i = 0;
				while ( false !== ( $filename = readdir( $handle ) ) ) {
						if ( $filename{0} == '.' ) continue;
						$file = $current_path . $filename;
						if ( is_dir( $file ) ) {
								$file_list[$i]['is_dir'] = true; //是否文件夹
								$file_list[$i]['has_file'] = ( count( scandir( $file ) ) > 2 ); //文件夹是否包含文件
								$file_list[$i]['filesize'] = 0; //文件大小
								$file_list[$i]['is_photo'] = false; //是否图片
								$file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
						} else {
								$file_list[$i]['is_dir'] = false;
								$file_list[$i]['has_file'] = false;
								$file_list[$i]['filesize'] = filesize( $file );
								$file_list[$i]['dir_path'] = '';
								$file_ext = strtolower( pathinfo( $file, PATHINFO_EXTENSION ) );
								$file_list[$i]['is_photo'] = in_array( $file_ext, $ext_arr );
								$file_list[$i]['filetype'] = $file_ext;
						} 
						$file_list[$i]['filename'] = $filename; //文件名，包含扩展名
						$file_list[$i]['datetime'] = date( 'Y-m-d H:i:s', filemtime( $file ) ); //文件最后修改时间
						$i++;
				} 
				closedir( $handle );
		} 
} 
usort( $file_list, 'cmp_func' );

$result = array();
// 相对于根目录的上一级目录
$result['moveup_dir_path'] = $moveup_dir_path;
// 相对于根目录的当前目录
$result['current_dir_path'] = $current_dir_path;
// 当前目录的URL
$result['current_url'] = $current_url;
// 文件数
$result['total_count'] = count( $file_list );
// 文件列表数组
$result['file_list'] = $file_list;
// 输出JSON字符串
header( 'Content-type: application/json; charset=UTF-8' );
$json = new Services_JSON();
echo $json -> encode( $result );

// 排序
function cmp_func( $a, $b ) {
		global $order;
		if ( $a['is_dir'] && !$b['is_dir'] ) {
				return -1;
		} else if ( !$a['is_dir'] && $b['is_dir'] ) {
				return 1;
		} else {
				if ( $order == 'size' ) {
						if ( $a['filesize'] > $b['filesize'] ) {
								return 1;
						} else if ( $a['filesize'] < $b['filesize'] ) {
								return -1;
						} else {
								return 0;
						} 
				} else if ( $order == 'type' ) {
						return strcmp( $a['filetype'], $b['filetype'] );
				} else {
						return strcmp( $a['filename'], $b['filename'] );
				} 
		} 
} 
function alert( $msg ) {
		header( 'Content-type: text/html; charset=UTF-8' );
		$json = new Services_JSON();
		echo $json -> encode( array( 'error' => 1, 'message' => $msg ) );
		exit;
} 