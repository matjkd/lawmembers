<button class="submitbutton" id="opener">Add Image</button>

<div id="dialog" title="Add Image" style="display: none;">

	<?=$this->load->view('gallery/add_gallery')?>

</div>
<hr/>

<?= form_open("admin/create_gallery") ?> 
<p>
   Gallery Name:<br/>
    <?= form_input('gallery_name', set_value('gallery_name')) ?>
</p>
<input type="submit" name="submit"  value="Add New Gallery"/>
<?= form_close()?>
<hr/>
<h2>Galleries</h2>

<?php foreach($gallery_titles as $row): ?>

<?=$row['gallery_title']?><br/>

<?php  endforeach; ?>

