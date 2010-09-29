<div id="login_form">

	<?php 
	echo form_open('user/login/validate_credentials');
	echo form_input('username', 'Username');
	echo "<BR/><BR/>";
	echo form_password('password', 'Password');?>
	<br/><br/>
	<?php
	echo form_submit('submit', 'Login');
	//echo anchor('user/login/register', 'Create Account');
	echo form_close();
	?>
<div style="clear:both;"></div>
</div><!-- end login_form--><br/>


