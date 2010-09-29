<?php
class Members extends MY_Controller 
{
function __construct()
	{
		parent::__construct();
		$this->load->model('companies_model');
		$this->is_logged_in();
              
	}
	function index()
	{
		redirect('members/view/');
	}
function view()
	{
		$segment_active = $this->uri->segment(3);
		if ($segment_active!=NULL)
			{
				$data['company_id'] = $this->uri->segment(3);
			}
		else
			{
				$data['company_id'] = $this->session->userdata('company_id');
				
			}
		$id = $data['company_id'];
		
		$data['companies'] = $this->companies_model->list_companies(); 
		$data['company'] = $this->companies_model->get_company($id); 
		
		$data['employees1'] = $this->companies_model->get_employees($id);	
		if ($data['employees1'] == NULL)
			{
			$data['employees'] = "no"; 
			}
		else
			{
			$data['employees'] = $this->companies_model->get_employees($id); 
			}
		
		
		$data['addresses1'] = $this->companies_model->get_addresses($id);	
		if ($data['addresses1'] == NULL)
			{
			$data['addresses'] = "no"; 
			}
		else
			{
			$data['addresses'] = $this->companies_model->get_addresses($id); 
			}
		
		
		$data['main'] = '/user/logged_in_area';
		$data['grid'] = '/members/companygrid';
		$data['body'] = '/members/view-company';
		$this->load->vars($data);
		$this->load->view('main_template');
	}
function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			$this->session->set_flashdata('conf_msg', "You need to log in");
			redirect('user/login');
                       
		}		
	}	
	

}