<?php

class Clientsearch_model extends Model {

    function __construct() {
        parent::__construct();
    }

    function get_searches() {
        $this->db->order_by('mydb_clientsearch.date_added', 'DESC');
        $this->db->join('mydb_company', 'mydb_clientsearch.company=mydb_company.idcompany');
        $this->db->join('mydb_keypeople', 'mydb_clientsearch.member=mydb_keypeople.idkeypeople');
        $this->db->join('mydb_address', 'mydb_address.idcompany=mydb_company.idcompany');
        $this->db->groupby('mydb_company.idcompany');
        $query = $this->db->get('mydb_clientsearch');
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }

    function get_company_id($company_name) {
        $this->db->select('idcompany');
        $this->db->where('company_name', $company_name);
        $query = $this->db->get('mydb_company');
        if ($query->num_rows == 1) {
            return $query->row();
        }
    }

    function get_member_id($member_name) {
        $firstname = substr($member_name, 0, strpos($member_name, " "));
        $lastname_array = explode(' ', trim($member_name));
        $lastname = $lastname_array[count($lastname_array) - 1];

        //$this->db->select('idkeypeople', 'idcompany');
        $this->db->like('firstname', $firstname);
        $this->db->like('lastname', $lastname);
        $query = $this->db->get('mydb_keypeople');
        if ($query->num_rows == 1) {
            return $query->row();
        }
    }

    /**
     *
     * @return type 
     */
    function add_search() {

        $member_id = $this->get_member_id($this->input->post('member_name'));

        $company_id = $this->get_company_id($this->input->post('company'));
        $user = $this->session->userdata('$user_id');


        //if no company name is entered, get company from member name
        if ($company_id == NULL && $member_id != NULL) {
            $company = $member_id->idcompany;
        } else if ($company_id == NULL && $member_id == NULL) {
            return FALSE;
        } else if ($company_id != NULL) {
            $company = $company_id->idcompany;
        }

        if ($member_id == NULL) {
            return FALSE;
        } else {
            $member = $member_id->idkeypeople;
        }
        //add data
        $new_search_insert_data = array(
            'search_title' => $this->input->post('search_title'),
            'content' => $this->input->post('content'),
            'date_added' => now(),
            'company' => $company,
            'member' => $member,
            'added_by' => $user,
        );

        $insert = $this->db->insert('mydb_clientsearch', $new_search_insert_data);
        return;
    }

    function delete_search($id) {
        $this->db->where('search_id', $id);
        $this->db->delete('mydb_clientsearch');


        return TRUE;
    }

}