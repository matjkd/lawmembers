<?php

class Admin_model extends Model {

	 function __construct()
    {
        parent::__construct();
      
    }
	function get_admin($id)
	{
			
		$this->db->where('admin_id', $id);
		$query = $this->db->get('mydb_admin');
		if($query->num_rows == 1);
			{
				return $query->result();
			}
		
	}
	
	function edit_field($id, $field, $value)
	{
		$user_admin_data = array(
					$field => $value
					);
		$this->db->where('admin_id', $id);
		$update = $this->db->update('mydb_admin', $user_admin_data);
		return $update;
	}
}