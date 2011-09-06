<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Clientsearches extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		$this->load->model('companies_model');
		$this->is_logged_in();
	}

        function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		$activated = $this->session->userdata('activated');
		if(!isset($is_logged_in) || $activated != 1 )
		{
			$data['message'] = "You don't have permission";
			redirect('user/login');

		}
	}
}