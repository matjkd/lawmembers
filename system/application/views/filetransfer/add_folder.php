
	<?=form_open('filetransfer/create_folder')?>
	Folder Name<br/>
	<?=form_input('folder_name')?> 
	
	<?=form_hidden('account_id', $account_id)?> 
	

	<?=form_submit('submit', 'Add Folder')?>
	<?=form_close()?>