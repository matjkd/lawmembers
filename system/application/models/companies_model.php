<?php

class Companies_model extends Model {

	 function __construct()
    {
        parent::__construct();
      
    }
	function get_company($id)
	{
			
		$this->db->where('idcompany', $id);
		$query = $this->db->get('companies');
		if($query->num_rows == 1);
			{
				return $query->result();
			}
		
	}
	function get_company_by_name($idname)
	{
			
		$this->db->where('company_name', $idname);
		$query = $this->db->get('companies');
		if($query->num_rows == 1);
			{
				return $query->result();
			}
		
	}
function get_address($id)
	{
	
		
		$this->db->where('address_id', $id);
		$query = $this->db->get('address');
		if($query->num_rows == 1);
			{
				return $query->result();
			}
		
	}
	function list_companies()
	{
		$data = array();
		$this->db->from('company_type');
		$this->db->join('companies', 'companies.company_type=company_type.id_company_type', 'right');
		
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
	}
	function list_company_names()
	{
		$this->db->select('company_name');
		$this->db->from('companies');
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		$Q->free_result();
		return $data;
	}
	
	function get_employees($id)
	{
		
		$this->db->from('users');
		$this->db->join('company_members', 'company_members.employee_id=users.id', 'right');
		$this->db->where('company_members.company_id', $id);
		
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
	function get_employee($id)
	{
		
		$this->db->from('users');
		
		$this->db->where('id', $id);
		
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
	
	function add_employee($id)
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
			'password' => md5($this->input->post('firstname')),
			'email_address' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),			
			'mobile' => $this->input->post('mobile'),
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
	
function get_addresses($id)
	{
		$this->db->from('address');
		$this->db->join('company_addresses', 'company_addresses.address_id=address.address_id', 'right');
		$this->db->where('company_addresses.company_id', $id);
		
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
	
function add_address($id)
	{
		if ($id == NULL)
		{
			$id_company = $this->input->post('id_company');
		}
		else
		{
			$id_company = $id;
		}
		
		$new_address_insert_data = array(
			'address1' => $this->input->post('address1'),
			'address2' => $this->input->post('address2'),
			'address3' => $this->input->post('address3'),
			'address4' => $this->input->post('address4'),
			'postcode' => $this->input->post('postcode'),
			'registerDate' => unix_to_human(now(), TRUE, 'eu')
		);
		
		$this->db->insert('address', $new_address_insert_data);
		
		
		$addressid = mysql_insert_id();
		
		$link_address_to_company = array(
			'company_id' => $id_company,
			'address_id' => $addressid
		);
		
		$this->db->insert('company_addresses', $link_address_to_company);
		
		
		
	
	}

	
	function add_company()
	{
		$new_company_insert_data = array(
			'company_name' => $this->input->post('company_name'),
			'company_desc' => $this->input->post('company_desc'),
			'company_phone' => $this->input->post('company_phone'),
			'company_fax' => $this->input->post('company_fax'),			
			'company_email' => $this->input->post('company_email'),
			'company_website' => $this->input->post('company_website'),
			'company_type' => $this->input->post('company_type')
			
		);
		
		
		$this->db->insert('companies', $new_company_insert_data);
		$this->db->from('companies');
		$this->db->select('idcompany');
		$this->db->where('company_name', $this->input->post('company_name'));
		$data = $this->db->get();
		if($data->num_rows == 1)
			{
				return $data->result();
			}
		
	}
	
function edit_company($id, $field, $value)
	{
		$company_update_data = array(
					$field => $value
					);
		$this->db->where('idcompany', $id);
		$update = $this->db->update('companies', $company_update_data);
		return $update;
	}
function edit_address($id, $field, $value)
	{
		$address_update_data = array(
					$field => $value
					);
		$this->db->where('address_id', $id);
		$update = $this->db->update('address', $address_update_data);
		return $update;
	}
function list_all_tags()
	{
		$data = array();
		$this->db->from('tags');
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
	}
function list_tags($id)
	{
		$data = array();
		$this->db->from('company_tags');
		$this->db->join('tags', 'tags.tag_id=company_tags.tag_id', 'right');
		
		$this->db->where('company_tags.company_id', $id);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			
			$data[] = $row;
			
		}
		
		$Q->free_result();
		return $data;
	}
function add_tag($id)
	{
	$new_tag_insert_data = array(
			'tag_id' => $this->input->post('tag_id'),
			'company_id' => $id
			
		);
		
		
		$this->db->insert('company_tags', $new_tag_insert_data);
		
	}
function delete_tag($id)
{
	$this->db->where('company_tags_id', $id);
	$this->db->delete('company_tags');
	
}
function delete_address($id_address) 
	{
		
		$delete_address = $this->db->query('DELETE FROM ignite_address WHERE address_id='.$id_address);
		$delete_links = $this->db->query('DELETE FROM ignite_company_addresses WHERE address_id='.$id_address);
		return TRUE;
		
	}
	
	function delete_company($id_company) 
	{
		$delete_company = $this->db->query('DELETE FROM ignite_companies WHERE idcompany='.$id_company);
		
		return TRUE;
	}
function delete_employee($id_employee) 
	{
		if($id_employee == 1)
		{
			return;
		}
		else
		{
		$delete_employee = $this->db->query('DELETE FROM ignite_users WHERE id='.$id_employee);
		$delete_links = $this->db->query('DELETE FROM ignite_company_members WHERE employee_id='.$id_employee);
		return TRUE;
		}
	}
	
}
