<?php

class Events_model extends Model {

	function get_events()
	{



	}


        function add_event()
        {
            //convert start date and time to single unix entry
            $startdate = $this->input->post('startdate_unix');
            $starttime = $this->input->post('starttime');
            $unixstarttime = ($starttime * 60)*60;
            $startdatetime = $startdate + $unixstarttime;

            //convert end date and time to single unix entry
            $enddate = $this->input->post('enddate_unix');
            $endtime = $this->input->post('endtime');
            $unixendtime = ($endtime * 60)*60;
            $enddatetime = $enddate + $unixendtime;

            //add data
            $new_event_insert_data = array(
			'location_title' => $this->input->post('location'),
			'hosted_by_company' => $this->input->post('hosted_by_company'),
			'startdate' => $startdatetime,
			'enddate' => $enddatetime
		);
		
		$insert = $this->db->insert('mydb_events',   $new_event_insert_data );
		return $insert;

        }
}