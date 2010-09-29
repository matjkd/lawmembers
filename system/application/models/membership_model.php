<?php

class Membership_model extends Model {

	function validate()
	{
		
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));
		$this->db->where('activated', 1);
		$query = $this->db->get('users');
		
		if($query->num_rows == 1)
		{
			return true;
		}
		
	}
	
	function create_member()
	{
		
		$new_member_insert_data = array(
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'email_address' => $this->input->post('email_address'),
			'twitter_id' => $this->input->post('twitter_id'),			
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'registerDate' => $this->input->post('registerDate'),
		);
		
		$insert = $this->db->insert('users', $new_member_insert_data);
		return $insert;
	}
	function add_employee()
	{
		$this->db->select('id');
		$this->db->where('username', $this->input->post('username'));
		$query2 = $this->db->get('users');
		if($query2->num_rows == 1)
		{
			foreach($query2->result() as $row)
			{
				$employee_id = $row->id;
			
			$employee_data = array(
				'company_id' =>$this->input->post('company_id'),
				'employee_id' =>$employee_id,
			);
			}
			$add = $this->db->insert('company_members', $employee_data);
			return $add;
		}
	
	}
	
	

	

}