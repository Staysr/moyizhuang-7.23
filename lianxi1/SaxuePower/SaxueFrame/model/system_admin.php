<?php
saxue_includedb();
class saxuesystemadmin extends saxueobjectdata {
		function saxuesystemadmin() {
				$this -> initvar( "id", SAXUE_TYPE_INT, 0, "编号", false, 5 );
				$this -> initvar( "account", SAXUE_TYPE_TXTBOX, "", "管理员账号", false, 20 );
				$this -> initvar( "password", SAXUE_TYPE_TXTBOX, "", "管理员密码", false, 32 );
				$this -> initvar( "role", SAXUE_TYPE_INT, 0, "管理员角色组", false, 4 );
				$this -> initvar( "status", SAXUE_TYPE_INT, 0, "账户状态", false, 1 );
				$this -> initvar( "isfounder", SAXUE_TYPE_INT, 0, "是否创始人", false, 1 );
				$this -> initvar( "lasttime", SAXUE_TYPE_INT, 0, "最后登录时间", false, 10 );
				$this -> initvar( "lastip", SAXUE_TYPE_TXTBOX, "", "最后登录IP", false, 15 );
		} 
} 

class saxuesystemadminhandler extends saxueobjecthandler {
		function saxuesystemadminhandler( $_db = "" ) {
				$this -> saxueobjecthandler( $_db );
				$this -> basename = "systemadmin";
				$this -> autoid = "id";
				$this -> dbname = "system_admin";
		} 

		function encryptpass( $_pass ) {
				return md5( 'R%^&*()_' . $_pass . '&^O&^&^&^KJ' );
		} 
}