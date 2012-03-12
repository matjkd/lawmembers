<?php

class Newsletter_model extends Model {

    function __construct() {
        parent::__construct();
    }

    /*
     * 
     */

    function list_newsletters($limit = "") {
        $country = $this->input->post('country');
        $this->db->join('mydb_company', 'mydb_newsletters.company_id = mydb_company.idcompany');
        $this->db->join('mydb_address', 'mydb_address.idcompany = mydb_company.idcompany');
        $this->db->group_by('mydb_newsletters.newsletter_id');
        $this->db->limit($limit);
        $this->db->order_by('mydb_newsletters.newsletter_date', 'desc');
        if ($country != NULL) {
            $this->db->where('mydb_address.country', $country);
        }
        $query = $this->db->get('mydb_newsletters');
        if ($query->num_rows > 0) {
            return $query->result();
        }
    }

    /*
     * list countries used in newsletters
     */

    function list_countries() {

        $this->db->join('mydb_company', 'mydb_newsletters.company_id = mydb_company.idcompany');
        $this->db->join('mydb_address', 'mydb_address.idcompany = mydb_company.idcompany');

        $this->db->group_by('mydb_address.country');

        $this->db->order_by('mydb_newsletters.newsletter_date', 'desc');
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
        $newsletterdate = $this->input->post('date_added') + 3601;
        $now = time();
        $title = $this->input->post('title');
        if ($title == NULL) {
            $title = $_FILES['file']['name'];
        }
        $datetime = $now;
        $form_data = array(
            'newsletter_title' => $title,
            'content' => $this->input->post('content'),
            'newsletter_date' => $newsletterdate,
            'added_by' => $name_id,
            'date_added' => $datetime,
            'company_id' => $this->input->post('company')
        );
        $insert = $this->db->insert('mydb_newsletters', $form_data);
        return $insert;
    }

    function edit_newsletter($id) {
        $newsletterdate = $this->input->post('date_added') + 3601;
        $content_update = array(
            'newsletter_title' => set_value('title'),
            'content' => $this->input->post('content'),
            'newsletter_date' => $newsletterdate,
            'added_by' => $name_id,
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
            'newsletter_filename' => $filename
        );

        $this->db->where('newsletter_id', $blog_id);
        $update = $this->db->update('mydb_newsletters', $content_update);
        return $update;
    }

}