

	<?php  foreach($company as $companydetail): ?>

		<h3><a href="#"><?php echo $companydetail->company_name; ?></a></h3>
<div>
		
		<div style="float:left;">
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
<form>
<?=$companydetail->description?>
</form>
		<?php endforeach ?>
		
	</div>	

	<div style="clear:both;"><br/>
	
	<div><?php $this->load->view('members/ajaxaddresses'); ?></div>
	</div>	
	</div>

		