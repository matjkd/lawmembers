<div style="width:200px;"><?php foreach($events as $key => $row):
// Format date here
$start = ($row->startdate);
 $end = ($row->enddate);
$startdate = date('ga \o\n l \t\h\e jS \o\f F, Y', $start);
$enddate = date('ga \o\n l \t\h\e jS \o\f F, Y', $end);


?>

    <div id="frontend" style="color:#000000;">
<?php


if(now() < $start){  ?>

<p>
<strong><a style="font-weight: bolder; color:#CA430A;" href="http://www.laworld.com/news-and-publications/meetings-and-events.html" target="_top"><?=$row->event_title?> (<?=$row->location_title?>)</a></strong>
from <?=$startdate?> to <?=$enddate?>
</p>


 <?php } else { ?>
    

 <?php } ?>

</div>

<?php endforeach ?>
</div>