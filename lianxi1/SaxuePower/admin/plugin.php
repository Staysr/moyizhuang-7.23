<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'plugin' );
define( 'CLOUDADDONS_WEBSITE_URL', 'http://addon.saxue.com' );
if ( !isset( $_REQUEST['action'] ) ) $_REQUEST['action'] = '';
include_once( SAXUE_ROOT_PATH . "/common/cache.php" );
include_once( SAXUE_ROOT_PATH . "/common/function.php" );
include_once( SAXUE_ROOT_PATH . "/model/plugin.php" );
$data_handler = &saxuepluginhandler :: getinstance( "saxuepluginhandler" );
$_plugindir = SAXUE_WEB_PATH . DIRECTORY_SEPARATOR . 'plugin';
switch ( $_REQUEST['action'] ) {
		// 模板安装
		case 'tempinstall' :
				$dir = $_GET['dir'];
				$cache_path = SAXUE_DATA_PATH . '/download/addon/' . $dir;
				if ( empty( $dir ) || !is_dir( $cache_path ) ) {
						saxue_printfail( '模板缓存目录不存在' );
				}
				// 导入模板设置
				if ( is_file( $cache_path . '/setting.txt' ) ) {
						$configs = saxue_readfile( $cache_path . '/setting.txt' );
						$configs = trim( preg_replace( "/(#.*\s+)*/", '', $configs ) );
						$configs = unserialize( base64_decode( $configs ) );
						if ( !is_array( $configs ) ) {
								saxue_delfolder( $cache_path );
								saxue_msgwin( '模板安装不完整', '模板文件已复制，但模板设置参数导入失败' );
						} 
						foreach ( $configs as $v ) {
								$sql = "INSERT INTO " . saxue_dbprefix( 'system_configs' ) . " SET gname='" . $v['gname'] . "', cname='" . $v['cname'] . "', ctitle='" . $v['ctitle'] . "', cvalue='" . $v['cvalue'] . "', cdescription='" . $v['cdescription'] . "', cdefine=" . $v['cdefine'] . ", ctype=" . $v['ctype'] . ", options='" . $v['options'] . "', catorder=" . $v['catorder'] . ", catname='" . $v['catname'] . "' ON DUPLICATE KEY UPDATE ctitle='" . $v['ctitle'] . "', cdescription='" . $v['cdescription'] . "', cdefine=" . $v['cdefine'] . ", ctype=" . $v['ctype'] . ", options='" . $v['options'] . "', catorder=" . $v['catorder'] . ", catname='" . $v['catname'] . "'";
								$data_handler -> execute( $sql );
						} 
				} 
				saxue_delfolder( $cache_path );
				if ( isset( $saxuePlugin['template'] ) ) {
						saxue_jumppage( '/plugin/template/styles.php?identifier=template&pmod=styles', '模板安装完成，请进入模版中心设置模版 ......', 1 );
				}
				saxue_jumppage( 'language.php', '模板安装完成，请手工设置模板目录和风格目录 ......', 1 );
		// 应用安装
		case 'install' :
				$dir = $_GET['dir'];
				if ( empty( $dir ) || !is_dir( $_plugindir . DIRECTORY_SEPARATOR . $dir ) ) {
						saxue_printfail( '插件目录不存在' );
				}
				$configfile = $_plugindir . DIRECTORY_SEPARATOR . $dir . '/config.php';
				$installfile = $_plugindir . DIRECTORY_SEPARATOR . $dir . '/install.php';
				$upgradefile = $_plugindir . DIRECTORY_SEPARATOR . $dir . '/upgrade.php';
				if ( !file_exists( $configfile ) ) {
						saxue_printfail( '插件配置文件不存在' );
				}
				include( $configfile );
				if ( 0 < $data_handler -> getcount( new criteria( 'identifier', $pluginConfigs['identifier'] ) ) ) {
						saxue_printfail( '您已安装过该插件' );
				}
				if ( file_exists( $installfile ) ) {
						@include $installfile;
				}
				$pluginConfigs['dir'] = $dir;
				if ( !empty( $pluginConfigs['menu'] ) && is_array( $pluginConfigs['menu'] ) ) {
						$pluginConfigs['menu'] = serialize( $pluginConfigs['menu'] );
				}
				$data = $data_handler -> create( true, $pluginConfigs );
				if ( !$data_handler -> insert( $data ) ) {
						saxue_printfail( '插件安装失败' );
				} 
				if ( file_exists( $installfile ) ) {
						saxue_delfile( $installfile );
				}
				if ( file_exists( $upgradefile ) ) {
						saxue_delfile( $upgradefile );
				}
				saxue_delfile( $configfile );
				cache_plugin();
				saxue_jumppage( 'plugin.php', '插件安装成功' );
				break;
		// 更新
		case 'update' :
				$identifier = trim( $_REQUEST['identifier'] );
				if ( !isset( $saxuePlugin[$identifier] ) ) {
						saxue_printfail( '插件不存在' );
				}
				$configfile = $_plugindir . DIRECTORY_SEPARATOR . $saxuePlugin[$identifier]['dir'] . '/config.php';
				$installfile = $_plugindir . DIRECTORY_SEPARATOR . $saxuePlugin[$identifier]['dir'] . '/install.php';
				$upgradefile = $_plugindir . DIRECTORY_SEPARATOR . $saxuePlugin[$identifier]['dir'] . '/upgrade.php';
				if ( !file_exists( $configfile ) ) {
						saxue_printfail( '插件配置文件不存在' );
				}
				include( $configfile );
				$upret = false;
				if ( isset( $pluginConfigs['releases'] ) && $saxuePlugin[$identifier]['releases'] < $pluginConfigs['releases'] ) {
						if ( file_exists( $upgradefile ) ) {
								@include $upgradefile;
						}
						if ( !empty( $pluginConfigs['menu'] ) && is_array( $pluginConfigs['menu'] ) ) {
								$pluginConfigs['menu'] = serialize( $pluginConfigs['menu'] );
						}
						$data_handler -> updatefields( $pluginConfigs, 'pluginid=' . $saxuePlugin[$identifier]['pluginid'] );
						$upret = true;
				}
				if ( file_exists( $installfile ) ) {
						saxue_delfile( $installfile );
				}
				if ( file_exists( $upgradefile ) ) {
						saxue_delfile( $upgradefile );
				}
				saxue_delfile( $configfile );
				cache_plugin();
				if ( $upret ) {
						saxue_jumppage( 'plugin.php', '插件已升级到最新版本 V' . $pluginConfigs['version'] . ' R' . $pluginConfigs['releases'] );
				} else {
						saxue_jumppage( 'plugin.php', '此插件已更新到最新版本' );
				}
				break;
		// 升级
		case 'upgrade' :
				$identifier = trim( $_REQUEST['identifier'] );
				$releases = intval( $_REQUEST['releases'] );
				if ( empty( $releases ) ) {
						$releases = intval( $saxuePlugin[$identifier]['releases'] );
				}
				include_once( SAXUE_ROOT_PATH . "/common/funaddon.php" );
				$url = CLOUDADDONS_WEBSITE_URL . '/getdownload.php?action=upgrade&key=' . $identifier . '&releases=' . $releases;
				$data = saxue_sockopen( $url, 999 );
				if ( empty( $data ) ) {
						saxue_printfail( '无法连接应用中心，请稍后再试' );
				}
				$data = json_decode( $data, TRUE );
				switch ( $data['flag'] ) {
						case 0 :
								saxue_printfail( $data['msg'] );
						case 1 :
								saxue_msgwin( '更新提示', $data['msg'] );
						case 2 :
								saxue_msgwin( '更新提示', '发现此插件最新版本 V' . $data['version'] . ' R' . $data['releases'] . '<br><br><a href="cloudaddons.php?id=' . $identifier . '">升级此插件</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="plugin.php">暂不升级</a>' );
				}
				break;
		// 卸载
		case 'uninstall' :
				$identifier = trim( $_REQUEST['identifier'] );
				if ( !isset( $saxuePlugin[$identifier] ) ) {
						saxue_printfail( '插件不存在' );
				}
				if ( $saxuePlugin[$identifier]['status'] ) {
						saxue_printfail( '请关闭插件后再卸载' );
				}
				$uninstallfile = $_plugindir . DIRECTORY_SEPARATOR . $saxuePlugin[$identifier]['dir'] . '/uninstall.php';
				if ( file_exists( $uninstallfile ) ) {
						@include $uninstallfile;
				}
				$data_handler -> delete( $saxuePlugin[$identifier]['pluginid'] );
				saxue_delfolder( $_plugindir . DIRECTORY_SEPARATOR . $saxuePlugin[$identifier]['dir'] );
				cache_plugin();
				saxue_jumppage( 'plugin.php', '插件卸载成功' );
				break;
		// 开启
		case 'open' :
				$identifier = trim( $_REQUEST['identifier'] );
				if ( !isset( $saxuePlugin[$identifier] ) ) {
						saxue_printfail( '插件不存在' );
				}
				$data_handler -> updatefields( 'status=1', 'pluginid=' . $saxuePlugin[$identifier]['pluginid'] );
				cache_plugin();
				saxue_jumppage( 'plugin.php', '插件已启用' );
				break;
		// 关闭
		case 'close' :
				$identifier = trim( $_REQUEST['identifier'] );
				if ( !isset( $saxuePlugin[$identifier] ) ) {
						saxue_printfail( '插件不存在' );
				}
				$data_handler -> updatefields( 'status=0', 'pluginid=' . $saxuePlugin[$identifier]['pluginid'] );
				cache_plugin();
				saxue_jumppage( 'plugin.php', '插件已关闭' );
				break;
		// 缓存
		case 'cache':
				cache_plugin();
				saxue_jumppage( 'plugin.php', '插件缓存更新完成' );
				break;
} 
$rows = $plugins = array();
foreach ( $saxuePlugin as $k => $v ) {
		$plugins[] = $v['dir'];
		if ( $v['status'] == 1 ) {
				$rows['open'][$k] = $v;
		} else {
				$rows['close'][$k] = $v;
		} 
}
$k = 0;
$_handle = @opendir( $_plugindir );
while ( $_file = @readdir( $_handle ) ) {
		if ( $_file != "." && $_file != ".." && is_dir( $_plugindir . DIRECTORY_SEPARATOR . $_file ) && !in_array( $_file, $plugins ) ) {
				if ( is_file( $_plugindir . DIRECTORY_SEPARATOR . $_file . '/config.php' ) ) {
						include( $_plugindir . DIRECTORY_SEPARATOR . $_file . '/config.php' );
						$rows['uninstall'][$k] = $pluginConfigs;
						$rows['uninstall'][$k]['dir'] = $_file;
						$rows['uninstall'][$k]['path'] = '/plugin/' . $rows['uninstall'][$k]['dir'];
						++$k;
				}
		} 
} 
@closedir( $_handle );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$saxueTpl -> assign( "rows", $rows );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/plugin.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
