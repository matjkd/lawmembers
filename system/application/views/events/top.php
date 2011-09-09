<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			dateFormat : 'DD, d MM, yy',
                        onSelect : function(dateText, inst)
                        {
                            var epoch = $.datepicker.formatDate('@', $(this).datepicker('getDate')) / 1000;

                            $('#alternate').val(epoch);
                        }
                        });

                        $( "#datepicker2" ).datepicker({
			dateFormat : 'DD, d MM, yy',
                        onSelect : function(dateText, inst)
                        {
                            var epoch = $.datepicker.formatDate('@', $(this).datepicker('getDate')) / 1000;

                            $('#alternate2').val(epoch);
                        }
                        });
                        
});
</script>

<script type="text/javascript">
	$(function() {
		var availableTags = [<?php $this->load->view('company/company_names');?>];
		$("#company").autocomplete({
			source: availableTags
		});
	});

	$(function() {
		$("#tabs").tabs();
	});
	</script>
<?php
$times = array(
                  '0'  => '00:00',
                  '1'    => '01:00',
                  '2'    => '02:00',
                  '3'    => '03:00',
                  '4'    => '04:00',
                  '5'    => '05:00',
                  '6'    => '06:00',
                  '7'    => '07:00',
                  '8'    => '08:00',
                  '9'    => '09:00',
                  '10'    => '10:00',
                  '11'    => '11:00',
                  '12'    => '12:00',
                  '13'    => '13:00',
                  '14'    => '14:00',
                  '15'    => '15:00',
                  '16'    => '16:00',
                  '17'    => '17:00',
                  '18'    => '18:00',
                  '19'    => '19:00',
                  '20'    => '20:00',
                  '21'    => '21:00',
                  '22'    => '22:00',
                  '23'    => '23:00',



                );
?>
Add new Event<br/>
<?=form_open('events/create_event')?>

<p>
<?=form_label('Title')?>:<br/>
<?=form_input('event_title')?>
</p>

<p>
<?=form_label('Location')?>:<br/>
<?=form_input('location')?>
</p>

<p>
<?=form_label('Hosted by')?>:<br/>

<input type="text" name="hosted_by_company" id="company"/>
</p>

<p>
<?=form_label('Start date')?>:<br/>
<input type="text" id="datepicker" name="startdate"/>
<input type="hidden" id="alternate" name="startdate_unix"/>
</p>
<p>
<?=form_label('Start time')?>:<br/>
<?=form_dropdown('starttime', $times)?>
</p>

<p>
<?=form_label('End Date')?>:<br/>
<input type="text" id="datepicker2" name="enddate"/>
<input type="hidden" id="alternate2" name="enddate_unix"/>
</p>
<p>
<?=form_label('End time')?>:<br/>
<?=form_dropdown('endtime', $times)?>

<?=form_submit('submit', 'Submit Event!')?>
</p>
