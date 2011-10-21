{<?php foreach($users as $row):?>
'<?=$row['idkeypeople']?>':'<?=$row['firstname']?> <?=$row['lastname']?>', 
<?php endforeach; ?>
'selected':'Other'}