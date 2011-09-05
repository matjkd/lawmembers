<?php if($folders != NULL) { foreach($folders as $row):
  //set variables
 $folder_id = $row['folder_id'];
    
  ?>


<div class="filefolder" >

<a href="<?=base_url()?>filetransfer/view_folder/<?=$folder_id?>">
    <img alt="folder icon"  src="<?=base_url()?>images/Folder-icon128.png"/>
</a>

<strong><?=$row['folder_name']?></strong> 
    
</div>
<?php endforeach; }?>