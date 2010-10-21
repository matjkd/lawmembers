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
	
	$this->config_ftp_host = '213.229.86.110';
	$this->config_ftp_user = 'laworld';
	$this->config_ftp_password = 'l33t523';
	$this->load->vars($config_data);
	
	}
	

}