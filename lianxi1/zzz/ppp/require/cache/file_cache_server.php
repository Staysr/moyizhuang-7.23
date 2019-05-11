<?php
require_once PHPVOD_ROOT . 'require/cache/abstract_cache_server.php';

class file_cache_server extends abstract_cache_server
{	
	const CACHE_DIR_NUM = 500; //缓存目录数量
	
	public function set($key, $value, $lifetime = 0)
	{
		//当前时间
		$now = time();
		
		//转换缓存时间
		$lifetime = $this->_convert_cachetime($lifetime);
		if($lifetime === false) return false;
		
		//过期时间
		if($lifetime == 0) //永不过期
			$expire_time = 0;
		else
			$expire_time = $now + $lifetime;
		
		//定义缓存数组
		$cache_info = array('cache' => $value, 'expire_time' => $expire_time, 'create_time' => $now);
		
		//写缓存
		$cache_dir = $this->_get_cache_dir($key);
		$value = serialize($cache_info);
		$this->_write_cache_file($cache_dir . $key, $value);
		return true;
	}
	
	public function get($key, $idx = 'cache')
	{
		//当前时间
		$now = time();
		
		//获取缓存所在目录
		$cache_dir = $this->_get_cache_dir($key);
		
		//读缓存
		$data = $this->_read_cache_file($cache_dir . $key);
		if($data === false) return false;
		$cache_info = unserialize($data);
		
		//判断缓存有没有过期
		if(isset($cache_info['expire_time']) && ($cache_info['expire_time'] > $now || $cache_info['expire_time'] == 0) && isset($cache_info['cache']))
		{
			if($idx == 'all')
			{
				unset($cache_info['expire_time']);
				return $cache_info;
			}
			elseif(isset($cache_info[$idx]))
			{
				return $cache_info[$idx];
			}
			else
			{
				return false;
			}
		}
		else
		{ 
			return false;
		}
	}

	public function delete($key)
	{
		$cache_dir = $this->_get_cache_dir($key);
		if(is_file($cache_dir . $key)) 
			return $this->_del_cache_file($cache_dir . $key);
	}
		
	public function clear()
	{
		$dir = PHPVOD_ROOT . 'data/cache/file_cache/'; //缓存目录
		if(!is_dir($dir)) return false;
		if($handle = opendir($dir))
		{
			while(($file = readdir($handle)))
			{
				if($file == "." || $file == "..")
				{
					continue;
				}
				if(is_dir($dir . "/" . $file))
				{
					$this->_del_cache_dir($dir . "/" . $file);
				}
				else
				{
					$this->_del_cache_file($dir . "/" . $file);
				}
			}
			closedir($handle);
		}
		return true;
	}

	private function _write_cache_file($filename, $data, $method = 'rb+', $iflock = 1, $chmod = 1)
	{
		touch($filename);
		$handle = fopen($filename, $method);
		$iflock && flock($handle, LOCK_EX);
		fwrite($handle, $data);
		$method == 'rb+' && ftruncate($handle, strlen($data));
		fclose($handle);
		$chmod && @chmod($filename, 0777);
	}

	private function _read_cache_file($filename, $method = 'rb')
	{
		$filedata = false;
		if(is_file($filename))
		{
			if($handle = @fopen($filename, $method))
			{
				flock($handle, LOCK_SH);
				$filedata = @fread($handle, filesize($filename));
				fclose($handle);
			}
		}
		return $filedata;
	}

	private function _del_cache_file($filename)
	{
		return @unlink($filename);
	}
	
	private function _del_cache_dir($dirname)
	{
		if(is_dir($dirname))
		{
			if($handle = opendir($dirname))
			{
				while(($file = readdir($handle)))
				{
					if($file == "." || $file == "..")
					{
						continue;
					}
					if(is_dir($dirname . "/" . $file))
					{
						$this->_del_cache_dir($dirname . "/" . $file);
					}
					else
					{
						$this->_del_cache_file($dirname . "/" . $file);
					}
				}
				closedir($handle);
				return @rmdir($dirname);
			}
			return false;
		}
		else
		{
			return false;
		}
	}	

	private function _get_cache_dir($key)
	{
		$dir = PHPVOD_ROOT . 'data/cache/file_cache/';
		$dirname = str_pad(abs(crc32($key)) % self::CACHE_DIR_NUM, 4, '0', STR_PAD_LEFT);
		$cache_dir = empty($dirname) ? $dir : $dir . $dirname . '/';
		
		$r = true;
		if(!is_dir($cache_dir)) $r = mkdir($cache_dir, 0777);
		
		return $r ? $cache_dir : $dir;
	}
}

?>