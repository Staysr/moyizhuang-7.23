<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Secure_Controller extends CI_Controller 
{
	/*
	* Controllers that are considered secure extend Secure_Controller, optionally a $module_id can
	* be set to also check if a user can access a particular module in the system.
	*/
	public function __construct($module_id = NULL, $submodule_id = NULL)
	{
		parent::__construct();
		
		$this->load->model('Employee');
		$model = $this->Employee;

		if(!$model->is_logged_in())
		{
			redirect('login');
		}

		$this->Stock_location->store_all_to_session(FALSE);
		//$this->track_page($module_id, $module_id);

		$logged_in_employee_info = $model->get_logged_in_employee_info();
		if(!$model->has_module_grant($module_id, $logged_in_employee_info->person_id) || 
			(isset($submodule_id) && !$model->has_module_grant($submodule_id, $logged_in_employee_info->person_id)))
		{
			redirect('no_access/' . $module_id . '/' . $submodule_id);
		}

		// load up global data visible to all the loaded views
		$data['allowed_modules'] = $this->Module->get_allowed_modules($logged_in_employee_info->person_id);
		$data['user_info'] = $logged_in_employee_info;
		$data['controller_name'] = $module_id;

		$this->load->vars($data);
	}
	
	/*
	* Internal method to do XSS clean in the derived classes
	*/
	protected function xss_clean($str, $is_image = FALSE)
	{
		// This setting is configurable in application/config/config.php.
		// Users can disable the XSS clean for performance reasons
		// (cases like intranet installation with no Internet access)
		if($this->config->item('ospos_xss_clean') == FALSE)
		{
			return $str;
		}
		else
		{
			return $this->security->xss_clean($str, $is_image);
		}
	}

	protected function track_page($path, $page)
	{
		if(get_instance()->Appconfig->get('statistics'))
		{
			$this->load->library('tracking_lib');

			if(empty($path))
			{
				$path = 'home';
				$page = 'home';
			}

			$this->tracking_lib->track_page('controller/' . $path, $page);
		}
	}

	protected function track_event($category, $action, $label, $value = NULL)
	{
		if(get_instance()->Appconfig->get('statistics'))
		{
			$this->load->library('tracking_lib');

			$this->tracking_lib->track_event($category, $action, $label, $value);
		}
	}

	public function numeric($str)
	{
		return parse_decimals($str);
	}

	public function check_numeric()
	{
		$result = TRUE;

		foreach($this->input->get() as $str)
		{
			$result = parse_decimals($str);
		}

		echo $result !== FALSE ? 'true' : 'false';
	}


	// this is the basic set of methods most OSPOS Controllers will implement
	public function index() { return FALSE; }
	public function search() { return FALSE; }
	public function suggest_search() { return FALSE; }
	public function view($data_item_id = -1) { return FALSE; }
	public function save($data_item_id = -1) { return FALSE; }
	public function delete() { return FALSE; }

}
?>