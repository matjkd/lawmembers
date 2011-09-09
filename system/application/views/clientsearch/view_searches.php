list of searches
<?php foreach($searches as $row):
    // Format date here
$date_added = ($row->date_added);

$date_added = date("l, d F, Y, ga", $date_added);



    ?>

<h1><?=$row->search_title?></h1>
<?=$date_added?>
<p>

   <?=$row->content?>
</p>
<hr/>
<?php endforeach ?>