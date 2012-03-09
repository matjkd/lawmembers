
	
<div class="topmenu">

<?php $is_logged_in = $this->session->userdata('is_logged_in');
$role = $this->session->userdata('user_level');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
		
		}
		else
		{
?>

 <div style="padding-left:10px; padding-right:10px; float:left;">
	<?=anchor('filetransfer', 'Members')?> 
</div>


<div style="padding-left:10px; padding-right:10px; float:left;">
	<?=anchor('events', 'Events')?> 
</div>

    
    <div style="padding-left:10px; padding-right:10px; float:left;">
	<?=anchor('filetransfer/view_account/1', 'Files')?> 
</div>

      <div style="padding-left:10px; padding-right:10px; float:left;">
	<?=anchor('clientsearches', 'Client Business Opportunities')?>
</div>
<<<<<<< HEAD
  <div style="padding-left:10px; padding-right:10px; float:left;">
	<?=anchor('newsletters', 'Newsletters')?>
</div>
=======

>>>>>>> a13ec6ec834fce02ad7b972183a438b4377fb8ba
 
<?php 


                }
                
                if($role < 2 &&$is_logged_in=='1') {?>
                    
 <div style="padding-left:10px; padding-right:10px; float:right;">
	<?=anchor('members', 'Member Admin')?> 
</div>
    
    
 <div style="padding-left:10px; padding-right:10px; float:right;">
	<?=anchor('members/users', 'Users Admin')?> 
</div>
    
                    <div style="padding-left:10px; padding-right:10px; float:right;">
	<?=anchor('filetransfer', 'Files Admin')?> 
</div>
            <?php    }

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