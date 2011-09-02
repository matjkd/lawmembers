<?php

class Membership_model extends Model {

	function validate($password)
	{
		
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', $password);
		$this->db->where('user_active', 1);
		$query = $this->db->get('mydb_keypeople');
		
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
        function update_password($id, $passsalt, $password)
	{
		$this->db->where('idkeypeople', $id);
		$new_member_update_data = array(

			'password' => $passsalt
			


		);

		$insert = $this->db->update('mydb_keypeople', $new_member_update_data);


		return $insert;
	}
	
	

	

}