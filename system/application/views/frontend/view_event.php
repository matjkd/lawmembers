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

<br/>
<br/>
<?php if(isset($gallery_images)){ foreach($gallery_images as $row):?>

<div style="float:left; width:100px;"?>
<img width="90px" src="https://s3-eu-west-1.amazonaws.com/laworld/events/<?=$row['image_folder']?>/<?=$row['image_filename']?>"/><br/>
 
</div>
<?php endforeach; } ?>
