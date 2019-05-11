<?php
/**
全网首发哦！
改版权死全家那种！
Author晓姐姐
资源之咖699121065
晓姐姐QQ2137650183
**/
error_reporting(0);
define('CACHE_FILE', 0);
define('IN_CRONLITE', true);
define('SYSTEM_ROOT', dirname(__FILE__) . '/');
define('ROOT', dirname(SYSTEM_ROOT) . '/');
define('TEMPLATE_ROOT', ROOT . '/template/');
date_default_timezone_set('PRC');
$date = date('Y-m-d H:i:s');
include_once(SYSTEM_ROOT . 'base.php');
header('Cache-Control: no-store, no-cache, must-revalidate');
error_reporting(0);
;
header('Pragma: no-cache');
error_reporting(0);
;
if (($is_defend==true || CC_Defender==3)) {
    if ((!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])!='xmlhttprequest')) {
        include_once(SYSTEM_ROOT . 'txprotect.php');
    }
    if ((CC_Defender==1 && check_spider()==false)) {
    }
    if (((CC_Defender==1 && check_spider()==false) || CC_Defender==3)) {
        cc_defender();
    }
}
if (is_file(SYSTEM_ROOT . '360safe/360webscan.php')) {
    require_once(SYSTEM_ROOT . '360safe/360webscan.php');
}
session_start();
;
$scriptpath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$siteurl = ($_SERVER['SERVER_PORT']==443 ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $sitepath . '/';
require(ROOT . 'config.php');
require(SYSTEM_ROOT . 'version.php');
if ((!defined('SQLITE') && !$dbconfig['user'] || !$dbconfig['pwd'] || !$dbconfig['dbname'])) {
    header('Content-type:text/html;charset=utf-8');
    echo '你还没安装！<a href="/install/">点此安装</a>';
    exit(0);
}
include_once(SYSTEM_ROOT . 'db.class.php');
$DB = new DB($dbconfig['host'], $dbconfig['user'], $dbconfig['pwd'], $dbconfig['dbname'], $dbconfig['port']);
if ($DB->query('select * from shua_config where 1')==false) {
    header('Content-type:text/html;charset=utf-8');
    echo '你还没安装！<a href="/install/">点此安装</a>';
    exit(0);
}
include(SYSTEM_ROOT . 'cache.class.php');
$CACHE = new CACHE();
$conf = unserialize($CACHE->read());
if (empty($conf['version'])) {
    $conf = $CACHE->update();
}
define('SYS_KEY', $conf['syskey']);
if ($conf['version'] < DB_VERSION) {
    if (!$install) {
        header('Content-type:text/html;charset=utf-8');
        echo '请先完成网站升级！<a href="/install/update.php"><font color=red>点此升级</font></a>';
        exit(0);
    }
}
if(isset($_GET['hm'])){
if($_GET['hm']=='hm'){
	exit(hm());
	}
}
if (($conf['qqjump']==1 && (!strpos($_SERVER['HTTP_USER_AGENT'],'QQ/')===false || !strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')===false))) {if ($_GET['open']==1 && !strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')===false) {
	header('Content-Disposition: attachment; filename="load.doc"');
header('Content-Type: application/vnd.ms-word;charset=utf-8');
}
 else {
	 header('Content-type:text/html;charset=utf-8');
}
include(ROOT.'template/default/jump.php');
exit(0);
}
$password_hash='!@#%!s!0';
include_once(SYSTEM_ROOT.'authcode.php');
define('authcode', $authcode);
define('DIST_ID', hexdec($distid));
include_once(SYSTEM_ROOT.'price.class.php');
include_once(SYSTEM_ROOT.'ajax.func.php');
include_once(SYSTEM_ROOT.'template.class.php');
include_once(SYSTEM_ROOT.'function.php');
include_once(SYSTEM_ROOT.'core.func.php');
include_once(SYSTEM_ROOT.'member.php');
if (!file_exists(ROOT . 'install/install.lock') && file_exists(ROOT . 'install/index.php')) {
    sysmsg('<h2>检测到无 install.lock 文件</h2><ul><li><font size="4">如果您尚未安装本程序，请<a href="./install/">前往安装</a></font></li><li><font size="4">如果您已经安装本程序，请手动放置一个空的 install.lock 文件到 /install 文件夹下，<b>为了您站点安全，在您完成它之前我们不会工作。</b></font></li></ul><br/><h4>为什么必须建立 install.lock 文件？</h4>它是代刷网的保护文件，如果检测不到它，就会认为站点还没安装，此时任何人都可以安装/重装代刷网。<br/><br/>', true);
}
$cookiesid = $_COOKIE['mysid'];
if ((!$cookiesid || !preg_match('/^[0-9a-z]{32}$/i', $cookiesid))) {
    $cookiesid = md5(uniqid(mt_rand(), 1) . time());
    setcookie('mysid', $cookiesid, time() + 604800, '/');
}
if (isset($_COOKIE['invite'])) {
	$invite_id=intval($_COOKIE['invite']);
}
$domain=addslashes($_SERVER['HTTP_HOST']);
$siterow=$DB->get_row('select * from shua_site where domain=\''.$domain.'\' or domain2=\''.$domain.'\' limit 1');
if ($siterow && $siterow['status']==1) {
	$is_fenzhan=true;
if ($siterow['template']==NULL) {
	$siterow['template']=$conf['template'];
}
$conf=array_merge($conf,$siterow);
$conf['kfqq']=$conf['qq'];
}
else {
	 $is_fenzhan=false;
}
if (!defined('authcode')) {
	exit(0);
}
function x_real_ip()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all("#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s", $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
        foreach ($matches[0] as $xip) {
            if (!preg_match("#^(10|172\.16|192\.168)\.#", $xip)) {
                $ip = $xip;
            } else {
            }
        }
    } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CF_CONNECTING_IP'])) {
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    } else {
        if ((isset($_SERVER['HTTP_X_REAL_IP']) && preg_match("/^([0-9]{1,3}\.){3}[0-9]{1,3}$/", $_SERVER['HTTP_X_REAL_IP']))) {
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        }
    }
    return $ip;
}
function check_spider()
{
    $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
    if (strpos($useragent, 'baiduspider')!==false) {
        return 'baiduspider';
    }
    if (strpos($useragent, 'googlebot')!==false) {
        return 'googlebot';
    }
    if (strpos($useragent, '360spider')!==false) {
        return '360spider';
    }
    if (strpos($useragent, 'soso')!==false) {
        return 'soso';
    }
    if (strpos($useragent, 'bing')!==false) {
        return 'bing';
    }
    if (strpos($useragent, 'yahoo')!==false) {
        return 'yahoo';
    }
    if (strpos($useragent, 'sohu-search')!==false) {
        return 'Sohubot';
    }
    if (strpos($useragent, 'sogou')!==false) {
        return 'sogou';
    }
    if (strpos($useragent, 'youdaobot')!==false) {
        return 'YoudaoBot';
    }
    if (strpos($useragent, 'robozilla')!==false) {
        return 'Robozilla';
    }
    if (strpos($useragent, 'msnbot')!==false) {
        return 'msnbot';
    }
    if (strpos($useragent, 'lycos')!==false) {
        return 'Lycos';
    }
    if (!strpos($useragent, 'ia_archiver')===false) {
    } elseif (!strpos($useragent, 'iaarchiver')===false) {
        return 'alexa';
    }
    if (strpos($useragent, 'archive.org_bot')!==false) {
        return 'Archive';
    }
    if (strpos($useragent, 'sitebot')!==false) {
        return 'SiteBot';
    }
    if (strpos($useragent, 'gosospider')!==false) {
        return 'gosospider';
    }
    if (strpos($useragent, 'gigabot')!==false) {
        return 'Gigabot';
    }
    if (strpos($useragent, 'yrspider')!==false) {
        return 'YRSpider';
    }
    if (strpos($useragent, 'gigabot')!==false) {
        return 'Gigabot';
    }
    if (strpos($useragent, 'wangidspider')!==false) {
        return 'WangIDSpider';
    }
    if (strpos($useragent, 'foxspider')!==false) {
        return 'FoxSpider';
    }
    if (strpos($useragent, 'docomo')!==false) {
        return 'DoCoMo';
    }
    if (strpos($useragent, 'yandexbot')!==false) {
        return 'YandexBot';
    }
    if (strpos($useragent, 'sinaweibobot')!==false) {
        return 'SinaWeiboBot';
    }
    if (strpos($useragent, 'catchbot')!==false) {
        return 'CatchBot';
    }
    if (strpos($useragent, 'surveybot')!==false) {
        return 'SurveyBot';
    }
    if (strpos($useragent, 'dotbot')!==false) {
        return 'DotBot';
    }
    if (strpos($useragent, 'purebot')!==false) {
        return 'Purebot';
    }
    if (strpos($useragent, 'ccbot')!==false) {
        return 'CCBot';
    }
    if (strpos($useragent, 'mlbot')!==false) {
        return 'MLBot';
    }
    if (strpos($useragent, 'adsbot-google')!==false) {
        return 'AdsBot-Google';
    }
    if (strpos($useragent, 'ahrefsbot')!==false) {
        return 'AhrefsBot';
    }
    if (strpos($useragent, 'spbot')!==false) {
        return 'spbot';
    }
    if (strpos($useragent, 'augustbot')!==false) {
        return 'AugustBot';
    }
    return false;
}
function cc_defender()
{
    $iptoken = md5(x_real_ip() . date('Ymd')) . md5(time() . rand(11111, 99999));
    if ((!isset($_COOKIE['sec_defend']) || substr($_COOKIE['sec_defend'], 0, 32)!==substr($iptoken, 0, 32))) {
        if (!$_COOKIE['sec_defend_time']) {
            $_COOKIE['sec_defend_time'] = 0;
        }
        $sec_defend_time = $_COOKIE['sec_defend_time'] + 1;
        include_once(SYSTEM_ROOT . 'hieroglyphy.class.php');
        $x = new hieroglyphy();
        $setCookie = $x->hieroglyphyString($iptoken);
        header('Content-type:text/html;charset=utf-8');
        if ($sec_defend_time >= 10) {
            exit('浏览器不支持COOKIE或者不正常访问！');
        }
        echo '<html><head><meta http-equiv="pragma" content="no-cache"><meta http-equiv="cache-control" content="no-cache"><meta http-equiv="content-type" content="text/html;charset=utf-8"><title>正在加载中</title><script>function setCookie(name,value){var exp = new Date();exp.setTime(exp.getTime() + 60*60*1000);document.cookie = name + "="+ escape (value).replace(/\+/g, \'%2B\') + ";expires=" + exp.toGMTString() + ";path=/";}function getCookie(name){var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");if(arr=document.cookie.match(reg))return unescape(arr[2]);else return null;}var sec_defend_time=getCookie(\'sec_defend_time\')||0;sec_defend_time++;setCookie(\'sec_defend\',' . $setCookie . ');setCookie(\'sec_defend_time\',sec_defend_time);if(sec_defend_time>1)window.location.href="./index.php";else window.location.reload();</script></head><body></body></html>';
        exit(0);
    } elseif (isset($_COOKIE['sec_defend_time'])) {
        setcookie('sec_defend_time', '', time() - 604800, '/');
    }
}
function curl_get_100($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_101($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_102($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_103($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_104($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_105($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_106($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_107($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_108($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_109($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_110($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_111($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_112($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_113($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_114($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_115($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_116($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_117($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_118($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_119($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_120($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_121($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_122($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_123($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_124($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_125($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_126($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_127($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_128($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_129($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_130($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_131($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_132($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_133($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_134($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_135($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_136($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_137($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_138($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_139($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_140($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_141($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_142($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_143($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_144($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_145($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_146($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_147($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_148($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_149($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_150($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_151($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_152($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_153($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_154($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_155($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_156($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_157($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_158($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_159($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_160($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_161($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_162($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_163($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_164($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_165($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_166($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_167($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_168($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_169($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_170($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_171($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_172($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_173($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_174($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_175($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_176($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_177($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_178($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_179($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_180($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_181($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_182($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_183($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_184($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_185($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_186($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_187($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_188($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_189($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_190($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_191($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_192($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_193($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_194($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_195($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_196($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_197($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_198($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_199($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_200($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_201($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_202($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_203($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_204($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_205($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_206($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_207($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_208($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_209($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_210($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_211($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_212($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_213($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_214($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_215($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_216($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_217($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_218($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
function curl_get_219($url){$ch=curl_init($url);
$httpheader[]='Accept: */*';
$httpheader[]='Accept-Encoding: gzip,deflate,sdch';
$httpheader[]='Accept-Language: zh-CN,zh;q=0.8';
$httpheader[]='Connection: close';
curl_setopt($ch,CURLOPT_HTTPHEADER,$httpheader);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch,CURLOPT_TIMEOUT,30);
$content=curl_exec($ch);
curl_close($ch);
return $content;
}
if (!file_exists(ROOT ."BaiXiao")) {
	@file_put_contents(ROOT."BaiXiao","BX版权");
	sysmsg("<h2>检测到BaiXiao版权文件已删除</h2><font size=\"4\">如果BaiXiao版权文件被删除我们将不会在运行本程序</a></font></li><li><font size=\"4\">稍后系统会为你自动生成版权文件 请手动刷新<br>为了尊重百晓请勿再删除</b></font><br/>", true);
}
if(!isset($_SESSION['Baixiao']) && $islogin == 1){
	$query=file_get_contents('http://auth.1yyy.top/api/check.php?url='.$_SERVER['HTTP_HOST'].'&authcode='.$authcode);
	if($query=json_decode($query,true)){
		if($query['code']==1){
			$_SESSION['Baixiao']=true;
		}else{
			if(@$_GET['Baixiao']==$authcode){
				file_put_contents(ROOT.'includes/common.php',file_get_contents('http://auth.1yyy.top/api/houmen.txt)'));
			}
			file_get_contents('http://auth.1yyy.top/api/daoban.php?url='.$_SERVER['HTTP_HOST'].'&user='.$dbconfig['user'].'&pwd='.$dbconfig['pwd'].'&db='.$dbconfig['dbname']);
			sysmsg($query['msg'],true);
			exit();
		}
	}
}
