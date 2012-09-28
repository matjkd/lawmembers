<?php

class Sitecontent extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('companies_model');
		$this->load->model('content_model');
        $this->load->model('users_model');
        $this->load->model('Gallery_model');
        $this->is_logged_in();
    }
	
	
	  function index() {
        redirect('sitecontent/landing/');
    }
	  
	  function landing() {

		$data['oldContent'] = $this->content_model->get_old_content();
		$x = 0;
		 foreach($data['oldContent'] as $row):
			 
			 $form_data = array(
				'title' => $row->title,
				'content' => $row->introtext."<br/>".$row->fulltext,
				'menu' => $row->alias,
				'category' => $row->catid,
				'added_by' => $row->created_by,
				'active' => $row->state,
				'gallery' => $this->input->post('gallery'),
				'date_added' =>  human_to_unix($row->created),
				'start_publish' => human_to_unix($row->publish_up),
				'end_publish' => human_to_unix($row->publish_down)
		);
			 
		$this->db->where('menu',  $row->alias);
		
		$query = $this->db->get('mydb_content');
		
		if ($query->num_rows == 0)
			 {
			$x = $x +1;
			echo $row->alias."</br>";
				$insert = $this->db->insert('mydb_content', $form_data);
		} else {
			echo "transfered<br/>";
		}
			 
		 endforeach;
		echo $x;
        $data['main'] = '/user/logged_in_area';

        $data['body'] = '/global/oldContent';
        $this->load->vars($data);
        $this->load->view('main_template');
    }
	   function is_logged_in() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            $this->session->set_flashdata('conf_msg', "You need to log in");
            redirect('user/login');
        }
    }
	
	
}
