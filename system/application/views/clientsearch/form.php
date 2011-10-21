<script type="text/javascript">        
$(function() {
		var availableTags = [<?php $this->load->view('ajax/ajax_users');?>];
		$("#users").autocomplete({
			source: availableTags
		});
	});
</script>

Search Facility for members to list clients offering or searching for products/services worldwide
<?=form_open('clientsearches/add_search')?>

<p>
<?=form_label('Title')?>:<br/>
<?=form_input('search_title')?>
</p>

<p>
<?=form_label('Member Name')?>:<br/>

  <input  type="text" name="member_name" id="users" />
</p>


<p>
<?=form_label('Business Opportunity')?>:<br/>

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