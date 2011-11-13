<br/>
<br/>
<?php if (isset($gallery_images)) {
    foreach ($gallery_images as $row): ?>

        <div style="float:left; width:100px;">
            <img width="90px" src="https://s3-eu-west-1.amazonaws.com/laworld/events/<?= $row['image_folder'] ?>/<?= $row['image_filename'] ?>"/><br/>
            <a href="<?= base_url() ?>events/delete_image/<?= $row['image_id'] ?>">Delete</a>


            <?= form_open('events/delete_image') ?>
            <?php
            $filename =  $row['image_filename'];
            $bucket_name = "events/".$row['image_folder'];
            ?>
            <?= form_hidden('folder', $bucket_name) ?> 

            <?= form_hidden('filename', $filename) ?> 
            <?= form_hidden('image_id', $row['image_id']) ?> 

            <?= form_submit('submit', 'delete image') ?>
            <?= form_close() ?>
        </div>
    <?php endforeach;
} ?>





