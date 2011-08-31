<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Database extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
                $this->load->library('upload');
                $this->load->library('s3');
		$this->is_logged_in();
	
              
	}
	function index()
	{
		
	}
	function backup()
	{
		// Load the DB utility class
		$this->load->dbutil();
		
		$prefs = array(
              
                'ignore'      => array(),           // List of tables to omit from the backup
                'format'      => 'gzip',             // gzip, zip, txt
                'filename'    => 'backup.sql',   	// File name - NEEDED ONLY WITH ZIP FILES
                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
              );

		
         $this->dbutil->backup($prefs);
		 $now = time();
         $date = unix_to_human($now, TRUE, 'eu');
         $file = $this->doc_root.'images/backup/backup.gz';
		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup(); 

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file($file, $backup);

		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('Backup_'.$date.'.gz', $backup);


	}

        function s3backup()
	{
		// Load the DB utility class
		$this->load->dbutil();

		$prefs = array(

                'ignore'      => array(),           // List of tables to omit from the backup
                'format'      => 'gzip',             // gzip, zip, txt
                'filename'    => 'backup.sql',   	// File name - NEEDED ONLY WITH ZIP FILES
                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
              );


            $this->dbutil->backup($prefs);
            $now = time();
             $date = unix_to_human($now, TRUE, 'eu');

                $file = $this->doc_root.'images/backup/backup.gz';


		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup();
                $testdata = "some data";

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		if(write_file($file, $backup)){
                echo "write complete";
                } else {
                  echo "write failed";
                }

echo "....";
             
                $target = 'LaworldBackup_'.$date.'.gz';
                //connect to amazon s3 and copy the file there
		

		//get folder info
               
                $bucket = $this->config_bucket."backup";

echo $bucket;

$this->s3->putBucket($bucket, S3::ACL_PUBLIC_READ);
               if ($this->s3->putObject($backup, $bucket, $target)) {

                    echo "backup complete";
                } else {

                   echo "backup failed ".$this->doc_root;
                   echo "<br/>";
                   echo $bucket." ".$target;
                                   echo "<br/>";
                
                }
                echo $target;
	}
	
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			$this->session->set_flashdata('conf_msg', "You need to log in");
			redirect('user/login');

		}
	}	
}