<?php foreach($event as $key => $row):
// Format date here
$start = ($row->startdate);
 $end = ($row->enddate);
$startdate = date("l, d F, Y, ga", $start);
$enddate = date("l, d F, Y, ga", $end);


?>

<?php


if(now() < $start){  ?>



<div id="frontend" style="color:#000000;">
 <?php } else { ?>
    <div id="frontend" style="color:#999999;">

 <?php } ?>
<p>
<h3><a href="<?=base_url()?>frontend/view_event/<?=$row->event_id?>"><?=$row->location_title?></a></h3>
<?=$startdate?> to <?=$enddate?><br/>

<em>Hosted by <?=$row->hosted_by_company?></em><br/><br/>
Location  <?=$row->location_title?>
</p>
</div>
<?php endforeach ?>

    <?=$this->load->view('events/view_gallery')?>