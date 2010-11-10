<script type="text/javascript">
$(document).ready(function() {
	$('#employees').dataTable({
		"bPaginate": false,
		"bInfo": false,
		"bStateSave": true,
		"bJQueryUI": false,
		"bAutoWidth": false,
		"aoColumns": [null, {"bSearchable": false}, {"bSearchable": false}, {"bSearchable": false}]
		
		});
} );

</script>
<script type="text/javascript">
<!--
function employeeconfirm(id) {
	var answer = confirm("are you sure you want to delete this employee?")
	if (answer){
		
		$.post('<?=base_url()?>contacts/delete_employee/', {id: id
			
			});
			
	}
	else{
		alert("nothing deleted!")
	}
	$('#ajax_employees').load('<?=base_url()?>contacts/employee_table/<?=$company_id?>');
}
//-->
</script>

<table id="employees"  width="100%" style="clear:both; ">
	<thead>
		<tr>
			<th>Name</th>
			<th>Job Title</th>
			<th>Email</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php 
if ($employees == "no")
{
	echo "There are no employees listed here. Add some.";
}
else
{	
foreach($employees as $key => $row):

?>
		<tr>
			<td style="padding:5px;"><?=$row['firstname']?> <?=$row['lastname']?></td>
					
			<td style="padding:5px;"><?=$row['jobtitle']?></td>
			
			<td style="padding:5px;"><a href="mailto:<?=$row['people_email']?>"><?=$row['people_email']?></a></td>
				
			<td style="padding:5px;"><?="<a href='".base_url()."members/view_employee/".$row['idkeypeople']."'>View</a> | <a href='#' onclick='employeeconfirm(".$row['idkeypeople'].")'>Delete</a>"?></td>
		
		</tr>
		<?php

		endforeach;

}?>
	</tbody>
</table>


