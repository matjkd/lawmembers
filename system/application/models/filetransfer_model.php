<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Filetransfer_model extends Model {
	
	function __construct()
    {
        parent::__construct();
      
    }

	function create_account($company_id)
	{
		
		
		$new_account_insert_data = array(
			'company_id' => $company_id,
			'added_by' => $this->session->userdata('user_id'),
			'date_added' => unix_to_human(now(), TRUE, 'eu')
		);
		
			$this->db->insert('transfer_account', $new_account_insert_data);
		
		
			$results['accountid'] = $this->db->insert_id();
			
			$data[] = $results;
			
		
		return $data;
			
	}
	
	function check_account($company_id)
	{
	$this->db->where('company_id', $company_id);
	$query = $this->db->get('transfer_account');
	if($query->num_rows == 1);
			{
				//if account exists retrieve account ID
				
				return $query->result();
				
			}
			if($query->num_rows < 1 || $query->num_rows > 1);
			{
				return FALSE;
			}
		
	}
	function checkuser($folder, $user)
	{
		
		$this->db->where('folder_id', $folder);
		$this->db->where('user_id', $user);
		$query = $this->db->get('transfer_folder_users');
		if($query->num_rows == 1)
			{
				//if account exists retrieve data
				
				return TRUE;
				
			}
		else if($query->num_rows != 1)
			{
				
				return FALSE;
			}
		
	}
	function get_account($id) // account id
	{
		//grab main account info
		$this->db->where('accountid', $id);
		$query = $this->db->get('transfer_account');
		if($query->num_rows == 1);
			{
				//if account exists retrieve data
				
				return $query->result();
				
			}
		
		
	}
        function getTransferAccounts()
        {
            $this->db->join('companies', 'companies.idcompany = transfer_account.company_id', 'leflt');
            $query = $this->db->get('transfer_account');

            if($query->num_rows > 0);
			{
				//if accounts exists retrieve data

				return $query->result();

			}


        }
	
	function assign_user_to_account($user_id, $account_id)
	{
			
		//first check user hasn't already been assigned	
		$this->db->from('transfer_users');
		$array = array('account_id' => $account_id, 'user_id' => $user_id);
		
		$this->db->where($array);
		
		$query = $this->db->get();
		if($query->num_rows < 1)
			{
			$assign_user_data = array(
			'user_id' => $user_id,
			'account_id' => $account_id
			
			);
		
			$this->db->insert('transfer_users', $assign_user_data);
		
		
		return;
			}
		else
			{
				
			return;
			}
	}
	function remove_user_from_account($user_id, $account_id)
	{
			
		//first check user hasn't already been assigned	
		$this->db->from('transfer_users');
		$array = array('account_id' => $account_id, 'user_id' => $user_id);
		
		$this->db->where($array);
		
		$query = $this->db->get();
		if($query->num_rows == 1)
			{
			$remove_user_data = array(
			'user_id' => $user_id,
			'account_id' => $account_id
			
			);
			$remove_folder_user = array(
			'user_id' => $user_id
			
			);
		
			$this->db->delete('transfer_users', $remove_user_data);
			$this->db->delete('transfer_folder_users', $remove_folder_user);
		
			
			
		
		return;
			}
		else
			{
				
			return;
			}
	}
	function remove_user_from_folder($id)
	{
			
			
			
		$remove_folder_user = array(
			
			'folder_user_id' => $id
			);
			
		$this->db->delete('transfer_folder_users', $remove_folder_user);	
	}
	
	function add_user($id, $salt) //company id
	{
			
		if($id==NULL)
		{
			$id_company = $this->input->post('id_company');
		}
		else
		{
			$id_company = $id;
		}
		
				
		$new_employee_insert_data = array(
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'username' => $this->input->post('lastname'),
			'password' => md5($this->input->post('password')),
			'passSALT' => $salt,
			'user_level' => 10,
			'registerDate' => unix_to_human(now(), TRUE, 'eu')
		);
		
		$this->db->insert('users', $new_employee_insert_data);
		
		
		$userid = mysql_insert_id();
		
		$link_employee_to_company = array(
			'company_id' => $id_company,
			'employee_id' => $userid
		);
		
		$this->db->insert('company_members', $link_employee_to_company);
		
		
				
			
		
	
	}
	
	
	
	
	function get_users($id) // account id
	{
		$this->db->from('users');
		$this->db->join('transfer_users', 'transfer_users.user_id=users.id', 'right');
		$this->db->where('transfer_users.account_id', $id);
		
		$query = $this->db->get();
		if($query->num_rows > 0)
			{
				foreach ($query->result_array() as $row)
			
			$data[] = $row;
			}
			else
			{
				$data = NULL;
			}
		$query->free_result();
		return $data;
		
		
	}
	function get_folder_users($id) // account id
	{
		$this->db->from('users');
		$this->db->join('transfer_users', 'transfer_users.user_id=users.id', 'right');
		$this->db->join('transfer_folder_users', 'transfer_folder_users.user_id=users.id', 'right');
		$this->db->where('transfer_users.account_id', $id);
		
		$query = $this->db->get();
		if($query->num_rows > 0)
			{
				foreach ($query->result_array() as $row)
			
			$data[] = $row;
			}
			else
			{
				$data = NULL;
			}
		$query->free_result();
		return $data;
	}
	
	function create_folder()
	{
		// create safe name for folder name on amazon, trim, remove spaces and symbols etc. Give it a unique name
		$safe_name = $this->input->post('folder_name');
		$safe_name = trim($safe_name);
		$safe_name = preg_replace("![^a-z0-9]+!i", "", $safe_name);
		$account_id = $this->input->post('account_id');
		$time = time();
		
		$safe_name = $safe_name."_".$time;
		
		$new_folder_insert_data = array(
			'account_id' => $this->input->post('account_id'),
			'folder_name' => $this->input->post('folder_name'),
			'safe_name' => $safe_name
		);
		
			$this->db->insert('transfer_folders', $new_folder_insert_data);
		
		
			$results['folder_id'] = $this->db->insert_id();
			
			$data[] = $results;
			
		
		return $data;
		
	}
	
	function assign_user_to_folder($user_id, $folder_id)
	{
			
		//first check user hasn't already been assigned	
		$this->db->from('transfer_folder_users');
		$array = array('folder_id' => $folder_id, 'user_id' => $user_id);
		
		$this->db->where($array);
		
		$query = $this->db->get();
		
		if($query->num_rows < 1)
			{
			$assign_user_data = array(
			'user_id' => $user_id,
			'folder_id' => $folder_id
			
			);
		
			$this->db->insert('transfer_folder_users', $assign_user_data);
		
			return; 
			}
			else
			{
				
			return;
			}
	}
	
	function get_folders($id) //account id
	{
		
		$this->db->from('transfer_folders');
	
		$this->db->where('account_id', $id);
		
		$query = $this->db->get();
		if($query->num_rows > 0)
			{
				foreach ($query->result_array() as $row)
			
			$data[] = $row;
			}
			else
			{
				$data = NULL;
			}
		$query->free_result();
		return $data;
		
	}
	
	function get_user_folders($id) //user id
	{
		
		$this->db->from('transfer_folders');
		$this->db->join('transfer_folder_users','transfer_folder_users.folder_id=transfer_folders.folder_id', 'left');
		$this->db->where('transfer_folder_users.user_id', $id);
		
		$query = $this->db->get();
		if($query->num_rows > 0)
			{
				foreach ($query->result_array() as $row)
			
			$data[] = $row;
			}
			else
			{
				$data = NULL;
			}
		$query->free_result();
		return $data;
		
	}
	
	function get_folder($id) //folder id
	{
		$this->db->from('transfer_folders');
	
		$this->db->where('folder_id', $id);
		
		$query = $this->db->get();
		if($query->num_rows == 1)
			{
				foreach ($query->result_array() as $row)
			
			$data[] = $row;
			}
			else
			{
				$data = NULL;
			}
		$query->free_result();
		return $data;
	}
	function delete_folder($id) //folder id
	{
		
		
		
		$this->db->where('folder_id', $id);	
		$this->db->delete('transfer_folders');
		return;
	}
}
