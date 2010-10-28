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



<iframe src ="<?=base_url()?>members/add_employee" width=100% height=100%>
  <p>Your browser does not support iframes. Go here for standalone form: <?=base_url()?>members/add_employee</p>
</iframe>
</div>

