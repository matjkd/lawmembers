<style>
	#toolbar {
		padding: 5px 4px;
		width:930px;
		margin-bottom: 10px;
		background: #85B5D9;
		font-size:0.8em;
	}
	#forward {
	float:right;
	}
	
	</style>
<script>
	$(function() {
		$( "#beginning" ).button({
			text: false,
			icons: {
				primary: "ui-icon-seek-start"
			}
		});
		$( "#rewind" ).button({
			text: false,
			icons: {
				primary: "ui-icon-seek-prev"
			}
		});
		$( "#play" ).button({
			text: false,
			icons: {
				primary: "ui-icon-play"
			}
		})
		
		$( "#stop" ).button({
			text: false,
			icons: {
				primary: "ui-icon-stop"
			}
		})
		.click(function() {
			$( "#play" ).button( "option", {
				label: "play",
				icons: {
					primary: "ui-icon-play"
				}
			});
		});
		$( "#forward" ).button({
			text: false,
			icons: {
				primary: "ui-icon-seek-next"
			}
		});
		$( "#end" ).button({
			text: false,
			icons: {
				primary: "ui-icon-seek-end"
			}
		});

		$( ".dialog" ).dialog({
			autoOpen: false			
		});
		
		
		$( "#add_company" ).button().click(function() {
			$( "#dialog_company" ).dialog( "open" );
			return false;
		});
		
		$( "#add_address" ).button().click(function() {
			$( "#dialog_address" ).dialog( "open" );
			return false;
		});
		
		$( "#add_employee" ).button().click(function() {
			$( "#dialog_employee" ).dialog( "open" );
			return false;
		});
		
		$( "#repeat" ).buttonset();

		
	});
	
	</script>


<div id="toolbar" class="ui-widget-header ui-corner-all">
	
	<a href="#"><button id="rewind">Previous Record</button></a>
<span align=center>
	<a href="#"><button id="add_company">Add Company</button></a>
	<a href="#"><button id="add_address">Add Address</button></a>	
	<a href="#"><button id="add_employee">Add Employee</button></a>		
</span>
	<a href="#"><button id="forward">Next Record</button></a>
</div>


<div id="dialog_company"  class="dialog" title="Basic dialog">
	<p>This is an animated dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>
<div id="dialog_address"  class="dialog" title="Basic dialog">
	<p>This is an animated dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>
<div id="dialog_employee" class="dialog" title="Basic dialog">
	<p>This is an animated dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>