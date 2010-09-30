

	<?php  foreach($company as $companydetail): ?>
	
	


		<h3><a href="#"><?php echo $companydetail->company_name; ?></a></h3>
	
<div>
		
		<div style="float:left; width:230px;">
				
				<table>
					<tr>
						<td class='leftcolumn'>
						<strong>Name:</strong>
						</td>
						<td>
						 <div class='edit' id='company_name'><?=$companydetail->company_name?></div>
						</td>
					</tr>
				
					<tr>
						<td class='leftcolumn'>
						<a href="<?=$companydetail->company_web?>"><strong>Website:</strong></a>
						</td>
						<td>
						 <div class='edit' id='company_website'><?=$companydetail->company_web?></div> 
						</td>
					</tr>
					
					
				
				</table>

		</div>

<div id="image" style="float:left; width:230px; padding-left:20px;">
image here
</div>

<div style="clear:both;"></div>	

	
	<form>
	<textarea>
	<?=$companydetail->description?>
	</textarea>
	<input type="button" value="Update Description">
</form>	

<div>

		<?php endforeach ?>
</div>
		

	<div style="clear:both;"></div>	
		
		<div id="view_address" style="float:left; width:230px;">
		
		</div>
	
	<div><?php $this->load->view('members/ajaxaddresses'); ?></div>

	
	</div>

		