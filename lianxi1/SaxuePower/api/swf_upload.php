<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include_once( "../core.php" );
} 
if ( empty( $_SESSION['saxueAdminId'] ) ) exit( '<script>parent.' . $_POST['backFunction'] . '(0, "未登录！", ' . $_POST['PicPos'] . ');</script>' );

// 文件保存目录路径
$save_path = realpath( saxue_uploadpath() );

// FTP保存目录路径
if ( SAXUE_ATTACHS_PATH != '' && strpos( SAXUE_ATTACHS_PATH, "/" ) === false && strpos( SAXUE_ATTACHS_PATH, "\\" ) === false && SAXUE_ATTACHS_FTPURL != '' ) {
		$ftp_path = SAXUE_ATTACHS_FTPURL . '/' . SAXUE_ATTACHS_PATH;
} else {
		$ftp_path = '';
} 

// 图片保存子目录
$file_path = '/image/' . date( "ym" ) . '/';

// 检查目录
saxue_checkdir( $save_path . $file_path, true );

// 接收上传数据
if ( 'php' == $_POST['name'] ) {
		// PHP方式上传
		if ( empty( $_FILES['fileUploadInput']['name'] ) ) {
				exit( '<script>parent.' . $_POST['backFunction'] . '(0, "请选择要上传的图片！", ' . $_POST['PicPos'] . ');</script>' );
		} 
		if ( 0 < $_FILES['fileUploadInput']['error'] ) {
				exit( '<script>parent.' . $_POST['backFunction'] . '(0, "上传失败，可能是文件太大或者网络问题！", ' . $_POST['PicPos'] . ');</script>' );
		} 
		$image_postfix = strrchr( trim( strtolower( $_FILES['fileUploadInput']['name'] ) ), "." );
		if ( !eregi( "\\.(gif|jpg|jpeg|png|bmp)\$", $image_postfix ) ) {
				exit( '<script>parent.' . $_POST['backFunction'] . '(0, "对不起，您上传的文件不是有效的图片格式！", ' . $_POST['PicPos'] . ');</script>' );
				saxue_delfile( $_FILES['fileUploadInput']['tmp_name'] );
		} 
		$file_name = date( "dHis" ) . rand( 10000, 99999 ) . $image_postfix;
		$save_file = $save_path . $file_path . $file_name;
		@move_uploaded_file( $_FILES['fileUploadInput']['tmp_name'], $save_file );
		if ( !is_file( $save_file ) ) {
				exit( '<script>parent.' . $_POST['backFunction'] . '(0, "上传失败，可能您没有文件夹的写权限", ' . $_POST['PicPos'] . ');</script>' );
		} 
} else {
		// FLASH上传
		$file_name = 'n_' . date( "dHis" ) . rand( 10000, 99999 ) . '.jpg';
		$save_file = $save_path . $file_path . $file_name;
		$attstr = $GLOBALS['HTTP_RAW_POST_DATA'];
		if ( empty( $attstr ) ) $attstr = file_get_contents( 'php://input' );
		file_put_contents( $save_file, $attstr );
		if ( !is_file( $save_file ) ) {
				exit;
		} 
}
@chmod( $save_file, 511 );

// 开启FTP上传
if ( SAXUE_ATTACHS_FTP && !empty( $ftp_path ) ) {
		saxue_copyfile( $save_file, $ftp_path . $file_path . $file_name, 511, true );
}

// 返回结果
if ( 'php' == $_POST['name'] ) {
		exit( '<script>parent.' . $_POST['backFunction'] . '(1, "' . $file_path . $file_name . '", ' . $_POST['PicPos'] . ');</script>' );
} else {
		exit( $file_path . $file_name );
} 
