<?php
if ( !defined( "SAXUE_CORE_INCLUDE" ) ) {
		include "../core.php";
} 
saxue_checkpower( 'blocks' );
saxue_loadlang( "blocks" );
include_once( SAXUE_ROOT_PATH . "/model/system_blocks.php" );
$blocks_handler = &saxuesystemblockshandler :: getinstance( "saxuesystemblockshandler" );
if ( isset( $_REQUEST['action'] ) ) {
		switch ( $_REQUEST['action'] ) {
				case "new" :
						$GLOBALS['_POST']['blockname'] = trim( $_POST['blockname'] );
						$errtext = "";
						if ( strlen( $_POST['blockname'] ) == 0 ) {
								$errtext .= $saxueLang['blocks']['need_block_name'] . "<br />";
						} 
						if ( empty( $errtext ) ) {
								$newblock = $blocks_handler -> create();
								$newblock -> setvar( "blockname", $_POST['blockname'] );
								$newblock -> setvar( "filename", "" );
								$newblock -> setvar( "classname", "BlockSystemCustom" );
								$newblock -> setvar( "title", $_POST['title'] );
								$newblock -> setvar( "description", "" );
								$newblock -> setvar( "content", $_POST['content'] );
								$newblock -> setvar( "vars", "" );
								$newblock -> setvar( "template", "" );
								$newblock -> setvar( "cachetime", 0 );
								$newblock -> setvar( "contenttype", SAXUE_CONTENT_HTML );
								$newblock -> setvar( "custom", 1 );
								$newblock -> setvar( "canedit", 1 );
								$newblock -> setvar( "hasvars", 0 );
								if ( !$blocks_handler -> insert( $newblock ) ) {
										saxue_printfail( $saxueLang['blocks']['block_add_failure'] );
								} 
								$blocks_handler -> savecontent( $newblock -> getvar( "bid" ), SAXUE_CONTENT_HTML, $_POST['content'] );
						} else {
								saxue_printfail( $errtext );
						} 
						break;
				case "update" :
						if ( empty( $_REQUEST['id'] ) ) {
								saxue_printfail( $saxueLang['blocks']['block_not_exists'] );
						} 
						$block = $blocks_handler -> get( $_REQUEST['id'] );
						if ( is_object( $block ) ) {
								$block -> setvar( "title", $_POST['title'] );
								$stype = 0;
								$GLOBALS['_POST']['blockname'] = trim( $_POST['blockname'] );
								if ( !empty( $_POST['blockname'] ) ) {
										$block -> setvar( "blockname", $_POST['blockname'] );
								} 
								if ( $block -> getvar( "custom" ) == 1 ) {
										$block -> setvar( "contenttype", SAXUE_CONTENT_HTML );
								} 
								if ( $block -> getvar( "canedit" ) == 1 ) {
										$block -> setvar( "content", $_POST['content'] );
								} 
								if ( 0 < $block -> getvar( "hasvars" ) ) {
										$block -> setvar( "vars", trim( $_POST['blockvars'] ) );
										$block -> setvar( "template", trim( $_POST['blocktemplate'] ) );
										if ( $_POST['savetype'] == 1 ) {
												$block -> setnew();
												$block -> setvar( "bid", 0 );
										} 
								} 
								if ( !$blocks_handler -> insert( $block ) ) {
										saxue_printfail( $saxueLang['blocks']['block_edit_failure'] );
								} 
								if ( $block -> getvar( "custom" ) == 1 ) {
										$blocks_handler -> savecontent( $block -> getvar( "bid" ), SAXUE_CONTENT_HTML, $_POST['content'] );
								} 
								if ( $_POST['cacheupdate'] == 1 ) {
										$modname = $block -> getvar( "modname", "n" );
										include( SAXUE_ROOT_PATH . "/blocks/" . $block -> getvar( "filename", "n" ) . ".php" );
										$classname = $block -> getvar( "classname", "n" );
										include_once( SAXUE_ROOT_PATH . "/lib/template/template.php" );
										$saxueTpl = &saxuetpl :: getinstance();
										$vars = array( "bid" => $block -> getvar( "bid" ),
												"blockname" => $block -> getvar( "blockname" ),
												"filename" => $block -> getvar( "filename", "n" ),
												"classname" => $block -> getvar( "classname", "n" ),
												"title" => $block -> getvar( "title", "n" ),
												"vars" => $block -> getvar( "vars", "n" ),
												"template" => $block -> getvar( "template", "n" ),
												"contenttype" => $block -> getvar( "contenttype", "n" ),
												"custom" => $block -> getvar( "custom", "n" ),
												"hasvars" => $block -> getvar( "hasvars", "n" ) 
												);
										$cblock = new $classname( $vars );
										$cblock -> updatecontent();
										unset( $saxueTpl );
										unset( $cblock );
										unset( $vars );
								} 
						} else {
								saxue_printfail( $saxueLang['blocks']['block_not_exists'] );
						} 
						break;
				case "delete" :
						if ( isset( $_REQUEST['id'] ) ) {
								$block = $blocks_handler -> get( $_REQUEST['id'] );
								if ( is_object( $block ) ) {
										if ( $block -> getvar( "custom" ) == 1 ) {
												$blocks_handler -> delete( $_REQUEST['id'] );
										} else if ( 0 < $block -> getvar( "hasvars" ) ) {
												if ( 1 < $blocks_handler -> getcount( new criteria( "classname", $block -> getvar( "classname", "n" ) ) ) ) {
														$blocks_handler -> delete( $_REQUEST['id'] );
												} else {
														saxue_printfail( $saxueLang['blocks']['block_less_one'] );
												} 
												unset( $criteria );
										} 
								} 
						} 
		} 
} 
include_once( SAXUE_ADMIN_PATH . "/header.php" );
$criteria = new criteriacompo();
$criteria -> setsort( "bid" );
$criteria -> setorder( "DESC" );
$blocks_handler -> queryobjects( $criteria );
$blockary = array();
$k = 0;
if ( SAXUE_URL == "" ) {
		$site_url = "http://" . $_SERVER['HTTP_HOST'];
} else {
		$site_url = SAXUE_URL;
}
while ( $v = $blocks_handler -> getobject() ) {
		$blockary[$k]['bid'] = $v -> getvar( "bid" );
		$blockary[$k]['blockname'] = $v -> getvar( "blockname" );
		$blockary[$k]['contenttype'] = $blocks_handler -> getcontenttype( $v -> getvar( "contenttype", "n" ) );
		$blockary[$k]['action'] = "<a href=\"" . SAXUE_ADMIN_URL . "/blockedit.php?id=" . $v -> getvar( "bid" ) . "\" target=\"_self\">" . $saxueLang['blocks']['block_action_edit'] . "</a>";
		if ( $v -> getvar( "custom" ) == 1 ) {
				$blockary[$k]['action'] .= "&nbsp;<a href=\"javascript:if(confirm('" . $saxueLang['blocks']['block_delete_cofirm'] . "')) document.location='" . SAXUE_ADMIN_URL . "/blocks.php?action=delete&id=" . $v -> getvar( "bid" ) . "';\" target=\"_self\"><font color='red'>" . $saxueLang['blocks']['block_action_delete'] . "</font></a>";
		} else {
				$blockary[$k]['action'] .= "&nbsp;<a href=\"" . SAXUE_ADMIN_URL . "/blockupdate.php?id=" . $v -> getvar( "bid" ) . "\" target=\"_blank\">" . $saxueLang['blocks']['block_action_refresh'] . "</a>";
				if ( $v -> getvar( "hasvars" ) ) {
						$blockary[$k]['action'] .= "&nbsp;<a href=\"javascript:if(confirm('" . $saxueLang['blocks']['block_delete_cofirm'] . "')) document.location='" . SAXUE_ADMIN_URL . "/blocks.php?action=delete&id=" . $v -> getvar( "bid" ) . "';\" target=\"_self\"><font color='red'>" . $saxueLang['blocks']['block_action_delete'] . "</font></a>";
				} 
		} 
		$blockary[$k]['configtext'] = htmlspecialchars( "\$saxueBlocks[]=array('bid'=>" . $v -> getvar( "bid" ) . ", 'blockname'=>'" . $v -> getvar( "blockname" ) . "', 'module'=>'" . $v -> getvar( "modname", "n" ) . "', 'filename'=>'" . $v -> getvar( "filename", "n" ) . "', 'classname'=>'" . $v -> getvar( "classname", "n" ) . "', 'title'=>'" . $v -> getvar( "title", "n" ) . "', 'vars'=>'" . $v -> getvar( "vars", "n" ) . "', 'template'=>'" . $v -> getvar( "template", "n" ) . "', 'contenttype'=>" . $v -> getvar( "contenttype", "n" ) . ", 'custom'=>" . $v -> getvar( "custom", "n" ) . ", 'publish'=>" . $v -> getvar( "publish", "n" ) . ", 'hasvars'=>" . $v -> getvar( "hasvars", "n" ) . ");" );
		$blockary[$k]['temptext'] = '{?block classname="' . $v -> getvar( "classname", "n" ) . '" bid="' . $v -> getvar( "bid" ) . '"?}';
		$blockary[$k]['jstext'] = htmlspecialchars( "<script language=\"javascript\" type=\"text/javascript\" src=\"" . $site_url . "/api/blockshow.php?bid=" . urlencode( $v -> getvar( "bid" ) ) . "&filename=" . urlencode( $v -> getvar( "filename", "n" ) ) . "&classname=" . urlencode( $v -> getvar( "classname", "n" ) ) . "&vars=" . urlencode( $v -> getvar( "vars", "n" ) ) . "&template=" . urlencode( $v -> getvar( "template", "n" ) ) . "&contenttype=" . urlencode( $v -> getvar( "contenttype", "n" ) ) . "&custom=" . $v -> getvar( "custom", "n" ) . "&hasvars=" . urlencode( $v -> getvar( "hasvars", "n" ) ) . "\"></script>" );
		++$k;
} 
$saxueTpl -> assign_by_ref( "blocks", $blockary );
include_once( SAXUE_ROOT_PATH . "/lib/form/formloader.php" );
$blocks_form = new saxuethemeform( $saxueLang['blocks']['add_custom_block'], "blocksnew", SAXUE_ADMIN_URL . "/blocks.php" );
$blocks_form -> addelement( new saxueformtext( $saxueLang['blocks']['table_blocks_blockname'], "blockname", 30, 50, "" ), true );
//$blocks_form -> addelement( new saxueformtextarea( $saxueLang['blocks']['table_blocks_title'] . "(HTML)", "title", "", 3, 60 ) );
$blocks_form -> addelement( new saxueformtextarea( $saxueLang['blocks']['table_blocks_content'] . "(HTML格式)", "content", "", 10, 60 ) );
$blocks_form -> addelement( new saxueformhidden( "action", "new" ) );
$blocks_form -> addelement( new saxueformbutton( "&nbsp;", "submit", $saxueLang['blocks']['add_block'], "submit" ) );
$saxueTpl -> assign( "form_addblock", "<br />" . $blocks_form -> render(  ) . "<br />" );
$saxueTpl -> setcaching( 0 );
$saxueTset['saxue_contents_template'] = SAXUE_ROOT_PATH . "/templates/admin/blocks.html";
include_once( SAXUE_ADMIN_PATH . "/footer.php" );
