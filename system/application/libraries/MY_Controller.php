<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends Controller {

	function __construct() {
	parent::Controller();
	
	$config_data['config_company_name'] = "Laworld";
	$config_data['config_address'] = "address";
	$config_data['config_version'] = "0.0.1";
	$config_data['config_email'] = "email";
	$config_data['config_website'] = "web address";
	$config_data['config_phone'] = "phone";
	

	$this->load->vars($config_data);
	
	}
	

}