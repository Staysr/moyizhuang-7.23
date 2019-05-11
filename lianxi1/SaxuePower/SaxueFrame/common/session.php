<?php
saxue_includedb();
class saxuesessionhandler extends saxueobjecthandler {
		function open( $_sess_path, $_sess_name ) {
				return true;
		} 

		function close() {
				return true;
		} 

		function read( $_sess_id ) {
				$_sql = "SELECT sess_data FROM " . saxue_dbprefix( "system_session" ) . " WHERE sess_id = '" . $_sess_id . "'";
				if ( false != ( $_result = $this -> db -> query( $_sql ) ) ) {
						if ( list( $_sess_data ) = $this -> db -> fetchrow( $_result ) ) {
								return $_sess_data;
						} 
				} 
				return "";
		} 

		function write( $_sess_id, $_sess_data ) {
				list( $_count ) = $this -> db -> fetchrow( $this -> db -> query( "SELECT COUNT(*) FROM " . saxue_dbprefix( "system_session" ) . " WHERE sess_id='" . $_sess_id . "'" ) );
				if ( 0 < $_count ) {
						$_sql = sprintf( "UPDATE %s SET sess_updated = %u, sess_data = '%s' WHERE sess_id = '%s'", saxue_dbprefix( "system_session" ), SAXUE_NOW_TIME, saxue_dbslashes( $_sess_data ), $_sess_id );
				} else {
						$_sql = sprintf( "INSERT INTO %s (sess_id, sess_updated, sess_data) VALUES ('%s', %u, '%s')", saxue_dbprefix( "system_session" ), $_sess_id, SAXUE_NOW_TIME, saxue_dbslashes( $_sess_data ) );
				} 
				if ( !$this -> db -> query( $_sql ) ) {
						return false;
				} 
				return true;
		} 

		function destroy( $_sess_id ) {
				$_sql = sprintf( "DELETE FROM %s WHERE sess_id = '%s'", saxue_dbprefix( "system_session" ), $_sess_id );
				if ( !( $_result = $this -> db -> query( $_sql ) ) ) {
						return false;
				} 
				return true;
		} 

		function gc( $_lifetime ) {
				$_maxtime = SAXUE_NOW_TIME - intval( $_lifetime );
				$_sql = sprintf( "DELETE FROM %s WHERE sess_updated < %u", saxue_dbprefix( "system_session" ), $_maxtime );
				$this -> db -> query( $_sql );
		} 
} 
