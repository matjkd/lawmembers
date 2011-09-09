<?php

class Clientsearch_model extends Model {

	 function __construct()
    {
        parent::__construct();

    }

    function get_searches()
    {
                 $this->db->order_by('date_added', 'DESC');
		$query = $this->db->get('mydb_clientsearch');
		if($query->num_rows > 0);
			{
				return $query->result();
			}
    }

    function add_search()
    {

         $user = $this->session->userdata('$user_firstname').$this->session->userdata('$user_lastname');
 //add data
            $new_search_insert_data = array(
			'search_title' => $this->input->post('search_title'),
                        'content' => $this->input->post('content'),
			'date_added' => now(),
			'added_by' => $user,
                );

		$insert = $this->db->insert('mydb_clientsearch',   $new_search_insert_data );
              return;

    }


}