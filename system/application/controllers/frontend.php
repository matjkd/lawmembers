<?php

class Frontend extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('companies_model');
		$this->load->model('users_model');
		$this->load->model('content_model');
		$this->load->model('events_model');
		$this->load->model('newsletter_model');
		$this->load->model('gallery_model');

		$this->load->library('s3');
	}

	function index() {
		redirect('events/view/');
	}

	function view_events() {
		$data['events'] = $this->events_model->get_events();

		$data['main'] = "frontend/view_events";
		$this->load->vars($data);

		$this->load->view('frontend/template');
	}

	function view_sideevents() {
		$data['events'] = $this->events_model->get_events();

		$data['main'] = "frontend/events_side";
		$this->load->vars($data);

		$this->load->view('frontend/template');
	}

	function view_event($id) {
		$data['event'] = $this->events_model->get_event($id);
		$data['main'] = "frontend/view_event";
		$data['folder_info'] = $this->gallery_model->get_eventgallery($id);


		//grab some variables for the folder
		foreach ($data['folder_info'] as $row):
		$data['folder_name'] = $row['folder_name'];
		$data['folder_id'] = $id;
		$data['safe_name'] = $row['safe_name'];
		$data['account_id'] = 'events';
		endforeach;
		$image_folder = $data['safe_name'];

		$data['gallery_images'] = $this->gallery_model->get_images($image_folder);
		$this->load->vars($data);

		$this->load->view('frontend/template');
	}
	
	function gallery($gallery) {
		$data['content'] = $this->content_model->get_gallery($gallery);
		if ($data['content'] != NULL) {
			foreach ($data['content'] as $row):
	
			if ($row->title != NULL) {
				$data['title'] = $row->title;
			}
			$data['sidebox'] = $row->sidebox;
	
			if ($row->meta_title != NULL) {
				$data['metatitle'] = $row->meta_title;
			}
	
			if ($row->meta_keywords != NULL) {
				$data['meta_keywords'] = $row->meta_keywords;
			}
	
			if ($row->meta_desc != NULL) {
				$data['meta_description'] = $row->meta_desc;
			}
	
			$data['slideshow_active'] = $row->slideshow;
			endforeach;
		}
	
	
		$data['main'] = "global/gallery";
		$this->load->vars($data);
		$this->load->view('frontend/template');
	}
	
	function galleries() {
		$data['gallery_titles'] = $this->gallery_model->get_galleries();
		$data['main'] = "frontend/galleryList";
		$this->load->vars($data);
		
		$this->load->view('frontend/template');
	}

	function view_newsletters() {
		$data['newsletters'] = $this->newsletter_model->list_newsletters();
		$data['countries'] = $this->newsletter_model->list_countries();
		$data['country'] = $this->input->post('country');
		
		if($data['country'] == 'NULL' || $data['country'] == '') {
		$data['main'] = "frontend/newsletters/intro";
		} else {
		$data['main'] = "frontend/newsletters/main";
		}
		$this->load->vars($data);

		$this->load->view('frontend/template');
	}

}