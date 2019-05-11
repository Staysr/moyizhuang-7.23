<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'dboptimize' );
if ( empty( $_SESSION['saxueDbLogin'] ) ) {
		header( "Location: " . SAXUE_ADMIN_URL . "/dblogin.php?jumpurl=".urlencode( saxue_addurlvars( array( ) ) ) );
		exit( );
}
@set_time_limit( 3600 );
@session_write_close();
saxue_loadlang( "database", SAXUE_MODULE_NAME );
saxue_includedb();
$db_query = saxuequeryhandler :: getinstance( "SaxueQueryHandler" );
include_once( SAXUE_ADMIN_PATH . "/header.php" );
if ( $_POST['action'] == "optimize" || $_POST['action'] == "repair" ) {
		if ( empty( $_POST['checkid'] ) ) {
				saxue_printfail( $saxueLang['database']['need_select_table'], 0 );
		} 
		$sql = "SHOW TABLE STATUS LIKE '" . SAXUE_DB_PREFIX . "%'";
		$res = $db_query -> execute( $sql );
		$alltables = array();
		while ( $row = $db_query -> getrow( $res ) ) {
				$alltables[] = $row['Name'];
		} 
		$doaction = "";
		foreach ( $GLOBALS['_POST']['checkid'] as $v ) {
				if ( in_array( $v, $alltables ) ) {
						if ( $_POST['action'] == "optimize" ) {
								$db_query -> execute( "OPTIMIZE TABLE " . $v );
								$doaction = $saxueLang['database']['optimize_table_action'];
								echo "<br>OPTIMIZE TABLE " . $v;
						} else {
								$db_query -> execute( "REPAIR TABLE " . $v );
								$doaction = $saxueLang['database']['repair_table_action'];
								echo "<br>REPAIR TABLE " . $v;
						} 
				} 
		} 
		if ( !empty( $doaction ) ) {
				saxue_jumppage( SAXUE_ADMIN_URL . "/dboptimize.php", sprintf( $saxueLang['database']['optrep_table_success'], $doaction ) );
		} else {
				saxue_printfail( sprintf( $saxueLang['database']['optrep_table_success'], $doaction ), 0 );
		} 
} else {
		$sql = "SHOW TABLE STATUS LIKE '" . SAXUE_DB_PREFIX . "%'";
		$res = $db_query -> execute( $sql );
		$tablerows = array();
		$k = 0;
		$totaltable = 0;
		$totalsize = 0;
		$totalrows = 0;
		$totalindex = 0;
		$totalfree = 0;
		while ( $row = $db_query -> getrow( $res ) ) {
				$tablerows[$k] = saxue_funtoarray( "saxue_htmlstr", $row );
				$tablerows[$k]['checkbox'] = "<input type=\"checkbox\" id=\"checkid[]\" name=\"checkid[]\" value=\"" . saxue_htmlstr( $row['Name'] ) . "\">";
				++$totaltable;
				$totalrows += $row['Rows'];
				$totalsize += $row['Data_length'];
				$totalindex += $row['Index_length'];
				$totalfree += $row['Data_free'];
				++$k;
		} 
		$saxueTpl -> assign( "checkall", "<input type=\"checkbox\" id=\"checkall\" name=\"checkall\" value=\"checkall\" onclick=\"javascript: for (var i=0;i<this.form.elements.length;i++){ if (this.form.elements[i].type == 'checkbox' && this.form.elements[i].name != 'checkkall') this.form.elements[i].checked = form.checkall.checked; }\">" );
		$saxueTpl -> assign_by_ref( "tablerows", $tablerows );
		if ( $totalsize ) {
				$saxueTpl -> assign( "totaltable", $totaltable );
		} 
		$saxueTpl -> assign( "totalrows", $totalrows );
		if ( 1048576 < $totalsize ) {
				$totalsize = sprintf( "%0.1fM", $totalsize / 1048576 );
		} else if ( 1024 < $totalsize ) {
				$totalsize = sprintf( "%0.1fK", $totalsize / 1024 );
		} 
		$saxueTpl -> assign( "totalsize", $totalsize );
		if ( 1048576 < $totalindex ) {
				$totalindex = sprintf( "%0.1fM", $totalindex / 1048576 );
		} else if ( 1024 < $totalindex ) {
				$totalindex = sprintf( "%0.1fK", $totalindex / 1024 );
		} 
		$saxueTpl -> assign( "totalindex", $totalindex );
		if ( 1048576 < $totalfree ) {
				$totalfree = sprintf( "%0.1fM", $totalfree / 1048576 );
		} else if ( 1024 < $totalfree ) {
				$totalfree = sprintf( "%0.1fK", $totalfree / 1024 );
		} 
		$saxueTpl -> assign( "totalfree", $totalfree );
		if ( $_REQUEST['option'] != "repair" ) {
				$GLOBALS['_REQUEST']['option'] = "optimize";
		} 
		$saxueTpl -> assign( "option", $_REQUEST['option'] );
		$saxueTpl -> setcaching( 0 );
		$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/dboptimize.html";
} 
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
