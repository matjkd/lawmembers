<script type="text/javascript">        
   
        
    
    //date picker on menu page

    $(document).ready(function() {
        $( "#datepicker" ).datepicker({
            dateFormat : 'DD, d MM, yy',
            changeMonth: true,
            changeYear: true,
           
            onSelect : function(dateText, inst)
            {
                var epoch = $.datepicker.formatDate('@', $(this).datepicker('getDate')) / 1000;

                $('#alternate').val(epoch);
            }
        });


  


    });
</script>





<div title="Add Newsletter" >
    <?= form_open_multipart("newsletters/update_newsletter/$newsletter_id") ?> 

    <p>
        Newsletter Title:<br/>
        <?php $inputstyle = "style='width:500px'"; ?>
        <?= form_input('title', $title, $inputstyle) ?>
    </p>


    <p>
        <?= form_label('Member Firm', set_value('member_firm')) ?>:<br/>





        <select name="company">  
            <?php foreach ($companies as $row): ?>
                <?php
                if ($row['idcompany'] == $company_id) {
                    $selectedcompany = "selected='selected'";
                } else {
                    $selectedcompany = "";
                }
                ?>
                <option value="<?= $row['idcompany'] ?>" <?= $selectedcompany ?>><?= $row['company_name'] ?></option>
            <?php endforeach; ?>
        </select>
    </p>


    <p>
        Date of Newsletter: <br/>
        <input type="text" name="date_addedview" id="datepicker" value="<?= $humandate ?>"><br/>
        <input type="hidden" name="date_added" id="alternate" value="<?= $newsletter_date ?>">
    </p>


    <p class="file">
        <?= $filename ?><br/>
       

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


        echo form_textarea($textarea_data, $content);
        ?>
    </p>
    <input type="submit" class="wymupdate" />

    <?= form_close() ?> 
</div>
