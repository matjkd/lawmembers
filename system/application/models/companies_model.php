<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Companies_model extends Model {

    function __construct() {
        parent::__construct();
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function get_company($id) {

        $this->db->where('idcompany', $id);
        $query = $this->db->get('mydb_company');
        if ($query->num_rows == 1)
            ; {
            return $query->result();
        }
    }

    /**
     *
     * @param type $idname
     * @return type 
     */
    function get_company_by_name($idname) {

        $this->db->where('company_name', $idname);
        $query = $this->db->get('mydb_company');
        if ($query->num_rows == 1)
            ; {
            return $query->result();
        }
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function get_address($id) {


        $this->db->where('idaddress', $id);
        $query = $this->db->get('mydb_address');
        if ($query->num_rows == 1)
            ; {
            return $query->result();
        }
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function get_employee($id) {


        $this->db->where('idkeypeople', $id);
        $query = $this->db->get('mydb_keypeople');
        if ($query->num_rows == 1)
            ; {
            return $query->result();
        }
    }

    /**
     *
     * @return type 
     */
    function list_companies() {
        $data = array();
        $this->db->from('mydb_company');
        $this->db->join('mydb_address', 'mydb_address.idcompany=mydb_company.idcompany', 'left');
        $this->db->group_by('mydb_company.idcompany');
        $this->db->order_by('mydb_company.company_name');

        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row)
                $data[] = $row;
        }

        $Q->free_result();
        return $data;
    }

    /**
     *
     * @return type 
     */
    function list_company_names() {
        $this->db->select('company_name');
        $this->db->from('mydb_company');
        $this->db->group_by('company_name');
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row)
                $data[] = $row;
        }
        $Q->free_result();
        return $data;
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function next_company($id) {
        $this->db->select('idcompany');
        $this->db->from('mydb_company');
        $this->db->order_by('idcompany', 'asc');
        $this->db->where('idcompany >', $id);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() == 1) {
            foreach ($Q->result_array() as $row)
                $data = $row['idcompany'];
            return $data;
        }
        $Q->free_result();
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function previous_company($id) {
        $this->db->select('idcompany');
        $this->db->from('mydb_company');
        $this->db->order_by('idcompany', 'desc');
        $this->db->where('idcompany <', $id);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() == 1) {
            foreach ($Q->result_array() as $row)
                $data = $row['idcompany'];
            return $data;
        }
        $Q->free_result();
    }

    /**
     *
     * @param type $id
     * @return string 
     */
    function get_employees($id) {

        $this->db->from('mydb_keypeople');

        $this->db->where('idcompany', $id);

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
     */
    function add_employee($id) {
        if ($id == NULL) {
            $id_company = $this->input->post('id_company');
        } else {
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

    /**
     *
     * @param type $id
     * @return string 
     */
    function get_addresses($id) {
        $this->db->from('mydb_address');
        $this->db->where('idcompany', $id);
		$this->db->order_by('order', 'asc');
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
     */
    function add_address($id) {


        if ($id == NULL) {
            $id_company = $this->input->post('id_company');
        } else {
            $id_company = $id;
        }

        $new_address_insert_data = array(
            'idcompany' => $id_company
                //'registerDate' => unix_to_human(now(), TRUE, 'eu')
        );

        $this->db->insert('mydb_address', $new_address_insert_data);
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function add_new_address($id) {


        if ($id == NULL) {
            return;
        }


        $new_address_insert_data = array(
            'idcompany' => $id,
            'address1' => $this->input->post('address1')
                //'registerDate' => unix_to_human(now(), TRUE, 'eu')
        );

        $this->db->insert('mydb_address', $new_address_insert_data);
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function add_new_employee($id) {


        if ($id == NULL) {
            return;
        }


        $new_employee_insert_data = array(
            'idcompany' => $id,
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'people_email' => $this->input->post('email')
                //'registerDate' => unix_to_human(now(), TRUE, 'eu')
        );

        $this->db->insert('mydb_keypeople', $new_employee_insert_data);
        return TRUE;
    }

    /**
     *
     * @return type 
     */
    function add_company() {
        $new_company_insert_data = array(
            'company_name' => $this->input->post('company_name'),
            'company_web' => $this->input->post('company_web')
        );


        $this->db->insert('mydb_company', $new_company_insert_data);
        $this->db->from('mydb_company');
        $this->db->select('idcompany');
        $this->db->where('company_name', $this->input->post('company_name'));
        $data = $this->db->get();
        if ($data->num_rows == 1) {
            return $data->result();
        }
    }

    /**
     *
     * @param type $id
     * @param type $field
     * @param type $value
     * @return type 
     */
    function edit_company($id, $field, $value) {
        $company_update_data = array(
            $field => $value
        );
        $this->db->where('idcompany', $id);
        $update = $this->db->update('mydb_company', $company_update_data);
        return $update;
    }

    /**
     *
     * @param type $id
     * @param type $field
     * @param type $value
     * @return type 
     */
    function edit_employee($id, $field, $value) {
        $company_update_data = array(
            $field => $value
        );
        $this->db->where('idkeypeople', $id);
        $update = $this->db->update('mydb_keypeople', $company_update_data);
        return $update;
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function update_description($id) {
        $form_data = array(
            'description' => $this->input->post('description'),
        );

        $this->db->where('idcompany', $id);
        $this->db->update('mydb_company', $form_data);

        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function update_local_description($id) {
        $form_data = array(
            'description_local' => $this->input->post('description_local'),
        );

        $this->db->where('idcompany', $id);
        $this->db->update('mydb_company', $form_data);

        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
    }

    /**
     *
     * @param type $id
     * @param type $field
     * @param type $value
     * @return type 
     */
    function edit_address($id, $field, $value) {
        $address_update_data = array(
            $field => $value
        );
        $this->db->where('idaddress', $id);
        $update = $this->db->update('mydb_address', $address_update_data);
        return $update;
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function get_region($id) {
        $data = array();
        $this->db->from('mydb_regions');
        $this->db->where('region_id', $id);
        $Q = $this->db->get();
        if ($Q->num_rows() == 1) {
            foreach ($Q->result_array() as $row)
                $data[] = $row;
        }

        $Q->free_result();
        return $data;
    }

    /**
     *
     * @return type 
     */
    function list_all_tags() {
        $data = array();
        $this->db->from('tags');
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row)
                $data[] = $row;
        }

        $Q->free_result();
        return $data;
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function list_tags($id) {
        $data = array();
        $this->db->from('company_tags');
        $this->db->join('tags', 'tags.tag_id=company_tags.tag_id', 'right');

        $this->db->where('company_tags.company_id', $id);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row)
                $data[] = $row;
        }

        $Q->free_result();
        return $data;
    }

    /**
     *
     * @param type $id 
     */
    function add_tag($id) {
        $new_tag_insert_data = array(
            'tag_id' => $this->input->post('tag_id'),
            'company_id' => $id
        );


        $this->db->insert('company_tags', $new_tag_insert_data);
    }

    function delete_tag($id) {
        $this->db->where('company_tags_id', $id);
        $this->db->delete('company_tags');
    }

    function delete_addresses($id_company) {
        $this->db->where('idcompany', $id_company);
        $this->db->delete('mydb_address');


        return TRUE;
    }

function delete_address($address_id) {
        $this->db->where('idaddress', $address_id);
        $this->db->delete('mydb_address');


        return TRUE;
    }
    function delete_company($id_company) {
        $this->db->where('idcompany', $id_company);
        $this->db->delete('mydb_company');


        return TRUE;
    }

    function delete_employees($id_company) {
        $this->db->where('idcompany', $id_company);
        $this->db->delete('mydb_keypeople');




        return TRUE;
    }

    function delete_employee($id) {
        if ($id == 1) {
            return;
        } else {
            $this->db->where('idkeypeople', $id);
            $this->db->delete('mydb_keypeople');
            return TRUE;
        }
    }

}
