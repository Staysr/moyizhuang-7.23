<?php
class phpvod_curl
{
	private $_ch = NULL;

	function __construct()
	{
		$this->_ch = curl_init();
	}

	function __destruct()
	{
		is_resource($this->_ch) && curl_close($this->_ch);
	}

	function run($opt)
	{
		$opts = array(
			CURLOPT_HEADER => false,
			CURLOPT_RETURNTRANSFER => true
		);
		foreach($opt as $k => $v)
		{
			$opts[$k] = $v;
		}
		curl_setopt_array($this->_ch, $opts);
		$r['return'] = curl_exec($this->_ch);
		$r['errno'] = curl_errno($this->_ch);
		$r['error'] = curl_error($this->_ch);
		curl_close($this->_ch);
		return $r;
	}

	function get($url = '', $opt = array())
	{
		$opt[CURLOPT_URL] = $url;
		return $this->run($opt);
	}

	function post($url = '', $data = array(), $opt = array())
	{
		$opt[CURLOPT_POST] = true;
		$opt[CURLOPT_URL] = $url;
		$opt[CURLOPT_POSTFIELDS] = $data;
		return $this->run($opt);
	}
}
?>