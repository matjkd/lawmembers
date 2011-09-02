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
<table id="table_id"  width="100%" style="clear:both;">

	<thead>
		<tr>
			<th>Company Name</th>
			<th>Country</th>
			<th>web site</th>
                        <th>Active on site</th>
			<th>Actions</th>
		</tr>
	</thead>  
	<tbody>
<?php foreach($companies as $key => $row):


?>
		<tr>
			<td style="padding:2px; "><span class="<?=$row['company_name']?>"></span><?="<a href='".base_url()."members/view/".$row['idcompany']."'>".$row['company_name']."</a>"?></td>
			
			<td style="padding:2px;"><?=$row['country']?></td>
			
			<td style="padding:2px;"><a href="http://<?=$row['company_web']?>" target="_blank"><?=$row['company_web']?></a></td>

                        <td style="padding:2px;"><?=$row['active']?></td>

			<td style="padding:2px;">
                       <?php  if($this->session->userdata('user_level') < 2) { ?>
                        <?="<a href='#' onclick='confirmation(".$row['idcompany'].")'><span class='ui-icon ui-icon-circle-close ui-state-highlight'></span></a>"?>
                        <?php } ?>
                        </td>
		</tr>
		<?php endforeach;  ?>
	</tbody>
</table>


