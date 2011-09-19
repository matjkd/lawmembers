<?=form_open('clientsearches/add_search')?>

<p>
<?=form_label('Title')?>:<br/>
<?=form_input('search_title')?>
</p>

<p>
<?=form_label('Content')?>:<br/>

	<?php
$textarea_data = array(
              'name'        => 'content',
              'id'          => 'content',
			  'class' 		=> 'wymeditor'
            );


		echo form_textarea($textarea_data);


?>
<br/>
	<input type="submit" class="wymupdate" />

        <br/>

<?=$this->load->view('clientsearch/view_searches')?>