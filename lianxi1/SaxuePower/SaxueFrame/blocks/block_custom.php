<?php
class blocksystemcustom extends saxueblock {
		function updatecontent( $isreturn = false ) {
				$ret = "";
				include_once( SAXUE_ROOT_PATH . "/model/system_blocks.php" );
				$blocks_handler = &saxuesystemblockshandler :: getinstance( "saxuesystemblockshandler" );
				if ( !empty( $this -> blockvars['bid'] ) ) {
						$block = $blocks_handler -> get( $this -> blockvars['bid'] );
						if ( is_object( $block ) ) {
								switch ( $block -> getvar( "contenttype" ) ) {
										case SAXUE_CONTENT_TXT :
												$ret = $block -> getvar( "content", "s" );
												break;
										case SAXUE_CONTENT_HTML :
												$ret = $block -> getvar( "content", "n" );
												break;
										case SAXUE_CONTENT_JS :
												$ret = "<script language=\"javascript\" type=\"text/javascript\">" . $block -> getvar( "content", "n" ) . "</script>";
												break;
										case SAXUE_CONTENT_MIX :
												$ret = $block -> getvar( "content", "n" );
												break;
										case SAXUE_CONTENT_PHP :
								} 
								$blocks_handler -> savecontent( $block -> getvar( "bid" ), $block -> getvar( "contenttype" ), $ret );
						} else {
								$ret = "block not exists! (id:" . $this -> blockvars['bid'] . ")";
						} 
				} else if ( !empty( $this -> blockvars['filename'] ) && preg_match( "/^\\w+\$/", $this -> blockvars['filename'] ) ) {
						$blockpath = SAXUE_THEME_PATH . "/blocks/" . $this -> blockvars['filename'] . ".html";
						$ret = saxue_readfile( $blockpath );
						$blocks_handler -> savecontent( $this -> blockvars['filename'], SAXUE_CONTENT_HTML, $ret );
				} else {
						$ret = "empty block id!";
				} 
				if ( $isreturn ) {
						return $ret;
				} 
		} 
} 
