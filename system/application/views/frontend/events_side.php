<div style="width:200px;"><?php foreach($events as $key => $row):
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
<strong><a href="http://www.laworld.com/news-and-publications/meetings-and-events.html" target="_top"><?=$row->event_title?></a></strong>
<?=$startdate?> to <?=$enddate?>
</p>
</div>

<?php endforeach ?>
</div>