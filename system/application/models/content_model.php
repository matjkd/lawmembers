<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Content_model extends Model {

	function __construct() {
		parent::__construct();
	}

	function get_content($title) {

		$this->db->where('menu', $title);
		$query = $this->db->get('mydb_content');
		if ($query->num_rows == 1) {
			return $query->result();
		}
	}

	function get_content_cat($cat) {

		$this->db->where('category', $cat);
		$this->db->order_by('date_added', 'desc');
		$query = $this->db->get('mydb_content');
		if ($query->num_rows > 0) {
			return $query->result();
		}
	}
	
	function get_content_id($id) {
	
		$this->db->where('content_id', $id);
		$query = $this->db->get('mydb_content');
		if ($query->num_rows == 1)
			; {
			return $query->result();
		}
	}

	function get_gallery($gallery) {

		$this->db->where('gallery', $gallery);
		$this->db->order_by('order');
		$query = $this->db->get('mydb_content');
		if ($query->num_rows > 0) {
			return $query->result();
		}
	}

	function add_content() {

		//process menu link
		$menu_link = $this->input->post('menu');
		$search = array(" ");
		$replace = "-";
		if ($menu_link == NULL) {

			$subject = set_value('title');
			$menu_link = str_replace($search, $replace, $subject);
		} else {
			$subject = $this->input->post('menu');
			$menu_link = str_replace($search, $replace, $subject);
		}

		// build array for the model
		$name = "" . $this->session->userdata('firstname') . " " . $this->session->userdata('lastname') . "";

		$now = time();
		$datetime = $now;
		$form_data = array(
				'title' => set_value('title'),
				'content' => $this->input->post('content'),
				'menu' => $menu_link,
				'category' => set_value('category'),
				'added_by' => $name,
				'gallery' => $this->input->post('gallery'),
				'date_added' => $datetime
		);
		$insert = $this->db->insert('mydb_content', $form_data);
		return $insert;
	}
	
	function edit_content($id) {
	
	
		$content_update = array(
				'content' => $this->input->post('content'),
				'menu' => $this->input->post('menu'),
				'gallery' => $this->input->post('gallery'),
				'title' => $this->input->post('title'),
				'extra' => $this->input->post('extra'),
				'meta_desc' => $this->input->post('meta_desc'),
				'meta_keywords' => $this->input->post('meta_keywords'),
				'meta_title' => $this->input->post('meta_title'),
				'sidebox' => $this->input->post('sidebox')
		);
	
	
	
	
		$this->db->where('content_id', $id);
		$update = $this->db->update('mydb_content', $content_update);
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
				'news_image' => $filename
		);
	
		$this->db->where('content_id', $blog_id);
		$update = $this->db->update('mydb_content', $content_update);
		return $update;
	}
}