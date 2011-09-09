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

                $data['events'] = $this->events_model->get_events();
                $data['companies'] = $this->companies_model->list_company_names();
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
        function view_event($id)
        {
             $data['userlevel'] = $this->session->userdata('user_level');
             $data['event'] = $this->events_model->get_event($id);
                $data['companies'] = $this->companies_model->list_company_names();
             // load data for table
             $data['events'] = $this->events_model->get_events();


               // show warning
                        if($this->session->flashdata('message'))
			{
				$data['message'] = $this->session->flashdata('message');
			}

                $data['main'] = '/user/logged_in_area';
                $data['grid'] = '/events/events_grid';

                 if(  $data['userlevel'] < 2){

		$data['body'] = '/events/viewtop';
                }
                
                if(  $data['userlevel'] == 2){

                $data['body'] = '/events/memberviewtop';
                }

                $this->load->vars($data);
                $this->load->view('main_template');

        }

        function update_event()
        {
                $id = $this->input->post('event_id');

               


                 //todo add some check here
                $this->events_model->update_event($id);
                 $this->session->set_flashdata('message', 'Event Changed');
		redirect('events/view_event/'.$id);

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

        function delete_event($id)
        {
                  //todo add some check here
                 $data['userlevel'] = $this->session->userdata('user_level');
                 if($data['userlevel'] == '0' || $data['userlevel'] == '1'){

               $this->events_model->delete_event($id);
                $this->session->set_flashdata('message', 'Event Deleted');

                 }
                 else
                 {
                                     $this->session->set_flashdata('message', 'You do not have permission to delete events');

                 }
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