
	
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
    <div style="padding-left:10px; float:left;">
	<?=anchor('filetransfer', 'Files')?>
</div>

        <div style="padding-left:10px; float:left;">
	<?=anchor('clientsearches', 'Client Searches')?>
</div>


<?php 
		}
		?>


<div style="float:right">
<?php 
		if($is_logged_in == true && $role == '0')
		{
		echo anchor('database/backup', 'Backup');
                echo $is_logged_in;
		}
		else
		{
			
		}
		?>


</div>
</div>