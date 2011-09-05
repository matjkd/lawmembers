
	
<div class="topmenu">

<?php $is_logged_in = $this->session->userdata('is_logged_in');
$role = $this->session->userdata('user_level');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
		
		}
		else
		{
?>

<div style=" float:left;">
	<?=anchor('members', 'Members')?>
</div>

 <div style="padding-left:10px; float:left;">
	<?=anchor('members/users', 'Users')?>
</div>

<div style="padding-left:10px; float:left;">
	<?=anchor('events', 'Events')?>
</div>


<?php 
		}
		?>


<div style="float:right">
<?php 
		if(!isset($is_logged_in) || $role > 1)
		{
		
		}
		else
		{
			echo anchor('database/backup', 'Backup');
		}
		?>


</div>
</div>