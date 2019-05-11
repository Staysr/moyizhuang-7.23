<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'blocks' );
saxue_loadlang( "blocks" );
if ( empty( $_REQUEST['id'] ) ) {
		saxue_printfail( $saxueLang['blocks']['block_not_exists'] );
} 
include_once( SAXUE_ROOT_PATH . "/model/system_blocks.php" );
$blocks_handler = &saxuesystemblockshandler :: getinstance( "saxuesystemblockshandler" );
$block = $blocks_handler -> get( $_REQUEST['id'] );
if ( !is_object( $block ) ) {
		saxue_printfail( $saxueLang['blocks']['block_not_exists'] );
} 
include_once( SAXUE_ADMIN_PATH . "/header.php" );
include_once( SAXUE_ROOT_PATH . "/lib/form/formloader.php" );
if ( $block -> getvar( "custom" ) == 1 ) {
		$blocks_form = new saxuethemeform( $saxueLang['blocks']['edit_custom_block'], "blockedit", SAXUE_ADMIN_URL . "/blocks.php" );
		$blocks_form -> addelement( new saxueformtext( $saxueLang['blocks']['table_blocks_blockname'], "blockname", 30, 50, $block -> getvar( "blockname", "e" ) ), true );
} else {
		$blocks_form = new saxuethemeform( $saxueLang['blocks']['edit_system_block'], "blockedit", SAXUE_ADMIN_URL . "/blocks.php" );
		$blockfile = $block -> getvar( "filename" ) . ".php";
		$blocks_form -> addelement( new saxueformlabel( $saxueLang['blocks']['table_blocks_filename'], $blockfile ) );
		$blocks_form -> addelement( new saxueformtext( $saxueLang['blocks']['table_blocks_blockname'], "blockname", 30, 50, $block -> getvar( "blockname", "e" ) ), true );
} 
//$blocks_form -> addelement( new saxueformtextarea( $saxueLang['blocks']['table_blocks_title'], "title", $block -> getvar( "title", "e" ), 3, 60 ) );
if ( $block -> getvar( "custom" ) == 1 ) {
		//$blocks_form -> addelement( new saxueformlabel( $saxueLang['blocks']['table_blocks_contenttype'], "HTML" ) );
} else {
		$tmpary = $blocks_handler -> getcontentary();
		if ( isset( $tmpary[$block -> getvar( "contenttype" )] ) ) {
				$blocks_form -> addelement( new saxueformlabel( $saxueLang['blocks']['table_blocks_contenttype'], $tmpary[$block -> getvar( "contenttype" )] ) );
		} else {
				$blocks_form -> addelement( new saxueformlabel( $saxueLang['blocks']['table_blocks_contenttype'], LANG_UNKNOWN ) );
		} 
} 
if ( $block -> getvar( "canedit" ) == 1 ) {
		$blocks_form -> addelement( new saxueformtextarea( $saxueLang['blocks']['table_blocks_content'], "content", $block -> getvar( "content", "e" ), 10, 60 ) );
} else {
		$blockdesc = trim( $block -> getvar( "description", "n" ) );
		if ( !empty( $blockdesc ) ) {
				$blocks_form -> addelement( new saxueformlabel( $saxueLang['blocks']['table_blocks_description'], $blockdesc ) );
		} 
} 
if ( $block -> getvar( "hasvars" ) ) {
		$blocks_form -> addelement( new saxueformtextarea( $saxueLang['blocks']['table_blocks_blockvars'], "blockvars", $block -> getvar( "vars", "e" ), 3, 60 ) );
		$blocks_form -> addelement( new saxueformtext( $saxueLang['blocks']['block_template_file'], "blocktemplate", 30, 50, $block -> getvar( "template", "e" ) ) );
		$saveradio = new saxueformradio( $saxueLang['blocks']['block_save_type'], "savetype", 0 );
		$saveradio -> addoptionarray( array( "0" => $saxueLang['blocks']['block_save_self'], "1" => $saxueLang['blocks']['block_save_another'] ) );
		$blocks_form -> addelement( $saveradio );
		if ( $block -> getvar( "hasvars" ) == 2 ) {
				$blocks_form -> addelement( new saxueformhidden( "cacheupdate", "1" ) );
		} 
} 
$blocks_form -> addelement( new saxueformhidden( "action", "update" ) );
$blocks_form -> addelement( new saxueformhidden( "id", $block -> getvar( "bid" ) ) );
$blocks_form -> addelement( new saxueformbutton( "&nbsp;", "submit", $saxueLang['blocks']['save_block'], "submit" ) );
$saxueTpl -> assign( "saxue_contents", $blocks_form -> render(  ) . "<br />" );
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
