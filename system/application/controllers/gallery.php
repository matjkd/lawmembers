<?php

class Gallery extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('companies_model');
		$this->load->model('users_model');
		$this->load->model('Gallery_model');
		$this->load->model('newsletter_model');
		$this->is_logged_in();
	}

	function index() {
		$data['userlevel'] = $this->session->userdata('user_level');
		$data['users'] = $this->users_model->list_users();
		$data['companies'] = $this->companies_model->list_companies();
		$data['newsletters'] = $this->newsletter_model->list_newsletters();
		$data['gallery_titles'] = $this->Gallery_model->get_galleries();
		$data['category'] = "gallery";
		$data['main'] = '/user/logged_in_area';

		$data['body'] = '/gallery/main';
		$this->load->vars($data);
		$this->load->view('main_template');
	}

	function is_logged_in() {
		$is_logged_in = $this->session->userdata('is_logged_in');
		if (!isset($is_logged_in) || $is_logged_in != true) {
			$this->session->set_flashdata('conf_msg', "You need to log in");
			redirect('user/login');
		}
	}

}