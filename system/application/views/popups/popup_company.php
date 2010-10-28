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



<iframe src ="<?=base_url()?>members/add_company" width=100% height=100%>
  <p>Your browser does not support iframes. Go here for standalone form: <?=base_url()?>members/add_company</p>
</iframe>
</div>

