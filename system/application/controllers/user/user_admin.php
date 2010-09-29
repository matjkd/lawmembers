<?php
class User_admin extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Grid_model');
		$this->is_logged_in();
              
	}
	function index()
	{
		$data['main'] = '/projects/project_list';
		$this->load->vars($data);
		$this->load->view('main_template');
	}
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			$data['message'] = "You don't have permission";
			redirect('user/login');
                       
		}		
	}	
}