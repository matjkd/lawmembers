<?php
class Members extends MY_Controller 
{
function __construct()
	{
		parent::__construct();
		$this->load->model('companies_model');
                $this->load->model('users_model');
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
				$data['next_record'] = $this->companies_model->next_company($data['company_id']);
				$data['previous_record'] = $this->companies_model->previous_company($data['company_id']);
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
		

                 // show warning
                        if($this->session->flashdata('message'))
			{
				$data['message'] = $this->session->flashdata('message');
			}



		$data['main'] = '/user/logged_in_area';
		$data['grid'] = '/members/companygrid';
		$data['body'] = '/members/view-company';
		$this->load->vars($data);
		$this->load->view('main_template');
	}
        function users()
        {

            //get list of all users
            $data['users'] = $this->users_model->list_users();

                $data['company_id'] = 0;
                $data['main'] = '/user/logged_in_area';
		$data['grid'] = '/users/usergrid';
		$data['body'] = '/users/top';
		$this->load->vars($data);
		$this->load->view('main_template');

            
        }

	function view_employee($id)
	{
		$data['companies'] = $this->companies_model->list_companies(); 
		$data['employee_id'] = $id;
		$data['employee_detail'] = $this->companies_model->get_employee($id);
		$data['main'] = '/user/logged_in_area';
		$data['grid'] = '/members/companygrid';
		$data['body'] = '/members/view_employee';
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
function edit_employee()
	{
		$data['id'] = $this->input->post('id');
		$data['field'] = $this->input->post('elementid');
		$data['value'] = $this->input->post('value');
		
		$this->companies_model->edit_employee($data['id'], $data['field'], $data['value']);
		
		$update = $this->input->post('value');
		if($data['field'] == 'people_resume')
			{
				redirect('members/view_employee/'.$data['id'].'');			
				
			}
		$this->output->set_output($update);
	}
function edit_address()
	{
		$data['id'] = $this->input->post('id');
		$data['field'] = $this->input->post('elementid');
		$data['value'] = $this->input->post('value');
		
		$this->companies_model->edit_address($data['id'], $data['field'], $data['value']);
		
		$update = $this->input->post('value');
		
		if($data['field'] == 'region')
			{
							
				$data['data'] = $this->companies_model->get_region($data['value']);
			
				foreach($data['data'] as  $row2):
					$update = $row2['region_name'];
				endforeach;	
			}
		
		$this->output->set_output($update);
	}
function edit_description($id) 
	{
			$this->companies_model->update_description($id); 
		
			redirect('members/view/'.$id.'');  
	}
function edit_local_description($id) 
	{
			$this->companies_model->update_local_description($id); 
		
			redirect('members/view/'.$id.'');  
	}

	
	function add_address($id)
	{
		$this->form_validation->set_rules('address1', 'address1', 'trim|required');
		if($this->form_validation->run() == FALSE)
			{
			
				$errors=validation_errors();
				$this->session->set_flashdata('message','There was a problem adding the address. The first line is required');
				redirect("members/view/$id");
			}
			else
			{
				if($query = $this->companies_model->add_new_address($id))
				{
					
					foreach($query as $resultdata)
					{
					
					redirect("members/view/$id");
					}
					
				}
				else
				{
					redirect("members/view/$id");
				}
			}
	}
	
	function add_employee($id)
	{
		$this->form_validation->set_rules('firstname', 'firstname', 'trim|required');
			if($this->form_validation->run() == FALSE)
				{
				
					$errors=validation_errors();
					$this->session->set_flashdata('message','There was a problem adding the employee. firstname is required');
					redirect("members/view/$id");
				}
				else
				{
					if($this->companies_model->add_new_employee($id))
					{
						
						
						$member_id = $this->db->insert_id();
						redirect("members/view_employee/$member_id");
						
						
					}
					
				}
	}
	
	function create_company()
	{
	// field name, error message, validation rules
		$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
		
		
		if($this->form_validation->run() == FALSE)
		{
		
			$errors=validation_errors();
			$this->session->set_flashdata('message','There was a problem...');
			redirect('contacts/add_company/');
		
		}
	else
		{			
					
			if($query = $this->companies_model->add_company())
			{
				
				foreach($query as $resultdata)
				{
				$companyid = mysql_insert_id();
				
				$this->companies_model->add_address($companyid);
				//$this->companies_model->add_employee($companyid);
				redirect('members/view/'.$companyid.'');
				}
				
			}
			else
			{
				redirect('members/view/');
			}
		}
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
function upload_profile_image()
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
				$this->ftp->delete_file('/public_html/admin/images/profiles/'.$current_image.'');
				$this->ftp->delete_file('/public_html/admin/images/profiles/thumbs/'.$current_image.'');
				$this->ftp->close();
		}
		$id = $this->input->post('id');
		if($this->input->post('upload'))
		{
			$this->Gallery_model->do_profile_upload($id);
		}
			
		redirect('members/view_employee/'.$id.'');   // or whatever logic needs to occur
		
	}
        function delete_employee()
        {
          
            $id = $this->input->post('id');
              $this->companies_model->delete_employee($id);
          
        }

        function delete_company($id)
        {

         //get company details
           $data['company'] = $this->companies_model->get_company($id); 

            //get users details
        $data['employees'] = $this->companies_model->get_employees($id);


        $data['main'] = '/user/logged_in_area';
		
		$data['body'] = '/members/delete_confirm';
		$this->load->vars($data);
		$this->load->view('main_template');


        }

        function delete_company_confirm() {

            $id = $this->input->post('idcompany');

         
            if($id == 1)
		{
			//so you can't delete my company
			$this->session->set_flashdata('message', 'You are not allowed to delete this company');
			redirect('members/view');

		}

                else

                {


                //delete employees
                    $this->companies_model->delete_employees($id);

                //delete addresses
                    $this->companies_model->delete_addresses($id);

                //delete company
                    $this->companies_model->delete_company($id);

                $this->session->set_flashdata('message', 'company deleted');
		redirect('members/view'); 

                }
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