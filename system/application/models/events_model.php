<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 */
class Events_model extends Model {

    /**
     *
     * @return type 
     */
    function get_events() {

        $this->db->order_by('startdate', 'DESC');
        $query = $this->db->get('mydb_events');
        if ($query->num_rows > 0)
            ; {
            return $query->result();
        }
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function get_event($id) {


        $this->db->where('event_id', $id);
        $query = $this->db->get('mydb_events');
        if ($query->num_rows > 0)
            ; {
            return $query->result();
        }
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function delete_event($id) {
        $this->db->where('event_id', $id);
        $this->db->delete('mydb_events');


        $this->db->where('folder_id', $id);
        $this->db->delete('mydb_events_gallery');
        return TRUE;
    }

    /**
     *
     * @param type $image_id
     * @return type 
     */
    function delete_image($image_id) {
        $this->db->where('image_id', $image_id);
        $this->db->delete('mydb_gallery_images');


        return TRUE;
    }

    /**
     *
     * @param type $id
     * @return type 
     */
    function update_event($id) {
        //convert start date and time to single unix entry
        $startdate = $this->input->post('startdate_unix');
        $starttime = $this->input->post('starttime');
        $unixstarttime = ($starttime * 60) * 60;
        $startdatetime = $startdate + $unixstarttime;

        //convert end date and time to single unix entry
        $enddate = $this->input->post('enddate_unix');
        $endtime = $this->input->post('endtime');
        $unixendtime = ($endtime * 60) * 60;
        $enddatetime = $enddate + $unixendtime;



        $update_event = array(
            'location_title' => $this->input->post('location'),
            'event_title' => $this->input->post('event_title'),
            'hosted_by_company' => $this->input->post('hosted_by_company'),
            'startdate' => $startdatetime,
            'enddate' => $enddatetime
        );

        $this->db->where('event_id', $id);
        $update = $this->db->update('mydb_events', $update_event);
        return $update;
    }

    /**
     *
     * @return type 
     */
    function add_event() {
        //convert start date and time to single unix entry
        $startdate = $this->input->post('startdate_unix');
        $starttime = $this->input->post('starttime');
        $unixstarttime = ($starttime * 60) * 60;
        $startdatetime = $startdate + $unixstarttime;

        //convert end date and time to single unix entry
        $enddate = $this->input->post('enddate_unix');
        $endtime = $this->input->post('endtime');
        $unixendtime = ($endtime * 60) * 60;
        $enddatetime = $enddate + $unixendtime;



        //add data
        $new_event_insert_data = array(
            'location_title' => $this->input->post('location'),
            'event_title' => $this->input->post('event_title'),
            'hosted_by_company' => $this->input->post('hosted_by_company'),
            'startdate' => $startdatetime,
            'enddate' => $enddatetime
        );

        $insert = $this->db->insert('mydb_events', $new_event_insert_data);
        $eventid = $this->db->insert_id();
        //create event gallery

        $safename = $eventid . now();

        $new_gallery_insert_data = array(
            'folder_id' => $eventid,
            'folder_name' => $eventid,
            'account_id' => 'events',
            'safe_name' => $safename
        );

        $galleryinsert = $this->db->insert('mydb_events_gallery', $new_gallery_insert_data);


        return $insert;
    }

}