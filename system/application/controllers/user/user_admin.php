<?php
class User_admin extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		
		
                $this->load->model('users_model');
		$this->is_logged_in();
              
	}
	function index()
	{
		$data['main'] = '/projects/project_list';
		$this->load->vars($data);
		$this->load->view('main_template');
	}


        function create_user()
        {
            
        }
	
        
        function set_passwords()
        {
            
            //get all users
            $data['members'] = $this->users_model->get_members();
            
            //set username as email address and surname as password, then make active where user is member
            
            foreach($data['members'] as $row):
                
                echo $row['lastname']." ".$row['people_email']."<br/>";
                
            endforeach;
            
            
            
            
        }
        
        function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			$data['message'] = "You don't have permission";
			redirect('user/login');
                       
		}		
	}	
}