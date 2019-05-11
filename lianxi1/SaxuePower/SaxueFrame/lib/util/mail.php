<?php
class saxuemail extends saxueobject {
		var $to;
		var $subject;
		var $content;
		var $params = array ( "mailtype" => 1, "maildelimiter" => 1, "charset" => SAXUE_SYSTEM_CHARSET, "mailfrom" => SAXUE_URL );

		function saxuemail( $to, $subject, $content, $params = array() ) {
				if ( is_array( $to ) ) {
						$this -> to = $to;
				} else {
						$this -> to[] = $to;
				} 
				if ( is_array( $params ) ) {
						$this -> params = array_merge( $this -> params, $params );
				} 
				$this -> subject = $subject;
				$this -> content = $content;
		} 

		function setparam( $_set, $_value = "" ) {
				if ( is_array( $_set ) ) {
						$this -> params = array_merge( $this -> params, $_set );
				} else {
						$this -> params[$_set] = $_value;
				} 
		} 

		function sendmail() {
				$_maildelimiter = !empty( $this -> params['maildelimiter'] ) ? "\r\n" : "\n";
				$_subject = "=?" . $this -> params['charset'] . "?B?" . base64_encode( str_replace( array( "\r", "\n" ), "", $this -> subject ) ) . "?=";
				$_content = chunk_split( base64_encode( str_replace( array( "\n\r", "\r\n", "\r", "\n", "\r\n." ), array( "\r", "\n", "\n", "\r\n", " \r\n.." ), $this -> content ) ) );
				$_from = $this -> params['mailfrom'] == "" ? "=?" . $this -> params['charset'] . "?B?" . base64_encode( SAXUE_SITE_NAME ) . "?= <" . SAXUE_URL . ">" : preg_match( "/^(.+?) \\<(.+?)\\>\$/", $this -> params['mailfrom'], $_from_arr ) ? "=?" . $this -> params['charset'] . "?B?" . base64_encode( $_from_arr[1] ) . ( "?= <" . $_from_arr['2'] . ">" ) : $this -> params['mailfrom'];
				$_to = implode( ",", $this -> to );
				$_headers = "From: " . $_from . "{$_maildelimiter}X-Priority: 3{$_maildelimiter}X-Mailer: SaxueCMS{$_maildelimiter}MIME-Version: 1.0{$_maildelimiter}Content-type: text/html; charset=" . $this -> params['charset'] . "{$_maildelimiter}Content-Transfer-Encoding: base64{$_maildelimiter}";
				if ( $this -> params['mailtype'] == 1 && function_exists( "mail" ) ) {
						@mail( $_to, $_subject, $_content, $_headers );
				} else if ( $this -> params['mailtype'] == 2 ) {
						if ( !$jq = fsockopen( $this -> params['mailserver'], $this -> params['mailport'], $_errno, $_errstr, 30 ) ) {
								$this -> raiseerror( "(" . $this -> params['mailserver'] . ":" . $this -> params['mailport'] . ") CONNECT - Unable to connect to the SMTP server, please check your configs.", SAXUE_ERROR_RETURN );
						} 
						stream_set_blocking( $jq, true );
						$_lastmessage = fgets( $jq, 512 );
						if ( substr( $_lastmessage, 0, 3 ) != "220" ) {
								$this -> raiseerror( "(" . $this -> params['mailserver'] . ":" . $this -> params['mailport'] . ") CONNECT - " . $_lastmessage, SAXUE_ERROR_RETURN );
						} 
						fputs( $jq, ( $this -> params['mailauth'] ? "EHLO" : "HELO" ) . " SaxueCMS\r\n" );
						$_lastmessage = fgets( $jq, 512 );
						if ( substr( $_lastmessage, 0, 3 ) != 220 && substr( $_lastmessage, 0, 3 ) != 250 ) {
								$this -> raiseerror( "(" . $this -> params['mailserver'] . ":" . $this -> params['mailport'] . ") HELO/EHLO - " . $_lastmessage, SAXUE_ERROR_RETURN );
						} 
						while ( 1 ) {
								if ( substr( $_lastmessage, 3, 1 ) != '-' || empty( $_lastmessage ) ) break;
								$_lastmessage = fgets( $jq, 512 );
						} 
						if ( $this -> params['mailauth'] ) {
								fputs( $jq, "AUTH LOGIN\r\n" );
								$_lastmessage = fgets( $jq, 512 );
								if ( substr( $_lastmessage, 0, 3 ) != 334 ) {
										$this -> raiseerror( "(" . $this -> params['mailserver'] . ":" . $this -> params['mailport'] . ") AUTH LOGIN - " . $_lastmessage, SAXUE_ERROR_RETURN );
								} 
								fputs( $jq, base64_encode( $this -> params['mailuser'] ) . "\r\n" );
								$_lastmessage = fgets( $jq, 512 );
								if ( substr( $_lastmessage, 0, 3 ) != 334 ) {
										$this -> raiseerror( "(" . $this -> params['mailserver'] . ":" . $this -> params['mailport'] . ") USERNAME - " . $_lastmessage, SAXUE_ERROR_RETURN );
								} 
								fputs( $jq, base64_encode( $this -> params['mailpassword'] ) . "\r\n" );
								$_lastmessage = fgets( $jq, 512 );
								if ( substr( $_lastmessage, 0, 3 ) != 235 ) {
										$this -> raiseerror( "(" . $this -> params['mailserver'] . ":" . $this -> params['mailport'] . ") PASSWORD - " . $_lastmessage, SAXUE_ERROR_RETURN );
								} 
						} 
						fputs( $jq, "MAIL FROM: <" . preg_replace( "/.*\\<(.+?)\\>.*/", "\\1", $_from ) . ">\r\n" );
						$_lastmessage = fgets( $jq, 512 );
						if ( substr( $_lastmessage, 0, 3 ) != 250 ) {
								fputs( $jq, "MAIL FROM: <" . preg_replace( "/.*\\<(.+?)\\>.*/", "\\1", $_from ) . ">\r\n" );
								$_lastmessage = fgets( $jq, 512 );
								if ( substr( $_lastmessage, 0, 3 ) != 250 ) {
										$this -> raiseerror( "(" . $this -> params['mailserver'] . ":" . $this -> params['mailport'] . ") MAIL FROM - " . $_lastmessage, SAXUE_ERROR_RETURN );
								} 
						} 
						foreach ( explode( ",", $_to ) as $_to_user ) {
								$_to_user = trim( $_to_user );
								if ( $_to_user ) {
										fputs( $jq, "RCPT TO: <" . $_to_user . ">\r\n" );
										$_lastmessage = fgets( $jq, 512 );
										if ( substr( $_lastmessage, 0, 3 ) != 250 ) {
												fputs( $jq, "RCPT TO: <" . $_to_user . ">\r\n" );
												$_lastmessage = fgets( $jq, 512 );
												$this -> raiseerror( "(" . $this -> params['mailserver'] . ":" . $this -> params['mailport'] . ") RCPT TO - " . $_lastmessage, SAXUE_ERROR_RETURN );
										} 
								} 
						} 
						fputs( $jq, "DATA\r\n" );
						$_lastmessage = fgets( $jq, 512 );
						if ( substr( $_lastmessage, 0, 3 ) != 354 ) {
								$this -> raiseerror( "(" . $this -> params['mailserver'] . ":" . $this -> params['mailport'] . ") DATA - " . $_lastmessage, SAXUE_ERROR_RETURN );
						} 
						list( $_msec, $_sec ) = explode( ' ', microtime() );
						$headers .= "Message-ID: <" . date( 'YmdHis', $_sec ) . "." . ( $_msec * 1000000 ) . "." . substr( $_from, strpos( $_from, '@' ) ) . ">" . $_maildelimiter;
						fputs( $jq, "Date: " . date( 'r' ) . "\r\nTo: " . $_to . "\r\nSubject: {$_subject}\r\n{$_headers}\r\n{$_content}\r\n.\r\n" );
						fputs( $jq, "QUIT\r\n" );
				} else if ( $this -> params['mailtype'] == 3 ) {
						ini_set( "SMTP", $this -> params['mailserver'] );
						ini_set( "smtp_port", $this -> params['mailport'] );
						ini_set( "sendmail_from", $_from );
						@mail( $_to, $_subject, $_content, $_headers );
				} 
		} 
} 
