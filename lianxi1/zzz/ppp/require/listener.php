<?php
defined('IN_PHPVOD') or exit('Access Denied');
abstract class listener
{
	private $listener_id;
	
	public function __construct($param)
	{
		$this->listener_id = $param;
	}
	
	public function get_listener_config()
	{
		include PHPVOD_ROOT . 'data/cache/listener.php';
		return $_listener[$this->listener_id];
	}

	public function run_common()
	{
	}

	public function run_admincp()
	{
	}

	public function run_global()
	{
	}

	public function run_header()
	{
	}

	public function run_footer()
	{
	}

	public function run_output()
	{
	}

	public function before_postvideo(&$param)
	{
	}

	public function after_postvideo($param)
	{
	}

	public function before_editvideo(&$param)
	{
	}

	public function after_editvideo($param)
	{
	}

	public function before_postreply(&$param)
	{
	}

	public function after_postreply($param)
	{
	}

	public function before_register(&$param)
	{
	}

	public function after_register($param)
	{
	}

	public function before_login(&$param)
	{
	}

	public function after_login($param)
	{
	}
	
	public function load_player(&$param)
	{
	}
}

?>