<?php

class Log_model extends Model {

	 function __construct()
    {
        parent::__construct();
      
    }
	
	function add_log($message, $ip, $user)
	{
                 // Convert older datetime entries to UNIX timestamps - This is temporary and can be removed once done
                 //$this->convert_to_unix();

               
                 // check for old logs and delete
                // delete successfull logins older than 1 week


                //convert time to take into account daylight savings
              

                $now = now();
                /*
                 *
                 * The following code has been added to the date helper gmt_to_local
                 * to automatically detect daylight savings. Though there arent always just 4
                 * sundays in march, it is on the last sunday, so we do 1st sunday of april minus 1 week
                 *
                 * $dst_begin = strtotime('first Sunday April 0')-604800;
                 * $dst_end   = strtotime('first Sunday November 0')-604800;
                 * $dst = false;
                 * if ($time >= $dst_begin && $time < $dst_end) $dst = true;
                 */

                $now = gmt_to_local($now);


                $oneWeek  = 604800; // one week in seconds
                $oneWeekAgo = $now-$oneWeek; // the time one week ago

                $this->db->like('log_message', '(1)', 'after'); // select logs marked 1, which represents succesful logins
                $this->db->where('datetime <', $oneWeekAgo); // where datetime is before 1 week ago

                //where ip address is office
                //@TODO create an ip whitelist that will populate this
                $this->db->where('ip_address', '80.68.33.6');
                $this->db->delete('log');
                //End of deleting 1 week old successful login logs!

		$log_data = array(
			'log_message' => $message,
			'ip_address' => $ip,
			'username' => $user,
			'datetime' => $now
		);
		
			$this->db->insert('mydb_log', $log_data);
			return;
	}

           function getLogs()
        {

            $query = $this->db->get('log');

            if($query->num_rows > 0);
			{
				//if accounts exists retrieve data

				return $query->result();

			}


        }

        function convert_to_unix()
        {
            $query = $this->db->get('log');

            if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row):


                            $log_id = $row['log_id'];
                            $olddate = $row['datetime'];
                          


                               //check if date is unix or not, if not convert it
                             if( is_numeric($olddate) && (int)$olddate == $olddate ){

                             $newdate = $olddate;

                            }
                            else {
                              $newdate = strtotime($olddate);
                            }
                            $data = array(
                                                   'datetime' => $newdate,

                                                );

                            $this->db->where('log_id', $log_id);
                            $this->db->update('mydb_log', $data);


			endforeach;
		}
        }

        function alertUploads()
        {

                $now = now();
                $oneWeek  = 604800; // one week in seconds
                $oneWeekAgo = $now-$oneWeek; // the time one week ago

                $this->db->like('log_message', '(5)', 'after'); // select logs marked 5 which represents uploads
               // $this->db->group_by('log_message'); // This groups but doesn't solve any problems because when you mark as read it doesnt go away till all the group is gone!
                $this->db->where('datetime >', $oneWeekAgo); // where datetime is before 1 week ago
                $this->db->where('read', 0); //where it is unread
                $query = $this->db->get('mydb_log');
		if($query->num_rows > 0);
			{
				return $query->result();
			}



        }

        function logRead($log_id)
        {
              $data = array(
                                       'read' => 1,

                                                );

                            $this->db->where('log_id', $log_id);
                            $this->db->update('mydb_log', $data);
               return;
        }
	
}