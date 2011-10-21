<?php

class Users_model extends Model {

	 function __construct()
    {
        parent::__construct();

    }

    	function list_users()
	{
		$data = array();
		$this->db->from('mydb_keypeople');
		$this->db->join('mydb_company', 'mydb_company.idcompany=mydb_keypeople.idcompany', 'left');
		
		$this->db->order_by('mydb_keypeople.idcompany');

		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)

			$data[] = $row;

		}

		$Q->free_result();
		return $data;
	}
        
                function get_members()
                {
                        $data = array();
		$this->db->from('mydb_keypeople');
                                $this->db->where('mydb_keypeople.level', NULL);
                                $this->db->or_where('mydb_keypeople.level >', '1');
                           
		$this->db->join('mydb_company', 'mydb_company.idcompany=mydb_keypeople.idcompany', 'left');
		
		$this->db->order_by('mydb_keypeople.idcompany');

		$Q = $this->db->get();
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)

			$data[] = $row;

		}

		$Q->free_result();
		return $data;
                }
                
                function set_passwords($id, $passsalt, $password, $username)
                {
                   
		$this->db->where('idkeypeople', $id);
		$new_member_update_data = array(

			'password' => $passsalt,
			'username' => $username,
                                                'user_active' => 1,
                                                'level' => 2


		);

		$insert = $this->db->update('mydb_keypeople', $new_member_update_data);


		return $insert;
	
                }

}
