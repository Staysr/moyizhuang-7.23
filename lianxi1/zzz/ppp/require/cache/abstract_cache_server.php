<?php
require_once PHPVOD_ROOT . 'require/cache/cache_server.php';
abstract class abstract_cache_server implements cache_server
{
	/**
	 * 转换缓存时间
	 * @param string $cachetime 缓存时间(字符串格式)
	 * @return number|bool
	 */
	public function _convert_cachetime($cachetime)
	{
		$s = array();
		preg_match('/^(\d+)([ymdhis]?)$/is', $cachetime, $s);
		if(is_numeric($s[1]) && $s[1] >= 0)
		{
			if(!empty($s[2])) //有单位
			{
				switch($s[2])
				{
					case 'y':
						return $s[1] * 31536000;
						break;
					case 'm':
						return $s[1] * 2592000;
						break;
					case 'd':
						return $s[1] * 86400;
						break;
					case 'h':
						return $s[1] * 3600;
						break;
					case 'i':
						return $s[1] * 60;
						break;
					default:
						return $s[1];
						break;
				}
			}
			else //没单位
			{
				return $s[1];
			}
		}
		else
		{
			return false; //转换失败
		}
	}
}

?>