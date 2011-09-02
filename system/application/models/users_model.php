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

}
