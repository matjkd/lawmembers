<?php foreach($oldContent as $row):?>


<?=$row->alias?> -startpublish <?=human_to_unix($row->publish_up)?><br/>

<?php endforeach; ?>
