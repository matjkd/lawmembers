<?php
class Edit_user extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('encrypt'));
		$this->load->model('companies_model');
		$this->load->model('membership_model');
	$this->load->model('users_model');
	
		$this->is_logged_in();
              
	}
	function index()
	{
		
	}
	function _prep_password($password)
	{
	    return sha1($password.$this->config->item('encryption_key'));
	}
	function edit_password()
	{
		$userid = $this->input->post('user_id');
		if ($this->input->post('password'))
		{
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		if($this->form_validation->run() == FALSE)
				{
					$errors=validation_errors();
					$this->session->set_flashdata('message', $errors);
				redirect("members/view_employee/$userid", 'refresh');
				}
		
			else
				{
					$password = $this->input->post('password');
					$passsalt = $this->_prep_password($password);
					$this->membership_model->update_password($userid, $passsalt, $password);
				
					$this->session->set_flashdata('message', 'Password Changed');
					redirect("members/view_employee/$userid", 'refresh');
				}
		
		
		}
		else
		{
			$this->session->set_flashdata('message', 'You must enter a password');
					redirect("members/view_employee/$userid", 'refresh');
		}
		
	}
        
                 function set_passwords()
                {
                      //set generic password
                    
                    //get all users
                    $data['members'] = $this->users_model->get_members();

                    //set username as email address and surname as password, then make active where user is member

                    foreach($data['members'] as $row):
                        $password = strtolower(preg_replace('/([^@]*).*/', '$1', $row['people_email']));
                        //echo $row['lastname']." ".$row['people_email']." ".$password."<br/>";
                    
                      
                        $passsalt = $this->_prep_password($password);
                        $username = $row['people_email'];
                        $id = $row['idkeypeople'];
                       $this->users_model->set_passwords($id, $passsalt, $password, $username);
                    endforeach;
                } 

            
            
	
	function main($id)
	{
		
		$data['userdetail'] = $this->companies_model->get_employee($id);
		$data['user_id'] = $id;
		$data['main'] = '/user/logged_in_area';
		$data['body'] = '/user/edit_user';
		
		if($this->session->flashdata('message'))
			{
				$data['message'] = $this->session->flashdata('message'); 	
			}
		$this->load->vars($data);
		$this->load->view('main_template');
	}
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		$activated = $this->session->userdata('activated');
		if(!isset($is_logged_in) || $activated != 1 )
		{
			$data['message'] = "You don't have permission";
			redirect('user/login');
                       
		}		
	}	
}