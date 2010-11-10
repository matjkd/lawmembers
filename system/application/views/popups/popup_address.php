<script type="text/javascript">
	// increase the default animation speed to exaggerate the effect
	$.fx.speeds._default = 500;
$(document).ready(function() {
		$('#dialog_address').dialog({
			autoOpen: false,
			
			width:450,
			height:200
		});
		
		$('#add_address').click(function() {
			$('#dialog_address').dialog('open');
			return false;
		});
	});


	</script>
	
	<div id="dialog_address"  class="dialog" title="Add Address">

<div id="popup_form" align="center">

<?=form_open('members/add_address/'.$company_id)?>

<?=form_label('address1')?> <?=form_input('address1')?><br/>

<?=form_label('address2')?> <?=form_input('address2')?><br/>

<?=form_submit('submit','Submit')?>

<?=form_close()?>
</div>
</div>

