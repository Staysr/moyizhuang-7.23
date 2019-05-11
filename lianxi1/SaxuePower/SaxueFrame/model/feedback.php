<?php
saxue_includedb();
class saxuefeedback extends saxueobjectdata {
		function saxuefeedback() {
				$this -> initvar( "id", SAXUE_TYPE_INT, 0, "", false, 8 );
				$this -> initvar( "catid", SAXUE_TYPE_INT, 0, "", false, 4 );
				$this -> initvar( "lang", SAXUE_TYPE_TXTBOX, "", "", false, 5 );
				$this -> initvar( "name", SAXUE_TYPE_TXTBOX, "", "", false, 30 );
				$this -> initvar( "tel", SAXUE_TYPE_TXTBOX, "", "", false, 20 );
				$this -> initvar( "email", SAXUE_TYPE_TXTBOX, "", "", false, 30 );
				$this -> initvar( "content", SAXUE_TYPE_TXTAREA, "", "", false, null );
				$this -> initvar( "ip", SAXUE_TYPE_TXTBOX, "", "", false, 15 );
				$this -> initvar( "addtime", SAXUE_TYPE_INT, 0, "", false, 10 );
				$this -> initvar( "isread", SAXUE_TYPE_INT, 0, "", false, 1 );
				$this -> initvar( "reply", SAXUE_TYPE_TXTAREA, "", "", false, null );
				$this -> initvar( "updatetime", SAXUE_TYPE_INT, 0, "", false, 10 );
				$this -> initvar( "display", SAXUE_TYPE_INT, 0, "", false, 1 );
				$this -> initvar( "iswap", SAXUE_TYPE_INT, 1, "", false, 1 );
		} 
} 

class saxuefeedbackhandler extends saxueobjecthandler {
		function saxuefeedbackhandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "feedback";
				$this -> autoid = "id";
				$this -> dbname = "feedback";
		} 

		function deletebycat( $_catid = 0 ) {
				if ( !is_numeric( $_catid ) || empty( $_catid ) ) {
						return false;
				} 
				$this -> db -> query( "DELETE FROM " . saxue_dbprefix( $this -> dbname ) . " WHERE catid=" . $_catid  );
		}
}