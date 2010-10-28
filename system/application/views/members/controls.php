<style>
	#toolbar {
		padding: 5px 4px;
		width:930px;
		margin-bottom: 10px;
		background: #999999;
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
		$( "#add_company" ).button();
		$( "#add_address" ).button();
		$( "#add_employee" ).button();
		$( "#repeat" ).buttonset();
	});
	</script>


<div id="toolbar" class="ui-widget-header ui-corner-all">
	
	<a href="#"><button id="rewind">Previous Record</button></a>
<span align=center>
	<a href="#"><button id="add_company">Add Company</button></a>
	<a href="#"><button id="add_company">Add Address</button></a>	
	<a href="#"><button id="add_company">Add Employee</button></a>		
</span>
	<a href="#"><button id="forward">Next Record</button></a>
</div>