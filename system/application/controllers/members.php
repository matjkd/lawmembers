<?php
class Members extends MY_Controller 
{
function __construct()
	{
		parent::__construct();
		$this->load->model('companies_model');
		$this->load->model('Gallery_model');
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
				$data['company_id'] = 0;
				
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

	function list_members()
	{
		$segment_active = $this->uri->segment(3);
		if ($segment_active!=NULL)
			{
				$data['company_id'] = $this->uri->segment(3);
			}
		else
			{
				$data['company_id'] = 0;
				
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
		
		$data['body'] = '/members/list_members';
		$this->load->vars($data);
		$this->load->view('main_template');
	}
	
function view_address()
	{
		$segment_active = $this->uri->segment(3);
		$data['address'] = $this->companies_model->get_address($segment_active); 
		
		$data['companies'] = $this->companies_model->list_companies(); 
		$data['address_id'] = $segment_active;
		$data['main'] = '/user/logged_in_area';
		$data['grid'] = '/members/companygrid';
		$data['body'] = '/members/edit_address';
		$this->load->vars($data);
		$this->load->view('/members/edit_address');
		
		
	}
function edit_company()
	{
		$data['id'] = $this->input->post('id');
		$data['field'] = $this->input->post('elementid');
		$data['value'] = $this->input->post('value');
		
		$this->companies_model->edit_company($data['id'], $data['field'], $data['value']);
		
		$update = $this->input->post('value');
		
		if($data['field'] == 'active')
			{
							
				if($data['value'] == 0 ) {$update = 'No';}
				if($data['value'] == 1 ) {$update = 'Yes';}
			
			}
			
		$this->output->set_output($update);
	}
function edit_description($id) 
	{
			$this->companies_model->update_description($id); 
		
			redirect('members/view/'.$id.'');  
	}
	
function upload_image()
	{
		$current_image = $this->input->post('current_image');
		
		if($current_image != NULL)
		{
			
			//Delete Current image before creating new one
			$this->load->library('ftp');
				$config['hostname'] = $this->config_ftp_host;
				$config['username'] = $this->config_ftp_user;
				$config['password'] = $this->config_ftp_password;
				$config['debug'] = TRUE;
				$this->ftp->connect($config);
				$this->ftp->delete_file('/public_html/admin/images/companies/'.$current_image.'');
				$this->ftp->delete_file('/public_html/admin/images/companies/thumbs/'.$current_image.'');
				$this->ftp->close();
		}
		$id = $this->input->post('id');
		if($this->input->post('upload'))
		{
			$this->Gallery_model->do_upload($id);
		}
			
		redirect('members/view/'.$id.'');   // or whatever logic needs to occur
		
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