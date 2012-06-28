<?php

class Admin extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library(array('encrypt', 'form_validation'));
		$this->load->model('companies_model');
		$this->load->model('content_model');
		$this->load->model('users_model');
		$this->load->model('gallery_model');
		$this->load->model('newsletter_model');
		$this->load->library('s3');
		$this->is_logged_in();
	}

	function index() {
		echo "hello";
	}


	function sort_gallery() {
		$pages = $this->input->post('pages');
		parse_str($pages, $pageOrder);
	
		// list id is retrieved from the ID on the sortable list
		foreach ($pageOrder['gallery'] as $key => $value):
		mysql_query("UPDATE mydb_content SET `order` = '$key' WHERE `content_id` = '$value'") or die(mysql_error());
	
	
		//$this->db->update('practice_area_links', $pro_update);
		endforeach;
	}
	
	function create_gallery() {
		$this->form_validation->set_rules('gallery_name', 'Gallery Name', 'trim|max_length[255]|required');
		if ($this->form_validation->run() == FALSE) { // validation hasn'\t been passed
			echo "validation error";
		} else { // passed validation proceed to post success logic
		
			$this->gallery_model->create_gallery();
			
			redirect('/gallery');  // or whatever logic needs to occur
		}
	}
	
	function submit_content() {
		$this->form_validation->set_rules('title', 'Title', 'trim|max_length[255]|required');
		$this->form_validation->set_rules('content', 'Content', 'trim');
		$this->form_validation->set_rules('menu', 'menu', 'trim');
		$this->form_validation->set_rules('category', 'Page Type', 'trim|max_length[11]');
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
		
		if ($this->form_validation->run() == FALSE) { // validation hasn'\t been passed
			echo "validation error";
		} else { // passed validation proceed to post success logic
			if ($this->content_model->add_content()) { // the information has therefore been successfully saved in the db
				//now process the image
				// run insert model to write data to db
				//upload file
				//retrieve uploaded file
				
				$this->upload_image();
				



				redirect('/gallery');  // or whatever logic needs to occur
			} else {
				echo 'An error occurred saving your information. Please try again later';
				// Or whatever error handling is necessary
			}
		}
	}

	function upload_image($id = 0) {

		$this->gallery_model->do_image_upload();

		
		
		if (!empty($_FILES) && $_FILES['file']['error'] != 4) {

			$fileName = $_FILES['file']['name'];
			$tmpName = $_FILES['file']['tmp_name'];
			$fileName = str_replace(" ", "_", $fileName);
			$filelocation = $fileName;

			$thefile = file_get_contents($tmpName, true);

			//add filename into database
			//get blog id
			if ($id == 0) {
				$blog_id = mysql_insert_id();
			} else {
				$blog_id = $id;
			}
			$this->content_model->add_file($fileName, $blog_id);
			
			//move the file

			if ($this->s3->putObject($thefile, $this->bucket, "gallery/".$filelocation, S3:: ACL_PUBLIC_READ)) {
				//echo "We successfully uploaded your file.";
				$this->session->set_flashdata('message', 'News Added and file uploaded successfully');
			} else {
				//echo "Something went wrong while uploading your file... sorry.";
				$this->session->set_flashdata('message', 'News Added, but your file did not upload');
			}

			//uploadthumb
			$thumblocation = base_url() . 'images/temp/thumbs/' . $fileName;
			$newfilename = "thumb_" . $fileName;


			$newfile = file_get_contents($thumblocation, true);

			if ($this->s3->putObject($newfile, $this->bucket, "gallery/thumbs/".$newfilename, S3:: ACL_PUBLIC_READ)) {
				//echo "We successfully uploaded your file.";
				$this->session->set_flashdata('message', 'News Added and file uploaded successfully');
			} else {
				//echo "Something went wrong while uploading your file... sorry.";
				$this->session->set_flashdata('message', 'News Added, but your file did not upload');
			}
			//delete files from server
			$this->gallery_path = "./images/temp";
			unlink($this->gallery_path . '/' . $fileName . '');
			unlink($this->gallery_path . '/thumbs/' . $fileName . '');
		} else {

			$this->session->set_flashdata('message', 'News Added');
		}
	}


	function is_logged_in() {
		$is_logged_in = $this->session->userdata('is_logged_in');
		$role = $this->session->userdata('role');
		if (!isset($is_logged_in) || $is_logged_in != true) {
			$data['message'] = "You don't have permission";
			redirect('welcome', 'refresh');
		}
	}

}