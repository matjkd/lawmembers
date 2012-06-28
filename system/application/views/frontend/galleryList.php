<?php foreach($gallery_titles as $row): ?>

<a href="<?=base_url()?>frontend/gallery/<?=$row['gallery_id']?>"><?=$row['gallery_title']?></a><br/>

<?php  endforeach; ?>
