<?php
function saxue_visit_valid( $_id, $_tmpname, $_upvisit = true ) {
		if ( !is_numeric( $_id ) || intval( $_id ) <= 0 ) {
				return false;
		} 
		$_subvar = "";
		if ( isset( $_SESSION[$_tmpname] ) ) {
				$_visitids_sary = unserialize( $_SESSION[$_tmpname] );
		} else {
				$_visitids_sary = array();
		} 
		if ( !is_array( $_visitids_sary ) ) {
				$_visitids_sary = array();
		} 
		$_tmparr = array();
		$_visitids_cary = array();
		if ( isset( $_COOKIE['saxueVisitId'] ) ) {
				$_tmparr = saxue_strtosary( $_COOKIE['saxueVisitId'], "=", "," );
				if ( isset( $_tmparr[$_tmpname] ) ) {
						$_visitids_cary = explode( "|", $_tmparr[$_tmpname] );
				} 
		} 
		if ( !is_array( $_visitids_cary ) ) {
				$_visitids_cary = array();
		} 
		if ( in_array( $_id, $_visitids_sary ) || in_array( $_id, $_visitids_cary ) ) {
				return false;
		} 
		if ( $_upvisit ) {
				if ( !in_array( $_id, $_visitids_sary ) && isset( $_SESSION ) ) {
						$_visitids_sary[] = $_id;
						$GLOBALS['_SESSION'][$_tmpname] = serialize( $_visitids_sary );
				} 
				if ( !in_array( $_id, $_visitids_cary ) ) {
						$_visitids_cary[] = $_id;
						$_tmparr[$_tmpname] = implode( "|", $_visitids_cary );
						setcookie( "saxueVisitId", saxue_sarytostr( $_tmparr, "=", "," ), SAXUE_NOW_TIME + 3600, "/", SAXUE_COOKIE_DOMAIN, 0 );
				} 
		} 
		return true;
} 

function saxue_visit_ids( $_id, $_tmpname, $_visit_time = -1 ) {
		if ( !is_numeric( $_id ) || intval( $_id ) <= 0 ) {
				return false;
		} 
		if ( !preg_match( "/^\\w+\$/is", $_tmpname ) ) {
				return false;
		} 
		$_tmpname = strtolower( $_tmpname );
		$_ret = array();
		if ( SAXUE_ENABLE_CACHE ) {
				$_visit_cache = SAXUE_CACHE_PATH . "/cachevars/cachevisit/" . $_tmpname . ".php";
				saxue_checkdir( dirname( $_visit_cache ), true );
				if ( mt_rand( 1, 100 ) == 1 ) {
						$_visit_ary = @file( $_visit_cache );
						if ( $jq = @fopen( $_visit_cache, "w" ) ) {
								@fclose( $jq );
						} 
						$_visit_ary[] = 0 <= $_visit_time ? $_id . "|" . $_visit_time : $_id;
						foreach ( $_visit_ary as $_v ) {
								$_v = trim( $_v );
								$_tmparr = explode( "|", $_v );
								$_tmparr[0] = intval( $_tmparr[0] );
								if ( !empty( $_tmparr[0] ) ) {
										if ( key_exists( $_tmparr[0], $_ret ) ) {
												++$_ret[$_tmparr[0]]['visitnum'];
										} else {
												$_ret[$_tmparr[0]]['visitnum'] = 1;
										} 
										if ( isset( $_tmparr[1] ) ) {
												$_ret[$_tmparr[0]]['lastvisit'] = intval( $_tmparr[1] );
										} else {
												$_ret[$_tmparr[0]]['lastvisit'] = -1;
										} 
								} 
						} 
				} else if ( $jq = @fopen( $_visit_cache, "a" ) ) {
						@flock( $_fileopen, LOCK_EX );
						if ( 0 <= $_visit_time ) {
								@fwrite( $jq, $_id . "|" . $_visit_time . "\r\n" );
						} else {
								@fwrite( $jq, $_id . "\r\n" );
						} 
						@flock( $_fileopen, LOCK_UN );
						@fclose( $jq );
						@chmod( $_visit_cache, 511 );
				} 
		} else {
				$_ret[$_id] = array( "visitnum" => 1, "lastvisit" => $_visit_time );
		} 
		if ( empty( $_ret ) ) {
				return false;
		} 
		return $_ret;
} 

function saxue_visit_stat( $_id, $_tablename, $_fieldname, $_tablekey, $_enlarge = 1 ) {
		if ( saxue_visit_valid( $_id, $_tablename . "_" . $_fieldname ) ) {
				if ( $_ids = saxue_visit_ids( $_id, $_tablename . "_" . $_fieldname ) ) {
						global $query;
						if ( !is_a( $query, "saxuequeryhandler" ) ) {
								saxue_includedb();
								$query = saxuequeryhandler :: getinstance( "saxuequeryhandler" );
						} 
						foreach ( $_ids as $_k => $_v ) {
								$_v['visitnum'] = intval( $_v['visitnum'] * $_enlarge );
								$_sql = "UPDATE " . saxue_dbprefix( $_tablename ) . " SET " . $_fieldname . "=" . $_fieldname . "+" . $_v['visitnum'] . " WHERE " . $_tablekey . "=" . intval( $_k );
								$query -> execute( $_sql );
						} 
				} 
				return true;
		} 
		return false;
} 
