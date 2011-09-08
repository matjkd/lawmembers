<?php
class Events extends MY_Controller
{
function __construct()
	{
		parent::__construct();
		$this->load->model('companies_model');
                $this->load->model('users_model');
                       $this->load->model('events_model');
		$this->is_logged_in();

	}
	function index()
	{
		redirect('events/view/');
	}


        function view()
        {

            $data['userlevel'] = $this->session->userdata('user_level');
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

                // show warning
                        if($this->session->flashdata('message'))
			{
				$data['message'] = $this->session->flashdata('message');
			}


		
		$this->load->vars($data);
		$this->load->view('main_template');
        }

        function create_event()
        {
                //validation
               $this->form_validation->set_rules('location', 'Location', 'trim|required');


		if($this->form_validation->run() == FALSE)
		{

			$errors=validation_errors();
			$this->session->set_flashdata('message', $errors);
			redirect('events/view');

		}
                   //todo add some check here
                $this->events_model->add_event();


               $this->session->set_flashdata('message', 'Event Added');
		redirect('events/view');




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