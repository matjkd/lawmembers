<?=$this->load->view('js/view-employee')?>
<?=$this->load->view('members/employee_controls')?>
<?php  foreach($employee_detail as $employee): ?>
<div style="float:left;">
				<div class="formfield">
						 <div class="leftcolumn">First Name:</div>
						 <div class='edit' id='firstname'><?=$employee->firstname?></div>
						 <div style="clear:both;"></div>
				</div>
				
				<div class="formfield">
						 <div class="leftcolumn">Last Name:</div>
						 <div class='edit' id='lastname'><?=$employee->lastname?></div>
						 <div style="clear:both;"></div>
				</div>

                                 <div class="formfield">
						 <div class="leftcolumn">Username:</div>
						 <div class='edit' id='username'><?=$employee->username?></div>
						 <div style="clear:both;"></div>
				</div>
				
				<div class="formfield">
						 <div class="leftcolumn">Job Title:</div>
						 <div class='edit' id='jobtitle'><?=$employee->jobtitle?></div>
						 <div style="clear:both;"></div>
				</div>
				
				<div class="formfield">
						 <div class="leftcolumn">Tel:</div>
						 <div class='edit' id='people_tel'><?=$employee->people_tel?></div>
						 <div style="clear:both;"></div>
				</div>
				
				<div class="formfield">
						 <div class="leftcolumn">Mob:</div>
						 <div class='edit' id='people_mobile'><?=$employee->people_mobile?></div>
						 <div style="clear:both;"></div>
				</div>
				<div class="formfield">
						 <div class="leftcolumn">Email:</div>
						 <div class='edit' id='people_email'><?=$employee->people_email?></div>
						 <div style="clear:both;"></div>
				</div>


                                <div class="formfield">
						 <div class="leftcolumn">Active:</div>
						 <div class='yesno' id='user_active'>
						 		<?php
									if($employee->user_active==0) {echo "No";};
									if($employee->user_active==1) {echo "Yes";};
								?>
						</div>
						 <div style="clear:both;"></div>
				</div>

                                 <div class="formfield">
						 <div class="leftcolumn">Visible on Site:</div>
						 <div class='yesno' id='visible'>
						 		<?php
									if($employee->visible==0) {echo "No";};
									if($employee->visible==1) {echo "Yes";};
								?>
						</div>
						 <div style="clear:both;"></div>
				</div>
</div>
<div style="float:right;">
<img width="100" height="100" src="http://www.laworld.com/admin/images/profiles/thumbs/<?=$employee->profile_photo?>">
<?php 
						echo realpath(APPPATH . '../images/profiles');
						echo form_open_multipart('members/upload_profile_image');
						echo form_hidden('id', $employee->idkeypeople);
						if(isset($employee->profile_photo))
						{
						echo form_hidden('current_image', $employee->profile_photo);
						}
						echo form_upload('userfile');
						echo form_submit('upload', 'Upload');
						echo form_close();
					?>


<br/>

<?php
	if(isset($employee->password))
		{
			echo "change password";
		}
	else
		{
			echo "<span style='color:red;'><h2>Set Password</h2></span>";

		}


?>


	 <?=form_open('user/edit_user/edit_password')?>
<table class="profiletable">
	<tr>
		<td class='leftcolumn'>
		<strong>Password</strong>
		</td>
		<td>
		<?php echo form_password('password'); ?>
		</td>
	</tr>
	<tr>
		<td class='leftcolumn'>
		<strong>Re-Type Password</strong>
		</td>
		<td>
		<?php echo form_password('password2'); ?>
		</td>
	</tr>


</table>

	<?=form_hidden('user_id', $employee->idkeypeople)?>
	<?=form_submit('submit', 'Submit')?>
	<?=form_close()?>




</div>




<div style="clear:both;"></div>	
	<?php echo form_open('members/edit_employee/');?>
	
	<?=form_hidden('id', $employee->idkeypeople)?>
	<?=form_hidden('elementid', 'people_resume')?>
	
	<?php 
$textarea_data = array(
              'name'        => 'value',
              'id'          => 'value',
			  'class' 		=> 'wymeditor',
              'value'       => $employee->people_resume
            );
		
		
		echo form_textarea($textarea_data);
		
		
?>
	<input type="submit" class="wymupdate" />
</form>	
<?php endforeach; ?>