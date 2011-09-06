<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Filetransfer extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		$this->load->model('companies_model');
		$this->load->model('filetransfer_model');
		$this->load->library('upload');
		$this->load->library('s3');
		$this->is_logged_in();
	}

	function index()
	{
		if($this->session->flashdata('message'))
			{
				$this->session->set_flashdata('message', $this->session->flashdata('message'));
			}
		redirect('filetransfer/setup');
	}
	function setup()
	{
		 $data['userlevel'] = $is_logged_in = $this->session->userdata('user_level');
                //load company names
		$data['companies'] = $this->companies_model->list_company_names();


                // list transfer accounts
                $data['transferAccounts'] = $this->filetransfer_model->getTransferAccounts();

		//load template files
		$data['main'] = '/user/logged_in_area';


                    if(  $data['userlevel'] < 2){

		$data['body'] = '/filetransfer/setup';
                }
                 if(  $data['userlevel'] == 2){
		$data['body'] = '/filetransfer/listaccounts';
                }


		

		if($this->session->flashdata('message'))
			{
				$data['message'] = $this->session->flashdata('message');
			}
		$this->load->vars($data);
		$this->load->view('main_template');
	}

	function create_folder()
	{
		$this->form_validation->set_rules('folder_name', 'folder_name', 'trim|required');
		if($this->form_validation->run() == FALSE)
			{
			$data['errors'] = validation_errors();

			$this->session->set_flashdata('message', $data['errors']);
			redirect($this->agent->referrer());
			}
		$id = $this->input->post('account_id');
		$this->filetransfer_model->create_folder();
		redirect('filetransfer/view_account/'.$id);

	}


	/**
	 * View folder and get contents from bucket
	 *
	 *
	 *
	 */
	function view_folder($id) //folder id
	{
       $data['userlevel'] = $is_logged_in = $this->session->userdata('user_level');
	//get folder info
	$bucket = $this->config_bucket;
	$data['mainbucket'] = $bucket;
	$data['folder_info'] = $this->filetransfer_model->get_folder($id);
	$data['complete_redirect'] = base_url()."filetransfer/view_folder/".$id."/";

	//grab some variables for the folder
	foreach($data['folder_info'] as $row):
		$data['folder_name'] = $row['folder_name'];
		$data['folder_id'] = $id;
		$data['safe_name'] = $row['safe_name'];
		$data['account_id'] = $row['account_id'];
	endforeach;

        //info for log
	$data['logUsername'] = $this->session->userdata('username');
        $data['logFolder'] = $data['folder_name'];

    // get company id from transfer account id
		$data['logaccount_data'] = $this->filetransfer_model->get_account($data['account_id']);
		foreach($data['logaccount_data'] as $row):
			$logcompany_id = $row->company_id;

		endforeach;

        //get company
		$data['company'] = $this->companies_model->get_company($logcompany_id);
			foreach($data['company'] as $row2):
                                $data['logCompanyName'] = $row2->company_name;

                        endforeach;


	$data['bucket_name'] = $data['account_id']."/".$data['safe_name'];
	$folder = "";
	$data['folder'] = $folder;


	//get folder contents

	$data['bucket_contents'] = $this->s3->getBucket($bucket);


  $data['AWS_ACCESS_KEY_ID'] = $this->access_key ;
  $data['AWS_SECRET_ACCESS_KEY'] = $this->secret_key ;

 		$data['main'] = '/user/logged_in_area';

                  if(  $data['userlevel'] < 2){

		$data['body'] = '/filetransfer/view_folder2';
                }
                 if(  $data['userlevel'] == 2){
		$data['body'] = 'filetransfer/files_table';
                }

		

		if($this->session->flashdata('message'))
			{
				$data['message'] = $this->session->flashdata('message');
			}
		$this->load->vars($data);
		$this->load->view('main_template');
	}

	function delete_file()
	{

		$bucket = $this->config_bucket;
		$folder = $this->input->post('folder');
		$file = $this->input->post('filename');
		$this->s3->deleteObject($bucket, $folder."/".$file);

		//echo "$bucket $folder $file";

		redirect($this->agent->referrer());
	}



	function delete_folder($id)
	{


		//retrieve folder information
		$data['folder_data'] = $this->filetransfer_model->get_folder($id);
		foreach($data['folder_data'] as $row):
			$safename = $row['safe_name'];
			$account_id = $row['account_id'];
		endforeach;
		//remove folder from database
		$this->filetransfer_model->delete_folder($id);


		//delete folder from amazons3
		//echo $safename;

		redirect('filetransfer/view_account/'.$account_id);
	}
	function _prep_password($password)
	{
	    return sha1($password.$this->config->item('encryption_key'));
	}

	function create_user()
	{
		//form validation goes here
		$this->form_validation->set_rules('firstname', 'firstname', 'trim|required');
		$this->form_validation->set_rules('lastname', 'lastname', 'trim|required');
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		if($this->form_validation->run() == FALSE)
			{
			$data['errors'] = validation_errors();

			$this->session->set_flashdata('message', $data['errors']);
			redirect($this->agent->referrer());
			}

		$company_id =  $this->input->post('company_id');
		$password = $this->input->post('password');
		$passSalt = $this->_prep_password($password);

		$this->filetransfer_model->add_user($company_id, $passSalt);

		//$this->filetransfer_model->assign_user_to_account($user_id, $account_id);
		redirect($this->agent->referrer());

	}

	function assign_user_to_folder()
	{
		$id = $this->input->post('account_id');
		$user_id = $this->input->post('users');
		$folder_id = $this->input->post('folder_id');

		$this->filetransfer_model->assign_user_to_folder($user_id, $folder_id);

	redirect('filetransfer/view_account/'.$id);
	}
	function delete_user_from_folder($folder_user_id)
	{


		$this->filetransfer_model->remove_user_from_folder($folder_user_id);

		header("Location:".$_SERVER['HTTP_REFERER']);
	}

	function createTransfer()
	{
		//create a transfer account for client
		$this->form_validation->set_rules('company', 'Company', 'trim|required');
		if($this->form_validation->run() == FALSE)
			{
			$this->session->set_flashdata('message', 'Nothing was entered');
			redirect('filetransfer');
			}
		//match company name to company id. If does not exist we will maybe
		//create a new company.

		$company_name = $this->input->post('company');
		$data['company'] = $this->companies_model->get_company_by_name($company_name);

		if($data['company']==NULL)
			{

				$this->session->set_flashdata('message', "The Company $company_name does not exist");
				redirect('filetransfer');
			}
		else
			{
					//convert the company name into id
					foreach($data['company'] as $row):
						$company_id = $row->idcompany;
					endforeach;


					//check if company has account

					if($this->filetransfer_model->check_account($company_id))

				//if they do set transfer_id to the name of their account
				{

					$accountdata['accountid'] = $this->filetransfer_model->check_account($company_id);
					foreach($accountdata['accountid'] as $row3):
						$transfer_id = $row3->accountid;
					endforeach;

				}
				else
				{
					//if they don't have an account create one
					$accountdata['accountid'] = $this->filetransfer_model->create_account($company_id);

					foreach($accountdata['accountid'] as $row2):
						$transfer_id = $row2['accountid'];
					endforeach;

				}


				redirect('filetransfer/view_account/'.$transfer_id);



			}
	}
	function view_account($id) //transfer account id
	{
		// get company id from transfer account id
		$data['account_data'] = $this->filetransfer_model->get_account($id);
		foreach($data['account_data'] as $row):
			$company_id = $row->company_id;
			$data['account_id'] = $row->accountid;
		endforeach;
			//get company
			$data['company'] = $this->companies_model->get_company($company_id);
			$data['company_id'] = $company_id;

                //list users in company
			$data['company_users'] = $this->companies_model->get_employees($company_id);

		

		// list folders created with this account
			$data['folders'] = $this->filetransfer_model->get_folders($id);

		

		// load template files
		$data['main'] = '/user/logged_in_area';
		$data['body'] = '/filetransfer/view_account';

		if($this->session->flashdata('message'))
			{
				$data['message'] = $this->session->flashdata('message');
			}
		$this->load->vars($data);
		$this->load->view('main_template');
	}

	function assign_user_to_account()
	{
		$user_id = $this->input->post('user_id');
		$account_id = $this->input->post('account_id');
		$this->filetransfer_model->assign_user_to_account($user_id, $account_id);

	}
	function remove_user_from_account()
	{
		$user_id = $this->input->post('user_id');
		$account_id = $this->input->post('account_id');
		$this->filetransfer_model->remove_user_from_account($user_id, $account_id);

	}
	function viewfiles()
	{
		$data['main'] = '/user/logged_in_area';
		$data['body'] = '/filetransfer/main';
		$data['buckets'] = $this->s3->listBuckets();
		$data['bucket_contents'] = $this->s3->getBucket('redstudio', 'test');
		$this->load->vars($data);
		$this->load->view('main_template');
	}

	function create_bucket($name)
	{
		var_dump($this->s3->putBucket($name));
		redirect('filetransfer');
	}

	function upload()
	{
		//retreive post variables
	    $data = $this->upload->data();
		$filename = "test.pdf";
		echo $filename;
		//move the file
		if ($this->s3->putObjectFile($data, "redstudio", $data))
		{
	    	echo "We successfully uploaded your file.";
		}
		else
		{
			echo "Something went wrong while uploading your file... sorry.";
		}

	}

          function logaction()
        {

              //create a log
                $username = $this->input->post('logUsername');
                $folder = $this->input->post('logFolder');
                $folderID = $this->input->post('logFolderID');
                $account = $this->input->post('logCompanyName');
		$ip_address = $this->input->ip_address();

		$username_log = $this->input->post('logUsername');
		$message = "(5) $username has uploaded to the $folder folder in the $account account. [$folderID]";
		$this->log_model->add_log($message, $ip_address, $username_log);



        }
        function logread()
        {
            $id = $this->input->post('logID');
            $this->log_model->logRead($id);
            return true;
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