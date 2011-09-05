<?php 
class Gallery_model extends Model {
	
	var $gallery_path;
	var $gallery_path_url;
	var $profile_path;
	var $profile_path_url;
	
	function Gallery_model() {
		
		parent::Model();
		
		$this->gallery_path = './images/companies';
		$this->gallery_path_url = base_url().'images/companies/';
		$this->profile_path = './images/profiles';
		$this->profile_path_url = base_url().'images/profiles/';
                $this->load->library('s3');
		
	}
	
	function do_upload($id) {
		
		$config = array(
		'allowed_types' => 'jpg|jpeg|gif|png',
		'upload_path' => $this->gallery_path,
		'max_size' => 2000
		);
		
		$this->load->library('upload', $config);
		$this->upload->do_upload();
		$image_data = $this->upload->data();
		
		
		
		$config = array(
			'source_image' => $image_data['full_path'],
			'new_image' => $this->gallery_path . '/thumbs',
			'maintain_ratio' => true,
			'width' => 239,
			'height' => 239
		
		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		$this->image_lib->clear();
		
		
	
		
		$upload_data = array($this->upload->data());
		
		foreach($upload_data as $row):
		
		
		// add this to database $row['filename'];
		$new_image_data = array(
				'filename' => $row['file_name'],
		);
		$this->db->where('idcompany', $id);
		$this->db->update('mydb_company', $new_image_data);
		
		endforeach;
		
		
		
	}
	function do_profile_upload($id)
	{
		$config = array(
		'allowed_types' => 'jpg|jpeg|gif|png',
		'upload_path' => $this->profile_path,
		'max_size' => 2000
		);
		
		$this->load->library('upload', $config);
		$this->upload->do_upload();
		$image_data = $this->upload->data();
		
		
		
		$config = array(
			'source_image' => $image_data['full_path'],
			'new_image' => $this->profile_path . '/thumbs',
			'maintain_ratio' => true,
			'width' => 239,
			'height' => 239
		
		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		$this->image_lib->clear();
		
		
		
		$upload_data = array($this->upload->data());
		
		foreach($upload_data as $row):
		
		
		// add this to database $row['filename'];
		$new_image_data = array(
				'profile_photo' => $row['file_name'],
		);
		$this->db->where('idkeypeople', $id);
		$this->db->update('mydb_keypeople', $new_image_data);
		
		endforeach;
	}

        function do_profile_upload_S3($id)
	{


	    $bucketname = "laworld";


            $config = array(
		'allowed_types' => 'jpg|jpeg|gif|png',
		'upload_path' => $this->profile_path,
		'max_size' => 2000
		);

		$this->load->library('upload', $config);
		if($this->upload->do_upload()){ echo "upload done"; } else
                {

                $this->upload_error = $this->upload->display_errors();
                echo $this->upload_error;

                }

		$image_data = $this->upload->data();



		$config = array(
			'source_image' => $image_data['full_path'],
			'new_image' => $this->profile_path . '/thumbs',
			'maintain_ratio' => true,
			'width' => 239,
			'height' => 239

		);

		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		$this->image_lib->clear();



		$upload_data = array($this->upload->data());

		foreach($upload_data as $row):

                //copy files to s3
                //copy large image
              $filelocation = 'profiles/'.$row['file_name'];

	      $thefiletmp = $image_data['full_path'];
              $thefile = file_get_contents($thefiletmp, true);

                if ($this->s3->putObject($thefile, $bucketname, $filelocation, S3:: ACL_PUBLIC_READ))
                                            {
                                           //echo "We successfully uploaded your file.";
                                          // @TODO combine the flashdata messages as an array then set flashdata at the end
                                                $this->session->set_flashdata('message', 'file uploaded successfully');
                                            }
                                            else
                                            {
                                           //	echo "Something went wrong while uploading your file... sorry.";
                                             $this->session->set_flashdata('message', 'your file did not upload');
                                            }

             
               //copy thumb
            $filelocation = 'profiles/thumbs/'.$row['file_name'];

	      $thefiletmp = $image_data['file_path']."/thumbs/".$image_data['file_name'];
              $thefile = file_get_contents($thefiletmp, true);

                if ($this->s3->putObject($thefile, $bucketname, $filelocation, S3:: ACL_PUBLIC_READ))
                                            {
                                           //echo "We successfully uploaded your file.";
                                                $this->session->set_flashdata('message', 'file uploaded successfully');
                                            }
                                            else
                                            {
                                           //	echo "Something went wrong while uploading your file... sorry.";
                                             $this->session->set_flashdata('message', 'your thumb file did not upload');
                                            }



		// add this to database $row['filename'];
		$new_image_data = array(
				'profile_photo' => $row['file_name'],
		);
		$this->db->where('idkeypeople', $id);
		$this->db->update('mydb_keypeople', $new_image_data);

		endforeach;
	}

	
	
}