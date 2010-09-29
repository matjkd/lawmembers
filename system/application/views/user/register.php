<div align=center><h1>Create an Account!</h1></div>
<fieldset>
<legend>Personal Information</legend>
<?php
   
echo form_open('user/login/create_member');

echo form_input('firstname', set_value('firstname', 'First Name'));
echo form_input('lastname', set_value('lastname', 'Last Name'));
echo form_input('email_address', set_value('email_address', 'Email Address'));
?>
</fieldset>

<fieldset>
<legend>Login Info</legend>
<?php
echo form_input('username', set_value('username', 'Username'));
echo form_password('password', set_value('password', 'Password'));
echo form_password('password2', 'Password Confirm');
echo form_hidden('registerDate', unix_to_human(now()));
echo form_submit('submit', 'Create Acccount');
?>

<?php echo validation_errors('<p class="error">'); ?>
</fieldset>