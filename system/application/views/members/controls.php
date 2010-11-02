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
	
	
<?=$this->load->view('popups/popup_company')?>
<?=$this->load->view('popups/popup_address')?>
<?=$this->load->view('popups/popup_employee')?>

<div id="toolbar" class="ui-widget-header ui-corner-all">
<?php 
if($company_id == 0)
{
	echo '<button id="add_company">Add Company</button>';
}
else
{

?>
	<a href="#"><button id="rewind">Previous Record</button></a>
		<span align=center>
			<button id="add_company">Add Company</button>
			<button id="add_address">Add Address</button>	
			<button id="add_employee">Add Employee</button>		
		</span>
	<a href="#"><button id="forward">Next Record</button></a>

<?php } ?>
</div>


