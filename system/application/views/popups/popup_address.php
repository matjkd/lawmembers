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



<iframe src ="<?=base_url()?>members/add_address" width=100% height=100%>
  <p>Your browser does not support iframes. Go here for standalone form: <?=base_url()?>members/add_company</p>
</iframe>
</div>

