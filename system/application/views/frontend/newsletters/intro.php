<div id="selectform">
	<?= form_open('frontend/view_newsletters') ?>
	<select name="country">
		<option value="">Please Select</option>
		<?php foreach ($countries as $row): 

		if($row->country == $country) {
			$selected ="selected='selected'";
		} else {
			$selected ="";
		}

		?>


		<option <?=$selected?> value="<?= $row->country ?>">
			<?= $row->country ?>
		</option>
		<?php endforeach;
		?>
	</select>
	<?= form_submit('Submit', 'Select Country') ?>

	<?= form_close() ?>

</div>

<?php foreach ($countries as $row): ?>

<?= form_open('frontend/view_newsletters') ?>
<div style="width:100%; height:30px; padding:3px 0; margin-bottom:0px; margin-top:3px; background:#ddd;">
	<?= form_hidden('country', $row->country) ?>
	<div style="color:#00478F; font-size:1.3em; font-weight:bold; float:left; padding-top:7px; padding-left:20px;">
		<?= $row->country ?>
	</div>
	<div style="float:right; padding-right:20px;">
		<?= form_submit('Submit', 'Select Country') ?>
	</div>


</div>
<div style="clear:both"></div>
<?= form_close() ?>


<?php endforeach; ?>