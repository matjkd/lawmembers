<?php

class Login extends MY_Controller {

    function Login() {
        parent::__construct();
        $this->load->library(array('encrypt', 'form_validation'));
    }

    /**
     * 
     */
    function index() {


        $this->is_logged_in();
        //$data['query'] = $this->db->get('content');
        // show warning
        if ($this->session->flashdata('message')) {
            $data['message'] = $this->session->flashdata('message');
        }
        $data['main'] = 'user/index';
        $this->load->vars($data);
        $this->load->view('main_template');
    }

    function _prep_password($password) {
        return sha1($password . $this->config->item('encryption_key'));
    }

    /**
     * 
     */
    function validate_credentials() {
        $this->load->model('membership_model');

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('message', $errors);
            redirect("user/login", 'refresh');
        }

        //convert password to salt
        $password = $this->input->post('password');
        $passsalt = $this->_prep_password($password);

        $query = $this->membership_model->validate($passsalt);


        if ($query) { // if the user's credentials validated...
            $this->db->where('username', $this->input->post('username'));
            $query2 = $this->db->get('mydb_keypeople');
            if ($query2->num_rows == 1) {
                foreach ($query2->result() as $row) {
                    $user_level = $row->level;
                    $user_id = $row->idkeypeople;
                    $user_firstname = $row->firstname;
                    $user_lastname = $row->lastname;
                    $activated = $row->user_active;
                    $company_id = $row->idcompany;
                }
            }


            $data = array(
                'username' => $this->input->post('username'),
                'user_level' => $user_level,
                'user_id' => $user_id,
                'activated' => $activated,
                'user_firstname' => $user_firstname,
                'user_lastname' => $user_lastname,
                'company_id' => $company_id,
                'is_logged_in' => true,
            );

            $this->session->set_userdata($data);
            $this->session->set_flashdata('message', "Welcome");
            redirect('members/landing');
        } else { // incorrect username or password
            $this->session->set_flashdata('message', "Account Details Not Valid");

            redirect('user/login');
        }
    }

    /**
     * 
     */
    function register() {
        $data['main'] = '/user/register';
        $this->load->vars($data);
        $this->load->view('main_template');
    }

    /**
     * 
     */
    function create_member() {


        // field name, error message, validation rules
        $this->form_validation->set_rules('firstname', 'Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');


        if ($this->form_validation->run() == FALSE) {
            $data['main'] = 'user/register';
            $this->load->vars($data);
            $this->load->view('main_template');
            //$this->template->load('template', 'user/register');
        } else {
            $this->load->model('membership_model');

            if ($query = $this->membership_model->create_member()) {
                $data['main'] = 'user/signup_successful';
                $this->load->vars($data);
                $this->load->view('main_template');
                //$this->template->load('template', 'user/signup_successful');
            } else {
                $data['main'] = 'user/register';
                $this->load->vars($data);
                $this->load->view('main_template');
                //$this->template->load('template', 'user/register');		
            }
        }
    }

    /**
     * 
     */
    function logout() {
        $this->session->sess_destroy();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in == true) {
            redirect($this->uri->uri_string());
        }
        $this->index();
    }

    /**
     * 
     */
    function is_logged_in() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in == true) {
            redirect('members/');
        }
    }

}

/* End of file login.php */
/* Location: ./system/application/controllers/user/login.php */