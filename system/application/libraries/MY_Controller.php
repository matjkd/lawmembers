<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends Controller {

	function __construct() {
	parent::Controller();

	$this->load->model('admin_model');
	$this->load->library('postmark');

	$admindata = $this->admin_model->get_admin(1);
		foreach($admindata as $row):

			$config_data['config_company_name'] = $row->company_name;
			$config_data['config_company_short'] = $row->company_name_short;

			$config_data['config_address1'] = $row->address1;
			$config_data['config_address2'] = $row->address2;
			$config_data['config_address3'] = $row->address3;
			$config_data['config_address4'] = $row->address4;
			$config_data['config_address5'] = $row->address5;

			$config_data['config_address'] = "".$row->address1.", ".$row->address2.", ".$row->address3.", ".$row->address4.", ".$row->address5."";

			$config_data['config_version'] = "0.0.9";
			$config_data['config_email'] = $row->main_email;
			$config_data['config_website'] = $row->web_address;
			$config_data['config_phone'] = $row->main_phone;
			$config_data['config_theme'] = $row->company_theme;
			$config_data['config_logo'] = $row->company_logo;
			$config_data['config_doc_root'] = $row->doc_root;
			$config_data['access_key'] = $row->access_key_id;
			$config_data['secret_key'] = $row->access_key;
			$config_data['config_bucket'] = $row->bucket;
		//	$this->config->set_item('access_key', $row->access_key_id);
		//	$this->config->set_item('secret_key', $row->access_key);

			$this->access_key = $row->access_key_id;
			$this->secret_key = $row->access_key;
			$this->config_email = $row->main_email;
			$this->config_bucket = $row->bucket;
			$this->doc_root = $row->doc_root;
			$this->config->set_item('access_key', $this->access_key);
			$this->config->set_item('secret_key', $this->secret_key);

			$this->config_company_name = $row->company_name;
			$this->load->vars($config_data);

		endforeach;


	}


}