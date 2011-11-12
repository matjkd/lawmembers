<script type="text/javascript">        
$(function() {
		var availableTags = [<?php $this->load->view('ajax/ajax_users');?>];
		$("#users").autocomplete({
			source: availableTags
		});
	});
        
        $(function() {
		var availableTags2 = [<?php $this->load->view('company/company_names');?>];
		$("#companies").autocomplete({
			source: availableTags2
		});
	});
</script>

Search Facility for members to list clients offering or searching for products/services worldwide

<button class="submitbutton" id="opener">Add Business Opportunity</button>



<div id="dialog" title="Add Business Opportunity" style="display:none;">
<?=form_open('clientsearches/add_search')?>

<p>
<?=form_label('Title')?>:<br/>
<?=form_input('search_title', set_value('title'))?>
</p>

<p>
<?=form_label('Member Name')?>:<br/>

  <input  type="text" name="member_name" id="users" value="<?=set_value('member_name')?>"/>
</p>

<p>
<?=form_label('Member Firm', set_value('member_firm'))?>:<br/>

  <input  type="text" name="company" id="companies"  value="<?=set_value('company')?>"/>
</p>

<p>
<?=form_label('Business Opportunity')?>:<br/>

	<?php
$textarea_data = array(
              'name'        => 'content',
              'id'          => 'content',
			  'class' 		=> 'wymeditor'
            );


		echo form_textarea($textarea_data, set_value('content'));


?>
<br/>
	<input type="submit" class="wymupdate" />
</div>
        <br/>

<?=$this->load->view('clientsearch/view_searches')?>