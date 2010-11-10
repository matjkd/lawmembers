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

		
		
		
	
		
		$( "#add_address" ).button().click(function() {
			$( "#dialog_address" ).dialog( "open" );
			return false;
		});
		
		
		
		$( "#repeat" ).buttonset();

		
	});

	
	
	</script>
	
	

<div id="toolbar" class="ui-widget-header ui-corner-all">


	<a href="<?=base_url()?>members/view_employee/"><button id="rewind">Previous Record</button></a>
		
	<a href="<?=base_url()?>members/view_employee/"><button id="forward">Next Record</button></a>


</div>


