<?php

class Newsletter_model extends Model {

    function __construct() {
        parent::__construct();
    }
/*
 * 
 */
    function list_newsletters() {

        $query = $this->db->get('mydb_newsletters');
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }
    
/*
 * 
 */
    function get_newsletter($id) {
        $this->db->where('newsletter_id', $id);
        $query = $this->db->get('mydb_newsletters');
        if ($query->num_rows == 1) {
            return $query->result();
        }
    }
/*
 * 
 */
    function add_newsletter() {

        // build array for the model
        $name_id = $this->session->userdata('user_id');

        $now = time();
        $datetime = $now;
        $form_data = array(
            'newsletter_title' => set_value('title'),
            'content' => $this->input->post('content'),
            'newsletter_date' => $this->input->post('date_added'),
            'added_by' => $name_id,
            'date_added' => $datetime,
            'company_id' => $this->input->post('company')
        );
        $insert = $this->db->insert('mydb_newsletters', $form_data);
        return $insert;
    }
    
    function edit_newsletter($id) {
        
        $content_update = array(
           'newsletter_title' => set_value('title'),
            'content' => $this->input->post('content'),
            'newsletter_date' => $this->input->post('date_added'),
            'added_by' => $name_id,
            'date_added' => $datetime,
            'company_id' => $this->input->post('company')
        );




        $this->db->where('newsletter_id', $id);
        $update = $this->db->update('mydb_newsletters', $content_update);
        return $update;
    }

    /**
     *
     * @param type $filename
     * @param type $blog_id
     * @return type 
     */
    function add_file($filename, $blog_id) {
        $content_update = array(
            'filename' => $filename
        );

        $this->db->where('newsletter_id', $blog_id);
        $update = $this->db->update('mydb_newsletters', $content_update);
        return $update;
    }

}