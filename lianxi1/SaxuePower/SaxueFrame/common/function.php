<?php
function saxue_sendmail( $to, $title, $content ) {
		global $saxueConfigs;
		if ( !isset( $saxueConfigs['system'] ) ) {
				saxue_getconfigs( "configs", "system" );
		} 
		if ( !isset( $saxueConfigs['system']['mailtype'] ) || $saxueConfigs['system']['mailtype'] == 0 ) {
				return array( 'flag' => 0, 'msg' => LANG_SENDMAIL_CLOSE );
		} 
		$params = array();
		if ( isset( $saxueConfigs['system']['mailtype'] ) ) {
				$params['mailtype'] = $saxueConfigs['system']['mailtype'];
		} 
		if ( isset( $saxueConfigs['system']['maildelimiter'] ) ) {
				$params['maildelimiter'] = $saxueConfigs['system']['maildelimiter'];
		} 
		if ( isset( $saxueConfigs['system']['mailfrom'] ) ) {
				$params['mailfrom'] = $saxueConfigs['system']['mailfrom'];
		} 
		if ( isset( $saxueConfigs['system']['mailserver'] ) ) {
				$params['mailserver'] = $saxueConfigs['system']['mailserver'];
		} 
		if ( isset( $saxueConfigs['system']['mailport'] ) ) {
				$params['mailport'] = $saxueConfigs['system']['mailport'];
		} 
		if ( isset( $saxueConfigs['system']['mailauth'] ) ) {
				$params['mailauth'] = $saxueConfigs['system']['mailauth'];
		} 
		if ( isset( $saxueConfigs['system']['mailuser'] ) ) {
				$params['mailuser'] = $saxueConfigs['system']['mailuser'];
		} 
		if ( isset( $saxueConfigs['system']['mailpassword'] ) ) {
				$params['mailpassword'] = $saxueConfigs['system']['mailpassword'];
		} 
		include_once( SAXUE_ROOT_PATH . "/lib/util/mail.php" );
		$saxuemail = new saxuemail( $to, $title, $content, $params );
		$saxuemail -> sendmail();
		if ( $saxuemail -> iserror( SAXUE_ERROR_RETURN ) ) {
				return array( 'flag' => 0, 'msg' => sprintf( LANG_SENDMAIL_FAILURE, implode( "<br />", $saxuemail -> geterrors( SAXUE_ERROR_RETURN ) ) ) );
		} else {
				return array( 'flag' => 1 );
		} 
} 

function saxue_crypt( $txt, $operation = 'DECODE' ) {
		$key = md5( SAXUE_URL );  
		$key_length = strlen( $key );
		$txt = $operation == 'DECODE' ? base64_decode( $txt ) : substr( md5( $txt . $key ), 0, 8 ) . $txt;
		$txt_length = strlen( $txt );
		$rndkey = $box = array();
		$result = '';
		for( $i = 0; $i <= 255; $i++ ) {
				$rndkey[$i] = ord( $key[$i % $key_length] );
				$box[$i] = $i;
		} 
		for( $j = $i = 0; $i < 256; $i++ ) {
				$j = ( $j + $box[$i] + $rndkey[$i] ) % 256;
				$tmp = $box[$i];
				$box[$i] = $box[$j];
				$box[$j] = $tmp;
		} 
		for( $a = $j = $i = 0; $i < $txt_length; $i++ ) {
				$a = ( $a + 1 ) % 256;
				$j = ( $j + $box[$a] ) % 256;
				$tmp = $box[$a];
				$box[$a] = $box[$j];
				$box[$j] = $tmp;
				$result .= chr( ord( $txt[$i] ) ^ ( $box[( $box[$a] + $box[$j] ) % 256] ) );
		} 
		if ( $operation == 'DECODE' ) {
				if ( substr( $result, 0, 8 ) == substr( md5( substr( $result, 8 ) . $key ), 0, 8 ) ) {
						return substr( $result, 8 );
				} else {
						return '';
				} 
		} else {
				return str_replace( '=', '', base64_encode( $result ) );
		} 
} 

function runquery( $sql ) {
		global $db_query;
		if ( !isset( $sql ) || empty( $sql ) ) return;
		if ( !is_object( $db_query ) ) {
				saxue_includedb();
				$db_query = saxuequeryhandler :: getinstance( 'saxuequeryhandler' );
		}
		if ( SAXUE_DB_PREFIX != 'saxue' ) {
				$sql = str_replace( ' saxue', ' ' . SAXUE_DB_PREFIX, $sql );
				$sql = str_replace( ' `saxue', ' `' . SAXUE_DB_PREFIX, $sql );
		} 
		$sql = str_replace( "\r", "\n", $sql );
		$ret = array();
		$num = 0;
		foreach( explode( ";\n", trim( $sql ) ) as $query ) {
				$ret[$num] = '';
				$queries = explode( "\n", trim( $query ) );
				foreach( $queries as $query ) {
						$ret[$num] .= ( isset( $query[0] ) && $query[0] == '#' ) || ( isset( $query[0] ) && isset( $query[1] ) && ( $query[0] . $query[1] == '--' || $query[0] . $query[1] == '/*' ) ) ? '' : $query;
				} 
				$num++;
		} 
		unset( $sql );
		foreach( $ret as $query ) {
				$query = trim( $query );
				if ( $query ) {
						$retflag = $db_query -> execute( $query );
						if ( !$retflag ) {
								saxue_printfail( sprintf( '<span class="span-blue">SQL执行失败：<br />%s</span><br /><span class="span-red">错误提示：<br />%s</span>', saxue_htmlstr( $query ), saxue_htmlstr( $db_query -> db -> error() ) ) );
						}
				} 
		} 
} 