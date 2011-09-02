<script src="<?=base_url()?>js/tables/tables.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function confirmation(id) {
	var answer = confirm("are you sure you want to delete this user?")
	if (answer){

		window.location = "<?=base_url()?>members/delete_employee/"+ id;
	}
	else{
		alert("nothing deleted!")
	}
}
//-->
</script>

<div style="display:none;" id="dvloader"><img src="<?=base_url()?>images/ajax-loader.gif"></div>
<table id="usertable"  width="100%" style="clear:both;">

	<thead>
		<tr>
			<th>Name</th>
			<th>Company</th>
			<th>Active</th>
                        <th>Visible on Site</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($users as $key => $row):


?>
		<tr>
			<td style="padding:2px; "><a href="<?=base_url()?>members/view_employee/<?=$row['idkeypeople']?>"><?=$row['firstname']?> <?=$row['lastname']?></a></td>

			<td style="padding:2px;"><a href="<?=base_url()?>members/view/<?=$row['idcompany']?>"><?=$row['company_name']?></a></td>

			<td style="padding:2px;"><?=$row['user_active']?></a></td>
                        <td style="padding:2px;"><?=$row['visible']?></a></td>

			<td style="padding:2px;"><?="<a href='#' onclick='confirmation(".$row['idkeypeople'].")'><span class='ui-icon ui-icon-circle-close ui-state-highlight'></span></a>"?></td>
		</tr>
		<?php endforeach;  ?>
	</tbody>
</table>


