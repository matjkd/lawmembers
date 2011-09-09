<?php foreach($events as $key => $row):
// Format date here
$start = ($row->startdate);
 $end = ($row->enddate);
$startdate = date("l, d F, Y, ga", $start);
$enddate = date("l, d F, Y, ga", $end);


?>

<?php


if(now() < $start){  ?>



<div style="color:#000000;">
 <?php } else { ?>
    <div style="color:#999999;">

 <?php } ?>
<p>
<strong><a href="http://www.laworld.com"><?=$row->location_title?></a></strong><br/>
<?=$startdate?> to <?=$enddate?>
</p>
</div>
<?php endforeach ?>