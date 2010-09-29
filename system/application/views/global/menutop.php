<?php 

$is_logged_in = $this->session->userdata('is_logged_in');
if(!isset($is_logged_in) || $is_logged_in != true)
		{
			echo anchor('/user/login', 'Login');
			//echo ' | ';	
			//echo anchor('/user/login/register', 'Register');
			
		}	

		else
			{
				echo 'Hello '; echo $this->session->userdata('username');
				echo ' | '; echo anchor('user/login/logout', 'Logout');
			}
?>

