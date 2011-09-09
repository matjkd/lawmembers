<script src="<?=base_url()?>js/tables/tables.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function confirmation(id) {
	var answer = confirm("are you sure you want to delete this Event")
	if (answer){

	 window.location = "<?=base_url()?>events/delete_event"+ id;
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
                        <th>Actions</th>

		</tr>
	</thead>
	<tbody>
<?php foreach($events as $key => $row):
// Format date here
$start = ($row->startdate);
 $end = ($row->enddate);
$startdate = date("l, d F, Y, ga", $start);
$enddate = date("l, d F, Y, ga", $end);


?>
		<tr>
			<td style="padding:2px; "><a href="<?=base_url()?>events/view_event/<?=$row->event_id?>"><?=$row->location_title?></a></td>

			<td style="padding:2px;"><?=$row->hosted_by_company?></td>

                        <td style="padding:2px;"><?=$startdate?></td>

                        <td style="padding:2px;"><?=$enddate?></td>

                         <td style="padding:2px;">
                         <?php  if($this->session->userdata('user_level') < 2) { ?>
                        <?="<a href='#' onclick='confirmation($row->event_id)'><span class='ui-icon ui-icon-circle-close ui-state-highlight'></span></a>"?>
                         <?php } ?>
                         </td>
		</tr>
		<?php endforeach;  ?>
	</tbody>
</table>


