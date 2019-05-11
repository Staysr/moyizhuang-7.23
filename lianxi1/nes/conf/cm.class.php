<?php
class CMDB {
	private $db_host;
	private $db_user;
	private $db_pwd;
	private $db_database;
	private $conn;
	private $result;
	private $sql;
	private $row;
	private $coding;
	private $bulletin = false;
	private $show_error = false;
	private $is_error = false;
	public function __construct($db_host, $db_user, $db_pwd, $db_database, $conn, $coding) {
		$this -> db_host = $db_host;
		$this -> db_user = $db_user;
		$this -> db_pwd = $db_pwd;
		$this -> db_database = $db_database;
		$this -> conn = $conn;
		$this -> coding = $coding;
		$this -> connect();
	} 
	public function connect() {
		if ($this -> conn == "pconn") {
			$this -> conn = mysql_pconnect($this -> db_host, $this -> db_user, $this -> db_pwd);
		} else {
			$this -> conn = mysql_connect($this -> db_host, $this -> db_user, $this -> db_pwd);
		} 
		if (!mysql_select_db($this -> db_database, $this -> conn)) {
			if ($this -> show_error) {
				$this -> show_error("数据库不可用：", $this -> db_database);
			} 
		} 
		mysql_query("SET NAMES $this->coding");
	} 
	public function query($sql) {
		if ($sql == "") {
			$this -> show_error("sql语句错误：", "sql查询语句为空");
		} 
		$this -> sql = $sql;
		$result = mysql_query($this -> sql, $this -> conn);
		if (!$result) {
			if ($this -> show_error) {
				$this -> show_error("错误sql语句：", $this -> sql);
			} 
		} else {
			$this -> result = $result;
		} 
		return $this -> result;
	} 
	public function cmadd($data, $table = null) {
		$table = (is_null($table)? $this -> table : $table);
		$sql = "INSERT INTO `$table`";
		$fields = $values = array();
		$field = $value = "";
		foreach ($data as $key => $val) {
			$fields[] = "`$table`.`$key`";
			$values[] = (is_numeric($val)? $val : "'$val'");
		} 
		$field = join(",", $fields);
		$value = join(",", $values);
		unset($fields);
		unset($values);
		$sql .= "($field) VALUES($value)";
		$this -> query($sql);
		return true;
	} 
	public function cmupdate($data, $where = null, $table = null) {
		$table = (is_null($table)? $this -> table : $table);
		$where = (is_null($where)? @$this -> options["where"] : $where);
		$sql = "UPDATE `$table` SET ";
		$values = array();
		foreach ($data as $key => $val) {
			$val = (is_numeric($val)? $val : "'$val'");
			$values[] = "`$table`.`$key` = $val";
		} 
		$value = join(",", $values);
		$sql = $sql . $value . " WHERE $where";
		$this -> query($sql);
		return true;
	} 
	public function create_database($database_name) {
		$database = $database_name;
		$sqlDatabase = "create database " . $database;
		$this -> query($sqlDatabase);
	} 
	public function show_databases() {
		$this -> query("show databases");
		echo '现有数据库：' . ($amount = $this -> db_num_rows($rs));
		echo '<br />';
		$i = 1;
		while ($row = $this -> fetch_array($rs)) {
			echo "$i {$row["Database"]}";
			echo '<br />';
			$i++;
		} 
	} 
	public function databases() {
		$rsPtr = mysql_list_dbs($this -> conn);
		$i = 0;
		$cnt = mysql_num_rows($rsPtr);
		while ($i < $cnt) {
			$rs[] = mysql_db_name($rsPtr, $i);
			$i++;
		} 
		return $rs;
	} 
	public function show_tables($database_name) {
		$this -> query("show tables");
		echo '现有数据库：' . ($amount = $this -> db_num_rows($rs));
		echo '<br />';
		$i = 1;
		while ($row = $this -> fetch_array($rs)) {
			$columnName = "Tables_in_" . $database_name;
			echo "$i $row[$columnName]";
			echo '<br />';
			$i++;
		} 
	} 
	public function mysql_result_li() {
		return mysql_result($str);
	} 
	public function fetch_array($rs) {
		if ($rs == "") {
			$rs = $this -> result;
		} 
		return mysql_fetch_array($rs);
	} 
	public function fetch_assoc() {
		return mysql_fetch_assoc($this -> result);
	} 
	public function fetch_row() {
		return mysql_fetch_row($this -> result);
	} 
	public function fetch_Object() {
		return mysql_fetch_object($this -> result);
	} 
	public function findall($table) {
		$this -> query("SELECT * FROM $table");
	} 
	public function cmselect($table, $columnName, $condition) {
		if ($columnName == "") {
			$columnName = "*";
		} 
		$this -> query("SELECT $columnName FROM $table $condition");
	} 
	public function delete($table, $condition) {
		$this -> query("DELETE FROM $table WHERE $condition");
	} 
	public function insert($table, $columnName, $value) {
		$this -> query("INSERT INTO $table ($columnName) VALUES ($value)");
	} 
	public function update($table, $mod_content, $condition) {
		$this -> query("UPDATE $table SET $mod_content WHERE $condition");
	} 
	public function insert_id() {
		return mysql_insert_id();
	} 
	public function db_data_seek($id) {
		if (0 < $id) {
			$id = $id - 1;
		} 
		if (!@mysql_data_seek($this -> result, $id)) {
			$this -> show_error("sql语句有误：", "指定的数据为空");
		} 
		return $this -> result;
	} 
	public function db_num_rows() {
		if ($this -> result == null) {
			if ($this -> show_error) {
				$this -> show_error("sql语句错误", "暂时为空，没有任何内容！");
			} 
		} else {
			return mysql_num_rows($this -> result);
		} 
	} 
	public function db_affected_rows() {
		return mysql_affected_rows();
	} 
	public function show_error($message = "", $sql = "") {
		if (!$sql) {
			echo "<font color='red'>" . $message . "</font>";
			echo '<br />';
		} else {
			echo '<fieldset>';
			echo '<legend>错误信息提示:</legend><br />';
			echo '<div style=\'font-size:14px; clear:both; font-family:Verdana, Arial, Helvetica, sans-serif;\'>';
			echo '<div style=\'height:20px; background:#000000; border:1px #000000 solid\'>';
			echo '<font color=\'white\'>错误号：12142</font>';
			echo '</div><br />';
			echo '错误原因：' . mysql_error() . '<br /><br />';
			echo '<div style=\'height:20px; background:#FF0000; border:1px #FF0000 solid\'>';
			echo '<font color=\'white\'>' . $message . "</font>";
			echo '</div>';
			echo '<font color=\'red\'><pre>' . $sql . "</pre></font>";
			$ip = $this -> getip();
			if ($this -> bulletin) {
				$time = date("Y-m-d H:i:s");
				$message = $message . "\r\n$this->sql\r\n客户IP:$ip\r\n时间 :$time\r\n\r\n";
				$server_date = date("Y-m-d");
				$filename = $server_date . ".txt";
				$file_path = "error/" . $filename;
				$error_content = $message;
				$file = "error";
				if (!file_exists($file)) {
					if (!mkdir($file, 511)) {
						exit("upload files directory does not exist and creation failed");
					} 
				} 
				if (!file_exists($file_path)) {
					fopen($file_path, "w+");
					if (is_writable($file_path)) {
						if (!$handle = fopen($file_path, "a")) {
							echo "不能打开文件 $filename";
							exit();
						} 
						if (!fwrite($handle, $error_content)) {
							echo "不能写入到文件 $filename";
							exit();
						} 
						echo '——错误记录被保存!';
						fclose($handle);
					} else {
						echo "文件 $filename 不可写";
					} 
				} else if (is_writable($file_path)) {
					if (!$handle = fopen($file_path, "a")) {
						echo "不能打开文件 $filename";
						exit();
					} 
					if (!fwrite($handle, $error_content)) {
						echo "不能写入到文件 $filename";
						exit();
					} 
					echo '——错误记录被保存!';
					fclose($handle);
				} else {
					echo "文件 $filename 不可写";
				} 
			} 
			echo '<br />';
			if ($this -> is_error) {
				exit();
			} 
		} 
		echo '</div>';
		echo '</fieldset>';
		echo '<br />';
	} 
	public function free() {
		@mysql_free_result($this -> result);
	} 
	public function select_db($db_database) {
		return mysql_select_db($db_database);
	} 
	public function num_fields($table_name) {
		$this -> query("select * from $table_name");
		echo '<br />';
		echo '字段数：' . ($total = mysql_num_fields($this -> result));
		echo '<pre>';
		for ($i = 0;$i < $total;$i++) {
			print_r(mysql_fetch_field($this -> result, $i));
		} 
		echo '</pre>';
		echo '<br />';
	} 
	public function mysql_server($num = "") {
		switch ($num) {
			case $num: return mysql_get_server_info();
				break;
			case $num: return mysql_get_host_info();
				break;
			case $num: return mysql_get_client_info();
				break;
			case $num: return mysql_get_proto_info();
				break;
			default: return mysql_get_client_info();
		} 
	} 
	public function __destruct() {
		if (!empty($this -> result)) {
			$this -> free();
		} 
		mysql_close($this -> conn);
	} 
} 
function hifun($string, $operation, $key = "") {
	$key = md5("hifun2015");
	$key_length = strlen($key);
	$string = ($operation == "D" ? base64_decode($string): substr(md5($string . $key), 0, 8) . $string);
	$string_length = strlen($string);
	$rndkey = $box = array();
	$result = "";
	for ($i = 0;$i <= 255;$i++) {
		$rndkey[$i] = ord($key[$i % $key_length]);
		$box[$i] = $i;
	} 
	for ($j = $i = 0;$i < 256;$i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	} 
	for ($a = $j = $i = 0;$i < $string_length;$i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ $box[($box[$a] + $box[$j]) % 256]);
	} 
	if ($operation == "D") {
		if (substr($result, 0, 8) == substr(md5(substr($result, 8) . $key), 0, 8)) {
			return substr($result, 8);
		} else {
			return "";
		} 
	} else {
		return str_replace("=", "", base64_encode($result));
	} 
} 
function tiao($keywords, $url) {
	$key = "<script type='text/javascript'>alert('" . $keywords . "');location.replace('" . $url . "');</script>";
	return $key;
} 
function tiaos($url) {
	$key = "<script type='text/javascript'>location.replace('" . $url . "');</script>";
	return $key;
} 
function backs($keywords) {
	$key = "<script type='text/javascript'>alert('" . $keywords . "');history.go(-1);</script>";
	return $key;
} 
function egetip_joy() {
	if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
		$ip = getenv("HTTP_CLIENT_IP");
	} else {
		if (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		} else {
			if (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
				$ip = getenv("REMOTE_ADDR");
			} else {
				if (isset($_SERVER["REMOTE_ADDR"]) && $_SERVER["REMOTE_ADDR"] && strcasecmp($_SERVER["REMOTE_ADDR"], "unknown")) {
					$ip = $_SERVER["REMOTE_ADDR"];
				} 
			} 
		} 
	} 
	$ip = preg_replace("/^([d.]+).*/", "1", $ip);
	return $ip;
} 
function cut_str($string, $sublen, $start = 0, $code = "UTF-8") {
	if ($code == "UTF-8") {
		$pa = "/[x01-x7f]|[xc2-xdf][x80-xbf]|xe0[xa0-xbf][x80-xbf]|[xe1-xef][x80-xbf][x80-xbf]|xf0[x90-xbf][x80-xbf][x80-xbf]|[xf1-xf7][x80-xbf][x80-xbf][x80-xbf]/"; 
		preg_match_all($pa, $string, $t_string);
		if ($sublen < (count($t_string[0]) - $start)) {
			return join("", array_slice($t_string[0], $start, $sublen)) . "...";
		} 
		return join("", array_slice($t_string[0], $start, $sublen));
	} else {
		$start = $start * 2;
		$sublen = $sublen * 2;
		$strlen = strlen($string);
		$tmpstr = "";
		for ($i = 0;$i < $strlen;$i++) {
			if (($start <= $i) && ($i < ($start + $sublen))) {
				if (129 < ord(substr($string, $i, 1))) {
					$tmpstr .= substr($string, $i, 2);
				} else {
					$tmpstr .= substr($string, $i, 1);
				} 
			} 
			if (129 < ord(substr($string, $i, 1))) {
				$i++;
			} 
		} 
		if (strlen($tmpstr) < $strlen) {
			$tmpstr .= "...";
		} 
		return $tmpstr;
	} 
} 
function isMobile() {
	$useragent = (isset($_SERVER["HTTP_USER_AGENT"])? $_SERVER["HTTP_USER_AGENT"] : "");
	function CheckSubstrs($substrs, $text) {
		foreach ($substrs as $substr) {
			if (false !== strpos($text, $substr)) {
				return true;
			} 
		} 
		return false;
	} 
	$useragent_commentsblock = (0 < preg_match("|\(.*?\)|", $useragent, $matches)? $matches[0] : "");
	$mobile_os_list = array("Google Wireless Transcoder", "Windows CE", "WindowsCE", "Symbian", "Android", "armv6l", "armv5", "Mobile", "CentOS", "mowser", "AvantGo", "Opera Mobi", "J2ME/MIDP", "Smartphone", "Go.Web", "Palm", "iPAQ");
	$mobile_token_list = array("Profile/MIDP", "Configuration/CLDC-", "160×160", "176×220", "240×240", "240×320", "320×240", "UP.Browser", "UP.Link", "SymbianOS", "PalmOS", "PocketPC", "SonyEricsson", "Nokia", "BlackBerry", "Vodafone", "BenQ", "Novarra-Vision", "Iris", "NetFront", "HTC_", "Xda_", "SAMSUNG-SGH", "Wapaka", "DoCoMo", "iPhone", "iPod");
	$found_mobile = CheckSubstrs($mobile_os_list, $useragent_commentsblock) || CheckSubstrs($mobile_token_list, $useragent);
	if ($found_mobile) {
		return true;
	} else {
		return false;
	} 
} 
function is_weixin() {
	if (strpos($_SERVER["HTTP_USER_AGENT"], "MicroMessenger") !== false) {
		return true;
	} 
	return false;
} 
function cturl($urlt) {
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "http://api.t.sina.com.cn/short_url/shorten.json?source=3213676317&url_long=" . $urlt);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($curl);
	curl_close($ch);
	$arrResponse = json_decode($data, true);
	$dwzurls = $arrResponse[0]["url_short"];
	if ($dwzurls == "") {
		$dwzurls = $urlt;
	} 
	return $dwzurls;
} 
function okpass($mypass) {
	$passwords = "/^[a-zA-Z0-9_]{3,16}$/";
	if (preg_match($passwords, $mypass)) {
		return true;
	} else {
		return false;
	} 
} 
function isQQ($qq) {
	return preg_match("/^[1-9][0-9]{4,11}$/", $qq);
} 
function shortUrl($long_url) {
	$long_url = str_replace("&", "%26", $long_url);
	$apiKey = '2849184197';
	$apiUrl = 'http://api.t.sina.com.cn/short_url/shorten.json?source=' . $apiKey . '&url_long=' . $long_url;
	$curlObj = curl_init();
	curl_setopt($curlObj, CURLOPT_URL, $apiUrl);
	curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curlObj, CURLOPT_HEADER, 0);
	curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
	$response = curl_exec($curlObj);
	curl_close($curlObj);
	$json = json_decode($response);
	return $json[0] -> url_short;
} 
$cm = new CMDB($Dconfig["DB_HOST"], $Dconfig["DB_USER"], $Dconfig["DB_PWD"], $Dconfig["DB_NAME"], "cm", "UTF8");
$cm -> query("SET sql_mode=''");
$mycmall = $cm -> query("SELECT * FROM f_config where c_id='1'");
$fens = $cm -> fetch_array($mycmall);
$b2 = "66788";
$ozt = array("未付款", "已付款");
$zszt = array("进行中", "关闭", "违规冻结");
$ispay = array("否", "是");
$grade = array("试用会员", "月度会员", "季度会员", "年度会员");
$kmtype = array("月度卡密", "季度卡密", "年度卡密");
$kmzt = array("未使用", "已使用");
$agent = array("普通会员", "普通代理", "高级代理");
$paytype = array("无", "微信支付", "支付宝支付");
$ddtype = array("待审核", "已审核", "拒绝");
$uragent = array("无", "普通", "高级");
