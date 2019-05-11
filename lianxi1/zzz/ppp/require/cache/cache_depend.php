<?php
class cache_depend
{
	private $cs = null;
	public function __construct($cs)
	{
		$this->cs = $cs;
	}

	/**
	 * 获取缓存依赖最后更新时间
	 * @param string $key 依赖KEY (cid/cids/artcid/best/reply)
	 * @param string $value 依赖VALUE，默认为null
	 * @return int 最后更新的时间戳，如果依赖不存在，则返回0
	 */
	public function get_depend_lasttime($key, $value = null)
	{
		if($key == 'cid')
		{
			$cache_key = 'class_lasttime_' . $value;
			return $this->_get_depend_lasttime($cache_key);
		}
		elseif($key == 'cids')
		{
			$r = 0;
			$cids = getsubcid($value);
			if($value != '-1')
				$cids .= empty($cids) ? $value : ',' . $value;

			$cid_list = explode(',', $cids);
			foreach ($cid_list as $cid)
			{
				$cache_key = 'class_lasttime_' . $cid;
				$time = $this->_get_depend_lasttime($cache_key);
				if($time > $r) $r = $time;
			}
			return $r;
		}
		elseif($key == 'artcid')
		{
			$cache_key = 'artclass_lasttime_' . $value;
			return $this->_get_depend_lasttime($cache_key);
		}
		elseif($key == 'best')
		{
			$cache_key = 'best_lasttime';
			return $this->_get_depend_lasttime($cache_key);
		}
		elseif($key == 'reply')
		{
			$cache_key = 'reply_lasttime_' . $value;
			return $this->_get_depend_lasttime($cache_key);
		}
	}

	/**
	 * 刷新依赖最后更新时间
	 * @param string $key 依赖KEY (cid/artcid/best/reply)
	 * @param mixed<String Array> $value 依赖VALUE；默认为null
	 */
	public function refresh_depend_lasttime($key, $value = null)
	{
		$now = time();
		$cache_key_list = array();
		$cache_key_pre = '';
		
		switch ($key)
		{
			case 'cid':
				$cache_key_pre = 'class_lasttime_';
				break;
			case 'artcid':
				$cache_key_pre = 'artclass_lasttime_';
				break;
			case 'best':
				$cache_key_pre = 'best_lasttime';
				break;
			case 'reply':
				$cache_key_pre = 'reply_lasttime_';
				break;
		}
		
		if(!empty($cache_key_pre))
		{
			if(is_array($value))
			{
				foreach($value as $item)
					$cache_key_list[] = $cache_key_pre . $item;
			}
			else 
			{
				$cache_key = !is_null($value) ? $cache_key_pre . $value : $cache_key_pre;
				$cache_key_list[] = $cache_key;
			}
		}
		
		foreach($cache_key_list as $cache_key)
		{
			if(empty($cache_key)) continue;
			$this->cs->set($cache_key, $now);
		}
	}
	
	/**
	 * 从缓存中获取key的值。
	 * @param string $key 缓存KEY
	 * @return int 返回KEY的值（时间戳），如果KEY不存在则返回0
	 */
	private function _get_depend_lasttime($key)
	{
		$r = $this->cs->get($key);
		if($r === false) $r = 0;
		return (int)$r;
	}	
}

?>
