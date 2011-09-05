<?php
class Events extends MY_Controller
{
function __construct()
	{
		parent::__construct();
		$this->load->model('companies_model');
                $this->load->model('users_model');

		$this->is_logged_in();

	}
	function index()
	{
		redirect('events/view/');
	}


        function view()
        {
                   //get list of all users
                $data['users'] = $this->users_model->list_users();

                $data['company_id'] = NULL;
                $data['main'] = '/user/logged_in_area';

		$data['body'] = '/events/top';
		$this->load->vars($data);
		$this->load->view('main_template');
        }

        function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		$role = $this->session->userdata('role');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			$data['message'] = "You don't have permission";
			redirect('welcome', 'refresh');

		}

	}	
}