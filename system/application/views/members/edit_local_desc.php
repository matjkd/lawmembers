	<?php  foreach($company as $companydetail2): ?>
<?php echo form_open('members/edit_local_description/'.$companydetail2->idcompany.'');?>
	
	<?php 
$textarea_data2 = array(
              'name'        => 'description_local',
              'id'          => 'description_local',
				'class' => 'wymeditor',
              'value'       => $companydetail2->description_local
            );
		
		
		echo form_textarea($textarea_data2);
		
		
?>
	<input type="submit" class="wymupdate" />
</form>	
	<?php endforeach; ?>	