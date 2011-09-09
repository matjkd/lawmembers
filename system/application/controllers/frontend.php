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

        function view_event($id)
        {
             $data['event'] = $this->events_model->get_event($id);
                 $data['main'] = "frontend/view_event";
                   $data['folder_info'] = $this->gallery_model->get_eventgallery($id);
           

	//grab some variables for the folder
	foreach($data['folder_info'] as $row):
		$data['folder_name'] = $row['folder_name'];
		$data['folder_id'] = $id;
		$data['safe_name'] = $row['safe_name'];
		$data['account_id'] = 'events';
	endforeach;
        $image_folder= $data['safe_name'];

             $data['gallery_images'] = $this->gallery_model->get_images($image_folder);
               $this->load->vars($data);

		$this->load->view('frontend/template');
        }
}