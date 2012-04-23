<div id="selectform">
<?= form_open('frontend/view_newsletters') ?>
<select name="country">
    <?php foreach ($countries as $row): 
        
        if($row->country == $country) {
            $selected ="selected='selected'";
        } else {
            $selected ="";
        }
        
        ?>
    
    
        <option <?=$selected?> value="<?= $row->country ?>"><?= $row->country ?></option>
    <?php endforeach;
    ?>
</select>
<?= form_submit('Submit', 'Select Country') ?>

<?= form_close() ?>

</div>
<script src="<?= base_url() ?>js/tables/tables.js" type="text/javascript" ></script>
<table id="newsletter_table" style="width:100%;">
    <thead>
        <tr>
            <th>Date</th>
            <th>Title</th>
            <th>Jurisdiction</th>
      


        </tr>

    </thead>
    <tbody>
        <?php
        foreach ($newsletters as $row):

            $link = str_replace(" ", "+", $row->newsletter_filename);
            $datestring1 = "%F %Y ";
            $datestring2 = " %d/%m/%Y ";
            $time = $row->newsletter_date;
            $time2 = $row->date_added;
            $newsletter_date = mdate($datestring1, $time);
            $date_added = mdate($datestring2, $time2);
            ?>

            <tr>
           
                <td> <?= $newsletter_date ?></td>
                     <td>  <a href="https://s3-eu-west-1.amazonaws.com/laworldnewsletters/<?= $link ?>"><?= $row->newsletter_title ?></a><br/> <em>Written by <?= $row->company_name ?></em> </td>
               
                <td> <?= $row->city ?>, <?= $row->country ?></td>
               


            </tr>




        <?php endforeach; ?>
    </tbody>
</table>