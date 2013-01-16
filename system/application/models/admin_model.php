<?php

class Admin_model extends Model {

	 function __construct()
    {
        parent::__construct();
      
    }
	function get_admin($id)
	{
			
		$this->db->where('admin_id', $id);
		$query = $this->db->get('mydb_admin');
		if($query->num_rows == 1);
			{
				return $query->result();
			}
		
	}
	
	function edit_field($id, $field, $value)
	{
		$user_admin_data = array(
					$field => $value
					);
		$this->db->where('admin_id', $id);
		$update = $this->db->update('mydb_admin', $user_admin_data);
		return $update;
	}
	
	 function s3backup() {
	 	
	 	 
        $this->load->library('s3');
        // Load the DB utility class
        $this->load->dbutil();

        $prefs = array(
            'ignore' => array(), // List of tables to omit from the backup
            'format' => 'gzip', // gzip, zip, txt
            'filename' => 'backup.sql', // File name - NEEDED ONLY WITH ZIP FILES
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline' => "\n"               // Newline character used in backup file
        );


        $this->dbutil->backup($prefs);
        $now = time();
        $date = unix_to_human($now, TRUE, 'eu');

        $file = $this->doc_root . 'images/backup/backup.gz';


        // Backup your entire database and assign it to a variable
        $backup = & $this->dbutil->backup();
       
	   
        // Load the file helper and write the file to your server
        $this->load->helper('file');
        if (write_file($file, $backup)) {
          //  echo "write complete";
        } else {
          //  echo "write failed";
        }

      

        $target = 'LaworldBackup_' . $date . '.gz';
        //connect to amazon s3 and copy the file there
        //get folder info

        $bucket = $this->config_bucket . "backup";

        //echo $bucket;

        $this->s3->putBucket($bucket, S3::ACL_PUBLIC_READ);
        if ($this->s3->putObject($backup, $bucket, $target)) {
   //set last backup time
            $current_time = now();
            $backuptime = array(
                'last_update' => $current_time
            );
            
            $this->db->where('admin_id', 1);
            $update = $this->db->update('mydb_admin', $backuptime);


            return TRUE;
          
        } else {
return FALSE;
           
        }
        
    }
}