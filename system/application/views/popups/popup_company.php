<script type="text/javascript">
	// increase the default animation speed to exaggerate the effect
	$.fx.speeds._default = 500;
$(document).ready(function() {
		$('#dialog_company').dialog({
			autoOpen: false,
			
			width:450,
			height:200
		});
		
		$('#add_company').click(function() {
			$('#dialog_company').dialog('open');
			return false;
		});
	});


	</script>
	
	<div id="dialog_company"  class="dialog" title="Add Company">


<div id="popup_form" align="center">
<?=form_open('members/create_company')?>

<?=form_label('Company Name')?> <?=form_input('company_name')?><br/>

<?=form_label('Web Address')?> <?=form_input('company_web')?><br/>

<?=form_submit('submit','Submit')?>

<?=form_close()?>
</div>
</div>

