
	<?php if($folders != NULL) { foreach($folders as $row):?>
	<div class="filefolder" >



<?php
 $is_logged_in = $this->session->userdata('is_logged_in');
 $role = $this->session->userdata('user_level');
$folder_id = $row['folder_id'];

$options = array();


?>







<a href="<?=base_url()?>filetransfer/view_folder/<?=$folder_id?>">
    <img alt="folder icon"  src="<?=base_url()?>images/Folder-icon128.png"/>
</a>
<p>


<strong><?=$row['folder_name']?></strong>

<br/>



</p>
<br/>








	</div>
	<?php endforeach; } ?>

