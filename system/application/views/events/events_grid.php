<script src="<?=base_url()?>js/tables/tables.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function confirmation(id) {
	var answer = confirm("are you sure you want to delete this company and all users?")
	if (answer){

	 window.location = "<?=base_url()?>members/delete_company/"+ id;
	}
	else{
		alert("nothing deleted!")
	}
}
//-->
</script>

<div style="display:none;" id="dvloader"><img src="<?=base_url()?>images/ajax-loader.gif"></div>
<table id="events_table"  width="100%" style="clear:both;">

	<thead>
		<tr>
			<th>Title</th>
			<th>Hosted by</th>
			<th>Start Date</th>
                        <th>End Date</th>

		</tr>
	</thead>
	<tbody>
<?php foreach($events as $key => $row):


?>
		<tr>
			<td style="padding:2px; "><?=$row->location_title?></td>

			<td style="padding:2px;"><?=$row->hosted_by_company?></td>

                        <td style="padding:2px;"><?=$row->startdate?></td>

                          <td style="padding:2px;"><?=$row->enddate?></td>
		</tr>
		<?php endforeach;  ?>
	</tbody>
</table>


