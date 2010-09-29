<?php
class Login extends MY_Controller {

function Login()
	{
		parent::__construct();
		$this->load->library(array('encrypt', 'form_validation'));
		
	}
	
	
	function index()
	{
		$this->is_logged_in();
		//$data['query'] = $this->db->get('content');	
		$data['main'] = 'user/index';
		$this->load->vars($data);
		$this->load->view('main_template');
	
	
	
	}
	function validate_credentials()
	{		
		$this->load->model('membership_model');
		$query = $this->membership_model->validate();
		
		
	if($query) // if the user's credentials validated...
		{
			
			
			$this->db->where('username', $this->input->post('username'));
			$query2 = $this->db->get('users');
			if($query2->num_rows == 1)
			{
				foreach($query2->result() as $row)
					{
						$user_level = $row->user_level;
						$user_id = $row->id;
						$user_firstname = $row->firstname;
						$user_lastname = $row->lastname;
						$activated = $row->activated;
					}
			}
			$this->db->where('employee_id', $user_id);
			$query3 = $this->db->get('company_members');
			if($query3->num_rows == 1)
			{
				foreach($query3->result() as $row)
					{
						$company_id = $row->company_id;
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
		$this->session->set_flashdata('conf_msg', "Welcome");
				redirect('contacts/');
		}
		else // incorrect username or password
	
		{
			
			
		
		$this->session->set_flashdata('conf_msg', "Account Details Not Valid");
		
		redirect('user/login');
			
			
		}
	}	
	
	function register()
	{
		$data['main'] = '/user/register';
		$this->load->vars($data);
		$this->load->view('main_template');
		
	}
	
	function create_member()
	{
		
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('firstname', 'Name', 'trim|required');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		
		
		if($this->form_validation->run() == FALSE)
		{
			$data['main'] = 'user/register';
		$this->load->vars($data);
		$this->load->view('main_template');
			//$this->template->load('template', 'user/register');
		}
		
		else
		{			
			$this->load->model('membership_model');
			
			if($query = $this->membership_model->create_member())
			{
				$data['main'] = 'user/signup_successful';
		$this->load->vars($data);
		$this->load->view('main_template');
				//$this->template->load('template', 'user/signup_successful');
			}
			else
			{
				$data['main'] = 'user/register';
		$this->load->vars($data);
		$this->load->view('main_template');
				//$this->template->load('template', 'user/register');		
			}
		}
		
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in == true)
		{
			redirect($this->uri->uri_string());
		}		
		$this->index();
	}
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in == true)
		{
			redirect('contacts/');
		}		
	}	

}


	

/* End of file login.php */
/* Location: ./system/application/controllers/user/login.php */