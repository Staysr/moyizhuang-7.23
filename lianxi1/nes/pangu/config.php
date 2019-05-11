<?php 


//-----------------------------------------------------------
//config文件请勿修改，因修改此文件造成无法解析概不负责！
//-----------------------------------------------------------


//错误提示
error_reporting(0);
//默认时区
date_default_timezone_set("Asia/Shanghai");
//强制编码
header("Content-type: text/html; charset=utf-8");
//加载文件
require_once FCPATH . 'user.php';
//用户授权UID
define('USER_UID', $user['uid']);
//用户授权TOKEN
define('USER_TOKEN', $user['token']);
//用户设置解析名称
define('USER_TITLE', $user['title']);
//用户设置的清晰度
define('USER_HD', $user['hdd']);
//用户设置PC播放模式
define('USER_AUTO', $user['autoplay']);
//用户设置H5播放模式
define('USER_AUTO_H5', $user['h5']);
//用户设置备用连接
define('USER_ATHER_HREF', $user['ather']);
//用户设置防盗跳转时间
define('USER_LOTIME', $user['lotime']);
//用户设置页面统计
define('USER_TONGJI', $user['tongji']);
//用户设置防盗跳转
define('USER_LOLINK', $user['lolink']);
//用户设置是否跳转至官网
define('USER_ONLINE', $user['online']);
//您网站的api.php地址，请勿随意修改，否则会造成解析失败
define('YOU_URL', http_url() . $user['path']);
//用户设置广告
define('USER_AD', $user['ad']);
//用户设置的微云网盘COOKIE
define('USER_WEIYUN', base64_encode($user['weiyun']));
//用户设置的icloud网盘COOKIE
define('USER_ILCOUD', base64_encode($user['icloud']));
//用户设置的百度网盘COOKIE
define('USER_BDYUN', base64_encode($user['bdyun']));
//用户设置的天翼网盘COOKIE
define('USER_TYYUN', base64_encode($user['tyyun']));
//当前解析版本，请勿随意修改，否则会造成解析失败
define('VERSION', 'v2.3.0.020181006');
//当前环境
define('HOST', base64_encode($_SERVER['HTTP_HOST']));
//盗链判断
define('REFERER', @$_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : @base64_decode($_POST['referer']));
//防盗验证
define('C_ROOT_TOKEN', md5(USER_TOKEN . time()));
define('C_ROOT_KEY', md5(USER_TOKEN . 'qipacao'));
define('C_ROOT_ID', ($user['localdanma'] == 1 ? '' : substr(C_ROOT_KEY, 0, 16)));
function http_url()
{
		$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
		return $http_type . $_SERVER['HTTP_HOST'];
}
class __abose
{
		private function get_api()
		{
				return $this->get_key(API_YOU_PATH, 'D', 'Leuqugirl');
		}
		public function is_referer()
		{
				if (REFERER_URL == '') return true;
				else
				{
						$ext = explode("|", REFERER_URL);
						$ref = parse_url(REFERER)['host'];
						for ($i = 0; $i < count($ext); $i++)
						{
								if (strstr(strtolower($ext[$i]), strtolower($ref)) == true && substr_count(strtolower(REFERER), strtolower($ref)) === 1)
								{
										return true;
								}
						}
				}
				return false;
		}
		public function geturl($url)
		{
				$headers1 = array(
						'referer' => $_POST['referer'],
						'Client-IP' => (empty($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['REMOTE_ADDR'] : $_SERVER['HTTP_CLIENT_IP']),
						'X-Forwarded-For' => (empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['REMOTE_ADDR'] : $_SERVER['HTTP_X_FORWARDED_FOR']),
						'User-Agent' => $_SERVER['HTTP_USER_AGENT']);
				$url = $url . '&pass=' . $this->pass() . '&other=' . $_POST['other'] . '&lref=' . rawurlencode($_POST['referer']) . "&headers1=" . rawurlencode(http_build_query($headers1)) . "&ver=" . VERSION .
						'&host=' . HOST . '&online=' . USER_ONLINE . '&passid=' . C_ROOT_ID;
				if (!function_exists('curl_init') || !function_exists('curl_exec'))
				{
						exit('您的主机不支持Curl，请开启~');
				}
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $this->get_api() . $url);
				curl_setopt($curl, CURLOPT_USERAGENT, 'Cloud Lequgirl');
				curl_setopt($curl, CURLOPT_REFERER, "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
				curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
				curl_setopt($curl, CURLOPT_TIMEOUT, 10);
				curl_setopt($curl, CURLOPT_HEADER, 0);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
				$data = curl_exec($curl);
				$file = json_decode(trim($data), true);
				curl_close($curl);
				if (stripos($data, 'code') == false && stripos($data, 'success') == false && is_array($file) == false)
				{
						$sucess = array(
								"code" => '500',
								'msg' => $this->decodeUnicode('\u670d\u52a1\u5668\u8fde\u63a5\u5931\u8d25\u002c\u8bf7\u8054\u7cfb\u7ba1\u7406\u5458\u0021'),
								'type' => 'false',
								'mode' => USER_ATHER_HREF == '' ? '0' : '1',
								'url' => USER_ATHER_HREF,
								'play' => base64_decode($_POST['other']));
						die(json_encode($sucess));
				}
				elseif (is_array($file) && @$file['t'] == 'Error')
				{
						$error = array(
								"code" => '300',
								'msg' => $file['m'],
								'type' => 'nopass');
						die(json_encode($error));

				}
				else
				{
						return $data;
				}
		}
		public function __cache($vid)
		{
				$cache = 'cache/' . md5($vid . 'Lequgirl');
				return $cache;
		}
		public function _iserror()
		{
				header('HTTP/1.1 403 Forbidden');
				exit(ERROR);
		}
		public function get_waif($s, $v)
		{
				$a = str_split($s, 2);
				$s = '%' . implode('%', $a);
				$zb = urldecode($s);
				if ($zb == $v && time() - $v < 30)
				{
						return true;
				}
				else
				{
						return false;
				}
		}
		public function strencode($string)
		{
				$string = base64_encode($string);
				$key = md5('istrue@#!');
				$len = strlen($key);
				$code = '';
				for ($i = 0; $i < strlen($string); $i++)
				{
						$k = $i % $len;
						$code .= $string[$i] ^ $key[$k];
				}
				return base64_encode($code);
		}
		private function decodeUnicode($str)
		{
				return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', create_function('$matches', 'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'), $str);
		}
		public function version($version)
		{
				$sucess = array(
						"code" => '120',
						'msg' => $this->decodeUnicode('\u5f53\u524d\u7248\u672c\u5df2\u505c\u7528\u002c\u8bf7\u8054\u7cfb\u7ba1\u7406\u5458\u53ca\u65f6\u66f4\u65b0\u0021'),
						'type' => 'false',
						'url' => '');
				(strcasecmp(VERSION, $version) < 0) ? die(json_encode($sucess)) : '';
		}
		public function get_key($string, $operation = 'E', $key = '')
		{
				if ($operation == 'E') $string .= '-time-' . (time() + 1800);
				if ($key == '') $key = md5(USER_TOKEN);
				$key_length = strlen($key);
				$string = $operation == 'D' ? base64_decode(str_replace('-', '/', str_replace('_', '+', $string))) : substr(md5($string . $key), 0, 8) . $string;
				$string_length = strlen($string);
				$rndkey = $box = array();
				$result = '';
				for ($i = 0; $i <= 255; $i++)
				{
						$rndkey[$i] = ord($key[$i % $key_length]);
						$box[$i] = $i;
				}
				for ($j = $i = 0; $i < 256; $i++)
				{
						$j = ($j + $box[$i] + $rndkey[$i]) % 256;
						$tmp = $box[$i];
						$box[$i] = $box[$j];
						$box[$j] = $tmp;
				}
				for ($a = $j = $i = 0; $i < $string_length; $i++)
				{
						$a = ($a + 1) % 256;
						$j = ($j + $box[$a]) % 256;
						$tmp = $box[$a];
						$box[$a] = $box[$j];
						$box[$j] = $tmp;
						$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
				}
				if ($operation == 'D')
				{
						if (substr($result, 0, 8) == substr(md5(substr($result, 8) . $key), 0, 8))
						{
								$str = substr($result, 8);
								$arr = explode("-time-", $str);
								if (strpos($arr[0], '.lequgirl.') === false && (empty($arr[1]) || $arr[1] < time())) return '';
								return $arr[0];
						}
						else
						{
								return '';
						}
				}
				else
				{
						return str_replace('+', '_', str_replace('=', '', base64_encode($result)));
				}
		}
		public function other_loca($json)
		{
				$jsons = json_decode($json, true);
				if ($jsons['success'] == '1' && $jsons['ext'] != 'xml')
				{
						$json_loca = json_encode(array(
								'code' => '200',
								'url' => $jsons['url'],
								'type' => $jsons['ext'],
								'list' => $jsons['type'],
								'msg' => 'h5',
								'live' => '0',
								'play' => '1'));
				}
				elseif ($jsons['success'] == '1' && $jsons['ext'] == 'xml')
				{
						foreach ($jsons['url'] as $i => $list)
						{
								$xml .= "<video><file><![CDATA[" . $list['purl'] . "]]></file>";
								$xml .= "<size>" . $list['size'] . "</size>";
								$xml .= "<seconds>" . $list['sec'] . "</seconds>";
								$xml .= "</video>";
						}
						$xml_url .= "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
						$xml_url .= "<ckplayer>";
						$xml_url .= $xml . '</ckplayer>';
						$json_loca = json_encode(array(
								'code' => '200',
								'list' => $jsons['type'],
								'type' => 'xml',
								'url' => $xml_url,
								'msg' => 'pc',
								'live' => '0',
								'play' => '1'));
				}
				else
				{
						$json_loca = json_encode(array(
								'code' => '405',
								'list' => $jsons['type'],
								'type' => '',
								'url' => 'http://api.lequgirl.com/404.mp4',
								'msg' => 'h5',
								'live' => '0',
								'play' => '1'));
				}
				return $json_loca;
		}
		public function tea($a, $b)
		{
				$c = $this->xxtea_decrypt($a, C_ROOT_KEY);
				if ($c == md5(USER_TOKEN . $b) && $this->__httpxml() == true)
				{
						return true;
				}
				else
				{
						return false;
				}
		}
		public function jsencode($java, $level = 0)
		{
				$result = "ﾟωﾟﾉ= /｀ｍ´）ﾉ ~┻━┻   //*´∇｀*/ ['_']; o=(ﾟｰﾟ)  =_=3; c=(ﾟΘﾟ) =(ﾟｰﾟ)-(ﾟｰﾟ); " . "(ﾟДﾟ) =(ﾟΘﾟ)= (o^_^o)/ (o^_^o);" . "(ﾟДﾟ)={ﾟΘﾟ: '_' ,ﾟωﾟﾉ : ((ﾟωﾟﾉ==3) +'_') [ﾟΘﾟ] " .
						",ﾟｰﾟﾉ :(ﾟωﾟﾉ+ '_')[o^_^o -(ﾟΘﾟ)] " . ",ﾟДﾟﾉ:((ﾟｰﾟ==3) +'_')[ﾟｰﾟ] }; (ﾟДﾟ) [ﾟΘﾟ] =((ﾟωﾟﾉ==3) +'_') [c^_^o];" . "(ﾟДﾟ) ['c'] = ((ﾟДﾟ)+'_') [ (ﾟｰﾟ)+(ﾟｰﾟ)-(ﾟΘﾟ) ];" .
						"(ﾟДﾟ) ['o'] = ((ﾟДﾟ)+'_') [ﾟΘﾟ];" . "(ﾟoﾟ)=(ﾟДﾟ) ['c']+(ﾟДﾟ) ['o']+(ﾟωﾟﾉ +'_')[ﾟΘﾟ]+ ((ﾟωﾟﾉ==3) +'_') [ﾟｰﾟ] + " . "((ﾟДﾟ) +'_') [(ﾟｰﾟ)+(ﾟｰﾟ)]+ ((ﾟｰﾟ==3) +'_') [ﾟΘﾟ]+" .
						"((ﾟｰﾟ==3) +'_') [(ﾟｰﾟ) - (ﾟΘﾟ)]+(ﾟДﾟ) ['c']+" . "((ﾟДﾟ)+'_') [(ﾟｰﾟ)+(ﾟｰﾟ)]+ (ﾟДﾟ) ['o']+" . "((ﾟｰﾟ==3) +'_') [ﾟΘﾟ];(ﾟДﾟ) ['_'] =(o^_^o) [ﾟoﾟ] [ﾟoﾟ];" .
						"(ﾟεﾟ)=((ﾟｰﾟ==3) +'_') [ﾟΘﾟ]+ (ﾟДﾟ) .ﾟДﾟﾉ+" . "((ﾟДﾟ)+'_') [(ﾟｰﾟ) + (ﾟｰﾟ)]+((ﾟｰﾟ==3) +'_') [o^_^o -ﾟΘﾟ]+" . "((ﾟｰﾟ==3) +'_') [ﾟΘﾟ]+ (ﾟωﾟﾉ +'_') [ﾟΘﾟ]; " . "(ﾟｰﾟ)+=(ﾟΘﾟ); (ﾟДﾟ)[ﾟεﾟ]='\\\\'; " .
						"(ﾟДﾟ).ﾟΘﾟﾉ=(ﾟДﾟ+ ﾟｰﾟ)[o^_^o -(ﾟΘﾟ)];" . "(oﾟｰﾟo)=(ﾟωﾟﾉ +'_')[c^_^o];" . "(ﾟДﾟ) [ﾟoﾟ]='\\\"';" . "(ﾟДﾟ) ['_'] ( (ﾟДﾟ) ['_'] (ﾟεﾟ+" . "/*´∇｀*/(ﾟДﾟ)[ﾟoﾟ]+ ";
				for ($i = 0, $len = mb_strlen($java); $i < $len; $i++)
				{
						$unp = unpack('N', mb_convert_encoding(mb_substr($java, $i, 1, 'UTF-8'), 'UCS-4BE', 'UTF-8'));
						$code = $unp[1];
						$text = '(ﾟДﾟ)[ﾟεﾟ]+';
						if ($code <= 127)
						{
								$text .= preg_replace_callback('/([0-7])/', function ($match)use ($level)
								{
										$byte = intval($match[1]); return ($level ? self::randomize($byte, $level) : self::$bytes[$byte]) . '+'; }
								, decoct($code));
						}
						else
						{
								$hex = str_split(substr('000' . dechex($code), -4));
								$text .= "(oﾟｰﾟo)+ ";
								for ($i = 0, $len = count($hex); $i < $len; $i++)
								{
										$text .= self::$bytes[hexdec($hex[$i])] . '+ ';
								}
						}
						$result .= $text;

				}
				$result .= "(ﾟДﾟ)[ﾟoﾟ]) (ﾟΘﾟ)) ('_');";
				return $result;
		}
		public function full($a)
		{
				return md5($this->str3long() . $a);
		}
		static private $bytes = ["(c^_^o)", "(ﾟΘﾟ)", "((o^_^o) - (ﾟΘﾟ))", "(o^_^o)", "(ﾟｰﾟ)", "((ﾟｰﾟ) + (ﾟΘﾟ))", "((o^_^o) +(o^_^o))", "((ﾟｰﾟ) + (o^_^o))", "((ﾟｰﾟ) + (ﾟｰﾟ))", "((ﾟｰﾟ) + (ﾟｰﾟ) + (ﾟΘﾟ))",
				"(ﾟДﾟ) .ﾟωﾟﾉ", "(ﾟДﾟ) .ﾟΘﾟﾉ", "(ﾟДﾟ) ['c']", "(ﾟДﾟ) .ﾟｰﾟﾉ", "(ﾟДﾟ) .ﾟДﾟﾉ", "(ﾟДﾟ) [ﾟΘﾟ]", ];

		static function randomize($byte, $level)
		{
				$random = [0 => [['+0', '-0'], ['+1', '-1'], ['+3', '-3'], ['+4', '-4']], 1 => [['+1', '-0'], ['+3', '-1', '-1'], ['+4', '-3']], 2 => [['+3', '-1'], ['+4', '-3', '+1'], ['+3', '+3', '-4']], 3 => [['+3',
						'-0'], ['+4', '-3', '+1', '+1']], 4 => [['+4', '+0'], ['+1', '+3'], ['+4', '-0']], 5 => [['+3', '+1', '+1'], ['+4', '+1'], ['+3', '+3', '-1']], 6 => [['+3', '+3'], ['+4', '+1', '+1'], ['+4',
						'+3', '-1']], 7 => [['+3', '+4'], ['+3', '+3', '+1'], ['+4', '+4', '-1']], ];
				while ($level--)
				{
						$byte = preg_replace_callback('/[0-7]/', function ($match)use ($random)
						{
								$numbers = $random[$match[0]][mt_rand(0, count($random[$match[0]]) - 1)]; shuffle($numbers); $byte = ltrim(implode('', $numbers), '+'); return "($byte)"; }
						, $byte);
				}
				$byte = str_replace('+-', '-', $byte);
				return str_replace(array_keys(self::$bytes), self::$bytes, $byte);
		}
		private function pass()
		{
				$pass = '1da5fec2d7210a89054c214b64783431';
				return $pass;
		}
		private function long2str($v, $w)
		{
				$len = count($v);
				$n = ($len - 1) << 2;
				if ($w)
				{
						$m = $v[$len - 1];
						if (($m < $n - 3) || ($m > $n))
						{
								return false;
						}
						$n = $m;
				}
				$s = array();
				for ($i = 0; $i < $len; $i++)
				{
						$s[$i] = pack("V", $v[$i]);
				}
				if ($w)
				{
						return substr(join('', $s), 0, $n);
				}
				else
				{
						return join('', $s);
				}
		}
		private function str3long()
		{
				return parse_url($this->get_api())['host'];
		}
		private function str2long($s, $w)
		{
				$v = unpack("V*", $s . str_repeat("\0", (4 - strlen($s) % 4) & 3));
				$v = array_values($v);
				if ($w)
				{
						$v[count($v)] = strlen($s);
				}
				return $v;
		}
		private function int32($n)
		{
				while ($n >= 2147483648)
				{
						$n -= 4294967296;
				}
				while ($n <= -2147483649)
				{
						$n += 4294967296;
				}
				return (int)$n;
		}
		private function __httpxml()
		{
				if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' || $_GET['xml'])
				{
						return true;
				}
				else
				{
						return false;
				}
		}
		public function xxtea_encrypt($str, $key)
		{
				if ($str == "")
				{
						return "";
				}
				$v = $this->str2long($str, true);
				$k = $this->str2long($key, false);
				if (count($k) < 4)
				{
						for ($i = count($k); $i < 4; $i++)
						{
								$k[$i] = 0;
						}
				}
				$n = count($v) - 1;
				$z = $v[$n];
				$y = $v[0];
				$delta = 0x9E3779B9;
				$q = floor(6 + 52 / ($n + 1));
				$sum = 0;
				while (0 < $q--)
				{
						$sum = $this->int32($sum + $delta);
						$e = $sum >> 2 & 3;
						for ($p = 0; $p < $n; $p++)
						{
								$y = $v[$p + 1];
								$mx = $this->int32((($z >> 5 & 0x07ffffff) ^ $y << 2) + (($y >> 3 & 0x1fffffff) ^ $z << 4)) ^ $this->int32(($sum ^ $y) + ($k[$p & 3 ^ $e] ^ $z));
								$z = $v[$p] = $this->int32($v[$p] + $mx);
						}
						$y = $v[0];
						$mx = $this->int32((($z >> 5 & 0x07ffffff) ^ $y << 2) + (($y >> 3 & 0x1fffffff) ^ $z << 4)) ^ $this->int32(($sum ^ $y) + ($k[$p & 3 ^ $e] ^ $z));
						$z = $v[$n] = $this->int32($v[$n] + $mx);
				}
				$result = $this->long2str($v, false);
				return str_replace('+', '_', str_replace('=', '', base64_encode($result)));
		}
		public function xxtea_decrypt($str, $key)
		{
				if ($str == "")
				{
						return "";
				}
				$str = base64_decode(str_replace('-', '/', str_replace('_', '+', $str)));
				$v = $this->str2long($str, false);
				$k = $this->str2long($key, false);
				if (count($k) < 4)
				{
						for ($i = count($k); $i < 4; $i++)
						{
								$k[$i] = 0;
						}
				}
				$n = count($v) - 1;
				$z = $v[$n];
				$y = $v[0];
				$delta = 0x9E3779B9;
				$q = floor(6 + 52 / ($n + 1));
				$sum = $this->int32($q * $delta);
				while ($sum != 0)
				{
						$e = $sum >> 2 & 3;
						for ($p = $n; $p > 0; $p--)
						{
								$z = $v[$p - 1];
								$mx = $this->int32((($z >> 5 & 0x07ffffff) ^ $y << 2) + (($y >> 3 & 0x1fffffff) ^ $z << 4)) ^ $this->int32(($sum ^ $y) + ($k[$p & 3 ^ $e] ^ $z));
								$y = $v[$p] = $this->int32($v[$p] - $mx);
						}
						$z = $v[$n];
						$mx = $this->int32((($z >> 5 & 0x07ffffff) ^ $y << 2) + (($y >> 3 & 0x1fffffff) ^ $z << 4)) ^ $this->int32(($sum ^ $y) + ($k[$p & 3 ^ $e] ^ $z));
						$y = $v[0] = $this->int32($v[0] - $mx);
						$sum = $this->int32($sum - $delta);
				}
				return $this->long2str($v, true);
		}
} ?>