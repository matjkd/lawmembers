<?php
class Frontend extends MY_Controller
{
function __construct()
	{
		parent::__construct();
		$this->load->model('companies_model');
                $this->load->model('users_model');
                $this->load->model('events_model');
                $this->load->model('gallery_model');

		$this->load->library('s3');


	}
	function index()
	{
		redirect('events/view/');
	}
        function view_events()
        {
               $data['events'] = $this->events_model->get_events();
               
               $data['main'] = "frontend/view_events";
               $this->load->vars($data);

		$this->load->view('frontend/template');
        }
}