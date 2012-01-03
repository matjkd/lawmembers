<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Filetransfer_model extends Model {

    function __construct() {
        parent::__construct();
    }

    /**
     *
     * @param type $company_id
     * @return type 
     */
    function create_account($company_id) {


        $new_account_insert_data = array(
            'company_id' => $company_id,
            'added_by' => $this->session->userdata('user_id'),
            'date_added' => unix_to_human(now(), TRUE, 'eu')
        );

        $this->db->insert('mydb_transfer_account', $new_account_insert_data);


        $results['accountid'] = $this->db->insert_id();

        $data[] = $results;


        return $data;
    }

    /**
     *
     * @param type $company_id
     * @return type 
     */
    function check_account($company_id) {
        $this->db->where('company_id', $company_id);
        $query = $this->db->get('mydb_transfer_account');
        if ($query->num_rows == 1)
            ; {
            //if account exists retrieve account ID

            return $query->result();
        }
        if ($query->num_rows < 1 || $query->num_rows > 1)
            ; {
            return FALSE;
        }
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function get_account($id) { // account id
        //grab main account info
        $this->db->where('accountid', $id);
        $query = $this->db->get('mydb_transfer_account');
        if ($query->num_rows == 1) {
            //if account exists retrieve data

            return $query->result();
        }
    }

    /**
     *
     * @return type 
     */
    function getTransferAccounts() {
        $this->db->join('mydb_company', 'mydb_company.idcompany = mydb_transfer_account.company_id', 'left');
        $this->db->join('mydb_address', 'mydb_address.idcompany=mydb_company.idcompany', 'left');
         $this->db->group_by('mydb_company.company_name');
        $query = $this->db->get('mydb_transfer_account');

        if ($query->num_rows > 0) {
            //if accounts exists retrieve data

            return $query->result();
        }
    }

    /**
     *
     * @return type 
     */
    function create_folder() {
        // create safe name for folder name on amazon, trim, remove spaces and symbols etc. Give it a unique name
        $safe_name = $this->input->post('folder_name');
        $safe_name = trim($safe_name);
        $safe_name = preg_replace("![^a-z0-9]+!i", "", $safe_name);
        $account_id = $this->input->post('account_id');
        $time = time();

        $safe_name = $safe_name . "_" . $time;

        $new_folder_insert_data = array(
            'account_id' => $this->input->post('account_id'),
            'folder_name' => $this->input->post('folder_name'),
            'safe_name' => $safe_name
        );

        $this->db->insert('mydb_transfer_folders', $new_folder_insert_data);


        $results['folder_id'] = $this->db->insert_id();

        $data[] = $results;


        return $data;
    }

    /**
     *
     * @param type $id
     * @return string 
     * 
     */
    function get_folders($id) { //account id
        $this->db->from('mydb_transfer_folders');

        $this->db->where('account_id', $id);

        $query = $this->db->get();
        if ($query->num_rows > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        } else {
            $data = NULL;
        }
        $query->free_result();
        return $data;
    }

    /**
     *
     * @param type $id
     * @return string 
     */
    function get_folder($id) { //folder id
        $this->db->from('mydb_transfer_folders');

        $this->db->where('folder_id', $id);

        $query = $this->db->get();
        if ($query->num_rows == 1) {
            foreach ($query->result_array() as $row)
                $data[] = $row;
        } else {
            $data = NULL;
        }
        $query->free_result();
        return $data;
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function delete_folder($id) { //folder id
        $this->db->where('folder_id', $id);
        $this->db->delete('mydb_transfer_folders');
        return;
    }

}
