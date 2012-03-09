<?php foreach($newsletters as $row):?>


<?=$row->newsletter_title?> - <a href="<?=base_url()?>newsletters/edit/<?=$row->newsletter_id?>">edit</a><br/>

<?php endforeach; ?>
