<?php
class Referrals extends MY_Controller 
{
function __construct()
	{
		parent::__construct();
		$this->load->model('companies_model');
		$this->load->model('Gallery_model');
		$this->is_logged_in();
              
	}
	function index()
	{
		
	}
function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			$this->session->set_flashdata('conf_msg', "You need to log in");
			redirect('user/login');
                       
		}		
	}
	
}