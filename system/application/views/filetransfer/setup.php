<script type="text/javascript">
	$(function() {
		var availableTags = [<?php $this->load->view('company/company_names');?>];
		$("#company").autocomplete({
			source: availableTags
		});
	});
	
	$(function() {
		$("#tabs").tabs();
	});
	</script>


<div id="tabs">

<ul>
<li><a href="#tabs-1">Create a new File Transfer Account</a></li>
</ul>
	<div id="tabs-1">
	Type the company name here:
	<?=form_open('filetransfer/createTransfer')?>	
		
		<input type="text" name="company" id="company" style="width:150px; "/>
			
	
	<?php 
	echo form_submit('submit', 'Create New Transfer Account');
	form_close();
	?>
	
	</div>
</div>


<?=$this->load->view('filetransfer/listaccounts')?>
