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

            $data['userlevel'] = $is_logged_in = $this->session->userdata('user_level');
                   //get list of all events
                //$data['events'] = $this->events_model->list_events();

                $data['company_id'] = NULL;
                $data['main'] = '/user/logged_in_area';
                $data['grid'] = '/events/events_grid';

                 if(  $data['userlevel'] < 2){

		$data['body'] = '/events/top';
                }
                 if(  $data['userlevel'] == 2){
                 $data['body'] = '/events/membertop';
                }



		
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