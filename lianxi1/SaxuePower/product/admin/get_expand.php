<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../../core.php";
} 
saxue_checkpower( 'content' );

$lang = trim( $_GET['lang'] );
$catid = intval( $_GET['catid'] );
$expands = '';
saxue_getconfigs( 'expand', 'content' );
foreach ( $saxueExpand as $v ) {
		if ( $lang == $v['lang'] && ( empty( $v['catid'] ) || $catid == $v['catid'] ) ) $expands .= '<option value="' . $v['name'] . '">' . $v['name'] . '</option>';
}
exit( json_encode( array( 'expands' => $expands ) ) );