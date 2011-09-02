<script type="text/javascript">
	$(function() {
		$("#accordion").accordion({
			collapsible: true,
			autoHeight: false,
			navigation: true
		});
	});
</script>
<div>

<?=$this->load->view('members/controls')?>

</div>

<?php
	if($company_id == NULL)
	{

	}
	else
	{
	?>

<div style="font-size: 0.9em;">
	<div id="accordion">
	<?=$this->load->view("members/company_detail_viewonly")?>
	




	</div>

</div>

	<?php }
	?>