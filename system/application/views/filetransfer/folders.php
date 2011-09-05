Folders<br/>
	<?php if($folders != NULL) { foreach($folders as $row):?>
	<div class="filefolder" >



<?php
 $is_logged_in = $this->session->userdata('is_logged_in');
 $role = $this->session->userdata('user_level');
$folder_id = $row['folder_id'];

$options = array();


?>


<?php
 
		





$attributes0 = array('name' => 'assign');?>




<a href="<?=base_url()?>filetransfer/view_folder/<?=$folder_id?>">			
    <img alt="folder icon"  src="<?=base_url()?>images/Folder-icon128.png"/>
</a>


<?php $attributes1 = array('name' => 'delete_folder');?>

<strong><?=$row['folder_name']?></strong> 




<a href="<?=base_url()?>filetransfer/delete_folder/<?=$folder_id?>"><image height="14px" src="<?=base_url()?>images/del.png"/></a><br/>


<br/>
<br/>
	







	</div>
	<?php endforeach; } ?>

