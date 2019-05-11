<?php
class saxueftp extends saxueobject {
		var $_host;
		var $_port = 21;
		var $_user;
		var $_pass;
		var $_path = ".";
		var $_ssl = 0;
		var $_timeout = 0;
		var $_pasv = 1;
		var $connid;

		function wipespecial( $_str ) {
				return str_replace( array( "\n", "\r" ), "", $_str );
		} 

		function saxueftp( $_ftphost = "", $_ftpuser = "", $_ftppass = "", $_ftppath = ".", $_ftpport = 21, $_timeout = 0, $_ftpssl = 0, $_ftppasv = 1 ) {
				$this -> _host = $this -> wipespecial( $_ftphost );
				$this -> _user = $_ftpuser;
				$this -> _pass = $_ftppass;
				$this -> _port = intval( $_ftpport );
				$this -> _timeout = intval( $_timeout );
				$this -> _ssl = intval( $_ftpssl );
				$this -> _pasv = intval( $_ftppasv );
				$this -> _path = $_ftppath;
		} 

		function &retinstance() {
				static $instance = array();
				return $instance;
		} 

		function close( $_ftp = null ) {
				if ( is_object( $_ftp ) ) {
						$_ftp -> ftp_close();
				} else {
						$_instance = &saxueftp :: retinstance();
						if ( !empty( $_instance ) ) {
								foreach ( $_instance as $_ftp ) {
										$_ftp -> ftp_close();
								} 
						} 
				} 
		} 

		function &getinstance( $_ftphost = "", $_ftpuser = "", $_ftppass = "", $_ftppath = ".", $_ftpport = 21, $_timeout = 0, $_ftpssl = 0, $_ftppasv = 1 ) {
				$_instance = &saxueftp :: retinstance();
				$_sign = md5( $_ftphost . "," . $_ftpuser . "," . $_ftppass . "," . $_ftppath . "," . $_ftpport . "," . $_timeout . "," . $_ftpssl . "," . $_ftppasv );
				if ( !isset( $_instance[$_sign] ) ) {
						$_instance[$_sign] = new saxueftp( $_ftphost, $_ftpuser, $_ftppass, $_ftppath, $_ftpport, $_timeout, $_ftpssl, $_ftppasv );
						$_ftpstatus = $_instance[$_sign] -> ftp_connect();
						if ( $_ftpstatus !== 1 ) {
								return false;
						} 
				} 
				return $_instance[$_sign];
		} 

		function ftp_connect() {
				$_function = $this -> _ssl && function_exists( "ftp_ssl_connect" ) ? "ftp_ssl_connect" : "ftp_connect";
				if ( $_function == "ftp_connect" && !function_exists( "ftp_connect" ) ) {
						$this -> raiseerror( "FTP not supported", SAXUE_ERROR_RETURN );
						return -4;
				} 
				if ( $this -> connid = @$_function( $this -> _host, $this -> _port, 20 ) ) {
						if ( $this -> _timeout && function_exists( "ftp_set_option" ) ) {
								@ftp_set_option( $this -> connid, FTP_TIMEOUT_SEC, $this -> _timeout );
						} 
						if ( $this -> ftp_login( $this -> _user, $this -> _pass ) ) {
								if ( $this -> _pasv ) {
										$this -> ftp_pasv( true );
								} 
								if ( $this -> ftp_chdir( $this -> _path ) ) {
										if ( !defined( "SAXUE_FTP_CONNECTED" ) ) {
												@define( "SAXUE_FTP_CONNECTED", true );
										} 
										return 1;
								} 
								$this -> ftp_close();
								$this -> raiseerror( "Chdir " . $this -> _path . " error", SAXUE_ERROR_RETURN );
								return -3;
						} 
						$this -> ftp_close();
						$this -> raiseerror( "FTP login failure", SAXUE_ERROR_RETURN );
						return -2;
				} 
				$this -> raiseerror( "Couldn't connect to " . $this -> _host . ":" . $this -> _port, SAXUE_ERROR_RETURN );
				return -2;
		} 

		function ftp_mkdir( $_remotedir ) {
				$_remotedir = $this -> wipespecial( $_remotedir );
				return ftp_mkdir( $this -> connid, $_remotedir );
		} 

		function ftp_rmdir( $_remotedir ) {
				$_remotedir = $this -> wipespecial( $_remotedir );
				return ftp_rmdir( $this -> connid, $_remotedir );
		} 

		function ftp_put( $_remotefile, $_localfile, $_mode = FTP_BINARY, $_resume = 0 ) {
				$_remotefile = $this -> wipespecial( $_remotefile );
				$_localfile = $this -> wipespecial( $_localfile );
				$_mode = intval( $_mode );
				$_resume = intval( $_resume );
				return ftp_put( $this -> connid, $_remotefile, $_localfile, $_mode, $_resume );
		} 

		function ftp_size( $_remotefile ) {
				$_remotefile = $this -> wipespecial( $_remotefile );
				return ftp_size( $this -> connid, $_remotefile );
		} 

		function ftp_close() {
				return ftp_close( $this -> connid );
		} 

		function ftp_delete( $_path ) {
				$_path = $this -> wipespecial( $_path );
				return ftp_delete( $this -> connid, $_path );
		} 

		function ftp_get( $_localfile, $_remotefile, $_mode = FTP_BINARY, $_resume = 0 ) {
				$_remotefile = $this -> wipespecial( $_remotefile );
				$_localfile = $this -> wipespecial( $_localfile );
				$_mode = intval( $_mode );
				$_resume = intval( $_resume );
				return ftp_get( $this -> connid, $_localfile, $_remotefile, $_mode, $_resume );
		} 

		function ftp_login( $_ftpusername, $_ftppassword ) {
				$_ftpusername = $this -> wipespecial( $_ftpusername );
				$_ftppassword = str_replace( array( "\n", "\r" ), array( "", "" ), $_ftppassword );
				return ftp_login( $this -> connid, $_ftpusername, $_ftppassword );
		} 

		function ftp_pasv( $_pasv ) {
				$_pasv = intval( $_pasv );
				return ftp_pasv( $this -> connid, $_pasv );
		} 

		function ftp_chdir( $_remotedir ) {
				$_remotedir = $this -> wipespecial( $_remotedir );
				return ftp_chdir( $this -> connid, $_remotedir );
		} 

		function ftp_site( $_cmd ) {
				$_cmd = $this -> wipespecial( $_cmd );
				return ftp_site( $this -> connid, $_cmd );
		} 

		function ftp_chmod( $_mode, $_filename ) {
				$_mode = intval( $_mode );
				$_filename = $this -> wipespecial( $_filename );
				if ( function_exists( "ftp_chmod" ) ) {
						return ftp_chmod( $this -> connid, $_mode, $_filename );
				} 
				return $this -> ftp_site( $this -> connid, "CHMOD " . $_mode . " " . $_filename );
		} 

		function ftp_rename( $_fromname, $_toname ) {
				return ftp_rename( $this -> connid, $_fromname, $_toname );
		} 

		function ftp_pwd() {
				return ftp_pwd( $this -> connid );
		} 

		function ftp_nlist( $_path ) {
				$_path = $this -> wipespecial( $_path );
				return ftp_nlist( $this -> connid, $_path );
		} 

		function ftp_rawlist( $_path ) {
				$_path = $this -> wipespecial( $_path );
				return ftp_rawlist( $this -> connid, $_path );
		}

		function ftp_delfolder( $_path, $_flag = true ) {
				$_path = $this -> wipespecial( $_path );
				if ( $_flag ) {
						$_ret = $this -> ftp_rmdir( $_path ) || $this -> ftp_delete( $_path );
				} else {
						$_ret = false;
				} 
				if ( !$_ret ) {
						$_files = $this -> ftp_nlist( $_path );
						foreach ( $_files as $_values ) {
								$_values = basename( $_values );
								if ( !$this -> ftp_delete( $_path . "/" . $_values ) ) {
										$this -> ftp_delfolder( $_path . "/" . $_values, true );
								} 
						} 
						if ( $_flag ) {
								return $this -> ftp_rmdir( $_path );
						} 
						return true;
				} 
				return $_ret;
		} 

		function ftp_mkdirs( $_path ) {
				$_path = $this -> wipespecial( $_path );
				$_subdirarr = explode( "/", $_path );
				$_subdirnum = count( $_subdirarr );
				foreach ( $_subdirarr as $_val ) {
						if ( $this -> ftp_chdir( $_val ) == false ) {
								$_tmp = $this -> ftp_mkdir( $_val );
								if ( $_tmp == false ) {
										$this -> raiseerror( "FTP mkdir failure", SAXUE_ERROR_RETURN );
										exit();
								} 
								$this -> ftp_chdir( $_val );
						} 
				} 
				for ( $_i = 1; $_i <= $_subdirnum; ++$_i ) {
						@ftp_cdup( $this -> connid );
				} 
		} 

		function ftp_xcopy( $_fromdir, $_todir ) {
				$_fromdir = $this -> wipespecial( $_fromdir );
				$_todir = $this -> wipespecial( $_todir );
				$_listdir = $this -> ftp_nlist( $_fromdir );
				$this -> ftp_mkdirs( $_todir );
				foreach ( $_listdir as $_subdir ) {
						$_subdir = basename( $_subdir );
						if ( !$this -> ftp_rename( $_fromdir . "/" . $_subdir, $_todir . "/" . $_subdir ) ) {
								$this -> ftp_mkdir( $_todir . "/" . $_subdir );
								$this -> ftp_xcopy( $_fromdir . "/" . $_subdir, $_todir . "/" . $_subdir );
						} 
				} 
		} 
} 
