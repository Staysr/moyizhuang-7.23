<?php
interface cache_server
{
	public function set($key, $value, $lifetime = 0);
	public function get($key, $idx = 'cache');
	public function delete($key);
	public function clear();
}
?>