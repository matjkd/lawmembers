<script type="text/javascript">
	// increase the default animation speed to exaggerate the effect
	$.fx.speeds._default = 500;
$(document).ready(function() {
		$('#dialog_employee').dialog({
			autoOpen: false,
			
			width:450,
			height:200
		});
		
		$('#add_employee').click(function() {
			$('#dialog_employee').dialog('open');
			return false;
		});
	});


	</script>
	
	<div id="dialog_employee"  class="dialog" title="Add Employee">




<div id="popup_form" align="center">
<?=form_open('members/add_employee/'.$company_id)?>

<?=form_label('First Name')?> <?=form_input('firstname')?><br/>

<?=form_label('Last Name')?> <?=form_input('lastname')?><br/>

<?=form_label('Email')?> <?=form_input('email')?><br/>

<?=form_submit('submit','Submit')?>

<?=form_close()?>
</div>
</div>

