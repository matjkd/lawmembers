<script type="text/javascript">
var oTable;
$(document).ready(function() {
	oTable = $('#addresses').dataTable({
		"bPaginate": false,
		"bInfo": false,
		"bStateSave": true,
		"bJQueryUI": false,
		"bAutoWidth": false,
		"sDom": 't',
		"aoColumns": [null, {"bSearchable": false}, {"bSearchable": false}, {"bSearchable": false}]
		
	});

});
</script>

<script type="text/javascript">
function addressconfirm(id) {
	var answer = confirm("are you sure you want to delete this address?" + id)
	if (answer){
		
		$.post('<?=base_url()?>members/delete_address/' + id, {id: id});
		alert('address deleted');	
		
		window.location.reload();
		
	}
	else{
		alert("nothing deleted!")
	}
	
	
	$('#ajax_addresses').load('<?=base_url()?>members/address_table/<?=$company_id?>');
}

function showaddress(id2) {
	
	$('#view_address').load('<?=base_url()?>members/view_address/' + id2);
}



</script>

<table id="addresses"  width="100%" style="clear:both; ">
	<thead>
		<tr>
			<th>Address 1</th>
			<th>order</th>
			<th>city</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php 

if ($addresses == "no")
{
	echo "There are no addresses listed here. Add some.";
}
else
{	
foreach($addresses as $key => $row):

?>
		<tr>
			<td style="padding:5px;"><?=$row['address1']?> </td>
					
			<td style="padding:5px;"><?=$row['order']?></td>
			
			<td style="padding:5px;"><?=$row['city']?></td>
				
			<td style="padding:5px;"><?="<a href='#' onclick='showaddress(".$row['idaddress'].")'>edit</a> 
| <a href='#' onclick='addressconfirm(".$row['idaddress'].")'>Delete</a>"?>
</td>
		
		</tr>
		<?php

		endforeach;

}?>
	</tbody>
</table>


