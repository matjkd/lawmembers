<script type="text/javascript">


function assign_user_to_account(user_id, account_id) {

		$.post('<?=base_url()?>filetransfer/assign_user_to_account/', {user_id: user_id, account_id: account_id});
		alert("added!");
		location.reload();
			
	}
	
function delete_user_from_account(user_id, account_id) {

		$.post('<?=base_url()?>filetransfer/remove_user_from_account/', {user_id: user_id, account_id: account_id});
		alert("deleted!");	
		location.reload();
			
	}	

</script>



<div class="container_24">
	
	<div class="grid_24">
	<?php foreach($company as $row):?>
		<h1><?=$row->company_name?> File Transfer Admin</h1>
		
	
	<?php endforeach; ?>
	</div>


    <?php
      //this is admin only
        $is_logged_in = $this->session->userdata('is_logged_in');
        $role = $this->session->userdata('user_level');

     if(!isset($is_logged_in) || $role > 1)
		{

		}
		else
		{
                
        
    ?>


	
	
	<div class="clear"></div>
	<br/>
	
	<div class="grid_10">
	<?=$this->load->view('filetransfer/add_folder')?>	
	</div>
	
	<div class="clear"></div>
	<br/>
        <?php
        //end of admin only
        }
        ?>
	<div class="grid_24">
	<?php
       
        if(isset($is_logged_in) && $role < 2)
            {
             
                $this->load->view('filetransfer/folders');
            }
            else
            {
                $this->load->view('filetransfer/foldersnoadmin');
            }
            ?>
	
	</div>
</div>

