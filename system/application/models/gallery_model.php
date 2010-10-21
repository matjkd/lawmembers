<?php 
class Gallery_model extends Model {
	
	var $gallery_path;
	var $gallery_path_url;
	
	function Gallery_model() {
		
		parent::Model();
		
		$this->gallery_path = './images/companies';
		$this->gallery_path_url = base_url().'images/companies/';
		
	}
	
	function do_upload($id) {
		
		$config = array(
		'allowed_types' => 'jpg|jpeg|gif|png',
		'upload_path' => $this->gallery_path . '/'.$id.'',
		'max_size' => 2000
		);
		
		$this->load->library('upload', $config);
		$this->upload->do_upload();
		$image_data = $this->upload->data();
		
		
		
		$config = array(
			'source_image' => $image_data['full_path'],
				'new_image' => $this->gallery_path . '/'.$id.'/thumbs',
			'maintain_ratio' => true,
			'width' => 200,
			'height' => 200
		
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
		
		$this->db->insert('mydb_company', $new_image_data);
		
		endforeach;
		
		
		
	}

	
	
}