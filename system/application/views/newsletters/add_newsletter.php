<script type="text/javascript">        
    $(function() {
        var availableTags = [<?php $this->load->view('ajax/ajax_users'); ?>];
        $("#users").autocomplete({
            source: availableTags
        });
    });
        
    
    //date picker on menu page

    $(document).ready(function() {
        $( "#datepicker" ).datepicker({
            dateFormat : 'DD, d MM, yy',
            onSelect : function(dateText, inst)
            {
                var epoch = $.datepicker.formatDate('@', $(this).datepicker('getDate')) / 1000;

                $('#alternate').val(epoch);
            }
        });


  


    });
</script>

<button class="submitbutton" id="opener">Add Newsletter</button>



<div id="dialog" title="Add Newsletter" style="display:none;">
    <?= form_open_multipart("newsletters/submit_newsletter") ?> 

    <p>
        Newsletter Title:<br/>
        <?= form_input('title', set_value('title')) ?>
    </p>


    <p>
        <?= form_label('Member Firm', set_value('member_firm')) ?>:<br/>


        <select name="company">  
            <?php foreach ($companies as $row): ?>
                <option value="<?= $row['idcompany'] ?>"><?= $row['company_name'] ?></option>
            <?php endforeach; ?>
        </select>
    </p>


    <p>
        Date: <br/>
        <input type="text" name="date_addedview" id="datepicker" value=""><br/>
        <input type="hidden" name="date_added" id="alternate" value="">
    </p>


    <p class="file">
        <?= form_label('file') ?><br/>

        <?= form_upload('file') ?>
    </p>



    <p>
        <?= form_label('Description') ?>:<br/>

        <?php
        $textarea_data = array(
            'name' => 'content',
            'id' => 'content',
            'class' => 'wymeditor'
        );


        echo form_textarea($textarea_data, set_value('content'));
        ?>
    </p>
    <input type="submit" class="wymupdate" />

    <?= form_close() ?> 
</div>
