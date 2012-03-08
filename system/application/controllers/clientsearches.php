<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clientsearches extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('user_agent');
        $this->load->model('users_model');
        $this->load->model('companies_model');
        $this->load->model('clientsearch_model');
        $this->is_logged_in();
    }

    function index() {

        $data['userlevel'] = $this->session->userdata('user_level');

        $data['users'] = $this->users_model->list_users();
        $data['companies'] = $this->companies_model->list_companies();

        if ($data['userlevel'] == 2) {
            redirect('clientsearches/list_searches');
        }

        $data['main'] = '/user/logged_in_area';


        if (isset($this->alertmessage)) {
            $data['message'] = $this->alertmessage;
        }

        $data['searches'] = $this->clientsearch_model->get_searches();
        $data['body'] = '/clientsearch/form';
        $this->load->vars($data);
        $this->load->view('main_template');
    }

    function list_searches() {
        $data['userlevel'] = $this->session->userdata('user_level');
        $data['main'] = '/user/logged_in_area';
        $data['searches'] = $this->clientsearch_model->get_searches();
        $data['body'] = '/clientsearch/view_searches';
        $this->load->vars($data);
        $this->load->view('main_template');
    }

    function add_search() {

        //do validation
        $this->form_validation->set_rules('member_name', 'member_name', 'trim|required');
        $this->form_validation->set_rules('title', 'title', 'trim');
        $this->form_validation->set_rules('company', 'company', 'trim');
        $this->form_validation->set_rules('content', 'content', 'trim');


        if ($this->clientsearch_model->add_search()) {
            $this->alertmessage = "entry added";
            $this->index();
        } else {
            $this->alertmessage = "..";
            $this->index();
        }
    }

    function delete_search($id) {
        $this->clientsearch_model->delete_search($id);
        $data['message'] = "search deleted";
        redirect('clientsearches');
    }

    function is_logged_in() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        $activated = $this->session->userdata('activated');
        if (!isset($is_logged_in) || $activated != 1) {
            $data['message'] = "You don't have permission";
            redirect('user/login');
        }
    }

}