<?php foreach($companies as $key => $row): ?>

<strong><?=$row['company_name']?></strong>, <?=$row['country']?>, <a href="http://<?=$row['company_web']?>"><?=$row['company_web']?></a><br/>


<?php endforeach; ?> 