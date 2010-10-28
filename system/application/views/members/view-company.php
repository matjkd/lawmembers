<?=$this->load->view('js/view-company')?>

<div>

<?=$this->load->view('members/controls')?>

</div>

	<?php 
	if($company_id == 0)
	{
		
	}
	else
	{
	?>
		
	<div class="demo">
	<div id="accordion">	
	<?=$this->load->view("members/company_detail")?>
	<h3><a href="#">Employees</a></h3>
	<div>
		
	<?=$this->load->view("members/ajaxemployees")?> 
		</div>
	
	


	</div>
	
</div>
<hr></hr>
	<?php }
	?>
		




