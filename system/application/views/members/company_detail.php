

	<?php  foreach($company as $companydetail): ?>
	
	


		<h3><a href="#"><?php echo $companydetail->company_name;  ?></a></h3>
	
<div>
<div id="main_edit" style="float:left; width:610px; ">	

<div id="image" style="float:left; width:180px; padding-right:20px;">
<img width="180" height="180" src="http://www.laworld.com/images/stories/companies/<?=$companydetail->company_image?>">
<img width="180" height="180" src="http://www.laworld.com/admin/images/companies/thumbs/<?=$companydetail->filename?>">
</div>
	
		<div style="float:left; width:410px;">
				
				<div class="formfield">
						<div class="leftcolumn">Name:</div>
						 <div class='edit' id='company_name'><?=$companydetail->company_name?></div>
						 <div style="clear:both;"></div>
				</div>
						
				<div class="formfield">		
						<a href="http://<?=$companydetail->company_web?>"><div class="leftcolumn">Website:</div></a>
						 <div class='edit' id='company_website'><?=$companydetail->company_web?></div>
						  <div style="clear:both;"></div> 
				</div>
				
			
					
				<div class="formfield">
						<div class="leftcolumn">Active:</div>
						 <div class='yesno' id='active'>
						 		<?php 
									if($companydetail->active==0) {echo "No";}; 
									if($companydetail->active==1) {echo "Yes";};
								?>
						</div>
						 <div style="clear:both;"></div>
				</div>
				
				<div id="upload">
					<?php 
						echo realpath(APPPATH . '../images/companies');
						echo form_open_multipart('members/upload_image');
						echo form_hidden('id', $companydetail->idcompany);
						if(isset($companydetail->filename))
						{
						echo form_hidden('current_image', $companydetail->filename);
						}
						echo form_upload('userfile');
						echo form_submit('upload', 'Upload');
						echo form_close();
					?>
				
				</div>
				<div style="clear:both;"></div>
				
		</div>





<div style="clear:both;"></div>	

	<br/>
	
</div>

<div id="view_address" style="float:left; width:230px;">
		
</div>
		
	
	<div style="clear:both;"></div>	
	<?php echo form_open('members/edit_description/'.$companydetail->idcompany.'');?>
	
	<?php 
$textarea_data = array(
              'name'        => 'description',
              'id'          => 'description',
				'class' => 'wymeditor',
              'value'       => $companydetail->description
            );
		
		
		echo form_textarea($textarea_data);
		
		
?>
	<input type="submit" class="wymupdate" />
</form>	
	<?php endforeach; ?>	
	
	
	<div><?php $this->load->view('members/ajaxaddresses'); ?></div>

	
	</div>

		